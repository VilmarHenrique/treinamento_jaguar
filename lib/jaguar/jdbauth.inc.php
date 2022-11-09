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

/**
* Users' authentication class
*
* @author  Atua Sistemas de Informação
* @since   2002-05-31
* @package Jaguar
*/
class JDBAuth
{
  /**
  * Stores the database connection object
  * @var object
  */
  var $mConn         = false;

  /**
  * Stores the username
  * @var string
  */
  var $mUser;

  /**
  * Stores the meaningful part of the scripts name
  * @var string
  */
  var $mScript;

  /**
  * Constructor
  * @param object $conn A JDBConnection object
  * @param string $user The current users's id in the database
  * @param string $script Full scripts name. Ex.: sel_country.php
  * @param string $department If record authentication level is used, department is the code of the entity
  * @param string $table Name of the table or view that holds the authentication's data
  */
  function __construct($conn, $user = false, $script = false, $department = false, $table = false)
  {
    $this->mConn = &$conn;

    $this->SetUser($user);
    $this->SetScript($script);
    $this->SetDepartment($department);
    $this->SetAuthTable($table);
  }

  /**
  * Sets the user
  * @param int $user Code of the current user in the database
  */
  function SetUser($user = false)
  {
    if ($user)
      $this->mUser = $user;
    elseif (isset($_SESSION["jaguar_username"]))
      $this->mUser = $_SESSION["jaguar_username"];
  }
  
  /**
  * Sets the department of the user
  * @param int $department Code of the row level restriction
  */
  function SetDepartment($department = false)
  {
    if ($department)
      $this->mDepartment = $department;
    elseif (isset($GLOBALS["jaguar_department"]))
      $this->mDepartment = $GLOBALS["jaguar_department"];
  }
  
  /**
  * Sets the meaningful part of the script
  * @param $script Full script's name
  */
  function SetScript($script)
  {
    $this->mScript = JDBAuth::GetFunctionName($script);
  }

  /**
  * Sets the meaningful part of the script
  * @param $script Full script's name
  */
  public static function GetFunctionName($script)
  {
    $functionName = $script ? $script : basename($_SERVER["PHP_SELF"]);

    $ini = strpos($functionName, "_");
    $ini = $ini ? $ini + 1 : 0;
    $fin = strlen($functionName) - strpos($functionName, ".");
    $functionName = substr($functionName, $ini, strlen($functionName));
    $functionName = substr($functionName, 0, strlen($functionName) - $fin);

    return $functionName;
  }

  /**
  * Sets the authentication's base table
  * @param string $table The name of the table or view that holds authentication's data
  */
  function SetAuthTable($table = false)
  {
    $this->mAuthTable = ($table)?$table:"jaguar_auth";
  }

  /**
  * Verifies if the user has permission to menu
  * @returns boolean
  */
  function CanMenu()
  {
    if (!$this->mAuthTable || !$this->mUser || !$this->mScript)
      return false;

    $sql = "SELECT canmenu " .
             "FROM " . $this->mAuthTable . " "  .
            "WHERE TRUE " .
              "AND functionname = '" . $this->mScript  . "' ";

    if (!empty($this->mDepartment))
      $sql .= "AND department='" . $this->mDepartment  . "' ";

    $can = false;

    if ( ($rs = $this->mConn->Select($sql)) )
    {
      while (!$rs->IsEof())
      {
        $can = (bool)$rs->GetField("canmenu");
        $rs->Next();
      }
      $rs->Close();
    }

    else
      $can = true;
   
    return $can;
  }

  /**
  * Verifies if the user has permission to update
  * @returns boolean
  */
  function CanUpdate()
  {
    if (!$this->mAuthTable || !$this->mUser || !$this->mScript)
      return false;

    $sql = "SELECT canupdate " .
             "FROM " . $this->mAuthTable . " "  .
            "WHERE TRUE " .
              "AND functionname = '" . $this->mScript  . "' ";

    if (!empty($this->mDepartment))
      $sql .= "AND department='" . $this->mDepartment  . "' ";

    $can = false;

    if ( ($rs = $this->mConn->Select($sql)) )
    {
      while (!$rs->IsEof())
      {
        $can = (bool)$rs->GetField("canupdate");
        $rs->Next();
      }
      $rs->Close();
    }

    else
      $can = true;
   
    return $can;
  }

  /**
  * Verifies if the user has permission to delete
  * @returns boolean
  */
  function CanDelete()
  {
    if (!$this->mAuthTable || !$this->mUser || !$this->mScript)
      return false;

    $sql = "SELECT candelete " .
             "FROM " . $this->mAuthTable . " "  .
            "WHERE TRUE " .
              "AND functionname = '" . $this->mScript  . "' ";

    if (!empty($this->mDepartment))
      $sql .= "AND department='" . $this->mDepartment  . "' ";

    $can = false;

    if ($rs = $this->mConn->Select($sql))
    {
      while (!$rs->IsEof())
      {
        $can = (bool)$rs->GetField("candelete");
        $rs->Next();
      }
      $rs->Close();
    }

    else
      $can = true;

    return $can;
  }

  /**
  * Verifies if the user has permission to insert
  * @returns boolean
  */
  function CanInsert()
  {
    if (!$this->mAuthTable || !$this->mUser || !$this->mScript)
      return false;

    $sql = "SELECT caninsert " .
             "FROM " . $this->mAuthTable . " "  .
            "WHERE TRUE " .
              "AND functionname = '" . $this->mScript  . "' ";

    if (!empty($this->mDepartment))
      $sql .= "AND department='" . $this->mDepartment  . "' ";

    $can = false;

    if ($rs = $this->mConn->Select($sql))
    {
      while (!$rs->IsEof())
      {
        $can = (bool)$rs->GetField("caninsert");
        $rs->Next();
      }
      $rs->Close();
    }

    else
      $can = true;

    return $can;
  }

  /**
  * static function which sets a script as validated
  */
  public static function SetValidated($script = "", $valid = true)
  {
    if (!$script) $script = JDBAuth::GetFunctionName($script);

    $_SERVER["already_validated"][ $script ] = (boolean) $valid;
  }

  public static function IsValidated($script = "")
  {
    if (!$script) $script = JDBAuth::GetFunctionName($script);

    return isset( $_SERVER["already_validated"][ $script ] );
  }

  public static function IsValid($script = "")
  {
    if (!$script) $script = JDBAuth::GetFunctionName($script);
    
    return (boolean) $_SERVER["already_validated"][ $script ];
  }

  /**
  * Verifies if the user has permission to select
  * @returns boolean
  */
  function CanSelect()
  {
    //Some scripts executed by crontab won't need verification
    //scripts don't have a valid http request method (GET ou POST)
    //

    if (!$_SERVER["REQUEST_METHOD"])
      return true;

    if (!$this->mAuthTable || !$this->mUser || !$this->mScript)
      return false;

    //Do not make the same validation several times
    //
    if (JDBAuth::IsValidated($this->mScript))
      return JDBAuth::IsValid($this->mScript);

    $sql = "SELECT canselect, filename " .
             "FROM " . $this->mAuthTable . " "  .
            "WHERE TRUE " .
              "AND functionname = '" . $this->mScript  . "' ";

    if (!empty($this->mDepartment))
      $sql .= "AND department='" . $this->mDepartment  . "' ";

    $can = false;

    if ($rs = $this->mConn->Select($sql))
    {
      while (!$rs->IsEof())
      {
        $file = $rs->GetField("filename");
        $can = (bool)$rs->GetField("canselect");

        if ($can && $file && $this->mConn->TableExists("mais_acessados"))
        {
          $this->mConn->SetLog(false);

          $link = basename($_SERVER["PHP_SELF"]);

          if ($link != 'bem_vindo.php' && $link != 'sistema.php' && $link == $file && !sizeof($_POST))
          {
            $sql = 
              "SELECT cd_pessoa, nm_funcao, qt_acessos
                 FROM mais_acessados
                WHERE nm_funcao = '$this->mScript'
                  AND cd_pessoa = '$this->mUser'";

            if ($rs_acessos = $this->mConn->Select($sql))
            {
              if ($rs_acessos->GetField("nm_funcao"))
              {
                $values = array("qt_acessos" => $rs_acessos->GetField("qt_acessos") + 1);

                $where  = array("cd_pessoa" => $rs_acessos->GetField("cd_pessoa"),
                                "nm_funcao" => $rs_acessos->GetField("nm_funcao"));

                $this->mConn->Update("mais_acessados", $values, $where);
              }
              else
              {
                $values = array("cd_pessoa"  => $this->mUser,
                                "nm_funcao"  => $this->mScript,
                                "qt_acessos" => 1);

                $this->mConn->Insert("mais_acessados", $values);
              }
            } // if ($rs_acessos = $this->mConn->Select($sql))
          }
        }

        $rs->Next();
      }

      $this->mConn->SetLog(true);

      $rs->Close();
    }

    // this select will fail in two possibilities:
    // 1) misconfiguration (either conf file, database connection, etc.)
    //    in this situation every thing will fail anyway...
    //
    // 2) when a rollback has previously been executed
    // in this case if the user is using the screen he does have permission so we can return true
    //
    else
      $can = true;

    //Set that this validation already occurredd
    //
    JDBAuth::SetValidated($this->mScript, $can);

    return $can;
  }
}