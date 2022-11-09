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

Décio Mazzutti, 22 October 2003
*/

/*
 * creation - 2004-03-18 - al_nunes
 *
 */


/**
* Interbase/Firebird connection class
*
* @author  Atua Sistemas de informacao
* @since   2004-03-18
* @package Jaguar
*/
Class JDBConnIbase
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
  * Controls if there is an opened transaction
  * @var boolean
  */
  var $mHasTransaction;

  /**
  * Stores an array with the PostgreSQL functions' names
  * @var array
  */
  var $mFunctions;

  /**
  * Stores most recently executed SQL statement
  * @var string
  */
  var $mLastSql;

  /**
  * Controls if the database uses external increment or not
  * @var boolean
  */
  var $mUseExternalIncrement = true;

  /**
  * Stores the generator prefix
  * @var boolean
  */
  var $mGeneratorPrefix = "s_";

  /**
  * Constructor
  */
  function __construct()
  {
    // Empty
  }

  /**
  * Connects to the database with the given parameters
  * @param string $db   Database's name
  * @param string $user Database's user
  * @param string $pwd  Users' password
  * @param string $host Database's host
  */
  function Connect($db = false, $user = false, $pwd = false, $host = false)
  {
    $this->mUser = $user;

    $this->mConn = ibase_connect($host . ":" . $db, $user, $pwd);
    if (!$this->mConn)
      return false;

    $this->mFunctions[] = "gen_id"; 
/*
    $sql = "SELECT distinct LOWER(p.proname) FROM pg_proc p";
    $rs = pg_query($this->mConn, $sql);

    while ($row = pg_fetch_array($rs, NULL, PGSQL_ASSOC))
      $this->mFunctions[] = $row["proname"];
*/    
    return true;

  }

  /**
  * Executes an SQL statement
  * @param   string  $sql    The SQL statement
  * @param   int     $limit  How many rows might be returned if the statement is a SELECT
  * @param   int     $offset How many rows mus be "jumped" from the begining of the recod set
  * @returns mixed   True or recordset if success, false otherwise
  */
  function Execute($sql, $limit = false, $offset = false)
  {
    if (substr(strtoupper(trim($sql)), 0, 6) == "SELECT")
    {
      $select = "SELECT ";

      if ($limit && is_int($limit))
      {
        $select .= " FIRST($limit) ";
      }        
      if ($offset && is_int($offset))
        $select .= " SKIP($offset) ";


      if (strlen($select) != 7)
        $sql = $select . substr(trim($sql), 7, strlen($sql));

    }

    $this->SetLastSql($sql);
    $this->mResult = @ibase_query($this->mConn, $sql);

    return $this->mResult;
  }

  /**
  * Returns the last inserted row
  * Function not implemented in Interbase/Firebird
  * @param string $table_name Name of the table affected by the most recent INSERT statement
  */
  function GetInserted($table_name)
  {
    $sql = "SELECT ";

    //Puts the key fields in the statement
    for ($i = 0; $i < sizeof($_SESSION["s_keys_array"]); $i++)
      $sql .= $_SESSION["s_keys_array"][$i] . ", ";

    //Puts the other fields in the statement
    for ($i = 0; $i < sizeof($_SESSION["s_fields_array"]); $i++)
      $sql .= $_SESSION["s_fields_array"][$i] . ", ";

    $sql = substr($sql, 0, (strlen($sql) - 2));  

    $sql .= " FROM " . $_SESSION["s_table_name"] . " WHERE ";
    
    //Puts the key fields in the statement
    for ($i = 0; $i < sizeof($_SESSION["s_keys_array"]); $i++)
    {
      $sql .= $_SESSION["s_keys_array"][$i] . " = ( ";
      $sql .= "SELECT DISTINCT gen_id($this->mGeneratorPrefix". $_SESSION["s_keys_array"][$i] . ", 0) " . 
              "FROM " . $_SESSION["s_table_name"] . ")";
    }

    $this->mResult = ibase_query($this->mConn, $sql);
    
    return $this->mResult;
  }

  /**
  * Opens a transaction
  * @returns boolean True in success, false otherwise
  */
  function BeginTransaction()
  {
    if (!$this->mHasTransaction)
    {
      $this->mHasTransaction = true;
      ibase_trans($this->mConn);
    }
  }

  /**
  * Commits a transaction
  * @returns boolean True in success, false otherwise
  */
  function Commit()
  {
    if ($this->mHasTransaction)
    {
      $this->mHasTransaction = false;
      ibase_commit($this->mConn);
    }
  }

  /**
  * Rolls back a open transaction
  * @returns boolean True in success, false otherwise
  */
  function Rollback()
  {
    if ($this->mHasTransaction)
    {
      $this->mHasTransaction = false;
      ibase_rollback($this->mConn);
    }
  }

  /**
  * Closes the database connection
  * @returns boolean True in success, false otherwise
  */
  function Close()
  {
    return ibase_close($this->mConn);
  }

  /**
  * Evaluates if the given value must be quoted before its use in a SQL statement
  * @param mixed $value The field value that will be evaluated
  * @returns string
  */
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
      $out = "NULL";
    else
    {
      $array = array("\\\"" => "&#34", "'" => "''");
      $value = strtr($value, $array);

      $out = "'" . $value . "'";
    }

    return $out;
  }

  /**
  * Returns a significative description of the error or sends an warning e-mail
  * @returns string
  */
  function GetError()
  {
    $original_string = ibase_errmsg();

    return $original_string;
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
  * Builds the call to the database function tha auto-increments a field
  * @return string
  */
  function GetIncrementalKey($key)
  {
    $str = "gen_id(". $this->mGeneratorPrefix . $key . ", 1)";
    return $str;
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
* Iterbase/Firebird recod set manipulation class
*
* @author  Atua Sistemas de Informacao
* @since   2004-03-21
* @package Jaguar
*/
Class JDBRSIbase
{
  /**
  * Stores the result set
  * @var JDBRS
  */
  var $mResult;
  
  /**
  * Stores number of lines in the record set
  * @var integer
  */
  var $mRowCount = false;
  
  /**
  * Stores data returned by the record set
  * @var array
  */
  var $mRows = false;

  /**
  * Constructor
  */
  function __construct()
  {
    //empty  
  }

  /**
  * Sets the result set
  */
  function Result($result)
  {
    $this->mResult = $result;
    $this->mIndex  = -1;
  }

  /**
  * Stores the database connection (Some databases might use it)
  * @param JDBRS $result A JDBRS Object
  */
//  function SetConn($conn)
//  {
//    $this->mConn = $conn;
//  }

  /**
  * Gets the number of columns from the record set
  * @returns int
  */
  function GetRowCount()
  {

    if ((is_bool($this->mRowCount)) && (!$this->mRowCount))
    {
      $row_count = 0;

      while ($row = ibase_fetch_row($this->mResult))
      {
        $this->mRows[] = $row;
        $row_count++;
      }

      $this->mRowCount = $row_count;
    }

    return $this->mRowCount;
  }

  /**
  * Gets the number of fields from the record set
  * @returns int
  */
  function GetFieldCount()
  {
    return ibase_num_fields($this->mResult);
  }

  /**
  * Gets the field names from the record set
  * @returns array
  */
  function GetFieldNames()
  {
    for ($i = 0; $i < $this->GetFieldCount(); $i++)
    {
      $info = ibase_field_info($this->mResult, $i);
      $name = strtolower($info["name"]);
      $arr[$name]["number"]   = $i;
      $arr[$name]["type"]     = strtolower($info["type"]); 
      $arr[$name]["size"]     = $info["length"]; 
      $arr[$name]["relation"] = $info["type"]; 
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

    return $this->mRows[$this->mIndex];
  }

  /**
  * Returns to the beginning from result set
  */
  function Reset()
  {
    $this->mIndex = -1;
  }

  /**
  * Close the result set
  * @returns boolean
  */
  function Close()
  {
    return ibase_free_result($this->mResult);
  }
}