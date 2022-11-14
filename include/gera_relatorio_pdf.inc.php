<?

require_once("include/fpdfReport.php");

class gera_relatorio_pdf extends fpdfReport 
{
  // cabecalho padrao
  var $c_nm_usuario_cabecalho;
  var $c_nm_cidade_cabecalho;
  var $c_nm_filial_cabecalho;
  var $c_endereco_filial_cabecalho;
  var $c_cep_filial_cabecalho;

  var $c_id_usuario_cabecalho;
  var $c_cd_empresa;
  var $c_cd_logo;


  function gera_relatorio_pdf(&$pConn, $pPageOrientation="v", $pTitle="", $pSubTitle="", $pSubTitle2="")
  {
    $this->mConn            = $pConn;

    $this->mPageOrientation = (strtolower($pPageOrientation)=="h" || strtolower($pPageOrientation)=="v")?
                               strtolower($pPageOrientation) : "v";

    $this->mTitle       = $pTitle;
    $this->mSubTitle    = $pSubTitle;
    $this->mSubTitle2   = $pSubTitle2;

    $this->mLineHeight  = 3;
    $this->mDefaultFont = "arial";

    $this->setPageSize();

    $this->obtem_nome_usuario();
    $this->obtem_dados_filial();

    $this->obtem_cd_empresa();
    $this->obtem_id_usuario_cabecalho();

    // FPDF constructor
    $this->FPDF((($this->mPageOrientation=="v")?"P":"L"));
  }


  function createNewPage()
  {
    $this->AddPage();
    $this->SetMargins(0, 0);
    $this->SetFont($this->mDefaultFont, "b", 7);
    $this->SetXY(5, $this->GetY());

    // posicionamentos de acordo com a orientacao da pagina
    if ($this->mPageOrientation == "h")
    {
      $this->Rect(5, 5, 285, 197);
      $x              = 220;
      $x_titulo       = 22;
      $x_usuario      = $x - 215;
      $tam_cel_titulo = 225;
      $this->mPageWidth = 290;
      $this->mPageHeight  = 195;
    }
    else
    {
      $this->SetMargins(0, 0);
      $this->Rect(5, 5, 200, 285);
      $x              = 135;
      $x_titulo       = 22;
      $x_usuario      = $x - 130;
      $tam_cel_titulo = 142;
      $this->mPageWidth = 205;
      $this->mPageHeight  = 284;
    }

    $this->SetAutoPageBreak(false);

    // -------------
    // mostra logo de acordo com a empresa
    $t_img_nome = "";
    if (strlen($this->c_cd_logo))
    {
      if (!file_exists("img/logo_" . $this->c_cd_logo . ".jpg"))
      {
        $sql = "SELECT cd_pessoa 
                  FROM filial 
                 WHERE cd_pessoa_filial = " . $this->c_cd_logo;
        if (!$rs = $this->mConn->Select($sql))
          conn_mostra_erro();
        else
          $this->c_cd_logo = $rs->GetField(0);
      }

      $t_img_nome = "img/logo_" . $this->c_cd_logo . ".jpg";
    }
    else
      $t_img_nome = "img/logo_" . $this->c_cd_empresa . ".jpg";

    if (file_exists($t_img_nome))
      $this->Image($t_img_nome, 7, 7, 20, 10);
    // -------------


    // titulo do Relatório
    $this->SetFont($this->mDefaultFont, "b", 12);
    $this->SetXY($x_titulo, 8);
    $this->Cell($tam_cel_titulo, 4, $this->mTitle, 0, 1, "C");

    // subtitulo
    $this->SetFont($this->mDefaultFont, "", 8);
    $this->SetXY($x_titulo, $this->GetY() + 1);
    $this->Cell($tam_cel_titulo, 3, $this->mSubTitle, 0, 1, "C");

    // subtitulo2
    $this->SetFont($this->mDefaultFont, "", 7);
    $this->SetXY($x_titulo, $this->GetY());
    $this->Cell($tam_cel_titulo, 3, $this->mSubTitle2, 0, 1, "C");

    // mostra os dados da empresa e do usuario
    $this->SetFont($this->mDefaultFont, "", 5);
    $this->SetXY($x, 5);
    $this->Cell(70, 3, $this->c_nm_filial_cabecalho, 0, 1, "R");

    $this->SetX($x);
    $this->Cell(70, 3, $this->c_endereco_filial_cabecalho, 0, 1, "R");

    $this->SetX($x);
    $this->Cell(70, 3, "" . $this->c_nm_cidade_cabecalho . "   CEP " . $this->c_cep_filial_cabecalho . " ", 0, 1, "R");

    $this->SetXY($x_usuario, $this->GetY() + 3);
    if (strlen($_SESSION["s_cd_usuario"]) && $this->c_id_usuario_cabecalho)
      $this->Cell(50, 3, "Usuário: " . $_SESSION["s_cd_usuario"] . " / " . $this->c_nm_usuario_cabecalho . " ", 0, 0, "L");
    else
      $this->Cell(50, 3, "", 0, 0, "L");

    $this->SetX($x + 35);
    $this->Cell(23, 3, "Data: " . date("d/m/Y H:i:s") . " ", 0, 0, "R");

    $this->SetFont($this->mDefaultFont, "i", 5);

    $this->SetX($x + 58);
    $this->Cell(12, 3, "Página: " . $this->PageNo() . " ", 0, 0, "R");
  }


  function showEmptyRSMessage()
  {
    rel_sem_resultado($this->mTitle);
    exit();
  }


  /*
    seleciona dados da filial
  */
  function obtem_dados_filial()
  {
    $sql = "SELECT p.nm_pessoa AS nm_filial, c.nm_cidade || ' / ' || uf.ds_sigla AS nm_cidade_filial, 
                   obtem_endereco(obtem_endereco_comercial(p.cd_pessoa)) AS ds_endereco_filial, cep.nr_cep ";

    if (strlen($_SESSION["s_cd_pessoa_cabecalho"]))
      $sql .= "FROM pessoa p ";
    else
      $sql .= "FROM parametro_geral   pg
               JOIN vw_empresa_filial  p ON p.cd_pessoa = pg.cd_pessoa ";

    $sql .=  "JOIN cidade   c ON c.cd_cidade = p.cd_cidade 
              JOIN endereco e ON e.cd_pessoa = p.cd_pessoa 
              JOIN cep        ON cep.cd_cep  = e.cd_cep 
              JOIN uf         ON uf.cd_uf    = c.cd_uf ";

    if (strlen($_SESSION["s_cd_pessoa_cabecalho"]))
      $sql .= "WHERE p.cd_pessoa = " . $_SESSION["s_cd_pessoa_cabecalho"];

    if (!$rs = $this->mConn->Select($sql))
      conn_mostra_erro();
    else
    {
      $this->c_nm_cidade_cabecalho       = $rs->GetField("nm_cidade_filial");
      $this->c_nm_filial_cabecalho       = $rs->GetField("nm_filial");
      $this->c_endereco_filial_cabecalho = $rs->GetField("ds_endereco_filial");
      $this->c_cep_filial_cabecalho      = Format_Cep($rs->GetField("nr_cep"), "sys", "pr_BR");
    }
  }



  /*
    seleciona nome de usuario
  */
  function obtem_nome_usuario()
  {
    if (strlen($_SESSION["s_cd_usuario"]))
    {
      $sql = "SELECT SUBSTR(nm_pessoa, 0, 30) AS nm_pessoa 
                FROM pessoa 
               WHERE cd_pessoa = " . $_SESSION["s_cd_usuario"];
      if (!$rs = $this->mConn->Select($sql))
        conn_mostra_erro();
      else
        $this->c_nm_usuario_cabecalho = $rs->GetField(0);
    }
  }



  function obtem_cd_empresa()
  {
    if (!strlen($_SESSION["s_cd_empresa"]))
    {
      $sql = "SELECT cd_pessoa 
                FROM parametro_geral ";
      if (!$rs = $this->mConn->Select($sql))
        conn_mostra_erro();
      else
        $this->c_cd_empresa = $rs->GetField(0);
    }
    else
      $this->c_cd_empresa = $_SESSION["s_cd_empresa"];
  }



  function obtem_id_usuario_cabecalho()
  {
    if (!$this->c_cd_empresa)
      $this->obtem_cd_empresa();

    if (!strlen($_SESSION["s_id_usuario_cabecalho"]))
    {
      $sql = "SELECT id_usuario_cabecalho 
                FROM parametro_geral_empresa_grupo
              WHERE cd_pessoa = " . $this->c_cd_empresa;

      if (!$rs = $this->mConn->Select($sql))
        conn_mostra_erro();
      else
        $this->c_id_usuario_cabecalho = $rs->GetField(0);
    }
    else
      $this->c_id_usuario_cabecalho = $_SESSION["s_id_usuario_cabecalho"];
  }



  function seta_cd_logo($t_cd_logo)
  {
    $this->c_cd_logo = $t_cd_logo;
  }

  // -----------------------------
  // p/ manter compatibilidade

  function seta_arr_label($p)
  {
    $this->setLabelArray($p);
  }
  
  function monta_campos($arr_campo, $arr_cabecalho = null, $arr_pag = null, 
                        $arr_cat = null, $arr_ignor = null, $arr_campo_filho = null)
  {
    $arr_label_pag_cat = array();

    if (is_array($arr_ignor))
      $arr_label_pag_cat = array_merge($arr_label_pag_cat, $arr_ignor);

    if (is_array($arr_pag))
      $arr_label_pag_cat = array_merge($arr_label_pag_cat, $arr_pag);

    if (is_array($arr_cat))
      $arr_label_pag_cat = array_merge($arr_label_pag_cat, $arr_cat);

    //Cria um array dos campos de paginação para facilitar os testes
    $arr_paginacao = array();
    foreach ($arr_label_pag_cat AS $key => $value)
    {
      if ($value["fieldName"])
        $arr_paginacao[] = $value["fieldName"];
    }

    $t_arr_resize       = array();
    $arr_campo_excluido = array();
    //Busca nos campos se existe o campo de paginação, caso encontre retira ele e salva o tamanho do redimensionamento dos outros campos
    foreach ($arr_campo as $i => $value)
    {
      $t = explode("|", $arr_campo[$i]["fieldName"]);

      $achou = false;

      foreach ($arr_paginacao AS $campo)
      {
        if ($campo === $t[0] && !$achou)
        {
          $arr_resize = $arr_campo[$i]["resize"];

          if (!is_array($arr_resize)) continue;

          $t_arr_resize[] = $arr_resize;

          $arr_campo_excluido[] = $arr_campo[$i]["fieldName"];
          unset($arr_campo[$i]);
          $achou = true;
        }
        elseif ($campo === $t[1] && !$achou)
        {
          $arr_resize = $arr_campo[$i]["resize"];

          if (!is_array($arr_resize)) continue;

          $t_arr_resize[] = $arr_resize;

          $arr_campo_excluido[] = $arr_campo[$i]["fieldName"];
          unset($arr_campo[$i]);
          $achou = true;
        }
      }
    }
   
    //Redimensiona os campos
    if (count($t_arr_resize) > 0)
    {
      foreach ($arr_campo AS $key => $value)
      {
        foreach ($t_arr_resize AS $k => $val)
        {
          if ($val[$value["fieldName"]] > 0)
          {
            $width = 0;
            foreach ($arr_campo_excluido AS $campo_excluido)
            {
              if ($t_arr_resize[$k][$campo_excluido] > 0)
              {
                $width += $t_arr_resize[$k][$campo_excluido];
                unset($t_arr_resize[$k][$campo_excluido]);
              }
            }
            $width += $val[$value["fieldName"]];
            $arr_campo[$key]["width"] += $width;
            unset($t_arr_resize[$k][$value["fieldName"]]);
          }
        }
      }
    }

    //Monta arr_label
    $arr_label = array();
    foreach ($arr_campo AS $key => $value)
    {
      $arr_label[] = array("label" => $value["label"], "width" => $value["width"], "border" => $value["border"]);

      if (!is_array($arr_cabecalho)) continue;
      
      foreach ($arr_cabecalho AS $k => $val)
      {
        if (!is_array($val["campos"])) continue;

        foreach ($val["campos"] AS $campos)
        {
          if ($value["fieldName"] == $campos)
            $arr_cabecalho[$k]["width"] += $value["width"];
        }
      }
    }
    
    
    if (is_array($arr_cabecalho))
    {
      foreach ($arr_cabecalho AS $key => $value)
      {
        if (!str_value($value["width"]))
          unset($arr_cabecalho[$key]);
      }
      
      $arr_cabecalho = array_merge($arr_cabecalho, array("new_line"));
      $arr_label = array_merge($arr_cabecalho, $arr_label);
    }

    if (is_array($arr_campo_filho))
    {
      foreach ($arr_campo_filho AS $key => $value)
        $arr_label_filho[] = array("label" => $value["label"], "width" => $value["width"]);
    }

    $this->seta_arr_label($arr_label, $arr_label_filho);
    $this->seta_arr_campo($arr_campo, $arr_campo_filho);
  }
  
  function seta_arr_campo($p)
  {
    $this->setCellFieldsArray($p);
  }

  function seta_arr_campo_total($p)
  {
    $this->setTotalizationCellFieldsArray($p); 
  }

  function seta_campo_paginacao($p)
  {
    $this->setPaginationField($p);
  }

  function seta_arr_label_paginacao($p)
  {
    $this->setPaginationLabelArray($p);
  }

  function seta_arr_label_categorizacao($p)
  {
    $this->setCategorizationLabelArray($p);
  }

  function seta_campo_categorizacao($p)
  {
    $this->setCategorizationField($p);
  }

  function seta_cor_fundo_celula($a, $b, $c)
  {
    $this->setReportCellBgColor($a, $b, $c);
  }
 
  function seta_cor_fundo_celula_categorizacao($a, $b)
  {
    $this->setChangeCategorizationCellBgColor($a, $b);
  }

  function testa_pagina()
  {
    $this->testNoAutoPageBreak();
  }

  function seta_mostra_total_paginacao($p)
  {
    $this->setShowPaginationTotal($p);
  }

  function seta_mostra_total_categorizacao($p)
  {
    $this->setShowCategorizationTotal($p);
  }

  function seta_mostra_total_geral($p)
  {
    $this->setShowTotal($p);
  }

  function seta_fonte_padrao($p)
  {
    $this->setDefaultFont($p);
  }

  function gera_relatorio_sql($p)
  {
    $this->buildPdfReport($p);
  }

}

?>
