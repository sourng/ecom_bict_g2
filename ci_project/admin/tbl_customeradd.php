<?php
if (session_id() == "") session_start(); // Init session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg14.php" ?>
<?php include_once ((EW_USE_ADODB) ? "adodb5/adodb.inc.php" : "ewmysql14.php") ?>
<?php include_once "phpfn14.php" ?>
<?php include_once "tbl_customerinfo.php" ?>
<?php include_once "userfn14.php" ?>
<?php

//
// Page class
//

$tbl_customer_add = NULL; // Initialize page object first

class ctbl_customer_add extends ctbl_customer {

	// Page ID
	var $PageID = 'add';

	// Project ID
	var $ProjectID = '{F31CE0FC-C728-4B81-A272-512B856E388F}';

	// Table name
	var $TableName = 'tbl_customer';

	// Page object name
	var $PageObjName = 'tbl_customer_add';

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

		// Table object (tbl_customer)
		if (!isset($GLOBALS["tbl_customer"]) || get_class($GLOBALS["tbl_customer"]) == "ctbl_customer") {
			$GLOBALS["tbl_customer"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["tbl_customer"];
		}

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'add', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'tbl_customer', TRUE);

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
				$this->Page_Terminate(ew_GetUrl("tbl_customerlist.php"));
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
		$this->cus_name->SetVisibility();
		$this->cus_email->SetVisibility();
		$this->cus_pwd->SetVisibility();
		$this->cus_phone->SetVisibility();
		$this->cus_order->SetVisibility();
		$this->img_profile->SetVisibility();
		$this->cus_status->SetVisibility();

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
		global $EW_EXPORT, $tbl_customer;
		if ($this->CustomExport <> "" && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, $EW_EXPORT)) {
				$sContent = ob_get_contents();
			if ($gsExportFile == "") $gsExportFile = $this->TableVar;
			$class = $EW_EXPORT[$this->CustomExport];
			if (class_exists($class)) {
				$doc = new $class($tbl_customer);
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
					if ($pageName == "tbl_customerview.php")
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
			if (@$_GET["cus_id"] != "") {
				$this->cus_id->setQueryStringValue($_GET["cus_id"]);
				$this->setKey("cus_id", $this->cus_id->CurrentValue); // Set up key
			} else {
				$this->setKey("cus_id", ""); // Clear key
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
					$this->Page_Terminate("tbl_customerlist.php"); // No matching record, return to list
				}
				break;
			case "A": // Add new record
				$this->SendEmail = TRUE; // Send email on add success
				if ($this->AddRow($this->OldRecordset)) { // Add successful
					if ($this->getSuccessMessage() == "")
						$this->setSuccessMessage($Language->Phrase("AddSuccess")); // Set up success message
					$sReturnUrl = $this->getReturnUrl();
					if (ew_GetPageName($sReturnUrl) == "tbl_customerlist.php")
						$sReturnUrl = $this->AddMasterUrl($sReturnUrl); // List page, return to List page with correct master key if necessary
					elseif (ew_GetPageName($sReturnUrl) == "tbl_customerview.php")
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
		$this->cus_id->CurrentValue = NULL;
		$this->cus_id->OldValue = $this->cus_id->CurrentValue;
		$this->cus_name->CurrentValue = NULL;
		$this->cus_name->OldValue = $this->cus_name->CurrentValue;
		$this->cus_email->CurrentValue = NULL;
		$this->cus_email->OldValue = $this->cus_email->CurrentValue;
		$this->cus_pwd->CurrentValue = NULL;
		$this->cus_pwd->OldValue = $this->cus_pwd->CurrentValue;
		$this->cus_phone->CurrentValue = NULL;
		$this->cus_phone->OldValue = $this->cus_phone->CurrentValue;
		$this->cus_order->CurrentValue = NULL;
		$this->cus_order->OldValue = $this->cus_order->CurrentValue;
		$this->img_profile->CurrentValue = NULL;
		$this->img_profile->OldValue = $this->img_profile->CurrentValue;
		$this->cus_status->CurrentValue = "Y";
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm;
		if (!$this->cus_name->FldIsDetailKey) {
			$this->cus_name->setFormValue($objForm->GetValue("x_cus_name"));
		}
		if (!$this->cus_email->FldIsDetailKey) {
			$this->cus_email->setFormValue($objForm->GetValue("x_cus_email"));
		}
		if (!$this->cus_pwd->FldIsDetailKey) {
			$this->cus_pwd->setFormValue($objForm->GetValue("x_cus_pwd"));
		}
		if (!$this->cus_phone->FldIsDetailKey) {
			$this->cus_phone->setFormValue($objForm->GetValue("x_cus_phone"));
		}
		if (!$this->cus_order->FldIsDetailKey) {
			$this->cus_order->setFormValue($objForm->GetValue("x_cus_order"));
		}
		if (!$this->img_profile->FldIsDetailKey) {
			$this->img_profile->setFormValue($objForm->GetValue("x_img_profile"));
		}
		if (!$this->cus_status->FldIsDetailKey) {
			$this->cus_status->setFormValue($objForm->GetValue("x_cus_status"));
		}
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm;
		$this->cus_name->CurrentValue = $this->cus_name->FormValue;
		$this->cus_email->CurrentValue = $this->cus_email->FormValue;
		$this->cus_pwd->CurrentValue = $this->cus_pwd->FormValue;
		$this->cus_phone->CurrentValue = $this->cus_phone->FormValue;
		$this->cus_order->CurrentValue = $this->cus_order->FormValue;
		$this->img_profile->CurrentValue = $this->img_profile->FormValue;
		$this->cus_status->CurrentValue = $this->cus_status->FormValue;
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
		$this->cus_id->setDbValue($row['cus_id']);
		$this->cus_name->setDbValue($row['cus_name']);
		$this->cus_email->setDbValue($row['cus_email']);
		$this->cus_pwd->setDbValue($row['cus_pwd']);
		$this->cus_phone->setDbValue($row['cus_phone']);
		$this->cus_order->setDbValue($row['cus_order']);
		$this->img_profile->setDbValue($row['img_profile']);
		$this->cus_status->setDbValue($row['cus_status']);
	}

	// Return a row with default values
	function NewRow() {
		$this->LoadDefaultValues();
		$row = array();
		$row['cus_id'] = $this->cus_id->CurrentValue;
		$row['cus_name'] = $this->cus_name->CurrentValue;
		$row['cus_email'] = $this->cus_email->CurrentValue;
		$row['cus_pwd'] = $this->cus_pwd->CurrentValue;
		$row['cus_phone'] = $this->cus_phone->CurrentValue;
		$row['cus_order'] = $this->cus_order->CurrentValue;
		$row['img_profile'] = $this->img_profile->CurrentValue;
		$row['cus_status'] = $this->cus_status->CurrentValue;
		return $row;
	}

	// Load DbValue from recordset
	function LoadDbValues(&$rs) {
		if (!$rs || !is_array($rs) && $rs->EOF)
			return;
		$row = is_array($rs) ? $rs : $rs->fields;
		$this->cus_id->DbValue = $row['cus_id'];
		$this->cus_name->DbValue = $row['cus_name'];
		$this->cus_email->DbValue = $row['cus_email'];
		$this->cus_pwd->DbValue = $row['cus_pwd'];
		$this->cus_phone->DbValue = $row['cus_phone'];
		$this->cus_order->DbValue = $row['cus_order'];
		$this->img_profile->DbValue = $row['img_profile'];
		$this->cus_status->DbValue = $row['cus_status'];
	}

	// Load old record
	function LoadOldRecord() {

		// Load key values from Session
		$bValidKey = TRUE;
		if (strval($this->getKey("cus_id")) <> "")
			$this->cus_id->CurrentValue = $this->getKey("cus_id"); // cus_id
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
		// cus_id
		// cus_name
		// cus_email
		// cus_pwd
		// cus_phone
		// cus_order
		// img_profile
		// cus_status

		if ($this->RowType == EW_ROWTYPE_VIEW) { // View row

		// cus_id
		$this->cus_id->ViewValue = $this->cus_id->CurrentValue;
		$this->cus_id->ViewCustomAttributes = "";

		// cus_name
		$this->cus_name->ViewValue = $this->cus_name->CurrentValue;
		$this->cus_name->ViewCustomAttributes = "";

		// cus_email
		$this->cus_email->ViewValue = $this->cus_email->CurrentValue;
		$this->cus_email->ViewCustomAttributes = "";

		// cus_pwd
		$this->cus_pwd->ViewValue = $this->cus_pwd->CurrentValue;
		$this->cus_pwd->ViewCustomAttributes = "";

		// cus_phone
		$this->cus_phone->ViewValue = $this->cus_phone->CurrentValue;
		$this->cus_phone->ViewCustomAttributes = "";

		// cus_order
		$this->cus_order->ViewValue = $this->cus_order->CurrentValue;
		$this->cus_order->ViewCustomAttributes = "";

		// img_profile
		$this->img_profile->ViewValue = $this->img_profile->CurrentValue;
		$this->img_profile->ViewCustomAttributes = "";

		// cus_status
		if (ew_ConvertToBool($this->cus_status->CurrentValue)) {
			$this->cus_status->ViewValue = $this->cus_status->FldTagCaption(1) <> "" ? $this->cus_status->FldTagCaption(1) : "Y";
		} else {
			$this->cus_status->ViewValue = $this->cus_status->FldTagCaption(2) <> "" ? $this->cus_status->FldTagCaption(2) : "N";
		}
		$this->cus_status->ViewCustomAttributes = "";

			// cus_name
			$this->cus_name->LinkCustomAttributes = "";
			$this->cus_name->HrefValue = "";
			$this->cus_name->TooltipValue = "";

			// cus_email
			$this->cus_email->LinkCustomAttributes = "";
			$this->cus_email->HrefValue = "";
			$this->cus_email->TooltipValue = "";

			// cus_pwd
			$this->cus_pwd->LinkCustomAttributes = "";
			$this->cus_pwd->HrefValue = "";
			$this->cus_pwd->TooltipValue = "";

			// cus_phone
			$this->cus_phone->LinkCustomAttributes = "";
			$this->cus_phone->HrefValue = "";
			$this->cus_phone->TooltipValue = "";

			// cus_order
			$this->cus_order->LinkCustomAttributes = "";
			$this->cus_order->HrefValue = "";
			$this->cus_order->TooltipValue = "";

			// img_profile
			$this->img_profile->LinkCustomAttributes = "";
			$this->img_profile->HrefValue = "";
			$this->img_profile->TooltipValue = "";

			// cus_status
			$this->cus_status->LinkCustomAttributes = "";
			$this->cus_status->HrefValue = "";
			$this->cus_status->TooltipValue = "";
		} elseif ($this->RowType == EW_ROWTYPE_ADD) { // Add row

			// cus_name
			$this->cus_name->EditAttrs["class"] = "form-control";
			$this->cus_name->EditCustomAttributes = "";
			$this->cus_name->EditValue = ew_HtmlEncode($this->cus_name->CurrentValue);
			$this->cus_name->PlaceHolder = ew_RemoveHtml($this->cus_name->FldCaption());

			// cus_email
			$this->cus_email->EditAttrs["class"] = "form-control";
			$this->cus_email->EditCustomAttributes = "";
			$this->cus_email->EditValue = ew_HtmlEncode($this->cus_email->CurrentValue);
			$this->cus_email->PlaceHolder = ew_RemoveHtml($this->cus_email->FldCaption());

			// cus_pwd
			$this->cus_pwd->EditAttrs["class"] = "form-control";
			$this->cus_pwd->EditCustomAttributes = "";
			$this->cus_pwd->EditValue = ew_HtmlEncode($this->cus_pwd->CurrentValue);
			$this->cus_pwd->PlaceHolder = ew_RemoveHtml($this->cus_pwd->FldCaption());

			// cus_phone
			$this->cus_phone->EditAttrs["class"] = "form-control";
			$this->cus_phone->EditCustomAttributes = "";
			$this->cus_phone->EditValue = ew_HtmlEncode($this->cus_phone->CurrentValue);
			$this->cus_phone->PlaceHolder = ew_RemoveHtml($this->cus_phone->FldCaption());

			// cus_order
			$this->cus_order->EditAttrs["class"] = "form-control";
			$this->cus_order->EditCustomAttributes = "";
			$this->cus_order->EditValue = ew_HtmlEncode($this->cus_order->CurrentValue);
			$this->cus_order->PlaceHolder = ew_RemoveHtml($this->cus_order->FldCaption());

			// img_profile
			$this->img_profile->EditAttrs["class"] = "form-control";
			$this->img_profile->EditCustomAttributes = "";
			$this->img_profile->EditValue = ew_HtmlEncode($this->img_profile->CurrentValue);
			$this->img_profile->PlaceHolder = ew_RemoveHtml($this->img_profile->FldCaption());

			// cus_status
			$this->cus_status->EditCustomAttributes = "";
			$this->cus_status->EditValue = $this->cus_status->Options(FALSE);

			// Add refer script
			// cus_name

			$this->cus_name->LinkCustomAttributes = "";
			$this->cus_name->HrefValue = "";

			// cus_email
			$this->cus_email->LinkCustomAttributes = "";
			$this->cus_email->HrefValue = "";

			// cus_pwd
			$this->cus_pwd->LinkCustomAttributes = "";
			$this->cus_pwd->HrefValue = "";

			// cus_phone
			$this->cus_phone->LinkCustomAttributes = "";
			$this->cus_phone->HrefValue = "";

			// cus_order
			$this->cus_order->LinkCustomAttributes = "";
			$this->cus_order->HrefValue = "";

			// img_profile
			$this->img_profile->LinkCustomAttributes = "";
			$this->img_profile->HrefValue = "";

			// cus_status
			$this->cus_status->LinkCustomAttributes = "";
			$this->cus_status->HrefValue = "";
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

		// cus_name
		$this->cus_name->SetDbValueDef($rsnew, $this->cus_name->CurrentValue, NULL, FALSE);

		// cus_email
		$this->cus_email->SetDbValueDef($rsnew, $this->cus_email->CurrentValue, NULL, FALSE);

		// cus_pwd
		$this->cus_pwd->SetDbValueDef($rsnew, $this->cus_pwd->CurrentValue, NULL, FALSE);

		// cus_phone
		$this->cus_phone->SetDbValueDef($rsnew, $this->cus_phone->CurrentValue, NULL, FALSE);

		// cus_order
		$this->cus_order->SetDbValueDef($rsnew, $this->cus_order->CurrentValue, NULL, FALSE);

		// img_profile
		$this->img_profile->SetDbValueDef($rsnew, $this->img_profile->CurrentValue, NULL, FALSE);

		// cus_status
		$tmpBool = $this->cus_status->CurrentValue;
		if ($tmpBool <> "Y" && $tmpBool <> "N")
			$tmpBool = (!empty($tmpBool)) ? "Y" : "N";
		$this->cus_status->SetDbValueDef($rsnew, $tmpBool, NULL, strval($this->cus_status->CurrentValue) == "");

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
		$Breadcrumb->Add("list", $this->TableVar, $this->AddMasterUrl("tbl_customerlist.php"), "", $this->TableVar, TRUE);
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
if (!isset($tbl_customer_add)) $tbl_customer_add = new ctbl_customer_add();

// Page init
$tbl_customer_add->Page_Init();

// Page main
$tbl_customer_add->Page_Main();

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$tbl_customer_add->Page_Render();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">

// Form object
var CurrentPageID = EW_PAGE_ID = "add";
var CurrentForm = ftbl_customeradd = new ew_Form("ftbl_customeradd", "add");

// Validate form
ftbl_customeradd.Validate = function() {
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
ftbl_customeradd.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid.
 	return true;
 }

// Use JavaScript validation or not
ftbl_customeradd.ValidateRequired = <?php echo json_encode(EW_CLIENT_VALIDATE) ?>;

// Dynamic selection lists
ftbl_customeradd.Lists["x_cus_status[]"] = {"LinkField":"","Ajax":null,"AutoFill":false,"DisplayFields":["","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":""};
ftbl_customeradd.Lists["x_cus_status[]"].Options = <?php echo json_encode($tbl_customer_add->cus_status->Options()) ?>;

// Form object for search
</script>
<script type="text/javascript">

// Write your client script here, no need to add script tags.
</script>
<?php $tbl_customer_add->ShowPageHeader(); ?>
<?php
$tbl_customer_add->ShowMessage();
?>
<form name="ftbl_customeradd" id="ftbl_customeradd" class="<?php echo $tbl_customer_add->FormClassName ?>" action="<?php echo ew_CurrentPage() ?>" method="post">
<?php if ($tbl_customer_add->CheckToken) { ?>
<input type="hidden" name="<?php echo EW_TOKEN_NAME ?>" value="<?php echo $tbl_customer_add->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="tbl_customer">
<input type="hidden" name="a_add" id="a_add" value="A">
<input type="hidden" name="modal" value="<?php echo intval($tbl_customer_add->IsModal) ?>">
<div class="ewAddDiv"><!-- page* -->
<?php if ($tbl_customer->cus_name->Visible) { // cus_name ?>
	<div id="r_cus_name" class="form-group">
		<label id="elh_tbl_customer_cus_name" for="x_cus_name" class="<?php echo $tbl_customer_add->LeftColumnClass ?>"><?php echo $tbl_customer->cus_name->FldCaption() ?></label>
		<div class="<?php echo $tbl_customer_add->RightColumnClass ?>"><div<?php echo $tbl_customer->cus_name->CellAttributes() ?>>
<span id="el_tbl_customer_cus_name">
<input type="text" data-table="tbl_customer" data-field="x_cus_name" name="x_cus_name" id="x_cus_name" size="30" maxlength="250" placeholder="<?php echo ew_HtmlEncode($tbl_customer->cus_name->getPlaceHolder()) ?>" value="<?php echo $tbl_customer->cus_name->EditValue ?>"<?php echo $tbl_customer->cus_name->EditAttributes() ?>>
</span>
<?php echo $tbl_customer->cus_name->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($tbl_customer->cus_email->Visible) { // cus_email ?>
	<div id="r_cus_email" class="form-group">
		<label id="elh_tbl_customer_cus_email" for="x_cus_email" class="<?php echo $tbl_customer_add->LeftColumnClass ?>"><?php echo $tbl_customer->cus_email->FldCaption() ?></label>
		<div class="<?php echo $tbl_customer_add->RightColumnClass ?>"><div<?php echo $tbl_customer->cus_email->CellAttributes() ?>>
<span id="el_tbl_customer_cus_email">
<input type="text" data-table="tbl_customer" data-field="x_cus_email" name="x_cus_email" id="x_cus_email" size="30" maxlength="250" placeholder="<?php echo ew_HtmlEncode($tbl_customer->cus_email->getPlaceHolder()) ?>" value="<?php echo $tbl_customer->cus_email->EditValue ?>"<?php echo $tbl_customer->cus_email->EditAttributes() ?>>
</span>
<?php echo $tbl_customer->cus_email->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($tbl_customer->cus_pwd->Visible) { // cus_pwd ?>
	<div id="r_cus_pwd" class="form-group">
		<label id="elh_tbl_customer_cus_pwd" for="x_cus_pwd" class="<?php echo $tbl_customer_add->LeftColumnClass ?>"><?php echo $tbl_customer->cus_pwd->FldCaption() ?></label>
		<div class="<?php echo $tbl_customer_add->RightColumnClass ?>"><div<?php echo $tbl_customer->cus_pwd->CellAttributes() ?>>
<span id="el_tbl_customer_cus_pwd">
<input type="text" data-table="tbl_customer" data-field="x_cus_pwd" name="x_cus_pwd" id="x_cus_pwd" size="30" maxlength="250" placeholder="<?php echo ew_HtmlEncode($tbl_customer->cus_pwd->getPlaceHolder()) ?>" value="<?php echo $tbl_customer->cus_pwd->EditValue ?>"<?php echo $tbl_customer->cus_pwd->EditAttributes() ?>>
</span>
<?php echo $tbl_customer->cus_pwd->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($tbl_customer->cus_phone->Visible) { // cus_phone ?>
	<div id="r_cus_phone" class="form-group">
		<label id="elh_tbl_customer_cus_phone" for="x_cus_phone" class="<?php echo $tbl_customer_add->LeftColumnClass ?>"><?php echo $tbl_customer->cus_phone->FldCaption() ?></label>
		<div class="<?php echo $tbl_customer_add->RightColumnClass ?>"><div<?php echo $tbl_customer->cus_phone->CellAttributes() ?>>
<span id="el_tbl_customer_cus_phone">
<input type="text" data-table="tbl_customer" data-field="x_cus_phone" name="x_cus_phone" id="x_cus_phone" size="30" maxlength="250" placeholder="<?php echo ew_HtmlEncode($tbl_customer->cus_phone->getPlaceHolder()) ?>" value="<?php echo $tbl_customer->cus_phone->EditValue ?>"<?php echo $tbl_customer->cus_phone->EditAttributes() ?>>
</span>
<?php echo $tbl_customer->cus_phone->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($tbl_customer->cus_order->Visible) { // cus_order ?>
	<div id="r_cus_order" class="form-group">
		<label id="elh_tbl_customer_cus_order" for="x_cus_order" class="<?php echo $tbl_customer_add->LeftColumnClass ?>"><?php echo $tbl_customer->cus_order->FldCaption() ?></label>
		<div class="<?php echo $tbl_customer_add->RightColumnClass ?>"><div<?php echo $tbl_customer->cus_order->CellAttributes() ?>>
<span id="el_tbl_customer_cus_order">
<input type="text" data-table="tbl_customer" data-field="x_cus_order" name="x_cus_order" id="x_cus_order" size="30" maxlength="250" placeholder="<?php echo ew_HtmlEncode($tbl_customer->cus_order->getPlaceHolder()) ?>" value="<?php echo $tbl_customer->cus_order->EditValue ?>"<?php echo $tbl_customer->cus_order->EditAttributes() ?>>
</span>
<?php echo $tbl_customer->cus_order->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($tbl_customer->img_profile->Visible) { // img_profile ?>
	<div id="r_img_profile" class="form-group">
		<label id="elh_tbl_customer_img_profile" for="x_img_profile" class="<?php echo $tbl_customer_add->LeftColumnClass ?>"><?php echo $tbl_customer->img_profile->FldCaption() ?></label>
		<div class="<?php echo $tbl_customer_add->RightColumnClass ?>"><div<?php echo $tbl_customer->img_profile->CellAttributes() ?>>
<span id="el_tbl_customer_img_profile">
<input type="text" data-table="tbl_customer" data-field="x_img_profile" name="x_img_profile" id="x_img_profile" size="30" maxlength="250" placeholder="<?php echo ew_HtmlEncode($tbl_customer->img_profile->getPlaceHolder()) ?>" value="<?php echo $tbl_customer->img_profile->EditValue ?>"<?php echo $tbl_customer->img_profile->EditAttributes() ?>>
</span>
<?php echo $tbl_customer->img_profile->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($tbl_customer->cus_status->Visible) { // cus_status ?>
	<div id="r_cus_status" class="form-group">
		<label id="elh_tbl_customer_cus_status" class="<?php echo $tbl_customer_add->LeftColumnClass ?>"><?php echo $tbl_customer->cus_status->FldCaption() ?></label>
		<div class="<?php echo $tbl_customer_add->RightColumnClass ?>"><div<?php echo $tbl_customer->cus_status->CellAttributes() ?>>
<span id="el_tbl_customer_cus_status">
<?php
$selwrk = (ew_ConvertToBool($tbl_customer->cus_status->CurrentValue)) ? " checked" : "";
?>
<input type="checkbox" data-table="tbl_customer" data-field="x_cus_status" name="x_cus_status[]" id="x_cus_status[]" value="1"<?php echo $selwrk ?><?php echo $tbl_customer->cus_status->EditAttributes() ?>>
</span>
<?php echo $tbl_customer->cus_status->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$tbl_customer_add->IsModal) { ?>
<div class="form-group"><!-- buttons .form-group -->
	<div class="<?php echo $tbl_customer_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ewButton" name="btnAction" id="btnAction" type="submit"><?php echo $Language->Phrase("AddBtn") ?></button>
<button class="btn btn-default ewButton" name="btnCancel" id="btnCancel" type="button" data-href="<?php echo $tbl_customer_add->getReturnUrl() ?>"><?php echo $Language->Phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<script type="text/javascript">
ftbl_customeradd.Init();
</script>
<?php
$tbl_customer_add->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<script type="text/javascript">

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$tbl_customer_add->Page_Terminate();
?>
