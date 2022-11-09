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
Class JConsultation extends JBaseConsultation
{

  /**
  * Stores object's type
  * @var string
  */
  var $mType = "Consultation";

  /**
  * Stores the consultation areas
  * @var array
  */
  var $mAreas;

  /**
  * Stores an array that controls if line breaks are required after a field
  * @var array
  */
  var $mNoBreakLines;

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
  * Stores the properties of the consultation's field headers
  * @var array
  */
  var $mCellHeaderOptions;

  /**
  * Controls if the consultation's areas must display data in horizontal or vertical
  * @var array
  */
  var $mVertical;

  /**
  * Stores the URL to edit the consultation data
  * @var array
  */  
  var $mUrl;

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
  * Stores the array containing the visible fields for each area
  * @var array 
  */
  var $mVisibleFields;

  var $mSum;
  var $mOptionSum;

  var $mSumTime;
  var $mOptionSumTime;
  
  var $mTotalRows;

  /**
  * Constructor
  * @param object $conn A JDBConnection object
  */
  function __construct($conn)
  {
    $this->SetConn($conn);
    $this->SetAuth($conn);
    $this->SetDefaultMessages();
  }
  
  /**
  * Sets callback functions associated to a column and its parameters
  *
  * Eg.: $consultation->SetCallback("general", 10, "format_id_active")
  *
  * @param string  $area     The area's name
  * @param integer $col      The column index in the visible fields array (Starting in 0)
  * @param string  $callback The callback function's name
  * @param array   $params   An associative array containig the callback parameters
  */
  function SetCallback($area, $col, $callback, $params = array())
  {
    $this->mCallback[$area][$col] = $callback;
    if ($callback == "CallbackPopup")
      array_unshift($params, $this, $area);
    $this->mCallbackParams[$area][$col] = $params;
  }

  function SetSum($area, $col)
  {
    $this->mSum[$area][$col] = 0;
  }
  
  function SetSumTime($area, $col)
  {
    $this->mSumTime[$area][$col] = 0;
  }
  
  function SetShowTotalRows($area)
  {
    $this->mTotalRows[$area] = 0;
  }

  /**
  * Sets the array os visible fields for each area
  * @param string $area  The area's name
  * @param array  $array An array containing the visible fields for this area
  */
  function SetVisibleFields($area, $array = false)
  {
    $this->mVisibleFields[$area] = $array;
  }

  /**
   * Build a popup to con_$pop.php on the label
   * @param string $area    Area where the label is located
   * @param string $field   Name of the label
   * @param string $pop     Name of consultation form
   * @param array $fields   Associative array with name and value of fields
   * @param string $width   Width's popup
   * @param string $height  Height's popup
  */
  function SetPopup($area, $field, $pop = "", $fields = "", $width = "", $height = "")
  {
    if ($pop == "")
      $pop = substr($field, 3);
    foreach ($fields as $key => $value)
      $filter[] = $key."=".$value;
    $this->mVisibleFields[$area][$field] = "<a onclick = \"javascript:pop_open('con_$pop.php?".implode("&", $filter)."', ".
                                               "'$width', '$height', false, 'yes');\">".$this->mVisibleFields[$area][$field]."</a>";
  }

  /**
  * Sets the line break control array
  * @param string $area  The area's name
  * @param string $field The field's name
  */
  function SetNoBreakLine($area, $field)
  {
    $this->mNoBreakLines[$area][$field] = true;
  }

  /**
  * Sets the array containing the cells' options
  * @param string $area  The area's name
  * @param string $field The field's name
  * @param array  $array An associative array containing the options. Eg.: array("align" => "center")
  */
  function SetCellOptions($area, $field, $array)
  {
    $this->mCellOptions[$area][$field] = $array;  
  }

  /**
  * Sets the array containing the header's options
  * @param string $area  The area's name
  * @param mixed  $array_or_field  An associative array for global options or the field's name for local options
  * @param array  $array An associative array containing the options. Eg.: array("align" => "center")
  */
  function SetHeaderOptions($area, $array_or_field, $array = null)
  {
    if (is_array($array_or_field))
      $this->mHeaderOptions[$area] = $array_or_field;
    elseif (is_string($array_or_field) && is_array($array))
      $this->mCellHeaderOptions[$area][$array_or_field] = $array;
  }
                       
  /**
  * Sets the URL for directly editing the consultation data
  * @param string $area The area's name
  * @param string $url  The complete URL 
  */
  function SetUrl($area, $url)
  {
    $this->mUrl[$area] = $url;
  }
  
  /**
  * Adds consultation areas
  * @param string $area      The area's name. This parameter will be used to identify the area in many methods
  * @param string $sql       The query string
  * @param string $title     The area's title
  * @param string $verticao  The area's orientation. true = vertical, false = horizontal
  */
  function AddArea($area, $sql, $title = false, $vertical = false)
  {
    $this->mAreas[$area]["sql"]   = $sql;
    $this->mAreas[$area]["title"] = $title;
    $this->mVertical[$area]       = $vertical;
    
    if (strpos($title, "href"))
    {
      $aux = substr($title, strpos($title, "_"));
      $this->mAreas[$area]["permissao"] = substr($aux, 1, strpos($aux, ".") - 1);
    }
  }  
 
  /**
  * Executes the consultations queries and stores it's results in the $this->mRs array
  */
  function ExecuteSql ()
  {
    reset($this->mAreas);
    do
    {
      $area = key($this->mAreas);
      $sql  = $this->mAreas[key($this->mAreas)]["sql"];
  
      if (!$this->mRs[$area] = $this->mConn->Select($sql))
      {
        $this->mError = true;
        break;
      }
    }
    while(next($this->mAreas));
  }
  
  /**
  * Builds the consultations based in the added areas
  */
  function BuildConsultation ()
  {
    $this->ExecuteSql();
    
    if (!$this->mError)
    {
      /**
      * Create sort function
      */
      $this->AddHtml("<script type='text/javascript' language=JavaScript>$(document).ready(function() { $('.JTable').tablesorter(); } );</script>");
    
      $count_areas = 1;
      reset($this->mAreas);
      do
      {
        $area = key($this->mAreas);
        
        $this->OpenRow();
        if ($this->mUrl[$area])
          $url = "<a href=\"".$this->mUrl[$area]."\">".$this->mAreas[$area]["title"]."</a>";
        else
          $url = $this->mAreas[$area]["title"];

        $this->OpenHeader("&nbsp;&nbsp;".$url, array("bgcolor" => "#FFFFFF", "align"   => "left"));

        $this->OpenRow();
        $this->OpenCell();


        $table = "tab_".$count_areas;
        $$table = new JTable();
        $$table->SetWidth("100%");
        
        $header_options = array("bgcolor" => "#FFFFFF", 
                                "align"   => "left");
        $fields = $this->mVisibleFields[$area];  

        if ($this->mVertical[$area])
        {
          if (is_array($fields))
          {
            $$table->OpenThead();
            $$table->OpenRow();

            reset($fields);
            do
            {
              $$table->OpenHeader(current($fields), array("align" => "center"));
            }
            while(next($fields));
            $$table->CloseThead();
            
            $$table->OpenTbody();
            $$table->OpenRow();

            if (!$this->mRs[$area]->GetRowCount()) 
            {
              $$table->OpenRow();
              $$table->OpenCell("<i>Sem dados.</i>", array("colspan" => count($fields)));
              $this->AddObject($$table);
              $this->OpenRow();
              $this->OpenCell("&nbsp;", $header_options);
              $count_areas++;
              continue;
            } 
            
            while (!$this->mRs[$area]->IsEof())
            {
              $k = 1;
              $i = 0;

              reset($fields);
              do
              {
                $value = $this->mRs[$area]->GetField(key($fields)); 
                
                //Sum
                if (isset($this->mSum[$area][$i]))
                {
                  $this->mSum[$area][$i] += $value;
                  $this->mOptionSum[$area][$i] = $this->mCellOptions[$area][key($fields)];
                }
                
                //SumTime
                if (isset($this->mSumTime[$area][$i]))
                {
                  $aux = array($this->mSumTime[$area][$i], $value);
                  $seconds = 0;

                  foreach ($aux as $time)
                  {
                    list($h, $m, $s) = explode(':', $time);
                    $seconds += $h * 3600;
                    $seconds += $m * 60;
                    $seconds += $s;
                  }

                  $hours = floor($seconds / 3600);
                  $seconds -= $hours * 3600;
                  $minutes = str_pad(floor($seconds / 60), 2, "0", STR_PAD_LEFT);
                  $seconds -= $minutes * 60;
                  $seconds = str_pad($seconds, 2, "0", STR_PAD_LEFT);

                  $this->mSumTime[$area][$i] = "$hours:$minutes:$seconds";
                  $this->mOptionSumTime[$area][$i] = $this->mCellOptions[$area][key($fields)];
                }

                //callback 
                if ($this->mCallback[$area][$i])
                {
                  $arr = $this->mCallbackParams[$area][$i];
                  array_unshift($arr, $value);
                  $value = call_user_func_array($this->mCallback[$area][$i], $arr);
                }

                $cell_options = ifnull($this->mCellOptions[$area][key($fields)], array());
                $$table->OpenCell($value, array_merge(array("class" => "table-grid-td"), $cell_options));
                
                if ($k == sizeof($fields))
                {
                  $$table->OpenRow();
                  $k = 1;
                }
                else
                  $k++;
                
                $i++;
              }
              while(next($fields));
              $this->mRs[$area]->Next();            
            }
            
            $$table->CloseTbody();

            if (isset($this->mSum[$area]))
            {
              $qtEmptyCells = 0;
              $aux = true;

              if (isset($this->mTotalRows[$area]))
                $fields = array("*" => "") + $this->mVisibleFields[$area];
              else
                $aux = false;

              for ($s=0;$s<$i;$s++)
              {
                //callback 
                if ($this->mCallback[$area][$s] && isset($this->mSum[$area][$s]))
                {
                  $arr = $this->mCallbackParams[$area][$s];
                  array_unshift($arr, $this->mSum[$area][$s]);
                  $this->mSum[$area][$s] = call_user_func_array($this->mCallback[$area][$s], $arr);
                }
                if (!isset($this->mSum[$area][$s]) && $aux)
                  $qtEmptyCells++;
                elseif ($aux)
                {
                  $aux = false;
                  $$table->OpenCell("<b>".$this->mRs[$area]->GetRowCount()."</b>", array_merge(array("class" => "table-grid-td", "colspan" => $qtEmptyCells), ifnull($this->mOptionSum[$area][$s], array())));
                  $$table->OpenCell(isset($this->mSum[$area][$s]) ? "<b>".$this->mSum[$area][$s]."</b>" : "", array_merge(array("class" => "table-grid-td"), ifnull($this->mOptionSum[$area][$s], array())));
                }
                elseif ($s < sizeof($fields))
                  $$table->OpenCell(isset($this->mSum[$area][$s]) ? "<b>".$this->mSum[$area][$s]."</b>" : "", array_merge(array("class" => "table-grid-td"), ifnull($this->mOptionSum[$area][$s], array())));
              }
            }
            
            if (isset($this->mSumTime[$area]))
            {
              for ($s=0;$s<=$i;$s++)
              {
                //callback 
                if ($this->mCallback[$area][$s] && isset($this->mSumTime[$area][$s]))
                {
                  $arr = $this->mCallbackParams[$area][$s];
                  array_unshift($arr, $this->mSumTime[$area][$s]);
                  $this->mSumTime[$area][$s] = call_user_func_array($this->mCallback[$area][$s], $arr);
                }

                if ($s < sizeof($this->mVisibleFields[$area]))
                  $$table->OpenCell(isset($this->mSumTime[$area][$s]) ? "<b>".$this->mSumTime[$area][$s]."</b>" : "", $this->mOptionSumTime[$area][$s]);
              }
            }
          }// if (is_array($fields))
        }// if ($this->mVertical[$area])
        else
        {
          if (!$this->mRs[$area]->GetRowCount()) 
          {
            $$table->OpenRow();
            $$table->OpenCell("<i>Sem dados.</i>");
            $this->AddObject($$table);
            $this->OpenRow();
            $this->OpenCell("&nbsp;", $header_options);
            $count_areas++;
            continue;
          } 

          if (is_array($fields))
          {
            $count_records = 1;
            
            while (!$this->mRs[$area]->IsEof())
            {
              $i = 0;

              reset($fields);
              do
              {
                $value        = $this->mRs[$area]->GetField(key($fields));
                $nobreakline  = $this->mNoBreakLines[$area][key($fields)];
                $cell_options = $this->mCellOptions[$area][key($fields)];

                if (!$nobreakline)
                  $$table->OpenRow();

                $header_options = array();

                if (is_array($this->mHeaderOptions[$area]))
                  $header_options = $this->mHeaderOptions[$area];

                if (is_array($this->mCellHeaderOptions[$area][key($fields)]))
                  $header_options = array_merge($this->mCellHeaderOptions[$area][key($fields)], $header_options);

                $$table->OpenHeader(current($fields), $header_options);
                
                //callback
                if ($this->mCallback[$area][$i])
                {
                  $arr = $this->mCallbackParams[$area][$i];
                  array_unshift($arr, $value);
                  $value = call_user_func_array($this->mCallback[$area][$i], $arr);
                }
  
                $$table->OpenCell($value, $cell_options);

                $i++;
              }
              while(next($fields));
          
              if ($count_records < $this->mRs[$area]->GetRowCount())
              {
                $cell_options = array("bgcolor" => "#FFFFFF");
                $$table->OpenRow();
                $$table->OpenCell("", $cell_options);
              }
              
              $count_records++;
              
              $this->mRs[$area]->Next();
            }
          }//if (is_array($fields))      
        }
     
        $this->AddObject($$table);

        if ($count_areas < sizeof($this->mAreas))
        {
          $cell_options = array("bgcolor" => "#FFFFFF");
          $this->OpenRow();
          $this->OpenCell("&nbsp;", $cell_options);
        }

        $count_areas++;       
      }
      while(next($this->mAreas));

      // Close Table
      if ($this->mTableOpened)
        $this->CloseTable();
      
    }     
    else
      $this->AddObject($this->mConn->GetError());
  }

  /**
  * Builds consultation output
  * @returns string
  */
  function GetHtml ()
  {

    if ( ($result = $this->HasPermissionTo("select", $this->mAuth)) !== true)
    {
      $table = new JTable();
      $table->OpenRow();
      $table->OpenCell($result);
      return $table->GetHtml();
    }

    foreach ($this->mAreas AS $key => $value)
    {
      if (strlen($value["permissao"]))
        $arr_function[] = $value["permissao"];
    }

    if (is_array($arr_function) && sizeof($arr_function))
    {
      $sql = "SELECT functionname
                FROM jaguar_auth
               WHERE functionname IN ('" . implode("', '", $arr_function) . "')
                 AND TRUE
                 AND canselect = '1' ";

      if (!$rs = $this->mConn->Select($sql))
        $this->AddObject($this->mConn->GetError());
      elseif($rs->GetRowCount() > 0)
      {
        while (!$rs->IsEof())
        {
          $arr_aux[] = $rs->GetField("functionname");
          $rs->Next();
        }

        $arr_function = array_diff($arr_function, $arr_aux);
        
        foreach ($this->mAreas AS $key => $value)
        {
          if (in_array($key, $arr_function))
            unset($this->mAreas[$key]);
        }
      }
    }
    
    $out = "";
    
    $this->SetWidth($this->mWidth);
    $this->SetStriped(false);
    $this->BuildConsultation();

    for ($i = 0; $i < $this->mIndex; $i++)
    {
      if (is_object($this->mObjects[$i]))
      {
        $this->mObjects[$i]->MakeId(++$this->mId);
        $out .= $this->mObjects[$i]->GetHtml();
        $this->mId = $this->mObjects[$i]->MakeId();//avoid duplicate ids when using nested objects
      }
      else
        $out .= $this->mTexts[$i];
    }

    reset($this->mAreas);
    do
    {
      if ($this->mRs[key($this->mAreas)])
        $this->mRs[key($this->mAreas)]->Close();
    }
    while(next($this->mAreas));
    
    return $out;
    
  }
}

/**
 * Build a popup to con_$pop.php
 * @param string $value   Data of the field
 * @param object $rthis   Main class
 * @param string $area    Area where the field is located
 * @param string $pop     Name of consultation form
 * @param array $fields   Associative array with name and value of fields
 * @param string $width   Width's popup
 * @param string $height  Height's popup
 * @returns string Link for the popup
*/
function CallbackPopup($value, $rthis, $area, $pop = "", $fields = "", $width = "", $height = "")
{
  if ($pop == "")
    $pop = substr($field, 3);
  foreach ($fields as $key => $field)
    $filter[] = $key."=".(str_value($rthis->mRs[$area]->GetField($field)) ? $rthis->mRs[$area]->GetField($field) : $field);
  return "<a onclick = \"javascript:pop_open('con_$pop.php?".implode("&", $filter)."', ".
             "'$width', '$height', false, 'yes');\">".$value."</a>";
}
