<?php

require_once(JAGUAR_PATH . "jtable.inc.php");
require_once(JAGUAR_PATH . "jform.inc.php");

class JLog
{
  /**
  * Stores object's main data
  * @var array
  */
  var $mData;

  /**
  * Stores object's file name 
  * @var string
  */
  var $mFile;

  /**
  * Stores object's file open mode
  * @var string
  */
  var $mMode;

  /**
  * Stores the separator of the string which will be used
  * @var string
  */
  var $mSeparator = "^";

  /**
  * Stores the separator of the string which will be used
  * @var integer
  */
  var $mFilterNumber = 4;

  /**
  * Stores the main form
  * @var object
  */
  var $mForm;

  /**
  * Stores whether the debug will be showed
  * @var boolean
  */
  var $mDebug = false;

  /**
  * Stores the data used in extra filters
  * @var array
  */
  var $mExtraGrep = array();
  
  /**
  * Constructor
  * @param string $file filename
  * @param string $mode Operation (w or r) to write or read
  * @param array  $data Associative Array of ("label" => "data") to read and a array with info to a write mode
  */
  function __construct($file, $mode, $data)
  {
    $this->mFile = &$file;
    $this->mData = &$data;

    $this->mMode = $mode == "w" ? "a" : $mode;

    if ($this->mMode == "a")
      $this->Start();
  }

  function appendTip($id, $title, $texto, &$container)
  {
    if (is_object($container))
    {
      $js = "Style[0] = [\"#000077\",\"#CECEFF\",\"\",\"\",\"cursive\",2,\"#000000\",\"#F0F0F0\",\"\",\"\",\"cursive\",2,,,2,\"#FFFFFF\",2,,,,,\"\",,,,];
                var TipId=\"tiplayer\"; 
                var FiltersEnabled = 1; 
                mig_clay(); 
                ";

      $container->AddJS($js, "end");
    }
    else
      exit('Erro: o container do tip necessita ser um objeto');
    
    if ($is_con)
        $container->AddJSFile(URL."js/main15.js");

    $out = "";

    if (!$title)
      $title = "";

    $out .= "
      <script language=\"JavaScript\">
      Tips[\"$id\"] = [\"$title\", \"$texto\"];
      </script>

      <a disabled href=\"#\" onMouseOver=\"stm(Tips['$id'],Style[0], '', '')\" onMouseOut=\"htm()\" ><img src=\"".URL."img/lamp.gif\" border=\"0\" height=\"14\" width=\"16\"></A>";

    return $out;
  }


  /**
  * Starts an operation
  * @param array $data Associative Array of ("label" => "data") 
  */
  function Start()
  {
    switch ($this->mMode)
    {
      case 'a':
        $this->mData = array_merge(array(date("Y-m-d H:i:s")), $this->mData);
        $this->WriteLog();
      break;
      case 'r':
        $this->mData = array_merge(array("Data" => "JFormTimeStamp"), $this->mData);
        $this->ReadLog();
      break;
      default:
        exit("Error: Log Mode might be 'w' or 'r'");
    }

  }

  /**
  * Write the log to a file
  * @param array $data Associative Array of ("label" => "data") 
  */
  function WriteLog()
  {
    
    //verify if the dir exists, in case that not create it
    clearstatcache();
    if (!is_dir(dirname($this->mFile)))
    {
      if(!@mkdir(dirname($this->mFile), 0777))
        exit("Cannot create dir ".dirname($this->mFile));

      exec("chmod 777 log/ -R");
    }

    if (!($fp = fopen($this->mFile, $this->mMode)))
      exit("Cannot open file ".$this->mFile);

    $str = "";
    foreach($this->mData as $data)
    {
      if ($str) $str .= $this->mSeparator;

      $str .= $data;
    }

    $str .= $this->mSeparator."\n";

    // Write $somecontent to our opened file.
    if (fwrite($fp, $str) === FALSE) 
      exit("Cannot write to ".$this->mFile);

    fclose($fp); 
  }


  /**
  * Read the log and generates a filter screen
  */
  function ReadLog()
  {
    $cellOptions = array("colspan" => 3);

    $title = "Análise de Log";
    $html = new JHtml($title);
    $html->AddHtml("<h3>$title</h3>");

    $js = '

    function validate_minimum_filters()
    {
      what = document.form; 
      var empty = 0;
      var total = 0;
      for (var i=0; i<what.elements.length; i++) 
      {
        if (what.elements[i].type != "hidden")
          total++;

        if (what.elements[i].value == "" && what.elements[i].type != "hidden" ) 
          empty++
      }

      //-3 because operator and format will be always defined, and the submit
      if (empty == (total-3))
      {
        alert("Ao menos um filtro deve ser selecionado"); 
        return false;
      }
    }
    
    ';

    $html->AddJs($js);
    $this->mForm = new JForm();
    $this->mForm->AddFunction("validate_minimum_filters");
    $this->mForm->AddFunction("testa_destino");

    //operador
    $this->mForm->OpenRow();
    $this->mForm->OpenHeader("<b>Operador</b>".$this->appendTip("operador",false, "Operador Lógico entre os filtros.", $html));
    $this->mForm->OpenCell();
    $operador = new JFormSelect("f_operador");
    $operador->AddOption(1, "E");
    $operador->AddOption(2, "OU");
    $this->mForm->AddObject($operador);
    $this->mForm->OpenRow();

    $i = 0;
    foreach($this->mData as $label => $type)
    {
      //sets whether a row will be opened in the container object
      $openRow = true; 

      $filter = "f_".($i++);

      $value = "";
      if (is_array($type))
      {
        $value = $type;
        $this->mData[$label] = $type ="JFormSelect";
      }

      //create filter object
      $$filter = new $type($filter);

      //catch some specific behaviour
      switch($type)
      {
        case "JFormTimeStamp":
          $openRow = false;
          $$filter->ForceBothArguments(false);
          $$filter->mDate->UseDatePicker();
        break;

        case "JFormSelect":
          $$filter->SetFirstEmpty();
          $$filter->SetOptions($value);
        break;
      }

      if ($openRow) $this->mForm->OpenRow();
      $this->mForm->OpenHeader($label);
      $this->mForm->OpenCell("" , $cellOptions);
      $this->mForm->AddObject($$filter);
    }

    //extraFilters
    $extraFilters = new JFormHidden("f_extraFilters"); 
    $extraFilters->SetDefaultValue($this->mFilterNumber);
    $this->mForm->AddObject($extraFilters);
    
    //presentation format
    $this->mForm->OpenRow();
    $this->mForm->OpenHeader("Formato");
    $this->mForm->OpenCell("", $cellOptions);
    $presentationFormat = new JFormSelect("presentationFormat");
    $presentationFormat->AddOption(0, "HTML");
    $presentationFormat->AddOption(1, "TXT");
    $this->mForm->AddObject($presentationFormat);

    //number of extra filters in a line
    $filtersInLine = 2;
    //controls the number of lines already created
    $j = 0;
    
    $table = new JTable();
    $table->SetWidth("100%");
    $table->OpenRow();
    $msg = "Valores passados nestes filtros serão pesquisados novamente e literalmente no conteúdo do arquivo, utilizando expressões regulares.";
    $table->OpenHeader("<b>Filtros</b>".$this->appendTip("filtro","Atenção", $msg, $html), array("colspan" => $filtersInLine * 3));
    
    for ($i = 0; $i < $extraFilters->GetValue(); $i++)
    {
      if ($i % $filtersInLine == 0)
      {
        $table->OpenRow();
        $j++;
      }
      if ((($i+1) == $_POST["f_extraFilters"]) && ($_POST["f_extraFilters"] % $filtersInLine != 0))
      {
        $qt_diferenca = ($j * $filtersInLine) - $_POST["f_extraFilters"];
        $cell_opt["colspan"] = 2 + ($qt_diferenca * 3);
      }
      else
        $cell_opt["colspan"] = 2;
       
      $table->OpenHeader("<b style='color:".$this->GetAssocColor($i).";'>Filtro " . ($i + 1)."</b>");

      $filtro = "filtro_$i";
      $$filtro = new JFormText("f_filtro_$i");
      $$filtro->SetSize(20);
      $$filtro->SetSpecialCharacter(false);
      $$filtro->mUpper = false;
      
      $table->OpenCell("", $cell_opt);
      $table->AddObject($$filtro);
    }
   
    $this->mForm->OpenRow();
    $this->mForm->OpenCell(null, array("colspan" => 10));
    $this->mForm->AddObject($table);
    $this->mForm->OpenRow();
    $this->mForm->OpenCell("", array("colspan" => 10, "align" => "center"));

    $submit = new JFormSubmit("f_submit_log", "Submeter");
    $this->mForm->AddObject($submit);


    if ($this->mForm->IsSubmitted())
    {
      //scape because default '^' separator is a reserved word in regEx expressions
      $separator = '\\'.$this->mSeparator;

      /* TODO
        * rotate
        * data form a select box like: "op_id value $executou = $_POST['f_executou'] !== '' ? $_POST['f_executou'] :'(0|1)'"
      */
      $cat = "cat ".$this->mFile;

      $i = 0;
      $reg = ""; //acumulative regEx
      $grep = ""; //final grep bash to execute
      $last = sizeof($this->mData)-1;
      foreach($this->mData as $label => $type)
      {
        $filter = "f_".$i;

        if ($$filter->GetValue() && $$filter->GetValue()!== "NULL")
          $filterLine = true;
        else
          $filterLine = false;

        //timestamp actually have a specific behaviour because passing its parameters is optional
        if ($i == 0)
        { 
          $date = &$$filter->GetDateInstance();
          $time = &$$filter->GetTimeInstance();

          $dateVal = $date->GetValue() ? $date->GetValue(true) : $date->mRegEx;
          $timeVal = ($time->GetValue() ? $time->GetValue() : $time->mRegEx).":([0-5][0-9])"; 

          $reg = "^".$dateVal." ".$timeVal.$separator;
        }
        else
        {
          $reg .= ($$filter->GetValue() ? ".*".$$filter->GetValue(true).".*" : "(".$$filter->mRegEx.")?" ).$separator;

          if ($i == $last)
            $reg .= "$";
        }

        //if ($filterLine) $grep .= " | '".$reg."'";

        $i++;
      }

      $grep .= " | '".$reg."'";

      //AND operator
      //
      if ($_POST['f_operador'] == 1)
      {
        //change every ' | ' to '| grep' passing many different filters
        $grep = $cat.str_replace(' | ', ' | egrep -i ', $grep); 
      
        //add extra filters
        //
        for ($i = 0; $i < $_POST["f_extraFilters"]; $i++)
        {
          $filtro = trim($_POST["f_filtro_".$i]);
      
          if ($filtro)
          {
            $this->mExtraGrep[$i] = $filtro;
            $grep .= " | egrep -i  " . "\"" . $filtro . "\"";
          }
        }
      
      }

      //OR operator
      //
      else
      {
        //change only the first character '|' to '| egrep -i '
        $grep = $cat.preg_replace("/^ \|/"," | egrep -i ", $grep ); 
        //alter the string from "egrep -i 'XP1' | 'XP2' | 'XP3'" to "egrep -i 'XP1|XP2|XP3'"
        $grep = str_replace("'", "", $grep);
        $grep = str_replace("-i  ^", "-i '^", $grep);
        $grep .= "'";
        $grep = preg_replace("/( \|)|(\| )/","|", $grep ); 
     
        //add extra filters
        //
        $re = "";
        for ($i = 0; $i < $_POST["f_extraFilters"]; $i++)
        {
          $filtro = trim($_POST["f_filtro_$i"]);

          if ($filtro)
          {
            if ($re) $re .= "|";

            $this->mExtraGrep[$i] = $filtro;
            $re .= $filtro;
          }
        }

        if ($re)
          $grep .= " | egrep -i \"($re)\"";
      
      }
    
      if ($this->mDebug)
      {
        $debugTable = new JTable();
        $debugTable->OpenHeader("Debug");
        $debugTable->OpenCell($grep);
        $html->AddObject($debugTable);
        $html->AddHtml("<br>");
      }

      //execute the search
      //
      exec($grep, $out);
      
      //HTML output format
      //
      if ($_POST["presentationFormat"] == 0)
      {
        $result = new JTable();
        $result->OpenHeader("#");
        foreach($this->mData as $label => $type)
          $result->OpenHeader($label);

        if (in_array('JFormIp', $this->mData) and function_exists("abre_pop"))
          $html->AddHtml(call_user_func("abre_pop"));
        
        reset($this->mData);
        foreach($out as $number => $line)
        {
          //Add respective colors to the line
          //
          $result->OpenRow();
          $result->OpenCell($number);
          $line = explode($this->mSeparator,$line);
          foreach($line as $element)
          {
            switch(current($this->mData))
            {
              case "JFormDate":
                $element = Format_Date($element, "sys", "pt_BR");
              break;

              case "JFormTimeStamp":
                $element = explode(" ", $element);
                $element = Format_Date($element[0], "sys", "pt_BR")." ".$element[1];
              break;
            
              case "JFormIp":
                $element = "<a href=\"javascript:void(0);\" onClick=\"abre_pop('exe_consulta_ip.php?f_ip=$element')\">$element</a>";
              break;
            }

            if ($element) $result->OpenCell( $this->ColorLine( $element ) );
            next($this->mData);
          }

          reset($this->mData);
          
        }

      }

      //Pure text output
      //
      else
      {
        $result = new JFormTextArea("f_result");
        $result->SetSize(150, 15);
        $result->SetDisabled(true);
        $result->SetUpper(false);
        $result->SetLower(false);

        $ds_sql = "";
        for($i = 0; $i < sizeof($out); $i++)
          $ds_sql .= $out[$i]." ;\n";
      
        $result->SetValue($ds_sql);
      }
      
    }//if ($this->mForm->IsSubmitted())

    $html->AddObject($this->mForm);

    $html->AddHtml("<br>");

    if ($result)
      $html->AddObject($result);

    echo $html->GetHtml();
  }

  function GetAssocColor( $index )
  {
    $colors = array("green", "red", "purple", "white", "black");

    $chosen = "";

    if ($colors[ $index ])
      $chosen = (string) $colors[ $index ];
    else
      $chosen = (string) $colors[ rand(0, sizeof( $colors ) ) ];

    return $chosen;
  }

  function ColorLine($line)
  {
    foreach($this->mExtraGrep as $index => $grep)
    {
      //wrap the command to can replace with \\1
      //
      $grep = "(".$grep.")";

      //add delimiters needed for preg_replace
      //
      if ($grep[0] != "/")
        $grep = "/".$grep;

      if ($grep[strlen($grep) -1] != "/")
        $grep .= "/i";

      $line = preg_replace($grep, "<b style='color:".$this->GetAssocColor( $index )."'>\\1</b>", $line);
    }

    return $line;
  }

//  /**
//  * Sets a Filter Event
//  * @param string $which Label represented in the constructor data array
//  * @param string $evt HTML Event
//  * @param array  $action the javascript functionName Added
//  */
//  function SetEvents($which, $evt, $action)
//  {
//    $obj = &$this->GetObjectByLabel($which);
//    $obj->SetEvents($evt, $action);
//  }
//
//  /**
//  * Sets a Filter Property
//  * @param string $which Label represented in the constructor data array
//  * @param string $property the property name to call
//  * @param mixed  $value
//  */
//  function SetProperty($which, $property, $value)
//  {
//    $obj = &$this->GetObjectByLabel($which);
//    $obj->$property($value);
//  }
//
//  function &GetObjectByLabel($find)
//  {
//    $i = 0;
//    foreach($this->mData as $label => $value)
//      if ($label == $find) break;
//
//    return $this->mForm->GetObjectByName("f_".$i);
//  }
//

}