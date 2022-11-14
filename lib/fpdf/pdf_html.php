<?php
  require_once 'pdf_contrato.php';
  
  class PDFHtml extends PDF
  {
    var $B = 0;
    var $I = 0;
    var $U = 0;
    var $HREF  = '';
    var $ALIGN = '';
    
    function WriteHTML($html)
    {
      //HTML parser
      $html = str_replace("\n", ' ', $html);
      $a    = preg_split('/<(.*)>/U', $html, -1, PREG_SPLIT_DELIM_CAPTURE);
      
      foreach($a as $i => $e)
      {
        if ($i % 2 == 0)
        {
          //Text
          if ($this->HREF)
            $this->PutLink($this->HREF, $e);
          elseif($this->ALIGN == 'center')
            $this->Cell(0, 5, $e, 0, 1, 'C');
          else
            $this->Write(5, $e);
        }
        else
        {
          //Tag
          if ($e[0] == '/')
            $this->CloseTag(strtoupper(substr($e, 1)));
          else
          {
            //Extract properties
            $a2   = explode(' ', $e);
            $tag  = strtoupper(array_shift($a2));
            $prop = array();
            
            foreach($a2 as $v)
            {
              if (preg_match('/([^=]*)=["\']?([^"\']*)/', $v, $a3))
                $prop[strtoupper($a3[1])] = $a3[2];
            }
            
            $this->OpenTag($tag, $prop);
          }
        }
      }
    }
    
    function OpenTag($tag, $prop)
    {
      //Opening tag
      if ($tag == 'B' || $tag == 'I' || $tag == 'U')
        $this->SetStyle($tag, true);
      
      if ($tag == 'A')
        $this->HREF = $prop['HREF'];
      
      if ($tag == 'BR')
        $this->Ln(5);
      
      if ($tag == 'P')
      {
        $this->ALIGN = $prop['ALIGN'];
        $this->Ln(5);
      }
      
      if ($tag == 'HR')
      {
        if (!empty($prop['WIDTH']))
          $Width = $prop['WIDTH'];
        else
          $Width = $this->w - $this->lMargin-$this->rMargin;
        
        $this->Ln(2);
        $x = $this->GetX();
        $y = $this->GetY();
        $this->SetLineWidth(0.4);
        $this->Line($x, $y, $x+$Width, $y);
        $this->SetLineWidth(0.2);
        $this->Ln(2);
      }
    }
    
    function CloseTag($tag)
    {
      //Closing tag
      if ($tag == 'B' || $tag == 'I' || $tag == 'U')
        $this->SetStyle($tag, false);
      
      if ($tag == 'A')
        $this->HREF = '';
      
      if ($tag == 'P')
        $this->ALIGN = '';
    }
    
    function SetStyle($tag, $enable)
    {
      //Modify style and select corresponding font
      $this->$tag += ($enable ? 1 : -1);
      $style = '';
      
      foreach (array('B', 'I', 'U') as $s)
        if ($this->$s > 0)
          $style.= $s;
      
      $this->SetFont('', $style);
    }
    
    function PutLink($URL,$txt)
    {
      //Put a hyperlink
      $this->SetTextColor(0, 0, 255);
      $this->SetStyle('U', true);
      $this->Write(5, $txt, $URL);
      $this->SetStyle('U', false);
      $this->SetTextColor(0);
    }
    
    function Write($h, $txt, $link='')
    {
      // Output text in flowing mode
      $cw = &$this->CurrentFont['cw'];
      $w = $this->w-$this->rMargin-$this->x;
      $wmax = ($w-2*$this->cMargin)*1000/$this->FontSize;
      $s = str_replace("\r",'',$txt);
      $nb = strlen($s);
      $sep = -1;
      $i = 0;
      $j = 0;
      $l = 0;
      $nl = 1;
      while($i<$nb)
      {
        // Get next character
        $c = $s[$i];
        if($c=="\n")
        {
          // Explicit line break
          //$this->MultiCell($w, $h, substr($s,$j,$i-$j), 1);
          $this->Cell($w,$h,substr($s,$j,$i-$j),0,2,'',0,$link);
          $i++;
          $sep = -1;
          $j = $i;
          $l = 0;
          if($nl==1)
          {
            $this->x = $this->lMargin;
            $w = $this->w-$this->rMargin-$this->x;
            $wmax = ($w-2*$this->cMargin)*1000/$this->FontSize;
          }
          $nl++;
          continue;
        }
        if($c==' ')
          $sep = $i;
        $l += $cw[$c];
        if($l>$wmax)
        {
          // Automatic line break
          if($sep==-1)
          {
            if($this->x>$this->lMargin)
            {
              // Move to next line
              $this->x = $this->lMargin;
              $this->y += $h;
              $w = $this->w-$this->rMargin-$this->x;
              $wmax = ($w-2*$this->cMargin)*1000/$this->FontSize;
              $i++;
              $nl++;
              continue;
            }
            if($i==$j)
              $i++;
            
            //$this->MultiCell($w, $h, substr($s,$j,$i-$j), 1);
            $this->Cell($w,$h,substr($s,$j,$i-$j),0,2,'',0,$link);
          }
          else
          {
            //$this->MultiCell($w, $h, substr($s,$j,$sep-$j), 1);
            $this->Cell($w,$h,substr($s,$j,$sep-$j),0,2,'',0,$link);
            $i = $sep+1;
          }
          $sep = -1;
          $j = $i;
          $l = 0;
          if($nl==1)
          {
            $this->x = $this->lMargin;
            $w = $this->w-$this->rMargin-$this->x;
            $wmax = ($w-2*$this->cMargin)*1000/$this->FontSize;
          }
          $nl++;
        }
        else
          $i++;
      }
      // Last chunk
      if($i!=$j)
        //$this->MultiCell($l/1000*$this->FontSize, $h, substr($s,$j));
        $this->Cell($l/1000*$this->FontSize,$h,substr($s,$j),0,0,'',0,$link);
    }
    
    function Cell($w, $h=0, $txt='', $border=0, $ln=0, $align='', $fill=false, $link='')
    {
        $k=$this->k;
        if($this->y+$h>$this->PageBreakTrigger && !$this->InHeader && !$this->InFooter && $this->AcceptPageBreak())
        {
            $x=$this->x;
            $ws=$this->ws;
            if($ws>0)
            {
                $this->ws=0;
                $this->_out('0 Tw');
            }
            $this->AddPage($this->CurOrientation);
            $this->x=$x;
            if($ws>0)
            {
                $this->ws=$ws;
                $this->_out(sprintf('%.3F Tw',$ws*$k));
            }
        }
        if($w==0)
            $w=$this->w-$this->rMargin-$this->x;
        $s='';
        if($fill || $border==1)
        {
            if($fill)
                $op=($border==1) ? 'B' : 'f';
            else
                $op='S';
            $s=sprintf('%.2F %.2F %.2F %.2F re %s ',$this->x*$k,($this->h-$this->y)*$k,$w*$k,-$h*$k,$op);
        }
        if(is_string($border))
        {
            $x=$this->x;
            $y=$this->y;
            if(is_int(strpos($border,'L')))
                $s.=sprintf('%.2F %.2F m %.2F %.2F l S ',$x*$k,($this->h-$y)*$k,$x*$k,($this->h-($y+$h))*$k);
            if(is_int(strpos($border,'T')))
                $s.=sprintf('%.2F %.2F m %.2F %.2F l S ',$x*$k,($this->h-$y)*$k,($x+$w)*$k,($this->h-$y)*$k);
            if(is_int(strpos($border,'R')))
                $s.=sprintf('%.2F %.2F m %.2F %.2F l S ',($x+$w)*$k,($this->h-$y)*$k,($x+$w)*$k,($this->h-($y+$h))*$k);
            if(is_int(strpos($border,'B')))
                $s.=sprintf('%.2F %.2F m %.2F %.2F l S ',$x*$k,($this->h-($y+$h))*$k,($x+$w)*$k,($this->h-($y+$h))*$k);
        }
        if($txt!='')
        {
            if($align=='R')
                $dx=$w-$this->cMargin-$this->GetStringWidth($txt);
            elseif($align=='C')
                $dx=($w-$this->GetStringWidth($txt))/2;
            elseif($align=='FJ')
            {
                //Set word spacing
                $wmax=($w-2*$this->cMargin);
                $nb=substr_count($txt,' ');
                if($nb>0)
                    $this->ws=($wmax-$this->GetStringWidth($txt))/$nb;
                else
                    $this->ws=0;
                $this->_out(sprintf('%.3F Tw',$this->ws*$this->k));
                $dx=$this->cMargin;
            }
            else
                $dx=$this->cMargin;
            $txt=str_replace(')','\\)',str_replace('(','\\(',str_replace('\\','\\\\',$txt)));
            if($this->ColorFlag)
                $s.='q '.$this->TextColor.' ';
            $s.=sprintf('BT %.2F %.2F Td (%s) Tj ET',($this->x+$dx)*$k,($this->h-($this->y+.5*$h+.3*$this->FontSize))*$k,$txt);
            if($this->underline)
                $s.=' '.$this->_dounderline($this->x+$dx,$this->y+.5*$h+.3*$this->FontSize,$txt);
            if($this->ColorFlag)
                $s.=' Q';
            if($link)
            {
                if($align=='FJ')
                    $wlink=$wmax;
                else
                    $wlink=$this->GetStringWidth($txt);
                $this->Link($this->x+$dx,$this->y+.5*$h-.5*$this->FontSize,$wlink,$this->FontSize,$link);
            }
        }
        if($s)
            $this->_out($s);
        if($align=='FJ')
        {
            //Remove word spacing
            $this->_out('0 Tw');
            $this->ws=0;
        }
        $this->lasth=$h;
        if($ln>0)
        {
            $this->y+=$h;
            if($ln==1)
                $this->x=$this->lMargin;
        }
        else
            $this->x+=$w;
    }

  }