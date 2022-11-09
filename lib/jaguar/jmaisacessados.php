<?php
  global $conn;

  // Não irá ser incluído no IE
  if ($_SESSION['s_cd_usuario'] && 
      substr(basename($_SERVER["PHP_SELF"]), 0, 3) != "ifr" &&
      basename($_SERVER["PHP_SELF"]) != "menu.php" && 
      basename($_SERVER["PHP_SELF"]) != "sistema.php" && 
      basename($_SERVER["PHP_SELF"]) != "login.php" && 
      basename($_SERVER["PHP_SELF"]) != "index.php" && 
      basename($_SERVER["PHP_SELF"]) != "topo.php" && 
      basename($_SERVER["PHP_SELF"]) != "exe_email_suporte.php" && 
      $this->showBreadcrumbs &&
      !($_REQUEST["f_popup"] || $_REQUEST["use_popup"]) && 
      !strpos($_SERVER["HTTP_USER_AGENT"], "MSIE") && 
      $conn->TableExists("mais_acessados"))
  {
    $mais_acessados = new JTable();
    $mais_acessados->mUseJaguarJavaScript = false;
    $mais_acessados->mUseJaguarStyleSheet = false;
    $mais_acessados->SetWidth("auto");
    
    $auth_apontamento = new JDBAuth($conn, $_SESSION['s_cd_usuario'], "man_apontamento.php");
    
    if ($auth_apontamento->CanSelect())
    {
      $mais_acessados->OpenRow("", array("valign" => "middle"));
      $html_cell  = "<img src='".URL."img/apontamentos.png' style='margin-bottom:-5px; align:left; border:0px;' width=16/>\n";
      $html_cell .= "<span style='vertical-align: middle; font-size: 14px; height:18px'>&nbsp;&nbsp;Apontamentos</span>\n";

      $mais_acessados->OpenCell($html_cell, array(  "style" => "cursor: pointer; vertical-align:middle; height:16px;", 
                                                  "onClick" => "abre_pop_apontamentos('man_apontamento.php', false);",
                                                    "align" => "left",
                                                   "valign" => "middle"));
    }

    $sql =
      "SELECT 0 AS id_tipo, ds_menu, nm_arquivo, qt_acessos, 0 AS nr_ordem 
        FROM (SELECT f.ds_menu, f.nm_arquivo, ma.qt_acessos 
                FROM mais_acessados ma
                JOIN funcao f USING (nm_funcao)
               WHERE ma.cd_pessoa = " . $_SESSION['s_cd_usuario'] ."
                 AND f.ds_menu IS NOT NULL
               ORDER BY 3 DESC 
               LIMIT 5 ) AS t ";

    $auth_preferencia = new JDBAuth($conn, $_SESSION['s_cd_usuario'], "sel_usuario_funcao_preferencia.php");
    if ($auth_preferencia->CanSelect())
    {
      $sql .= "       
        UNION ALL 
        
        SELECT 1 AS id_tipo, f.ds_menu, f.nm_arquivo, 0 AS qt_acessos, ufp.nr_ordem 
         FROM usuario_funcao_preferencia ufp
         JOIN funcao f ON f.cd_funcao = ufp.cd_funcao 
        WHERE ufp.cd_pessoa = '" . $_SESSION['s_cd_usuario'] . "' 
          AND f.ds_menu IS NOT NULL 
        ORDER BY 1, qt_acessos DESC, nr_ordem, 2";
    }
    
    if (!$rs = $conn->Select($sql))
      $this->AddObject($this->mConn->GetError());
    else
    {
      if ($rs->GetRowCount())
      {
        $id_tipo = null;
        $old_id_tipo = null;
        
        while (!$rs->IsEof())
        {
          $id_tipo = $rs->GetField("id_tipo");
          
          if ($id_tipo != $old_id_tipo)
          {
            if ($id_tipo == 0)
            {
              $mais_acessados->OpenRow();
              $mais_acessados->OpenHeader("<b>Mais Acessados</b>");
              $img = "glyphicon glyphicon-time";
            }
            else
            {
              $mais_acessados->OpenRow();
              $lnk_preferencia = "<b><a href=\"sel_usuario_funcao_preferencia.php\">Minhas Preferências</a></b>";
              $mais_acessados->OpenHeader($lnk_preferencia);
              $img = "glyphicon glyphicon-star";
            }
          }
          
          $mais_acessados->OpenRow();
          $link = $rs->GetField("nm_arquivo");

          $mais_acessados->OpenCell("<span class='$img'></span>
                                     <span style='vertical-align: middle; font-size: 14px;'>" .
                                      $rs->GetField("ds_menu") . "</span>" , array("style" => "cursor: pointer; vertical-align:middle; height:16px;",
                                                                                   "onClick" => "window.open('$link');"));
          $rs->Next();
          $old_id_tipo = $id_tipo;
        }

        $out .= "
        <script language=\"javascript\" type=\"text/javascript\">
          function abre_pop_apontamentos(endereco, hideclose)
          {
            option = {
                      width: window.innerWidth * 0.9, 
                      height: window.innerHeight * 0.9,
                      modal: true,
                      autoOpen: false,
                      draggable: false,
                      resizable: false,
                      closeOnEscape: false,
                      closeText: 'hide'
                      };

            $('#pop_dialog_apontamentos').dialog(option);
            $('#pop_dialog_apontamentos').dialog({
              title: '&nbsp;',
              open: function(event, ui) {
                $('#iframe_apontamentos').attr('src', endereco);

                if (hideclose)
                {
                  $('.ui-dialog-titlebar-close').remove();
                  $('#close_pop_apontamentos').remove();
                }
              }
            });
            $('#pop_dialog_apontamentos').dialog('open');
          }

          function close_pop_apontamentos()
          {
            $('#pop_dialog_apontamentos').dialog('close');
          }
        </script>

        <div id=\"pop_dialog_apontamentos\" style=\"display:none;\"><table width=\"100%\" height=\"100%\">
        <tr><td colspan=\"3\">&nbsp;</td></tr>
        <tr width=\"100%\" height=\"100%\"><td>&nbsp;&nbsp;&nbsp;</td><td align=\"center\"><iframe id=\"iframe_apontamentos\" width=100% height=100% frameborder=\"no\" src=\"\" ></iframe></td><td>&nbsp;&nbsp;&nbsp;</td></tr>
        <tr><td colspan=\"3\">&nbsp;</td></tr>
        <tr><td colspan=\"3\" align=\"center\">&nbsp;<a id=\"close_pop_apontamentos\" href=\"javascript:void(0);\" onClick=\"close_pop_apontamentos()\">Fechar</a>&nbsp;</td>
        </table></div>
        ";
        
        $out .= "
         <script>
          $(document).ready(function(){
          
            if ($('#mais_acessados').is('div') || $('#mais_acessados', parent.document).is('div') )
              return false;
            
            $(document).click(function(event){
              if ($(event.target).attr('id') != 'action_mais_acessados' && $('#mais_acessados').is(':visible'))
                $('#mais_acessados').hide();
            });
            
            $('html').append('<div id=\'mais_acessados\' style=\'border:0px; overflow:auto; width:auto; max-height:80%; margin-left: 5px; background-color:white; border-radius:2px; box-shadow: grey 0px 1px 10px; display:block; top:40px; position:fixed; float:left;\' >'+'" . str_replace("\n","", str_replace("'", "\'", $mais_acessados->GetHtml())) . "'+'</div>');
            $('html').append('<a href=\'javascript:void(0)\' style=\'margin-left:5px; display:block; position:fixed; float:left; top:1px;\' ><img id=\'action_mais_acessados\' src=\'".URL."img/favoritos_g.png\' style=\'border:0px; margin-bottom:-5px;\' width=40/></a>');
            $('#mais_acessados').hide();
            $('#action_mais_acessados').click(function(){
              if ($('#mais_acessados').is(':visible'))
                $('#mais_acessados').hide();
              else 
                $('#mais_acessados').show();
            });
          });
        </script>";
      }
    }
  }
?>
