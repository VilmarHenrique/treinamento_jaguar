<?php
/*
Jaguar - A PHP framework for IT systems development
Copyright (C) 2003  Atua Sistemas de Informação Ltda.

This library is free software; you can redistribute it and/or
modify it under the terms of the GNU Lesser General Public
License as published by the Free Software Foundation; either
version 2.1 of the License, or (at your option) any later version.

This library is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU
Lesser General Public License for more details.

You should have received a copy of the GNU Lesser General Public
License along with this library; if not, write to the Free Software
Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA

You can contact Atua Sistemas de Informação Ltda by the e-mail jaguar@atua.com.br, or
885 XV de Novembro street, Passo Fundo, RS 99010-100 Brazil

Atua Sistemas de Informação Ltda., hereby disclaims all copyright interest in
the library 'Jaguar' (A PHP framework for IT systems development) written
by it's development team.

*/

/*
 * creation - 2004-03-17 - Fábio Arezi
 *
 */


/**
* MySQL connection class
*
* @author  ...
* @since   17/03/2004
* @package Jaguar
*/
Class JDBConnMysql
{
  /**
  * Stores the database connection
  * @var object
  */
  var $mConn;

  /**
  * Stores the result identifier
  * @var int
  */
  var $mResult;

  /**
  * It's not used. Left to keep compatibility. 
  * @var boolean
  */
  var $mHasTransaction;

  /**
  * It's not used. Left to keep compatibility. 
  * @var array
  */
  var $mFunctions;

  /**
  * Stores most recently executed SQL statement
  * @var string
  */
  var $mLastSql;

  /**
  * Constructor
  */
  function __construct()
  {
    /* Empty */
  }

  /**
  * Connects to the database with the given parameters
  * @param string $db Database's name
  * @param string $user Database's user
  * @param string $pwd Users' password
  * @param string $host Database's host
  */
  function Connect($db = false, $user = false, $pwd = false, $host = false)
  {
    /* Build connection string */

    $this->mConn = mysql_connect($host, $user,$pwd);
    if (!$this->mConn)
      return false;

	mysql_select_db($db, $this->mConn);

    return true;

  }

  /**
  * Executes an SQL statement
  * @param string  $sql The SQL statement
  * @param int $limit How many rows might be returned if the statement is a SELECT
  * @param int $offset How many rows mus be "jumped" from the begining of the recod set
  * @returns mixed True or recordset if success, false otherwise
  */
  function Execute($sql, $limit = false, $offset = false)
  {
    if (substr(strtoupper($sql), 0, 6) == "SELECT")
    {
      if ($limit && is_int($limit))
        $sql .= " LIMIT $limit ";
      if ($offset && is_int($offset))
        $sql .= " OFFSET $offset ";
    }

    $this->SetLastSql($sql);

    $this->mResult = mysql_query($sql, $this->mConn);

    return $this->mResult;
  }

  /**
  * Returns the last inserted row
  * @param string $table_name Name of the table affected by the most recent INSERT statement
  */
  function GetInserted($table_name)
  {
    if (sizeof($_SESSION["s_keys_array"]) == 1)
    {
      $sql = "SELECT LAST_INSERT_ID()";

      if (!$result = mysql_query($sql, $this->mConn))
        return false;

      $sql = "SELECT * FROM " . $_SESSION["s_table_name"] . " WHERE ";
      
      //Puts the key fields in the statement
      for ($i = 0; $i < sizeof($_SESSION["s_keys_array"]); $i++)
        $sql .= $_SESSION["s_keys_array"][$i] . " = ". mysql_result($result, 0, $i);
     
      $this->mResult = mysql_query($sql, $this->mConn);
    }
    else
      $this->mResult = mysql_query($table_name, $this->mConn);
    
    return $this->mResult;
  }

  /**
  * It's not used. Left to keep compatibility. 
  * @returns always true
  */
  function BeginTransaction()
  {
    if (!$this->mHasTransaction)
    {
      $this->mHasTransaction = true;
      return true;
    }
  }

  /**
  * It's not used. Left to keep compatibility. 
  * @returns always true
  */
  function Commit()
  {
    if ($this->mHasTransaction)
    {
      $this->mHasTransaction = false;
      return true;
    }
  }

  /**
  * It's not used. Left to keep compatibility. 
  * @returns always true
  */
  function Rollback()
  {
    if ($this->mHasTransaction)
    {
      $this->mHasTransaction = false;
      return true;
    }
  }

  /**
  * Closes the database connection
  * @returns boolean True in success, false otherwise
  */
  function Close()
  {
    return mysql_close($this->mConn);
  }

  function QuoteValue($value)
  {
    if (is_integer($value)
        or is_int($value)
        or ((string)$value == "0")
        or ( strpos($value, "(")
             and
             in_array( strtolower(substr($value,0,strpos($value,"("))) , $this->mFunctions)
           ) )
      $out = $value;
    else if (empty($value))
      $out = "null";
    else
      $out = "'" . $value . "'";
    
    return $out;
  }
          
  /**
  * Returns a significative description of the error and the SQL code;
  * @returns string
  */
  function GetError()
  {
    $original_string = mysql_error($this->mConn);
    if (strlen($original_string) == 0)
      return "";

   return $original_string." - ".$this->mLastSql;
  }

  /**
  * Stores the last SQL statement sent to the PostgreSQL backend
  * @param string $lastSql A SQL statement
  */
  function SetLastSql($lastSql = false)
  {
    $this->mLastSql = $lastSql;
  }
  
  /**
   * Test if table exists
   * @param string table name
   */
  function TableExists($table_name)
  {
    return false;
  }

  /**
   * Test if sequence exists
   * @param string sequence name
   */
  function SequeceExists($sequence)
  {
    return false;
  }
  
  /**
   * create sequences
   * @param string $sequence_name
   * @param int $start
   */
  function CreateSequence($sequence_name, $start)
  {
    return false;
  }

  /**
   * test if field exists in a table
   * @param type $table_name
   * @param type $field_name
   * @return boolean
   */
  function FieldExists($table_name, $field_name)
  {
    return false;
  }
}

/**
* MySQL recod set manipulation class
*
* @author  Atua Sistemas de Informacao
* @since   2004-03-17
* @package Jaguar
*/
Class JDBRSMysql
{
  /**
  * Stores the result set
  * @var JDBRS
  */
  var $mResult;

  /**
  * Sets the result set
  */
  function Result($result)
  {
    $this->mResult = $result;
    $this->mIndex  = -1;
  }

  /**
  * Gets the number of columns from the record set
  * @returns int
  */
  function GetRowCount()
  {
    return mysql_num_rows($this->mResult);
  }

  /**
  * Gets the number of fields from the record set
  * @returns int
  */
  function GetFieldCount()
  {
    return mysql_num_fields($this->mResult);
  }

  /**
  * Gets the field names from the record set
  * @returns array
  */
  function GetFieldNames()
  {
    $top = mysql_num_fields($this->mResult);
    for ($i = 0; $i < $top; $i++)
    {
      $name = mysql_field_name($this->mResult, $i);
      $arr[$name]["number"] = $i;
      $arr[$name]["type"] = mysql_field_type($this->mResult, $i);
      $arr[$name]["size"] = mysql_field_len($this->mResult, $i);
    }
    return $arr;
  }

  /**
  * Jumps to the next row in the record set
  * @returns array 
  */
  function Next()
  {
    $this->mIndex++;

	  return mysql_fetch_row($this->mResult);
  }

  /**
  * Returns to the beginning from result set
  */
  function Reset()
  {
	  mysql_field_seek($this->mResult, 0);

    $this->mIndex = -1;
  }

  /**
  * Close the result set
  * @returns boolean
  */
  function Close()
  {
    return mysql_free_result($this->mResult);
  }
}