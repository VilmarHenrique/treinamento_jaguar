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
 * creation - 2002-01-06 - migliori
 *
 * 2003-03-27 - decio
 *  criado nova função GetTextualError()
 *
 * 2003-05-04 - Pedro
 *  implementação de controle para log e log_erro
 *
 * 2003-11-18 - al_nunes
 *  opcao de utilizar ou noa o log baseado no usuario informado no arquivo de configuracao
 */

/**
* Database connection abstraction class
*
* @author  Atua Sistemas de Informação
* @since   2002-05-31
* @package Jaguar
*/

require_once(JAGUAR_PATH . "/IXR_Library.inc.php");

define("LOG_SELECT",       3);
define("LOG_ONLY_ERRORS",  2);
define("LOG_EVERY_ACTION", 1);
define("NO_LOG",           0);

class JDBConn
{
  /**
  * Stores the driver name (with fisrt letter in upper case)
  * @var string
  */
  var $mDriverName;

  /**
  * Stores the driver object
  * @var object
  */
  var $mDriver;

  /**
  * Stores the log driver object
  * @var object
  */
  var $mLogDriver;
  
  /**
  * Controls if the posted SQL statements must be printed to screen
  * @var boolean
  */
  var $mDebug         = false;

  /**
  * Controls whether the debug string will be shown formatted (for better viewing)
  * @var boolean
  */
  var $mShowFormattedDebug   = false;

  /**
  * Stores the database name
  * @var string
  */
  var $mDb;

  /**
  * Stores the database user name
  * @var string
  */
  var $mUser;

  /**
  * Stores the database log user name
  * @var string
  */
  var $mLogUser;

  /**
  * Stores the database password
  * @var string
  */
  var $mPwd;

  /**
  * Stores the database host
  * @var string
  */
  var $mHost;

  /**
  * Stores the database connection type (persistent or not)
  * @var boolean
  */
  var $mPersistent    = true;

  /**
  * Stores the name of tha table wich received the last insertion
  * @var string
  */
  var $mInsertedTable;

  /**
  * Controls the use of the log
  * @var boolean
  */
  var $mLog           = false;

  /**
  * Stores the name of the log table
  * @var string
  */
  var $mLogTable      = "log";

  /**
  * Stores the name of the error log table
  * @var string
  */
  var $mLogErrorTable = "log_erro";

  /**
  * Stores the temporary table names created in this connection instance 
  * @var array
  */
  var $arrayTemporaryTables = array();

  private static $instance;
  private static $instanceBackup;

  /**
  * Constructor
  * @param string $driver
  */
  function __construct($driver = false, $persistent = false)
  {
    $this->SetPersistent($persistent);

    if ($driver)
      $this->LoadDriver($driver);

    $this->SetLog(LOG_EVERY_ACTION);
  }

  /**
  * Identifies what database driver must be used and instanciate one of its objects
  * @param string $driver The driver's name. Eg.: pgsql
  */
  function LoadDriver($driver)
  {
    $driver = strtolower($driver);
    require_once(JAGUAR_PATH . "jdbdrivers/jdb". $driver . ".inc.php");
    $this->mDriverName = ucfirst($driver);
    $driver = "JDBConn".$this->mDriverName;
    $this->mDriver    = new $driver();
  }
  
  function TableExists($table_name)
  {
    return $this->mDriver->TableExists($table_name);
  }

  function SequenceExists($sequence)
  {
    return $this->mDriver->SequenceExists($sequence);
  }
  
  function CreateSequence($sequence_name, $start = 1)
  {
    if (!$this->SequenceExists($sequence_name))
      return $this->mDriver->CreateSequence($sequence_name, $start);

    return true;
  }

  /**
   * test if field exists in a table
   * @param type $table_name
   * @param type $field_name
   * @return type
   */
  function FieldExists($table_name, $field_name)
  {
    return $this->mDriver->FieldExists($table_name, $field_name);
  }

  /**
  * Conects to the selected database with the given parameters
  * @param string $db A string containing the database's name
  * @param string $user A string containing the user's name
  * @param string $pwd A string containing the user's password
  * @param string $host A string containing the host's name
  * @param string $logUser A string containing the log user's name
  * @returns boolean True in sucess, false otherwise
  */
  function Connect($db = false, $user = false, $pwd = false, $host = false, $logUser = "log")
  {
    $this->mDb      = $db;
    $this->mUser    = $user;
    $this->mPwd     = $pwd;
    $this->mHost    = $host;
    $this->mLogUser = $logUser;

    if (method_exists($this->mDriver, "SetPersistent"))
      $this->mDriver->SetPersistent($this->mPersistent);

    $this->mDriver->Connect($db, $user, $pwd, $host); 

    if ( (!is_object($this->mLogDriver)) && ((bool)$this->mLog) )
    {
      $driver = "JDBConn" . $this->mDriverName;
      $this->mLogDriver = new $driver();
//      $this->mLogDriver->Connect($this->mDb, $this->mLogUser, $this->mPwd, $this->mHost);
    }
  
    return true; 
  }

  /**
   * Verify if has connection established
   * @return boolean True if has connection, False otherwise
   */
  function IsConnected()
  {
    if (!is_object($this->mDriver)) return false;

    if (!$this->mDriver->mConn) return false;

    if (!is_resource($this->mDriver->mConn)) return false;

    if (get_resource_type($this->mDriver->mConn) == "Unknown") return false;

    return true;
  }

  /**
  * Sets if connection must be persistent or not
  * @param boolean $persistent
  */
  function SetPersistent($persistent = true)
  {
    $this->mPersistent = (bool) $persistent;
  }

  /**
  * Sets if every submitted statement must be shown in the screen
  * @param boolean $debug
  */
  function SetDebug($debug = false, $formatted = false)
  {
    $this->mDebug = (bool) $debug;
    $this->mShowFormattedDebug = (bool) $formatted;
  }

  /**
  * Sets the log level
  * @param mixed $log { 0 - No Log | 1 - Log Every Action | 2 - Log Only Errors | 3 - Log Select Too }
  */
  function SetLog($log = false)
  {
    if (is_bool($log))
    {
      if ($log)
        $log = LOG_EVERY_ACTION;
      else
        $log = NO_LOG;
    }
    else
    {
      if ( ($log != NO_LOG) && ($log != LOG_ONLY_ERRORS) && 
           ($log != LOG_EVERY_ACTION) && ($log != LOG_SELECT) && (!$this->mLogUser) )
        $log = NO_LOG;
    }

    $this->mLog = $log;
  }

  /**
  * Sets the name of the log table
  * @param string $table Log table's name
  */
  function SetLogTable($table)
  {
    $this->mLogTable = $table;
  }

  /**
  * Sets the name of the error log table
  * @param string $table Error log table's name
  */
  function SetLogErrorTable($table)
  {
    $this->mLogErrorTable = $table;
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
    $this->CheckIfTemporaryCreated($sql);
    $return = $this->mDriver->Execute($sql, $limit, $offset);

    if ($this->mDebug)
    {
      $table = new JTable();
      /*
       * Avoid the following infinite loop
       JTable -> GetHtml -> CanSelect (Validate Permission) ->
                    -> JDBConn::Select("SELECT canselect...") -> if mDebug -> JTable -> GetHtml() ->...
      */
      $table->SetAuth(false);
      $table->OpenHeader($this->mDriverName);

      if ($this->mShowFormattedDebug)
        $table->OpenCell("<pre>".$sql."</pre>");
      else
        $table->OpenCell(nl2br($sql));

      echo $table->GetHtml();

      if (!$return && $this->GetError() !== false)
      {
        $table_error = $this->GetError();
        echo $table_error->GetHtml();
      }
    }

    //Log
    if ($this->mLog && (is_object($this->mLogDriver)))
    {
      if (!$return && $this->GetError() !== false)
        $this->WriteLog($this->mLogErrorTable, $sql, $this->mDriver->GetError());
      else
      {
        if ($this->mLog == LOG_EVERY_ACTION || $this->mLog === LOG_SELECT)
          $this->WriteLog($this->mLogTable, $sql);
      }
    }
    
    return $return;
  }

  /**
  * Returns the address of a table object containing the error message, or the table's output
  * @param boolean $returnAsText Controls if the return value of the function must be a JTable object or the tables output
  * @returns mixed
  */
  function &GetError($returnsAsText = false)
  {
    if (!strlen($this->mDriver->GetError()) && !strlen($this->mError))
      return false;

    $table = new JTable;
    $table->OpenHeader($this->mDriverName);
    $table->OpenCell("<b>".$this->mDriver->GetError() . " " . $this->mError . "</b>");
    
    if ($returnsAsText)
      return $table->GetHtml();
    else
      return $table;
  }

  /**
  * Return the textual the error message
  * @returns string
  */
  function GetTextualError()
  {
    $array = array("\n\n\n" => "",
                   "\n\n"   => " => ");
    $str = $this->mDriverName ." => ". strtr($this->mDriver->GetError(), $array) ." => ". $this->mDriver->mLastSql;
    return $str;
  }

  /**
  * Evaluates if the given value must be quoted before its use in a SQL statement
  * @param mixed $value The field value that will be evaluated
  * @returns string
  */
  function QuoteValue($value)
  {
    return $this->mDriver->QuoteValue($value);
  }

  /**
  * Builds an insert statement based in the given params
  * @param string $table Name of the table that will receive new rows
  * @param array  $values Associative array containing the fields' names and values. Ex.: array("value" => "foo")
  * @returns boolean True in success, false otherwise
  */
  function Insert($table, $values)
  {
    reset ($values);
    $field_names  = key($values);
    $field_values = $this->QuoteValue(current($values));

    for ($i = 1; $i < sizeof($values); $i++)
    {
      next($values);
      $field_names  .= ", "  . key($values);
      $field_values .= ", " . $this->QuoteValue(current($values));
    }
    $sql = "INSERT INTO $table ($field_names) VALUES ($field_values) ";
    $this->mInsertedTable = $table;
    return $this->Execute($sql);
  }

  /**
  * Builds an update statement based in the given params
  * @param string $table Name of the table that may have rows updated
  * @param array  $values Associative array containing the fields' names and values for the SET clause. Ex.: array("value" => "foo")
  * @param array  $where  Associative array containing the fields' names and values for the WHERE clause.
  * @returns boolean True in success, false otherwise
  */
  function Update($table, $values, $where = false, $extra_values = false, $extra_where = false, $operator_extra_where = true)
  {
    if (is_array($values))
    {
      reset ($values);
      $field_names  = key($values) . " = " . $this->QuoteValue(current($values));
      for ($i = 1; $i < sizeof($values); $i++)
      {
        next($values);
        $field_names .= ", " . key($values) . " = " . $this->QuoteValue(current($values));
      }

      $operator = "WHERE ";
      if ($where)
      {
        reset ($where);
        $field_where = $operator . key($where) . " = " . $this->QuoteValue(current($where));
        $operator = "AND ";
        for ($i = 1; $i < sizeof($where); $i++)
        {
          next($where);
          $field_where .= " $operator" . key($where) . " = " . $this->QuoteValue(current($where));
        }
      }

      $sql = "UPDATE $table SET $field_names " . (is_string($extra_values) ? ", " . "$extra_values " : "") . 
                        "$field_where " . (is_string($extra_where) ? " " . ($operator_extra_where ? $operator : "") . " " . "$extra_where " : "");

      $out = $this->Execute($sql);
    }
    else
      $out = true;

    return $out;
  }


  /**
  * Builds a delete statement based in the given params
  * @param string $table Table's name 
  * @param array  $where Associative array containing the fields' names and values for the WHERE clause.
  * @returns boolean True in success, false otherwise
  */
  function Delete($table, $where = false, $extra_where = false)
  {

    $operator = "WHERE ";
    if ($where)
    {
      reset ($where);
      $field_where = $operator . key($where) . " = " . $this->QuoteValue(current($where));
      $operator = "AND ";
      for ($i = 1; $i < sizeof($where); $i++)
      {
        next($where);
        $field_where .= " $operator" . key($where) . " = " . $this->QuoteValue(current($where));
      }
    }
    
    $tmpWhere = $field_where . " " . (is_string($extra_where) ? " $operator " . $extra_where : "");
    
    if (!strlen(trim($tmpWhere)))
    {
      $this->mError = "Delete na tabela $table sem restrição Where.";
      return false;
    }

    $sql = "DELETE FROM $table $tmpWhere";
    return $this->Execute($sql);
  }

  /**
  * Checks in the sql string if a temporary table is being created
  * @param string $sql 
  */
  function CheckIfTemporaryCreated(&$sql)
  {
    preg_match("/TEMP(ORARY)? {1,}(table {1,})?([A-Z0-9_]{1,})/i" , $sql, $createdTemporaryTable);
    $size = sizeof($createdTemporaryTable);
    if ($size > 0)
      $this->arrayTemporaryTables[] = $createdTemporaryTable[$size-1];
  }

  /**
  * Executes a select statement. Returns the record set if succedded or false in failure
  * @param string $sql The SELECT statement
  * @param int $limit How many rows might be returned if the statement is a SELECT
  * @param int $offset How many rows mus be "jumped" from the begining of the recod set
  */
  function Select($sql, $limit = false, $offset = false)
  {
    if ($this->Execute($sql, $limit, $offset))
    {
      $rs = new JDBRS($this->mDriverName, $this->mDriver->mResult);
      return $rs;
    }
    else
      return false;
  }

  /**
  * Returns the last inserted row
  * returns mixed JDBRS if availiable, false otherwise
  */
  function GetInserted($sql = false)
  {
    //alterado para compatibilidade com novo driver pg
    $parametro = $sql;

    if ($this->mDriver->GetInserted($parametro))
    {
      $rs = new JDBRS($this->mDriverName, $this->mDriver->mResult);
      return $rs;
    }
    else
    {
      return false;
    }
  }

  /**
  * Opens a database transaction
  * @returns boolean True in success, false otherwise
  */
  function BeginTransaction()
  {
    $this->WriteLog($this->mLogTable, $this->mDriver->mBeginTransaction);
    return $this->mDriver->BeginTransaction();
  }

  /**
  * Commit the changes made in the actual transaction
  * @returns boolean True in success, false otherwise
  */
  function Commit()
  {
    $this->WriteLog($this->mLogTable, $this->mDriver->mCommit);
    return $this->mDriver->Commit();
  }

  /**
  * Rolls back the changes made in the actual transaction
  * @returns boolean True in success, false otherwise
  */
  function Rollback()
  {
    $this->WriteLog($this->mLogTable, $this->mDriver->mRollback);
    return $this->mDriver->Rollback();
  }

  /**
  * Closes the database connection
  * @returns boolean True in success, false otherwise
  */
  function Close()
  {
    foreach($this->arrayTemporaryTables as $tableName)
      $this->mDriver->Execute('DROP TABLE '.$tableName);

    return $this->mDriver->Close();
  }

  /**
  * Returns the kind of SQL statement
  * @param string $sql The SQL statement 
  * @returns int 0 - Insert, 1 - Update, 2 - Delete, 3 - Select/With
  */
  function GetSqlAction($sql)
  {
    $str = strtoupper(substr(trim($sql), 0, 1));
    switch ($str)
    {
      case "I": $action = 0; break;
      case "U": $action = 1; break;
      case "D": $action = 2; break;
      case "W":
      case "S": $action = 3; break;
    }
    return $action;
  }
  
  /**
  * Writes log
  * @param string $table Affected table's name
  * @param string $sql Full SQL Statement
  * @param string $error If it's an error log, the description of the error
  */
  function WriteLog($table, $sql, $error = false)
  {
    global $rpc_log_server;
  
    //user
    $user = $_SESSION["jaguar_username"]; 
    $banco = ($this->mDb ? $this->mDb : $GLOBALS["banco_nome"]);
   
    //script
    $script = basename($_SERVER["PHP_SELF"]);

    if ($this->mLog)
    {
      $action = $this->GetSqlAction($sql);

      if ($action != 3 || ($action == 3 && $this->mLog === LOG_SELECT))
      {
        $str = "$user^" . date("Y-m-d H:i:s") . "^$sql^" . $this->GetSqlAction($sql) . "^$script^$banco\n";

        if (strlen($rpc_log_server))
        {
          // Create new XML-RPC client
          $client = new IXR_Client($rpc_log_server);

          // Try the sayHello function
          if (!$client->query("demo.WriteLogRpc", $str, ((defined("EFESUS")) ? EFESUS : "") . $path . "log") )
          {
              die("Something went wrong - ".$client->getErrorCode()." : ".$client->getErrorMessage());
          }

          // Show response
          if (is_string($client->getResponse()))
            echo $client->getResponse();
        }
        else
          JDBLog::gravarLog($str);

      }//if ($this->GetSqlAction($sql) != 3)
    }//if ($this->mLog)
   
  }

  /**
   * Singleton
   * @return JDBConn
   */
  public static final function getInstance()
  {
    if (isset(self::$instance))
      return self::$instance;
      
    self::$instance = new JDBConn($GLOBALS["banco_tipo"]);
    return self::$instance;
  }

  /**
   * Singleton
   * @return JDBConn
   */
  public static final function getInstanceBackup()
  {
    if (!isset($GLOBALS["banco_host_backup"]))
      return self::getInstance();

    if (!isset(self::$instanceBackup))
    {
      self::$instanceBackup = new JDBConn($GLOBALS["banco_tipo"]);
      self::$instanceBackup->Connect($GLOBALS["banco_nome"], $GLOBALS["banco_usuario"], $GLOBALS["banco_senha"], $GLOBALS["banco_host_backup"]);
    }

    if (self::getDelay() > 1800)
      return self::getInstance();

    return self::$instanceBackup;
  }

  public static function getDelay()
  {
    if (!isset(self::$instanceBackup))
      self::getInstanceBackup();

    if (!self::$instanceBackup || !self::$instanceBackup->IsConnected())
      return false;

    $sql = "SELECT CASE WHEN pg_last_xlog_receive_location() = pg_last_xlog_replay_location()
                     THEN 0
                     ELSE EXTRACT (EPOCH FROM now() - pg_last_xact_replay_timestamp())
                   END AS delay ";

    if (!$rs = self::$instanceBackup->Select($sql))
      return false;

    return (int)$rs->GetField("delay");
  }
}

class JDBLog
{
  const ID_OPERADOR_E  = 1;
  const ID_OPERADOR_OU = 2;

  public static $opIdOperador = array(
    self::ID_OPERADOR_E  => "E",
    self::ID_OPERADOR_OU => "OU"
  );

  public static function obterOpMeses()
  {
    $opIdMeses = array();

    if (file_exists((defined("EFESUS") ? EFESUS : "") . "log/jaguar.log"))
    {
      foreach (glob((defined("EFESUS") ? EFESUS : "") . "log/*.log.*") as $nmArquivo)
      {
        $tmArquivo = filemtime($nmArquivo);
        $opIdMeses[date("Y/m", $tmArquivo)] = date("m/Y", $tmArquivo);
      }
    }
    else
    {
      $dsCaminho = (defined("EFESUS") ? EFESUS : "") . "log/jaguar/";

      foreach (glob("{$dsCaminho}*/*") as $nmPasta)
      {
        $nmPasta = str_replace($dsCaminho, "", $nmPasta);
        $opIdMeses[$nmPasta] = implode("/", array_reverse(explode("/", $nmPasta)));
      }
    }

    $opIdMeses[date("Y/m")] = "Atual";
    krsort($opIdMeses);
    
    return array_merge(array("" => "Todos os meses"), $opIdMeses);
  }

  private static function obterNmArquivoMes($dtMes)
  {
    foreach (glob((defined("EFESUS") ? EFESUS : "") . "log/*.log.*") as $nmArquivo)
      if (date("Y/m", filemtime($nmArquivo)) === $dtMes)
        return basename($nmArquivo);
  }

  public static function gravarLog($dsLog)
  {
    if (file_exists((defined("EFESUS") ? EFESUS : "") . "log/jaguar.log"))
      $nmArquivo = (defined("EFESUS") ? EFESUS : "") . "log/jaguar.log";
    else
    {
      $nmPastaLog = (defined("EFESUS") ? EFESUS : "") . "log/jaguar/" . date("Y/m");
      $nmArquivo = $nmPastaLog . "/jaguar_" . date("Ymd") . ".log";

      if (!is_dir($nmPastaLog))
        if (!@mkdir($nmPastaLog, 0777, true))
          echo "Nao foi possivel criar o diretório: {$nmPastaLog}";
    }

    $dsLog = preg_replace("/(\\n|\\r\\n)/", " ", $dsLog)."\n";

    if (file_put_contents($nmArquivo, $dsLog, FILE_APPEND) === false)
      echo "Não foi possível abrir arquivo de log.";
  }


  public static function obterArrDsCaminho($dtInicial, $dtFinal) {
    $arrDsCaminho = array();

    try
    {
      $dtInicial = DateTime::createFromFormat("d/m/Y", $dtInicial);
      $dtFinal = DateTime::createFromFormat("d/m/Y", $dtFinal)->modify("+1 day");

      $dias = new DatePeriod($dtInicial, DateInterval::createFromDateString("1 day"), $dtFinal);

      foreach ($dias as $dia)
        $arrDsCaminho[] = $dia->format("Y/m") . "/jaguar_" . $dia->format("Ymd");
    }
    catch (Exception $e) {}

    return $arrDsCaminho;
  }



  public static function obterArrLog($dtInicial, $dtFinal, $idOperador, $cdUsuario, array $arrFiltros)
  {
    $arrSaida = $arrGreps = array();

    $nmPasta = (defined("EFESUS") ? EFESUS : "") . "log/jaguar/";

    $arrDsCaminho = self::obterArrDsCaminho($dtInicial, $dtFinal);

    if ((int)$cdUsuario)
      $arrGreps[] = "grep -a ^{$cdUsuario}^";

    if (count($arrFiltros))
    {
      $fnFormatarFiltro = function ($filtro) {
        return str_replace(array("^", "\\'"), array("\\^'", "'"), trim($filtro));
      };

      $arrFiltros = array_map($fnFormatarFiltro, $arrFiltros);

      if ((int)$idOperador === self::ID_OPERADOR_OU)
        $arrGreps[] = "egrep -a -i \"(" . implode("|", $arrFiltros) . ")\"";
      else
        foreach ($arrFiltros as $dsFiltro)
          $arrGreps[] = "egrep -a -i \"{$dsFiltro}\"";
    }

    if (count($arrGreps) && count($arrDsCaminho))
    {
      $dsGrep = implode(" | ", $arrGreps);

      $dsComando = implode("; ", array_map(function($dsCaminho) use ($nmPasta, $dsGrep) {
        return "zcat {$nmPasta}{$dsCaminho}.log.gz | {$dsGrep}; cat {$nmPasta}{$dsCaminho}.log | {$dsGrep}";
      }, $arrDsCaminho));

      exec($dsComando, $arrSaida);
    }

    return $arrSaida;
  }
  
  public static function obterArrLogApp($dtInicial, $dtFinal, $idOperador, $cdUsuario, array $arrFiltros)
  {
    $arrSaida = $arrGreps = array();
    
    $nmPasta = "/var/www/html/api/appWMS/log/jaguar/";

    //$nmPasta = (defined("EFESUS") ? EFESUS : "") . "log/jaguar/";

    $arrDsCaminho = self::obterArrDsCaminho($dtInicial, $dtFinal);

    if ((int)$cdUsuario)
      $arrGreps[] = "grep -a ^{$cdUsuario}^";

    if (count($arrFiltros))
    {
      $fnFormatarFiltro = function ($filtro) {
        return str_replace(array("^", "\\'"), array("\\^'", "'"), trim($filtro));
      };

      $arrFiltros = array_map($fnFormatarFiltro, $arrFiltros);

      if ((int)$idOperador === self::ID_OPERADOR_OU)
        $arrGreps[] = "egrep -a -i \"(" . implode("|", $arrFiltros) . ")\"";
      else
        foreach ($arrFiltros as $dsFiltro)
          $arrGreps[] = "egrep -a -i \"{$dsFiltro}\"";
    }

    if (count($arrGreps) && count($arrDsCaminho))
    {
      $dsGrep = implode(" | ", $arrGreps);

      $dsComando = implode("; ", array_map(function($dsCaminho) use ($nmPasta, $dsGrep) {
        return "zcat {$nmPasta}{$dsCaminho}.log.gz | {$dsGrep}; cat {$nmPasta}{$dsCaminho}.log | {$dsGrep}";
      }, $arrDsCaminho));

      exec($dsComando, $arrSaida);
    }

    return $arrSaida;
  }
  
  public static function obterArrLog1($dtMes, $idOperador, $cdUsuario, array $arrFiltros)
	{
    $arrSaida = $arrGreps = array();
    $regExpGz = $regExp = "";

    if (file_exists((defined("EFESUS") ? EFESUS : "") . "log/jaguar.log"))
    {
      $dsCaminho = (defined("EFESUS") ? EFESUS : "") . "log";

      if ($dtMes === date("Y/m"))
        $regExp       = "jaguar.log";
      elseif (preg_match("/\\d{4}\\/\\d{2}/", $dtMes))
        $regExpGz = self::obterNmArquivoMes($dtMes);
      else
      {
        $regExpGz     = "jaguar.log.*";
        $regExp       = "jaguar.log";
      }
    }
    else
    {
      $dsCaminho = (defined("EFESUS") ? EFESUS : "") . "log/jaguar/" . (preg_match("/\\d{4}\\/\\d{2}/", $dtMes) ? $dtMes : "*/*");
      $regExpGz     = "*.gz";
      $regExp       = "*.log";
    }


    if ((int)$cdUsuario)
      $arrGreps[] = "grep -a ^{$cdUsuario}^";

    if (count($arrFiltros))
    {
      $arrFiltros = array_map("preg_quote", array_map("trim", $arrFiltros));

      if ((int)$idOperador === self::ID_OPERADOR_OU)
        $arrGreps[] = "egrep -a -i \"(" . implode("|", $arrFiltros) . ")\"";
      else
        foreach ($arrFiltros as $dsFiltro)
          $arrGreps[] = "egrep -a -i \"{$dsFiltro}\"";
    }

    if (count($arrGreps))
    {
      $dsGrep = implode(" | ", $arrGreps);

      $dsComando = implode("; ", array_filter(array(
        ($regExpGz ? "zcat {$dsCaminho}/{$regExpGz} | {$dsGrep}" : null),
        ($regExp   ? "cat {$dsCaminho}/{$regExp} | {$dsGrep}"    : null)
      ), "str_value"));

      exec($dsComando, $arrSaida);
    }

    return $arrSaida;
  }
}

/**
* Record Set Manipulation Class
*
* @author  Atua Sistemas de Informação
* @since   2002-05-31
* @package Jaguar
*/
class JDBRS
{
  /**
  * Stores the driver name
  * @var string
  */
  var $mDriverName;

  /**
  * Stores the driver object
  * @var object
  */
  var $mDriver;

  /**
  * Stores the number of fields in the record set
  * @var int
  */
  var $mFieldCount;

  /**
  * Stores the number of rows in the record set
  * @var int
  */
  var $mRowCount;

  /**
  * Stores the names of the record set's fields
  * @var array
  */
  var $mFieldNames;

  /**
  * Stores index the record set
  * @var int
  */
  var $mIndex;

  /**
  * Controls if the current line of the record set is its last
  * @var boolean
  */
  var $mEof;

  /**
  * Stores the current line of the record set
  * @var array
  */
  var $mFields;

  /**
  * Constructor
  * @param string $driver Name of the appropriate driver
  * @param object $result Result resource retunrned from a select statement
  */
  function __construct($driver, $result)
  {
    $this->LoadDriver($driver);
    $this->Result($result);
  }

  /**
  * Identifies what database driver must be used and instanciate one of its objects
  * @param string $driver The driver's name. Eg.: pgsql
  */
  function LoadDriver($driver)
  {
    $driver = strtolower($driver);
    require_once(JAGUAR_PATH . "jdbdrivers/jdb". $driver . ".inc.php");
    $this->mDriverName = ucfirst($driver);
    $driver = "JDBRS".$this->mDriverName;
    $this->mDriver = new $driver();
  }

  /**
  * Stores informations about the record set
  * @param int $result A valid result set
  */
  function Result($result)
  {
    $this->mDriver->Result($result);

    $this->mRowCount   = $this->mDriver->GetRowCount();
    $this->mFieldCount = $this->mDriver->GetFieldCount();
    $this->mFieldNames = $this->mDriver->GetFieldNames();
    $this->mIndex      = -1;
    $this->mEof        = ($this->mRowCount)?false:true;

    $this->Next();

  }

  /**
  * Verifies if the record set has reached its end
  * @returns boolean Returns true if the record set has reached its end, false otherwise
  */
  function IsEof()
  {
    return $this->mEof;
  }

  /**
  * Jumps to the next row in the recod set. 
  * @returns Returns true if it's not the end of the record set and false otherwise
  */
  function Next()
  {
    $this->mIndex++;
    if ($this->mIndex < $this->mRowCount)
    {
      $this->mFields = $this->mDriver->Next();
      return true;
    }
    else
    {
      $this->mEof = true;
      return false;
    }
  }

  /**
  * Jumps to the first row of the record set
  */
  function Reset()
  {
    $this->mIndex = -1;
    $this->mDriver->Reset();
    $this->mEof = ($this->mDriver->GetRowCount())?false:true;
    $this->Next();
  }

  /**
  * Returns the value of a field in the actual row
  * @param mixed $name The name of the field or its index in the record set
  * @returns mixed
  */
  function GetField($name)
  {
    if (!is_integer($name))
      return $this->mFields[$this->GetFieldNumber($name)];
    else
      return $this->mFields[$name];
  }

  /**
  * Returns the field name for the specified column index
  * @param int $number
  * @returns string
  */
  function GetFieldName($number)
  {
    reset($this->mFieldNames);
    for ($i = 0; $i < $number; $i++)
      next($this->mFieldNames);
    return key($this->mFieldNames);
  }

  /**
  * Returns the index of a field in the record set for the specified column name
  * @param string $name
  * @returns int
  */
  function GetFieldNumber($name)
  {
    return $this->mFieldNames[$name]["number"];
  }

  /**
  * Returns the number of fields in the record set
  * @returns int
  */
  function GetFieldCount()
  {
    return $this->mFieldCount;
  }

  /**
  * Returns the number of rows in the record set
  * @returns int
  */
  function GetRowCount()
  {
    return $this->mRowCount;
  }

  /**
  * Returns an array (associative or not) with the record set's values
  * @param boolean $associative Specifies if the returned array might be assossiative or not
  * @returns array
  */
  function GetArray($associative = false)
  {
    $j = 0;
    $arr = array();

    while (!$this->IsEof())
    {
      if ($associative)
      {
        for ($i = 0; $i < $this->GetFieldCount(); $i++)
          $arr[$j][$this->GetFieldName($i)] = $this->GetField($i);
      }
      else
      {
        for ($i = 0; $i < $this->GetFieldCount(); $i++)
          $arr[$j][$i] = $this->GetField($i);
      }

      $j++;
      $this->Next();
    }

    $this->Reset();

    return $arr;
  }

  /**
  * Closes the record set
  */
  function Close()
  {
    return $this->mDriver->Close();
  }

}
