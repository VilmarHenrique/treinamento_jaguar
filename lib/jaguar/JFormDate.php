<?php

/**
* Date objects creation class
*
* @author  Atua Sistemas de Informação
*/
class JFormDate extends JFormText
{
  /**
  * Stores object's type
  * @var string
  */
  var $mType        = "Date";

  /**
  * Stores the first comparison date
  * @var float
  */
  var $mDate1       = "";

  /**
  * Stores the second comparison date
  * @var float
  */
  var $mDate2       = "";

  /**
  * Stores the dates comparison's condition
  * @var string
  */
  var $mCondition   = "";

  /**
  * Stores the interval to be compared between two dates
  * @var string
  */
  var $mInterval   = 0;

  /**
  * Stores error message
  * @var string
  */
  var $mError       = "";

  /**
  * Stores the minimum accepted year
  * @var int
  */
  var $mMinYear;

  /**
  * Stores the maximum accepted year
  * @var int
  */
  var $mMaxYear;

  /**
  * Stores the current date's format
  * @var string
  */
  var $mFormat;

  /**
  * Stores the if the day wil be shown
  * @var bool
  */
  var $mUseDay        = true;
                      
  /**
  * Stores the if the month wil be shown
  * @var bool
  */
  var $mUseYear       = true;
                      
  /**
  * Stores the Day default and current value
  * @var bool
  */
  var $mDefaultDay    = "01";
                      
  /**
  * Stores the Year default and current value
  * @var bool
  */
  var $mDefaultYear;

  /**
  * Stores whether the variables $mDefaultYear,$mDefaultMonth, and $mDefaultDay are updated
  * @var bool
  */
  var $mValuesUpdated = false;

  /**
  * Controls whether the object requires special parameters on grid's SetValue call
  * @var boolean
  */
  var $mGridParameters = array("pt_BR", "pt_BR");

  /**
  * Controls whether the component shows a javascript date picker
  * @var boolean
  */
  var $mUseDatePicker = true;

  /**
  * Stores the object's regEx
  * @var string
  */
  var $mRegEx = "([123456789][[:digit:]]{3})-(0[1-9]|1[012])-(0[1-9]|[12][[:digit:]]|3[01])";

  /**
  * Stores the object's dyalog type to be shown 
  * @var string
  */
  var $mDialogType = "alert";
  
  /**
  * Stores the type style to DatePicker
  * 1 = JQuery
  * 0 = old model
  * @var int
  */
  var $mTypeDatePicker = 1;

  /**
  * Constructor
  * @param string $name  Field's name  Field's name
  * @param string $value Field's value
  */
  function __construct($name = false, $value = false)
  {
    $this->SetName($name);
    $this->mEmpty = $this->IsEmpty();
    $this->mDefaultYear = date("Y");
    $this->SetMinMaxYear();
    $this->SetDefaultValue($value);
    $this->SetTestOnBlur(true);
    parent::SetDefaultEvents();
    $this->SetDefaultEvents();
  }
  
  /**
  * Sets style to DatePicker
  */
  function SetDatePickerStyle($value)
  {
    $this->mTypeDatePicker = $value;
  }

  /**
  * Sets the min and max years for validation purposes
  */
  function SetMinMaxYear()
  {
    $this->mMinYear     = $this->mDefaultYear - 120;
    $this->mMaxYear     = $this->mDefaultYear + 30;
  }

  /**
  * Sets whether the component shows a javascript date picker
  * @param boolean $use
  */
  function UseDatePicker($use = true)
  {
    $this->mUseDatePicker = $use;
  }

  /**
  * Sets the use of day on date
  * @param boolean $bool
  * @param number  $day
  */
  function SetUseDay($bool = true, $day = false)
  {
    $this->mUseDay = (boolean) $bool;

    if (!$bool)
    {
      $this->mUseYear = true;
      $this->UseDatePicker($bool);
    }

    if ($day && is_numeric($day))
      $this->mDefaultDay = $day;

    $this->SetDefaultEvents();
  }

  /**
  * Sets the use of year on date
  * @param boolean $bool
  * @param number  $year
  */
  function SetUseYear($bool = true, $year = false)
  {
    $this->mUseYear = (boolean) $bool;

    if (!$bool)
    {
      $this->mUseDay = true;
      $this->UseDatePicker($bool);
    }
    
    if ($year && is_numeric($year))
      $this->mDefaultYear = $year;
    
    $this->SetDefaultEvents();
  }

  /**
  * Sets default JS functions for JFormDate objects
  */
  function SetDefaultEvents()
  {
    $useDay = ($this->mUseDay === false ? "false" : "true");
    $useYear = ($this->mUseYear === false ? "false" : "true");
    
    $this->SetEvents("onKeyPress", "return format_date");
    unset($this->mParameters["return format_date"]);
    $this->SetParameters("return format_date", "this");
    $this->SetParameters("return format_date", "event");
    $this->SetParameters("return format_date", $useDay, true);
    $this->SetParameters("return format_date", true);
    $this->SetParameters("return format_date", $useYear, true);

    if ($this->mTestOnBlur)
    {
      $this->SetEvents("onBlur", "validate_date");
      unset($this->mParameters["validate_date"]);
      $this->SetParameters("validate_date", "this");
      $this->SetParameters("validate_date", $useDay, true);
      $this->SetParameters("validate_date", true);
      $this->SetParameters("validate_date", $useYear, true);
    }
  }

  /**
  * Sets the object's default value
  * @param string $value Field's value
  * @param string $from  Date's current format
  * @param string $to    Date's storage format
  */
  function SetDefaultValue($value = false, $from = "sys", $to = "pt_BR")
  {
    //if a value has been passed and default wasn't already set or are still setting a default
    if ( $value !== false && ( ($this->mValue === null || $this->mValue === '') || ($this->mDefaultValue === true) ) )
    {
      $this->SetValue($value, $from, $to);
      $this->mDefaultValue = true;
    }
  }

  /**
  * Sets object's value
  * @param string $value Field's value
  * @param string $from  Date's current format
  * @param string $to    Date's storage format
  */ 
  function SetValue($value = false, $from = "sys", $to = "pt_BR") 
  {
    parent::SetValue( $this->FormatValue($value, $from, $to) );
    $this->SetFormat($to);
  }

  /**
  * Format a param value
  * @param string $value value
  * @param string $from  Date's current format
  * @param string $to    Date's storage format
  */
  function FormatValue($value = false, $from = "sys", $to = "pt_BR")
  {
    if ($value === false)
      return false;

    $delimiter = $this->GetDelimiter($value, $from);

    switch (strlen($value))
    {
      case 7:
        if (!$this->mUseDay)
        {
          if ($delimiter == "/") //TODO "us" pattern support
            $value = $this->mDefaultDay . "/" . $value;
          elseif ($delimiter ==  "-")
            $value .= "-$this->mDefaultDay";
        }
      break;
      case 5:
        if (!$this->mUseYear)
        {
          if ($delimiter == "/") //TODO "us" pattern support
            $value .= "/" . $this->mDefaultYear;
          elseif ($delimiter ==  "-")
            $value = $this->mDefaultYear . "-" . $value;
        }
      break;
    }
  
    $value = Format_Date($value, $from, $to);

    switch ($to)
    {
      case "us":    // MM/DD/YYYY
        if (!$this->mUseDay)
          $value = substr($value, 0, 2).substr($value, 5, 5);
        else
          if (!$this->mUseYear)
            $value = substr($value, 0, 5);
      break;
      case "sys": // YYYY/MM/DD
        if (!$this->mUseDay)
          $value = substr($value, 0, 7);
        else
          if (!$this->mUseYear)
            $value = substr($value, 5, 6);
      break;
      default: // DD/MM/YYYY - pt_BR
        if (!$this->mUseDay)
          $value = substr($value, 3, 7);
        else
          if (!$this->mUseYear)
            $value = substr($value, 0, 5);
    }

    return $value;
  }

  /**
  * Returns the date delimiter 
  * @param string $dateString
  * @param string $locale
  * @returns string
  */
  function &GetDelimiter(&$dateString, &$locale)
  {
    $delimiter = '#';
    if (strpos($dateString, "-") !== false)
    {
      $delimiter = '-';
      $locale = "sys";
    }
    elseif ( strpos($dateString, "/") !== false)
    {
      $delimiter = '/';
      $locale = "pt_BR";
    }

    return $delimiter;
  }

  /**
  * Sets object's format
  * @param string $format
  */
  function SetFormat($format)
  {
    $this->mFormat = $format;
  }

  /**
  * Sets default dates
  * @param int $default. 1 = today, 2 = first day in the month, 3 = last day in the month
  */
  function SetDefault($default = 0)
  {
    $format = $this->GetFormat();
    
    switch($format)
    {
      case "pt_BR": $format = "d/m/Y"; break;
      case "us":    $format = "m/d/Y"; break;
      case "sys":   $format = "Y-m-d"; break;
    }

    switch($default)
    {
      case "1":
        $this->mValue = date($format);
      break;
      
      case "2":
        $this->mValue = date($format, mktime(0, 0, 0, date("m"), 1, date("Y")));
      break;
      
      case "3":
        $this->mValue = date($format, mktime(0, 0, 0, date("m") + 1, 0, date("Y")));
      break;
    }
  }

  /**
  * Sets the first comparison date
  * @param string $date1 Date's value
  * @param string $from  First argument's current format
  */
  function SetDate1($date1 = false, $from = "sys")
  {
    if (is_object($date1))
      $this->mDate1 = &$date1;
    else
      $this->mDate1 = $this->FormatValue($date1, $from, "pt_BR"); 
  }

  /**
  * Sets the first comparison date
  * @param string $dialogType 
  */
  function SetDialogType($dialogType = "alert")
  {
    $accepted = array("alert", "confirm");

    if (!in_array($dialogType, $accepted))
      exit("Error: Param should be in (array('alert', 'confirm'))");

    $this->mDialogType = $dialogType;
  }

  /**
  * Sets the second comparion date
  * @param string $date2
  * @param string $from  First argument's current format
  */
  function SetDate2($date2 = false, $from = "sys")
  {
    $this->mDate2 = $this->FormatValue($date2, $from, "pt_BR"); 
  }

  /**
  * Sets the comparison's  condition
  * @param string $condition { "=" | "<" | "<=" | ">" | ">=" }
  */
  function SetCondition($condition = false)
  {
    $this->mCondition = ($condition)?$condition:"";
  }

  /**
  * Sets the interval to be compared between two dates (in days)
  * @param integer $condition 
  */
  function SetInterval($interval = false)
  {
    $this->mInterval = ($interval)?$interval:"";
  }

  /**
  * Sets the maximum acceptable year
  * @param int $year
  */
  function SetMaxYear($year)
  {
    $this->mMaxYear = $year;
  }

  /**
  * Sets the minimum acceptable year
  * @param int $year
  */
  function SetMinYear($year)
  {
    $this->mMinYear = $year;
  }

  /**
  * Returns the maximum acceptable year
  * @returns integer
  */
  function GetMaxYear($year)
  {
    return $this->mMaxYear;
  }

  /**
  * Returns the minimum acceptable year
  * @returns integer
  */
  function GetMinYear($year)
  {
    return $this->mMinYear;
  }

  /**
  * Checks if the object is valid
  * @returns boolean
  */
  function IsValid()
  {

    //test if can be empty AND is empty
    if ($this->mTestIfEmpty == 0 && $this->IsEmpty())
      return true;

    //syntactic analysis
    $dateString = $this->GetValue(true);
    if (preg_match($this->GetRegEx(false, false), $dateString))
    {
      //semantic analysis 
      $date = explode("-", $dateString);
      if (!checkdate ($date[1], $date[2], $date[0]) )
      {
        $this->SetInvalidMessage("Data Inválida");
        return false;
      }
    }
    else
    {
      $this->SetInvalidMessage("Formatação de data inválida");
      return false;
    }

    $ok = true;
    if ($this->mDate1  && (is_string($this->mDate1)) && ($this->mCondition  || $this->mDate2))
    {
      $date = explode("-", $this->GetValue(true));
      $date = mktime(0, 0, 0, $date[1], $date[2], $date[0]);

      $date1 = explode("-", Format_Date($this->mDate1, "pt_BR", "sys"));
      $date1 = mktime(0, 0, 0, $date1[1], $date1[2], $date1[0]);

      if ($this->mDate2)
      {
        $date2 = explode("-", Format_Date($this->mDate2, "pt_BR", "sys"));
        $date2 = mktime(0, 0, 0, $date2[1], $date2[2], $date2[0]);

        if ( !($date >= $date1 && $date <= $date2) )
        {
          $this->SetInvalidMessage("A data '".$this->GetValue()."' Deve estar entre ".$this->mDate1." e ".$this->mDate2);
          return false;
        }

      }
      else
      {
        $conditionValue = '';
        switch($this->mCondition)
        {
          case "=":
            $ok = $ok && ($date == $date1);
            $conditionValue = 'igual';
          break;
          case "<":
            $ok = $ok && ($date < $date1);
            $conditionValue = 'menor';
          break;
          case "<=":
            $ok = $ok && ($date <= $date1);
            $conditionValue = 'menor ou igual';
          break;
          case ">":
            $ok = $ok && ($date > $date1);
            $conditionValue = 'maior';
          break;
          case ">=":
            $ok = $ok && ($date >= $date1);
            $conditionValue = 'maior ou igual';
          break;
        }
      }
    }

    if (!$ok)
    {
      $str = $conditionValue .(($this->mCondition == '>' || $this->mCondition == '<') ? ' do que ' : ' á ');
      $this->SetInvalidMessage("A data '".$this->GetValue()."' Deve ser ".$str." '".$this->mDate1."'", true);
      return false;
    }

    return true;
  }

  /**
  * Gets the formatting's type
  * @returns string
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

    $validate = ( ((is_string($this->mDate1) && (strlen($this->mDate1) > 0)) || (is_object($this->mDate1))) &&
                ((strlen($this->mCondition) > 0) || (strlen($this->mDate2) > 0))
                );

    $out .= "  ".$this->mName."_ok = true; \n";

    if ($this->mAllowInvalidSubmission)
      $out .= "  ".$this->mName."_ini_ok = true; \n";
   
    if ($validate)
    {
      $out .= "  ".$this->mName."_ok = ".$this->mName."_ok && (test_date(";
      $out .= "document.".$this->mMainForm->mName.".".$this->mName.", ";
      if (is_string($this->mDate1))
        $out .= "'$this->mDate1', " ;
      else
        $out .= "document.".$this->mMainForm->mName.".".$this->mDate1->mName.".value, ";

      $out .= "'$this->mDate2', '$this->mCondition', ";
      $out .= "'$this->mError', '".$this->mInterval."', '".$this->GetLabel()."', '".$this->mDialogType."'));\n";
    }

    $useDay = ($this->mUseDay === false ? "false" : "true");
    $useYear = ($this->mUseYear === false ? "false" : "true");

    $out .= "  ".$this->mName."_ok = ".$this->mName."_ok && validate_date(document.".$this->mMainForm->mName.".".$this->mName.", ".$useDay.", true, ".$useYear.");\n"; 

    if ($this->mTestIfEmpty != 0)
    {
      $out .= "  ".$this->mName."_ok = ".$this->mName."_ok && (!test_if_empty(document.".
              $this->mMainForm->mName.".".$this->mName.".value, '$this->mTestIfEmptyMessage', '".
              $this->mMainForm->mName."','$this->mName'));\n";
    }

    if ($this->mAllowInvalidSubmission)
    {
      $out .= "  if ((".$this->mName."_ini_ok) && (!".$this->mName."_ok)) \n";
      $out .= "    ".$this->mName."_ok = confirm('Campo inválido, confirmar mesmo assim?'); \n";
    }
            
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
    {
      if ($this->mValue)
      {
        $size = (strlen($this->mValue) != 10);
        $tmp_value = $this->mValue;
        $delimiter = $this->GetDelimiter($tmp_value, $from);

        if (!$this->mUseDay && $size)
          $tmp_value = $this->mDefaultDay.$delimiter.$tmp_value;

        if (!$this->mUseYear && $size)
          $tmp_value = $tmp_value.$delimiter.$this->mDefaultYear;

        return Format_Date($tmp_value, $from, $to);
      }
    }

    return $this->mValue;
  }

  /**
  * Builds object's output
  * @returns string
  */
  function GetHtml()
  {
    $myId = $this->MakeId();
    $myClass = $this->MakeClass();

    $out  = "\n";
    $out .= "<input class=\"".$myClass."\" id=\"".$myId."\" type=\"text\" name=\"".$this->mName."\" ".
                   "value=\"".$this->GetValue()."\"";
    if ($this->mUseDay && $this->mUseYear)
      $out .= " size=\"8\"  ";
    else
    {
      if (!$this->mUseDay)
        $out .= " size=\"5\" ";
        
      if (!$this->mUseYear)
        $out .= " size=\"3\" ";
    }
    $out .= $this->mDisabled." ".$this->GetCssclass();

    //javascript events

    if ($this->mDate1 && ($this->mCondition || $this->mDate2)  )
    {
      $this->SetEvents("onBlur", "test_date");
      $this->SetParameters("test_date", "this");
      if (is_object($this->mDate1))
        $this->SetParameters("test_date", "document." . $this->mMainForm->mName . "." . $this->mDate1->mName . ".value");
      else
        $this->SetParameters("test_date", $this->mDate1);
      $this->SetParameters("test_date", $this->mDate2);
      $this->SetParameters("test_date", $this->mCondition);
      $this->SetParameters("test_date", $this->mError);
      $this->SetParameters("test_date", $this->mInterval);
      $this->SetParameters("test_date", $this->GetLabel());
      $this->SetParameters("test_date", $this->mDialogType);
    }

    $out .= $this->BuildJSEvents();

    $out .= " ".$this->mExtra.">\n";

    $out .= ($this->mTypeDatePicker) ? $this->GetDatePickerJQuery($myId) : $this->GetDatePickerHtml($myId);

    $out .= $this->GetMask("date");
    
    $out .= $this->GetTip();

    return $this->GetRawHtml($out);
  }

  function GetDatePickerJQuery($dateId)
  {
    if ($this->mUseDatePicker && $this->mMainForm->mUseDatePicker && !$this->mDisabled)
    {
      return "<script type=\"text/javascript\">
                $(function() {
                  $(\"#$dateId\").datepicker({
                    dateFormat: 'dd/mm/yy',  
                    dayNames: ['Domingo','Segunda','Terça','Quarta','Quinta','Sexta','Sábado','Domingo'],  
                    dayNamesMin: ['D','S','T','Q','Q','S','S','D'],  
                    dayNamesShort: ['Dom','Seg','Ter','Qua','Qui','Sex','Sáb','Dom'],  
                    monthNames: ['Janeiro','Fevereiro','Março','Abril','Maio','Junho','Julho','Agosto','Setembro', 'Outubro','Novembro','Dezembro'],  
                    monthNamesShort: ['Jan','Fev','Mar','Abr','Mai','Jun','Jul','Ago','Set', 'Out','Nov','Dez'],  
                    nextText: 'Próximo',  
                    prevText: 'Anterior',
                    changeMonth: true,
                    changeYear: true,
                    showOtherMonths: true, 
                    selectOtherMonths: true, 
                    onSelect: function(dateText){
                      $(this).focus();
                      if (dateText != $(this).datepicker(\"option\", \"defaultDate\"))
                        $(this).change();
                    }
                  });
                });
              </script>";
    }
    else
      return "";

  }
  
  /**
  * Returns the DatePicker html
  * @param string $dateId The related Date Object's Id
  * @returns string
  */
  function GetDatePickerHtml($dateId)
  {

    //if the object uses AND the container is seted to use
    if ($this->mUseDatePicker && $this->mMainForm->mUseDatePicker)
    {
      return '<a '.$this->mDisabled.' href="javascript:void(0)" onClick="if (self.gfPop) gfPop.fPopCalendar(document.getElementById(\''.$dateId.'\')); return false;" HIDEFOCUS><img class="PopcalTrigger" align="absmiddle" src="'.URL.'js/calendar/calbtn.gif" width="20" height="15" border="0" style="position:relative;top:-2px;" ></a> ';
    }
    else
      return "";

  }
}