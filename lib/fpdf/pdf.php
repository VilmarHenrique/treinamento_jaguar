<?php
  require_once($path . "lib/jaguar/jaguar.inc.php");
  require_once("fpdf.php");
  
  //conexão com o banco
  $conn = new JDBConn($banco_tipo);
  $conn->Connect($banco_nome, $banco_usuario, $banco_senha, $banco_host);

  //Seleciona o nome do usuário
  if (strlen($_SESSION["s_cd_usuario"]))
  {
    $sql = "SELECT SUBSTR(nm_pessoa, 0, 30) AS nm_pessoa ". 
             "FROM pessoa ".
            "WHERE cd_pessoa = " . $_SESSION["s_cd_usuario"];
          
    if ($rs = $conn->Select($sql))
      $nm_usuario = $rs->GetField(0);
  }

  //Seleciona os dados da Filial - Nome, Endereço e CEP
  $sql = "SELECT p.nm_pessoa AS nm_filial, c.nm_cidade || ' / ' || uf.ds_sigla AS nm_cidade_filial, ".
                "obtem_endereco(obtem_endereco_comercial(p.cd_pessoa)) AS ds_endereco_filial, cep.nr_cep ";

  if (strlen($_SESSION["s_cd_pessoa_cabecalho"]))
    $sql .= "FROM pessoa p ";
  else  
    $sql .= "FROM parametro_geral pg, vw_empresa_filial p ";

  $sql .=  "JOIN cidade c ON c.cd_cidade = p.cd_cidade " .
           "JOIN endereco e ON e.cd_pessoa = p.cd_pessoa ".
           "JOIN cep ON cep.cd_cep = e.cd_cep ".
           "JOIN uf uf ON c.cd_uf = uf.cd_uf ";

  if (strlen($_SESSION["s_cd_pessoa_cabecalho"]))
    $sql .= "WHERE p.cd_pessoa = " . $_SESSION["s_cd_pessoa_cabecalho"];
  else
    $sql .= "WHERE p.cd_pessoa = pg.cd_pessoa ";

  if ($rs = $conn->Select($sql))
  {
    $nm_cidade_cabecalho = $rs->GetField("nm_cidade_filial");
    $nm_filial_cabecalho = $rs->GetField("nm_filial");
    $filial_endereco     = $rs->GetField("ds_endereco_filial");
    $filial_cep          = Format_Cep($rs->GetField("nr_cep"), "sys", "pr_BR");
  } 

  class PDF extends FPDF
  {
    //Constructor
    //
    function __construct($orientation='L',$unit='mm',$format='A4')
    {
      global $conn;

      parent::FPDF($orientation, $unit, $format);

      $myAuth = new JObject();
      $myAuth->ValidatePermission($conn);
    }

    //Page header
    function Header()
    {
      global $conn, $nm_usuario, $horizontal, $nm_filial_cabecalho, $filial_endereco, $filial_cep,
             $nm_cidade_cabecalho, $titulo, $sub_titulo, $sub_titulo2, $cd_logo, $path;

      if (!strlen($_SESSION["s_cd_empresa"]))
      {
        $sql = "SELECT cd_pessoa ".
                 "FROM parametro_geral ";

        if ($rs = $conn->Select($sql))
          $_SESSION["s_cd_empresa"] = $rs->GetField(0);
        else
          echo $conn->GetTextualError();
      }
      if (!strlen($_SESSION['s_id_usuario_cabecalho']))
      {
        $sql = "SELECT id_usuario_cabecalho ".
                 "FROM parametro_geral_empresa_grupo 
                WHERE cd_pessoa = " . $_SESSION["s_cd_empresa"];

        if ($rs = $conn->Select($sql))
          $_SESSION['s_id_usuario_cabecalho'] = $rs->GetField(0);
        else
          echo $conn->GetTextualError();        
      }

      $this->SetAutoPageBreak(false);

      //Logo
      if ($horizontal == true)
      {
        $this->Rect(5, 5, 285, 197);
        $x = 220;
        $x_titulo = 22;
        $x_usuario = $x - 215;
        $tam_cel_titulo = 225;
        $vl_linha = 290;
      }
      else
      {
        $this->SetMargins(0, 0);
        $this->Rect(5, 5, 200, 285);
        $x = 135;
        $x_titulo = 22;
        $x_usuario = $x - 130;
        $tam_cel_titulo = 142;
        $vl_linha = 205;
      }
      
      //Logo da Empresa      
      if (strlen($cd_logo))
      {
        if (!file_exists($path . "img/logo_".$cd_logo.".jpg"))
        {
          $sql = "SELECT cd_pessoa ".
                   "FROM filial ".
                  "WHERE cd_pessoa_filial = $cd_logo";
          if ($rs = $conn->Select($sql))
            $cd_logo = $rs->GetField(0);
          else
            echo $conn->GetTextualError();
        }
        
        $img_name = $path . "img/logo_" .$cd_logo. ".jpg";
      }  
      else
        $img_name = $path . "img/logo_" . $_SESSION["s_cd_empresa"] . ".jpg";
      
      if (file_exists($img_name))
        $this->Image($img_name, 7, 7, 20, 10);

      //Título do Relatório
      $this->SetFont('Arial', 'B', 12);
      $this->SetXY($x_titulo, 8);
      $this->Cell($tam_cel_titulo, 4, $titulo, 0, 1, 'C');

      //Subtítulo - quando há período de datas
      $this->SetFont('Arial', '', 8);
      $this->SetXY($x_titulo, $this->GetY() + 1);
      $this->Cell($tam_cel_titulo, 3, $sub_titulo, 0, 1, 'C');

      $this->SetFont('Arial', '', 7);
      $this->SetXY($x_titulo, $this->GetY());
      $this->Cell($tam_cel_titulo, 3, $sub_titulo2, 0, 1, 'C');

      //Mostra os dados da Empresa e do usuário
      $this->SetFont('Arial','',5);
      $this->SetXY($x, 5);
      $this->Cell(70, 3, $nm_filial_cabecalho, 0, 1, 'R');
      
      $this->SetX($x);
      $this->Cell(70, 3, $filial_endereco, 0, 1, 'R');
      
      $this->SetX($x);
      $this->Cell(70, 3, ''.$nm_cidade_cabecalho.'   CEP '.$filial_cep.' ', 0, 1, 'R');
      
      $this->SetXY($x_usuario, $this->GetY() + 3);
      if (strlen($_SESSION["s_cd_usuario"]) && $_SESSION['s_id_usuario_cabecalho'])
        $this->Cell(50, 3, 'Usuário: '. $_SESSION["s_cd_usuario"]  .' / '. $nm_usuario.' ', 0, 0, 'L');
      else
        $this->Cell(50, 3, '', 0, 0, 'L');

      if ($this->ShowDate())
        $dt_data = "Data: " . date("d/m/Y H:i:s") . " ";

      $this->SetX($x + 35);
      $this->Cell(23, 3, $dt_data, 0, 0, 'R');
      
      $this->SetFont('Arial', 'I', 5);
      
      $this->SetX($x + 58);
      $this->Cell(12, 3, $this->LabelPage() . ': ' . $this->PageNo() . ' ', 0, 1, 'R');

      //Mostra uma linha
      $this->SetXY(4, $this->GetY() - 3);
      $this->SetFont('Arial','',10);
      $this->Line(5, $this->GetY() + 3, $vl_linha, $this->GetY() + 3);

      //Quebra de Linha
      $this->Ln(20);
    }

  }//class PDF
  
  if (strlen($_SESSION["s_cd_pessoa_cabecalho"]))
    unset($_SESSION["s_cd_pessoa_cabecalho"]);