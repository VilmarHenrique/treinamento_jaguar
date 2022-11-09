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
 * creation - 
 *
 * 2003-03-27 - decio
 *  Criadas as funcoes: SetUnformatted(), SetUpper(), SetLower(), SetTrim()
 *
 * 2003-04-10 - al_nunes
 *  Alteradas as funcoes SetUpper() e SetLower()
 *
 * 2003-04-16 - pedro
 *  alteração na classe JFormSelect
 *
 * 2003-04-22 - pedro
 *  alteracao da funcao IsValid() da classe JFormDate
 * 
 * 2003-04-23 - pedro
 *  alteracao na classe JFormTime, implementado o uso da classe 
 *  sem a obrigatoriedade da digitacao de segundos
 *
 * 2003-05-06 - pedro
 *  implementação de ALTS nos links para popup da classe JFormSelect
 *
 * 2003-05-08 
 *  implementacao da possibilidade de passagem de um paramero fixo por URL
 *  no JFormSelect
 *
 * 2003-06-12
 *  aumentado o tamanho default do SetSize() para 40, 
 *  e colocado para o JFormText pegar esse tamanho por defalt
 *
 * 2003-29-07
 *  mudado função GetValue(), converte os valores que veem do banco
 *
 * 2003-29-07
 *  mudado a classe JFormEditor, apadtado para novo editor
 */

require_once(JAGUAR_PATH . "jtable.inc.php");
require_once(JAGUAR_PATH . "jutils.inc.php");
require_once(JAGUAR_PATH . "jdb.inc.php");
require_once(JAGUAR_PATH . "JPrimitiveObject.php"); 

/**
* Forms creation class
*
* @author  Atua Sistemas de Informação
* @since   2002-04-??
* @package Jaguar
*/
class JForm extends JTable
{
  const FILTER_TYPE_FREE     = 0;
  const FILTER_TYPE_INTERVAL = 1;
  const FILTER_TYPE_LIGHT    = 2;
  const FILTER_TYPE_HEAVY    = 3;

  const FILTER_VALIDATION_FREE    = 0;
  const FILTER_VALIDATION_LEVEL_1 = 1;

  /**
  * Stores object's type
  * @var string
  */
  var $mType = "Form";

  /**
  * Stores object's name
  * @var string
  */
  var $mName;
  
  /**
  * Stores form's action
  * @var string
  */
  var $mAction;

  /**
  * Stores form's method
  * @var string
  */
  var $mMethod;

  /**
  * Controls whether form might receive focus on it's creation or not
  * @var boolean
  */
  var $mFocus = true;

  /**
  * Stores the name of the object that will receive focus
  * @var string
  */
  var $mFocusedField;

  /**
  * Controls the passwords fields in the form
  * @var array
  */
  var $mHasPassword;

  /**
  * Controls the submission of the form
  * @var boolean
  */
  var $mSubmitted;

  /**
  * Used by javascript function called avoidMultipleRequest to verify whether the actual form has been already submitted
  * @var object
  */
  var $mAlreadySubmitted;

  /**
  * Controls the submission of the form
  * @var boolean
  */
  var $mFormSubmitted = 0;

  /**
  * Stores extra code HTML used in the form tag
  * @var string
  */
  var $mExtra;

  /**
  * Controls whether the all the form fields where validated or not
  * @var boolean 
  */
  var $mValid;

  /**
  * Controls if debug will be used or not
  * @var boolean
  */
  var $mDebug = false;

  /**
  * Stores the form's target
  * @var string
  */
  var $mTarget = "_self";

  /**
  * Stores the functions called before the form's submission
  * @var array
  */
  var $mFunctions;
  
  /**
  * Stores the parameters for the functions called before the form's submission
  * @var array
  */
  var $mParameters;
  
  /**
  * Stores the tips' style
  * @var array
  */
  var $mTipStyle = "\"#000077\",\"#CECEFF\",\"\",\"\",\"cursive\",2,\"#000000\",\"#F0F0F0\",\"\",\"\",\"cursive\",2,,,2,\"#FFFFFF\",2,,,,,\"\",,,,";

  var $mIndTipStyle = 0;

  /**
  * Stores if the enter key will have any action in the form
  * @var boolean
  */
  var $mEnterHasActions = true;

  /**
  * Sets whether the component will test its value on onBlur event
  * @var string
  */
  var $mTestOnBlur = true;

  /**
  * Enctype of the form
  * @var string
  */
  var $mEnctype = "multipart/form-data";

  /** @var int */
  private $mFilterValidationLevel;

  /** @var array */
  private $mFilterConfig = array();

  /**
  * Constructor
  * @param string $name  Field's name Form's name
  */
  function __construct($name = false)
  {
    global $conn;

    parent::__construct();
    $this->SetName($name);
    $this->SetAction();
    $this->SetMethod();
    $this->mIndex = 0;

    $this->mAlreadySubmitted = new JFormHidden("f_".$name."_already_submitted");
    $this->mAlreadySubmitted->SetValue(0);

    $this->mSubmitted = new JFormHidden("f_".$name."_submitted", "0");
    $this->mFormSubmitted = $this->mSubmitted->GetValue();
    $this->mSubmitted->SetValue("1");
  }

  /**
   * Create table to see saved filters
   * @global $conn
   * @global $html
   * @param Array $cell_options
   * @param String $submit_label
   * @return type
   */
  function GetSavedFilters($cell_options, $submit_label = "Gerar")
  {
    global $conn, $html;
    
    //Busca Filtros Salvos
    if (!str_value($_SESSION["s_cd_usuario"]))
      return;
    
    $sql = 
      "SELECT DISTINCT cd_filtro_jaguar AS value,
              nm_filtro AS description
         FROM filtro_jaguar fj
         LEFT JOIN filtro_jaguar_usuario fju USING (cd_filtro_jaguar)
        WHERE nm_arquivo = '" . basename($_SERVER["SCRIPT_FILENAME"]) . "'
          AND (fju.cd_pessoa IS NULL OR fju.cd_pessoa = " . $_SESSION["s_cd_usuario"] . ") ";
    
    if ($rs = $conn->Select($sql))
    {
      if ($rs->GetRowCount())
      {
        $js_busca_filtro = "       
          var dsFiltroJaguar = '';
          var arr_filtro_jaguar = new Array();
          
          function pesquisa_filtro_jaguar(cd_filtro_jaguar, ds_filtro_jaguar)
          {
            ds_filtro_jaguar = ds_filtro_jaguar.toUpperCase();

            if ( ds_filtro_jaguar == dsFiltroJaguar)
              return false;
            else
              dsFiltroJaguar = ds_filtro_jaguar;
            if (typeof(arr_filtro_jaguar[cd_filtro_jaguar.name]) == 'undefined')
              arr_filtro_jaguar[cd_filtro_jaguar.name] = new Array();
            if (cd_filtro_jaguar.options.length > arr_filtro_jaguar[cd_filtro_jaguar.name].length)
            {
              for (i = 0; i < cd_filtro_jaguar.options.length; i++)
                arr_filtro_jaguar[cd_filtro_jaguar.name][i] = new Array(cd_filtro_jaguar.options[i].text, cd_filtro_jaguar.options[i].value);
            }
            cd_filtro_jaguar.options.length = 0;

            if (ds_filtro_jaguar == '')
            {
              for (i = 0; i < arr_filtro_jaguar[cd_filtro_jaguar.name].length; i++)
                cd_filtro_jaguar.options[i] = new Option(arr_filtro_jaguar[cd_filtro_jaguar.name][i][0], arr_filtro_jaguar[cd_filtro_jaguar.name][i][1]);
            }
            else
            {
              for (i = 0, x = 0; i < arr_filtro_jaguar[cd_filtro_jaguar.name].length; i++)
              { 
                if (arr_filtro_jaguar[cd_filtro_jaguar.name][i][0].toUpperCase().indexOf(ds_filtro_jaguar) >= 0)
                  cd_filtro_jaguar.options[x++] = new Option(arr_filtro_jaguar[cd_filtro_jaguar.name][i][0], arr_filtro_jaguar[cd_filtro_jaguar.name][i][1]);
              }
            }
          }
        ";
        $this->AddJs($js_busca_filtro);
        
        //Formulário
        $tbl_filtros = new JTable(array("name" => "tbl_filtro_jaguar"));
        $tbl_filtros->SetWidth("75%");

        $tbl_filtros->OpenRow();
        $tbl_filtros->OpenHeader("<b>Filtros</b>", array("colspan" => 2));
        
        if (valida_permissao_funcao("filtro_jaguar"))
        {
          //id_filtro_confidencial_jaguar
          $tbl_filtros->OpenRow();
          $tbl_filtros->OpenHeader("<b>Confidencial</b>");
          $tbl_filtros->OpenCell();
          $id_filtro_confidencial_jaguar = new JFormSelect("f_id_filtro_confidencial_jaguar");
          $id_filtro_confidencial_jaguar->MakeId("id_filtro_confidencial_jaguar");
          $id_filtro_confidencial_jaguar->SetFirstEmpty();
          $id_filtro_confidencial_jaguar->AddOption(0, "Não");
          $id_filtro_confidencial_jaguar->AddOption(1, "Sim");
          $tbl_filtros->AddObject($id_filtro_confidencial_jaguar);
        }
        
        //ds_filtro_jaguar
        $tbl_filtros->OpenRow();
        $tbl_filtros->OpenHeader("<b>Buscar</b>");
        $tbl_filtros->OpenCell();
        $ds_filtro_jaguar = new JFormText("f_ds_filtro_jaguar");
        $ds_filtro_jaguar->MakeId("ds_filtro_jaguar");
        $ds_filtro_jaguar->SetSize(15);
        $ds_filtro_jaguar->SetMaxLength(30);
        $ds_filtro_jaguar->SetEvents("onKeyUp", "pesquisa_filtro_jaguar");
        $ds_filtro_jaguar->SetParameters("pesquisa_filtro_jaguar", "document.form.f_cd_filtro_jaguar");
        $ds_filtro_jaguar->SetParameters("pesquisa_filtro_jaguar", "this.value");
        $tbl_filtros->AddObject($ds_filtro_jaguar);
        
        //cd_filtro_jaguar
        $cd_filtro_jaguar = new JFormSelect("f_cd_filtro_jaguar");
        $cd_filtro_jaguar->MakeId("cd_filtro_jaguar");
        $cd_filtro_jaguar->SetFirstEmpty();
        $cd_filtro_jaguar->SetOptions($rs->GetArray(true));
        $tbl_filtros->AddObject($cd_filtro_jaguar);
        
        //btn_aplica_filtro
        $tbl_filtros->OpenRow();
        $tbl_filtros->OpenHeader("", array("colspan" => 2));                
        $btn_aplica_filtro = new JFormButton("f_btn_aplica_filtro", "Aplicar");
        $btn_aplica_filtro->SetCssClass("submit");
        $btn_aplica_filtro->MakeId("btn_aplica_filtro");
        $tbl_filtros->AddObject($btn_aplica_filtro);
        
        //btn_exclui_filtro
        $btn_exclui_filtro = new JFormButton("f_btn_exclui_filtro", "Excluir");
        $btn_exclui_filtro->SetCssClass("submit");
        $btn_exclui_filtro->MakeId("btn_exclui_filtro");
        $tbl_filtros->AddObject($btn_exclui_filtro);
        
        //btn_desfazer_acao
        $btn_desfazer_acao = new JFormButton("f_btn_desfazer_acao", "Limpar Filtros");
        $btn_desfazer_acao->SetCssClass("submit");
        $btn_desfazer_acao->MakeId("btn_desfazer_acao");
        $tbl_filtros->AddObject($btn_desfazer_acao);
        
        //Gerar (atalho para gerar o relatório)
        $submit = new JFormSubmit("submit_", "$submit_label");
        $tbl_filtros->AddObject($submit);
        
        $this->OpenRow();
        $this->OpenCell("", $cell_options);
        
        $this->AddObject($tbl_filtros);
        
        $this->OpenRow();
        $this->OpenCell("&nbsp;", $cell_options);
        
        $html->AddHtml("<br/>");
        
        $js = " 
          $(document).ready(function(){
            $('#btn_aplica_filtro').click(function(){
              if ($('#cd_filtro_jaguar').val() == '' || $('#cd_filtro_jaguar').val() == null)
                alert('Informe um filtro para aplicar!');
              else
              {
                //Seta Filtro Aplicado
                $('#cd_filtro_jaguar_aplicado').val($('#cd_filtro_jaguar').val());              
                
                abre_iframe('include/ifr_salva_filtro_jaguar.php?f_cd_filtro_jaguar=' + $('#cd_filtro_jaguar').val());
              }
            });
            
            $('#btn_exclui_filtro').click(function(){
              if ($('#cd_filtro_jaguar').val() == '' || $('#cd_filtro_jaguar').val() == null)
                alert('Informe um filtro para excluir!');
              else
              {
                vl        = $('#cd_filtro_jaguar').val();
                nm_filtro = $('#cd_filtro_jaguar option[value=' + vl + ']').text();
                
                if (confirm('Tem certeza que deseja excluir o Filtro ' + nm_filtro + ' ?'))
                  abre_iframe('include/ifr_salva_filtro_jaguar.php?f_id_excluir_filtro=1&f_cd_filtro_jaguar=' + $('#cd_filtro_jaguar').val());
              }
            });
            
            $('#btn_desfazer_acao').click(function(){
              self.location.reload();
            });
            
            $('#id_filtro_confidencial_jaguar').live('change', function(){
              ds_parametros = 'f_id_busca_filtro=1&f_id_confidencial=' + $(this).val();
              ds_parametros +='&f_nm_arquivo_filtro_jaguar=\'" . substr($_SERVER["PHP_SELF"], 1) . "\'';
                
              abre_iframe('include/ifr_salva_filtro_jaguar.php?' + ds_parametros);
            });
            
          });
        ";
        
        $this->AddJs($js);
        
        //cd_filtro_jaguar_aplicado
        $cd_filtro_jaguar_aplicado = new JFormHidden("f_cd_filtro_jaguar_aplicado");
        $cd_filtro_jaguar_aplicado->MakeId("cd_filtro_jaguar_aplicado");
        $this->AddObject($cd_filtro_jaguar_aplicado);
      }
    }
    else
      echo $conn->GetTextualError();
  }

  function SaveFilter()
  {
    //btn_salvar_filtro
    $btn_salvar_filtro = new JFormButton("f_salvar_filtro");
    $btn_salvar_filtro->MakeId("btn_salvar_filtro");
    $btn_salvar_filtro->SetValue("Salvar Filtro");
    $btn_salvar_filtro->SetCssClass("submit");
    $this->AddObject($btn_salvar_filtro);
    
    //Dialog
    $this->AddHtml(abre_pop());
    
    $js = "         
      $(document).ready(function(){
        $('#btn_salvar_filtro').click(function(){
          ds_parametros = 'f_nm_arquivo_filtro_jaguar=" . basename($_SERVER["SCRIPT_FILENAME"]) . "';
          
          if ($('#cd_filtro_jaguar_aplicado').val())
            ds_parametros += '&f_cd_filtro_jaguar_aplicado=' + $('#cd_filtro_jaguar_aplicado').val();
            
          abre_pop('include/ifr_salva_filtro_jaguar.php?' + ds_parametros);
        })
      })";
    
    $this->AddJs($js);
  }

  /**
  * Sets the form's target
  * @param string $target Form's target
  */
  function SetTarget($target)
  {
    $this->mTarget = $target;
  }

  /**
  * Returns error messages of the objects added to this container
  * @returns string
  */
  function GetInvalidMessages()
  { 
    $invalidMessage = '';
    foreach($this->mObjects as $component)
    {
      $error = $component->GetInvalidMessage();
      if ($error)
        $invalidMessage .= $error.'\n';
    }

    return $invalidMessage;
  }

  /**
  * Sets the form's name
  * @param string $name  Field's name Form's name
  */
  function SetName($name = false)
  {
    $this->mName = ($name)?$name:"form";
  }

  /**
  * Sets the form's action
  * @param string $action Form's action
  */
  function SetAction($action = false)
  {
    $this->mAction = ($action) ? $action : $_SERVER["PHP_SELF"];
  }

  /**
  * Sets the form's method
  * @param string $method Form's method
  */
  function SetMethod($method = false)
  {
    $this->mMethod = ($method)?$method:"POST";
  }

  /**
  * Adds JS functions to the onSubmit event
  * @param string $function Function's name
  */
  function AddFunction($function)
  {
    $this->mFunctions[] = $function;
  }

  /**
  * Adds parameters for JS functions calles on onSubmit event
  * @param string $function  Function's name
  * @param string $parameter Parameter's name
  */
  function AddParameter($function, $parameter)
  {
    $this->mParameters[$function][] = $parameter;
  }
 
  /**
  * Adds a object to the form
  * @param string $what Object's reference
  */
  function AddObject(&$what)
  {
    if ($what instanceof JFormObject && $what->GetFilterType() !== self::FILTER_TYPE_INTERVAL)
      $this->mFilterConfig[$what->GetFilterType()][] = $what->mName;

    if (!$this->mTableOpened)
      $this->OpenTable();

    parent::AddObject($what);
    $i = $this->mIndex -1;

    switch($this->mObjects[$i]->mType)
    {
      case "Password":
        $this->mHasPassword[] = &$this->mObjects[$i];
      break;
    }
  }

  /**
  * Sets the focus to a given form field
  * @param object $object JForm* object
  */
  function SetFocus($object = false)
  {
    if (is_object($object))
    {
      $this->mFocus = true;
      $this->mFocusedField = $object->mName;
    }
    else
      $this->mFocus = false;
  }

  /**
  * Sets extra HTML code to the form tag
  * @param string $text Extra-code
  */
  function SetExtra($text = false)
  {
    $this->mExtra = ($text)?$text:"";
  }

  /**
  * Controls the use of debug
  * @param boolean $debug True or false
  */
  function SetDebug($debug = false)
  {
    $this->mDebug = (is_bool($debug))?$debug:false;
  }

  /**
  * Checks if all the form objects are valid
  *
  * If the Debug parameter is set for true, prints the name of the invalid fields
  *
  * @returns boolean
  */
  function IsValid()
  {
    $this->mValid = true;

    if ($_POST["f_action"] == "delete")
      return $this->mValid;

    foreach($this->mObjects as $obj)
    {
      if ( is_subclass_of($obj, "JFormObject") )
      {
        $this->mValid = $this->mValid && $obj->IsValid();

        if ($this->mDebug)
          if ( !$this->mValid )
            echo "Invalid: ".$obj->mName." - ".$obj->GetInvalidMessage()."<br>\n";

        if (!$this->mValid)
          return $this->mValid;
      }
    }

    return $this->mValid;
  }

  /**
  * Checks if the form was submitted
  * @returns boolean
  */
  function IsSubmitted()
  {
    return $this->mFormSubmitted;
  }

  /**
  * Builds the form's HTML code
  * @returns string
  */
  function GetHtml($disabledFields=false)
  {
    $this->CloseTable();

    $out  = "";
    $out .= $this->GetMainContainerHtml();

    //TODO testing
//    $out .= "$this->mSpace<script language=\"JavaScript\" src=\"" . URL ."js/main15.js\"></script>\n";
//    $out .= "$this->mSpace<script language=\"JavaScript\" src=\"" . URL ."js/jutils.js\"></script>\n";

    $tips = "";
    for ($i = 0; $i < $this->mIndex; $i++)
    {

      if ($this->mObjects[$i]->mTip["tip"])
      {
        $tips .= "Tips[\"" . $this->mObjects[$i]->mName . "\"] = [\"" . $this->mObjects[$i]->mTip["title"] . 
                "\", \"" . $this->mObjects[$i]->mTip["tip"] ."\"];\n";
      }

      if (is_object($this->mObjects[$i]))
      {
        /*
          When there is a key field in a maintenance which needs to be shown to the user, it can't be edited
          so in this case, JMaintenance->GetHtml() will pass it through a parameter meaning that 
          this field might be disabled here.
        */
        if (is_array($disabledFields) && in_array($this->mObjects[$i]->mName, $disabledFields))
          $this->mObjects[$i]->SetDisabled(true); 

        //generates an id to this component
        $this->mObjects[$i]->MakeId(++$this->mId);
        $out .= $this->mObjects[$i]->GetHtml();

        /*
          To avoid problems of duplicate ids when using nested objects,
          in these cases ids after GetHtml() method will have a different value
        */
        $this->mId = $this->mObjects[$i]->MakeId(); 
      }
      else
        $out .= $this->mTexts[$i];
    }

    if ($tips)
    {
      $out .= "$this->mSpace<script language=\"JavaScript\">\n";
      $out .= "Style[0] = [" . $this->mTipStyle . "];\n" ; 
      $out .= "var TipId=\"tiplayer\"; \nvar FiltersEnabled = 1; \nmig_clay(); \n";
      $out .= "$tips\n</script>\n";
    }

    //$this->GetFocus();
    $out .= $this->GetFocus();
    $out .= $this->GetMainContainerHtml("end");

    // O trecho abaixo estava no método OpenTable da classe JTable.
    // Foi retirado daquele método e colocado aqui para poder adicionar
    // funções de validação de submit após o formulário já ter sido construído.
    if (is_array($this->mFunctions))
    {
      $OnSubmitFunctions = "";
      reset($this->mFunctions);
      do
      {
        $OnSubmitFunctions .= " && ";
        $OnSubmitFunctions .=  current($this->mFunctions)."(";

        if (is_array($this->mParameters))
        {
          reset($this->mParameters);
          do
          {
            $parameters = current($this->mParameters);
            if (is_array($parameters))
            {
              $end = end($parameters);
              reset($parameters);
              do
              {
                if (current($this->mFunctions) == key($this->mParameters))
                {
                  if ($end == current($parameters))
                    $OnSubmitFunctions .= current($parameters);
                  else
                    $OnSubmitFunctions .= current($parameters).",";
                }
              }
              while(next($parameters));
            }
          }
          while(next($this->mParameters));
        }

        $OnSubmitFunctions .= ")";
      }
      while(next($this->mFunctions));
      
      $out = str_replace(
        "return ".$this->mName."Submit()",
        "return ".$this->mName."Submit()" . $OnSubmitFunctions,
        $out
      );
    }

    return $out;
  }

  /**
  * Places focus in a form's field
  */
  function GetFocus($script = true)
  {

    if (!$this->mFocus)
      return;

    $js = "";

    // if there is not an specific field to focus by default the focused field will be the first
    //
    if (!$this->mFocusedField)
    {
      reset($this->mObjects);
      do
      {
        $field = &current($this->mObjects);
        if ($field->mType != "DualList" && $field->mType != "Hidden" &&
            $field->mType != "Layer" && $field->mName && !$field->mDisabled &&
            $this->mName != $field->mName)
        {
          $this->mFocusedField = $field->mName;
          break;
        }
      }
      while (next($this->mObjects));
    }

    // set focus on the specified field
    //
    if ($this->mFocusedField)
    {
      $js = "\ndocument.{$this->mName}.{$this->mFocusedField} && document.{$this->mName}.{$this->mFocusedField}.focus();\n";

      if ($script)
        $js = "<script>".$js."</script>";
    }

    return $js;
  }

  function RecursiveValidation(&$obj)
  {
    $out = "";
    
    if (!is_object($obj)) return;

    if (get_class($obj) == "JTable")
    {
      foreach ($obj->mObjects AS $table_obj)
      {
        if (get_class($table_obj) == "JTable")
        {
          $out .= $this->RecursiveValidation($table_obj);
          continue;
        }

        if (is_object($table_obj) && !is_subclass_of($table_obj, 'JObject'))
        {
          if (!$table_obj->mMainForm->mName)
            $table_obj->mMainForm->mName = $this->mName;

          if (method_exists($table_obj, "GetJSOnSubmit"))
          {
            $out .= $table_obj->GetJSOnSubmit();
            $out .= "  if (!ok){ form_submitted = false; return false; }\n\n";
          }
        }
      }
    }

    return $out;
  }
  
  /**
  * Builds the JS code that validates the form's submission
  * @returns string
  */
  function GetJSOnSubmit()
  {

    $isMaintenance = $this->mName == "maintenance";

    $out  = "
    <script>\nfunction ".$this->mName."Submit()\n{

      var errorRow = $('#".$this->mName."-filter-error');

      form_submitted = true;
      ok = true;

      try {
        {$this->GetFiltersValidationJS()}
        errorRow.hide();
      } catch (e) {
        errorRow.children().html(e);
        errorRow.show();
        ok = false;
      }

      if (eval('document." . $this->mName . ".f_action') != undefined)
      {
        if (document." . $this->mName . ".f_action.length == 2)
        {
          if (document." . $this->mName . ".f_action[1].checked)
          {";

  //maintenance enable all fields before submit
  if ($isMaintenance)
    $out .= "\n\t\tenableAll".$this->mName."();";

    $out .="
            return true;  
          }
        }
      }
    ";

    if (is_array($this->mObjects))
    {
      foreach($this->mObjects as $obj)
      {
        if (is_object($obj) && !is_subclass_of($obj, 'JObject')) 
        {
          $out .= $obj->GetJSOnSubmit();
          $out .= "  if (!ok){ form_submitted = false; return false; }\n\n";
        }
        else//if ($obj->mName == 'JTable')
          $out .= $this->RecursiveValidation($obj);
      }
      
    }

    if (is_array($this->mHasPassword))
    {
      $out .= "  if (ok) \n";
      $out .= "  {\n";

      foreach($this->mHasPassword as $obj)
      {
        if ($obj->mHashWithJS)
        {
          $out .= "  if (document.".$this->mName.".".$obj->mName.".value != '')\n";
          $out .= "    document.".$this->mName.".".$obj->mName.".value = calcMD5(document.".$this->mName.".".$obj->mName.".value);\n";
        }
      }

      $out .= "  }\n";
      $out .= "  return true; \n";
    }

    $out .= "  if (ok) { ";

    //maintenance enable all fields before submit
    if ($isMaintenance) 
       $out .= " enableAll".$this->mName."(); ";

    $out .= "return true; }\n";
    $out .= "} \n" ;

    if ($isMaintenance)
    {
      $out .= "
      function enableAll".$this->mName."()
      {
       for (var i=0; i<document.".$this->mName.".elements.length; i++) 
        document.".$this->mName.".elements[i].disabled = false; 
      }

      function avoidMultipleRequests".$this->mName."()   
      {    
        var obj = document.".$this->mName.".".$this->mAlreadySubmitted->mName.";
        if (obj.value == 1)
        {
          alert('Atenção: O formulário ja foi enviado!');
          return false;
        }
        else
          obj.value = 1;

        return true;
      }
      ";
    } 

    $out .= "\n</script>\n";

    return $out;
  }

  function SetEnctype($enctype)
  {
    $this->mEnctype = (string) $enctype;
  }
  
  function GetName()
  {
    return $this->mName;
  }

  public function SetFilterValidationLevel($level)
  {
    $this->mFilterValidationLevel = (int)$level;
  }

  /**
   * @param JFormObject $field1 ex: $dt_inicio, $nr_inicio
   * @param JFormObject $field2 ex: $dt_final, $nr_final
   * @param string $label ex: "Dt. Emissão CTRC", "Nr. Ctrc"
   * @param array $config ex: array(JForm::FILTER_VALIDATION_LEVEL_1 => array(7, 30, 365)) // 7, 30, 365 intervalo de dias ou numeros
   * @param JFormObject $fieldEqual ex: $dt_igual, $nr_igual
   * @throws Exception
   */
  public function SetIntervalFilters(JFormObject $field1, JFormObject $field2, $label, array $config, JFormObject $fieldEqual=null)
  {
    $class = get_class($field1);

    if ($class !== get_class($field2))
      throw new Exception("Parametros 1 e 2 devem ser instâncias da mesma classe!");

    if (!in_array($class, array("JFormDate", "JFormNumber")))
      throw new Exception("Ainda não implementado tipo: {$class}.");

    $this->mFilterConfig[JForm::FILTER_TYPE_INTERVAL][] = array(
      "type"       => $class,
      "field1"     => $field1->mName,
      "field2"     => $field2->mName,
      "label"      => utf8_encode($label),
      "dsType"     => utf8_encode($class === "JFormDate" ? " dia(s)" : ""),
      "fieldEqual" => $fieldEqual->mName,
      "config"     => $config
    );
  }

  private function GetFiltersValidationJS()
  {
    if ($this->mFilterValidationLevel < JForm::FILTER_VALIDATION_LEVEL_1)
      return "";

    if (count($this->mFilterConfig) && !count($this->mFilterConfig[JForm::FILTER_TYPE_INTERVAL]))
      throw new Exception("Está faltando utilizar o JForm::SetIntervalFilters!");

    foreach ($this->mFilterConfig[JForm::FILTER_TYPE_INTERVAL] as &$intervalConfig)
      $intervalConfig["config"] = $intervalConfig["config"][$this->mFilterValidationLevel];

    $arrConfig = json_encode(array(
      "free"     => $this->mFilterConfig[JForm::FILTER_TYPE_FREE],
      "interval" => $this->mFilterConfig[JForm::FILTER_TYPE_INTERVAL],
      "light"    => $this->mFilterConfig[JForm::FILTER_TYPE_LIGHT],
      "heavy"    => $this->mFilterConfig[JForm::FILTER_TYPE_HEAVY],
    ));

    return <<<JS
      (function(){

        var idMinInterval, arrConfig = {$arrConfig};
        var arrDtFormat = ['DD/MM/YYYY', 'DD/MM/YY', 'YYYY-MM-DD'];
        var idInterval = 3;

        if ((arrConfig.free || []).some(strValue))
          return true;

        for (var i in arrConfig.interval)
        {
          var config = arrConfig.interval[i];

          if (config.fieldEqual && strValue(config.fieldEqual))
            return true;

          var field1 = strValue(config.field1);
          var field2 = strValue(config.field2);

          if (field1 && field2)
          {
            if (config.type === 'JFormNumber')
              config.vlInterval = field2 - field1;
            else
              config.vlInterval = moment(field2, arrDtFormat).diff(moment(field1, arrDtFormat), 'days');

            if (config.vlInterval < 0)
              continue;
            else if (config.vlInterval <= config.config[0])
              return true;
            else if (config.vlInterval <= config.config[1])
              idInterval = 1;
            else if (config.vlInterval <= config.config[2])
              idInterval = Math.min(2, idInterval);
          }
        }

        var idLight  = (arrConfig.light || []).some(strValue);
        var idHeavy  = (arrConfig.heavy || []).some(strValue);

        if (!((idInterval === 1 && (idHeavy || idLight)) || (idInterval === 2 && idLight)))
        {
          idMinInterval = (idLight ? 2 : (idHeavy ? 1 : 0));
          throw '<b>Preencha os filtros conforme descrição a seguir:</b><br />' + arrConfig.interval.map(getFieldDescription).join(';<br />') + '.';
        }

        function strValue(fieldName)
        {
          return $('*[name="' + fieldName + '"]').val();
        }

        function getFieldDescription(interval)
        {
          return '<b>' + interval.label + ':</b> com intervalo de no máximo ' + interval.config[idMinInterval] + interval.dsType;
        }
      })();
JS;
  }

  /** @param int $colspan */
  public function AddFilterErrorRow($colspan=2)
  {
    $this->OpenRow(array("id" => $this->mName . "-filter-error", "style" => "display:none;", "align" => "center"));
    $this->OpenCell("", array("colspan" => $colspan, "class" => "alert-danger"));
  }
}

/**
* Base class for form object's creation
*
* @author  Atua Sistemas de Informação
* @package Jaguar
* @subpackage FormObjects
*/
class JFormObject extends JPrimitiveObject
{
  /**
  * Stores object's value
  * @var string
  */
  var $mValue;

  /**
  * Controls the object will have a maximum length
  * @var boolean
  */
  var $mHasMaxLength = false;

  /**
  * Stores the object's size
  * @var int
  */
  var $mSize         = 25;

  /**
  * Stores the object's maximum length
  * @var int
  */
  var $mMaxLength;

  /**
  * Controls if the object is disabled
  * @var string
  */
  var $mDisabled     = "";

  /**
  * Controls whether the object might be fulfilled or not
  *
  * 0 - no test
  * 1 - test on onSubmit event only
  * 2 - test on onBlur/onSubmit events
  *
  * @var int
  */
  var $mTestIfEmpty  = 0;

  /**
  * Stores the message shown in a fulfillig error
  * @var string
  */
  var $mTestIfEmptyMessage;

  /**
  * Stores extra code HTML for the input tag
  * @var string
  */
  var $mExtra;

  /**
  * Stores the object's alignment
  * @var string
  */
  var $mAlign;

  /**
  * Checks if the object has value
  * @var boolean
  */
  var $mEmpty;

  /**
  * Stores the object's CSS class
  * @var string
  */
  var $mCssclass     = false;

  /**
  * Stores the function's names associated to the JS events
  * @var array
  */
  var $mEvents;

  /**
  * Stores if the class will force data types when passing through parameters to JS
  * @var array
  */
  var $mForceDataTypeJS;

  /**
  * Stores the function's parameters associated to the JS events
  * @var array
  */
  var $mParameters;

  /**
  * Controls the use of popup
  * @var array
  */
  var $mPopUpUrl;

  /**
  * Stores the popup's height
  * @var int
  */
  var $mPopUpHeight  = 500;

  /**
  * Stores the popup's width
  * @var int
  */
  var $mPopUpWidth   = 600;

  /**
  * Stores the popup's link
  * @var array
  */
  var $mPopUpLabel;

  /**
  * Stores the images used in the popup links
  * @var array
  */
  var $mLinkImage;

  /**
  * Controls the images usage for popup links
  * @var boolean
  */
  var $mUseLinkImage = false;

  /**
  * Controls whether the form might be submitted with this field not been valid
  * @var boolean
  */
  var $mAllowInvalidSubmission = false;

  /**
  * Controls whether the object requires special parameters on grid's SetValue call
  * @var boolean
  */
  var $mGridParameters = false;

  /**
  * Stores the object's Tip
  * @var array
  */
  var $mTip;

  /**
  * Stores the object's message in case of an invalid entry
  * @var string
  */
  var $mInvalidMessage;

  /**
  * Stores the object's regEx
  * @var string
  */
  var $mRegEx;

  /**
  * Store the minnimum number of repetition for the given Reg Expression
  * @var integer
  */
  var $mMinimumRepeat;

  /**
  * Store the maximum number of repetition for the given Reg Expression
  * @var integer
  */
  var $mMaximumRepeat; 

  /**
  * Stores the width value
  * @var int
  */
  var $mWidth = '';

  /**
  * Stores the height value
  * @var int
  */
  var $mHeight = '';

  /**
  * Stores the jobject isntance which contains this object
  * @var object
  */
  var $mMainForm;

  /**
  * Stores whether $mValue is holding a defualt value
  * @var object
  */
  var $mDefaultValue; 

  /**
  * Stores object's label 
  * @var string
  */
  var $mLabel;

  /**
  * Stores error message
  * @var string
  */
  var $mError;

  /**
   * @var bool
   */
  var $mUsePopUp = false;

  /** @var int */
  private $mFilterType;

  protected $mTooltip = "";

  /**
  * Sets the object's name
  * @param string $name  Field's name Object's name
  */
  function SetName($name)
  {
    $this->mName = $name;
    if ($this->mType != "Button")
    {
      if (!isset($GLOBALS[$name]))
        $GLOBALS[$name] = "";

      $this->mValue = &$GLOBALS[$name];
    }
  }


  /**
  * Sets the object's label
  * @param string $label Field's label
  */
  function SetLabel($label)
  {
    $this->mLabel = $label;
  }

  /**
  * Returns the object's label
  * @returns string
  */
  function GetLabel() 
  {
    $mLabel = preg_replace("/(<\/?)(\w+)([^>]*>)/", "", $this->mLabel);
    $mLabel = explode("\n", $mLabel);
    $mLabel = trim($mLabel[0]);

    return $mLabel;
  }

  /**
  * sets the object's default value
  * @param mixed $value object's default value
  */
  function SetDefaultValue($value = false)
  {
    // if a value has been passed is valid (!== false)
    // and the value wasn't already been set ($this->mValue === null || $this->mValue === '')
    // or are still setting a default value ($this->mDefaultValue === true)
    // OBS: mValue is also redefined in SetName, so it can has an invalid value !== null
    //
    if ( $value !== false && ( ($this->mValue === null || $this->mValue === '') || ($this->mDefaultValue === true) ) )
    {
      $this->SetValue($value);
      $this->mDefaultValue = true;
    }
  } 

  /**
  * Sets the object's value
  * @param mixed $value Object's value
  */
  function SetValue($value = false)
  {

    //passed a valid value 
    if ($value !== false)
    {
    //if there is already a valid value which is not default, and then comes an invalid one, then just ignore the new value
      if ( ($this->mValue !== null && $this->mDefaultValue !== true) && ($value === '' || $value === null))
        return;

      $this->mValue = $value;
      $this->mDefaultValue = false;
    }

  }

  /**
  * Resets popup features when a component is disabled
  * @param boolean $disabled
  */
  function UsePopUp($disabled)
  {
    if (ifnull($disabled, $this->mUsePopUp) === null)
    {
      $this->mPopUpFields =  null;
      $this->mPopUpLabel  = null;
      $this->mPopUpUrl    = null;
    }
    else
      $this->mUsePopUp = true;
  }

  /**
  * Sets the object's size
  * @param int $size Object's size
  */
  function SetSize($size = 40) 
  {
    $this->mSize = $size;
  }

  /**
  * Sets the width and height size
  * @param string $width Width number or percent
  * @param string $height height number or percent
  */
  function SetCssSize($width = '100%', $height = '95%' ) 
  {
    $this->mWidth  = $width;
    $this->mHeight = $height;
  }

  /**
  * Sets the object's message in case of an invalid entry
  * @param string $msg Message text
  * @param boolean $force Force message
  */
  function SetInvalidMessage($msg, $force = false)
  {
    $label = $this->GetLabel() ? $this->GetLabel() : 'Valor do campo '.$this->GetValue();
    $this->mInvalidMessage = $force ? $msg : $label.': '.$msg;
  }

  /**
  * Returns the object's message which holds the error
  * @returns string
  */
  function GetInvalidMessage()
  {
    return $this->mInvalidMessage;
  }

  /**
  * Sets the object's maximum length
  * @param int $maxlength Object's maximum length
  */
  function SetMaxLength($maxlength = false)
  {
    if ($maxlength)
    {
      $this->mHasMaxLength = true;
      $this->mMaxLength = $maxlength;
      if ($this->mSize > $this->mMaxLength)
        $this->mSize = $this->mMaxLength;
    }
    else
      $this->mHasMaxLength = false;
  }

  /*
  * Sets whether the object must be filled or not and when the error messahe will be shown
  *
  * @param int    $test    Controls the test's moment.
  * Possible values for $test are: <br>
  * 0 - no test <br>
  * 1 - test on onSubmit event only <br>
  * 2 - test on onBlur/onSubmit events 
  * @param string $message Error message
  */
  function SetTestIfEmpty($test = 0, $message = "Por favor, preencha o campo!")
  {
    if (is_bool($test))
      $test = ($test)?1:0;
    else
    {
      if ($test < 0 || $test > 2)
        $test = 0;
    }
      
    $this->mTestIfEmpty        = $test;
    $this->mTestIfEmptyMessage = $message;
  }

  /**
  * Sets extra HTML code
  * @param string $text Extra code
  */
  function SetExtra($text = false)
  {
    $this->mExtra = ($text)?$text:"";
  }

  /**
  * Sets the object's alignment
  * @param string $align { left | center | right }
  */
  function SetAlign($align = "right")
  {
    $this->mAlign = ($align)?"style=\"text-align: $align\"":"";
  }

  /**
  * Sets the object's CSS class
  * @param string $class CSS class
  */
  function SetCssClass($class)
  {
    $this->mCssclass .= " ".( (string) $class );
  }

  /**
  * Sets whether the component will test its value on onBlur event
  * @param boolean $bool
  */
  function SetTestOnBlur($bool = true)
  {
    $this->mTestOnBlur = (boolean) $bool;
  }

  /**
  * Sets the object as disabled or not
  * @param boolean $disabled
  */
  function SetDisabled($disabled = false)
  {
    $this->UsePopUp(!$disabled);
    $this->mDisabled = ($disabled) ? " disabled ":"";
  }

  /**
  * Sets default javascript events
  */
  function SetDefaultEvents()
  {
    if ($this->mTestIfEmpty == 2)
    {
      $this->SetEvents("onBlur", "test_if_empty");
      $this->SetParameters("test_if_empty", "this.id");
      $this->SetParameters("test_if_empty", $this->mTestIfEmptyMessage);
    }

    // this is only needed for IE because firefox accepts the :focus css property
    //
    if ($this->IsIE())
    {   
     $this->SetEvents("onBlur", "_cssOnBlur");     
     $this->SetParameters("_cssOnBlur", "this.id");    

     $this->SetEvents("onFocus", "_cssOnFocus");     
     $this->SetParameters("_cssOnFocus", "this.id");   
    }

    /*
      Some applications use it's own focus control.
      So it won't use the focus change issue through enter key
    */

    if ($this->mMainForm->mEnterHasActions && !in_array($this->mType, array("Editor", "TextArea")))
    {
      //set default action to onKeyPress event
      //
      $onKeyEnterPressed = "";
    
      if ($this->mMainForm->mUseEnterBesidesTab)
        $onKeyEnterPressed = "return changeFocusUsingEnter";
      else
        if ($this->mType == "Select")
          $onKeyEnterPressed = "submitOnEnterEvent";


      if ($onKeyEnterPressed)
      {
        $this->SetEvents("onKeyDown", $onKeyEnterPressed);  
        $this->SetParameters($onKeyEnterPressed, "this.id");
        $this->SetParameters($onKeyEnterPressed, "event");
      }
    }

  }

  /**
  * Add JS functions to events
  * @param string $event    Event's name. Eg.: onBlur, onFocus
  * @param string $function Function's name
  */
  function SetEvents($event, $function)
  {
    $this->mEvents[$event][] = $function;
  }

  /**
  * Adds parameters to JS functions associated to events
  * @param string $function  Function's name
  * @param string $parameter Parameter's name
  * @param bool   $force    force data type
  */
  function SetParameters($function, $parameter, $force = false) 
  {
    $this->mParameters[$function][] = $parameter;
    $this->mForceDataTypeJS[$function][] = $force;
  }

  /**
   * @param $filterType
   * @throws Exception
   */
  function SetFilterType($filterType)
  {
    $this->mFilterType = (int)$filterType;
  }

  /** @return int */
  function GetFilterType()
  {
    return $this->mFilterType;
  }

  /**
  * Builds the JS events code
  * @returns string
  */
  function BuildJSEvents()
  {
    $str = '';

    if (is_array($this->mEvents))
    {
      $return_events = array('onkeypress', 'onkeyup', 'onkeydown');

      reset($this->mEvents);
      do
      {
        $event = strtolower(key($this->mEvents));

        if (in_array($event, $return_events))
          $str .= $event."=\"return ";
        else
          $str .= $event."=\"";

        $functions = current($this->mEvents);

        reset($functions);
        do
        {
          $function = current($functions);

          if (in_array($event, $return_events))
            $str .= preg_replace('/^return /i', '', trim($function))."(";
          else
            $str .= $function."(";

          if (is_array($this->mParameters))
          {
            reset($this->mParameters);
            do
            {
              $key        = key($this->mParameters);
              $parameters = current($this->mParameters);
              
              reset($parameters);
              for ($i = 0; $i < sizeof($parameters); $i++)
              {
                if ($key == $function)
                {
                  if (
                      $this->mForceDataTypeJS[$function][$i] || 
                      (substr($parameters[$i], 0, 4) == "this") || 
                      ($parameters[$i] == "event") ||
                      (substr($parameters[$i], 0, 8) == "document"))
                    $separator = "";
                  else
                    $separator = "'";
                  
                  if (($i + 1) == sizeof($parameters))
                    $str .= $separator.$parameters[$i].$separator;
                  else
                    $str .= $separator.$parameters[$i].$separator.", ";
                }
              }
            }
            while (next($this->mParameters));
          }//if (is_array($this->mParameters))

          if (in_array($event, $return_events))
            $str .= ") && ";
          else
            $str .= "); ";
        }
        while (next($functions));

        if (in_array($event, $return_events))
          $str = substr($str, 0, -4) . "; \" ";
        else
          $str .= "\" ";
      }
      while (next($this->mEvents));
    }//if (is_array($this->mEvents))

    return $str;
  }

  /**
  * Checks if the object is empty
  * @returns boolean
  */
  function IsEmpty()
  {
    return (boolean) ($this->mValue === '' || $this->mValue === null || $this->mValue === false);
  }

  /**
  * Checks if the object is valid - usually overriden
  * @returns boolean
  */
  function IsValid()
  {

    $ok = true;

    if ($this->mTestIfEmpty != 0)
      $ok = $ok && !$this->IsEmpty();

    return $ok;
  }

  /**
  * Checks if the object is disabled
  * @returns boolean
  */
  function IsDisabled()
  {
    $mDisabled = trim($this->mDisabled);

    if (!empty($mDisabled))
      return true;

    return false;
  }

  /**
  * Returns the object's regEx
  * @returns string
  */
  function GetRegEx($useLimit = true)
  {
      if ($useLimit)
        $regEx = "/^".$this->mRegEx."{".$this->mMinimumRepeat.",".$this->mMaximumRepeat."}$/";
      else
        $regEx = "/".$this->mRegEx."/";

    return $regEx;
  }


  /**
  * Builds onBlur empty test verification
  */
  function GetEmptyTest()
  {
    if ($this->mTestIfEmpty == 2)
      $out = " onBlur=\"javascript:test_if_empty(this, '$this->mTestIfEmptyMessage')\" ";

    return $out;
  }

  /**
  * Gets the object's value
  * @returns mixed
  */
  function GetValue($db = true)
  {
    return $this->mValue;
  }

  /**
  * Get's the object's maximum length part of the object's tag
  * @returns string
  */
  function GetMaxLength()
  {
    if ($this->mHasMaxLength)
      return "maxlength=\"$this->mMaxLength\" ";
    else
      return "";
  }

  /**
  * Builds the JS onSubmit validation code of the object
  * @returns string
  */
  function GetJSOnSubmit()
  {
    $out = "";

    if ($this->mTestIfEmpty != 0)
    {
      $out .= "  ".$this->mName."_ok = (!test_if_empty(document.".$this->mMainForm->mName.".".
              $this->mName.".value, '$this->mTestIfEmptyMessage', '".$this->mMainForm->mName.
              "','$this->mName'));\n";
      $out .= "  ok = (ok && ".$this->mName."_ok);\n\n";
      $out .= "  form_submitted = (form_submitted && ".$this->mName."_ok);\n\n";
    }

    return $out;
  }

  /**
  * Returns the CSS class part of the object's tag
  * @returns string
  */
  function GetCssClass()
  {
    $out = '';

    /*
      * Add css class
    */
//    if ($this->mCssclass)
      $out .= ' class="form ' .$this->mCssclass.'" ';

    /*
      * Checks if SetCssSize has been set
    */
    $style = '';

    if ($this->mWidth !== '') 
      $style .= 'width:'.(strpos($this->mWidth,'%') === false ? $this->mWidth.'px': $this->mWidth).';';
    if ($this->mHeight !== '')
      $style .= 'height:'.(strpos($this->mHeight,'%') === false ? $this->mHeight.'px': $this->mHeight).';';

    /*
      * If there is already a tag style set as Extra param
    */
    if($style !== '')
    {
      if (strpos($this->mExtra, 'style') !== false) 
      {
        $this->mExtra = preg_replace('/\'/', '"', $this->mExtra);
        $this->mExtra = preg_replace('/style( {1,})?=("|\')/', 'style="'.$style, $this->mExtra); //add as extra param
      }
      else //add in html as usual
        $out .= 'style="'.$style.'" ';
    }
    else //* Checks if only SetSize has been set
    {
      //textarea may use cols and rows
      if ($this->mSizeL || $this->mSizeC)
        $out .= ' rows="'.$this->mSizeL.'" cols="'.$this->mSizeC.' "';
    }

    return $out;
  }

  function GetTip()
  {
    $dsReturn = "";

    if ($this->mTip["tip"] != "")
    {
      $str = "";
      
      if (is_string($this->mTip["url"]))
        $str = "onClick=\"javascript: pop_open('" . $this->mTip["url"] . "', " . $this->mTip["width"] . ", " .  
                $this->mTip["height"]. ", 1, 'yes')\"";

      $dsReturn = "<a disabled=\"disabled\" tabindex=\"-1\" href=\"javascript:void(0);\" onMouseOver=\"stm(Tips['" . $this->mName . "'],Style[".(integer)$this->mIndTipStyle."], '".$this->mTip["twidth"]."', '".$this->mTip["theight"]."')\" onMouseOut=\"htm()\" $str>" .
                    "<div class=\"fa fa-lightbulb-o\" style=\"color: #e8a915; font-size: 18px;\" ></div>" .
                  "</a>";
    }

    if (str_value($this->mTooltip))
      $dsReturn .= "<script>$(\"[name='{$this->mName}']\").tooltip();</script>";

    return $dsReturn;
  }

  /**
  * Sets popup's the label of link
  * @param string $label
  * Esta função foi depreciada. Utilize a função AddPopUpLabel.
  */
  function SetPopUpLabel($label = "Search")
  {
    $this->AddPopUpLabel($label);
  }

  /**
  * Add popup's label for the links
  * @param string $label
  */
  function AddPopUpLabel($label)
  {
    $this->mPopUpLabel[] = $label;
    if ($label == 'Consultar' || $label == 'Adicionar')
    {
      $this->SetUseLinkImage(true);
      $this->SetDefaultLinkImage($label);
    }
  }
  
  /**
  * Sets the popup's link
  * This function is deprecated, use AddPopUpUrl instead
  * @param string $link
  */
  function SetPopUpUrl($link = false, $resizable = true, $autoclose = true)
  {
    $this->AddPopUpUrl($link, $resizable, $autoclose);
  }

  /**
  * Adds the popup's link
  * @param string $link Popup's link. Used to identify this popup link in other functions
  */
  function AddPopUpUrl($link = false, $resizable = true, $autoclose = true)
  {
    $this->mPopUpUrl[] = array($link, $resizable, $autoclose);
  }

  /*
  * Sets the form fields used in the popup
  * @param string  $popUp        Popup's link identifier
  * @param string  $fiels        Form field's name
  * @param string  $variableName If this parameter is set, it's used as variable name
  * @param boolean $fixedValue   If $variableName is set, controls whether the field 
  * parameter will be a variable or a fixed value
  */
  function AddPopUpField($popUp, $field, $variableName = false, $fixedValue = false)
  {
    if (!$variableName && is_bool($variableName))
      $variableName = $field;

    $this->mPopUpFields[$popUp][] = array($field, $variableName, $fixedValue);
  }

  /**
  * Sets the popup's height
  * @param int $height
  */
  function SetPopUpHeight($height = 500)
  {
    $this->mPopUpHeight = $height;
  }

  /**
  * Sets the popup's width
  * @param int $width
  */
  function SetPopUpWidth($width = 600)
  {
    $this->mPopUpWidth = $width;
  }

  /**
  * Controls if the links might be show wi images or labels
  * @param boolean $bool
  */
  function SetUseLinkImage($bool = false)
  {
    $this->mUseLinkImage = $bool;
  }

  /**
  * Sets default images for popup links
  */
  function SetDefaultLinkImage($label = false)
  {
    if ($label == 'Consultar')
      $this->SetLinkImage("Consultar", "img_consultar.gif", "fa fa-search");
    if ($label == 'Adicionar')
      $this->SetLinkImage("Adicionar", "img_adicionar.png", "fa fa-plus");
  }

  /**
  * Sets link images
  * @param string $link Link's description
  * @param string $img  Image
  */
  function SetLinkImage($link, $img, $class)
  {
    $this->mLinkImage[$link] = array($img, $class);
  }

  /*
  * Builds popups of object
  */
  function BuildPopUp()
  {
    if (is_array($this->mPopUpUrl))
    {
      for ($i = 0; $i < sizeof($this->mPopUpUrl); $i++)
      {
        if ($this->mPopUpLabel[$i] != "")
        {
          $id = $this->MakeId();
          $out .= "\n&nbsp;<a href=\"javascript:void(0);\" class='".$this->MakeClass()."' id='$id' onClick=\"javascript:if (top.pop) top.pop.close();";
          if ($this->mPopUpUrl[$i][2]) $out .= "top.pop = ";
          $out .= "pop_open('".$this->mPopUpUrl[$i][0];
          $out .= "?f_pop_form=".urlencode($this->mMainForm->mName);
          $out .= "&f_pop_field=".urlencode($this->mName);
          $out .= "&f_popup=true&use_popup=true'";

          $array = (is_array($this->mPopUpFields[$this->mPopUpUrl[$i][0]]) ? $this->mPopUpFields[$this->mPopUpUrl[$i][0]] : []);

          for ($j = 0; $j < sizeof($array); $j++)
          {
            $array_tmp = $array[$j];
            if ($array_tmp[2])
              $out .=  " + '&" . $array_tmp[1] . "=" . $array_tmp[0] . "'";
            else
              $out .=  " + '&" . $array_tmp[1] . "=' + document." . $this->mMainForm->mName . "." . $array_tmp[0] . ".value";
          }    
                    
          $rand = rand(0, 1000);

          $out .= ", " . $this->mPopUpWidth;
          $out .= ", " . $this->mPopUpHeight;
          $out .= ", '" . $this->mName.$rand."'";
          $out .= ", '" . (($this->mPopUpUrl[$i][1]) ? "yes" : "no") . "'";
          $out .= ");\">";

          if ($this->mUseLinkImage && ($this->mPopUpLabel[$i] == "Consultar" || $this->mPopUpLabel[$i] == "Adicionar"))
          {
            if (str_value($this->mLinkImage[$this->mPopUpLabel[$i]][1]))
            {
              $color = $this->mPopUpLabel[$i] == "Adicionar" ? "color: green;" : "";
              $out .= "<span class=\"" . $this->mLinkImage[$this->mPopUpLabel[$i]][1] . " glyphicon\" " .
                      "style=\"font-size: 16px; $color\" title=\"" . $this->mPopUpLabel[$i] . "\"></span></a>&nbsp;&nbsp;\n";
            }
            else
            {
              $out .= "<img src=\"" . JAGUAR_URL . "/img/".$this->mLinkImage[$this->mPopUpLabel[$i]][0].
                      "\" border=\"0\" width=\"16px;\" height=\"14px;\" alt=\"".$this->mPopUpLabel[$i]."\" title=\"".
                      $this->mPopUpLabel[$i]."\"></a>&nbsp;&nbsp;\n";
            }
          }
          else
          {
            $out .= $this->mPopUpLabel[$i]."</a>\n";

            if (($i + 1) < sizeof($this->mPopUpUrl))
              $out .= "&nbsp;|&nbsp;";
          }
        }//if ($this->mPopUpLabel[$i] != "")
      }//for ($i = 0; $i < sizeof($this->mPopUpUrl); $i++)
    }//if (is_array($this->mPopUpUrl))
    
    return $out;
  }

  /**
  * Sets if the form might be submitted with this field been invalid
  * @param mixed $value Object's value
  */
  function SetAllowInvalidSubmission($value = false)
  {
    $this->mAllowInvalidSubmission = $value;
  }

  /**
  * Sets the object's tip
  * @param string $name  Field's name Object's name
  */
  function SetTip($title, $tip, $url = false, $width = 600, $height = 450, $twidth = "", $theight = "")
  {
    $this->mTip["title"]  = $title;
    $this->mTip["tip"]    = $tip;
    $this->mTip["url"]    = $url;
    $this->mTip["width"]  = $width;
    $this->mTip["height"] = $height;
    $this->mTip["twidth"] = $twidth;
    $this->mTip["theight"]= $theight;
  }

  /**
  * Sets error message
  * @param string $error
  */
  function SetError($error = false)
  {
    $this->mError = ($error) ? $error : "Valor Inválido!";
  }

  /**
  * -  Seta o valor da mRegEx para depois validar no GetValue()
  * -  Seta um evento em JS onPressKey para validar o que esta sendo digitado
  * @param <int> $id
  * @param <array> $char
  */
  function RemoveSpecialChar($id = false, $char = true)
  {
    $this->mSpecialChar = true;

    if (is_bool($char) and $char)
      $this->mRegEx = "[^a-zA-Z0-9\\n @.!$#&*:?=+_,;%\/-]";
    elseif (is_array($char) and $id)
    {
      if ($id == 1)
        $this->mRegEx = "[^";
      if ($id == 2)
        $this->mRegEx = "[";

      foreach ($char as $value)
        $this->mRegEx .= "$value";

      $this->mRegEx .= "]";
    }

    $this->SetEvents("onKeyPress", "return format_regex");
    $this->SetParameters("return format_regex", "event");
    $this->SetParameters("return format_regex", "this");
    $this->SetParameters("return format_regex", str_replace("\"", htmlentities("\""), $this->mRegEx));
  }
  
  function GetMask($type)
  {
    if (!$type) return;
    
    $mask = "<script type=\"text/javascript\">";

    switch ($type)
    {
      case "money":
        $mask .= "$('*[name=" . $this->mName . "]').maskMoney({precision: " . $this->mDigits . ", allowNegative: '" . $this->mNegativeNumber . "'});";
      break;
    
      case "date":
        $mask .= " 
          id_use_day  = '" . $this->mUseDay  . "';
          id_use_year = '" . $this->mUseYear . "'; 
         
          mask = (!id_use_day ? '99/9999' : (!id_use_year ? '99/99' : '99/99/9999'));
          
          $('*[name=" . $this->mName . "]').mask(mask); ";
      break;
      case "cpf":
        $mask .= "$('*[name=" . $this->mName . "]').mask(\"999.999.999-99\");";
      break;
      case "cnpj":
        $mask .= "$('*[name=" . $this->mName . "]').mask(\"99.999.999/9999-99\");";
      break;
      case "number":
        $max = str_pad("9", ifnull($this->mMaxLength, ($this->mSize > 17 ? $this->mSize : null), 17)-1, "9", STR_PAD_RIGHT);
        $mask .= "
          $.mask.definitions['~'] = '[0-9".($this->mNegativeNumber ? "-" : "")."]';
          $('*[name=" . $this->mName . "]').mask(\"~?$max\", {placeholder: \"\"});
        ";
        if ($this->mNegativeNumber)
        {
          $mask .= "$('*[name=" . $this->mName . "]').live('blur', function(){ if ($(this).val()=='-') $(this).val(''); });";
          $mask .= "$('form').submit(function(){ if ($('*[name=" . $this->mName . "]').val()=='-') $('*[name=" . $this->mName . "]').val(''); });";
        }
      break;

      case "time":
        $mask .= "$('*[name=" . $this->mName . "]').mask('99:99')";
      break;
    
      case "placa":
        $mask .= "$('*[name=" . $this->mName . "]').mask(\"aaa-9*99\");";
      break;
    }
    
    $mask .= "</script>";
    
    return $mask;
  }

  function SetTooltip($text)
  {
    $this->mTooltip = $text;
    $this->mExtra  .= " title=\"{$text}\" ";
  }
}

/**
* Passwords objects creation class
*
* @author  Atua Sistemas de Informação
*/
class JFormPassword extends JFormObject
{
  /**
  * Stores the object's type
  * @var string
  */
  var $mType = "Password";

  /**
  * Stores whether javascript will use md5 hash function
  * @var boolean
  */
  var $mHashWithJS = true;

  /**
  * Stores whether the component will force a secure password
  * @var boolean
  */
  var $mForceSecurePassword = false;

  /**
  * Stores whether the component will 
  * @var boolean
  */
  var $mExposePassword = false;

  /**
  * Stores the object's regEx
  * @var string
  */
  var $mRegEx = "[a-zA-Z0-9!@#%\(\):.\-<>,\+=\*\-]";

  /**
  * Store the minnimum number of characters which might be used in a password 
  * @var integer
  */
  var $mMinimumRepeat = 6; 

  /**
  * Stores error message
  * @var string
  */
  var $mError = "Por Favor Verifique se o nível de segurança da senha não é BAIXA!";

  /**
  * Constructor
  * @param string $name  Field's name  Field's nameField's name
  * @param string $value Field's value Fields's default value
  */
  function __construct($name, $value = false)
  {
    $this->SetName($name);
    $this->mEmpty = $this->IsEmpty();
    $this->SetDefaultValue($value);
  }

  /**
  * Sets whether javascript will use md5 hash function
  * @param boolean $bool
  */
  function SetHashWithJS($bool=true)
  {
    $this->mHashWithJS = $bool;
  }

  /**
  * 
  * @param boolean $bool
  */
  function SetExposePassword($bool = true)
  {
    $this->mExposePassword = (boolean) $bool;
  }

  /**
  * Sets default JS functions for the object
  */
  function SetDefaultEvents()
  {
    parent::SetDefaultEvents();
    if ($this->mForceSecurePassword)
    {
      $this->SetEvents("onKeyUp", "validate_passwd");
      $this->SetParameters("validate_passwd", "this");
      $this->SetParameters("validate_passwd", $this->GetRegEx(false), true);
      $this->SetParameters("validate_passwd", $this->mMinimumRepeat);
    }
  }

  /**
  * Sets whether the object will force a safe password
  * @param boolean $bool
  */
  function ForceSecurePassword($bool=true)
  {
    $this->mForceSecurePassword = $bool;
    $this->SetTip("DICA", "Misture letras, números e caracteres como '@#%' na senha de no mínimo ".$this->mMinimumRepeat." caracteres para garantir sua segurança!");
  }

  /**
  * Checks if the object is valid
  */
  function IsValid()
  {
    if (!$this->mHashWithJS || !$this->mForceSecurePassword || parent::IsValid())
      return true;


    $value = $this->GetValue();
    if (preg_match($this->GetRegEx(), $value))
      return true;
    else
      $this->SetInvalidMessage("Caracteres inválidos ou não foi fornecido o mínimo de ".$this->mMinimumRepeat." caracteres!");

    return false;
  }

  /**
  * Builds the object's JS onSubmit validation code
  * @returns string
  */
  function GetJSOnSubmit()
  {
    $out = "";

    $out .= "  ".$this->mName."_ok = true; \n";

    if ($this->mForceSecurePassword)
    {
      $obj = "document." . $this->mMainForm->mName . "." . $this->mName;
      $out .= "  ".$this->mName."_ok = ".$this->mName."_ok && test_passwd(".$obj.", '".$this->GetLabel()."', '".$this->mError."');\n";
    }

    $out .= "  ok = ok && ".$this->mName."_ok;\n";

    $out .= parent::GetJSOnSubmit();
    return $out;
  }

  /**
  * Builds object's output
  * @returns string
  */
  function GetHtml()
  {
    $class = $this->MakeClass();
    $id    = $this->MakeId();

    $out  = "\n";
    $out .= "<input class=\"$class\" id=\"$id\" type=\"password\" name=\"$this->mName\" ";
    $out .= "value=\"" . ($this->mExposePassword ? $this->mValue : "") . "\" ";
    $out .= "size=\"$this->mSize\" $this->mDisabled $this->mAlign ";
    $out .= $this->GetMaxLength();
    //eventos JavaScript
    $this->SetDefaultEvents();
    $out .= $this->BuildJSEvents();

    $out .= $this->GetCssClass();
    $out .= " $this->mExtra>";

    if ($this->mExposePassword)
    {
      $out .= " <span id=\"{$id}_expose\" class=\"{$class}_expose fa fa-eye\" style=\"cursor: pointer;\"></span> ";
      $out .= "<script>$(document).ready(function(){";
      $out .= "$('#{$id}_expose, .{$class}_expose').click(function(){";
      $out .= "if ($(this).hasClass('fa-eye')){";
      $out .= "$(this).removeClass('fa-eye').addClass('fa-eye-slash');";
      $out .= "$('#{$id}, .{$class}').attr('type', 'text');";
      $out .= "}else{";
      $out .= "$(this).removeClass('fa-eye-slash').addClass('fa-eye');";
      $out .= "$('#{$id}, .{$class}').attr('type', 'password');";
      $out .= "}});});</script>";
    }

    $out .= $this->GetTip();
    $out .= "<div id='".$this->mName."_message' style='font-size:13px;'/>\n";

    return $this->GetRawHtml($out);
  }

}

/**
* Text objects creation class
*
* @author  Atua Sistemas de Informação
*/
class JFormText extends JFormObject
{
  /**
  * Stores object's type
  * @var string
  */
  var $mType    = "Text";

  /**
  * Controls Wheather SetUnformatted will be used by default (which redefines mUpper, mLower and mSpecialCharacter)
  * in pages where content is displayed it is better to deactivate this flag
  * and then set mUpper, mLower and mSpecialCharacter as preferred 
  * @var boolean
  */
  var $mUnformatted = true;

  /**
  * Controls if the object's value must be returned in uppercase letters
  * @var boolean
  */
  var $mUpper   = false;

  /**
  * Controls if the object's value must be returned in lowercase letters
  * @var boolean
  */
  var $mLower   = false;
  
  /**
  * Controls if the object's value must be trimmed before returning
  * @var boolean
  */
  var $mTrim;

  /**
  * Controls if the object's value must have special charecters converted before returning
  * @var boolean
  */
  var $mSpecialCharacter = false;

  /**
   *
   * @var boolean
   */
  var $mSpecialChar      = false;

  /**
  * Stores the object's regEx
  * @var string
  */
  var $mRegEx = ".*";

  /**
  * Constructor
  * @param string $name  Field's name  Field's nameField's name
  * @param string $value Field's value
  */
  function __construct($name, $value = false, $mUnformatted = true)
  {
    $this->SetName($name);
    $this->mEmpty = $this->IsEmpty();
    $this->SetDefaultValue($value);
    $this->SetSize();
    $this->mUnformatted = $mUnformatted;
    $this->SetUnformatted();

    $this->SetEvents("onKeyPress", "return rm_double_spaces");
    $this->SetParameters("return rm_double_spaces", "event");
    $this->SetParameters("return rm_double_spaces", "this");
    $this->SetParameters("return rm_double_spaces", str_replace("\"", htmlentities("\""), "[\\ ]{2,}"));
  }

  /**
  * Sets the object as disabled or not
  * @param boolean $disabled
  */
  function SetDisabled($disabled = false)
  {
    parent::SetDisabled($disabled);
    $this->mDisabled = ($disabled)? " readonly " : ""; 
    $this->SetCssClass("readonly");
  }

  /**
  * Calls the trim, upper and special characters conversion functions
  */
  function SetUnformatted()
  {
    if (!$this->mUnformatted) return;

    $this->SetTrim();
    $this->SetSpecialCharacter();
    $this->SetUpper();
  }

  /**
  * Sets if the object's value muight be trimmed before returning its value and how
  * @param string Trim method { left | all | right }
  */
  function SetTrim($trim = "all")
  {
    switch ($trim)
    {
      case "left" : $this->mTrim = $trim; break;
      case "right": $this->mTrim = $trim; break;
      case "all"  : 
      default     : $this->mTrim = "all"; break;
    }
  }

  /**
  * Sets if the object's value might be returned in uppercase letters
  *
  * If the $upper parameter is set to true, the mLower property is automatically
  * set to false
  *
  * @param boolean $upper
  */
  function SetUpper($upper = true)
  {
    $this->mUpper = is_bool($upper)?$upper:true;
    $this->mLower = ($this->mUpper && $this->mLower)?false:$this->mLower;
  }
 
  /**
  * Sets if the object's value might be returned in lowercase letters
  *
  * If the $upper parameter is set to true, the mUpper property is automatically
  * set to false
  *
  * @param boolean $lower
  */
  function SetLower($lower = true)
  {
    $this->mLower = is_bool($lower)?$lower:false;
    $this->mUpper = ($this->mLower&& $this->mUpper)?false:$this->mLower;
  }

  /**
  * Sets whether the special characters might be converted to commom characters or not
  *
  * For example, if the $specialCharacter parameter is true, characters like <b>â</b>
  * and <b>ü</b>will be converted to <b>a</b><b>u</b>, respectively.
  *
  * @param boolean $specialCharacter
  */
  function SetSpecialCharacter($specialCharacter = true)
  {
    $this->mSpecialCharacter = is_bool($specialCharacter)?$specialCharacter:true;
  }


  /**
  * Returns a string without accents
  * @returns string
  */
  function RemoveSpecialChars($value)
  {
      $trans = array( "Á" => "A", "Ã" => "A", "À" => "A", "Â" => "A", "Ä" => "A",
                      "É" => "E", "È" => "E", "Ê" => "E", "Ë" => "E",
                      "Í" => "I", "Ì" => "I", "Î" => "I", "Ï" => "I",
                      "Ó" => "O", "Õ" => "O", "Ò" => "O", "Ô" => "O", "Ö" => "O",
                      "Ú" => "U", "Ù" => "U", "Û" => "U", "Ü" => "U",
                      "Ç" => "C", "Ñ" => "N", "Ý" => "Y",
                      "á" => "a", "ã" => "a", "à" => "a", "â" => "a", "ä" => "a",
                      "é" => "e", "è" => "e", "ê" => "e", "ë" => "e",
                      "í" => "i", "ì" => "i", "î" => "i", "ï" => "i",
                      "ó" => "o", "õ" => "o", "ò" => "o", "ô" => "o", "ö" => "o",
                      "ú" => "u", "ù" => "u", "û" => "u", "ü" => "u",
                      "ç" => "c", "ñ" => "n", "ý" => "y", "ÿ" => "y",
                      "º" => "", "ª" => "", "°" => "");

      return implode("", array_filter(str_split(strtr($value, $trans)), function($str)
      {
        $nrAscii = ord($str);

        // de "espaço" até "~"
        if ($nrAscii >= 32 && $nrAscii <= 126) return true;

        return false;
      }));
  }

  /**
  * Gets object's value
  * @returns string
  */
  function GetValue($db = true)
  {
    $this->mValue = trim(preg_replace("/\\ {2,}/", " ", $this->mValue));

    if ($this->mSpecialCharacter)
      $this->mValue = $this->RemoveSpecialChars($this->mValue);

    if ($this->mSpecialChar)
      $this->mValue = preg_replace("/$this->mRegEx/", "", $this->mValue);
   
    if ($this->mUpper)
      $this->mValue = Convert_String($this->mValue, "upper");

    if ($this->mLower)
      $this->mValue = Convert_String($this->mValue, "lower");

    if ($this->mTrim != "")
    {
      switch ($this->mTrim)
      {
        case "left" : $this->mValue = ltrim($this->mValue); break;
        case "right": $this->mValue = rtrim($this->mValue); break;
        case "all"  : $this->mValue = trim($this->mValue);  break;
      }
    }

    while (substr($this->mValue, 0, 1) == "(" && substr($this->mValue, -1) == ")")
      $this->mValue = substr($this->mValue, 1, -1);
    
    return $this->mValue;
  }

  function GetJSOnSubmit()
  {
    $obj = "document." . $this->mMainForm->mName . "." . $this->mName;
    $var = $this->mName . "_value";

    $out = "";
    $out .= "  $var = $obj.value;\n";
    $out .= "  while ($var.substr(0, 1) == '(' && $var.substr($var.length-1, 1) == ')')\n";
    $out .= "    $var = $var.substring(1, $var.length-1);\n";
    $out .= "  $obj.value = $var;\n";
    $out .= parent::GetJSOnSubmit();

    return $out;
  }

  /**
  * Builds object's output
  * @returns string
  */
  function GetHtml()
  { 
    $out  = "\n";
    $out .= "<input class='" . $this->MakeClass() . "' id=\"" . $this->MakeId() . "\" type=\"text\" name=\"" . $this->mName . "\" " .
                   "value=\"" . $this->GetValue() . "\" " .
                   "size=\"" . $this->mSize . "\" " . $this->mDisabled;
    $out .= $this->GetCssClass() . $this->GetMaxLength();

    //javascript events
    $this->SetDefaultEvents();
    $out .= $this->BuildJSEvents();

    $out .= " ".$this->mExtra.">";
    $out .= $this->BuildPopUp()."\n";
    $out .= $this->GetTip();
    
    return $this->GetRawHtml($out);
  }
}

/**
* Files uploaders creation class
*
* @author  Atua Sistemas de Informação
*/
class JFormFile extends JFormObject
{
  /**
  * Stores object's type
  * @var string
  */
  var $mType = "File";

  /**
  * Stores Available mask types either for mask or restriction
  * @var array
  */
  var $mAvailableMask = array("php" => "application/x-httpd-php", "html" => "text/html",
                              "text" => "plain/text", "js" => "application/javascript",
                              "jpg" => "image/jpeg", "gif" => "image/gif" , "png" => "image/png" ,
                              "bmp" => "image/x-ms-bmp");

  /**
  * Stores Restricted types
  * @var array
  */
  var $mMaskRestricted;

  /**
  * Stores wheather the component will test a mask or a restriction  
  * @var array
  */
  var $mTestType;

  var $mUseJqueryUpload = false;

  /**
  * Constructor
  * @param string $name  Field's name  Field's nameField's name
  * @param string $value Field's value Field's value
  */
  function __construct($name, $value = false)
  {
    $this->SetName($name);
    $this->mEmpty = $this->IsEmpty();
    $this->SetDefaultValue($value);
  }

  /**
  * Sets object's names
  * @param string $name  Field's name Field's name
  */
  function SetName($name)
  {
    $this->mName = $name;
    $this->mValue = $_FILES[$name]["tmp_name"];
    $this->mValueName = $_FILES[$name]["name"];
    $this->mValueSize = $_FILES[$name]["size"];
    $this->mValueType = $_FILES[$name]["type"];
  }

  /*
    * Test if informed types are avaiable
    @param array $type
  */
  function TestAvailability(&$type)
  {

    //TODO error handling
    //
    if ( !(is_array($type)) )
      exit("Parametro deve Ser um Array"); 

    //Get Available items
    //
    $available = array_keys($this->mAvailableMask);

    //Test if the type informed is in $this->mAvailableMask array
    //
    foreach($type as $key => $name)
    {
      if (!in_array($name, $available))
      {
        //Get the error string
        //
        $out = "Restrições suportadas como parâmetro São:<br><br>"; 
        foreach ($this->mAvailableMask as $type => $mime) 
          $out .= "<b>".$type."</b>,";

        //TODO error handling
        //
        exit($out);
      }

      $type[$key] = strtr($name, $this->mAvailableMask);
    }

  }

  function SetRestriction($type)
  {
    $this->TestAvailability($type);
    $this->mMaskRestricted = $type;

    //Set that will be testing a Restriction
    //
    $this->mTestType = "Restriction";
  }

  function SetMask($type)
  {
    if ($type == "images")
      $type = array("jpg", "png", "bmp", "gif");

    $this->TestAvailability($type);

    $this->mMaskRestricted = $type;

    //Set that will be testing the Mask
    //
    $this->mTestType = "Mask";
  }

  function IsValid()
  {
    //Test if there is at least a file sent
    //
    $file = &current($_FILES);
    if (!$file["name"])
      return true;

    //Test Restricted Or Masked Types
    //Only the parameter change happens 'cause the algorithm is almost the same
    //
    if ($this->mTestType == "Restriction")
      return $this->TestIfValid();
    else
      return $this->TestIfValid(true);
  }

  function TestIfValid($testIfIs = false)
  {
    //Search for restricted file types
    //
    if ($this->mMaskRestricted === null)
      return true;

    $isLegal = true;

    foreach($_FILES as $file)
    {
      //More than one file in the form and some were not filled
      //
      if (!$file["name"] || !is_uploaded_file($file["tmp_name"]))
        continue;
     
      //Gets the Mime Type
      //
      $finfo = finfo_open(FILEINFO_MIME_TYPE);
      $mime  = finfo_file($finfo, $file["tmp_name"]);
      //Some types must be validated through the mime, but some like "javascript only" files are harder to detect,
      //so the validation is made only over the extension type
      //
      if ( in_array($mime, array("application/x-httpd-php", "image/png", "image/jpeg", "image/gif", "image/x-ms-bmp") ) )
        $isLegal = $isLegal && $this->TestRestriction($mime, $testIfIs);
      else
        $isLegal = $isLegal && $this->TestRestriction($file["type"], $testIfIs);

      //TODO error handling
      //Handle the error
      //return false
      //
      if (!$isLegal)
        exit("<hr>Desculpe, Não é possível Enviar Arquivos deste Tipo: <b>".$file["name"]."</b><br><a href='".$_SERVER["HTTP_REFERER"]."'>Voltar</a>");

    }

    return true;
  }

  /*
    * Tests if a file type is restricted or masked
    * if $testIfIs is true, it will be testing the mask
    * if $testIfIs is false, it will be testing the restriction
    @param string $type
    @param boolean $testIfIs
  */
  function TestRestriction($type, $testIfIs = false)
  {
    //Get Available items
    //
    if ( in_array($type, $this->mMaskRestricted) )
      return $testIfIs;

    return !$testIfIs;
  }

  /**
  * Gets object's value
  * @param string $tipo Controls what value might be retrieved. Eg.: { tmp | size | type | name }
  */
  function GetValue($type = "name")
  {
    switch ($type)
    {
      case "tmp":
        return $this->mValue;
        break;
      case "size":
        return $this->mValueSize;
        break;
      case "type":
        return $this->mValueType;
        break;
      case "name":
      default:
        return $this->mValueName;
        break;
    }
  }

  function SetJQueryUploadFile($nmArquivo, $dsCaminho, $linkRedirecionar, $tiposArquivos = "*")
  {
    $fileSize = converte_bytes(ini_get("upload_max_filesize"));
    $js = "
      $('#linha_upload').hide();

      var uploadObj = $('#".$this->MakeId("f_nm_arquivo")."').uploadFile({
        url:'../lib/jaguar/jquery/jquery_file_upload/upload.php',
        fileName:'myfile',
        multiple: true,
        autoSubmit: false,
        allowedTypes: '".$tiposArquivos."',
        formData: {'nm_arquivo':'".$nmArquivo."_', 'ds_caminho': '".$dsCaminho."'},
        maxFileSize:$fileSize,
        showProgress: true,
        showDone: false,
        onSelect:function(files)
        {
          $('#linha_upload').show();
          return true;
        },
        afterUploadAll:function()
        {
          location.href=\"$linkRedirecionar\";
        },
        dragDropStr: '<span><b>Arraste e solte arquivos</b></span>',
        abortStr:'Cancelar',
        cancelStr:'Cancelar',
        doneStr:'Completo',
        extErrorStr:'Tipo de arquivo nÃ£o suportado. ExtenÃ§Ãµes permitidas:',
        sizeErrorStr:'Arquivo ultrapassou tamanho maximo. Tamanho maximo permitido:'
      });

      $('#f_button').click(function(){
        uploadObj.startUpload();
      });
    ";

    $this->AddJSOnLoad($js);
    $this->mUseJqueryUpload = true;
  }


  /**
  * Builds object's output
  * @returns string
  */
  function GetHtml()
  {
    $out  = "\n";
    $out .= "<input style=\"float: left;\" class='".$this->MakeClass()."' id=\"".$this->MakeId()."\" type=\"file\" name=\"$this->mName\" value=\"".$this->GetValue()."\" ";
    $out .= "size=\"$this->mSize\" $this->mDisabled ";
    $out .= $this->GetCssClass().$this->GetMaxLength();

    //eventos JavaScript
    $this->SetDefaultEvents();
    $out .= $this->BuildJSEvents();

    $out .= " $this->mExtra>\n";
    $out .= $this->GetTip();

    if ($this->mUseJqueryUpload)
    {
      $out .= "<tr id=\"linha_upload\" class=\"rowodd\" onmouseover=\"javascript:this.className='roweven-hi'\" onmouseout=\"javascript:this.className='roweven'\">";
      $out .= "<td colspan=2>";
      $button = new JFormButton("f_button", "Realizar Upload");
      $button->MakeId("f_button");
      $out .= $button->GetHtml();
      $out .= "</td></tr>";
    }

    return $this->GetRawHtml($out);
  }

  /**
  * Builds the JS onSubmit validation code of the object
  * @returns string
  */
  function GetJSOnSubmit()
  {
    $out = "";

    if ($this->mTestIfEmpty != 0)
    {
      $out .= "  ".$this->mName."_ok = (!test_if_empty(document.".$this->mMainForm->mName.".".
              $this->mName.".value, '$this->mTestIfEmptyMessage', '".$this->mMainForm->mName.
              "','$this->mName', 'File'));\n";
      $out .= "  ok = (ok && ".$this->mName."_ok);\n\n";
      $out .= "  form_submitted = (form_submitted && ".$this->mName."_ok);\n\n";
    }

    return $out;
  }

}

/**
* Number objects creation class
*
* @author  Atua Sistemas de Informação
* @package Jaguar
*/
class JFormNumber extends JFormText
{
  /**
  * Stores object's type
  * @var string
  */
  var $mType = "Number";

  /**
  * Stores the first comparison value
  * @var float
  */
  var $mValue1    = "";

  /**
  * Stores the second comparison value
  * @var float
  */
  var $mValue2    = "";

  /**
  * Stores the comparison's condition
  * @var string
  */
  var $mCondition = "";

  /**
  * Stores error message
  * @var string
  */
  var $mError     = "Valor Inválido!";
  
  /**
  * Stores accept negative numbers
  * @var int
  */
  var $mNegativeNumber = 0;

  /**
  * Constructor
  * @param string $name  Field's name  Field's nameFields's name 
  * @param string $value Field's value Field's value
  */
  function __construct($name, $value = false)
  {
    $this->SetName($name);
    $this->mEmpty = $this->IsEmpty();
    $this->SetSize(10);
    $this->SetDefaultValue($value);
  }

  /**
  * Sets the first comparison value
  * @param string $value Field's value1 Value
  * @param string $from   Current format. { pt_BR | sys | us }
  * @param string $to     Storage format. { pt_BR | sys | us }
  */
  function SetValue1($value1 = false)
  {
    $this->mValue1 = ($value1 !== false)? $value1 : "";
  }

  /**
  * Sets the second comparison value
  * @param string $value Field's value1 Value
  * @param string $from   Current format. { pt_BR | sys | us }
  * @param string $to     Storage format. { pt_BR | sys | us }
  */
  function SetValue2($value2 = false)
  {
    $this->mValue2 = ($value2 !== false) ? $value2 : "";
  }

  /**
  * Sets the comparison's condition
  * @param string $condition { "=" | "<" | "<=" | ">" | ">=" }
  */
  function SetCondition($condition = false)
  {
    $this->mCondition = ($condition)?$condition:"";
  }
  
  /**
  * Sets the mNegativeNumber 
  * @param int {0, 1}
  */
  function SetNegativeNumber($value = 1)
  {
    $this->mNegativeNumber = $value;
  }

  /**
  * Sets default JS functions for JFormNumber objects
  */
  function SetDefaultEvents()
  {
    $mValue1 = $this->mValue1;

    if (is_object($this->mValue1))
      $mValue1 = "document." . $this->mMainForm->mName . "." . $this->mValue1->mName . ".value";

    if (strlen($mValue1) && (strlen($this->mCondition) || strlen($this->mValue2)))
    {
      $this->SetEvents("onBlur", "test_value");
      $this->SetParameters("test_value", "this");
      $this->SetParameters("test_value", "this.value");
      $this->SetParameters("test_value", $mValue1);
      $this->SetParameters("test_value", $this->mValue2);
      $this->SetParameters("test_value", $this->mCondition);
      $this->SetParameters("test_value", $this->mError);
      $this->SetParameters("test_value", $this->mMainForm->mName);
      $this->SetParameters("test_value", true);
    }
  }

  /**
  * Checks if the object's value is valid
  * @returns boolean
  */
  function IsValid()
  {
    $ok = true;

    if ($this->mTestIfEmpty != 0)
      $ok = $ok && !$this->IsEmpty();
    
    if (!$this->mNegativeNumber && $this->mValue < 0)
      $ok = false;

    $validate = ( $this->mValue1  && ( $this->mCondition || $this->mValue2 ) );
    
    if ($validate && $this->mValue)
    {
      $value = $this->mValue;

      $value1 = is_object( $this->mValue1 ) ? $this->mValue1->GetValue() : $this->mValue1;
      $value2 = is_object( $this->mValue2 ) ? $this->mValue2->GetValue() : $this->mValue2;

      if ($value2)
      {
        $ok = $ok && ($value >= $value1 &&
                      $value <= $value2)?true:false;
      }
      else
      {
        switch($this->mCondition)
        {
          case "=":  $ok = $ok && ($value == $value1); break;
          case "<":  $ok = $ok && ($value < $value1);  break;
          case "<=": $ok = $ok && ($value <= $value1); break;
          case ">":  $ok = $ok && ($value > $value1);  break;
          case ">=": $ok = $ok && ($value >= $value1); break;
        }
      }
    }

    return $ok;
  }

  /**
  * Builds the object's JS onSubmit validation code
  * @returns string
  */
  function GetJSOnSubmit()
  {
    $out = "";

    $out .= "  ".$this->mName."_ok = true; \n";

    $validate = ( (is_string($this->mValue1)) && (strlen($this->mValue1) > 0) &&
                ( $this->mCondition || (strlen($this->mValue2) > 0) ) );

    if (($this->mTestIfEmpty != 0) || $validate)
      $out .= "  ".$this->mName."_ok = true; \n";

    if ($this->mTestIfEmpty != 0)
      $out .= "  ".$this->mName."_ok = ".$this->mName."_ok && ".
              "(!test_if_empty(document.".$this->mMainForm->mName.".".
              $this->mName.".value, '$this->mTestIfEmptyMessage', '".
              $this->mMainForm->mName."','$this->mName'));\n";

    if ($validate)
    {
      $out .= "  ".$this->mName."_ok = ".$this->mName."_ok && (test_value(";
      $out .= "'$this->mName', document.".$this->mMainForm->mName.".".$this->mName.".value, ";
      $out .= "'$this->mValue1', '$this->mValue2', '$this->mCondition', ";
      $out .= "'$this->mError', '".$this->mMainForm->mName."', true ));\n";
    }

    if ((strlen($this->mCondition) > 0) && (is_object($this->mValue1)))
    {
      $out .= "  ".$this->mName."_ok = ".$this->mName."_ok && (test_value(";
      $out .= "'$this->mName', document.".$this->mMainForm->mName.".".$this->mName.".value, ";
      $out .= "document.".$this->mMainForm->mName.".".$this->mValue1->mName.".value, '', ";;
      $out .= "'$this->mCondition', '$this->mError', '".$this->mMainForm->mName . "', true));\n";
    }

    if (($this->mTestIfEmpty != 0) || $validate)
    {
      $out .= "  ok = ok && ".$this->mName."_ok;\n";
      $out .= "  form_submitted = (form_submitted && ".$this->mName."_ok);\n\n";
    }

    return $out;
  }

  /**
  * Builds object's output
  * @returns string
  */
  function GetHtml()
  {
    $out  = "\n";
    $out .= "<input class='".$this->MakeClass()."' id=\"".$this->MakeId()."\" type=\"text\" name=\"".$this->mName."\" ".
                   "value=\"".$this->GetValue()."\" ".
                   "size=\"".$this->mSize."\" ".$this->mDisabled;
    if ($this->mHasMaxLength)
      $out .= " MaxLength=\"".$this->mMaxLength."\" ";
    $out .= $this->GetCssClass();

    //javascript events
    parent::SetDefaultEvents();
    $this->SetDefaultEvents();
    $out .= $this->BuildJSEvents();

    $out .= " ".$this->mAlign." ".$this->mExtra.">";
    $out .= $this->BuildPopUp()."\n";
    $out .= $this->GetTip();
    $out .= $this->GetMask('number');
    
    return $this->GetRawHtml($out);
  }
}

/**
* Formatted number objects creation class
*
* @author  Atua Sistemas de Informação
*/
class JFormFormattedNumber extends JFormText
{
  /**
  * Stores object's type
  * @var string
  */
  var $mType      = "FormattedNumber";

  /**
  * Stores the number of digits after the decimal separator
  * @var int
  */
  var $mDigits    = 2;

  /**
  * Stores the first comparison value
  * @var float
  */
  var $mValue1    = "";

  /**
  * Stores the second comparison value
  * @var float
  */
  var $mValue2    = "";

  /**
  * Stores the comparison's condition
  * @var string
  */
  var $mCondition = "";

  /**
  * Stores error message
  * @var string
  */
  var $mError     = "Valor Inválido!";

  /**
  * Stores the formatting type
  * @var string
  */
  var $mFormat    = "pt_BR";

  /**
  * Stores display size
  * @var string
  */
  var $mDisplaySize = 10;

  /**
  * Controls whether the object requires special parameters on grid's SetValue call
  * @var boolean
  */
  var $mGridParameters = array("pt_BR", "pt_BR");
  
  /**
  * Stores accept negative numbers
  * @var int
  */
  var $mNegativeNumber = false;

  /**
  * Constructor
  * @param string $name  Field's name  Field's nameField's name
  * @param string $value Field's value Field's value
  */
  function __construct($name = false, $value = false)
  {
    $this->SetName($name);
    $this->mEmpty = $this->IsEmpty();
    $this->SetDefaultValue($value);
    $this->SetSize(15);
    $this->SetAlign();
  }

  /**
  * Sets the mNegativeNumber 
  * @param int {0, 1}
  */
  function SetNegativeNumber($value = 1)
  {
    $this->mNegativeNumber = $value;
  }
  
  /**
  * Sets default JS functions for JFormFormattedNUmber objects
  */
  function SetDefaultEvents()
  {
    if (($this->mValue1 != "") && 
         ($this->mCondition || ($this->mValue2 != "")))
    {
      $this->SetEvents("onBlur", "test_value"); 
      $this->SetParameters("test_value", "this");
      $this->SetParameters("test_value", "this.value");
      if (is_object($this->mValue1))
        $this->SetParameters("test_value", "document." . $this->mMainForm->mName . "." . $this->mValue1->mName . ".value");
      else
        $this->SetParameters("test_value", $this->mValue1);
      $this->SetParameters("test_value", $this->mValue2);
      $this->SetParameters("test_value", $this->mCondition);
      $this->SetParameters("test_value", $this->mError);
      $this->SetParameters("test_value", $this->mMainForm->mName);
      if (!$this->mDigits)
        $this->SetParameters("test_value", true);
    }
  }

  /**
  * Gets object's value
  * @param boolean $db   Defines if the value must formatted before returning
  * @param string  $from Defines the current value format. { pt_BR | sys | us }
  * @param string  $to   Defines the desired value format. { pt_BR | sys | us }
  */
  function GetValue($db = false, $from = "pt_BR", $to = "sys")
  {
    if ($db)
      $value = Format_Number($this->mValue, $this->mDigits, $from, $to);
    else
      $value = $this->mValue;
    
    return $value;
  }

  /**
  * Sets object's default value
  * @param string $value Field's value Number's value
  * @param string $from  Number's current format. { pt_BR | sys | us }
  * @param string $to    Number's desired format. { pt_BR | sys | us }
  */
  function SetDefaultValue($value = false, $from = "sys", $to = "pt_BR")
  {
    if (empty($this->mValue) and ((string)$this->mValue != "0"))  
      $this->SetValue($value, $from, $to);
  }

  /**
  * Sets object's value
  * @param string $value Field's value Number's value
  * @param string $from  Number's current format. { pt_BR | sys | us }
  * @param string $to    Number's desired format. { pt_BR | sys | us }
  */
  function SetValue($value = false, $from = "sys", $to = "pt_BR")
  {
    $this->mValue = ($value !== false || (!is_bool($value)))?
                    Format_Number($value, $this->mDigits, $from, $to):"";
                    
    $this->SetFormat($to);
  }

  /**
  * Sets object's format
  * @param string $format. { pt_BR | sys | us }
  */
  function SetFormat($format)
  {
    $this->mFormat = $format;
  }

  /**
  * Sets object's display size
  * @param displaySize integer
  */
  function SetDisplaySize($displaySize)
  {
    $this->mDisplaySize = $displaySize;
  }

  /**
  * Sets the first comparison value
  * @param string $value Field's value1 Value
  * @param string $from   Current format. { pt_BR | sys | us }
  * @param string $to     Storage format. { pt_BR | sys | us }
  */
  function SetValue1($value1 = false, $from = "sys", $to = "pt_BR")
  {
    if (is_object($value1))
      $this->mValue1 = $value1;
    else
      $this->mValue1 = ($value1)?Format_Number($value1, $this->mDigits, $from, $to):"";
  }

  /**
  * Sets the second comparison value
  * @param string $value Field's value1 Value
  * @param string $from   Current format. { pt_BR | sys | us }
  * @param string $to     Storage format. { pt_BR | sys | us }
  */
  function SetValue2($value2 = false, $from = "sys", $to = "pt_BR")
  {
    $this->mValue2 = ($value2 !== false)?Format_Number($value2, $this->mDigits, $from, $to):"";
  }

  /**
  * Sets the comparison's condition
  * @param string $condition { "=" | "<" | "<=" | ">" | ">=" }
  */
  function SetCondition($condition = false)
  {
    $this->mCondition = ($condition)?$condition:"";
  }

  /**
  * Sets the precision of the formatting
  * @param int $size   Number's length
  * @param int $digits Number of digits after decimal separator
  */
  function SetPrecision($size = 15, $digits = 2)
  {
    $this->mSize   = $size;
    $this->mDigits = $digits;

    $total = 0;

    if ($this->mDigits)
      $total++;
      
    if ($this->mSize)
      $total += (integer)(($this->mSize - $this->mDigits) / 3);
      
    if (($this->mSize - $this->mDigits) % 3 == 0)
      $total--;

    $this->mMaxLength = $this->mSize + $total;

    if ($this->mValue)
      $this->SetValue(Format_Number($this->mValue, $this->mDigits));
  }

  /**
  * Checks if the object's value is valid
  * @returns boolean
  */
  function IsValid()
  {
    $ok = true;

    if ($this->mTestIfEmpty != 0)
      $ok = $ok && !$this->IsEmpty();
    
    if (!$this->mNegativeNumber && $this->mValue < 0)
      $ok = false;

    $validate = ( $this->mValue1 && ( $this->mCondition || $this->mValue2 ) );

    if ($validate && !$this->IsEmpty())
    {
      $value = Format_Number($this->mValue, $this->mDigits, $this->GetFormat(), "sys");
      if (is_object($this->mValue1))    
        $value1 = Format_Number($this->mValue1->GetValue(), $this->mDigits, $this->GetFormat(), "sys");
      else
        $value1 = Format_Number($this->mValue1, $this->mDigits, $this->GetFormat(), "sys");

      if ( strlen($this->mValue2) > 0 )
      {
        $value2 = Format_Number($this->mValue2, $this->mDigits, $this->GetFormat(), "sys");

        $ok = $ok && ($value >= $value1 &&
                      $value <= $value2)?true:false;
      }
      else
      {
        switch($this->mCondition)
        {
          case "=":  $ok = $ok && ($value == $value1); break;
          case "<":  $ok = $ok && ($value < $value1);  break;
          case "<=": $ok = $ok && ($value <= $value1); break;
          case ">":  $ok = $ok && ($value > $value1);  break;
          case ">=": $ok = $ok && ($value >= $value1); break;
        }
      }
    }

    return $ok;
  }

  /**
  * Gets the formatting type 
  */
  function GetFormat()
  {
    return $this->mFormat;
  }

  /**
  * Builds the object's JS onSubmit validation code
  * @returns string
  */
  function GetJSOnSubmit()
  {
    $out = "";

    $out .= "  ".$this->mName."_ok = true; \n";

    $validate = ( $this->mValue1 && (is_string($this->mValue1)) && ( $this->mCondition || $this->mValue2 ) );

    //Verify if the value will be validated in onSumit event
    if (($this->mTestIfEmpty != 0) || $validate)
      $out .= "  ".$this->mName."_ok = true; \n";

    if ($this->mTestIfEmpty != 0)
    {
      $out .= $this->mName."_ok = ".$this->mName."_ok && ";
      $out .= "(!test_if_empty(document.".$this->mMainForm->mName.".";
      $out .=  $this->mName.".value, '$this->mTestIfEmptyMessage', '";
      $out .=  $this->mMainForm->mName."','$this->mName'));\n";
    } 

    if ($validate)
    {
      $out .= "  ".$this->mName."_ok = ".$this->mName."_ok && (test_value(";
      $out .= "'$this->mName', document.".$this->mMainForm->mName.".".$this->mName.".value, ";
      $out .= "'$this->mValue1', '$this->mValue2', '$this->mCondition', ";
      $out .= "'$this->mError', '".$this->mMainForm->mName."'";
      if (!$this->mDigits)
        $out .= ", true";
      $out .= "));\n";
    }

    if ((strlen($this->mCondition) > 0) && (is_object($this->mValue1)))
    {
      $out .= "  ".$this->mName."_ok = ".$this->mName."_ok && (test_value(";
      $out .= "'$this->mName', document.".$this->mMainForm->mName.".".$this->mName.".value, ";
      $out .= "document.".$this->mMainForm->mName.".".$this->mValue1->mName.".value, '', ";
      $out .= "'$this->mCondition', '$this->mError', '".$this->mMainForm->mName."'";  
      if (!$this->mDigits)
        $out .= ", true" ; 
      $out .= "));\n";
    }

    if (($this->mTestIfEmpty != 0) || $validate ||
        ((strlen($this->mCondition) > 0) && (is_object($this->mValue1))))
    {
      $out .= "  ok = ok && ".$this->mName."_ok;\n";
      $out .= "  form_submitted = (form_submitted && ".$this->mName."_ok);\n\n";
    }

    return $out;
  }

  /**
  * Builds object's output
  * @returns string
  */
  function GetHtml()
  {
    $this->mMaxLength = strlen(trim($this->mMaxLength)) > 0 ? $this->mMaxLength : $this->mSize;
    
    $out  = "\n";
    $out .= "<input class=\"".$this->MakeClass()."\" id=\"".$this->MakeId()."\" type=\"text\" name=\"".$this->mName."\" ".
                   "value=\"".$this->GetValue()."\" ".
                   "size=\"".$this->mDisplaySize."\" ".
                   "maxlength=\"".$this->mMaxLength."\" ".$this->mAlign." ";
    $out .= $this->GetCssClass().$this->mDisabled;

    //javascript events
    parent::SetDefaultEvents();
    $this->SetDefaultEvents();
    $out .= $this->BuildJSEvents();

    $out .= " ".$this->mExtra.">";
    $out .= $this->BuildPopUp()."\n";
    $out .= $this->GetTip();
    $out .= $this->GetMask('money');

    return $this->GetRawHtml($out);
  }
}

/**
* Formatted numbers creation class
*
* This class is manteined for backward compatibility reasons. It will soon be
* deprecated.
*
* @author  Atua Sistemas de Informação
*/
class JFormFormatedNumber extends JFormFormattedNumber
{
  /**
  * Constructor
  * @param string $name  Field's name  Field's nameField's name
  * @param string $value Field's value Field's value
  */
  function JFormFormattedNumber($name = false, $value = false)
  {
    $this->SetName($name);
    $this->mEmpty = $this->IsEmpty();
    $this->SetDefaultValue($value);
    $this->SetPrecision();
    $this->SetAlign();
  }
}

require_once("JFormDate.php");

require_once("JFormTime.php");

class JFormTimeStamp extends JFormObject
{
  var $mType      = "Timestamp";
  var $mIndex;
  var $mObjects = array();
  var $mError     = "";
  var $mDate; //date instance
  var $mTime; //time instance

  var $mTimeStamp1;
  var $mTimeStamp2;
  var $mUseDatePicker = true;
  var $mUseLinkHoraAtual = false;
  
  /**
  * Stores the type style to DatePicker
  * 1 = JQuery
  * 0 = old model
  * @var int
  */
  var $mTypeDatePicker = 1;

  /**
  * Sets whether javascript will force that date AND time might be filled
  * @var boolean
  */
  var $forceBothArguments = true;

  function __construct($name = false, $value = false)
  {
    $this->mIndex = 0;
    $this->mDate = new JFormDate($name);
    $this->AddObject($this->mDate);

    $this->mTime = new JFormTime($name."_tm");
    $this->AddObject($this->mTime);

    $this->SetName($name);
    $this->mEmpty = $this->IsEmpty();
    $this->SetDefaultValue($value);

    $this->SetTestOnBlur(true);
  }

  /**
  * Sets whether the component shows a javascript date picker
  * @param boolean $use
  */
  function UseDatePicker($use = true)
  {
    $this->mUseDatePicker = (boolean) $use;
  }

  /**
  * cria o link para setar hora atual com javascript
  * @param boolean $use
  */
  function UseLinkHoraAtual($use = true)
  {
    $this->mUseLinkHoraAtual = (boolean) $use;
  }

  /**
  * Sets default JS functions for JFormTime objects
  */
  function SetDefaultEvents()
  {
    if ($this->mTestOnBlur && $this->mTimeStamp1 && ($this->mCondition || $this->mTimeStamp2) )
    {
      $form = "document.".$this->mMainForm->mName;

      $this->mTime->SetEvents("onBlur", "test_timestamp");
      $this->mTime->SetParameters("test_timestamp", $form.".".$this->mDate->mName.".value +' '+this.value");
      if (is_object($this->mTimeStamp1))
      {
        $ts = $form.".".$this->mTimeStamp1->mName.".value +' '+".$form.".".$this->mTimeStamp1->mTime->mName.".value";
        $this->mTime->SetParameters("test_timestamp", $ts);
      }
      else
        $this->mTime->SetParameters("test_timestamp", $this->mTimeStamp1);
      $this->mTime->SetParameters("test_timestamp",   $this->mTimeStamp2);
      $this->mTime->SetParameters("test_timestamp",   $this->mCondition);
      $this->mTime->SetParameters("test_timestamp",   $this->mError);
      $this->mTime->SetParameters("test_timestamp",   $this->mInterval);
      $this->mTime->SetParameters("test_timestamp",   $this->GetLabel());
      $this->mTime->SetParameters("test_timestamp",   "this");
    }

  }

  /**
  * Sets the comparison's  condition
  * @param string $condition { "=" | "<" | "<=" | ">" | ">=" }
  */
  function SetCondition($condition = false)
  {
    $this->mDate->SetCondition( $condition );
    $this->mTime->SetCondition( $condition );
    $this->mCondition = ($condition) ? $condition : "";
  }

  function AddObject(&$what)
  {
    $this->mObjects[$this->mIndex] = &$what; 
    $this->mIndex++;
  }

  function SetDefaultValue($value = false)
  {
    if ($value)
    {
      $values_arr = explode(" ", $value);
      $this->SetDateDefaultValue($values_arr[0]);
      $this->SetTimeDefaultValue($values_arr[1]);
    }
  }

  /**
  * Sets the date default value
  * @param string $value Field's value
  * @param string $from  Date's current format
  * @param string $to    Date's storage format
  */
  function SetDateDefaultValue($value = false, $from = "sys", $to = "pt_BR")
  {
    $this->mDate->SetDefaultValue($value, $from , $to);
  }

  /**
  * Sets time default value
  * @param string $value Field's value
  */
  function SetTimeDefaultValue($value)
  {
    $this->mTime->SetDefaultValue($value); 
  }

  /**
  * Sets the date value
  * @param string $value Field's value
  * @param string $from  Date's current format
  * @param string $to    Date's storage format
  */
  function SetDateValue($value = false, $from = "sys", $to = "pt_BR")
  {
    $this->mDate->SetValue($value, $from , $to);
  }

  /**
  * Sets time value
  * @param string $value Field's value
  */
  function SetTimeValue($value)
  {
    $this->mTime->SetValue($value); 
  }

  /**
  * Sets the object as disabled or not
  * @param boolean $disabled
  */
  function SetDisabled($disabled = false)
  {
    $this->mDate->SetDisabled($disabled);
    $this->mTime->SetDisabled($disabled);
  }

  function SetValue($value = false) 
  {
    $args = func_get_args();
    $from = $args[1] ? $args[1] : "sys";
    $to   = $args[2] ? $args[2] : "pt_BR";
    
    $values_arr = explode(" ", $value);
    $this->mDate->SetValue($values_arr[0], $from, $to);
    $this->mTime->SetValue($values_arr[1]);
  }

  /**
  * Sets whether javascript will force that date AND time might be filled
  * @param boolean $bool 
  */
  function ForceBothArguments($bool=true)
  {
    $this->forceBothArguments = $bool;
  }

  /**
  * Add JS functions to events
  * @param string $event    Event's name. Eg.: onBlur, onFocus
  * @param string $function Function's name
  * @param string $which which component to reach(time or date)
  */
  function SetEvents($event, $function, $which='time')
  {
    switch ($which)
    {
      case 'date':
        $this->mDate->SetEvents($event, $function);
      break;
      default:
        $this->mTime->SetEvents($event, $function);
    }
  }

  /**
  * Adds parameters to JS functions associated to events
  * @param string $function  Function's name
  * @param string $parameter Parameter's name
  * @param bool   $force    force data type
  * @param string $which which component to reach(time or date)
  */
  function SetParameters($function, $parameter, $force = false, $which = 'time') 
  {
    switch ($which)
    {
      case 'date':
        $this->mDate->SetParameters($function, $parameter, $force);
      break;
      default:
        $this->mTime->SetParameters($function, $parameter, $force);
    }
  }

  function SetTestIfEmpty($test = false, $message = "Por favor, preencha o campo!")
  {
    //validate_timestamp javascript function will force time to be filled
    $this->SetDateMandatory($test, $message); 
  }

  function SetDateMandatory($test = true, $message = "Por favor, preencha o campo!")
  {
    $this->mDate->SetTestIfEmpty($test, $message);  
  }

  function SetTimeMandatory($test = true, $message = "Por favor, preencha o campo!")
  {
    $this->mTime->SetTestIfEmpty($test, $message);  
  }

  function IsValid()
  {
    //test if can be empty AND is empty
    if ($this->mTestIfEmpty == 0 && $this->IsEmpty())
      return true;

    if (!$this->mDate->IsValid())
    {
      $this->SetInvalidMessage($this->mDate->GetInvalidMessage(), true);
      return false;
    }

    if (!$this->mTime->IsValid())
    {
      $this->SetInvalidMessage($this->mTime->GetInvalidMessage(), true);
      return false;
    }

    return true;
  }

  function GetJSOnSubmit()
  {
    /*
      * MainForm object isn't updated normally because they are inside TimeStamp,
      and only timestamp is catched by the container
    */
    $this->mDate->mMainForm = &$this->mMainForm;
    $this->mTime->mMainForm = &$this->mMainForm;

    $out = "";

    $out .= $this->mDate->GetJSOnSubmit();
    $out .= $this->mTime->GetJSOnSubmit(); 

    $form = "document.".$this->mMainForm->mName.".";

    if ($this->mTimeStamp1 && ($this->mCondition || $this->mTimeStamp2) )
    {
      $out .= "  ".$this->mName."_ok = ".$this->mName."_ok && (test_timestamp(";
      $out .= $form.$this->mDate->mName.".value +' '+".$form.$this->mTime->mName.".value, ";
      if (is_object($this->mTimeStamp1))
        $out .= $form.$this->mTimeStamp1->mName.".value +' '+".$form.$this->mTimeStamp1->mTime->mName.".value, ";
      else
        $out .= "'$this->mTimeStamp1', " ;

      $out .= "'$this->mTimeStamp2', '$this->mCondition', ";
      $out .= "'$this->mError', '".$this->mInterval."', '".$this->GetLabel()."'));\n";
    }

    if ($this->forceBothArguments)
      $out .= "  ".$this->mName."_ok = ".$this->mName."_ok && validate_timestamp(".$form.$this->mDate->mName.", ".$form.$this->mTime->mName." );\n";

    $out .= "  ok = ok && ".$this->mName."_ok\n";

    return $out;
  }

  /**
  * Gets the instance of the Date object
  * @returns JFormDate instance of JFormDate
  * @acess private
  */
  function &GetDateInstance()
  {
    return $this->mDate;
  }

  /**
  * Gets the instance of the time object
  * @returns JFormTime instance of JFormTime
  * @acess private
  */
  function &GetTimeInstance()
  {
    return $this->mTime;
  }

  /**
  * Gets the date value
  * @param boolean $sys controls whether the value will be returned in sys format
  * @returns string
  */
  function GetDateValue($sys=false)
  {
    return $this->mDate->GetValue($sys);
  }

  /**
  * Gets time value
  * @returns string
  */
  function GetTimeValue()
  {
    return $this->mTime->GetValue(); 
  }

  /**
  * Gets object's value
  * @param boolean $sys controls whether the value will be returned in sys format
  * @returns string
  */
  function GetValue($sys=false)
  {
    $returnValue = $this->mDate->GetValue($sys).' '.$this->mTime->GetValue();
    //there is always a single space between date and time values
    return  ($returnValue !== ' ' ? $returnValue : 'NULL');
  }

  /**
  * Sets Object's Date1 value
  * @param boolean $value
  */
  function SetDate1($value)
  {
    $this->mDate->SetDate1($value); 
  }

  /**
  * Sets Object's Date2 value
  * @param boolean $value
  */
  function SetDate2($value)
  {
    $this->mDate->SetDate2($value); 
  }

  /**
  * Sets Object's Time1 value
  * @param boolean $value
  */
  function SetTime1($value)
  {
    $this->mTime->SetTime1($value); 
  }

  /**
  * Sets Object's Time2 value
  * @param boolean $value
  */
  function SetTime2($value)
  {
    $this->mTime->SetTime2($value); 
  }

  /**
  * Sets Object's TimeStamp1 value
  * @param boolean $value
  */
  function SetTimeStamp1($value)
  { 
    $this->mTimeStamp1 = &$value;
  } 

  /**
  * Sets Object's TimeStamp2 value
  * @param boolean $value
  */
  function SetTimeStamp2($value)
  {
    $this->mTimeStamp2 = &$value;
  }
  
  /**
  * Sets style to DatePicker
  */
  function SetDatePickerStyle($value)
  {
    $this->mTypeDatePicker = $value;
  }

  /**
  * Builds object's output
  * @returns string
  */
  function GetHtml()
  {
    $dateId = $this->mId;
              
    $this->mDate->MakeId($this->mId);
    $this->mTime->MakeId(++$this->mId);

    parent::SetDefaultEvents();
    $this->SetDefaultEvents();

    $out = "";
    $out .= $this->BuildJSEvents();
  
    //the datepicker cannot appear by the side of date field
    //
    $this->mDate->UseDatePicker(false);

    $out .= trim($this->mDate->GetHtml());
    $out .= trim($this->mTime->GetHtml());

    if ($this->mUseDatePicker)
    {
      $this->mDate->UseDatePicker(true);
      $out .= ($this->mTypeDatePicker) ? $this->mDate->GetDatePickerJQuery($dateId) : $this->mDate->GetDatePickerHtml($dateId);
    }

    if ($this->mUseLinkHoraAtual)
    {
      $nmDate = trim($this->mDate->mName);
      $nmTime = trim($this->mTime->mName);
      
      $nmFuncStrPad         = "strPad_" . $nmDate;
      $nmFuncObterDataAtual = "obterDataAtual_" . $nmDate;
      
      $out .= "
        <script type='text/javascript'>
          function $nmFuncStrPad(str, max) 
          {
            return str.length < max ? $nmFuncStrPad('0' + str, max) : str;
          }

          function $nmFuncObterDataAtual()
          {
            var data = new Date();

            var dia  = $nmFuncStrPad(data.getDate().toString(10),        2);      
            var mes  = $nmFuncStrPad((data.getMonth() + 1).toString(10), 2);       
            var ano  = data.getFullYear();       
            var hora = $nmFuncStrPad(data.getHours().toString(10),   2);          
            var min  = $nmFuncStrPad(data.getMinutes().toString(10), 2);        

            var str_data = dia + '/' + mes + '/' + ano;
            var str_hora = hora + ':' + min;

            $('.$nmDate').val(str_data);
            $('.$nmTime').val(str_hora);
          }
        </script>
      
        <a href=\"javascript:void(0);\" onClick=\"$nmFuncObterDataAtual()\">
          <img src='" . JAGUAR_URL . "/img/clock.png' />
        </a>";
    }
    
    $out .= $this->GetTip();

    return $this->GetRawHtml($out);
  }
}

/**
* Cep objects creation class (CEP = Brazilian's ZIP code)
*
* @author  Atua Sistemas de Informação
*/
class JFormCep extends JFormText
{
  /**
  * Stores object's type
  * @var string
  */
  var $mType = "Cep";

  /**
  * Stores error message
  * @var string
  */
  var $mError = "CEP Inválido!";

  /**
  * Controls the exhibition of link CEP's consultation
  * @var boolean
  */
  var $mCadastre = true;

  /**
  * Stores link for CEP's verification
  * @var string
  */
  var $mLink     = "Verificar";

  /**
  * Controls whether the object requires special parameters on grid's SetValue call
  * @var boolean
  */
  var $mGridParameters = array("pt_BR", "pt_BR");

  /**
  * @var string
  */
  var $mNmObjetoCidade = "f_cd_cidade";

  /**
  * Constructor
  * @param string $name  Field's name
  * @param string|boolean $value  Field's value
  * @param string|boolean $objCidade
  */
  function __construct($name, $value = false, $objCidade = false)
  {
    $this->SetName($name);
    $this->mEmpty = $this->IsEmpty();
    $this->DefaultValue = $value;

    if ($objCidade)
      $this->mNmObjetoCidade = $objCidade->mName;
  }

  /**
  * Sets default JS functions for JFormCep objects
  */
  function SetDefaultEvents()
  {
    $this->SetEvents("onKeyPress", "return format_cep");
    $this->SetParameters("return format_cep", "this");
    $this->SetParameters("return format_cep", "event");

    $this->SetEvents("onBlur", "validate_cep");
    $this->SetParameters("validate_cep", "this");
    $this->SetParameters("validate_cep", $this->mError);
  }

  function SetValue($value = false)
  {
    $args = func_get_args();
    $from = $args[1] ? $args[1] : "sys";
    $to   = $args[2] ? $args[2] : "pt_BR";
    
    $this->mValue = Format_Cep($value, $from, $to);
  }

  /**
  * Gets object's value
  * @param boolean $db Controls if the value must be formatted before its returning
  * @returns mixed
  */
  function GetValue($db = false)
  {
    if ($db)
      return Format_Cep($this->mValue);
    else
      return $this->mValue;
  }

  function SetCadastreExibition($cadastre = false, $link = "")
  {
    if (is_bool($cadastre))
      $this->mCadastre = $cadastre;
      
    if (strlen($link))
      $this->mLink = $link;
  }

  /**
  * Builds object's output
  * @returns string
  */
  function GetHtml()
  {
    $id   = $this->MakeId();
    $out  = "\n";
    $out .= "<input class='".$this->MakeClass()."' id=\"$id\" type=\"text\" name=\"$this->mName\" value=\"".$this->GetValue()."\" ";
    $out .= "size=\"9\" maxlength=\"9\" $this->mDisabled".$this->GetCssClass();

    //JavaScript events
    parent::SetDefaultEvents();
    $this->SetDefaultEvents();
    $out .= $this->BuildJSEvents();

    $out .= " $this->mExtra>\n";
    if ($this->mCadastre)
    {
      $out .= "<a href=\"javascript:void(0);\" onClick=\"javascript:cep_cadastre(document.getElementById('$id').value,
                                                                                 '$this->mNmObjetoCidade');\">" . $this->mLink . "</a>\n";
    }
    $out .= $this->GetTip();

    return $this->GetRawHtml($out);
  }
}

/** 
* E-mail objects creation class
*
* @author  Atua Sistemas de Informação
* @since   19/02/2003
*/
class JFormEmail extends JFormText
{
  /**
  * Stores object's type
  * @var string
  */
  var $mType  = "Email";

  /**
  * Stores error message
  * @var string
  */
  var $mError = "Email Inválido!";

  /**
  * Store the minnimum number of repetition for the given Reg Expression
  * @var integer
  */
  var $mMinimumRepeat = 1;

  /**
  * Store the maximum number of repetition for the given Reg Expression
  * @var integer
  */
  var $mMaximumRepeat = null; 

  /**
  * Stores the object's regEx
  * @var string
  */
  var $mRegEx = '([\w-]+(\.[\w-]+)*@(([A-Za-z\d][A-Za-z\d_-]{0,61}[A-Za-z\d]\.)+[A-Za-z]{2,6}|\[\d{1,3}(\.\d{1,3}){3}\])(;)?)';
  
  /**
  * Constructor
  * @param string $name  Field's name
  * @param string $value Field's value
  */
  function __construct($name = false, $value = false)
  {
    $this->SetName($name);
    $this->mEmpty = $this->IsEmpty();
    $this->SetDefaultValue($value);
    $this->SetLower();
  }

  /**
  * Sets default JS functions for JFormEmail objects
  */
  function SetDefaultEvents()
  {
    $this->SetEvents("onKeyPress", "return format_email");
    $this->SetParameters("return format_email", "this");
    $this->SetParameters("return format_email", "event");
    $this->SetParameters("return format_email", "True");
    
    $this->SetEvents("onBlur", "validate_email");
    $this->SetParameters("validate_email", "this");
    $this->SetParameters("validate_email", $this->mError);
    $this->SetParameters("validate_email", $this->GetRegEx(), true);
    $this->SetParameters("validate_email", $this->GetLabel());
  }

  /**
  * Sets the maximum number of emails which can be filled in a JFormEmail field
    separated by ';'
  * @param int $number The maximum number of emails
  */
  function SetMaximumEmails($number)
  {
    $this->mMaximumRepeat = $number;
  }

  /**
  * Checks if the object is valid
  */
  function IsValid()
  {
    $this->mValue = str_replace(" ", ";", $this->mValue);
    $this->mValue = preg_replace("/;+/", ";", $this->mValue);  
    
    //test if must be filled AND is filled
    if (!parent::IsValid())
      return false;

    //if doesn't need to be filled and is empty
    if (!$this->mTestIfEmpty && $this->IsEmpty())
      return true;

    // retira ";" das extremidades, retira emails repetidos, valida emails
    $value  = implode(";", array_keys(array_flip(explode(";", trim($this->GetValue() , "; ")))));
    if (preg_match($this->GetRegEx(), $value))
    {
      $arrEmailsErrados = array();
      //emails are separed by ";" character
      //
      $emailList = explode(";", $value);
      foreach($emailList as $key => $value)
      {
        if (!$value)
          return;

        $domain = explode('@', $value);
        $domain = $domain[1];

        //validates if a domain really exists through digg
        if (function_exists("checkdnsrr"))
        {
          /**
           * Nota:
           * De acordo com a RFC 2821 quando nenhum MX está listado, o hostname
           * poderia ser usado como único mail exchanger com uma prioridade 0.
           */
          switch (true)
          {
            case checkdnsrr($domain, "MX"):  break;
            case checkdnsrr($domain, "A"):   break;
            case checkdnsrr($domain, "SOA"): break;
            default: $arrEmailsErrados[] = $value;
          }
        }
        else
        {
          switch (true)
          {
            case exec('dig -t mx '.$domain.' +short +answer'):  break;
            case exec('dig -t a '.$domain.' +short +answer'):   break;
            case exec('dig -t soa '.$domain.' +short +answer'): break;
            default: $arrEmailsErrados[] = $value;
          }
        }
      }
      if (count($arrEmailsErrados) == 0)
      {
        $this->SetValue(implode(";", $emailList));
        return true;
      }
      
      $this->SetInvalidMessage(implode("\\n", $arrEmailsErrados), true);
    }
    else
      $this->SetInvalidMessage("A formatação do Email está incorreta");

    return false;
  }

  /**
  * Builds the object's JS onSubmit validation code
  * @returns string
  */
  function GetJSOnSubmit()
  {
    $out = "";
    $out .= "  ".$this->mName."_ok = true; \n";

    if ($this->mTestIfEmpty != 0)
      $out .= "  ".$this->mName."_ok = ".$this->mName."_ok && (!test_if_empty(document.".$this->mMainForm->mName.".".$this->mName.".value, '$this->mTestIfEmptyMessage', '".$this->mMainForm->mName."','$this->mName'));\n";

    $out .= "  ".$this->mName."_ok = ".$this->mName."_ok && validate_email(";
    $out .= "document.".$this->mMainForm->mName.".".$this->mName.", '".$this->mError."', ".$this->GetRegEx().", '".$this->GetLabel()."');\n";
    
    $out .= "  ok = ok && ".$this->mName."_ok;\n";
    $out .= "  form_submitted = (form_submitted && ".$this->mName."_ok);\n\n";

    return $out;

  }

  /**
  * Builds object's output
  * @returns string
  */
  function GetHtml()
  {
    $out  = "\n";
    $out .= "<input class='".$this->MakeClass()."' id=\"".$this->MakeId()."\" type=\"text\" name=\"$this->mName\" value=\"".$this->GetValue()."\" ";
    $out .= "size=\"".$this->mSize."\" $this->mDisabled ".$this->GetCssClass();

    //JavaScript events
    $this->SetDefaultEvents();
    parent::SetDefaultEvents();
    $out .= $this->BuildJSEvents();

    $out .= $this->mExtra.">\n";
    $out .= $this->GetTip();

    return $this->GetRawHtml($out);
  }
}

/**
* Telephone (brazilian style) objects creation class
*
* @author  Atua Sistemas de Informação
* @since   13/02/2003
*/
class JFormPhone extends JFormText
{
  /**
  * Stores object's type
  * @var string
  */
  var $mType = "Phone";

  /**
  * Stores error message
  * @var string
  */
  var $mError = "Telefone Inválido!";

  /**
  * Constructor
  * @param string $name  Field's name
  * @param string $value Field's value
  */
  function __construct($name = false, $value = false)
  {
    $this->SetName($name);
    $this->mEmpty = $this->IsEmpty();
    $this->SetDefaultValue($value);
  }

  /**
  * Sets default JS functions for JFormFone objects
  */
  function SetDefaultEvents()
  {
    $this->SetEvents("onKeyPress", "return format_fone");
    $this->SetParameters("return format_fone", "this");
    $this->SetParameters("return format_fone", "event");

    $this->SetEvents("onBlur", "validate_fone");
    $this->SetParameters("validate_fone", "this");
    $this->SetParameters("validate_fone", $this->mError);
  }

  function SetValue($value = false)
  {
    $args = func_get_args();
    $from = $args[1] ? $args[1] : "sys";
    $to   = $args[2] ? $args[2] : "pt_BR";
    
    $this->mValue = Format_Fone($value, $from, $to);
  }

  /**
  * Checks if the object is valid
  */
  function IsValid()
  {
    $ok = true;

    $fone = preg_replace("/[^0-9\*]*/", "", $this->GetValue());

    $min = 10;
    $max = 11;
    
    if ($fone[0] == 0)
    {
      $min = 10;
      $max = 12;
    }

    if (strpos($fone, "*") !== false)
    {
      $min = 7;
      $max = 17;

      if (!preg_match("/^((\*)*[0-9])+([0-9\*])*$/", $fone))
        $ok = false;
    }

    $size = strlen($fone);

    if ($this->mTestIfEmpty != 0)
    {
      if ($size == 0)
        $ok = false;
      else
      {
        if (($size < $min) || ($size > $max))
          $ok = false;
      }
    }
    else
    {
      if ( ($size != 0) && (($size < $min) || ($size > $max)) )
        $ok = false;
    }

    return $ok;
  }

  /**
  * Builds the object's JS onSubmit validation code
  */
  function GetJSOnSubmit()
  {
    $out = "";
    $out .= "  ".$this->mName."_ok = true; \n";

    if ($this->mTestIfEmpty != 0)
      $out .= "  ".$this->mName."_ok = ".$this->mName."_ok && (!test_if_empty(document.".
              $this->mMainForm->mName.".".$this->mName.".value, '$this->mTestIfEmptyMessage', '".
              $this->mMainForm->mName."','$this->mName'));\n";

    $out .= "  ".$this->mName."_ok = ".$this->mName."_ok && validate_fone(";
    $out .= "'$this->mName', '$this->mError', '".$this->mMainForm->mName."');\n";

    $out .= "  ok = ok && ".$this->mName."_ok;\n";
    $out .= "  form_submitted = (form_submitted && ".$this->mName."_ok);\n\n";

    return $out;

  }

  /**
  * Gets object's value
  */
  function GetValue($db = false, $from = "pt_BR", $to = "sys")
  {
    if ($db)
      return Format_Fone($this->mValue, $from, $to);
    else
      return $this->mValue;
  }

  /**
  * Builds object's output
  */
  function GetHtml()
  {
    $out  = "\n";
    $out .= "<input class='".$this->MakeClass()."' id=\"".$this->MakeId()."\" type=\"text\" name=\"$this->mName\" value=\"".$this->GetValue()."\" ";
    $out .= "size=\"14\" maxlength=\"16\" $this->mDisabled ".$this->GetCssClass();

    //eventos JavaScript
    parent::SetDefaultEvents();
    $this->SetDefaultEvents();
    $out .= $this->BuildJSEvents();

    $out .= $this->mExtra.">\n";
    $out .= $this->GetTip();

    return $this->GetRawHtml($out);
  }
}

/**
* Telephone creation class
*
* This class is manteined for backward compatibility reasons. It will soon be
* deprecated.
*
* @author  Atua Sistemas de Informação
*/
class JFormFone extends JFormPhone
{
  /**
  * Constructor
  * @param string $name  Field's name
  * @param string $value Field's value
  */
  function __construct($name = false, $value = false)
  {
    $this->SetName($name);
    $this->mEmpty = $this->IsEmpty();
    $this->SetDefaultValue($value);
  }
}

/**
* State inscription creation class (Brazilian code)
* 
* @author Atua Sistemas de Informação
* @since 30/06/2003
*/
class JFormIE extends JFormText
{
  /**
  * Stores object's type
  * @var string
  */
  var $mType  = "IE";

  /**
  * Stores error message
  * @var string
  */
  var $mError = "Iscrição Estadual Inválida!";

  /**
  * Stores the name of the field that holds the state inscription
  * @var string
  */
  var $mField;

  /*
  * Stores the maintenance form's name
  * @var string
  */
  var $mForm;

  /**
  * Constructor
  * @param string $name  Field's name
  * @param string $field State name field
  * @param string $form  Form's name 
  * @param string $value Field's value
  */
  function __construct($name, $field, $form, $value = false)
  {
    $this->SetName($name);
    $this->mEmpty = $this->IsEmpty();
    $this->mField = $field;
    $this->mForm  = $form;
    $this->SetDefaultValue($value);
  }
  
  /**
  * Sets the object's value
  * @param string $value Field's value
  * @internal string $from  { sys | pt_BR }
  * @internal string $to    { sys | pt_BR }
  */
  function SetValue($value = false) 
  {
    $args = func_get_args();
    $from = $args[1] ? $args[1] : "sys";
    $to   = $args[2] ? $args[2] : "pt_BR";

    $this->mValue = Format_IE($value, $this->mField, $from, $to);
  }

  /**
  * Gets object's value
  * @param boolean $db Controls whetjer the value must be formatted before returning or not
  */
  function GetValue($db = false)
  {
    if ($db)
      return Format_IE($this->mValue, $this->mField);
    else
      return $this->mValue;
  }
                  
  /**
  * Sets default JS functions for JFormIE objects
  */
  function SetDefaultEvents()
  {
    $this->SetEvents("onKeyPress", "return format_inscricao_estadual");
    $this->SetParameters("return format_inscricao_estadual", "this");
    $this->SetParameters("return format_inscricao_estadual", "event");
    $this->SetParameters("return format_inscricao_estadual", $this->mField);
    $this->SetParameters("return format_inscricao_estadual", $this->mForm);

    $this->SetEvents("onBlur", "validate_inscricao_estadual");
    $this->SetParameters("validate_inscricao_estadual", "this");
    $this->SetParameters("validate_inscricao_estadual", $this->mField);
    $this->SetParameters("validate_inscricao_estadual", $this->mForm);
    $this->SetParameters("validate_inscricao_estadual", $this->mError);
  }

  /**
  * Calculates and returnsa the value in Modulo11
  * @param mixed $value IE's value
  * @param int   $max   Module length
  */
  function CalcModulo11($value, $max = 10)
  {
    //retira caracteres não numéricos
    $numbers   = array('1', '2', '3', '4', '5', '6', '7', '8', '9', '0');
    $value_tmp = $value;
    unset($value);
    
    for ($i = 0; $i < strlen($value_tmp); $i++)
    {
      $char = substr($value_tmp, $i, 1);

      if (in_array($char, $numbers))
        $value[] = $char;
    }

    //calcula o módulo 11
    $fator = 2;
    for ($i = (sizeof($value) - 1); $i > 0; $i--)
    {
      if ($fator == $max)
        $fator = 2;

      $resultado += $value[$i - 1] * $fator;
      $fator++;
    }
    $digito = ( 11 - ($resultado % 11) );

    if ($digito == 10 || $digito == 11)
      $digito = 0;
    
    return ($digito == $value[sizeof($value) - 1])?true:false;
    
  }
  
  /**
  * Checks if the object is valid
  * @returns boolean
  */
  function IsValid()
  {
    $ok = $this->IsEmpty();
    
    if (strlen($this->GetValue()) > 0)
    {
      switch ($GLOBALS[$this->mField])
      {
        case "RS":
          $ok = $this->CalcModulo11($this->GetValue());
          return $ok;
        break;

        case "SC":
        break;
      
        case "PR":
          $ok_1 = $this->CalcModulo11(substr($this->GetValue(), 0, -1), 8);
          if ($ok_1)
            $ok_2 = $this->CalcModulo11($this->GetValue(), 8);
          
          if ($ok_1 && $ok_2)
            return true;
          else
            return false;
        break;

        case "SP":
        break;
      }
    }
    else
      return $ok;
  }

  /**
  * Builds the object's JS onSubmit validation code
  * @returns string
  */
  function GetJSOnSubmit()
  {
    $out = "";
    $out .= "  ".$this->mName."_ok = true; \n";

    if ($this->mTestIfEmpty != 0)
      $out .= "  ".$this->mName."_ok = ".$this->mName."_ok && (!test_if_empty(document.".
              $this->mMainForm->mName.".".$this->mName.".value, '$this->mTestIfEmptyMessage', '".
              $this->mMainForm->mName."','$this->mName'));\n";

    $out .= "  ".$this->mName."_ok = ".$this->mName."_ok && validate_inscricao_estadual(";
    $out .= "'$this->mName', '$this->mField', '".$this->mMainForm->mName."', '$this->mError');\n";

    $out .= "  ok = ok && ".$this->mName."_ok;\n";
    $out .= "  form_submitted = (form_submitted && ".$this->mName."_ok);\n\n";

    return $out;
 
  }
  
  /**
  * Builds object' output
  * @returns string
  */
  function GetHtml()
  {
    $out  = "\n";
    $out .= "<input class='".$this->MakeClass()."' id=\"".$this->MakeId()."\" type=\"text\" name=\"$this->mName\" value=\"".$this->GetValue()."\" ";
    $out .= "size=\"11\" maxlength=\"11\" $this->mDisabled ".$this->GetCssClass();

    //eventos JavaScript
    parent::SetDefaultEvents();
    $this->SetDefaultEvents();
    $out .= $this->BuildJSEvents();

    $out .= $this->mExtra.">\n";
    $out .= $this->GetTip();

    return $this->GetRawHtml($out);
  }
  
}

/**
* NIT creation class (Brazilian code)
*
* @author  Atua Sistemas de Informação
*/
class JFormNIT extends JFormText
{
  /**
  * Stores object's type
  * @var string
  */
  var $mType     = "NIT";

  /**
  * Controls the exhibition of link NIT's consultation
  * @var boolean
  */
  var $mCadastre = true;

  /**
  * Stores link for NIT's verification
  * @var string
  */
  var $mLink     = "Verificar";

  /**
  * Stores link for NIT's validated
  * @var string
  */
  var $mLink_     = "Validar";

  /**
  * Stores error message
  * @var string
  */
  var $mError    = "Número Inscrição Trabalhador Inválida!";

  /**
  * Controls whether the object requires special parameters on grid's SetValue call
  * @var boolean
  */
  var $mGridParameters = array("pt_BR", "pt_BR");

  /**
  * Constructor
  * @param string $name  Field's name
  * @param string $value Field's value
  */
  function __construct($name = false, $value = false)
  {
    $this->SetName($name);
    $this->mEmpty = $this->IsEmpty();
    $this->SetDefaultValue($value);
  }

  /**
  * Sets default JS functions for JFormNit objects
  */
  function SetDefaultEvents()
  {
    $this->SetEvents("onKeyPress", "return format_nit");
    $this->SetParameters("return format_nit", "this");
    $this->SetParameters("return format_nit", "event");

    $this->SetEvents("onBlur", "validate_nit");
    $this->SetParameters("validate_nit", "this");
    $this->SetParameters("validate_nit", $this->mError);
  }


  /**
  * Sets link for register Nit 
  * @param boolean $cadastre Controls whether the link might be shown or not
  * @param string  $link     The link target
  */
  function SetCadastreExibition($cadastre = false, $link = "")
  {
    if (is_bool($cadastre))
      $this->mCadastre = $cadastre;
      
    if (strlen($link))
      $this->mLink = $link;
  }

  /**
  * Checks if the object is valid
  * @returns boolean
  */
  function IsValid()
  {
    $ok = true;

    if ($this->mTestIfEmpty != 0)
      $ok = $ok && !$this->IsEmpty();
    
    $nit = (string)$this->GetValue();

    if (strlen($nit) > 0)
    {
      if (strlen($nit) != 11)
        return false;

      for ($i = 0; $i < 11; $i++)
      {
        if (($nit[$i] !== "0") && ($nit[$i] !== "1") && ($nit[$i] !== "2") && ($nit[$i] !== "3") && 
            ($nit[$i] !== "4") && ($nit[$i] !== "5") && ($nit[$i] !== "6") && ($nit[$i] !== "7") && 
            ($nit[$i] !== "8") && ($nit[$i] !== "9"))
          return false;
      }

      $arr_peso = array(3, 2, 9, 8, 7, 6, 5, 4, 3, 2);
      $arr_nit = array();
      $digito = substr($nit, -1);

      for ($i=0; $i<=9; $i++)
      {
        $arr_nit[] = substr($nit, $i, 1);
      }
      
      $i = 0;
      $result = 0;
      foreach ($arr_nit AS $value)
      {
        $result += $value * $arr_peso[$i];
        $i++;
      }

      $mod = $result % 11;
      $digito_verificador = 11 - $mod;
      
      if ($digito_verificador == 11 || $digito_verificador == 10)
        $digito_verificador = 0;

      if ($digito_verificador != $digito)
        return false;
      else
        return true;
    }
    else
      return $ok;
  }

  /**
  * Builds the object's JS onSubmit validation code
  * @returns string
  */
  function GetJSOnSubmit()
  {
    $out = "";
    $out .= "  ".$this->mName."_ok = true; \n";

    if ($this->mTestIfEmpty != 0)
      $out .= "  ".$this->mName."_ok = ".$this->mName."_ok && (!test_if_empty(document.".
              $this->mMainForm->mName.".".$this->mName.".value, '$this->mTestIfEmptyMessage', '".
              $this->mMainForm->mName."','$this->mName'));\n";

    $out .= "  ".$this->mName."_ok = ".$this->mName."_ok && validate_nit(";
    $out .= "'$this->mName', '$this->mError', '".$this->mMainForm->mName."');\n";

    $out .= "  ok = ok && ".$this->mName."_ok;\n";
    $out .= "  form_submitted = (form_submitted && ".$this->mName."_ok);\n\n";
    return $out;
  }

  /**
  * Gets object's value
  * @param boolean $db   Controls whether the Nit might be formatted or not before returning
  * @param string  $from { sys | pt_BR }
  * @param string  $to   { sys | pt_BR }
  * @returns string
  */
  function GetValue($db = false, $from = "pt_BR", $to = "sys")
  {
    return $this->mValue;
  }

  /**
  * Builds object's output
  * @returns string
  */
  function GetHtml()
  {
    $id   = $this->MakeId();
    $out  = "\n";
    $out .= "<input class='".$this->MakeClass()."' id=\"$id\" type=\"text\" name=\"$this->mName\" value=\"".$this->GetValue()."\" ";
    $out .= "size=\"11\" maxlength=\"11\" $this->mDisabled ".$this->GetCssClass();

    //eventos JavaScript
    parent::SetDefaultEvents();
    $this->SetDefaultEvents();
    $out .= $this->BuildJSEvents();

    $out .= " $this->mExtra>\n";

    if ($this->mCadastre)
    {
      $out .= "<a href=\"javascript:void(0);\" onClick=\"javascript:nit_cadastre();\">".
              $this->mLink."</a>";
      $out .= " | <a href=\"javascript:void(0);\" onClick=\"javascript:nit_validated();\">".
              $this->mLink_."</a>\n";
    }

    $out .= $this->GetTip();

    return $this->GetRawHtml($out);
  }
}

/**
* CPF creation class (Brazilian code)
*
* @author  Atua Sistemas de Informação
*/
class JFormCpf extends JFormText
{
  /**
  * Stores object's type
  * @var string
  */
  var $mType     = "Cpf";

  /**
  * Controls the exhibition of link CPF's consultation
  * @var boolean
  */
  var $mCadastre = true;

  /**
  * Stores link for CPF's verification
  * @var string
  */
  var $mLink     = "Verificar";

  /**
  * Stores error message
  * @var string
  */
  var $mError    = "CPF Inválido!";

  /**
  * Controls whether the object requires special parameters on grid's SetValue call
  * @var boolean
  */
  var $mGridParameters = array("pt_BR", "pt_BR");

  /**
  * Constructor
  * @param string $name  Field's name
  * @param string $value Field's value
  */
  function __construct($name = false, $value = false)
  {
    $this->SetName($name);
    $this->mEmpty = $this->IsEmpty();
    $this->SetDefaultValue($value);
  }

  /**
  * Sets default JS functions for JFormCpf objects
  */
  function SetDefaultEvents()
  {
    $this->SetEvents("onBlur", "validate_cpf");
    $this->SetParameters("validate_cpf", "this");
    $this->SetParameters("validate_cpf", $this->mError);
  }

  /**
  * Sets object's value
  * @param string $value CPF's value
  * @internal string $from  { sys | pt_BR }
  * @internal string $to    { sys | pt_BR }
  */
  function SetValue($value = false)
  {
    $args = func_get_args();
    $from = $args[1] ? $args[1] : "sys";
    $to   = $args[2] ? $args[2] : "pt_BR";
    
    $this->mValue = Format_Cpf($value, $from, $to);
  }

  /**
  * Sets link for register CPF
  * @param boolean $cadastre Controls whether the link might be shown or not
  * @param string  $link     The link target
  */
  function SetCadastreExibition($cadastre = false, $link = "")
  {
    if (is_bool($cadastre))
      $this->mCadastre = $cadastre;
      
    if (strlen($link))
      $this->mLink = $link;
  }

  /**
  * Checks if the object is valid
  * @returns boolean
  */
  function IsValid()
  {
    $ok = true;

    if ($this->mTestIfEmpty != 0)
      $ok = $ok && !$this->IsEmpty();
    
    $cpf = $this->GetValue();

    if (strlen($cpf) > 0)
    {
      $trans = array("." => "", "/" => "", "-" => "");
      $cpf   = strtr($cpf, $trans);
            
      if (strlen($cpf) != 11)
        return false;

      //verifica o primeiro digito
      $sum = 0;
      
      for ($i = 0; $i <= 8; $i++)
      {
        $value = substr($cpf, $i, 1);
        $sum += $value * ($i + 1);
      }
         
      $rest = $sum % 11;

      if ($rest > 9)
        $dig = $rest - 10;
      else
        $dig = $rest;

      if ($dig != substr($cpf, 9, 1))
        return false;
      else
      {
        //verifica o segundo dígito
        $sum = 0;
        for ($i = 0; $i <= 7; $i++)
        {
          $value = substr($cpf, ($i + 1), 1);
          $sum += ($value * ($i + 1)); 
        }

        $sum += ($dig * 9);
        $rest = $sum % 11;

        if ($rest > 9)
          $dig = $rest - 10;
        else
          $dig = $rest;

        if ($dig != substr($cpf, 10, 1))
          return false;
        else
          return true;
      }
    }//if ($this->mTestIfEmpty && ( strlen($cpf) > 0) )
    else
      return $ok;
  }

  /**
  * Builds the object's JS onSubmit validation code
  * @returns string
  */
  function GetJSOnSubmit()
  {
    $out = "";
    $out .= "  ".$this->mName."_ok = true; \n";

    if ($this->mTestIfEmpty != 0)
      $out .= "  ".$this->mName."_ok = ".$this->mName."_ok && (!test_if_empty(document.".
              $this->mMainForm->mName.".".$this->mName.".value, '$this->mTestIfEmptyMessage', '".
              $this->mMainForm->mName."','$this->mName'));\n";

    $out .= "  ".$this->mName."_ok = ".$this->mName."_ok && validate_cpf(";
    $out .= "'$this->mName', '$this->mError', '".$this->mMainForm->mName."');\n";

    $out .= "  ok = ok && ".$this->mName."_ok;\n";
    $out .= "  form_submitted = (form_submitted && ".$this->mName."_ok);\n\n";
    return $out;
  }

  /**
  * Gets object's value
  * @param boolean $db   Controls whether the CPF might be formatted or not before returning
  * @param string  $from { sys | pt_BR }
  * @param string  $to   { sys | pt_BR }
  * @returns string
  */
  function GetValue($db = false, $from = "pt_BR", $to = "sys")
  {
    if ($db)
      return Format_Cpf($this->mValue, $from, $to);
    else
      return $this->mValue;
  }

  /**
  * Builds object's output
  * @returns string
  */
  function GetHtml()
  {
    $id   = $this->MakeId();
    $out  = "\n";
    $out .= "<input class='".$this->MakeClass()."' id=\"$id\" type=\"text\" name=\"$this->mName\" value=\"".$this->GetValue()."\" ";
    $out .= "size=\"14\" $this->mDisabled ".$this->GetCssClass();

    //eventos JavaScript
    parent::SetDefaultEvents();
    $this->SetDefaultEvents();
    $out .= $this->BuildJSEvents();

    $out .= " $this->mExtra>\n";

    if ($this->mCadastre)
      $out .= "<a href=\"javascript:void(0);\" onClick=\"javascript:cpf_cadastre(document.getElementById('$id').value);\">".
              $this->mLink."</a>\n";

    $out .= $this->BuildPopUp()."\n";
    $out .= $this->GetTip();
    $out .= $this->GetMask("cpf");

    return $this->GetRawHtml($out);
  }
}

/**
* Cnpj creation class (Brazilian code)
*
* @author  Atua Sistemas de Informação
*/
class JFormCnpj extends JFormText
{
  /**
  * Stores object's type
  * @var string
  */
  var $mType     = "Cnpj";

  /**
  * Controls the exhibition of link Cnpj's consultation
  * @var boolean
  */
  var $mCadastre = true;

  /**
  * Stores link for Cnpj's consultation
  * @var string
  */
  var $mLink     = "Verificar";

  /**
  * Stores error message
  * @var string
  */
  var $mError    = "Cnpj Inválido!";

  /**
  * Controls whether the object requires special parameters on grid's SetValue call
  * @var boolean
  */
  var $mGridParameters = array("pt_BR", "pt_BR");

  /**
  * Constructor
  * @param string $name  Field's name
  * @param string $value Field's value
  */
  function __construct($name = false, $value = false)
  {
    $this->SetName($name);
    $this->mEmpty = $this->IsEmpty();
    $this->SetDefaultValue($value);
  }

  /**
  * Sets default JS functions for JFormCnpj objects
  */
  function SetDefaultEvents()
  {
    $this->SetEvents("onBlur", "validate_cnpj");
    $this->SetParameters("validate_cnpj", "this");
    $this->SetParameters("validate_cnpj", $this->mError);
  }

  /**
  * Sets object's value
  * @param string $value CPF's value
  * @internal string $from  { sys | pt_BR }
  * @internal string $to    { sys | pt_BR }
  */
  function SetValue($value = false)
  {
    $args = func_get_args();
    $from = $args[1] ? $args[1] : "sys";
    $to   = $args[2] ? $args[2] : "pt_BR";
    
    $this->mValue = Format_Cnpj($value, $from, $to);
  }

  /**
  * Sets link for CNPJ consultation
  * @param boolean $cadastre Controls whether the link might be shown or not
  * @param string  $link     The link target
  */
  function SetCadastreExibition($cadastre = true, $link = "")
  {
    if (is_bool($cadastre))
      $this->mCadastre = $cadastre;
      
    if (strlen($link))
      $this->mLink = $link;
  }

  /**
  * Checks if the object is valid
  * @returns boolean
  */
  function IsValid()
  {
    $ok = true;

    if ($this->mTestIfEmpty != 0)
      $ok = $ok && !$this->IsEmpty();
    $cnpj = $this->GetValue();

    if ( strlen($cnpj) > 0 )
    {
      $cnpj = preg_replace("/[^0-9]/", "", $cnpj);

      $m2 = 2;
      $sum1 = 0;
      $sum2 = 0;
      for ($i = 11; $i >= 0; $i--)
      {
        $val = substr($cnpj,$i,1);
        $m1 = $m2;
        if ($m2 < 9)
          $m2 = $m2 + 1;
        else
          $m2 = 2;

        $sum1 = $sum1 + ($val * $m1);
        $sum2 = $sum2 + ($val * $m2);
      }

      $sum1 = $sum1 % 11;
      if ($sum1 < 2)
        $d1 = 0;
      else
        $d1 = 11 - $sum1;

      $sum2 = ($sum2 + (2 * $d1) ) % 11;

      if ($sum2 < 2)
        $d2 = 0;
      else
        $d2 = 11 - $sum2;

      return ( ( $d1 != substr($cnpj,12,1) ) || ( $d2 != substr($cnpj,13,1) ) )?false:true;
    }
    else
      return $ok;

  }

  /**
  * Gets object's value
  * @param boolean $db   Controls whether the CPF might be formatted or not before returning
  * @param string  $from { sys | pt_BR }
  * @param string  $to   { sys | pt_BR }
  * @returns string
  */
  function GetValue($db = false, $from = "pt_BR", $to = "sys")
  {
    if ($db)
      return Format_Cnpj($this->mValue, $from, $to);
    else
      return $this->mValue;
  }

  /**
  * Builds the object's JS onSubmit validation code
  * @returns string
  */
  function GetJSOnSubmit()
  {
    $out = "";
    $out .= "  ".$this->mName."_ok = true; \n";

    if ($this->mTestIfEmpty != 0)
      $out .= "  ".$this->mName."_ok = ".$this->mName."_ok && (!test_if_empty(document.".
              $this->mMainForm->mName.".".$this->mName.".value, '$this->mTestIfEmptyMessage', '".
              $this->mMainForm->mName."','$this->mName'));\n";

    $out .= "  ".$this->mName."_ok = ".$this->mName."_ok && validate_cnpj(";
    $out .= "'$this->mName', '$this->mError', '".$this->mMainForm->mName."');\n";

    $out .= "  ok = ok && ".$this->mName."_ok;\n";
    $out .= "  form_submitted = (form_submitted && ".$this->mName."_ok);\n\n";
    
    return $out;
  }

  /**
  * Builds object's output
  * @returns string
  */
  function GetHtml()
  {
    $id   = $this->MakeId();
    $out  = "\n";
    $out .= "<input class='".$this->MakeClass()."' id=\"$id\" type=\"text\" name=\"$this->mName\" value=\"".$this->GetValue()."\" ";
    $out .= "size=\"18\" $this->mDisabled ".$this->GetCssClass();

    //eventos JavaScript
    parent::SetDefaultEvents();
    $this->SetDefaultEvents();
    $out .= $this->BuildJSEvents();

    $out .= $this->mExtra.">\n";

    if ($this->mCadastre)
      $out .= "<a href=\"javascript:void(0);\" onClick=\"javascript:cnpj_cadastre(document.getElementById('$id').value);\">".
              $this->mLink."</a>\n";

    $out .= $this->BuildPopUp()."\n";
    $out .= $this->GetTip();
    $out .= $this->GetMask('cnpj');

    return $this->GetRawHtml($out);
  }
}

/**
* PIS/PASEP objects creation class (Brazilian code)
*
* @author  Atua Sistemas de Informação
* @since   2003-03-13
*/
class JFormPis extends JFormText
{
  /**
  * Stores object's type
  * @var string
  */
  var $mType = "Pis";

  /**
  * Stores error message
  * @var string
  */
  var $mError = "PIS Inválido!";

  /**
  * Constructor
  * @param string $name  Field's name
  * @param string $value Field's value
  */
  function __construct($name = false, $value = false)
  {
    $this->SetName($name);
    $this->mEmpty = $this->IsEmpty();
    $this->SetDefaultValue($value);
  }

  /**
  * Sets default JS functions for JFormPis objects
  */
  function SetDefaultEvents()
  {
    $this->SetEvents("onKeyPress", "return format_pis");
    $this->SetParameters("return format_pis", "this");
    $this->SetParameters("return format_pis", "event");

    $this->SetEvents("onBlur", "validate_pis");
    $this->SetParameters("validate_pis", "this");
    $this->SetParameters("validate_pis", $this->mError);
  }

  /**
  * Sets object's value
  * @param string $value CPF's value
  * @internal string $from  { sys | pt_BR }
  * @internal string $to    { sys | pt_BR }
  */
  function SetValue($value = false)
  {
    $args = func_get_args();
    $from = $args[1] ? $args[1] : "sys";
    $to   = $args[2] ? $args[2] : "pt_BR";

    $this->mValue = Format_Pis($value, $from, $to);
  }

  /**
  * Checks if the object is valid
  * @returns boolean
  */
  function IsValid()
  {
    $ok = $this->IsEmpty();
    $pis = $this->GetValue();

    if ( strlen($pis) > 0 )
    {
      $trans = array("." => "", "-" => "");
      $pis = strtr($pis, $trans);

      $soma = 0;
      $fator = array(3,2,9,8,7,6,5,4,3,2);
      for ($i=0; $i < 10; $i++)
      {
        $soma += (substr($pis,$i,1) * $fator[$i]);
      }

      $resultado = 11 - ($soma % 11);

      if ( ($resultado == 10) || ($resultado == 11))
        $resultado = 0;

      return ( $resultado == substr($pis,10,1) )?true:false;
    }
    else
      return $ok;

  }

  /**
  * Gets object's value
  * @param boolean $db   Controls whether the CPF might be formatted or not before returning
  * @param string  $from { sys | pt_BR }
  * @param string  $to   { sys | pt_BR }
  * @returns string
  */
  function GetValue($db = false, $from = "pt_BR", $to = "sys")
  {
    if ($db)
      return Format_Pis($this->mValue, $from, $to);
    else
      return $this->mValue;
  }

  /**
  * Builds the object's JS onSubmit validation code
  * @returns string
  */
  function GetJSOnSubmit()
  {
    $out = "";
    $out .= "  ".$this->mName."_ok = true; \n";

    if ($this->mTestIfEmpty != 0)
      $out .= "  ".$this->mName."_ok = ".$this->mName."_ok && (!test_if_empty(document.".$this->mMainForm->mName.".".$this->mName.".value, '$this->mTestIfEmptyMessage', '".$this->mMainForm->mName."','$this->mName'));\n";

    $out .= "  ".$this->mName."_ok = ".$this->mName."_ok && validate_pis(";
    $out .= "'$this->mName', '$this->mError', '".$this->mMainForm->mName."');\n";

    $out .= "  ok = ok && ".$this->mName."_ok;\n";
    $out .= "  form_submitted = (form_submitted && ".$this->mName."_ok);\n\n";
    return $out;
  }

  /**
  * Builds object's output
  * @returns string
  */
  function GetHtml()
  {
    $out  = "\n";
    $out .= "<input class='".$this->MakeClass()."' id=\"".$this->MakeId()."\" type=\"text\" name=\"$this->mName\" value=\"".$this->GetValue()."\" ";
    $out .= "size=\"18\" maxlength=\"18\" $this->mDisabled ".$this->GetCssClass();

    //eventos JavaScript
    parent::SetDefaultEvents();
    $this->SetDefaultEvents();
    $out .= $this->BuildJSEvents();

    $out .= $this->mExtra.">\n";
    $out .= $this->GetTip();

    return $this->GetRawHtml($out);
  }
}

/**
* Modulo11 creation class
*
* @author  Atua Sistemas de Informação
* @since   2003-03-14
*/
class JFormModulo11 extends JFormText
{
  /**
  * Stores object's type
  * @var string
  */
  var $mType = "Modulo11";

  /**
  * Stores error message
  * @var string
  */
  var $mError = "Matricula Inválida!";

  /**
  * Constructor
  * @param string $name  Field's name
  * @param string $value Field's value
  */
  function __construct($name = false, $value = false)
  {
    $this->SetName($name);
    $this->mEmpty = $this->IsEmpty();
    $this->SetPrecision();
    $this->SetDefaultValue($value);
  }

  /**
  * Sets default JS functions for JFormModulo11 objects
  */
  function SetDefaultEvents()
  {
    $this->SetEvents("onKeyPress", "return format_modulo11");
    $this->SetParameters("return format_modulo11", "this");
    $this->SetParameters("return format_modulo11", $this->mSize);
    $this->SetParameters("return format_modulo11", "event");

    $this->SetEvents("onBlur", "validate_modulo11");
    $this->SetParameters("validate_modulo11", "this");
    $this->SetParameters("validate_modulo11", $this->mError);
  }

  /**
  * Sets object's value
  * @param string $value CPF's value
  * @internal string $from  { sys | pt_BR }
  * @internal string $to    { sys | pt_BR }
  */
  function SetValue($value = false)
  {
    $args = func_get_args();
    $from = $args[1] ? $args[1] : "sys";
    $to   = $args[2] ? $args[2] : "pt_BR";
    
    $this->mValue = Format_Modulo11($value, $from, $to);
  }

  /**
  * Sets the formatting's precision
  * @param int $size Number of digits before the hifen
  */
  function SetPrecision($size = 5)
  {
    $this->mSize      = $size;
    $this->mMaxLength = $this->mSize + 2;
  }

  /**
  * Checks if the object is valid
  * @returns boolean
  */
  function IsValid()
  {
    $ok = $this->IsEmpty();
    $modulo11 = $this->GetValue();

    if (strlen($modulo11) > 0)
    {
      $trans = array("-" => "");
      $modulo11 = strtr($modulo11, $trans);
      $matricula = substr($modulo11, 0, -1);
      $resultado = 0;

      $fator = 2;
      for ($i = strlen($matricula); $i > 0; $i--)
      {
        if ($fator == 10)
          $fator = 2;

        $resultado += ( substr($modulo11,($i-1),1) * $fator);
        $fator++;
      }
      $digito = ( 11 - ($resultado % 11) );

      return ( $digito == substr($modulo11, -1) )?true:false;
    }
    else
      return $ok;

  }

  /**
  * Gets object's value
  * @param boolean $db   Controls whether the CPF might be formatted or not before returning
  * @param string  $from { sys | pt_BR }
  * @param string  $to   { sys | pt_BR }
  * @returns string
  */
  function GetValue($db = false, $from = "pt_BR", $to = "sys")
  {
    if ($db)
      return Format_Modulo11($this->mValue, $from, $to);
    else
      return $this->mValue;
  }

  /**
  * Builds the object's JS onSubmit validation code
  * @returns string
  */
  function GetJSOnSubmit()
  {
    $out = "";
    $out .= "  ".$this->mName."_ok = true; \n";

    if ($this->mTestIfEmpty != 0)
      $out .= "  ".$this->mName."_ok = ".$this->mName."_ok && (!test_if_empty(document.".$this->mMainForm->mName.".".$this->mName.".value, '$this->mTestIfEmptyMessage', '".$this->mMainForm->mName."','$this->mName'));\n";

    $out .= "  ".$this->mName."_ok = ".$this->mName."_ok && validate_modulo11(";
    $out .= "'$this->mName', '$this->mError', '".$this->mMainForm->mName."');\n";

    $out .= "  ok = ok && ".$this->mName."_ok;\n";
    $out .= "  form_submitted = (form_submitted && ".$this->mName."_ok);\n\n";
    return $out;
  }

  /**
  * Builds object's output
  * @returns string
  */
  function GetHtml()
  {
    $out  = "\n";
    $out .= "<input class='".$this->MakeClass()."' id=\"".$this->MakeId()."\" type=\"text\" name=\"$this->mName\" value=\"".$this->GetValue()."\" ";
    $out .= "size=\"$this->mMaxLength\" maxlength=\"$this->mMaxLength\" $this->mDisabled ".$this->GetCssClass();

    //eventos JavaScript
    parent::SetDefaultEvents();
    $this->SetDefaultEvents();
    $out .= $this->BuildJSEvents();

    $out .= $this->mExtra.">\n";
    $out .= $this->GetTip();

    return $this->GetRawHtml($out);
  }
}

/**
* Hidden objects creation class
*
* @author  Atua Sistemas de Informação
*/
class JFormHidden extends JFormObject
{
  /**
  * Stores object's type
  * @var string
  */
  var $mType     = "Hidden";

  /**
  * Constructor
  * @param string $name  Field's name
  * @param string $value Field's value
  */
  function __construct($name, $value = false)
  {
    $this->SetName($name);
    $this->mEmpty = $this->IsEmpty();
    $this->SetDefaultValue($value);
    $this->SetDisabled();
  }

  /**
  * Builds object's output
  * @returns string
  */
  function GetHtml()
  {
    $out  = "\n";
    $out .= "<input class='".$this->MakeClass()."' id=\"".$this->MakeId()."\" type=\"hidden\" name=\"$this->mName\" value=\"".$this->GetValue()."\" ";
    $out .= " $this->mExtra>\n";

    return $this->GetRawHtml($out);
  }

}

class JFormJson extends JFormHidden
{
  function GetHtml()
  {
    $out  = "\n";
    $out .= "<input class='".$this->MakeClass()."' id=\"".$this->MakeId();
    $out .= "\" type=\"hidden\" name=\"$this->mName\" value=\"".str_replace("\"", "&quot;", $this->GetValue())."\" ";
    $out .= " $this->mExtra>\n";

    return $this->GetRawHtml($out);
  }
}


/**
* Undocumented - A weird hidden type. Its origin is still been researched
*
* @author  Atua Sistemas de Informação
*/
class JFormSubmitWHidden extends JFormObject
{
  /**
  * Stores object's type
  * @var string
  */
  var $mType = "Hidden";

  /**
  * Constructor
  * @param string $name  Field's name
  * @param string $value Field's value
  */
  function __construct($name, $value = false)
  {
    $this->mButton = new JFormSubmit("button_of_".$name);
    $this->SetName($name);
    $this->mEmpty = $this->IsEmpty();
    $this->SetDefaultValue($value);
    $this->SetDisabled();
  }

  /**
  * Sets object's default value
  * @param string $value Field's value
  */
  function SetDefaultValue($value = false)
  {
    $this->mButton->SetValue($value);
  }

  /**
  * Builds object's output
  */
  function GetHtml()
  {
    $out  = "\n";
    $out .= "<input class='".$this->MakeClass()."' id=\"".$this->MakeId()."\" type=\"hidden\" name=\"$this->mName\" value=\"".$this->GetValue()."\" ";
    $out .= $this->GetMaxLength()." $this->mDisabled $this->mExtra>\n";
    $this->mButton->mMainForm = $this->mMainForm;
    $this->mButton->SetExtra("OnClick='document." . $this->mMainForm->mName . "." . $this->mName . ".value = document." . $this->mMainForm->mName . "." . $this->mButton->mName . ".value'");
    $out .= $this->mButton->GetHtml();

    return $this->GetRawHtml($out);
  }

}

/**
* Button objects creation class
*
* @author  Atua Sistemas de Informação
*/
class JFormButton extends JFormObject
{
  /**
  * Stores object's type
  * @var string
  */
  var $mType = "Button";

  var $mAngularMaterialConfig;

  var $mAngularMaterialTemplates = array(
    "flat"    => "<md-button class=\":class\" :extra>:text</md-button>",
    "raised"  => "<md-button class=\"md-raised :class\" :extra>:text</md-button>",
    "fab"     => "<md-button class=\"md-fab :class\" :extra>
                    <md-tooltip>:text</md-tooltip>
                    <md-icon md-font-icon=\":icon\" class=\"fa fa-2x\"></md-icon>
                  </md-button>",
    "miniFab" => "<md-button class=\"md-fab md-mini :class\" :extra>
                    <md-tooltip>:text</md-tooltip>
                    <md-icon md-font-icon=\":icon\" class=\"fa fa-2x\"></md-icon>
                  </md-button>",
    "icon"    => "<md-button class=\"md-icon-button :class\" :extra>
                    <md-tooltip>:text</md-tooltip>
                    <md-icon md-font-icon=\":icon\" class=\"fa fa-2x\"></md-icon>
                  </md-button>"
  );

  /**
  * Constructor
  * @param string $name  Field's name
  * @param string $value Field's value
  */
  function __construct($name, $value = false)
  {
    $this->SetName($name);
    $this->mEmpty = $this->IsEmpty();
    $this->SetDefaultValue($value);
    $this->SetDisabled();
  }

  /**
   * @param $config {
   *   type: flat|raised|fab|miniFab|icon,
   *   text: '',
   *   theme?: primary|warn|accent,
   *   hue?: 0|1|2,
   *   icon?: ''
   * }
   */
  function UseAngularMaterial(array $config)
  {
    JObject::$useComponents = true;

    $this->mAngularMaterialConfig = $config;
  }

  function GetHtmlAngularMaterial()
  {
    $dsTemplate = $this->mAngularMaterialTemplates[$this->mAngularMaterialConfig["type"]];

    $dsClass = $this->MakeClass();

    if (str_value($this->mAngularMaterialConfig["theme"]))
      $dsClass .= " md-{$this->mAngularMaterialConfig["theme"]}";

    if (str_value($this->mAngularMaterialConfig["hue"]))
      $dsClass .= " md-hue-{$this->mAngularMaterialConfig["hue"]}";

    $dsExtra = "id=\"{$this->MakeId()}\" type=\"{$this->mType}\" name=\"{$this->mName}\" {$this->mDisabled} {$this->mExtra}";

    $this->SetDefaultEvents();
    $dsExtra .= $this->BuildJSEvents();

    $dsTemplate = str_replace(":text",  ifnull($this->mAngularMaterialConfig["text"], $this->GetValue()), $dsTemplate);
    $dsTemplate = str_replace(":icon",  $this->mAngularMaterialConfig["icon"],                            $dsTemplate);
    $dsTemplate = str_replace(":class", $dsClass,                                                         $dsTemplate);
    $dsTemplate = str_replace(":extra", $dsExtra,                                                         $dsTemplate);

    return $this->GetRawHtml("\n".$dsTemplate);
  }

  /**
  * Builds object's output
  * @returns string
  */
  function GetHtml()
  {
    if (str_value($this->mAngularMaterialConfig))
      return $this->GetHtmlAngularMaterial();

    $out  = "\n";
    $out .= "<input class='".$this->MakeClass()."' id=\"".$this->MakeId()."\" type=\"button\" name=\"$this->mName\" value=\"".$this->GetValue()."\" ";
    $out .= $this->GetCssClass().$this->GetMaxLength();
  
    //JavaScript events
    $this->SetDefaultEvents();
    $out .= $this->BuildJSEvents();
 
    $out .= " ".$this->mDisabled." ".$this->mExtra.">\n";

    return $this->GetRawHtml($out);
  }

}

/**
* Submit buttons creation class
*
* @author  Atua Sistemas de Informação
* @package Jaguar
*/
class JFormSubmit extends JFormButton
{
  /**
  * Stores object's type
  * @var string
  */
  var $mType = "Submit";

  /**
  * Constructor
  * @param string $name  Field's name
  * @param string $value Field's value
  */
  function __construct($name, $value = false)
  {
    $this->SetName($name);
    $this->mEmpty = $this->IsEmpty();
    $this->SetDefaultValue($value);
    $this->SetDisabled();
    $this->SetCssClass($this->mType);
  }

  /**
  * Builds object's output
  * @returns string
  */
  function GetHtml()
  {
    $out  = "\n";
    $out .= "<input class='".$this->MakeClass()."' id=\"".$this->MakeId()."\" type=\"submit\" name=\"".$this->mName.
            "\" value=\"".$this->GetValue()."\" ";
    $out .= "$this->mDisabled $this->mExtra ".$this->GetCssClass();

    $this->SetDefaultEvents();
    $out .= $this->BuildJSEvents();

    $out .= "onClick=\"javascript: form_submitted_keep = form_submitted;";
    $out .= "\">";
    $out .= $this->GetTip();

    return $this->GetRawHtml($out);
  }

}

/**
* Reset buttons creation class
*
* @author  Atua Sistemas de Informação
*/
class JFormReset extends JFormButton
{
  /**
  * Stores object's type
  * @var string
  */
  var $mType = "Submit";

  /**
  * Constructor
  * @param string $name  Field's name
  * @param string $value Field's value
  */
  function __construct($name, $value = false, $forceReset = false)
  {
    $this->SetName($name);
    $this->mEmpty = $this->IsEmpty();
    $this->SetDefaultValue($value);
    $this->SetDisabled();
    $this->SetCssClass($this->mType);
    $this->forceReset = $forceReset;

    $this->SetEvents("onClick", "void");
    $this->SetParameters("void", "form_submitted_keep = form_submitted", true);

    if ($this->forceReset)
    {
      $this->SetEvents("onClick", "resetDefaultValues");
      $this->SetParameters("resetDefaultValues", "this.form");
    }
  }

  /**
  * Builds object's output
  * @returns string
  */
  function GetHtml()
  { 
    $out  = "\n";
    $buttonType = ($this->forceReset)? "button" : "reset";
    $out .= "<input class='".$this->MakeClass()."' id=\"".$this->MakeId()."\" type=\"".$buttonType."\" name=\"$this->mName\" value=\"".$this->GetValue()."\" ";
    $out .= "$this->mDisabled $this->mExtra ".$this->GetCssClass();

    $this->SetDefaultEvents();
    $out .= $this->BuildJSEvents();

    $out .= ">\n";

    return $this->GetRawHtml($out);
  }

}

/**
* TextArea objects creation class
*
* @author  Atua Sistemas de Informação
*/
class JFormTextArea extends JFormObject
{

  /**
  * Stores object's type
  * @var string
  */
  var $mType = "TextArea";

  /**
  * Stores the object's number of the lines
  * @var int
  */
  var $mSizeL;

  /**
  * Stores the object's number of the columns
  * @var int
  */
  var $mSizeC;

  /**
  * Stores object's maximum size
  * @var int
  */
  var $mMaxSize = 0;

  /**
  * Controls if the object's value must be returned in uppercase letters
  * @var boolean
  */
  var $mUpper   = false;

  /**
  * Controls if the object's value must be returned in lowercase letters
  * @var boolean
  */
  var $mLower   = false;

  /**
  * Controls if the object's value must have special charecters converted before returning
  * @var boolean
  */
  var $mSpecialCharacter = false;

  /**
  *
  * @var boolean
  */
  var $mSpecialChar      = false;

  /**
  * Constructor
  * @param string $name  Field's name
  * @param string $value Field's value
  */
  function __construct($name, $value = false)
  {
    $this->SetName($name);
    $this->mEmpty = $this->IsEmpty();
    $this->SetDefaultValue($value);
    $this->SetSize();
  }

  /**
  * Sets default JS functions for JFormTextArea objects
  */
  function SetDefaultEvents()
  {
    if ($this->mMaxSize > 0)
    {
      $this->SetEvents("onKeyUp", "validate_text");
      $this->SetParameters("validate_text", "this");
      $this->SetParameters("validate_text", $this->mMaxSize);
    }
  }

  /**
  * Sets the number of columnss and lines
  * @param int $cols  Number of columns
  * @param int $lines Number of lines
  */
  function SetSize($cols = 100, $lines = 25)
  {
    $this->mSizeL = $lines;
    $this->mSizeC = $cols;
  }


  /**
  * Sets object's maximum size
  * @param int $maxlength
  */
  function SetMaxLength($maxlength = false)
  {
    $this->mMaxSize = $maxlength;
    if ($maxlength)
    {
      $this->mHasMaxLength = true;
      $this->mMaxLength = $maxlength;
      if ($this->mSize > $this->mMaxLength)
        $this->mSize = $this->mMaxLength;
    }
    else
    {
      $this->mHasMaxLength = false;
    }
  }

  /**
  * Sets if the object's value might be returned in uppercase letters
  *
  * If the $upper parameter is set to true, the mLower property is automatically
  * set to false
  *
  * @param boolean $upper
  */
  function SetUpper($upper = true)
  {
    $this->mUpper = is_bool($upper)?$upper:true;
    $this->mLower = ($this->mUpper && $this->mLower)?false:$this->mLower;
  }
  
  /**
  * Sets if the object's value might be returned in lowercase letters
  *
  * If the $upper parameter is set to true, the mUpper property is automatically
  * set to false
  *
  * @param boolean $lower
  */
  function SetLower($lower = true)
  {
    $this->mLower = is_bool($lower)?$lower:false;
    $this->mUpper = ($this->mLower&& $this->mUpper)?false:$this->mLower;
  }

  /**
  * Sets whether the special characters might be converted to commom characters or not
  *
  * For example, if the $specialCharacter parameter is true, characters like <b>â</b>
  * and <b>ü</b>will be converted to <b>a</b><b>u</b>, respectively.
  *
  * @param boolean $specialCharacter
  */
  function SetSpecialCharacter($specialCharacter = true)
  {
    $this->mSpecialCharacter = is_bool($specialCharacter)?$specialCharacter:true;
  }

  /**
  * Gets object's value
  * @returns string
  */
  function GetValue($dt = false)
  {
    if ($this->mSpecialCharacter)
    {
      $trans = array( "Á" => "A", "Ã" => "A", "À" => "A", "Â" => "A", "Ä" => "A",
                      "É" => "E", "È" => "E", "Ê" => "E", "Ë" => "E",
                      "Í" => "I", "Ì" => "I", "Î" => "I", "Ï" => "I",
                      "Ó" => "O", "Õ" => "O", "Ò" => "O", "Ô" => "O", "Ö" => "O",
                      "Ú" => "U", "Ù" => "U", "Û" => "U", "Ü" => "U",
                      "Ç" => "C", "Ñ" => "N", "Ý" => "Y",
                      "á" => "a", "ã" => "a", "à" => "a", "â" => "a", "ä" => "a",
                      "é" => "e", "è" => "e", "ê" => "e", "ë" => "e",
                      "í" => "i", "ì" => "i", "î" => "i", "ï" => "i",
                      "ó" => "o", "õ" => "o", "ò" => "o", "ô" => "o", "ö" => "o",
                      "ú" => "u", "ù" => "u", "û" => "u", "ü" => "u",
                      "ç" => "c", "ñ" => "n", "ý" => "y", "ÿ" => "y",
                      "º" => "", "ª" => "", "°" => "");

      $this->mValue = implode("", array_filter(str_split(strtr($this->mValue, $trans)), function($str)
      {
        $nrAscii = ord($str);

        // de "espaço" até "~"
        if ($nrAscii >= 32 && $nrAscii <= 126) return true;
        // caracter "§"
        if (chr($nrAscii) == "§") return true;
        // caracter "\n"
        if ($nrAscii == 10) return true;

        return false;
      }));
    }

    if ($this->mSpecialChar)
      $this->mValue = preg_replace("/$this->mRegEx/", "", $this->mValue);
    
    if ($this->mUpper)
      $this->mValue = Convert_String($this->mValue, "upper");

    if ($this->mLower)
      $this->mValue = Convert_String($this->mValue, "lower"); 

    if (strlen($this->mTrim))
    {
      switch ($this->mTrim)
      {
        case "left" : $this->mValue = ltrim($this->mValue); break;
        case "right": $this->mValue = rtrim($this->mValue); break;
        case "all"  : $this->mValue = trim($this->mValue);  break;
      }
    }

    while (substr($this->mValue, 0, 1) == "(" && substr($this->mValue, -1) == ")")
      $this->mValue = substr($this->mValue, 1, -1);
    
    if ($this->mMaxSize > 0)
      $this->mValue = substr($this->mValue, 0, $this->mMaxSize);

    return $this->mValue;
  }

  function GetJSOnSubmit()
  {
    $obj = "document." . $this->mMainForm->mName . "." . $this->mName;
    $var = $this->mName . "_value";

    $out = "";
    $out .= "  $var = $obj.value;\n";
    $out .= "  while ($var.substr(0, 1) == '(' && $var.substr($var.length-1, 1) == ')')\n";
    $out .= "    $var = $var.substring(1, $var.length-1);\n";
    $out .= "  $obj.value = $var;\n";
    $out .= parent::GetJSOnSubmit();

    return $out;
  }

  /**
  * Builds HTML code of the object
  * @returns string
  */
  function GetHtml()
  {
    $out = "";
    $out .= "<textarea class='".$this->MakeClass()."' id=\"".$this->MakeId()."\" name=\"$this->mName\" ".$this->mDisabled ;
    $out .= $this->GetCssClass().$this->GetMaxLength();

    //eventos JavaScript
    parent::SetDefaultEvents();
    $this->SetDefaultEvents();
    $out .= $this->BuildJSEvents();

    $out .= " $this->mExtra>";
    $out .= $this->GetValue();
    $out .= "</textarea>\n";
    $out .= $this->BuildPopUp()."\n";
    $out .= $this->GetTip();

    return $this->GetRawHtml($out);
  }
}

/**
* Select objects creation class
*
* @author  Atua Sistemas de Informação
*/
class JFormSelect extends JFormObject
{
  /**
  * Stores object's type
  * @var string
  */
  var $mType         = "Select";

  /**
  * Controls if the object is disabled
  * @var string
  */
  var $mDisabled;

  /**
  * Controls if select accepted multiple choice
  * @var string
  */
  var $mMultiple;

  /**
   * @var boolean
   */
  var $mFilter = false;

  /**
  * Controls the select's number of options
  * @var int
  */
  var $mOptionsIdx;

  /**
  * Stores select's options
  * @var array
  */
  var $mOptions      = array();

  /**
  * Controls if the first option of select is empty
  * @var boolean
  */
  var $mFirstEmpty   = false;

  /**
  * Controls whether the JFormSelect may be selectd by default
  * @var boolean
  */
  var $mControlsSelected;

  /**
  * Controls order of the options, about value or description
  * @var string
  */
  var $mOrder;
  
  /**
  * Controls what value will be the first option (after the empty one)
  * @var integer
  */
  var $mFirstValue;
  
  /**
  * Constructor
  * @param string $name  Field's name
  * @param string $value Field's value
  */
  function __construct($name, $value = false)
  {
    $this->SetName($name);
    $this->mEmpty = $this->IsEmpty();
    $this->SetDefaultValue($value);
    $this->SetDisabled();
    $this->SetSize();
    $this->SetMultiple();
    $this->SetControlsSelected();
    $this->mOptionsIdx = 0;
  }
  
  /**
  * Sets Width and/or height to field
  * @param int $sizeWidth width value
  * @param int $sizeHeight height value
  */
  function SetDisplaySize($sizeWidth = 100, $sizeHeight = null)
  {
    if ($sizeHeight != null) $height = "height: " . $sizeHeight . "px;";
    $this->SetExtra("style=\"width: " . $sizeWidth . "px; $height\"");
  }

  function SetDisplayFilter($isDisplay = false)
  {
    $this->mFilter = $isDisplay;
  }

  /**
  * Sets select's size
  * @param int $size
  */
  function SetSize($size = 1)
  {
    $this->mSize = $size;
  }

  /**
  * Controls whether the JFormSelect may be selectd by default
  * @param int $size
  */
  function SetControlsSelected($bool = true)
  {
    $this->mControlsSelected = $bool;
  }

  /**
  * Sets the use of multiple choices in select
  * @param boolean $multiple
  */
  function SetMultiple($multiple = false)
  {
    $this->mMultiple = ($multiple)?"multiple":"";
  }

  /**
  * Adds options in select
  * @param string $value Field's value
  * @param string $text  Field's description
  */
  function AddOption($value, $text = false)
  {
    $text = str_value($text) ? $text : $value;
    $this->mOptions[$this->mOptionsIdx]["value"]        = $value;
    $this->mOptions[$this->mOptionsIdx]["description"]  = $text;
    $this->mOptionsIdx++;
  }

  /**
  * Sets options of the JFormSelect object
  * @param array $arr Associative array with the followin structure:<br><pre>
  * $options[] = array("value" => 1, "description" => "One");
  * $options[] = array("value" => 2, "description" => "Two");
  * $options[] = array("value" => 3, "description" => "Three"); </pre>
  */
  function SetOptions($arr)
  {
    if (is_array($arr))
    {
      foreach ($arr as $key => $value)
      {
        if (is_array($value))
        {
          if (isset($value["value"]))
            $this->AddOption($value["value"], $value["description"]);
          else
            $this->AddOption($value[0], $value[1]);
        }
        else
          $this->AddOption($key, $value);
      }
    }
  }
  
  /**
  * Sets order of the options of the JFormSelect object
  * @param string $order
  */
  function SetOrder($order = "description")
  {
    $order = strtolower($order);

    if ($order == "value" || $order == "description")
      $this->mOrder = $order;
  }

  /**
  * Sets what option will be the first item (after the empty) on the JFormSelect object
  * @param integer $value
  */
  function SetFirstValue($value)
  {
    if (is_numeric($value)) $this->mFirstValue = $value;
  }

  /**
  * Sets the variable that controls if the first option of select is empty
  * @param boolean $bool
  */
  function SetFirstEmpty($bool = true)
  {
    $this->mFirstEmpty = (bool)$bool;
  }


  /**
  * Builds object's output
  * @returns string
  */
  function GetHtml()
  {
    if (count($this->mOptions)==1 && $this->mTestIfEmpty)
      $this->SetDefaultValue($this->mOptions[0]["value"]);
    
    $out  = "\n";

    if ($this->mFilter)
    {
      $out .= '<a href="javascript:void(0);" id="' . $this->mName . '-apply-select-filter"><img src="' . JAGUAR_URL . '/img/filter.png" style="vertical-align: middle; cursor: pointer;" border="0" alt="Filtro" title="Filtro"></a>';
    }

    $out .= "<select class=\"".$this->MakeClass()."\" id=\"".$this->MakeId()."\" name=\"$this->mName\" size=\"$this->mSize\" $this->mDisabled";
    $out .= " ".$this->mMultiple." ".$this->GetCssClass();

    $this->SetDefaultEvents();
    
    $out .= $this->BuildJSEvents();
    $out .= " ".$this->mExtra.">\n";

    if ($this->mFilter)
    {
      $out .=
        '
          <script type="text/javascript">
            $(document).ready(function() {
              $("#' . $this->mName . '-apply-select-filter").click(function() {
                $("select[name='. $this->mName . ']").selectFilter({
                    width: "auto",
                    minimumSelectElementSize: 5,
                    linkFilterId: "' . $this->mName . '-apply-select-filter",
                    originalWidth: $("select[name='. $this->mName . ']").width()
                });

                $(this).hide();
              });
            });
          </script>
        ';
    }

    if ($this->mOrder)
    {
      $t_arr  = array();
      $tt_arr = array();

      foreach ($this->mOptions as $key => $value)
        $t_arr[$key] = $value[$this->mOrder];
      
      natcasesort($t_arr);

      foreach ($t_arr as $key => $value)
      {
        $tt_arr[] = array("value" =>       ($this->mOrder == "value" ?       $value : $this->mOptions[$key]["value"]),
                          "description" => ($this->mOrder == "description" ? $value : $this->mOptions[$key]["description"]));
      }

      $this->mOptions = $tt_arr;
    }

    if (is_numeric($this->mFirstValue))
    {
      $t_arr  = array();
      $tt_arr = array();

      foreach ($this->mOptions as $value)
      {
        if ($value["value"] != $this->mFirstValue)
          $t_arr[] = $value;
        else
          $tt_arr = $value;
      }

      if (sizeof($tt_arr) > 0)
      {
        array_unshift($t_arr, $tt_arr);
        $this->mOptions = $t_arr;
      }
    }

    if ($this->mFirstEmpty)
    {
      $array = array("value" => "", "description" => "");
      array_unshift($this->mOptions, $array);
      $this->mOptionsIdx++;
    }

    //options
    for ($i = 0; $i < $this->mOptionsIdx; $i++)
    {
      $out .= "  <option value=\"".$this->mOptions[$i]["value"]."\"";
    
      if ($this->mControlsSelected)
        if ($this->mOptions[$i]["value"] == $this->GetValue() && strlen($this->GetValue()))
          $out .= " selected";

      $out .= ">".$this->mOptions[$i]["description"]."</option>\n";
    }
    
    $out .= "</select>";
    $out .= $this->BuildPopUp()."\n";
    $out .= $this->GetTip();

    return $this->GetRawHtml($out);
  }
}

/**
* DualList objects creation class
* 
* @author  Atua Sistemas de Informação 
* @since   2003-10-08
*/
class JFormDualList extends JFormObject
{
  /**
  * Stores object's type
  * @var string
  */
  var $mType     = "DualList";

  /**
  * Stores the dual list's main table object (a JTable object)
  * @var object
  */
  var $mMainTable;

  /**
  * Stores the dual list's internal table object (a JTable object)
  * @var object
  */
  var $mInternalTable;

  /**
  * Stores the origin's list object (a JFormSelect object)
  * @var object
  */
  var $mOriginList;
  
  /**
  * Stores the destination's list object (a JFormSelect object)
  * @var object
  */
  var $mDestinationList;

  /**
  * Stores the lista' size
  * @var int
  */
  var $mListSize = 7;

  /**
  * Stores the movimentation's buttons
  * @var array
  */
  var $mChangeButtons;

  
  /**
  * Constructor
  * @param string $name  Field's name
  */
  function __construct($name)
  {
    $this->SetName($name);
    $this->mEmpty = $this->IsEmpty();

    //Tables
    $this->mMainTable = new JTable(array("class" => "noborder"));
    $this->mMainTable->SetLineStyles("rowodd", "rowodd", "roweven", "roweven");
    $this->mInternalTable = new JTable(array("class" => "noborder"));

    //Lists
    $this->mOriginList = new JFormSelect($this->mName."_origin[]");
    $this->mOriginList->SetMultiple(true);
    $this->mDestinationList = new JFormSelect($this->mName."_destination[]");
    $this->mDestinationList->SetMultiple(true);
  }

  /**
  * Sets the list size
  * @param int $size Number os options displayed in the lists (withou the toolbar)
  */
  function SetListSize($size = 7)
  {
    $this->mListSize = (is_numeric($size))?$size:7;
  }

  /**
  * Sets Width and/or height to field
  * @param int $sizeWidth width value
  * @param int $sizeHeight height value
  */
  function SetDisplaySize($sizeWidth = 100, $sizeHeight = null)
  {
    if ($sizeHeight != null) $height = "height: " . $sizeHeight . "px;";
    $this->mOriginList->SetExtra("style=\"width: " . $sizeWidth . "px; $height\"");
    $this->mDestinationList->SetExtra("style=\"width: " . $sizeWidth . "px; $height\"");
  }

  /**
  * Sets the lists' options
  * @param array  $arr  Associative array containig the list's options
  * @param string $list List's name. { origin | destination }
  */
  function SetOptions ($arr, $list = "origin")
  {
    if (sizeof($arr) > 0)
    {
      switch ($list)
      {
        case "origin":
          $this->mOriginList->SetOptions($arr);
        break;

        case "destination":
          $this->mDestinationList->SetOptions($arr);
        break;
      }
    }
  }

  /*
  * Sets whether the object must be filled or not and when the error messahe will be shown
  *
  * @param int    $test    Controls the test's moment.
  * Possible values for $test are: <br>
  * 0 - no test <br>
  * 1 - test on onSubmit event only <br>
  * 2 - test on onBlur/onSubmit events 
  * @param string $message Error message
  */
  function SetTestIfEmpty ($test = 0, $message = "Por favor, preencha o campo!")
  {
    $this->mDestinationList->SetTestIfEmpty($test, $message);
  }

  /**
  * Builds the object's JS onSubmit validation code
  * @returns string
  */
  function GetJSOnSubmit ()
  {
    /*
    $js  = "  dual_list = eval(\"document.".$this->mMainForm->mName.
           ".elements['".$this->mName."_destination[]']\");\n";
    $js .= "  for(i = 0; i < dual_list.options.length; i++)\n".
           "    dual_list.options[i].selected = true;\n\n";
    */

    $js =  "  dual_list = eval(\"document.".$this->mMainForm->mName.
           ".elements['".$this->mName."_destination[]']\");\n";
    $js .= "  SelectDualListOptions(dual_list);\n\n";
    
    if ($this->mDestinationList->mTestIfEmpty != 0)
    {
      $js .= "  ".$this->mName."_destination_ok = (!test_if_empty(".
                "document.".$this->mMainForm->mName.".elements['".$this->mName."_destination[]'], ".
                "'".$this->mDestinationList->mTestIfEmptyMessage."', ". 
                "'".$this->mMainForm->mName."', ".
                "'".$this->mName."_destination[]', ".
                "'DualList'));\n";
      $js .= "  ok = (ok && ".$this->mName."_destination_ok);\n\n";
      $js .= "  form_submitted = (form_submitted && ".$this->mName."_destination_ok);\n\n";
    }

    return $js;
  }

  /**
  * Sets the object's value
  */
  function SetValue($value = false)
  {
    $this->mValue = ($GLOBALS[$this->mName."_destination"])?$GLOBALS[$this->mName."_destination"]:0;
  }
 
  /**
  * Get's the object's value
  * @returns mixed
  */
  function GetValue($dt = false)
  {
    return ($GLOBALS[$this->mName."_destination"])?$GLOBALS[$this->mName."_destination"]:0;
  }
  
  /**
  * Builds object's output
  * @returns string
  */
  function GetHtml()
  {
    $this->mMainTable->OpenRow();
    $this->mMainTable->OpenCell();
    $this->mOriginList->SetSize($this->mListSize);
    $this->mMainTable->AddObject($this->mOriginList);
    
    $this->mMainTable->OpenCell();
    $this->mInternalTable->OpenRow();
    $this->mChangeButton[">"] = new JFormButton(">", ">");
    $js = "style=\"width:25; height:20\" ".
          "onclick=\"moveDualList(this.form.elements['".$this->mName."_origin[]'], ".
                                 "this.form.elements['".$this->mName."_destination[]'], ".
                                 "false, true)\"";
    $this->mChangeButton[">"]->SetExtra($js);
    $this->mChangeButton[">"]->MakeId($this->mName . "_right");
    $this->mInternalTable->OpenCell();
    $this->mInternalTable->AddObject($this->mChangeButton[">"]);
    
    $this->mInternalTable->OpenRow();
    $this->mChangeButton[">>"] = new JFormButton(">>", ">>");
    $js = "style=\"width:25; height:20\" ".
          "onclick=\"moveDualList(this.form.elements['".$this->mName."_origin[]'], ".
                                 "this.form.elements['".$this->mName."_destination[]'], ".
                                 "true, true)\"";
    $this->mChangeButton[">>"]->SetExtra($js);
    $this->mChangeButton[">>"]->MakeId($this->mName . "_all_right");
    $this->mInternalTable->OpenCell();
    $this->mInternalTable->AddObject($this->mChangeButton[">>"]);
 
    $this->mInternalTable->OpenRow();
    $this->mChangeButton["<"] = new JFormButton("<", "<");
    $js = "style=\"width:25; height:20\" ".
          "onclick=\"moveDualList(this.form.elements['".$this->mName."_destination[]'], ".
                                 "this.form.elements['".$this->mName."_origin[]'], ".
                                 "false, false)\"";
    $this->mChangeButton["<"]->SetExtra($js);
    $this->mChangeButton["<"]->MakeId($this->mName . "_left");
    $this->mInternalTable->OpenCell();
    $this->mInternalTable->AddObject($this->mChangeButton["<"]);
    
    $this->mInternalTable->OpenRow();
    $this->mChangeButton["<<"] = new JFormButton("<<", "<<");
    $js = "style=\"width:25; height:20\" ".
          "onclick=\"moveDualList(this.form.elements['".$this->mName."_destination[]'], ".
                                 "this.form.elements['".$this->mName."_origin[]'], ".
                                 "true, false)\"";
    $this->mChangeButton["<<"]->SetExtra($js);
    $this->mChangeButton["<<"]->MakeId($this->mName . "_all_left");
    $this->mInternalTable->OpenCell();
    $this->mInternalTable->AddObject($this->mChangeButton["<<"]);
    $this->mInternalTable->CloseTable();
    $this->mMainTable->AddObject($this->mInternalTable);

    $this->mMainTable->OpenCell();
    $this->mDestinationList->SetSize($this->mListSize);
    $this->mMainTable->AddObject($this->mDestinationList); 
 
    $out = "";

    $this->mMainTable->MakeId(++$this->mId);

    /**
     * mantém a largura dos campos iguais
     * só funciona corretamente se o min-width está definido no style.css
     */
    $this->mMainTable->AddJS("
      if (window.jQuery)
      {
        function resizeDualList_".$this->mName."()
        {
          minWidth = $('select[name^=".$this->mName."_origin]').css('min-width').replace(/[^0-9]/g, '');

          if (isNaN(minWidth) || parseFloat(minWidth) == 0) return;

          if ($('select[name^=".$this->mName."_origin]').width() >= $('select[name^=".$this->mName."_destination]').width())
          {
            $('select[name^=".$this->mName."_destination]').width($('select[name^=".$this->mName."_origin]').width());
            $('select[name^=".$this->mName."_origin]').width($('select[name^=".$this->mName."_destination]').width());
          }
          else
          {
            $('select[name^=".$this->mName."_origin]').width($('select[name^=".$this->mName."_destination]').width());
            $('select[name^=".$this->mName."_destination]').width($('select[name^=".$this->mName."_origin]').width());
          }
        }

        $(document).ready(function(){
          resizeDualList_".$this->mName."();
        });
      }
    ");

    $out .= $this->mMainTable->GetHtml();
    $this->mId = $this->mMainTable->MakeId(); 

    $this->SetValue();

    return $this->GetRawHtml($out);
  }
}

/**
* Radio objects creation class
*
* @author  Atua Sistemas de Informação
*/
class JFormRadio extends JFormObject
{
  /**
  * Stores object's type
  * @var string
  */
  var $mType = "Radio";

  /**
  * Controls the use of divider between the buttons
  * @var string
  */
  var $mDivisor;

  var $mOptionsIdx;

  var $mOptions = array();

  /**
  * Constructor
  * @param string $name  Field's name
  * @param string $value Field's value
  */
  function __construct($name, $value = false)
  {
    $this->SetName($name);
    $this->mEmpty = $this->IsEmpty();
    $this->SetDefaultValue($value);
    $this->SetDisabled();
    $this->SetDivisor();
    $this->mOptionsIdx = 0;
    $this->SetCssClass($this->mType);
  }

  /**
  * Sets the use of divider between the buttons
  * @param string $diviser A atring that separates the radion options. Eg.: "|"
  */
  function SetDivisor($divisor = false)
  {
    $this->mDivisor = ($divisor)?$divisor:"";
  }

  /**
  * Adds options
  * @param string $value Field's value
  * @param string $text  Field's label
  */
  function AddOption($value, $text = false)
  {
    $text = ($text)?$text:$value;
    $this->mOptions[$this->mOptionsIdx]["value"] = $value;
    $this->mOptions[$this->mOptionsIdx]["description"]  = $text;
    $this->mOptionsIdx++;
  }

  /**
  * Removes an option through it's value
  * @param string $value Action's value 
  */
  function RemoveOption($value)
  {
    $index = $this->findInmOptions($this->mOptions, $value);
    //if the item exists in the array
    if ($index !== false)
    {
      $oldValue = $this->mOptions[$index]["value"];
      //remove the item
      unset($this->mOptions[$index]);

      //if the deleted option was the one who held the action value
      if ($value == $oldValue)
      {
        //if there is anymore actions
        if (sizeof($this->mOptions) > 0)
        {
          $option = current($this->mOptions);
          $this->SetValue($option["value"]);
        }
        else
          $this->SetValue("");
      }
        
    }
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
      if (strcasecmp($arrValue["value"],$value) == 0)
        return $index;
    }

    return false;
  }

  /**
  * Sets options of the JFormSelect object
  * @param array $arr Associative array with the followin structure:<br><pre>
  * $options[] = array("value" => 1, "description" => "One");
  * $options[] = array("value" => 2, "description" => "Two");
  * $options[] = array("value" => 3, "description" => "Three"); </pre>
  */
  function SetOptions($arr)
  {
    $this->mOptions = $arr;
    $this->mOptionsIdx = sizeof($arr);
  }

  /**
  * Builds the object's JS onSubmit validation code
  * @returns string
  */
  function GetJSOnSubmit()
  {
    $out = "";

    if ($this->mTestIfEmpty != 0)
    {
      $out .= "  ".$this->mName."_ok = (!test_if_empty(";
      $out .= "'', '$this->mTestIfEmptyMessage', ";
      $out .= "'".$this->mMainForm->mName."', '$this->mName', 'Radio'));\n";
      $out .= "  ok = (ok && ".$this->mName."_ok);\n";
      $out .= "  form_submitted = (form_submitted && ".$this->mName."_ok);\n\n";
    }

    return $out;
  }

  /**
  * Builds object's output
  * @returns string
  */
  function GetHtml()
  {
    $out  = "\n";

    for ($i = 0; $i < $this->mOptionsIdx; $i++)
    {
      if (!is_array($this->mOptions[$i]))
        continue;

      $out .= "<label><input class='".$this->MakeClass()."' id=\"".$this->MakeId()."\" type=\"radio\" name=\"$this->mName\" value=\"" . $this->mOptions[$i]["value"] . "\"";
      if ($this->mOptions[$i]["value"] == $this->GetValue() )
        $out .= " checked ";
      $out .= $this->GetCssClass().$this->GetEmptyTest();
      $out .= " $this->mDisabled $this->mExtra>";
      $out .= $this->mOptions[$i]["description"] . "</label>";
      $out .= $this->mDivisor . "\n";
    }

    return $this->GetRawHtml($out);
  }
}

/**
* CheckBox objects creation class
*
* @author  Atua Sistemas de Informação
*/
class JFormCheckBox extends JFormObject
{
  /**
   * Descrição do label
   * @var text
   */
  var $mDescription;
  /**
  * Stores object's type
  * @var string
  */
  var $mType = "CheckBox";

  var $mOptionsIdx;

  var $mOptionsChecked;

  var $mOptions = array();

  /**
  * Constructor
  * @param string $name  Field's name
  * @param string $value Field's value
  */
  function __construct($name, $value = false)
  {
    $this->SetName($name);
    $this->mEmpty = $this->IsEmpty();
    $this->SetDefaultValue($value);
    $this->SetDisabled();
    $this->SetDivisor();
    $this->mOptionsIdx = 0;
    $this->SetCssClass($this->mType);
  }

  /**
  * Sets the use of divider between the buttons
  * @param string $diviser A atring that separates the radion options. Eg.: "|"
  */
  function SetDivisor($divisor = false)
  {
    $this->mDivisor = ($divisor)?$divisor:"";
  }
  
  /**
   * Sets the Description of the label
   * @param type $description
   */
  function SetDescription($description = false)
  {
    $this->mDescription = ($description) ? $description : "";
  }

  /**
  * Builds the object's JS onSubmit validation code
  * @returns string
  */
  function GetJSOnSubmit()
  {
    $out = "";

    if ($this->mTestIfEmpty != 0)
    {
      $out .= "  ".$this->mName."_ok = (!test_if_empty(";
      $out .= "'', '$this->mTestIfEmptyMessage', ";
      $out .= "'".$this->mMainForm->mName."', '$this->mName', 'CheckBox'));\n";
      $out .= "  ok = (ok && ".$this->mName."_ok);\n";
      $out .= "  form_submitted = (form_submitted && ".$this->mName."_ok);\n\n";
    }

    return $out;
  }

  function SetChecked(array $arrValues)
  {
    $this->mOptionsChecked = $arrValues;
  }

  function GetChecked()
  {
    return $this->mOptionsChecked ? $this->mOptionsChecked : array();
  }

  /**
  * Builds object's output
  * @returns string
  */
  function GetHtml()
  {
    $out  = "\n";

    $out .= "<label style='cursor:pointer'><input class='".$this->MakeClass()."' id=\"".$this->MakeId()."\" type=\"CheckBox\" name=\"$this->mName\" value=\"" . $this->GetValue() . "\"";
    if (in_array($this->GetValue(), $this->GetChecked())) $out .= " checked ";
    $out .= $this->GetCssClass().$this->GetEmptyTest();
    $out .= " $this->mDisabled $this->mExtra>";
    if (strlen($this->mDescription)) $out .= " " . $this->mDescription;
    $out .= "</label>";
    $out .= $this->mDivisor . "\n";
    
    return $this->GetRawHtml($out);
  }

}

  /**
   * CheckBox objects creation class
   *
   * @author  Atua Sistemas de Informação
   */
  class JFormCheckBoxes extends JFormObject
  {
    /**
     * Descrição do label
     * @var text
     */
    var $mDescription;
    /**
     * Stores object's type
     * @var string
     */
    var $mType = "CheckBox";

    var $mOptionsIdx;

    var $mOptionsChecked;

    var $mOptionsBreakLine;

    var $mOptions = array();

    /**
     * Constructor
     * @param string $name  Field's name
     * @param string $value Field's value
     */
    function __construct($name, $value = false)
    {
      $this->SetName($name);
      $this->mEmpty = $this->IsEmpty();
      $this->SetDefaultValue($value);
      $this->SetDisabled();
      $this->SetDivisor();
      $this->mOptionsIdx = 0;
      $this->SetCssClass($this->mType);

      $this->mOptionsBreakLine = array();
    }

    /**
     * Sets the use of divider between the buttons
     * @param string $diviser A atring that separates the radion options. Eg.: "|"
     */
    function SetDivisor($divisor = false)
    {
      $this->mDivisor = ($divisor)?$divisor:"";
    }

    /**
     * Sets the Description of the label
     * @param type $description
     */
    function SetDescription($description = false)
    {
      $this->mDescription = ($description) ? $description : "";
    }

    /**
     * Builds the object's JS onSubmit validation code
     * @returns string
     */
    function GetJSOnSubmit()
    {
      $out = "
        $(document).ready(function(){
          $('#{$this->mName}_hidden').val('');
          $('.$this->mName').each(function(){
            if ($(this).prop('checked'))
              $('#{$this->mName}_hidden').val($('#{$this->mName}_hidden').val() + $(this).val() + ',');
          });

          if ($('#{$this->mName}_hidden').val() != '')
            $('#{$this->mName}_hidden').val('{' + $('#{$this->mName}_hidden').val().replace(/,+$/, '') + '}');
        });
      ";

      if ($this->mTestIfEmpty != 0)
      {
        $out .= "  ".$this->mName."_ok = (!test_if_empty(";
        $out .= "'', '$this->mTestIfEmptyMessage', ";
        $out .= "'".$this->mMainForm->mName."', '$this->mName', 'CheckBox'));\n";
        $out .= "  ok = (ok && ".$this->mName."_ok);\n";
        $out .= "  form_submitted = (form_submitted && ".$this->mName."_ok);\n\n";
      }

      return $out;
    }

    function SetOptions(array $array)
    {
      $this->mOptions = $array;
    }

    function AddOption(array $array)
    {
      $this->mOptions = array_merge($this->mOptions, $array);
    }

    function SetValue($value = false)
    {
      $value = explode(",", str_replace(array("{", "}"), "", $value));
      $this->SetChecked($value);
    }

    function SetDefaultValue($value = false)
    {
      $this->SetChecked(array($value));
    }

    function SetChecked(array $arrValues)
    {
     $this->mOptionsChecked = $arrValues;
    }

    function GetChecked()
    {
      return $this->mOptionsChecked;
    }

    function SetOptionsBreakLine(array $array)
    {
      $this->mOptionsBreakLine = $array;
    }

    /**
     * Builds object's output
     * @returns string
     */
    function GetHtml()
    {
      $out  = "\n";

      $idCheckBox = new JFormHidden($this->mName);
      $idCheckBox->MakeId($this->mName . "_hidden");
      $out .= $idCheckBox->GetHtml();

      $out .= $this->montarCampos($this->mOptions);

      return $this->GetRawHtml($out);
    }

    private function montarCampos($options = array())
    {
      $out = "";

      foreach ($options AS $value => $description)
      {
        if (!is_numeric($value) && is_array($description))
        {
          $out .= "<div style=\"float:left; padding: 0px 5px;\">$value<br />";
          $out .= $this->montarCampos($description);
          $out .= "</div>";
          continue;
        }

        unset($idCheckBoxes);
        $idCheckBoxes = new JFormCheckBox($this->mName . "_" . $value);
        $idCheckBoxes->SetDescription($description);
        $idCheckBoxes->SetDivisor(in_array($value, $this->mOptionsBreakLine) ? "<br>" : "&nbsp;&nbsp;&nbsp;");

        if (str_value($this->mDivisor))
          $idCheckBoxes->SetDivisor($this->mDivisor);

        $idCheckBoxes->SetValue($value);
        $idCheckBoxes->SetChecked($this->GetChecked());
        $idCheckBoxes->MakeClass($this->mName . ($this->mClass != $this->mName ? " " . $this->mClass : ""));
        $idCheckBoxes->MakeId($this->MakeId());
        $idCheckBoxes->SetExtra($this->mExtra);
        $out .= $idCheckBoxes->GetHtml();
      }

      return $out;
    }
  }

/**
* Layer objects base class - Not used, undocumented
*
* @author  Atua Sistemas de Informação
* @author  Álvaro Nunes
* @since
* @package Jaguar
*/
class JFormLayer extends JFormObject
{
  /**
  * Stores object's type
  * @var string
  */
  var $mType = "Layer";

  /**
  * Stores layer's name
  * @var string
  */
  var $mLayerName;

  /**
  * Constructor
  * @param string $name  Field's name
  * @param string $value Field's value
  */
  function __construct($name, $value = false)
  {
    $this->SetName($name, $layerName);
    $this->mEmpty = $this->IsEmpty();
    $this->SetDefaultValue($value);
  }

  /**
  * Sets layer's name
  * @param string $name  Field's name
  * @internal string $layerName
  */
  function SetName($name)
  {
    $args      = func_get_args();
    $layerName = $args[1];
    
    $this->mName = $name;
    $this->mLayerName = $layerName;
  }

  /**
  * Builds the object's JS onSubmit validation code
  */
  function GetJSOnSubmit()
  {
    $out = "";

    if ($this->mTestIfEmpty != 0)
    {
      $out .= "  ".$this->mName."_ok = (!test_if_empty(";
      $out .= "'', '$this->mTestIfEmptyMessage', ";
      $out .= "'', '".$this->mName."_ly', 'Layer'));\n";
      $out .= "  ok = (ok && ".$this->mName."_ok);\n\n";
      $out .= "  form_submitted = (form_submitted && ".$this->mName."_ok);\n";
    }

    return $out;
  }

  /**
  * Builds object's output
  */
  function GetHtml()
  {
    $out = "";
    $out .= "<span id=\"".$this->mLayerName."\" $this->mExtra></span>\n";
    $out .= "<input class='".$this->MakeClass()."' id=\"".$this->MakeId()."\" type=\"hidden\" name=\"$this->mName\" value=\"".$this->GetValue()."\" ";
    $out .= "$this->mExtra>\n";

    return $this->GetRawHtml($out);
  }
}

/**
* Layer objects base class - Not used, undocumented
*
* @author  Atua Sistemas de Informação
* @author  Álvaro Nunes
* @since
* @package Jaguar
*/
class JFormPopUp extends JFormObject
{
  /**
  * Stores layer's name
  * @var string
  */
  var $mLayerName;

  /**
  * Stores object's type
  * @var string
  */
  var $mType               = "PopUp";

  /**
  * Stores the codes of the item of popup
  * @var array
  */
  var $mCodeItems;

  /**
  * Stores the number of codes
  * @var int
  */
  var $mCodeIndex;

  /**
  * Stores the descriptions of the item of popup
  * @var array
  */
  var $mDescriptionItems;

  /**
  * Stores the number of descriptions
  * @var int
  */
  var $mDescriptionIndex;

  /**
  * Stores the url of the popup
  * @var string
  */
  var $mUrl;

  /**
  * Stores popup's height
  * @var string
  */
  var $mHeight;

  /**
  * Stores popup's link
  * @var string
  */
  var $mLink               = "Link";

  /**
  * Constructor
  * @param string $name  Field's name
  * @param string $layerName
  * @param string $value Field's value
  * @param string $layerValue
  */
  function __construct($name, $layerName, $value = false, $layerValue = false)
  {
    $this->mItemIndex = 0;
    $this->SetName($name, $layerName);
    $this->mEmpty = $this->IsEmpty();
    $this->SetDefaultValue($value);
    $this->SetHeight(200);
    $this->SetWidth(200);
  }

  /**
  * Sets popup's name
  * @param string $name  Field's name
  * @internal string @layerName
  */
  function SetName($name)
  {
    $args      = func_get_args();
    $layerName = $args[1];
    
    $this->mName = $name;
    $this->mLayerName = $layerName;
    $this->AddCodeItem($name);
    $this->AddDescriptionItem($layerName);
  }

  /**
  * Adds code of the item
  * @param string $codField
  */
  function AddCodeItem($codeField)
  {
    $this->mCodeItems[] = $codeField;
    $this->mCodeIndex++;
  }

  /**
  * Adds description of the item
  * @param string $descriptionField
  */
  function AddDescriptionItem($descriptionField)
  {
    $this->mDescriptionItems[] = $descriptionField;
    $this->mDescriptionIndex++;
  }

  /**
  * Sets popup's url
  * @param string $url
  */
  function SetUrl($url)
  {
    $this->mUrl = $url;
  }

  /**
  * Sets popup's link
  * @param string $link
  */
  function SetLink($link)
  {
    $this->mLink = $link;
  }

  /**
  * Sets popup's height
  * @param string $height
  */
  function SetHeight($height)
  {
    $this->mHeight = $height;
  }

  /**
  * Sets popup's width
  * @param string $width
  */
  function SetWidth($width)
  {
    $this->mWidth = $width;
  }

  /**
  * Sets popup's width and height
  * @param int|string $width
  * @internal string $height
  */
  function SetSize($width = 40)
  {
    $args   = func_get_args();
    $height = $args[1];
    
    $this->mWidth = $width;
    $this->mHeight = $height;
  }

  /**
  *
  */
  function IsEmpty()
  {
    if (is_bool($this->mEmpty))
      return $this->mEmpty;
    else
    {
      $empty = true;
      for ($i = 0; $i < $this->mCodeIndex; $i++)
        $empty = $empty && ( ($this->mValue == "")?true:false );

      return $empty;
    }
  }

  /**
  * Builds the object's JS onSubmit validation code
  */
  function GetJSOnSubmit()
  {
    $out = "";

    if ($this->mTestIfEmpty != 0)
    {
      for ($i = 0; $i < $this->mCodeIndex; $i++)
      {
        $out .= "  ".$this->mCodeItems[$i]."_ok = (!test_if_empty(";
        $out .= "'', '$this->mTestIfEmptyMessage', ";
        $out .= "'".$this->mMainForm->mName."', '".$this->mCodeItems[$i]."', ";
        $out .= "'Hidden'));\n";
        $out .= "  ok = (ok && ".$this->mCodeItems[$i]."_ok);\n\n";
        $out .= "  form_submitted = (form_submitted && ".$this->mCodeItems[$i]."_ok);\n";
      }
    }

    return $out;
  }

  /**
  * Builds object's output
  */
  function GetHtml()
  {
    $out = "";

    $params = "f_form=".$this->mMainForm->mName;

    for ($i = 0; $i < $this->mCodeIndex; $i++)
    {
      $id = $this->MakeId();
      $params .= "&&f_cd[$i]=".$this->mCodeItems[$i];
      $out .= "<input class='".$this->MakeClass()."' id=\"".$id."\" type=\"hidden\" name=\"".$this->mCodeItems[$i]."\" value=\"".$this->GetValue()."\" ";
      $out .= "$this->mExtra>\n";
    }
    for ($i = 0; $i < $this->mDescriptionIndex; $i++)
    {
      $params .= "&&f_descr[$i]=".$this->mDescriptionItems[$i];
      $out .= "<span class='".$this->MakeClass()."' id=\"".$this->mDescriptionItems[$i]."\" $this->mExtra></span>\n";
    }

    $out .= "<a href=\"javascript:void(0);\" onClick=\"javascript:pop_open('".$this->mUrl."?$params', $this->mWidth, $this->mHeight);\">";
    $out .= "$this->mLink</a> " ;

    return $this->GetRawHtml($out);
  }
}

/**
* Editor objects creation class
*
* @author  Atua Sistemas de Informação
* @package Jaguar
*/
class JFormEditor extends JFormObject
{
  /**
  * Stores object's type
  * @var string
  */
  var $mType                    = "Editor";

  /**
  * Stores the object's number of the lines
  * @var int
  */
  var $mSizeL;

  /**
  * Stores the object's number of the columns
  * @var int
  */
  var $mSizeC;

  /**
  * Stores the object's value
  * @var string
  */
  var $mValue = " ";

  /**
  * Stores the object's name
  * @var string
  */
  var $mName = "Editor";

  /**
  * Constructor
  * @param string $name  Field's name
  * @param JMaintenance $man Fiel's parent maintenance
  */
  function __construct($name = false, &$man)
  {
    if ($name) $this->SetName($name);

    $this->mEmpty = $this->IsEmpty();
    $this->SetSize();

    $js =
    "
      var editor = null;
  
      function initEditor()
      {
        editor = new HTMLArea(\"" . $this->mName . "\", undefined, '".GetLocationDifference(JAGUAR_PATH)."');
        editor.generate();
      }

      function insertHTML()
      {
        var html = prompt(\"Enter some HTML code here\");
        if (html)
        {
          editor.insertHTML(html);
        }
      }

      initEditor();

    ";

    $path = URL."jformeditor/";
    $man->AddJSFile($path."htmlarea.js");
    $man->AddJSFile($path."htmlarea-lang-ptbr.js");
    $man->AddJSFile($path."dialog.js");
    $man->AddJSOnLoad($js);
  }

  /**
  * Builds the object's JS onSubmit validation code
  * @returns string
  */
  function GetJSOnSubmit()
  {
    $out = "";
    $out .= "  ".$this->mName."_ok = true; \n";

//TODO fix!
//    if ($this->mTestIfEmpty != 0)
//      $out .= "  ".$this->mName."_ok = ".$this->mName."_ok && (test_if_empty(document.".$this->mMainForm->mName.".".$this->mName.", '".$this->mTestIfEmptyMessage."', '".$this->mMainForm->mName."', '".$this->mName."', '".$this->mType."'));\n";

    $out .= "  ok = ok && ".$this->mName."_ok;\n";
    $out .= "  form_submitted = (form_submitted && ".$this->mName."_ok);\n\n";

    return $out;

  }

  /**
  * Sets the number of columnss and lines
  * @param int $cols  Number of columns
  * @param int $lines Number of lines
  */
  function SetSize($cols = 100, $lines = 25)
  {
    $this->mSizeL = $lines;
    $this->mSizeC = $cols;
  }

  /**
  * Gets the object's value
  * @returns string
  */
  function GetValue($db = true)
  {
    $array = array("&#34;" => "\"", "&quot;" => "\"");
    $value = strtr($this->mValue, $array);
    return $value;
  }

  /**
  * Builds object's output
  * @returns string
  */
  function GetHtml()
  {
    $out  .= "";
    $out .= "<textarea class='".$this->MakeClass()."' id=\"$this->mName\" name=\"$this->mName\" rows=\"$this->mSizeL\" ";
    $out .= "cols=\"$this->mSizeC\" $this->mDisabled >";
    $out .= $this->GetValue();
    $out .= "</textarea>\n";
    $out .= $this->GetTip();

    return $this->GetRawHtml($out);
  }

}

class JFormProcesso extends JFormText
{
  /**
  * Stores object's type
  * @var string
  */
  var $mType = "Processo";

  /**
  * Stores error message
  * @var string
  */
  var $mCadastre = true;

  /**
  * Constructor
  * @param string $name  Field's name
  * @param string $value Field's value
  */

  var $mError    = "Processo Inválido!";

  function __construct($name = false, $value = false)
  {
    $this->SetName($name);
    $this->mEmpty = $this->IsEmpty();
    $this->SetDefaultValue($value);
  }

  /**
  * Sets default JS functions for JFormFone objects
  */
  function SetDefaultEvents()
  {
    $this->SetEvents("onKeyPress", "return format_processo");
    $this->SetParameters("return format_processo", "this");
    $this->SetParameters("return format_processo", "event");

    $this->SetEvents("onBlur", "validate_processo");
    $this->SetParameters("validate_processo", "this");
    $this->SetParameters("validate_processo", $this->mError);
  }

  function SetValue($value = false)
  {
    $args = func_get_args();
    $from = $args[1] ? $args[1] : "sys";
    $to   = $args[2] ? $args[2] : "pt_BR";
    
    $this->mValue = Format_Processo($value, $from, $to);
  }

  /**
  * Checks if the object is valid
  */
   function IsValid()
  {
    $ok = true;

    if ($this->mTestIfEmpty != 0)
      $ok = $ok && !$this->IsEmpty();
    
    $processo = $this->GetValue();
    if (strlen($processo) > 0)
    {
      $trans = array("/" => "", "-" => "");
      $processo   = strtr($processo, $trans);
            
      if (strlen($processo) != 10)
        return false;
		  else
				return true;

      //verifica o primeiro digito
/*      $sum = 0;
      
      for ($i = 0; $i <= 8; $i++)
      {
        $value = substr($cpf, $i, 1);
        $sum += $value * ($i + 1);
      }
         
      $rest = $sum % 11;

      if ($rest > 9)
        $dig = $rest - 10;
      else
        $dig = $rest;

      if ($dig != substr($cpf, 9, 1))
        return false;
      else
      {
        //verifica o segundo dígito
        $sum = 0;
        for ($i = 0; $i <= 7; $i++)
        {
          $value = substr($cpf, ($i + 1), 1);
          $sum += ($value * ($i + 1)); 
        }

        $sum += ($dig * 9);
        $rest = $sum % 11;

        if ($rest > 9)
          $dig = $rest - 10;
        else
          $dig = $rest;

        if ($dig != substr($cpf, 10, 1))
          return false;
        else
          return true;
      }*/
    }//if ($this->mTestIfEmpty && ( strlen($cpf) > 0) )
    else
      return $ok;
  }

  /**
  * Builds the object's JS onSubmit validation code
  */
  function GetJSOnSubmit()
  {
    $out = "";
    $out .= "  ".$this->mName."_ok = true; \n";

    if ($this->mTestIfEmpty != 0)
      $out .= "  ".$this->mName."_ok = ".$this->mName."_ok && (!test_if_empty(document.".$this->mMainForm->mName.".".$this->mName.".value, '$this->mTestIfEmptyMessage', '".$this->mMainForm->mName."','$this->mName'));\n";

    $out .= "  ".$this->mName."_ok = ".$this->mName."_ok && validate_processo(";
    $out .= "'$this->mName', '$this->mError', '".$this->mMainForm->mName."');\n";

    $out .= "  ok = ok && ".$this->mName."_ok;\n";
    $out .= "  form_submitted = (form_submitted && ".$this->mName."_ok);\n\n";
    return $out;
  }

  /**
  * Gets object's value
  */
  function GetValue($db = false, $from = "pt_BR", $to = "sys")
  {
    if ($db)
      return Format_Processo($this->mValue, $from, $to);
    else
      return $this->mValue;
  }

  /**
  * Builds object's output
  */
  function GetHtml()
  {
    $out  = "\n";
    $out .= "<input class='".$this->MakeClass()."' id=\"".$this->MakeId()."\" type=\"text\" name=\"$this->mName\" value=\"".$this->GetValue()."\" ";
    $out .= "size=\"12\" maxlength=\"12\" $this->mDisabled ".$this->GetCssClass();

    //eventos JavaScript
    parent::SetDefaultEvents();
    $this->SetDefaultEvents();
    $out .= $this->BuildJSEvents();

    $out .= $this->mExtra.">\n";
    $out .= $this->GetTip();

    return $this->GetRawHtml($out);
  }
}

class JFormEconomia extends JFormText
{
  /**
  * Stores object's type
  * @var string
  */
  var $mType     = "Economia";

  /**
  * Controls the exhibition of link Economia's consultation
  * @var boolean
  */
  var $mCadastre = true;

  /**
  * Stores link for Economia's verification
  * @var string
  */
//  var $mLink     = "Verificar";

  /**
  * Stores error message
  * @var string
  */
  var $mError    = "Inscrição do Imóvel Inválido!";

  /**
  * Constructor
  * @param string $name  Field's name
  * @param string $value Field's value
  */
  function __construct($name = false, $value = false)
  {
    $this->SetName($name);
    $this->mEmpty = $this->IsEmpty();
    $this->SetDefaultValue($value);
  }

  /**
  * Sets default JS functions for JFormEconomia objects
  */
  function SetDefaultEvents()
  {
    $this->SetEvents("onKeyPress", "return format_economia");
    $this->SetParameters("return format_economia", "this");
    $this->SetParameters("return format_economia", "event");

//    $this->SetEvents("onBlur", "validate_cpf");
//    $this->SetParameters("validate_cpf", "this");
//    $this->SetParameters("validate_cpf", $this->mError);
  }

  /**
  * Sets object's value
  * @param string $value Economia's value
  * @internal string $from  { sys | pt_BR }
  * @internal string $to    { sys | pt_BR }
  */
  function SetValue($value = false)
  {
    $args = func_get_args();
    $from = $args[1] ? $args[1] : "sys";
    $to   = $args[2] ? $args[2] : "pt_BR";
    
    $this->mValue = Format_Economia($value, $from, $to);
  }

  /**
  * Sets link for register Economia
  * @param boolean $cadastre Controls whether the link might be shown or not
  * @param string  $link     The link target
  */
/*  function SetCadastreExibition($cadastre = false, $link = "")
  {
    if (is_bool($cadastre))
      $this->mCadastre = $cadastre;

    if (strlen($link))
      $this->mLink = $link;
  }*/

  /**
  * Checks if the object is valid
  * @returns boolean
  */
  function IsValid()
  {
    $ok = true;

    if ($this->mTestIfEmpty != 0)
      $ok = $ok && !$this->IsEmpty();

    $economia = $this->GetValue();

    if (strlen($economia) > 0)
    {
      $trans = array("." => "", "/" => "", "-" => "");
      $economia   = strtr($economia, $trans);

      if (strlen($economia) != 13)
        return false;

      //verifica o primeiro digito
/*      $sum = 0;

      for ($i = 0; $i <= 8; $i++)
      {
        $value = substr($cpf, $i, 1);
        $sum += $value * ($i + 1);
      }

      $rest = $sum % 11;

      if ($rest > 9)
        $dig = $rest - 10;
      else
        $dig = $rest;

      if ($dig != substr($cpf, 9, 1))
        return false;
      else
      {
        //verifica o segundo dígito
        $sum = 0;
        for ($i = 0; $i <= 7; $i++)
        {
          $value = substr($cpf, ($i + 1), 1);
          $sum += ($value * ($i + 1));
        }

        $sum += ($dig * 9);
        $rest = $sum % 11;

        if ($rest > 9)
          $dig = $rest - 10;
        else
          $dig = $rest;

        if ($dig != substr($cpf, 10, 1))
          return false;
        else
          return true;
      }*/
    }//if ($this->mTestIfEmpty && ( strlen($cpf) > 0) )
    else
      return $ok;
  }

  /**
  * Builds the object's JS onSubmit validation code
  * @returns string
  */
  function GetJSOnSubmit()
  {
    $out = "";
    $out .= "  ".$this->mName."_ok = true; \n";

    if ($this->mTestIfEmpty != 0)
      $out .= "  ".$this->mName."_ok = ".$this->mName."_ok && (!test_if_empty(document.".
              $this->mMainForm->mName.".".$this->mName.".value, '$this->mTestIfEmptyMessage', '".
              $this->mMainForm->mName."','$this->mName'));\n";

/*$out .= "  ".$this->mName."_ok = ".$this->mName."_ok && validate_cpf(";
 $out .= "'$this->mName', '$this->mError', '".$this->mMainForm->mName."');\n";*/

    $out .= "  ok = ok && ".$this->mName."_ok;\n";
    $out .= "  form_submitted = (form_submitted && ".$this->mName."_ok);\n\n";
    return $out;
  }

  /**
  * Gets object's value
  * @param boolean $db   Controls whether the Economia might be formatted or not
before returning
  * @param string  $from { sys | pt_BR }
  * @param string  $to   { sys | pt_BR }
  * @returns string
  */
  function GetValue($db = false, $from = "pt_BR", $to = "sys")
  {
    if ($db)
      return Format_Economia($this->mValue, $from, $to);
    else
      return $this->mValue;
  }

  /**
  * Builds object's output
  * @returns string
  */
  function GetHtml()
  {
    $out  = "\n";
    $out .= "<input class='".$this->MakeClass()."' id=\"".$this->MakeId()."\" type=\"text\" name=\"$this->mName\" value=\"".$this->GetValue()."\" ";
    $out .= "size=\"16\" maxlength=\"16\" $this->mDisabled ".$this->GetCssClass();

    //eventos JavaScript
    parent::SetDefaultEvents();
    $this->SetDefaultEvents();
    $out .= $this->BuildJSEvents();

    $out .= " $this->mExtra>\n";
    $out .= $this->GetTip();

    return $this->GetRawHtml($out);
  }
}

class JFormViagem extends JFormText
{
  /**
  * Stores object's type
  * @var string
  */
  var $mType        = "Viagem";

  /**
  * Stores error message
  * @var string
  */
  var $mError = "Viagem Inválida!";

  /**
  * Controls whether the object requires special parameters on grid's SetValue call
  * @var boolean
  */
  var $mGridParameters = array("pt_BR", "pt_BR");

  /**
  * Constructor
  * @param string $name  Field's name  Field's name
  * @param string $value Field's value
  */
  function __construct($name = false, $value = false)
  {
    $this->SetName($name);
    $this->mEmpty = $this->IsEmpty();
    $this->SetDefaultValue($value);
  }

  /**
  * Sets default JS functions for JFormCep objects
  */
  function SetDefaultEvents()
  {
    $this->SetEvents("onKeyPress", "return format_viagem");
    $this->SetParameters("return format_viagem", "this");
    $this->SetParameters("return format_viagem", "event");

    $this->SetEvents("onBlur", "validate_viagem");
    $this->SetParameters("validate_viagem", "this");
    $this->SetParameters("validate_viagem", $this->mError);
  }


  /**
  * Sets object's default value
  * @param string $value Field's value
  * @param string $from  Date's current format
  * @param string $to    Date's storage format
  */
  function SetValue($value = false, $from = "sys", $to = "pt_BR")
  {
    $this->mValue = Format_Viagem($value, $from, $to);
  }


  /**
  * Builds the object's JS onSubmit validation code
  * @returns string
  */
  function GetJSOnSubmit()
  {
    $out = "";
    $out .= "  ".$this->mName."_ok = true; \n";

    if ($this->mTestIfEmpty != 0)
      $out .= "  ".$this->mName."_ok = ".$this->mName."_ok && (!test_if_empty(document.".$this->mMainForm->mName.".".$this->mName.".value, '$this->mTestIfEmptyMessage', '".$this->mMainForm->mName."','$this->mName'));\n";

    $out .= "  ".$this->mName."_ok = ".$this->mName."_ok && validate_viagem(";
    $out .= "'$this->mName', '$this->mError', '".$this->mMainForm->mName."');\n";

    $out .= "  ok = ok && ".$this->mName."_ok;\n";
    $out .= "  form_submitted = (form_submitted && ".$this->mName."_ok);\n\n";

    return $out;
  }

  /**
  * Gets object's value
  * @param boolean $db   Defines if the date must formatted before returning
  * @param string  $from Defines the current date format. { pt_BR | sys | us }
  * @param string  $to   Defines the desired date format. { pt_BR | sys | us }
  */
  function GetValue($db = false, $from = "pt_BR", $to = "sys")
  {
    if ($db)
      return Format_Viagem($this->mValue);
    else
      return $this->mValue;
  }

  /**
  * Builds object's output
  * @returns string
  */
  function GetHtml()
  {
    $out  = "\n";
    $out .= "<input class='".$this->MakeClass()."' id=\"".$this->MakeId()."\" type=\"text\" name=\"$this->mName\" value=\"".$this->GetValue()."\" ";
    if (str_value($this->mTooltip))
      $out .= " title='{$this->mTooltip}' ";
    $out .= "size=\"8\" maxlength=\"8\" $this->mDisabled".$this->GetCssClass();

    //JavaScript events
    parent::SetDefaultEvents();
    $this->SetDefaultEvents();
    $out .= $this->BuildJSEvents();

    $out .= " $this->mExtra>\n";
    $out .= $this->BuildPopUp()."\n";
    $out .= $this->GetTip();

    return $this->GetRawHtml($out);
  }
}

class JFormPlaca extends JFormText
{
  /**
  * Stores object's type
  * @var string
  */
  var $mType        = "Placa";

  /**
  * Stores error message
  * @var string
  */
  var $mError = "Placa Inválida!";

  /**
  * Controls whether the object requires special parameters on grid's SetValue call
  * @var boolean
  */
  var $mGridParameters = array("pt_BR", "pt_BR");

  /**
  * Constructor
  * @param string $name  Field's name  Field's name
  * @param string $value Field's value
  */
  function __construct($name = false, $value = false)
  {
    $this->SetName($name);
    $this->mEmpty = $this->IsEmpty();
    $this->SetDefaultValue($value);
  }

  /**
  * Sets default JS functions for JFormCep objects
  */
  function SetDefaultEvents()
  {
    $this->SetEvents("onKeyPress", "return format_placa");
    $this->SetParameters("return format_placa", "this");
    $this->SetParameters("return format_placa", "event");

    $this->SetEvents("onBlur", "validate_placa");
    $this->SetParameters("validate_placa", "this");
    $this->SetParameters("validate_placa", $this->mError);
  }


  /**
  * Sets object's default value
  * @param string $value Field's value
  * @param string $from  Date's current format
  * @param string $to    Date's storage format
  */
  function SetValue($value = false, $from = "sys", $to = "pt_BR")
  {
    $this->mValue = Format_Placa($value, $from, $to);
  }


  /**
  * Builds the object's JS onSubmit validation code
  * @returns string
  */
  function GetJSOnSubmit()
  {
    $out = "";
    $out .= "  ".$this->mName."_ok = true; \n";

    if ($this->mTestIfEmpty != 0)
      $out .= "  ".$this->mName."_ok = ".$this->mName."_ok && (!test_if_empty(document.".$this->mMainForm->mName.".".$this->mName.".value, '$this->mTestIfEmptyMessage', '".$this->mMainForm->mName."','$this->mName'));\n";

    $out .= "  ".$this->mName."_ok = ".$this->mName."_ok && validate_placa(";
    $out .= "'$this->mName', '$this->mError', '".$this->mMainForm->mName."');\n";

    $out .= "  ok = ok && ".$this->mName."_ok;\n";
    $out .= "  form_submitted = (form_submitted && ".$this->mName."_ok);\n\n";

    return $out;
  }

  /**
  * Gets object's value
  * @param boolean $db   Defines if the date must formatted before returning
  * @param string  $from Defines the current date format. { pt_BR | sys | us }
  * @param string  $to   Defines the desired date format. { pt_BR | sys | us }
  */
  function GetValue($db = false, $from = "pt_BR", $to = "sys")
  {
    if ($db)
      return Format_Placa($this->mValue);
    else
      return $this->mValue;
  }

  /**
  * Builds object's output
  * @returns string
  */
  function GetHtml()
  {
    $out  = "\n";
    $out .= "<input class='".$this->MakeClass()."' id=\"".$this->MakeId()."\" type=\"text\" name=\"$this->mName\" value=\"".$this->GetValue()."\" ";
    if (str_value($this->mTooltip))
      $out .= " title='{$this->mTooltip}' ";
    $out .= "size=\"8\" maxlength=\"8\" $this->mDisabled".$this->GetCssClass();

    //JavaScript events
    parent::SetDefaultEvents();
    $this->SetDefaultEvents();
    $out .= $this->BuildJSEvents();

    $out .= " $this->mExtra>\n";
    $out .= $this->BuildPopUp()."\n";
    $out .= $this->GetTip();

    return $this->GetRawHtml($out);
  }
}
