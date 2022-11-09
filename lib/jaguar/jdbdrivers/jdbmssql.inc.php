<?php
  /**
   * User: vinicius
   * Date: 23/11/15
   * Time: 14:40
   */
  class JDBConnMssql
  {
    protected $resultSet;

    public $mResult;

    public $mReservedWords;

    public $mConn;

    public $rowCount;

    public $mFunctions;

    public $mHasTransaction;

    public function Connect($db, $user, $pwd, $host)
    {
      $this->mReservedWords = array("is not null", "is null", "true", "false", "coalesce",
                                    "session_user", "current_user", "current_date", "current_timestamp",
                                    "current_time", "null", "not null", "localtime", "localtimestamp");
      $this->mFunctions = null; //TODO

      $this->mConn = mssql_connect($host, $user, $pwd) or die('Erro ao connectar com SQL Server');
      mssql_select_db($db, $this->mConn);
    }

    public function Result($result)
    {
      $this->mResult = $result;
      $this->mIndex  = -1;
    }

    public function Execute($sql, $limit = false, $offset = false)
    {
      //TODO implementar o $limit e $offset
      $this->mResult = @mssql_query($sql, $this->mConn);

      return $this->mResult;
    }


    public function GetError()
    {
      return mssql_get_last_message();
    }

    function QuoteValue($value)
    {
      $out = "";

      if (in_array(strtolower($value), $this->mReservedWords)
          or in_array(strtolower(substr($value,0,strpos($value,"("))) , $this->mReservedWords)
          or ( strpos($value, "(")
               and
               in_array( strtolower(substr($value,0,strpos($value,"("))) , $this->mFunctions)
          ) )
        $out = $value;
      else if (!strlen($value))
        $out = "NULL";
      else if ((substr($value,0,1) == "(") && (substr($value, strlen($value)-1, 1) == ")"))
        $out = $value;
      else
      {
        $array = array("\\\"" => "&quot", "'" => "\\'");
        $value = strtr($value, $array);

        $array = array("\\\\'" => "\\'");
        $value = strtr($value, $array);

        $value = "'" . trim($value) . "'";

        $out .= (strpos($value, "\\")!==false?"E".$value:$value);
      }


      return $out;
    }

    /**
     * Test if table exists
     * @param string table name
     * @return boolean
     */
    function TableExists($table_name)
    {
      $sql = "SELECT COUNT(*) FROM information_schema.tables WHERE table_name = '$table_name'";
      $rs = mssql_query($sql, $this->mConn);
      $arr = mssql_fetch_array($rs, 0);

      return ($arr["count"]>=1?true:false);
    }

    /**
     * test if sequence exists
     * @param string $sequence sequence name
     * @return boolean
     */
    function SequenceExists($sequence)
    {
      $sql = "SELECT COUNT(*) FROM information_schema.sequences WHERE sequence_name = '$sequence'";
      $rs = mssql_query($sql, $this->mConn);
      $arr = mssql_fetch_array($rs, 0);

      return ($arr["count"]>=1?true:false);
    }

    /**
     * test if field exists in a table
     * @param type $table_name
     * @param type $field_name
     * @return type
     */
    function FieldExists($table_name, $field_name)
    {
      $sql = "SELECT COUNT(*) FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_NAME = '$table_name' AND COLUMN_NAME = '$field_name' ";
      $rs = mssql_query($sql, $this->mConn);
      $arr = mssql_fetch_array($rs, 0);

      return ($arr["count"]>=1?true:false);
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
        return $this->Execute("begin");
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
        return $this->Execute("commit");
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
        return $this->Execute("rollback");
      }
    }
  }

  /**
   * SQL Server recod set manipulation class
   *
   * @author  Atua Sistemas de Informacao
   * @since   2002-06-01
   * @package Jaguar
   */
  Class JDBRSMssql
  {
    /**
     * Stores the result set
     * @var resource
     */
    public $mResult;

    /**
     * @var int
     */
    public $mIndex;

    /**
     * Sets the result set
     * @param $result
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
      return @mssql_num_rows($this->mResult);
    }

    /**
     * Gets the number of fields from the record set
     * @returns int
     */
    function GetFieldCount()
    {
      return @mssql_num_fields($this->mResult);
    }

    /**
     * Gets the field names from the record set
     * @returns array
     */
    function GetFieldNames()
    {
      $top = @mssql_num_fields($this->mResult);
      $arr = array();

      for ($i=0; $i<$top; $i++)
      {
        $name = mssql_field_name($this->mResult, $i);
        $arr[$name]["number"] = $i;
        $arr[$name]["size"] = mssql_field_length($this->mResult, $i);
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
      return mssql_fetch_row($this->mResult);
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
      return mssql_free_result($this->mResult);
    }
  }