<?php
/*******************************************************************************
* Software: FPDF                                                               *
* Version:  1.52                                                               *
* Date:     2003-12-30                                                         *
* Author:   Olivier PLATHEY                                                    *
* License:  Freeware                                                           *
*                                                                              *
* You may use and modify this software as you wish.                            *
*******************************************************************************/

if(!class_exists('FPDF'))
{
define('FPDF_VERSION','1.52');

class FPDF
{
//Private properties
var $showdate;           //show date in report
var $page;               //current page number
var $n;                  //current object number
var $offsets;            //array of object offsets
var $buffer;             //buffer holding in-memory PDF
var $pages;              //array containing pages
var $state;              //current document state
var $compress;           //compression flag
var $DefOrientation;     //default orientation
var $CurOrientation;     //current orientation
var $OrientationChanges; //array indicating orientation changes
var $k;                  //scale factor (number of points in user unit)
var $fwPt,$fhPt;         //dimensions of page format in points
var $fw,$fh;             //dimensions of page format in user unit
var $wPt,$hPt;           //current dimensions of page in points
var $w,$h;               //current dimensions of page in user unit
var $lMargin;            //left margin
var $tMargin;            //top margin
var $rMargin;            //right margin
var $bMargin;            //page break margin
var $cMargin;            //cell margin
var $x,$y;               //current position in user unit for cell positioning
var $lasth;              //height of last cell printed
var $LineWidth;          //line width in user unit
var $CoreFonts;          //array of standard font names
var $fonts;              //array of used fonts
var $FontFiles;          //array of font files
var $diffs;              //array of encoding differences
var $images;             //array of used images
var $PageLinks;          //array of links in pages
var $links;              //array of internal links
var $FontFamily;         //current font family
var $FontStyle;          //current font style
var $underline;          //underlining flag
var $CurrentFont;        //current font info
var $FontSizePt;         //current font size in points
var $FontSize;           //current font size in user unit
var $DrawColor;          //commands for drawing color
var $FillColor;          //commands for filling color
var $TextColor;          //commands for text color
var $ColorFlag;          //indicates whether fill and text colors are different
var $ws;                 //word spacing
var $AutoPageBreak;      //automatic page breaking
var $PageBreakTrigger;   //threshold used to trigger page breaks
var $InFooter;           //flag set when processing footer
var $ZoomMode;           //zoom display mode
var $LayoutMode;         //layout display mode
var $title;              //title
var $subject;            //subject
var $author;             //author
var $keywords;           //keywords
var $creator;            //creator
var $AliasNbPages;       //alias for total number of pages

/*******************************************************************************
*                                                                              *
*                               Public methods                                 *
*                                                                              *
*******************************************************************************/
function FPDF($orientation='L',$unit='mm',$format='A4')
{
	//Some checks
	$this->_dochecks();
	//Initialization of properties
	$this->showdate=true;
	$this->showpage=0;
	$this->labelpage="Página";
	$this->page=0;
	$this->n=2;
	$this->buffer='';
	$this->pages=array();
	$this->OrientationChanges=array();
	$this->state=0;
	$this->fonts=array();
	$this->FontFiles=array();
	$this->diffs=array();
	$this->images=array();
	$this->links=array();
	$this->InFooter=false;
	$this->lasth=0;
	$this->FontFamily='';
	$this->FontStyle='';
	$this->FontSizePt=12;
	$this->underline=false;
	$this->DrawColor='0 G';
	$this->FillColor='0 g';
	$this->TextColor='0 g';
	$this->ColorFlag=false;
	$this->ws=0;
	//Standard fonts
	$this->CoreFonts=array('courier'=>'Courier','courierB'=>'Courier-Bold','courierI'=>'Courier-Oblique','courierBI'=>'Courier-BoldOblique',
		'helvetica'=>'Helvetica','helveticaB'=>'Helvetica-Bold','helveticaI'=>'Helvetica-Oblique','helveticaBI'=>'Helvetica-BoldOblique',
		'times'=>'Times-Roman','timesB'=>'Times-Bold','timesI'=>'Times-Italic','timesBI'=>'Times-BoldItalic',
		'symbol'=>'Symbol','zapfdingbats'=>'ZapfDingbats');
	//Scale factor
	if($unit=='pt')
		$this->k=1;
	elseif($unit=='mm')
		$this->k=72/25.4;
	elseif($unit=='cm')
		$this->k=72/2.54;
	elseif($unit=='in')
		$this->k=72;
	else
		$this->Error('Incorrect unit: '.$unit);
	//Page format
	if(is_string($format))
	{
		$format=strtolower($format);
		if($format=='a3')
			$format=array(841.89,1190.55);
		elseif($format=='a4')
			$format=array(595.28,841.89);
		elseif($format=='a5')
			$format=array(420.94,595.28);
		elseif($format=='letter')
			$format=array(612,792);
		elseif($format=='legal')
			$format=array(612,1008);
                elseif($format=='etiqueta')
                        $format=array(226.78,127.55);
                elseif($format=='etiqueta_fr')
                        $format=array(1000.78,127.55);
		else
			$this->Error('Unknown page format: '.$format);
		$this->fwPt=$format[0];
		$this->fhPt=$format[1];
	}
	else
	{
		$this->fwPt=$format[0]*$this->k;
		$this->fhPt=$format[1]*$this->k;
	}
	$this->fw=$this->fwPt/$this->k;
	$this->fh=$this->fhPt/$this->k;
	//Page orientation
	$orientation=strtolower($orientation);
	if($orientation=='p' or $orientation=='portrait')
	{
		$this->DefOrientation='P';
		$this->wPt=$this->fwPt;
		$this->hPt=$this->fhPt;
	}
	elseif($orientation=='l' or $orientation=='landscape')
	{
		$this->DefOrientation='L';
		$this->wPt=$this->fhPt;
		$this->hPt=$this->fwPt;
	}
	else
		$this->Error('Incorrect orientation: '.$orientation);
	$this->CurOrientation=$this->DefOrientation;
	$this->w=$this->wPt/$this->k;
	$this->h=$this->hPt/$this->k;
	//Page margins (1 cm)
	$margin=28.35/$this->k;
	$this->SetMargins($margin,$margin);
	//Interior cell margin (1 mm)
	$this->cMargin=$margin/10;
	//Line width (0.2 mm)
	$this->LineWidth=.567/$this->k;
	//Automatic page break
	$this->SetAutoPageBreak(true,2*$margin);
	//Full width display mode
	$this->SetDisplayMode('fullwidth');
	//Compression
	$this->SetCompression(true);
}

function PDF_Code128()
{
  /*******************************************************************************
  * Script :  PDF_Code128
  * Version : 1.0
  * Date :    20/05/2008
  * Auteur :  Roland Gautier
  *
  * Code128($x, $y, $code, $w, $h)
  *     $x,$y :     angle supérieur gauche du code à barre
  *     $code :     le code à créer
  *     $w :        largeur hors tout du code dans l'unité courante
  *                 (prévoir 5 à 15 mm de blanc à droite et à gauche)
  *     $h :        hauteur hors tout du code dans l'unité courante
  *
  * Commutation des jeux ABC automatique et optimisée.
  *******************************************************************************/

  $this->T128    = array();
  $this->ABCset  = "";
  $this->Aset    = "";
  $this->Bset    = "";
  $this->Cset    = "";
  $this->SetFrom = array();
  $this->SetTo   = array();
  $this->JStart  = array("A" => 103, "B" => 104, "C" => 105);
  $this->JSwap   = array("A" => 101, "B" => 100, "C" => 99);

  $this->T128[] = array(2, 1, 2, 2, 2, 2);           //0   : [ ]
  $this->T128[] = array(2, 2, 2, 1, 2, 2);           //1   : [!]
  $this->T128[] = array(2, 2, 2, 2, 2, 1);           //2   : ["]
  $this->T128[] = array(1, 2, 1, 2, 2, 3);           //3   : [#]
  $this->T128[] = array(1, 2, 1, 3, 2, 2);           //4   : [$]
  $this->T128[] = array(1, 3, 1, 2, 2, 2);           //5   : [%]
  $this->T128[] = array(1, 2, 2, 2, 1, 3);           //6   : [&]
  $this->T128[] = array(1, 2, 2, 3, 1, 2);           //7   : [']
  $this->T128[] = array(1, 3, 2, 2, 1, 2);           //8   : [(]
  $this->T128[] = array(2, 2, 1, 2, 1, 3);           //9   : [)]
  $this->T128[] = array(2, 2, 1, 3, 1, 2);           //10  : [*]
  $this->T128[] = array(2, 3, 1, 2, 1, 2);           //11  : [+]
  $this->T128[] = array(1, 1, 2, 2, 3, 2);           //12  : [,]
  $this->T128[] = array(1, 2, 2, 1, 3, 2);           //13  : [-]
  $this->T128[] = array(1, 2, 2, 2, 3, 1);           //14  : [.]
  $this->T128[] = array(1, 1, 3, 2, 2, 2);           //15  : [/]
  $this->T128[] = array(1, 2, 3, 1, 2, 2);           //16  : [0]
  $this->T128[] = array(1, 2, 3, 2, 2, 1);           //17  : [1]
  $this->T128[] = array(2, 2, 3, 2, 1, 1);           //18  : [2]
  $this->T128[] = array(2, 2, 1, 1, 3, 2);           //19  : [3]
  $this->T128[] = array(2, 2, 1, 2, 3, 1);           //20  : [4]
  $this->T128[] = array(2, 1, 3, 2, 1, 2);           //21  : [5]
  $this->T128[] = array(2, 2, 3, 1, 1, 2);           //22  : [6]
  $this->T128[] = array(3, 1, 2, 1, 3, 1);           //23  : [7]
  $this->T128[] = array(3, 1, 1, 2, 2, 2);           //24  : [8]
  $this->T128[] = array(3, 2, 1, 1, 2, 2);           //25  : [9]
  $this->T128[] = array(3, 2, 1, 2, 2, 1);           //26  : [:]
  $this->T128[] = array(3, 1, 2, 2, 1, 2);           //27  : [;]
  $this->T128[] = array(3, 2, 2, 1, 1, 2);           //28  : [<]
  $this->T128[] = array(3, 2, 2, 2, 1, 1);           //29  : [=]
  $this->T128[] = array(2, 1, 2, 1, 2, 3);           //30  : [>]
  $this->T128[] = array(2, 1, 2, 3, 2, 1);           //31  : [?]
  $this->T128[] = array(2, 3, 2, 1, 2, 1);           //32  : [@]
  $this->T128[] = array(1, 1, 1, 3, 2, 3);           //33  : [A]
  $this->T128[] = array(1, 3, 1, 1, 2, 3);           //34  : [B]
  $this->T128[] = array(1, 3, 1, 3, 2, 1);           //35  : [C]
  $this->T128[] = array(1, 1, 2, 3, 1, 3);           //36  : [D]
  $this->T128[] = array(1, 3, 2, 1, 1, 3);           //37  : [E]
  $this->T128[] = array(1, 3, 2, 3, 1, 1);           //38  : [F]
  $this->T128[] = array(2, 1, 1, 3, 1, 3);           //39  : [G]
  $this->T128[] = array(2, 3, 1, 1, 1, 3);           //40  : [H]
  $this->T128[] = array(2, 3, 1, 3, 1, 1);           //41  : [I]
  $this->T128[] = array(1, 1, 2, 1, 3, 3);           //42  : [J]
  $this->T128[] = array(1, 1, 2, 3, 3, 1);           //43  : [K]
  $this->T128[] = array(1, 3, 2, 1, 3, 1);           //44  : [L]
  $this->T128[] = array(1, 1, 3, 1, 2, 3);           //45  : [M]
  $this->T128[] = array(1, 1, 3, 3, 2, 1);           //46  : [N]
  $this->T128[] = array(1, 3, 3, 1, 2, 1);           //47  : [O]
  $this->T128[] = array(3, 1, 3, 1, 2, 1);           //48  : [P]
  $this->T128[] = array(2, 1, 1, 3, 3, 1);           //49  : [Q]
  $this->T128[] = array(2, 3, 1, 1, 3, 1);           //50  : [R]
  $this->T128[] = array(2, 1, 3, 1, 1, 3);           //51  : [S]
  $this->T128[] = array(2, 1, 3, 3, 1, 1);           //52  : [T]
  $this->T128[] = array(2, 1, 3, 1, 3, 1);           //53  : [U]
  $this->T128[] = array(3, 1, 1, 1, 2, 3);           //54  : [V]
  $this->T128[] = array(3, 1, 1, 3, 2, 1);           //55  : [W]
  $this->T128[] = array(3, 3, 1, 1, 2, 1);           //56  : [X]
  $this->T128[] = array(3, 1, 2, 1, 1, 3);           //57  : [Y]
  $this->T128[] = array(3, 1, 2, 3, 1, 1);           //58  : [Z]
  $this->T128[] = array(3, 3, 2, 1, 1, 1);           //59  : [[]
  $this->T128[] = array(3, 1, 4, 1, 1, 1);           //60  : [\]
  $this->T128[] = array(2, 2, 1, 4, 1, 1);           //61  : []]
  $this->T128[] = array(4, 3, 1, 1, 1, 1);           //62  : [^]
  $this->T128[] = array(1, 1, 1, 2, 2, 4);           //63  : [_]
  $this->T128[] = array(1, 1, 1, 4, 2, 2);           //64  : [`]
  $this->T128[] = array(1, 2, 1, 1, 2, 4);           //65  : [a]
  $this->T128[] = array(1, 2, 1, 4, 2, 1);           //66  : [b]
  $this->T128[] = array(1, 4, 1, 1, 2, 2);           //67  : [c]
  $this->T128[] = array(1, 4, 1, 2, 2, 1);           //68  : [d]
  $this->T128[] = array(1, 1, 2, 2, 1, 4);           //69  : [e]
  $this->T128[] = array(1, 1, 2, 4, 1, 2);           //70  : [f]
  $this->T128[] = array(1, 2, 2, 1, 1, 4);           //71  : [g]
  $this->T128[] = array(1, 2, 2, 4, 1, 1);           //72  : [h]
  $this->T128[] = array(1, 4, 2, 1, 1, 2);           //73  : [i]
  $this->T128[] = array(1, 4, 2, 2, 1, 1);           //74  : [j]
  $this->T128[] = array(2, 4, 1, 2, 1, 1);           //75  : [k]
  $this->T128[] = array(2, 2, 1, 1, 1, 4);           //76  : [l]
  $this->T128[] = array(4, 1, 3, 1, 1, 1);           //77  : [m]
  $this->T128[] = array(2, 4, 1, 1, 1, 2);           //78  : [n]
  $this->T128[] = array(1, 3, 4, 1, 1, 1);           //79  : [o]
  $this->T128[] = array(1, 1, 1, 2, 4, 2);           //80  : [p]
  $this->T128[] = array(1, 2, 1, 1, 4, 2);           //81  : [q]
  $this->T128[] = array(1, 2, 1, 2, 4, 1);           //82  : [r]
  $this->T128[] = array(1, 1, 4, 2, 1, 2);           //83  : [s]
  $this->T128[] = array(1, 2, 4, 1, 1, 2);           //84  : [t]
  $this->T128[] = array(1, 2, 4, 2, 1, 1);           //85  : [u]
  $this->T128[] = array(4, 1, 1, 2, 1, 2);           //86  : [v]
  $this->T128[] = array(4, 2, 1, 1, 1, 2);           //87  : [w]
  $this->T128[] = array(4, 2, 1, 2, 1, 1);           //88  : [x]
  $this->T128[] = array(2, 1, 2, 1, 4, 1);           //89  : [y]
  $this->T128[] = array(2, 1, 4, 1, 2, 1);           //90  : [z]
  $this->T128[] = array(4, 1, 2, 1, 2, 1);           //91  : [{]
  $this->T128[] = array(1, 1, 1, 1, 4, 3);           //92  : [|]
  $this->T128[] = array(1, 1, 1, 3, 4, 1);           //93  : [}]
  $this->T128[] = array(1, 3, 1, 1, 4, 1);           //94  : [~]
  $this->T128[] = array(1, 1, 4, 1, 1, 3);           //95  : [DEL]
  $this->T128[] = array(1, 1, 4, 3, 1, 1);           //96  : [FNC3]
  $this->T128[] = array(4, 1, 1, 1, 1, 3);           //97  : [FNC2]
  $this->T128[] = array(4, 1, 1, 3, 1, 1);           //98  : [SHIFT]
  $this->T128[] = array(1, 1, 3, 1, 4, 1);           //99  : [Cswap]
  $this->T128[] = array(1, 1, 4, 1, 3, 1);           //100 : [Bswap]
  $this->T128[] = array(3, 1, 1, 1, 4, 1);           //101 : [Aswap]
  $this->T128[] = array(4, 1, 1, 1, 3, 1);           //102 : [FNC1]
  $this->T128[] = array(2, 1, 1, 4, 1, 2);           //103 : [Astart]
  $this->T128[] = array(2, 1, 1, 2, 1, 4);           //104 : [Bstart]
  $this->T128[] = array(2, 1, 1, 2, 3, 2);           //105 : [Cstart]
  $this->T128[] = array(2, 3, 3, 1, 1, 1);           //106 : [STOP]
  $this->T128[] = array(2, 1);                       //107 : [END BAR]

  for ($i = 32; $i <= 95; $i++)
    $this->ABCset .= chr($i);

  $this->Aset = $this->ABCset;
  $this->Bset = $this->ABCset;
  $this->Cset = "0123456789";

  for ($i = 0; $i <= 31; $i++)
  {
    $this->ABCset .= chr($i);
    $this->Aset   .= chr($i);
  }

  for ($i = 96; $i <= 126; $i++)
  {
    $this->ABCset .= chr($i);
    $this->Bset   .= chr($i);
  }

  for ($i = 0; $i < 96; $i++)
  {
    @$this->SetFrom["A"] .= chr($i);
    @$this->SetFrom["B"] .= chr($i + 32);
    @$this->SetTo["A"]   .= chr(($i < 32) ? $i + 64 : $i - 32);
    @$this->SetTo["B"]   .= chr($i);
  }
}

function Code128($x, $y, $code, $w, $h)
{
  $this->PDF_Code128();

  $Aguid = "";
  $Bguid = "";
  $Cguid = "";

  for ($i = 0; $i < strlen($code); $i++)
  {
    $needle = substr($code, $i, 1);
    $Aguid .= ((strpos($this->Aset, $needle) === false) ? "N" : "O");
    $Bguid .= ((strpos($this->Bset, $needle) === false) ? "N" : "O");
    $Cguid .= ((strpos($this->Cset, $needle) === false) ? "N" : "O");
  }

  $SminiC = "OOOO";
  $IminiC = 4;

  $crypt = "";

  while ($code > "")
  {
    $i = strpos($Cguid, $SminiC);

    if ($i !== false)
    {
      $Aguid[$i] = "N";
      $Bguid[$i] = "N";
    }

    if (substr($Cguid, 0, $IminiC) == $SminiC)
    {
      $crypt .= chr(($crypt > "") ? $this->JSwap["C"] : $this->JStart["C"]);
      $made   = strpos($Cguid, "N");

      if ($made === false)
        $made = strlen($Cguid);

      if (fmod($made, 2) == 1)
        $made--;

      for ($i = 0; $i < $made; $i += 2)
        $crypt .= chr(strval(substr($code, $i, 2)));
        
      $set = "C";
    }
    else
    {
      $madeA = strpos($Aguid, "N");

      if ($madeA === false)
        $madeA = strlen($Aguid);

      $madeB = strpos($Bguid, "N");

      if ($madeB === false)
        $madeB = strlen($Bguid);

      $made = (($madeA < $madeB) ? $madeB : $madeA);
      $set  = (($madeA < $madeB) ? "B" : "A");

      $crypt .= chr(($crypt > "") ? $this->JSwap[$set] : $this->JStart[$set]);

      $crypt .= strtr(substr($code, 0, $made), $this->SetFrom[$set], $this->SetTo[$set]);
    }

    $code  = substr($code,  $made);
    $Aguid = substr($Aguid, $made);
    $Bguid = substr($Bguid, $made);
    $Cguid = substr($Cguid, $made);
  }

  $check = ord($crypt[0]);

  for ($i = 0; $i < strlen($crypt); $i++)
    $check += (ord($crypt[$i]) * $i);

  $check %= 103;

  $crypt .= chr($check) . chr(106) . chr(107);

  $i = (strlen($crypt) * 11) - 9;
  $modul = $w / $i;

  for ($i = 0; $i < strlen($crypt); $i++)
  {
    $c = $this->T128[ord($crypt[$i])];

    for ($j = 0; $j < count($c); $j++)
    {
      $this->Rect($x, $y, $c[$j] * $modul, $h, "F");
      $x += (($c[$j++] + $c[$j]) * $modul);
    }
  }
}

function SetMargins($left,$top,$right=-1)
{
	//Set left, top and right margins
	$this->lMargin=$left;
	$this->tMargin=$top;
	if($right==-1)
		$right=$left;
	$this->rMargin=$right;
}

function SetLeftMargin($margin)
{
	//Set left margin
	$this->lMargin=$margin;
	if($this->page>0 and $this->x<$margin)
		$this->x=$margin;
}

function SetTopMargin($margin)
{
	//Set top margin
	$this->tMargin=$margin;
}

function SetRightMargin($margin)
{
	//Set right margin
	$this->rMargin=$margin;
}

function SetAutoPageBreak($auto,$margin=0)
{
	//Set auto page break mode and triggering margin
	$this->AutoPageBreak=$auto;
	$this->bMargin=$margin;
	$this->PageBreakTrigger=$this->h-$margin;
}

function SetDisplayMode($zoom,$layout='continuous')
{
	//Set display mode in viewer
	if($zoom=='fullpage' or $zoom=='fullwidth' or $zoom=='real' or $zoom=='default' or !is_string($zoom))
		$this->ZoomMode=$zoom;
	else
		$this->Error('Incorrect zoom display mode: '.$zoom);
	if($layout=='single' or $layout=='continuous' or $layout=='two' or $layout=='default')
		$this->LayoutMode=$layout;
	else
		$this->Error('Incorrect layout display mode: '.$layout);
}

function SetCompression($compress)
{
	//Set page compression
	if(function_exists('gzcompress'))
		$this->compress=$compress;
	else
		$this->compress=false;
}

function SetTitle($title)
{
	//Title of document
	$this->title=$title;
}

function SetSubject($subject)
{
	//Subject of document
	$this->subject=$subject;
}

function SetAuthor($author)
{
	//Author of document
	$this->author=$author;
}

function SetKeywords($keywords)
{
	//Keywords of document
	$this->keywords=$keywords;
}

function SetCreator($creator)
{
	//Creator of document
	$this->creator=$creator;
}

function AliasNbPages($alias='{nb}')
{
	//Define an alias for total number of pages
	$this->AliasNbPages=$alias;
}

function Error($msg)
{
	//Fatal error
	die('<B>FPDF error: </B>'.$msg);
}

function Open()
{
	//Begin document
	if($this->state==0)
		$this->_begindoc();
}

function Close()
{
	//Terminate document
	if($this->state==3)
		return;
	if($this->page==0)
		$this->AddPage();
	//Page footer
	$this->InFooter=true;
	$this->Footer();
	$this->InFooter=false;
	//Close page
	$this->_endpage();
	//Close document
	$this->_enddoc();
}

function AddPage($orientation='')
{
	//Start a new page
	if($this->state==0)
		$this->Open();
	$family=$this->FontFamily;
	$style=$this->FontStyle.($this->underline ? 'U' : '');
	$size=$this->FontSizePt;
	$lw=$this->LineWidth;
	$dc=$this->DrawColor;
	$fc=$this->FillColor;
	$tc=$this->TextColor;
	$cf=$this->ColorFlag;
	if($this->page>0)
	{
		//Page footer
		$this->InFooter=true;
		$this->Footer();
		$this->InFooter=false;
		//Close page
		$this->_endpage();
	}
	//Start new page
	$this->_beginpage($orientation);
	//Set line cap style to square
	$this->_out('2 J');
	//Set line width
	$this->LineWidth=$lw;
	$this->_out(sprintf('%.2f w',$lw*$this->k));
	//Set font
	if($family)
		$this->SetFont($family,$style,$size);
	//Set colors
	$this->DrawColor=$dc;
	if($dc!='0 G')
		$this->_out($dc);
	$this->FillColor=$fc;
	if($fc!='0 g')
		$this->_out($fc);
	$this->TextColor=$tc;
	$this->ColorFlag=$cf;
	//Page header
	$this->Header();
	//Restore line width
	if($this->LineWidth!=$lw)
	{
		$this->LineWidth=$lw;
		$this->_out(sprintf('%.2f w',$lw*$this->k));
	}
	//Restore font
	if($family)
		$this->SetFont($family,$style,$size);
	//Restore colors
	if($this->DrawColor!=$dc)
	{
		$this->DrawColor=$dc;
		$this->_out($dc);
	}
	if($this->FillColor!=$fc)
	{
		$this->FillColor=$fc;
		$this->_out($fc);
	}
	$this->TextColor=$tc;
	$this->ColorFlag=$cf;
}

function Header()
{
	//To be implemented in your own inherited class
}

function Footer()
{
	//To be implemented in your own inherited class
}

function ShowDate()
{
	//Get Show Date in Report
	return $this->showdate;
}

function SetShowDate($show=true)
{
  //Set show date in report
	$this->showdate = $show;
}

function SetPageInitial($page=1)
{
  //Set number of page initial
	$this->showpage = ($page - 1);
}

function SetLabelPage($label="Página")
{
  //Set label of page
	$this->labelpage = $label;
}

function PageNo()
{
	//Get current page number
	return $this->showpage;
}

function LabelPage()
{
	//Get current label page
	return $this->labelpage;
}

function SetDrawColor($r,$g=-1,$b=-1)
{
	//Set color for all stroking operations
	if(($r==0 and $g==0 and $b==0) or $g==-1)
		$this->DrawColor=sprintf('%.3f G',$r/255);
	else
		$this->DrawColor=sprintf('%.3f %.3f %.3f RG',$r/255,$g/255,$b/255);
	if($this->page>0)
		$this->_out($this->DrawColor);
}

function SetFillColor($r,$g=-1,$b=-1)
{
	//Set color for all filling operations
	if(($r==0 and $g==0 and $b==0) or $g==-1)
		$this->FillColor=sprintf('%.3f g',$r/255);
	else
		$this->FillColor=sprintf('%.3f %.3f %.3f rg',$r/255,$g/255,$b/255);
	$this->ColorFlag=($this->FillColor!=$this->TextColor);
	if($this->page>0)
		$this->_out($this->FillColor);
}

function SetTextColor($r,$g=-1,$b=-1)
{
	//Set color for text
	if(($r==0 and $g==0 and $b==0) or $g==-1)
		$this->TextColor=sprintf('%.3f g',$r/255);
	else
		$this->TextColor=sprintf('%.3f %.3f %.3f rg',$r/255,$g/255,$b/255);
	$this->ColorFlag=($this->FillColor!=$this->TextColor);
}

function GetStringWidth($s)
{
	//Get width of a string in the current font
	$s=(string)$s;
	$cw=&$this->CurrentFont['cw'];
	$w=0;
	$l=strlen($s);
	for($i=0;$i<$l;$i++)
		$w+=$cw[$s{$i}];
	return $w*$this->FontSize/1000;
}

function SetLineWidth($width)
{
	//Set line width
	$this->LineWidth=$width;
	if($this->page>0)
		$this->_out(sprintf('%.2f w',$width*$this->k));
}

function Line($x1,$y1,$x2,$y2)
{
	//Draw a line
	$this->_out(sprintf('%.2f %.2f m %.2f %.2f l S',$x1*$this->k,($this->h-$y1)*$this->k,$x2*$this->k,($this->h-$y2)*$this->k));
}

function Rect($x,$y,$w,$h,$style='')
{
	//Draw a rectangle
	if($style=='F')
		$op='f';
	elseif($style=='FD' or $style=='DF')
		$op='B';
	else
		$op='S';
	$this->_out(sprintf('%.2f %.2f %.2f %.2f re %s',$x*$this->k,($this->h-$y)*$this->k,$w*$this->k,-$h*$this->k,$op));
}

function AddFont($family,$style='',$file='')
{
	//Add a TrueType or Type1 font
	$family=strtolower($family);
	if($family=='arial')
		$family='helvetica';
	$style=strtoupper($style);
	if($style=='IB')
		$style='BI';
	if(isset($this->fonts[$family.$style]))
		$this->Error('Font already added: '.$family.' '.$style);
	if($file=='')
		$file=str_replace(' ','',$family).strtolower($style).'.php';
	if(defined('FPDF_FONTPATH'))
		$file=FPDF_FONTPATH.$file;
  include($file);
	if(!isset($name))
		$this->Error('Could not include font definition file');
	$i=count($this->fonts)+1;
	$this->fonts[$family.$style]=array('i'=>$i,'type'=>$type,'name'=>$name,'desc'=>$desc,'up'=>$up,'ut'=>$ut,'cw'=>$cw,'enc'=>$enc,'file'=>$file);
	if($diff)
	{
		//Search existing encodings
		$d=0;
		$nb=count($this->diffs);
		for($i=1;$i<=$nb;$i++)
			if($this->diffs[$i]==$diff)
			{
				$d=$i;
				break;
			}
		if($d==0)
		{
			$d=$nb+1;
			$this->diffs[$d]=$diff;
		}
		$this->fonts[$family.$style]['diff']=$d;
	}
	if($file)
	{
		if($type=='TrueType')
			$this->FontFiles[$file]=array('length1'=>$originalsize);
		else
			$this->FontFiles[$file]=array('length1'=>$size1,'length2'=>$size2);
	}
}

function SetFont($family,$style='',$size=0)
{
	//Select a font; size given in points
	global $fpdf_charwidths;

	$family=strtolower($family);
	if($family=='')
		$family=$this->FontFamily;
	if($family=='arial')
		$family='helvetica';
	elseif($family=='symbol' or $family=='zapfdingbats')
		$style='';
	$style=strtoupper($style);
	if(is_int(strpos($style,'U')))
	{
		$this->underline=true;
		$style=str_replace('U','',$style);
	}
	else
		$this->underline=false;
	if($style=='IB')
		$style='BI';
	if($size==0)
		$size=$this->FontSizePt;
	//Test if font is already selected
	if($this->FontFamily==$family and $this->FontStyle==$style and $this->FontSizePt==$size)
		return;
	//Test if used for the first time
	$fontkey=$family.$style;
	if(!isset($this->fonts[$fontkey]))
	{
		//Check if one of the standard fonts
		if(isset($this->CoreFonts[$fontkey]))
		{
			if(!isset($fpdf_charwidths[$fontkey]))
			{
				//Load metric file
				$file=$family;
				if($family=='times' or $family=='helvetica')
					$file.=strtolower($style);
				$file.='.php';
				if(defined('FPDF_FONTPATH'))
					$file=FPDF_FONTPATH.$file;
        include($file);
				if(!isset($fpdf_charwidths[$fontkey]))
					$this->Error('Could not include font metric file');
			}
			$i=count($this->fonts)+1;
			$this->fonts[$fontkey]=array('i'=>$i,'type'=>'core','name'=>$this->CoreFonts[$fontkey],'up'=>-100,'ut'=>50,'cw'=>$fpdf_charwidths[$fontkey]);
		}
		else
			$this->Error('Undefined font: '.$family.' '.$style);
	}
	//Select it
	$this->FontFamily=$family;
	$this->FontStyle=$style;
	$this->FontSizePt=$size;
	$this->FontSize=$size/$this->k;
	$this->CurrentFont=&$this->fonts[$fontkey];
	if($this->page>0)
		$this->_out(sprintf('BT /F%d %.2f Tf ET',$this->CurrentFont['i'],$this->FontSizePt));
}

function SetFontSize($size)
{
	//Set font size in points
	if($this->FontSizePt==$size)
		return;
	$this->FontSizePt=$size;
	$this->FontSize=$size/$this->k;
	if($this->page>0)
		$this->_out(sprintf('BT /F%d %.2f Tf ET',$this->CurrentFont['i'],$this->FontSizePt));
}

function AddLink()
{
	//Create a new internal link
	$n=count($this->links)+1;
	$this->links[$n]=array(0,0);
	return $n;
}

function SetLink($link,$y=0,$page=-1)
{
	//Set destination of internal link
	if($y==-1)
		$y=$this->y;
	if($page==-1)
		$page=$this->page;
	$this->links[$link]=array($page,$y);
}

function Link($x,$y,$w,$h,$link)
{
	//Put a link on the page
	$this->PageLinks[$this->page][]=array($x*$this->k,$this->hPt-$y*$this->k,$w*$this->k,$h*$this->k,$link);
}

function Text($x,$y,$txt)
{
	//Output a string
	$s=sprintf('BT %.2f %.2f Td (%s) Tj ET',$x*$this->k,($this->h-$y)*$this->k,$this->_escape($txt));
	if($this->underline and $txt!='')
		$s.=' '.$this->_dounderline($x,$y,$txt);
	if($this->ColorFlag)
		$s='q '.$this->TextColor.' '.$s.' Q';
	$this->_out($s);
}

function AcceptPageBreak()
{
	//Accept automatic page break or not
	return $this->AutoPageBreak;
}

function Cell($w,$h=0,$txt='',$border=0,$ln=0,$align='',$fill=0,$link='')
{
	//Output a cell
	$k=$this->k;
	if($this->y+$h>$this->PageBreakTrigger and !$this->InFooter and $this->AcceptPageBreak())
	{
		//Automatic page break
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
			$this->_out(sprintf('%.3f Tw',$ws*$k));
		}
	}
	if($w==0)
		$w=$this->w-$this->rMargin-$this->x;
	$s='';
	if($fill==1 or $border==1)
	{
		if($fill==1)
			$op=($border==1) ? 'B' : 'f';
		else
			$op='S';
		$s=sprintf('%.2f %.2f %.2f %.2f re %s ',$this->x*$k,($this->h-$this->y)*$k,$w*$k,-$h*$k,$op);
	}
	if(is_string($border))
	{
		$x=$this->x;
		$y=$this->y;
		if(is_int(strpos($border,'L')))
			$s.=sprintf('%.2f %.2f m %.2f %.2f l S ',$x*$k,($this->h-$y)*$k,$x*$k,($this->h-($y+$h))*$k);
		if(is_int(strpos($border,'T')))
			$s.=sprintf('%.2f %.2f m %.2f %.2f l S ',$x*$k,($this->h-$y)*$k,($x+$w)*$k,($this->h-$y)*$k);
		if(is_int(strpos($border,'R')))
			$s.=sprintf('%.2f %.2f m %.2f %.2f l S ',($x+$w)*$k,($this->h-$y)*$k,($x+$w)*$k,($this->h-($y+$h))*$k);
		if(is_int(strpos($border,'B')))
			$s.=sprintf('%.2f %.2f m %.2f %.2f l S ',$x*$k,($this->h-($y+$h))*$k,($x+$w)*$k,($this->h-($y+$h))*$k);
	}
	if($txt!='')
	{
		if($align=='R')
			$dx=$w-$this->cMargin-$this->GetStringWidth($txt);
		elseif($align=='C')
			$dx=($w-$this->GetStringWidth($txt))/2;
		else
			$dx=$this->cMargin;
		if($this->ColorFlag)
			$s.='q '.$this->TextColor.' ';
		$txt2=str_replace(')','\\)',str_replace('(','\\(',str_replace('\\','\\\\',$txt)));
		$s.=sprintf('BT %.2f %.2f Td (%s) Tj ET',($this->x+$dx)*$k,($this->h-($this->y+.5*$h+.3*$this->FontSize))*$k,$txt2);
		if($this->underline)
			$s.=' '.$this->_dounderline($this->x+$dx,$this->y+.5*$h+.3*$this->FontSize,$txt);
		if($this->ColorFlag)
			$s.=' Q';
		if($link)
			$this->Link($this->x+$dx,$this->y+.5*$h-.5*$this->FontSize,$this->GetStringWidth($txt),$this->FontSize,$link);
	}
	if($s)
		$this->_out($s);
	$this->lasth=$h;
	if($ln>0)
	{
		//Go to next line
		$this->y+=$h;
		if($ln==1)
			$this->x=$this->lMargin;
	}
	else
		$this->x+=$w;
}

function MultiCell($w,$h,$txt,$border=0,$align='J',$fill=0)
{
	//Output text with automatic or explicit line breaks
	$cw=&$this->CurrentFont['cw'];
	if($w==0)
		$w=$this->w-$this->rMargin-$this->x;
	$wmax=($w-2*$this->cMargin)*1000/$this->FontSize;
	$s=str_replace("\r",'',$txt);
	$nb=strlen($s);
	if($nb>0 and $s[$nb-1]=="\n")
		$nb--;
	$b=0;
	if($border)
	{
		if($border==1)
		{
			$border='LTRB';
			$b='LRT';
			$b2='LR';
		}
		else
		{
			$b2='';
			if(is_int(strpos($border,'L')))
				$b2.='L';
			if(is_int(strpos($border,'R')))
				$b2.='R';
			$b=is_int(strpos($border,'T')) ? $b2.'T' : $b2;
		}
	}
	$sep=-1;
	$i=0;
	$j=0;
	$l=0;
	$ns=0;
	$nl=1;
	while($i<$nb)
	{
		//Get next character
		$c=$s{$i};
		if($c=="\n")
		{
			//Explicit line break
			if($this->ws>0)
			{
				$this->ws=0;
				$this->_out('0 Tw');
			}
			$this->Cell($w,$h,substr($s,$j,$i-$j),$b,2,$align,$fill);
			$i++;
			$sep=-1;
			$j=$i;
			$l=0;
			$ns=0;
			$nl++;
			if($border and $nl==2)
				$b=$b2;
			continue;
		}
		if($c==' ')
		{
			$sep=$i;
			$ls=$l;
			$ns++;
		}
		$l+=$cw[$c];
		if($l>$wmax)
		{
			//Automatic line break
			if($sep==-1)
			{
				if($i==$j)
					$i++;
				if($this->ws>0)
				{
					$this->ws=0;
					$this->_out('0 Tw');
				}
				$this->Cell($w,$h,substr($s,$j,$i-$j),$b,2,$align,$fill);
			}
			else
			{
				if($align=='J')
				{
					$this->ws=($ns>1) ? ($wmax-$ls)/1000*$this->FontSize/($ns-1) : 0;
					$this->_out(sprintf('%.3f Tw',$this->ws*$this->k));
				}
				$this->Cell($w,$h,substr($s,$j,$sep-$j),$b,2,$align,$fill);
				$i=$sep+1;
			}
			$sep=-1;
			$j=$i;
			$l=0;
			$ns=0;
			$nl++;
			if($border and $nl==2)
				$b=$b2;
		}
		else
			$i++;
	}
	//Last chunk
	if($this->ws>0)
	{
		$this->ws=0;
		$this->_out('0 Tw');
	}
	if($border and is_int(strpos($border,'B')))
		$b.='B';
	$this->Cell($w,$h,substr($s,$j,$i-$j),$b,2,$align,$fill);
	$this->x=$this->lMargin;
}

function MultiCellCount($w,$h,$txt,$border=0,$align='J',$fill=0)
{
  $mCount = 0;
  
	//Output text with automatic or explicit line breaks
	$cw=&$this->CurrentFont['cw'];
	if($w==0)
		$w=$this->w-$this->rMargin-$this->x;
	$wmax=($w-2*$this->cMargin)*1000/$this->FontSize;
	$s=str_replace("\r",'',$txt);
	$nb=strlen($s);
	if($nb>0 and $s[$nb-1]=="\n")
		$nb--;
	$b=0;
	if($border)
	{
		if($border==1)
		{
			$border='LTRB';
			$b='LRT';
			$b2='LR';
		}
		else
		{
			$b2='';
			if(is_int(strpos($border,'L')))
				$b2.='L';
			if(is_int(strpos($border,'R')))
				$b2.='R';
			$b=is_int(strpos($border,'T')) ? $b2.'T' : $b2;
		}
	}
	$sep=-1;
	$i=0;
	$j=0;
	$l=0;
	$ns=0;
	$nl=1;
	while($i<$nb)
	{
		//Get next character
		$c=$s{$i};
		if($c=="\n")
		{
			//Explicit line break
			if($this->ws>0)
			{
				$this->ws=0;
				$this->_out('0 Tw');
			}
			//$this->Cell($w,$h,substr($s,$j,$i-$j),$b,2,$align,$fill);
      $mCount++;
			$i++;
			$sep=-1;
			$j=$i;
			$l=0;
			$ns=0;
			$nl++;
			if($border and $nl==2)
				$b=$b2;
			continue;
		}
		if($c==' ')
		{
			$sep=$i;
			$ls=$l;
			$ns++;
		}
		$l+=$cw[$c];
		if($l>$wmax)
		{
			//Automatic line break
			if($sep==-1)
			{
				if($i==$j)
					$i++;
				if($this->ws>0)
				{
					$this->ws=0;
					$this->_out('0 Tw');
				}
        
				//$this->Cell($w,$h,substr($s,$j,$i-$j),$b,2,$align,$fill);
        $mCount++;
			}
			else
			{
				if($align=='J')
				{
					$this->ws=($ns>1) ? ($wmax-$ls)/1000*$this->FontSize/($ns-1) : 0;
					$this->_out(sprintf('%.3f Tw',$this->ws*$this->k));
				}
        
				//$this->Cell($w,$h,substr($s,$j,$sep-$j),$b,2,$align,$fill);
        $mCount++;
        
				$i=$sep+1;
			}
			$sep=-1;
			$j=$i;
			$l=0;
			$ns=0;
			$nl++;
			if($border and $nl==2)
				$b=$b2;
		}
		else
			$i++;
	}
	//Last chunk
	if($this->ws>0)
	{
		$this->ws=0;
		$this->_out('0 Tw');
	}
	if($border and is_int(strpos($border,'B')))
		$b.='B';
  
	//$this->Cell($w,$h,substr($s,$j,$i-$j),$b,2,$align,$fill);
  $mCount++;
	$this->x=$this->lMargin;
  
  return $mCount;
}

function Write($h,$txt,$link='')
{
	//Output text in flowing mode
	$cw=&$this->CurrentFont['cw'];
	$w=$this->w-$this->rMargin-$this->x;
	$wmax=($w-2*$this->cMargin)*1000/$this->FontSize;
	$s=str_replace("\r",'',$txt);
	$nb=strlen($s);
	$sep=-1;
	$i=0;
	$j=0;
	$l=0;
	$nl=1;
	while($i<$nb)
	{
		//Get next character
		$c=$s{$i};
		if($c=="\n")
		{
			//Explicit line break
			$this->Cell($w,$h,substr($s,$j,$i-$j),0,2,'',0,$link);
			$i++;
			$sep=-1;
			$j=$i;
			$l=0;
			if($nl==1)
			{
				$this->x=$this->lMargin;
				$w=$this->w-$this->rMargin-$this->x;
				$wmax=($w-2*$this->cMargin)*1000/$this->FontSize;
			}
			$nl++;
			continue;
		}
		if($c==' ')
			$sep=$i;
		$l+=$cw[$c];
		if($l>$wmax)
		{
			//Automatic line break
			if($sep==-1)
			{
				if($this->x>$this->lMargin)
				{
					//Move to next line
					$this->x=$this->lMargin;
					$this->y+=$h;
					$w=$this->w-$this->rMargin-$this->x;
					$wmax=($w-2*$this->cMargin)*1000/$this->FontSize;
					$i++;
					$nl++;
					continue;
				}
				if($i==$j)
					$i++;
				$this->Cell($w,$h,substr($s,$j,$i-$j),0,2,'',0,$link);
			}
			else
			{
				$this->Cell($w,$h,substr($s,$j,$sep-$j),0,2,'',0,$link);
				$i=$sep+1;
			}
			$sep=-1;
			$j=$i;
			$l=0;
			if($nl==1)
			{
				$this->x=$this->lMargin;
				$w=$this->w-$this->rMargin-$this->x;
				$wmax=($w-2*$this->cMargin)*1000/$this->FontSize;
			}
			$nl++;
		}
		else
			$i++;
	}
	//Last chunk
	if($i!=$j)
		$this->Cell($l/1000*$this->FontSize,$h,substr($s,$j),0,0,'',0,$link);
}

function Image($file,$x,$y,$w=0,$h=0,$type='',$link='')
{
	//Put an image on the page
	if(!isset($this->images[$file]))
	{
		//First use of image, get info
		if($type=='')
		{
			$pos=strrpos($file,'.');
			if(!$pos)
				$this->Error('Image file has no extension and no type was specified: '.$file);
			$type=substr($file,$pos+1);
		}
                
		$type=strtolower($type);
		
                $mqr=get_magic_quotes_runtime();
                ini_set("magic_quotes_runtime", 0);
                
		if($type=='jpg' or $type=='jpeg')
			$info=$this->_parsejpg($file);
		elseif($type=='png')
			$info=$this->_parsepng($file);
		else
		{
			//Allow for additional formats
			$mtd='_parse'.$type;
			if(!method_exists($this,$mtd))
				$this->Error('Unsupported image type: '.$type);
			$info=$this->$mtd($file);
		}
                
		ini_set("magic_quotes_runtime", $mqr);
                
		$info['i']=count($this->images)+1;
		$this->images[$file]=$info;
	}
	else
		$info=$this->images[$file];
	//Automatic width and height calculation if needed
	if($w==0 and $h==0)
	{
		//Put image at 72 dpi
		$w=$info['w']/$this->k;
		$h=$info['h']/$this->k;
	}
	if($w==0)
		$w=$h*$info['w']/$info['h'];
	if($h==0)
		$h=$w*$info['h']/$info['w'];
	$this->_out(sprintf('q %.2f 0 0 %.2f %.2f %.2f cm /I%d Do Q',$w*$this->k,$h*$this->k,$x*$this->k,($this->h-($y+$h))*$this->k,$info['i']));
	if($link)
		$this->Link($x,$y,$w,$h,$link);
}

function Ln($h='')
{
	//Line feed; default value is last cell height
	$this->x=$this->lMargin;
	if(is_string($h))
		$this->y+=$this->lasth;
	else
		$this->y+=$h;
}

function GetX()
{
	//Get x position
	return $this->x;
}

function SetX($x)
{
	//Set x position
	if($x>=0)
		$this->x=$x;
	else
		$this->x=$this->w+$x;
}

function GetY()
{
	//Get y position
	return $this->y;
}

function SetY($y)
{
	//Set y position and reset x
	$this->x=$this->lMargin;
	if($y>=0)
		$this->y=$y;
	else
		$this->y=$this->h+$y;
}

function SetXY($x,$y)
{
	//Set x and y positions
	$this->SetY($y);
	$this->SetX($x);
}

function Output($name='',$dest='',$printer='')
{
	//Output PDF to some destination

	//Finish document if necessary
	if($this->state<3)
		$this->Close();
	//Normalize parameters
	if(is_bool($dest))
		$dest=$dest ? 'D' : 'F';
	$dest=strtoupper($dest);
	if($dest=='')
	{
		if($name=='')
		{
			$name='doc.pdf';
			$dest='I';
		}
		else
			$dest='F';
	}
	switch($dest)
	{
		case 'I':
      if (strpos($name, "carga_saida_conferencia"))
      {
        $f=fopen("tmp/" . date("Ymd_His") . "$name",'wb');
        if(!$f)
          $this->Error('Unable to create output file: '.$name);
        fwrite($f,$this->buffer,strlen($this->buffer));
        fclose($f);
      }
			//Send to standard output
			if(isset($_SERVER['SERVER_NAME']))
			{
				//We send to a browser
				Header('Content-Type: application/pdf');
				if(headers_sent())
					$this->Error('Some data has already been output to browser, can\'t send PDF file');
				Header('Content-Length: '.strlen($this->buffer));
				Header('Content-disposition: inline; filename='.$name);
        header("Pragma: no-cache");
        header("Cache-Control: no-cache");
        header("Cache-Control: max-age=0");
			}
			echo $this->buffer;
			break;
		case 'D':
			//Download file
			if(isset($_SERVER['HTTP_USER_AGENT']) and strpos($_SERVER['HTTP_USER_AGENT'],'MSIE'))
				Header('Content-Type: application/force-download');
			else
				Header('Content-Type: application/octet-stream');
			if(headers_sent())
				$this->Error('Some data has already been output to browser, can\'t send PDF file');
			Header('Content-Length: '.strlen($this->buffer));
			Header('Content-disposition: attachment; filename='.$name);
			echo $this->buffer;
			break;
		case 'F':
			//Save to local file
			$f=fopen($name,'wb');
			if(!$f)
				$this->Error('Unable to create output file: '.$name);
			fwrite($f,$this->buffer,strlen($this->buffer));
			fclose($f);
			break;
    case 'P':
      //Print to local printer 
      $name=tempnam("/var/www/fpdf/fpdf152/spool/", "oniz.relato");
      $f=fopen($name, "wb");
      if(!$f)
        $this->Error('Unable to create output file: '.$name);
      fwrite($f,$this->buffer,strlen($this->buffer));
      fclose($f);
      #system('/var/www/fpdf/lpr -P$printer $name',$retval);
      #$retval = `./lpr -P$printer $name; echo $?`;
//      $retval = `./pdf2ps $name; ./lpr -P$printer $name; echo $?`;
//      $retval = `pdf2ps $name; ./lpr -P$printer $name_ps; echo $?`;

     //system('pwd', $x);
     //echo $x;
   echo "lib/fpdf/pdf2ps $name $name.ps";
   exec('lib/fpdf/pdf2ps ' . $name . ' ' . $name . '.ps');
   exec('lib/fpdf/lpr ' . $name . '.ps -Ptxt');
//     echo "fpdf/pdf3ps $name $name.ps";
     //echo $retval;
      #unlink($name);
		case 'S':
			//Return as a string
			return $this->buffer;
		default:
			$this->Error('Incorrect output destination: '.$dest);
	}
	return '';
}

/*******************************************************************************
*                                                                              *
*                              Protected methods                               *
*                                                                              *
*******************************************************************************/
function _dochecks()
{
	//Check for locale-related bug
	if(1.1==1)
		$this->Error('Don\'t alter the locale before including class file');
	//Check for decimal separator
	if(sprintf('%.1f',1.0)!='1.0')
		setlocale(LC_NUMERIC,'C');
}

function _begindoc()
{
	//Start document
	$this->state=1;
	$this->_out('%PDF-1.3');
}

function _putpages()
{
	$nb=$this->page;
	if(!empty($this->AliasNbPages))
	{
		//Replace number of pages
		for($n=1;$n<=$nb;$n++)
			$this->pages[$n]=str_replace($this->AliasNbPages,$nb,$this->pages[$n]);
	}
	if($this->DefOrientation=='P')
	{
		$wPt=$this->fwPt;
		$hPt=$this->fhPt;
	}
	else
	{
		$wPt=$this->fhPt;
		$hPt=$this->fwPt;
	}
	$filter=($this->compress) ? '/Filter /FlateDecode ' : '';
	for($n=1;$n<=$nb;$n++)
	{
		//Page
		$this->_newobj();
		$this->_out('<</Type /Page');
		$this->_out('/Parent 1 0 R');
		if(isset($this->OrientationChanges[$n]))
			$this->_out(sprintf('/MediaBox [0 0 %.2f %.2f]',$hPt,$wPt));
		$this->_out('/Resources 2 0 R');
		if(isset($this->PageLinks[$n]))
		{
			//Links
			$annots='/Annots [';
			foreach($this->PageLinks[$n] as $pl)
			{
				$rect=sprintf('%.2f %.2f %.2f %.2f',$pl[0],$pl[1],$pl[0]+$pl[2],$pl[1]-$pl[3]);
				$annots.='<</Type /Annot /Subtype /Link /Rect ['.$rect.'] /Border [0 0 0] ';
				if(is_string($pl[4]))
					$annots.='/A <</S /URI /URI '.$this->_textstring($pl[4]).'>>>>';
				else
				{
					$l=$this->links[$pl[4]];
					$h=isset($this->OrientationChanges[$l[0]]) ? $wPt : $hPt;
					$annots.=sprintf('/Dest [%d 0 R /XYZ 0 %.2f null]>>',1+2*$l[0],$h-$l[1]*$this->k);
				}
			}
			$this->_out($annots.']');
		}
		$this->_out('/Contents '.($this->n+1).' 0 R>>');
		$this->_out('endobj');
		//Page content
		$p=($this->compress) ? gzcompress($this->pages[$n]) : $this->pages[$n];
		$this->_newobj();
		$this->_out('<<'.$filter.'/Length '.strlen($p).'>>');
		$this->_putstream($p);
		$this->_out('endobj');
	}
	//Pages root
	$this->offsets[1]=strlen($this->buffer);
	$this->_out('1 0 obj');
	$this->_out('<</Type /Pages');
	$kids='/Kids [';
	for($i=0;$i<$nb;$i++)
		$kids.=(3+2*$i).' 0 R ';
	$this->_out($kids.']');
	$this->_out('/Count '.$nb);
	$this->_out(sprintf('/MediaBox [0 0 %.2f %.2f]',$wPt,$hPt));
	$this->_out('>>');
	$this->_out('endobj');
}

function _putfonts()
{
	$nf=$this->n;
	foreach($this->diffs as $diff)
	{
		//Encodings
		$this->_newobj();
		$this->_out('<</Type /Encoding /BaseEncoding /WinAnsiEncoding /Differences ['.$diff.']>>');
		$this->_out('endobj');
	}
        
	$mqr=get_magic_quotes_runtime();
        ini_set("magic_quotes_runtime", 0);
        	
	foreach($this->FontFiles as $file=>$info)
	{
		//Font file embedding
		$this->_newobj();
		$this->FontFiles[$file]['n']=$this->n;
		if(defined('FPDF_FONTPATH'))
			$file=FPDF_FONTPATH.$file;
		$size=filesize($file);
		if(!$size)
			$this->Error('Font file not found');
		$this->_out('<</Length '.$size);
		if(substr($file,-2)=='.z')
			$this->_out('/Filter /FlateDecode');
		$this->_out('/Length1 '.$info['length1']);
		if(isset($info['length2']))
			$this->_out('/Length2 '.$info['length2'].' /Length3 0');
		$this->_out('>>');
		$f=fopen($file,'rb');
		$this->_putstream(fread($f,$size));
		fclose($f);
		$this->_out('endobj');
	}
        
        ini_set("magic_quotes_runtime", $mqr);
        
	foreach($this->fonts as $k=>$font)
	{
		//Font objects
		$this->fonts[$k]['n']=$this->n+1;
		$type=$font['type'];
		$name=$font['name'];
		if($type=='core')
		{
			//Standard font
			$this->_newobj();
			$this->_out('<</Type /Font');
			$this->_out('/BaseFont /'.$name);
			$this->_out('/Subtype /Type1');
			if($name!='Symbol' and $name!='ZapfDingbats')
				$this->_out('/Encoding /WinAnsiEncoding');
			$this->_out('>>');
			$this->_out('endobj');
		}
		elseif($type=='Type1' or $type=='TrueType')
		{
			//Additional Type1 or TrueType font
			$this->_newobj();
			$this->_out('<</Type /Font');
			$this->_out('/BaseFont /'.$name);
			$this->_out('/Subtype /'.$type);
			$this->_out('/FirstChar 32 /LastChar 255');
			$this->_out('/Widths '.($this->n+1).' 0 R');
			$this->_out('/FontDescriptor '.($this->n+2).' 0 R');
			if($font['enc'])
			{
				if(isset($font['diff']))
					$this->_out('/Encoding '.($nf+$font['diff']).' 0 R');
				else
					$this->_out('/Encoding /WinAnsiEncoding');
			}
			$this->_out('>>');
			$this->_out('endobj');
			//Widths
			$this->_newobj();
			$cw=&$font['cw'];
			$s='[';
			for($i=32;$i<=255;$i++)
				$s.=$cw[chr($i)].' ';
			$this->_out($s.']');
			$this->_out('endobj');
			//Descriptor
			$this->_newobj();
			$s='<</Type /FontDescriptor /FontName /'.$name;
			foreach($font['desc'] as $k=>$v)
				$s.=' /'.$k.' '.$v;
			$file=$font['file'];
			if($file)
				$s.=' /FontFile'.($type=='Type1' ? '' : '2').' '.$this->FontFiles[$file]['n'].' 0 R';
			$this->_out($s.'>>');
			$this->_out('endobj');
		}
		else
		{
			//Allow for additional types
			$mtd='_put'.strtolower($type);
			if(!method_exists($this,$mtd))
				$this->Error('Unsupported font type: '.$type);
			$this->$mtd($font);
		}
	}
}

function _putimages()
{
	$filter=($this->compress) ? '/Filter /FlateDecode ' : '';
	reset($this->images);
	while(list($file,$info)=each($this->images))
	{
		$this->_newobj();
		$this->images[$file]['n']=$this->n;
		$this->_out('<</Type /XObject');
		$this->_out('/Subtype /Image');
		$this->_out('/Width '.$info['w']);
		$this->_out('/Height '.$info['h']);
		if($info['cs']=='Indexed')
			$this->_out('/ColorSpace [/Indexed /DeviceRGB '.(strlen($info['pal'])/3-1).' '.($this->n+1).' 0 R]');
		else
		{
			$this->_out('/ColorSpace /'.$info['cs']);
			if($info['cs']=='DeviceCMYK')
				$this->_out('/Decode [1 0 1 0 1 0 1 0]');
		}
		$this->_out('/BitsPerComponent '.$info['bpc']);
		$this->_out('/Filter /'.$info['f']);
		if(isset($info['parms']))
			$this->_out($info['parms']);
		if(isset($info['trns']) and is_array($info['trns']))
		{
			$trns='';
			for($i=0;$i<count($info['trns']);$i++)
				$trns.=$info['trns'][$i].' '.$info['trns'][$i].' ';
			$this->_out('/Mask ['.$trns.']');
		}
		$this->_out('/Length '.strlen($info['data']).'>>');
		$this->_putstream($info['data']);
		unset($this->images[$file]['data']);
		$this->_out('endobj');
		//Palette
		if($info['cs']=='Indexed')
		{
			$this->_newobj();
			$pal=($this->compress) ? gzcompress($info['pal']) : $info['pal'];
			$this->_out('<<'.$filter.'/Length '.strlen($pal).'>>');
			$this->_putstream($pal);
			$this->_out('endobj');
		}
	}
}

function _putresources()
{
	$this->_putfonts();
	$this->_putimages();
	//Resource dictionary
	$this->offsets[2]=strlen($this->buffer);
	$this->_out('2 0 obj');
	$this->_out('<</ProcSet [/PDF /Text /ImageB /ImageC /ImageI]');
	$this->_out('/Font <<');
	foreach($this->fonts as $font)
		$this->_out('/F'.$font['i'].' '.$font['n'].' 0 R');
	$this->_out('>>');
	if(count($this->images))
	{
		$this->_out('/XObject <<');
		foreach($this->images as $image)
			$this->_out('/I'.$image['i'].' '.$image['n'].' 0 R');
		$this->_out('>>');
	}
	$this->_out('>>');
	$this->_out('endobj');
}

function _putinfo()
{
	$this->_out('/Producer '.$this->_textstring('FPDF '.FPDF_VERSION));
	if(!empty($this->title))
		$this->_out('/Title '.$this->_textstring($this->title));
	if(!empty($this->subject))
		$this->_out('/Subject '.$this->_textstring($this->subject));
	if(!empty($this->author))
		$this->_out('/Author '.$this->_textstring($this->author));
	if(!empty($this->keywords))
		$this->_out('/Keywords '.$this->_textstring($this->keywords));
	if(!empty($this->creator))
		$this->_out('/Creator '.$this->_textstring($this->creator));
	$this->_out('/CreationDate '.$this->_textstring('D:'.date('YmdHis')));
}

function _putcatalog()
{
	$this->_out('/Type /Catalog');
	$this->_out('/Pages 1 0 R');
	if($this->ZoomMode=='fullpage')
		$this->_out('/OpenAction [3 0 R /Fit]');
	elseif($this->ZoomMode=='fullwidth')
		$this->_out('/OpenAction [3 0 R /FitH null]');
	elseif($this->ZoomMode=='real')
		$this->_out('/OpenAction [3 0 R /XYZ null null 1]');
	elseif(!is_string($this->ZoomMode))
		$this->_out('/OpenAction [3 0 R /XYZ null null '.($this->ZoomMode/100).']');
	if($this->LayoutMode=='single')
		$this->_out('/PageLayout /SinglePage');
	elseif($this->LayoutMode=='continuous')
		$this->_out('/PageLayout /OneColumn');
	elseif($this->LayoutMode=='two')
		$this->_out('/PageLayout /TwoColumnLeft');
}

function _puttrailer()
{
	$this->_out('/Size '.($this->n+1));
	$this->_out('/Root '.$this->n.' 0 R');
	$this->_out('/Info '.($this->n-1).' 0 R');
}

function _enddoc()
{
	$this->_putpages();
	$this->_putresources();
	//Info
	$this->_newobj();
	$this->_out('<<');
	$this->_putinfo();
	$this->_out('>>');
	$this->_out('endobj');
	//Catalog
	$this->_newobj();
	$this->_out('<<');
	$this->_putcatalog();
	$this->_out('>>');
	$this->_out('endobj');
	//Cross-ref
	$o=strlen($this->buffer);
	$this->_out('xref');
	$this->_out('0 '.($this->n+1));
	$this->_out('0000000000 65535 f ');
	for($i=1;$i<=$this->n;$i++)
		$this->_out(sprintf('%010d 00000 n ',$this->offsets[$i]));
	//Trailer
	$this->_out('trailer');
	$this->_out('<<');
	$this->_puttrailer();
	$this->_out('>>');
	$this->_out('startxref');
	$this->_out($o);
	$this->_out('%%EOF');
	$this->state=3;
}

function _beginpage($orientation)
{
	$this->page++;
	$this->showpage++;
	$this->pages[$this->page]='';
	$this->state=2;
	$this->x=$this->lMargin;
	$this->y=$this->tMargin;
	$this->FontFamily='';
	//Page orientation
	if(!$orientation)
		$orientation=$this->DefOrientation;
	else
	{
		$orientation=strtoupper($orientation{0});
		if($orientation!=$this->DefOrientation)
			$this->OrientationChanges[$this->page]=true;
	}
	if($orientation!=$this->CurOrientation)
	{
		//Change orientation
		if($orientation=='P')
		{
			$this->wPt=$this->fwPt;
			$this->hPt=$this->fhPt;
			$this->w=$this->fw;
			$this->h=$this->fh;
		}
		else
		{
			$this->wPt=$this->fhPt;
			$this->hPt=$this->fwPt;
			$this->w=$this->fh;
			$this->h=$this->fw;
		}
		$this->PageBreakTrigger=$this->h-$this->bMargin;
		$this->CurOrientation=$orientation;
	}
}

function _endpage()
{
	//End of page contents
	$this->state=1;
}

function _newobj()
{
	//Begin a new object
	$this->n++;
	$this->offsets[$this->n]=strlen($this->buffer);
	$this->_out($this->n.' 0 obj');
}

function _dounderline($x,$y,$txt)
{
	//Underline text
	$up=$this->CurrentFont['up'];
	$ut=$this->CurrentFont['ut'];
	$w=$this->GetStringWidth($txt)+$this->ws*substr_count($txt,' ');
	return sprintf('%.2f %.2f %.2f %.2f re f',$x*$this->k,($this->h-($y-$up/1000*$this->FontSize))*$this->k,$w*$this->k,-$ut/1000*$this->FontSizePt);
}

function _parsejpg($file)
{
	//Extract info from a JPEG file
	$a=GetImageSize($file);
	if(!$a)
		$this->Error('Missing or incorrect image file: '.$file);
	if($a[2]!=2)
		$this->Error('Not a JPEG file: '.$file);
	if(!isset($a['channels']) or $a['channels']==3)
		$colspace='DeviceRGB';
	elseif($a['channels']==4)
		$colspace='DeviceCMYK';
	else
		$colspace='DeviceGray';
	$bpc=isset($a['bits']) ? $a['bits'] : 8;
	//Read whole file
	$f=fopen($file,'rb');
	$data='';
	while(!feof($f))
		$data.=fread($f,4096);
	fclose($f);
	return array('w'=>$a[0],'h'=>$a[1],'cs'=>$colspace,'bpc'=>$bpc,'f'=>'DCTDecode','data'=>$data);
}

function _parsepng($file)
{
	//Extract info from a PNG file
	$f=fopen($file,'rb');
	if(!$f)
		$this->Error('Can\'t open image file: '.$file);
	//Check signature
	if(fread($f,8)!=chr(137).'PNG'.chr(13).chr(10).chr(26).chr(10))
		$this->Error('Not a PNG file: '.$file);
	//Read header chunk
	fread($f,4);
	if(fread($f,4)!='IHDR')
		$this->Error('Incorrect PNG file: '.$file);
	$w=$this->_freadint($f);
	$h=$this->_freadint($f);
	$bpc=ord(fread($f,1));
	if($bpc>8)
		$this->Error('16-bit depth not supported: '.$file);
	$ct=ord(fread($f,1));
	if($ct==0)
		$colspace='DeviceGray';
	elseif($ct==2)
		$colspace='DeviceRGB';
	elseif($ct==3)
		$colspace='Indexed';
	else
		$this->Error('Alpha channel not supported: '.$file);
	if(ord(fread($f,1))!=0)
		$this->Error('Unknown compression method: '.$file);
	if(ord(fread($f,1))!=0)
		$this->Error('Unknown filter method: '.$file);
	if(ord(fread($f,1))!=0)
		$this->Error('Interlacing not supported: '.$file);
	fread($f,4);
	$parms='/DecodeParms <</Predictor 15 /Colors '.($ct==2 ? 3 : 1).' /BitsPerComponent '.$bpc.' /Columns '.$w.'>>';
	//Scan chunks looking for palette, transparency and image data
	$pal='';
	$trns='';
	$data='';
	do
	{
		$n=$this->_freadint($f);
		$type=fread($f,4);
		if($type=='PLTE')
		{
			//Read palette
			$pal=fread($f,$n);
			fread($f,4);
		}
		elseif($type=='tRNS')
		{
			//Read transparency info
			$t=fread($f,$n);
			if($ct==0)
				$trns=array(ord(substr($t,1,1)));
			elseif($ct==2)
				$trns=array(ord(substr($t,1,1)),ord(substr($t,3,1)),ord(substr($t,5,1)));
			else
			{
				$pos=strpos($t,chr(0));
				if(is_int($pos))
					$trns=array($pos);
			}
			fread($f,4);
		}
		elseif($type=='IDAT')
		{
			//Read image data block
			$data.=fread($f,$n);
			fread($f,4);
		}
		elseif($type=='IEND')
			break;
		else
			fread($f,$n+4);
	}
	while($n);
	if($colspace=='Indexed' and empty($pal))
		$this->Error('Missing palette in '.$file);
	fclose($f);
	return array('w'=>$w,'h'=>$h,'cs'=>$colspace,'bpc'=>$bpc,'f'=>'FlateDecode','parms'=>$parms,'pal'=>$pal,'trns'=>$trns,'data'=>$data);
}

function _freadint($f)
{
	//Read a 4-byte integer from file
	$i=ord(fread($f,1))<<24;
	$i+=ord(fread($f,1))<<16;
	$i+=ord(fread($f,1))<<8;
	$i+=ord(fread($f,1));
	return $i;
}

function _textstring($s)
{
	//Format a text string
	return '('.$this->_escape($s).')';
}

function _escape($s)
{
	//Add \ before \, ( and )
	return str_replace(')','\\)',str_replace('(','\\(',str_replace('\\','\\\\',$s)));
}

function _putstream($s)
{
	$this->_out('stream');
	$this->_out($s);
	$this->_out('endstream');
}

function _out($s)
{
	//Add a line to the document
	if($this->state==2)
		$this->pages[$this->page].=$s."\n";
	else
		$this->buffer.=$s."\n";
}
#####################################################################################################
####################### FPDF_CellFit http://fpdf.org/en/script/script62.php #########################
#####################################################################################################

//Cell with horizontal scaling if text is too wide
function CellFit($w, $h=0, $txt='', $border=0, $ln=0, $align='', $fill=false, $link='', $scale=false, $force=true)
{
    //Get string width
    $str_width=($this->GetStringWidth($txt)>0?$this->GetStringWidth($txt):1);

    //Calculate ratio to fit cell
    if($w==0)
        $w = $this->w-$this->rMargin-$this->x;
    $ratio = ($w-$this->cMargin*2)/$str_width;

    $fit = ($ratio < 1 || ($ratio > 1 && $force));
    if ($fit)
    {    
        if ($scale)
        {
            //Calculate horizontal scaling
            $horiz_scale=$ratio*100.0;
            //Set horizontal scaling
            $this->_out(sprintf('BT %.2F Tz ET',$horiz_scale));
        }
        else
        {
            //Calculate character spacing in points
            $char_space=($w-$this->cMargin*2-$str_width)/max($this->MBGetStringLength($txt)-1,1)*$this->k;
            //Set character spacing
            $this->_out(sprintf('BT %.2F Tc ET',$char_space));
        }
        //Override user alignment (since text will fill up cell)
        $align='';
    }    

    //Pass on to Cell method
    $this->Cell($w,$h,$txt,$border,$ln,$align,$fill,$link);
    //Reset character spacing/horizontal scaling
    if ($fit)
        $this->_out('BT '.($scale ? '100 Tz' : '0 Tc').' ET');
}

//Cell with horizontal scaling only if necessary
function CellFitScale($w, $h=0, $txt='', $border=0, $ln=0, $align='', $fill=false, $link='')
{
    $this->CellFit($w,$h,$txt,$border,$ln,$align,$fill,$link,true,false);
}

//Cell with horizontal scaling always
function CellFitScaleForce($w, $h=0, $txt='', $border=0, $ln=0, $align='', $fill=false, $link='')
{
    $this->CellFit($w,$h,$txt,$border,$ln,$align,$fill,$link,true,true);
}

//Cell with character spacing only if necessary
function CellFitSpace($w, $h=0, $txt='', $border=0, $ln=0, $align='', $fill=false, $link='')
{
    $this->CellFit($w,$h,$txt,$border,$ln,$align,$fill,$link,false,false);
}

//Cell with character spacing always
function CellFitSpaceForce($w, $h=0, $txt='', $border=0, $ln=0, $align='', $fill=false, $link='')
{
    //Same as calling CellFit directly
    $this->CellFit($w,$h,$txt,$border,$ln,$align,$fill,$link,false,true);
}

//Patch to also work with CJK double-byte text
function MBGetStringLength($s)
{
    if($this->CurrentFont['type']=='Type0')
    {
        $len = 0;
        $nbbytes = strlen($s);
        for ($i = 0; $i < $nbbytes; $i++)
        {
            if (ord($s[$i])<128)
                $len++;
            else
            {
                $len++;
                $i++;
            }
        }
        return $len;
    }
    else
        return strlen($s);
}
#####################################################################################################

function Rotate($angle,$x=-1,$y=-1)
{
  if($x==-1)
    $x=$this->x;
  if($y==-1)
    $y=$this->y;
  if($this->angle!=0)
    $this->_out('Q');
  $this->angle=$angle;
  if($angle!=0)
  {
    $angle*=M_PI/180;
    $c=cos($angle);
    $s=sin($angle);
    $cx=$x*$this->k;
    $cy=($this->h-$y)*$this->k;
    $this->_out(sprintf('q %.5f %.5f %.5f %.5f %.2f %.2f cm 1 0 0 1 %.2f %.2f cm',$c,$s,-$s,$c,$cx,$cy,-$cx,-$cy));
  }
}

function RotatedText($x,$y,$txt,$angle)
{
  //Text rotated around its origin
  $this->Rotate($angle,$x,$y);
  $this->Text($x,$y,$txt);
  $this->Rotate(0);
}

function RotatedImage($file,$x,$y,$w,$h,$angle)
{
  //Image rotated around its upper-left corner
  $this->Rotate($angle,$x,$y);
  $this->Image($file,$x,$y,$w,$h);
  $this->Rotate(0);
}

function RoundedRect($x, $y, $w, $h, $r, $style = '')
{
  $k = $this->k;
  $hp = $this->h;
  if($style=='F')
    $op='f';
  elseif($style=='FD' || $style=='DF')
    $op='B';
  else
    $op='S';
  $MyArc = 4/3 * (sqrt(2) - 1);
  $this->_out(sprintf('%.2F %.2F m',($x+$r)*$k,($hp-$y)*$k ));
  $xc = $x+$w-$r ;
  $yc = $y+$r;
  $this->_out(sprintf('%.2F %.2F l', $xc*$k,($hp-$y)*$k ));

  $this->_Arc($xc + $r*$MyArc, $yc - $r, $xc + $r, $yc - $r*$MyArc, $xc + $r, $yc);
  $xc = $x+$w-$r ;
  $yc = $y+$h-$r;
  $this->_out(sprintf('%.2F %.2F l',($x+$w)*$k,($hp-$yc)*$k));
  $this->_Arc($xc + $r, $yc + $r*$MyArc, $xc + $r*$MyArc, $yc + $r, $xc, $yc + $r);
  $xc = $x+$r ;
  $yc = $y+$h-$r;
  $this->_out(sprintf('%.2F %.2F l',$xc*$k,($hp-($y+$h))*$k));
  $this->_Arc($xc - $r*$MyArc, $yc + $r, $xc - $r, $yc + $r*$MyArc, $xc - $r, $yc);
  $xc = $x+$r ;
  $yc = $y+$r;
  $this->_out(sprintf('%.2F %.2F l',($x)*$k,($hp-$yc)*$k ));
  $this->_Arc($xc - $r, $yc - $r*$MyArc, $xc - $r*$MyArc, $yc - $r, $xc, $yc - $r);
  $this->_out($op);
}

function _Arc($x1, $y1, $x2, $y2, $x3, $y3)
{
  $h = $this->h;
  $this->_out(sprintf('%.2F %.2F %.2F %.2F %.2F %.2F c ', $x1*$this->k, ($h-$y1)*$this->k,
  $x2*$this->k, ($h-$y2)*$this->k, $x3*$this->k, ($h-$y3)*$this->k));
}

//End of class
}

//Handle special IE contype request
if(isset($_SERVER['HTTP_USER_AGENT']) and $_SERVER['HTTP_USER_AGENT']=='contype')
{
	Header('Content-Type: application/pdf');
	exit;
}

}