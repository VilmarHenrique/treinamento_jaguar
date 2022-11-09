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

/**
* JS menu generation class
*
* @author  Atua Sistemas de Informação
* @since   2003-02-17
* @package Jaguar
*/

require_once(JAGUAR_PATH . "JPrimitiveObject.php");
require_once(JAGUAR_PATH . "JMenuNode.php");

class JMenu extends JPrimitiveObject
{
  /**
  * Stores object's type
  * @var string
  */
  var $mType = "Menu";

  /**
  * Stores SQL statements
  * @var string
  */
  var $mSqls;

  /**
  * Stores object's name
  * @var string
  */
  var $mName;

  /**
  * Stores object's connection handler
  * @var string
  */
  var $mConn;


  /**
  * Stores if the object will use javascript 
  * @var string
  */
  var $mUseEasing = true;

  /**
  * Stores the URL target on <a href="" target="">
  * @var string
  */
  var $mTarget;

  /**
  * Stores extra parameters
  * @var string
  */
  var $mExtra = "";

  /**
  * Stores whether the menu will be placed centered by javascript
  * @var string
  */
  var $mCentered;

  /**
  * Constructor
  * @param object $conn A JDBConnecion object
  */
  function __construct($name = false, $useEasing = true, $useCSS = true)
  {
    global $conn;

    $this->SetName($name);
    if (is_object($conn)) $this->SetConnection($conn);

    $this->mUseEasing = $useEasing;
  }

  /**
  * Stores the object's name 
  * @param string $name The object's name
  */
  function SetName($name = false)
  {
    $this->mName = $name ? $name : "Menu";
  }

  /**
  * Returns the object's name 
  * @returns string 
  */
  function &GetName()
  {
    return $this->mName;
  }

  /**
  * Stores the JDBConnection object
  * @param object &$conn The address of a JDBConnecion object
  */
  function SetConnection(&$conn)
  {
    $this->mConn = &$conn;
  }

  /**
  * Stores the SQL statements to build the menu dynamically
  * @param string $index The index in the associative mSqls array. { parent_folders | subfolders_count | functions_count | folders_and_functions}
  */
  function SetSql($index, $sql)
  {
    $this->mSqls[$index] = &$sql;
  }

  /**
  * Verifies if all the SQL to build the menu dynamically are set and builds it
  */ 
  function BuildMenuFromSql()
  {

    if (! ($this->mSqls["parent_folders"] && $this->mSqls["folders_and_functions"]) )
      exit("Erro: Nem todos os SQL necessarios foram informados");
    elseif (!is_object($this->mConn))
      exit("Erro: Por favor utilize SetConnection para instanciar uma conexão.");

    $this->BuildParentFolders();
  }

  /**
  * If the menu is being mounted dynamically, builds the menu's first line
  */
  function BuildParentFolders()
  {
    if ( ($rs = $this->mConn->Select($this->mSqls["parent_folders"])) )
    {
      $i = 0;
      while (!$rs->IsEof())
      {
        $node = "node_".$i++;
        $$node = new JMenuNode($rs->GetField(1));
        $this->AddObject($$node);
        $this->GetChildren($rs->GetField(0), $$node);
        
        $rs->Next();
      }
      $rs->Close();
    }
    else
      exit("Erro no SQL - parent_folders"); //TODO sistema de erros
  }

  /**
  * Obtains the children items for an specified item
  * @param int $codw The parent items code
  * @param JMenuNode &$node The parent node object
  */
  function GetChildren($code, &$node)
  {
    $trans = array("__CODE__" => $code);
    $sql = strtr($this->mSqls["folders_and_functions"], $trans);

    if ( ($rs = $this->mConn->Select($sql)) )
    {
      $i = 0;
      while (!$rs->IsEof())
      {
        $child = "child_".$i++;
        $target = ($rs->GetField(6) ? $rs->GetField(6) : $this->mTarget);
        $$child = new JMenuNode($rs->GetField(1), $rs->GetField(4), $rs->GetField(5), $target);

        $node->AddObject($$child);

        //If it is a folder
        if ($rs->GetField(3))
          $this->GetChildren($rs->GetField(0), $$child);
      
        $rs->Next();
      }
      $rs->Close();
    }
    else
      exit("Erro no SQL - folders_and_functions"); //TODO sistema de erros
  }

  /**
  * Sets the target of the menu content 
  * @param string $target The target URL 
  */
  function SetContentTarget($target)
  {
    $this->mTarget = $target;
  } 

  /**
  * Sets extra parameters
  * @param string $extra
  */
  function SetExtra($extra)
  {
    $this->mExtra = $extra;
  } 


  /**
  * Adds an object to the objects' array and increases the main index
  * @param string $what Reference to the object that will be added
  */ 
  function AddObject(&$what)
  {
    //TODO add to the error system
    if (!is_a($what, "JMenuNode"))
      exit("Error: o Objeto adicionado Não é suportado pelo menu na versão corrente.");

    parent::AddObject($what);
  }

  /**
  * Set a default configuration for the menu to be placed centered
  * @param boolean $bool
  */ 
  function SetCentered($bool = true)
  {
    $this->mCentered = (boolean) $bool;

    //TODO add to method AddJSOnLoad which will keep all window.onload events
    $this->AddJS("
      window.onload = function()
      {
        var ul = document.getElementById('".$this->Getname()."Root');
        var div = document.getElementById('div".$this->Getname()."');
        var nodeWidth = 0;
        var nodeNumber = 0;
        
        for (i=0; i<ul.childNodes.length; i++)
        {
          if (ul.childNodes[i].nodeName.toUpperCase() == 'LI')
          {
            if (ul.childNodes[i].clientWidth) nodeWidth += parseInt(ul.childNodes[i].clientWidth) + 1;
            nodeNumber++;
          }
        }
        
        if (!nodeWidth) nodeWidth = nodeNumber * 55;

        if (nodeWidth > 0)
        {
          div.style.left = '50%';
          div.style.width = (nodeWidth + 1).toString() + 'px';
          div.style.marginLeft = Math.round((nodeWidth + 1) / -2).toString() + 'px';
        }

        div.style.visibility = 'visible';
      }
    ");

  }

  /**
  * Builds the menu's output
  * @returns string
  */
  function GetHtml()
  {
    $out = "\n<ul class=\"menulist\" id=\"".$this->Getname()."Root\" ".$this->mExtra.">\n";

    foreach($this->mObjects as $node)
      $out .= " ".$node->GetHtml()."\n";

    $out .= "</ul>\n\n";

    if ($this->mCentered)
      $out = "<div id='div".$this->Getname()."' style='position:relative;visibility:hidden;text-align:left;'>".$out."</div>";

    return $out;
  }

}