<?php

class JFormList
{
  /**
   * @var JFormText
   */
  private $campo;

  /**
   * @var string
   */
  private $label = "";

  /**
   * @var array
   */
  private $arrOptions = array();

  /**
   * @var array
   */
  private $arrOptionsDefault = array();

  /**
   * @param $nome
   * @param $label
   * @param bool $obrigatorio
   */
  public function __construct($nome, $label, $obrigatorio = false)
  {
    $this->campo = new JFormText($nome);
    $this->campo->SetExtra("style=\"display:none;\"");
    $this->campo->SetTestIfEmpty($obrigatorio, "Selecione ao menos um registro para o campo $label!");

    $this->label = $obrigatorio ? "<b>$label</b>" : $label;
  }

  /**
   * @param $label
   * @param $url
   * @param array $arrCamposForm ['nmCampo1', 'nmCampo2', 'nmCampo3']
   * @param array $arrCamposFixos {'nmCampo4': 'valor1', 'nmCampo5': 'valor2'}
   * @param int $width
   */
  public function addLinkPopUp($label, $url, $arrCamposForm = array(), $arrCamposFixos = array(), $width = 800)
  {
    $this->campo->AddPopUpLabel($label);
    $this->campo->AddPopUpUrl($url);
    $this->campo->SetPopUpWidth($width);

    $arrCamposForm[] = $this->campo->mName;

    foreach ($arrCamposForm as $nmCampo)
      $this->campo->AddPopUpField($url, $nmCampo);

    $arrCamposFixos["f_nm_campo_list"] = $this->campo->mName;

    foreach ($arrCamposFixos as $nmCampo => $valor)
      $this->campo->AddPopUpField($url, $valor, $nmCampo, true);
  }

  /**
   * @param $codigo
   * @param $descricao
   * @param bool $default
   */
  public function addOption($codigo, $descricao, $default = false)
  {
    $this->campo->mValue = "";

    if (str_value($descricao))
    {
      if ($default)
      {
        if (!isset($this->arrOptions[$codigo]))
          $this->arrOptionsDefault[$codigo] = $descricao;
      }
      else
        $this->arrOptions[$codigo] = $descricao;
    }
  }

  /**
   * @param JTable $form
   * @param array $arrOptionsHeader Padrão array()
   * @param array $arrOptionsCell Padrão array()
   * @param bool $novaTabela Padrão false
   * @param bool $mostrarListNaCelula Padrão false
   */
  public function addCodigoForm(JTable $form, $arrOptionsHeader = array(), $arrOptionsCell = array(), $novaTabela = false, $mostrarListNaCelula = false)
  {
    $form->AddJS($this->criarJS());

    $arrOptionsCell["align"] = "center";

    if ($novaTabela)
    {
      $tabela = new JTable(array("width" => "100%"));
      $form->OpenCell("", array("colspan" => ifnull($arrOptionsHeader["colspan"], 1) + ifnull($arrOptionsCell["colspan"], 1), "valign" => "top"));
      $form->AddObject($tabela);
      $form = $tabela;
    }

    $form->OpenRow();
    $form->OpenHeader($this->label, $arrOptionsHeader);
    $form->OpenCell("", $arrOptionsCell);

    $form->AddObject($this->addCampoOptionsDefault());

    $form->AddObject($this->campo);
    $form->AddHtml("<a href=\"javascript:void(0);\" id=\"selecionar_todos_" . $this->campo->mName . "\" style=\"text-decoration: none;\">
                      <img src=\"lib/jaguar/img/selecionar.png\" height=\"18\" width=\"18\" title=\"Selecionar todos\" />
                    </a>");
    $form->AddHtml("<a href=\"javascript:void(0);\" id=\"remover_todos_" . $this->campo->mName . "\">
                      <span style=\"color: #DD0000\" class=\"fa fa-times glyphicon\"></span>
                    </a>");

    $arrOptionsHeader["class"] = "coluna_" . $this->campo->mName;

    if ($mostrarListNaCelula)
    {
      $tbl = new JTable(array("width" => "100%", "style" => "margin: 2px 0px 0px 0px; padding: 0px; border-style: solid none none none;"));
      $tbl->OpenRow(array("style" => "display:none;", "id" => "linha_" . $this->campo->mName));
      $tbl->OpenCell("", $arrOptionsHeader);
      $tbl->OpenCell("<a href=\"javascript:void(0);\" class=\"remover_" . $this->campo->mName . "\" style=\"margin: 0px 5px 0px 5px;\">
                         <span style=\"color: #DD0000\" class=\"fa fa-times glyphicon\"></span>
                       </a>", $arrOptionsCell);
      $form->AddObject($tbl);
    }
    else
    {
      $form->OpenRow(array("style" => "display:none;", "id" => "linha_" . $this->campo->mName));
      $form->OpenCell("", $arrOptionsHeader);
      $form->OpenCell("<a href=\"javascript:void(0);\" class=\"remover_" . $this->campo->mName . "\">
                         <span style=\"color: #DD0000\" class=\"fa fa-times glyphicon\"></span>
                       </a>", $arrOptionsCell);
    }

    foreach ($this->arrOptions as $codigo => $descricao)
      $form->AddJS("$(function(){pop_up_back_{$this->campo->mName}('$codigo', '" . strtr($descricao, "'", "\'") . "');});");
  }

  public function GetValue()
  {
    return $this->campo->GetValue();
  }

  private function criarJS()
  {
    $nmCampo = $this->campo->mName;

    return <<<JS
      function pop_up_back_{$nmCampo}(codigo, descricao)
      {
        if (manipularStrList('.{$nmCampo}', 'add', codigo))
        {
          var newLine = $('#linha_{$nmCampo}').first().clone();
          newLine.removeAttr('style');
          newLine.find('a').attr('id', codigo);
          newLine.find('.coluna_{$nmCampo}').text(descricao);
          $('#linha_{$nmCampo}').after(newLine);
        }
      }

      $(function(){
        var method;
        var campo           = $('.{$nmCampo}');
        var selectDefault   = $('.{$nmCampo}_default');
        var selecionarTodos = $('#selecionar_todos_{$nmCampo}');
        var removerTodos    = $('#remover_todos_{$nmCampo}');

        function toggleSelect()
        {
          method = selectDefault.children().length > 1 ? 'show' : 'hide';
          selecionarTodos[method]();
          selectDefault[method]();

          method = campo.val().length > 0 ? 'show' : 'hide';
          removerTodos[method]();
        }

        function selecionarTodosFromDefault()
        {
          selectDefault.children().each(function(){
            if ($(this).attr('value'))
            {
              pop_up_back_{$nmCampo}($(this).attr('value'), $(this).text());
              $(this).remove();
            }
          });

          toggleSelect();
        }

        function selectOptionFromDefault()
        {
          var codigo = $(this).val();

          if (codigo != '')
          {
            var option = $('option[value="'+codigo+'"]', $(this));

            pop_up_back_{$nmCampo}(codigo, option.text());
            option.remove();

            toggleSelect();
          }
        }

        function adicionarOptionDefault(codigo, descricao)
        {
          if ($('option[value="'+codigo+'"]', selectDefault).text() == '')
            $('option:last', selectDefault).after('<option value="'+codigo+'">'+descricao+'</option>');

          toggleSelect();
        }

        removerTodos.on('click', function(){
          $('.remover_{$nmCampo}:visible').trigger('click');
        });

        $('.remover_{$nmCampo}').live('click', function()
        {
          var codigo = $(this).attr('id');
          var linha = $(this).parent().parent();

          manipularStrList('.{$nmCampo}', 'remove', codigo);

          adicionarOptionDefault(codigo, $('.coluna_{$nmCampo}', linha).text());

          linha.remove();
        });

        campo.on('change', toggleSelect);
        selectDefault.on('blur', selectOptionFromDefault);
        selectDefault.on('change', selectOptionFromDefault);
        selecionarTodos.on('click', selecionarTodosFromDefault)

        setTimeout(toggleSelect, 10);
      });
JS;
  }

  private function addCampoOptionsDefault()
  {
    $select = new JFormSelect("{$this->campo->mName}_default");
    $select->SetFirstEmpty(true);
    $select->mExtra = " style=\"width: 50px;";

    if (count($this->arrOptionsDefault))
      $select->SetOptions($this->arrOptionsDefault);
    else
      $select->mExtra .= "display:none;";

    $select->mExtra .= "\"";

    return $select;
  }
} 