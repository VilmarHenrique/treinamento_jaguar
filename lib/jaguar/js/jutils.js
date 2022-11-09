BACKSPACE_KEY    = 8;
TAB_KEY          = 9;
ENTER            = 13;
ESC              = 27;
DELETE_KEY       = 46;
ZERO_KEY         = 48;
NINE_KEY         = 57;
F1_KEY           = 112;
F12_KEY          = 123;

var VALID_NUMERIC_KEYS    = new Array(48, 49, 50, 51, 52, 53, 54, 55, 56, 57);
var VALID_NAVIGATION_KEYS = new Array(0, 8, 9, 13, 27);

function is_valid_numeric(key)
{
  for (i = 0; i < VALID_NUMERIC_KEYS.length; i++)
    if (VALID_NUMERIC_KEYS[i] > key)
      return false;
    else
      if (VALID_NUMERIC_KEYS[i] == key)
        return true;

  return false;
}

function is_valid_navigation(key)
{
  for (i = 0; i < VALID_NAVIGATION_KEYS.length; i++)
    if (VALID_NAVIGATION_KEYS[i] > key)
      return false;
    else
      if (VALID_NAVIGATION_KEYS[i] == key)
        return true;

  return false;
}

function is_valid_character(key)
{
  if ( ((key >= 97) && (key <= 122)) || ((key >= 65) && (key <= 90)) )
    return true;
  else
    return false;
}

function layer_text(layer, value, parent)
{
  if (!parent)
    aux_layer = document.getElementById(layer);
  else
    aux_layer = top.opener.document.getElementById(layer);

  aux_layer.innerHTML = value;
}

function test_if_empty(field, message, formName, fieldName, type)
{
  switch(type)
  {
    case 'Radio':
      rad = eval("document." + formName + "['" + fieldName + "']");
      if (rad.disabled || rad.readOnly) return false;
      empty = true;
      for (i = 0; i < rad.length; i++)
        if (rad[i].checked == true)
          empty = false;
      if (empty)
      {
        test_empty = false;
        last_empty_field = fieldName;
        alert(message);
        rad[0].focus();
      }
      else
        test_empty = true;

      return empty;
    break;
    
    case 'Layer':
      layer = document.getElementById(fieldName);
      if (layer.innerHTML.length == 0)
      {
        test_empty = false;
        last_empty_field = fieldName;
        alert(message);
        return true;
      }
      else
      {
        test_empty = true;
        return false;
      }
    break;
    
    case "Editor":
      if (!field.value)
      {
        alert(message);
        return false;
      }

      return true;
    break;
    
    case "DualList":
      dual_list = eval("document." + formName + ".elements['" + fieldName + "']");
      if (dual_list.disabled || dual_list.readOnly) return false;
        
      if (dual_list.options.length == 0)
      {
        test_empty = false;
        last_empty_field = fieldName;
        alert(message);
        return true;
      }
      else
      {
        test_empty = true;
        return false;
      }
    break;
    
    default:
      if (field.value == undefined)
      {
        cmp = eval("document." + formName + "['" + fieldName + "']");
        if (cmp.disabled || cmp.readOnly) return false;
        if (type != 'File') cmp.value = cmp.value.replace(/^[\s\r\t\n\0\v]+|[\s\r\t\n\0\v]+$/g, '');
        if (cmp.value == '')
        {
          test_empty = false;
          last_empty_field = fieldName;
          alert(message);
          if (type != 'Hidden')
            cmp.focus();
          return true;
        }
        else
        {
          test_empty = true;
          return false;
        }//if (cmp.value == '')
      }//if (field.value == undefined)
      else
      {
        if (field.disabled || field.readOnly) return false;
        if (type != 'File') field.value = field.value.replace(/^[\s\r\t\n\0\v]+|[\s\r\t\n\0\v]+$/g, '');
        if (field.value == '')
        {
          test_empty = false;
          last_empty_field = field.name;
          alert(message);
        }
        else
          test_empty = true;

      }// else - if (field.value == undefined)
    break;
  }//switch(type)

}

function clock(hr, min, sec, formName, fieldName)
{
  //////////////////////////////////////////////////////////
  // passar os parametros para a funcao SEM as aspas "''" //
  // desta forma:                                         //
  //              relogio(1,2,3); ou relogio(01,02,03);   //
  //////////////////////////////////////////////////////////
  if (sec > 59)
  {
    min += 1;
    sec = 0;
  }
  if (min > 59)
  {
    hr += 1;
    min = 0;
  }
  if (hr > 23)
    hr = 0;

  var Shr  = new String(hr);
  var Smin = new String(min);
  var Ssec = new String(sec);

  if (Shr.length == 1)
    Shr = "0" + Shr;
  if (Smin.length == 1)
    Smin = "0" + Smin;
  if (Ssec.length == 1)
    Ssec = "0" + Ssec;
  var clocktext = Shr + ":"  + Smin + ":" + Ssec;
  Shr  = "";
  Smin = "";
  Ssec = "";
  ///////////////// ONDE ESCREVER /////////////////////////
  field = eval("document." + formName + "['" + fieldName + "']");
  field.value = clocktext;
  /////////////////////////////////////////////////////////
  sec += 1;
  setTimeout("clock(" + hr + "," + min + "," + sec + ", '" + formName + "', '" + fieldName + "')",1000);
}

/*
 * Atualiza o frame ou a pagina
 */
function reload (frame)
{
  if (frame)
  {
    frame = 'parent.' + frame + '.location.href = parent.' + frame + '.location.href';
    setTimeout(frame, 0);
  }
  else
    parent.location.href = parent.location.href;
}

/*
 * Abre a janela do correio que verifica o CEP
*/
function cep_cadastre(cepNumber)
{
  cepNumber        = cepNumber.replace( "-", "" );
  var height       = 550;
  var width        = 680;
  var top          = (screen.availHeight / 2) - (height / 2);
  var left         = (screen.availWidth / 2) - (width / 2);
  var s            = cepNumber != '' ? 'http://www.buscacep.correios.com.br/servicos/dnec/consultaLogradouroAction.do'+
                                       '?Metodo=listaLogradouro&TipoConsulta=cep&StartRow=1&EndRow=10&CEP=' + cepNumber
                                     : 'http://www.buscacep.correios.com.br/servicos/dnec/index.do';
  window.open(s, "_blank", "top="+top+",left="+left+",height="+height+",width="+width+",resizable=yes,status=no,scrollbars=yes,toolbar=no,menubar=no,location=no");
}

/*
 * Abre a janela da receita federal que verifica o NIT 
*/
function nit_cadastre()
{
  var height       = 550;
  var width        = 680;
  var top          = (screen.availHeight / 2) - (height / 2);
  var left         = (screen.availWidth / 2) - (width / 2);
  var s            = 'http://www.dataprev.gov.br/servicos/cadint/cadint.html';
  window.open(s, "_blank", "top="+top+",left="+left+",height="+height+",width="+width+",resizable=yes,status=no,scrollbars=yes,toolbar=no,menubar=no,location=no");
}

/*
 * Abre a janela da dataprev que valida o NIT 
*/
function nit_validated()
{
  var height       = 550;
  var width        = 680;
  var top          = (screen.availHeight / 2) - (height / 2);
  var left         = (screen.availWidth / 2) - (width / 2);
  var s            = 'http://www2.dataprev.gov.br/PortalSalInternet/faces/pages/calcContribuicoesCI/filiadosApos/selecionarOpcoesCalculoApos.xhtml';
  window.open(s, "_blank", "top="+top+",left="+left+",height="+height+",width="+width+",resizable=yes,status=no,scrollbars=yes,toolbar=no,menubar=no,location=no");
}

/*
 * Abre a janela da receita federal que verifica o CPF
*/
function cpf_cadastre(cpfNumber)
{
  cpfNumber = cpfNumber.replace( /\D/g, "" );
  var height       = 550;
  var width        = 680;
  var top          = (screen.availHeight / 2) - (height / 2);
  var left         = (screen.availWidth / 2) - (width / 2);
  var s            = 'http://www.receita.fazenda.gov.br/Aplicacoes/ATCTA/CPF/ConsultaPublica.asp?CPF=' + cpfNumber;
  window.open(s, "_blank", "top="+top+",left="+left+",height="+height+",width="+width+",resizable=yes,status=no,scrollbars=yes,toolbar=no,menubar=no,location=no");
}

/*
 * Abre a janela da receita federal que verifica o Cnpj
*/
function cnpj_cadastre(cnpjNumber)
{
  cnpjNumber = cnpjNumber.replace( /\D/g, "" );
  var height  = 550;
  var width   = 680;
  var top     = (screen.availHeight / 2) - (height / 2);
  var left    = (screen.availWidth / 2) - (width / 2);
  var s       = 'http://www.receita.fazenda.gov.br/PessoaJuridica/CNPJ/cnpjreva/cnpjreva_solicitacao2.asp?cnpj=' + cnpjNumber;
  window.open(s, "_blank", "top="+top+",left="+left+",height="+height+",width="+width+",resizable=yes,status=no,scrollbars=yes,toolbar=no,menubar=no,location=no");
}

/*
 * Responsável pela abertura dos pops
 */
function pop_open(address, width, height, windowName, resizable)
{
  // POP CENTRALIZADO //
  /*
  var topo = (screen.availHeight / 2) - (height / 2);
  var esq = (screen.availWidth / 2) - (width / 2);
  */
  // POP NO CANTO SUPERIOR DIREITO
  var topo = 0;
  var esq = (screen.availWidth - width);
  var __BASE_URL__ = '';

  if (windowName == false)
    windowName = '';
  if (!resizable)
    resizable = 'yes';

  if (window.BASE_URL && window.BASE_URL != '')
  {
    if ("http" != address.substr(0, 4).toLowerCase() && "ftp" != address.substr(0, 3).toLowerCase())
      __BASE_URL__ = window.BASE_URL;

    address = __BASE_URL__ + address.replace(/\.\.\//g, '');
  }

  var pop_window = window.open(address, windowName,'width='+width+',height='+height+',top='+topo+',left='+esq+',location=no,status=no,menubar=no,resizable=' + resizable + ',scrollbars=yes');
  
  pop_window.focus();

  return pop_window;

}

/*
  * Pega o valor do campo formatado e transforma para ponto flutuante
  (mesmo assim retorna uma string, logo ainda é necessario usar parseFloat
  para utilizar o valor nos calculos)
*/
function transform_value(object)
{
  if (typeof object == 'undefined' || object == '' || object == 'NaN,00' || object == 'NaN' || object == null)
    return 0;
  else if(typeof object == 'object')
  {
    if (object.value == '' || typeof object.value == 'undefined' || object.value == 'NaN,00' || object.value == 'NaN')
      return 0;
  }

  if (object)
  {
    if (object.value == undefined)
      object_value = object;
    else
      object_value = object.value;

    characters       = '.,';
    size             = object_value.length;
    object_value_fmt = "";

    for (i=0; i < size; i++)
    {
      if (object_value.charAt(i) == ',')
        object_value_fmt = object_value_fmt + '.';
      else
      {
        if (object_value.charAt(i) != '.')
          object_value_fmt = object_value_fmt + object_value.charAt(i);
      }
    }

    return object_value_fmt;
  }
}

/*
 * Permite apenas a entrada de Números no campo
*/
function format_number(object, e, neg)
{
  var code = getKeyCode(e);

  if (object.readOnly && !is_valid_navigation(code))
     return false;

  if (is_selected_or_selecting(e, code, object))
    return true;

  object_value = "";

  object_value = object.value;
  size         = object.value.length;
  negative     = (object_value.charCodeAt(0) == 45);

  if (code == 45 && neg)
  {
    if (negative)
      object.value = object_value.substr(1, size);
    else
      object.value = '-' + object_value;
  }

  return (is_valid_numeric(code) || is_valid_navigation(code));
}


/*
  * Permite ao usuário selecionar (com "ctrl+a") o texto inteiro 
  * Se tem valor selecionado permite que o usuário sobrescreva o valor do campo ou 
*/
function is_selected_or_selecting(e, code, object, specific_type) 
{

  //se ctrl ou enter por exemplo for pressionado libera a digitação para atalhos do teclado
  if (is_valid_navigation(code) || e.ctrlKey)
      return true;

  // se for o internet explorer ou o opera não vai ter a vantagem de sobreescrever o texto selecionado
  //
  myBrowser = navigator.userAgent.toLowerCase();


  //verifica se tem algum texto selecionado para o IE
  //
  if ( myBrowser.indexOf("msie") != -1 && document.selection)
    txt = document.selection.createRange().text; 

  // firefox e outros 
  //
  else
    txt = (object.value).substring(object.selectionStart, object.selectionEnd);

  /*
    Até então todas as validações (exceto placa) necessariamente validam se foi digitado um numero,
    já que campos texto nao possuem formatação ao digitar
  */
  if (txt)
   return ( (specific_type == "placa")? true : is_valid_numeric(code) );


  return false;
}

/*
 * Permite apenas a entrada de Números no campo
 * além de colocar os pontos e vírgulas necessários ao tamanho do campo
*/
function format_value(object, size, digits, e)
{
  var code = getKeyCode(e);

  if (object.readOnly && !is_valid_navigation(code))
     return false;

  if (is_selected_or_selecting(e, code, object))
    return true;

  total_size = size;
  if (digits > 0)
    total_size++;

  points = size - digits;
  points = parseInt(String( (points / 3) ), 10);

  if ( (size - digits) % 3 == 0)
    points--;

  total_size += points;
  total_size = total_size;

  actual_size  = object.value.length;

  object_value = "";
  
  //pega somente os números
  for (i = 0; i < actual_size; i++)
  {
    if (object.value.charAt(i) != ',' && object.value.charAt(i) != '.')
      object_value = object_value + object.value.charAt(i);
  }
  
  if ( ( is_valid_numeric(code) && ( (actual_size) < (total_size) ) ) || is_valid_navigation(code) || (code == 45) )
  {
    if (is_valid_navigation(code))
      return true;
    else
    {
      if (code != 45)
      {
        object_value_fmt = object_value;
        
        if ( (object_value_fmt.length >= digits) && (digits > 0) )
        {
          digits--;
          object_value_fmt = object_value_fmt.substr(0, object_value_fmt.length - digits) +
                             ',' + object_value_fmt.substr(object_value_fmt.length - digits, digits);
        }
      }
    }

    j = 0;
    
    str_tmp = "";
    
    use_point = false;

    negative = (object_value_fmt.charCodeAt(0) == 45);

    limit  = (negative) ? 1 : 0;

    for (i = object_value_fmt.length - 1; i >= limit ; i--)
    {
      if (object_value_fmt.charCodeAt(i) >= 48 && object_value_fmt.charAt(i) <= 57)
        j++;

      if (object_value_fmt.charAt(i) == ',')
      {
        use_point = true;
        j = 0;
      }

      str_tmp = object_value_fmt.charAt(i) + str_tmp;

      if ( (j == 3 && use_point) && (i > limit) && (object_value_fmt.charAt(i - 1) != ",") && (code != 45) )
      {
        str_tmp =  '.' + str_tmp;
        j = 0;
      }
    }

    object_value_fmt = str_tmp;

    if (negative)
      object_value_fmt = '-' + object_value_fmt;

    if (code == 45)
      if (object_value_fmt.charCodeAt(0) == 45)
        object_value_fmt = object_value_fmt.substr(1, object_value_fmt.length - 1);
      else
        object_value_fmt = '-' + object_value_fmt;
    object.value = object_value_fmt;

    return false;
  }
  else
    return false;
}

/*
  * Converte o valor ponto flutuante javascript
  para uma string com a formatação padrão

  * Realiza o contrario de "transform_value"
*/
function convert_value(value, size, digits)
{
  object_value     = new String(value);
  actual_size      = object_value.length;
  object_value_fmt = "";
  temp             = "";
  j                = 0;
  dot              = 0;
  for (i = 0; (i < actual_size) && (j < (digits + 1) ); i++)
  {
    if ((dot != 0) && (i > ((dot + digits))))
    {
      continue;
    }
    if (object_value.charAt(i) == '.')
    {
      dot = i;
    }
    else
      temp = temp + object_value.charAt(i);
  }
  if (dot == 0)
  {
    temp = temp;
    dot = actual_size;
    actual_size++;
  }
  used_digits = actual_size - dot - 1;


  
  for (i = used_digits; i < digits; i++)
  {
    temp = temp + '0';
  }

  j = 0;
  k = 0;
  conta_virgula = (digits == 0);
  for(i = temp.length; i >=0; i--)
  {
    object_value_fmt = temp.charAt(i) + object_value_fmt;
    if ((k == digits) && (k != 0))
    {
      object_value_fmt = ',' + object_value_fmt;
      conta_virgula = true;
    }
    k++;
    if ((j == 3) && (i > 0))
    {
      object_value_fmt = '.' + object_value_fmt;
      j = 0;
    }
    if (conta_virgula)
      j++;
  }

  return object_value_fmt;
}


/*
 * Formata a data, permitindo a digitacao apenas de nros e colocando
 * as barras automaticamente
 * Deve ser colocado no evento onKeyPress
 */
function format_date(object, e, useDay, useMonth, useYear)
{
  var code = getKeyCode(e);

  if (object.readOnly && !is_valid_navigation(code))
         return false;

  if (is_selected_or_selecting(e, code, object))
    return true;

  actual_size = object.value.length;

  expected_size = 10;

  //index where these variables will expect to have a bar beside
  var  day   = -1;
  var  month = -1;

  if (!useDay)
    expected_size -= 3;
  else
    day = 2;

  if (!useMonth)
    expected_size -= 3;
  else
    month = (useDay) ? ( (useYear) ? 5 : -1 ) : ( (useYear) ? 2 : -1 );
  
  if (!useYear)
    expected_size -= (useMonth && useDay) ? 5 : 7; 

  if ((code == 13) && (actual_size < expected_size))
    return false;

  if ((is_valid_numeric(code) && ((actual_size) < expected_size)) || is_valid_navigation(code))
  {
    if (is_valid_navigation(code))
      return true;

    object_value_fmt = "";
    object.value = object.value + String.fromCharCode(code);

    for (i = 0; i < object.value.length; i++)
    {
      if ( (i == day || i == month) && (object.value.charAt(i) != '/')) 
          object_value_fmt += '/';

      object_value_fmt += object.value.charAt(i);
    }

    object.value = object_value_fmt;

    return false;
  }
  else
    return (is_valid_navigation(code) );

}


/*
 * Formata a hora, permitindo a digitacao apenas de nros e colocando
 * os ":" automaticamente
 * Deve ser colocado no evento onKeyPress
 */
function format_time(object, e)
{
  var code = getKeyCode(e);

  if (object.readOnly && !is_valid_navigation(code))
     return false;

  if (is_selected_or_selecting(e, code, object))
    return true;

  actual_size = object.value.length;

  if ((actual_size == 2 || (actual_size == 3 && object.value.charAt(2) == ":")) && code > 53)
    return false;
 
  if ( is_valid_numeric(code) && actual_size < 5)
  {

    object_value_fmt = "";
    object.value = object.value + String.fromCharCode(code);

    for (i = 0; i < object.value.length; i++)
    {
      if (i == 2 && object.value.charAt(i) != ':')
        object_value_fmt = object_value_fmt + ':';

      object_value_fmt = object_value_fmt + object.value.charAt(i);
    }

    object.value = object_value_fmt;

    return false;
  }
  else
    return false;

}

/*
 * Formata o CEP, colocando o hifen separador automaticamente
 * e permitindo somente a digitacao de numeros
 * Deve ser colocado no evento onKeyPress
*/
function format_cep(object, e)
{
  var code = getKeyCode(e);

  if (object.readOnly && !is_valid_navigation(code))
     return false;

  if (is_selected_or_selecting(e, code, object))
    return true;

  actual_size = object.value.length;

  if ( ( is_valid_numeric(code) && ( (actual_size) < (9) ) ) ||
       is_valid_navigation(code) )
  {
    if (is_valid_navigation(code))
      return true;

    object_value_fmt = "";
    object.value = object.value + String.fromCharCode(code);

    for (i = 0; i < object.value.length; i++)
    {
      if ( i == 5 && object.value.charAt(i) != '-')
        object_value_fmt = object_value_fmt + '-';

      object_value_fmt = object_value_fmt + object.value.charAt(i);
    }

    object.value = object_value_fmt;

    return false;
  }
  else
    return false;

}

/*
 * Formata NIT permitindo somente a digitacao de numeros
 * Deve ser colocado no evento onKeyPress
*/
function format_nit(object, e)
{
  var code = getKeyCode(e);

  if (object.readOnly && !is_valid_navigation(code))
     return false;

  if (is_selected_or_selecting(e, code, object))
    return true;

  actual_size = object.value.length;

  if ( ( is_valid_numeric(code) && ( (actual_size) <= (10) ) ) ||
       is_valid_navigation(code) )
  {
    if (is_valid_navigation(code))
      return true;

    object.value = object.value + String.fromCharCode(code);

    return false;
  }
  else
    return false;
}


/*
 * Formata o CNPJ, colocando os pontos e a barra automaticamente
 * e permitindo somente a digitacao de numeros
 * Deve ser colocado no evento onKeyPress
*/
function format_cnpj(object, e)
{
  var code = getKeyCode(e);

  if (object.readOnly && !is_valid_navigation(code))
     return false;

  if (is_selected_or_selecting(e, code, object))
    return true;

  actual_size = object.value.length;

  if ( ( is_valid_numeric(code) && ( (actual_size) <= (17) ) ) ||
       is_valid_navigation(code) )
  {
    if (is_valid_navigation(code))
      return true;

    object_value_fmt = "";
    object.value = object.value + String.fromCharCode(code);

    for (i = 0; i < object.value.length; i++)
    {
      if ( (i == 2 || i == 6) && object.value.charAt(i) != '.')
        object_value_fmt = object_value_fmt + '.';

      if ( i == 10 && object.value.charAt(i) != '/')
        object_value_fmt = object_value_fmt + '/';

      if ( i == 15 && object.value.charAt(i) != '-')
        object_value_fmt = object_value_fmt + '-';

      object_value_fmt = object_value_fmt + object.value.charAt(i);
    }
    object.value = object_value_fmt;

    return false;
  }
  else
    return false;
}


/*
 * Formata o CPF, colocando os pontos e a barra automaticamente
 * e permitindo somente a digitacao de numeros
 * Deve ser colocado no evento onKeyPress
*/
function format_cpf(object, e)
{
  var code = getKeyCode(e);

  if (object.readOnly && !is_valid_navigation(code))
     return false;

  if (is_selected_or_selecting(e, code, object))
    return true;

  actual_size = object.value.length;

  if ( ( is_valid_numeric(code) && ( (actual_size) <= (13) ) ) ||
       is_valid_navigation(code) )
  {
    if (is_valid_navigation(code))
      return true;

    object_value_fmt = "";
    object.value = object.value + String.fromCharCode(code);

    for (i = 0; i < object.value.length; i++)
    {
      if ( (i == 3 || i == 7) && object.value.charAt(i) != '.')
        object_value_fmt = object_value_fmt + '.';

      if ( i == 11 && object.value.charAt(i) != '/')
        object_value_fmt = object_value_fmt + '/';

      object_value_fmt = object_value_fmt + object.value.charAt(i);
    }
    object.value = object_value_fmt;

    return false;
  }
  else
    return false;
}

/*
 * Formata email
*/
function format_email(object, e, espaco)
{
  var code = getKeyCode(e);

  if (object.readOnly && !is_valid_navigation(code))
     return false;
  
  if (code == 32 && !espaco)
    return false
  else
    return true;
  
}

/* Formata telefones, aceita os formatos:
 * - (xx)xxx-xxxx
 * - (xx)xxxx-xxxx
 * - (xx)xxxxx-xxxx
 * - xxxx-xxxxxxx
 * - xx*xxxxxxx*xxxxx
 * - Nrs intercalados com * em qualquer posição
 */
function format_fone(object, e)
{
  var code = getKeyCode(e);

  if (object.readOnly && !is_valid_navigation(code))
     return false;

  if (is_selected_or_selecting(e, code, object))
    return true;

  if ( is_valid_numeric(code) || is_valid_navigation(code) || code == 42) 
  {
    if (is_valid_navigation(code))
      return true;

    var append = '';
    append = object.getAttribute('class').substring(13);
    var idTipo = $('.f_id_tipo' + append).val() * 1;
    if (idTipo === 6 && (is_valid_numeric(code) || code == 42)) // type Radio
    {
      if (object.value.length >= 15)
      {
        object.value = object.value.substring(0, 15);
        return false;
      }

      return true;
    }

    if (object.value.length < 2 && code == 42)
      return false;
    
    if (object.value.length > 1)
    {
      value = object.value.substring(0,1);

      if (value != 0)
      {
        if (value != "(" && object.value.length > 2)
        {
          // Nextel
          qt = object.value.split("*");
          
          // Não deixa colocar **
          if (qt.length == 2 && code == 42 && qt[1] == "")
            return false;
          
          // não deixa colocar mais de 2 *
          if (qt.length == 3 && code == 42)
            return false;
          
          // caso tenha XX*XXXXXXX e não for * irá adicionar outro *
          if (object.value.length == 10 && qt.length == 2 && code != 42)
            object.value +=  "*";
          
          // caso o segundo campo não tenha 7 caracteres mesmo assim vai permitir
          // apenas 5 no último campo
          if (qt.length == 3 && qt[2].length == 5)
            return false;
        }
        else
        {
          if (code == 42 && object.value.length > 2)
            return false;
          
          // Convencional e celular
          if (object.value.length == 14)
            return false;
          
          if (object.value.length == 2 && code != 42)
          {
            value_tmp = object.value;
            object.value = "(" + value_tmp + ")";

            return;
          }
          
          // só pode ter 9 dígitos se o telefone começar com '9'
          if (object.value.substring(4,5) != '9' && object.value.length == 13)
            return false;

          //retira "-"
          object.value = object.value.replace("-", "");
          
          var value_tmp = false;
          var value_tmp2 = false;
          
          //separa value em duas partes
          switch (object.value.length)
          {
            case 8:
            case 9:
            case 10:
            case 11:
              value_tmp  = object.value.substring(0,8);
              value_tmp2 = object.value.substring(8, 11);
            break;
            case 12:
              value_tmp  = object.value.substring(0,9);
              value_tmp2 = object.value.substring(9,12);
            break;
          }
          
          //coloca "-" 
          if (value_tmp !== false)
          {
            object.value = value_tmp + "-" + value_tmp2;
            
            return;
          }
        }
      }
      else
      {
        if (code == 42)
          return false;
        // 0800
        if (object.value.length == 12)
          return false;
        
        if (object.value.length == 4)
          object.value = object.value + "-";
      }
    }//if (object.value.length > 1)
  }//if ( is_valid_numeric(code) || is_valid_navigation(code) )
  else
    return false;
}

/*
 * Formata a inscrição estadual de acordo com a UF
*/
function format_inscricao_estadual(object, e, fieldUf, formName)
{
  var code = getKeyCode(e);

  if (object.readOnly && !is_valid_navigation(code))
     return false;

  if (is_selected_or_selecting(e, code, object))
    return true;
 
  if ( is_valid_numeric(code) || is_valid_navigation(code) )
  {
    if (is_valid_navigation(code))
      return true;
    
    //pega a uf
    cmp = eval("document." + formName + "['" + fieldUf + "']");
    uf = cmp.value;
    
    //formata de acordo com a uf
    switch (uf)
    {
      case "RS":
        if (object.value.length == 3)
          object.value = object.value + "/";    
      break;
    
      case "SC":
      break;
      
      case "PR":
        if (object.value.length == 8)
          object.value = object.value + "-";
      break;

      case "SP":
      break;
    }
  }
  else
    return false;
}

/*
 * Formata o PIS, colocando os pontos e a barra automaticamente
 * e permitindo somente a digitacao de numeros
 * Deve ser colocado no evento onKeyPress
*/
function format_pis(object, e)
{
  var code = getKeyCode(e);

  if (object.readOnly && !is_valid_navigation(code))
     return false;

  if (is_selected_or_selecting(e, code, object))
    return true;

  actual_size = object.value.length;

  if ( ( is_valid_numeric(code) && ( (actual_size) <= (13) ) ) ||
       is_valid_navigation(code) )
  {
    if (is_valid_navigation(code))
      return true;

    object_value_fmt = "";
    object.value = object.value + String.fromCharCode(code);

    for (i = 0; i < object.value.length; i++)
    {
      if ( (i == 3 || i == 9) && object.value.charAt(i) != '.')
        object_value_fmt = object_value_fmt + '.';

      if ( i == 12 && object.value.charAt(i) != '-')
        object_value_fmt = object_value_fmt + '-';

      object_value_fmt = object_value_fmt + object.value.charAt(i);
    }
    object.value = object_value_fmt;

    return false;
  }
  else
    return false;
}

/*
 * Formata o Modulo11, a barra automaticamente
 * e permitindo somente a digitacao de numeros
 * Deve ser colocado no evento onKeyPress
*/
function format_modulo11(object, size, e)
{
  digits = 1;
  size = parseInt(size) + 1;

  var code = getKeyCode(e);

  if (object.readOnly && !is_valid_navigation(code))
     return false;

  if (is_selected_or_selecting(e, code, object))
    return true;

  total_size = size;
  if (digits > 0)
    total_size++;

  actual_size  = object.value.length;

  object_value = "";
  for (i = 0; i < actual_size; i++)
    if (object.value.charAt(i) != '-')
      object_value = object_value + object.value.charAt(i);

  if ( ( is_valid_numeric(code) && ( (actual_size) < (total_size) ) ) ||
       is_valid_navigation(code) )
  {
    if (is_valid_navigation(code))
      return true;
    else
    {
      object_value_fmt = object_value + String.fromCharCode(code);
      if (object_value_fmt.length > digits)
        object_value_fmt = object_value_fmt.substr(0, object_value_fmt.length - digits) +
                           '-' +
                           object_value_fmt.substr(object_value_fmt.length - digits, digits);
    }
    object.value = object_value_fmt;

    return false;
  }
  else
    return false;
}

/*
 * Verifica se o telefone é valido
 * utilizado no onBlur e na submissão do form
*/
function validate_fone(object, error, formName)
{
  var telefone = /^\(([0-9]{2})\)([0-9]{4,5})[-]([0-9]{4})$/;
  var nextel   = /^([0-9]{2})\*([0-9]{1,7})\*([0-9]{2,5})$/;
  var gratuito = /^([0][0-9]{3})[-]([0-9]{7})$/;
  var radio    = /^((\*)*[0-9])+([0-9\*])*$/;

  if (object.value == undefined)
    object = eval("document." + formName + "['" + object + "']");

  var append = '';
  append = object.getAttribute('class').substring(13);
  var idTipo = $('.f_id_tipo' + append).val() * 1;

  if (object.value.length == 0  ||  telefone.test(object.value) || 
      nextel.test(object.value) ||  gratuito.test(object.value) ||
      (idTipo == 6 && radio.test(object.value)))
    return true;
  else 
  {
    alert(error);
    object.value = '';
    return false;
  }
}

/* 
 * Verifica se o cep é valido, utilizado no onBlur
*/
function validate_cep(object, error, formName)
{
  var_return = true;

  if (object.value == undefined)
  {
    cmp = eval("document." + formName + "['" + object + "']");
    object_value = cmp.value;
  }
  else
    object_value = object.value;

  if (object_value.length > 0)
  {
    if (object_value.length < 9)
    {
      alert(error);
      object.value = '';
      var_return = false;
    }
  }

  return  var_return;
}

/*
 * Verifica se o email é valido
 * utilizado no onBlur e na submissão do form
*/
function validate_email(object, error, re, label)
{
  var regEx = RegExp(re); 
  
  if (object.value)
  {
    var arrEmails = object.value.replace(/[ ;]+/g, ";").split(";");
    
    var arrEmailInvalidos = arrEmails.filter(
          function(email) {
            return email && !regEx.test(email);
          });
          
    if (arrEmailInvalidos.join('') !== '')
    {
      if (label);
        error = label+': '+error+'\n'+arrEmailInvalidos.join('\n');

      alert(error);
      //object.value = '';
      return false;
    }
  }
  
  return true;
}

/*
 * Verifica se o formato da data digitada está correto,
 * deve ser utilizado no onBlur
*/
function validate_date(obj, useDay, useMonth, useYear)
{
  if (!obj)
    return true;

  if (!obj.value || obj.value == '__/__/____' || obj.value == '__/____' || obj.value == '__/__')
  {
    obj.value = '';
    return true;
  }
  
  obj.value = obj.value.replace( /_/g, "" );
    
  //Criacao da string que complementa a data
  data = new Date();

  foo = data.getMonth() + 1;

  mes = foo.toString();
  if (mes.length == 1)
    mes = "0" + mes;

  ano = data.getFullYear();

  if (useDay)
  {
    compl = "00/" + mes + "/" + ano;
    largura = 10;
  }
  else
  {
    compl = mes + "/" + ano;
    largura = 7;
  }

  str = String(obj.value);

  str_data = str;
  str_data = str_data.replace(/\//g, " ");
  str_data = str_data.replace(/^\s+|\s+$/g,"");    

  //Verifica se está no modo auto-complete
  if (str_data.length < 10)
  {
    str = str.replace(/\//g, " ");
    str = str.replace(/^\s+|\s+$/g,"");    
  }

  //Caso tenha informado apenas um caracter no dia ou mes
  if (str.length == 1)
    str = "0" + str;

  if (str.length == 4 && useDay) 
    //Caso tenha informado apenas um caracter no mês
    str = str.substr(0,3) + "0" + str.substr(3, 1);

  for (i = str.length; i < largura; i++)
    str = str + compl.charAt(i);

  str_data = str;
  str_data = str_data.replace(/\s|\//g, "");

  if (useDay) //Data completa
  {
    day   = str_data.substr(0, 2);
    month = str_data.substr(2, 2);
    year  = str_data.substr(4, 5);

    str = day + "/" + month + "/" + year;
  }
  else //Mês / Ano
  {
    month = str_data.substr(0, 2);
    year  = str_data.substr(2, 4); 

    str = month + "/" + year;
  }
  
  obj.value = str;
  
  //mounts a valid string
  var day   = useDay   ? obj.value.substr(0, 2) : '01';
  var month = useMonth ? (useDay) ? obj.value.substr(3, 2) : obj.value.substr(0, 2) : '01';
  var year  = useYear  ? ( ((useDay && useMonth) ? obj.value.substr(6, 4): ((useDay || useMonth) ? obj.value.substr(3, 4) : obj.value.substr(0, 4)) ) ) : new Date().getFullYear();

  var myDate = year+'/'+month+'/'+day;

  //test the date
  var isValid = true;
  var regEx = new RegExp(/^((?:19|20)\d\d)[\/](0[1-9]|1[012])[\/](0[1-9]|[12][0-9]|3[01])$/); 
  if (regEx.test(myDate))
  {
    // At this point, year holds the year, month the month && day the day of the date entered
    if (day == 31 && (month == 4 || month == 6 || month == 9 || month == 11)) {
      isValid = false;// 31st of a month with 30 days
    } else if (day >= 30 && month == 2) {
      isValid = false;// February 30th || 31st
    } else if (month == 2 && day == 29 && !(year % 4 == 0 && (year % 100 != 0 || year % 400 == 0))) {
      isValid = false;// February 29th outside a leap year
    } else {
      return isValid; // Valid date
    }
  }
  else
    isValid = false;

  //if(!isValid)
  obj.value = '';
  alert("Data Inválida!");
  return false;
}

function complete_time(field)
{
  value       = field.value ? field.value : '';
  field.value = '';
  valor       = new Array;

  if (value.length == 1)
    value = '0' + value;

  for (i = 0; i <= 4; i++)
    valor[i] = value.substr(i, 1);

  if ((value.length <= 5) && (value.length > 0))
  {
    for (i = 1; i <= 5; i++)
    {
      if (i%3==0)
        field.value = field.value + ':';
      else if (valor[i-1])
        field.value = field.value + valor[i-1];
      else
        field.value = field.value + '0';
    }
  }
}

/*
 * Verifica se o formato da data digitada está correto,
 * deve ser utilizado no onBlur
*/
function validate_time(field, errorMsg)
{
  complete_time(field);
  
  field_value = field.value ? field.value : '';
  field_size  = field.size;

  if ((field_value.length < field_size) && (field_value.length > 0))
  {
    alert(errorMsg);  
    field.value = '';
    return false;
  }
  
  hour   = field_value.substr(0, 2);
  minute = field_value.substr(3, 2);
  second = field_value.substr(6, 2);

  if (hour > 23 || minute > 59 || second > 59)
  {
    alert(errorMsg);
    field.value = '';
    return false;
  }
  else
    return true;

}

/*
 * Verifica se o formato do NIT está correto,
 * deve ser utilizado no onBlur
*/
function validate_nit(field, error, formName)
{

  if (field.value == undefined)
  {
    cmp = eval("document." + formName + "['" + field + "']");
    field_value = cmp.value;
  }
  else
    field_value = field.value;

  valid = true;

  if (field_value.length != 0)
  {

    // verifica o tamanho
    if (field_value.length != 11 || field_value <= 0)
    {
      valid = false;
    }

    nit = field_value;
      
    arr_peso = new Array(3, 2, 9, 8, 7, 6, 5, 4, 3, 2);
    arr_nit = new Array();
    digito = nit.substr(10, 1);

    for (i=0; i<=9; i++)
    {
      arr_nit[i] = nit.substr(i, 1);
    }

    result = 0;
    for (var i = 0; i < arr_nit.length; i++)
    {
      result += arr_nit[i] * arr_peso[i];
    }

    mod = result % 11;
    digito_verificador = 11 - mod;

    if (digito_verificador == 11 || digito_verificador == 10)
      digito_verificador = 0;


    if (digito_verificador != digito)
      valid = false;
  }

  if (!valid)
  {
    alert(error);
    field.value = '';
    return false;
  }
  else
    return true;
}

/*
 * Verifica se o formato do CPF está correto,
 * deve ser utilizado no onBlur
*/
function validate_cpf(field, error, formName)
{
  if (field.value == undefined)
    field = eval("document." + formName + "['" + field + "']");

  field_value = field.value.replace( /\D/g, "" );

  valid = true;

  if (field_value.length != 0)
  {
    // verifica o tamanho
    if (field_value.length != 11)
      valid = false;

    if (valid)  // valida o primeiro digito
    {
      sum = 0;
      for (i = 0; i <= 8; i++)
      {
        val = eval(field_value.charAt(i));
        sum = sum + ( val * (i + 1) );
      }

      rest = sum % 11;

      if (rest > 9)
        dig = rest - 10;
      else
        dig = rest;

      if (dig != eval( field_value.charAt(9) ) )
        valid = false;
      else   // valida o segundo digito
      {
        sum = 0;
        for (i = 0;i <= 7; i++)
        {
          val = eval(field_value.charAt(i + 1) );
          sum = sum + ( val * ( i + 1 ) );
        }

        sum = sum + (dig * 9);
        rest = sum % 11;

        if (rest > 9)
          dig = rest - 10;
        else
          dig = rest;

        if (dig != eval( field_value.charAt(10) ) )
          valid = false;
      }//if (valid)
    }//if (valid)
  }
  else
    field.value = '';
    

  if (!valid)
  {
    alert(error);
    field.value = '';
    return false;
  }
  else
    return true;
}

/*
 * Verifica se o formato do Cnpj está correto,
 * deve ser utilizado no onBlur
*/
function validate_cnpj(field, error, formName)
{
  if (field.value == undefined)
    field = eval("document." + formName + "['" + field + "']");

  field_value = field.value.replace( /\D/g, "" );

  valid = true;

  // ve se pode passar em branco
  if (field_value.length != 0)
  {
    // verifica o tamanho
    if (field_value.length != 14)
      valid = false;

    if (valid) // validacao do nr.
    {
      m2 = 2;
      sum1 = 0;
      sum2 = 0;
      for (i = 11; i >= 0; i--)
      {
        val = eval(field_value.charAt(i));
        m1 = m2;

        if (m2 < 9)
          m2 = m2 + 1;
        else
          m2 = 2;

        sum1 = sum1 + (val * m1);
        sum2 = sum2 + (val * m2);
      }  // fim do for de sum

      sum1 = sum1 % 11;
      if (sum1 < 2)
        d1 = 0;
      else
        d1 = 11 - sum1;

      sum2 = (sum2 + (2 * d1) ) % 11;

      if (sum2 < 2)
        d2 = 0;
      else
        d2 = 11 - sum2;

      if ( ( d1 != field_value.charAt(12) ) || ( d2 != field_value.charAt(13) ) )
        valid = false;
    }//if (valid)
  }//if ( (field_value.length != 0) && (field_value != '0') )
  else
    field.value = '';

  if (!valid)
  {
    alert(error);
    field.value = '';
    return false;
  }
  else
    return true;
}

// -- Contador para objeto TextArea.
/*
 * Verifica se o tamanho do textarea não ultrapassou o seu limite,
 * deve ser utilizado no onKeyUp
*/
function validate_text(field, size)
{
  var actual_size = field.value.length;
  var actual_text = field.value;
  if (actual_size > size)
  {
    field.value = actual_text.substring(0, size);
  }
  return true;
}

/*
 * Verifica se o formato do PIS está correto,
 * deve ser utilizado no onBlur
*/
function validate_pis(field, error, formName)
{

  if (field.value == undefined)
  {
    cmp = eval("document." + formName + "['" + field + "']");
    field_value = cmp.value;
  }
  else
    field_value = field.value;

  field_value = field_value.replace( "-", "" );
  field_value = field_value.replace( ".", "" );
  field_value = field_value.replace( ".", "" );

  valid = true;

  // ve se pode passar em branco
  if ( (field_value.length != 0) && (field_value != '0') )
  {
    // verifica o tamanho
    if (field_value.length != 11)
      valid = false;

    if (valid)  // verifica se e numero
    {
      for (i = 0;( (i <= (field_value.length - 1) ) && valid); i++)
      {
        val = field_value.charAt(i)

        if ( (val != "9") && (val != "0") && (val != "1") && (val != "2") &&
             (val != "3") && (val != "4") && (val != "5") && (val != "6") &&
             (val != "7") && (val != "8") )
          valid = false;
      }

      if (valid)  // se for numero continua
      {
        soma = 0;
        fator = [3,2,9,8,7,6,5,4,3,2];
        for (i=0; i < 10; i++)
        {
          val = eval(field_value.charAt(i));
          soma += val * fator[i];
        }

        resultado = 11 - (soma % 11);

        if ( (resultado == 10) || (resultado == 11) )
          resultado = 0;

        if ( resultado != field_value.charAt(10) )
          valid = false;

      }//if (valid)
    }//if (valid)
  }//if ( (field_value.length != 0) && (field_value != '0') )

  if (!valid)
  {
    alert(error);
    field.value = '';
    return false;
  }
  else
    return true;
}

/*
 * Valida a Inscrição Estadual
 * deve ser utlizada no onBlur
*/
function validate_inscricao_estadual(field, fieldUf, formName, error)
{
  //pegua o valor do campo
  if (field.value == undefined)
  {
    cmp = eval("document." + formName + "['" + field + "']");
    field_value = cmp.value;
  }
  else
    field_value = field.value;

  //pega a uf
  cmp = eval("document." + formName + "['" + fieldUf + "']");
  uf = cmp.value;

  switch (uf)
  {
    case "RS":
      var_return = validate_modulo11(field_value, error, formName, uf);
    break;

    case "SC":
    break;
    
    case "PR":
      value_1 = field_value;
      value_2 = field_value.substring(0, 10);
      //valida o primeiro dígito verificador
      var_1 = validate_modulo11(value_2, error, formName, uf, 8);
      //se o primeiro dígito for valido, valida o segundo
      if (var_1)
        var_2 = validate_modulo11(value_1, error, formName, uf, 8);
      //se ambos forem válidos
      if (var_1 && var_2)
        var_return = true; 
      else
        var_return = false;
    break;

    case "SP":
    break;
  }

  return var_return;
}

/*
 * Verifica se o formato do Modulo11 está correto,
 * deve ser utilizado no onBlur
*/
function validate_modulo11(field, error, formName, uf, max)
{
  if (max == undefined)
    max = 10; 
  
  if (uf == undefined)
  {
    if (field.value == undefined)
    {
      cmp = eval("document." + formName + "['" + field + "']");
      field_value = cmp.value;
    }
    else
      field_value = field.value;
  }
  else
    field_value = field;
    
  field_value = field_value.replace( "-", "");
  field_value = field_value.replace( "/", "");
  
  //alert (field_value);
  
  valid = true;

  // ve se pode passar em branco
  if ( (field_value.length != 0) && (field_value != '0') )
  {
    if (valid)  // verifica se e numero
    {
      for (i = 0;( (i < field_value.length) && valid); i++)
      {
        val = field_value.charAt(i)

        if ( (val != "9") && (val != "0") && (val != "1") && (val != "2") &&
             (val != "3") && (val != "4") && (val != "5") && (val != "6") &&
             (val != "7") && (val != "8") )
          valid = false;
      }

      val = 0;
      resultado = 0;
      if (valid)  // se for numero continua
      {
        fator = 2;
        for (i = (field_value.length - 1); i > 0; i--)
        {
          if (fator == max)
            fator = 2;

          val = eval(field_value.charAt(i-1));
          resultado += (val * fator);
          fator++;
        }
        digito = (11 - (resultado % 11) );
        if (digito == 11 || digito == 10)
          digito = 0;
        
        if ( digito != field_value.charAt(field_value.length - 1) )
          valid = false;

        //alert (digito + "!=" + field_value.charAt(field_value.length - 1) );
          
      }//if (valid)
    }//if (valid)
  }//if ( (field_value.length != 0) && (field_value != '0') )

  if (!valid)
  {
    alert(error);
    field.value = '';
    return false;
  }
  else
    return true;
}

//Testa se uma data eh maior, menor ou igual a outra
//ou estah em um intervalo
//campo = campo onde esta se fazendo o teste
//data1 ou data2 = valor do campo
//teste = simbolos ('<' ,'>' ,'<=' ,'>=' ,'=')
function test_date(field, date1, date2, test, myError, interval, label, dialogType)
{
  if (!field.value || field.value == '  /  /    ' || field.value == '  /    ' || field.value == '  /  ')
    return true;
    
  var date = field.value;
      
  //Valida a entrada
  date = date.replace(" ", "");
  date = date.replace(/^\s+|\s+$/g,""); //trim
  
  //Se ocorreu algum erro e a data não está formatada corretamente
  if (date.length < 10)
  {
    //Limpa os divisores "/"
    date = date.replace(/\//g, " ");
    date = date.replace(" ", "");
    date = date.replace(/^\s+|\s+$/g,""); //trim
    
    day   = date.substr(0, 2);
    month = date.substr(2, 2);
    year  = date.substr(4, 5);
    
    if ((date1.value != '' && date1.length == 10) || (date2.value != '' && date2.length == 10))
      date = day + "/" + month + "/" + year;
    else if ((date1.value != '' && date1.length == 7) || (date2.value != '' && date2.length == 7))
    {
      month = date.substr(0, 2);
      year  = date.substr(2, 4);
      
      date = month + "/" + year;
    }
  }
    
  dt = new String(date);
  return_var = true;
  var error = "";

  if (date)
  {
    dt1 = new String(date1);

    period = 'false';
    if (date2 != '')
    {
      dt2 = new String(date2);
      period = 'true';
    }
    else
      dt2 = "";

    dt_fmt = "";
    dt1_fmt = "";
    dt2_fmt = "";

    for (i=0; i < 10; i++)
    {
      if (dt.charAt(i) != '/')
        dt_fmt = dt_fmt + dt.charAt(i);

      if (dt1.charAt(i) != '/')
        dt1_fmt = dt1_fmt + dt1.charAt(i);

      if (period == 'true')
        if (dt2.charAt(i) != '/')
          dt2_fmt = dt2_fmt + dt2.charAt(i);
    }

    switch(dt.length)
    {
      case 10:
        var d = dt_fmt.substr( 4, 4 );
        d += dt_fmt.substr( 2, 2 );
        d += dt_fmt.substr( 0, 2 );
        dt = Number(d);

        di = Date.UTC(dt_fmt.substr(4, 4), dt_fmt.substr(2, 2), dt_fmt.substr(0, 2)) / 1000;

        var d1 = dt1_fmt.substr( 4, 4 );
        d1 += dt1_fmt.substr( 2, 2 );
        d1 += dt1_fmt.substr( 0, 2 );
        dt1 = Number(d1);
        
        d1i = Date.UTC(dt1_fmt.substr(4, 4), dt1_fmt.substr(2, 2), dt1_fmt.substr(0, 2)) / 1000;

        diff = (di - d1i) / 86400;
        
        if (period == 'true')
        {
          var d2 = dt2_fmt.substr( 4, 4 );
          d2 += dt2_fmt.substr( 2, 2 );
          d2 += dt2_fmt.substr( 0, 2 );
          dt2 = Number(d2);
        }
        else
          var d2 = 0;

        break;
        
      case 7:
        var d = dt_fmt.substr( 2, 4 );
        d += dt_fmt.substr( 0, 2 );
        dt = Number(d);

        di = Date.UTC(dt_fmt.substr(2, 4), dt_fmt.substr(0, 2), 1) / 1000;

        var d1 = dt1_fmt.substr( 2, 4 );
        d1 += dt1_fmt.substr( 0, 2 );
        dt1 = Number(d1);
        
        d1i = Date.UTC(dt1_fmt.substr(2, 4), dt1_fmt.substr(0, 2), 1) / 1000;

        diff = (di - d1i) / 86400;

        if (period == 'true')
        {
          var d2 = dt2_fmt.substr( 2, 4 );
          d2 += dt2_fmt.substr( 0, 2 );
          dt2 = Number(d2);
        }
        break;

      case 5:
        var d = dt_fmt.substr( 2, 2 );
        d += dt_fmt.substr( 0, 2 );
        dt = Number(d);

        var d1 = dt1_fmt.substr( 2, 2 );
        d1 += dt1_fmt.substr( 0, 2 );
        dt1 = Number(d1);

        if (period == 'true')
        {
          var d2 = dt2_fmt.substr( 2, 2 );
          d2 += dt2_fmt.substr( 0, 2 );
          dt2 = Number(d2);
        }
        break;
    }
    if ((period == 'false') && dt1)
    {

      if ( interval > 0 )
      {
        if ( diff > interval)
        {
          alert("Erro: Intervalo entre "+date1+" e "+date+" não pode ultrapassar "+interval+" dias");
          return false;
        }
      }

      switch(test)
      {
        case "=":
          if (!( dt == dt1))
          {
            return_var = false;
            error = 'igual';
          }
        break;
        case "<":
          if (!( dt < dt1))
          {
            return_var = false;
            error = 'menor';
          } 
        break;
        case "<=":
          if (!( dt <= dt1))
          {
            return_var = false;
            error = 'menor ou igual';
          }
        break;
        case ">":
          if (!( dt > dt1))
          {
            return_var = false;
            error = 'maior';
          }
        break;
        case ">=":
          if (!( dt >= dt1))
          {
            return_var = false;
            error = 'maior ou igual';
          }
        break;
      }

      var str = error + ((test == '>' || test == '<') ?  ' do que ' : ' á ');
      error = ( label ? label : 'Valor: '+ date ) +' Deve ser '+ str + date1;
    }
    else
    {
      if (dt2 && ! ((dt >= dt1) && (dt <= dt2)) )
      {
        return_var = false;
        error = ( label ? label : 'Valor: '+ date ) +' Deve estar entre '+date1+' e '+date2+'.';
      }
    }

    if (return_var == false)
    {
      error = myError ? myError : error;
      switch(dialogType)
      {
        case "confirm":
          return_var = confirm(error);
        break;
        default:
          jAlert(error, 'Atenção', function(){
            field.focus();
          });
        break;
      }

      //return_var pode ter sido alterada pelo confirm
      if (return_var == false)
        field.value = '';
    }
  }// if (date)
 
  return return_var;
}

function getSeconds(time)
{
  if (!time)
    return false;

  if (time.length >= 16) //variable time carries "date" and "time" values such as "04/05/2007 16:18"
    return Date.UTC(time.substr(6, 4) , time.substr(3, 2) - 1, time.substr(0, 2) , time.substr(11, 2) , time.substr(14, 2));

  var mDate = new Date();
  return Date.UTC(mDate.getFullYear(), mDate.getMonth(), mDate.getDate(), time.substr( 0, 2 ), time.substr( 3, 2 ));
}

function test_time_values(field, time1, time2, test, error, interval, label, obj_field)
{
 
  var value;
  var return_var = true;

  if (typeof(field) == "string")
    value = field; //called from test_timestamp
  else
  {
    value = field.value; //called from test_time
    obj_field = field;
  }

  var ts_time = new Date(value);
  var ts_time1 = new Date(time1);
  var ts_time2 = new Date(time2);


  if (ts_time2 && ts_time >= ts_time1 && ts_time <= ts_time2)
    return true;

  if (!test)
    return true;

  error = '';
  var diff = (ts_time-ts_time1);
  switch(test)
  {
    case "=":
      if (diff != 0) 
      {
        return_var = false;
        error = 'igual';
      }
    break;
    case "<":
      if (diff >= 0) 
      {
        return_var = false;
        error = 'menor';
      } 
    break;
    case "<=":
      if (diff > 0) 
      {
        return_var = false;
        error = 'menor ou igual';
      }
    break;
    case ">":
      if (diff <= 0) 
      {
        return_var = false;
        error = 'maior';
      }
    break;
    case ">=":
      if (diff < 0) 
      {
        return_var = false;
        error = 'maior ou igual';
      }
    break;
  }

  if (error)
  {
    var str = error + ((test == '>' || test == '<') ?  ' do que ' : ' á ');
    error = ( label ? label : 'Valor: ' + value ) +' Deve ser '+str+time1;
  }

  if (Math.abs(diff) < interval)
  {
    return_var = false;
    error = ( label ? label : 'Valor: ' + value ) +' Deve respeitar o intervalo '+interval;
  }

  if (!return_var)
  {
    jAlert(error, 'Atenção', function(){
        obj_field.value = '';
    });

    if (typeof(field) != "string") field.value = '';
  }

  return return_var;
}

//Testa se a hora eh maior, menor ou igual a outra
//ou estah em um intervalo
//campo = campo onde esta se fazendo o teste
//hora1 ou hora2 = valor do campo
//teste = simbolos ('<' ,'>' ,'<=' ,'>=' ,'=')
function test_time(field, time1, time2, test, error, interval, label)
{
  return_var = true;

  if (field.value == '' && !(time1 || time2))
    return true;

  return test_time_values(field, time1, time2, test, error, interval, label);
}

/*
  * Only tests that if date or time has been filled, both might be filled 
*/
function validate_timestamp(dateObject, timeObject)
{
  if ((timeObject.value || dateObject.value) && !(timeObject.value && dateObject.value) )
  {
    alert('Se um valor de um campo DATA HORA for preenchido ambos devem ser prenchidos');
    timeObject.value = '';
    dateObject.value = '';
    dateObject.focus();
    return false;
  }

  return true;
}

/*
  * Test diffs or gaps between timestamps
*/
function test_timestamp(value, time1, time2, test, error, interval, label, obj_field)
{

  if ( (!value || value == ' ') || !(time1 || time2))
    return true;

  return test_time_values(value, time1, time2, test, error, interval, label, obj_field);
}


//Testa se um valor eh maior, menor ou igual a outra
//ou estah em um intervalo
//campo = campo onde esta se fazendo o teste
//data1 ou data2 = valor do campo
//teste = simbolos ('<' ,'>' ,'<=' ,'>=' ,'=' ,'!=')
function test_value(field, value, value1, value2, test, error, formName, intField)
{
  if ( (!value || value == ' ') || !(value1 || value2))
    return true;

  if (intField)
  {
    vlr     = parseInt(value);
    vlr1    = parseInt(value1);
    vlr2    = parseInt(value2);
  }
  else
  {
    vlr     = parseFloat(transform_value(value));
    vlr1    = parseFloat(transform_value(value1));
    vlr2    = parseFloat(transform_value(value2));
  }

  return_var = true;

  if (value != '')
  {

    if ( (value1 != '') && (value2 != ''))//Verificacao de Intervalo
    {
      if ( (vlr < vlr1) || (vlr > vlr2) )
        return_var = false;
    }
    else //test condicional
    {
      if (test == '=')
        if (!(vlr == vlr1))
          return_var = false;

      if (test == '!=')
        if (!(vlr != vlr1))
          return_var = false;

      if (test == '>')
        if (!(vlr > vlr1))
          return_var = false;

      if (test == '>=')
        if (!(vlr >= vlr1))
          return_var = false;

      if (test == '<')
        if (!(vlr < vlr1))
          return_var = false;

      if (test == '<=')
        if (!(vlr <= vlr1))
          return_var = false;
    }

    if (return_var == false)
    {
      alert(error);
      field.value = '';
    }

    return return_var;
  }
  return return_var;
}

/*
Função utilizada para retornar numeros formatados com determinada quantidade de digitos

 exemplos:
   1) 6000 -> 6.000,000
   2) '195,43' -> 19.543,00 

 o segundo exemplo mostra que esta função consegue pegar um valor (string) formatado
 e adiciona/remove casas, ou seja, reformata este dado..  (o que "convert_value" não faz)
*/
function return_formatted_value(value, digits)
{
  tmp_value   = new String(value);
  new_value = new String();

  dec        = 0;
  after_point = false;
  for (i = 0; i < tmp_value.length; i++)
  {
    if (tmp_value.charAt(i) != ',')
      new_value = new_value + tmp_value.charAt(i);
    
    if (!after_point)
    {
      if (tmp_value.charAt(i) == '.')
        after_point = true;
    }
    else
      dec++;
  }//for (i = 0; i < actual_size; i++)

  tmp_value = new_value;
  new_value = '';
  thousand_sep = 0;
  for (i = tmp_value.length; i >= 0; i--)
  {
    if ((tmp_value.charAt(i) == '.'))
      new_value = ',' + new_value;
    else
      new_value = tmp_value.charAt(i) + new_value;

    if ((tmp_value.charAt(i) == ',') || (tmp_value.charAt(i) == '.'))
      thousand_sep = 0;

    if ((thousand_sep == 3) && i)
    {
      new_value = '.' + new_value;
      thousand_sep = 0;
    }
      
    thousand_sep++;
  }//for (i = tmp_value.length; i >= 0; i--)

  if ((dec == 0) && (digits > 0))
    new_value = new_value + ',';

  for (i = dec; i < digits; i++)
    new_value = new_value + '0';
      
  return  new_value;
}

function add_digits(value, digits)
{
  if (value.length <= digits)
  {
    for(i = 0; i < digits; i++)
      value += 0;
  }

  return value;
}

function format_money(value, digits)
{
  virgula   = false;
  precisao  = false;
  new_value = "";
  j         = 0;

  //retira caracteres não numéricos 
  for (i = 0; i < value.length; i++)
  {
    if (value.charAt(i) != "." && value.charAt(i) != ",")
      new_value += value.charAt(i);
    else
      precisao = true;
  }
  
  //complementa o valor com 0(s)
  if (precisao == false)
  {
    for(i = 0; i < digits; i++)
      new_value += 0;
  }
  else
  {
    if (new_value.length <= digits)
    {
      for(i = 0; i < ((digits + 1) - digits); i++)
        new_value += 0;
    }
  }
  
  value = "";
  
  //formata com . e ,
  for (i = (new_value.length - 1); i >= 0; i--)
  { 
    j++;
    
    value = new_value.charAt(i) + value;

    if (j == digits && virgula == false && i != 0)
    {
      virgula  = true;
      value    = "," + value;
      j        = 0;
    }
    else
    {
      if (j == 3 && i != 0)
      {
        value = "." + value;
        j     = 0;
      }
    }
  }//for (i = (new_value.length - 1); i >= 0; i--)
  
  return value;
}



/*
 *
 *        MD5 IMPLEMENTATION
 *
 *
 */


/*
 * A JavaScript implementation of the RSA Data Security, Inc. MD5 Message
 * Digest Algorithm, as defined in RFC 1321.
 * Version 1.1 Copyright (C) Paul Johnston 1999 - 2002.
 * Code also contributed by Greg Holt
 * See http://pajhome.org.uk/site/legal.html for details.
 */

/*
 * Add integers, wrapping at 2^32. This uses 16-bit operations internally
 * to work around bugs in some JS interpreters.
 */
function safe_add(x, y)
{
  var lsw = (x & 0xFFFF) + (y & 0xFFFF)
  var msw = (x >> 16) + (y >> 16) + (lsw >> 16)
  return (msw << 16) | (lsw & 0xFFFF)
}

/*
 * Bitwise rotate a 32-bit number to the left.
 */
function rol(num, cnt)
{
  return (num << cnt) | (num >>> (32 - cnt))
}

/*
 * These functions implement the four basic operations the algorithm uses.
 */
function cmn(q, a, b, x, s, t)
{
  return safe_add(rol(safe_add(safe_add(a, q), safe_add(x, t)), s), b)
}
function ff(a, b, c, d, x, s, t)
{
  return cmn((b & c) | ((~b) & d), a, b, x, s, t)
}
function gg(a, b, c, d, x, s, t)
{
  return cmn((b & d) | (c & (~d)), a, b, x, s, t)
}
function hh(a, b, c, d, x, s, t)
{
  return cmn(b ^ c ^ d, a, b, x, s, t)
}
function ii(a, b, c, d, x, s, t)
{
  return cmn(c ^ (b | (~d)), a, b, x, s, t)
}

/*
 * Calculate the MD5 of an array of little-endian words, producing an array
 * of little-endian words.
 */
function coreMD5(x)
{
  var a =  1732584193
  var b = -271733879
  var c = -1732584194
  var d =  271733878

  for(i = 0; i < x.length; i += 16)
  {
    var olda = a
    var oldb = b
    var oldc = c
    var oldd = d

    a = ff(a, b, c, d, x[i+ 0], 7 , -680876936)
    d = ff(d, a, b, c, x[i+ 1], 12, -389564586)
    c = ff(c, d, a, b, x[i+ 2], 17,  606105819)
    b = ff(b, c, d, a, x[i+ 3], 22, -1044525330)
    a = ff(a, b, c, d, x[i+ 4], 7 , -176418897)
    d = ff(d, a, b, c, x[i+ 5], 12,  1200080426)
    c = ff(c, d, a, b, x[i+ 6], 17, -1473231341)
    b = ff(b, c, d, a, x[i+ 7], 22, -45705983)
    a = ff(a, b, c, d, x[i+ 8], 7 ,  1770035416)
    d = ff(d, a, b, c, x[i+ 9], 12, -1958414417)
    c = ff(c, d, a, b, x[i+10], 17, -42063)
    b = ff(b, c, d, a, x[i+11], 22, -1990404162)
    a = ff(a, b, c, d, x[i+12], 7 ,  1804603682)
    d = ff(d, a, b, c, x[i+13], 12, -40341101)
    c = ff(c, d, a, b, x[i+14], 17, -1502002290)
    b = ff(b, c, d, a, x[i+15], 22,  1236535329)

    a = gg(a, b, c, d, x[i+ 1], 5 , -165796510)
    d = gg(d, a, b, c, x[i+ 6], 9 , -1069501632)
    c = gg(c, d, a, b, x[i+11], 14,  643717713)
    b = gg(b, c, d, a, x[i+ 0], 20, -373897302)
    a = gg(a, b, c, d, x[i+ 5], 5 , -701558691)
    d = gg(d, a, b, c, x[i+10], 9 ,  38016083)
    c = gg(c, d, a, b, x[i+15], 14, -660478335)
    b = gg(b, c, d, a, x[i+ 4], 20, -405537848)
    a = gg(a, b, c, d, x[i+ 9], 5 ,  568446438)
    d = gg(d, a, b, c, x[i+14], 9 , -1019803690)
    c = gg(c, d, a, b, x[i+ 3], 14, -187363961)
    b = gg(b, c, d, a, x[i+ 8], 20,  1163531501)
    a = gg(a, b, c, d, x[i+13], 5 , -1444681467)
    d = gg(d, a, b, c, x[i+ 2], 9 , -51403784)
    c = gg(c, d, a, b, x[i+ 7], 14,  1735328473)
    b = gg(b, c, d, a, x[i+12], 20, -1926607734)

    a = hh(a, b, c, d, x[i+ 5], 4 , -378558)
    d = hh(d, a, b, c, x[i+ 8], 11, -2022574463)
    c = hh(c, d, a, b, x[i+11], 16,  1839030562)
    b = hh(b, c, d, a, x[i+14], 23, -35309556)
    a = hh(a, b, c, d, x[i+ 1], 4 , -1530992060)
    d = hh(d, a, b, c, x[i+ 4], 11,  1272893353)
    c = hh(c, d, a, b, x[i+ 7], 16, -155497632)
    b = hh(b, c, d, a, x[i+10], 23, -1094730640)
    a = hh(a, b, c, d, x[i+13], 4 ,  681279174)
    d = hh(d, a, b, c, x[i+ 0], 11, -358537222)
    c = hh(c, d, a, b, x[i+ 3], 16, -722521979)
    b = hh(b, c, d, a, x[i+ 6], 23,  76029189)
    a = hh(a, b, c, d, x[i+ 9], 4 , -640364487)
    d = hh(d, a, b, c, x[i+12], 11, -421815835)
    c = hh(c, d, a, b, x[i+15], 16,  530742520)
    b = hh(b, c, d, a, x[i+ 2], 23, -995338651)

    a = ii(a, b, c, d, x[i+ 0], 6 , -198630844)
    d = ii(d, a, b, c, x[i+ 7], 10,  1126891415)
    c = ii(c, d, a, b, x[i+14], 15, -1416354905)
    b = ii(b, c, d, a, x[i+ 5], 21, -57434055)
    a = ii(a, b, c, d, x[i+12], 6 ,  1700485571)
    d = ii(d, a, b, c, x[i+ 3], 10, -1894986606)
    c = ii(c, d, a, b, x[i+10], 15, -1051523)
    b = ii(b, c, d, a, x[i+ 1], 21, -2054922799)
    a = ii(a, b, c, d, x[i+ 8], 6 ,  1873313359)
    d = ii(d, a, b, c, x[i+15], 10, -30611744)
    c = ii(c, d, a, b, x[i+ 6], 15, -1560198380)
    b = ii(b, c, d, a, x[i+13], 21,  1309151649)
    a = ii(a, b, c, d, x[i+ 4], 6 , -145523070)
    d = ii(d, a, b, c, x[i+11], 10, -1120210379)
    c = ii(c, d, a, b, x[i+ 2], 15,  718787259)
    b = ii(b, c, d, a, x[i+ 9], 21, -343485551)

    a = safe_add(a, olda)
    b = safe_add(b, oldb)
    c = safe_add(c, oldc)
    d = safe_add(d, oldd)
  }
  return [a, b, c, d]
}

/*
 * Convert an array of little-endian words to a hex string.
 */
function binl2hex(binarray)
{
  var hex_tab = "0123456789abcdef"
  var str = ""
  for(var i = 0; i < binarray.length * 4; i++)
  {
    str += hex_tab.charAt((binarray[i>>2] >> ((i%4)*8+4)) & 0xF) +
           hex_tab.charAt((binarray[i>>2] >> ((i%4)*8)) & 0xF)
  }
  return str
}

/*
 * Convert an array of little-endian words to a base64 encoded string.
 */
function binl2b64(binarray)
{
  var tab = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/"
  var str = ""
  for(var i = 0; i < binarray.length * 32; i += 6)
  {
    str += tab.charAt(((binarray[i>>5] << (i%32)) & 0x3F) |
                      ((binarray[i>>5+1] >> (32-i%32)) & 0x3F))
  }
  return str
}

/*
 * Convert an 8-bit character string to a sequence of 16-word blocks, stored
 * as an array, and append appropriate padding for MD4/5 calculation.
 * If any of the characters are >255, the high byte is silently ignored.
 */
function str2binl(str)
{
  var nblk = ((str.length + 8) >> 6) + 1 // number of 16-word blocks
  var blks = new Array(nblk * 16)
  for(var i = 0; i < nblk * 16; i++) blks[i] = 0
  for(var i = 0; i < str.length; i++)
    blks[i>>2] |= (str.charCodeAt(i) & 0xFF) << ((i%4) * 8)
  blks[i>>2] |= 0x80 << ((i%4) * 8)
  blks[nblk*16-2] = str.length * 8
  return blks
}

/*
 * Convert a wide-character string to a sequence of 16-word blocks, stored as
 * an array, and append appropriate padding for MD4/5 calculation.
 */
function strw2binl(str)
{
  var nblk = ((str.length + 4) >> 5) + 1 // number of 16-word blocks
  var blks = new Array(nblk * 16)
  for(var i = 0; i < nblk * 16; i++) blks[i] = 0
  for(var i = 0; i < str.length; i++)
    blks[i>>1] |= str.charCodeAt(i) << ((i%2) * 16)
  blks[i>>1] |= 0x80 << ((i%2) * 16)
  blks[nblk*16-2] = str.length * 16
  return blks
}

/*
 * External interface
 */
function hexMD5 (str) {return binl2hex(coreMD5( str2binl(str)))}
function hexMD5w(str) {return binl2hex(coreMD5(strw2binl(str)))}
function b64MD5 (str) {return binl2b64(coreMD5( str2binl(str)))}
function b64MD5w(str) {return binl2b64(coreMD5(strw2binl(str)))}
/* Backward compatibility */
function calcMD5(str) {return binl2hex(coreMD5( str2binl(str)))}


/* ############ FUNCÕES DO EDITOR HTML  ################### */

function storeCaret(textEl)
{
  if (textEl.createTextRange) textEl.caretPos = document.selection.createRange().duplicate();
}

//Link
function LINK(formName, fieldName)
{
  var url = window.prompt("Digite o endereco:","");

  if (url !=null)
  {
  var link = window.prompt("Digite o texto:","")

  if (link !=null)
  {
    tmp = eval("document." + formName + "['" + fieldName + "']");
    text = ("<A HREF='HTTP://" + url + "' target='_blank' class='index_link'><U>" + link + "</U></A>\n");

    if (tmp.createTextRange && tmp.caretPos)
    {
      var caretPos = tmp.caretPos;
      caretPos.text = caretPos.text.charAt(caretPos.text.length - 1) == ' ' ? text + ' ' : text;
      tmp.focus();
    }
    else
    {
      tmp.value += ("<A HREF='HTTP://" + url + "' target='_blank' class='index_link'><U>" +
                 link + "</U></A>\n");
      tmp.focus();
    }
  }
  }
}

//Negrito
function B(formName, fieldName)
{
  var B = window.prompt("Digite o texto em negrito:","")
  if (B != null)
  {
  tmp = eval("document." + formName + "['" + fieldName + "']");
  text = "<B>" + B + "</B>";

  if (tmp.createTextRange && tmp.caretPos)
  {
    var caretPos = tmp.caretPos;
    caretPos.text = caretPos.text.charAt(caretPos.text.length - 1) == ' ' ? text + ' ' : text;
    tmp.focus();
  }
  else
  {
    tmp.value += ("<B>" + B + "</B>\n");
    tmp.focus();
  }
  }
}

//Itálico
function I(formName, fieldName)
{
  var I = window.prompt("Digite o texto em itálico:","")
  if (I != null)
  {
  tmp = eval("document." + formName + "['" + fieldName + "']");
  text = "<I>" + I + "</I>";

  if (tmp.createTextRange && tmp.caretPos)
  {
    var caretPos = tmp.caretPos;
    caretPos.text = caretPos.text.charAt(caretPos.text.length - 1) == ' ' ? text + ' ' : text;
    tmp.focus();
  }
  else
  {
    tmp.value += ("<I>" + I + "</I>\n");
    tmp.focus();
  }
  }
}

//Sublinhado
function U(formName, fieldName)
{
  var U = window.prompt("Digite o texto a ser sublinhado:","")
  if (U != null)
  {
  tmp = eval("document." + formName + "['" + fieldName + "']");
  text = "<U>" + U + "</U>";

  if (tmp.createTextRange && tmp.caretPos)
  {
    var caretPos = tmp.caretPos;
    caretPos.text = caretPos.text.charAt(caretPos.text.length - 1) == ' ' ? text + ' ' : text;
    tmp.focus();
  }
  else
  {
    tmp.value += ("<U>" + U + "</U>\n");
    tmp.focus();
  }
  }
}

//BR
function BR(formName, fieldName)
{
  tmp = eval("document." + formName + "['" + fieldName + "']");
  text = "<BR>";

  if (tmp.createTextRange && tmp.caretPos)
  {
  var caretPos = tmp.caretPos;
  caretPos.text = caretPos.text.charAt(caretPos.text.length - 1) == ' ' ? text + ' ' : text;
  tmp.focus();
  }
  else
  {
  tmp.value += ("<BR>\n");
  tmp.focus();
  }
}

//Espaço
function E(formName, fieldName)
{
  tmp = eval("document." + formName + "['" + fieldName + "']");
  text = "&nbsp;";

  if (tmp.createTextRange && tmp.caretPos)
  {
  var caretPos = tmp.caretPos;
  caretPos.text = caretPos.text.charAt(caretPos.text.length - 1) == ' ' ? text + ' ' : text;
  tmp.focus();
  }
  else
  {
  tmp.value += ("&nbsp;\n");
  tmp.focus();
  }
}

//Imagem
/*
function IMG(formName, fieldSelect, fieldText)
{

  tmp  = eval("document." + formName + "['" + fieldSelect + "']");
    tmp2 = eval("document." + formName + "['" + fieldText + "']");

  text = ' <img src="images/'+tmp[tmp.selectedIndex].value+'" border="0" align="" width="" height"">';

    if (tmp2.createTextRange && tmp2.caretPos)
  {
        var caretPos = tmp2.caretPos;
    caretPos.text = caretPos.text.charAt(caretPos.text.length - 1) == ' ' ? text + ' ' : text;
    tmp2.focus();
  }
  else
  {
    tmp2.value  += text;
    tmp2.focus();
  }
}
*/
function IMG(formName, fieldText, text)
{

  field = eval("document." + formName + "['" + fieldText + "']");

  if (field.createTextRange && field.caretPos)
  {
    var caretPos = field.caretPos;
    caretPos.text = caretPos.text.charAt(caretPos.text.length - 1) == ' ' ? text + ' ' : text;
    field.focus();
  }
  else
  {
    field.value  += text;
    field.focus();
  }
}


//Alinhamento
function ALIGN(formName, fieldSelect, fieldText)
{

  tmp  = eval("document." + formName + "['" + fieldSelect + "']");
    tmp2 = eval("document." + formName + "['" + fieldText + "']");

  text = '<div align="'+tmp[tmp.selectedIndex].value+'"> </div>';

    if (tmp2.createTextRange && tmp2.caretPos)
  {
        var caretPos = tmp2.caretPos;
    caretPos.text = caretPos.text.charAt(caretPos.text.length - 1) == ' ' ? text + ' ' : text;
    tmp2.focus();
  }
  else
  {
    tmp2.value  += text;
    tmp2.focus();
  }
}

/* DUALLIST */

function compareOptionValues (a, b)
{
  var sA = a.text;
  var sB = b.text;

  if (!isNaN(sA) && !isNaN(sB))
    return sA - sB;
  else if (sA == sB)
    return 0;
  else
    return sA < sB ? -1 : 1;
}

function moveDualList (srcList, destList, moveAll, selected)
{
  if ((srcList.selectedIndex == -1) && (moveAll == false))
    return false;

  newDestList = new Array();

  var end = 0;

  for (end = 0; end < destList.options.length; end++)
  {
    if (destList.options[end] != null)
      newDestList[end] = new Option(destList.options[end].text, destList.options[end].value);
  }

  for (var i = 0; i < srcList.options.length; i++)
  {
    if (srcList.options[i] != null && (srcList.options[i].selected == true || moveAll))
    {
      newDestList[end] = new Option(srcList.options[i].text, srcList.options[i].value);
      end++;
    }
  }

  newDestList.sort(compareOptionValues);

  for (var j = 0; j < newDestList.length; j++)
  {
    if (newDestList[j] != null)
      destList.options[j] = newDestList[j];
  }

  for (var i = srcList.options.length - 1; i >= 0; i--)
  {
    if (srcList.options[i] != null && (srcList.options[i].selected == true || moveAll))
      srcList.options[i] = null;
  }
}

function SelectDualListOptions (field)
{
  for(i = 0; i < dual_list.options.length; i++)
    dual_list.options[i].selected = true;
}

function transform_array(object)
{
  selLength = object.length;
  var i;
  var arr_options;
  
  arr_options = '';
  
  if (selLength > 0)
  {
    arr_options = '(';
    for(i=selLength-1; i>=0; i--)
    {
      arr_options = arr_options + object.options[i].value;
      if (i==0)
        arr_options = arr_options + ')';
      else
        arr_options = arr_options + ', ';
    }
  }

  return arr_options;
}

function format_processo(object, e)
{
  var code = getKeyCode(e);

  if (object.readOnly && !is_valid_navigation(code))
    return false;

  if (is_selected_or_selecting(e, code, object))
    return true;

  actual_size = object.value.length;

  if ( ( is_valid_numeric(code) && ( (actual_size) <= (11) ) ) ||
       is_valid_navigation(code))
  {
    if (is_valid_navigation(code))
      return true;

    object_value_fmt = "";
    object.value = object.value + String.fromCharCode(code);

    for (i = 0; i < object.value.length; i++)
    {
      if ((i == 1) && (object.value.charAt(i) != '-'))
		  object_value_fmt = object_value_fmt + '-'; 

	  if ((i == 6) && (object.value.charAt(i) != '/'))
	            object_value_fmt = object_value_fmt + '/';
	          
      object_value_fmt = object_value_fmt + object.value.charAt(i);
    }
    object.value = object_value_fmt;

    return false;
  }
  else
    return false;
} 

function format_economia(object, e)
{
  var code = getKeyCode(e);

  if (object.readOnly && !is_valid_navigation(code))
    return false;

  if (is_selected_or_selecting(e, code, object))
    return true;

  actual_size = object.value.length;

  if ( ( is_valid_numeric(code) && ( (actual_size) <= (15) ) ) ||
       is_valid_navigation(code) )
  {
    if (is_valid_navigation(code))
      return true;

    object_value_fmt = "";
    object.value = object.value + String.fromCharCode(code);

    for (i = 0; i < object.value.length; i++)
    {
      if ( (i == 3 || i == 8 || i == 12) && object.value.charAt(i) != '.')
        object_value_fmt = object_value_fmt + '.';

      object_value_fmt = object_value_fmt + object.value.charAt(i);
    }
    object.value = object_value_fmt;

    return false;
  }
  else
    return false;
}

function format_alvara(object, e)
{
  var code = getKeyCode(e);

  if (object.readOnly && !is_valid_navigation(code))
    return false;

  actual_size = object.value.length;

  if ( ( is_valid_numeric(code) && ( (actual_size) <= (8) ) ) ||
       is_valid_navigation(code) )
  {
    if (is_valid_navigation(code))
      return true;

    object_value_fmt = "";
    object.value = object.value + String.fromCharCode(code);

    for (i = 0; i < object.value.length; i++)
    {
	  if ((i == 3) && (object.value.charAt(i) != '/'))
	            object_value_fmt = object_value_fmt + '/';
	          
      object_value_fmt = object_value_fmt + object.value.charAt(i);
    }
    object.value = object_value_fmt;

    return false;
  }
  else
    return false;
} 

/*
 * Formata a viagem, colocando a barra separadora automaticamente
 * e permitindo somente a digitacao de numeros
 * Deve ser colocado no evento onKeyPress
*/
function format_viagem(object, e)
{
  var code = getKeyCode(e);

  if (object.readOnly && !is_valid_navigation(code))
    return false;

  if (is_selected_or_selecting(e, code, object))
    return true;

  actual_size = object.value.length;

  if ( ( is_valid_numeric(code) && ( (actual_size) < (8) ) ) ||
       is_valid_navigation(code) )
  {
    if (is_valid_navigation(code))
      return true;

    object_value_fmt = "";
    object.value = object.value + String.fromCharCode(code);

    for (i = 0; i < object.value.length; i++)
    {
      if ( i == 2 && object.value.charAt(i) != '/')
        object_value_fmt = object_value_fmt + '/';

      object_value_fmt = object_value_fmt + object.value.charAt(i);
    }

    object.value = object_value_fmt;

    return false;
  }
  else
    return false;

}

/* 
 * Verifica se a viagem é valida, utilizado no onBlur
*/
function validate_viagem(object, error, formName)
{
  var_return = true;

  if (object.value == undefined)
  {
    cmp = eval("document." + formName + "['" + object + "']");
    object_value = cmp.value;
  }
  else
    object_value = object.value;

  if (object_value.length > 0)
  {
    viagem = new RegExp('^[0-9]{2}/[0-9]{5}', 'i');
    if (!viagem.exec(object_value))
    {
      alert(error);
      object.value = '';
      var_return = false;
    }
  }

  return  var_return;
}

/*
 * Formata a placa, colocando o hifen separador automaticamente
 * e permitindo somente a digitacao caracteres antes e de numeros depois do hifen
 * Deve ser colocado no evento onKeyPress
*/
function format_placa(object, e)
{
  var code = getKeyCode(e);

  if (object.readOnly && !is_valid_navigation(code))
    return false;

  if (is_selected_or_selecting(e, code, object, "placa"))
    return true;
  
  //actual size + the new character which will be added in the next event
  var size = object.value.length + 1;
  var reg  = "^[a-zA-Z]{1,3}";

  if (size == 3)
  {
    object.value += String.fromCharCode(code) + "-";
    return false;
  }
  else if (size >= 4)
    reg += "-[0-9]{1,4}";

  reg += "$";

  var regEx = RegExp(reg); 
  return regEx.test( object.value + String.fromCharCode(code) );
}

/* 
 * Verifica se a placa é valida, utilizado no onBlur
*/
function validate_placa(object, error, formName)
{
  var_return = true;

  if (!object.value)
    return true;

  placa = new RegExp("^[a-zA-Z]{3}-[0-9]{4}$");
  if (!placa.test(object.value))
  {
    alert(error);
    object.value = '';
    var_return = false;
  }

  return  var_return;
}

/* 
 * Verifica se o processo é valido, utilizado no onBlur
*/
function validate_processo(object, error, formName)
{
  var_return = true;

  if (object.value == undefined)
  {
    cmp = eval("document." + formName + "['" + object + "']");
    object_value = cmp.value;
  }
  else
    object_value = object.value;

  if (object_value.length > 0)
  {
    placa = new RegExp('^[0-9]-[0-9]{4}/[0-9]{5}', 'i');
    if (!placa.exec(object_value))
    {
      alert(error);
      object.value = '';
      var_return = false;
    }
  }

  return  var_return;
}

function abre_relatorio_()
{
  pop_open('', 500, 450, 'relatorio', 'yes'); // O navegador resolve como abrir o relatorio (windows abre em nova aba)
}

/*
  * Forca a limpeza de todos os valores de campos de um dado form, já que o type='reset' do HTML apenas
    retorna os valores ao seu estado default que não necessariamente é vazio 

  * OBS: jaguar perde a configuração se campos hidden forem anulados
    alterado de --> http://www.irt.org/script/940.htm
*/
function resetDefaultValues(what) {
    for (var i=0, j=what.elements.length; i<j; i++) {
      myType = what.elements[i].type;

      switch (myType)
      {
        case "checkbox":
          what.elements[i].checked = false;
        break;
      
        case "radio":
          what.elements[i].checked = false;
        break;
        
        case "password":
          what.elements[i].value = '';
        break;

        case "text":
          what.elements[i].value = '';
        break;

        case "textarea":
          what.elements[i].value = '';
        break;

        case "select-one":
              what.elements[i].options.selectedIndex = 0;
        break;

        case "select-multiple":
          for (var k=0, l=what.elements[i].options.length; k<l; k++)
              what.elements[i].options[k].selected = false;
        break;
      }
    }
  what.elements[1].focus();
}

function getKeyCode(e)
{
  if (window.event) 
    return event.keyCode;

  return e.which;
}

function changeFocusUsingEnter(componentId, evt)
{
  var obj = document.getElementById(componentId);
  var code = getKeyCode(evt);

  if (code == 13) 
  {
    var nextId = '';
    var i=1;
    do
    {
      nextId = (parseInt(componentId)+(i++));
    }
    while(document.getElementById(nextId).disabled || document.getElementById(nextId).readOnly );

    document.getElementById(nextId).focus();
    return false;
  }

  /*107 == '+' 61 == '+'*/
  if ((code == 107 || code == 61) && (obj.form != null))
    obj.form.submit();

  return true;
}

function submitOnEnterEvent(componentId, evt)
{
  var obj = document.getElementById(componentId);
  var code = getKeyCode(evt);

  if (code == 13 && obj.form != null) 
  {
    /*
      * Por quesão de compatibilidade procura o botao de submit do form para poder enviar por post ao submitar o form
    o IE ja faz isto sosinho no método form.submit();
    */
    if (navigator.userAgent.toLowerCase().indexOf("msie") != -1 && (obj.type != "select-one")) 
      obj.form.onSubmit();
    else
    {
      /*
        * Por padrão o form é enviado quando a tecla enter é pressionada, logo apenas é preciso
        tratar o click do enter quando o item for um select
      */
      if (obj.type != "select-one")
        return true;

      var submitBtn;
      var myForm = obj.form;

      //a maioria dos arquivos utiliza f_submit como nome padrão de submit
      if (myForm.f_submit)
        submitBtn = obj.form.f_submit;
      else
      {
        //senao usa procura no form o primeiro submit
        for (var i=0; i<myForm.elements.length; i++) 
          if (myForm.elements[i].type == "submit" || myForm.elements[i].type == "button")
          {
            submitBtn = myForm.elements[i];
            break;
          }
      }

      submitBtn.click();
    }

  }

  return true;
}


function ChangeRecordLimit(field, formName)
{
  document[formName]['f_limit'].value = field.value;
  document[formName].submit();
}


function validate_passwd(object, re, minimumChars)
{
  var regEx = RegExp(re); 
  var div = document.getElementById(object.name+"_message"); 

  var ERaz = /[a-zA-Z]/;
  var ER09 = /[0-9]/;
  var ERxx = /[!@#%\(\):.\-<>,\+=\*\-]/;

  if(object.value.length == 0)
     div.innerHTML = 'Segurança da senha!';
  else
  {
    if (!regEx.test(object.value))
    {
       div.innerHTML = '<font color=\'red\'> Caracteres Inválidos</font>';
       return;
    }
    if(object.value.length < minimumChars)
       div.innerHTML = 'Segurança da senha: <font color=\'red\'> BAIXA</font>';
    else
    {
      if (ERxx.test(object.value) && ERaz.test(object.value) && ER09.test(object.value))
         div.innerHTML = 'Segurança da senha: <font color=\'orange\'> ALTA</font>';
      else
      {
        if ((ERaz.test(object.value) && ER09.test(object.value)) || (ERaz.test(object.value) && ERxx.test(object.value))
        || (ER09.test(object.value) && ERxx.test(object.value)) )
           div.innerHTML = 'Segurança da senha: <font color=\'orange\'> MÉDIA</font>';
        else  
          if (ERaz.test(object.value) || ER09.test(object.value))
           div.innerHTML = 'Segurança da senha: <font color=\'red\'> BAIXA</font>';
      }
    }
  }
}


function test_passwd(obj, label, error)
{
  var div = document.getElementById(obj.name + "_message"); 

  if (div.innerHTML.indexOf("BAIXA") != -1)
  {
    alert(label+': '+error);
    obj.value = '';
    obj.focus();
    return false;
  }

  return true;
}


function openWindow(num)
{
  var id = "data_"+num;
  var obj = document.getElementById(id);
  if(obj.style.visibility == "hidden")
  {
    obj.style.visibility = "visible";
    obj.className = "windowOpenned";
  }
  else
    obj.style.visibility = "hidden";

}


//verifica um minimo de filtros passados
function verifica_minimo_preenchidos(desconsiderados, container, id_alert)
{
  if (!container)
    container = 'form';

  var myForm = document[container];

  var count = 0;

  for (var i=0; i<myForm.elements.length; i++) 
  {
    var type = myForm.elements[i].type;

    if (type != 'hidden' && type != 'submit') 
      if (myForm.elements[i].value)
        count++;
  }

  if (count <= desconsiderados)
  {
    if (id_alert)
    {
      alert('Preencha pelo menos um filtro significativo!');
      return false;
    }
    else
      return confirm('Atenção: Nenhum filtro significativo selecionado, deseja continuar?');
  }

  return true;
}


/* 
  * Altera o CSS do componente quando o campo perde o foco, (onBlur)    
  */   
 function _cssOnBlur(id_componente)    
 {   
   obj = document.getElementById(id_componente);   
   if (!obj.readOnly)    
     obj.className = 'input';    
 }   
     
 /*    
   * Altera o CSS do componente quando o campo recebe o foco, (onFocus)    
  */   
 function _cssOnFocus(id_componente)   
 {   
   obj = document.getElementById(id_componente);   
   if (!obj.readOnly)    
     obj.className = 'selectOver';   
 }

 function function_exists( function_name )
 {
   // http://kevin.vanzonneveld.net
   // +   original by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
   // +   improved by: Steve Clay
   // +   improved by: Legaev Andrey
   // *     example 1: function_exists('isFinite');
   // *     returns 1: true
 
   if (typeof function_name == 'string'){
     return (typeof window[function_name] == 'function');
   } else {
     return (function_name instanceof Function);
   }
 }

function confirm_deletion(form_name)
{
  obj = eval('document.' + form_name);

  //Occurs in deletions/updates
  if (obj.f_action.length == 2)
  {
    if (obj.f_action[1].checked)
    {
      return confirm('Você tem certeza que deseja excluir o registro?')
    }
    else
      return true;
  }
  else
    return true;

  return true;
}

function format_regex(e, object, regex)
{
  if (!String.fromCharCode(getKeyCode(e)).match(regex))
    return true;

  if (object.readOnly && !is_valid_navigation(getKeyCode(e)))
    return false;

  if (is_selected_or_selecting(e, getKeyCode(e), object))
    return true;

  return is_valid_navigation(getKeyCode(e));
}

function setCookie(c_name,value,exdays)
{
var exdate=new Date();
exdate.setDate(exdate.getDate() + exdays);
var c_value=escape(value) + ((exdays==null) ? "" : "; expires="+exdate.toUTCString());
document.cookie=c_name + "=" + c_value + '; path=/';
}

function getCookie(c_name)
{
var i,x,y,ARRcookies=document.cookie.split(";");
for (i=0;i<ARRcookies.length;i++)
{
  x=ARRcookies[i].substr(0,ARRcookies[i].indexOf("="));
  y=ARRcookies[i].substr(ARRcookies[i].indexOf("=")+1);
  x=x.replace(/^\s+|\s+$/g,"");
  if (x==c_name)
    {
    return unescape(y);
    }
  }
}

function adiciona_campos(nameCampoInicial, linhaBase, tablePrincipal, quantidadeMax, botaoAdd, contador, header, ultimaLinha, qtInicial, frame, id)
{
  var style1 = "";
  var style2 = "";
  
  if($('#'+linhaBase).attr('class') == 'roweven')
  {
    style2 = 'class=\"rowodd\" onmouseover=\"javascript:this.className=\'rowodd-hi\'\" onmouseout=\"javascript:this.className=\'rowodd\'\"';
    style1 = 'class=\"roweven\" onmouseover=\"javascript:this.className=\'roweven-hi\'\" onmouseout=\"javascript:this.className=\'roweven\'\"';
  }
  else
  {
    style1 = 'class=\"rowodd\" onmouseover=\"javascript:this.className=\'rowodd-hi\'\" onmouseout=\"javascript:this.className=\'rowodd\'\"';
    style2 = 'class=\"roweven\" onmouseover=\"javascript:this.className=\'roweven-hi\'\" onmouseout=\"javascript:this.className=\'roweven\'\"';    
  }
  
  if (id)
  {
    style1 = 'id=\"' + id + '\"' + ' ' + style1;
    style2 = 'id=\"' + id + '\"' + ' ' + style2;
  }
  
  if (qtInicial == '' || qtInicial == undefined) qtInicial = 1;
  
  var qt = 1;
 
  $(':input[name^='+nameCampoInicial+']').each(function(){
    qt = parseFloat($(this).attr('name').substr($(this).attr('name').lastIndexOf('_') + 1));
  });

  qt++;
  $(':input[name='+contador+']').val(qt);

  //Ajusta o name do campo, id, class etc
  linhaBase = $('#'+linhaBase).html().replace(new RegExp('_' + qtInicial, 'g'), '_'+qt);
  
  //Ajusta parâmetros passados para funçõe JS nos eventos (ATENÇÃO)
  linhaBase = linhaBase.replace(new RegExp('\'' + qtInicial + '\'', 'g'), '\''+qt+'\'');
    
  //Concatena uma nova linha
  linhaBase = '<tr ' + ((qt%2) == 0 ? style2 : style1) + '>' + linhaBase + '</tr>';

  //Adiciona a nova linha na tabela
  if (!ultimaLinha)
    $('.'+tablePrincipal+':first tr:last').before(linhaBase);
  else
    $('.'+tablePrincipal+' #' + ultimaLinha).before(linhaBase);


  //Apaga valor dos novos campos
  $('.'+tablePrincipal+' :input[name$=_'+qt+']').each(function(){

    if ($(this).prop('disabled') == false)
      $(this).val('');
    else
    {
      $(this).trigger('change');
      $(this).trigger('blur');
    }

    if ($(this).hasClass('hasDatepicker'))
    {
      $(this).removeClass('hasDatepicker');
      $(this).datepicker({
        dateFormat: 'dd/mm/yy',
        dayNames: ['Domingo','Segunda','Terça','Quarta','Quinta','Sexta','Sábado','Domingo'],
        dayNamesMin: ['D','S','T','Q','Q','S','S','D'],
        dayNamesShort: ['Dom','Seg','Ter','Qua','Qui','Sex','Sáb','Dom'],
        monthNames: ['Janeiro','Fevereiro','Março','Abril','Maio','Junho','Julho','Agosto','Setembro', 'Outubro','Novembro','Dezembro'],
        monthNamesShort: ['Jan','Fev','Mar','Abr','Mai','Jun','Jul','Ago','Set', 'Out','Nov','Dez'],
        nextText: 'Próximo',
        prevText: 'Anterior',
        changeMonth: true,
        changeYear: true,
        showOtherMonths: true, 
        selectOtherMonths: true,
        onSelect: function(){
          $(this).focus()
        } 
      });
    }
  });
  
  if (header != '')
  {
    $('#'+header+qt).html($('#'+header+qt).html().replace('1', qt));
  }
    
  if (frame != '')
    $('#'+frame, parent.document).height($(document).height());

  //Caso tenha quantidade máxima de linhas, elimina o botão de Add quando chegar ao limite
  if (quantidadeMax != '')
  {
    if (qt == quantidadeMax)
      $('#'+botaoAdd).remove();
  }
}

function buscaDadosAjax(classe, acao, param, isPost, isAsync)
{
  var dados;
  var isAsync = (typeof isAsync != 'undefined') ? isAsync : false;

  $.ajax({
    async:    isAsync,
    dataType: "json",
    data:     {c: classe, a: acao, p:param},
    url:      window.API_URL || 'AjaxIframe.php',
    cache:    false,
    type:     (isPost ? 'POST' : 'GET'),
    global:   false,
    success:  function(data)
    {
      dados = data;

      if (dados == null) return;

      // Mostra o erro, se houver
      if (dados.status == 'ERRO')
        console.log('Erro: ' + dados.erro + '!');
    }
  });

  return dados;
}

function buscaDadosAjaxAsync(data, isPost)
{
    return $.ajax({
        async   : true,
        dataType: 'json',
        data    : data,
        url     : window.API_URL || 'AjaxIframe.php',
        cache   : false,
        type    : isPost ? 'POST' : 'GET',
        global  : true
    }).promise();
}

function dadosAjax(classe, acao, parametros)
{
  return {c: classe, a: acao, p:parametros};
}

function manipularStrList(jquerySelector, operacao, valor, separador)
{
  if (!separador) separador = ",";
  
  var formObject = $(jquerySelector);
  var arrDados = formObject.val().split(separador);
  var index = arrDados.indexOf(valor);

  if (operacao === "add" && index === -1)
    arrDados.push(valor);
  else if (operacao === "remove" && index !== -1)
  {
    do
    {
      delete arrDados[index];
      index = arrDados.indexOf(valor);
    }
    while(index !== -1)
  }
  else
    return false;

  formObject.val(arrDados.filter(function(e){return e;}).join(separador)).trigger('change');
  return true;
}