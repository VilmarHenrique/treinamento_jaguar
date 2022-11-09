function LI(id)
{
  document.adiciona_texto.elements[id].value += ("<LI>\n")
}

function E(id)
{
  document.adiciona_texto.elements[id].value += ("&nbsp;\n")
}

function B(id)
{
  var B = window.prompt("Digite o texto em negrito:","")
  if(B != null)
	document.adiciona_texto.elements[id].value += ("<B>" + B + "</B>\n")
 }

function I(id)
{
  var I = window.prompt("Digite o texto em itálico:","")
  if(I != null)
	document.adiciona_texto.elements[id].value += ("<I>" + I + "</I>\n")
}

function DD(id)
{
  if (id!="")
    document.adiciona_texto.elements[id].value += ("<DD>");
}

function P(id)
{
	document.adiciona_texto.elements[id].value += ("<br><img src=\"imagens/transp.gif\" border=0 alt='' width=100 height=10><BR>");
}

function BR(id)
{
  if (id!="")
    document.adiciona_texto.elements[id].value += ("<BR>\n");
}

function IMG(id,fig)
{
  document.adiciona_texto.elements[id].value += ("<IMG SRC=\"http://www.politicaparapoliticos.com.br/imagens/" + fig + "\" align='left' height='' width=''>");
}

function LINK(id)
{
  var PLACE = window.prompt("Entre o endereco:","")
  if(PLACE !=null)
	var LINK = window.prompt("Entre o nome do link:","")
  if(LINK !=null)
	document.adiciona_texto.elements[id].value += ("<A HREF='" + PLACE + "' target='_blank'><U>" + LINK + "</U></A>\n")
}

function CLS(id,tipo)
{
  document.adiciona_texto.elements[id].value += ("<font class='" + tipo + "'></font>\n")
}

  function QUEBRA(id)
{
  document.adiciona_texto.elements[id].value += ("<#quebra_texto#>\n")
}
