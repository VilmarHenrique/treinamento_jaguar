<?php
class CaminhoMigalhas 
{
  /**
   *  Objeto de manutenção das operações do banco de dados.
   *  @var ManBD 
   */
  private $ManBD;
  
  /** 
   * Objeto jaguar que monta html
   * @var JHtml 
   */
  private $JHtml;

  /** 
   * Guarda o nome do arquivo requisitado
   * @var string 
   */
  private $nmArquivo = "";
  
  /** 
   * Guarda o tipo do arquivo requisitado
   * @var string 
   */
  private $dsArquivo = "";
  
  /** 
   * Guarda o nome da função 
   * @var string 
   */
  private $nmFuncao = "";
  
  /** 
   * Armazena caminho, primeiramente de forma inversa: 
   * <br>do arquivo atual até o menu principal que
   * <br>posteriormente será reverso para exibição.
   * @var Array 
   */
  private $arrCaminho = array();
  
  /** 
   * Armazena o código da pasta onde o arquivo se encontra,
   * <br>para consulta de forma recursiva de suas pastas pai
   * @var int
   */
  private $cdPasta;

  public static $nmFuncaoCaminho = "";
  
  /**
   * Método construtor 
   * @param JHtml $JHtml 
   */
  public function __construct(JHtml $JHtml) 
  {
    $this->ManBD     = ManBD::getInstance();
    $this->JHtml     = $JHtml;
    $this->nmArquivo = $_SERVER["script_name"] . ".php";
    $this->nmFuncao  = ifnull(self::$nmFuncaoCaminho, substr($this->nmArquivo, 4, -4));
    $this->dsArquivo = substr($this->nmArquivo, 0, 4);

    $arrTipoArq = array("sel_", "fil_", "man_", "exe_", "con_");

    if (in_array($this->dsArquivo, $arrTipoArq) and $_REQUEST["f_id_hide_caminho"] !== "1")
    {
      $this->ManBD->objConn->SetLog(false);
      
      $this->addDsMasterDetail();
      $this->addDadosFuncao();
      $this->addCaminhoMenu();
      
      $this->ManBD->objConn->SetLog(true);
    }
  }
   
  /** 
   * Retorna o html que será exibido na tela com 
   * <br>o caminho até o arquivo atual requisitado
   * @return string 
   */
  public function getHtml()
  {
    if (count($this->arrCaminho) > 0)
    {
      return "
        <div id=\"divCaminhoMigalhas\" style=\"position: fixed; top:5px; left:5px;\">
          <div id=\"caminhoMigalhas\" style=\"border-bottom: 1px solid #999; font-size: 11px; background-color:white; float:left;\">
          " . implode("  >>  ", array_reverse($this->arrCaminho)) . "
          </div>
          <div style=\"float:left;\">
            &nbsp;<a style=\"font-size:17px; text-decoration:none; font-weight:bold; font-family:serif;\" href=\"javascript:void(0);\" onclick=\"ocultarCaminhoMigalhas();\" id=\"setaCaminhoMigalhas\">&laquo;</a>
          </div>
        </div><br />

        <script language=\"javascript\" type=\"text/javascript\">
          $(document).ready(function()
          {
            if ($('#action_mais_acessados').is(':visible'))
              $('#divCaminhoMigalhas').css('left', '50px');
          });

          function ocultarCaminhoMigalhas()
          {
            if ($('#caminhoMigalhas').is(':visible'))
            {
              $('#action_mais_acessados').fadeOut('fast');
              $('#caminhoMigalhas').fadeOut('fast', function()
              {
                $('#divCaminhoMigalhas').css('left', '5px');
              });
            }
            else
            {
              $('#action_mais_acessados').fadeIn();
              $('#caminhoMigalhas').fadeIn();

              if ($('#action_mais_acessados').is(':visible'))
                $('#divCaminhoMigalhas').css('left', '50px');
            }
            
            if ($('#setaCaminhoMigalhas').html() == '«')
              $('#setaCaminhoMigalhas').html('»'); 
            else 
              $('#setaCaminhoMigalhas').html('«'); 
          }
        </script>";
    }
  }

  /** 
   * Método que adiciona título com informações do mestre detalhe
   * <br>e altera nmFuncao caso o arquivo requisitado não 
   * <br>seja o default do mestre detalhe
   */
  private function addDsMasterDetail()
  {
    if ($this->JHtml->mMasterDetail instanceof JMasterDetail and 
        $this->nmArquivo != $this->JHtml->mMasterDetail->mDefaultFile)
    {
      foreach ($this->JHtml->mMasterDetail->mObject as $dsLabel => $value)
      {
        if ($value["file"] == $this->nmArquivo)
        {
          $this->arrCaminho[] = $this->JHtml->mTitle;
          $this->arrCaminho[] = $dsLabel;
          break;
        }
      }
      
      if (strlen($this->JHtml->mMasterDetail->mDefaultFile) > 0)
        $this->nmFuncao = substr($this->JHtml->mMasterDetail->mDefaultFile, 4, -4);
    }
  }
  
  /**
   * Busca dados da função e adiciona ao caminho
   */
  private function addDadosFuncao()
  {
    if (!$this->ManBD->objConn->TableExists("funcao_pasta")) return;

    $sql = "SELECT p.cd_pasta, f.ds_menu, f.ds_funcao, f.nm_arquivo
              FROM funcao f
              JOIN funcao_pasta fp ON fp.cd_funcao = f.cd_funcao
              JOIN pasta        p  ON p.cd_pasta   = fp.cd_pasta
             WHERE f.nm_funcao = '$this->nmFuncao'
             LIMIT 1";
    
    if (!$rs = $this->ManBD->objConn->Select($sql))
      echo $this->ManBD->objConn->GetTextualError();
    elseif ($rs->GetRowCount())
    {
      if (strlen($rs->GetField("ds_menu")) > 0)
      {
        if (count($this->arrCaminho) > 0)
        {
          if ($this->dsArquivo == "con_")
            $this->arrCaminho[] = str_replace("Manutenção", "Extrato", $rs->GetField("ds_funcao"));
          else
            $this->arrCaminho[] = $rs->GetField("ds_funcao");
          
          $this->arrCaminho[] = $this->montarLink($rs->GetField("nm_arquivo"), $rs->GetField("ds_menu"));
        }
        elseif ((count($_REQUEST) and $this->dsArquivo == "exe_") or
                $rs->GetField("nm_arquivo") != $this->nmArquivo)
        {
          $this->arrCaminho[] = $this->JHtml->mTitle;
          $this->arrCaminho[] = $this->montarLink($rs->GetField("nm_arquivo"), $rs->GetField("ds_menu"));
        }
        else
        {
          $this->arrCaminho[] = $this->JHtml->mTitle;
          $this->arrCaminho[] = $rs->GetField("ds_menu");
        }
        
        $this->cdPasta = $rs->GetField("cd_pasta");
      }
      else
        $this->arrCaminho = array();
    }
  }
  
  /**
   * Busca dados das pastas de forma recursiva
   */
  private function addCaminhoMenu()
  {
    if ($this->cdPasta != null)
    {
      // sql com recursivedade
      $sql = "
        WITH RECURSIVE obter_pastas(cd_pasta) AS 
        (
          SELECT $this->cdPasta
           UNION ALL
          SELECT pp.cd_pasta 
            FROM obter_pastas op
            JOIN pasta_pasta  pp ON pp.cd_pasta_filha = op.cd_pasta
        )
      SELECT p.nm_pasta
        FROM obter_pastas op
        JOIN pasta         p ON p.cd_pasta = op.cd_pasta";

      if (!$rs = $this->ManBD->objConn->Select($sql))
        echo $this->ManBD->objConn->GetTextualError();
      elseif ($rs->GetRowCount() > 0)
      {      
        do
          $this->arrCaminho[] = $rs->GetField("nm_pasta");
        while ($rs->Next());
      }
    }
  }
  
  /**
   * Monta o link para aquivo principal da função escolhida 
   * <br>caso tenha permissão no menu
   * @param string $nmArquivo
   * @param string $dsLink
   * @return string
   */
  private function montarLink($nmArquivo, $dsLink)
  {
    $auth = new JDBAuth($this->ManBD->objConn);
    $auth->SetScript($nmArquivo);

    return ($auth->CanMenu() ? "<a href=\"$nmArquivo\">$dsLink</a>" : $dsLink);
  }
}
?>