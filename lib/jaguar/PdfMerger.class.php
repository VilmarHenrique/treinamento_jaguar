<?php

  class PdfMerger extends \iio\libmergepdf\Merger
  {
    public function Output($filename = "newpdf.pdf", $mode = "I")
    {
      if ($mode == "I")
      {
        if(PHP_SAPI!='cli')
        {
          // We send to a browser
          header('Content-Type: application/pdf');
          header('Content-Disposition: inline; filename="'.$filename.'"');
          header('Cache-Control: private, max-age=0, must-revalidate');
          header('Pragma: public');
        }
        echo $this->merge();
        die;
      }

      /* testei e acho que esta com problemas :/, tem que rever os headers */
      if ($mode == "D")
      {
        //Download file
        header('Content-Type: application/x-download');
        header('Content-Disposition: attachment; filename="'.$filename.'"');
        header('Cache-Control: private, max-age=0, must-revalidate');
        header('Pragma: public');
        echo $this->merge();
        die;
      }

      if ($mode == "F")
      {
        file_put_contents($filename, $this->merge());
        return;//void
      }

      if ($mode == "S")
        return $this->merge();

      die("Modo para o Output inválido");
    }

    public function addRaw($pdf, \iio\libmergepdf\Pages $pages = null)
    {
      parent::addRaw(@file_get_contents($pdf), $pages);
    }
  }