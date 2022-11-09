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
* HierarchicalConsultations creation class
*
* @author  Atua Sistemas de Informação
* @since   2003-04-01
* @package Jaguar
* @subpackage Consultation
*/
Class JHierarchicalConsultation extends JBaseConsultation
{
  /**
  * Controls whether individual items must be shown in the report or not
  * @var boolean
  */
  var $mUseItems;

  /**
  * Stores the queries utilized by the class
  * @var array
  */
  var $mSql;

  /**
  * Stores the filters
  * @var array
  */
  var $mFilters;

  /**
  * Stores the totalizations
  * @var array
  */
  var $mSums;

  /**
  * Stores the report's items
  * @var array
  */
  var $mItems;

  /**
  * Stores the reports' groups
  * @var array
  */
  var $mGroups;

  /**
  * Stores the items identation
  * @var string
  */
  var $mIndent;

  /**
  * Stores the last group's code
  * @var int
  */
  var $mLastGroup;

  /**
  * Stores the father groups (groups that aren't children from another group)
  * @var array
  */
  var $mFathers;

  /**
  * Stores the current level
  * @var int
  */
  var $mLevel;

  /**
  * Stores the mSums' array index
  * @var int
  */
  var $mIdx;

  /**
  * Stores the initial group
  * @var int
  */
  var $mFatherGroup;

  /**
  * Stores the callback function's name for a column from the mSums array
  * @var array
  */
  var $mSumsCallback;

  /**
  * Stores the callback function's parameters for a column from the mSums array
  * @var array
  */
  var $mSumsCallbackParams;

  /**
  *  Stores the callback function's name for a column from the mItems array
  * @var array
  */
  var $mItemsCallback;

  /**
  *  Stores the callback function's parameters for a column from the mItems array
  * @var array
  */
  var $mItemsCallbackParams;
 
 
  /**
  * Construtor
  * @param object $conn A JDBConnection object
  * @param array $sql Associative array containing all the SQL that build the consultation: <br>
  * father, groups, get_father_group, add_father, get_children_groups. 
  * add_items, if_have_children, get_values
  */
  function __construct($conn, $sql)
  {
    $this->SetConnection($conn);
    $this->SetSql($sql);
    $this->SetUseItems(false);
    $this->SetDefaultMessages();
    $this->SetFatherGroup();
  }

  /**
  * Sets the initial group
  * @param int $initialGroup Initial's group code
  */
  function SetFatherGroup($initialGroup = false)
  {
    $this->mFatherGroup = $initialGroup;
  }

  /**
  * Sets the queries array
  * @param array $sql
  */
  function SetSql($sql)
  {
    if (is_array($sql))
      $this->mSql = $sql;  
  }
  
  /**
  * Sets if item lines might be shown or not
  * @param boolean $bool
  */
  function SetUseItems($bool)
  {
    $this->mUseItems = $bool;
  }
                  
  /**
  * Seta as mensagens padrão
  */
  function SetDefaultMessages()
  {
    $this->SetMessage("Father", "Plano de Contas Pai");
    $this->SetMessage("Total", "Total");
  }
 
  /**
  * Sets callback functions associated to a column in the sums array and its params
  * @param int    $col      Column's index in the mSums array
  * @param string $callback Callback function's name
  * @param array  $params   Callback function's paramaters
  */
  function SetSumsCallback ($col, $callback, $params = false)
  {
    $this->mSumsCallback[$col] = $callback;
    $this->mSumsCallbackParams[$col] = (is_array($params))?$params:array();
  }
 
  /**
  * Sets callback functions associated to a column in the sums array and its params
  * @param int    $col      Column's index in the mSums array
  * @param string $callback Callback function's name
  * @param array  $params   Callback function's paramaters
  */
  function SetItemsCallback ($col, $callback, $params = false)
  {
    $this->mItemsCallback[$col] = $callback;
    $this->mItemsCallbackParams[$col] = (is_array($params))?$params:array();
  }

  /**
  * Adds filters to the items query
  * @param string $field    Field's name
  * @param string $value    Filter's value
  * @param string $operator Filter's operatos
  * @param string $sql      SQL
  */
  function AddFilterField($field, $value, $operator, $sql = false)
  {
    if (!is_array($this->mFilters))
    {
      $this->mFilters[0]["field"]    = $field;
      $this->mFilters[0]["value"]    = $value;
      $this->mFilters[0]["operator"] = $operator;
      $this->mFilters[0]["sql"]      = $sql;
    }
    else
    {
      $index = sizeof($this->mFilters);
      $this->mFilters[$index]["field"]    = $field;
      $this->mFilters[$index]["value"]    = $value;
      $this->mFilters[$index]["operator"] = $operator;
      $this->mFilters[$index]["sql"]      = $sql;
    }
  }
  
  /**
  * Gets the father group of a given group
  * @param int $group A group code
  * @returns int
  */
  function GetFatherGroup($group)
  {
    do
    {
      //sql - getfathergroup
      $sql = $this->mSql["get_father_group"];
      $sql .= " = '".$group."' ";

      if ($rs = $this->mConn->Select($sql) )
        $father = $rs->GetField(0);
      else
        echo $this->mConn->GetTextualError();

      if (strlen($father) > 0)
        $group = $father;
    
    }while(strlen($father) > 0);

    return $group;
  }

  /**
  * Checks if a given group is used
  * @param int $group Group's code
  * @returns boolean
  */
  function IsUsed($group)
  {
    for ($i = 0; $i < sizeof($this->mGroups); $i++)
      if ($group == $this->mGroups[$i][0])
        return true;
    return false;
  }

  /**
  *  Checks if a given group is father
  * @param int $group
  * @returns boolean
  */
  function IsFather($group)
  {
    for ($i = 0; $i < sizeof($this->mFathers); $i++)
      if ($group == $this->mFathers[$i])
        return true;
    return false;
  }

  /**
  * Fill the items array
  * @param int $group Group's code
  */
  function AddItems($group)
  {
    //sql - additems
    $sql = $this->mSql["add_items"];
    $sql .= " = '".$group."' "; 
            
    //filtro
    $i = 0;
    reset($this->mFilters);
    do
    {
      if (strlen($this->mFilters[$i]["value"]) > 0)
      {
        if (strlen($this->mFilters[$i]["sql"]) > 0)
        {
          if ($this->mFilters[$i]["sql"] == "add_items")
            $sql .= "AND ".$this->mFilters[$i]["field"]." ".$this->mFilters[$i]["operator"].
                    " '".$this->mFilters[$i]["value"]."' ";
        }
        else
        {
          $sql .= "AND ".$this->mFilters[$i]["field"]." ".$this->mFilters[$i]["operator"].
                  " '".$this->mFilters[$i]["value"]."' ";
        }
      }
      
      $i++;
    }
    while(next($this->mFilters));
 
    if ($rs = $this->mConn->Select($sql))
    {
      unset($items);
      while(!$rs->IsEof())
      {
        $items[] = array('1', $rs->GetField(0), $rs->GetField(1), false, $group);
        $rs->Next();
      }
      
      if ($this->mUseItems)
        $this->mItems = array_merge($this->mItems, $items);

      $this->mIdx = sizeof($this->mSums);
      $this->mSums[$this->mIdx][0] = $group;
      $this->mSums[$this->mIdx][1] = 0;

      for($i = 0; $i < sizeof($items); $i++)
        $this->mSums[$this->mIdx][1] += $items[$i][2];

      $this->mSums[$this->mIdx][2] = $this->GetFatherGroup($group);
      
      // Debug Line
      //echo $this->arr2table($this->mSums);

    }//Selecao Itens
    else
      echo $this->mConn->GetTextualError();
  }

  /**
  * Checks if a group has children groups
  * @param int $group Group's code
  * @return boolean
  */
  function IfHaveChildren($group)
  {
    $sql = $this->mSql["if_have_children"];
    $sql .= " = '".$group."'";

    if ($rs = $this->mConn->Select($sql))
    {
      while (!$rs->IsEof())
      {
        $sql = $this->mSql["get_values"];
        $sql .= " = '".$rs->GetField(0)."'";
        
        if ($rs_tmp = $this->mConn->Select($sql))
        {
          if ($rs_tmp->GetRowCount() > 0)
          {
            $show = true;
            break;
          }
        }    
        
        $this->IfHaveChildren($rs->GetField(0));
        $rs->Next();
      }
      
      $rs->Close();
    }
    
    if ($show)
      return true;
    else
      return false;

  }
  
  /**
  * Checks if a group has items
  * @param int $group Group's code
  * @return boolean
  */
  function IfHaveValues($group)
  {
    $show = false;

    $sql = $this->mSql["get_values"];
    $sql .= " = '".$group."'";
    
    if ($rs = $this->mConn->Select($sql))
    {
      if ($rs->GetRowCount() > 0)
        $show = true;  
    
      $rs->Close();
    }
    
    return $show;
  }

  /**
  * Fill the mItems array with the groups that ar children from a given group
  * @param int $group Group's code
  */
  function GetChildrenGroups($group)
  {
    $this->mLevel++;
  
    //sql - getchildrengroups
    $sql = $this->mSql["get_children_groups"];
    $sql .= " = '".$group."'";
    
    if ($rs = $this->mConn->Select($sql))
    {
      while (!$rs->IsEof())
      {
        unset($tmp);

        $tmp[] = array('0', $rs->GetField(1), $rs->GetField(0), $this->mLevel);

        $this->mItems = array_merge($this->mItems, $tmp);

        if ($this->IsUsed($rs->GetField(0)) || $this->IfHaveChildren($rs->GetField(0)) || $this->IfHaveValues($rs->GetField(0)))
           $this->AddItems($rs->GetField(0));

        $this->GetChildrenGroups($rs->GetField(0));
      
        $rs->Next();
      }
    }
    else
      echo $this->mConn->GetTextualError();

    $this->mLevel--;
  }

  /**
  * Debug function - show the given array in a JTable object
  * @param array @array
  */
  function arr2table($array)
  {
    $table = new JTable();
    $table->SetBorder(1);
    
    if (sizeof($array) > 0)
    {
      //if (sizeof($array) > 1)
      //{
        for ($i = 0; $i < sizeof($array); $i++)
        {
          $table->OpenRow();
          for ($j = 0; $j < sizeof($array[$i]); $j++)
            $table->OpenCell( ((strlen((string)$array[$i][$j] > 0))?$array[$i][$j]:"-") );
        }
      //}
      /*      
      else
      {
        $table->OpenRow();
        for ($i = 0; $i < sizeof($array); $i++)
          $table->OpenCell( ((strlen($array[$i] > 0))?$array[$i]:"-") );
      }
      */      
    }
    
    return $table->GetHtml();
    
  }

  /**
  * Inserts a sumarization line in the mSums array
  * @param boolean $parentGroup Parent group's code
  */
  function InsertSumarizationLine($parentGroup = false)
  {
    if ($this->mUseItems || $parentGroup)
    {
      $this->OpenRow();
      
      $header_options = array("align" => "left");
      if ($parentGroup && !$this->mUseItems)
          $header_options["colspan"] = 2;
      
      $this->OpenHeader("&nbsp;" . (($parentGroup)?"":$this->mIndent) .
                                "<b>".$this->mMessages["Total"]."</b>" , $header_options);
      $openHeader = true;
    }
    
    $header_options = array("align" => "right");
    
    for ($i = 0; $i < sizeof($this->mSums); $i++)
    {
      $value = $this->mSums[$i][1];

      for ($j = 0; $j < sizeof($this->mSums[$i]); $j++)
      {      
        //callback 
        if ($this->mSumsCallback[$j])
        {
          $arr = $this->mSumsCallbackParams[$j];
          array_unshift($arr, $value);
          $value = call_user_func_array($this->mSumsCallback[$j], $arr);
        }
      }

      if ($parentGroup)
      {
        $group = $this->GetFatherGroup($this->mLastGroup);
       
        if (($this->mSums[$i][0] == $group) && (sizeof($this->mSums[$i]) == 2))
        {
          $this->OpenHeader("<b>".$value."</b>", $header_options);
          if ($openHeader)
            $openHeader = false;
        }
      }
      else
      {
        if (($this->mSums[$i][0] == $this->mLastGroup) && (sizeof($this->mSums[$i]) == 3))
        {
          $this->OpenHeader("<b>".$value."</b>", $header_options);
          if ($openHeader)
            $openHeader = false;
        }
      }
    }

    if ($openHeader)
      $this->OpenHeader("0");

    if ($this->mUseItems)
    {
      $this->OpenRow();
      $this->OpenCell("&nbsp;", array("colspan" => "3"));
    }
  
  }

  /**
  * Internal function - Builds the main table
  */
  function BuildTable()
  {
    $table = new JTable();
    $table->SetLineStyles("rowodd", "rowodd", "rowodd", "rowodd");

    for ($i = 0; $i < sizeof($table->mItems); $i++)
    {
      if ($table->mItems[$i][0]) //Linhas de resultado
      {
        $table->OpenRow();
        $table->OpenCell("&nbsp;" . $table->mIndent .$table->mItems[$i][1]);
        
        $value = $table->mItems[$i][2];

        //callback
        for ($j = 0; $j < sizeof($table->mItems[$i]); $j++)
        {
          //callback 
          if ($table->mItemsCallback[$j])
          {
            $arr = $table->mItemsCallbackParams[$j];
            array_unshift($arr, $value);
            $value = call_user_func_array($table->mItemsCallback[$j], $arr);
          }
        }

        $table->OpenCell($value, array("align" => "right"));
      }
      else//Linhas de grupo
      {
        if ($table->IsUsed($table->mLastGroup))
          $table->InsertSumarizationLine();
        
        if ($table->IsFather($table->mItems[$i][2]) && $i)
          $table->InsertSumarizationLine(true);
       
        unset($table->mIndent);
        for ($j = 0; $j < $table->mItems[$i][3]; $j++)
          $table->mIndent .= "&nbsp;&nbsp;&nbsp;&nbsp;";

        if ($table->IsUsed($table->mItems[$i][2]) || $table->IfHaveChildren($table->mItems[$i][2]) || 
            $table->IfHaveValues($table->mItems[$i][2]))
        {
          $table->OpenRow();
          $header_options = array("colspan" => 2, "align" => "left");
          $table->OpenHeader("&nbsp;" . $table->mIndent .$table->mItems[$i][1], $header_options);

          if (!$table->IsUsed($table->mItems[$i][2]) && !$table->mUseItems)
            $table->OpenHeader("&nbsp;");
        }
        
        $table->mLastGroup = $table->mItems[$i][2];

      }// else - linhas de grupo

      $last_type = $table->mItems[$i][0];
      
    } // Percorre o array de itens

    if ($table->IfHaveValues($table->mLastGroup) || $table->IfHaveChildren($table->mLastGroup))
      $table->InsertSumarizationLine();
    
    $table->InsertSumarizationLine(true);

    return $table->GetHtml();
  }

  /**
  * Builds the HTML output
  * @returns string
  */
  function GetHtml()
  {
    unset($out);

    $header_table = new JTable();
    $header_table->OpenRow();
    
    //sql - father 
    $sql = $this->mSql["father"];
    
    /*
    //plano de contas pai
    if ($rs = $this->mConn->Select($sql))
    {
      $header_options = array("colspan" => "2", "align" => "center");
      $header_table->OpenHeader($this->mMessages["Father"].": <b>" . $rs->GetField(0)."</b>", $header_options);
    }  
    else
    {
      $header_table->OpenCell();
      $header_table->AddObject($this->mConn->GetError());
    }  
    $out .= $header_table->GetHtml();
    */
   
    //sql - groups
    $sql = $this->mSql["groups"];
             
    //filtro         
    $i = 0;
    reset($this->mFilters);
    do 
    {
      if (strlen($this->mFilters[$i]["value"]) > 0)
      {
        if (strlen($this->mFilters[$i]["sql"]) > 0)
          if ($this->mFilters[$i]["sql"] == "groups")
            $sql .= "AND ".$this->mFilters[$i]["field"]." ".$this->mFilters[$i]["operator"].
                    " '".$this->mFilters[$i]["value"]."' ";
        else
          $sql .= "AND ".$this->mFilters[$i]["field"]." ".$this->mFilters[$i]["operator"].
                  " '".$this->mFilters[$i]["value"]."' ";
      }
      
      $i++;
    }
    while(next($this->mFilters));

    //Obtencao de todos os planos de conta utilizados
    if ($rs = $this->mConn->Select($sql))
    {
      $this->mGroups = $rs->GetArray();

      if ($this->mFatherGroup)
        $this->mFathers[] = $this->mFatherGroup;
      else
      {
        while(!$rs->IsEof())
        {
          //Obtem os planos de contas pai
          $father = $this->GetFatherGroup($rs->GetField(0));
        
          $exists = false;
          for ($i = 0; $i < sizeof($this->mFathers); $i++)
            if ($this->mFathers[$i] == $father)
              $exists = true;

          if (!$exists)
            $this->mFathers[] = $father;

          $rs->Next();
        }
      }
    }//Selecao de grupos
    else
      $out .= $this->mConn->GetTextualError();

    //Insere os planos de contas pai no array de items
    for ($i = 0; $i < sizeof($this->mFathers); $i++)
    {
      unset($tmp); 
      
      //sql - fathers
      $sql = $this->mSql["add_father"];
      $sql .= " = '".$this->mFathers[$i]."'";
      
      if ($rs = $this->mConn->Select($sql))
      {
        $tmp[] = array('0', $rs->GetField(0), $this->mFathers[$i], '0');
       
        $this->mItems = array_merge($this->mItems, $tmp);

        // Verifica se ha itens no grupo pai      
        if ($this->IsUsed($this->mFathers[$i]))
          $this->AddItems($this->mFathers[$i]);  

        $this->GetChildrenGroups($this->mFathers[$i]);

        $this->mIdx = sizeof($this->mSums);
        $this->mSums[$this->mIdx][0] = $this->mFathers[$i];
        $this->mSums[$this->mIdx][1] = 0;
        
        for ($j = 0; $j < sizeof($this->mSums) - 1; $j++)
        {
          if ($this->mSums[$j][2] == $this->mFathers[$i])
          {
            $this->mSums[$this->mIdx][1] += $this->mSums[$j][1];
          }
        }
      }
      else
        $out .= $this->mConn->GetTextualError();
    }

    /*
    $table = new JTable();
    $table->OpenRow();
    $table->OpenCell($this->arr2table($this->mItems));
    $table->OpenCell($this->arr2table($this->mSums)); 
    $table->OpenCell($this->arr2table($this->mGroups));
    $table->OpenCell($this->arr2table($this->mFathers));
    echo $table->GetHtml();
    */

    $out .= $this->BuildTable();

    //Debug line
    //echo $this->arr2table($this->mItems);
    
    return $out;
  
  }// function GetHtml()
}