<?php

require_once 'fpdf.php';

class PDF extends FPDF
{
  /**
   * @var integer
   */
  private $hMin = 0;
  
  /**
   * @var integer
   */
  private $hAtual = 0;
  
  /**
   * @var integer
   */
  private $wAtual = false;
  
  /**
   * @var string
   */
  private $alignAtual = "L";

  /**
   * @var string
   */
  private $fillAtual = 0;
  
  /**
   * @var integer
   */
  private $wMax = 0;
  
  /**
   * @var integer
   */
  private $xInicial = 0;
  
  /**
   * @var integer
   */
  private $nrLinha = 0;
  
  /**
   * @var Array
   */
  private $arrFontConfig = array();
  
  /**
   * @var Array
   */
  private $arrLinha = array();

  /**
   * @var string
   */
  public static $border = '0';

  /**
   * adiciona font config
   * 
   * @param string $name
   * @param Array  $config
   */
  public function addFontConfig($name, Array $config)
  {
    $this->arrFontConfig[$name] = $config;
  }

    /**
     * Seta a configuração de fonte
     *
     * @param  string $name
     */
  private function setFontConfig($name)
  {
    foreach ($this->arrFontConfig[$name] as $method => $params)
      call_user_func_array(array($this, $method), $params);
  }

  /**
   * Seta hAtual
   *
   * @param $hAtual
   * @param $wAtual
   * @param $alignAtual
   * @param $fillAtual
   */
  public function SetHeightWidthAlignAtual($hAtual, $wAtual, $alignAtual, $fillAtual=false)
  {
    $this->hAtual     = $hAtual;
    $this->wAtual     = $wAtual;
    $this->alignAtual = $alignAtual;
    $this->fillAtual  = $fillAtual;
  }
  
  /**
   * escreve paragrafo
   * 
   * @param string texto
   * @param integer w
   * @param integer hMin
   */
  public function escreveTexto($txt, $w = 0, $hMin = 0)
  {
    $this->arrLinha[0]["h"] = $this->hMin = $this->hAtual = $hMin;
    $this->arrLinha[0]["w"] = 0; 
    $this->wMax             = $w;
    $this->xInicial         = $this->x;
    $this->arrLinha         = array();
    
    foreach (explode("\n", $txt) as $linha)
    {
      $linha .= "\n";
      
      foreach (explode(chr(16), $linha) as $bloco)
      {
        $arrBloco = explode(chr(17), $bloco);

        if (count($arrBloco) == 1)
          $this->montaBloco($bloco);
        else
        {
          $this->arrLinha[$this->nrLinha]["blocos"][]["fontConfig"] = $arrBloco[0];
          
          $this->setFontConfig($arrBloco[0]);
          $this->montaBloco($arrBloco[1]);
        }
      }
    }

    $this->gravaTexto();
  }

    /**
     * monta blocos e joga no arrLinha
     *
     * @param  string $txt
     */
  private function montaBloco($txt)
  {
    while ($length = strlen($txt))
    {
      if ($this->wAtual === false)
      {
        $w1 = $this->wMax - $this->arrLinha[$this->nrLinha]["w"];

        $w2 = $pos = 0;

        while ($w1 > $w2 && ($length - $pos) > 0)
          $w2 += parent::GetStringWidth($txt[$pos++]);

        if ($w1 < $w2)
        {
          $w2 = $w1;
          $pos--;
        }

        $w = ($txt[$pos - 1] == "\n" ? $w1 : $w2);

        if($length != $pos)
        {
          $pos2 = max(array(strrpos(substr($txt, 0, $pos + 1), " "),
                            strrpos(substr($txt, 0, $pos + 1), "\t"),
                            strrpos(substr($txt, 0, $pos + 1), "\n")));

          if ($pos2 !== false)
              $pos = $pos2 + 1;
          else
          {
            if ($w1 != $this->wMax)
              $pos = 0;
          }
        }
      }
      else
      {
        $w   = $this->wAtual;
        $pos = strlen($txt);
      }
      
      if($w > 0 && $pos > 0)
      {
        $this->arrLinha[$this->nrLinha]["blocos"][] = array("txt"   => substr($txt, 0, $pos),
                                                            "h"     => $this->hAtual,
                                                            "w"     => $w,
                                                            "align" => $this->alignAtual,
                                                            "fill"  => $this->fillAtual);
        $this->arrLinha[$this->nrLinha]["w"] += $w;
        
        $txt = substr($txt, $pos);
        
        if($this->arrLinha[$this->nrLinha]["h"] < $this->hAtual)
          $this->arrLinha[$this->nrLinha]["h"] = $this->hAtual;
      }
      
      if ($w1 == $w)
      {
        $this->nrLinha++;
        $this->arrLinha[$this->nrLinha]["h"] = $this->hMin;
        $this->arrLinha[$this->nrLinha]["w"] = 0;
      }
    }
  }
  
    /**
     * escreve blocos do arrLinha p/ pdf
     */
  private function gravaTexto()
  {
    foreach ($this->arrLinha as $Linha)
    {
      $hLinhaOld = $Linha["h"];
  
      if(is_array($Linha["blocos"]))
      {
        foreach ($Linha["blocos"] as $bloco)
        {
          if ($bloco["fontConfig"] !== null)
            $this->setFontConfig($bloco["fontConfig"]);
          else
          {
            if ($bloco["h"] < $hLinhaOld)
              $this->y = $this->y + ($hLinhaOld - $bloco["h"]);
            elseif ($bloco["h"] > $hLinhaOld)
              $this->y = $this->y - ($bloco["h"] - $hLinhaOld);

            $hLinhaOld = $bloco["h"];
            
            $this->Cell($bloco["w"], $bloco["h"], $bloco["txt"], self::$border, 0, $bloco["align"], $bloco["fill"]);
          }
        }
        
        $this->SetXY($this->xInicial, $this->y + $hLinhaOld);
      }
    }
  }
}