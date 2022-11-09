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

/**
* JS menu generation class
*
* @author  Atua Sistemas de Informação
* @since   2003-02-17
* @package Jaguar
*/

require_once(JAGUAR_PATH . "JPrimitiveObject.php");

class JMenu extends JPrimitiveObject
{
  var $mNoOffFirstLineMenus     = 1;
  var $mLowBgColor              = "#8585EF";
  var $mHighBgColor             = "#F0F0F0";
  var $mFontLowColor            = "black";
  var $mFontHighColor           = "blue";
  var $mBorderColor             = "black";
  var $mBorderWidthMain         = 0;
  var $mBorderWidthSub          = 0;
  var $mBorderBtwnMain          = 0;
  var $mBorderBtwnSub           = 0;
  var $mFontFamily              = "helvetica, arial, geneva";
  var $mFontSize                = 8;
  var $mFontBold                = 0;
  var $mFontItalic              = 0;
  var $mMenuTextCentered        = "left";
  var $mMenuCentered            = "centerjustify";
  var $mMenuVerticalCentered    = "top";
  var $mChildOverlap            = .2;
  var $mChildVerticalOverlap    = .2;
  var $mStartTop                = 0;
  var $mStartLeft               = 0;
  var $mVerCorrect              = 0;
  var $mHorCorrect              = 0;
  var $mLeftPaddng              = 3;
  var $mTopPaddng               = 2;
  var $mFirstLineHorizontal     = 1;
  var $mMenuFramesVertical      = 0;
  var $mDissapearDelay          = 1000;
  var $mUnfoldDelay             = 100;
  var $mTakeOverBgColor         = 0;
  var $mFirstLineFrame          = "menu";
  var $mSecLineFrame            = "conteudo";
  var $mDocTargetFrame          = "conteudo";
  var $mTargetLoc               = "";
  var $mMenuWrap                = 1;
  var $mRightToLeft             = 0;
  var $mBottomUp                = 0;
  var $mUnfoldsOnClick          = 0;
  var $mBaseHref                = "";
  var $mArrows                   = "";
  var $mMenuUsesFrames          = 1;
  var $mRememberStatus          = 0;
  var $mPartOfWindow            = .8;
  var $mBuildOnDemand           = 0;
  var $mMenuSlide               = "";
  var $mMenuShadow              = "";
  var $mMenuOpacity             = "";
  var $mHeight                  = 20;
  var $mWidth                   = 160;
  var $mMenuMarginLeft          = '0%'; 
  
  
  var $mObjects;  
  var $mSqls;
  var $mConn;
  var $mLevels;
 
  /**
  * Constructor
  * @param object $conn A JDBConnecion object
  */
  function __construct($conn)
  {
    $this->SetConnection($conn);
    $this->SetArrows();
  }

  /**
  * Stores the JDBConnection object
  * @param object &$conn The address of a JDBConnecion object
  */
  function SetConnection($conn)
  {
    $this->mConn = $conn;
  }

  /**
  * Stores the number of menu items in the first line
  * @param int $number Number of menu items in the first line 
  */
  function SetNoOffFirstLineMenus($number)
  {
    $this->mNoOffFirstLineMenus = $number;
  }

  /**
  * Sets the CSS MarginLeft property
  * @param integer $margin percent margin left
  */
  function SetMarginLeft($margin)
  {
    $this->mMenuMarginLeft = $margin.'%';
  }

  /**
  * Arrow source, width and height.
  * @param string $arrws A string containing arrows source, width and height
  */                        
  function SetArrows($arrws = false)
  {
    $str = "[\"". URL ."img/tri.gif\",5,10," .
           " \"". URL ."img/tridown.gif\",10,5,".
           " \"". URL ."img/trileft.gif\",5,10,".
           " \"". URL ."img/triup.gif\",10,5]";
    $this->mArrows = ($arrws)?$arrws:$str;
  }

  /* Background color when mouse is not over */
  function SetLowBgColor($lowbgcolor)
  {
    $this->mLowBgColor = $lowbgcolor;
  }

  /* Background color when mouse is over */
  function SetHighBgColor($highbgcolor)
  {
    $this->mHighBgColor = $highbgcolor;
  }

  /* Font color when mouse is not over */
  function SetFontLowColor($fontlowcolor)
  {
    $this->mFontLowColor = $fontlowcolor;
  }

  /* Font color when mouse is over */
  function SetFontHighColor($fonthighcolor)
  {
    $this->mFontHighColor = $fonthighcolor;
  }

  /* Border color */
  function SetBorderColor($bordercolor)
  {
    $this->mBorderColor = $bordercolor;
  }

  /* Border width main items */
  function SetBorderWidthMain($borderwidthmain)
  {
    $this->mBorderWidthMain = $borderwidthmain;
  }

  /* Border width sub items */
  function SetBorderWidthSub($borderwidthsub)
  {
    $this->mBorderWidthSub = $borderwidthsub;
  }

  /* Border between elements main items 1 or 0 */
  function SetBorderBtwnMain($borderbtwnmain)
  {
    $this->mBorderBtwnMain ($borderbtwnmain);
  }

  /* Border between elements sub items 1 or 0 */
  function SetBorderBtwnSub($borderbtwnsub)
  {
    $this->mBorderBtwnSub = $borderbtwnsub;
  }

  /* Font family menu items*/
  function SetFontFamily($fontfamily)
  {
    $this->mFontFamily = $fontfamily;
  }

  /* Font size menu items */
  function SetFontSize($fontsize)
  {
    $this->mFontSize =$fontsize;
  }

  /* Bold menu items 1 or 0 */
  function SetFontBold($fontbold)
  {
    $this->mFontBold = $fontbold;
  }

  /* Italic menu items 1 or 0 */
  function SetFontItalic($fontitalic)
  {
    $this->mFontItalic = $fontitalic;
  }

  /* Item text position left, center or right */
  function SetMenuTextCentered($menutextcentered)
  {
    $this->mMenuTextCentered = $menutextcentered;
  }

  /**
  * Menu horizontal position can be: left, center, right, justify 
  * leftjustify, centerjustify or rightjustify. 
  * PartOfWindow determines part of window to use
  */
  function SetMenuCentered($menucentered)
  {
    $this->mMenuCentered = $menucentered;
  }

  /* Menu vertical position top, middle,bottom or static */
  function SetMenuVerticalCentered($menuverticalcentered)
  {
    $this->mMenuVerticalCentered = $menuverticalcentered;
  }
  
  /* horizontal overlap child/parent */
  function SetChildOverlap($childoverlap)
  {
    $this->mChildOverlap = $childoverlap;
  }

  /* vertical overlap child/parent */
  function SetChildVerticalOverlap($childverticaloverlap)
  {
    $this->mChildVerticalOverlap = $childverticaloverlap;
  }

  /**
  * Menu offset x coordinate. 
  * If StartTop is between 0 and 1 StartTop is calculated as part of windowheight
  */
  function SetStartTop($starttop)
  {
    $this->mStartTop = $starttop;
  }

  /**  Menu offset y coordinate. 
  * If StartLeft is between 0 and 1 StartLeft is calculated as part of windowheight
  */
  function SetStartLeft($starleft)
  {
    $this->mStartLeft = $startleft;
  }

  /* Multiple frames y correction */
  function SetVerCorrect($vercorrect)
  {
    $this->mVerCorrect = $vercorrect;
  }

  /* Multiple frames x correction */
  function SetHorCorrect($horcorrect)
  {
    $this->mHorCorrect = $horcorrect;
  }
  
  /* Left padding */
  function SetLeftPaddng($leftpaddng)
  {
    $this->mLeftPaddng = $leftpaddng;
  }

  /* Top padding */
  function SetTopPaddng($toppaddng)
  {
    $this->mTopPaddng = $toppaddng;
  }

  /* First level items layout horizontal 1 or 0 */
  function SetFirstLineHorizontal($firstlinehorizontal)
  {
    $this->mFirstLineHorizontal = $firstlinehorizontal;
  }

  /* Frames in cols or rows 1 or 0 */
  function SetMenuFramesVertical($menuframesvertical)
  {
    $this->mMenuFramesVertical = $menuframesvertical;
  }

  /* Delay before menu folds in */
  function SetDissapearDelay($dissapeardelay)
  {
    $this->mDissapearDelay = $dissapeardelay;
  }

  /* Delay before sub unfolds */
  function SetUnfoldDelay($unfolddelay)
  {
    $this->mUnfoldDelay = $unfolddelay;
  }

  /* Menu frame takes over background color subitem frame */
  function SetTakeOverBgColor($takeopverbgcolor)
  {
    $this->mTakeOverBgColor = $takeopverbgcolor;
  }

  /* Frame where first level appears */
  function SetFirstLineFrame($firstlineframe)
  {
    $this->mFirstLineFrame = $firstlineframe;
  }

  /* Frame where sub levels appear */
  function SetSecLineFrame($seclineframe)
  {
    $this->mSecLineFrame = $seclineframe;
  }

  /* Frame where target documents appear */
  function SetDocTargetFrame($doctargetframe)
  {
    $this->mDocTargetFrame = $doctargetframe;
  }

  /* Span id for relative positioning */
  function SetTargetLoc($targetloc)
  {
    $this->mTargetLoc = $targetloc;
  }

  /* Enables/disables menu wrap 1 or 0 */
  function SetMenuWrap($menuwrap)
  {
    $this->mMenuWrap = $menuwrap;
  }

  /* Enables/disables right to left unfold 1 or 0 */
  function SetRightToLeft($righttoleft)
  {
    $this->mRightToLeft = $righttoleft;
  }

  /* Enables/disables Bottom up unfold 1 or 0 */
  function SetBottomUp($bottomup)
  {
    $this->mBottomUp = $bootomup;
  }

  /* Level 1 unfolds onclick/ onmouseover */
  function SetUnfoldsOnClick($unfoldsonclick)
  {
    $this->mUnfoldsOnClick = $unfoldsonclick;
  }

  /**
  * The script precedes your relative links with BaseHref
  * For instance:
  * when your BaseHref= "http://www.MyDomain/" and a link in the menu is "subdir/MyFile.htm",
  * the script renders to: "http://www.MyDomain/subdir/MyFile.htm"
  * Can also be used when you use images in the textfields of the menu
  * "MenuX=new Array("<img src=\""+BaseHref+"MyImage\">"
  * For testing on your harddisk use syntax like: BaseHref="file:///C|/MyFiles/Homepage/"
  */
  function SetBaseHref($basehref = false)
  {
    $this->mBaseHref = ($basehref)?$basehref: URL;
  }

  /**
  * Sets if the menu is in one frame and its target in another
  *
  * MenuUsesFrames is only 0 when Main menu, submenus,
  * document targets and script are in the same frame.
  * In all other cases it must be 1
  *
  * @param $menuUsesFrames integer { 0 | 1 }
  */
  function SetMenuUsesFrames($menuUsesFrames)
  {
    $this->mMenuUsesFrames = $menuUsesFrames;
  }

  /**
  * RememberStatus: When set to 1, menu unfolds to the presetted menu item.
  * When set to 2 only the relevant main item stays highligthed
  * The preset is done by setting a variable in the head section of the target document.
  * <head>
  * <script type="text/javascript">var SetMenu="2_2_1";</script>
  * </head>
  *   2_2_1 represents the menu item Menu2_2_1=new Array(.......
  */
  function SetRememberStatus($rememberStatus)
  {
    $this->mRememberStatus = $rememberStatus;
  }
                        
  /**
  * PartOfWindow: When MenuCentered is justify, sets part of window width to stretch to
  * Below some pretty useless effects, since only IE6+ supports them
  * I provided 3 effects: MenuSlide, MenuShadow and MenuOpacity
  * If you don't need MenuSlide just leave in the line var MenuSlide="";
  * delete the other MenuSlide statements
  * In general leave the MenuSlide you need in and delete the others.
  * Above is also valid for MenuShadow and MenuOpacity
  * You can also use other effects by specifying another filter for MenuShadow and MenuOpacity.
  * You can add more filters by concanating the strings
  */
  function SetPartOfWindow($partOfWindows)
  {
    $this->mPartOfWindow = $partOfWindows;
  }

  /* 1/0 When set to 1 the sub menus are build when the parent is moused over */
  function SetBuildOnDemand($buildOnDemand)
  {
    $this->mBuildOnDemand = $buildOnDemand;
  }

  /**
  * Adds a menu item to the menu
  *
  * Menu tree:
  * MenuX=new Array("ItemText","Link","background image",number of sub elements,
  *                 height,width,"bgcolor","bghighcolor", "fontcolor","fonthighcolor",
  *                 "bordercolor","fontfamily",fontsize,fontbold,fontitalic,"textalign",
  *                 "statustext");
  * Color and font variables defined in the menu tree take precedence over the global variables
  * Fontsize, fontbold and fontitalic are ignored when set to -1.
  * For rollover images ItemText format is:  "rollover?"+BaseHref+"Image1.jpg?"+
  *                                                      BaseHref+"Image2.jpg"
  *
  * @param string $level A string indicating this menu level. Ex.: 1, 1_1, 1_2_1
  * @param string $label The menu item label
  * @param string $url The menu item link
  * @param int $numberOfElements The number of elements of this menu item, if it contains subitems
  */
  function AddMenuObject($level = false, $label = false, $url = false, $numberOfElements = false)
  {
    $str = "";
    $str .= "Menu$level = new Array(".
            "'" . $label . "'," .
            "'" . $url . "'," .
            "''," .
            (($numberOfElements)?$numberOfElements:0) . ',' .
            $this->mHeight . "," .
            $this->mWidth . "," .
            "''," . 
            "''," . 
            "''," . 
            "''," . 
            "''," . 
            "''," . 
            "'-1'," . 
            "'-1'," . 
            "'-1'," . 
            "''," . 
            "'');\n";
    $this->mObjects[] = $str;
  }
  
  /**
  * Stores the SQL statements to build the menu dynamically
  * @param string $index The index in the associative mSqls array. { parent_folders | subfolders_count | functions_count | folders_and_functions}
  */
  function SetSql($index, $sql)
  {
    $this->mSqls[$index]= $sql;
  }

  /**
  * Verifies if all the SQL to build the menu dynamically are set and builds it
  */ 
  function BuildMenuFromSql()
  {

    if ( (strlen($this->mSqls["parent_folders"]) > 0)
       && (strlen($this->mSqls["subfolders_count"]) > 0)
       && (strlen($this->mSqls["functions_count"]) > 0)
       && (strlen($this->mSqls["folders_and_functions"]) > 0) )
    {
      unset($this->mLevels);
      $this->BuildParentFolders();
      $this->BuildMenuFromItems();
    }//if

  }

  /**
  * If the menu is being mounted dynamically, builds the menu's first line
  */
  function BuildParentFolders()
  {
    if ($rs = $this->mConn->Select($this->mSqls["parent_folders"]))
    {
      $this->SetNoOffFirstLineMenus($rs->GetRowCount());
      $i = 1;
      while (!$rs->IsEof())
      {
        $this->mItems[] = array($rs->GetField(0), $rs->GetField(1), '1', 0, $i);

        $this->GetChildren($rs->GetField(0), $i."_");
        
        $rs->Next();
        
        $i++;
      }
      $rs->Close();
    }
    else
      echo "Erro no SQL - parent_folders";
  }

  /**
  * If the menu is being mounted dynamically, counts the number of subitems or an item
  * @returns integer
  */
  function GetItemsCount($code)
  {
    $trans = array("__CODE__" => $code);

    $sql = strtr($this->mSqls["functions_count"], $trans);

    if ($rs = $this->mConn->Select($sql))
      return $rs->GetField(0);
    else
    {
      echo "Erro no SQL - functions_count - $sql";
      return 0;
    }
  }

  /**
  * If the menu is being mounted dynamically, counts the number of folers or an item
  * @returns integer
  */
  function GetSubFoldersCount($code)
  {
    $trans = array("__CODE__" => $code);

    $sql = strtr($this->mSqls["subfolders_count"], $trans);

    if ($rs = $this->mConn->Select($sql))
      return $rs->GetField(0);
    else
    {
      echo "Erro no SQL - subfolders_count - $sql";
      return 0;
    }
  }

  /**
  * Obtains the children items for an specified item
  * @param int $codw The parent items code
  * @param string $parentLevel The description of the parent level. Eg.: 1_2, 3_1_5, 1
  */
  function GetChildren($code, $parentLevel = false)
  {
    $trans = array("__CODE__" => $code);
    $sql = strtr($this->mSqls["folders_and_functions"], $trans);
    
    if ($rs = $this->mConn->Select($sql) )
    {
      $i = 1;
      while (!$rs->IsEof())
      {
        
        $this->mItems[] = array($rs->GetField(0), $rs->GetField(1), 
                                $rs->GetField(3), $code, 
                                $parentLevel.$i, $rs->GetField(4));

        if ($rs->GetField(3))
          $this->GetChildren($rs->GetField(0), $parentLevel.$i."_");
      
        $rs->Next();
        
        $i++;
      }
      $rs->Close();
    }
    else
      echo "Erro no SQL - folders_and_functions";
     
  }

  /** 
  * If the menu is being build dynamically, calls AddMenuObject based on the mItems array
  */
  function BuildMenuFromItems()
  {
    for ($i = 0; $i < sizeof($this->mItems); $i++)
    {
      $qtd = 0;
      if ($this->mItems[$i][2])
        $qtd += $this->GetItemsCount($this->mItems[$i][0]) + $this->GetSubFoldersCount($this->mItems[$i][0]);
      
      $this->AddMenuObject($this->mItems[$i][4], $this->mItems[$i][1], $this->mItems[$i][5], $qtd);
    }
  }

  /**
  * Debug function, show the items array to verify the existence os errors
  */
  function ShowItemsArray()
  {
    echo "<table border=1>";
    for ($i = 0; $i < sizeof($this->mItems); $i++)
    {
    
      echo "<tr><td>";
      echo $this->mItems[$i][0] . "</td><td>" . $this->mItems[$i][1] . "</td><td>" . 
           $this->mItems[$i][2] . "</td><td>" .$this->mItems[$i][3] . "</td><td>" .$this->mItems[$i][4] ;
      echo "</td></tr>";
    }
    echo "</table>";
  }
  
  /**
  * Builds the menu's output
  * @returns string
  */
  function GetHtml()
  {
    $out  = "\n\n<script>\n";
    $out .= "  var MenuMarginLeft = '$this->mMenuMarginLeft';\n";
    $out .= "  var NoOffFirstLineMenus = $this->mNoOffFirstLineMenus;\n";
    $out .= "  var LowBgColor = \"$this->mLowBgColor\";\n";
    $out .= "  var HighBgColor = \"$this->mHighBgColor\";\n";
    $out .= "  var FontLowColor = \"$this->mFontLowColor\";\n";
    $out .= "  var FontHighColor = \"$this->mFontHighColor\";\n";
    $out .= "  var BorderColor = \"$this->mBorderColor\";\n";
    $out .= "  var BorderWidthMain = $this->mBorderWidthMain;\n";
    $out .= "  var BorderWidthSub = $this->mBorderWidthSub;\n";
    $out .= "  var BorderBtwnMain = $this->mBorderBtwnMain;\n";
    $out .= "  var BorderBtwnSub = $this->mBorderBtwnSub;\n";
    $out .= "  var FontFamily = \"$this->mFontFamily\";\n";
    $out .= "  var FontSize = $this->mFontSize;\n";
    $out .= "  var FontBold = $this->mFontBold;\n";
    $out .= "  var FontItalic = $this->mFontItalic;\n";
    $out .= "  var MenuTextCentered = \"$this->mMenuTextCentered\";\n";
    $out .= "  var MenuCentered = \"$this->mMenuCentered\";\n";
    $out .= "  var MenuVerticalCentered = \"$this->mMenuVerticalCentered\";\n";
    $out .= "  var ChildOverlap = $this->mChildOverlap;\n";
    $out .= "  var ChildVerticalOverlap = $this->mChildVerticalOverlap;\n";
    $out .= "  var StartTop = $this->mStartTop;\n";
    $out .= "  var StartLeft = $this->mStartLeft;\n";
    $out .= "  var VerCorrect = $this->mVerCorrect;\n";
    $out .= "  var HorCorrect = $this->mHorCorrect;\n";
    $out .= "  var LeftPaddng = $this->mLeftPaddng;\n";
    $out .= "  var TopPaddng = $this->mTopPaddng;\n";
    $out .= "  var FirstLineHorizontal = $this->mFirstLineHorizontal;\n";
    $out .= "  var MenuFramesVertical = $this->mMenuFramesVertical;\n";
    $out .= "  var DissapearDelay = $this->mDissapearDelay;\n";
    $out .= "  var UnfoldDelay = $this->mUnfoldDelay;\n";
    $out .= "  var TakeOverBgColor = $this->mTakeOverBgColor;\n";
    $out .= "  var FirstLineFrame = \"$this->mFirstLineFrame\";\n";
    $out .= "  var SecLineFrame = \"$this->mSecLineFrame\";\n";
    $out .= "  var DocTargetFrame = \"$this->mDocTargetFrame\";\n";
    $out .= "  var TargetLoc = \"$this->mTargetLoc\";\n";
    $out .= "  var MenuWrap = $this->mMenuWrap;\n";
    $out .= "  var RightToLeft = $this->mRightToLeft;\n";
    $out .= "  var BottomUp = $this->mBottomUp;\n";
    $out .= "  var UnfoldsOnClick = $this->mUnfoldsOnClick;\n";
    $out .= "  var BaseHref = \"$this->mBaseHref\";\n";
    $out .= "  var Arrws = $this->mArrows;\n";
    $out .= "  var MenuUsesFrames = $this->mMenuUsesFrames;\n";
    $out .= "  var RememberStatus = $this->mRememberStatus;\n";
    $out .= "  var PartOfWindow = $this->mPartOfWindow;\n";
    $out .= "  var BuildOnDemand = $this->mBuildOnDemand;\n";
    $out .= "  var MenuSlide = \"$this->mMenuSlide\";\n";
    $out .= "  var MenuShadow = \"$this->mMenuShadow\";\n";
    $out .= "  var MenuOpacity = \"$this->mMenuOpacity\";\n";

    $out .= "\n\n";
    $out .= "  function BeforeStart(){return}\n";
    $out .= "  function AfterBuild(){return}\n";
    $out .= "  function BeforeFirstOpen(){return}\n";
    $out .= "  function AfterCloseAll(){return}\n";
    $out .= "\n\n";

    for ($i=0; count($this->mObjects) > $i; $i++)
    {
      $out .= $this->mObjects[$i] . "\n\n";
    }

    $out .= "</script>\n";
    $out .= "<script src=\"". URL ."js/jmenu.js\" language=\"JavaScript\"></script>\n";

    return $out;
  }
}