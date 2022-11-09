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
* Database configuration file
*
* @author  Atua Sistemas de Informação
*
* @since   2002-05-31
* @package Jaguar
*/


/**
* Stores the databases's type
* @var string $banco_tipo
*/	
$banco_tipo    = "ibase";

/**
* Stores the databases's user
* @var string $banco_usuario
*/	
$banco_usuario = "sysdba";

/**
* Stores the database's log user
* @var string $banco_usuario
*/	
$banco_usuario_log = false;

/**
* Stores the databases's password
* @var string $banco_senha
*/	
$banco_senha   = "masterkey";

/**
* Stores the databases's type
* @var string $banco_nome
*/	
$banco_nome    = "/home/www/ib/jaguar_tutorial/site/jaguar_db.fdb";

/**
* Stores the databases's host
* @var string $banco_host
*/	
$banco_host    = "localhost";
?>
