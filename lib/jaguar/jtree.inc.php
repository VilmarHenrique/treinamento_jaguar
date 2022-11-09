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

require_once(JAGUAR_PATH . "jobject.inc.php");

/**
* Class that builds HTML + JS tree menus
*
* @author  Atua Sistemas de Informação
* @since   2002-07-05
* @package Jaguar
*/
class JTree extends JObject
{
  /**
  * Stores the layer name 
  * @var string
  */
  var $mLayer;
  
  /**
  * Stores path to the tree's images 
  * @var string
  */
  var $mImages;

  /**
  * Stores the object name 
  * @var string
  */
  var $mMenuObj    = "objTreeMenu";

  /**
  * Stores the link wich the nodes will point to 
  * @var string
  */
  var $mLinkTarget;

  /**
  * Constructor 
  * @param string $name String containing the tree name 
  * @param string $images Path to the tree images
  * @param string $linkTarget Target to wich the nodes will poit to
  */
  function __construct($name = false, $images = false, $linkTarget = false)
  {
    global $conn;

    //Messages
    $this->SetDefaultMessages();

    $this->SetName($name);
    $this->SetImages($images);
    $this->SetLinkTarget($linkTarget);

    $path = URL."jtree/";
    $this->AddJSFile($path."sniffer.js");
    $this->AddJSFile($path."jtree.js");
  }

  /**
  * Sets layer and object's name
  * @param string $name 
  */
  function SetName($name = false)
  {
    $this->mLayer      = ($name)?"lay".$name:"layJtree";
    $this->mMenuObj    = ($name)?"obj".$name:"objJtree";
  }

  /**
  * Sets images path
  * @param string $images Path to tree images
  */
  function SetImages($images = false)
  {
    $this->mImages     = ($images) ? $images : URL."jtree/images";
  }

  /**
  * Sets layer and object's name
  * @param string $linkTarget The frame that will be the link target
  */
  function SetLinkTarget($linkTarget = false)
  {
    $this->mLinkTarget = ($linkTarget)?$linkTarget:"_self";
  }

  /**
  * Builds tree output 
  */
  function GetHtml()
  {
    $out .= "\n";

    $out .= "<div id=\"$this->mLayer\"></div>\n";

    $out .= "<script language=\"javascript\" type=\"text/javascript\">\n\t";
    $out .= sprintf('%s = new TreeMenu("%s", "%s", "%s", "%s");',
                    $this->mMenuObj,
                    $this->mLayer,
                    $this->mImages,
                    $this->mMenuObj,
                    $this->mLinkTarget);

    $out .= "\n";

    for ($i=0; $i<count($this->mObjects); $i++)
    {
      $out .= $this->mObjects[$i]->GetHtml($this->mMenuObj . ".n[$i]");
    }

    $out .= sprintf("%s.drawMenu();\n%s.resetBranches();\n</script>", 
                    $this->mMenuObj, 
                    $this->mMenuObj);

    return $out;
  }

}

/**
* Tree nodes creation class
*
* @author  Atua Sistemas de Informação
* @since   2002-07-05
* @package Jaguar
*/
class JTreeNode extends JObject
{
  /**
  * Stores the node's text
  * @var string
  */
  var $mText;

  /**
  * Stores the node's link
  * @var string
  */
  var $mLink;

  /**
  * Controls what kind of icon the node must have
  * @var boolean
  */
  var $mIcon;

  /**
  * Controls if the tree must be expanded when loaded
  * @var boolean
  */
  var $mExpanded;

  /**
  * Constructor
  * @param string  $text Node's text
  * @param string  $link Node's link
  * @param boolean $icon Node's icon
  * @param boolean $expanded Sets if the tree will be expanded when opened
  */  
  function __construct($text = false, $link = false,  $icon = false, $expanded = false)
  {
    $this->SetText($text);
    $this->SetLink($link);
    $this->SetIcon($icon);
    $this->SetExpanded($expanded);
  }

  /**
  * Sets node's text
  * @param string  $text
  */
  function SetText($text = false)
  {
    $this->mText     = ($text)?$text:"";
  }

  /**
  * Sets node's link
  * @param string  $text
  */
  function SetLink($link = false)
  {
    $this->mLink     = ($link)?$link:"#";
  }

  /**
  * Sets node's icon
  *
  * If the parameter is passed as text, its value is assumed as the node's icon
  * @param boolean  $icon
  */
  function SetIcon($icon = false)
  {
    if (is_bool($icon))
      $this->mIcon   = ($icon)?"item.gif":"folder.gif";
    else
      $this->mIcon   =  $icon;
  }

  /**
  * Sets if the tree will be open expanded
  * @param boolean $expanded
  */
  function SetExpanded($expanded = false)
  {
    $this->mExpanded = $expanded;
  }

  /**
  * Builds the node's output
  * @internal string $prefix
  */
  function GetHtml()
  {
    $args   = func_get_args();
    $prefix = $args[0];
    
    $out = $this->GetMainContainerHtml();
    $out .= sprintf("\t%s = new TreeNode('%s', %s, %s, %s);\n",
                    $prefix,
                    $this->mText,
                    !empty($this->mIcon) ? "'" . $this->mIcon . "'" : 'null',
                    !empty($this->mLink) ? "'" . $this->mLink . "'" : 'null',
                    $this->mExpanded ? 'true' : 'false');

    for ($i=0; $i<count($this->mObjects); $i++)
    {
      $out .= $this->mObjects[$i]->GetHtml($prefix . ".n[$i]");
    }

    return $out;
  }
}