<?php
/*
Jaguar - A PHP framework for IT systems development
Copyright (C) 2007  Atua Sistemas de Informação Ltda.

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
* @since   2007-02-15
* @package Jaguar
*/

require_once(JAGUAR_PATH . "JMenu.php");

class JMenuNode extends JMenu
{

  /**
  * Stores object's type
  * @var string
  */
  var $mType = "MenuNode";

  /**
  * Stores object's label
  * @var string
  */
  var $mLabel;

  /**
  * Stores object's label
  * @var string
  */
  var $mUrl;

  /**
  * Stores object's label
  * @var string
  */
  var $mTipTitle;

  /**
  * Stores objects attached to this container
  * @var array
  */
  var $mObjects = array();

  /**
  * Constructor
  * @param string $label
  * @param string $url
  * @param string $tip
  */
  function __construct($label, $url = "#", $tip = false, $target = false)
  {
    $this->mLabel = $label;
    $this->mUrl = $url ? $url : "#";
    $this->mTipTitle = ($tip ? $tip : $label);
    $this->mTarget = $target;
  }

  function GetHtml($nodeLevel = 0)
  {
    $nodeLevel++;
 
    $space = "\n".(str_pad('', $nodeLevel));

    $href = ($this->mUrl == "#") ? "" : "href=\"".$this->mUrl."\" onClick=\"javascript:Menu.hideAll();\" ";
    $target = ($this->mTarget && $href) ? " target=\"".$this->mTarget."\" " : "";
    $out .= $space."<li><a ".$target." title=\"".$this->mTipTitle."\" ".$href." ".$this->mExtra.">".$this->mLabel."</a>";

    $nested = '';
    foreach($this->mObjects as $node)
      $nested .= $node->GetHtml($nodeLevel);

    if (!empty($this->mObjects))
      $out .= "\n<ul>".$nested."\n </ul>";

    $out .= "</li>";
    return $out;
  }
}