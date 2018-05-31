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

$tbl_customer_delete = NULL; // Initialize page object first

class ctbl_customer_delete extends ctbl_customer {

	// Page ID
	var $PageID = 'delete';

	// Project ID
	var $ProjectID = '{F31CE0FC-C728-4B81-A272-512B856E388F}';

	// Table name
	var $TableName = 'tbl_customer';

	// Page object name
	var $PageObjName = 'tbl_customer_delete';

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
			define("EW_PAGE_ID", 'delete', TRUE);

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

		// User profile
		$UserProfile = new cUserProfile();

		// Security
		$Security = new cAdvancedSecurity();
		if (!$Security->IsLoggedIn()) $Security->AutoLogin();
		$Security->LoadCurrentUserLevel($this->ProjectID . $this->TableName);
		if (!$Security->CanDelete()) {
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

		$this->CurrentAction = (@$_GET["a"] <> "") ? $_GET["a"] : @$_POST["a_list"]; // Set up current action
		$this->cus_id->SetVisibility();
		if ($this->IsAdd() || $this->IsCopy() || $this->IsGridAdd())
			$this->cus_id->Visible = FALSE;
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
			ew_SaveDebugMsg();
			header("Location: " . $url);
		}
		exit();
	}
	var $DbMasterFilter = "";
	var $DbDetailFilter = "";
	var $StartRec;
	var $TotalRecs = 0;
	var $RecCnt;
	var $RecKeys = array();
	var $Recordset;
	var $StartRowCnt = 1;
	var $RowCnt = 0;

	//
	// Page main
	//
	function Page_Main() {
		global $Language;

		// Set up Breadcrumb
		$this->SetupBreadcrumb();

		// Load key parameters
		$this->RecKeys = $this->GetRecordKeys(); // Load record keys
		$sFilter = $this->GetKeyFilter();
		if ($sFilter == "")
			$this->Page_Terminate("tbl_customerlist.php"); // Prevent SQL injection, return to list

		// Set up filter (SQL WHHERE clause) and get return SQL
		// SQL constructor in tbl_customer class, tbl_customerinfo.php

		$this->CurrentFilter = $sFilter;

		// Get action
		if (@$_POST["a_delete"] <> "") {
			$this->CurrentAction = $_POST["a_delete"];
		} elseif (@$_GET["a_delete"] == "1") {
			$this->CurrentAction = "D"; // Delete record directly
		} else {
			$this->CurrentAction = "I"; // Display record
		}
		if ($this->CurrentAction == "D") {
			$this->SendEmail = TRUE; // Send email on delete success
			if ($this->DeleteRows()) { // Delete rows
				if ($this->getSuccessMessage() == "")
					$this->setSuccessMessage($Language->Phrase("DeleteSuccess")); // Set up success message
				$this->Page_Terminate($this->getReturnUrl()); // Return to caller
			} else { // Delete failed
				$this->CurrentAction = "I"; // Display record
			}
		}
		if ($this->CurrentAction == "I") { // Load records for display
			if ($this->Recordset = $this->LoadRecordset())
				$this->TotalRecs = $this->Recordset->RecordCount(); // Get record count
			if ($this->TotalRecs <= 0) { // No record found, exit
				if ($this->Recordset)
					$this->Recordset->Close();
				$this->Page_Terminate("tbl_customerlist.php"); // Return to list
			}
		}
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
		$row = array();
		$row['cus_id'] = NULL;
		$row['cus_name'] = NULL;
		$row['cus_email'] = NULL;
		$row['cus_pwd'] = NULL;
		$row['cus_phone'] = NULL;
		$row['cus_order'] = NULL;
		$row['img_profile'] = NULL;
		$row['cus_status'] = NULL;
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

			// cus_id
			$this->cus_id->LinkCustomAttributes = "";
			$this->cus_id->HrefValue = "";
			$this->cus_id->TooltipValue = "";

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
		}

		// Call Row Rendered event
		if ($this->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$this->Row_Rendered();
	}

	//
	// Delete records based on current filter
	//
	function DeleteRows() {
		global $Language, $Security;
		$DeleteRows = TRUE;
		$sSql = $this->SQL();
		$conn = &$this->Connection();
		$conn->raiseErrorFn = $GLOBALS["EW_ERROR_FN"];
		$rs = $conn->Execute($sSql);
		$conn->raiseErrorFn = '';
		if ($rs === FALSE) {
			return FALSE;
		} elseif ($rs->EOF) {
			$this->setFailureMessage($Language->Phrase("NoRecord")); // No record found
			$rs->Close();
			return FALSE;
		}
		$rows = ($rs) ? $rs->GetRows() : array();
		$conn->BeginTrans();

		// Clone old rows
		$rsold = $rows;
		if ($rs)
			$rs->Close();

		// Call row deleting event
		if ($DeleteRows) {
			foreach ($rsold as $row) {
				$DeleteRows = $this->Row_Deleting($row);
				if (!$DeleteRows) break;
			}
		}
		if ($DeleteRows) {
			$sKey = "";
			foreach ($rsold as $row) {
				$sThisKey = "";
				if ($sThisKey <> "") $sThisKey .= $GLOBALS["EW_COMPOSITE_KEY_SEPARATOR"];
				$sThisKey .= $row['cus_id'];
				$conn->raiseErrorFn = $GLOBALS["EW_ERROR_FN"];
				$DeleteRows = $this->Delete($row); // Delete
				$conn->raiseErrorFn = '';
				if ($DeleteRows === FALSE)
					break;
				if ($sKey <> "") $sKey .= ", ";
				$sKey .= $sThisKey;
			}
		}
		if (!$DeleteRows) {

			// Set up error message
			if ($this->getSuccessMessage() <> "" || $this->getFailureMessage() <> "") {

				// Use the message, do nothing
			} elseif ($this->CancelMessage <> "") {
				$this->setFailureMessage($this->CancelMessage);
				$this->CancelMessage = "";
			} else {
				$this->setFailureMessage($Language->Phrase("DeleteCancelled"));
			}
		}
		if ($DeleteRows) {
			$conn->CommitTrans(); // Commit the changes
		} else {
			$conn->RollbackTrans(); // Rollback changes
		}

		// Call Row Deleted event
		if ($DeleteRows) {
			foreach ($rsold as $row) {
				$this->Row_Deleted($row);
			}
		}
		return $DeleteRows;
	}

	// Set up Breadcrumb
	function SetupBreadcrumb() {
		global $Breadcrumb, $Language;
		$Breadcrumb = new cBreadcrumb();
		$url = substr(ew_CurrentUrl(), strrpos(ew_CurrentUrl(), "/")+1);
		$Breadcrumb->Add("list", $this->TableVar, $this->AddMasterUrl("tbl_customerlist.php"), "", $this->TableVar, TRUE);
		$PageId = "delete";
		$Breadcrumb->Add("delete", $PageId, $url);
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
}
?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
if (!isset($tbl_customer_delete)) $tbl_customer_delete = new ctbl_customer_delete();

// Page init
$tbl_customer_delete->Page_Init();

// Page main
$tbl_customer_delete->Page_Main();

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$tbl_customer_delete->Page_Render();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">

// Form object
var CurrentPageID = EW_PAGE_ID = "delete";
var CurrentForm = ftbl_customerdelete = new ew_Form("ftbl_customerdelete", "delete");

// Form_CustomValidate event
ftbl_customerdelete.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid.
 	return true;
 }

// Use JavaScript validation or not
ftbl_customerdelete.ValidateRequired = <?php echo json_encode(EW_CLIENT_VALIDATE) ?>;

// Dynamic selection lists
ftbl_customerdelete.Lists["x_cus_status[]"] = {"LinkField":"","Ajax":null,"AutoFill":false,"DisplayFields":["","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":""};
ftbl_customerdelete.Lists["x_cus_status[]"].Options = <?php echo json_encode($tbl_customer_delete->cus_status->Options()) ?>;

// Form object for search
</script>
<script type="text/javascript">

// Write your client script here, no need to add script tags.
</script>
<?php $tbl_customer_delete->ShowPageHeader(); ?>
<?php
$tbl_customer_delete->ShowMessage();
?>
<form name="ftbl_customerdelete" id="ftbl_customerdelete" class="form-inline ewForm ewDeleteForm" action="<?php echo ew_CurrentPage() ?>" method="post">
<?php if ($tbl_customer_delete->CheckToken) { ?>
<input type="hidden" name="<?php echo EW_TOKEN_NAME ?>" value="<?php echo $tbl_customer_delete->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="tbl_customer">
<input type="hidden" name="a_delete" id="a_delete" value="D">
<?php foreach ($tbl_customer_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode($EW_COMPOSITE_KEY_SEPARATOR, $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo ew_HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="box ewBox ewGrid">
<div class="<?php if (ew_IsResponsiveLayout()) { ?>table-responsive <?php } ?>ewGridMiddlePanel">
<table class="table ewTable">
	<thead>
	<tr class="ewTableHeader">
<?php if ($tbl_customer->cus_id->Visible) { // cus_id ?>
		<th class="<?php echo $tbl_customer->cus_id->HeaderCellClass() ?>"><span id="elh_tbl_customer_cus_id" class="tbl_customer_cus_id"><?php echo $tbl_customer->cus_id->FldCaption() ?></span></th>
<?php } ?>
<?php if ($tbl_customer->cus_name->Visible) { // cus_name ?>
		<th class="<?php echo $tbl_customer->cus_name->HeaderCellClass() ?>"><span id="elh_tbl_customer_cus_name" class="tbl_customer_cus_name"><?php echo $tbl_customer->cus_name->FldCaption() ?></span></th>
<?php } ?>
<?php if ($tbl_customer->cus_email->Visible) { // cus_email ?>
		<th class="<?php echo $tbl_customer->cus_email->HeaderCellClass() ?>"><span id="elh_tbl_customer_cus_email" class="tbl_customer_cus_email"><?php echo $tbl_customer->cus_email->FldCaption() ?></span></th>
<?php } ?>
<?php if ($tbl_customer->cus_pwd->Visible) { // cus_pwd ?>
		<th class="<?php echo $tbl_customer->cus_pwd->HeaderCellClass() ?>"><span id="elh_tbl_customer_cus_pwd" class="tbl_customer_cus_pwd"><?php echo $tbl_customer->cus_pwd->FldCaption() ?></span></th>
<?php } ?>
<?php if ($tbl_customer->cus_phone->Visible) { // cus_phone ?>
		<th class="<?php echo $tbl_customer->cus_phone->HeaderCellClass() ?>"><span id="elh_tbl_customer_cus_phone" class="tbl_customer_cus_phone"><?php echo $tbl_customer->cus_phone->FldCaption() ?></span></th>
<?php } ?>
<?php if ($tbl_customer->cus_order->Visible) { // cus_order ?>
		<th class="<?php echo $tbl_customer->cus_order->HeaderCellClass() ?>"><span id="elh_tbl_customer_cus_order" class="tbl_customer_cus_order"><?php echo $tbl_customer->cus_order->FldCaption() ?></span></th>
<?php } ?>
<?php if ($tbl_customer->img_profile->Visible) { // img_profile ?>
		<th class="<?php echo $tbl_customer->img_profile->HeaderCellClass() ?>"><span id="elh_tbl_customer_img_profile" class="tbl_customer_img_profile"><?php echo $tbl_customer->img_profile->FldCaption() ?></span></th>
<?php } ?>
<?php if ($tbl_customer->cus_status->Visible) { // cus_status ?>
		<th class="<?php echo $tbl_customer->cus_status->HeaderCellClass() ?>"><span id="elh_tbl_customer_cus_status" class="tbl_customer_cus_status"><?php echo $tbl_customer->cus_status->FldCaption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$tbl_customer_delete->RecCnt = 0;
$i = 0;
while (!$tbl_customer_delete->Recordset->EOF) {
	$tbl_customer_delete->RecCnt++;
	$tbl_customer_delete->RowCnt++;

	// Set row properties
	$tbl_customer->ResetAttrs();
	$tbl_customer->RowType = EW_ROWTYPE_VIEW; // View

	// Get the field contents
	$tbl_customer_delete->LoadRowValues($tbl_customer_delete->Recordset);

	// Render row
	$tbl_customer_delete->RenderRow();
?>
	<tr<?php echo $tbl_customer->RowAttributes() ?>>
<?php if ($tbl_customer->cus_id->Visible) { // cus_id ?>
		<td<?php echo $tbl_customer->cus_id->CellAttributes() ?>>
<span id="el<?php echo $tbl_customer_delete->RowCnt ?>_tbl_customer_cus_id" class="tbl_customer_cus_id">
<span<?php echo $tbl_customer->cus_id->ViewAttributes() ?>>
<?php echo $tbl_customer->cus_id->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($tbl_customer->cus_name->Visible) { // cus_name ?>
		<td<?php echo $tbl_customer->cus_name->CellAttributes() ?>>
<span id="el<?php echo $tbl_customer_delete->RowCnt ?>_tbl_customer_cus_name" class="tbl_customer_cus_name">
<span<?php echo $tbl_customer->cus_name->ViewAttributes() ?>>
<?php echo $tbl_customer->cus_name->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($tbl_customer->cus_email->Visible) { // cus_email ?>
		<td<?php echo $tbl_customer->cus_email->CellAttributes() ?>>
<span id="el<?php echo $tbl_customer_delete->RowCnt ?>_tbl_customer_cus_email" class="tbl_customer_cus_email">
<span<?php echo $tbl_customer->cus_email->ViewAttributes() ?>>
<?php echo $tbl_customer->cus_email->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($tbl_customer->cus_pwd->Visible) { // cus_pwd ?>
		<td<?php echo $tbl_customer->cus_pwd->CellAttributes() ?>>
<span id="el<?php echo $tbl_customer_delete->RowCnt ?>_tbl_customer_cus_pwd" class="tbl_customer_cus_pwd">
<span<?php echo $tbl_customer->cus_pwd->ViewAttributes() ?>>
<?php echo $tbl_customer->cus_pwd->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($tbl_customer->cus_phone->Visible) { // cus_phone ?>
		<td<?php echo $tbl_customer->cus_phone->CellAttributes() ?>>
<span id="el<?php echo $tbl_customer_delete->RowCnt ?>_tbl_customer_cus_phone" class="tbl_customer_cus_phone">
<span<?php echo $tbl_customer->cus_phone->ViewAttributes() ?>>
<?php echo $tbl_customer->cus_phone->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($tbl_customer->cus_order->Visible) { // cus_order ?>
		<td<?php echo $tbl_customer->cus_order->CellAttributes() ?>>
<span id="el<?php echo $tbl_customer_delete->RowCnt ?>_tbl_customer_cus_order" class="tbl_customer_cus_order">
<span<?php echo $tbl_customer->cus_order->ViewAttributes() ?>>
<?php echo $tbl_customer->cus_order->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($tbl_customer->img_profile->Visible) { // img_profile ?>
		<td<?php echo $tbl_customer->img_profile->CellAttributes() ?>>
<span id="el<?php echo $tbl_customer_delete->RowCnt ?>_tbl_customer_img_profile" class="tbl_customer_img_profile">
<span<?php echo $tbl_customer->img_profile->ViewAttributes() ?>>
<?php echo $tbl_customer->img_profile->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($tbl_customer->cus_status->Visible) { // cus_status ?>
		<td<?php echo $tbl_customer->cus_status->CellAttributes() ?>>
<span id="el<?php echo $tbl_customer_delete->RowCnt ?>_tbl_customer_cus_status" class="tbl_customer_cus_status">
<span<?php echo $tbl_customer->cus_status->ViewAttributes() ?>>
<?php if (ew_ConvertToBool($tbl_customer->cus_status->CurrentValue)) { ?>
<input type="checkbox" value="<?php echo $tbl_customer->cus_status->ListViewValue() ?>" disabled checked>
<?php } else { ?>
<input type="checkbox" value="<?php echo $tbl_customer->cus_status->ListViewValue() ?>" disabled>
<?php } ?>
</span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$tbl_customer_delete->Recordset->MoveNext();
}
$tbl_customer_delete->Recordset->Close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ewButton" name="btnAction" id="btnAction" type="submit"><?php echo $Language->Phrase("DeleteBtn") ?></button>
<button class="btn btn-default ewButton" name="btnCancel" id="btnCancel" type="button" data-href="<?php echo $tbl_customer_delete->getReturnUrl() ?>"><?php echo $Language->Phrase("CancelBtn") ?></button>
</div>
</form>
<script type="text/javascript">
ftbl_customerdelete.Init();
</script>
<?php
$tbl_customer_delete->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<script type="text/javascript">

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$tbl_customer_delete->Page_Terminate();
?>
