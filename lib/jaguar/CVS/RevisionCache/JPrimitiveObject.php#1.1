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
require_once(JAGUAR_PATH . "JWindow.php");

class JPrimitiveObject
{
  /**
  * Stores object's type
  * @var string
  */
  var $mType = "PrimitiveObject";

  /**
  * Stores the object's name
  * @var string
  */
  var $mName;

  /**
  * Stores Javascript's code blocks which runs on page load
  * @var array $mJS
  */
  var $mOnLoadJS = array();

  /**
  * Stores HTML's code blocks
  * @var array $mHTML
  */
  var $mHTML = array();

  /**
  * Stores Javascript's code blocks
  * @var array $mJS
  */
  var $mJS = array();
    
  /**
  * Stores Javascript archives used by the page 
  * @var array
  */
  var $mJSFile = array();

  /**
  * Stores CSS' code blocks
  * @var array
  */
  var $mCSS = array();
  
  /**
  * Stores the CSS' archives used by the page 
  * @var array
  */
  var $mCSSFile = array();

  /**
  * Stores whether a page will display information windows
  * @var array
  */
  var $displayInformationWindows = true;

  /**
  * Stores the object's container
  * @var object
  */
  var $mContainer = null;

  /**
  * Stores objects added in another object
  * @var array $mObjects
  */
  var $mObjects = array();

  /**
  * Stores the index of the menu objects contained in the object
  * @var array
  */
  var $mMenusArray = array();

  /*
    * Sets the object's container
    @param object $obj
  */
  function SetContainer(&$obj)
  {
    //$obj becomes this component container
    //
    $this->mContainer = &$obj;

    //JFormEditor for example has attachments
    //
    $obj->UpdateAttachments($this);
  }

  function UpdateAttachments(&$obj)
  {
    /*
      TODO
      * html->addobject(table2)
      * table2->addobject(table)
      * form->addobject(hidden)
      * form->addobject(text) //text has a css file
      * table->addobject(form) // html need to get the css file so we update to the root container
    */
    $new = &$this->GetMainContainer();
    if (!$new) $new = &$this;

    // prepare to append the datepicker iframe into html
    //
    if (!$new->mUseDatePicker && $obj->mType == "Date" && $obj->mUseDatePicker )
        $new->mUseDatePicker = true;

    // transfer information to its container
    //
    $new->mCSS       =  array_merge($new->mCSS, $obj->mCSS);
    $new->mCSSFile   =  array_merge($new->mCSSFile, $obj->mCSSFile);
    $new->mOnLoadJS  =  array_merge($new->mOnLoadJS, $obj->mOnLoadJS);
    $new->mJS        =  array_merge($new->mJS, $obj->mJS);
    $new->mJSFile    =  array_merge($new->mJSFile, $obj->mJSFile);
    
    $new->mMenusArray  =  array_merge($new->mMenusArray, $obj->mMenusArray);

    // in case any children object be marked to does not validate just replicate it to its parent
    //
    if ($this->HasAuthProperty($obj))
      if (!$obj->mUseAuthentication) $new->mUseAuthentication = $obj->mUseAuthentication;

    // dispatch some memory
    //
    $obj->mCSSFile = array();
    $obj->mCSS = array();
    $obj->mOnLoadJS = array();
    $obj->mJS = array();
    $obj->mJSFile = array();
    $obj->mMenusArray = array();
  }

  /**
  * Returns true is a class has mUseAuthentication property and false otherwise
  * @returns boolen
  */
  function HasAuthProperty($object)
  {
    $properties = get_class_vars(get_class($object));

    reset($properties);
    if (get_class($object) == "JForm")
    {
      for($i = 0; $i < sizeof($properties); $i++)
      {
        if (key($properties) == "mUseAuthentication")
          return true;
        next($properties);
      }
    }

    return false;
  }

  /**
  * Return the maincontainer of the application (the parent of its parent of its parent...)
  * or null in case of no parents
  * @returns &object
  */

  function &GetMainContainer()
  {
    $obj = &$this;

    do
    {
      $obj = &$obj->GetContainer();
    } while($obj && $obj->GetContainer() !== null);

    return $obj;
  }

  function &GetContainer()
  {
    return $this->mContainer;
  }

  /**
  * Sets and return the Id of the current object
  * @param integer $id
  * @returns int
  */
  function MakeId($id=false)
  {
    //after change the id once it remains the same
    if ($this->mId === null)
      $this->mId = ($id === null ? 1 : $id); //To don't need to initialize the $id in each container instance, such not all pages are contained by JHtml

    return ($this->mId === false) ? rand(0, getrandmax()) : $this->mId;
  }
  
  /**
  * Sets and return the Class of the current object
  * @param string $class
  * @returns string
  */
  function MakeClass($class=false)
  {
    //after change the id once it remains the same
    if ($this->mClass === null)
      $this->mClass = ($class === null ? 1 : $class);

    return ($this->mClass === false) ? $this->mName : $this->mClass;
  }

  /**
  * Adds HTML code in the page 
  * @param string $what A block of HTML code
  * @param string $position The position of the code near the object (begin or end)
  */
  function AddHTML($what, $position = "end")
  {
    $this->mHTML[$position] .= $what;
  }

  /**
  * Adds Javascript code in the page 
  * @param string $what A block of JS code without the <script></script> tags
  * @param string $position The position of the code in the html (begin or end)
  */
  function AddJSOnLoad($what)
  {
    $container = &$this->GetMainContainer();
    if (!$container) $container = &$this;

    $container->mOnLoadJS[$what] = "begin";
  }

  /**
  * Adds Javascript code in the page 
  * @param string $what A block of JS code without the <script></script> tags
  * @param string $position The position of the code in the html (begin or end)
  */
  function AddJS($what, $position = "begin")
  {
    $container = &$this->GetMainContainer();
    if (!$container) $container = &$this;

    $container->mJS[$what] = $position;
  }


  /**
  * Adds Javascript archives in the page 
  * @param string $what A JS filename
  * @param string $position The position of the code in the html (begin or end)
  */
  function AddJSFile($what, $position = "begin")
  {
    $container = &$this->GetMainContainer();
    if (!$container) $container = &$this;

    $container->mJSFile[$what . "?" . date("YW")] = $position;
  }

  /**
  * Adds CSS code in the page 
  * @param string $what
  */
  function AddCSS($what)
  {
    $container = &$this->GetMainContainer();
    if (!$container) $container = &$this;

    $container->mCSS[$what] = true;
  }

  /**
  * Adds CSS archives in the page 
  * @param string $what A CSS filename
  */
  function AddCSSFile($what = false)
  {
    $container = &$this->GetMainContainer();
    if (!$container) $container = &$this;

    $container->mCSSFile[(($what) ? $what : URL."style.css") . "?" . date("YW")] = true;
  }

  /**
  * Sets whether the page will display the informative windows 
  * @param booelan $bool
  */
  function DisplayInformationWindows($bool = true)
  {
    $this->displayInformationWindows = $bool;
  }

  /**
  * Return configuration of windows which will be displayed
  * @returns string
  */
  function GetWindowData()
  {
    $file = "acesso_rapido.php";

    clearstatcache();
    if ($_SESSION["s_show_jwindow"] && file_exists($file) && !($_GET["use_popup"] || $_POST["use_popup"]))
      require_once($file);
  }

  /**
  * Adds an object to the objects' array and increases the main index
  * @param string $what Reference to the object that will be added
  */ 
  function AddObject(&$what)
  {
    if (!is_object($what))
    {
      $what = new JPrimitiveObject();
      //TODO add a warning message because $what might be an object
    }

    //TODO add to the error system
    if (!is_a($what, "JPrimitiveObject"))
      exit("Error: o Objeto adicionado depois de (".$what->mType."-".$what->mName.") deve ser um objeto válido no jaguar"); 

    if ($what->mType == "Menu")
      $this->mMenusArray[] = $what;

    $what->SetContainer($this);
    $this->mObjects[$this->mIndex++] = $what;
  }

  /**
  * Return the CSS Files
  * @returns string
  */
  function GetCSSFiles()
  {
    $out = "";
    foreach($this->mCSSFile as $value => $exists)
    {
      if (substr(basename($_SERVER["PHP_SELF"]), 0, 3) == "ifr")
        $out .= "<script type=\"text/javascript\"> if (document.location.toString().indexOf('".basename($_SERVER["PHP_SELF"])."') != -1) { document.writeln('";
      
      $out .= "<link rel=\"stylesheet\" type=\"text/css\" href=\"" . $value . "\" />";
      
      if (substr(basename($_SERVER["PHP_SELF"]), 0, 3) == "ifr")
        $out .= "'); } </script>";

      $out .= "\n";
    }

    return $out;
  }

  /**
  * Return the JS Files
  * @returns string
  */
  function GetJSFiles($myPosition)
  {
    $out = "";
    foreach($this->mJSFile as $value => $position)
    {
      if ($position == $myPosition)
      {
        $value = trim($value);

        $out .= "<script type=\"text/javascript\"";

        $charset = strpos($value, 'jaguar-ui') !== false ? " charset=\"UTF-8\" " : "";

        if (!defined("JAGUAR_NO_USE_SRC_SCRIPT") || !JAGUAR_NO_USE_SRC_SCRIPT)
        {
          if (substr(basename($_SERVER["PHP_SELF"]), 0, 3) == "ifr")
            $out .= "> if (document.location.toString().indexOf('".basename($_SERVER["PHP_SELF"])."') != -1) { document.writeln('<script";

          $out .= " src=\"" . $value . "\" {$charset}>";

          if (substr(basename($_SERVER["PHP_SELF"]), 0, 3) == "ifr")
            $out .= "</sc' + 'ript>'); } "; 
        }
        else
        {
          $out .= $charset . ">\n";

          if (strpos($value, "?") !== false)
            $value = substr($value, 0, strpos($value, "?"));

          if (strpos($value, "http") === 0)
            $value = urlencode($value);
          else
            $value = JAGUAR_PATH . str_replace(URL, "", $value);

          $out .= @file_get_contents($value) . "\n";
        }

        $out .= "</script>\n";
      }
    }

    return $out;
  }

  /**
  * Return the CSS text 
  * @returns string
  */
  function GetCSS()
  {
    $out = "";
    if (sizeof($this->mCSS))
    {
      $out .= "<style type=\"text/css\">\n<!--\n";
      foreach($this->mCSS as $value => $exists)
        $out .= $value . "\n";
      $out .= "-->\n</style>\n";
    }

    return $out;
  }

  /**
  * Return the JS text
  * @returns string
  */
  function GetJS($myPosition)
  {
    $out = "";

    if (sizeof($this->mOnLoadJS) && $myPosition == "begin")
    {
      //$out .= "$(function(){\n";
      $out .= "window.onload = function(){\n";
  
      foreach($this->mOnLoadJS as $value => $position)
        $out .= $value . "\n";

      $out .= "}\n\n";
      //$out .= "})\n\n";
    }

    if (sizeof($this->mJS))
    {
      foreach($this->mJS as $value => $position)
        if ($position == $myPosition)
          $out .= $value . "\n";
    }

    if ($out)
      $out = "<script type=\"text/javascript\">\n<!--\n".$out."\n-->\n</script>\n";

    return $out;
  }

  /**
  * Returns if the client browser is the Internet Explorer
  * @returns string
  */
  function IsIE()
  {
    if (strpos($_SERVER["HTTP_USER_AGENT"], "MSIE"))
      return true;
    
    return false;
  }

  /**
  * Return the a symbolic string only
  * @returns string
  */
  function GetHtml()
  {
    return $this->GetRawHtml(" ");
  }

  function GetRawHtml($html = "")
  {
    return (string) $this->mHTML["begin"] . $html . (string) $this->mHTML["end"];
  }

}
