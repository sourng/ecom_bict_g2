<?php
if (session_id() == "") session_start(); // Init session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg14.php" ?>
<?php include_once ((EW_USE_ADODB) ? "adodb5/adodb.inc.php" : "ewmysql14.php") ?>
<?php include_once "phpfn14.php" ?>
<?php include_once "tbl_productinfo.php" ?>
<?php include_once "userfn14.php" ?>
<?php

//
// Page class
//

$tbl_product_list = NULL; // Initialize page object first

class ctbl_product_list extends ctbl_product {

	// Page ID
	var $PageID = 'list';

	// Project ID
	var $ProjectID = '{6AF8C2FF-A16C-4050-9229-E3A572D6C974}';

	// Table name
	var $TableName = 'tbl_product';

	// Page object name
	var $PageObjName = 'tbl_product_list';

	// Grid form hidden field names
	var $FormName = 'ftbl_productlist';
	var $FormActionName = 'k_action';
	var $FormKeyName = 'k_key';
	var $FormOldKeyName = 'k_oldkey';
	var $FormBlankRowName = 'k_blankrow';
	var $FormKeyCountName = 'key_count';

	// Page headings
	var $Heading = '';
	var $Subheading = '';

	// Page heading
	function PageHeading() {
		global $Language;
		if ($this->Heading <> "")
			return $this->Heading;
		if (method_exists($this, "TableCaption"))
			return $this->TableCaption();
		return "";
	}

	// Page subheading
	function PageSubheading() {
		global $Language;
		if ($this->Subheading <> "")
			return $this->Subheading;
		if ($this->TableName)
			return $Language->Phrase($this->PageID);
		return "";
	}

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		if ($this->UseTokenInUrl) $PageUrl .= "t=" . $this->TableVar . "&"; // Add page token
		return $PageUrl;
	}

	// Page URLs
	var $AddUrl;
	var $EditUrl;
	var $CopyUrl;
	var $DeleteUrl;
	var $ViewUrl;
	var $ListUrl;

	// Export URLs
	var $ExportPrintUrl;
	var $ExportHtmlUrl;
	var $ExportExcelUrl;
	var $ExportWordUrl;
	var $ExportXmlUrl;
	var $ExportCsvUrl;
	var $ExportPdfUrl;

	// Custom export
	var $ExportExcelCustom = FALSE;
	var $ExportWordCustom = FALSE;
	var $ExportPdfCustom = FALSE;
	var $ExportEmailCustom = FALSE;

	// Update URLs
	var $InlineAddUrl;
	var $InlineCopyUrl;
	var $InlineEditUrl;
	var $GridAddUrl;
	var $GridEditUrl;
	var $MultiDeleteUrl;
	var $MultiUpdateUrl;

	// Message
	function getMessage() {
		return @$_SESSION[EW_SESSION_MESSAGE];
	}

	function setMessage($v) {
		ew_AddMessage($_SESSION[EW_SESSION_MESSAGE], $v);
	}

	function getFailureMessage() {
		return @$_SESSION[EW_SESSION_FAILURE_MESSAGE];
	}

	function setFailureMessage($v) {
		ew_AddMessage($_SESSION[EW_SESSION_FAILURE_MESSAGE], $v);
	}

	function getSuccessMessage() {
		return @$_SESSION[EW_SESSION_SUCCESS_MESSAGE];
	}

	function setSuccessMessage($v) {
		ew_AddMessage($_SESSION[EW_SESSION_SUCCESS_MESSAGE], $v);
	}

	function getWarningMessage() {
		return @$_SESSION[EW_SESSION_WARNING_MESSAGE];
	}

	function setWarningMessage($v) {
		ew_AddMessage($_SESSION[EW_SESSION_WARNING_MESSAGE], $v);
	}

	// Methods to clear message
	function ClearMessage() {
		$_SESSION[EW_SESSION_MESSAGE] = "";
	}

	function ClearFailureMessage() {
		$_SESSION[EW_SESSION_FAILURE_MESSAGE] = "";
	}

	function ClearSuccessMessage() {
		$_SESSION[EW_SESSION_SUCCESS_MESSAGE] = "";
	}

	function ClearWarningMessage() {
		$_SESSION[EW_SESSION_WARNING_MESSAGE] = "";
	}

	function ClearMessages() {
		$_SESSION[EW_SESSION_MESSAGE] = "";
		$_SESSION[EW_SESSION_FAILURE_MESSAGE] = "";
		$_SESSION[EW_SESSION_SUCCESS_MESSAGE] = "";
		$_SESSION[EW_SESSION_WARNING_MESSAGE] = "";
	}

	// Show message
	function ShowMessage() {
		$hidden = FALSE;
		$html = "";

		// Message
		$sMessage = $this->getMessage();
		if (method_exists($this, "Message_Showing"))
			$this->Message_Showing($sMessage, "");
		if ($sMessage <> "") { // Message in Session, display
			if (!$hidden)
				$sMessage = "<button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>" . $sMessage;
			$html .= "<div class=\"alert alert-info ewInfo\">" . $sMessage . "</div>";
			$_SESSION[EW_SESSION_MESSAGE] = ""; // Clear message in Session
		}

		// Warning message
		$sWarningMessage = $this->getWarningMessage();
		if (method_exists($this, "Message_Showing"))
			$this->Message_Showing($sWarningMessage, "warning");
		if ($sWarningMessage <> "") { // Message in Session, display
			if (!$hidden)
				$sWarningMessage = "<button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>" . $sWarningMessage;
			$html .= "<div class=\"alert alert-warning ewWarning\">" . $sWarningMessage . "</div>";
			$_SESSION[EW_SESSION_WARNING_MESSAGE] = ""; // Clear message in Session
		}

		// Success message
		$sSuccessMessage = $this->getSuccessMessage();
		if (method_exists($this, "Message_Showing"))
			$this->Message_Showing($sSuccessMessage, "success");
		if ($sSuccessMessage <> "") { // Message in Session, display
			if (!$hidden)
				$sSuccessMessage = "<button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>" . $sSuccessMessage;
			$html .= "<div class=\"alert alert-success ewSuccess\">" . $sSuccessMessage . "</div>";
			$_SESSION[EW_SESSION_SUCCESS_MESSAGE] = ""; // Clear message in Session
		}

		// Failure message
		$sErrorMessage = $this->getFailureMessage();
		if (method_exists($this, "Message_Showing"))
			$this->Message_Showing($sErrorMessage, "failure");
		if ($sErrorMessage <> "") { // Message in Session, display
			if (!$hidden)
				$sErrorMessage = "<button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>" . $sErrorMessage;
			$html .= "<div class=\"alert alert-danger ewError\">" . $sErrorMessage . "</div>";
			$_SESSION[EW_SESSION_FAILURE_MESSAGE] = ""; // Clear message in Session
		}
		echo "<div class=\"ewMessageDialog\"" . (($hidden) ? " style=\"display: none;\"" : "") . ">" . $html . "</div>";
	}
	var $PageHeader;
	var $PageFooter;

	// Show Page Header
	function ShowPageHeader() {
		$sHeader = $this->PageHeader;
		$this->Page_DataRendering($sHeader);
		if ($sHeader <> "") { // Header exists, display
			echo "<p>" . $sHeader . "</p>";
		}
	}

	// Show Page Footer
	function ShowPageFooter() {
		$sFooter = $this->PageFooter;
		$this->Page_DataRendered($sFooter);
		if ($sFooter <> "") { // Footer exists, display
			echo "<p>" . $sFooter . "</p>";
		}
	}

	// Validate page request
	function IsPageRequest() {
		global $objForm;
		if ($this->UseTokenInUrl) {
			if ($objForm)
				return ($this->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($this->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}
	var $Token = "";
	var $TokenTimeout = 0;
	var $CheckToken = EW_CHECK_TOKEN;
	var $CheckTokenFn = "ew_CheckToken";
	var $CreateTokenFn = "ew_CreateToken";

	// Valid Post
	function ValidPost() {
		if (!$this->CheckToken || !ew_IsPost())
			return TRUE;
		if (!isset($_POST[EW_TOKEN_NAME]))
			return FALSE;
		$fn = $this->CheckTokenFn;
		if (is_callable($fn))
			return $fn($_POST[EW_TOKEN_NAME], $this->TokenTimeout);
		return FALSE;
	}

	// Create Token
	function CreateToken() {
		global $gsToken;
		if ($this->CheckToken) {
			$fn = $this->CreateTokenFn;
			if ($this->Token == "" && is_callable($fn)) // Create token
				$this->Token = $fn();
			$gsToken = $this->Token; // Save to global variable
		}
	}

	//
	// Page class constructor
	//
	function __construct() {
		global $conn, $Language;
		$GLOBALS["Page"] = &$this;
		$this->TokenTimeout = ew_SessionTimeoutTime();

		// Language object
		if (!isset($Language)) $Language = new cLanguage();

		// Parent constuctor
		parent::__construct();

		// Table object (tbl_product)
		if (!isset($GLOBALS["tbl_product"]) || get_class($GLOBALS["tbl_product"]) == "ctbl_product") {
			$GLOBALS["tbl_product"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["tbl_product"];
		}

		// Initialize URLs
		$this->ExportPrintUrl = $this->PageUrl() . "export=print";
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel";
		$this->ExportWordUrl = $this->PageUrl() . "export=word";
		$this->ExportHtmlUrl = $this->PageUrl() . "export=html";
		$this->ExportXmlUrl = $this->PageUrl() . "export=xml";
		$this->ExportCsvUrl = $this->PageUrl() . "export=csv";
		$this->ExportPdfUrl = $this->PageUrl() . "export=pdf";
		$this->AddUrl = "tbl_productadd.php";
		$this->InlineAddUrl = $this->PageUrl() . "a=add";
		$this->GridAddUrl = $this->PageUrl() . "a=gridadd";
		$this->GridEditUrl = $this->PageUrl() . "a=gridedit";
		$this->MultiDeleteUrl = "tbl_productdelete.php";
		$this->MultiUpdateUrl = "tbl_productupdate.php";

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'list', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'tbl_product', TRUE);

		// Start timer
		if (!isset($GLOBALS["gTimer"]))
			$GLOBALS["gTimer"] = new cTimer();

		// Debug message
		ew_LoadDebugMsg();

		// Open connection
		if (!isset($conn))
			$conn = ew_Connect($this->DBID);

		// List options
		$this->ListOptions = new cListOptions();
		$this->ListOptions->TableVar = $this->TableVar;

		// Export options
		$this->ExportOptions = new cListOptions();
		$this->ExportOptions->Tag = "div";
		$this->ExportOptions->TagClassName = "ewExportOption";

		// Other options
		$this->OtherOptions['addedit'] = new cListOptions();
		$this->OtherOptions['addedit']->Tag = "div";
		$this->OtherOptions['addedit']->TagClassName = "ewAddEditOption";
		$this->OtherOptions['detail'] = new cListOptions();
		$this->OtherOptions['detail']->Tag = "div";
		$this->OtherOptions['detail']->TagClassName = "ewDetailOption";
		$this->OtherOptions['action'] = new cListOptions();
		$this->OtherOptions['action']->Tag = "div";
		$this->OtherOptions['action']->TagClassName = "ewActionOption";

		// Filter options
		$this->FilterOptions = new cListOptions();
		$this->FilterOptions->Tag = "div";
		$this->FilterOptions->TagClassName = "ewFilterOption ftbl_productlistsrch";

		// List actions
		$this->ListActions = new cListActions();
	}

	//
	//  Page_Init
	//
	function Page_Init() {
		global $gsExport, $gsCustomExport, $gsExportFile, $UserProfile, $Language, $Security, $objForm;

		// User profile
		$UserProfile = new cUserProfile();

		// Security
		$Security = new cAdvancedSecurity();
		if (!$Security->IsLoggedIn()) $Security->AutoLogin();
		$Security->LoadCurrentUserLevel($this->ProjectID . $this->TableName);
		if (!$Security->CanList()) {
			$Security->SaveLastUrl();
			$this->setFailureMessage(ew_DeniedMsg()); // Set no permission
			$this->Page_Terminate(ew_GetUrl("index.php"));
		}

		// NOTE: Security object may be needed in other part of the script, skip set to Nothing
		// 
		// Security = null;
		// 

		$this->CurrentAction = (@$_GET["a"] <> "") ? $_GET["a"] : @$_POST["a_list"]; // Set up current action

		// Get grid add count
		$gridaddcnt = @$_GET[EW_TABLE_GRID_ADD_ROW_COUNT];
		if (is_numeric($gridaddcnt) && $gridaddcnt > 0)
			$this->GridAddRowCount = $gridaddcnt;

		// Set up list options
		$this->SetupListOptions();
		$this->pro_id->SetVisibility();
		if ($this->IsAdd() || $this->IsCopy() || $this->IsGridAdd())
			$this->pro_id->Visible = FALSE;
		$this->pro_cat_id->SetVisibility();
		$this->pro_name->SetVisibility();
		$this->pro_feature->SetVisibility();
		$this->pro_img_folder->SetVisibility();
		$this->price->SetVisibility();
		$this->pro_keyword->SetVisibility();
		$this->pro_status->SetVisibility();
		$this->col_id->SetVisibility();

		// Global Page Loading event (in userfn*.php)
		Page_Loading();

		// Page Load event
		$this->Page_Load();

		// Check token
		if (!$this->ValidPost()) {
			echo $Language->Phrase("InvalidPostRequest");
			$this->Page_Terminate();
			exit();
		}

		// Process auto fill
		if (@$_POST["ajax"] == "autofill") {
			$results = $this->GetAutoFill(@$_POST["name"], @$_POST["q"]);
			if ($results) {

				// Clean output buffer
				if (!EW_DEBUG_ENABLED && ob_get_length())
					ob_end_clean();
				echo $results;
				$this->Page_Terminate();
				exit();
			}
		}

		// Create Token
		$this->CreateToken();

		// Setup other options
		$this->SetupOtherOptions();

		// Set up custom action (compatible with old version)
		foreach ($this->CustomActions as $name => $action)
			$this->ListActions->Add($name, $action);

		// Show checkbox column if multiple action
		foreach ($this->ListActions->Items as $listaction) {
			if ($listaction->Select == EW_ACTION_MULTIPLE && $listaction->Allow) {
				$this->ListOptions->Items["checkbox"]->Visible = TRUE;
				break;
			}
		}
	}

	//
	// Page_Terminate
	//
	function Page_Terminate($url = "") {
		global $gsExportFile, $gTmpImages;

		// Page Unload event
		$this->Page_Unload();

		// Global Page Unloaded event (in userfn*.php)
		Page_Unloaded();

		// Export
		global $EW_EXPORT, $tbl_product;
		if ($this->CustomExport <> "" && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, $EW_EXPORT)) {
				$sContent = ob_get_contents();
			if ($gsExportFile == "") $gsExportFile = $this->TableVar;
			$class = $EW_EXPORT[$this->CustomExport];
			if (class_exists($class)) {
				$doc = new $class($tbl_product);
				$doc->Text = $sContent;
				if ($this->Export == "email")
					echo $this->ExportEmail($doc->Text);
				else
					$doc->Export();
				ew_DeleteTmpImages(); // Delete temp images
				exit();
			}
		}
		$this->Page_Redirecting($url);

		// Close connection
		ew_CloseConn();

		// Go to URL if specified
		if ($url <> "") {
			if (!EW_DEBUG_ENABLED && ob_get_length())
				ob_end_clean();
			ew_SaveDebugMsg();
			header("Location: " . $url);
		}
		exit();
	}

	// Class variables
	var $ListOptions; // List options
	var $ExportOptions; // Export options
	var $SearchOptions; // Search options
	var $OtherOptions = array(); // Other options
	var $FilterOptions; // Filter options
	var $ListActions; // List actions
	var $SelectedCount = 0;
	var $SelectedIndex = 0;
	var $DisplayRecs = 20;
	var $StartRec;
	var $StopRec;
	var $TotalRecs = 0;
	var $RecRange = 10;
	var $Pager;
	var $AutoHidePager = EW_AUTO_HIDE_PAGER;
	var $AutoHidePageSizeSelector = EW_AUTO_HIDE_PAGE_SIZE_SELECTOR;
	var $DefaultSearchWhere = ""; // Default search WHERE clause
	var $SearchWhere = ""; // Search WHERE clause
	var $RecCnt = 0; // Record count
	var $EditRowCnt;
	var $StartRowCnt = 1;
	var $RowCnt = 0;
	var $Attrs = array(); // Row attributes and cell attributes
	var $RowIndex = 0; // Row index
	var $KeyCount = 0; // Key count
	var $RowAction = ""; // Row action
	var $RowOldKey = ""; // Row old key (for copy)
	var $RecPerRow = 0;
	var $MultiColumnClass;
	var $MultiColumnEditClass = "col-sm-12";
	var $MultiColumnCnt = 12;
	var $MultiColumnEditCnt = 12;
	var $GridCnt = 0;
	var $ColCnt = 0;
	var $DbMasterFilter = ""; // Master filter
	var $DbDetailFilter = ""; // Detail filter
	var $MasterRecordExists;
	var $MultiSelectKey;
	var $Command;
	var $RestoreSearch = FALSE;
	var $DetailPages;
	var $Recordset;
	var $OldRecordset;

	//
	// Page main
	//
	function Page_Main() {
		global $objForm, $Language, $gsFormError, $gsSearchError, $Security, $EW_EXPORT;

		// Search filters
		$sSrchAdvanced = ""; // Advanced search filter
		$sSrchBasic = ""; // Basic search filter
		$sFilter = "";

		// Get command
		$this->Command = strtolower(@$_GET["cmd"]);
		if ($this->IsPageRequest()) { // Validate request

			// Process list action first
			if ($this->ProcessListAction()) // Ajax request
				$this->Page_Terminate();

			// Handle reset command
			$this->ResetCmd();

			// Set up Breadcrumb
			if ($this->Export == "")
				$this->SetupBreadcrumb();

			// Hide list options
			if ($this->Export <> "") {
				$this->ListOptions->HideAllOptions(array("sequence"));
				$this->ListOptions->UseDropDownButton = FALSE; // Disable drop down button
				$this->ListOptions->UseButtonGroup = FALSE; // Disable button group
			} elseif ($this->CurrentAction == "gridadd" || $this->CurrentAction == "gridedit") {
				$this->ListOptions->HideAllOptions();
				$this->ListOptions->UseDropDownButton = FALSE; // Disable drop down button
				$this->ListOptions->UseButtonGroup = FALSE; // Disable button group
			}

			// Hide options
			if ($this->Export <> "" || $this->CurrentAction <> "") {
				$this->ExportOptions->HideAllOptions();
				$this->FilterOptions->HideAllOptions();
			}

			// Hide other options
			if ($this->Export <> "") {
				foreach ($this->OtherOptions as &$option)
					$option->HideAllOptions();
			}

			// Get default search criteria
			ew_AddFilter($this->DefaultSearchWhere, $this->BasicSearchWhere(TRUE));
			ew_AddFilter($this->DefaultSearchWhere, $this->AdvancedSearchWhere(TRUE));

			// Get basic search values
			$this->LoadBasicSearchValues();

			// Get and validate search values for advanced search
			$this->LoadSearchValues(); // Get search values

			// Process filter list
			$this->ProcessFilterList();
			if (!$this->ValidateSearch())
				$this->setFailureMessage($gsSearchError);

			// Restore search parms from Session if not searching / reset / export
			if (($this->Export <> "" || $this->Command <> "search" && $this->Command <> "reset" && $this->Command <> "resetall") && $this->Command <> "json" && $this->CheckSearchParms())
				$this->RestoreSearchParms();

			// Call Recordset SearchValidated event
			$this->Recordset_SearchValidated();

			// Set up sorting order
			$this->SetupSortOrder();

			// Get basic search criteria
			if ($gsSearchError == "")
				$sSrchBasic = $this->BasicSearchWhere();

			// Get search criteria for advanced search
			if ($gsSearchError == "")
				$sSrchAdvanced = $this->AdvancedSearchWhere();
		}

		// Restore display records
		if ($this->Command <> "json" && $this->getRecordsPerPage() <> "") {
			$this->DisplayRecs = $this->getRecordsPerPage(); // Restore from Session
		} else {
			$this->DisplayRecs = 20; // Load default
		}

		// Load Sorting Order
		if ($this->Command <> "json")
			$this->LoadSortOrder();

		// Load search default if no existing search criteria
		if (!$this->CheckSearchParms()) {

			// Load basic search from default
			$this->BasicSearch->LoadDefault();
			if ($this->BasicSearch->Keyword != "")
				$sSrchBasic = $this->BasicSearchWhere();

			// Load advanced search from default
			if ($this->LoadAdvancedSearchDefault()) {
				$sSrchAdvanced = $this->AdvancedSearchWhere();
			}
		}

		// Build search criteria
		ew_AddFilter($this->SearchWhere, $sSrchAdvanced);
		ew_AddFilter($this->SearchWhere, $sSrchBasic);

		// Call Recordset_Searching event
		$this->Recordset_Searching($this->SearchWhere);

		// Save search criteria
		if ($this->Command == "search" && !$this->RestoreSearch) {
			$this->setSearchWhere($this->SearchWhere); // Save to Session
			$this->StartRec = 1; // Reset start record counter
			$this->setStartRecordNumber($this->StartRec);
		} elseif ($this->Command <> "json") {
			$this->SearchWhere = $this->getSearchWhere();
		}

		// Build filter
		$sFilter = "";
		ew_AddFilter($sFilter, $this->DbDetailFilter);
		ew_AddFilter($sFilter, $this->SearchWhere);

		// Set up filter
		if ($this->Command == "json") {
			$this->UseSessionForListSQL = FALSE; // Do not use session for ListSQL
			$this->CurrentFilter = $sFilter;
		} else {
			$this->setSessionWhere($sFilter);
			$this->CurrentFilter = "";
		}

		// Load record count first
		if (!$this->IsAddOrEdit()) {
			$bSelectLimit = $this->UseSelectLimit;
			if ($bSelectLimit) {
				$this->TotalRecs = $this->ListRecordCount();
			} else {
				if ($this->Recordset = $this->LoadRecordset())
					$this->TotalRecs = $this->Recordset->RecordCount();
			}
		}

		// Search options
		$this->SetupSearchOptions();
	}

	// Build filter for all keys
	function BuildKeyFilter() {
		global $objForm;
		$sWrkFilter = "";

		// Update row index and get row key
		$rowindex = 1;
		$objForm->Index = $rowindex;
		$sThisKey = strval($objForm->GetValue($this->FormKeyName));
		while ($sThisKey <> "") {
			if ($this->SetupKeyValues($sThisKey)) {
				$sFilter = $this->KeyFilter();
				if ($sWrkFilter <> "") $sWrkFilter .= " OR ";
				$sWrkFilter .= $sFilter;
			} else {
				$sWrkFilter = "0=1";
				break;
			}

			// Update row index and get row key
			$rowindex++; // Next row
			$objForm->Index = $rowindex;
			$sThisKey = strval($objForm->GetValue($this->FormKeyName));
		}
		return $sWrkFilter;
	}

	// Set up key values
	function SetupKeyValues($key) {
		$arrKeyFlds = explode($GLOBALS["EW_COMPOSITE_KEY_SEPARATOR"], $key);
		if (count($arrKeyFlds) >= 1) {
			$this->pro_id->setFormValue($arrKeyFlds[0]);
			if (!is_numeric($this->pro_id->FormValue))
				return FALSE;
		}
		return TRUE;
	}

	// Get list of filters
	function GetFilterList() {
		global $UserProfile;

		// Initialize
		$sFilterList = "";
		$sSavedFilterList = "";
		$sFilterList = ew_Concat($sFilterList, $this->pro_id->AdvancedSearch->ToJson(), ","); // Field pro_id
		$sFilterList = ew_Concat($sFilterList, $this->pro_cat_id->AdvancedSearch->ToJson(), ","); // Field pro_cat_id
		$sFilterList = ew_Concat($sFilterList, $this->pro_name->AdvancedSearch->ToJson(), ","); // Field pro_name
		$sFilterList = ew_Concat($sFilterList, $this->pro_feature->AdvancedSearch->ToJson(), ","); // Field pro_feature
		$sFilterList = ew_Concat($sFilterList, $this->pro_img_folder->AdvancedSearch->ToJson(), ","); // Field pro_img_folder
		$sFilterList = ew_Concat($sFilterList, $this->pro_detail->AdvancedSearch->ToJson(), ","); // Field pro_detail
		$sFilterList = ew_Concat($sFilterList, $this->price->AdvancedSearch->ToJson(), ","); // Field price
		$sFilterList = ew_Concat($sFilterList, $this->pro_keyword->AdvancedSearch->ToJson(), ","); // Field pro_keyword
		$sFilterList = ew_Concat($sFilterList, $this->pro_status->AdvancedSearch->ToJson(), ","); // Field pro_status
		$sFilterList = ew_Concat($sFilterList, $this->col_id->AdvancedSearch->ToJson(), ","); // Field col_id
		if ($this->BasicSearch->Keyword <> "") {
			$sWrk = "\"" . EW_TABLE_BASIC_SEARCH . "\":\"" . ew_JsEncode2($this->BasicSearch->Keyword) . "\",\"" . EW_TABLE_BASIC_SEARCH_TYPE . "\":\"" . ew_JsEncode2($this->BasicSearch->Type) . "\"";
			$sFilterList = ew_Concat($sFilterList, $sWrk, ",");
		}
		$sFilterList = preg_replace('/,$/', "", $sFilterList);

		// Return filter list in json
		if ($sFilterList <> "")
			$sFilterList = "\"data\":{" . $sFilterList . "}";
		if ($sSavedFilterList <> "") {
			if ($sFilterList <> "")
				$sFilterList .= ",";
			$sFilterList .= "\"filters\":" . $sSavedFilterList;
		}
		return ($sFilterList <> "") ? "{" . $sFilterList . "}" : "null";
	}

	// Process filter list
	function ProcessFilterList() {
		global $UserProfile;
		if (@$_POST["ajax"] == "savefilters") { // Save filter request (Ajax)
			$filters = @$_POST["filters"];
			$UserProfile->SetSearchFilters(CurrentUserName(), "ftbl_productlistsrch", $filters);

			// Clean output buffer
			if (!EW_DEBUG_ENABLED && ob_get_length())
				ob_end_clean();
			echo ew_ArrayToJson(array(array("success" => TRUE))); // Success
			$this->Page_Terminate();
			exit();
		} elseif (@$_POST["cmd"] == "resetfilter") {
			$this->RestoreFilterList();
		}
	}

	// Restore list of filters
	function RestoreFilterList() {

		// Return if not reset filter
		if (@$_POST["cmd"] <> "resetfilter")
			return FALSE;
		$filter = json_decode(@$_POST["filter"], TRUE);
		$this->Command = "search";

		// Field pro_id
		$this->pro_id->AdvancedSearch->SearchValue = @$filter["x_pro_id"];
		$this->pro_id->AdvancedSearch->SearchOperator = @$filter["z_pro_id"];
		$this->pro_id->AdvancedSearch->SearchCondition = @$filter["v_pro_id"];
		$this->pro_id->AdvancedSearch->SearchValue2 = @$filter["y_pro_id"];
		$this->pro_id->AdvancedSearch->SearchOperator2 = @$filter["w_pro_id"];
		$this->pro_id->AdvancedSearch->Save();

		// Field pro_cat_id
		$this->pro_cat_id->AdvancedSearch->SearchValue = @$filter["x_pro_cat_id"];
		$this->pro_cat_id->AdvancedSearch->SearchOperator = @$filter["z_pro_cat_id"];
		$this->pro_cat_id->AdvancedSearch->SearchCondition = @$filter["v_pro_cat_id"];
		$this->pro_cat_id->AdvancedSearch->SearchValue2 = @$filter["y_pro_cat_id"];
		$this->pro_cat_id->AdvancedSearch->SearchOperator2 = @$filter["w_pro_cat_id"];
		$this->pro_cat_id->AdvancedSearch->Save();

		// Field pro_name
		$this->pro_name->AdvancedSearch->SearchValue = @$filter["x_pro_name"];
		$this->pro_name->AdvancedSearch->SearchOperator = @$filter["z_pro_name"];
		$this->pro_name->AdvancedSearch->SearchCondition = @$filter["v_pro_name"];
		$this->pro_name->AdvancedSearch->SearchValue2 = @$filter["y_pro_name"];
		$this->pro_name->AdvancedSearch->SearchOperator2 = @$filter["w_pro_name"];
		$this->pro_name->AdvancedSearch->Save();

		// Field pro_feature
		$this->pro_feature->AdvancedSearch->SearchValue = @$filter["x_pro_feature"];
		$this->pro_feature->AdvancedSearch->SearchOperator = @$filter["z_pro_feature"];
		$this->pro_feature->AdvancedSearch->SearchCondition = @$filter["v_pro_feature"];
		$this->pro_feature->AdvancedSearch->SearchValue2 = @$filter["y_pro_feature"];
		$this->pro_feature->AdvancedSearch->SearchOperator2 = @$filter["w_pro_feature"];
		$this->pro_feature->AdvancedSearch->Save();

		// Field pro_img_folder
		$this->pro_img_folder->AdvancedSearch->SearchValue = @$filter["x_pro_img_folder"];
		$this->pro_img_folder->AdvancedSearch->SearchOperator = @$filter["z_pro_img_folder"];
		$this->pro_img_folder->AdvancedSearch->SearchCondition = @$filter["v_pro_img_folder"];
		$this->pro_img_folder->AdvancedSearch->SearchValue2 = @$filter["y_pro_img_folder"];
		$this->pro_img_folder->AdvancedSearch->SearchOperator2 = @$filter["w_pro_img_folder"];
		$this->pro_img_folder->AdvancedSearch->Save();

		// Field pro_detail
		$this->pro_detail->AdvancedSearch->SearchValue = @$filter["x_pro_detail"];
		$this->pro_detail->AdvancedSearch->SearchOperator = @$filter["z_pro_detail"];
		$this->pro_detail->AdvancedSearch->SearchCondition = @$filter["v_pro_detail"];
		$this->pro_detail->AdvancedSearch->SearchValue2 = @$filter["y_pro_detail"];
		$this->pro_detail->AdvancedSearch->SearchOperator2 = @$filter["w_pro_detail"];
		$this->pro_detail->AdvancedSearch->Save();

		// Field price
		$this->price->AdvancedSearch->SearchValue = @$filter["x_price"];
		$this->price->AdvancedSearch->SearchOperator = @$filter["z_price"];
		$this->price->AdvancedSearch->SearchCondition = @$filter["v_price"];
		$this->price->AdvancedSearch->SearchValue2 = @$filter["y_price"];
		$this->price->AdvancedSearch->SearchOperator2 = @$filter["w_price"];
		$this->price->AdvancedSearch->Save();

		// Field pro_keyword
		$this->pro_keyword->AdvancedSearch->SearchValue = @$filter["x_pro_keyword"];
		$this->pro_keyword->AdvancedSearch->SearchOperator = @$filter["z_pro_keyword"];
		$this->pro_keyword->AdvancedSearch->SearchCondition = @$filter["v_pro_keyword"];
		$this->pro_keyword->AdvancedSearch->SearchValue2 = @$filter["y_pro_keyword"];
		$this->pro_keyword->AdvancedSearch->SearchOperator2 = @$filter["w_pro_keyword"];
		$this->pro_keyword->AdvancedSearch->Save();

		// Field pro_status
		$this->pro_status->AdvancedSearch->SearchValue = @$filter["x_pro_status"];
		$this->pro_status->AdvancedSearch->SearchOperator = @$filter["z_pro_status"];
		$this->pro_status->AdvancedSearch->SearchCondition = @$filter["v_pro_status"];
		$this->pro_status->AdvancedSearch->SearchValue2 = @$filter["y_pro_status"];
		$this->pro_status->AdvancedSearch->SearchOperator2 = @$filter["w_pro_status"];
		$this->pro_status->AdvancedSearch->Save();

		// Field col_id
		$this->col_id->AdvancedSearch->SearchValue = @$filter["x_col_id"];
		$this->col_id->AdvancedSearch->SearchOperator = @$filter["z_col_id"];
		$this->col_id->AdvancedSearch->SearchCondition = @$filter["v_col_id"];
		$this->col_id->AdvancedSearch->SearchValue2 = @$filter["y_col_id"];
		$this->col_id->AdvancedSearch->SearchOperator2 = @$filter["w_col_id"];
		$this->col_id->AdvancedSearch->Save();
		$this->BasicSearch->setKeyword(@$filter[EW_TABLE_BASIC_SEARCH]);
		$this->BasicSearch->setType(@$filter[EW_TABLE_BASIC_SEARCH_TYPE]);
	}

	// Advanced search WHERE clause based on QueryString
	function AdvancedSearchWhere($Default = FALSE) {
		global $Security;
		$sWhere = "";
		$this->BuildSearchSql($sWhere, $this->pro_id, $Default, FALSE); // pro_id
		$this->BuildSearchSql($sWhere, $this->pro_cat_id, $Default, FALSE); // pro_cat_id
		$this->BuildSearchSql($sWhere, $this->pro_name, $Default, FALSE); // pro_name
		$this->BuildSearchSql($sWhere, $this->pro_feature, $Default, FALSE); // pro_feature
		$this->BuildSearchSql($sWhere, $this->pro_img_folder, $Default, FALSE); // pro_img_folder
		$this->BuildSearchSql($sWhere, $this->pro_detail, $Default, FALSE); // pro_detail
		$this->BuildSearchSql($sWhere, $this->price, $Default, FALSE); // price
		$this->BuildSearchSql($sWhere, $this->pro_keyword, $Default, FALSE); // pro_keyword
		$this->BuildSearchSql($sWhere, $this->pro_status, $Default, FALSE); // pro_status
		$this->BuildSearchSql($sWhere, $this->col_id, $Default, FALSE); // col_id

		// Set up search parm
		if (!$Default && $sWhere <> "" && in_array($this->Command, array("", "reset", "resetall"))) {
			$this->Command = "search";
		}
		if (!$Default && $this->Command == "search") {
			$this->pro_id->AdvancedSearch->Save(); // pro_id
			$this->pro_cat_id->AdvancedSearch->Save(); // pro_cat_id
			$this->pro_name->AdvancedSearch->Save(); // pro_name
			$this->pro_feature->AdvancedSearch->Save(); // pro_feature
			$this->pro_img_folder->AdvancedSearch->Save(); // pro_img_folder
			$this->pro_detail->AdvancedSearch->Save(); // pro_detail
			$this->price->AdvancedSearch->Save(); // price
			$this->pro_keyword->AdvancedSearch->Save(); // pro_keyword
			$this->pro_status->AdvancedSearch->Save(); // pro_status
			$this->col_id->AdvancedSearch->Save(); // col_id
		}
		return $sWhere;
	}

	// Build search SQL
	function BuildSearchSql(&$Where, &$Fld, $Default, $MultiValue) {
		$FldParm = $Fld->FldParm();
		$FldVal = ($Default) ? $Fld->AdvancedSearch->SearchValueDefault : $Fld->AdvancedSearch->SearchValue; // @$_GET["x_$FldParm"]
		$FldOpr = ($Default) ? $Fld->AdvancedSearch->SearchOperatorDefault : $Fld->AdvancedSearch->SearchOperator; // @$_GET["z_$FldParm"]
		$FldCond = ($Default) ? $Fld->AdvancedSearch->SearchConditionDefault : $Fld->AdvancedSearch->SearchCondition; // @$_GET["v_$FldParm"]
		$FldVal2 = ($Default) ? $Fld->AdvancedSearch->SearchValue2Default : $Fld->AdvancedSearch->SearchValue2; // @$_GET["y_$FldParm"]
		$FldOpr2 = ($Default) ? $Fld->AdvancedSearch->SearchOperator2Default : $Fld->AdvancedSearch->SearchOperator2; // @$_GET["w_$FldParm"]
		$sWrk = "";
		if (is_array($FldVal)) $FldVal = implode(",", $FldVal);
		if (is_array($FldVal2)) $FldVal2 = implode(",", $FldVal2);
		$FldOpr = strtoupper(trim($FldOpr));
		if ($FldOpr == "") $FldOpr = "=";
		$FldOpr2 = strtoupper(trim($FldOpr2));
		if ($FldOpr2 == "") $FldOpr2 = "=";
		if (EW_SEARCH_MULTI_VALUE_OPTION == 1)
			$MultiValue = FALSE;
		if ($MultiValue) {
			$sWrk1 = ($FldVal <> "") ? ew_GetMultiSearchSql($Fld, $FldOpr, $FldVal, $this->DBID) : ""; // Field value 1
			$sWrk2 = ($FldVal2 <> "") ? ew_GetMultiSearchSql($Fld, $FldOpr2, $FldVal2, $this->DBID) : ""; // Field value 2
			$sWrk = $sWrk1; // Build final SQL
			if ($sWrk2 <> "")
				$sWrk = ($sWrk <> "") ? "($sWrk) $FldCond ($sWrk2)" : $sWrk2;
		} else {
			$FldVal = $this->ConvertSearchValue($Fld, $FldVal);
			$FldVal2 = $this->ConvertSearchValue($Fld, $FldVal2);
			$sWrk = ew_GetSearchSql($Fld, $FldVal, $FldOpr, $FldCond, $FldVal2, $FldOpr2, $this->DBID);
		}
		ew_AddFilter($Where, $sWrk);
	}

	// Convert search value
	function ConvertSearchValue(&$Fld, $FldVal) {
		if ($FldVal == EW_NULL_VALUE || $FldVal == EW_NOT_NULL_VALUE)
			return $FldVal;
		$Value = $FldVal;
		if ($Fld->FldDataType == EW_DATATYPE_BOOLEAN) {
			if ($FldVal <> "") $Value = ($FldVal == "1" || strtolower(strval($FldVal)) == "y" || strtolower(strval($FldVal)) == "t") ? $Fld->TrueValue : $Fld->FalseValue;
		} elseif ($Fld->FldDataType == EW_DATATYPE_DATE || $Fld->FldDataType == EW_DATATYPE_TIME) {
			if ($FldVal <> "") $Value = ew_UnFormatDateTime($FldVal, $Fld->FldDateTimeFormat);
		}
		return $Value;
	}

	// Return basic search SQL
	function BasicSearchSQL($arKeywords, $type) {
		$sWhere = "";
		$this->BuildBasicSearchSQL($sWhere, $this->pro_name, $arKeywords, $type);
		$this->BuildBasicSearchSQL($sWhere, $this->pro_feature, $arKeywords, $type);
		$this->BuildBasicSearchSQL($sWhere, $this->pro_img_folder, $arKeywords, $type);
		$this->BuildBasicSearchSQL($sWhere, $this->pro_detail, $arKeywords, $type);
		$this->BuildBasicSearchSQL($sWhere, $this->price, $arKeywords, $type);
		$this->BuildBasicSearchSQL($sWhere, $this->pro_keyword, $arKeywords, $type);
		return $sWhere;
	}

	// Build basic search SQL
	function BuildBasicSearchSQL(&$Where, &$Fld, $arKeywords, $type) {
		global $EW_BASIC_SEARCH_IGNORE_PATTERN;
		$sDefCond = ($type == "OR") ? "OR" : "AND";
		$arSQL = array(); // Array for SQL parts
		$arCond = array(); // Array for search conditions
		$cnt = count($arKeywords);
		$j = 0; // Number of SQL parts
		for ($i = 0; $i < $cnt; $i++) {
			$Keyword = $arKeywords[$i];
			$Keyword = trim($Keyword);
			if ($EW_BASIC_SEARCH_IGNORE_PATTERN <> "") {
				$Keyword = preg_replace($EW_BASIC_SEARCH_IGNORE_PATTERN, "\\", $Keyword);
				$ar = explode("\\", $Keyword);
			} else {
				$ar = array($Keyword);
			}
			foreach ($ar as $Keyword) {
				if ($Keyword <> "") {
					$sWrk = "";
					if ($Keyword == "OR" && $type == "") {
						if ($j > 0)
							$arCond[$j-1] = "OR";
					} elseif ($Keyword == EW_NULL_VALUE) {
						$sWrk = $Fld->FldExpression . " IS NULL";
					} elseif ($Keyword == EW_NOT_NULL_VALUE) {
						$sWrk = $Fld->FldExpression . " IS NOT NULL";
					} elseif ($Fld->FldIsVirtual) {
						$sWrk = $Fld->FldVirtualExpression . ew_Like(ew_QuotedValue("%" . $Keyword . "%", EW_DATATYPE_STRING, $this->DBID), $this->DBID);
					} elseif ($Fld->FldDataType != EW_DATATYPE_NUMBER || is_numeric($Keyword)) {
						$sWrk = $Fld->FldBasicSearchExpression . ew_Like(ew_QuotedValue("%" . $Keyword . "%", EW_DATATYPE_STRING, $this->DBID), $this->DBID);
					}
					if ($sWrk <> "") {
						$arSQL[$j] = $sWrk;
						$arCond[$j] = $sDefCond;
						$j += 1;
					}
				}
			}
		}
		$cnt = count($arSQL);
		$bQuoted = FALSE;
		$sSql = "";
		if ($cnt > 0) {
			for ($i = 0; $i < $cnt-1; $i++) {
				if ($arCond[$i] == "OR") {
					if (!$bQuoted) $sSql .= "(";
					$bQuoted = TRUE;
				}
				$sSql .= $arSQL[$i];
				if ($bQuoted && $arCond[$i] <> "OR") {
					$sSql .= ")";
					$bQuoted = FALSE;
				}
				$sSql .= " " . $arCond[$i] . " ";
			}
			$sSql .= $arSQL[$cnt-1];
			if ($bQuoted)
				$sSql .= ")";
		}
		if ($sSql <> "") {
			if ($Where <> "") $Where .= " OR ";
			$Where .= "(" . $sSql . ")";
		}
	}

	// Return basic search WHERE clause based on search keyword and type
	function BasicSearchWhere($Default = FALSE) {
		global $Security;
		$sSearchStr = "";
		$sSearchKeyword = ($Default) ? $this->BasicSearch->KeywordDefault : $this->BasicSearch->Keyword;
		$sSearchType = ($Default) ? $this->BasicSearch->TypeDefault : $this->BasicSearch->Type;

		// Get search SQL
		if ($sSearchKeyword <> "") {
			$ar = $this->BasicSearch->KeywordList($Default);

			// Search keyword in any fields
			if (($sSearchType == "OR" || $sSearchType == "AND") && $this->BasicSearch->BasicSearchAnyFields) {
				foreach ($ar as $sKeyword) {
					if ($sKeyword <> "") {
						if ($sSearchStr <> "") $sSearchStr .= " " . $sSearchType . " ";
						$sSearchStr .= "(" . $this->BasicSearchSQL(array($sKeyword), $sSearchType) . ")";
					}
				}
			} else {
				$sSearchStr = $this->BasicSearchSQL($ar, $sSearchType);
			}
			if (!$Default && in_array($this->Command, array("", "reset", "resetall"))) $this->Command = "search";
		}
		if (!$Default && $this->Command == "search") {
			$this->BasicSearch->setKeyword($sSearchKeyword);
			$this->BasicSearch->setType($sSearchType);
		}
		return $sSearchStr;
	}

	// Check if search parm exists
	function CheckSearchParms() {

		// Check basic search
		if ($this->BasicSearch->IssetSession())
			return TRUE;
		if ($this->pro_id->AdvancedSearch->IssetSession())
			return TRUE;
		if ($this->pro_cat_id->AdvancedSearch->IssetSession())
			return TRUE;
		if ($this->pro_name->AdvancedSearch->IssetSession())
			return TRUE;
		if ($this->pro_feature->AdvancedSearch->IssetSession())
			return TRUE;
		if ($this->pro_img_folder->AdvancedSearch->IssetSession())
			return TRUE;
		if ($this->pro_detail->AdvancedSearch->IssetSession())
			return TRUE;
		if ($this->price->AdvancedSearch->IssetSession())
			return TRUE;
		if ($this->pro_keyword->AdvancedSearch->IssetSession())
			return TRUE;
		if ($this->pro_status->AdvancedSearch->IssetSession())
			return TRUE;
		if ($this->col_id->AdvancedSearch->IssetSession())
			return TRUE;
		return FALSE;
	}

	// Clear all search parameters
	function ResetSearchParms() {

		// Clear search WHERE clause
		$this->SearchWhere = "";
		$this->setSearchWhere($this->SearchWhere);

		// Clear basic search parameters
		$this->ResetBasicSearchParms();

		// Clear advanced search parameters
		$this->ResetAdvancedSearchParms();
	}

	// Load advanced search default values
	function LoadAdvancedSearchDefault() {
		return FALSE;
	}

	// Clear all basic search parameters
	function ResetBasicSearchParms() {
		$this->BasicSearch->UnsetSession();
	}

	// Clear all advanced search parameters
	function ResetAdvancedSearchParms() {
		$this->pro_id->AdvancedSearch->UnsetSession();
		$this->pro_cat_id->AdvancedSearch->UnsetSession();
		$this->pro_name->AdvancedSearch->UnsetSession();
		$this->pro_feature->AdvancedSearch->UnsetSession();
		$this->pro_img_folder->AdvancedSearch->UnsetSession();
		$this->pro_detail->AdvancedSearch->UnsetSession();
		$this->price->AdvancedSearch->UnsetSession();
		$this->pro_keyword->AdvancedSearch->UnsetSession();
		$this->pro_status->AdvancedSearch->UnsetSession();
		$this->col_id->AdvancedSearch->UnsetSession();
	}

	// Restore all search parameters
	function RestoreSearchParms() {
		$this->RestoreSearch = TRUE;

		// Restore basic search values
		$this->BasicSearch->Load();

		// Restore advanced search values
		$this->pro_id->AdvancedSearch->Load();
		$this->pro_cat_id->AdvancedSearch->Load();
		$this->pro_name->AdvancedSearch->Load();
		$this->pro_feature->AdvancedSearch->Load();
		$this->pro_img_folder->AdvancedSearch->Load();
		$this->pro_detail->AdvancedSearch->Load();
		$this->price->AdvancedSearch->Load();
		$this->pro_keyword->AdvancedSearch->Load();
		$this->pro_status->AdvancedSearch->Load();
		$this->col_id->AdvancedSearch->Load();
	}

	// Set up sort parameters
	function SetupSortOrder() {

		// Check for "order" parameter
		if (@$_GET["order"] <> "") {
			$this->CurrentOrder = @$_GET["order"];
			$this->CurrentOrderType = @$_GET["ordertype"];
			$this->UpdateSort($this->pro_id); // pro_id
			$this->UpdateSort($this->pro_cat_id); // pro_cat_id
			$this->UpdateSort($this->pro_name); // pro_name
			$this->UpdateSort($this->pro_feature); // pro_feature
			$this->UpdateSort($this->pro_img_folder); // pro_img_folder
			$this->UpdateSort($this->price); // price
			$this->UpdateSort($this->pro_keyword); // pro_keyword
			$this->UpdateSort($this->pro_status); // pro_status
			$this->UpdateSort($this->col_id); // col_id
			$this->setStartRecordNumber(1); // Reset start position
		}
	}

	// Load sort order parameters
	function LoadSortOrder() {
		$sOrderBy = $this->getSessionOrderBy(); // Get ORDER BY from Session
		if ($sOrderBy == "") {
			if ($this->getSqlOrderBy() <> "") {
				$sOrderBy = $this->getSqlOrderBy();
				$this->setSessionOrderBy($sOrderBy);
			}
		}
	}

	// Reset command
	// - cmd=reset (Reset search parameters)
	// - cmd=resetall (Reset search and master/detail parameters)
	// - cmd=resetsort (Reset sort parameters)
	function ResetCmd() {

		// Check if reset command
		if (substr($this->Command,0,5) == "reset") {

			// Reset search criteria
			if ($this->Command == "reset" || $this->Command == "resetall")
				$this->ResetSearchParms();

			// Reset sorting order
			if ($this->Command == "resetsort") {
				$sOrderBy = "";
				$this->setSessionOrderBy($sOrderBy);
				$this->pro_id->setSort("");
				$this->pro_cat_id->setSort("");
				$this->pro_name->setSort("");
				$this->pro_feature->setSort("");
				$this->pro_img_folder->setSort("");
				$this->price->setSort("");
				$this->pro_keyword->setSort("");
				$this->pro_status->setSort("");
				$this->col_id->setSort("");
			}

			// Reset start position
			$this->StartRec = 1;
			$this->setStartRecordNumber($this->StartRec);
		}
	}

	// Set up list options
	function SetupListOptions() {
		global $Security, $Language;

		// Add group option item
		$item = &$this->ListOptions->Add($this->ListOptions->GroupOptionName);
		$item->Body = "";
		$item->OnLeft = FALSE;
		$item->Visible = FALSE;

		// "view"
		$item = &$this->ListOptions->Add("view");
		$item->CssClass = "text-nowrap";
		$item->Visible = $Security->IsLoggedIn();
		$item->OnLeft = FALSE;

		// "edit"
		$item = &$this->ListOptions->Add("edit");
		$item->CssClass = "text-nowrap";
		$item->Visible = $Security->IsLoggedIn();
		$item->OnLeft = FALSE;

		// "copy"
		$item = &$this->ListOptions->Add("copy");
		$item->CssClass = "text-nowrap";
		$item->Visible = $Security->IsLoggedIn();
		$item->OnLeft = FALSE;

		// "delete"
		$item = &$this->ListOptions->Add("delete");
		$item->CssClass = "text-nowrap";
		$item->Visible = $Security->IsLoggedIn();
		$item->OnLeft = FALSE;

		// List actions
		$item = &$this->ListOptions->Add("listactions");
		$item->CssClass = "text-nowrap";
		$item->OnLeft = FALSE;
		$item->Visible = FALSE;
		$item->ShowInButtonGroup = FALSE;
		$item->ShowInDropDown = FALSE;

		// "checkbox"
		$item = &$this->ListOptions->Add("checkbox");
		$item->Visible = FALSE;
		$item->OnLeft = FALSE;
		$item->Header = "<input type=\"checkbox\" name=\"key\" id=\"key\" onclick=\"ew_SelectAllKey(this);\">";
		$item->ShowInDropDown = FALSE;
		$item->ShowInButtonGroup = FALSE;

		// Drop down button for ListOptions
		$this->ListOptions->UseImageAndText = TRUE;
		$this->ListOptions->UseDropDownButton = FALSE;
		$this->ListOptions->DropDownButtonPhrase = $Language->Phrase("ButtonListOptions");
		$this->ListOptions->UseButtonGroup = FALSE;
		if ($this->ListOptions->UseButtonGroup && ew_IsMobile())
			$this->ListOptions->UseDropDownButton = TRUE;
		$this->ListOptions->ButtonClass = "btn-sm"; // Class for button group

		// Call ListOptions_Load event
		$this->ListOptions_Load();
		$this->SetupListOptionsExt();
		$item = &$this->ListOptions->GetItem($this->ListOptions->GroupOptionName);
		$item->Visible = $this->ListOptions->GroupOptionVisible();
	}

	// Render list options
	function RenderListOptions() {
		global $Security, $Language, $objForm;
		$this->ListOptions->LoadDefault();

		// Call ListOptions_Rendering event
		$this->ListOptions_Rendering();

		// "view"
		$oListOpt = &$this->ListOptions->Items["view"];
		$viewcaption = ew_HtmlTitle($Language->Phrase("ViewLink"));
		if ($Security->IsLoggedIn()) {
			$oListOpt->Body = "<a class=\"ewRowLink ewView\" title=\"" . $viewcaption . "\" data-caption=\"" . $viewcaption . "\" href=\"" . ew_HtmlEncode($this->ViewUrl) . "\">" . $Language->Phrase("ViewLink") . "</a>";
		} else {
			$oListOpt->Body = "";
		}

		// "edit"
		$oListOpt = &$this->ListOptions->Items["edit"];
		$editcaption = ew_HtmlTitle($Language->Phrase("EditLink"));
		if ($Security->IsLoggedIn()) {
			$oListOpt->Body = "<a class=\"ewRowLink ewEdit\" title=\"" . ew_HtmlTitle($Language->Phrase("EditLink")) . "\" data-caption=\"" . ew_HtmlTitle($Language->Phrase("EditLink")) . "\" href=\"" . ew_HtmlEncode($this->EditUrl) . "\">" . $Language->Phrase("EditLink") . "</a>";
		} else {
			$oListOpt->Body = "";
		}

		// "copy"
		$oListOpt = &$this->ListOptions->Items["copy"];
		$copycaption = ew_HtmlTitle($Language->Phrase("CopyLink"));
		if ($Security->IsLoggedIn()) {
			$oListOpt->Body = "<a class=\"ewRowLink ewCopy\" title=\"" . $copycaption . "\" data-caption=\"" . $copycaption . "\" href=\"" . ew_HtmlEncode($this->CopyUrl) . "\">" . $Language->Phrase("CopyLink") . "</a>";
		} else {
			$oListOpt->Body = "";
		}

		// "delete"
		$oListOpt = &$this->ListOptions->Items["delete"];
		if ($Security->IsLoggedIn())
			$oListOpt->Body = "<a class=\"ewRowLink ewDelete\"" . "" . " title=\"" . ew_HtmlTitle($Language->Phrase("DeleteLink")) . "\" data-caption=\"" . ew_HtmlTitle($Language->Phrase("DeleteLink")) . "\" href=\"" . ew_HtmlEncode($this->DeleteUrl) . "\">" . $Language->Phrase("DeleteLink") . "</a>";
		else
			$oListOpt->Body = "";

		// Set up list action buttons
		$oListOpt = &$this->ListOptions->GetItem("listactions");
		if ($oListOpt && $this->Export == "" && $this->CurrentAction == "") {
			$body = "";
			$links = array();
			foreach ($this->ListActions->Items as $listaction) {
				if ($listaction->Select == EW_ACTION_SINGLE && $listaction->Allow) {
					$action = $listaction->Action;
					$caption = $listaction->Caption;
					$icon = ($listaction->Icon <> "") ? "<span class=\"" . ew_HtmlEncode(str_replace(" ewIcon", "", $listaction->Icon)) . "\" data-caption=\"" . ew_HtmlTitle($caption) . "\"></span> " : "";
					$links[] = "<li><a class=\"ewAction ewListAction\" data-action=\"" . ew_HtmlEncode($action) . "\" data-caption=\"" . ew_HtmlTitle($caption) . "\" href=\"\" onclick=\"ew_SubmitAction(event,jQuery.extend({key:" . $this->KeyToJson() . "}," . $listaction->ToJson(TRUE) . "));return false;\">" . $icon . $listaction->Caption . "</a></li>";
					if (count($links) == 1) // Single button
						$body = "<a class=\"ewAction ewListAction\" data-action=\"" . ew_HtmlEncode($action) . "\" title=\"" . ew_HtmlTitle($caption) . "\" data-caption=\"" . ew_HtmlTitle($caption) . "\" href=\"\" onclick=\"ew_SubmitAction(event,jQuery.extend({key:" . $this->KeyToJson() . "}," . $listaction->ToJson(TRUE) . "));return false;\">" . $Language->Phrase("ListActionButton") . "</a>";
				}
			}
			if (count($links) > 1) { // More than one buttons, use dropdown
				$body = "<button class=\"dropdown-toggle btn btn-default btn-sm ewActions\" title=\"" . ew_HtmlTitle($Language->Phrase("ListActionButton")) . "\" data-toggle=\"dropdown\">" . $Language->Phrase("ListActionButton") . "<b class=\"caret\"></b></button>";
				$content = "";
				foreach ($links as $link)
					$content .= "<li>" . $link . "</li>";
				$body .= "<ul class=\"dropdown-menu" . ($oListOpt->OnLeft ? "" : " dropdown-menu-right") . "\">". $content . "</ul>";
				$body = "<div class=\"btn-group\">" . $body . "</div>";
			}
			if (count($links) > 0) {
				$oListOpt->Body = $body;
				$oListOpt->Visible = TRUE;
			}
		}

		// "checkbox"
		$oListOpt = &$this->ListOptions->Items["checkbox"];
		$oListOpt->Body = "<input type=\"checkbox\" name=\"key_m[]\" class=\"ewMultiSelect\" value=\"" . ew_HtmlEncode($this->pro_id->CurrentValue) . "\" onclick=\"ew_ClickMultiCheckbox(event);\">";
		$this->RenderListOptionsExt();

		// Call ListOptions_Rendered event
		$this->ListOptions_Rendered();
	}

	// Set up other options
	function SetupOtherOptions() {
		global $Language, $Security;
		$options = &$this->OtherOptions;
		$option = $options["addedit"];

		// Add
		$item = &$option->Add("add");
		$addcaption = ew_HtmlTitle($Language->Phrase("AddLink"));
		$item->Body = "<a class=\"ewAddEdit ewAdd\" title=\"" . $addcaption . "\" data-caption=\"" . $addcaption . "\" href=\"" . ew_HtmlEncode($this->AddUrl) . "\">" . $Language->Phrase("AddLink") . "</a>";
		$item->Visible = ($this->AddUrl <> "" && $Security->IsLoggedIn());
		$option = $options["action"];

		// Set up options default
		foreach ($options as &$option) {
			$option->UseImageAndText = TRUE;
			$option->UseDropDownButton = FALSE;
			$option->UseButtonGroup = TRUE;
			$option->ButtonClass = "btn-sm"; // Class for button group
			$item = &$option->Add($option->GroupOptionName);
			$item->Body = "";
			$item->Visible = FALSE;
		}
		$options["addedit"]->DropDownButtonPhrase = $Language->Phrase("ButtonAddEdit");
		$options["detail"]->DropDownButtonPhrase = $Language->Phrase("ButtonDetails");
		$options["action"]->DropDownButtonPhrase = $Language->Phrase("ButtonActions");

		// Filter button
		$item = &$this->FilterOptions->Add("savecurrentfilter");
		$item->Body = "<a class=\"ewSaveFilter\" data-form=\"ftbl_productlistsrch\" href=\"#\">" . $Language->Phrase("SaveCurrentFilter") . "</a>";
		$item->Visible = TRUE;
		$item = &$this->FilterOptions->Add("deletefilter");
		$item->Body = "<a class=\"ewDeleteFilter\" data-form=\"ftbl_productlistsrch\" href=\"#\">" . $Language->Phrase("DeleteFilter") . "</a>";
		$item->Visible = TRUE;
		$this->FilterOptions->UseDropDownButton = TRUE;
		$this->FilterOptions->UseButtonGroup = !$this->FilterOptions->UseDropDownButton;
		$this->FilterOptions->DropDownButtonPhrase = $Language->Phrase("Filters");

		// Add group option item
		$item = &$this->FilterOptions->Add($this->FilterOptions->GroupOptionName);
		$item->Body = "";
		$item->Visible = FALSE;
	}

	// Render other options
	function RenderOtherOptions() {
		global $Language, $Security;
		$options = &$this->OtherOptions;
			$option = &$options["action"];

			// Set up list action buttons
			foreach ($this->ListActions->Items as $listaction) {
				if ($listaction->Select == EW_ACTION_MULTIPLE) {
					$item = &$option->Add("custom_" . $listaction->Action);
					$caption = $listaction->Caption;
					$icon = ($listaction->Icon <> "") ? "<span class=\"" . ew_HtmlEncode($listaction->Icon) . "\" data-caption=\"" . ew_HtmlEncode($caption) . "\"></span> " : $caption;
					$item->Body = "<a class=\"ewAction ewListAction\" title=\"" . ew_HtmlEncode($caption) . "\" data-caption=\"" . ew_HtmlEncode($caption) . "\" href=\"\" onclick=\"ew_SubmitAction(event,jQuery.extend({f:document.ftbl_productlist}," . $listaction->ToJson(TRUE) . "));return false;\">" . $icon . "</a>";
					$item->Visible = $listaction->Allow;
				}
			}

			// Hide grid edit and other options
			if ($this->TotalRecs <= 0) {
				$option = &$options["addedit"];
				$item = &$option->GetItem("gridedit");
				if ($item) $item->Visible = FALSE;
				$option = &$options["action"];
				$option->HideAllOptions();
			}
	}

	// Process list action
	function ProcessListAction() {
		global $Language, $Security;
		$userlist = "";
		$user = "";
		$sFilter = $this->GetKeyFilter();
		$UserAction = @$_POST["useraction"];
		if ($sFilter <> "" && $UserAction <> "") {

			// Check permission first
			$ActionCaption = $UserAction;
			if (array_key_exists($UserAction, $this->ListActions->Items)) {
				$ActionCaption = $this->ListActions->Items[$UserAction]->Caption;
				if (!$this->ListActions->Items[$UserAction]->Allow) {
					$errmsg = str_replace('%s', $ActionCaption, $Language->Phrase("CustomActionNotAllowed"));
					if (@$_POST["ajax"] == $UserAction) // Ajax
						echo "<p class=\"text-danger\">" . $errmsg . "</p>";
					else
						$this->setFailureMessage($errmsg);
					return FALSE;
				}
			}
			$this->CurrentFilter = $sFilter;
			$sSql = $this->SQL();
			$conn = &$this->Connection();
			$conn->raiseErrorFn = $GLOBALS["EW_ERROR_FN"];
			$rs = $conn->Execute($sSql);
			$conn->raiseErrorFn = '';
			$this->CurrentAction = $UserAction;

			// Call row action event
			if ($rs && !$rs->EOF) {
				$conn->BeginTrans();
				$this->SelectedCount = $rs->RecordCount();
				$this->SelectedIndex = 0;
				while (!$rs->EOF) {
					$this->SelectedIndex++;
					$row = $rs->fields;
					$Processed = $this->Row_CustomAction($UserAction, $row);
					if (!$Processed) break;
					$rs->MoveNext();
				}
				if ($Processed) {
					$conn->CommitTrans(); // Commit the changes
					if ($this->getSuccessMessage() == "")
						$this->setSuccessMessage(str_replace('%s', $ActionCaption, $Language->Phrase("CustomActionCompleted"))); // Set up success message
				} else {
					$conn->RollbackTrans(); // Rollback changes

					// Set up error message
					if ($this->getSuccessMessage() <> "" || $this->getFailureMessage() <> "") {

						// Use the message, do nothing
					} elseif ($this->CancelMessage <> "") {
						$this->setFailureMessage($this->CancelMessage);
						$this->CancelMessage = "";
					} else {
						$this->setFailureMessage(str_replace('%s', $ActionCaption, $Language->Phrase("CustomActionFailed")));
					}
				}
			}
			if ($rs)
				$rs->Close();
			$this->CurrentAction = ""; // Clear action
			if (@$_POST["ajax"] == $UserAction) { // Ajax
				if ($this->getSuccessMessage() <> "") {
					echo "<p class=\"text-success\">" . $this->getSuccessMessage() . "</p>";
					$this->ClearSuccessMessage(); // Clear message
				}
				if ($this->getFailureMessage() <> "") {
					echo "<p class=\"text-danger\">" . $this->getFailureMessage() . "</p>";
					$this->ClearFailureMessage(); // Clear message
				}
				return TRUE;
			}
		}
		return FALSE; // Not ajax request
	}

	// Set up search options
	function SetupSearchOptions() {
		global $Language;
		$this->SearchOptions = new cListOptions();
		$this->SearchOptions->Tag = "div";
		$this->SearchOptions->TagClassName = "ewSearchOption";

		// Search button
		$item = &$this->SearchOptions->Add("searchtoggle");
		$SearchToggleClass = ($this->SearchWhere <> "") ? " active" : " active";
		$item->Body = "<button type=\"button\" class=\"btn btn-default ewSearchToggle" . $SearchToggleClass . "\" title=\"" . $Language->Phrase("SearchPanel") . "\" data-caption=\"" . $Language->Phrase("SearchPanel") . "\" data-toggle=\"button\" data-form=\"ftbl_productlistsrch\">" . $Language->Phrase("SearchLink") . "</button>";
		$item->Visible = TRUE;

		// Show all button
		$item = &$this->SearchOptions->Add("showall");
		$item->Body = "<a class=\"btn btn-default ewShowAll\" title=\"" . $Language->Phrase("ShowAll") . "\" data-caption=\"" . $Language->Phrase("ShowAll") . "\" href=\"" . $this->PageUrl() . "cmd=reset\">" . $Language->Phrase("ShowAllBtn") . "</a>";
		$item->Visible = ($this->SearchWhere <> $this->DefaultSearchWhere && $this->SearchWhere <> "0=101");

		// Button group for search
		$this->SearchOptions->UseDropDownButton = FALSE;
		$this->SearchOptions->UseImageAndText = TRUE;
		$this->SearchOptions->UseButtonGroup = TRUE;
		$this->SearchOptions->DropDownButtonPhrase = $Language->Phrase("ButtonSearch");

		// Add group option item
		$item = &$this->SearchOptions->Add($this->SearchOptions->GroupOptionName);
		$item->Body = "";
		$item->Visible = FALSE;

		// Hide search options
		if ($this->Export <> "" || $this->CurrentAction <> "")
			$this->SearchOptions->HideAllOptions();
	}

	function SetupListOptionsExt() {
		global $Security, $Language;
	}

	function RenderListOptionsExt() {
		global $Security, $Language;
	}

	// Set up starting record parameters
	function SetupStartRec() {
		if ($this->DisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->StartRec = $_GET[EW_TABLE_START_REC];
				$this->setStartRecordNumber($this->StartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$PageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($PageNo)) {
					$this->StartRec = ($PageNo-1)*$this->DisplayRecs+1;
					if ($this->StartRec <= 0) {
						$this->StartRec = 1;
					} elseif ($this->StartRec >= intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1) {
						$this->StartRec = intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1;
					}
					$this->setStartRecordNumber($this->StartRec);
				}
			}
		}
		$this->StartRec = $this->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->StartRec) || $this->StartRec == "") { // Avoid invalid start record counter
			$this->StartRec = 1; // Reset start record counter
			$this->setStartRecordNumber($this->StartRec);
		} elseif (intval($this->StartRec) > intval($this->TotalRecs)) { // Avoid starting record > total records
			$this->StartRec = intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1; // Point to last page first record
			$this->setStartRecordNumber($this->StartRec);
		} elseif (($this->StartRec-1) % $this->DisplayRecs <> 0) {
			$this->StartRec = intval(($this->StartRec-1)/$this->DisplayRecs)*$this->DisplayRecs+1; // Point to page boundary
			$this->setStartRecordNumber($this->StartRec);
		}
	}

	// Load basic search values
	function LoadBasicSearchValues() {
		$this->BasicSearch->Keyword = @$_GET[EW_TABLE_BASIC_SEARCH];
		if ($this->BasicSearch->Keyword <> "" && $this->Command == "") $this->Command = "search";
		$this->BasicSearch->Type = @$_GET[EW_TABLE_BASIC_SEARCH_TYPE];
	}

	// Load search values for validation
	function LoadSearchValues() {
		global $objForm;

		// Load search values
		// pro_id

		$this->pro_id->AdvancedSearch->SearchValue = @$_GET["x_pro_id"];
		if ($this->pro_id->AdvancedSearch->SearchValue <> "" && $this->Command == "") $this->Command = "search";
		$this->pro_id->AdvancedSearch->SearchOperator = @$_GET["z_pro_id"];

		// pro_cat_id
		$this->pro_cat_id->AdvancedSearch->SearchValue = @$_GET["x_pro_cat_id"];
		if ($this->pro_cat_id->AdvancedSearch->SearchValue <> "" && $this->Command == "") $this->Command = "search";
		$this->pro_cat_id->AdvancedSearch->SearchOperator = @$_GET["z_pro_cat_id"];

		// pro_name
		$this->pro_name->AdvancedSearch->SearchValue = @$_GET["x_pro_name"];
		if ($this->pro_name->AdvancedSearch->SearchValue <> "" && $this->Command == "") $this->Command = "search";
		$this->pro_name->AdvancedSearch->SearchOperator = @$_GET["z_pro_name"];

		// pro_feature
		$this->pro_feature->AdvancedSearch->SearchValue = @$_GET["x_pro_feature"];
		if ($this->pro_feature->AdvancedSearch->SearchValue <> "" && $this->Command == "") $this->Command = "search";
		$this->pro_feature->AdvancedSearch->SearchOperator = @$_GET["z_pro_feature"];

		// pro_img_folder
		$this->pro_img_folder->AdvancedSearch->SearchValue = @$_GET["x_pro_img_folder"];
		if ($this->pro_img_folder->AdvancedSearch->SearchValue <> "" && $this->Command == "") $this->Command = "search";
		$this->pro_img_folder->AdvancedSearch->SearchOperator = @$_GET["z_pro_img_folder"];

		// pro_detail
		$this->pro_detail->AdvancedSearch->SearchValue = @$_GET["x_pro_detail"];
		if ($this->pro_detail->AdvancedSearch->SearchValue <> "" && $this->Command == "") $this->Command = "search";
		$this->pro_detail->AdvancedSearch->SearchOperator = @$_GET["z_pro_detail"];

		// price
		$this->price->AdvancedSearch->SearchValue = @$_GET["x_price"];
		if ($this->price->AdvancedSearch->SearchValue <> "" && $this->Command == "") $this->Command = "search";
		$this->price->AdvancedSearch->SearchOperator = @$_GET["z_price"];

		// pro_keyword
		$this->pro_keyword->AdvancedSearch->SearchValue = @$_GET["x_pro_keyword"];
		if ($this->pro_keyword->AdvancedSearch->SearchValue <> "" && $this->Command == "") $this->Command = "search";
		$this->pro_keyword->AdvancedSearch->SearchOperator = @$_GET["z_pro_keyword"];

		// pro_status
		$this->pro_status->AdvancedSearch->SearchValue = @$_GET["x_pro_status"];
		if ($this->pro_status->AdvancedSearch->SearchValue <> "" && $this->Command == "") $this->Command = "search";
		$this->pro_status->AdvancedSearch->SearchOperator = @$_GET["z_pro_status"];
		if (is_array($this->pro_status->AdvancedSearch->SearchValue)) $this->pro_status->AdvancedSearch->SearchValue = implode(",", $this->pro_status->AdvancedSearch->SearchValue);
		if (is_array($this->pro_status->AdvancedSearch->SearchValue2)) $this->pro_status->AdvancedSearch->SearchValue2 = implode(",", $this->pro_status->AdvancedSearch->SearchValue2);

		// col_id
		$this->col_id->AdvancedSearch->SearchValue = @$_GET["x_col_id"];
		if ($this->col_id->AdvancedSearch->SearchValue <> "" && $this->Command == "") $this->Command = "search";
		$this->col_id->AdvancedSearch->SearchOperator = @$_GET["z_col_id"];
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {

		// Load List page SQL
		$sSql = $this->ListSQL();
		$conn = &$this->Connection();

		// Load recordset
		$dbtype = ew_GetConnectionType($this->DBID);
		if ($this->UseSelectLimit) {
			$conn->raiseErrorFn = $GLOBALS["EW_ERROR_FN"];
			if ($dbtype == "MSSQL") {
				$rs = $conn->SelectLimit($sSql, $rowcnt, $offset, array("_hasOrderBy" => trim($this->getOrderBy()) || trim($this->getSessionOrderBy())));
			} else {
				$rs = $conn->SelectLimit($sSql, $rowcnt, $offset);
			}
			$conn->raiseErrorFn = '';
		} else {
			$rs = ew_LoadRecordset($sSql, $conn);
		}

		// Call Recordset Selected event
		$this->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $Security, $Language;
		$sFilter = $this->KeyFilter();

		// Call Row Selecting event
		$this->Row_Selecting($sFilter);

		// Load SQL based on filter
		$this->CurrentFilter = $sFilter;
		$sSql = $this->SQL();
		$conn = &$this->Connection();
		$res = FALSE;
		$rs = ew_LoadRecordset($sSql, $conn);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->LoadRowValues($rs); // Load row values
			$rs->Close();
		}
		return $res;
	}

	// Load row values from recordset
	function LoadRowValues($rs = NULL) {
		if ($rs && !$rs->EOF)
			$row = $rs->fields;
		else
			$row = $this->NewRow(); 

		// Call Row Selected event
		$this->Row_Selected($row);
		if (!$rs || $rs->EOF)
			return;
		$this->pro_id->setDbValue($row['pro_id']);
		$this->pro_cat_id->setDbValue($row['pro_cat_id']);
		$this->pro_name->setDbValue($row['pro_name']);
		$this->pro_feature->setDbValue($row['pro_feature']);
		$this->pro_img_folder->setDbValue($row['pro_img_folder']);
		$this->pro_detail->setDbValue($row['pro_detail']);
		$this->price->setDbValue($row['price']);
		$this->pro_keyword->setDbValue($row['pro_keyword']);
		$this->pro_status->setDbValue($row['pro_status']);
		$this->col_id->setDbValue($row['col_id']);
	}

	// Return a row with default values
	function NewRow() {
		$row = array();
		$row['pro_id'] = NULL;
		$row['pro_cat_id'] = NULL;
		$row['pro_name'] = NULL;
		$row['pro_feature'] = NULL;
		$row['pro_img_folder'] = NULL;
		$row['pro_detail'] = NULL;
		$row['price'] = NULL;
		$row['pro_keyword'] = NULL;
		$row['pro_status'] = NULL;
		$row['col_id'] = NULL;
		return $row;
	}

	// Load DbValue from recordset
	function LoadDbValues(&$rs) {
		if (!$rs || !is_array($rs) && $rs->EOF)
			return;
		$row = is_array($rs) ? $rs : $rs->fields;
		$this->pro_id->DbValue = $row['pro_id'];
		$this->pro_cat_id->DbValue = $row['pro_cat_id'];
		$this->pro_name->DbValue = $row['pro_name'];
		$this->pro_feature->DbValue = $row['pro_feature'];
		$this->pro_img_folder->DbValue = $row['pro_img_folder'];
		$this->pro_detail->DbValue = $row['pro_detail'];
		$this->price->DbValue = $row['price'];
		$this->pro_keyword->DbValue = $row['pro_keyword'];
		$this->pro_status->DbValue = $row['pro_status'];
		$this->col_id->DbValue = $row['col_id'];
	}

	// Load old record
	function LoadOldRecord() {

		// Load key values from Session
		$bValidKey = TRUE;
		if (strval($this->getKey("pro_id")) <> "")
			$this->pro_id->CurrentValue = $this->getKey("pro_id"); // pro_id
		else
			$bValidKey = FALSE;

		// Load old record
		$this->OldRecordset = NULL;
		if ($bValidKey) {
			$this->CurrentFilter = $this->KeyFilter();
			$sSql = $this->SQL();
			$conn = &$this->Connection();
			$this->OldRecordset = ew_LoadRecordset($sSql, $conn);
		}
		$this->LoadRowValues($this->OldRecordset); // Load row values
		return $bValidKey;
	}

	// Render row values based on field settings
	function RenderRow() {
		global $Security, $Language, $gsLanguage;

		// Initialize URLs
		$this->ViewUrl = $this->GetViewUrl();
		$this->EditUrl = $this->GetEditUrl();
		$this->InlineEditUrl = $this->GetInlineEditUrl();
		$this->CopyUrl = $this->GetCopyUrl();
		$this->InlineCopyUrl = $this->GetInlineCopyUrl();
		$this->DeleteUrl = $this->GetDeleteUrl();

		// Call Row_Rendering event
		$this->Row_Rendering();

		// Common render codes for all row types
		// pro_id
		// pro_cat_id
		// pro_name
		// pro_feature
		// pro_img_folder
		// pro_detail
		// price
		// pro_keyword
		// pro_status
		// col_id

		if ($this->RowType == EW_ROWTYPE_VIEW) { // View row

		// pro_id
		$this->pro_id->ViewValue = $this->pro_id->CurrentValue;
		$this->pro_id->ViewCustomAttributes = "";

		// pro_cat_id
		$this->pro_cat_id->ViewValue = $this->pro_cat_id->CurrentValue;
		$this->pro_cat_id->ViewCustomAttributes = "";

		// pro_name
		$this->pro_name->ViewValue = $this->pro_name->CurrentValue;
		$this->pro_name->ViewCustomAttributes = "";

		// pro_feature
		$this->pro_feature->ViewValue = $this->pro_feature->CurrentValue;
		$this->pro_feature->ViewCustomAttributes = "";

		// pro_img_folder
		$this->pro_img_folder->ViewValue = $this->pro_img_folder->CurrentValue;
		$this->pro_img_folder->ViewCustomAttributes = "";

		// price
		$this->price->ViewValue = $this->price->CurrentValue;
		$this->price->ViewCustomAttributes = "";

		// pro_keyword
		$this->pro_keyword->ViewValue = $this->pro_keyword->CurrentValue;
		$this->pro_keyword->ViewCustomAttributes = "";

		// pro_status
		if (ew_ConvertToBool($this->pro_status->CurrentValue)) {
			$this->pro_status->ViewValue = $this->pro_status->FldTagCaption(1) <> "" ? $this->pro_status->FldTagCaption(1) : "Y";
		} else {
			$this->pro_status->ViewValue = $this->pro_status->FldTagCaption(2) <> "" ? $this->pro_status->FldTagCaption(2) : "N";
		}
		$this->pro_status->ViewCustomAttributes = "";

		// col_id
		$this->col_id->ViewValue = $this->col_id->CurrentValue;
		$this->col_id->ViewCustomAttributes = "";

			// pro_id
			$this->pro_id->LinkCustomAttributes = "";
			$this->pro_id->HrefValue = "";
			$this->pro_id->TooltipValue = "";

			// pro_cat_id
			$this->pro_cat_id->LinkCustomAttributes = "";
			$this->pro_cat_id->HrefValue = "";
			$this->pro_cat_id->TooltipValue = "";

			// pro_name
			$this->pro_name->LinkCustomAttributes = "";
			$this->pro_name->HrefValue = "";
			$this->pro_name->TooltipValue = "";

			// pro_feature
			$this->pro_feature->LinkCustomAttributes = "";
			$this->pro_feature->HrefValue = "";
			$this->pro_feature->TooltipValue = "";

			// pro_img_folder
			$this->pro_img_folder->LinkCustomAttributes = "";
			$this->pro_img_folder->HrefValue = "";
			$this->pro_img_folder->TooltipValue = "";

			// price
			$this->price->LinkCustomAttributes = "";
			$this->price->HrefValue = "";
			$this->price->TooltipValue = "";

			// pro_keyword
			$this->pro_keyword->LinkCustomAttributes = "";
			$this->pro_keyword->HrefValue = "";
			$this->pro_keyword->TooltipValue = "";

			// pro_status
			$this->pro_status->LinkCustomAttributes = "";
			$this->pro_status->HrefValue = "";
			$this->pro_status->TooltipValue = "";

			// col_id
			$this->col_id->LinkCustomAttributes = "";
			$this->col_id->HrefValue = "";
			$this->col_id->TooltipValue = "";
		} elseif ($this->RowType == EW_ROWTYPE_SEARCH) { // Search row

			// pro_id
			$this->pro_id->EditAttrs["class"] = "form-control";
			$this->pro_id->EditCustomAttributes = "";
			$this->pro_id->EditValue = ew_HtmlEncode($this->pro_id->AdvancedSearch->SearchValue);
			$this->pro_id->PlaceHolder = ew_RemoveHtml($this->pro_id->FldCaption());

			// pro_cat_id
			$this->pro_cat_id->EditAttrs["class"] = "form-control";
			$this->pro_cat_id->EditCustomAttributes = "";
			$this->pro_cat_id->EditValue = ew_HtmlEncode($this->pro_cat_id->AdvancedSearch->SearchValue);
			$this->pro_cat_id->PlaceHolder = ew_RemoveHtml($this->pro_cat_id->FldCaption());

			// pro_name
			$this->pro_name->EditAttrs["class"] = "form-control";
			$this->pro_name->EditCustomAttributes = "";
			$this->pro_name->EditValue = ew_HtmlEncode($this->pro_name->AdvancedSearch->SearchValue);
			$this->pro_name->PlaceHolder = ew_RemoveHtml($this->pro_name->FldCaption());

			// pro_feature
			$this->pro_feature->EditAttrs["class"] = "form-control";
			$this->pro_feature->EditCustomAttributes = "";
			$this->pro_feature->EditValue = ew_HtmlEncode($this->pro_feature->AdvancedSearch->SearchValue);
			$this->pro_feature->PlaceHolder = ew_RemoveHtml($this->pro_feature->FldCaption());

			// pro_img_folder
			$this->pro_img_folder->EditAttrs["class"] = "form-control";
			$this->pro_img_folder->EditCustomAttributes = "";
			$this->pro_img_folder->EditValue = ew_HtmlEncode($this->pro_img_folder->AdvancedSearch->SearchValue);
			$this->pro_img_folder->PlaceHolder = ew_RemoveHtml($this->pro_img_folder->FldCaption());

			// price
			$this->price->EditAttrs["class"] = "form-control";
			$this->price->EditCustomAttributes = "";
			$this->price->EditValue = ew_HtmlEncode($this->price->AdvancedSearch->SearchValue);
			$this->price->PlaceHolder = ew_RemoveHtml($this->price->FldCaption());

			// pro_keyword
			$this->pro_keyword->EditAttrs["class"] = "form-control";
			$this->pro_keyword->EditCustomAttributes = "";
			$this->pro_keyword->EditValue = ew_HtmlEncode($this->pro_keyword->AdvancedSearch->SearchValue);
			$this->pro_keyword->PlaceHolder = ew_RemoveHtml($this->pro_keyword->FldCaption());

			// pro_status
			$this->pro_status->EditCustomAttributes = "";
			$this->pro_status->EditValue = $this->pro_status->Options(FALSE);

			// col_id
			$this->col_id->EditAttrs["class"] = "form-control";
			$this->col_id->EditCustomAttributes = "";
			$this->col_id->EditValue = ew_HtmlEncode($this->col_id->AdvancedSearch->SearchValue);
			$this->col_id->PlaceHolder = ew_RemoveHtml($this->col_id->FldCaption());
		}
		if ($this->RowType == EW_ROWTYPE_ADD || $this->RowType == EW_ROWTYPE_EDIT || $this->RowType == EW_ROWTYPE_SEARCH) // Add/Edit/Search row
			$this->SetupFieldTitles();

		// Call Row Rendered event
		if ($this->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$this->Row_Rendered();
	}

	// Validate search
	function ValidateSearch() {
		global $gsSearchError;

		// Initialize
		$gsSearchError = "";

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return TRUE;

		// Return validate result
		$ValidateSearch = ($gsSearchError == "");

		// Call Form_CustomValidate event
		$sFormCustomError = "";
		$ValidateSearch = $ValidateSearch && $this->Form_CustomValidate($sFormCustomError);
		if ($sFormCustomError <> "") {
			ew_AddMessage($gsSearchError, $sFormCustomError);
		}
		return $ValidateSearch;
	}

	// Load advanced search
	function LoadAdvancedSearch() {
		$this->pro_id->AdvancedSearch->Load();
		$this->pro_cat_id->AdvancedSearch->Load();
		$this->pro_name->AdvancedSearch->Load();
		$this->pro_feature->AdvancedSearch->Load();
		$this->pro_img_folder->AdvancedSearch->Load();
		$this->pro_detail->AdvancedSearch->Load();
		$this->price->AdvancedSearch->Load();
		$this->pro_keyword->AdvancedSearch->Load();
		$this->pro_status->AdvancedSearch->Load();
		$this->col_id->AdvancedSearch->Load();
	}

	// Set up Breadcrumb
	function SetupBreadcrumb() {
		global $Breadcrumb, $Language;
		$Breadcrumb = new cBreadcrumb();
		$url = substr(ew_CurrentUrl(), strrpos(ew_CurrentUrl(), "/")+1);
		$url = preg_replace('/\?cmd=reset(all){0,1}$/i', '', $url); // Remove cmd=reset / cmd=resetall
		$Breadcrumb->Add("list", $this->TableVar, $url, "", $this->TableVar, TRUE);
	}

	// Setup lookup filters of a field
	function SetupLookupFilters($fld, $pageId = null) {
		global $gsLanguage;
		$pageId = $pageId ?: $this->PageID;
		if ($pageId == "list") {
			switch ($fld->FldVar) {
			}
		} elseif ($pageId == "extbs") {
			switch ($fld->FldVar) {
			}
		}
	}

	// Setup AutoSuggest filters of a field
	function SetupAutoSuggestFilters($fld, $pageId = null) {
		global $gsLanguage;
		$pageId = $pageId ?: $this->PageID;
		if ($pageId == "list") {
			switch ($fld->FldVar) {
			}
		} elseif ($pageId == "extbs") {
			switch ($fld->FldVar) {
			}
		}
	}

	// Page Load event
	function Page_Load() {

		//echo "Page Load";
	}

	// Page Unload event
	function Page_Unload() {

		//echo "Page Unload";
	}

	// Page Redirecting event
	function Page_Redirecting(&$url) {

		// Example:
		//$url = "your URL";

	}

	// Message Showing event
	// $type = ''|'success'|'failure'|'warning'
	function Message_Showing(&$msg, $type) {
		if ($type == 'success') {

			//$msg = "your success message";
		} elseif ($type == 'failure') {

			//$msg = "your failure message";
		} elseif ($type == 'warning') {

			//$msg = "your warning message";
		} else {

			//$msg = "your message";
		}
	}

	// Page Render event
	function Page_Render() {

		//echo "Page Render";
	}

	// Page Data Rendering event
	function Page_DataRendering(&$header) {

		// Example:
		//$header = "your header";

	}

	// Page Data Rendered event
	function Page_DataRendered(&$footer) {

		// Example:
		//$footer = "your footer";

	}

	// Form Custom Validate event
	function Form_CustomValidate(&$CustomError) {

		// Return error message in CustomError
		return TRUE;
	}

	// ListOptions Load event
	function ListOptions_Load() {

		// Example:
		//$opt = &$this->ListOptions->Add("new");
		//$opt->Header = "xxx";
		//$opt->OnLeft = TRUE; // Link on left
		//$opt->MoveTo(0); // Move to first column

	}

	// ListOptions Rendering event
	function ListOptions_Rendering() {

		//$GLOBALS["xxx_grid"]->DetailAdd = (...condition...); // Set to TRUE or FALSE conditionally
		//$GLOBALS["xxx_grid"]->DetailEdit = (...condition...); // Set to TRUE or FALSE conditionally
		//$GLOBALS["xxx_grid"]->DetailView = (...condition...); // Set to TRUE or FALSE conditionally

	}

	// ListOptions Rendered event
	function ListOptions_Rendered() {

		// Example:
		//$this->ListOptions->Items["new"]->Body = "xxx";

	}

	// Row Custom Action event
	function Row_CustomAction($action, $row) {

		// Return FALSE to abort
		return TRUE;
	}

	// Page Exporting event
	// $this->ExportDoc = export document object
	function Page_Exporting() {

		//$this->ExportDoc->Text = "my header"; // Export header
		//return FALSE; // Return FALSE to skip default export and use Row_Export event

		return TRUE; // Return TRUE to use default export and skip Row_Export event
	}

	// Row Export event
	// $this->ExportDoc = export document object
	function Row_Export($rs) {

		//$this->ExportDoc->Text .= "my content"; // Build HTML with field value: $rs["MyField"] or $this->MyField->ViewValue
	}

	// Page Exported event
	// $this->ExportDoc = export document object
	function Page_Exported() {

		//$this->ExportDoc->Text .= "my footer"; // Export footer
		//echo $this->ExportDoc->Text;

	}
}
?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
if (!isset($tbl_product_list)) $tbl_product_list = new ctbl_product_list();

// Page init
$tbl_product_list->Page_Init();

// Page main
$tbl_product_list->Page_Main();

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$tbl_product_list->Page_Render();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">

// Form object
var CurrentPageID = EW_PAGE_ID = "list";
var CurrentForm = ftbl_productlist = new ew_Form("ftbl_productlist", "list");
ftbl_productlist.FormKeyCountName = '<?php echo $tbl_product_list->FormKeyCountName ?>';

// Form_CustomValidate event
ftbl_productlist.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid.
 	return true;
 }

// Use JavaScript validation or not
ftbl_productlist.ValidateRequired = <?php echo json_encode(EW_CLIENT_VALIDATE) ?>;

// Dynamic selection lists
ftbl_productlist.Lists["x_pro_status[]"] = {"LinkField":"","Ajax":null,"AutoFill":false,"DisplayFields":["","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":""};
ftbl_productlist.Lists["x_pro_status[]"].Options = <?php echo json_encode($tbl_product_list->pro_status->Options()) ?>;

// Form object for search
var CurrentSearchForm = ftbl_productlistsrch = new ew_Form("ftbl_productlistsrch");

// Validate function for search
ftbl_productlistsrch.Validate = function(fobj) {
	if (!this.ValidateRequired)
		return true; // Ignore validation
	fobj = fobj || this.Form;
	var infix = "";

	// Fire Form_CustomValidate event
	if (!this.Form_CustomValidate(fobj))
		return false;
	return true;
}

// Form_CustomValidate event
ftbl_productlistsrch.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid.
 	return true;
 }

// Use JavaScript validation or not
ftbl_productlistsrch.ValidateRequired = <?php echo json_encode(EW_CLIENT_VALIDATE) ?>;

// Dynamic selection lists
ftbl_productlistsrch.Lists["x_pro_status[]"] = {"LinkField":"","Ajax":null,"AutoFill":false,"DisplayFields":["","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":""};
ftbl_productlistsrch.Lists["x_pro_status[]"].Options = <?php echo json_encode($tbl_product_list->pro_status->Options()) ?>;
</script>
<script type="text/javascript">

// Write your client script here, no need to add script tags.
</script>
<div class="ewToolbar">
<?php if ($tbl_product_list->TotalRecs > 0 && $tbl_product_list->ExportOptions->Visible()) { ?>
<?php $tbl_product_list->ExportOptions->Render("body") ?>
<?php } ?>
<?php if ($tbl_product_list->SearchOptions->Visible()) { ?>
<?php $tbl_product_list->SearchOptions->Render("body") ?>
<?php } ?>
<?php if ($tbl_product_list->FilterOptions->Visible()) { ?>
<?php $tbl_product_list->FilterOptions->Render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php
	$bSelectLimit = $tbl_product_list->UseSelectLimit;
	if ($bSelectLimit) {
		if ($tbl_product_list->TotalRecs <= 0)
			$tbl_product_list->TotalRecs = $tbl_product->ListRecordCount();
	} else {
		if (!$tbl_product_list->Recordset && ($tbl_product_list->Recordset = $tbl_product_list->LoadRecordset()))
			$tbl_product_list->TotalRecs = $tbl_product_list->Recordset->RecordCount();
	}
	$tbl_product_list->StartRec = 1;
	if ($tbl_product_list->DisplayRecs <= 0 || ($tbl_product->Export <> "" && $tbl_product->ExportAll)) // Display all records
		$tbl_product_list->DisplayRecs = $tbl_product_list->TotalRecs;
	if (!($tbl_product->Export <> "" && $tbl_product->ExportAll))
		$tbl_product_list->SetupStartRec(); // Set up start record position
	if ($bSelectLimit)
		$tbl_product_list->Recordset = $tbl_product_list->LoadRecordset($tbl_product_list->StartRec-1, $tbl_product_list->DisplayRecs);

	// Set no record found message
	if ($tbl_product->CurrentAction == "" && $tbl_product_list->TotalRecs == 0) {
		if ($tbl_product_list->SearchWhere == "0=101")
			$tbl_product_list->setWarningMessage($Language->Phrase("EnterSearchCriteria"));
		else
			$tbl_product_list->setWarningMessage($Language->Phrase("NoRecord"));
	}
$tbl_product_list->RenderOtherOptions();
?>
<?php if ($Security->IsLoggedIn()) { ?>
<?php if ($tbl_product->Export == "" && $tbl_product->CurrentAction == "") { ?>
<form name="ftbl_productlistsrch" id="ftbl_productlistsrch" class="form-inline ewForm ewExtSearchForm" action="<?php echo ew_CurrentPage() ?>">
<?php $SearchPanelClass = ($tbl_product_list->SearchWhere <> "") ? " in" : " in"; ?>
<div id="ftbl_productlistsrch_SearchPanel" class="ewSearchPanel collapse<?php echo $SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="tbl_product">
	<div class="ewBasicSearch">
<?php
if ($gsSearchError == "")
	$tbl_product_list->LoadAdvancedSearch(); // Load advanced search

// Render for search
$tbl_product->RowType = EW_ROWTYPE_SEARCH;

// Render row
$tbl_product->ResetAttrs();
$tbl_product_list->RenderRow();
?>
<div id="xsr_1" class="ewRow">
<?php if ($tbl_product->pro_status->Visible) { // pro_status ?>
	<div id="xsc_pro_status" class="ewCell form-group">
		<label class="ewSearchCaption ewLabel"><?php echo $tbl_product->pro_status->FldCaption() ?></label>
		<span class="ewSearchOperator"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_pro_status" id="z_pro_status" value="="></span>
		<span class="ewSearchField">
<?php
$selwrk = (ew_ConvertToBool($tbl_product->pro_status->AdvancedSearch->SearchValue)) ? " checked" : "";
?>
<input type="checkbox" data-table="tbl_product" data-field="x_pro_status" name="x_pro_status[]" id="x_pro_status[]" value="1"<?php echo $selwrk ?><?php echo $tbl_product->pro_status->EditAttributes() ?>>
</span>
	</div>
<?php } ?>
</div>
<div id="xsr_2" class="ewRow">
	<div class="ewQuickSearch input-group">
	<input type="text" name="<?php echo EW_TABLE_BASIC_SEARCH ?>" id="<?php echo EW_TABLE_BASIC_SEARCH ?>" class="form-control" value="<?php echo ew_HtmlEncode($tbl_product_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo ew_HtmlEncode($Language->Phrase("Search")) ?>">
	<input type="hidden" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value="<?php echo ew_HtmlEncode($tbl_product_list->BasicSearch->getType()) ?>">
	<div class="input-group-btn">
		<button type="button" data-toggle="dropdown" class="btn btn-default"><span id="searchtype"><?php echo $tbl_product_list->BasicSearch->getTypeNameShort() ?></span><span class="caret"></span></button>
		<ul class="dropdown-menu pull-right" role="menu">
			<li<?php if ($tbl_product_list->BasicSearch->getType() == "") echo " class=\"active\""; ?>><a href="javascript:void(0);" onclick="ew_SetSearchType(this)"><?php echo $Language->Phrase("QuickSearchAuto") ?></a></li>
			<li<?php if ($tbl_product_list->BasicSearch->getType() == "=") echo " class=\"active\""; ?>><a href="javascript:void(0);" onclick="ew_SetSearchType(this,'=')"><?php echo $Language->Phrase("QuickSearchExact") ?></a></li>
			<li<?php if ($tbl_product_list->BasicSearch->getType() == "AND") echo " class=\"active\""; ?>><a href="javascript:void(0);" onclick="ew_SetSearchType(this,'AND')"><?php echo $Language->Phrase("QuickSearchAll") ?></a></li>
			<li<?php if ($tbl_product_list->BasicSearch->getType() == "OR") echo " class=\"active\""; ?>><a href="javascript:void(0);" onclick="ew_SetSearchType(this,'OR')"><?php echo $Language->Phrase("QuickSearchAny") ?></a></li>
		</ul>
	<button class="btn btn-primary ewButton" name="btnsubmit" id="btnsubmit" type="submit"><?php echo $Language->Phrase("SearchBtn") ?></button>
	</div>
	</div>
</div>
	</div>
</div>
</form>
<?php } ?>
<?php } ?>
<?php $tbl_product_list->ShowPageHeader(); ?>
<?php
$tbl_product_list->ShowMessage();
?>
<?php if ($tbl_product_list->TotalRecs > 0 || $tbl_product->CurrentAction <> "") { ?>
<div class="box ewBox ewGrid<?php if ($tbl_product_list->IsAddOrEdit()) { ?> ewGridAddEdit<?php } ?> tbl_product">
<form name="ftbl_productlist" id="ftbl_productlist" class="form-inline ewForm ewListForm" action="<?php echo ew_CurrentPage() ?>" method="post">
<?php if ($tbl_product_list->CheckToken) { ?>
<input type="hidden" name="<?php echo EW_TOKEN_NAME ?>" value="<?php echo $tbl_product_list->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="tbl_product">
<div id="gmp_tbl_product" class="<?php if (ew_IsResponsiveLayout()) { ?>table-responsive <?php } ?>ewGridMiddlePanel">
<?php if ($tbl_product_list->TotalRecs > 0 || $tbl_product->CurrentAction == "gridedit") { ?>
<table id="tbl_tbl_productlist" class="table ewTable">
<thead>
	<tr class="ewTableHeader">
<?php

// Header row
$tbl_product_list->RowType = EW_ROWTYPE_HEADER;

// Render list options
$tbl_product_list->RenderListOptions();

// Render list options (header, left)
$tbl_product_list->ListOptions->Render("header", "left");
?>
<?php if ($tbl_product->pro_id->Visible) { // pro_id ?>
	<?php if ($tbl_product->SortUrl($tbl_product->pro_id) == "") { ?>
		<th data-name="pro_id" class="<?php echo $tbl_product->pro_id->HeaderCellClass() ?>"><div id="elh_tbl_product_pro_id" class="tbl_product_pro_id"><div class="ewTableHeaderCaption"><?php echo $tbl_product->pro_id->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="pro_id" class="<?php echo $tbl_product->pro_id->HeaderCellClass() ?>"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $tbl_product->SortUrl($tbl_product->pro_id) ?>',1);"><div id="elh_tbl_product_pro_id" class="tbl_product_pro_id">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $tbl_product->pro_id->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($tbl_product->pro_id->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($tbl_product->pro_id->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tbl_product->pro_cat_id->Visible) { // pro_cat_id ?>
	<?php if ($tbl_product->SortUrl($tbl_product->pro_cat_id) == "") { ?>
		<th data-name="pro_cat_id" class="<?php echo $tbl_product->pro_cat_id->HeaderCellClass() ?>"><div id="elh_tbl_product_pro_cat_id" class="tbl_product_pro_cat_id"><div class="ewTableHeaderCaption"><?php echo $tbl_product->pro_cat_id->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="pro_cat_id" class="<?php echo $tbl_product->pro_cat_id->HeaderCellClass() ?>"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $tbl_product->SortUrl($tbl_product->pro_cat_id) ?>',1);"><div id="elh_tbl_product_pro_cat_id" class="tbl_product_pro_cat_id">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $tbl_product->pro_cat_id->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($tbl_product->pro_cat_id->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($tbl_product->pro_cat_id->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tbl_product->pro_name->Visible) { // pro_name ?>
	<?php if ($tbl_product->SortUrl($tbl_product->pro_name) == "") { ?>
		<th data-name="pro_name" class="<?php echo $tbl_product->pro_name->HeaderCellClass() ?>"><div id="elh_tbl_product_pro_name" class="tbl_product_pro_name"><div class="ewTableHeaderCaption"><?php echo $tbl_product->pro_name->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="pro_name" class="<?php echo $tbl_product->pro_name->HeaderCellClass() ?>"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $tbl_product->SortUrl($tbl_product->pro_name) ?>',1);"><div id="elh_tbl_product_pro_name" class="tbl_product_pro_name">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $tbl_product->pro_name->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></span><span class="ewTableHeaderSort"><?php if ($tbl_product->pro_name->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($tbl_product->pro_name->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tbl_product->pro_feature->Visible) { // pro_feature ?>
	<?php if ($tbl_product->SortUrl($tbl_product->pro_feature) == "") { ?>
		<th data-name="pro_feature" class="<?php echo $tbl_product->pro_feature->HeaderCellClass() ?>"><div id="elh_tbl_product_pro_feature" class="tbl_product_pro_feature"><div class="ewTableHeaderCaption"><?php echo $tbl_product->pro_feature->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="pro_feature" class="<?php echo $tbl_product->pro_feature->HeaderCellClass() ?>"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $tbl_product->SortUrl($tbl_product->pro_feature) ?>',1);"><div id="elh_tbl_product_pro_feature" class="tbl_product_pro_feature">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $tbl_product->pro_feature->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></span><span class="ewTableHeaderSort"><?php if ($tbl_product->pro_feature->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($tbl_product->pro_feature->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tbl_product->pro_img_folder->Visible) { // pro_img_folder ?>
	<?php if ($tbl_product->SortUrl($tbl_product->pro_img_folder) == "") { ?>
		<th data-name="pro_img_folder" class="<?php echo $tbl_product->pro_img_folder->HeaderCellClass() ?>"><div id="elh_tbl_product_pro_img_folder" class="tbl_product_pro_img_folder"><div class="ewTableHeaderCaption"><?php echo $tbl_product->pro_img_folder->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="pro_img_folder" class="<?php echo $tbl_product->pro_img_folder->HeaderCellClass() ?>"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $tbl_product->SortUrl($tbl_product->pro_img_folder) ?>',1);"><div id="elh_tbl_product_pro_img_folder" class="tbl_product_pro_img_folder">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $tbl_product->pro_img_folder->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></span><span class="ewTableHeaderSort"><?php if ($tbl_product->pro_img_folder->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($tbl_product->pro_img_folder->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tbl_product->price->Visible) { // price ?>
	<?php if ($tbl_product->SortUrl($tbl_product->price) == "") { ?>
		<th data-name="price" class="<?php echo $tbl_product->price->HeaderCellClass() ?>"><div id="elh_tbl_product_price" class="tbl_product_price"><div class="ewTableHeaderCaption"><?php echo $tbl_product->price->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="price" class="<?php echo $tbl_product->price->HeaderCellClass() ?>"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $tbl_product->SortUrl($tbl_product->price) ?>',1);"><div id="elh_tbl_product_price" class="tbl_product_price">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $tbl_product->price->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></span><span class="ewTableHeaderSort"><?php if ($tbl_product->price->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($tbl_product->price->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tbl_product->pro_keyword->Visible) { // pro_keyword ?>
	<?php if ($tbl_product->SortUrl($tbl_product->pro_keyword) == "") { ?>
		<th data-name="pro_keyword" class="<?php echo $tbl_product->pro_keyword->HeaderCellClass() ?>"><div id="elh_tbl_product_pro_keyword" class="tbl_product_pro_keyword"><div class="ewTableHeaderCaption"><?php echo $tbl_product->pro_keyword->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="pro_keyword" class="<?php echo $tbl_product->pro_keyword->HeaderCellClass() ?>"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $tbl_product->SortUrl($tbl_product->pro_keyword) ?>',1);"><div id="elh_tbl_product_pro_keyword" class="tbl_product_pro_keyword">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $tbl_product->pro_keyword->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></span><span class="ewTableHeaderSort"><?php if ($tbl_product->pro_keyword->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($tbl_product->pro_keyword->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tbl_product->pro_status->Visible) { // pro_status ?>
	<?php if ($tbl_product->SortUrl($tbl_product->pro_status) == "") { ?>
		<th data-name="pro_status" class="<?php echo $tbl_product->pro_status->HeaderCellClass() ?>"><div id="elh_tbl_product_pro_status" class="tbl_product_pro_status"><div class="ewTableHeaderCaption"><?php echo $tbl_product->pro_status->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="pro_status" class="<?php echo $tbl_product->pro_status->HeaderCellClass() ?>"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $tbl_product->SortUrl($tbl_product->pro_status) ?>',1);"><div id="elh_tbl_product_pro_status" class="tbl_product_pro_status">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $tbl_product->pro_status->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($tbl_product->pro_status->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($tbl_product->pro_status->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tbl_product->col_id->Visible) { // col_id ?>
	<?php if ($tbl_product->SortUrl($tbl_product->col_id) == "") { ?>
		<th data-name="col_id" class="<?php echo $tbl_product->col_id->HeaderCellClass() ?>"><div id="elh_tbl_product_col_id" class="tbl_product_col_id"><div class="ewTableHeaderCaption"><?php echo $tbl_product->col_id->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="col_id" class="<?php echo $tbl_product->col_id->HeaderCellClass() ?>"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $tbl_product->SortUrl($tbl_product->col_id) ?>',1);"><div id="elh_tbl_product_col_id" class="tbl_product_col_id">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $tbl_product->col_id->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($tbl_product->col_id->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($tbl_product->col_id->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$tbl_product_list->ListOptions->Render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($tbl_product->ExportAll && $tbl_product->Export <> "") {
	$tbl_product_list->StopRec = $tbl_product_list->TotalRecs;
} else {

	// Set the last record to display
	if ($tbl_product_list->TotalRecs > $tbl_product_list->StartRec + $tbl_product_list->DisplayRecs - 1)
		$tbl_product_list->StopRec = $tbl_product_list->StartRec + $tbl_product_list->DisplayRecs - 1;
	else
		$tbl_product_list->StopRec = $tbl_product_list->TotalRecs;
}
$tbl_product_list->RecCnt = $tbl_product_list->StartRec - 1;
if ($tbl_product_list->Recordset && !$tbl_product_list->Recordset->EOF) {
	$tbl_product_list->Recordset->MoveFirst();
	$bSelectLimit = $tbl_product_list->UseSelectLimit;
	if (!$bSelectLimit && $tbl_product_list->StartRec > 1)
		$tbl_product_list->Recordset->Move($tbl_product_list->StartRec - 1);
} elseif (!$tbl_product->AllowAddDeleteRow && $tbl_product_list->StopRec == 0) {
	$tbl_product_list->StopRec = $tbl_product->GridAddRowCount;
}

// Initialize aggregate
$tbl_product->RowType = EW_ROWTYPE_AGGREGATEINIT;
$tbl_product->ResetAttrs();
$tbl_product_list->RenderRow();
while ($tbl_product_list->RecCnt < $tbl_product_list->StopRec) {
	$tbl_product_list->RecCnt++;
	if (intval($tbl_product_list->RecCnt) >= intval($tbl_product_list->StartRec)) {
		$tbl_product_list->RowCnt++;

		// Set up key count
		$tbl_product_list->KeyCount = $tbl_product_list->RowIndex;

		// Init row class and style
		$tbl_product->ResetAttrs();
		$tbl_product->CssClass = "";
		if ($tbl_product->CurrentAction == "gridadd") {
		} else {
			$tbl_product_list->LoadRowValues($tbl_product_list->Recordset); // Load row values
		}
		$tbl_product->RowType = EW_ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$tbl_product->RowAttrs = array_merge($tbl_product->RowAttrs, array('data-rowindex'=>$tbl_product_list->RowCnt, 'id'=>'r' . $tbl_product_list->RowCnt . '_tbl_product', 'data-rowtype'=>$tbl_product->RowType));

		// Render row
		$tbl_product_list->RenderRow();

		// Render list options
		$tbl_product_list->RenderListOptions();
?>
	<tr<?php echo $tbl_product->RowAttributes() ?>>
<?php

// Render list options (body, left)
$tbl_product_list->ListOptions->Render("body", "left", $tbl_product_list->RowCnt);
?>
	<?php if ($tbl_product->pro_id->Visible) { // pro_id ?>
		<td data-name="pro_id"<?php echo $tbl_product->pro_id->CellAttributes() ?>>
<span id="el<?php echo $tbl_product_list->RowCnt ?>_tbl_product_pro_id" class="tbl_product_pro_id">
<span<?php echo $tbl_product->pro_id->ViewAttributes() ?>>
<?php echo $tbl_product->pro_id->ListViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($tbl_product->pro_cat_id->Visible) { // pro_cat_id ?>
		<td data-name="pro_cat_id"<?php echo $tbl_product->pro_cat_id->CellAttributes() ?>>
<span id="el<?php echo $tbl_product_list->RowCnt ?>_tbl_product_pro_cat_id" class="tbl_product_pro_cat_id">
<span<?php echo $tbl_product->pro_cat_id->ViewAttributes() ?>>
<?php echo $tbl_product->pro_cat_id->ListViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($tbl_product->pro_name->Visible) { // pro_name ?>
		<td data-name="pro_name"<?php echo $tbl_product->pro_name->CellAttributes() ?>>
<span id="el<?php echo $tbl_product_list->RowCnt ?>_tbl_product_pro_name" class="tbl_product_pro_name">
<span<?php echo $tbl_product->pro_name->ViewAttributes() ?>>
<?php echo $tbl_product->pro_name->ListViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($tbl_product->pro_feature->Visible) { // pro_feature ?>
		<td data-name="pro_feature"<?php echo $tbl_product->pro_feature->CellAttributes() ?>>
<span id="el<?php echo $tbl_product_list->RowCnt ?>_tbl_product_pro_feature" class="tbl_product_pro_feature">
<span<?php echo $tbl_product->pro_feature->ViewAttributes() ?>>
<?php echo $tbl_product->pro_feature->ListViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($tbl_product->pro_img_folder->Visible) { // pro_img_folder ?>
		<td data-name="pro_img_folder"<?php echo $tbl_product->pro_img_folder->CellAttributes() ?>>
<span id="el<?php echo $tbl_product_list->RowCnt ?>_tbl_product_pro_img_folder" class="tbl_product_pro_img_folder">
<span<?php echo $tbl_product->pro_img_folder->ViewAttributes() ?>>
<?php echo $tbl_product->pro_img_folder->ListViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($tbl_product->price->Visible) { // price ?>
		<td data-name="price"<?php echo $tbl_product->price->CellAttributes() ?>>
<span id="el<?php echo $tbl_product_list->RowCnt ?>_tbl_product_price" class="tbl_product_price">
<span<?php echo $tbl_product->price->ViewAttributes() ?>>
<?php echo $tbl_product->price->ListViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($tbl_product->pro_keyword->Visible) { // pro_keyword ?>
		<td data-name="pro_keyword"<?php echo $tbl_product->pro_keyword->CellAttributes() ?>>
<span id="el<?php echo $tbl_product_list->RowCnt ?>_tbl_product_pro_keyword" class="tbl_product_pro_keyword">
<span<?php echo $tbl_product->pro_keyword->ViewAttributes() ?>>
<?php echo $tbl_product->pro_keyword->ListViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($tbl_product->pro_status->Visible) { // pro_status ?>
		<td data-name="pro_status"<?php echo $tbl_product->pro_status->CellAttributes() ?>>
<span id="el<?php echo $tbl_product_list->RowCnt ?>_tbl_product_pro_status" class="tbl_product_pro_status">
<span<?php echo $tbl_product->pro_status->ViewAttributes() ?>>
<?php if (ew_ConvertToBool($tbl_product->pro_status->CurrentValue)) { ?>
<input type="checkbox" value="<?php echo $tbl_product->pro_status->ListViewValue() ?>" disabled checked>
<?php } else { ?>
<input type="checkbox" value="<?php echo $tbl_product->pro_status->ListViewValue() ?>" disabled>
<?php } ?>
</span>
</span>
</td>
	<?php } ?>
	<?php if ($tbl_product->col_id->Visible) { // col_id ?>
		<td data-name="col_id"<?php echo $tbl_product->col_id->CellAttributes() ?>>
<span id="el<?php echo $tbl_product_list->RowCnt ?>_tbl_product_col_id" class="tbl_product_col_id">
<span<?php echo $tbl_product->col_id->ViewAttributes() ?>>
<?php echo $tbl_product->col_id->ListViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$tbl_product_list->ListOptions->Render("body", "right", $tbl_product_list->RowCnt);
?>
	</tr>
<?php
	}
	if ($tbl_product->CurrentAction <> "gridadd")
		$tbl_product_list->Recordset->MoveNext();
}
?>
</tbody>
</table>
<?php } ?>
<?php if ($tbl_product->CurrentAction == "") { ?>
<input type="hidden" name="a_list" id="a_list" value="">
<?php } ?>
</div>
</form>
<?php

// Close recordset
if ($tbl_product_list->Recordset)
	$tbl_product_list->Recordset->Close();
?>
<div class="box-footer ewGridLowerPanel">
<?php if ($tbl_product->CurrentAction <> "gridadd" && $tbl_product->CurrentAction <> "gridedit") { ?>
<form name="ewPagerForm" class="ewForm form-inline ewPagerForm" action="<?php echo ew_CurrentPage() ?>">
<?php if (!isset($tbl_product_list->Pager)) $tbl_product_list->Pager = new cPrevNextPager($tbl_product_list->StartRec, $tbl_product_list->DisplayRecs, $tbl_product_list->TotalRecs, $tbl_product_list->AutoHidePager) ?>
<?php if ($tbl_product_list->Pager->RecordCount > 0 && $tbl_product_list->Pager->Visible) { ?>
<div class="ewPager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ewPrevNext"><div class="input-group">
<div class="input-group-btn">
<!--first page button-->
	<?php if ($tbl_product_list->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default btn-sm" title="<?php echo $Language->Phrase("PagerFirst") ?>" href="<?php echo $tbl_product_list->PageUrl() ?>start=<?php echo $tbl_product_list->Pager->FirstButton->Start ?>"><span class="icon-first ewIcon"></span></a>
	<?php } else { ?>
	<a class="btn btn-default btn-sm disabled" title="<?php echo $Language->Phrase("PagerFirst") ?>"><span class="icon-first ewIcon"></span></a>
	<?php } ?>
<!--previous page button-->
	<?php if ($tbl_product_list->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default btn-sm" title="<?php echo $Language->Phrase("PagerPrevious") ?>" href="<?php echo $tbl_product_list->PageUrl() ?>start=<?php echo $tbl_product_list->Pager->PrevButton->Start ?>"><span class="icon-prev ewIcon"></span></a>
	<?php } else { ?>
	<a class="btn btn-default btn-sm disabled" title="<?php echo $Language->Phrase("PagerPrevious") ?>"><span class="icon-prev ewIcon"></span></a>
	<?php } ?>
</div>
<!--current page number-->
	<input class="form-control input-sm" type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $tbl_product_list->Pager->CurrentPage ?>">
<div class="input-group-btn">
<!--next page button-->
	<?php if ($tbl_product_list->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default btn-sm" title="<?php echo $Language->Phrase("PagerNext") ?>" href="<?php echo $tbl_product_list->PageUrl() ?>start=<?php echo $tbl_product_list->Pager->NextButton->Start ?>"><span class="icon-next ewIcon"></span></a>
	<?php } else { ?>
	<a class="btn btn-default btn-sm disabled" title="<?php echo $Language->Phrase("PagerNext") ?>"><span class="icon-next ewIcon"></span></a>
	<?php } ?>
<!--last page button-->
	<?php if ($tbl_product_list->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default btn-sm" title="<?php echo $Language->Phrase("PagerLast") ?>" href="<?php echo $tbl_product_list->PageUrl() ?>start=<?php echo $tbl_product_list->Pager->LastButton->Start ?>"><span class="icon-last ewIcon"></span></a>
	<?php } else { ?>
	<a class="btn btn-default btn-sm disabled" title="<?php echo $Language->Phrase("PagerLast") ?>"><span class="icon-last ewIcon"></span></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $tbl_product_list->Pager->PageCount ?></span>
</div>
<?php } ?>
<?php if ($tbl_product_list->Pager->RecordCount > 0) { ?>
<div class="ewPager ewRec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $tbl_product_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $tbl_product_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $tbl_product_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ewListOtherOptions">
<?php
	foreach ($tbl_product_list->OtherOptions as &$option)
		$option->Render("body", "bottom");
?>
</div>
<div class="clearfix"></div>
</div>
</div>
<?php } ?>
<?php if ($tbl_product_list->TotalRecs == 0 && $tbl_product->CurrentAction == "") { // Show other options ?>
<div class="ewListOtherOptions">
<?php
	foreach ($tbl_product_list->OtherOptions as &$option) {
		$option->ButtonClass = "";
		$option->Render("body", "");
	}
?>
</div>
<div class="clearfix"></div>
<?php } ?>
<script type="text/javascript">
ftbl_productlistsrch.FilterList = <?php echo $tbl_product_list->GetFilterList() ?>;
ftbl_productlistsrch.Init();
ftbl_productlist.Init();
</script>
<?php
$tbl_product_list->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<script type="text/javascript">

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$tbl_product_list->Page_Terminate();
?>
