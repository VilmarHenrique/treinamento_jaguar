<?
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
* Base consultation's class
*
* @author  Atua Sistemas de Informação
* @since   2003-10-14
* @package Jaguar
* @subpackage Consultation
*/
Class JBaseConsultation extends JTable
{
  /**
  * Stores the database connection (JDBConnection) object
  * @var object 
  */
  var $mConn;
  
  /**
  * Stores the record sets used in the consultation
  * @var array 
  */
  var $mRs;

  /**
  * Controls if any arror occured during the querys execution
  * @var boolean $this->mError
  */
  var $mError      = false;

  /**
  * Stores the consultation's width
  * @var int
  */
  var $mWidth      = 500;
  
  /**
  * Stores the consultation messages
  * @var array
  */
  var $mMessages;

  /**
  * Sets the database connection
  * @param object $conn A JDBConnection object
  */
  function SetConn($conn)
  {
    $this->mConn = $conn;
  }
  
  /**
  * Inserts values in the messages associative array
  * @param string  $messageName The array's key
  * @param integer $messageText The array's value
  */
  function SetMessage($messageName, $messageText)
  {
    $this->mMessages[$messageName] = $messageText;
  }

}

?>
