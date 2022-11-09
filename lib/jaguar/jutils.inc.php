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
885 Quinze de Novembro street, Passo Fundo, RS 99010-100 Brazil

Atua Sistemas de Informação Ltda., hereby disclaims all copyright interest in
the library 'Jaguar' (A PHP framework for IT systems development) written
by it's development team.

Décio Mazzutti, 22 October 2003
*/

/*
 * creation - 
 *
 * 2003-03-27 - decio
 *  nas funções que tem por parâmentro strings é tirado os caracteres especiais que vem do banco
 */
/*
 * function OpenIframe
 * 2006-01-30 - Maicon de Quadros
 *  Created Function that opens an iframe
 */
/**
* Common functions
* @package Jaguar
*/

  function Format_File_Size($size)
  {
    if ($size < 1024)
      return "1 Kb";
    elseif ($size < 1048576)
      return (int)($size / 1024)." Kb";
    else
      return round(($size / 1048576), 1)." Mb";
  }

  function Days_In_Month($month, $year)
  {
    switch ($month)
    {
      case 1:
      case 3:
      case 5:
      case 7:
      case 8:
      case 10:
      case 12:
        $days = 31;
        break;
      case 4:
      case 6:
      case 9:
      case 11:
        $days = 30;
        break;
      case 2:
        if ($year % 4 == 0)
          $days = 29;
        else
          $days = 28;
      break;
    }//switch($month)

    return $days;
  }

  function Days_Between($start, $end, $format = "pt_BR")
  {
    $array  = array("&#34" => "");
    $format = strtr($format, $array);

    if (strstr($start, "/"))
      $delimiter = "/";

    if (strstr($start, "-"))
      $delimiter = "-";

    switch ($format)
    {
      case "us":    // MM/DD/YYYY
        list($s_month, $s_day, $s_year) = explode($delimiter, $start);
        list($e_month, $e_day, $e_year) = explode($delimiter, $end);
        break;
      case "sys":
        list($s_year, $s_month, $s_day) = explode($delimiter, $start);
        list($e_year, $e_month, $e_day) = explode($delimiter, $end);
        break;
      case "pt_BR": // DD/MM/YYYY
      default:
        list($s_day, $s_month, $s_year) = explode($delimiter, $start);
        list($e_day, $e_month, $e_year) = explode($delimiter, $end);
        break;
    }

    $start = mktime (0, 0, 0, (int)$s_month, (int)$s_day, (int)$s_year);
    $end   = mktime (0, 0, 0, (int)$e_month, (int)$e_day, (int)$e_year);

    $ret = ($end - $start)/86400;

    return $ret;
  }
  
  function Alert($msg = "Empty Message!")
  {
    $res  = "<script>\n";
    $res .= "alert('$msg');\n";
    $res .= "</script>\n";

    return $res;
  }

  function Image($img, $alt="", $border=0, $width= false, $height = false)
  {
    if (file_exists($img))
    {
      $size = GetImageSize($img);
      $img = explode("/",$img);

      $out = "<img src=\"". $img[0] ."/". rawurlencode($img[1]) ."\" width=\"";
      $out .= ($width)?$width:$size[0];
      $out .= "\" height=\"";
      $out .= ($height)?$height:$size[1];
      $out .= "\" border=\"$border\" alt=\"$alt\">";
      return $out;
    }
  }

  function Format_Date($date, $format_from = "pt_BR", $format_to = "sys", $sizeYear=4)
  {
    $array       = array("&#34" => "");
    $format_from = strtr($format_from, $array);
    $format_to   = strtr($format_to, $array);

    //test if a date is empty
    //
    if (!$date)
      return false;

    if (strpos($date, "/") !== false)
      $delimiter = "/";
    elseif (strpos($date, "-") !== false)
    {
      $delimiter = "-";
      $format_from = "sys";
    }
    else
      return false;

    //avoid a call such Format_Date($date, "pt_BR", "sys") in case that $date is already in the sys format
    //
    if (($format_from == $format_to))
      return $date;

    switch ($format_from)
    {
      case "us":    // MM/DD/YYYY
        list($month, $day, $year) = explode($delimiter, $date);
        break;
      case "sys":
        list($year, $month, $day) = explode($delimiter, $date);
        break;
      case "pt_BR": // DD/MM/YYYY
      default:
        list($day, $month, $year) = explode($delimiter, $date);
        break;
    }

    $year = substr($year, (-1*$sizeYear));

    switch ($format_to)
    {
      case "us":    // MM/DD/YYYY
        $out = "$month/$day/$year";
        break;
      case "sys":
        $out = "$year-$month-$day";
        break;
      case "pt_BR": // DD/MM/YYYY
      default:
        $out = "$day/$month/$year";
        break;
    }

    return $out;
  }

  /**
   * @param float   $number        A number to be formatted.
   * @param integer $precision     A decimal precision to the number.
   * @param string  $format_from   The input format. Accepted: "pt_BR" | "sys" | "us". Default: "pt_BR".
   * @param string  $format_to     The output format. Accepted: "pt_BR" | "sys" | "us". Default: "sys".
   * @param integer $min_precision A minimal decimal precision to the number. Will trim off de "0"s at the right of the number. Must be lower than the $precision. Default: null.
   * @return string
   */
  function Format_Number($number, $precision, $format_from = "pt_BR", $format_to = "sys", $min_precision = null)
  {
    $array       = array("&#34" => "");
    $format_from = strtr($format_from, $array);
    $format_to   = strtr($format_to, $array);

    if (!strlen($number))
      return "";
    
    switch ($format_from)
    {
      case "us":  
        $number = strtr($number, array("," => "")); 
      break;
      
      case "sys": 
        $number = strtr($number, array("," => "")); 
      break;
      
      case "pt_BR": 
      default:
        $number = strtr($number, array("." => ""));
        $number = strtr($number, array("," => "."));
      break;
    }

    switch ($format_to)
    {
      case "us":
        $number = number_format((float)$number, $precision, ".", ",");
      break;
      
      case "sys":
        $number = number_format((float)$number, $precision, ".", "");
      break;
      
      case "pt_BR":
      default:
        $number = number_format((float)$number, $precision, ",", ".");
      break;
    }
   
    /**
     * Will trim off the "0"s at the right of the number.
     * Sample:
     *   $precision = 4;
     *   $min_precision = 2;
     * 
     *   input: 1,23456, output: 1,2346
     *   input: 1,2345,  output: 1,2345
     *   input: 1,2340,  output: 1,234
     *   input: 1,2300,  output: 1,23
     *   input: 1,2000,  output: 1,20
     */
    if ($min_precision !== null && $min_precision > 0 && $precision > $min_precision)
    {
      $number = substr($number, 0, $min_precision - $precision) .
                rtrim(substr($number, $min_precision - $precision), "0");
    }

    return $number;
  }

  function Format_Cnpj($number, $format_from = "pt_BR", $format_to = "sys")
  {
    $array       = array("&#34" => "");
    $format_from = strtr($format_from, $array);
    $format_to   = strtr($format_to, $array);

    switch ($format_from)
    {
      case "sys":
        break;
      case "pt_BR": // DD/MM/YYYY
      default:
        $number = strtr($number, array("/" => "") );
        $number = strtr($number, array("-" => "") );
        $number = strtr($number, array("." => "") );
        break;
    }

    switch ($format_to)
    {
      case "sys":
        break;
      case "pt_BR": // DD/MM/YYYY
      default:
        $size = strlen($number);
        $number_fmt = "";

        for ($i=0; $i<$size; $i++)
        {
          $number_fmt = substr($number, ($size-$i-1), 1 ) . $number_fmt;

          if (($i==1) && ($size>2))
            $number_fmt = "-" . $number_fmt;

          if (($i==5) && ($size>6))
            $number_fmt = "/" . $number_fmt;

          if (($i==8) && ($size>9))
            $number_fmt = "." . $number_fmt;

          if (($i==11) && ($size>12))
            $number_fmt = "." . $number_fmt;
        }
        for ($i=0; $i<(14-$size) && $size > 0; $i++)
          $number_fmt = "0" . $number_fmt;
        $number = &$number_fmt;
        break;
    }
    
    return $number;
  }

  function Format_Cpf($number, $format_from = "pt_BR", $format_to = "sys")
  {
    $array       = array("&#34" => "");
    $format_from = strtr($format_from, $array);
    $format_to   = strtr($format_to, $array);

    switch ($format_from)
    {
      case "sys":
        break;
      case "pt_BR": // DD/MM/YYYY
      default:
        $number = strtr($number, array("/" => "") );
        $number = strtr($number, array("-" => "") );
        $number = strtr($number, array("." => "") );
        break;
    }

    switch ($format_to)
    {
      case "sys":
        break;
      case "pt_BR": // DD/MM/YYYY
      default:
        $size = strlen($number);
        $number_fmt = "";
        if ($size)
        {
          for ($i=0; $i<$size; $i++)
          {
            $number_fmt = substr($number, ($size-$i-1), 1 ) . $number_fmt;

            if (($i==1) && ($size>2))
              $number_fmt = "/" . $number_fmt;

            if (($i==4) && ($size>5))
              $number_fmt = "." . $number_fmt;

            if (($i==7) && ($size>8))
              $number_fmt = "." . $number_fmt;
          }
          for ($i=0; $i<(11-$size); $i++)
            $number_fmt = "0" . $number_fmt;
        }
        $number = &$number_fmt;
        break;
    }

    return $number;
  }

  function Format_IE($number, $field, $format_from = "pt_BR", $format_to = "sys")
  {
    $arr         = array("&#34" => "");
    $format_from = strtr($format_from, $arr);
    $format_to   = strtr($format_to, $arr);
    unset ($arr);

    $arr = array("/" => "", "-" => "", " " => "");
    
    //uf
    $uf = $GLOBALS[$field];
    if (!strlen($uf) > 0)
      $uf = substr($number, 0, 2);
    
    //from
    switch ($format_from)
    {
      case "sys":
      break;
      
      case "pt_BR":
      default:
        switch ($uf)
        {
          case "RS":
            $number = strtr($number, $arr);
          break;

          case "SC":
          break;

          case "PR":
            $number = strtr($number, $arr);
          break;

          case "SP":
          break;

          case "RJ":
          break;
        }
        
        $number = $uf.$number;

      break;
    }

    unset($arr);
    $arr = [];
    
    //to
    switch ($format_to)
    {
      case "sys":
      break;

      case "pt_BR":
        $number = substr($number, 2); 
        
        //converte a string para array
        for($i = 0; $i < strlen($number); $i++)
          $arr[] = substr($number, $i, 1);

        unset($number);

        switch ($uf)
        {
          case "RS":
            //percorre o array e formata a inscrição
            for ($i = 0; $i < sizeof($arr); $i++)
            {
              if ($i == 3)
                $number .= "/";
              $number .= $arr[$i];
            } 
          break;

          case "SC":
          break;

          case "PR":
            //percorre o array e formata a inscrição
            for ($i = 0; $i < sizeof($arr); $i++)
            {
              if ($i == 8)
                $number .= "-";
              $number .= $arr[$i];
            }
          break;

          case "SP":
          break;

          case "RJ":
          break;
        }
      break;
    }
    
    return $number;
    
  }
  
  function Format_Fone($number, $format_from = "pt_BR", $format_to = "sys")
  {
    $number = trim($number);

    if (strpos($number, "*") !== false) return $number;
    $array       = array("&#34" => "");
    $format_from = strtr($format_from, $array);
    $format_to   = strtr($format_to, $array);

    unset($array);
    $array = $array_tmp = [];

    switch ($format_from)
    {
      case "sys":
      break;
      
      case"pt_BR":
      default:
        $number = strtr($number, array(" " => ""));
        $number = strtr($number, array("(" => ""));
        $number = strtr($number, array(")" => ""));
        $number = strtr($number, array("-" => ""));
      break;
    }

    switch ($format_to)
    {
      case "sys":
      break;

      case "pt_BR":

        for($i=0; $i<strlen($number); $i++)
          $array[] = substr($number, $i, 1);

        unset($number);

        //0800
        if ($array[0] == 0)
        {
          for($i=0; $i<sizeof($array); $i++)
          {
            if ($i == 4)
            {
              $array_tmp[] = "-";
              $array_tmp[] = $array[$i];
            }
            else
              $array_tmp[] = $array[$i];
          }
        }
        else
        {
          switch (sizeof($array))
          {
            case 10:
              $separator = 6;
            break;

            case 11:
            default:
              $separator = 7;
            break;
          }

          for($i=0; $i<sizeof($array); $i++)
          {
            switch ($i)
            {
              case 0:
                $array_tmp[] = "(";
                $array_tmp[] = $array[$i];
              break;

              case 2:
                $array_tmp[] = ")";
                $array_tmp[] = $array[$i];
              break;

              case $separator:
                $array_tmp[] = "-";
                $array_tmp[] = $array[$i];
              break;

              default:
                $array_tmp[] = $array[$i];
              break;
            }
          }
        }
        
        for($i=0; $i<sizeof($array_tmp); $i++)
          $number .= $array_tmp[$i];

      break;
    }

    return $number;
  }

  function Format_Cep($number, $format_from = "pt_BR", $format_to = "sys")
  {
    $array       = array("&#34" => "");
    $format_from = strtr($format_from, $array);
    $format_to   = strtr($format_to, $array);

    switch ($format_from)
    {
      case "sys":
        break;
      case "pt_BR": // DD/MM/YYYY
      default:
        $number = strtr($number, array(" " => "") );
        $number = strtr($number, array("/" => "") );
        $number = strtr($number, array("-" => "") );
        $number = strtr($number, array("." => "") );
        break;
    }

    switch ($format_to)
    {
      case "sys":
        break;
      case "pt_BR": // DD/MM/YYYY
      default:
        $size = strlen($number);
        $number_fmt = "";
        if ($size)
        {
          for ($i=0; $i<$size; $i++)
          {
            $number_fmt = substr($number, ($size-$i-1), 1 ) . $number_fmt;
            if (($i==2) && ($size>3))
              $number_fmt = "-" . $number_fmt;
          }
          for ($i=0; $i<(8-$size); $i++)
            $number_fmt = "0" . $number_fmt;
        }
        $number = &$number_fmt;
        break;
    }

    return $number;
  }

  function Format_Pis($number, $format_from = "pt_BR", $format_to = "sys")
  {
    $array       = array("&#34" => "");
    $format_from = strtr($format_from, $array);
    $format_to   = strtr($format_to, $array);

    switch ($format_from)
    {
      case "sys":
        break;
      case "pt_BR": // DD/MM/YYYY
      default:
        $number = strtr($number, array("-" => "") );
        $number = strtr($number, array("." => "") );
        break;
    }

    switch ($format_to)
    {
      case "sys":
        break;
      case "pt_BR": // DD/MM/YYYY
      default:
        $size = strlen($number);
        $number_fmt = "";

        for ($i=0; $i<$size; $i++)
        {
          $number_fmt = substr($number, ($size-$i-1), 1 ) . $number_fmt;

          if (($i==0) && ($size>1))
            $number_fmt = "-" . $number_fmt;

          if (($i==2) && ($size>3))
            $number_fmt = "." . $number_fmt;

          if (($i==7) && ($size>8))
            $number_fmt = "." . $number_fmt;
        }
        for ($i=0; $i<(11-$size) && $size > 0; $i++)
          $number_fmt = "0" . $number_fmt;
        $number = &$number_fmt;
        break;
    }

    return $number;
  }

  function Format_Modulo11($number, $format_from = "pt_BR", $format_to = "sys")
  {
    $array       = array("&#34" => "");
    $format_from = strtr($format_from, $array);
    $format_to   = strtr($format_to, $array);

    switch ($format_from)
    {
      case "sys":
        break;
      case "pt_BR": // DD/MM/YYYY
      default:
        $number = strtr($number, array("-" => "") );
        break;
    }

    switch ($format_to)
    {
      case "sys":
        break;
      case "pt_BR": // DD/MM/YYYY
      default:
        $size = strlen($number);
        $number_fmt = "";

        for ($i=0; $i<$size; $i++)
        {
          $number_fmt = substr($number, ($size-$i-1), 1 ) . $number_fmt;

          if (($i==0) && ($size>1))
            $number_fmt = "-" . $number_fmt;
        }
        for ($i=0; $i<(6-$size) && $size > 0; $i++)
          $number_fmt = "0" . $number_fmt;
        $number = &$number_fmt;
        break;
    }

    return $number;
  }

  //converte um tempo xx:xx:xx para horas
  function retorna_horas($val)
  {
    $dias = 0;

    if (strpos($val, "d"))
    {
      $dias = substr($val, 0, strpos($val, "d"));

      if ($dias > 1)
        $posicao = strpos($val, "s") + 1;
      else
        $posicao = strpos($val, "y") + 1;
    }
    else
      $posicao = 0;

    $resto  = substr($val, $posicao, 9);
    $resto  = explode(":", $resto);
    
    $total_horas = 0;
    $total_horas = $dias * 24;

    //horas
    if (strlen($resto[0]) > 0)
      $total_horas += $resto[0];

    //minutos
    if (strlen($resto[1]) > 0)
      $total_horas += $resto[1] / 60;

    //segundos
    if (strlen($resto[2]) > 0)
      $total_horas += $resto[2] / 3600;

    return round($total_horas, 2);

  }

  function Convert_String($str, $to = "upper")
  {
    $arr_lower = array('ç',
                       'â','ã','á','à','ä',
                       'é','è','ê','ë',
                       'í','ì','î','ï',
                       'ó','ò','ô','õ','ö',
                       'ú','ù','û','ü');

    $arr_upper = array('Ç',
                       'Â','Ã','Á','À','Ä',
                       'É','È','Ê','Ë',
                       'Í','Ì','Î','Ï',
                       'Ó','Ò','Ô','Õ','Ö',
                       'Ú','Ù','Û','Ü');

    switch ($to)
    {
      case "lower":
        $str = strtolower($str);

        for ($i = 0; $i < count($arr_lower); $i++)
          $str = str_replace($arr_upper[$i], $arr_lower[$i], $str);
      break;

      default:
      case "upper":
        $str = strtoupper($str);

        for ($i = 0; $i < count($arr_lower); $i++)
          $str = str_replace($arr_lower[$i], $arr_upper[$i], $str);
      break;
    }
  
    return $str;

  }
  
  function ascii($str)
  {
    $nrAscii = ord($str);

    // de "espaço" até "~"
    if ($nrAscii >= 32 && $nrAscii <= 126) return true;
    // caracter "§"
    if (chr($nrAscii) == "§") return true;
    // caracter "\n"
    if ($nrAscii == 10) return true;

    return false;
  }

  function Clear_Filename($str)
  {
    return preg_replace("/[^0-9a-z_\.]/i", "", ucwords(Clear_String(str_replace("_", " ", $str), 1, "lower")));
  }

  function Clear_String($str, $specialcharacter=1, $to="upper", $trim="all")
  {
    if ($specialcharacter)
    {
      $trans = array( "Á" => "A", "Ã" => "A", "À" => "A", "Â" => "A", "Ä" => "A",
                      "É" => "E", "È" => "E", "Ê" => "E", "Ë" => "E",
                      "Í" => "I", "Ì" => "I", "Î" => "I", "Ï" => "I",
                      "Ó" => "O", "Õ" => "O", "Ò" => "O", "Ô" => "O", "Ö" => "O",
                      "Ú" => "U", "Ù" => "U", "Û" => "U", "Ü" => "U",
                      "Ç" => "C", "Ñ" => "N", "Ý" => "Y",
                      "á" => "a", "ã" => "a", "à" => "a", "â" => "a", "ä" => "a",
                      "é" => "e", "è" => "e", "ê" => "e", "ë" => "e",
                      "í" => "i", "ì" => "i", "î" => "i", "ï" => "i",
                      "ó" => "o", "õ" => "o", "ò" => "o", "ô" => "o", "ö" => "o",
                      "ú" => "u", "ù" => "u", "û" => "u", "ü" => "u",
                      "ç" => "c", "ñ" => "n", "ý" => "y", "ÿ" => "y",
                      "Ã§" => "c", "'" => "\'", "\\" => "\\\\", "\"" => "\\\"");

      $str = implode("", array_filter(str_split(strtr($str, $trans)), "ascii"));
    }

    switch ($to)
    {
      case "upper" : $str = Convert_String($str, "upper"); break;
      case "lower" : $str = Convert_String($str, "lower"); break;
    }

    if (strlen($trim))
    {
      switch ($trim)
      {
        case "left"  : $str = ltrim($str); break;
        case "right" : $str = rtrim($str); break;
        case "all"   : $str = trim($str);  break;
      }
    }

    return $str;
  }

  function Format_Economia($number, $format_from = "pt_BR", $format_to = "sys")
  {
    $array       = array("&#34" => "");
    $format_from = strtr($format_from, $array);
    $format_to   = strtr($format_to, $array);

    switch ($format_from)
    {
      case "sys":
        break;
      case "pt_BR": // DD/MM/YYYY
      default:
        $number = strtr($number, array("-" => "") );
        $number = strtr($number, array("." => "") );
        break;
    }

    switch ($format_to)
    {
      case "sys":
        break;
      case "pt_BR": // DD/MM/YYYY
      default:
        $size = strlen($number);
        $number_fmt = "";

        for ($i=0; $i<$size; $i++)
        {

          $number_fmt = substr($number, ($size-$i-1), 1 ) . $number_fmt;

          if ($i==0)
            $number_fmt = "-" . $number_fmt;

          if ($i==3)
            $number_fmt = "." . $number_fmt;

          if ($i==6)
            $number_fmt = "." . $number_fmt;

          if ($i==10)
            $number_fmt = "." . $number_fmt;

        }
        
        for ($i=0; $i<(13-$size) && $size > 0; $i++)
          $number_fmt = "0" . $number_fmt;

        $number = &$number_fmt;
        break;
    }

    return $number;
  }

  function Format_Processo($number, $format_from = "pt_BR", $format_to = "sys")
  {
    $array       = array("&#34" => "");
    $format_from = strtr($format_from, $array);
    $format_to   = strtr($format_to, $array);

    switch ($format_from)
    {
      case "sys":
        break;
      case "pt_BR": // DD/MM/YYYY
      default:
        $number = strtr($number, array("-" => "") );
        $number = strtr($number, array("/" => "") );
        break;
    }

    switch ($format_to)
    {
      case "sys":
        break;
      case "pt_BR": // DD/MM/YYYY
      default:
        $size = strlen($number);
        $number_fmt = "";

        for ($i=0; $i<$size; $i++)
        {
          $number_fmt = substr($number, ($size-$i-1), 1 ) . $number_fmt;

          if ($i==10)
            $number_fmt = "-" . $number_fmt;

          if ($i==5)
            $number_fmt = "/" . $number_fmt;
        }

        for ($i=0; $i<(10-$size) && $size > 0; $i++)
          $number_fmt = "0" . $number_fmt;

        $number = &$number_fmt;

        break;
    }

    return $number;
  }

  /**
  * Returns an Iframe with a specified file
  * @param string $name Name of the iFrame
  * @param string $link Source of file that will be opened on the iFrame
  * @param array  $properties Proprieties of iFrame. Ex.: array("frameborder" => "no", "scrolling" => "yes")
  * @returns string that is a iFrame HTML tag.
  */
  function OpenIframe($name = false, $link = false, $properties = false)
  {
    //Known Properties of IFrame
    $known_properties = array("align", "frameborder", "height", "longdesc", 
                              "marginheight", "marginwidth", "name", "scrolling", "src", "width");
    
    //Default Values for IFrame Properties
    $value_properties = array("align"        => "null_value", 
                              "frameborder"  => "\"no\"", 
                              "height"       => "\"100%\"", 
                              "longdesc"     => "null_value", 
                              "marginheight" => "null_value", 
                              "marginwidth"  => "null_value", 
                              "name"         => "\"iframe\"", 
                              "scrolling"    => "null_value", 
                              "src"          => "null_value", 
                              "width"        => "\"100%\"");
    
    //Test if $properties not received some property value
    //else it attributes default value to null property values
    if (!is_array($properties))
      $properties = $value_properties;
    else
    {
      foreach($value_properties as $key => $value)
      {
        if(!strlen($properties[$key]))
          $properties[$key] = "$value";
        else
          $properties[$key] = "\"$properties[$key]\"";
      }
    }
    
    
    if (strlen($name))
      $properties["name"] = "\"$name\"";
    else
      $name = "iframe";
    
    if (strlen($link))
      $properties["src"] = "\"$link\"";
    
    if (is_array($properties))
    {
      foreach($properties as $key => $value)
      {
        if (in_array(strtolower($key), $known_properties))
        {
          if ($value != "null_value")
            $merged_properties .= "$key=$value ";
        }
          
      }
    }
    $iframe = "<iframe $merged_properties>$name</iframe>";
    return $iframe;
  }

  function Format_Viagem($number, $format_from = "pt_BR", $format_to = "sys")
  {
    switch ($format_from)
    {
      case "sys":
        break;
      case "pt_BR": // DD/MM/YYYY
      default:
        $number = strtr($number, array("/" => "") );
        break;
    }

    switch ($format_to)
    {
      case "sys":
        break;
      case "pt_BR": // DD/MM/YYYY
      default:
        $size = strlen($number);
        $number_fmt = "";
        if ($size)
        {
          for ($i = 0; $i < $size; $i++)
          {
            $number_fmt .= substr($number, $i, 1);
            if ($i == 1)
              $number_fmt .= "/";
          }
        }
        $number = &$number_fmt;
        break;
    }

    return $number;
  }

  function Format_Placa($number, $format_from = "pt_BR", $format_to = "sys")
  {
    switch ($format_from)
    {
      case "sys":
        break;
      case "pt_BR": // DD/MM/YYYY
      default:
        $number = strtr($number, array("-" => "") );
        break;
    }

    switch ($format_to)
    {
      case "sys":
        break;
      case "pt_BR": // DD/MM/YYYY
      default:
        $size = strlen($number);
        $number_fmt = "";
        if ($size)
        {
          for ($i = 0; $i < $size; $i++)
          {
            $number_fmt .= substr($number, $i, 1);
            if ($i == 2)
              $number_fmt .= "-";
          }
        }
        $number = &$number_fmt;
        break;
    }

    return strtoupper($number);
  }

  //Get the difference between two paths
  function GetLocationDifference($path1, $path2 = false )
  {
    //if path 2 wasn't passed it assumes that the comparison must be done with the actual url
    //
    if (!$path2)
      $path2 = realpath( dirname($_SERVER["SCRIPT_FILENAME"]) )."/";

    //init variables
    //
    $pathBehind  = "";
    $pathForward = "";

    $i = 0;
    $flag = false;

    //start from the largest string 
    //
    $size = strlen($path1) > strlen($path2) ? strlen($path1) : strlen($path2);

    for ($j = $size ; $i < $j; $i++)
    {
      if ($flag)
      {
        $pathBehind .= $path2[$i];    //will get a path like ../../some/path/
        $pathForward .= $path1[$i]; //will get a path like /lib/jaguar which is forward in the file url level 
      }
      else
      {
        if ($path1[$i] != $path2[$i]) //stop when find a different character in the url
        {
          $flag = true; //from here there is a different path
          $i--;
        }
      }
    }

    if ($pathBehind)
    {
      $behind = "";
      for ($i=0, $j=sizeof( explode("/", $pathBehind) ) -1 ; $i < $j; $i++)
        $behind .= "../";

      return $behind.$pathForward;
    }

    return $pathForward;
  }

  /**
   * Get de mime-type of a file
   * Obtém o mime-type de um arquivo
   * 
   * @return string
   */
  function GetMimeType($file)
  {
    $mime = "";

    if (function_exists("finfo_file"))
    {
      $finfo = finfo_open(FILEINFO_MIME_TYPE);
      $mime = finfo_file($finfo, $file);
      finfo_close($finfo);
    }
    elseif (function_exists("mime_content_type"))
      $mime = mime_content_type($file);
    elseif (!stristr(ini_get("disable_functions"), "shell_exec"))
    {
      $mime = shell_exec("file -bi " . escapeshellarg($file));

      if (strpos($mime, ";") !== false)
        $mime = substr($mime, 0, strpos($mime, ";"));
    }

    return strtolower($mime);
  }

 /**
  * retorna true se for um valor valido.
  * utilizado para verificar campos enviados por formulários
  * 
  * @return boolean
  */
  function str_value($value)
  {
    return ($value !== '' && $value !== null && $value !== false);
  }
  
  /**
   * Recebe varios parametros e retorna o primeiro valido, caso contrario null
   * 
   * @return mixed|null
   */
  function ifnull()
  {
    if (!func_num_args()) return null;

    $args = func_get_args();

    foreach ($args as $value)
    {
      if ((!is_object($value) && !is_array($value)) && strtoupper($value) === "NULL") continue;
      
      if (str_value($value)) return $value;
    }

    return null;
  }

  /**
   * Recebe varios parametros e retorna o primeiro valido, caso contrario null
   * Aceita "NULL" como string para ser utilizado em SQLs
   * 
   * @return mixed|null
   */
  function ifnullsql()
  {
    if (!func_num_args()) return null;

    $args = func_get_args();

    foreach ($args as $value)
      if (str_value($value)) return $value;

    return null;
	}

  function toIso(&$dados)
  {
    if (is_array($dados) || is_object($dados))
      array_walk_recursive(
        $dados,
        function (&$elem)
        {
          toIso($elem);
        }
      );

    if (is_string($dados) && mb_detect_encoding($dados, 'UTF-8', true) !== false)
      $dados = utf8_decode($dados);

    return $dados;
  }

  function toUtf8(&$retorno)
  {
    if (is_array($retorno) || is_object($retorno))
    {
      array_walk_recursive(
        $retorno,
        function (&$elem)
        {
          toUtf8($elem);
        }
      );
    }
    elseif ((is_string($retorno) && (mb_detect_encoding($retorno, 'UTF-8', true) === false)) || (!is_bool($retorno) && !str_value($retorno)))
      $retorno = utf8_encode($retorno);

    return $retorno;
  }

  /**
   * @param $json
   * @param bool $assoc
   * @return mixed
   */
  function jsonDecode($json, $assoc=true)
  {
    toUtf8($json);
    $retorno = json_decode($json, $assoc);
    toIso($retorno);

    return $retorno;
  }

  /**
   * @param mixed $dados
   * @return string
   */
  function jsonEncode($dados)
  {
    toUtf8($dados);
    return json_encode($dados);
  }