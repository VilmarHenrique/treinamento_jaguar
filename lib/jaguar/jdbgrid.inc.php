<?php
/*
Jaguar - A PHP framework for IT systems development
Copyright (C) 2003  Atua Sistemas de Informa��o Ltda.

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

You can contact Atua Sistemas de Informa��o Ltda by the e-mail jaguar@atua.com.br, or
885 XV de Novembro street, Passo Fundo, RS 99010-100 Brazil

Atua Sistemas de Informa��o Ltda., hereby disclaims all copyright interest in
the library 'Jaguar' (A PHP framework for IT systems development) written
by it's development team.

D�cio Mazzutti, 22 October 2003
*/

/*
 * creation -  - 
 *
 * 2003-03-28 - al_nunes
 *  autenticacao de poplists e grids
 *
 * 2003-03-28 - pedro
 *  modifica��o no filtro do grid, adicionada a possibilidade de uso do operador OR
 *  possibilidade de mais de um campo por linha no filtro
 * 
 * 2003-04-15 - pedro
 *  altera��o no filtro do grid (formata��o de campos data)
 *  altera��o de nomes de m�todos do Grid (SetAlign => SetColumnAlign)
 *
 * 2003-06-26 - pedro
 *  implementa��o de jun��o no sql do grid
 *
 * 2003-08-14 - decio
 *  criado a fun��o SetShowBeginning(), permitindo que que o grid n�o seja submetido automaticamente qdo carregado
 * 2003-11-11 - al_nunes
 *  alterado o codigo para permitir que um grid simples (sem filtros nem paginador) 
 *  seja criado o SQL caso seja passado como string
 *
 * 2004-03-17 - fabio
 *  adicionado as seguintes linhas no metodo ExecuteSQL() para tornar compativel os demais bancos. 
 *    if ( (strtolower($operator) == 'like') || (strtolower($operator) == 'ilike') )
 *      $value = '%'.$value.'%';
 *
 */

/**
* Database grids selection class
*
* @author  Atua Sistemas de Informa��o
* @package Jaguar
*/
Class JDBGrid extends JTable
{
  /**
  * Stores fields that don't come from the query - Associative Array
  * @var array
  */
  var $mExtraFields         = false;

  /**
  * Stores the record set used in the grid's construction
  * @var object
  */
  var $mRs                  = false;

  /**
  * Controls if the link for a specific column has an interrogation symbol
  * @var array
  */
  var $mHasLinkInterrogation;

  /**
  * Controls if a specific column has link
  * @var array
  */
  var $mHasLink;

  /**
  * Stores the link for a specific column
  * @var array
  */
  var $mLink;

  /**
  * Stores the target for a link in a specific column
  * @var array
  */
  var $mTarget;

  /**
  * Stores the callback function for a specific column
  * @var array
  */
  var $mCallback;

  /**
  * Stores the callback params for a specific column
  * @var array
  */
  var $mCallbackParams;

  /**
  * Controls if a column is associated to a javascript's onClick event
  * @var array
  */
  var $mHasOnClick;

  /**
  * Stores the name of the javascript's onClick function associated to that column
  * @var array
  */
  var $mFunc;

  /**
  * Stores the record set fields that will be used on the JS function
  * @var array
  */
  var $mOnClickFields;

  /**
  * Stores the columns alignment
  * @var array
  */
  var $mColumnAlign;

  /**
  * Stores the number of pages in the grid
  * @var int
  */
  var $mNumPages;
  
  /**
  * Stores the number of records from this grid
  * @var int
  */
  var $mNumRecords;

  /**
  * Stores the sum of the valuable records from this grid
  * @var float
  */
  var $mSumRecords = null;

  /**
  * Stores the grid filtering fields
  * @var array
  */
  var $mFilters;

  /**
  * Stores the filter grid separators
  * @var array
  */
  var $mSeparators = array();

  /**
  * Stores the grids filtering fields properties
  * @var array
  */
  var $mFiltersProperties;

  /**
  * Controls if an outer join has been usen in the query
  * @var boolean
  */
  var $mUseJoin             = false;

  /**
  * Stores the tables used in joins made by a grid filter
  * @var array
  */
  var $mJoinTables;

  /**
  * Stores the fields used in joins made by a grid filter
  * $var array
  */
  var $mJoinFields;

  /**
  * Stores the JDBConnection object
  * @var object
  */
  var $mConn;
  
  /**
  * Stores the fracionated string that will build the grid
  * @var string
  */
  var $mSql;

  /**
  * Controls whether the navigation table will be shown or not
  * @var boolean
  */
  var $mShowNavigationTable = true;

  /**
  * Stores the actual page number
  * @var int
  */
  var $mPage                = 1;

  /**
  * Stores the string of the previous page link
  * @var string
  */
  var $mBackButton          = "<";

  /**
  * Stores the string of the next page link
  * @var string
  */
  var $mForwardButton       = ">";

  /**
  * Stores the string of the fisrt page link
  * @var string
  */
  var $mFirstButton         = "<<";

  /**
  * Stores the string of the last page link
  * @var string
  */
  var $mLastButton          = ">>";

  /**
  * Controls the navigation table's position
  * @var string
  */
  var $mNavigationPosition  = "top";
 
  /**
  * Stores the grid name
  * @var string
  */
  var $mGridName;  

  /**
  * Controls if any error occurred during the SQL execution
  * @var boolean
  */
  var $mError               = false;  

  /**
  * Stores the query's LIMIT
  * @var int
  */
  var $mLimit               = 10;  

  /**
  * Stores configuration vars to the limit chooser combo
  * @var array
  */
  var $mLimitConfiguration  = array('increment' => 10, 'max' => 500);  

  /**
  * Stores the query's OFFSET statement
  * @var int
  */
  var $mOffset              = 0;

  /**
  * Stores the page's interval
  * @var int
  */
  var $mInterval            = 3;

  /**
  * Stores the location for grid links (usually PHP_SELF)
  * @var string
  */
  var $mLocation;

  /**
  * Controls if ordenation links might be shown or not
  * @var boolean
  */
  var $mShowLinks           = true;

  /**
  * Stores the submit button
  * @var object A JFormSubmit button
  */
  var $mSubmit;

  /**
  * Stores the reset button
  * @var object A JFormReset button

  */
  var $mReset;

  /**
  * Stores the filter form
  * @var object A JForm object
  */
  var $mFilterForm;  

  /**
  * Stores the navigation table's object
  * @var object A JTable object
  */
  var $mNavigationTable;  

  /**
  * Stores the filter table's (JTable) object
  * @var object A JTable object
  */
  var $mFilterTable;  

  /**
  * Stores the status table's object
  * @var object A JTable object
  */
  var $mStatusTable;
          

  /**
  * Controls if the records wil be shown without any filter applyed to them
  * @var boolean
  */
  var $mShowBeginning         = true;

  /**
	 * Controls if the option to generate data in Xls format shall be displayed
	 * @var boolean
	 */ 
  var $mShowXls = false;

  /**
  * Stores the tips' style
  * @var array
  */
  var $mTipStyle = "\"#000077\",\"#CECEFF\",\"\",\"\",\"cursive\",2,\"#000000\",\"#F0F0F0\",\"\",\"\",\"cursive\",2,,,2,\"#FFFFFF\",2,,,,,\"\",,,,";

  /**
  * Sets whether the specified fields will show the total
  * @var array
  */
  var $mShowTotal             = array();

  /**
  * Sets whether status bar might be shown
  * @var bool
  */
  var $mShowStatus = true;

  /**
  * Sets whether status bar might be shown
  * @var bool
  */
  var $mUseDatePickerToGrid = false;

  /**
   * Grid's title
   * @var text
   */
  var $title = null;

  /**
   * Sets whether if show grid with empty records
   * @var bool
   */
  var $mShowEmptyGrid = true;

  /**
  * Constructor - Receives the address of the record set
  * @param string $name The grid name, usually the main table's name
  * @param object $conn A JDBConnection object
  * @param mixed  $sql  String or associative array.
  * An associative array containig query parts. Eg.: array ("select" => "cd_country, nm_contry", "from" => "country", "order" => "nm_country"), or a string containing the full SQL. Eg.: "SELECT * FROM city"
  *
  * If the $sql parameter is a string, the grid won't have page control neither filters
  */
  function __construct($name, &$conn, $sql, $title = null)
  {
    parent::__construct();

    $this->SetGridName($name);
    $this->SetConn($conn);
    $this->SetSql($sql);
    $this->SetShowBeginning();
    $this->SetLocation();
    $this->mTitle = $title;

		$this->SetShowXls(true);
    $this->mFilterForm = new JForm("filter_".$this->mGridName);
    $this->UseDatePicker();
    $this->mFilterForm->SetLineStyles("rowodd_filter", "roweven_filter", "rowodd_filter", "roweven_filter");
    $this->SetLimit();
    
    $this->AddJSFile( URL ."js/main15.js" );
  }
  
  /**
  * Adds a filter field
  * @param string   $field         The name of the database field that will be filtered
  * @param string   $description   A label that will identify the field
  * @param string   $type          The filter field type. { text | number | date | select | cep | fone | cpf | cnpj | pis | modulo11 }
  * @param string   $operator      The operator in the where clause
  * @param string   $objectName    The name of the object that will be instanciated to this filter field
  * @param array    $selectOptions The options used if this filter type is "select"
  * @param boolean  $open          Controls if the filter might open an new row in the filter table
  * @param array    $options       Associative array that holds options for this filter cell
  * @param array    $moreFields    If the filter involves an outer join, this field must be an associative array with the filtered fields
  * @param boolean  $join          Controls if the filter involves an outer join
  */
  function AddFilterField($field, $description, $type, $operator, $objectName = false, 
                          $selectOptions = false, $open = true, $options = false, 
                          $moreFields = false, $join = false, $callback = false,
                          $tipOnTitle = false)
  {
    if (!$objectName)
      $name = $field;
    else
      $name = $objectName;
    
    //jun��o
    if ($join)
      $this->mUseJoin = true;
    
    //registra as vari�veis de sess�o
    $campoFiltro = $this->mGridName."_".$name;

    if (isset($_REQUEST["f_$campoFiltro"]))
      $_SESSION["s_$campoFiltro"] = $_REQUEST["f_$campoFiltro"];

    if (is_array($_SESSION["s_objects"]))
    {
      if (!in_array("f_".$this->mGridName."_".$name, $_SESSION["s_objects"]))
        $_SESSION["s_objects"][] = "f_".$this->mGridName."_".$name;

      if (!in_array("f_filter_".$this->mGridName."_submitted", $_SESSION["s_objects"]))
        $_SESSION["s_objects"][] = "f_filter_".$this->mGridName."_submitted";
    }
    else
    {
      $_SESSION["s_objects"][] = "f_submit_filter";
      $_SESSION["s_objects"][] = "f_reset_filter";
      $_SESSION["s_objects"][] = "f_".$this->mGridName."_".$name;
    }

    switch ($type)
    {
      case "time":
        $$name = new JFormTime("f_".$this->mGridName."_".$name);
      break;

      case "text":
        $$name = new JFormText("f_".$this->mGridName."_".$name);
      break;
      
      case "number":
        $$name = new JFormNumber("f_".$this->mGridName."_".$name);
      break;

      case "date":
        $$name = new JFormDate("f_".$this->mGridName."_".$name);
      break;
      
      case "select":
        $$name = new JFormSelect("f_".$this->mGridName."_".$name);
        $$name->SetOptions($selectOptions);
      break;

      case "cep":
        $$name = new JFormCep("f_".$this->mGridName."_".$name);
      break;

      case "fone":
        $$name = new JFormFone("f_".$this->mGridName."_".$name);
      break;

      case "cnpj":
        $$name = new JFormCnpj("f_".$this->mGridName."_".$name);
        $$name->SetCadastreExibition(false);
      break;

      case "cpf":
        $$name = new JFormCpf("f_".$this->mGridName."_".$name);
        $$name->SetCadastreExibition(false);
      break;

      case "pis":
        $$name = new JFormPis("f_".$this->mGridName."_".$name);
      break;

      case "modulo11":
        $$name = new JFormModulo11("f_".$this->mGridName."_".$name);
      break;
      
      case "nit":
        $$name = new JFormNit("f_".$this->mGridName."_".$name);
        $$name->SetCadastreExibition(false);
      break;
      
      default:
        $$name = new $type("f_".$this->mGridName."_".$name);

    }

    if (str_value($tipOnTitle))
    {
      $$name->SetExtra("title=\"$tipOnTitle\"");
      // $this->mFilterForm->AddHtml("<script> $(function() { $( document ).tooltip(); }); </script>");
    }

    $this->mFilters[$name] = array("object"      => $$name,
                                   "field"       => $field,
                                   "description" => $description,
                                   "type"        => $type,
                                   "operator"    => $operator,
                                   "open"        => $open,
                                   "options"     => $options,
                                   "more_fields" => $moreFields,
                                   "join"        => $join, 
                                   "callback"    => $callback);
  }
 
  function AddFilterSeparator($description, $options = false)
  {
    if (!is_array($this->mFilters))
      $i = "";
    else
    {
      end($this->mFilters);
      $i = key($this->mFilters);
    }

    $this->mSeparators["$i"][] = array("description" => $description,
                                       "options"     => $options);
  }

  /**
  * Sets properties for filter fields
  * @param string $filter Field name
  * @param array  $arr    Associative array containing the filter properties. Keys: { value | size | disable | maxlength }
  */
  function SetFilterProperties($filter, $arr)
  {
    $this->mFiltersProperties[$filter] = ($arr)?$arr:array();
  }

  /**
   * @param array $arr
   * @param array $filters
   */
  public function SetFiltersProperties(array $arr, array $filters)
  {
    foreach ($filters as $filter)
    {
      $filterObj = $this->mFilters[$filter]["object"];

      if (!$filterObj instanceof JFormObject)
        throw new Exception("Filtro '{$filter}' n�o encontrado nesta listagem!");

      foreach ($arr as $method => $params)
        call_user_func_array(array($filterObj, $method), is_array($params) ? $params : array($params));
    }
  }
  
  /**
  * Sets the tables joined by a filter
  *
  * In some cases, it might be necessary join tables according to the users selection in filter fileds.
  * As an example, we have a people table that holds all data common to people, and two tables that
  * specializes this first, client and investor. In a people listing, everyone should be listed, 
  * but in some cases you may want to see only the people who are clients, or the people who are investors.
  * In this cases you must use SetJoinTables and SetJoinFields.
  *
  * @param array $array A associative array containing the tables that might be involved in a join.
  * <br>Eg.: array("client"   => array("alias" => "c", "field" => "c.cd_people"),<br>
  *                "investor" => array("alias" => "i", "field" => "i.cd_people"))
  */
  function SetJoinTables($array = false)
  {
    $this->mJoinTables = $array;
  }
  
  /**
  * Sets the fields of the tabled involved by a join caused by a filter field
  *
  * In some cases, it might be necessary join tables according to the users selection in filter fileds.
  * As an example, we have a people table that holds all data common to people, and two tables that
  * specializes this first, client and investor. In a people listing, everyone should be listed, 
  * but in some cases you may want to see only the people who are clients, or the people who are investors.
  * In this cases you must use SetJoinTables and SetJoinFields.
  *
  * @param string $objectName  Name of the filter object that might couse the join 
  * @param string $commonField Name of the parent table that will be involved in the join
  */
  function SetJoinFields($objectName, $commonField)
  {
    $this->mJoinFields["object_name"]  = $objectName;
    $this->mJoinFields["common_field"] = $commonField;
  }
  
  /**
  * Sets the ordenation links visualization
  * @param boolean $show
  */
  function SetShowLinks($show = true)
  {
    $this->mShowLinks = $show;
  }

  /**
  * Sets the location for the navigation table's links
  * @param string $location
  */
  function SetLocation($location = false)
  {
    $this->mLocation = ($location)?$location:$_SERVER["PHP_SELF"];
  }

  /**
  * Sets the grids name
  * @param string $name Usually the main's table name
  */
  function SetGridName($name)
  {
    // there are parameters which are passed through GET that are based in the grid name, and in case of 
    // the name contain a dot character, the PHP is unable by some reason to retrieve its value...
    //
    $this->mGridName = str_replace(".", "", $name);
  }

  /**
  * Sets the database connection
  * @param object $conn A JDBConnection object
  */
  function SetConn($conn)
  {
    $this->mConn = $conn;
  }
  
  /**
  * Sets the partitioned SQL statement
  * @param array $sql A associative array containing the query clauses. Keys: [ fields | count | from | where | order | groupby ]
  */
  function SetSql(&$sql)
  {
    $this->mSql = &$sql;
  }

  /**
  * Sets if the record must be shown in the first time the grid is opened
  * @param boolean $show
  */
  function SetShowBeginning($show = true)
  {
    if (is_bool($show))
      $this->mShowBeginning = $show;
    else
      $this->mShowBeginning = false;
	}

  /**
	  * Controls if the option to generate data in Xls format shall be displayed
		* @param boolean $show
	  */
  function SetShowXls($show = true)
	{
		if (is_bool($show))
			$this->mShowXls = $show;
		else
			$this->mShowXls = false;
	}
                  
  /**
  * Sets the SQL limit
  * @param int $limit
  */
  function SetLimit($limit=false)
  {
    $getOrPost = $_POST['f_limit'] ? $_POST['f_limit'] : $_GET['f_limit'];
    if ($getOrPost)
      $this->mLimit = $getOrPost;
    else
      if ($limit)
        $this->mLimit = $limit;
      else
        $this->mLimit = $this->mLimit;
  }

  /**
  * Sets that the total will be shown about certain fields
    The fields must first be visible fields or won't be shown
  * @param   array $fieldNames
  */
  function SetShowTotal($fieldNames)
  {
    if (is_array($fieldNames))
      $this->mShowTotal = $fieldNames;
  }

  /**
  * Sets the previous page link's text
  * @param string $back The previous page link's text
  */ 
  function SetBackButton($back)
  {
    $this->mBackButton = $back;
  }

  /**
  * Sets the next page link's text
  * @param string $forward The next page link's text
  */ 
  function SetForwardButton($forward)
  {
    $this->mForwardButton = $forward;
  }

  /**
  * Sets the first page link's text
  * @param string $first The first page link's text
  */
  function SetFirstButton($first)
  {
    $this->mFirstButton = $first;
  }

  /**
  * Sets the last page link's text
  * @param string $last The last page link's text
  */
  function SetLastButton($last)
  {
    $this->mLastButton = $last;
  }

  /**
  * Sets the next and previous pages links' text
  * @param string $forward Next page link's text
  * @param string $back    Previous page link's text
  */ 
  function SetForwardBackButtons($forward, $back)
  {
    $this->SetForwardButton($forward);
    $this->SetBackButton($back);
  }
  
  /**
  * Sets how many pages will be shown in the navigation tab 
  *
  * Eg.: If you are seeing the third page of the grid and the interval is set to 2, you will have the option to move for pages 1, 2, 4, 5. In other words, two pages ahead and two pages backwards
  * @param int $interval The number of pages ahead and backwards the actual page that will be shown uin the navigation table
  */ 
  function SetInterval($interval)
  {
    $this->mInterval = $interval;
  }

  /**
  * Inserts values in the messages associative array. This array contains all the messages used in the grid.
  * @param string  $messageName Message name
  * @param int     $messageText Message content
  */ 
  function SetMessage($messageName, $messageText)
  {
    $this->mMessages[$messageName] = $messageText;
  }

  /**
  * Sets the default messages
  */
  function SetDefaultMessages()
  {
    parent::SetDefaultMessages();
    $this->SetMessage("RecordsFounds", "registros encontrados.");
    $this->SetMessage("permission_denied", "<font color=\"red\"><b>Permiss�o Negada!</b></font>");
    $this->SetMessage("ListingFor", "Listando de");
    $this->SetMessage("To", "�");
    $this->SetMessage("For", "de");
    $this->SetMessage("NoRecords", "0 registro(s) encontrado(s).");
  }
  
  /**
  * Sets link columns in the grid and its properties
  * @param int     $col    The column index in the record set (starting in 0)
  * @param string  $link   Location wich this link points to. Eg.: sel_country.php
  * @param string  $target The frame target (if used)
  */
  function SetLink($col, $link = false, $target = false)
  {
    $this->mHasLinkInterrogation[$col] = (strstr($link, "?"))?true:false;
    $this->mHasLink[$col]              = true;
    $this->mLink[$col]                 = $link;
    $this->mTarget[$col]               = $target;
  }

  /**
  * Sets callback functions associated to a column and its params
  * @param int     $col    The column index in the record set (starting in 0)
  * @param string  $link   Location wich this link points to. Eg.: sel_country.php
  * @param string  $target The frame target (if used)
  */
  function SetCallback($col, $callback, $params = false)
  {
    $this->mCallback[$col][]       = $callback;
    $this->mCallbackParams[$col][] = (is_array($params))?$params:array();
  }

  /**
  * Sets the record set columns associated to a link in a grid column
  * @param int     $col   The column index in the record set (starting in 0)
  * @param array   $array Associative array containing the name of the bind variable as key and the field name in the recorset as value
  */
  function SetLinkFields ($col, $array = false)
  {
    $this->mHasLink[$col]    = true;
    $this->mLinkFields[$col] = $array;
  }

  /**
  * Sets the fixed values associated to a link in a grid column
  * @param int     $col   The column index in the record set (starting in 0)
  * @param array   $array Associative array containing the name of the bind variable as key and a fixed value as value
  */
  function SetExtraLinkFields($col, $array = false)
  {
    $this->mHasLink[$col]         = true;
    $this->mExtraLinkFields[$col] = $array;
  }

  /**
  * Sets the name of the function called in the onClick event
  * @param int     $col  Index to the column in the record set (Starting in 0)
  * @param string  $func Function name
  */
  function SetOnClick($col, $func = false)
  {
    $this->mHasOnClick[$col] = true;
    $this->mFunc[$col]       = $func;
  }

  /**
  * Sets the fields array used in the onClick event/function
  * @param int    $col      Index to the column in the record set (Starting in 0)
  * @param array  $arr_db   Array containig the name of the columns in the database that will be used in the onClick function. Eg.: array("cd_country", "nm_country")
  * @param array  $arr_stat Associative array containing static values that will be used on the onClick function. Ex.: array("location" => 1)
  */
  function SetOnClickFields($col, $arr_db = false, $arr_stat = false)
  {
    $this->mOnClickFields[$col]["db"]   = $arr_db;
    $this->mOnClickFields[$col]["stat"] = $arr_stat;
  }

  /**
  * Sets the visible fields array
  *
  * Only the fields in this array will be shown in the grid. Some fields might be in the query an not be shown.
  * @param array   $array Associative array containing the field name in the query as keys and its labels in the grid as values. Ex.: array("nm_country" => "Country")
  */
  function SetVisibleFields($array = false)
  {
    $this->mVisibles = &$array;
  }

  /**
  * Sets the extra fields array
  *
  * The extra fileds array contains static values that are usually inserted to be used like links
  * @param array $array Associative array containing the extra field as key and its value as value. Ex.: array(" " => "Properties")
  */
  function AddExtraFields($array = false)
  {
    $this->mExtraFields = &$array;
  }

  /**
  * Sets a grid column alignment
  * @param int    $column Column index in the record set (starting in 0).
  * @param string $align  Desired alignment. { eft | center | right}
  */
  function SetColumnAlign($column, $align)
  {
    $this->mColumnAlign[$column] = $align;
  }

  /**
  * Sets the position of the navigation buttons (above or under the grid)
  * @param string $navigationPosition Position { top | bottom }
  */ 
  function SetNavigationPosition($position = "top")
  {
    if (!$position && is_bool($position))
      $this->mShowNavigationTable = $position;
    else
    {
      $this->mShowNavigationTable = true;
      switch ($position)
      {
        case "top":
        case "bottom":
          $this->mNavigationPosition = $position;
        break;
        default:
          $this->mNavigationPosition = "top";
        break;
      }
    }
  }

  /**
  * Sets the object's tip
  * @param string $name  Field's name Object's name
  */
  function SetTip($title, $tip, $twidth = "", $theight = "")
  {
    $this->mTip["title"] = $title;
    $this->mTip["tip"]   = $tip;
    $this->mTip["twidth"] = $twidth;
    $this->mTip["theight"]= $theight;
  }

  /**
  * Internal funtion, used in the grid's construction. Executes the SQL statement assigned for the grid
  */ 
  function ExecuteSql()
  {
    $order = "f_order_".$this->mGridName;
    $page  = "f_page_".$this->mGridName;
    global $$order, $$page;

    if (gettype($this->mSql) == "array")
    {
    
      //grid page
      if (!isset($$page))
        $$page = $this->mPage;

      //limit
      if (!$this->mShowNavigationTable)
        $this->mLimit = 0;

      //offset
      $this->mOffset = $this->mLimit * ($$page - 1);

      //sql
      $sql = $this->mSql["with"]." SELECT ".$this->mSql["fields"]." FROM ".$this->mSql["from"];

      //sql_count
      if ($this->mShowNavigationTable)
      {
        if ($this->mSql["count"] === '' || $this->mSql["count"] === null)
          $this->mSql["count"] = "COUNT(*)";
        else
          $this->mSql["count"] = "COUNT(". $this->mSql["count"].")";
      }

      //sql_sum
      $this->mSql["sum"] = "";
      $tmp_index = 0;
      foreach($this->mShowTotal as $index => $sumField)
      {
        if ($tmp_index != 0)
          $this->mSql["sum"] .= ", ";

        if (!is_numeric($index))
          $this->mSql["sum"] .= " SUM(".$sumField.") as ".$index;
        else
        {
          if (strpos($sumField, ".") !== false)
            $tSumField = substr($sumField, strpos($sumField, ".") + 1);
          else
            $tSumField = $sumField;
          
          $this->mSql["sum"] .= " SUM(".$sumField.") as ".$tSumField;
        }
        
        $tmp_index++;
      }
      unset($tmp_index);

      $sqlSum     = $this->mSql["with"]." SELECT ".$this->mSql["sum"]." FROM ".$this->mSql["from"];
      $sql_count  = $this->mSql["with"]." SELECT ".$this->mSql["count"]." FROM ".$this->mSql["from"];
    
      //join
      if ($this->mUseJoin)
      {
        $field  = $this->mJoinFields["object_name"];
        $object = $this->mFilters[$field]["object"];

        if ($this->mFilterForm->IsSubmitted())
          $value = $object->GetValue(true);
        else
        {
          $arr = $this->mFiltersProperties[$field];
  
          if (isset($_SESSION["s_".$this->mGridName."_".$field]))
          {
            if (strlen($_SESSION["s_".$this->mGridName."_".$field]) > 0)
              $value = $_SESSION["s_".$this->mGridName."_".$field];
            else
            {
              if ($_REQUEST["f_popup"])
                $value = $arr["value"];
            }
          }
          else
            $value = $arr["value"];
        }

        if (strlen($value) > 0)
        {
          $sql       .= ", ".$value." ".$this->mJoinTables[$value]["alias"];
          $sql_count .= ", ".$value." ".$this->mJoinTables[$value]["alias"];
        }
      }
    
      //where
      if ($this->mSql["where"] != '')
      {
        $sql       .= " WHERE ".$this->mSql["where"];
        $sql_count .= " WHERE ".$this->mSql["where"];
        $sqlSum    .= " WHERE ".$this->mSql["where"];
        $sql_operator = " AND ";
      }
      else
        $sql_operator = " WHERE ";

      //join
      if ($this->mUseJoin)
      {
        if ($value != '')
        {
          $sql       .= $sql_operator." ".$this->mJoinFields["common_field"]." = ".
                        $this->mJoinTables[$value]["field"];
          $sql_count .= $sql_operator." ".$this->mJoinFields["common_field"]." = ".
                        $this->mJoinTables[$value]["field"];

          $sqlSum    .=  $sql_operator." ".$this->mJoinFields["common_field"]." = ".
                         $this->mJoinTables[$value]["field"];
          $sql_operator = " AND ";
        }
      }
    
      //filter
      if (is_array($this->mFilters))
      {
        reset($this->mFilters);
        do
        {
          unset($value);
          
          $name     = key($this->mFilters);
          $field    = $this->mFilters[key($this->mFilters)]["field"];
          $object   = &$this->mFilters[key($this->mFilters)]["object"];
          $operator = $this->mFilters[key($this->mFilters)]["operator"];
          $join     = $this->mFilters[key($this->mFilters)]["join"];


          if ($this->mFilterForm->IsSubmitted())
          {
            if ($this->mFilters[key($this->mFilters)]["callback"])
            {
              if (!is_array($this->mFilters[key($this->mFilters)]["callback"]))
                $this->mFilters[key($this->mFilters)]["callback"] = array($this->mFilters[key($this->mFilters)]["callback"], array());

              $opCallbackParameters = array_merge(array($object->GetValue(true)), $this->mFilters[key($this->mFilters)]["callback"][1]);
              $value = call_user_func_array($this->mFilters[key($this->mFilters)]["callback"][0], $opCallbackParameters);
            }
            else
              $value = $object->GetValue(true);
          }
          else
          {
            $arr = $this->mFiltersProperties[$name];
            if (isset($_SESSION["s_" . $this->mGridName . "_" . $name]))
            {
              if (strlen($_SESSION["s_" . $this->mGridName . "_" . $name]) > 0)
                $value = $_SESSION["s_" . $this->mGridName . "_" . $name];
              else
              {
                if ($_REQUEST["f_popup"])
                  $value = $arr["value"];
              }
            }
            else
              $value = $object->GetValue(true);

            if ($this->mFilters[key($this->mFilters)]["callback"])
            {
              if (!is_array($this->mFilters[key($this->mFilters)]["callback"]))
                $this->mFilters[key($this->mFilters)]["callback"] = array($this->mFilters[key($this->mFilters)]["callback"], array());

              $opCallbackParameters = array_merge(array($value), $this->mFilters[key($this->mFilters)]["callback"][1]);
              $value = call_user_func_array($this->mFilters[key($this->mFilters)]["callback"][0], $opCallbackParameters);
            }
          }//else - if ($this->mFilterForm->IsSubmitted())

          //Ajuste realizado para filtros Date em campos Timestamp, quando feito CAST em um TIMESTAMP o banco n�o utiliza
          //o index criado nesse campo, com esse ajuste, na hora de filtrar, filtrar� utilizando o index do campo timestamp
          if (strpos($field, "::DATE")             !== false       &&
            strpos(strtolower($field), "substr") === false       &&
            get_class($object)                    == "JFormDate" &&
            in_array($operator, array(">=", "<="))               &&
            $value)
          {
            $value .= $operator == ">=" ? " 00:00:00" : " 23:59:59.999999";
            $field = str_replace("::DATE", "", $field);
          }

          //atualiza os valores dos campos do filtro
          if ($this->mFilterForm->IsSubmitted())
            $_SESSION["s_" . $this->mGridName . "_" . $name] = $object->GetValue(true);
          else
          {
            if (!$object->GetValue(true))
            {
              if (isset($_SESSION["s_" . $this->mGridName . "_" . $name]))
                $object->SetValue($_SESSION["s_" . $this->mGridName . "_" . $name]);
              else
                $object->SetValue($value);
            }
          }

          if (strlen($value) > 0 && !$join)
          {
            if ( (strtolower($operator) == 'like') || (strtolower($operator) == 'ilike') )
              $value = '%' . $value . '%';

            //more fields
            if ($this->mFilters[key($this->mFilters)]["more_fields"])
            {
              $more_fields = $this->mFilters[key($this->mFilters)]["more_fields"];
              
              if (!is_array($more_fields))
                $more_fields = array($more_fields);
            
              $sql       .= $sql_operator . "(" . $field . " " . $operator . " " . $this->mConn->mDriver->QuoteValue($value);
              $sql_count .= $sql_operator . "(" . $field . " " . $operator . " " . $this->mConn->mDriver->QuoteValue($value);
              $sqlSum    .= $sql_operator . "(" . $field . " " . $operator . " " . $this->mConn->mDriver->QuoteValue($value);
            
              for ($i = 0; $i < sizeof($more_fields); $i++)
              {
                $sql       .= " OR " . $more_fields[$i] . " " . $operator . " " . $this->mConn->mDriver->QuoteValue($value);
                $sql_count .= " OR " . $more_fields[$i] . " " . $operator . " " . $this->mConn->mDriver->QuoteValue($value);
                $sqlSum    .= " OR " . $more_fields[$i] . " " . $operator . " " . $this->mConn->mDriver->QuoteValue($value);
              }
            
              $sql       .= ") ";
              $sql_count .= ") ";
              $sqlSum    .= ") ";
            }
            else
            {
              //Se operador for IN ou NOT IN vai colocar aspas em cada valor separado por v�rgula
              if ($operator === 'IN' || $operator === 'NOT IN')
              {
                //Se tiver um v�rgula sobrando � direita, vai limpar
                $value = rtrim ($value, " , ");

                $arr_value = explode(",", $value);
                $value = implode("', '", $arr_value);

                $sql       .= $sql_operator . $field . " " . $operator . " ('" . ($value). "') ";
                $sql_count .= $sql_operator . $field . " " . $operator . " ('" . ($value). "') ";
                $sqlSum    .= $sql_operator . $field . " " . $operator . " ('" . ($value). "') ";
              }
              elseif ((strtolower($operator) === '~*') && (strpos($value, "&&"))) // Utilizar AND em consultas de texto
              {
                foreach (explode("&&",$value) as $value)
                {
                  if (strlen($value) > 0)
                  {
                    $sql       .= $sql_operator . $field . " " . $operator . " " . $this->mConn->mDriver->QuoteValue($value);
                    $sql_count .= $sql_operator . $field . " " . $operator . " " . $this->mConn->mDriver->QuoteValue($value);
                    $sqlSum    .= $sql_operator . $field . " " . $operator . " " . $this->mConn->mDriver->QuoteValue($value);
                    if ($sql_operator == " WHERE ")
                      $sql_operator = " AND ";
                  }
                }
              }
              else
              {
                $sql       .= $sql_operator . $field . " " . $operator . " " . $this->mConn->mDriver->QuoteValue($value);
                $sql_count .= $sql_operator . $field . " " . $operator . " " . $this->mConn->mDriver->QuoteValue($value);
                $sqlSum    .= $sql_operator . $field . " " . $operator . " " . $this->mConn->mDriver->QuoteValue($value);          
              }
            }
        
          if ($sql_operator == " WHERE ")
            $sql_operator = " AND "; 
        
          }//if (strlen($value) > 0 && !$join)
          unset($value);
        }
        while (next($this->mFilters));
      }//if (is_array($this->mFilters))

      //sql Order
      if ($$order)
      {
        $sql_order = $this->mSql["order"];
        $this->mSql["order"] = $$order . ' ' . $this->GetAscDescOrder();

        if (str_value($sql_order))
          $this->mSql["order"] .= ", {$sql_order}";
      }


      //group by
      if ($this->mSql["groupby"])
        $sql .= " GROUP BY ".$this->mSql["groupby"];
    
      if ($this->mSql["order"])
        $sql .= " ORDER BY ".$this->mSql["order"];
  
      if ($this->mFilterForm->IsSubmitted() || $this->mShowBeginning || $_POST['f_limit'] ||
          ($_GET["f_page_" . $this->mGridName] || $_GET["f_order_" . $this->mGridName] /* && (!$GLOBALS["use_md"] && !$GLOBALS["use_popup"])*/ ) )
      {
#        if ($this->mRs = $this->mConn->Select($sql_count))
#        {
#          $this->mNumRecords = $this->mRs->GetField(0);
#  
#          if (!$this->mRs = $this->mConn->Select($sql, intval($this->mLimit), intval($this->mOffset)))
#            $this->mError = true;
#        }
#        else
#          $this->mError = true;
          
        if ($this->mShowNavigationTable)
        {
          if ($this->mRs = $this->mConn->Select($sql_count))
            $this->mNumRecords = $this->mRs->GetField(0);
          else
            $this->mError = true;
        }

       //execute the select that sum all values on this grid
       if ($this->mSql["sum"]) 
        {
          if ($this->mRs = $this->mConn->Select($sqlSum))
            $this->mSumRecords = $this->mRs; 
          else
            $this->mError = true;
        }

        if ( !($this->mRs = $this->mConn->Select($sql, intval($this->mLimit), intval($this->mOffset))) )
					$this->mError = true;
				else
					$this->mSql = $sql;

      }
    }//if (gettype($this->mSql) == "array")
    elseif (gettype($this->mSql) == "string")
    {
      $this->mShowNavigationTable = false;
      if (!$this->mRs = $this->mConn->Select($this->mSql))
        $this->mError = true;
    }
  }

  /**
  * Internal funtion, used in the grid's construction. Uses stored informations to build the grid links (if they exists). 
  * @param int     $col
  * @param variant $value
  */
  function BuildLink($col, $value)
  {
    if ($this->mHasLink[$col])
    {
      // a href
      if (empty($this->mLink[$col]))
        $link = $_SERVER["PHP_SELF"];
      elseif (is_int($this->mLink[$col]))
        $link = $this->mRs->GetField($this->mLink[$col]);
      else
        $link = $this->mLink[$col];

      //Only happens when the link identifier is a column index
      //and the column value is empty
      if (strlen($link) == 0)
        return $value;

      if ($link == "#")
        $link = "javascript:void(0);";

      if ((!$this->mHasLinkInterrogation[$col] && $this->mLinkFields[$col]) && stripos($link, "javascript:") === false)
        $link .= "?";

      //Add URL params from the SQL
      if ($this->mLinkFields[$col])
      {
        reset($this->mLinkFields[$col]);
        
        for ($i = 0; $i < sizeof($this->mLinkFields[$col]); $i++)
        {
          $link .= "&" ;

          $link .= urlencode(key($this->mLinkFields[$col]));
          
          if ( is_int(current($this->mLinkFields[$col])) )
            $link .= "=". $this->mRs->GetField(current($this->mLinkFields[$col]));
          else
            $link .= "=". urlencode($this->mRs->GetField(current($this->mLinkFields[$col])));
          next($this->mLinkFields[$col]);
        }
      }

      //Add URL params with fixed values
      if ($this->mExtraLinkFields[$col])
      {
        reset($this->mExtraLinkFields[$col]);
        for ($i = 0; $i < sizeof($this->mExtraLinkFields[$col]); $i++)
        {
          $link .= "&" ;
         
          $link .= urlencode(key($this->mExtraLinkFields[$col]));
          
          if ( is_int(current($this->mExtraLinkFields[$col])) )
            $link .= "=". current($this->mExtraLinkFields[$col]);
          else
            $link .= "=". urlencode(current($this->mExtraLinkFields[$col]));
          next($this->mExtraLinkFields[$col]);
        }
      }

      // OnClick 
      if ($this->mHasOnClick[$col])
      {

        $func = " onClick=\"javascript:" . $this->mFunc[$col];
        $comma = "(";

        // stat params 
        if ($this->mOnClickFields[$col]["stat"])
        {
          reset($this->mOnClickFields[$col]["stat"]);
          for ($i = 0; $i < count($this->mOnClickFields[$col]["stat"]); $i++)
          {
            $func .= $comma . current($this->mOnClickFields[$col]["stat"]);
            $comma = ",";
            next($this->mOnClickFields[$col]["stat"]);
          }
        }

        // db params 
        if ($this->mOnClickFields[$col]["db"])
        {
          reset($this->mOnClickFields[$col]["db"]);
          for ($i = 0; $i < count($this->mOnClickFields[$col]["db"]); $i++)
          {
            $func .= $comma . "'" . addslashes($this->mRs->GetField(current($this->mOnClickFields[$col]["db"]))) . "'";
            $comma = ",";
            next($this->mOnClickFields[$col]["db"]);
          }
        }

        $func .= ");\"";

      }

      // target 
      if (strlen($this->mTarget[$col]) > 0)
        $target = "\" target=\"".$this->mTarget[$col]."\"";

      $useImage = true;
      
      // Icon
      switch(trim(strtolower(str_replace(".","",  strip_tags($value)))))
      {
        case "propriedades":
        case "prop":
        case "propr":
        case "editar":
          $icon  = "editar";
          $tip   = "Editar";
          $class = "fa fa-pencil-square-o";
        break;
      
        case "extrato":
        case "extr":
          $icon  = "extrato";
          $tip   = "Extrato";
          $class = "fa fa-list";
        break;
      
        case "extrato completo":
          $icon  = "extrato_completo";
          $tip   = "Extrato Completo";
          $class = "fa fa-list-alt";
        break;
      
        case "duplicar":
        case "dupl":
          $icon  = "duplicar";
          $tip   = "Duplicar";
          $class = "fa fa-files-o";
        break;
      
        case "anexar":
        case "upload":
          $icon  = "anexo";
          $tip   = "Anexar";
          $class = "fa fa-upload";
        break;
      
        case "documento":
          $icon  = "documento";
          $tip   = "Documento";
          $class = "fa fa-file-text-o";
        break;
      
        case "imprimir":
        case "print":
          $icon  = "imprimir";
          $tip   = "Imprimir";
          $class = "fa fa-print";
        break;
      
        case "download":
        case "baixar":
        case "salvar":
          $icon  = "download";
          $tip   = "Download";
          $class = "fa fa-download";
        break;
      
        case "selecionar":
          $icon  = "selecionar";
          $tip   = "Selecionar";
          $class = "fa fa-check-circle-o";
          $color = "color: green;";
        break;

        case "cobrar":
          $icon  = "cobrar";
          $tip   = "Cobrar";
          $class = "fa fa-usd";
        break;
        
        case "imagem":
        case "img":
        case "foto":
          $icon  = "foto";
          $tip   = "Foto";
          $class = "fa fa-picture-o";
        break;
        
        default:
          $useImage = false;
        break;
      }
      
      // Image HAS TO BE a png file
      
      $out = "<a href=\"$link\" $func $target>";
      
      if ($useImage)
      {
        if (str_value($class))
          $out .= "<div class=\"" . $class . " glyphicon\" style=\"font-size: 19px; $color\" title=\"" . $tip . "\"></div>";
        else
          $out .= "<img border=\"0px\" width=\"19\" heigth=\"19\" src=\"" . URL . "/img/" . $icon . ".png\" title=\"" . $tip . "\" alt=\"" . $tip . "\" />";
      }
      else
        $out .= "$value";
      
      $out .= "</a>";
    }
    else
    {
      $out = $value;
    }
    return $out;
  }


  /**
  * Returns the current ordenation order up to a certain field,
    or just only the actual $_GET parameter in case no $fieldName be passed
  * @param   string $fieldName
  * @returns string
  */
  function GetAscDescOrder($fieldName=false)
  {
    if ($fieldName === false)
      return $_GET['ascDesc'];

    if ($_GET["f_order_".$this->mGridName] == $fieldName) 
      return (($_GET['ascDesc']) == 'desc' ? 'asc' : 'desc');

    return 'asc';
  }

  /**
  * Internal funtion, used in the grid's construction. Build the grid
  */
  function BuildGrid()
  {
    if ($this->mError)
      $this->AddObject($this->mConn->GetError());
    else
    {
      if ($this->mVisibles)
      {
        // Header: Visible Fields 
        reset($this->mVisibles);
        do
        {
          if ($this->mShowLinks)
          {
            $str = "<a href=\"".$this->mLocation;
            $str .= $this->BuildUrlGrid();

            if (strpos($str, "?"))
              $operator = "&"; 
            else
              $operator = "?";
       
            $order = "f_order_".$this->mGridName; 
            $str  .= $operator.$order."=".key($this->mVisibles)."&ascDesc=".$this->GetAscDescOrder(key($this->mVisibles));
            $str  .= "\">".current($this->mVisibles)."</a>";
          }
          else
            $str = current($this->mVisibles);

          $this->OpenHeader($str, array("align" => "center"));
        }
        while (next($this->mVisibles));

        // Header: Extra Fields 
        if ($this->mExtraFields)
        {
          reset($this->mExtraFields);
          for ($j=0; $j<sizeof($this->mExtraFields); $j++)
          {
            $this->OpenHeader((!is_int(key($this->mExtraFields)) ? key($this->mExtraFields) : ""), array("align" => "center"));
            next($this->mExtraFields);
          }
        }

        if (!$this->mRs->GetRowCount())
        {
          $this->OpenRow();
          $this->OpenCell("<i>Sem dados.</i>", array("colspan" => $this->GetColspan()));
        }
                
        // Cells 
        while (!$this->mRs->IsEof())
        {
          // DB Cells
          $i = 0;
          $this->OpenRow();
          reset($this->mVisibles);
          do
          {
            $value = $this->mRs->GetField(key($this->mVisibles));

            // callback(s)
            if ($this->mCallback[$i])
            {
              foreach ($this->mCallback[$i] as $chave => $valor)
              {
                $arr = $this->mCallbackParams[$i][$chave];
                array_unshift($arr, $value);
                $value = call_user_func_array($this->mCallback[$i][$chave], $arr);
              }
            }

            $cell_options = array("align" => $this->mColumnAlign[key($this->mVisibles)], "class" => "table-grid-td");
            $this->OpenCell($this->BuildLink($i, $value), $cell_options);
            $i++;
          }
          while (next($this->mVisibles));

          // Extra Cells 
          if ($this->mExtraFields)
          {
            reset($this->mExtraFields);
            for ($j=0; $j<sizeof($this->mExtraFields); $j++)
            {
              $this->OpenCell($this->BuildLink($i, current($this->mExtraFields)),
                              array("align" => "center"));
              next($this->mExtraFields);
              $i++;
            }
          }

          $this->mRs->Next();
        }
        
        //show SUM results
        if ($this->mSumRecords !== null) 
        {
          $this->OpenRow();

          $records = $this->mSumRecords->GetArray(true);
          $records = $records[0];

          //show the totals below their respective columns
          //
          $headerCounter = 0;
          $i = 0;
          foreach($this->mVisibles as $fieldName => $label)
          {
            if ( ($sumValue = $records[$fieldName]) )
            {
              //set the color
              //
              $color = $sumValue > 0 ? "green" : "red";

              //if is there a column callback
              //
              if ($this->mCallback[$i])
              {
                foreach ($this->mCallback[$i] as $chave => $valor)
                {
                  $arr = $this->mCallbackParams[$i][$chave];
                  array_unshift($arr, $sumValue);
                  $sumValue = call_user_func_array($this->mCallback[$i][$chave], $arr);
                }
              }

              //show the sum
              //
              $this->OpenCell("<b>".$sumValue."</b>", array("align" => "right", "style" => "color:".$color.";"));
            }
            else
            {
              if ($headerCounter++ == 0)
                $this->OpenHeader("<b>Total</b>"); 
              else
                $this->OpenCell("");
            }

            $i++;
          }

          //Fill the extra spaces
          //
          if (is_array($this->mExtraFields))
          {
            for ($i = 0, $j = sizeof($this->mExtraFields); $i < $j; $i++)
              $this->OpenCell("");
          }
        }

      }
      else
      {
        // header 
        for ($i=0; $i<$this->mRs->GetFieldCount(); $i++)
        {
          $this->OpenHeader($this->mRs->GetFieldName($i), array("align" => "center"));
        }

        // extra header 
        if ($this->mExtraFields)
        {
          reset($this->mExtraFields);
          for ($j=0; $j<sizeof($this->mExtraFields); $j++)
          {
            $this->OpenHeader(key($this->mExtraFields), array("align" => "center"));
            next($this->mExtraFields);
          }
        }

        // cells 
        while (!$this->mRs->IsEof())
        {
          // db cells 
          $this->OpenRow();
          for ($i=0; $i<$this->mRs->GetFieldCount(); $i++)
          {
            $value = $this->mRs->GetField($i);

            // callback 
            if ($this->mCallback[$i])
            {
              $arr = $this->mCallbackParams[$i];
              array_unshift($arr, $value);
              $value = call_user_func_array($this->mCallback[$i], $arr);
            }

            $this->OpenCell($this->BuildLink($i, $value));
          }
          $this->mRs->Next();

          // extra cells 
          if ($this->mExtraFields)
          {
            reset($this->mExtraFields);
            for ($j=0; $j<sizeof($this->mExtraFields); $j++)
            {
              $i++;
              $this->OpenCell($this->BuildLink($i-1, current($this->mExtraFields)));
              next($this->mExtraFields);
            }
          }
        }
      }
    }
  }

  /**
  * Internal funtion, used in the grid's construction. Used to build the urls used in the grid
  */
  function BuildUrlGrid($ignoreKey = array("f_id_xls"))
  {
    $order    = "f_order_".$this->mGridName;
    $page     = "f_page_".$this->mGridName;
    $operator = (strpos($this->mLocation, "?") === false) ? "?" : "&";
    $str      = "";
    
    if (is_array($_GET))
    {
      reset($_GET);
      for ($i = 0; $i < sizeof($_GET); $i++)
      {
				$getKey = key($_GET);
				
				if (in_array($getKey, $ignoreKey))
				{
					next($_GET);
					continue;
				}

        if ($getKey && ($getKey != $page) && ($getKey != $order) && 
            ($getKey != 'ascDesc') && (substr($getKey, 0, 7) != "message") && ($getKey != "f_popup"))
        {
          $str .= $operator.$getKey."=".current($_GET); 
          if ($operator == "?")
            $operator = "&"; 
        }
        next($_GET);
      }
    }
    
    if (is_array($_POST))
    {
      if (!is_array($_SESSION["s_objects"]))
        $_SESSION["s_objects"] = array();
      
      reset($_POST);
      for ($i = 0; $i < sizeof($_POST); $i++) 
      {
				$postKey = key($_POST);

				if (in_array($postKey, $ignoreKey))
				{
					next($_POST);
					continue;
				}

        if ((!in_array($postKey, $_SESSION["s_objects"])) && ($postKey != $order) && ($postKey != "ascDesc") &&
            ($postKey != $page))
        {
          $str .= $operator.$postKey."=".current($_POST);
          if ($operator == "?")
            $operator = "&"; 
        }
        next($_POST);
      }
    }

    return $str;

  }

  /**
  * Internal funtion, used in the grid's construction. Used to build the navigation table
  */
  function BuildNavigationTable()
  {
    $this->mNavigationTable = new JForm("NavigationTable");
    $this->mNavigationTable->SetWidth("100%");
    $this->mNavigationTable->SetLineStyles("rowodd", "rowodd", "roweven", "roweven");

    $actualUrl = basename($_SERVER["PHP_SELF"])."?".$_SERVER["QUERY_STRING"];
    $this->mNavigationTable->SetAction( $actualUrl );
    $this->mNavigationTable->SetFocus(false);

    $this->mNavigationTable->OpenRow();
      
    $order  = "f_order_".$this->mGridName;
    $page   = "f_page_".$this->mGridName; 
    global $$order, $$page;

    //first button
    if ($$page > 1)
    {
      $str_tmp = "<li><a href=\"".$this->mLocation;
      $str_tmp .= $this->BuildUrlGrid();

      if (strpos($str_tmp, "?") !== false)
        $operator = "&";
      else
        $operator = "?";

      $str_tmp .= $operator."f_page_".$this->mGridName."=1&f_order_".$this->mGridName."=".$$order."&ascDesc=".$this->GetAscDescOrder();

      $str_tmp .= "\">".$this->mFirstButton."</a></li>";
    }
    else
      $str_tmp = "<li class=\"disabled\"><a href=\"#\"> $this->mFirstButton </a></li>";

    $str = $str_tmp;
    unset($str_tmp);

    //navigantion pages
    $this->mNumPages = ceil($this->mNumRecords / $this->mLimit);

    if ($this->mNumPages > 0)
    {      
      //unset($str);
      $inicio = $$page - $this->mInterval;
      if ($inicio <= 0)
      {
        $sobra  = abs($inicio) + 1;
        $inicio = 1;
      }

      $fim = $$page + $this->mInterval + $sobra;
      if ($fim > $this->mNumPages)
      {
        $sobra = $fim - $this->mNumPages;
        $inicio -= $sobra;
        if ($inicio <= 0)
          $inicio = 1;
        $fim = $this->mNumPages;
      }

      //back
      if ($$page > 1)
      {
        $str_tmp = "<li><a href=\"".$this->mLocation;
        $str_tmp .= $this->BuildUrlGrid();

        if (strpos($str_tmp, "?") !== false)
          $operator = "&";
        else
          $operator = "?";

        $str_tmp .= $operator."f_page_".$this->mGridName."=".($$page - 1)."&f_order_".$this->mGridName."=".$$order."&ascDesc=".$this->GetAscDescOrder();
        $str_tmp .= "\">".$this->mBackButton."</a></li>";
      }
      else
        $str_tmp = "<li class=\"disabled\"><a href=\"#\"> $this->mBackButton </a></li>";

      $str .= $str_tmp;
      unset($str_tmp);
 
      for ($i = $inicio; $i <= $fim; $i++)
      {
        if ($i == $$page)
          $str_tmp = "<li class=\"active\"><a href=\"#\">$i<span class=\"sr-only\">(current)</span></a></li>";
        else
        {
          $str_tmp = "<li> <a href=\"".$this->mLocation;
          $str_tmp .= $this->BuildUrlGrid();

          if (strpos($str_tmp, "?") !== false)
            $operator = "&";
          else
            $operator = "?";

          $str_tmp .= $operator."f_page_".$this->mGridName."=".$i."&f_order_".$this->mGridName."=".$$order."&ascDesc=".$this->GetAscDescOrder();
          $str_tmp .= "\">".$i."</a></li>";
        }
        
        $str .= $str_tmp;
        unset($str_tmp);
      }

      //forward
      if ($$page >= $this->mNumPages)
        $str_tmp = "<li class=\"disabled\"><a href=\"#\"> $this->mForwardButton </a></li>";
      else
      {
        $str_tmp = "<li><a href=\"".$this->mLocation;
        $str_tmp .= $this->BuildUrlGrid();

        if (strpos($str_tmp, "?") !== false)
          $operator = "&";
        else
          $operator = "?";

        $str_tmp .= $operator."f_page_".$this->mGridName."=".($$page + 1)."&f_order_".$this->mGridName."=".$$order."&ascDesc=".$this->GetAscDescOrder();
        $str_tmp .= "\">".$this->mForwardButton."</a></li>\n";
      }
      $str .= $str_tmp;
      unset($str_tmp);
    }

    //last
    if ($$page >= $this->mNumPages)
      $str_tmp = "<li class=\"disabled\"><a href=\"#\"> $this->mLastButton </a></li>";
    else
    {
      $str_tmp = "<li><a href=\"".$this->mLocation;
      $str_tmp .= $this->BuildUrlGrid();

      if (strpos($str_tmp, "?") !== false)
        $operator = "&";
      else
        $operator = "?";

      $str_tmp .= $operator."f_page_".$this->mGridName."=".$this->mNumPages."&f_order_".$this->mGridName."=".$$order."&ascDesc=".$this->GetAscDescOrder();
      $str_tmp .= "\">".$this->mLastButton."</a></li>";
    }

    $str .= $str_tmp;
    unset($str_tmp);

    $this->mNavigationTable->OpenCell("", array("align" => "center"));
    $this->mNavigationTable->AddHtml("<ul align=\"center\" width=\"50%\" class=\"pagination pagination-sm\">$str</ul>");

    unset($str);

    //Number of records like: 1 to 10 of 30
    if ($this->mNumRecords > 0)
    {
      $str = ($this->mOffset + 1)." ".$this->mMessages["To"];
      if ( ($this->mOffset + $this->mLimit) > $this->mNumRecords)
        $str .= " ".$this->mNumRecords;
      else
        $str .= " ".($this->mOffset + $this->mLimit);
      $str .= " ".$this->mMessages["For"]." ".$this->mNumRecords;
    }
    else
      $str = $this->mMessages["NoRecords"];

    $this->mNavigationTable->AddHtml("<div style=\"color:#428bca;\">$str</div>");

    //limit of entrys chooser
    $this->mNavigationTable->OpenCell("", array("style" => "vertical-align:top; padding-top: 8px"));
		$this->mNavigationTable->AddObject($this->GetLimitChooser());

    if ($this->mShowXls)
      $this->AddXlsGenerationData();
	}

  /**
		* Add link for Xls generation of filtred data
		*/
	function AddXlsGenerationData()
	{
		if (!is_array($this->mSql))
		{
			if (strpos($_SERVER["REQUEST_URI"], "?") !== false)
			{
			  $operator = ((strpos($_SERVER["REQUEST_URI"], "?") !== false) ? "&" : "?");
			  $str  = "<a href=\"" . $_SERVER["REQUEST_URI"] . $operator . "f_id_xls=1\">";
			  $str .= "<div class=\"fa fa-file-excel-o glyphicon\" style=\"font-size: 27px;\" title=\"Gerar Xls\"></div></a>";
			}
			else
			{
				$str = "<a href=\"". $this->mLocation;
				$str .= $this->BuildUrlGrid();

				$operator = ((strpos($str, "?") === false) ? "?" : "&");
				$str .= $operator."f_page_".$this->mGridName."=1";
				$str .= "&f_id_xls=1\"><div class=\"fa fa-file-excel-o glyphicon\" style=\"font-size: 27px;\" title=\"Gerar Xls\"></div></a>";
			}

			$this->mNavigationTable->OpenCell($str, array("align" => "center"));
		}
	}

  /**
  * Returns the object which sets the limit of shown entry
  * @returns object
  */
  function &GetLimitChooser()
  {    
    // chooser
    //
    $comboChooser = new JFormSelect("f_limit");
    $comboChooser->MakeClass("btn btn-primary btn-xs");
    $comboChooser->SetDefaultValue($this->mLimit);
    $comboChooser->SetEvents("onChange", "ChangeRecordLimit");
    $comboChooser->SetParameters("ChangeRecordLimit", "this");
    
    if (is_array($this->mFilters) && count($this->mFilters) > 0)
    {
      $comboChooser->SetParameters("ChangeRecordLimit", $this->mNavigationTable->GetName());
    }
    else
    {
      $comboChooser->SetParameters("ChangeRecordLimit", "NavigationTable"); 
    }

  	//Limites personalizados para o Ofert�o
		for($i=10; $i <= $this->mLimitConfiguration['max'];$i=$i+$this->mLimitConfiguration['increment'])
		{
			if ($i >= 50 && $i < 100)
			{
				$this->mLimitConfiguration['increment'] = 50;
			}
			elseif ($i >= 100)
				$this->mLimitConfiguration['increment'] = 100;

			$comboChooser->AddOption($i, $i);
		}
  
    return $comboChooser;
  }

  
  /**
  * Internal funtion, used in the grid's construction. Builds the grid's filters.
  */
  function BuildFilter()
  {
    $this->mFilterForm->SetWidth("100%");
    $this->mFilterForm->SetLineStyles("rowodd_filter", "rowodd_filter", "roweven_filter", "roweven_filter");
#    $this->mFilterForm->SetLineStyles("filtro-rowodd", "filtro-rowodd", "filtro-roweven", "filtro-roweven");
#    $this->mFilterForm->OpenTable(array("class" => "filtro"));

    //Array Filters
    if (is_array($this->mFilters))
    {
      reset($this->mFilters);

      if (sizeof($this->mSeparators) > 0 and sizeof($this->mSeparators[""]) > 0)
      {
        for ($i = 0; $i < sizeof($this->mSeparators[""]); $i++)
        {
          $this->mFilterForm->OpenRow();
          $this->mFilterForm->OpenHeader($this->mSeparators[""][$i]["description"], $this->mSeparators[""][$i]["options"]);
        }
      }

      do
      {
        if ($this->mFilters[key($this->mFilters)]["open"])
          $this->mFilterForm->OpenRow();
         
        $this->mFilterForm->OpenCell($this->mFilters[key($this->mFilters)]["description"]);
        $object =& $this->mFilters[key($this->mFilters)]["object"];
        $this->mFilterForm->OpenCell("", $this->mFilters[key($this->mFilters)]["options"]);

        $this->mFilterForm->AddObject($object);
        unset($object);

        if (is_array($this->mSeparators[key($this->mFilters)]) && sizeof($this->mSeparators[key($this->mFilters)]) > 0)
        {
          for ($i = 0; $i < sizeof($this->mSeparators[key($this->mFilters)]); $i++)
          {
            $this->mFilterForm->OpenRow();
            $this->mFilterForm->OpenHeader($this->mSeparators[key($this->mFilters)][$i]["description"], $this->mSeparators[key($this->mFilters)][$i]["options"]);
          }
        }
      }
      while (next($this->mFilters));

      $cell_options = array("colspan" => (sizeof($this->mFilters)*2), "align" => "center");
      $this->mFilterForm->OpenRow();
      $this->mFilterForm->OpenHeader("", $cell_options);
      $this->Submit = new JFormSubmit("f_submit_filter", "Filtrar");
      $this->mFilterForm->AddObject($this->Submit);
      $this->Reset  = new JFormReset("f_reset_filter", "Limpar", true);
      $this->mFilterForm->AddObject($this->Reset);
      //Hidden that keeps the chosen value from the limit chooser which is out of the form
      if (!$_POST['f_limit']) $this->mFilterForm->AddObject(new JFormHidden('f_limit'));

      $this->mFilterForm->AddFilterErrorRow($cell_options["colspan"]);
    }
    
    $order = "f_order_".$this->mGridName;
    $page  = "f_page_".$this->mGridName;

    //Array GET
    if (is_array($_GET))
    {
      reset($_GET);
      for ($i = 0; $i < sizeof($_GET); $i++)
      {
        $getKey = key($_GET);
        if (($getKey != $order) && ($getKey != $page) && 
            (substr($getKey, 0, 7) != "message") && ($getKey != "f_popup"))
        {
          $object  = $getKey;
          $$object = new JFormHidden($object);
          $$object->SetValue(current($_GET));
          $this->mFilterForm->AddObject($$object);
          unset($object);
        }
        next($_GET);
      }
    }

    //Array Post
    if (is_array($_POST))
    {
      if (!is_array($_SESSION["s_objects"]))
        $_SESSION["s_objects"] = array();

      reset($_POST);
      for ($i = 0; $i < sizeof($_POST); $i++)
      {
        $postKey = key($_POST);
        if ((!in_array($postKey, $_SESSION["s_objects"])) && ($postKey != $order) && ($postKey != $page))
        {
          $object = $postKey;
          $$object = new JFormHidden($object);
          $$object->SetValue(current($_POST));
          $this->mFilterForm->AddObject($$object);
          unset($object);
        }
        
        next($_POST);
      }
    }
  
  }

  /**
  * Builds grid output
  * @returns string
  */
  function GetHtml()
  {
    //Sets filters properties
    $usePostAction = sizeof($_POST);
    if (is_array($this->mFilters))
    {
      reset($this->mFilters);
      do
      {
        $object =& $this->mFilters[key($this->mFilters)]["object"];
        
        //object properties
        $arr = $this->mFiltersProperties[key($this->mFilters)]; 

        if (is_array($arr))
        {
          foreach($arr as $property => $value)
          {
            switch ($property)
            {
              case "value":
                if (!isset($_SESSION["s_".$this->mGridName."_".key($this->mFilters)]))
                  if (!$object->GetValue())
                    $object->SetValue($value);
              break;

              case "size":
                $object->SetSize($value);  
              break;

              case "maxlength":
                $object->SetMaxlength($value);
              break;
              
              case "disabled":
                $object->SetDisabled($value);
              break;

              case "SetDefaultValue":
                if (!isset($_SESSION["s_".$this->mGridName."_".key($this->mFilters)]))
                  $object->$property($value);
              break;
              
              default:
              {
                if (!is_array($value))
                  $value = array($value);
                
                call_user_func_array(array(&$object, $property), $value);
              }

            }//switch ($property)
          }//foreach
        }//if (is_array($arr))
       
        if ($usePostAction)
        {
          $value = $_POST[$object->mName];
          if ($object->mGridParameters)
            call_user_func_array(array(&$object, "SetValue"), array_merge(array($value), $object->mGridParameters));
          else
            $object->SetValue($value);
        }
        else
        {
          if (isset($_REQUEST[$object->mName]) && $_SESSION["s_".$this->mGridName."_".key($this->mFilters)])
          {
            if ($object->mType == "Date")
            {
              if (strpos($_SESSION["s_".$this->mGridName."_".key($this->mFilters)], "/"))
                $object->SetValue($_SESSION["s_".$this->mGridName."_".key($this->mFilters)], "pt_BR", "pt_BR");
              else
                $object->SetValue($_SESSION["s_".$this->mGridName."_".key($this->mFilters)]);
            }
            else
            {
              $value = $_SESSION["s_".$this->mGridName."_".key($this->mFilters)];
              if ($object->mGridParameters)
                call_user_func_array(array(&$object, "SetValue"), array_merge(array($value), $object->mGridParameters));
              else
                $object->SetValue($value);
            }
          }
          else
          {
            if (!isset($_SESSION["s_".$this->mGridName."_".key($this->mFilters)]))
            {
              $value = (isset($_REQUEST[$object->mName]) ? $_REQUEST[$object->mName] : $object->GetValue(true));
              if ($object->mGridParameters)
                call_user_func_array(array(&$object, "SetValue"), array_merge(array($value), $object->mGridParameters));
              else
                $object->SetValue($value);
            }
          }
        }
      }
      while (next($this->mFilters));

    }//if (is_array($this->Filters))
    $usePostAction = null;

    //Execute Sqls
    $this->ExecuteSql();

    //Xls
		if ($this->mShowXls && $_GET["f_id_xls"])
		{
			if (is_object($this->mRs) && $this->mRs->GetRowCount())
		  {
				require("lib/writeexcel/db_write_excel.php");
				
				ini_set("memory_limit", - 1);
				
				$sql_with   = "WITH with_consulta_listagem AS ($this->mSql)";
				$sql_select = "SELECT " . implode(",", array_keys($this->mVisibles));
		                                                                            
		    $sql = $sql_with . $sql_select . " FROM with_consulta_listagem";

 		    //Gera XLS
		    $myxls = new DbWriteExcel($this->mConn);
		    $myxls->SetNameFile($_SESSION["s_cd_usuario"] . "_" . str_replace(".php", "", basename($_SERVER["SCRIPT_NAME"])));
		    $myxls->GetXlsFromQuery($sql);
		                                                                                                                                    
		    exit;
		  }
		  else
		    echo "<script>alert('Aten��o: Sem dados para a gera��o do XLS!')</script>";
	  }

    if ($this->mError)
    {
      $this->AddObject($this->mConn->GetError());
      $out .= $this->mObjects[0]->GetHtml();
    
      if (is_array($this->mFilters))
      {
        //clean session variables
        reset($this->mFilters);
        do
        {
          unset($_SESSION["s_".$this->mGridName."_".key($this->mFilters)]);
        }
        while(next($this->mFilters));
      }
    }
    elseif (!$this->mNumRecords && !$this->mShowEmptyGrid)
    {
      return false;
    }
    else
    {
      $cell_options = array("colspan" => $this->GetColspan(),
                            "bgcolor" => "#FFFFFF",
                            "align"   => "center");
      
      //Navigation Table
      if ($this->mShowNavigationTable)
        $this->BuildNavigationTable();

      if ($this->mTitle)
      {
        $this->OpenRow();
        $this->OpenHeader($this->mTitle, $cell_options);
      }

      if ($this->mShowNavigationTable && $this->mNavigationPosition == "top")
      {
        $this->OpenRow();
        $this->OpenCell("", $cell_options);
        $this->AddObject($this->mNavigationTable);
      }
     
     
      //Grid
      $this->OpenRow();
      if (gettype($this->mSql) == "array")
      {
        if ($this->mFilterForm->IsSubmitted() || $this->mShowBeginning || $_POST['f_limit'] ||
            ($_GET["f_page_" . $this->mGridName] || $_GET["f_order_" . $this->mGridName] ) )
          $this->BuildGrid();
      }
      else
        $this->BuildGrid();

      //Navigation Table
      if ($this->mShowNavigationTable && $this->mNavigationPosition == "bottom")
      {
        $this->OpenRow();
        $this->OpenCell("", $cell_options);
        $this->AddObject($this->mNavigationTable);
      }
      
      //Filter
      if ($this->mShowNavigationTable && is_array($this->mFilters))
      {

        #Empty Filter Control
        $has_defaut_value = false;
        $has_value        = false;

        reset($this->mFilters);
        do
        {
          $object =& $this->mFilters[key($this->mFilters)]["object"];
          $arr = $this->mFiltersProperties[key($this->mFilters)];
          if (is_array($arr))
          {
            reset($arr);
            do
            {
              if (key($arr) == "SetDefaultValue")
                $has_default_value = true;
            }while (next($arr));
          }

          if ($object->mValue)
            $has_value = true;
        } while (next($this->mFilters));

        if (!sizeof($_POST) && !sizeof($_GET))
        {
          if ($has_default_value && !$has_value)
          {
            reset($this->mFilters);
            do
            {
              $object =& $this->mFilters[key($this->mFilters)]["object"];
              $arr = $this->mFiltersProperties[key($this->mFilters)];
              if (is_array($arr))
              {
                reset($arr);
                do
                {
                  if (key($arr) == "SetDefaultValue")
                  {
                    $value = current($arr);
                    if ($object->mGridParameters)
                      call_user_func_array(array(&$object, "SetValue"), array_merge(array($value), $object->mGridParameters));
                    else
                      $object->SetValue($value);
                  }
                }while (next($arr));
              }

              if (strlen($object->mValue))
                $has_value = true;
            } while (next($this->mFilters));
          }
        }

        $this->BuildFilter();
        $this->OpenRow();
        $this->OpenCell("", $cell_options);
        $this->AddObject($this->mFilterForm);
      }
      
      //Status Table
      if (((is_array($this->mFilters) && sizeof($this->mFilters)) || $this->mShowNavigationTable) && $this->mShowStatus)
      {
          $cell_options = array("colspan" => $this->GetColspan(),
                                "bgcolor" => "#efefef");
          $this->OpenRow();
          $this->OpenCell("", $cell_options);
          $this->mStatusTable = new JTable();
          $this->mStatusTable->SetTableOptions(array("class" => "noborder"));
          $this->mStatusTable->SetWidth("100%");
          $this->mStatusTable->OpenRow();
          if ($this->mTip["tip"])
            $tip = "<a disabled href=\"#\" onMouseOver=\"stm(Tips[0],Style[0], '".$this->mTip["twidth"]."', '".$this->mTip["theight"]."')\" onMouseOut=\"htm()\"><img src=\"" . URL . "img/lamp.gif\" border=\"0\" width=\"16\" height=\"14\"></A>  ";
          $this->mStatusTable->OpenHeader($tip . "Status:", array("width" => "20%"));
          $this->mStatusTable->OpenCell("&nbsp;".stripslashes($_REQUEST["message"]), array("align" => "left", "valign" => "center"));
          $this->AddObject($this->mStatusTable);
      }

      //Close Table
      $this->CloseTable();

      if ($this->mTip["tip"])
      {
        //$out .= "<script language=\"JavaScript\" src=\"" . URL ."js/main15.js\"></script>\n"; TODO
        $out .= "<script language=\"JavaScript\">\n";
        $out .= "Style[0] = [" . $this->mTipStyle . "];\n" ;
        $out .= "var TipId=\"tiplayer\"; \nvar FiltersEnabled = 1; \nmig_clay(); \n";
        $out .= "Tips[0] = [\"" . $this->mTip["title"] . "\", \"" . $this->mTip["tip"] ."\"];\n";
        $out .= "</script>\n";
      }

      for ($i = 0; $i < $this->mIndex; $i++)
      {
        if (is_object($this->mObjects[$i]))
        {
          $this->mObjects[$i]->MakeId($this->mId);
          $out .= $this->mObjects[$i]->GetHtml();
          $this->mId = $this->mObjects[$i]->MakeId();//avoid duplicate ids when using nested objects
        }
        else
          $out .= $this->mTexts[$i];
      }

      if ($this->mRS)
        $this->mRs->Close();

    }

    return $out;
  }

  /**
  * Sets whether the component shows a javascript date picker
  * @param boolean $use
  */
  function UseDatePicker($use=null)
  {
    if ($use !== null)
      $this->mUseDatePickerToGrid = $use;

    $use = $this->mUseDatePickerToGrid && $this->mUseDatePicker;
    $this->mFilterForm->UseDatePicker($use);
  }

  /**
  * Sets whether status bar might be shown
  * It also depends if the grid have any filters or shows the navigation table
  * @param boolean $use
  */
  function SetShowStatus($show)
  {
    if (is_bool($show))
      $this->mShowStatus = $show;
  }

  public function SetShowEmptyGrid($show)
  {
    if (is_bool($show))
      $this->mShowEmptyGrid = $show;
  }

  public function SetFilterValidationLevel($level)
  {
    $this->mFilterForm->SetFilterValidationLevel($level);
  }

  /**
   * @param string $field1
   * @param string $field2
   * @param string $label
   * @param array $config
   * @param string|null $fieldEqual
   * @throws Exception
   */
  public function SetIntervalFilters($field1, $field2, $label, array $config, $fieldEqual=null)
  {
    $field1 = $this->mFilters[$field1]["object"];
    $field2 = $this->mFilters[$field2]["object"];
    $fieldEqual = $fieldEqual ? $this->mFilters[$fieldEqual]["object"] : null;

    $this->mFilterForm->SetIntervalFilters($field1, $field2, $label, $config, $fieldEqual);
  }
  
  protected function GetColspan()
  {
      $colspan = 0;
      $colspan += (is_array($this->mVisibles)    ? sizeof($this->mVisibles)    : 0);
      $colspan += (is_array($this->mExtraFields) ? sizeof($this->mExtraFields) : 0);
      
      return $colspan;
  }
}
