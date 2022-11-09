<?php
  $dir_destino = "../../../../adm/" . $_POST["ds_caminho"];

  if(isset($_FILES["myfile"]))
  {
    $ret = array();

    $error =$_FILES["myfile"]["error"];
    //You need to handle  both cases
    //If Any browser does not support serializing of multiple files using FormData()
    if(!is_array($_FILES["myfile"]["name"])) //single file
    {
      $nmArquivo = $_POST["nm_arquivo"] . $_FILES["myfile"]["name"];
      move_uploaded_file($_FILES["myfile"]["tmp_name"],$dir_destino.$nmArquivo);
        $ret[]= $nmArquivo;
    }
    else  //Multiple files, file[]
    {
      $fileCount = count($_FILES["myfile"]["name"]);
      for($i=0; $i < $fileCount; $i++)
      {
        $nmArquivo = $_POST["nm_arquivo"] . $_FILES["myfile"]["name"][$i];
      move_uploaded_file($_FILES["myfile"]["tmp_name"][$i],$dir_destino.$nmArquivo);
        $ret[]= $nmArquivo;
      }

    }
      echo json_encode($ret);
   }
 ?>