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
885 Quinze de Novembro street, Passo Fundo, RS 99010-100 Brazil

Atua Sistemas de Informação Ltda., hereby disclaims all copyright interest in
the library 'Jaguar' (A PHP framework for IT systems development) written
by it's development team.

Décio Mazzutti, 22 October 2003
*/

/*
 * creation -  - migliori
 *
 * 2003-04-03 - decio
 *  criado a function SetLastInserdet() que guarda em mLastInserted do ultimo registro inserido
 * 
 * 2003-04-16 - Pedro
 *  implementação da utilização de manutenções como popup
 *
 * 2003-05-02 - Pedro
 *  retirada do controle de log e log_erro
 *
 * 2003-10-15 - Pedro
 *  implementação do objeto duallist
 *
 * 2004-03-12 - Pedro
 *  implementado o cancelamento de ações (insert, update e delete)
 *
 * 2004-04-27 - al_nunes
 * mudancas dual list
 *
 */

/**
* Maintenances creation class
*
* @author Atua Sistemas de Informação
* @package Jaguar
*/
class JMaintenance extends JHtml
{
  /**
  * Stores object's type
  * @var string
  */
  var $mType = "Maintenance";

  /**
  * Stores the fields used to build the SQL statements
  * @var array 
  */ 
  var $mFields;
  
  /**
  * Stores the manitenance's table keys
  * @var array 
  */ 
  var $mKeys = array();

  /**
  * Stores the form of the maintenance archive 
  * @var object 
  */ 
  var $mForm;
  
  /**
  * Controls the actions that can be carried through by form 
  * (to insert, to modify, to exclude)
  * 
  * A JFormRadio object
  * 
  * @var object 
  */ 
  var $mAction;
  
  /**
  * A JTable object that stores the maintenance's messages
  * (denied permission, inserted register, modified register, excluded register)
  * @var object 
  */ 
  var $mStatus;

  /**
  * Defines wheather mStatus table will be shown
  * @var booelan
  */
  var $mShowStatus = true;

  /**
  * A JFormSubmit buttons the stores the submit button
  * @var object 
  */ 
  var $mSubmit;
  
  /**
  * Stores the submit button's label
  * @var string 
  */ 
  var $mSubmitLabel      = "Confirmar";
  
  /**
  * Stores the insert action's label
  * @var string 
  */ 
  var $mInsertLabel      = "Inserir";
  
  /**
  * Stores the delete action's label
  * @var string 
  */ 
  var $mDeleteLabel      = "Excluir";

  /**
  * Stores the update action's label
  * @var string 
  */ 
  var $mUpdateLabel      = "Alterar";

  /**
  * Stores insert actions
  * @var array 
  */ 
  var $mInsertActions;

  /**
  * Stores delete and update actions
  * @var array 
  */ 
  var $mDelUpActions;

  /**
  * Controls whther the insert action might be shown or not
  * @var boolean 
  */ 
  var $mShowInsert       = true;

  /**
  * Controls whther the delete action might be shown or not
  * @var boolean 
  */ 
  var $mShowDelete       = true;

  /**
  * Controls whther the update action might be shown or not
  * @var boolean 
  */ 
  var $mShowUpdate       = true;

  /**
  * Controls the maintenance's redirecting 
  * @var boolean
  */
  var $mUseLocation      = true;

  /**
  * Stores the form location
  * @var array
  */
  var $mLocation;

  /**
  * Controls if JFormDualList objects where used in this form
  * @var boolean
  */
  var $mUseDualList      = false;

  /**
  * Stores the JFormDualList objects
  * @var array
  */
  var $mDualLists;

  /**
  * Stores the paraneters for the location URL
  * @var array
  */
  var $mUrlFields;
  
  /**
  * Controls if the keys might be loaded from database
  * @var boolean
  */
  var $mLoadKeys         = false;

  /**
  * Controls if the key might be updated
  * @var array
  */
  var $mUpdateKeys       = false;

  /**
  * Stores the returning callback function's name
  * @var string
  */
  var $mPopUpFunction;
  
  /**
  * Stores the returning callback function's parameters
  * @var array
  */
  var $mPopUpParameters;
  
  
  /**
  * Stores the name of entity used in the maintenanca
  * @var string
  */
  var $mDBTable;
  
  /**
  * Stores the name of entity used in the maintenanca
  * @var string
  */
  var $mTable = false;
  
  /**
  * Stores the name of entity used in the maintenanca
  * @var string
  */
  var $mSchema = false;

  /**
  * Stores the select clause
  * @var string
  */
  var $mSelectClause;

  /**
  * Stores where clause
  * @var string
  */
  var $mWhereClause;
  
  /**
  * Controls if the keys must be informed in insertions
  * @var booolean
  */
  var $mInsertKeys       =  false;
  
  /**
  * Controls if the keys array must be have its values erased after the deletion
  * @var booolean
  */
  var $mCleanDeletedKeys = true;

  /**
  * Controls the usage of automatic transacton control
  * @var string
  */
  var $mAutoTransactionControl;

  /**
  * Stores the name of the grid that will dysplays the maintenance messages
  * @var string
  */
  var $mGridName;

  /**
  * Stores the indicative messages of the maintenance
  * @var string
  */
  var $mMaintenanceMessage;

  /**
  * Stores alert messages of maintenance
  * @var string
  */
  var $mMaintenanceAlertMessage;

  /**
  * Stores the a record set (JDBRS object) containig the last inserted row
  * @var string
  */
  var $mLastInserted;

  /**
  * Controls the cancellation of maintenance action
  * @var boolean
  */
  var $mCancelAction     = false;

  /**
  * Controls whether the efective data's maintenance must be done or not
  * @var boolean
  */
  var $mMaintainData     = true;

  /**
  * Controls whether 
  * @var array
  */
  var $mMaintenanceBuildOrder = array("BuildEndMaintenance" => false, "PostAction" => false, "LoadDbValues" => false); 

  /**
  * Stores the cell options related to the BuildEndMaintenance and GetHtml 
  * @var private array
  */
  var $cellOptions;

  /**
  * Stores the header options related to the BuildEndMaintenance and GetHtml 
  * @var private array
  */
  var $headerOptions;

  /**
  * Constructor
  * @param object $conn   A JDBConnection object
  * @param string $title  Maintenance's title
  * @param boolean $css   Maintenence's CSS file
  */	
  function __construct(&$conn, $title = "Manutenção", $css = false, $jQuery = true)
  {
    //DB Connection
    $this->mConn = &$conn;

    parent::__construct();
    $this->jQuery = $jQuery;

    //Start html
    $this->SetTitle($title);
    $this->SetTopMargin(5);
    $this->SetMarginHeight(5);

    if (str_value($title))
      $this->AddHtml("<h3>".$title."</h3>");

    //Form
    $this->mForm = new JForm("maintenance");
    $this->mForm->SetLineStyles("rowodd", "rowodd", "roweven", "roweven");
    $this->AddObject($this->mForm);

    //action handler
    $this->mAction = new JFormRadio("f_action");

    //Status bar
    $this->mStatus = new JTable();
    $this->mStatus->SetAuth(false); /*IMPORTANT otherwise it will result in unexpected validation error*/

    //Location
    $this->SetDefaultLocation();

    //Transaction Control
    $this->SetAutoTransactionControl();
  }

  /**
  * Adds an object to the objects' array and increases the main index
  * @param string $what Reference to the object that will be added
  */ 
  function AddObject(&$what)
  {
    parent::AddObject($what);

    if (strtolower( get_class($what) ) == "jdbgrid")
      $what->mFilterForm->SetFocus(false);
  }

  /**
  * Mounts the actions and the buttons submit of the form 
  * @param array $cell_options   Associative array containig the cell options. 
  * Eg.: array("colspan" => 2)
  * @param array $header_options Associative array containig the cell options.
  */
  function BuildEndMaintenance($cell_options = false, $header_options = false)
  {
    if (!$this->RaiseBuildOrder("BuildEndMaintenance"))
    {
      echo 'Atenção: Método BuildEndMaintenance invocado duas vezes na mesma pagina';
      return;
    }

    $this->cellOptions   = $cell_options;
    $this->headerOptions = $header_options;

    //Action (object can be initialized before in SetShowInsert, SetShowupdate or SetShowDelete)
    if (!is_object($this->mAction))
      $this->mAction = new JFormRadio("f_action");

    //Submit
    $this->mSubmit = new JFormSubmit("f_submit", $this->mSubmitLabel);

    $this->PostAction();
    $this->LoadDbValues();
  }


  /**
  * return an object reference by its name
  * @param string $name
  * @returns object
  */
  function &GetObjectByName($name)
  {
    return $this->mForm->GetObjectByName($name);
  }

  function SetShowStatus($show)
  {
    $this->mShowStatus = (boolean) $show;
  }

  /**
  * Builds the form's HTML code
  * @returns string
  */
  function GetHtml()
  {
    if (!$this->cellOptions)
      $this->cellOptions = array("colspan" => 2);
    else
      $this->cellOptions["colspan"] += 1;

    //Append Action to Form
    if ($this->mAction->mValue)
    {
      $this->mForm->OpenRow();
      $this->mForm->OpenHeader("Ação:", $this->headerOptions);
      $this->mForm->OpenCell("", array("colspan" => $this->cellOptions["colspan"] - 1)); 
      $this->mForm->AddObject($this->mAction);

      //Append Submit to Form
      $this->mForm->OpenRow();
      $this->mForm->OpenHeader("", $this->cellOptions);
      $this->mForm->AddObject($this->mSubmit);
    }

    //Status Table
    $this->mForm->OpenRow();
    $this->mForm->OpenCell("", $this->cellOptions);

    //redefine mStatus for it's correct purpouse, it might be done for compatibility with older source code
    //
    if ( ($value = "<script>".preg_replace("/(<\/?)(\w+)([^>]*>)/", "", $this->mStatus->GetHtml())."</script>") )
    {
      //TODO deprecated, throw a warning message
      $this->AddHtml($value);
    }

    if ($this->mShowStatus)
    {
      $this->mStatus = new JTable(array("class" => "noborder"));
      $this->mStatus->SetWidth("100%");
      $this->mStatus->OpenHeader("Status:", array("width" => "20%"));
      $this->mStatus->OpenCell($this->mMaintenanceMessage);

      //shows any alert message related with maintenance errors    
      if ($this->mMaintenanceAlertMessage)
        $this->mStatus->OpenCell('<script> alert("'.$this->mMaintenanceAlertMessage.'"); </script>');

      $this->mForm->AddObject($this->mStatus);
    }

    return parent::GetHtml();
  }
  
  /**
  * Sets the name of the entity 
  * @param string $table
  */
  function SetDBTable ($table, $class = null)
  {
    $this->mDBTable = $table;
    $this->mClass = $class;

    if (strpos($table, "."))
    {
      $this->mSchema = substr($table, 0, strpos($table, "."));
      $this->mTable = substr($table, strpos($table, ".") + 1);
    }
  }
  
  /**
  * Sets default connection
  * @param string $table
  */
  function SetConn ($conn)
  {
    $this->mConn = $conn;
  }
  
  /**
  * Sets usage of automatic transaction control
  * @param boolean $auto
  */
  function SetAutoTransactionControl($auto = false)
  {
    if (is_bool($auto))
      $this->mAutoTransactionControl = $auto;
  }

  /**
  * Sets the popup retrning function's name
  * @param string $function Popup returning function's name
  */
  function SetPopUpFunction($function)
  {
    if (strlen($function))
      $this->mPopUpFunction = $function;  
  }
 
  /**
  * Sets the popup retrning function's parameters
  * @param array $array  Associative array containig the parameters
  */
  function SetPopUpParameters($array)
  {
    $this->mPopUpParameters = $array;  
  }
  
  /**
  * Sets whether the keys must be used in the insert clause or not
  * @param array $array  Associative array containig the parameters
  */
  function SetInsertKeys ($insert_keys = false)
  {
    $this->mInsertKeys = $insert_keys; 
  }

  /**
  * Sets whether the keys array must have its keys and values be cleaned after a deletion
  * @param array $array  Associative array containig the parameters
  */
  function SetCleanDeletedKeys ($clean = true)
  {
    $this->mCleanDeletedKeys = $clean;
  }

  /**
  * Sets the submit button's label
  * @param string $label
  */
  function SetSubmitLabel($label = "Confirmar")
  {
    $this->mSubmitLabel = $label;
  }

  /**
  * Sets the insert radio button's label
  * @param string $label
  */
  function SetInsertLabel($label = "Inserir")
  {
    $this->mInsertLabel = $label;
  }

  /**
  * Sets the delete radio button's label
  * @param string $label
  */
  function SetDeleteLabel($label = "Excluir")
  {
    $this->mDeleteLabel = $label;
  }

  /**
  * Sets the update radio button's label
  * @param string $label
  */
  function SetUpdateLabel($label = "Alterar")
  {
    $this->mUpdateLabel = $label;
  }

  /**
  * Append or Remove an Action option
  * @param  string $action The action in (insert,delete,update)
  * @access private
  */
  function SetShowAction($action, $bool)
  {
    if ($bool)
      $this->AppendAction($action);
    elseif ($this->mAction)
      $this->mAction->RemoveOption($action); 
  }

  /**
  * Sets the exibition of insert actions
  * @param boolean $bool
  */
  function SetShowInsert($bool = true)
  {
    $this->mShowInsert = $bool;
    $this->SetShowAction("insert", $bool);
  }

  /**
  * Sets the exibition of delete actions
  * @param boolean $bool
  */
  function SetShowDelete($bool = true)
  {
    $this->mShowDelete = $bool;
    $this->SetShowAction("delete", $bool);
  }


  /**
  * Sets the exibition of update actions
  * @param boolean $bool
  */
  function SetShowUpdate($bool = true)
  {
    $this->mShowUpdate = $bool;
    $this->SetShowAction("update", $bool);
  }

  /**
  * Hide the exibition of all actions
  * @param boolean $bool
  */
  function HiddeActions($bool=true)
  {
    $this->SetShowDelete(!$bool);
    $this->SetShowInsert(!$bool);
    $this->SetShowUpdate(!$bool);
  }

  /**
  * Adds actions that must be shown with the insert action
  * @param mixed  $value Radio's value
  * @param string $label Radio's label
  */  
  function AddInsertActions($value, $label)
  {
    $this->mInsertActions[$value] = $label;
  }

  /**
  * Adds actions that must be shown with the update and delete action
  * @param mixed  $value Radio's value
  * @param string $label Radio's label
  */  
  function AddUpDelActions($value, $label)
  {
    $this->mUpDelActions[$value] = $label;
  }
 
  /**
  * Sets the usage of redirecting in the maintenance
  * @param boolean $bool
  */
  function SetUseLocation($bool = true)
  {
    if (is_bool($bool))
      $this->mUseLocation = $bool;
  }

  /**
  * Sets the redirecting location for the given action
  * @param string $action     Action's name. { insert | delete | update }
  * @param string $location   URL's location
  * @param array  $parameters Array containing the URL parameters
  */
  function SetLocation($action, $location, $parameters = false)
  {
    if (!strpos($location, "?"))
      $location .= "?";
      
    $this->mLocation[$action]  = $location;
    $this->mUrlFields[$action] = $parameters;
  }
 
  /**
  * Sets default messages
  */
  function SetDefaultMessages() 
  {
    parent::SetDefaultMessages();
    $this->mMessages["cancel_delete"]      = "<font color='red'><b>Exclusão Cancelada!</b></font>";
    $this->mMessages["cancel_update"]      = "<font color='red'><b>Alteração Cancelada!</b></font>";
    $this->mMessages["cancel_insert"]      = "<font color='red'><b>Inserção Cancelada!</b></font>";
    $this->mMessages["invalid_fulfilling"] = "<font color='red'><b>Preenchimento Inválido para o campo </b></font>";
    $this->mMessages["insert_message"]     = "<font color='green'><b>Registro Inserido!</b></font>";
    $this->mMessages["update_message"]     = "<font color='green'><b>Registro Alterado!</b></font>";
    $this->mMessages["delete_message"]     = "<font color='green'><b>Registro Excluído!</b></font>";
  }
  
  /**
  * Inserts values in the messages associative array
  * @param string  $messageName The array's key
  * @param integer $messageText The array's value
  */
  function SetMessage($messageName, $messageText)
  {
    $this->mMessages[$messageName] = $messageText;
  }
                    
  /**
  * Sets the maintenance message
  * @param string $message
  */
  function SetMaintenanceMessage($message)
  {
    if (strlen($this->mMaintenanceMessage) > 0) $this->mMaintenanceMessage .= "<br />";
    $this->mMaintenanceMessage .= $message;
  }

  /**
  * Sets a maintenance alert message
  * @param string $message
  */
  function SetMaintenanceAlert($message)
  {
    $this->mMaintenanceAlertMessage = $message;
  }

                     
  /**
  * Sets the name of the grid associated to this maintenance
  * @param string $gridName
  */
  function SetGridName($gridName)
  {
    $this->mGridName = $gridName;
  }

  /**
  * Sets the defaulr redirecting URLs for the maintenance
  */
  function SetDefaultLocation()
  {
    $this->mScript = ($script) ? $script : JDBAuth::GetFunctionName($script);

    $this->SetLocation("insert", "man_".$this->mScript.".php");
    $this->SetLocation("update", "sel_".$this->mScript.".php");
    $this->SetLocation("delete", "sel_".$this->mScript.".php");
  }

  /**
  * Adds JS functions in the onSubmit event
  * @param string $function Function's name
  */
  function AddFunction($function)
  {
    $this->mForm->AddFunction($function);
  }

  /**
  * Adda parameters for the functions associated to the onSubmit event
  * @param string $function  Function's name
  * @param array  $parameter Function's parameters
  */
  function AddParameter($function, $parameter)
  {
    $this->mForm->AddParameter($function, $parameter);
  }
  
  /**
  * Adds JDualList objects to the maintenance
  * @param object  $obj            JDualList object
  * @param string  $label          Label for the DualList field
  * @param string  $table          Name of the table involved in the JDualList
  * @param array   $properties     Associative array containing the following keys:<br>
  * value: name of the field that holds the items code<br> 
  * description: name of the field that holds the items name<br>
  * table: name of the table that holds the fields referred above
  * @param array   $extra_fields   Fields usen in the where clause to filter 
  * the selected list
  * @param boolean $open           Controls if these field must open a new line
  * @param array   $cell_options   Associative array containing the cell options.
  * Eg.: array("colspan" => 2)
  * @param array   $header_options Associative array containing the header options.
  * Eg.: array("colspan" => 2)
  * @param string  $separator      If no line is open and no label is given, this
  * parameters separates two fields
  */
  function AddDualList (&$obj, $label, $table, $properties, $extra_fields = false, 
                        $open = true, $cell_options = false, $header_options = false, 
                        $separator = "<br>")
  {
    if ($obj->mType == "DualList")
    {
      $this->mUseDualList                            = true;
      $this->mDualLists[$obj->mName]["object"]       = $obj;
      $this->mDualLists[$obj->mName]["master"]       = $properties["master"];
      $this->mDualLists[$obj->mName]["detail"]       = $properties["detail"];
      $this->mDualLists[$obj->mName]["connection"]   = $properties["connection"];
      $this->mDualLists[$obj->mName]["table"]        = $table;
      $this->mDualLists[$obj->mName]["properties"]   = $properties;
      $this->mDualLists[$obj->mName]["extra_fields"] = $extra_fields;

      $this->AddField($obj, $label, $open, $cell_options, $header_options, $separator);
    }
  }
  
  /**
  * Adds a field that will be used in the SQL statements to the maintenance 
  * @param string  $dbname          Name of the field in the database
  * @param object  &$obj            Reference to the field (JForm<somethig>) object
  * @param boolen  $label           Field's label.
  * @param boolean $key             True if the field is part of the primary key, false otherwise
  * @param boolean $open            True if the field must open a new line, false otherwise
  * @param array   $cell_options    Associative array containing the field cell options.
  * Eg.: array("colspan" => 2)
  * @param array   $header_options  Associative array containing the header cell options.
  * Eg.: array("colspan" => 2)
  * @param string  $separator       If no line is open and no label is given, this
	* parameters separates two fields
	* @param array   $row_options     Associative array containing the row options.
  */
  function AddDBField ($dbname, &$obj, $label = false, $key = false, $open = true, 
                       $cell_options = false, $header_options = false, $separator = "<br>", $row_options = false)
  {
    if ($key)
      $this->mKeys[$dbname] = $obj;
    else
      $this->mFields[$dbname] = $obj;

    $this->AddField($obj, $label, $open, $cell_options, $header_options, $separator, $row_options);
  }
  
  /**
  * Adds in the maintenance a field that will not be used in SQL statement
  * @param object  &$obj            Reference to the field (JForm<somethig>) object
  * @param boolen  $label           Field's label.
  * @param boolean $open            True if the field must open a new line, false otherwise
  * @param array   $cell_options    Associative array containing the field cell options.
  * Eg.: array("colspan" => 2)
  * @param array   $header_options  Associative array containing the header cell options.
  * Eg.: array("colspan" => 2)
  * @param string  $separator       If no line is open and no label is given, this
	* parameters separates two fields
	* @param array   $row_options     Associative array containing the row options.
  */
  function AddField (&$obj, $label = false, $open = true, $cell_options = false, 
                     $header_options = false, $separator = "<br>", $row_options = false)
  {
    if ($obj->mType != "Hidden")
    {
      $obj->SetLabel($label);

      if (!$this->mForm->mTableOpened)
        $this->mForm->OpenTable();

      if ($open)
      {
        $this->mForm->OpenRow($row_options);

        if ($label)
        {
          if ($obj->mTestIfEmpty)
          {
            $label = str_replace(array("<b>", "</b>", "<B>", "</B>"), "", $label);
            
            if ($obj->mTestIfEmptyMessage == "Por favor, preencha o campo!")
              $obj->mTestIfEmptyMessage = "Preencha o campo $label!";
            
            $label = "<b>$label</b>";
          }
          
          $this->mForm->OpenHeader($label, $header_options);
        }
      
        $this->mForm->OpenCell("", $cell_options);
        $this->mForm->AddObject($obj);
      }
      else
      {
        if ($label)
        {
          if ($obj->mTestIfEmpty)
          {
            $label = str_replace(array("<b>", "</b>", "<B>", "</B>"), "", $label);
            
            if ($obj->mTestIfEmptyMessage == "Por favor, preencha o campo!")
              $obj->mTestIfEmptyMessage = "Preencha o campo $label!";
            
            $label = "<b>$label</b>";
          }
          
          $this->mForm->OpenHeader($label, $header_options);
          $this->mForm->OpenCell("", $cell_options);
        }
        else
          $this->mForm->AddHtml($separator);
       
        $this->mForm->AddObject($obj);
      }
    }
    else
      $this->mForm->AddObject($obj);
  }

  /**
  * Adds a header in the maintenance's table
  * @param string $header Header's label
  * @param array   $options  Associative array containing the header cell options
  * Eg.: array("colspan" => 2)
  */
  function AddHeader($header, $options = false)
  {
    $this->mForm->OpenRow();
    $this->mForm->OpenHeader("", $options);
    $this->mForm->AddHtml($header);
  }

  /**
  * Sets if the keys must be loaded
  * @param boolean $loadKeys
  */
  function SetLoadKeys($loadKeys = false)
  {
    if (is_bool($loadKeys))
      $this->mLoadKeys = $loadKeys;
  }

  /**
  * Sets if the keys must be updated
  * @param boolean $updateKeys
  */
  function SetUpdateKeys($updateKeys = false)
  {
    if (is_bool($updateKeys))
      $this->mUpdateKeys = $updateKeys;      
  }

  /**
  * Sets if the maintenance action might be cancelled or not
  * @param boolean $updateKeys
  */
  function SetCancelAction($bool = false)
  {
    if (is_bool($bool))
      $this->mCancelAction = $bool;
  }

  /**
  * Sets if the maintenance action might be cancelled or not
  * @param boolean $updateKeys
  */
  function SetMaintainData($bool = false)
  {
    if (is_bool($bool))
      $this->mMaintainData = $bool;
  }

  /**
  * Return false if an event already happened or got blocked by a programmer intervention and true otherwise
  * @private
  * @param string buildEvent 
  * @returns bool 
  */
  function RaiseBuildOrder($buildEvent)
  {
    if ($this->mMaintenanceBuildOrder[$buildEvent] === true || $this->mMaintenanceBuildOrder[$buildEvent] === null)
      return false;
    else
      $this->mMaintenanceBuildOrder[$buildEvent] = true;

    return true;
  }

  /**
  * Ignores an Default event, for example you may want to choose not to use LoadDbValues for some implementation reason
    so you can just block it
  * @param string buildEvent 
  */
  function IgnoreBuildOrderEvent($buildEvent) 
  {
    $this->mMaintenanceBuildOrder[$buildEvent] = null;
  }

  /**
  * Find an occurrence of value in a mOptions array
    (which is composed by numeric indexes and array items with value and description)
  * @param string $value Action's value
  */
  function findInmOptions(&$array, &$value)
  {
    if (!is_array($array))
      return false;

    foreach($array as $index => $arrValue)
    {
      if(strcasecmp($arrValue["value"], $value) == 0)
        return $index;
    }

    return false;
  }

  /**
  * Append an action to the actions handler If the user has permission
    AND was enabled by SetShowInsert ,SetShowUpdate or SetShowDelete methods
  * @param string $action Action's description
  */
  function AppendAction($action)
  {
    //If the action was already appended just leave the operation
    if ($this->findInmOptions($this->mAction->mOptions, $action) !== false)
      return;

    $actionTmp   = ucfirst($action);
    $actionLabel = "m".$actionTmp."Label";
    $viewAction  = "mShow".$actionTmp;

    if ($this->$viewAction && $this->HasPermissionTo($action))
    {
      //update must always come in front of delete
      //
      if ($action == "delete") 
        $this->AppendAction("update");

      $this->mAction->AddOption($action, $this->$actionLabel);

      if (!$this->mAction->mValue) 
        $this->mAction->SetValue($action);
    } 
  }

  /**
  * Catches the values of fields DB in the database 
  * and places in the respective fields 
  */
  function LoadDbValues()
  {
    if (!$this->RaiseBuildOrder("LoadDbValues"))
      return;

    if (!$this->HasPermissionTo("select"))
      return;

    //Necessary to return new values in PopUps
    $this->GetKeysArray();
    $this->GetFieldsArray();
    unset($_SESSION["s_table_name"]);
    $_SESSION["s_table_name"] = $this->mDBTable;

    //Select
    $this->BuildSelectClause();
      
    //Where
    $this->BuildWhereClause();

    $this->RaiseSignal("before_load_db_values");

    if (strpos($this->mWhere, "NULL"))
    {

      $this->AppendAction("insert");
      //Others Insert Actions
      if (is_array($this->mInsertActions))
      {
        do
        {
          $this->mAction->AddOption(key($this->mInsertActions), 
                                    current($this->mInsertActions));
        }
        while(next($this->mInsertActions));
      }
    }
    else
    {
      $qry = "SELECT ".$this->mSelect." FROM ".$this->mDBTable." ".$this->mWhere;
     
      if ($rs = $this->mConn->Select($qry))
      {
        //Occurs if provided key does not exists
        if ($rs->GetRowCount() == 0)
        {
          $this->AppendAction("insert");
            
          //Others Insert Actions
          if (is_array($this->mInsertActions))
          {
            do
            {
              $this->mAction->AddOption(key($this->mInsertActions), 
                                        current($this->mInsertActions));
            }
            while(next($this->mInsertActions));
          }
        }
        else
        {
          $this->AppendAction("update");
          $this->AppendAction("delete"); 
            
          //Others Delete e Update Actions
          if (is_array($this->mUpDelActions))
          {
            do
            {
              $this->mAction->AddOption(key($this->mUpDelActions), 
                                        current($this->mUpDelActions));
            }
            while(next($this->mUpDelActions));
          }
    
          //Load DB Fields
          while (!$rs->IsEof())
          {
            $j = 0;
              
            for ($i = 1; $i < $rs->GetFieldCount(); $i++)
            {
              $field_name  = $rs->GetFieldName($i);
              $field_value = $rs->GetField($i); 
                
              if ($this->mLoadKeys && ($j < sizeof($this->mKeys)))
                $this->mKeys[$field_name]->SetValue($field_value);
              else              
                $this->mFields[$field_name]->SetValue($field_value);

              $j++;
            }
              
            $rs->Next();
          }

          $rs->Close();          

          if (!$this->mUseDualList)
            $this->RaiseSignal("after_load_db_values");
        }
          
        //DualList
        if ($this->mUseDualList)
        {
          if ($rs->GetRowCount() > 0)
            $this->BuildDualList("load_db_values");
          else
            $this->RaiseSignal("after_load_db_values");
        }
      }//$rs = $this->mConn->Select($qry) 
      else
      {
        $this->RaiseSignal("on_load_db_values_error"); 
        $this->SetMaintenanceMessage($this->mConn->GetError(true));
      }
    }//else - if (strpos($this->mWhere, "NULL"))

    if (strlen(trim($GLOBALS["message"])) > 0)
      $this->mMaintenanceMessage = "&nbsp;" . stripslashes($GLOBALS["message"]);
  }

  /**
  * Checks if the form was submitted
  * @returns boolean
  */
  function IsSubmitted()
  {
    return $this->mForm->IsSubmitted();
  }

  /**
  * Controls if the submission of the form is valid 
  * and the action of the form 
  */
  function PostAction()
  {
    global $f_close_window, $ManBD;

    if (!$this->RaiseBuildOrder("PostAction"))
      return;

    if ($this->IsSubmitted())
    {
      if ($this->mForm->IsValid())
      {
        if ($this->mClass != "")
        {
          $ManBD->throwExceptions = true;
          
          try
          {
            $this->mConn->BeginTransaction();
            
            switch($this->mAction->GetValue())
            {
              case "insert": $this->InsertManBD($ManBD); break;
              case "update": $this->UpdateManBD($ManBD); break;
              case "delete": $this->DeleteManBD($ManBD); break;
            }
            
            $this->mConn->Commit();
          }
          catch (Aviso $e)
          {
            $this->SetMaintenanceMessage("<img src=\"".JAGUAR_URL."img/warn.png\"><font style='color:CD950C; font-size:15px'><b> ".stripslashes($e->getMessage())."</b></font>");
            $this->RaiseSignal("on_".$this->mAction->GetValue());
            $this->mConn->Commit();
          }
          catch (Exception $e)
          {
            $this->SetCancelAction(true);
            $this->SetUseLocation(false);
            $this->RaiseSignal("on_".$this->mAction->GetValue()."_error");
            $this->SetMaintenanceMessage($this->mMessages["cancel_".$this->mAction->GetValue()] . "<br><font color='red'><b>".stripslashes($e->getMessage())."</b></font>");
            $this->mConn->RollBack();
          }
        }
        else
        {
          switch($this->mAction->GetValue())
          {
            case "insert": $this->Insert(); break;
            case "update": $this->Update(); break;
            case "delete": $this->Delete(); break;
          }
        }
      
        if ((!isset($f_close_window)) && ($GLOBALS["f_popup"] || $_REQUEST["f_popup"]))
          $f_close_window = true;

        //Location 
        if ($this->mUseLocation && !$this->mConn->mDriver->GetError())
        {
          $action = $this->mAction->GetValue();
          
          if ((strlen($this->mLocation[$action])) && !$f_close_window)
          {
            if (!strlen($this->mGridName))
              $this->SetGridName($this->mAuth->mScript);
        
            $str = "Location: ".$this->mLocation[$action];
            
            if (is_array($this->mUrlFields[$action]))
            {
              $operator = "&";

              reset($this->mUrlFields[$action]);
              for($i = 0; $i < sizeof($this->mUrlFields[$action]); $i++)
              {
                $value = "";

                $key = key($this->mUrlFields[$action]);
                foreach ($this->mKeys as $mKeys)
                {
                  if ($mKeys->mName == $key)
                  {
                    $value = $mKeys->mValue;
                    break;
                  }
                }

                $str .= $operator.$key."=";

                if (!strlen($value))
                {
                  $value = current($this->mUrlFields[$action]);
                }
                
                if (!strlen($value))
                {
                  if (strlen($_REQUEST[$key]))
                    $str .= $_REQUEST[$key];
                  else
                    $str .= $GLOBALS[$key];
                }
                else
                  $str .= $value;

                if (strpos($str, "?"))
                  $operator = "&";
                  
                next($this->mUrlFields[$action]);
              }
            }
            
            $str .= "&message=".$this->mMaintenanceMessage."&grid=grid_".$this->mGridName;

            $driver = strtolower( get_class($this->mConn->mDriver) );
            $driver = ucfirst(substr($driver, strpos($driver, "nn") + 2, strlen($driver)));
            
            reset($this->mObjects);
            do
            {
              $obj = current($this->mObjects);
              $saida = $obj->GetHtml();
              if ( strtolower( get_class($obj) ) == "jtable")
              {
                if (strpos($saida, $driver) !== false)
                {
                  echo $saida . "\n";
                }
              }
            }while(next($this->mObjects));

            header(preg_replace('(\n|\r)', '', $str));
            
          }
        }//if ($this->mUseLocation)
      }//if ($this->mForm->IsValid())
      else
      {
        $msg = $alert = "";
        foreach ($this->mFields AS $key => $value)
        {
          if (!$value->IsValid())
          {
            if (strlen($msg) > 0) $msg .= "<br />";
            $msg .= $this->mMessages["invalid_fulfilling"] . "<font color='red'><b>" . $value->GetLabel() . "</b></font>";
            
            $alert .= $value->GetLabel() . ": " . (strlen($value->mError)?$value->mError:"");
            if (strlen($alert) > 0) $alert .= "\\n";
            $alert .= (strlen($value->GetInvalidMessage())?$value->GetInvalidMessage()."\\n":"");
          }
        }
        
        $this->SetmaintenanceMessage($msg);
        $this->SetMaintenanceAlert($alert);
        //$this->SetMaintenanceAlert($this->mForm->GetInvalidMessages());
      }
    }
  }
  
  /**
  * Internal function - Returns the keys array
  * @returns array
  */
  function GetKeysArray()
  {
    if (is_array($this->mKeys)) 
    {
      // It's necessary to register the fields array to obtain
      // the most recently inserted record in a table
      unset($_SESSION["s_keys_array"]);

      reset($this->mKeys);
      for ($i = 0; $i < sizeof($this->mKeys); $i++)
      {
        $current                = &current($this->mKeys);
        $arr[key($this->mKeys)] = $current->GetValue(true);

        $_SESSION["s_keys_array"][] = key($this->mKeys);
        next ($this->mKeys);
      }
    }
    else
      $arr = array();
   
    return $arr;
  }

  /**
  * Internal function - Returns the keys array for external incremental fields
  * @returns array
  */
  function GetIncrementalKeysArray()
  {
    $table = ($this->mTable) ? $this->mTable : $this->mDBTable;
    if (is_array($this->mKeys))
    {
      reset($this->mKeys);
      for ($i = 0; $i<sizeof($this->mKeys); $i++)
      {
        $current = &current($this->mKeys);
        $this->mIncrementalKeys[key($this->mKeys)] = $this->mConn->mDriver->GetIncrementalKey(key($this->mKeys), $table, $this->mSchema);
        next ($this->mKeys);
      }
    }
    else
      $this->mIncrementalKeys = array();
   
    return $this->mIncrementalKeys;
  }

  /**
  * Internal function - Returns the fields array
  * @returns array
  */
  function GetFieldsArray()
  {
    if (is_array($this->mFields))
    {
      // It's necessary to register the fields array to obtain
      // the most recently inserted record in a table
      unset($_SESSION["s_fields_array"]);
      reset($this->mFields);
      for ($i = 0; $i < sizeof($this->mFields); $i++)
      {
        $current                  = &current($this->mFields);
        $arr[key($this->mFields)] = $current->GetValue(true);
        $_SESSION["s_fields_array"][] = key($this->mFields);

        next ($this->mFields);
      }
    }
    else
      $arr = array();

    return $arr;
  }

  /**
  * Builds the DualList maintenance
  * @param string $action { insert | update | delete }
  */
  function BuildDualList($action)
  {
    //percorre os duallists da manutenção
    reset($this->mDualLists);
    do
    {
      $error = false;      

      $obj          = $this->mDualLists[key($this->mDualLists)]["object"];
      $table        = $this->mDualLists[key($this->mDualLists)]["table"];
      $master       = $this->mDualLists[key($this->mDualLists)]["master"];
      $detail       = $this->mDualLists[key($this->mDualLists)]["detail"];
      $connection   = $this->mDualLists[key($this->mDualLists)]["connection"];
      $extra_fields = $this->mDualLists[key($this->mDualLists)]["properties"]["extra_fields"];
      $selecteds    = $obj->GetValue();
      $this->mConn->BeginTransaction();
      switch ($action)
      {
        case "load_db_values":
          //Necessary to use where clause in other actions
          unset($f_where);
          for ($i = 0; $i < sizeof($master["keys"]); $i++)
            $f_where .= (($i)?"AND ":"WHERE ") . 
                        $master["keys"][$i] . " = '" . $GLOBALS["f_" . $master["keys"][$i]] . "' ";

          $where = new JFormHidden("f_where", $f_where);
          $this->AddField($where, false);

          //Load detail values
          if (strlen($detail["query"]))
            $sql = $detail["query"];
          else
          {
            $sql = "SELECT " . $detail["key"] . " AS value, ";

            for ($i = 0; $i < sizeof($detail["fields"]); $i++)
              $sql .= (($i)?" || ' - ' || ":"") . $detail["fields"][$i];

            $sql .= " AS description " . 
                   "FROM ". $detail["table"] . " " . 
                   "WHERE " . $detail["key"] . " NOT IN ( " . 
                     "SELECT " . $connection["detail_key"] . " " . 
                     "FROM " . $connection["table"] . " ";

            $sql .=  "$f_where ) ";
          }//else - if (strlen($detail["query"]))

          if ($rs = $this->mConn->Select($sql))
            $obj->SetOptions($rs->GetArray(true), "origin");
          else
            $this->AddObject($this->mConn->GetError());

          //Load conenction values
          if (strlen($connection["query"]))
            $sql = $connection["query"];
          else
          {
            $sql = "SELECT dt." . $detail["key"] . " AS value, " ;

            for ($i = 0; $i < sizeof($detail["fields"]); $i++)
              $sql .= (($i)?" || ' - ' || ":"") . "dt." .  $detail["fields"][$i];

            $sql .= " AS description " . 
                   "FROM ". $detail["table"] . " dt ". 
                            "JOIN " . $connection["table"] . " ct " .
                              "ON dt." .  $detail["key"] . " = ct." .  $connection["detail_key"] . " " ;
                              
            for ($i = 0; $i < sizeof($master["keys"]); $i++)
              $sql .= (($i)?"AND ":"WHERE ") . "ct. " . 
                      $master["keys"][$i] . " = '" . $GLOBALS["f_" . $master["keys"][$i]] . "' ";
          }//else - if (strlen($connection["query"]))                     

          if ($rs = $this->mConn->Select($sql))
            $obj->SetOptions( $rs->GetArray(true), "destination");
          else
            $this->AddObject($this->mConn->GetError());


/*        
          $sql = "SELECT ".$properties["value"]." FROM ".$table;

          if (sizeof($extra_fields))
          {
            $operador = "";
            $sql .= " WHERE ";

            for ($i = 0; $i < sizeof($extra_fields); $i++)
            {
              $sql .= $operador . $extra_fields[$i] . " = '" . $GLOBALS["f_".$extra_fields[$i]]."'";
              
              if (strpos($sql, "WHERE"))
                $operador = " AND ";
            }
          }
echo "$sql<hr>";
          if (!$rs = $this->mConn->Select($sql))
          {
            $error = true;
            break;
          }
          else
          {
            unset($options);
            while (!$rs->IsEof())
            {
              $sql = "SELECT ".$properties["value"]." AS value, ".
                               $properties["description"]." AS description ".
                      "FROM ".$properties["table"]." ".
                     "WHERE ".$properties["value"]." = ".$rs->GetField($properties["value"]);

echo "$sql<hr>";
              if ($rs_tmp = $this->mConn->Select($sql))
                $options[] = array("value"       => $rs_tmp->GetField(0),
                                   "description" => $rs_tmp->GetField(1));
              else
              {
                $error = true;
                break;
              }
              
              $rs->Next();
            }//while (!$rs->IsEof())

            $obj->SetOptions($options, "destination");
          }//else - if (!$rs = $this->mConn->Select($sql))
*/          
        break;
        case "insert";
        case "update";

          $new_details = $_POST[$obj->mName . "_destination"];

          while (strpos($_POST["f_where"], chr(92)) )
          {
            $_POST["f_where"] = stripslashes($_POST["f_where"]);
          }
          
          $sql = "SELECT " . $connection["detail_key"] . " " . 
                        "FROM " . $connection["table"] . " " . $_POST["f_where"] ;

          if ($rs = $this->mConn->Select($sql))
            while(!$rs->IsEof())
            {
              $actual_details[] = $rs->GetField(0);
              $rs->Next();
            }
          else
            $this->AddObject($this->mConn->GetError());

          //Builds where and values array
          unset($where, $values);
          for ($i = 0; $i < sizeof($master["keys"]); $i++)
            $values[$master["keys"][$i]] = $where[$master["keys"][$i]]  = $GLOBALS[ "f_" . $master["keys"][$i] ];
          
          //Insert new records
          for ($i = 0; $i < sizeof($new_details); $i++)
          {
            if (!in_array($new_details[$i], $actual_details) )
            {
              $values[$detail["key"]] = $new_details[$i];
              
              if (!$this->mConn->Insert($connection["table"], $values) )
              {
                $this->mConn->Rollback();
                break;
              }
            }
          }

          //Delete unused records
          for ($i = 0; $i < sizeof($actual_details); $i++)
            if (!in_array($actual_details[$i], $new_details) )
            {
              $where[$detail["key"]] = $actual_details[$i];
              
              if (!$this->mConn->Delete($connection["table"], $where) )
              {
                $this->mConn->Rollback();
                break;
              }
            }
        break;

/*  
        case "insert":
        case "update":
          for ($i = 0; $i < sizeof($extra_fields); $i++)
            $arr_extra_fields[$extra_fields[$i]] = $GLOBALS["f_".$extra_fields[$i]];

          if (!$this->mConn->Delete($table, $arr_extra_fields))
          {
            $error = true;
            break;
          }
          else
          { 
            if ($obj->GetValue())
            {
              for ($i = 0; $i < sizeof($obj->GetValue()); $i++)
              {
                $arr = array($properties["value"] => $selecteds[$i]);
                $arr = array_merge($arr, $arr_extra_fields);

                if (!$this->mConn->Insert($table, $arr))
                {
                  $error = true;
                  break;
                }//if (!$this->mConn->Insert($table, $arr))
              }//for ($i = 0; $i < sizeof($obj->GetValue()); $i++)
            }//if ($obj->GetValue())
          }//if (!$this->mConn->Delete($table, $arr_extra_fields))
        break;

        case "delete":
          for ($i = 0; $i < sizeof($extra_fields); $i++)
            $arr_extra_fields[$extra_fields[$i]] = $GLOBALS["f_".$extra_fields[$i]];
          
          if (!$this->mConn->Delete($table, $arr_extra_fields))
          {
            $error = true;
            break; 
          }
        break;
*/      
      }//switch ($action)
      $this->mConn->Commit();
    }
    while(next($this->mDualLists));

    //controle de transação
    if ($error)
    {
      $this->SetMaintenanceMessage($this->mConn->GetTextualError());
      $this->mConn->RollBack();
      $this->RaiseSignal("on_".$action."_error");
    }
    else
    {
      $this->mConn->Commit();
      $this->RaiseSignal("after_".$action);
    }
  }

  /**
  * Build js code to close window
  */
  function CloseWindow()
  {
    if ($this->mPopUpFunction != "cancel")
    {
      $js_parameters = "";
      
      for ($i = 0; $i < sizeof($this->mPopUpParameters); $i++)
      {
        $obj = $this->GetObjectByName($this->mPopUpParameters[$i]);

        $js_parameters .= "'".($obj !== false ? $obj->GetValue() : $GLOBALS[$this->mPopUpParameters[$i]])."'";

        if (($i + 1) < sizeof($this->mPopUpParameters))
          $js_parameters .= ", ";
      }
      
      $js = "
        if (typeof parent.".$this->mPopUpFunction." == 'function')
          parent.".$this->mPopUpFunction."($js_parameters);
        else if (typeof top.opener.".$this->mPopUpFunction." == 'function')
          top.opener.".$this->mPopUpFunction."($js_parameters);
      ";

      $js .= "
        if (typeof parent.close_pop == 'function')
          parent.close_pop(); 
        else 
          self.close();
      ";
      
      if (!$this->mUseDualList)
        $this->AddJs($js);
    }
  }
  
  /**
  * Updates the current record
  */
  function UpdateManBD(ManBD $ManBD)
  {   
    if (!$this->HasPermissionTo("update"))
      return true;
    
    $this->RaiseSignal("before_update");

    if ($this->mCancelAction)
    {
      $this->RaiseSignal("on_cancel_update");
      throw new Exception($this->mMessages["cancel_update"]);
    }

    $objPrincipal = new $this->mClass($ManBD->objConn);

    $arrKeys = $this->GetKeysArray();

    if (!sizeof($arrKeys)) 
    {
      if (!sizeof($objPrincipal->key))
        throw new Exception("Campos chaves não encontrados na manutenção.");
      
      foreach ($objPrincipal->key as $chave)
        if ($objPrincipal->$chave == null)
          throw new Exception("Campos chaves não encontrados na manutenção.");
    } 
    else
    {
      foreach ($arrKeys AS $key => $value)
        $objPrincipal->$key = ifnullsql($value, "NULL");
    }

    $ManBD->PopulaObjetoGenerico($objPrincipal, false, false, false);

    $arr = $this->GetFieldsArray();

    foreach ($arr AS $key => $value)
      $objPrincipal->$key = ifnullsql($value, "NULL");

    $ManBD->salvar($objPrincipal);
    $this->SetMaintenanceMessage($this->mMessages["update_message"]);
    $this->RaiseSignal("after_update");

    if ($this->mUseDualList)
      $this->BuildDualList("update");
  }
  
  /**
  * Updates the current record
  */
  function Update()
  {   
    if (!$this->HasPermissionTo("update"))
      return true;
    
    if ($this->mAutoTransactionControl || $this->mUseDualList)
      $this->mConn->BeginTransaction();

    $this->RaiseSignal("before_update");

    if (!$this->mCancelAction)
    {
      $arr = $this->GetFieldsArray();
      
      if ($this->mUpdateKeys)
        $arr = array_merge($this->GetKeysArray(), $arr);
      
      if ($this->mMaintainData)
      {
        //Update
        if ($this->mConn->Update($this->mDBTable, $arr, $this->GetKeysArray()))
        {
          $this->SetMaintenanceMessage($this->mMessages["update_message"]);
         
          if ($this->mAutoTransactionControl && !$this->mUseDualList)
            $this->mConn->Commit();

          if (!$this->mUseDualList)
            $this->RaiseSignal("after_update");
        }
        else
        {
          $this->SetMaintenanceMessage($this->mConn->GetTextualError());
          $this->mUseDualList = false;
          $this->RaiseSignal("on_update_error");
          
          if ($this->mAutoTransactionControl || $this->mUseDualList)
            $this->mConn->RollBack();
        }//else - if ($this->mConn->Update($this->mDBTable,
      }//if ($this->mMaintainData)
      else
        $this->RaiseSignal("after_update");
      
      if ($this->mUseDualList)
        $this->BuildDualList("update");
          
    }//if (!$this->mCancelAction)
    else
    {
      $this->RaiseSignal("on_cancel_update");
      $this->SetMaintenanceMessage($this->mMessages["cancel_update"]);
    }
  }

  /**
  * Validates wheter the user have permission to execute an action
  * @param $action the action which the permission will be tested (insert, update, delete)
  * @returns boolean 
  */
  function HasPermissionTo($action, $connOrAuth = false)
  {
    $result = parent::HasPermissionTo($action, $this->mAuth);
    if (!$result) $this->SetMaintenanceMessage($this->mAuthenticationError);

    return $result;
  }
  
  /**
  * Excludes record from the database 
  */
  function DeleteManBD(ManBD $ManBD)
  {
    if (!$this->HasPermissionTo("delete"))
      return true;

    $this->RaiseSignal("before_delete");

    if ($this->mCancelAction)
    {
      $this->RaiseSignal("on_cancel_delete");
      throw new Exception($this->mMessages["cancel_delete"]);
    }

    if ($this->mUseDualList)
      $this->BuildDualList("delete");

    $objPrincipal = new $this->mClass($ManBD->objConn);
    $arr = $this->GetKeysArray();
    
    if (!sizeof($arr)) 
      throw new Exception("Erro: Não foram declarados campos de chave na manutenção.");

    $arr = array_merge($arr, $this->GetFieldsArray());
    
    foreach ($arr AS $key => $value)
      $objPrincipal->$key = $value;

    $ManBD->excluir($objPrincipal);

    //Clean Keys
    if ($this->mCleanDeletedKeys)
    {
      reset($this->mKeys);
      for ($i = 0; $i < sizeof($this->mKeys); $i++)
      {
        $current = &current($this->mKeys);
        $current->SetValue("");
        $current->mEmpty = true;
        next($this->mKeys);
      }
    }

    $this->SetMaintenanceMessage($this->mMessages["delete_message"]);
    $this->RaiseSignal("after_delete");
  }

  /**
  * Excludes record from the database 
  */
  function Delete()
  {
    if (!$this->HasPermissionTo("delete"))
      return true;

    $ok = true;

    if ($this->mAutoTransactionControl || $this->mUseDualList)
      $this->mConn->BeginTransaction();

    $this->RaiseSignal("before_delete");

    if (!$this->mCancelAction)
    {
      if ($this->mUseDualList)
        $this->BuildDualList("delete");

      if ($this->mMaintainData)
      {
        //Delete
        if ($this->mConn->Delete($this->mDBTable, $this->GetKeysArray()))
        {
          //Clean Keys
          if ($this->mCleanDeletedKeys)
          {
            reset($this->mKeys);
            for ($i = 0; $i < sizeof($this->mKeys); $i++)
            {
              $current = &current($this->mKeys);
              $current->SetValue("");
              $current->mEmpty = true;
              next($this->mKeys);
            }
          }
             
          $this->SetMaintenanceMessage($this->mMessages["delete_message"]);

          if ($this->mAutoTransactionControl || $this->mUseDualList)
            $this->mConn->Commit();

          $this->RaiseSignal("after_delete");
        }
        else
        {
          $this->RaiseSignal("on_delete_error");

          if ($this->mAutoTransactionControl || $this->mUseDualList)
            $this->mConn->RollBack();
         
          $this->SetMaintenanceMessage($this->mConn->GetTextualError());
        }
      }//if ($this->mMaintainData)
      else
        $this->RaiseSignal("after_delete");
    }//if (!$this->mCancelAction)
    else
    {
      $this->RaiseSignal("on_cancel_delete");
      $this->SetMaintenanceMessage($this->mMessages["cancel_delete"]);
    }
  }
  
  /**
  * Inserts a record in the database 
  */
  function InsertManBD(ManBD $ManBD)
  {
    if (!$this->HasPermissionTo("insert"))
      return true;

    $this->RaiseSignal("before_insert");

    if ($this->mCancelAction)
    {
      $this->RaiseSignal("on_cancel_insert");
      throw new Exception($this->mMessages["cancel_insert"]);
    }

    $objPrincipal = new $this->mClass($ManBD->objConn);

    //Merge Keys e Fields Arrays if necessary
    if ($this->mInsertKeys)
    {
      $objTest = clone $objPrincipal;
      $msg = "";
      
      foreach ($this->GetKeysArray() AS $key => $value)
      {
        $objTest->$key = $value;
        $msg .= substr($key, strpos($key, "_") + 1) . ", ";
      }
      
      $arrObjTest = $ManBD->PopulaObjetoGenerico($objTest);
      
      //Valida se o objeto que está sendo inserido já existe
      if (sizeof($arrObjTest) > 0)
        throw new Exception ("Erro: ".get_class ($objPrincipal)." já inserido com os dados: ".substr($msg, 0, strlen($msg)-2).".");

      $arr = array_merge($this->GetFieldsArray(), $this->GetKeysArray());
    }
    elseif ($this->mConn->mDriver->mUseExternalIncrement)
      $arr = array_merge($this->GetFieldsArray(), $this->GetIncrementalKeysArray());
    else
      $arr = $this->GetFieldsArray();

    foreach ($arr AS $key => $value)
      $objPrincipal->$key = $value;
    
    $ManBD->salvar($objPrincipal);

    reset($this->mKeys);
    for ($i = 0; $i < sizeof($this->mKeys); $i++)
    {
      $current = &current($this->mKeys);
      $current->SetValue($objPrincipal->{key($this->mKeys)});
      next($this->mKeys);
    }

    $this->SetMaintenanceMessage($this->mMessages["insert_message"]);
    $this->RaiseSignal("after_insert");    

    if ($GLOBALS["f_popup"])
      $this->CloseWindow();

    if ($this->mUseDualList)
    {
      $this->BuildDualList("insert");

      if ($GLOBALS["f_popup"])
        $this->CloseWindow();  
    }
  }

  /**
  * Inserts a record in the database 
  */
  function Insert()
  {
    if (!$this->HasPermissionTo("insert"))
      return true;

    if ($this->mAutoTransactionControl || $this->mUseDualList)
      $this->mConn->BeginTransaction();

    $this->RaiseSignal("before_insert");

    if (!$this->mCancelAction)
    {
      //Merge Keys e Fields Arrays if necessary
      if ($this->mInsertKeys)
        $arr = array_merge($this->GetFieldsArray(), $this->GetKeysArray());
      elseif ($this->mConn->mDriver->mUseExternalIncrement)
        $arr = array_merge($this->GetFieldsArray(), $this->GetIncrementalKeysArray());
      else
        $arr = $this->GetFieldsArray();

      if ($this->mMaintainData)
      {
        //Insert
        if ($this->mConn->Insert($this->mDBTable, $arr))
        {
          reset($arr);
          $sql = "SELECT ";
          for ($i = 0; $i < sizeof($arr); $i++)
          {
            $array = array("\\\"" => "&quot", "'" => "\\'");
            $value = strtr(current($arr), $array);

            $array = array("\\\\'" => "\\'");
            $value = strtr($value, $array);

            $value = "'" . trim($value) . "'";

            $value = (strpos($value, "\\")>0?"E".$value:$value);

            $sql .= $value . " AS " . key($arr);

            if ($i != sizeof($arr) - 1)
              $sql .= ", ";
            
            next($arr);
          }
        
          if ( ($rs = $this->mConn->GetInserted($sql)) )
          {
            $this->SetLastInserted($rs);
           
            //Load DB Fields
            reset($this->mKeys);
            for ($i = 0; $i < sizeof($this->mKeys); $i++)
            {
              $current = &current($this->mKeys);
              $current->SetValue($rs->GetField(key($this->mKeys)));
              next($this->mKeys);
            }

            $this->SetMaintenanceMessage($this->mMessages["insert_message"]);

            if ($this->mAutoTransactionControl && !$this->mUseDualList)
              $this->mConn->Commit();
            
            $rs->Close();

            if (!$this->mUseDualList)
              $this->RaiseSignal("after_insert");    

            if ($GLOBALS["f_popup"])
              $this->CloseWindow();

          }//if ($rs = $this->mConn->GetInserted())
          else
            $this->SetMaintenanceMessage($this->mConn->GetError(true));
        }//if ($this->mConn->Insert($this->mDBTable, $arr))
        else
        {
          $this->RaiseSignal("on_insert_error");
          $this->SetMaintenanceMessage(stripslashes($this->mConn->GetTextualError()));
          
          if ($this->mAutoTransactionControl || $this->mUseDualList)
            $this->mConn->RollBack();

          $this->mUseDualList = false;
        }
      }//if ($this->mMaintainData)
      else
        $this->RaiseSignal("after_insert");    

      if ($this->mUseDualList)
      {
        $this->BuildDualList("insert");
        
        if ($GLOBALS["f_popup"])
          $this->CloseWindow();  
      }
    }//if (!$this->mCancelAction)
    else
    {
      $this->RaiseSignal("on_cancel_insert");
      $this->SetMaintenanceMessage($this->mMessages["cancel_insert"]);
    }        
  }

  /**
  * Verifies if a record in the table already exists for the given keys
  * @returns boolean
  */
  function IsNewRecord()
  {
    $this->BuildWhereClause();
    if (strpos($this->mWhere, "NULL"))
      return true;
    else
    {
      $qry = "SELECT COUNT(*) FROM $this->mDBTable $this->mWhere";

      if ($rs = $this->mConn->Select($qry))
      {
        return !$rs->GetField(0);
        $rs->Close();
      }
      else
      {
        $this->AddObject($this->mConn->GetError());
        return false;
      }
    }
  }

  /**
  * Internal function - Builds the select clause used on LoadDbValues
  */
  function BuildSelectClause()
  {
    if (is_array($this->mFields) || ( (is_array($this->mKeys)) && $this->mLoadKeys ) )
    {
      $arr = $this->mFields;

      if ($this->mLoadKeys && is_array($this->mKeys))
      {
        if (is_array($arr))        
          $arr = array_merge($this->mKeys, $arr);
        else
          $arr = $this->mKeys;
      }

      if (is_array($arr))
        reset($arr);

      $delim = "1, ";
      for ($i = 0; $i<sizeof($arr); $i++)
      {
        $this->mSelect .= $delim." ".key($arr);
        $delim = ",";
        next ($arr);
      }
    }
    else
      $this->mSelect = " 1 ";
  }

  /**
  * Internal function - Builds the where clause used on LoadDbValues
  */
  function BuildWhereClause()
  {
    if (strlen($this->mWhere) == 0)
    {
      if (is_array($this->mKeys))
      {
        reset($this->mKeys);
        $delim = "WHERE ";
        for ($i = 0; $i < sizeof($this->mKeys); $i++)
        {
          $current = &current($this->mKeys);
          $this->mWhere .= $delim . " " . key($this->mKeys) .
                           ( ( ($current->GetValue()) || 
                               (($current->GetValue() == "0") && (!$current->GetValue()) ) )  ? 
                           " = " : " IS ") .
                           $this->mConn->QuoteValue($current->GetValue(true));
          $delim = " AND";
          next ($this->mKeys);
        }//for ($i = 0; $i < sizeof($this->mKeys); $i++)
      }//if (is_array($this->mKeys))
    }//if (strlen($this->mWhere) == 0)
  } 

  /**
  * Stores the last inserted record
  */
  function SetLastInserted($lastInserted = false)
  {
    $this->mLastInserted = is_object($lastInserted)?$lastInserted:false;
  }

  /**
  * Asks the user whether he wishes to delete a record 
  */
  function ConfirmDeletion($confirmDeletion = false)
  {
    if ($confirmDeletion)
    {
      $this->AddFunction("confirm_deletion");
      $this->AddParameter("confirm_deletion", "'" . $this->mForm->mName . "'");
    }
  }
}