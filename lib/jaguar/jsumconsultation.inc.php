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
* Sum consultations creation class
*
* @author     Atua Sistemas de Informação
* @since      2003-05-09
* @package    Jaguar
* @subpackage Consultation
*/
Class JSumConsultation extends JBaseConsultation
{
  /**
  * Stores the consultation query
  * @var string
  */
  var $mSql;
           
  /**
  * Stores the totalizer callback function's name
  * @var string
  */
  var $mTotalCallback;

  /**
  * Stores the totalizer callback function's parameters
  * @var array
  */
  var $mTotalCallbackParams;
 
  /**
  * Stores the texts callback function's name
  * @var array 
  */
  var $mTextCallback;

  /**
  * Stores the texts callback function's parameters
  * @var array
  */
  var $mTextCallbackParams;
  
  /**
  * Stores the SQL group fields
  * @var array
  */
  var $mGroups;

  /**
  * Stores the name of the field used in the sum
  * @var string
  */
  var $mAdder;

  /** 
  * Controls if the consultation will make a final calculation
  * @var boolean
  */
  var $mComparison           = false;
  
  /**
  * Stores the value that will be used in a mathematic operation with the
  * consultation's final result
  * @var int
  */
  var $mComparisonValue      = 0;

  /**
  * Stores the label that will be shown besides the consultation's final result
  * @var text
  */
  var $mComparisonLabel;   

  /**
  * Controls if the mComparisonLabel will be used in the final operation before ou after the final result
  * @var string
  */
  var $mAlignComparisonValue = 'left';
  
  /**
  * Stores the mathematical operator that will be applied to the final result
  * @var string
  */
  var $mOperator             = "-";

  /**
  * Stores the mAdder field's unit
  * @var string
  */
  var $mUnit;

  /**
  * Stores the mAdder field's unit alignment
  * @var string
  */
  var $mUnitAlign            = 'left';
  
  /**
  * Stores the totalization values
  * @var array
  */
  var $mTotal;

  /**
  * Stores the consultations final value
  * @var int
  */
  var $mTotalling            = 0;

  /**
  * Stores the groups labels
  * @var array
  */
  var $mGroupLabel;

  /**
  * Stores the header table's object (JTable)
  * @var object
  */
  var $mHeaderTable;

  /**
  * Stores the report's title
  * @var string
  */
  var $mSumConsultationTitle;

  /**
  * Stores the name of the group that controls if the header must be reprinted
  * @var string
  */
  var $mSeparatorGroup;

  /**
  * Stores the grid's columns alignment
  * @var array
  */
  var $mColumnAlign;

  /**
  * Stores the array containing the visible fields
  * @var array 
  */
  var $mVisibleFields;
  
  /**
  * Constructor
  * @param object $conn  A JDBConnection object
  * @param string $sql   The consultation's query
  * @param string $title The consultation's title
  */
  function __construct($conn, $sql, $title = false)
  {
    $this->SetConn($conn);
    $this->SetSql($sql);
    $this->SetSumConsultationTitle($title);
    $this->SetDefaultMessages();
  }
  
  /**
  * Sets the consultation query
  * @param string $sql A valid SELECT statement
  */
  function SetSql ($sql)
  {
    $this->mSql = $sql;
  }

  /**
  * Sets the consultation's title
  * @param string $title
  */
  function SetSumConsultationTitle($title)
  {
    $this->mSumConsultationTitle = $title;
  }
                  
  /**
  * Sets the visible fields arrau
  * @param array $array
  */
  function SetVisibleFields ($array = false)
  {
    $this->mVisibleFields = $array;
  }
  
  /**
  * Sets the groups array
  * @param array $array An array containing the names of the fileds that will be grouped
  */
  function SetGroups ($array = false)
  {
    $this->mGroups = $array;
  }

  /**
  * Sets the separator group
  * @param string $group The name of the field that will generate a new group header whhen changed
  */
  function SetSeparatorGroup($group)
  {
    $this->mSeparatorGroup = $group;
  }
  
  /**
  * Sets the name of the filed that will be summarized
  * @param string $field A field name
  */
  function SetAdder ($field)
  {
    $this->mAdder = $field;
  }

  /**
  * Sets the labels used in the summarization lines
  * @param array $array
  */
  function SetGroupLabel($array)
  {
    $this->mGroupLabel = $array;
  }

  /**
  * Sets the unit of the summarized field and its position
  * @param string $unit  The unit description. Eg.: U$$, cm
  * @param string $align The unit's description position. Eg.: left = U$$ XXX, right = XX cm
  */
  function SetUnit($unit, $align = "left")
  {
    $this->mUnit      = $unit;
    $this->mUnitAlign = $align;
  }
  
  /**
  * Sets callback functions associated to a column and its parameters
  * @param int    $col      The columns index in the mVisibleFields array
  * @param string $callback The callback function's name
  * @param array  $params   The callback function's parameters
  */
  function SetCallback ($col, $callback, $params = false)
  {
    $this->mCallback[$col] = $callback;
    $this->mCallbackParams[$col] = (is_array($params))?$params:array();
  }

  /**
  * Sets callback functions associated to the summarized and its params
  * @param string $callback The callback function's name
  * @param array  $params   The callback function's parameters
  */
  function SetTotalCallback ($callback, $params = false)
  {
    $this->mTotalCallback = $callback;
    $this->mTotalCallbackParams = (is_array($params))?$params:array();
  }

  /**
  * Sets the callback function associated to the fields defined in the SetGroupLabel field 
  * @param string $col      Column index in the mVisibleFields array
  * @param string $callback Callback function's name
  * @param array $params    Callback Function's parameters
  */
  function SetTextCallback ($col, $callback, $params = false)
  {
    $this->mTextCallback[$col] = $callback;
    $this->mTextCallbackParams[$col] = (is_array($params))?$params:array();
  }
  
  /**
  * Sets a grid column's alignment
  * @param string $column Grid columns index
  * @param string $align  Alignment { "left" | "center" | "right" }
  */  
  function SetColumnAlign($column, $align)
  {
    $this->mColumnAlign[$column] = $align;
  }

  /**
  * Sets the element used in the consultation's final calculation
  * @param int    $value    Column's index
  * @param string $align    Operator's alignment. { "left" | "right" }
  * @param string $operator Operator. { "+" | "-" | "/" | "*" }
  * @param string $text     Oparation's label
  */
  function SetComparisonElements($value = 0, $align = "left", $operator = "-", $text = false)
  {
    $this->mComparison           = true; 
    $this->mComparisonValue      = $value;
    $this->mAlignComparisonValue = $align;
    $this->mOperator             = $operator;
    $this->mComparisonLabel      = $text;
  }

  /**
  * Builds the columns headers
  */
  function BuildColumnsHeader()
  {
    if (is_array($this->mVisibleFields))
    {
      $this->OpenRow();
      $this->OpenCell("&nbsp;", array("colspan" => sizeof($this->mVisibleFields)));

      $this->OpenRow();

      reset($this->mVisibleFields);
      do
      {
        $this->OpenHeader("<b>".current($this->mVisibleFields)."</b>");
      }
      while(next($this->mVisibleFields));
    }
  }
  
  /**
  * Builds the consultation's header
  */
  function BuildSumConsultationHeader()
  {
    $this->OpenRow();
    $this->OpenCell("",  array("colspan" => sizeof($this->mVisibleFields)));
    $this->mHeaderTable = new JTable();
    $this->mHeaderTable->SetWidth("100%");
    $this->mHeaderTable->SetLineStyles("rowodd", "rowodd", "rowodd", "rowodd");
    
    //título
    $this->mHeaderTable->OpenRow();
    $this->mHeaderTable->OpenHeader("<h3>".$this->mSumConsultationTitle."</h3>", 
                                    array("colspan" => "3"));
    //linha em branco
    $this->mHeaderTable->OpenRow();
    $this->mHeaderTable->OpenCell("", array("colspan" => "3"));
    
    $this->mHeaderTable->OpenRow();
    
    //data de geração do relatório
    $this->mHeaderTable->OpenHeader(date("d/m/Y H:i:s"));
    
    //número de registros
    $this->mHeaderTable->OpenHeader($this->mMessages["RecordsNumber"].": ".$this->mRs->GetRowCount());
    
    $this->AddObject($this->mHeaderTable);
    
    $this->BuildColumnsHeader();
    
  }
  
  /**
  * Builds the final operation
  */
  function BuildComparison()
  {
    $header_options = array("colspan" => sizeof($this->mVisibleFields), "align" => "left");
    
    //posicionamento dos valores
    if ($this->mAlignComparisonValue == "left")
    {
      $value_1 = $this->mComparisonValue;
      $value_2 = $this->mTotalling;
    }
    else
    {
      $value_1 = $this->mTotalling;
      $value_2 = $this->mComparisonValue;
    }

    //operação
    switch ($this->mOperator)
    {
      case "+":
        $result = $value_1 + $value_2;
      break;

      case "-":
        $result = $value_1 - $value_2;
      break;

      case "*":
        $result = $value_1 * $value_2;
      break;

      case "/":
        $result = $value_1 / $value_2;
      break;
    }

    //callback
    if ($this->mTotalCallback)
    {
      $arr = $this->mTotalCallbackParams;
      array_unshift($arr, $this->mTotalling);
      $this->mTotalling = call_user_func_array($this->mTotalCallback, $arr);

      $arr = $this->mTotalCallbackParams;
      array_unshift($arr, $this->mComparisonValue);
      $this->mComparisonValue = call_user_func_array($this->mTotalCallback, $arr);

      $arr = $this->mTotalCallbackParams;
      array_unshift($arr, $result);
      $result = call_user_func_array($this->mTotalCallback, $arr);
    }
    
    //linha em branco
    $this->OpenRow();
    $this->OpenCell("&nbsp;", array("colspan" => sizeof($this->mVisibleFields)));

    $str_1 = "<b>".$this->mMessages["Total"]."</b> ";
    $str_2 = "<b>".$this->mComparisonLabel."</b>";
    $str_3 = "<b>Saldo Final</b>";

    //se o resultado for negativo
    if ($result < 0)
      $result = "<font color=\"#F80517\">".$result."<font>";
    
    //alinhamento da unidade 
    if ($this->mUnitAlign == "left")
    {
      $str_1_1 .= $this->mUnit." ".$this->mTotalling;
      $str_2_2 .= $this->mUnit." ".$this->mComparisonValue;
      $str_3_3 .= $this->mUnit." ".$result;
    }
    else
    {
      $str_1_1 .= $this->mTotalling." ".$this->mUnit;
      $str_2_2 .= $this->mComparisonValue." ".$this->mUnit;
      $str_3_3 .= $result." ".$this->mUnit;
    }

    //mostra os valores
    $this->OpenRow();
    $this->OpenHeader($str_1, array("align" => "left"));
    $this->OpenHeader($str_1_1, $header_options);
    $this->OpenRow();
    $this->OpenHeader($str_2, array("align" => "left"));
    $this->OpenHeader($str_2_2, $header_options);
    $this->OpenRow();
    $this->OpenHeader($str_3, array("align" => "left"));
    $this->OpenHeader($str_3_3, $header_options);
  }
  
  /**
  * Builds the consultation
  */
  function BuildSumConsultation()
  {
    if ($this->mRs = $this->mConn->Select($this->mSql))
    {
      $this->SetWidth($this->mWidth);
      $this->SetLineStyles("rowodd", "rowodd", "rowodd", "rowodd");
      
      $this->BuildSumConsultationHeader();
      $header_options = array("colspan" => sizeof($this->mVisibleFields), "align" => "left");
      
      if (!$this->mError)
      {
        while (!$this->mRs->IsEof())
        {
          unset($value);
          $value = $this->mRs->GetField($this->mAdder);

          //totalização do relatório
          $this->mTotalling += $value;
          
          //adder callback
          if ($this->mCallback[$this->mAdder])
          {
            $arr = $this->mCallbackParams[$this->mAdder];
            array_unshift($arr, $value);
            $value = call_user_func_array($this->mCallback[$this->mAdder], $arr);
          }
          
          //totalizacoes dos grupos
          $show_total = false; 
          $init       = false;
          
          for ($i = 0; $i < sizeof($this->mGroups); $i++)
          {
            $group = $this->mGroups[$i];

            if (!strlen($$group) > 0)
            {
              $$group = $this->mRs->GetField($group);
              $this->mTotal[$$group] += $value;
              $init = true;
            }
            else
            {
              if ($$group != $this->mRs->GetField($group))
              {
                $show_total = true;
                $index      = $i;
              }
            }
          }
          
          if (!$init)
          {
            if (!$show_total)
            {
              for ($i = 0; $i < sizeof($this->mGroups); $i++)
              {
                $group = $this->mGroups[$i];
                $this->mTotal[$$group] += $value;
              }
            }
            else
            {
              for ($i = ($index + 1); $i < sizeof($this->mGroups); $i++)
              {
                $group = $this->mGroups[$i];
                $this->mTotal[$$group] += $value;
              }
            
              for ($i = 0; $i <= $index; $i++)
              {
                $group = $this->mGroups[$i];
                $total = $this->mTotal[$$group];
                $this->OpenRow();
    
                //total callbacks
                if ($this->mTotalCallback)
                {
                  $arr = $this->mTotalCallbackParams;
                  array_unshift($arr, $total);
                  $total = call_user_func_array($this->mTotalCallback, $arr);
                }
        
                $str = $this->mGroupLabel[$group]." ";
                
                //text callbacks
                if ($this->mTextCallback[$group])
                {
                  $arr = $this->mTextCallbackParams[$group];
                  array_unshift($arr, $$group);
                  $$group = call_user_func_array($this->mTextCallback[$group], $arr);
                }
                
                $str .= $$group.": ";
                
                if ($this->mUnitAlign == "left")
                  $str .= $this->mUnit." ".$total;
                else
                  $str .= $total." ".$this->mUnit;

                $this->OpenHeader($str, $header_options);
                $this->mTotal[$$group] = 0;
               
                if ($group == $this->mSeparatorGroup)
                  $this->BuildColumnsHeader();
                
                $$group = $this->mRs->GetField($group);
                $this->mTotal[$$group] = 0;
                $this->mTotal[$$group] += $value;
              }
            }
          }

          //dados
          if (is_array($this->mVisibleFields))
          {
            $this->OpenRow();

            reset($this->mVisibleFields);
            for ($i = 0; $i < sizeof($this->mVisibleFields); $i++)
            {
              $group = key($this->mVisibleFields);
              
              $value = "--";

              if ($$group != $this->mRs->GetField(key($this->mVisibleFields)) || $show_total || $init)
              {
                $value = $this->mRs->GetField(key($this->mVisibleFields));
              
                //callback
                if ($this->mCallback[$i])
                {
                  $arr = $this->mCallbackParams[$i];
                  array_unshift($arr, $value);
                  $value = call_user_func_array($this->mCallback[$i], $arr);
                }
              }
              
              $cell_options = array("align" => $this->mColumnAlign[key($this->mVisibleFields)]);
              $this->OpenCell($value, $cell_options);  
              
              next($this->mVisibleFields);
            }
          }
        
          $this->mRs->Next();

          //totalizações finais dos grupos
          if ($this->mRs->IsEof())
          {
            for ($i = 0; $i < sizeof($this->mGroups); $i++)
            {
              $group = $this->mGroups[$i];
              $total = $this->mTotal[$$group];
              $this->OpenRow();

              //total callbacks
              if ($this->mTotalCallback)
              {
                $arr = $this->mTotalCallbackParams;
                array_unshift($arr, $total);
                $total = call_user_func_array($this->mTotalCallback, $arr);
              }
              
              $str = $this->mGroupLabel[$group]." ";
              
              //text callbacks
              if ($this->mTextCallback[$group])
              {
                $arr = $this->mTextCallbackParams[$group];
                array_unshift($arr, $$group);  
                $$group = call_user_func_array($this->mTextCallback[$group], $arr);
              }                                                                                                                    
              $str .= $$group.": ";
              
              if ($this->mUnitAlign == "left")
                $str .= $this->mUnit." ".$total;
              else
                $str .= $total." ".$this->mUnit;
              $this->mTotal[$$group] = 0;
              $this->OpenHeader($str, $header_options);
            }
          }
        }//while (!$this->mRs->IsEof())

        //comparação de valores
        if ($this->mComparison)
          $this->BuildComparison(); 

        $this->CloseTable();
      
      }//if (!$this->mError
      else
        $this->AddObject($this->mConn->GetError());  

    }//if ($this->mRs = $this->mConn->Select($this->mSql))
    else
      $this->AddObject($this->mConn->GetError());

  }
  
  /**
  * Builds consultation output
  * @returns string
  */
  function GetHtml ()
  {
    unset($out);
   
    $build_report = true;
    if ( ($result = $this->HasPermissionTo("select", $this->mAuth)) !== true) 
    {
      $build_report = false;
      $table = new JTable();
      $table->OpenRow();
      $table->OpenCell($result);
      return $table->GetHtml();
    }

    if ($build_report)
      $this->BuildSumConsultation();
    
    for ($i = 0; $i < $this->mIndex; $i++)
    {
      if (is_object($this->mObjects[$i]))
        $out .= $this->mObjects[$i]->GetHtml();
      else
        $out .= $this->mTexts[$i];
    }

    return $out;
    
  }
}