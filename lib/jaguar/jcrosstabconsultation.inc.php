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
* Consultation's creation class
*
* @author     Atua Sistemas de Informação
* @since      2003-03-21
* @package    Jaguar
* @subpackage Consultation
*/
Class JCrosstabConsultation extends JBaseConsultation
{
  /**
  * Stores the properties of the consultaion's cells
  * @var array
  */
  var $mCellOptions;

  /**
  * Stores the properties of the consultation's headers
  * @var array
  */
  var $mHeaderOptions;

  /**
  * Stores callback function's names
  * @var array
  */
  var $mCallback;

  /**
  * Stores callback function's parameters
  * @var array 
  */
  var $mCallbackParams;

  /**
  * Stores the consultation's SQL statement
  * @var string 
  */
  var $mSql;

  /**
  * Stores the consultation's categories SQL statement
  * @var string 
  */
  var $mCategoriesSql;

  /**
  * Stores the consultation's type SQL statement
  * @var string 
  */
  var $mTypeStatement;

  /**
  * Stores the consultation' catetegory field
  * @var string 
  */
  var $mCategoryField;

  /**
  * Controls if line totalizers will be used
  * @var boolean 
  */
  var $mUseLinesTotalizers = false;

  /**
  * Controls if column totalizers will be used
  * @var boolean 
  */
  var $mUseColumnsTotalizer = false;

  /**
  * Stores the lines totalizers
  * @var array 
  */
  var $mLinesTotalizers;

  /**
  * Stores the column totalizers
  * @var boolean 
  */
  var $mColumnsTotalizer;

  /**
  * Stores the column wicth
  * @var integer 
  */
  var $mColumnWidth = 80;

  /**
  * Constructor
  * @param object $conn A JDBConnection object
  * @param string $conn The consultation's SQL statement
  */
  function __construct($conn, $sql, $categoryField)
  {
    $this->SetConn($conn);
    $this->SetAuth($conn);
    $this->SetCategoryField($categoryField);
    $this->SetSql($sql);
    $this->SetDefaultMessages();
  }
  
  /**
  * Sets callback functions associated to a column and its parameters
  *
  * Eg.: $consultation->SetCallback("general", 10, "format_id_active")
  *
  * @param integer $local    The part of the report affected by the callback 
  * { line_header | column_header | line_value | column_value }
  * @param string  $callback The callback function's name
  * @param array   $params   An associative array containig the callback parameters
  */
  function SetCallback($local, $callback, $params = false)
  {
    $this->mCallback[$local] = $callback;
    $this->mCallbackParams[$local] = (is_array($params))?$params:array();
  }
  
  /**
  * Sets the array containing the cells' options
  * @param string $local { line | column }
  * @param array  $array An associative array containing the options. Eg.: array("align" => "center")
  */
  function SetCellOptions($local, $array)
  {
    $this->mCellOptions[$local] = $array;  
  }

  /**
  * Sets the array containing the header's options
  * @param string $local { line | column }
  * @param array  $array An associative array containing the options. Eg.: array("align" => "center")
  */
  function SetHeaderOptions($local, $array)
  {
    $this->mHeaderOptions[$local] = $array;
  }

  /**
  * Sets the consultation's SQL statements
  * @param string $sql The consultation's SQL statement
  */
  function SetSql($sql)
  {
    if (strpos(strtolower($sql), "order"))
      $sql = substr($sql, 0, strpos(strtolower($sql), "order") );

    $this->mSql = $sql . "ORDER BY 1, 2";

    $this->mCategoriesSql = "SELECT DISTINCT " . $this->mCategoryField . " ";

    $sql = strtolower($sql);
    $sql  = substr($sql, strpos($sql, "from"));

    if (strpos($sql, "group"))
      $length = strpos($sql, "group");
    elseif (strpos($sql, "order"))
      $length = strpos($sql, "order");

    if ($length)
      $this->mCategoriesSql .= substr($sql, strpos($sql, "from"), $length);
    else
      $this->mCategoriesSql .= substr($sql, strpos($sql, "from"));

    $this->mCategoriesSql .= " ORDER BY 1";

    $this->mType = "tipo (campo TEXT, ";

    $trans = array("-" => "_", "/" => "_");

    if ($rs = $this->mConn->Select($this->mCategoriesSql))
    {
      while (!$rs->IsEof())
      {
        $this->mType .= "t_" . strtr($rs->GetField(0), $trans) . " NUMERIC(15,2), ";
        
        $rs->Next();
      }
    }
    else
      echo $this->mConn->GetTextualError();

    $this->mType = substr($this->mType, 0, strlen($this->mType) - 2) . ")";
  }

  /**
  * Sets the usage of lines totalizers
  * @param boolean $use Boolean
  */
  function SetLinesTotalizer($use)
  {
    $this->mUseLinesTotalizer = $use;
  }

  /**
  * Sets the usage of columns totalizers
  * @param boolean $use Boolean
  */
  function SetColumnsTotalizer($use)
  {
    $this->mUseColumnsTotalizer = $use;
  }

  /**
  * Sets the consultation's category field
  * @param string $sql The consultation's category field
  */
  function SetCategoryField($categoryField)
  {
    $this->mCategoryField = $categoryField;
  }

  /**
  * Sets the columns's width
  * @param integer $width Column's width
  */
  function SetColumnWidth($width)
  {
    $this->mColumnWidth = $width;
  }

  /**
  * Builds the consultations based in the added areas
  */
  function BuildConsultation ()
  {

    $trans = array("'" => "''");
    
    $sql = "SELECT * FROM crosstab('" .  strtr($this->mSql, $trans) . "', '" . 
                                         strtr($this->mCategoriesSql, $trans) . 
                                  "') AS " . $this->mType;
    if ($this->mRs = $this->mConn->Select($sql))
    {
      //Largura
      $columns = $this->mRs->GetFieldCount() - 1;
  
      if ($this->mColumnsTotalizer)
        $columns++;

      $this->SetWidth(150 + ($columns * $this->mColumnWidth));
      //Header
      $fields_count = $this->mRs->GetFieldCount();
      for ($i = 0; $i < $fields_count; $i++)
      {
        $local = ((!$i)?"line":"column") . "_header";
        $value = substr($this->mRs->GetFieldName($i), ((!$i)?0:2), strlen($this->mRs->GetFieldName($i)) );
        
        //Header's callback
        if ($this->mCallback[$local])
        {
          $arr = $this->mCallbackParams[$local];
          array_unshift($arr, $value);
          $value = call_user_func_array($this->mCallback[$local], $arr);
        }
        
        $this->OpenHeader($value, $this->mHeaderOptions[ substr($local, 0, strpos($local, "_")) ]);
      }
      if ($this->mUseLinesTotalizer)
        $this->OpenHeader("<b>Total</b>");

      $line = 0;
      //Values
      while (!$this->mRs->IsEof())
      {
        
        $this->OpenRow();
        for ($i = 0; $i < $fields_count; $i++)
        {
          $value = $this->mRs->GetField($i);
          $local = (!$i)?"line_value":"column_value";

          //Totalizers section
          if ($this->mUseLinesTotalizer)
            $this->mLinesTotalizer[$line] += $value;

          if ($this->mUseColumnsTotalizer && $i)
            $this->mColumnsTotalizer[$i] += $value;
          
          //Value's callback
          if ($this->mCallback[$local])
          {
            $arr = $this->mCallbackParams[$local];
            array_unshift($arr, $value);
            $value = call_user_func_array($this->mCallback[$local], $arr);
          }
        
          $this->OpenCell($value, $this->mCellOptions[ substr($local, 0, strpos($local, "_")) ]);
        }//for ($i = 0; $i < $fields_count; $i++)

        if ($this->mUseLinesTotalizer)
        {
          //Lines totalizer callback
          if ($this->mCallback[$local])
          {
            $arr = $this->mCallbackParams[$local];
            array_unshift($arr, $this->mLinesTotalizer[$line]);
            $this->mLinesTotalizer[$line] = call_user_func_array($this->mCallback[$local], $arr);
          }
          
          $this->OpenCell("<b>" . $this->mLinesTotalizer[$line] . "</b>", $this->mCellOptions[ substr($local, 0, strpos($local, "_")) ]);
        }
        
        $this->mRs->Next();
        $line++;
      }

      if ($this->mUseColumnsTotalizer)
      {
        $this->OpenRow();
        $this->OpenCell("<b>Total</b>", $this->mCellOptions["line_value"]);
        reset($this->mColumnsTotalizer);
        do
        {
          $value = current($this->mColumnsTotalizer);

          //Columns totalizer callback
          if ($this->mCallback["column_value"])
          {
            $arr = $this->mCallbackParams[$local];
            array_unshift($arr, $value);
            $value = call_user_func_array($this->mCallback[$local], $arr);
          }
          
          $this->OpenCell("<b>$value</b>", $this->mCellOptions["column"]);
        }while(next($this->mColumnsTotalizer));
        $this->OpenCell("&nbsp;");
      }
    }
    else
    {
      $this->mErros = 1;
      echo $this->GetTextualError();
    }
  }

  /**
  * Builds consultation output
  * @returns string
  */
  function GetHtml()
  {

    if ( ($result = $this->HasPermissionTo("select", $this->mAuth)) !== true)
    {
      $table = new JTable();
      $table->SetAsMainContainer(true);
      $table->OpenRow();
      $table->OpenCell($result);
      return $table->GetHtml();
    }

    $this->BuildConsultation();

    $this->SetWidth($this->mWidth);

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