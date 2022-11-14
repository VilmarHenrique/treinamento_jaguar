<?
/**
* Pdf Report Creation Class
*
* @author   dachkf5@gmail.com
* @since    2007-04-17 11:28:48
* @package 
*/
class fpdfReport extends FPDF 
{

  // TODO
  var $mUsePaginationAsCategorization = false; 

  // TODO - negrito nos campos mostrados 
  var $mBold = "";

  /**
  * Jaguar's connection object
  * @var object
  */
  var $mConn;

  /**
  * Stores result set 
  * @var object
  */
  var $mResultSet;

  /**
  * Stores a copy of the last row of the result set 
  * @var object
  */
  var $mLastResultSetRow;

  /**
  * Stores report's title
  * @var string
  */
  var $mTitle;

  /**
  * Stores report's subtitle
  * @var string
  */
  var $mSubTitle;

  /**
  * Stores report's smaller subtitle
  * @var string
  */
  var $mSubTitle2;

  /**
  * Default font type used to create reports
  * @var string
  */
  var $mDefaultFont;

  /**
  * Default font size used to create reports
  * @var int
  */
  var $mDefaultFontSize = 6;

  /**
  * Categorization font size  
  * @var int
  */
  var $mCategorizationFontSize = 6;

  /**
  * Totalization cell font size  
  * @var int 
  */
  var $mTotalsFontSize = 6;

  /**
  * Label font size  
  * @var int 
  */
  var $mLabelFontSize = 6;

  /**
  * Reports' page orientation [h/v]
  * @var string
  */
  var $mPageOrientation;

  /**
  * Stores reports' page width
  * @var int
  */
  var $mPageWidth;

  /**
  * Stores reports' page height
  * @var int
  */
  var $mPageHeight;

  /**
  * Stores reports' line height
  * @var int
  */
  var $mLineHeight;

  /**
  * Stores the field name used to paginate the report,
  * this filed name comes in the resultset
  * @var string
  */
  var $mPaginationField;

  /**
  * Stores maximum width used by $mCellFieldsArray fields
  * @var string
  */
  var $mTotalsLineMaxWidth;

  /**
  * Stores fields to create page labels 
  * @var array
  */
  var $mPaginationLabelArray = array();

  /**
  * Stores fields to create categorization labels
  * @var array
  */
  var $mCategorizationLabelArray = array();

  /**
  * Odd cells' background RED color
  * @var int
  */
  var $mCellBgOddR;

  /**
  * Odd cells' background GREEN color
  * @var int
  */
  var $mCellBgOddG;

  /**
  * Odd cells' background BLUE color
  * @var int
  */
  var $mCellBgOddB;

  /**
  * Even cells' background RED color
  * @var int
  */
  var $mCellBgEvenR;

  /**
  * Even cells' background GREEN color
  * @var int
  */
  var $mCellBgEvenG;

  /**
  * Even cells' background BLUE color
  * @var int
  */
  var $mCellBgEvenB;

  /**
  * Change report cells background color
  * @var boolean
  */
  var $mChangeReportCellBgColor = false;

  /**
  * Change categorization cells background color
  * @var boolean
  */
  var $mChangeCategorizationCellBgColor = false;

  /**
  * Categorization cells' background RED color 
  * @var int
  */
  var $mCategorizationCellBgR;

  /**
  * Categorization cells' background GREEN color 
  * @var int
  */
  var $mCategorizationCellBgG;

  /**
  * Categorization cells' background BLUE color 
  * @var int
  */
  var $mCategorizationCellBgB;

  /**
  * Stores columns labels 
  * @var array
  */
  var $mLabelArray = array();

  /**
  * Stores result set fields shown on report
  * @var array
  */
  var $mCellFieldsArray = array();

  /**
  * Stores result set fields used to make totalization cell
  * @var array
  */
  var $mTotalizationCellFieldsArray = array();

  /**
  * Field used to categorize the report
  * @var string
  */
  var $mCategorizationField;

  /**
  * Stores total values
  * @var array
  */
  var $mTotalArray = array();

  /**
  * Stores pagination total values
  * @var array
  */
  var $mPaginationTotalArray = array();

  /**
  * Stores categorization total values 
  * @var array
  */
  var $mCategorizationTotalArray = array();

  /**
  * Counts number of lines within pagination range
  * @var int
  */
  var $mCountPaginationLines = 0;

  /**
  * Counts number of lines within categorization range
  * @var int
  */
  var $mCountCategorizationLines = 0;

  /**
  * Controls if pagination total cell should be shown or not 
  * @var boolean
  */
  var $mShowPaginationTotal = true;

  /**
  * Controls if categorization total cell should be shown or not
  * @var boolean
  */
  var $mShowCategorizationTotal = true;

  /**
  * Controls if total cell should be shown or not
  * @var boolean
  */
  var $mShowTotal = true;

  /**
  * Stores external function called on pagination 
  * @var array
  */
  var $mPaginationExternalFunction = array();

  /**
  * Stores external function called on categorization
  * @var array
  */
  var $mCategorizationExternalFunction = array();

  /**
  * Stores external function called in the end of the report 
  * @var array
  */
  var $mFooterExternalFunction = array();

  /**
  * Stores external function called in the begining of the report 
  * @var array
  */
  var $mBeginingExternalFunction = array();


  /**
  * Constructor
  * @param object $pConn            Jaguar's connection object 
  * @param string $pPageOrientation Report's page orientation (h/v)
  * @param string $pTitle           Report's title
  * @param string $pSubTitle        Report's subtitle
  * @param string $pSubTitle        Report's smaller subtitle
  */
  function fpdfReport(&$pConn, $pPageOrientation="v", $pTitle="", $pSubTitle="", $pSubTitle2="")
  {
    $this->mConn            = $pConn;

    $this->mPageOrientation = (strtolower($pPageOrientation)=="h" || strtolower($pPageOrientation)=="v")?
                               strtolower($pPageOrientation) : "v";

    $this->mTitle       = $pTitle;
    $this->mSubTitle    = $pSubTitle;
    $this->mSubTitle2   = $pSubTitle2;

    $this->mLineHeight  = 3;
    $this->mDefaultFont = "arial";

    $this->setPageSize();

    // FPDF constructor
    $this->FPDF((($this->mPageOrientation=="v")?"P":"L"));
  }


  /**
  * Executes external functions
  * @param array $pExternalFunction  |$mPaginationExternalFunction|$mCategorizationExternalFunction|$mFooterExternalFunction|
  */
  function callExternalFunction($pExternalFunction)
  {
    if (!count($pExternalFunction))
      return;

    if (is_array($pExternalFunction[1]))
    {
      foreach ($pExternalFunction[1] AS $key=>$value)
        $pExternalFunction[1][$key] = $this->mLastResultSetRow->GetField($value);
    }

    $opCallbackParameters = (is_array($pExternalFunction[1]))
                      ? array_merge(array(&$this), $pExternalFunction[1])
                      : array(&$this);

    call_user_func_array($pExternalFunction[0], $opCallbackParameters);
  }


  /**
  * Executes external functions using current result set 
  * @param array $pExternalFunction  |$mPaginationExternalFunction|$mCategorizationExternalFunction|$mFooterExternalFunction|
  */
  function callExternalFunctionCurrentRS($pExternalFunction)
  {
    if (!count($pExternalFunction))
      return;

    if (is_array($pExternalFunction[1]))
    {
      foreach ($pExternalFunction[1] AS $key=>$value)
        $pExternalFunction[1][$key] = $this->mResultSet->GetField($value); 
    }

    $opCallbackParameters = (is_array($pExternalFunction[1]))
                      ? array_merge(array(&$this), $pExternalFunction[1])
                      : array(&$this);

    call_user_func_array($pExternalFunction[0], $opCallbackParameters);
  }


  /**
  * Sets if external function should be called in the begining of the report 
  * @param array $pBeginingExternalFunction   External function name and result set field names \n
  *     array("function_name", \n
  *           array("resultset", "field", "names"...) \n
  *     ) \n
  */
  function setBeginingExternalFunction($pBeginingExternalFunction)
  {
    $this->mBeginingExternalFunction = $pBeginingExternalFunction;
  }


  /**
  * Sets if external function should be called on pagination 
  * @param array $pPaginationExternalFunction   External function name and result set field names \n
  *     array("function_name", \n
  *           array("resultset", "field", "names"...) \n
  *     ) \n
  */
  function setPaginationExternalFunction($pPaginationExternalFunction)
  {
    $this->mPaginationExternalFunction = $pPaginationExternalFunction;
  }


  /**
  * Sets if external function should be called on categorization 
  * @param array $pPaginationExternalFunction   External function name and result set field names \n
  *     array("function_name", \n
  *           array("resultset", "field", "names"...) \n
  *     ) \n
  */
  function setCategorizationExternalFunction($pCategorizationExternalFunction)
  {
    $this->mCategorizationExternalFunction = $pCategorizationExternalFunction;
  }


  /**
  * Sets if external function should be called in the end of the report 
  * @param array $pPaginationExternalFunction   External function name and result set field names \n
  *     array("function_name", \n
  *           array("resultset", "field", "names"...) \n
  *     ) \n
  */
  function setFooterExternalFunction($pFooterExternalFunction)
  {
    $this->mFooterExternalFunction = $pFooterExternalFunction;
  }


  /**
  * Shows message when result set is empty
  */
  function showEmptyRSMessage()
  {
    echo "EMPTY RESULT SET";
    exit();
  }


  /**
  * Sets page width and height
  */
  function setPageSize()
  {
    if ($this->mPageOrientation == "h")
    {
      $this->mPageWidth = 290;
      $this->mPageHeight = 195;
    }
    else
    {
      $this->mPageWidth = 205;
      $this->mPageHeight = 280;
    }
  }


  /**
  * Shows reports titles and draws page border
  */
  function createNewPage()
  {
    $this->AddPage();
    $this->SetMargins(0, 0);
    $this->SetFont($this->mDefaultFont, "b", 7);
    $this->SetXY(5, $this->GetY());

    if ($this->mPageOrientation == "h")
    {
      $this->Rect(5, 5, 285, 197);
      $titleXPosition = 22;
      $titleCellWidth = 225;
    }
    else
    {
      $this->Rect(5, 5, 200, 285);
      $titleXPosition = 22;
      $titleCellWidth = 142;
    }

    $this->SetAutoPageBreak(false);

    // title
    $this->SetFont($this->mDefaultFont, "b", 12);
    $this->SetXY($titleXPosition, 8);
    $this->Cell($titleCellWidth, 4, $this->mTitle, 0, 1, "C");

    // subtitle
    $this->SetFont($this->mDefaultFont, "", 8);
    $this->SetXY($titleXPosition, $this->GetY() + 1);
    $this->Cell($titleCellWidth, 3, $this->mSubTitle, 0, 1, "C");

    // subtitle2
    $this->SetFont($this->mDefaultFont, "", 7);
    $this->SetXY($titleXPosition, $this->GetY());
    $this->Cell($titleCellWidth, 3, $this->mSubTitle2, 0, 1, "C");
  }


  /**
  * Create label cell 
  */
  function showLabelCell()
  {
    if (!count($this->mLabelArray))
      return false;

    $this->SetFont($this->mDefaultFont, "b", $this->mLabelFontSize);
    $this->SetXY(5.5, $this->GetY());

    $this->drawPdfLine();

    foreach ($this->mLabelArray AS $key => $value)
    {
      if (is_array($value))
      {
        $this->Cell($value["width"],
                    ($value["height"]?$value["height"]:4),
                    $value["label"],
                    ($value["border"]?$value["border"]:0),
                    0,
                    ($value["align"]?$value["align"]:"C"),
                    ($value["background"]?$value["background"]:0));
      }
      elseif ($value == "separator")
        $this->drawPdfLine();
      elseif ($value == "new_line")
        $this->SetXY(5.5, $this->GetY()+2);
    }

    $this->drawPdfLine();
  }


  /**
  * Draws a line and increments Y position
  * @param int $pWidth Line width 
  */
  function drawPdfLine($pWidth=0)
  {
    $this->Line(5, $this->GetY()+$this->mLineHeight, ($pWidth?$pWidth:$this->mPageWidth), $this->GetY()+$this->mLineHeight);
    $this->SetXY(5.5, $this->GetY()+$this->mLineHeight);
  }


  /**
  * Sets reports default font 
  * @param string $pDefaultFont Font name 
  */
  function setDefaultFont($pDefaultFont)
  {
    $this->mDefaultFont = $pDefaultFont;
  }

  function setDefaultFontSize($pDefaultFontSize)
  {
    $this->mDefaultFontSize = $pDefaultFontSize;
  }

  function setCategorizationFontSize($pCategorizationFontSize)
  {
    $this->mCategorizationFontSize = $pCategorizationFontSize;
  }

  function setTotalsFontSize($pTotalsFontSize)
  {
    $this->mTotalsFontSize = $pTotalsFontSize;
  }

  function setLabelFontSize($pLabelFontSize)
  {
    $this->mLabelFontSize = $pLabelFontSize;
  }

  /**
  * Sets reports' labels
  * @param array $pLabelArray Labels 
  */
  function setLabelArray($pLabelArray)
  {
    $this->mLabelArray = $pLabelArray;
  }


  /**
  * Sets reports' columns
  * @param array $pCellFieldsArray Result set columns names shown on report 
  */
  function setCellFieldsArray($pCellFieldsArray)
  {
    $this->mCellFieldsArray = $pCellFieldsArray;

    foreach ($this->mCellFieldsArray AS $key=>$value)
      $this->mTotalsLineMaxWidth += $value["width"];
  }


  /**
  * Sets reports' columns used to make total cells 
  * @param array $pTotalizationCellFieldsArray Result set columns names 
  */
  function setTotalizationCellFieldsArray($pTotalizationCellFieldsArray)
  {
    $this->mTotalizationCellFieldsArray = $pTotalizationCellFieldsArray;
  }


  /**
  * Sets reports' column used to paginate the report  
  * @param string $pPaginationField Result set column name 
  */
  function setPaginationField($pPaginationField)
  {
    $this->mPaginationField = $pPaginationField;
  }


  /**
  * Sets reports' columns used to make subtitle when adding a new page 
  * @param array $pPaginationLabelArray Result set columns names and separators 
  */
  function setPaginationLabelArray($pPaginationLabelArray)
  {
    $this->mPaginationLabelArray = $pPaginationLabelArray;
  }


  /**
  * Sets reports' columns used to make label when adding a new categorization cell
  * @param array $pCategorizationLabelArray Result set columns names and separators 
  */
  function setCategorizationLabelArray($pCategorizationLabelArray)
  {
    $this->mCategorizationLabelArray = $pCategorizationLabelArray;
  }


  /**
  * Sets reports' column used to categorize the report  
  * @param string $pCategorizationField Result set column name 
  */
  function setCategorizationField($pCategorizationField)
  {
    $this->mCategorizationField = $pCategorizationField;
  }


  /**
  * Sets wheter to show pagination total or not  
  * @param boolean $pShowPaginationTotal 
  */
  function setShowPaginationTotal($pShowPaginationTotal=false)
  {
    $this->mShowPaginationTotal = $pShowPaginationTotal;
  }


  /**
  * Sets wheter to show categorization total or not  
  * @param boolean $pShowCategorizationTotal 
  */
  function setShowCategorizationTotal($pShowCategorizationTotal=false)
  {
    $this->mShowCategorizationTotal = $pShowCategorizationTotal;
  }


  /**
  * Sets wheter to show total cell or not  
  * @param boolean $pShowTotal 
  */
  function setShowTotal($pShowTotal=false)
  {
    $this->mShowTotal = $pShowTotal;
  }


  // TODO
  function setUsePaginationAsCategorization($pUsePaginationAsCategorization)
  {
    $this->mUsePaginationAsCategorization = $pUsePaginationAsCategorization; 
  }


  /**
  * Sets colors for report cells   
  * @param boolean $pChangeReportCellBgColor Sets wheter to change cells bgcolor or not 
  * @param array   $pCellBgEven              Even cells rgb color 
  * @param array   $pCellBgOdd               Odd cells rgb color 
  */
  function setReportCellBgColor($pChangeReportCellBgColor, $pCellBgEven=array(), $pCellBgOdd=array())
  {
    if (count($pCellBgEven))
    {
      $this->mCellBgEvenR = $pCellBgEven[0];
      $this->mCellBgEvenG = $pCellBgEven[1];
      $this->mCellBgEvenB = $pCellBgEven[2];
    }

    if (count($pCellBgOdd))
    {
      $this->mCellBgOddR = $pCellBgOdd[0];
      $this->mCellBgOddG = $pCellBgOdd[1];
      $this->mCellBgOddB = $pCellBgOdd[2];
    }

    $this->mChangeReportCellBgColor = $pChangeReportCellBgColor;
  }


  /**
  * Sets colors for categorization cells   
  * @param boolean $pChangeCategorizationCellBgColor Sets wheter to change categorization cells bgcolor or not 
  * @param array   $pCategorizationCellBg            Cells rgb color 
  */
  function setChangeCategorizationCellBgColor($pChangeCategorizationCellBgColor, $pCategorizationCellBg=array())
  {
    if (count($pCategorizationCellBg))
    {
      $this->mCategorizationCellBgR = $pCategorizationCellBg[0];
      $this->mCategorizationCellBgG = $pCategorizationCellBg[1];
      $this->mCategorizationCellBgB = $pCategorizationCellBg[2];
    }

    $this->mChangeCategorizationCellBgColor = $pChangeCategorizationCellBgColor;
  }


  function changeReportCellBgColor($pCellPosition)
  {
    if (!($pCellPosition&1)) 
      $this->SetFillColor($this->mCellBgEvenR, $this->mCellBgEvenG, $this->mCellBgEvenB);
    else 
      $this->SetFillColor($this->mCellBgOddR, $this->mCellBgOddG, $this->mCellBgOddB);
  }


  function testNoAutoPageBreak()
  {
    if ($this->GetY() > $this->mPageHeight+$this->mLineHeight)
    {
      $this->createNewPage();
      $this->showLabelCell();
    }
  }


  function showTotalCell($pTotalArray, $pLineCount=0)
  {
    $idShown = 0;

    $this->SetX(5.5);
    $this->SetFont($this->mDefaultFont, "b", $this->mTotalsFontSize);

    foreach ($this->mCellFieldsArray AS $key=>$value)
    {
      if (!in_array($value["fieldName"], $this->mTotalizationCellFieldsArray))
      {
        $this->SetX($this->GetX() + $value["width"]);
      }
      else
      {
        if (!$idShown && $pLineCount)
        {
          $this->SetX($this->GetX() - 10);
          $this->Cell(10,
                      ($value["height"]?$value["height"]:$this->mLineHeight),
                      $pLineCount,  "T",  0,  "C",
                      ($value["background"]?$value["background"]:0));
        }

        $idShown++;

        $dsFieldValue = $pTotalArray[$value["fieldName"]];

        // callback
        if (is_array($value["callback"]))
        {
          $opCallbackParameters = (is_array($value["callback"][1]))
                            ? array_merge(array($dsFieldValue), $value["callback"][1])
                            : array($dsFieldValue);
          $dsFieldValue = call_user_func_array($value["callback"][0], $opCallbackParameters);
        }

        $this->Cell($value["width"],
                    ($value["height"]?$value["height"]:$this->mLineHeight),
                    $dsFieldValue,
                    ($value["totalBorder"]?$value["totalBorder"]:"T"),
                    ($value["break"]?$value["break"]:0),
                    ($value["align"]?$value["align"]:"C"),
                    ($value["background"]?$value["background"]:0));
      }
    }

    if ($idShown)
    {
      $this->SetXY(5.5, $this->GetY()+$this->mLineHeight);
      $this->testNoAutoPageBreak();
    }
  }


  function buildPdfReport($pSql)
  {
    if (!count($this->mCellFieldsArray))
      return false;

    $tmpPaginationField = "";

    $tmpCategorizationField = "";

    if (!($this->mResultSet = $this->mConn->Select($pSql)))
      exit($this->mConn->GetTextualError());
    elseif (!$this->mResultSet->GetRowCount())
      $this->showEmptyRSMessage();
    else
    {
      while (!$this->mResultSet->IsEof())
      {
        $flagShowPaginationTotal           = true;
        $flagShowCategorizationTotal       = true;
        $flagIsNewPage                     = true;


        // TODO - gambiarra 
        $flagShowSubtitleAsCategoriozation = false; 


        if (count($this->mPaginationLabelArray))
        {
          $tmpSubtitle = "";
          foreach ($this->mPaginationLabelArray AS $key=>$value)
          {
            $dsFieldValue = $this->mResultSet->GetField($value["fieldName"]);

            if (is_array($value["callback"]))
            {
              $opCallbackParameters = (is_array($value["callback"][1]))
                                ? array_merge(array($dsFieldValue), $value["callback"][1])
                                : array($dsFieldValue);
              $dsFieldValue = call_user_func_array($value["callback"][0], $opCallbackParameters);
            }

            $tmpSubtitle .= $dsFieldValue . (strlen($value["separator"])?$value["separator"]:"");
          }

          if (strlen($tmpSubtitle))
            $this->mSubTitle = $tmpSubtitle;
        } // if (count($this->mPaginationLabelArray))

        if (!$this->mResultSet->mIndex)
        {
          $this->createNewPage();
          $this->callExternalFunction($this->mBeginingExternalFunction);
          $this->showLabelCell();
          $flagIsNewPage = false;
        }

        if (strlen($this->mPaginationField) && $tmpPaginationField != $this->mResultSet->GetField($this->mPaginationField))
        {
          if ($this->mResultSet->mIndex && count($this->mTotalizationCellFieldsArray))
          {
            if (strlen($this->mCategorizationField) && $this->mShowCategorizationTotal)
            {
              // asd 
              $this->callExternalFunctionCurrentRS($this->mCategorizationExternalFunction);
              $this->showTotalCell($this->mCategorizationTotalArray, $this->mCountCategorizationLines);
              $this->mCountCategorizationLines = 0;
            }

            if ($this->mShowPaginationTotal)
            {
              $this->showTotalCell($this->mPaginationTotalArray, $this->mCountPaginationLines);

              $flagShowPaginationTotal     = false;
              $flagShowCategorizationTotal = false;
              $this->mCountPaginationLines  = 0;
            }
          }

          if ($flagIsNewPage) 
          {
            // TODO 
            if (!$this->mUsePaginationAsCategorization)
            {
              $this->createNewPage();
              $this->showLabelCell();
            }

            $flagIsNewPage = false;
          }

          // TODO 
          $flagShowSubtitleAsCategoriozation = true; 

          // asd 
          $this->callExternalFunctionCurrentRS($this->mPaginationExternalFunction);

          $tmpPaginationField     = $this->mResultSet->GetField($this->mPaginationField);
          $tmpCategorizationField = "";

          $this->mPaginationTotalArray     = array();
          $this->mCategorizationTotalArray = array();
        }


        // TODO - make this an array so we can use more then 1 categorization level  
        if (strlen($this->mCategorizationField) 
              && $tmpCategorizationField != $this->mResultSet->GetField($this->mCategorizationField))
        {
          if ($this->mResultSet->mIndex 
                && count($this->mTotalizationCellFieldsArray) 
                && $flagShowCategorizationTotal
                && $this->mShowCategorizationTotal)
          {
#$this->callExternalFunction($this->mCategorizationExternalFunction);
            $this->showTotalCell($this->mCategorizationTotalArray, $this->mCountCategorizationLines);
            $flagShowCategorizationTotal = false;
          }


          // **********************************
          // TODO - gambiarra
          if ($this->mSubTitle && $this->mUsePaginationAsCategorization && $flagShowSubtitleAsCategoriozation) 
          {
            if ($this->mChangeCategorizationCellBgColor)
            {
              $this->SetFillColor($this->mCategorizationCellBgR,
                                  $this->mCategorizationCellBgG,
                                  $this->mCategorizationCellBgB);
            }

            $this->SetFont($this->mDefaultFont, "b", $this->mCategorizationFontSize);

            $this->Cell($this->mTotalsLineMaxWidth, $this->mLineHeight, 
                          $this->mSubTitle, 
                        0, 0, "L", $this->mChangeCategorizationCellBgColor);
            $this->SetXY(5.5, $this->GetY()+$this->mLineHeight);
          }
          // **********************************


          if (count($this->mCategorizationLabelArray))
          {
            $label_categorizacao = "";
            foreach ($this->mCategorizationLabelArray AS $key=>$value)
            {
              $dsFieldValue = $this->mResultSet->GetField($value["fieldName"]);

              if (is_array($value["callback"]))
              {
                $opCallbackParameters = (is_array($value["callback"][1]))
                                  ? array_merge(array($dsFieldValue), $value["callback"][1])
                                  : array($dsFieldValue);
                $dsFieldValue = call_user_func_array($value["callback"][0], $opCallbackParameters);
              }

              $label_categorizacao .= $dsFieldValue . (strlen($value["separator"])?$value["separator"]:"");
            }
          } // if (count($this->mCategorizationLabelArray))

          if ($this->mChangeCategorizationCellBgColor)
          {
            $this->SetFillColor($this->mCategorizationCellBgR,
                                $this->mCategorizationCellBgG,
                                $this->mCategorizationCellBgB);
          }

          $this->SetFont($this->mDefaultFont, "b", $this->mCategorizationFontSize);

          $this->Cell($this->mTotalsLineMaxWidth, $this->mLineHeight, 
                        (strlen($label_categorizacao)?$label_categorizacao:$this->mResultSet->GetField($this->mCategorizationField)), 
                      0, 0, "L", $this->mChangeCategorizationCellBgColor);
          $this->SetXY(5.5, $this->GetY()+$this->mLineHeight);

          if ($flagIsNewPage)
            $this->testNoAutoPageBreak();

          // asd 
          $this->callExternalFunctionCurrentRS($this->mCategorizationExternalFunction);

          $tmpCategorizationField = $this->mResultSet->GetField($this->mCategorizationField);

          $this->mCountCategorizationLines = 0;

          $this->mCategorizationTotalArray = array();
        }

        if ($flagIsNewPage)
          $this->testNoAutoPageBreak();

        foreach ($this->mCellFieldsArray AS $key=>$value)
        {
          $dsFieldValue = "";

          // TODO 
          $this->mBold = "";

          $arrSplitFields = explode("|", $value["fieldName"]);
          if (is_array($arrSplitFields))
          {
            $arrSplitFields_aux = array();
            foreach ($arrSplitFields AS $vlSplitedField)
              $arrSplitFields_aux[] = $this->mResultSet->GetField(trim($vlSplitedField));
            $dsFieldValue = implode((($value["separator"])?$value["separator"]:" / "), $arrSplitFields_aux);
          }
          else
            $dsFieldValue = $this->mResultSet->GetField($value["fieldName"]);


          if (is_array($value["callback"]))
          {
            $opCallbackParameters = (is_array($value["callback"][1]))
                              ? array_merge(array($dsFieldValue), $value["callback"][1])
                              : array($dsFieldValue);
            $dsFieldValue = call_user_func_array($value["callback"][0], $opCallbackParameters);
          }

          if ($this->mChangeReportCellBgColor)
            $this->changeReportCellBgColor($this->mResultSet->mIndex);

          while ($this->GetStringWidth($dsFieldValue) > $value["width"]-1)
            $dsFieldValue = substr($dsFieldValue, 0, -1);

          $this->SetFont($this->mDefaultFont, $this->mBold, $this->mDefaultFontSize);

          $this->Cell($value["width"],
                      ($value["height"]?$value["height"]:$this->mLineHeight),
                      $dsFieldValue,
                      ($value["border"]?$value["border"]:0),
                      ($value["break"]?$value["break"]:0),
                      ($value["align"]?$value["align"]:"C"),
                      ($this->mChangeReportCellBgColor ? $this->mChangeReportCellBgColor : $value["background"]));
        }
        $this->SetXY(5.5, $this->GetY()+$this->mLineHeight);

        if (count($this->mTotalizationCellFieldsArray))
        {
          foreach ($this->mTotalizationCellFieldsArray AS $idxTotalArray)
          {
            $this->mTotalArray[$idxTotalArray]               += $this->mResultSet->GetField($idxTotalArray);
            $this->mPaginationTotalArray[$idxTotalArray]     += $this->mResultSet->GetField($idxTotalArray);
            $this->mCategorizationTotalArray[$idxTotalArray] += $this->mResultSet->GetField($idxTotalArray);
          }
        }

        $this->mCountCategorizationLines++;
        $this->mCountPaginationLines++;

        $this->mLastResultSetRow = $this->mResultSet;

        $this->mResultSet->Next();
      } // while (!$this->mResultSet->IsEof()) 

#$this->callExternalFunction($this->mCategorizationExternalFunction);

      if ( $this->mShowCategorizationTotal 
            && count($this->mTotalizationCellFieldsArray)
            && strlen($this->mCategorizationField) 
            && ($this->mCountCategorizationLines || $flagShowCategorizationTotal) )
        $this->showTotalCell($this->mCategorizationTotalArray, $this->mCountCategorizationLines);


#$this->callExternalFunctionCurrentRS($this->mPaginationExternalFunction);

      if ( $this->mShowPaginationTotal
            && count($this->mTotalizationCellFieldsArray)
            && $flagShowPaginationTotal 
            && strlen($this->mPaginationField))
        $this->showTotalCell($this->mPaginationTotalArray, $this->mCountPaginationLines);

      if ($this->mShowTotal && count($this->mTotalizationCellFieldsArray))
        $this->showTotalCell($this->mTotalArray, $this->mResultSet->GetRowCount());

      $this->callExternalFunction($this->mFooterExternalFunction);

    } // else if (!$this->mResultSet->GetRowCount())
  }

}

?>
