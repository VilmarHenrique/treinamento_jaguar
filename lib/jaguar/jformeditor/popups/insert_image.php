<?
  require_once("../../jaguar.inc.php");
?>
<html style="width: 398; height: 218">
<head>
  <title>Inserir Imagem</title>

<script type="text/javascript" src="popup.js"></script>

<script type="text/javascript">
var preview_window = null;

function Init() {
  __dlg_init();
  document.getElementById("f_url").focus();
};

function onOK() {
  var required = {
    "f_url": "Informe a URL",
  };
  for (var i in required) {
    var el = document.getElementById(i);
    if (!el.value) {
      alert(required[i]);
      el.focus();
      return false;
    }
  }
  // pass data back to the calling window
  var fields = ["f_url", "f_alt", "f_align", "f_border",
                "f_horiz", "f_vert"];
  var param = new Object();
  for (var i in fields) {
    var id = fields[i];
    var el = document.getElementById(id);
    if(i==0)
      param[id] = '<?=$absolute_image_path?>' + el.value;
    else
      param[id] = el.value;
  }
  if (preview_window) {
    preview_window.close();
  }
  __dlg_close(param);
  return false;
};

function onCancel() {
  if (preview_window) {
    preview_window.close();
  }
  __dlg_close(null);
  return false;
};

function onPreview() {
//  alert("FIXME: preview needs rewritten:\n  show the image inside this window instead of opening a new one.");
  var f_url = document.getElementById("f_url");
  var url = f_url.value;
  if (!url) {
    alert("Informe primeiro a URL");
    f_url.focus();
    return false;
  }
  var img = new Image();
  img.src = url;
  var win = null;
  if (!document.all) {
    win = window.open(url, "ha_imgpreview", "toolbar=no,menubar=no,personalbar=no,innerWidth=800,innerHeight=600,scrollbars=no,resizable=yes");
  } else {
    win = window.open(url, "ha_imgpreview", "channelmode=no,directories=no,height=600,width=800,location=no,menubar=no,resizable=yes,scrollbars=no,toolbar=no");
  }
  preview_window = win;
  var doc = win.document;
  var body = doc.body;
  if (body) {
    body.innerHTML = "";
    body.style.padding = "0px";
    body.style.margin = "0px";
    var el = doc.createElement("img");
    el.src = '<?=$absolute_image_path?>' + url;
    var table = doc.createElement("table");
    body.appendChild(table);
    table.style.width = "100%";
    table.style.height = "100%";
    var tbody = doc.createElement("tbody");
    table.appendChild(tbody);
    var tr = doc.createElement("tr");
    tbody.appendChild(tr);
    var td = doc.createElement("td");
    tr.appendChild(td);
    td.style.textAlign = "center";

    td.appendChild(el);
    win.resizeTo(el.offsetWidth + 30, el.offsetHeight + 30);
  }
  win.focus();
  return false;
};
</script>

<style type="text/css">
html, body {
  background: ButtonFace;
  color: ButtonText;
  font: 11px Tahoma,Verdana,sans-serif;
  margin: 0px;
  padding: 0px;
}
body { padding: 5px; }
table {
  font: 11px Tahoma,Verdana,sans-serif;
}
form p {
  margin-top: 5px;
  margin-bottom: 5px;
}
.fl { width: 9em; float: left; padding: 2px 5px; text-align: right; }
.fr { width: 6em; float: left; padding: 2px 5px; text-align: right; }
fieldset { padding: 0px 10px 5px 5px; }
select, input, button { font: 11px Tahoma,Verdana,sans-serif; }
button { width: 70px; }
.space { padding: 2px; }

.title { background: #ddf; color: #000; font-weight: bold; font-size: 120%; padding: 3px 10px; margin-bottom: 10px;
border-bottom: 1px solid black; letter-spacing: 2px;
}
form { padding: 0px; margin: 0px; }
</style>

</head>

<body onload="Init()">

<div class="title">Inserir Imagem</div>
<form action="" method="get">
<table border="0" width="100%" style="padding: 0px; margin: 0px">
  <tbody>
  <tr>
    <td style="width: 7em; text-align: right">URL:</td>
    <td><input type="text" name="url" id="f_url" style="width:75%"
      title="Enter the image URL here" value="<?= $_GET["f_t_ds_url"] ?>"/>
      <button name="preview" onclick="return onPreview();"
      title="Visualiza a imagem em uma nova janela">Visualizar</button>
    </td>
  </tr>
  <tr>
    <td style="width: 7em; text-align: right">Texto Alternativo:</td>
    <td><input type="text" name="alt" id="f_alt" style="width:100%"
      title="Para browsers que não suportam imagem" /></td>
  </tr>

  </tbody>
</table>

<p />

<fieldset style="float: left; margin-left: 5px;">
<legend>Layout</legend>

<div class="space"></div>

<div class="fl">Alinhamento:</div>
<select size="1" name="align" id="f_align"
  title="Posicionamento da imagem">
  <option value=""                             >Não Ajustar</option>
  <option value="left"                         >Á Esquerda</option>
  <option value="right"                        >À Direta</option>
  <option value="texttop"                      >Acima do Texto</option>
  <option value="absmiddle"                    >No centro</option>
  <option value="baseline" selected="1"        >Linha de Base</option>
  <option value="absbottom"                    >O mais baixo</option>
  <option value="bottom"                       >Inferior</option>
  <option value="middle"                       >No Centro</option>
  <option value="top"                          >Topo</option>
</select>

<p />

<div class="fl">Densidade da borda:</div>
<input type="text" name="border" id="f_border" size="5"
title="Leave empty for no border" />

<div class="space"></div>

</fieldset>

<fieldset style="float:right; margin-right: 5px;">
<legend>Espaçamento</legend>

<div class="space"></div>

<div class="fr">Horizontal:</div>
<input type="text" name="horiz" id="f_horiz" size="5"
title="Preenchimento Horizontal" />

<p />

<div class="fr">Vertical:</div>
<input type="text" name="vert" id="f_vert" size="5"
title="Preenchimento Vertical" />

<div class="space"></div>

</fieldset>

<div style="margin-top: 85px; text-align: right;">
<hr />
<button type="button" name="ok" onclick="return onOK();">Confirma</button>
<button type="button" name="cancel" onclick="return onCancel();">Cancelar</button>
</div>

</form>

</body>
</html>
