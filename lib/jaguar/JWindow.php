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
* Base class for many objects
*
* @author  Atua Sistemas de Informação
* @since   2007-03-21
* @package Jaguar
*/

require_once(JAGUAR_PATH . "jobject.inc.php");

class JWindow extends JPrimitiveObject
{
  /**
  * Stores object's type
  * @var string
  */
  var $mType = "Window";

  /**
  * Stores object's title 
  * @var string
  */
  var $mTitle;

  /**
  * Stores the object´s data to be showed 
  * @var string
  */
  var $mData = "";

  /**
  * Stores the object´s image display  position
  * @var string (left or right)
  */
  var $mStatusInfo = ".:";

  /**
  * Constructor
  * @param string $name  Field's name Form's name
  */
  function __construct($title = false, $data = false, $img = false)
  {
    if ($title) $this->SetTitle($title);
    if ($data) $this->SetData($data);

    $path = URL."js/window/";
    $this->AddCSSFile($path."windowStyle.css"); 
    $this->AddJSFile($path."drag.php");
  }

  /**
  * Sets object's title 
  * @param string $title
  */
  function SetTitle($title)
  {
    $this->mTitle = $title;
  }

  /**
  * Sets object's data 
  * @param string $data
  */
  function SetData($data)
  {
    if (is_object($data))
      $this->AddObject($data);
    else
      $this->mData = $data;
  }

  /**
  * Sets object's status information
  * @param string $info
  */
  function SetStatusInfo($info)
  {
    $this->mStatusInfo = $info;
  }

  /**
  * Builds object's output
  * @returns string
  */
  function GetHtml()
  {
    $id = $this->MakeId();

    if (is_array($this->mObjects))
    {
      foreach($this->mObjects as $component)
      {
        if (is_object($component))
          $this->mData .= $component->GetHtml();
        else
          $this->mData .= $component;
      }
    }

    $width = strlen($this->mTitle)*7;
    if ($this->IsIE())
      $width += 125;
    else
      $width += 123;

    $out = "
    <div id=\"window\" style=\"width:".$width."px;visibility:hidden;\" >
      <div id=\"bar\" onmousedown=\"startDrag();\" onmouseup=\"stopDrag();\" >
        <h2>".$this->mTitle."</h2>
        <a id=\"toCloseInThisSession\" href=\"#\" title=\"Não Mostrar Novamente\" onmouseup=\"toCloseInThisSession();\">-</a>
        <a id=\"toClose\" href=\"#\" title=\"Fechar\" onmouseup=\"toClose();\">x</a>
        <a id=\"hide\" href=\"#\" title=\"Esconder\" onmouseup=\"hide();\">^</a>
        <a id=\"minimax\" href=\"#\" title=\"Minimizar\" onmouseup=\"minimax();\">-</a>
      </div>
      <div id=\"content\">
        ".$this->mData."
      </div>
     <!-- <div id=\"statusbar\">".$this->mStatusInfo."</div> -->
    </div>
    <script type=\"text/javascript\">toOpen();</script>
  ";

    return $out;
  }

}