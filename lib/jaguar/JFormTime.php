<?php

/**
* Time objects creation class
*
* @author  Atua Sistemas de Informação
*/
class JFormTime extends JFormText
{
  /**
  * Stores object's type
  * @var string
  */
  var $mType       = "Time";

  /**
  * Stores error message
  * @var string
  */
  var $mError      = "Hora inválida!";

  /**
  * Controls whether the field must have seconds or not
  * @var boolean
  */
  var $mUseSeconds = false;

  /**
  * Stores the object's regEx
  * @var string
  */
  var $mRegEx = "(0[0-9]|1[0-9]|2[0-3]):([0-5][0-9])";

  /**
  * Stores the first comparison time
  * @var string
  */
  var $mTime1       = "";

  /**
  * Stores the second comparison time
  * @var string
  */
  var $mTime2       = "";

  /**
  * Stores the times comparison's condition
  * @var string
  */
  var $mCondition   = "";

  /**
  * Stores the interval to be compared between two times
  * @var string
  */
  var $mInterval   = 0;

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
    $this->SetSize(($this->IsIE() ? 2 : 4)); 
    $this->SetMaxLength(5);
    $this->SetTestOnBlur(true);
  }

  /**
  * Sets whether the field must use seconds or not
  * @param boolean $bool
  */
  function SetUseSeconds($bool = false)
  {
    $this->mUseSeconds = $bool;
    $this->SetSize(8);
    $this->SetMaxLength(8);
  }

  /**
  * Sets default JS functions for JFormTime objects
  */
  function SetDefaultEvents()
  {
    $this->SetEvents("onBlur", "complete_time");
    $this->SetParameters("complete_time", "this");
    
    if ($this->mTestOnBlur)
    {
      $this->SetEvents("onBlur", "validate_time"); 
      $this->SetParameters("validate_time", "this");
      $this->SetParameters("validate_time", $this->mError);

      if ($this->mTime1 && ($this->mCondition || $this->mTime2) )
      {
        $this->SetEvents("onBlur", "test_time");
        $this->SetParameters("test_time", "this");

        if (is_object($this->mTime1))
          $this->SetParameters("test_time", "document." . $this->mMainForm->mName . "." . $this->mTime1->mName . ".value");
        else
          $this->SetParameters("test_time", $this->mTime1);

        $this->SetParameters("test_time", $this->mTime2);
        $this->SetParameters("test_time", $this->mCondition);
        $this->SetParameters("test_time", $this->mError);
        $this->SetParameters("test_time", $this->mInterval);
        $this->SetParameters("test_time", $this->GetLabel());
      }
    }
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

    if (!$this->mTestOnBlur)
      $this->mRegEx = "([0-9][0-9]):([0-5][0-9])";
    
    //syntactic analysis
    if (!preg_match($this->GetRegEx(false, false), $this->GetValue()) && $this->mTestOnBlur)
    {
      $this->SetInvalidMessage("Formatação de Hora inválida");
      return false;
    }

    $ok = true;

    if ($this->mTime1 && is_string($this->mTime1) && ($this->mCondition || $this->mTime2))
    {
      $time = explode(":", $this->GetValue());
      $time = ($time[0] * 60) + $time[1];

      $time1 = explode(":", $this->mTime1);
      $time1 = ($time1[0] * 60) + $time1[1];

      if ($this->mTime2 != '')
      {
        $time2 = explode(":", $this->mTime1);
        $time2 = ($time2[0] * 60) + $time2[1];

        if ( !($time >= $time1 && $time <= $time2) )
        {
          $this->SetInvalidMessage("A hora '" . $this->GetValue() . "' deve estar entre " . $this->mTime1 . " e " . $this->mTime2);
          return false;
        }
      }
      else
      {
        $conditionValue = '';
        
        switch($this->mCondition)
        {
          case "=":
            $ok = $ok && ($time == $time1);
            $conditionValue = 'igual';
          break;

          case "<":
            $ok = $ok && ($time < $time1);
            $conditionValue = 'menor';
          break;

          case "<=":
            $ok = $ok && ($time <= $time1);
            $conditionValue = 'menor ou igual';
          break;

          case ">":
            $ok = $ok && ($time > $time1);
            $conditionValue = 'maior';
          break;

          case ">=":
            $ok = $ok && ($time >= $time1);
            $conditionValue = 'maior ou igual';
          break;
        }
      }
    }

    if (!$ok)
    {
      $str = $conditionValue . (($this->mCondition == '>' || $this->mCondition == '<') ? ' do que ' : ' á ');
      $this->SetInvalidMessage("A data '" . $this->GetValue() . "' deve ser " . $str . " '" . $this->mTime1 . "'", true); 
      return false;
    }

    return true;
  }

  /**
  * Sets the first comparison time
  * @param string $time1 Time's value
  */
  function SetTime1($time1 = false)
  {
    if (is_object($time1))
      $this->mTime1 = &$time1;
    else
      $this->mTime1 = $time1;
  }

  /**
  * Sets the second comparion time
  * @param string $time2
  */
  function SetTime2($time2 = false)
  {
    $this->mTime2 = $time2;
  }

  /**
  * Sets the comparison's  condition
  * @param string $condition { "=" | "<" | "<=" | ">" | ">=" }
  */
  function SetCondition($condition = false)
  {
    $this->mCondition = ($condition) ? $condition : "";
  }

  /**
  * Sets the interval to be compared between two times (in minutes)
  * @param integer $condition 
  */
  function SetInterval($interval = false)
  {
    $this->mInterval = ($interval) ? $interval : "";
  }

  /**
  * Builds the object's JS onSubmit validation code
  * @returns string
  */
  function GetJSOnSubmit()
  {
    $out = "";

    $out .= "  " . $this->mName . "_ok = true; \n";
    
    if (((is_string($this->mTime1) && strlen($this->mTime1) > 0) || is_object($this->mTime1)) &&
        (strlen($this->mCondition) > 0 || strlen($this->mTime2) > 0))
    {
      $out .= "  " . $this->mName . "_ok = " . $this->mName . "_ok && (test_time(";
      $out .= "document." . $this->mMainForm->mName . "." . $this->mName . ", ";
      
      if (is_string($this->mTime1))
        $out .= "'$this->mTime1', ";
      else
        $out .= "document." . $this->mMainForm->mName . "." . $this->mTime1->mName . ".value, ";

      $out .= "'$this->mTime2', '$this->mCondition', ";
      $out .= "'$this->mError', '" . $this->mInterval . "', '" . $this->GetLabel() . "'));\n";
    }

    $out .= "  " . $this->mName . "_ok = " . $this->mName . "_ok && validate_time(";
    $out .= "this, '$this->mError');\n";

    if ($this->mTestIfEmpty != 0)
    {
      $out .= "  " . $this->mName . "_ok = " . $this->mName . "_ok && (!test_if_empty(document." . $this->mMainForm->mName . "." .
                 $this->mName . ".value, '$this->mTestIfEmptyMessage', '" . $this->mMainForm->mName . "','$this->mName'));\n";
    }
    
    $out .= "  ok = ok && " . $this->mName . "_ok;\n";
    $out .= "  form_submitted = (form_submitted && " . $this->mName . "_ok);\n\n";

    return $out;
  }

  /**
  * Sets the object's value
  * @param string $value Object's value
  */
  function SetValue($value = false)
  {
    if (strlen($value) != 5)
      $value = substr($value, 0, 5);

    if (!preg_match($this->GetRegEx(false, false), $value))
      $this->SetInvalidMessage("Setando Formatação de Hora inválida"); //TODO lançar erro pelo sistema de tratamento de erros

    parent::SetValue($value);
  }

  /**
  * Builds object's output
  * @returns string
  */
  function GetHtml()
  {
    $out  = "\n";
    $out .= "<input class=\"" . $this->MakeClass() . "\" id=\"" . $this->MakeId() . "\" type=\"text\" name=\"$this->mName\" value=\"" . $this->GetValue() . "\"";
    $out .= " size=\"" . $this->mSize . "\" maxlength=\"" . $this->mMaxLength . "\" $this->mDisabled" .
            $this->GetCssclass();

    //JavaScript events
    parent::SetDefaultEvents();
    $this->SetDefaultEvents();
   
    $out .= $this->BuildJSEvents();
    $out .= " $this->mExtra>\n";
    $out .= $this->GetTip();
    $out .= $this->GetMask('time');

    return $this->GetRawHtml($out);
  }
}
