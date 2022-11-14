<?

  require_once("PHPExcel.php");

  class DbWriteExcel
  {
    /** @var JDBConn $mConn */
    private $mConn;
    
    /** @var string $mFileName */
    private $mFileName;

    /** @var array $arrLabels */
    private $arrLabels = array();
    
    /** @var array $arrDados */
    private $arrDados = array();
    
    /** 
     * campos que serao totalizados
     * @var array $mTotalFieldsArray
     */
    private $mTotalFieldsArray = array();
    
    /** @param JDBConn $conn */
    public function DBWriteExcel($conn)
    {
      $this->SetConnection($conn);
      $this->ValidatePermission();
    }

    public function ValidatePermission()
    {
      $myAuth = new JObject();
      $myAuth->ValidatePermission($this->mConn);
    }

    public function SetConnection($conn)
    {
      $this->mConn = $conn;
    }

    public function SetTotalFieldsArray($pTotalFieldsArray)
    {
      $this->mTotalFieldsArray = $pTotalFieldsArray;
    }

    public function HeaderingExcel() 
    {
      header("Content-type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
      header("Content-Disposition: attachment; filename=" . $this->mFileName);
      header("Expires: 0");
      header("Cache-Control: must-revalidate, post-check=0,pre-check=0");
      header("Pragma: public");
    }

    /** @param string $name */
    public function SetFileName($name)
    {
      switch (end(explode(".", $name)))
      {
        case "xlsx":                   break;
        case "xls" : $name .= "x";     break;
        default    : $name .= ".xlsx";
      }
      
      $this->mFileName = $name;
    }

    /** @param string $name */
    public function SetNameFile($name)
    {
      $this->SetFileName($name);
    }

    public function GetXlsFromQuery($sql, $pTitle = "", $pSaveFile = false)
    {
      global $argc;

      if ($rs = $this->mConn->Select($sql))
      {
        if ($rs->GetRowCount())
        {
          // caso arquivo nao ira ficar salvo no servidor
          if (!$pSaveFile)
          {
            if (!headers_sent())
            {
              $this->HeaderingExcel();
              $this->mFileName = "php://output";
              $pSaveFile = true;
            }
          }
         
          // obtem array de labels
          $this->arrLabels = array_keys($rs->mFieldNames);

          // obter todos os dados da consulta, de forma mais rapida que o GetArray();
          $this->arrDados = array();
          
          do 
            $this->arrDados[] = $rs->mFields; 
          while($rs->Next());
          
          if (count($this->mTotalFieldsArray))
            $this->adicionarTotais();
         
          $this->formatarValores();
          
          // montar .xlsx
          $excel = new PHPExcel();
          $excel->getProperties()->setTitle($pTitle);
          $excel->getSheet()->setTitle("Plan1");
          $excel->setActiveSheetIndex(0);
          $excel->getActiveSheet()->fromArray(array_merge(array($this->arrLabels), $this->arrDados));

          // gerar o arquivo
          if($pSaveFile)
          {
            $writer = new PHPExcel_Writer_Excel2007($excel);
            $writer->save($this->mFileName);
          }
        }
        else
        {
          if (PHP_SAPI != "cli")
          {
            $html = new JHtml($pTitle);
            $html->AddHtml("<h4>Não há registros para o(s) filtro(s) informado(s)!</h4>");
            $html->AddHtml("<br><br><a href=\"#\" onClick=\"window.close();\">Fechar Janela</a>");
            echo $html->GetHtml();
          }
        }
      }
      else
        echo $this->mConn->GetTextualError();
    }
    
    /**
     * funcao adiciona ultima linha com totais
     */
    private function adicionarTotais()
    {
      $arrKeys = array();
            
      $arrTotal = array_fill(0, count($this->arrLabels), null);

      // obter chaves dos campos que possuem total
      foreach ($this->mTotalFieldsArray as $nmField)
      {
        if (($key = array_search($nmField, $this->arrLabels)) !== false)
        {
          $arrKeys[]      = $key;
          $arrTotal[$key] = 0;
        }
      }

      foreach($this->arrDados as $arrLinha)
        foreach ($arrKeys as $key) 
          $arrTotal[$key] += $arrLinha[$key];

      $this->arrDados[] = $arrTotal;
    }    
    
    /**
     * funcao utilizada para formatar valores numericos 
     * como: cnpj, cpf e telefone
     */
    private function formatarValores()
    {
      $arrFunctions = array();
            
      // obter chaves dos campos que devem ser formatados
      foreach ($this->arrLabels as $key => $label)
      {
        if (strpos($label, "cnpj") !== false || strpos($label, "cpf") !== false)
          $arrFunctions[$key] = array("formata_nr_cnpj_cpf", array());
//        elseif (strpos($label, "telefone") !== false)
  //        $arrFunctions[$key] = array("Format_Fone", array("sys", "pt_BR")); 
      }
        
      if (count($arrFunctions))
        foreach ($this->arrDados as &$arrLinha) 
          foreach ($arrFunctions as $key => $arrFunction)
            $arrLinha[$key] = call_user_func_array($arrFunction[0], array_merge(array($arrLinha[$key]), $arrFunction[1]));
    }
  }
?>
