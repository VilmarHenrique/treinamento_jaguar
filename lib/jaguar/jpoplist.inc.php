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

/*
* creation - ??? - decio
* 2003-03-26 - al_nunes - 
*  adicao do nome do grid na construcao do pop
*
* 2003-03-28 - al_nunes
*  autenticacao
*/

define ("PATH", dirname(__FILE__) . "/" );

/**
* Pop-up windows grids creation class
*
* @author Atua Sistemas de Informação
* @package Jaguar
*/
Class JPopList extends JDBGrid
{

  /**
  * Stores the default onClick function's name
  * @var object
  */
  var $mOnClick = "pop_up_back";

  private $dsLabelSelect = " ";

  /**
  * Constructor
  * @param string $name  The grid name
  * @param object &$conn A JDBConnection object
  * @param array  $sql   The partitioned sql clause
  * @param string $link  The location to wich the links wiil point to
  */
  function __construct($name, &$conn, $sql, $link = false)
  {
//    $this->SetOnClick(1, $this->mOnClick);

    parent::__construct($name, $conn, $sql);
    $this->SetOnClick(1, $this->mOnClick);
    $this->SetLocation($link);
  }
  
  /**
  * Builds pop-up's output
  * @returns string
  */
  function GetHtml()
  {
    // append a column called "Selecionar" to the grid
    $this->AddExtraFields(array($this->dsLabelSelect => "Selecionar"));
    $this->SetLink(count($this->mVisibles), "javascript:void(0);");

    // GetHtml from JDBGrid
    $str = parent::GetHtml();
    $str .= "
      <script>var jpoplist_numrecords = " . (float) $this->mNumRecords . ";</script>
    ";
    $str .= "<br>".
            "<a href=\"#\" onClick=\"javascript:window.close();\">".
            "Fechar Janela</a><br>";
    return $str;
  }

  public function configSupportJFormList(JHtml $html, $nmCampo, $aliasSql, $nmPopUpBack, $arrPopUpParams, $formatarDescricaoJS)
  {
    if (isset($_REQUEST["f_nm_campo_list"]))
    {
      $html->AddJS($this->montarPopUpBackJFormList($nmCampo, $arrPopUpParams, $formatarDescricaoJS));
      $this->addRestricaoWhereCampoList($aliasSql.$nmCampo);

      $this->mFilterForm->AddObject(new JFormHidden("f_nm_campo_list"));
      $this->mFilterForm->AddObject(new JFormHidden($_REQUEST["f_nm_campo_list"]));

      $this->dsLabelSelect = "
        <a href=\"javascript:void(0);\" id=\"addTodos\">
          <div class=\"fa fa-check-circle-o glyphicon\" style=\"font-size: 19px; color: green;\" title=\"Selecionar\"></div>
        </a>";
    }
    else
      $html->AddJS($this->montarPopUpBack($arrPopUpParams, $nmPopUpBack));
  }

  private function montarPopUpBackJFormList($nmCampo, $arrPopUpParams, $formatarDescricaoJS)
  {
    $params = implode(", ", $arrPopUpParams);

    $js = "
      var submitForm = true;

      $(function(){
        $('#addTodos').click(function(){
          if (confirm('Selecionar todos os itens?'))
          {
            submitForm = false;

            $('a[onclick*=\"pop_up_back\"]').each(function(){
              $(this).click();
            });

            submitForm = true;

            if (jpoplist_numrecords <= " . (float) $this->mLimit . ")
              self.close();
            else
              $('form').submit();
          }
        });
      });

      function pop_up_back($params)
      {
        $formatarDescricaoJS
        top.opener.pop_up_back_{$_REQUEST["f_nm_campo_list"]}($nmCampo, descricao);
        manipularStrList('.{$_REQUEST["f_nm_campo_list"]}', 'add', $nmCampo);

        if (jpoplist_numrecords == 1)
          self.close();
        else
          if (submitForm)
            $('form').submit();
      }
    ";

    return $js;
  }

  private function montarPopUpBack($arrPopUpParams, $nmPopUpBack)
  {
    $params = implode(", ", $arrPopUpParams);

    return "
      function pop_up_back($params)
      {
        top.opener.pop_up_back_{$nmPopUpBack}($params);
        window.close();
      }
    ";
  }

  private function addRestricaoWhereCampoList($nmCampoSql)
  {
    $this->mSql["where"] =
      ifnull($this->mSql["where"], "TRUE") .
      restricao_where("AND", $nmCampoSql, "NOT IN", limpa_variavel_multipla_entrada($_REQUEST[$_REQUEST["f_nm_campo_list"]], true, true));
  }
}
