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

$tbl_product_add = NULL; // Initialize page object first

class ctbl_product_add extends ctbl_product {

	// Page ID
	var $PageID = 'add';

	// Project ID
	var $ProjectID = '{6AF8C2FF-A16C-4050-9229-E3A572D6C974}';

	// Table name
	var $TableName = 'tbl_product';

	// Page object name
	var $PageObjName = 'tbl_product_add';

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

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'add', TRUE);

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
	}

	//
	//  Page_Init
	//
	function Page_Init() {
		global $gsExport, $gsCustomExport, $gsExportFile, $UserProfile, $Language, $Security, $objForm;

		// Is modal
		$this->IsModal = (@$_GET["modal"] == "1" || @$_POST["modal"] == "1");

		// User profile
		$UserProfile = new cUserProfile();

		// Security
		$Security = new cAdvancedSecurity();
		if (!$Security->IsLoggedIn()) $Security->AutoLogin();
		$Security->LoadCurrentUserLevel($this->ProjectID . $this->TableName);
		if (!$Security->CanAdd()) {
			$Security->SaveLastUrl();
			$this->setFailureMessage(ew_DeniedMsg()); // Set no permission
			if ($Security->CanList())
				$this->Page_Terminate(ew_GetUrl("tbl_productlist.php"));
			else
				$this->Page_Terminate(ew_GetUrl("login.php"));
		}

		// NOTE: Security object may be needed in other part of the script, skip set to Nothing
		// 
		// Security = null;
		// 
		// Create form object

		$objForm = new cFormObj();
		$this->CurrentAction = (@$_GET["a"] <> "") ? $_GET["a"] : @$_POST["a_list"]; // Set up current action
		$this->pro_cat_id->SetVisibility();
		$this->pro_name->SetVisibility();
		$this->pro_feature->SetVisibility();
		$this->pro_img_folder->SetVisibility();
		$this->pro_detail->SetVisibility();
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

			// Handle modal response
			if ($this->IsModal) { // Show as modal
				$row = array("url" => $url, "modal" => "1");
				$pageName = ew_GetPageName($url);
				if ($pageName != $this->GetListUrl()) { // Not List page
					$row["caption"] = $this->GetModalCaption($pageName);
					if ($pageName == "tbl_productview.php")
						$row["view"] = "1";
				} else { // List page should not be shown as modal => error
					$row["error"] = $this->getFailureMessage();
					$this->clearFailureMessage();
				}
				header("Content-Type: application/json; charset=utf-8");
				echo ew_ConvertToUtf8(ew_ArrayToJson(array($row)));
			} else {
				ew_SaveDebugMsg();
				header("Location: " . $url);
			}
		}
		exit();
	}
	var $FormClassName = "form-horizontal ewForm ewAddForm";
	var $IsModal = FALSE;
	var $IsMobileOrModal = FALSE;
	var $DbMasterFilter = "";
	var $DbDetailFilter = "";
	var $StartRec;
	var $Priv = 0;
	var $OldRecordset;
	var $CopyRecord;

	//
	// Page main
	//
	function Page_Main() {
		global $objForm, $Language, $gsFormError;
		global $gbSkipHeaderFooter;

		// Check modal
		if ($this->IsModal)
			$gbSkipHeaderFooter = TRUE;
		$this->IsMobileOrModal = ew_IsMobile() || $this->IsModal;
		$this->FormClassName = "ewForm ewAddForm form-horizontal";

		// Set up current action
		if (@$_POST["a_add"] <> "") {
			$this->CurrentAction = $_POST["a_add"]; // Get form action
		} else { // Not post back

			// Load key values from QueryString
			$this->CopyRecord = TRUE;
			if (@$_GET["pro_id"] != "") {
				$this->pro_id->setQueryStringValue($_GET["pro_id"]);
				$this->setKey("pro_id", $this->pro_id->CurrentValue); // Set up key
			} else {
				$this->setKey("pro_id", ""); // Clear key
				$this->CopyRecord = FALSE;
			}
			if ($this->CopyRecord) {
				$this->CurrentAction = "C"; // Copy record
			} else {
				$this->CurrentAction = "I"; // Display blank record
			}
		}

		// Load old record / default values
		$loaded = $this->LoadOldRecord();

		// Load form values
		if (@$_POST["a_add"] <> "") {
			$this->LoadFormValues(); // Load form values
		}

		// Validate form if post back
		if (@$_POST["a_add"] <> "") {
			if (!$this->ValidateForm()) {
				$this->CurrentAction = "I"; // Form error, reset action
				$this->EventCancelled = TRUE; // Event cancelled
				$this->RestoreFormValues(); // Restore form values
				$this->setFailureMessage($gsFormError);
			}
		}

		// Perform current action
		switch ($this->CurrentAction) {
			case "I": // Blank record
				break;
			case "C": // Copy an existing record
				if (!$loaded) { // Record not loaded
					if ($this->getFailureMessage() == "") $this->setFailureMessage($Language->Phrase("NoRecord")); // No record found
					$this->Page_Terminate("tbl_productlist.php"); // No matching record, return to list
				}
				break;
			case "A": // Add new record
				$this->SendEmail = TRUE; // Send email on add success
				if ($this->AddRow($this->OldRecordset)) { // Add successful
					if ($this->getSuccessMessage() == "")
						$this->setSuccessMessage($Language->Phrase("AddSuccess")); // Set up success message
					$sReturnUrl = $this->getReturnUrl();
					if (ew_GetPageName($sReturnUrl) == "tbl_productlist.php")
						$sReturnUrl = $this->AddMasterUrl($sReturnUrl); // List page, return to List page with correct master key if necessary
					elseif (ew_GetPageName($sReturnUrl) == "tbl_productview.php")
						$sReturnUrl = $this->GetViewUrl(); // View page, return to View page with keyurl directly
					$this->Page_Terminate($sReturnUrl); // Clean up and return
				} else {
					$this->EventCancelled = TRUE; // Event cancelled
					$this->RestoreFormValues(); // Add failed, restore form values
				}
		}

		// Set up Breadcrumb
		$this->SetupBreadcrumb();

		// Render row based on row type
		$this->RowType = EW_ROWTYPE_ADD; // Render add type

		// Render row
		$this->ResetAttrs();
		$this->RenderRow();
	}

	// Get upload files
	function GetUploadFiles() {
		global $objForm, $Language;

		// Get upload data
	}

	// Load default values
	function LoadDefaultValues() {
		$this->pro_id->CurrentValue = NULL;
		$this->pro_id->OldValue = $this->pro_id->CurrentValue;
		$this->pro_cat_id->CurrentValue = NULL;
		$this->pro_cat_id->OldValue = $this->pro_cat_id->CurrentValue;
		$this->pro_name->CurrentValue = NULL;
		$this->pro_name->OldValue = $this->pro_name->CurrentValue;
		$this->pro_feature->CurrentValue = NULL;
		$this->pro_feature->OldValue = $this->pro_feature->CurrentValue;
		$this->pro_img_folder->CurrentValue = NULL;
		$this->pro_img_folder->OldValue = $this->pro_img_folder->CurrentValue;
		$this->pro_detail->CurrentValue = NULL;
		$this->pro_detail->OldValue = $this->pro_detail->CurrentValue;
		$this->price->CurrentValue = NULL;
		$this->price->OldValue = $this->price->CurrentValue;
		$this->pro_keyword->CurrentValue = NULL;
		$this->pro_keyword->OldValue = $this->pro_keyword->CurrentValue;
		$this->pro_status->CurrentValue = "Y";
		$this->col_id->CurrentValue = 0;
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm;
		if (!$this->pro_cat_id->FldIsDetailKey) {
			$this->pro_cat_id->setFormValue($objForm->GetValue("x_pro_cat_id"));
		}
		if (!$this->pro_name->FldIsDetailKey) {
			$this->pro_name->setFormValue($objForm->GetValue("x_pro_name"));
		}
		if (!$this->pro_feature->FldIsDetailKey) {
			$this->pro_feature->setFormValue($objForm->GetValue("x_pro_feature"));
		}
		if (!$this->pro_img_folder->FldIsDetailKey) {
			$this->pro_img_folder->setFormValue($objForm->GetValue("x_pro_img_folder"));
		}
		if (!$this->pro_detail->FldIsDetailKey) {
			$this->pro_detail->setFormValue($objForm->GetValue("x_pro_detail"));
		}
		if (!$this->price->FldIsDetailKey) {
			$this->price->setFormValue($objForm->GetValue("x_price"));
		}
		if (!$this->pro_keyword->FldIsDetailKey) {
			$this->pro_keyword->setFormValue($objForm->GetValue("x_pro_keyword"));
		}
		if (!$this->pro_status->FldIsDetailKey) {
			$this->pro_status->setFormValue($objForm->GetValue("x_pro_status"));
		}
		if (!$this->col_id->FldIsDetailKey) {
			$this->col_id->setFormValue($objForm->GetValue("x_col_id"));
		}
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm;
		$this->pro_cat_id->CurrentValue = $this->pro_cat_id->FormValue;
		$this->pro_name->CurrentValue = $this->pro_name->FormValue;
		$this->pro_feature->CurrentValue = $this->pro_feature->FormValue;
		$this->pro_img_folder->CurrentValue = $this->pro_img_folder->FormValue;
		$this->pro_detail->CurrentValue = $this->pro_detail->FormValue;
		$this->price->CurrentValue = $this->price->FormValue;
		$this->pro_keyword->CurrentValue = $this->pro_keyword->FormValue;
		$this->pro_status->CurrentValue = $this->pro_status->FormValue;
		$this->col_id->CurrentValue = $this->col_id->FormValue;
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
		$this->LoadDefaultValues();
		$row = array();
		$row['pro_id'] = $this->pro_id->CurrentValue;
		$row['pro_cat_id'] = $this->pro_cat_id->CurrentValue;
		$row['pro_name'] = $this->pro_name->CurrentValue;
		$row['pro_feature'] = $this->pro_feature->CurrentValue;
		$row['pro_img_folder'] = $this->pro_img_folder->CurrentValue;
		$row['pro_detail'] = $this->pro_detail->CurrentValue;
		$row['price'] = $this->price->CurrentValue;
		$row['pro_keyword'] = $this->pro_keyword->CurrentValue;
		$row['pro_status'] = $this->pro_status->CurrentValue;
		$row['col_id'] = $this->col_id->CurrentValue;
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

		// pro_detail
		$this->pro_detail->ViewValue = $this->pro_detail->CurrentValue;
		$this->pro_detail->ViewCustomAttributes = "";

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

			// pro_detail
			$this->pro_detail->LinkCustomAttributes = "";
			$this->pro_detail->HrefValue = "";
			$this->pro_detail->TooltipValue = "";

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
		} elseif ($this->RowType == EW_ROWTYPE_ADD) { // Add row

			// pro_cat_id
			$this->pro_cat_id->EditAttrs["class"] = "form-control";
			$this->pro_cat_id->EditCustomAttributes = "";
			$this->pro_cat_id->EditValue = ew_HtmlEncode($this->pro_cat_id->CurrentValue);
			$this->pro_cat_id->PlaceHolder = ew_RemoveHtml($this->pro_cat_id->FldCaption());

			// pro_name
			$this->pro_name->EditAttrs["class"] = "form-control";
			$this->pro_name->EditCustomAttributes = "";
			$this->pro_name->EditValue = ew_HtmlEncode($this->pro_name->CurrentValue);
			$this->pro_name->PlaceHolder = ew_RemoveHtml($this->pro_name->FldCaption());

			// pro_feature
			$this->pro_feature->EditAttrs["class"] = "form-control";
			$this->pro_feature->EditCustomAttributes = "";
			$this->pro_feature->EditValue = ew_HtmlEncode($this->pro_feature->CurrentValue);
			$this->pro_feature->PlaceHolder = ew_RemoveHtml($this->pro_feature->FldCaption());

			// pro_img_folder
			$this->pro_img_folder->EditAttrs["class"] = "form-control";
			$this->pro_img_folder->EditCustomAttributes = "";
			$this->pro_img_folder->EditValue = ew_HtmlEncode($this->pro_img_folder->CurrentValue);
			$this->pro_img_folder->PlaceHolder = ew_RemoveHtml($this->pro_img_folder->FldCaption());

			// pro_detail
			$this->pro_detail->EditAttrs["class"] = "form-control";
			$this->pro_detail->EditCustomAttributes = "";
			$this->pro_detail->EditValue = ew_HtmlEncode($this->pro_detail->CurrentValue);
			$this->pro_detail->PlaceHolder = ew_RemoveHtml($this->pro_detail->FldCaption());

			// price
			$this->price->EditAttrs["class"] = "form-control";
			$this->price->EditCustomAttributes = "";
			$this->price->EditValue = ew_HtmlEncode($this->price->CurrentValue);
			$this->price->PlaceHolder = ew_RemoveHtml($this->price->FldCaption());

			// pro_keyword
			$this->pro_keyword->EditAttrs["class"] = "form-control";
			$this->pro_keyword->EditCustomAttributes = "";
			$this->pro_keyword->EditValue = ew_HtmlEncode($this->pro_keyword->CurrentValue);
			$this->pro_keyword->PlaceHolder = ew_RemoveHtml($this->pro_keyword->FldCaption());

			// pro_status
			$this->pro_status->EditCustomAttributes = "";
			$this->pro_status->EditValue = $this->pro_status->Options(FALSE);

			// col_id
			$this->col_id->EditAttrs["class"] = "form-control";
			$this->col_id->EditCustomAttributes = "";
			$this->col_id->EditValue = ew_HtmlEncode($this->col_id->CurrentValue);
			$this->col_id->PlaceHolder = ew_RemoveHtml($this->col_id->FldCaption());

			// Add refer script
			// pro_cat_id

			$this->pro_cat_id->LinkCustomAttributes = "";
			$this->pro_cat_id->HrefValue = "";

			// pro_name
			$this->pro_name->LinkCustomAttributes = "";
			$this->pro_name->HrefValue = "";

			// pro_feature
			$this->pro_feature->LinkCustomAttributes = "";
			$this->pro_feature->HrefValue = "";

			// pro_img_folder
			$this->pro_img_folder->LinkCustomAttributes = "";
			$this->pro_img_folder->HrefValue = "";

			// pro_detail
			$this->pro_detail->LinkCustomAttributes = "";
			$this->pro_detail->HrefValue = "";

			// price
			$this->price->LinkCustomAttributes = "";
			$this->price->HrefValue = "";

			// pro_keyword
			$this->pro_keyword->LinkCustomAttributes = "";
			$this->pro_keyword->HrefValue = "";

			// pro_status
			$this->pro_status->LinkCustomAttributes = "";
			$this->pro_status->HrefValue = "";

			// col_id
			$this->col_id->LinkCustomAttributes = "";
			$this->col_id->HrefValue = "";
		}
		if ($this->RowType == EW_ROWTYPE_ADD || $this->RowType == EW_ROWTYPE_EDIT || $this->RowType == EW_ROWTYPE_SEARCH) // Add/Edit/Search row
			$this->SetupFieldTitles();

		// Call Row Rendered event
		if ($this->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$this->Row_Rendered();
	}

	// Validate form
	function ValidateForm() {
		global $Language, $gsFormError;

		// Initialize form error message
		$gsFormError = "";

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return ($gsFormError == "");
		if (!ew_CheckInteger($this->pro_cat_id->FormValue)) {
			ew_AddMessage($gsFormError, $this->pro_cat_id->FldErrMsg());
		}
		if (!$this->col_id->FldIsDetailKey && !is_null($this->col_id->FormValue) && $this->col_id->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->col_id->FldCaption(), $this->col_id->ReqErrMsg));
		}
		if (!ew_CheckInteger($this->col_id->FormValue)) {
			ew_AddMessage($gsFormError, $this->col_id->FldErrMsg());
		}

		// Return validate result
		$ValidateForm = ($gsFormError == "");

		// Call Form_CustomValidate event
		$sFormCustomError = "";
		$ValidateForm = $ValidateForm && $this->Form_CustomValidate($sFormCustomError);
		if ($sFormCustomError <> "") {
			ew_AddMessage($gsFormError, $sFormCustomError);
		}
		return $ValidateForm;
	}

	// Add record
	function AddRow($rsold = NULL) {
		global $Language, $Security;
		$conn = &$this->Connection();

		// Load db values from rsold
		$this->LoadDbValues($rsold);
		if ($rsold) {
		}
		$rsnew = array();

		// pro_cat_id
		$this->pro_cat_id->SetDbValueDef($rsnew, $this->pro_cat_id->CurrentValue, NULL, FALSE);

		// pro_name
		$this->pro_name->SetDbValueDef($rsnew, $this->pro_name->CurrentValue, NULL, FALSE);

		// pro_feature
		$this->pro_feature->SetDbValueDef($rsnew, $this->pro_feature->CurrentValue, NULL, FALSE);

		// pro_img_folder
		$this->pro_img_folder->SetDbValueDef($rsnew, $this->pro_img_folder->CurrentValue, NULL, FALSE);

		// pro_detail
		$this->pro_detail->SetDbValueDef($rsnew, $this->pro_detail->CurrentValue, NULL, FALSE);

		// price
		$this->price->SetDbValueDef($rsnew, $this->price->CurrentValue, NULL, FALSE);

		// pro_keyword
		$this->pro_keyword->SetDbValueDef($rsnew, $this->pro_keyword->CurrentValue, NULL, FALSE);

		// pro_status
		$tmpBool = $this->pro_status->CurrentValue;
		if ($tmpBool <> "Y" && $tmpBool <> "N")
			$tmpBool = (!empty($tmpBool)) ? "Y" : "N";
		$this->pro_status->SetDbValueDef($rsnew, $tmpBool, NULL, strval($this->pro_status->CurrentValue) == "");

		// col_id
		$this->col_id->SetDbValueDef($rsnew, $this->col_id->CurrentValue, 0, strval($this->col_id->CurrentValue) == "");

		// Call Row Inserting event
		$rs = ($rsold == NULL) ? NULL : $rsold->fields;
		$bInsertRow = $this->Row_Inserting($rs, $rsnew);
		if ($bInsertRow) {
			$conn->raiseErrorFn = $GLOBALS["EW_ERROR_FN"];
			$AddRow = $this->Insert($rsnew);
			$conn->raiseErrorFn = '';
			if ($AddRow) {
			}
		} else {
			if ($this->getSuccessMessage() <> "" || $this->getFailureMessage() <> "") {

				// Use the message, do nothing
			} elseif ($this->CancelMessage <> "") {
				$this->setFailureMessage($this->CancelMessage);
				$this->CancelMessage = "";
			} else {
				$this->setFailureMessage($Language->Phrase("InsertCancelled"));
			}
			$AddRow = FALSE;
		}
		if ($AddRow) {

			// Call Row Inserted event
			$rs = ($rsold == NULL) ? NULL : $rsold->fields;
			$this->Row_Inserted($rs, $rsnew);
		}
		return $AddRow;
	}

	// Set up Breadcrumb
	function SetupBreadcrumb() {
		global $Breadcrumb, $Language;
		$Breadcrumb = new cBreadcrumb();
		$url = substr(ew_CurrentUrl(), strrpos(ew_CurrentUrl(), "/")+1);
		$Breadcrumb->Add("list", $this->TableVar, $this->AddMasterUrl("tbl_productlist.php"), "", $this->TableVar, TRUE);
		$PageId = ($this->CurrentAction == "C") ? "Copy" : "Add";
		$Breadcrumb->Add("add", $PageId, $url);
	}

	// Setup lookup filters of a field
	function SetupLookupFilters($fld, $pageId = null) {
		global $gsLanguage;
		$pageId = $pageId ?: $this->PageID;
		switch ($fld->FldVar) {
		}
	}

	// Setup AutoSuggest filters of a field
	function SetupAutoSuggestFilters($fld, $pageId = null) {
		global $gsLanguage;
		$pageId = $pageId ?: $this->PageID;
		switch ($fld->FldVar) {
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
}
?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
if (!isset($tbl_product_add)) $tbl_product_add = new ctbl_product_add();

// Page init
$tbl_product_add->Page_Init();

// Page main
$tbl_product_add->Page_Main();

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$tbl_product_add->Page_Render();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">

// Form object
var CurrentPageID = EW_PAGE_ID = "add";
var CurrentForm = ftbl_productadd = new ew_Form("ftbl_productadd", "add");

// Validate form
ftbl_productadd.Validate = function() {
	if (!this.ValidateRequired)
		return true; // Ignore validation
	var $ = jQuery, fobj = this.GetForm(), $fobj = $(fobj);
	if ($fobj.find("#a_confirm").val() == "F")
		return true;
	var elm, felm, uelm, addcnt = 0;
	var $k = $fobj.find("#" + this.FormKeyCountName); // Get key_count
	var rowcnt = ($k[0]) ? parseInt($k.val(), 10) : 1;
	var startcnt = (rowcnt == 0) ? 0 : 1; // Check rowcnt == 0 => Inline-Add
	var gridinsert = $fobj.find("#a_list").val() == "gridinsert";
	for (var i = startcnt; i <= rowcnt; i++) {
		var infix = ($k[0]) ? String(i) : "";
		$fobj.data("rowindex", infix);
			elm = this.GetElements("x" + infix + "_pro_cat_id");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($tbl_product->pro_cat_id->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_col_id");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $tbl_product->col_id->FldCaption(), $tbl_product->col_id->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_col_id");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($tbl_product->col_id->FldErrMsg()) ?>");

			// Fire Form_CustomValidate event
			if (!this.Form_CustomValidate(fobj))
				return false;
	}

	// Process detail forms
	var dfs = $fobj.find("input[name='detailpage']").get();
	for (var i = 0; i < dfs.length; i++) {
		var df = dfs[i], val = df.value;
		if (val && ewForms[val])
			if (!ewForms[val].Validate())
				return false;
	}
	return true;
}

// Form_CustomValidate event
ftbl_productadd.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid.
 	return true;
 }

// Use JavaScript validation or not
ftbl_productadd.ValidateRequired = <?php echo json_encode(EW_CLIENT_VALIDATE) ?>;

// Dynamic selection lists
ftbl_productadd.Lists["x_pro_status[]"] = {"LinkField":"","Ajax":null,"AutoFill":false,"DisplayFields":["","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":""};
ftbl_productadd.Lists["x_pro_status[]"].Options = <?php echo json_encode($tbl_product_add->pro_status->Options()) ?>;

// Form object for search
</script>
<script type="text/javascript">

// Write your client script here, no need to add script tags.
</script>
<?php $tbl_product_add->ShowPageHeader(); ?>
<?php
$tbl_product_add->ShowMessage();
?>
<form name="ftbl_productadd" id="ftbl_productadd" class="<?php echo $tbl_product_add->FormClassName ?>" action="<?php echo ew_CurrentPage() ?>" method="post">
<?php if ($tbl_product_add->CheckToken) { ?>
<input type="hidden" name="<?php echo EW_TOKEN_NAME ?>" value="<?php echo $tbl_product_add->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="tbl_product">
<input type="hidden" name="a_add" id="a_add" value="A">
<input type="hidden" name="modal" value="<?php echo intval($tbl_product_add->IsModal) ?>">
<div class="ewAddDiv"><!-- page* -->
<?php if ($tbl_product->pro_cat_id->Visible) { // pro_cat_id ?>
	<div id="r_pro_cat_id" class="form-group">
		<label id="elh_tbl_product_pro_cat_id" for="x_pro_cat_id" class="<?php echo $tbl_product_add->LeftColumnClass ?>"><?php echo $tbl_product->pro_cat_id->FldCaption() ?></label>
		<div class="<?php echo $tbl_product_add->RightColumnClass ?>"><div<?php echo $tbl_product->pro_cat_id->CellAttributes() ?>>
<span id="el_tbl_product_pro_cat_id">
<input type="text" data-table="tbl_product" data-field="x_pro_cat_id" name="x_pro_cat_id" id="x_pro_cat_id" size="30" placeholder="<?php echo ew_HtmlEncode($tbl_product->pro_cat_id->getPlaceHolder()) ?>" value="<?php echo $tbl_product->pro_cat_id->EditValue ?>"<?php echo $tbl_product->pro_cat_id->EditAttributes() ?>>
</span>
<?php echo $tbl_product->pro_cat_id->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($tbl_product->pro_name->Visible) { // pro_name ?>
	<div id="r_pro_name" class="form-group">
		<label id="elh_tbl_product_pro_name" for="x_pro_name" class="<?php echo $tbl_product_add->LeftColumnClass ?>"><?php echo $tbl_product->pro_name->FldCaption() ?></label>
		<div class="<?php echo $tbl_product_add->RightColumnClass ?>"><div<?php echo $tbl_product->pro_name->CellAttributes() ?>>
<span id="el_tbl_product_pro_name">
<input type="text" data-table="tbl_product" data-field="x_pro_name" name="x_pro_name" id="x_pro_name" size="30" maxlength="250" placeholder="<?php echo ew_HtmlEncode($tbl_product->pro_name->getPlaceHolder()) ?>" value="<?php echo $tbl_product->pro_name->EditValue ?>"<?php echo $tbl_product->pro_name->EditAttributes() ?>>
</span>
<?php echo $tbl_product->pro_name->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($tbl_product->pro_feature->Visible) { // pro_feature ?>
	<div id="r_pro_feature" class="form-group">
		<label id="elh_tbl_product_pro_feature" for="x_pro_feature" class="<?php echo $tbl_product_add->LeftColumnClass ?>"><?php echo $tbl_product->pro_feature->FldCaption() ?></label>
		<div class="<?php echo $tbl_product_add->RightColumnClass ?>"><div<?php echo $tbl_product->pro_feature->CellAttributes() ?>>
<span id="el_tbl_product_pro_feature">
<input type="text" data-table="tbl_product" data-field="x_pro_feature" name="x_pro_feature" id="x_pro_feature" size="30" maxlength="250" placeholder="<?php echo ew_HtmlEncode($tbl_product->pro_feature->getPlaceHolder()) ?>" value="<?php echo $tbl_product->pro_feature->EditValue ?>"<?php echo $tbl_product->pro_feature->EditAttributes() ?>>
</span>
<?php echo $tbl_product->pro_feature->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($tbl_product->pro_img_folder->Visible) { // pro_img_folder ?>
	<div id="r_pro_img_folder" class="form-group">
		<label id="elh_tbl_product_pro_img_folder" for="x_pro_img_folder" class="<?php echo $tbl_product_add->LeftColumnClass ?>"><?php echo $tbl_product->pro_img_folder->FldCaption() ?></label>
		<div class="<?php echo $tbl_product_add->RightColumnClass ?>"><div<?php echo $tbl_product->pro_img_folder->CellAttributes() ?>>
<span id="el_tbl_product_pro_img_folder">
<input type="text" data-table="tbl_product" data-field="x_pro_img_folder" name="x_pro_img_folder" id="x_pro_img_folder" size="30" maxlength="250" placeholder="<?php echo ew_HtmlEncode($tbl_product->pro_img_folder->getPlaceHolder()) ?>" value="<?php echo $tbl_product->pro_img_folder->EditValue ?>"<?php echo $tbl_product->pro_img_folder->EditAttributes() ?>>
</span>
<?php echo $tbl_product->pro_img_folder->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($tbl_product->pro_detail->Visible) { // pro_detail ?>
	<div id="r_pro_detail" class="form-group">
		<label id="elh_tbl_product_pro_detail" class="<?php echo $tbl_product_add->LeftColumnClass ?>"><?php echo $tbl_product->pro_detail->FldCaption() ?></label>
		<div class="<?php echo $tbl_product_add->RightColumnClass ?>"><div<?php echo $tbl_product->pro_detail->CellAttributes() ?>>
<span id="el_tbl_product_pro_detail">
<?php ew_AppendClass($tbl_product->pro_detail->EditAttrs["class"], "editor"); ?>
<textarea data-table="tbl_product" data-field="x_pro_detail" name="x_pro_detail" id="x_pro_detail" cols="20" rows="4" placeholder="<?php echo ew_HtmlEncode($tbl_product->pro_detail->getPlaceHolder()) ?>"<?php echo $tbl_product->pro_detail->EditAttributes() ?>><?php echo $tbl_product->pro_detail->EditValue ?></textarea>
<script type="text/javascript">
ew_CreateEditor("ftbl_productadd", "x_pro_detail", 20, 4, <?php echo ($tbl_product->pro_detail->ReadOnly || FALSE) ? "true" : "false" ?>);
</script>
</span>
<?php echo $tbl_product->pro_detail->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($tbl_product->price->Visible) { // price ?>
	<div id="r_price" class="form-group">
		<label id="elh_tbl_product_price" for="x_price" class="<?php echo $tbl_product_add->LeftColumnClass ?>"><?php echo $tbl_product->price->FldCaption() ?></label>
		<div class="<?php echo $tbl_product_add->RightColumnClass ?>"><div<?php echo $tbl_product->price->CellAttributes() ?>>
<span id="el_tbl_product_price">
<input type="text" data-table="tbl_product" data-field="x_price" name="x_price" id="x_price" size="30" maxlength="250" placeholder="<?php echo ew_HtmlEncode($tbl_product->price->getPlaceHolder()) ?>" value="<?php echo $tbl_product->price->EditValue ?>"<?php echo $tbl_product->price->EditAttributes() ?>>
</span>
<?php echo $tbl_product->price->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($tbl_product->pro_keyword->Visible) { // pro_keyword ?>
	<div id="r_pro_keyword" class="form-group">
		<label id="elh_tbl_product_pro_keyword" for="x_pro_keyword" class="<?php echo $tbl_product_add->LeftColumnClass ?>"><?php echo $tbl_product->pro_keyword->FldCaption() ?></label>
		<div class="<?php echo $tbl_product_add->RightColumnClass ?>"><div<?php echo $tbl_product->pro_keyword->CellAttributes() ?>>
<span id="el_tbl_product_pro_keyword">
<input type="text" data-table="tbl_product" data-field="x_pro_keyword" name="x_pro_keyword" id="x_pro_keyword" size="30" maxlength="250" placeholder="<?php echo ew_HtmlEncode($tbl_product->pro_keyword->getPlaceHolder()) ?>" value="<?php echo $tbl_product->pro_keyword->EditValue ?>"<?php echo $tbl_product->pro_keyword->EditAttributes() ?>>
</span>
<?php echo $tbl_product->pro_keyword->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($tbl_product->pro_status->Visible) { // pro_status ?>
	<div id="r_pro_status" class="form-group">
		<label id="elh_tbl_product_pro_status" class="<?php echo $tbl_product_add->LeftColumnClass ?>"><?php echo $tbl_product->pro_status->FldCaption() ?></label>
		<div class="<?php echo $tbl_product_add->RightColumnClass ?>"><div<?php echo $tbl_product->pro_status->CellAttributes() ?>>
<span id="el_tbl_product_pro_status">
<?php
$selwrk = (ew_ConvertToBool($tbl_product->pro_status->CurrentValue)) ? " checked" : "";
?>
<input type="checkbox" data-table="tbl_product" data-field="x_pro_status" name="x_pro_status[]" id="x_pro_status[]" value="1"<?php echo $selwrk ?><?php echo $tbl_product->pro_status->EditAttributes() ?>>
</span>
<?php echo $tbl_product->pro_status->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($tbl_product->col_id->Visible) { // col_id ?>
	<div id="r_col_id" class="form-group">
		<label id="elh_tbl_product_col_id" for="x_col_id" class="<?php echo $tbl_product_add->LeftColumnClass ?>"><?php echo $tbl_product->col_id->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></label>
		<div class="<?php echo $tbl_product_add->RightColumnClass ?>"><div<?php echo $tbl_product->col_id->CellAttributes() ?>>
<span id="el_tbl_product_col_id">
<input type="text" data-table="tbl_product" data-field="x_col_id" name="x_col_id" id="x_col_id" size="30" placeholder="<?php echo ew_HtmlEncode($tbl_product->col_id->getPlaceHolder()) ?>" value="<?php echo $tbl_product->col_id->EditValue ?>"<?php echo $tbl_product->col_id->EditAttributes() ?>>
</span>
<?php echo $tbl_product->col_id->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$tbl_product_add->IsModal) { ?>
<div class="form-group"><!-- buttons .form-group -->
	<div class="<?php echo $tbl_product_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ewButton" name="btnAction" id="btnAction" type="submit"><?php echo $Language->Phrase("AddBtn") ?></button>
<button class="btn btn-default ewButton" name="btnCancel" id="btnCancel" type="button" data-href="<?php echo $tbl_product_add->getReturnUrl() ?>"><?php echo $Language->Phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<script type="text/javascript">
ftbl_productadd.Init();
</script>
<?php
$tbl_product_add->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<script type="text/javascript">

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$tbl_product_add->Page_Terminate();
?>
