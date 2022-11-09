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
* Sub-consultations creation class
*
* @author  Atua Sistemas de Informação
* @author  Pedro Tiaraju de Medeiros
* @since   2003-07-24
* @package Jaguar
*/
Class JSubConsultation extends JBaseConsultation
{
  /**
  * Stores the consultation's title
  * @var string
  */
  var $mConsultationTitle;

  /**
  * Stores the header table (JTable) object
  * @var object
  */
  var $mHeaderTable;

  /**
  * Stores the consultation's areas
  * @var array
  */
  var $mAreas;

  /**
  * Storesthe callback function's name
  * @var array
  */
  var $mCallback;

  /**
  * Stores the callback function's parameters
  * @var array
  */
  var $mCallbackParams;

  /**
  * Stores the callback function's name for the totalizer fields
  * @var array
  */
  var $mTotallingCallback;

  /**
  * Stores the callback function's parameters for the totalizer fields
  * @var array
  */
  var $mTotallingCallbackParams;

  /**
  * Stores the areas that will be separated by blank rows
  * @var array
  */
  var $mSeparatorArea;

  /**
  * Controls the totalling usage
  * @var boolean
  */
  var $mUseTotalling = false;

  /**
  * Stores the fields that must be totalized
  * @var array
  */
  var $mTotalling;

  /**
  * Stores the totalizations' values
  * @var array
  */
  var $mTotalizers; 
  
  /**
  * Stores the totalizations' labels porperties
  * @var array
  */
  var $mTotallingProperties;

  /**
  * Controls the use of final totalization
  * @var boolean
  */
  var $mUseFinalTotalling = false;
  
  /**
  * Stores the final totalling of each area
  * @var array
  */
  var $mFinalTotalling;
  
  /**
  * Stores the final totalling value of each area
  * @var array
  */
  var $mFinalTotalizers;
  
  /**
  * Stores the final totalling label properties
  * @var array
  */
  var $mFinalTotallingProperties;
  

  /**
  * Constructor
  * @param object $conn  A JDBConnection object
  * @param string $title The consultation's title
  */
  function __construct($conn, $title = false)
  {
    $this->SetConn($conn);
    $this->SetConsultationTitle($title);
    $this->SetDefaultMessages();
  }
  
  /**
  * Sets the consultations Title
  * @param string $title
  */
  function SetConsultationTitle($title)
  {
    $this->mConsultationTitle = $title;
  }

  /**
  * Sets the default messages for this consultation
  */
  function SetDefaultMessages()
  {
    parent::SetDefaultMessages();
    $this->SetMessage("PermissionDenied", "Permissão negada para esta operação!");
    $this->SetMessage("NoRecords", "<center>'0' registros encontrados</center>");
  }

  /**
  * Sets callback functions associated to a column in a specific area and its params
  * @param string  $area     Aea's name
  * @param int     $col      Column's index in its area
  * @param string  $callback Callback function's name
  * @param array   $params   Callback function's parameters
  */
  function SetCallback($area, $col, $callback, $params = false)
  {
    $this->mCallback[$area][$col] = $callback;
    $this->mCallbackParams[$area][$col] = (is_array($params))?$params:array();
  }

  /**
  * Sets callback functions associated to a column and its params
  * @param int     $col      Totalling column index
  * @param string  $callback Callback function's name
  * @param array   $params   Callback function's parameters
  */
  function SetTotallingCallback($col, $callback, $params = false)
  {
    $this->mTotallingCallback[$col] = $callback;
    $this->mTotallingCallbackParams[$col] = (is_array($params))?$params:array();
  }
                             
  /**
  * Controls the totalizations usage
  * 
  * <pre>
  * Eg.: $totalization = array("area1" => array("cont1"),
  *                            "area2" => array("cont2", "time"));
  * </pre>
  * 
  * Where area1 and area2 are the areas' name and cont1, cont2 and time are the names of the fields that will be totallized
  * 
  * @param array $arr 
  */
  function SetTotalling($arr)
  {
    if (is_array($arr))
    {
      $this->mUseTotalling = true;
      $this->mTotalling    = $arr;
    }
  }
  
  /**
  * Sets the totalizations labels and its properties
  *
  * Eg.:
  * <pre>
  * $arr = array("cont1" => array("text" => "Number of Calls"),
  *              "time"  => array("text" => "Total Time:",
  *                               "unit" => "hour(s)", 
  *                               "unit_aling" => "right"));
  * </pre>
  * 
  * Where cont1 and time are field names. For each we can associate an
  d
  * array containig the following options: <br>
  * text: The label <br>
  * unit: The totalization unit <br>
  * text_align: The position of the unit relative to the value <br>
  *
  * @param array $arr
  */
  function SetTotallingProperties($arr)
  {
    $this->mTotallingProperties = (is_array($arr))?$arr:array();
  }

  /**
  * Sets the final totalling usage
  * @param array $arr An array containing the name of the fields that
  * will be totalized
  */
  function SetFinalTotalling($arr)
  {
    if (is_array($arr))
    {
      $this->mUseFinalTotalling = true;
      $this->mFinalTotalling    = $arr;
    }
  }
  
  /**
  * Sets the final totalizations labels and its properties
  * @param array $arr
  * @see   function SetTotallingProperties
  */
  function SetFinalTotallingProperties($arr)
  {
    $this->mFinalTotallingProperties = (is_array($arr))?$arr:array();
  }
                                    
  
  /**
  * Sets the areas that might be followed by blank rows
  *
  * Eg.: 
  * array = ("area1" => 2, "area2" => 1)
  *
  * @param array @arr Associative array containig the areas' name and
  * the number of lines that may follo them
  */
  function SetSeparatorArea($arr)
  {
    $this->mSeparatorArea = (is_array($arr))?$arr:array();        
  }
    
  /**
  * Adds areas to the reports
  * @param string  $area             Area's name
  * @param string  $title            Area's title
  * @param array   $sql              Area's SQL
  * @param array   $visibleFields    An associative array where the 
  * keys are the field's names in the query and the values are the
  * labels for each field in the area
  * @param string  $father           The area that's immediately over
  * in the areas tree
  * @param array   $comparisonFields An array containig the name of
  * the field in the query as key and the name of the equivalent field
  * in the father area as value
  * @param array   $options          An associative array containig 
  * the field name as key and another associative array as value. This
  * second array may have two keys: no_open_line and cell_options
  * @param boolean $vertical         Controls if the data will be show
  * in vertical or horizontal disposition
  */
  function AddArea($area, $title, $sql, $visibleFields, $father = false, $comparisonFields = false, $options = false, $vertical = false)
  {
    $this->mAreas[$area] = array("title"             => $title,
                                 "sql"               => $sql,
                                 "visible_fields"    => $visibleFields,
                                 "father"            => $father,
                                 "comparison_fields" => $comparisonFields,
                                 "options"           => $options, 
                                 "grid_format"       => $vertical);
  }
  
  /**
  * Internal Function - Buils the report header
  */
  function BuildReportHeader()
  {
    $this->OpenRow();
    $this->OpenCell("");
    $this->mHeaderTable = new JTable();
    $this->mHeaderTable->SetWidth("100%");
    $this->mHeaderTable->SetLineStyles("rowodd", "rowodd", "rowodd", "rowodd");

    //título
    $this->mHeaderTable->OpenRow();
    $this->mHeaderTable->OpenHeader("<h3>".$this->mConsultationTitle."</h3>", array("colspan" => "3"));
    //linha em branco
    $this->mHeaderTable->OpenRow();
    $this->mHeaderTable->OpenCell("", array("colspan" => "3"));

    //data de geração do relatório
    $this->mHeaderTable->OpenRow();
    $this->mHeaderTable->OpenHeader(date("d/m/Y H:i:s"), array("align" => "right"));

    $this->AddObject($this->mHeaderTable);
  }

  /**
  * Internal Function - Verifies if the given area has children areas
  * @param   string  $area The areas' name
  * @returns boolean
  */
  function HasChildren($area)
  {
    $father = false;
    
    for (($i = $area + 1); $i < sizeof($this->mAreas); $i++)
    {
      if ($area == $this->mAreas[$i]["father"])
        $father = true;
    }
    
    return $father;    
  }

  /**
  * Internal Function - Builds the area's query
  * @param string $father           The father area's identifier
  * @param array  $sql              The partitioned SQL
  * @param array  $comparisonFields Array containig the connection between areas
  * @returns string
  */
  function BuildAreaSql($father, $sql, $comparisonFields)
  {
    $arr = $comparisonFields;

    //se tem área pai
    if (strlen($father) > 0 && is_array($arr))
    {
      $operator = "WHERE";
      if (strrpos($sql["where"], " WHERE "))
        $operator = "AND";

      reset ($arr);
      do
      {
        $sql["where"] .= " ".$operator." ". key($arr)." = ".$this->mRs[$father]->GetField(current($arr));
      }
      while(next($arr));
    }
    
    //monta o sql
    $sql = $sql["fields"]." ".$sql["from"]." ".$sql["where"]." ".$sql["group_by"]." ".$sql["order_by"];

    return $sql;
  }
  
  /**
  * Internal Function - Builds the reports areas
  * @param string  $area         Areas's name
  * @param int     $indice       Index of this area on its father area
  * @param object  $father_table A JTable object
  */
  function BuildAreas($area = 0, $indice = false, $father_table = false)
  {
    $title             = $this->mAreas[$area]["title"];
    $father            = $this->mAreas[$area]["father"];
    $sql               = $this->mAreas[$area]["sql"];
    $comparison_fields = $this->mAreas[$area]["comparison_fields"];
    $grid_format       = $this->mAreas[$area]["grid_format"];
    $field_options     = $this->mAreas[$area]["options"];
    $visible_fields    = $this->mAreas[$area]["visible_fields"];

    //monta o sql
    $sql = $this->BuildAreaSql($father, $sql, $comparison_fields);

    if ($this->mRs[$area] = $this->mConn->Select($sql))
    {
      $cell_options = array("colspan" => sizeof($this->mAreas[$father]["visible_fields"]) * 2);
      
      //área principal
      if ($area == 0)
      {
        $table  = "table_".$area;
        $$table = new JTable();
        $$table->SetWidth("100%");
        $this->AddObject($$table);
        
        //titulo da área
        $$table->OpenRow();
        $$table->OpenHeader("<b>".$title."</b>", $cell_options);
      }
      else //áreas filhas
      {
        $table  = "table_".$area."_".$indice;
        $$table = new JTable(array("class" => "noborder"));
        $$table->SetWidth("100%");

        $father_table->OpenRow();
        $father_table->OpenCell("", $cell_options);
        $father_table->AddObject($$table);
      }
      
      $i = 0;
      
      if ($this->mRs[$area]->GetRowCount() > 0)
      {
        //monta o cabeçalho das áreas com formato de grid
        if ($grid_format && is_array($visible_fields))
        {
          $$table->OpenRow();
          $cell_options = array("colspan" => sizeof($this->mAreas[$area]["visible_fields"]) * 2,
                                "align"   => "left");
          $$table->OpenHeader("<b>".$title."</b>", $cell_options);
          $$table->OpenRow();
          
          reset($visible_fields);
          do
          {
            $$table->OpenHeader(current($visible_fields));        
          }
          while(next($visible_fields));
        }
        
        //percorre o record set
        while (!$this->mRs[$area]->IsEof())
        {
          //título da área
          if ($area != 0 && !$grid_format)
          {
            $cell_options = array("colspan" => sizeof($this->mAreas[$area]["visible_fields"]) * 2,
                                  "align"   => "left");
            $$table->OpenRow();
            $$table->OpenHeader("<b>".$title."</b>", $cell_options);
          }
          
          $k = 0;

          //totalizações
          if (is_array($this->mTotalling[$area]))
          {
            $arr = $this->mTotalling[$area];
            for ($j = 0; $j < sizeof($arr); $j++)
            {
              unset($value);
              $value = $this->mRs[$area]->GetField($arr[$j]);

              //callback
              if ($this->mTotallingCallback[$arr[$j]])
              {
                $params = $this->mTotallingCallbackParams[$arr[$j]];
                array_unshift($params, $value);
                $value = call_user_func_array($this->mTotallingCallback[$arr[$j]], $params);
              }
              
              $this->mTotalizers[$area][$arr[$j]] += $value;
              $this->mFinalTotalizers[$arr[$j]]   += $value;
            }
          }
          
          //mostra os campos visíveis
          if (is_array($visible_fields))
          {
            reset ($visible_fields);
            do
            {
              unset($value);
              $value = $this->mRs[$area]->GetField(key($visible_fields));

              //callback
              if ($this->mCallback[$area][$k])
              {
                $params = $this->mCallbackParams[$area][$k];
                array_unshift($params, $value);
                $value = call_user_func_array($this->mCallback[$area][$k], $params);
              }        
        
              //formato de grid
              if ($grid_format)
              {
                if ($k == 0)
                {
                  $$table->OpenRow();
                  $$table->OpenCell($value);
                }
                else
                  $$table->OpenCell($value);
              }
              else //formato normal
              {
                if ($field_options[key($visible_fields)]["no_open_line"])
                {
                  $$table->OpenHeader(current($visible_fields));
                  $$table->OpenCell($value, $field_options[key($visible_fields)]["cell_options"]);
                }
                else
                {
                  $$table->OpenRow();
                  $$table->OpenHeader(current($visible_fields));
                  $$table->OpenCell($value, $field_options[key($visible_fields)]["cell_options"]);
                }
              }
              
              $k++;
            }
            while(next($visible_fields));
          }

          //linha em branco
          if ($area == 0)
          {
            $$table->OpenRow();
            $$table->OpenCell("&nbsp;", $cell_options);
          }
          
          //verifica se a área tem filhas
          if ($this->HasChildren($area))
            $this->BuildAreas($area + 1, $i, $$table);

          $i++;

          $this->mRs[$area]->Next();
          
          //linha em branco 
          if ($this->mSeparatorArea[$area] && !$this->mRs[$area]->IsEof())
          {
            $rows = $this->mSeparatorArea[$area];
            for ($i = 0; $i < $rows; $i++)
            {
              $$table->OpenRow();
              $$table->OpenCell("&nbsp;", $cell_options);
            }
          }
        
        }//while (!$this->mRs[$area]->IsEof())

        //mostra as totalizações
        if (is_array($this->mTotalling[$area]))
        {
          $arr = $this->mTotalling[$area];
          for ($j = 0; $j < sizeof($arr); $j++)
          {
            $father_table->OpenRow();
            $str = $this->mTotallingProperties[$arr[$j]]["text"].": ";
            //alinhamento da unidade
            switch ($this->mTotallingProperties[$arr[$j]]["unit_align"])
            {
              case "right":
              default:
                $str .= $this->mTotalizers[$area][$arr[$j]]." ".$this->mTotallingProperties[$arr[$j]]["unit"];
              break;

              case "left":
                $str .= $this->mTotallingProperties[$arr[$j]]["unit"]." ".$this->mTotalizers[$area][$arr[$j]];
              break;
            }
            
            $father_table->OpenHeader($str, $cell_options);
            $this->mTotalizers[$area][$arr[$j]] = 0;
          }
        }

        //mostra as totalizações finais
        if ($area == 0 && $this->mUseFinalTotalling)
        {
          $arr = $this->mFinalTotalling;
          for ($j = 0; $j < sizeof($arr); $j++)
          {
            $$table->OpenRow();
            $str = $this->mFinalTotallingProperties[$arr[$j]]["text"].": ";
            //alinhamento da unidade
            switch ($this->mFinalTotallingProperties[$arr[$j]]["unit_align"])
            {
              case "right":
              default:
                $str .= $this->mFinalTotalizers[$arr[$j]]." ".$this->mFinalTotallingProperties[$arr[$j]]["unit"];
              break;

              case "left":
                $str .= $this->mFinalTotallingProperties[$arr[$j]]["unit"]." ".$this->mFinalTotalizers[$arr[$j]];
              break;
            }

            $$table->OpenHeader("<b>".$str."</b>", $cell_options);
          }
        }
      
      }//if ($this->mRs[$area]->GetRowCount() > 0)
      else //se não exitem registros
      {
        //titulo da área
        $$table->OpenRow();
        $cell_options = array("colspan" => sizeof($this->mAreas[$father]["visible_fields"]) * 2,
                              "align"   => "left");
        $$table->OpenHeader("<b>".$title."</b>", $cell_options);
                    
        $$table->OpenRow();
        $$table->OpenCell($this->mMessages["NoRecords"]);
      }
      
      //fecha a tabela da área
      $$table->CloseTable();

    }//if ($this->mRs[$area] = $this->mConn->Select($sql))
    else
      $this->mError = true;
  }

  /**
  * Internal Function - Builds the report
  */
  function BuildReport()
  {
    //seta a largura do relatório
    $this->SetWidth($this->mWidth);

    //define o estilo das linhas do relatório
    $this->SetLineStyles("rowodd", "rowodd", "rowodd", "rowodd");
    
    //monta o cabeçalho do relatório
    $this->BuildReportHeader();

    //monta as áreas do relatório
    $this->OpenRow();
    $this->OpenCell();
    if (is_array($this->mAreas))
      $this->BuildAreas();
    
    //se ocorreu erro na montagem das áreas
    if ($this->mError)
      $this->AddObject($this->mConn->GetError());

  }
  
  /**
  * Builds report output
  * @returns string
  */
  function GetHtml ()
  {
    unset($out);

    $build_report = true;
    //verifica as permissões
    if ( ($result = $this->HasPermissionTo("select", $this->mAuth)) !== true)
    {
      $build_report = false;
      $table->SetAsMainContainer(true); //TODO to validate
      $table->OpenRow();
      $table->OpenCell($result);
    }

    if ($build_report) 
      $this->BuildReport();   
    
    //fecha a tabela
    $this->CloseTable();
    
    //percorre os objetos do relatório
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