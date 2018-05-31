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

$tbl_product_delete = NULL; // Initialize page object first

class ctbl_product_delete extends ctbl_product {

	// Page ID
	var $PageID = 'delete';

	// Project ID
	var $ProjectID = '{F31CE0FC-C728-4B81-A272-512B856E388F}';

	// Table name
	var $TableName = 'tbl_product';

	// Page object name
	var $PageObjName = 'tbl_product_delete';

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
			define("EW_PAGE_ID", 'delete', TRUE);

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
				$this->Page_Terminate(ew_GetUrl("tbl_productlist.php"));
			else
				$this->Page_Terminate(ew_GetUrl("login.php"));
		}

		// NOTE: Security object may be needed in other part of the script, skip set to Nothing
		// 
		// Security = null;
		// 

		$this->CurrentAction = (@$_GET["a"] <> "") ? $_GET["a"] : @$_POST["a_list"]; // Set up current action
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
			$this->Page_Terminate("tbl_productlist.php"); // Prevent SQL injection, return to list

		// Set up filter (SQL WHHERE clause) and get return SQL
		// SQL constructor in tbl_product class, tbl_productinfo.php

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
				$this->Page_Terminate("tbl_productlist.php"); // Return to list
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
				$sThisKey .= $row['pro_id'];
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
		$Breadcrumb->Add("list", $this->TableVar, $this->AddMasterUrl("tbl_productlist.php"), "", $this->TableVar, TRUE);
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
if (!isset($tbl_product_delete)) $tbl_product_delete = new ctbl_product_delete();

// Page init
$tbl_product_delete->Page_Init();

// Page main
$tbl_product_delete->Page_Main();

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$tbl_product_delete->Page_Render();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">

// Form object
var CurrentPageID = EW_PAGE_ID = "delete";
var CurrentForm = ftbl_productdelete = new ew_Form("ftbl_productdelete", "delete");

// Form_CustomValidate event
ftbl_productdelete.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid.
 	return true;
 }

// Use JavaScript validation or not
ftbl_productdelete.ValidateRequired = <?php echo json_encode(EW_CLIENT_VALIDATE) ?>;

// Dynamic selection lists
ftbl_productdelete.Lists["x_pro_status[]"] = {"LinkField":"","Ajax":null,"AutoFill":false,"DisplayFields":["","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":""};
ftbl_productdelete.Lists["x_pro_status[]"].Options = <?php echo json_encode($tbl_product_delete->pro_status->Options()) ?>;

// Form object for search
</script>
<script type="text/javascript">

// Write your client script here, no need to add script tags.
</script>
<?php $tbl_product_delete->ShowPageHeader(); ?>
<?php
$tbl_product_delete->ShowMessage();
?>
<form name="ftbl_productdelete" id="ftbl_productdelete" class="form-inline ewForm ewDeleteForm" action="<?php echo ew_CurrentPage() ?>" method="post">
<?php if ($tbl_product_delete->CheckToken) { ?>
<input type="hidden" name="<?php echo EW_TOKEN_NAME ?>" value="<?php echo $tbl_product_delete->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="tbl_product">
<input type="hidden" name="a_delete" id="a_delete" value="D">
<?php foreach ($tbl_product_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode($EW_COMPOSITE_KEY_SEPARATOR, $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo ew_HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="box ewBox ewGrid">
<div class="<?php if (ew_IsResponsiveLayout()) { ?>table-responsive <?php } ?>ewGridMiddlePanel">
<table class="table ewTable">
	<thead>
	<tr class="ewTableHeader">
<?php if ($tbl_product->pro_id->Visible) { // pro_id ?>
		<th class="<?php echo $tbl_product->pro_id->HeaderCellClass() ?>"><span id="elh_tbl_product_pro_id" class="tbl_product_pro_id"><?php echo $tbl_product->pro_id->FldCaption() ?></span></th>
<?php } ?>
<?php if ($tbl_product->pro_cat_id->Visible) { // pro_cat_id ?>
		<th class="<?php echo $tbl_product->pro_cat_id->HeaderCellClass() ?>"><span id="elh_tbl_product_pro_cat_id" class="tbl_product_pro_cat_id"><?php echo $tbl_product->pro_cat_id->FldCaption() ?></span></th>
<?php } ?>
<?php if ($tbl_product->pro_name->Visible) { // pro_name ?>
		<th class="<?php echo $tbl_product->pro_name->HeaderCellClass() ?>"><span id="elh_tbl_product_pro_name" class="tbl_product_pro_name"><?php echo $tbl_product->pro_name->FldCaption() ?></span></th>
<?php } ?>
<?php if ($tbl_product->pro_feature->Visible) { // pro_feature ?>
		<th class="<?php echo $tbl_product->pro_feature->HeaderCellClass() ?>"><span id="elh_tbl_product_pro_feature" class="tbl_product_pro_feature"><?php echo $tbl_product->pro_feature->FldCaption() ?></span></th>
<?php } ?>
<?php if ($tbl_product->pro_img_folder->Visible) { // pro_img_folder ?>
		<th class="<?php echo $tbl_product->pro_img_folder->HeaderCellClass() ?>"><span id="elh_tbl_product_pro_img_folder" class="tbl_product_pro_img_folder"><?php echo $tbl_product->pro_img_folder->FldCaption() ?></span></th>
<?php } ?>
<?php if ($tbl_product->price->Visible) { // price ?>
		<th class="<?php echo $tbl_product->price->HeaderCellClass() ?>"><span id="elh_tbl_product_price" class="tbl_product_price"><?php echo $tbl_product->price->FldCaption() ?></span></th>
<?php } ?>
<?php if ($tbl_product->pro_keyword->Visible) { // pro_keyword ?>
		<th class="<?php echo $tbl_product->pro_keyword->HeaderCellClass() ?>"><span id="elh_tbl_product_pro_keyword" class="tbl_product_pro_keyword"><?php echo $tbl_product->pro_keyword->FldCaption() ?></span></th>
<?php } ?>
<?php if ($tbl_product->pro_status->Visible) { // pro_status ?>
		<th class="<?php echo $tbl_product->pro_status->HeaderCellClass() ?>"><span id="elh_tbl_product_pro_status" class="tbl_product_pro_status"><?php echo $tbl_product->pro_status->FldCaption() ?></span></th>
<?php } ?>
<?php if ($tbl_product->col_id->Visible) { // col_id ?>
		<th class="<?php echo $tbl_product->col_id->HeaderCellClass() ?>"><span id="elh_tbl_product_col_id" class="tbl_product_col_id"><?php echo $tbl_product->col_id->FldCaption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$tbl_product_delete->RecCnt = 0;
$i = 0;
while (!$tbl_product_delete->Recordset->EOF) {
	$tbl_product_delete->RecCnt++;
	$tbl_product_delete->RowCnt++;

	// Set row properties
	$tbl_product->ResetAttrs();
	$tbl_product->RowType = EW_ROWTYPE_VIEW; // View

	// Get the field contents
	$tbl_product_delete->LoadRowValues($tbl_product_delete->Recordset);

	// Render row
	$tbl_product_delete->RenderRow();
?>
	<tr<?php echo $tbl_product->RowAttributes() ?>>
<?php if ($tbl_product->pro_id->Visible) { // pro_id ?>
		<td<?php echo $tbl_product->pro_id->CellAttributes() ?>>
<span id="el<?php echo $tbl_product_delete->RowCnt ?>_tbl_product_pro_id" class="tbl_product_pro_id">
<span<?php echo $tbl_product->pro_id->ViewAttributes() ?>>
<?php echo $tbl_product->pro_id->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($tbl_product->pro_cat_id->Visible) { // pro_cat_id ?>
		<td<?php echo $tbl_product->pro_cat_id->CellAttributes() ?>>
<span id="el<?php echo $tbl_product_delete->RowCnt ?>_tbl_product_pro_cat_id" class="tbl_product_pro_cat_id">
<span<?php echo $tbl_product->pro_cat_id->ViewAttributes() ?>>
<?php echo $tbl_product->pro_cat_id->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($tbl_product->pro_name->Visible) { // pro_name ?>
		<td<?php echo $tbl_product->pro_name->CellAttributes() ?>>
<span id="el<?php echo $tbl_product_delete->RowCnt ?>_tbl_product_pro_name" class="tbl_product_pro_name">
<span<?php echo $tbl_product->pro_name->ViewAttributes() ?>>
<?php echo $tbl_product->pro_name->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($tbl_product->pro_feature->Visible) { // pro_feature ?>
		<td<?php echo $tbl_product->pro_feature->CellAttributes() ?>>
<span id="el<?php echo $tbl_product_delete->RowCnt ?>_tbl_product_pro_feature" class="tbl_product_pro_feature">
<span<?php echo $tbl_product->pro_feature->ViewAttributes() ?>>
<?php echo $tbl_product->pro_feature->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($tbl_product->pro_img_folder->Visible) { // pro_img_folder ?>
		<td<?php echo $tbl_product->pro_img_folder->CellAttributes() ?>>
<span id="el<?php echo $tbl_product_delete->RowCnt ?>_tbl_product_pro_img_folder" class="tbl_product_pro_img_folder">
<span<?php echo $tbl_product->pro_img_folder->ViewAttributes() ?>>
<?php echo $tbl_product->pro_img_folder->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($tbl_product->price->Visible) { // price ?>
		<td<?php echo $tbl_product->price->CellAttributes() ?>>
<span id="el<?php echo $tbl_product_delete->RowCnt ?>_tbl_product_price" class="tbl_product_price">
<span<?php echo $tbl_product->price->ViewAttributes() ?>>
<?php echo $tbl_product->price->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($tbl_product->pro_keyword->Visible) { // pro_keyword ?>
		<td<?php echo $tbl_product->pro_keyword->CellAttributes() ?>>
<span id="el<?php echo $tbl_product_delete->RowCnt ?>_tbl_product_pro_keyword" class="tbl_product_pro_keyword">
<span<?php echo $tbl_product->pro_keyword->ViewAttributes() ?>>
<?php echo $tbl_product->pro_keyword->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($tbl_product->pro_status->Visible) { // pro_status ?>
		<td<?php echo $tbl_product->pro_status->CellAttributes() ?>>
<span id="el<?php echo $tbl_product_delete->RowCnt ?>_tbl_product_pro_status" class="tbl_product_pro_status">
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
		<td<?php echo $tbl_product->col_id->CellAttributes() ?>>
<span id="el<?php echo $tbl_product_delete->RowCnt ?>_tbl_product_col_id" class="tbl_product_col_id">
<span<?php echo $tbl_product->col_id->ViewAttributes() ?>>
<?php echo $tbl_product->col_id->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$tbl_product_delete->Recordset->MoveNext();
}
$tbl_product_delete->Recordset->Close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ewButton" name="btnAction" id="btnAction" type="submit"><?php echo $Language->Phrase("DeleteBtn") ?></button>
<button class="btn btn-default ewButton" name="btnCancel" id="btnCancel" type="button" data-href="<?php echo $tbl_product_delete->getReturnUrl() ?>"><?php echo $Language->Phrase("CancelBtn") ?></button>
</div>
</form>
<script type="text/javascript">
ftbl_productdelete.Init();
</script>
<?php
$tbl_product_delete->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<script type="text/javascript">

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$tbl_product_delete->Page_Terminate();
?>
