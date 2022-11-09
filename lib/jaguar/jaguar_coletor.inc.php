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
* Main configuration file, includes all Jaguar Files
*
* @author  Atua Sistemas de Informação
* @since   2002-07-30
* @package Jaguar
*/

if (version_compare(PHP_VERSION, '5.4.0', '>='))
{
  if (isset($_SERVER))
  {
    foreach ($_SERVER as $key => $value)
      $$key = $value;
  }

  if (isset($_SESSION))
  {
    foreach ($_SESSION as $key => $value)
      $$key = $value;
  }

  if (isset($_REQUEST))
  {
    foreach ($_REQUEST as $key => $value)
      $$key = $value;
  }
}

require_once("conf.inc.php");
require_once(JAGUAR_PATH . "jutils.inc.php");
require_once(JAGUAR_PATH . "jobject.inc.php");
require_once(JAGUAR_PATH . "jhtml.inc.php");
require_once(JAGUAR_PATH . "jtable.inc.php");
require_once(JAGUAR_PATH . "jform.inc.php");
require_once(JAGUAR_PATH . "jdb.inc.php");
require_once(JAGUAR_PATH . "jdbauth.inc.php");
require_once(JAGUAR_PATH . "jdbgrid.inc.php");
require_once(JAGUAR_PATH . "jtree.inc.php");
require_once(JAGUAR_PATH . "jmaintenance.inc.php");
require_once(JAGUAR_PATH . "jpoplist.inc.php");
require_once(JAGUAR_PATH . "jmenu.inc.php");
require_once(JAGUAR_PATH . "jmasterdetail.inc.php");
require_once(JAGUAR_PATH . "jbaseconsultation.inc.php");
require_once(JAGUAR_PATH . "jconsultation.inc.php");
require_once(JAGUAR_PATH . "jhierarchicalconsultation.inc.php");
require_once(JAGUAR_PATH . "jsubconsultation.inc.php");
require_once(JAGUAR_PATH . "jsumconsultation.inc.php");
require_once(JAGUAR_PATH . "jcrosstabconsultation.inc.php");

JDBAuth::SetValidated();

//Conexão com o banco de dados
$conn = new JDBConn($banco_tipo);
$conn->Connect($banco_nome, $banco_usuario, $banco_senha, $banco_host);
$conn->SetDebug(0);
?>
