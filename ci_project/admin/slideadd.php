<?php
if (session_id() == "") session_start(); // Init session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg14.php" ?>
<?php include_once ((EW_USE_ADODB) ? "adodb5/adodb.inc.php" : "ewmysql14.php") ?>
<?php include_once "phpfn14.php" ?>
<?php include_once "slideinfo.php" ?>
<?php include_once "userfn14.php" ?>
<?php

//
// Page class
//

$slide_add = NULL; // Initialize page object first

class cslide_add extends cslide {

	// Page ID
	var $PageID = 'add';

	// Project ID
	var $ProjectID = '{6AF8C2FF-A16C-4050-9229-E3A572D6C974}';

	// Table name
	var $TableName = 'slide';

	// Page object name
	var $PageObjName = 'slide_add';

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

		// Table object (slide)
		if (!isset($GLOBALS["slide"]) || get_class($GLOBALS["slide"]) == "cslide") {
			$GLOBALS["slide"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["slide"];
		}

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'add', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'slide', TRUE);

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
				$this->Page_Terminate(ew_GetUrl("slidelist.php"));
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
		$this->image->SetVisibility();
		$this->upload_date->SetVisibility();
		$this->delete_date->SetVisibility();
		$this->user_create->SetVisibility();
		$this->slide_status->SetVisibility();

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
		global $EW_EXPORT, $slide;
		if ($this->CustomExport <> "" && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, $EW_EXPORT)) {
				$sContent = ob_get_contents();
			if ($gsExportFile == "") $gsExportFile = $this->TableVar;
			$class = $EW_EXPORT[$this->CustomExport];
			if (class_exists($class)) {
				$doc = new $class($slide);
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
					if ($pageName == "slideview.php")
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
			if (@$_GET["slide_id"] != "") {
				$this->slide_id->setQueryStringValue($_GET["slide_id"]);
				$this->setKey("slide_id", $this->slide_id->CurrentValue); // Set up key
			} else {
				$this->setKey("slide_id", ""); // Clear key
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
					$this->Page_Terminate("slidelist.php"); // No matching record, return to list
				}
				break;
			case "A": // Add new record
				$this->SendEmail = TRUE; // Send email on add success
				if ($this->AddRow($this->OldRecordset)) { // Add successful
					if ($this->getSuccessMessage() == "")
						$this->setSuccessMessage($Language->Phrase("AddSuccess")); // Set up success message
					$sReturnUrl = $this->getReturnUrl();
					if (ew_GetPageName($sReturnUrl) == "slidelist.php")
						$sReturnUrl = $this->AddMasterUrl($sReturnUrl); // List page, return to List page with correct master key if necessary
					elseif (ew_GetPageName($sReturnUrl) == "slideview.php")
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
		$this->slide_id->CurrentValue = NULL;
		$this->slide_id->OldValue = $this->slide_id->CurrentValue;
		$this->image->CurrentValue = NULL;
		$this->image->OldValue = $this->image->CurrentValue;
		$this->upload_date->CurrentValue = NULL;
		$this->upload_date->OldValue = $this->upload_date->CurrentValue;
		$this->delete_date->CurrentValue = NULL;
		$this->delete_date->OldValue = $this->delete_date->CurrentValue;
		$this->user_create->CurrentValue = NULL;
		$this->user_create->OldValue = $this->user_create->CurrentValue;
		$this->slide_status->CurrentValue = "Y";
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm;
		if (!$this->image->FldIsDetailKey) {
			$this->image->setFormValue($objForm->GetValue("x_image"));
		}
		if (!$this->upload_date->FldIsDetailKey) {
			$this->upload_date->setFormValue($objForm->GetValue("x_upload_date"));
			$this->upload_date->CurrentValue = ew_UnFormatDateTime($this->upload_date->CurrentValue, 0);
		}
		if (!$this->delete_date->FldIsDetailKey) {
			$this->delete_date->setFormValue($objForm->GetValue("x_delete_date"));
			$this->delete_date->CurrentValue = ew_UnFormatDateTime($this->delete_date->CurrentValue, 0);
		}
		if (!$this->user_create->FldIsDetailKey) {
			$this->user_create->setFormValue($objForm->GetValue("x_user_create"));
		}
		if (!$this->slide_status->FldIsDetailKey) {
			$this->slide_status->setFormValue($objForm->GetValue("x_slide_status"));
		}
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm;
		$this->image->CurrentValue = $this->image->FormValue;
		$this->upload_date->CurrentValue = $this->upload_date->FormValue;
		$this->upload_date->CurrentValue = ew_UnFormatDateTime($this->upload_date->CurrentValue, 0);
		$this->delete_date->CurrentValue = $this->delete_date->FormValue;
		$this->delete_date->CurrentValue = ew_UnFormatDateTime($this->delete_date->CurrentValue, 0);
		$this->user_create->CurrentValue = $this->user_create->FormValue;
		$this->slide_status->CurrentValue = $this->slide_status->FormValue;
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
		$this->slide_id->setDbValue($row['slide_id']);
		$this->image->setDbValue($row['image']);
		$this->upload_date->setDbValue($row['upload_date']);
		$this->delete_date->setDbValue($row['delete_date']);
		$this->user_create->setDbValue($row['user_create']);
		$this->slide_status->setDbValue($row['slide_status']);
	}

	// Return a row with default values
	function NewRow() {
		$this->LoadDefaultValues();
		$row = array();
		$row['slide_id'] = $this->slide_id->CurrentValue;
		$row['image'] = $this->image->CurrentValue;
		$row['upload_date'] = $this->upload_date->CurrentValue;
		$row['delete_date'] = $this->delete_date->CurrentValue;
		$row['user_create'] = $this->user_create->CurrentValue;
		$row['slide_status'] = $this->slide_status->CurrentValue;
		return $row;
	}

	// Load DbValue from recordset
	function LoadDbValues(&$rs) {
		if (!$rs || !is_array($rs) && $rs->EOF)
			return;
		$row = is_array($rs) ? $rs : $rs->fields;
		$this->slide_id->DbValue = $row['slide_id'];
		$this->image->DbValue = $row['image'];
		$this->upload_date->DbValue = $row['upload_date'];
		$this->delete_date->DbValue = $row['delete_date'];
		$this->user_create->DbValue = $row['user_create'];
		$this->slide_status->DbValue = $row['slide_status'];
	}

	// Load old record
	function LoadOldRecord() {

		// Load key values from Session
		$bValidKey = TRUE;
		if (strval($this->getKey("slide_id")) <> "")
			$this->slide_id->CurrentValue = $this->getKey("slide_id"); // slide_id
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
		// slide_id
		// image
		// upload_date
		// delete_date
		// user_create
		// slide_status

		if ($this->RowType == EW_ROWTYPE_VIEW) { // View row

		// slide_id
		$this->slide_id->ViewValue = $this->slide_id->CurrentValue;
		$this->slide_id->ViewCustomAttributes = "";

		// image
		$this->image->ViewValue = $this->image->CurrentValue;
		$this->image->ViewCustomAttributes = "";

		// upload_date
		$this->upload_date->ViewValue = $this->upload_date->CurrentValue;
		$this->upload_date->ViewValue = ew_FormatDateTime($this->upload_date->ViewValue, 0);
		$this->upload_date->ViewCustomAttributes = "";

		// delete_date
		$this->delete_date->ViewValue = $this->delete_date->CurrentValue;
		$this->delete_date->ViewValue = ew_FormatDateTime($this->delete_date->ViewValue, 0);
		$this->delete_date->ViewCustomAttributes = "";

		// user_create
		$this->user_create->ViewValue = $this->user_create->CurrentValue;
		$this->user_create->ViewCustomAttributes = "";

		// slide_status
		if (ew_ConvertToBool($this->slide_status->CurrentValue)) {
			$this->slide_status->ViewValue = $this->slide_status->FldTagCaption(1) <> "" ? $this->slide_status->FldTagCaption(1) : "Y";
		} else {
			$this->slide_status->ViewValue = $this->slide_status->FldTagCaption(2) <> "" ? $this->slide_status->FldTagCaption(2) : "N";
		}
		$this->slide_status->ViewCustomAttributes = "";

			// image
			$this->image->LinkCustomAttributes = "";
			$this->image->HrefValue = "";
			$this->image->TooltipValue = "";

			// upload_date
			$this->upload_date->LinkCustomAttributes = "";
			$this->upload_date->HrefValue = "";
			$this->upload_date->TooltipValue = "";

			// delete_date
			$this->delete_date->LinkCustomAttributes = "";
			$this->delete_date->HrefValue = "";
			$this->delete_date->TooltipValue = "";

			// user_create
			$this->user_create->LinkCustomAttributes = "";
			$this->user_create->HrefValue = "";
			$this->user_create->TooltipValue = "";

			// slide_status
			$this->slide_status->LinkCustomAttributes = "";
			$this->slide_status->HrefValue = "";
			$this->slide_status->TooltipValue = "";
		} elseif ($this->RowType == EW_ROWTYPE_ADD) { // Add row

			// image
			$this->image->EditAttrs["class"] = "form-control";
			$this->image->EditCustomAttributes = "";
			$this->image->EditValue = ew_HtmlEncode($this->image->CurrentValue);
			$this->image->PlaceHolder = ew_RemoveHtml($this->image->FldCaption());

			// upload_date
			$this->upload_date->EditAttrs["class"] = "form-control";
			$this->upload_date->EditCustomAttributes = "";
			$this->upload_date->EditValue = ew_HtmlEncode(ew_FormatDateTime($this->upload_date->CurrentValue, 8));
			$this->upload_date->PlaceHolder = ew_RemoveHtml($this->upload_date->FldCaption());

			// delete_date
			$this->delete_date->EditAttrs["class"] = "form-control";
			$this->delete_date->EditCustomAttributes = "";
			$this->delete_date->EditValue = ew_HtmlEncode(ew_FormatDateTime($this->delete_date->CurrentValue, 8));
			$this->delete_date->PlaceHolder = ew_RemoveHtml($this->delete_date->FldCaption());

			// user_create
			$this->user_create->EditAttrs["class"] = "form-control";
			$this->user_create->EditCustomAttributes = "";
			$this->user_create->EditValue = ew_HtmlEncode($this->user_create->CurrentValue);
			$this->user_create->PlaceHolder = ew_RemoveHtml($this->user_create->FldCaption());

			// slide_status
			$this->slide_status->EditCustomAttributes = "";
			$this->slide_status->EditValue = $this->slide_status->Options(FALSE);

			// Add refer script
			// image

			$this->image->LinkCustomAttributes = "";
			$this->image->HrefValue = "";

			// upload_date
			$this->upload_date->LinkCustomAttributes = "";
			$this->upload_date->HrefValue = "";

			// delete_date
			$this->delete_date->LinkCustomAttributes = "";
			$this->delete_date->HrefValue = "";

			// user_create
			$this->user_create->LinkCustomAttributes = "";
			$this->user_create->HrefValue = "";

			// slide_status
			$this->slide_status->LinkCustomAttributes = "";
			$this->slide_status->HrefValue = "";
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
		if (!ew_CheckDateDef($this->upload_date->FormValue)) {
			ew_AddMessage($gsFormError, $this->upload_date->FldErrMsg());
		}
		if (!ew_CheckDateDef($this->delete_date->FormValue)) {
			ew_AddMessage($gsFormError, $this->delete_date->FldErrMsg());
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

		// image
		$this->image->SetDbValueDef($rsnew, $this->image->CurrentValue, NULL, FALSE);

		// upload_date
		$this->upload_date->SetDbValueDef($rsnew, ew_UnFormatDateTime($this->upload_date->CurrentValue, 0), NULL, FALSE);

		// delete_date
		$this->delete_date->SetDbValueDef($rsnew, ew_UnFormatDateTime($this->delete_date->CurrentValue, 0), NULL, FALSE);

		// user_create
		$this->user_create->SetDbValueDef($rsnew, $this->user_create->CurrentValue, NULL, FALSE);

		// slide_status
		$tmpBool = $this->slide_status->CurrentValue;
		if ($tmpBool <> "Y" && $tmpBool <> "N")
			$tmpBool = (!empty($tmpBool)) ? "Y" : "N";
		$this->slide_status->SetDbValueDef($rsnew, $tmpBool, NULL, strval($this->slide_status->CurrentValue) == "");

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
		$Breadcrumb->Add("list", $this->TableVar, $this->AddMasterUrl("slidelist.php"), "", $this->TableVar, TRUE);
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
if (!isset($slide_add)) $slide_add = new cslide_add();

// Page init
$slide_add->Page_Init();

// Page main
$slide_add->Page_Main();

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$slide_add->Page_Render();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">

// Form object
var CurrentPageID = EW_PAGE_ID = "add";
var CurrentForm = fslideadd = new ew_Form("fslideadd", "add");

// Validate form
fslideadd.Validate = function() {
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
			elm = this.GetElements("x" + infix + "_upload_date");
			if (elm && !ew_CheckDateDef(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($slide->upload_date->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_delete_date");
			if (elm && !ew_CheckDateDef(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($slide->delete_date->FldErrMsg()) ?>");

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
fslideadd.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid.
 	return true;
 }

// Use JavaScript validation or not
fslideadd.ValidateRequired = <?php echo json_encode(EW_CLIENT_VALIDATE) ?>;

// Dynamic selection lists
fslideadd.Lists["x_slide_status[]"] = {"LinkField":"","Ajax":null,"AutoFill":false,"DisplayFields":["","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":""};
fslideadd.Lists["x_slide_status[]"].Options = <?php echo json_encode($slide_add->slide_status->Options()) ?>;

// Form object for search
</script>
<script type="text/javascript">

// Write your client script here, no need to add script tags.
</script>
<?php $slide_add->ShowPageHeader(); ?>
<?php
$slide_add->ShowMessage();
?>
<form name="fslideadd" id="fslideadd" class="<?php echo $slide_add->FormClassName ?>" action="<?php echo ew_CurrentPage() ?>" method="post">
<?php if ($slide_add->CheckToken) { ?>
<input type="hidden" name="<?php echo EW_TOKEN_NAME ?>" value="<?php echo $slide_add->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="slide">
<input type="hidden" name="a_add" id="a_add" value="A">
<input type="hidden" name="modal" value="<?php echo intval($slide_add->IsModal) ?>">
<div class="ewAddDiv"><!-- page* -->
<?php if ($slide->image->Visible) { // image ?>
	<div id="r_image" class="form-group">
		<label id="elh_slide_image" for="x_image" class="<?php echo $slide_add->LeftColumnClass ?>"><?php echo $slide->image->FldCaption() ?></label>
		<div class="<?php echo $slide_add->RightColumnClass ?>"><div<?php echo $slide->image->CellAttributes() ?>>
<span id="el_slide_image">
<input type="text" data-table="slide" data-field="x_image" name="x_image" id="x_image" size="30" maxlength="250" placeholder="<?php echo ew_HtmlEncode($slide->image->getPlaceHolder()) ?>" value="<?php echo $slide->image->EditValue ?>"<?php echo $slide->image->EditAttributes() ?>>
</span>
<?php echo $slide->image->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($slide->upload_date->Visible) { // upload_date ?>
	<div id="r_upload_date" class="form-group">
		<label id="elh_slide_upload_date" for="x_upload_date" class="<?php echo $slide_add->LeftColumnClass ?>"><?php echo $slide->upload_date->FldCaption() ?></label>
		<div class="<?php echo $slide_add->RightColumnClass ?>"><div<?php echo $slide->upload_date->CellAttributes() ?>>
<span id="el_slide_upload_date">
<input type="text" data-table="slide" data-field="x_upload_date" name="x_upload_date" id="x_upload_date" placeholder="<?php echo ew_HtmlEncode($slide->upload_date->getPlaceHolder()) ?>" value="<?php echo $slide->upload_date->EditValue ?>"<?php echo $slide->upload_date->EditAttributes() ?>>
</span>
<?php echo $slide->upload_date->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($slide->delete_date->Visible) { // delete_date ?>
	<div id="r_delete_date" class="form-group">
		<label id="elh_slide_delete_date" for="x_delete_date" class="<?php echo $slide_add->LeftColumnClass ?>"><?php echo $slide->delete_date->FldCaption() ?></label>
		<div class="<?php echo $slide_add->RightColumnClass ?>"><div<?php echo $slide->delete_date->CellAttributes() ?>>
<span id="el_slide_delete_date">
<input type="text" data-table="slide" data-field="x_delete_date" name="x_delete_date" id="x_delete_date" placeholder="<?php echo ew_HtmlEncode($slide->delete_date->getPlaceHolder()) ?>" value="<?php echo $slide->delete_date->EditValue ?>"<?php echo $slide->delete_date->EditAttributes() ?>>
</span>
<?php echo $slide->delete_date->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($slide->user_create->Visible) { // user_create ?>
	<div id="r_user_create" class="form-group">
		<label id="elh_slide_user_create" for="x_user_create" class="<?php echo $slide_add->LeftColumnClass ?>"><?php echo $slide->user_create->FldCaption() ?></label>
		<div class="<?php echo $slide_add->RightColumnClass ?>"><div<?php echo $slide->user_create->CellAttributes() ?>>
<span id="el_slide_user_create">
<input type="text" data-table="slide" data-field="x_user_create" name="x_user_create" id="x_user_create" size="30" maxlength="250" placeholder="<?php echo ew_HtmlEncode($slide->user_create->getPlaceHolder()) ?>" value="<?php echo $slide->user_create->EditValue ?>"<?php echo $slide->user_create->EditAttributes() ?>>
</span>
<?php echo $slide->user_create->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($slide->slide_status->Visible) { // slide_status ?>
	<div id="r_slide_status" class="form-group">
		<label id="elh_slide_slide_status" class="<?php echo $slide_add->LeftColumnClass ?>"><?php echo $slide->slide_status->FldCaption() ?></label>
		<div class="<?php echo $slide_add->RightColumnClass ?>"><div<?php echo $slide->slide_status->CellAttributes() ?>>
<span id="el_slide_slide_status">
<?php
$selwrk = (ew_ConvertToBool($slide->slide_status->CurrentValue)) ? " checked" : "";
?>
<input type="checkbox" data-table="slide" data-field="x_slide_status" name="x_slide_status[]" id="x_slide_status[]" value="1"<?php echo $selwrk ?><?php echo $slide->slide_status->EditAttributes() ?>>
</span>
<?php echo $slide->slide_status->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$slide_add->IsModal) { ?>
<div class="form-group"><!-- buttons .form-group -->
	<div class="<?php echo $slide_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ewButton" name="btnAction" id="btnAction" type="submit"><?php echo $Language->Phrase("AddBtn") ?></button>
<button class="btn btn-default ewButton" name="btnCancel" id="btnCancel" type="button" data-href="<?php echo $slide_add->getReturnUrl() ?>"><?php echo $Language->Phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<script type="text/javascript">
fslideadd.Init();
</script>
<?php
$slide_add->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<script type="text/javascript">

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$slide_add->Page_Terminate();
?>
