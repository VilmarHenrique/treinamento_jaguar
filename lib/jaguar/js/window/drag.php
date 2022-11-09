<?php
session_start();
// require sajax
require_once("../../Sajax.php");

// enable the use of jwindow to other applications
function enableJWindow($enable)
{
  unset($_SESSION["s_show_jwindow"]);
  return true;
}

sajax_init();
$sajax_debug_mode = 0;
sajax_export("enableJWindow");
sajax_handle_client_request();
sajax_show_javascript();
?>

/******************************

Draggable Window: JS+CSS

JS designed by
Rogério Alencar Lino Filho
email: rogeriolino@gmail.com
http://rogeriolino.wordpress.com/

******************************/
var x, y, offsetX, offsetY;
var id = "window";
var drag = false;
var mini = false;
var offset = false;

//
//addStyle
var style = document.createElement("link");
style.setAttribute("rel", "stylesheet");
style.setAttribute("type", "text/css");
style.setAttribute("href", "style.css");
document.getElementsByTagName("head").item(0).appendChild(style);
//
function selecao(target, act){
	if (!act) {
		if (typeof target.onselectstart != "undefined") //IE route
			target.onselectstart = function() { return false; }
		else if (typeof target.style.MozUserSelect != "undefined") //Firefox route
			target.style.MozUserSelect = "none";
		else //All other route (ie: Opera)
			target.onmousedown = function() { return false; }
	} else {
		if (typeof target.onselectstart != "undefined") //IE route
			target.onselectstart = function() { return true; }
		else if (typeof target.style.MozUserSelect != "undefined") //Firefox route
			target.style.MozUserSelect = "none";
		else //All other route (ie: Opera)
			target.onmousedown = function() { return true; }
	}
}
//
function findPos() {
	var left = 0;
	var top = 0;
  var obj;

  if (! (obj = document.getElementById(id)) )
    return;

	if (obj.offsetParent) {
		left = obj.offsetLeft;
		top = obj.offsetTop;
		while (obj = obj.offsetParent) {
			left += obj.offsetLeft;
			top += obj.offsetTop;
		}
	}
	offsetX = left;
	offsetY = top;
}
//
function pos(event) {
  
  var alvo;

	if (document.all) {
		x = window.event.clientX;
		y = window.event.clientY;
	} else {
		x = event.pageX;
		y = event.pageY;
	}
	if (!offset) {
		findPos();
		offsetX = x - offsetX;
		offsetY = y - offsetY;
	}

	if (id)
    if ( !(alvo = document.getElementById(id)) )
      return;
	
	var body = document.getElementsByTagName("body").item(0);
	if (drag) {
		alvo.style.top = (y-offsetY)+"px";
		alvo.style.left = (x-offsetX)+"px";
		alvo.style.cursor = "move";
		alvo.style.opacity = 0.7;
		alvo.style.filter = "alpha(opacity=70)";
		//selecao(body, false);
	} else {
		alvo.style.cursor = "default";
		alvo.style.opacity = 1;
		alvo.style.filter = "alpha(opacity=100)";
		//selecao(body, true);
	}
}
//
function startDrag() { drag = true; offset = true; }
function stopDrag() { drag = false; offset = false; }
//
function toClose()
{
document.getElementById(id).style.visibility = "hidden";
}

// funcão para retorno do resultado da função em php
function finishEnable( done )
{
  if ( done )
    toClose();
  else
    alert('erro ao terminar janela!');
}

//call the php function enableJWindow
function toCloseInThisSession()
{
  x_enableJWindow(false, finishEnable);
}


function toOpen() {
document.getElementById(id).style.visibility = "visible";
hide();
}
//
function minimax() {
	var obj = document.getElementById("content");
	var btn = document.getElementById("minimax");
	if (!mini) {
		obj.style.display = "none";
		btn.innerHTML = "+";
		btn.setAttribute("title", "Maximizar");

    var obj = document.getElementById(id);

    if (!obj.defaultWidth) obj.defaultWidth = obj.style.width;

		document.getElementById(id).style.width = obj.defaultWidth;
		mini = true;
	}
  else
  {
		obj.style.display = "block";
		btn.innerHTML = "-";
		btn.setAttribute("title", "Minimizar");
//		document.getElementById("statusbar").style.display = "block";
		mini = false;
	}
}
//
function hide() {
	if (!mini) 
		minimax();

	document.getElementById(id).style.top = 0;
//	document.getElementById(id).style.left = 0;
	document.getElementById(id).style.left = "75%";
//	document.getElementById("statusbar").style.display = "none";
}
//
document.onmousemove = function(event) { pos(event); }
//
