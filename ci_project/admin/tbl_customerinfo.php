<?php

// Global variable for table object
$tbl_customer = NULL;

//
// Table class for tbl_customer
//
class ctbl_customer extends cTable {
	var $cus_id;
	var $cus_name;
	var $cus_email;
	var $cus_pwd;
	var $cus_phone;
	var $cus_order;
	var $img_profile;
	var $cus_status;

	//
	// Table class constructor
	//
	function __construct() {
		global $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();
		$this->TableVar = 'tbl_customer';
		$this->TableName = 'tbl_customer';
		$this->TableType = 'TABLE';

		// Update Table
		$this->UpdateTable = "`tbl_customer`";
		$this->DBID = 'DB';
		$this->ExportAll = TRUE;
		$this->ExportPageBreakCount = 0; // Page break per every n record (PDF only)
		$this->ExportPageOrientation = "portrait"; // Page orientation (PDF only)
		$this->ExportPageSize = "a4"; // Page size (PDF only)
		$this->ExportExcelPageOrientation = ""; // Page orientation (PHPExcel only)
		$this->ExportExcelPageSize = ""; // Page size (PHPExcel only)
		$this->ExportWordPageOrientation = "portrait"; // Page orientation (PHPWord only)
		$this->ExportWordColumnWidth = NULL; // Cell width (PHPWord only)
		$this->DetailAdd = FALSE; // Allow detail add
		$this->DetailEdit = FALSE; // Allow detail edit
		$this->DetailView = FALSE; // Allow detail view
		$this->ShowMultipleDetails = FALSE; // Show multiple details
		$this->GridAddRowCount = 5;
		$this->AllowAddDeleteRow = TRUE; // Allow add/delete row
		$this->UserIDAllowSecurity = 0; // User ID Allow
		$this->BasicSearch = new cBasicSearch($this->TableVar);

		// cus_id
		$this->cus_id = new cField('tbl_customer', 'tbl_customer', 'x_cus_id', 'cus_id', '`cus_id`', '`cus_id`', 3, -1, FALSE, '`cus_id`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'NO');
		$this->cus_id->Sortable = TRUE; // Allow sort
		$this->cus_id->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['cus_id'] = &$this->cus_id;

		// cus_name
		$this->cus_name = new cField('tbl_customer', 'tbl_customer', 'x_cus_name', 'cus_name', '`cus_name`', '`cus_name`', 200, -1, FALSE, '`cus_name`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->cus_name->Sortable = TRUE; // Allow sort
		$this->fields['cus_name'] = &$this->cus_name;

		// cus_email
		$this->cus_email = new cField('tbl_customer', 'tbl_customer', 'x_cus_email', 'cus_email', '`cus_email`', '`cus_email`', 200, -1, FALSE, '`cus_email`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->cus_email->Sortable = TRUE; // Allow sort
		$this->fields['cus_email'] = &$this->cus_email;

		// cus_pwd
		$this->cus_pwd = new cField('tbl_customer', 'tbl_customer', 'x_cus_pwd', 'cus_pwd', '`cus_pwd`', '`cus_pwd`', 200, -1, FALSE, '`cus_pwd`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->cus_pwd->Sortable = TRUE; // Allow sort
		$this->fields['cus_pwd'] = &$this->cus_pwd;

		// cus_phone
		$this->cus_phone = new cField('tbl_customer', 'tbl_customer', 'x_cus_phone', 'cus_phone', '`cus_phone`', '`cus_phone`', 200, -1, FALSE, '`cus_phone`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->cus_phone->Sortable = TRUE; // Allow sort
		$this->fields['cus_phone'] = &$this->cus_phone;

		// cus_order
		$this->cus_order = new cField('tbl_customer', 'tbl_customer', 'x_cus_order', 'cus_order', '`cus_order`', '`cus_order`', 200, -1, FALSE, '`cus_order`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->cus_order->Sortable = TRUE; // Allow sort
		$this->fields['cus_order'] = &$this->cus_order;

		// img_profile
		$this->img_profile = new cField('tbl_customer', 'tbl_customer', 'x_img_profile', 'img_profile', '`img_profile`', '`img_profile`', 200, -1, FALSE, '`img_profile`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->img_profile->Sortable = TRUE; // Allow sort
		$this->fields['img_profile'] = &$this->img_profile;

		// cus_status
		$this->cus_status = new cField('tbl_customer', 'tbl_customer', 'x_cus_status', 'cus_status', '`cus_status`', '`cus_status`', 202, -1, FALSE, '`cus_status`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'CHECKBOX');
		$this->cus_status->Sortable = TRUE; // Allow sort
		$this->cus_status->FldDataType = EW_DATATYPE_BOOLEAN;
		$this->cus_status->TrueValue = 'Y';
		$this->cus_status->FalseValue = 'N';
		$this->cus_status->OptionCount = 2;
		$this->fields['cus_status'] = &$this->cus_status;
	}

	// Field Visibility
	function GetFieldVisibility($fldparm) {
		global $Security;
		return $this->$fldparm->Visible; // Returns original value
	}

	// Column CSS classes
	var $LeftColumnClass = "col-sm-2 control-label ewLabel";
	var $RightColumnClass = "col-sm-10";
	var $OffsetColumnClass = "col-sm-10 col-sm-offset-2";

	// Set left column class (must be predefined col-*-* classes of Bootstrap grid system)
	function SetLeftColumnClass($class) {
		if (preg_match('/^col\-(\w+)\-(\d+)$/', $class, $match)) {
			$this->LeftColumnClass = $class . " control-label ewLabel";
			$this->RightColumnClass = "col-" . $match[1] . "-" . strval(12 - intval($match[2]));
			$this->OffsetColumnClass = $this->RightColumnClass . " " . str_replace($match[1], $match[1] + "-offset", $class);
		}
	}

	// Single column sort
	function UpdateSort(&$ofld) {
		if ($this->CurrentOrder == $ofld->FldName) {
			$sSortField = $ofld->FldExpression;
			$sLastSort = $ofld->getSort();
			if ($this->CurrentOrderType == "ASC" || $this->CurrentOrderType == "DESC") {
				$sThisSort = $this->CurrentOrderType;
			} else {
				$sThisSort = ($sLastSort == "ASC") ? "DESC" : "ASC";
			}
			$ofld->setSort($sThisSort);
			$this->setSessionOrderBy($sSortField . " " . $sThisSort); // Save to Session
		} else {
			$ofld->setSort("");
		}
	}

	// Table level SQL
	var $_SqlFrom = "";

	function getSqlFrom() { // From
		return ($this->_SqlFrom <> "") ? $this->_SqlFrom : "`tbl_customer`";
	}

	function SqlFrom() { // For backward compatibility
		return $this->getSqlFrom();
	}

	function setSqlFrom($v) {
		$this->_SqlFrom = $v;
	}
	var $_SqlSelect = "";

	function getSqlSelect() { // Select
		return ($this->_SqlSelect <> "") ? $this->_SqlSelect : "SELECT * FROM " . $this->getSqlFrom();
	}

	function SqlSelect() { // For backward compatibility
		return $this->getSqlSelect();
	}

	function setSqlSelect($v) {
		$this->_SqlSelect = $v;
	}
	var $_SqlWhere = "";

	function getSqlWhere() { // Where
		$sWhere = ($this->_SqlWhere <> "") ? $this->_SqlWhere : "";
		$this->TableFilter = "";
		ew_AddFilter($sWhere, $this->TableFilter);
		return $sWhere;
	}

	function SqlWhere() { // For backward compatibility
		return $this->getSqlWhere();
	}

	function setSqlWhere($v) {
		$this->_SqlWhere = $v;
	}
	var $_SqlGroupBy = "";

	function getSqlGroupBy() { // Group By
		return ($this->_SqlGroupBy <> "") ? $this->_SqlGroupBy : "";
	}

	function SqlGroupBy() { // For backward compatibility
		return $this->getSqlGroupBy();
	}

	function setSqlGroupBy($v) {
		$this->_SqlGroupBy = $v;
	}
	var $_SqlHaving = "";

	function getSqlHaving() { // Having
		return ($this->_SqlHaving <> "") ? $this->_SqlHaving : "";
	}

	function SqlHaving() { // For backward compatibility
		return $this->getSqlHaving();
	}

	function setSqlHaving($v) {
		$this->_SqlHaving = $v;
	}
	var $_SqlOrderBy = "";

	function getSqlOrderBy() { // Order By
		return ($this->_SqlOrderBy <> "") ? $this->_SqlOrderBy : "";
	}

	function SqlOrderBy() { // For backward compatibility
		return $this->getSqlOrderBy();
	}

	function setSqlOrderBy($v) {
		$this->_SqlOrderBy = $v;
	}

	// Apply User ID filters
	function ApplyUserIDFilters($sFilter) {
		return $sFilter;
	}

	// Check if User ID security allows view all
	function UserIDAllow($id = "") {
		$allow = EW_USER_ID_ALLOW;
		switch ($id) {
			case "add":
			case "copy":
			case "gridadd":
			case "register":
			case "addopt":
				return (($allow & 1) == 1);
			case "edit":
			case "gridedit":
			case "update":
			case "changepwd":
			case "forgotpwd":
				return (($allow & 4) == 4);
			case "delete":
				return (($allow & 2) == 2);
			case "view":
				return (($allow & 32) == 32);
			case "search":
				return (($allow & 64) == 64);
			default:
				return (($allow & 8) == 8);
		}
	}

	// Get SQL
	function GetSQL($where, $orderby) {
		return ew_BuildSelectSql($this->getSqlSelect(), $this->getSqlWhere(),
			$this->getSqlGroupBy(), $this->getSqlHaving(), $this->getSqlOrderBy(),
			$where, $orderby);
	}

	// Table SQL
	function SQL() {
		$filter = $this->CurrentFilter;
		$filter = $this->ApplyUserIDFilters($filter);
		$sort = $this->getSessionOrderBy();
		return $this->GetSQL($filter, $sort);
	}

	// Table SQL with List page filter
	var $UseSessionForListSQL = TRUE;

	function ListSQL() {
		$sFilter = $this->UseSessionForListSQL ? $this->getSessionWhere() : "";
		ew_AddFilter($sFilter, $this->CurrentFilter);
		$sFilter = $this->ApplyUserIDFilters($sFilter);
		$this->Recordset_Selecting($sFilter);
		$sSelect = $this->getSqlSelect();
		$sSort = $this->UseSessionForListSQL ? $this->getSessionOrderBy() : "";
		return ew_BuildSelectSql($sSelect, $this->getSqlWhere(), $this->getSqlGroupBy(),
			$this->getSqlHaving(), $this->getSqlOrderBy(), $sFilter, $sSort);
	}

	// Get ORDER BY clause
	function GetOrderBy() {
		$sSort = $this->getSessionOrderBy();
		return ew_BuildSelectSql("", "", "", "", $this->getSqlOrderBy(), "", $sSort);
	}

	// Try to get record count
	function TryGetRecordCount($sql) {
		$cnt = -1;
		$pattern = "/^SELECT \* FROM/i";
		if (($this->TableType == 'TABLE' || $this->TableType == 'VIEW' || $this->TableType == 'LINKTABLE') && preg_match($pattern, $sql)) {
			$sql = "SELECT COUNT(*) FROM" . preg_replace($pattern, "", $sql);
		} else {
			$sql = "SELECT COUNT(*) FROM (" . $sql . ") EW_COUNT_TABLE";
		}
		$conn = &$this->Connection();
		if ($rs = $conn->Execute($sql)) {
			if (!$rs->EOF && $rs->FieldCount() > 0) {
				$cnt = $rs->fields[0];
				$rs->Close();
			}
		}
		return intval($cnt);
	}

	// Get record count based on filter (for detail record count in master table pages)
	function LoadRecordCount($filter) {
		$origFilter = $this->CurrentFilter;
		$this->CurrentFilter = $filter;
		$this->Recordset_Selecting($this->CurrentFilter);
		$select = $this->TableType == 'CUSTOMVIEW' ? $this->getSqlSelect() : "SELECT * FROM " . $this->getSqlFrom();
		$groupBy = $this->TableType == 'CUSTOMVIEW' ? $this->getSqlGroupBy() : "";
		$having = $this->TableType == 'CUSTOMVIEW' ? $this->getSqlHaving() : "";
		$sql = ew_BuildSelectSql($select, $this->getSqlWhere(), $groupBy, $having, "", $this->CurrentFilter, "");
		$cnt = $this->TryGetRecordCount($sql);
		if ($cnt == -1) {
			if ($rs = $this->LoadRs($this->CurrentFilter)) {
				$cnt = $rs->RecordCount();
				$rs->Close();
			}
		}
		$this->CurrentFilter = $origFilter;
		return intval($cnt);
	}

	// Get record count (for current List page)
	function ListRecordCount() {
		$filter = $this->getSessionWhere();
		ew_AddFilter($filter, $this->CurrentFilter);
		$filter = $this->ApplyUserIDFilters($filter);
		$this->Recordset_Selecting($filter);
		$select = $this->TableType == 'CUSTOMVIEW' ? $this->getSqlSelect() : "SELECT * FROM " . $this->getSqlFrom();
		$groupBy = $this->TableType == 'CUSTOMVIEW' ? $this->getSqlGroupBy() : "";
		$having = $this->TableType == 'CUSTOMVIEW' ? $this->getSqlHaving() : "";
		$sql = ew_BuildSelectSql($select, $this->getSqlWhere(), $groupBy, $having, "", $filter, "");
		$cnt = $this->TryGetRecordCount($sql);
		if ($cnt == -1) {
			$conn = &$this->Connection();
			if ($rs = $conn->Execute($sql)) {
				$cnt = $rs->RecordCount();
				$rs->Close();
			}
		}
		return intval($cnt);
	}

	// INSERT statement
	function InsertSQL(&$rs) {
		$names = "";
		$values = "";
		foreach ($rs as $name => $value) {
			if (!isset($this->fields[$name]) || $this->fields[$name]->FldIsCustom)
				continue;
			$names .= $this->fields[$name]->FldExpression . ",";
			$values .= ew_QuotedValue($value, $this->fields[$name]->FldDataType, $this->DBID) . ",";
		}
		$names = preg_replace('/,+$/', "", $names);
		$values = preg_replace('/,+$/', "", $values);
		return "INSERT INTO " . $this->UpdateTable . " ($names) VALUES ($values)";
	}

	// Insert
	function Insert(&$rs) {
		$conn = &$this->Connection();
		$bInsert = $conn->Execute($this->InsertSQL($rs));
		if ($bInsert) {

			// Get insert id if necessary
			$this->cus_id->setDbValue($conn->Insert_ID());
			$rs['cus_id'] = $this->cus_id->DbValue;
		}
		return $bInsert;
	}

	// UPDATE statement
	function UpdateSQL(&$rs, $where = "", $curfilter = TRUE) {
		$sql = "UPDATE " . $this->UpdateTable . " SET ";
		foreach ($rs as $name => $value) {
			if (!isset($this->fields[$name]) || $this->fields[$name]->FldIsCustom)
				continue;
			$sql .= $this->fields[$name]->FldExpression . "=";
			$sql .= ew_QuotedValue($value, $this->fields[$name]->FldDataType, $this->DBID) . ",";
		}
		$sql = preg_replace('/,+$/', "", $sql);
		$filter = ($curfilter) ? $this->CurrentFilter : "";
		if (is_array($where))
			$where = $this->ArrayToFilter($where);
		ew_AddFilter($filter, $where);
		if ($filter <> "")	$sql .= " WHERE " . $filter;
		return $sql;
	}

	// Update
	function Update(&$rs, $where = "", $rsold = NULL, $curfilter = TRUE) {
		$conn = &$this->Connection();
		$bUpdate = $conn->Execute($this->UpdateSQL($rs, $where, $curfilter));
		return $bUpdate;
	}

	// DELETE statement
	function DeleteSQL(&$rs, $where = "", $curfilter = TRUE) {
		$sql = "DELETE FROM " . $this->UpdateTable . " WHERE ";
		if (is_array($where))
			$where = $this->ArrayToFilter($where);
		if ($rs) {
			if (array_key_exists('cus_id', $rs))
				ew_AddFilter($where, ew_QuotedName('cus_id', $this->DBID) . '=' . ew_QuotedValue($rs['cus_id'], $this->cus_id->FldDataType, $this->DBID));
		}
		$filter = ($curfilter) ? $this->CurrentFilter : "";
		ew_AddFilter($filter, $where);
		if ($filter <> "")
			$sql .= $filter;
		else
			$sql .= "0=1"; // Avoid delete
		return $sql;
	}

	// Delete
	function Delete(&$rs, $where = "", $curfilter = TRUE) {
		$bDelete = TRUE;
		$conn = &$this->Connection();
		if ($bDelete)
			$bDelete = $conn->Execute($this->DeleteSQL($rs, $where, $curfilter));
		return $bDelete;
	}

	// Key filter WHERE clause
	function SqlKeyFilter() {
		return "`cus_id` = @cus_id@";
	}

	// Key filter
	function KeyFilter() {
		$sKeyFilter = $this->SqlKeyFilter();
		if (!is_numeric($this->cus_id->CurrentValue))
			return "0=1"; // Invalid key
		if (is_null($this->cus_id->CurrentValue))
			return "0=1"; // Invalid key
		else
			$sKeyFilter = str_replace("@cus_id@", ew_AdjustSql($this->cus_id->CurrentValue, $this->DBID), $sKeyFilter); // Replace key value
		return $sKeyFilter;
	}

	// Return page URL
	function getReturnUrl() {
		$name = EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_RETURN_URL;

		// Get referer URL automatically
		if (ew_ServerVar("HTTP_REFERER") <> "" && ew_ReferPage() <> ew_CurrentPage() && ew_ReferPage() <> "login.php") // Referer not same page or login page
			$_SESSION[$name] = ew_ServerVar("HTTP_REFERER"); // Save to Session
		if (@$_SESSION[$name] <> "") {
			return $_SESSION[$name];
		} else {
			return "tbl_customerlist.php";
		}
	}

	function setReturnUrl($v) {
		$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_RETURN_URL] = $v;
	}

	// Get modal caption
	function GetModalCaption($pageName) {
		global $Language;
		if ($pageName == "tbl_customerview.php")
			return $Language->Phrase("View");
		elseif ($pageName == "tbl_customeredit.php")
			return $Language->Phrase("Edit");
		elseif ($pageName == "tbl_customeradd.php")
			return $Language->Phrase("Add");
		else
			return "";
	}

	// List URL
	function GetListUrl() {
		return "tbl_customerlist.php";
	}

	// View URL
	function GetViewUrl($parm = "") {
		if ($parm <> "")
			$url = $this->KeyUrl("tbl_customerview.php", $this->UrlParm($parm));
		else
			$url = $this->KeyUrl("tbl_customerview.php", $this->UrlParm(EW_TABLE_SHOW_DETAIL . "="));
		return $this->AddMasterUrl($url);
	}

	// Add URL
	function GetAddUrl($parm = "") {
		if ($parm <> "")
			$url = "tbl_customeradd.php?" . $this->UrlParm($parm);
		else
			$url = "tbl_customeradd.php";
		return $this->AddMasterUrl($url);
	}

	// Edit URL
	function GetEditUrl($parm = "") {
		$url = $this->KeyUrl("tbl_customeredit.php", $this->UrlParm($parm));
		return $this->AddMasterUrl($url);
	}

	// Inline edit URL
	function GetInlineEditUrl() {
		$url = $this->KeyUrl(ew_CurrentPage(), $this->UrlParm("a=edit"));
		return $this->AddMasterUrl($url);
	}

	// Copy URL
	function GetCopyUrl($parm = "") {
		$url = $this->KeyUrl("tbl_customeradd.php", $this->UrlParm($parm));
		return $this->AddMasterUrl($url);
	}

	// Inline copy URL
	function GetInlineCopyUrl() {
		$url = $this->KeyUrl(ew_CurrentPage(), $this->UrlParm("a=copy"));
		return $this->AddMasterUrl($url);
	}

	// Delete URL
	function GetDeleteUrl() {
		return $this->KeyUrl("tbl_customerdelete.php", $this->UrlParm());
	}

	// Add master url
	function AddMasterUrl($url) {
		return $url;
	}

	function KeyToJson() {
		$json = "";
		$json .= "cus_id:" . ew_VarToJson($this->cus_id->CurrentValue, "number", "'");
		return "{" . $json . "}";
	}

	// Add key value to URL
	function KeyUrl($url, $parm = "") {
		$sUrl = $url . "?";
		if ($parm <> "") $sUrl .= $parm . "&";
		if (!is_null($this->cus_id->CurrentValue)) {
			$sUrl .= "cus_id=" . urlencode($this->cus_id->CurrentValue);
		} else {
			return "javascript:ew_Alert(ewLanguage.Phrase('InvalidRecord'));";
		}
		return $sUrl;
	}

	// Sort URL
	function SortUrl(&$fld) {
		if ($this->CurrentAction <> "" || $this->Export <> "" ||
			in_array($fld->FldType, array(128, 204, 205))) { // Unsortable data type
				return "";
		} elseif ($fld->Sortable) {
			$sUrlParm = $this->UrlParm("order=" . urlencode($fld->FldName) . "&amp;ordertype=" . $fld->ReverseSort());
			return $this->AddMasterUrl(ew_CurrentPage() . "?" . $sUrlParm);
		} else {
			return "";
		}
	}

	// Get record keys from $_POST/$_GET/$_SESSION
	function GetRecordKeys() {
		global $EW_COMPOSITE_KEY_SEPARATOR;
		$arKeys = array();
		$arKey = array();
		if (isset($_POST["key_m"])) {
			$arKeys = $_POST["key_m"];
			$cnt = count($arKeys);
		} elseif (isset($_GET["key_m"])) {
			$arKeys = $_GET["key_m"];
			$cnt = count($arKeys);
		} elseif (!empty($_GET) || !empty($_POST)) {
			$isPost = ew_IsPost();
			if ($isPost && isset($_POST["cus_id"]))
				$arKeys[] = $_POST["cus_id"];
			elseif (isset($_GET["cus_id"]))
				$arKeys[] = $_GET["cus_id"];
			else
				$arKeys = NULL; // Do not setup

			//return $arKeys; // Do not return yet, so the values will also be checked by the following code
		}

		// Check keys
		$ar = array();
		if (is_array($arKeys)) {
			foreach ($arKeys as $key) {
				if (!is_numeric($key))
					continue;
				$ar[] = $key;
			}
		}
		return $ar;
	}

	// Get key filter
	function GetKeyFilter() {
		$arKeys = $this->GetRecordKeys();
		$sKeyFilter = "";
		foreach ($arKeys as $key) {
			if ($sKeyFilter <> "") $sKeyFilter .= " OR ";
			$this->cus_id->CurrentValue = $key;
			$sKeyFilter .= "(" . $this->KeyFilter() . ")";
		}
		return $sKeyFilter;
	}

	// Load rows based on filter
	function &LoadRs($filter) {

		// Set up filter (SQL WHERE clause) and get return SQL
		//$this->CurrentFilter = $filter;
		//$sql = $this->SQL();

		$sql = $this->GetSQL($filter, "");
		$conn = &$this->Connection();
		$rs = $conn->Execute($sql);
		return $rs;
	}

	// Load row values from recordset
	function LoadListRowValues(&$rs) {
		$this->cus_id->setDbValue($rs->fields('cus_id'));
		$this->cus_name->setDbValue($rs->fields('cus_name'));
		$this->cus_email->setDbValue($rs->fields('cus_email'));
		$this->cus_pwd->setDbValue($rs->fields('cus_pwd'));
		$this->cus_phone->setDbValue($rs->fields('cus_phone'));
		$this->cus_order->setDbValue($rs->fields('cus_order'));
		$this->img_profile->setDbValue($rs->fields('img_profile'));
		$this->cus_status->setDbValue($rs->fields('cus_status'));
	}

	// Render list row values
	function RenderListRow() {
		global $Security, $gsLanguage, $Language;

		// Call Row Rendering event
		$this->Row_Rendering();

	// Common render codes
		// cus_id
		// cus_name
		// cus_email
		// cus_pwd
		// cus_phone
		// cus_order
		// img_profile
		// cus_status
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

		// Call Row Rendered event
		$this->Row_Rendered();

		// Save data for Custom Template
		$this->Rows[] = $this->CustomTemplateFieldValues();
	}

	// Render edit row values
	function RenderEditRow() {
		global $Security, $gsLanguage, $Language;

		// Call Row Rendering event
		$this->Row_Rendering();

		// cus_id
		$this->cus_id->EditAttrs["class"] = "form-control";
		$this->cus_id->EditCustomAttributes = "";
		$this->cus_id->EditValue = $this->cus_id->CurrentValue;
		$this->cus_id->ViewCustomAttributes = "";

		// cus_name
		$this->cus_name->EditAttrs["class"] = "form-control";
		$this->cus_name->EditCustomAttributes = "";
		$this->cus_name->EditValue = $this->cus_name->CurrentValue;
		$this->cus_name->PlaceHolder = ew_RemoveHtml($this->cus_name->FldCaption());

		// cus_email
		$this->cus_email->EditAttrs["class"] = "form-control";
		$this->cus_email->EditCustomAttributes = "";
		$this->cus_email->EditValue = $this->cus_email->CurrentValue;
		$this->cus_email->PlaceHolder = ew_RemoveHtml($this->cus_email->FldCaption());

		// cus_pwd
		$this->cus_pwd->EditAttrs["class"] = "form-control";
		$this->cus_pwd->EditCustomAttributes = "";
		$this->cus_pwd->EditValue = $this->cus_pwd->CurrentValue;
		$this->cus_pwd->PlaceHolder = ew_RemoveHtml($this->cus_pwd->FldCaption());

		// cus_phone
		$this->cus_phone->EditAttrs["class"] = "form-control";
		$this->cus_phone->EditCustomAttributes = "";
		$this->cus_phone->EditValue = $this->cus_phone->CurrentValue;
		$this->cus_phone->PlaceHolder = ew_RemoveHtml($this->cus_phone->FldCaption());

		// cus_order
		$this->cus_order->EditAttrs["class"] = "form-control";
		$this->cus_order->EditCustomAttributes = "";
		$this->cus_order->EditValue = $this->cus_order->CurrentValue;
		$this->cus_order->PlaceHolder = ew_RemoveHtml($this->cus_order->FldCaption());

		// img_profile
		$this->img_profile->EditAttrs["class"] = "form-control";
		$this->img_profile->EditCustomAttributes = "";
		$this->img_profile->EditValue = $this->img_profile->CurrentValue;
		$this->img_profile->PlaceHolder = ew_RemoveHtml($this->img_profile->FldCaption());

		// cus_status
		$this->cus_status->EditCustomAttributes = "";
		$this->cus_status->EditValue = $this->cus_status->Options(FALSE);

		// Call Row Rendered event
		$this->Row_Rendered();
	}

	// Aggregate list row values
	function AggregateListRowValues() {
	}

	// Aggregate list row (for rendering)
	function AggregateListRow() {

		// Call Row Rendered event
		$this->Row_Rendered();
	}
	var $ExportDoc;

	// Export data in HTML/CSV/Word/Excel/Email/PDF format
	function ExportDocument(&$Doc, &$Recordset, $StartRec, $StopRec, $ExportPageType = "") {
		if (!$Recordset || !$Doc)
			return;
		if (!$Doc->ExportCustom) {

			// Write header
			$Doc->ExportTableHeader();
			if ($Doc->Horizontal) { // Horizontal format, write header
				$Doc->BeginExportRow();
				if ($ExportPageType == "view") {
					if ($this->cus_id->Exportable) $Doc->ExportCaption($this->cus_id);
					if ($this->cus_name->Exportable) $Doc->ExportCaption($this->cus_name);
					if ($this->cus_email->Exportable) $Doc->ExportCaption($this->cus_email);
					if ($this->cus_pwd->Exportable) $Doc->ExportCaption($this->cus_pwd);
					if ($this->cus_phone->Exportable) $Doc->ExportCaption($this->cus_phone);
					if ($this->cus_order->Exportable) $Doc->ExportCaption($this->cus_order);
					if ($this->img_profile->Exportable) $Doc->ExportCaption($this->img_profile);
					if ($this->cus_status->Exportable) $Doc->ExportCaption($this->cus_status);
				} else {
					if ($this->cus_id->Exportable) $Doc->ExportCaption($this->cus_id);
					if ($this->cus_name->Exportable) $Doc->ExportCaption($this->cus_name);
					if ($this->cus_email->Exportable) $Doc->ExportCaption($this->cus_email);
					if ($this->cus_pwd->Exportable) $Doc->ExportCaption($this->cus_pwd);
					if ($this->cus_phone->Exportable) $Doc->ExportCaption($this->cus_phone);
					if ($this->cus_order->Exportable) $Doc->ExportCaption($this->cus_order);
					if ($this->img_profile->Exportable) $Doc->ExportCaption($this->img_profile);
					if ($this->cus_status->Exportable) $Doc->ExportCaption($this->cus_status);
				}
				$Doc->EndExportRow();
			}
		}

		// Move to first record
		$RecCnt = $StartRec - 1;
		if (!$Recordset->EOF) {
			$Recordset->MoveFirst();
			if ($StartRec > 1)
				$Recordset->Move($StartRec - 1);
		}
		while (!$Recordset->EOF && $RecCnt < $StopRec) {
			$RecCnt++;
			if (intval($RecCnt) >= intval($StartRec)) {
				$RowCnt = intval($RecCnt) - intval($StartRec) + 1;

				// Page break
				if ($this->ExportPageBreakCount > 0) {
					if ($RowCnt > 1 && ($RowCnt - 1) % $this->ExportPageBreakCount == 0)
						$Doc->ExportPageBreak();
				}
				$this->LoadListRowValues($Recordset);

				// Render row
				$this->RowType = EW_ROWTYPE_VIEW; // Render view
				$this->ResetAttrs();
				$this->RenderListRow();
				if (!$Doc->ExportCustom) {
					$Doc->BeginExportRow($RowCnt); // Allow CSS styles if enabled
					if ($ExportPageType == "view") {
						if ($this->cus_id->Exportable) $Doc->ExportField($this->cus_id);
						if ($this->cus_name->Exportable) $Doc->ExportField($this->cus_name);
						if ($this->cus_email->Exportable) $Doc->ExportField($this->cus_email);
						if ($this->cus_pwd->Exportable) $Doc->ExportField($this->cus_pwd);
						if ($this->cus_phone->Exportable) $Doc->ExportField($this->cus_phone);
						if ($this->cus_order->Exportable) $Doc->ExportField($this->cus_order);
						if ($this->img_profile->Exportable) $Doc->ExportField($this->img_profile);
						if ($this->cus_status->Exportable) $Doc->ExportField($this->cus_status);
					} else {
						if ($this->cus_id->Exportable) $Doc->ExportField($this->cus_id);
						if ($this->cus_name->Exportable) $Doc->ExportField($this->cus_name);
						if ($this->cus_email->Exportable) $Doc->ExportField($this->cus_email);
						if ($this->cus_pwd->Exportable) $Doc->ExportField($this->cus_pwd);
						if ($this->cus_phone->Exportable) $Doc->ExportField($this->cus_phone);
						if ($this->cus_order->Exportable) $Doc->ExportField($this->cus_order);
						if ($this->img_profile->Exportable) $Doc->ExportField($this->img_profile);
						if ($this->cus_status->Exportable) $Doc->ExportField($this->cus_status);
					}
					$Doc->EndExportRow($RowCnt);
				}
			}

			// Call Row Export server event
			if ($Doc->ExportCustom)
				$this->Row_Export($Recordset->fields);
			$Recordset->MoveNext();
		}
		if (!$Doc->ExportCustom) {
			$Doc->ExportTableFooter();
		}
	}

	// Get auto fill value
	function GetAutoFill($id, $val) {
		$rsarr = array();
		$rowcnt = 0;

		// Output
		if (is_array($rsarr) && $rowcnt > 0) {
			$fldcnt = count($rsarr[0]);
			for ($i = 0; $i < $rowcnt; $i++) {
				for ($j = 0; $j < $fldcnt; $j++) {
					$str = strval($rsarr[$i][$j]);
					$str = ew_ConvertToUtf8($str);
					if (isset($post["keepCRLF"])) {
						$str = str_replace(array("\r", "\n"), array("\\r", "\\n"), $str);
					} else {
						$str = str_replace(array("\r", "\n"), array(" ", " "), $str);
					}
					$rsarr[$i][$j] = $str;
				}
			}
			return ew_ArrayToJson($rsarr);
		} else {
			return FALSE;
		}
	}

	// Table level events
	// Recordset Selecting event
	function Recordset_Selecting(&$filter) {

		// Enter your code here
	}

	// Recordset Selected event
	function Recordset_Selected(&$rs) {

		//echo "Recordset Selected";
	}

	// Recordset Search Validated event
	function Recordset_SearchValidated() {

		// Example:
		//$this->MyField1->AdvancedSearch->SearchValue = "your search criteria"; // Search value

	}

	// Recordset Searching event
	function Recordset_Searching(&$filter) {

		// Enter your code here
	}

	// Row_Selecting event
	function Row_Selecting(&$filter) {

		// Enter your code here
	}

	// Row Selected event
	function Row_Selected(&$rs) {

		//echo "Row Selected";
	}

	// Row Inserting event
	function Row_Inserting($rsold, &$rsnew) {

		// Enter your code here
		// To cancel, set return value to FALSE

		return TRUE;
	}

	// Row Inserted event
	function Row_Inserted($rsold, &$rsnew) {

		//echo "Row Inserted"
	}

	// Row Updating event
	function Row_Updating($rsold, &$rsnew) {

		// Enter your code here
		// To cancel, set return value to FALSE

		return TRUE;
	}

	// Row Updated event
	function Row_Updated($rsold, &$rsnew) {

		//echo "Row Updated";
	}

	// Row Update Conflict event
	function Row_UpdateConflict($rsold, &$rsnew) {

		// Enter your code here
		// To ignore conflict, set return value to FALSE

		return TRUE;
	}

	// Grid Inserting event
	function Grid_Inserting() {

		// Enter your code here
		// To reject grid insert, set return value to FALSE

		return TRUE;
	}

	// Grid Inserted event
	function Grid_Inserted($rsnew) {

		//echo "Grid Inserted";
	}

	// Grid Updating event
	function Grid_Updating($rsold) {

		// Enter your code here
		// To reject grid update, set return value to FALSE

		return TRUE;
	}

	// Grid Updated event
	function Grid_Updated($rsold, $rsnew) {

		//echo "Grid Updated";
	}

	// Row Deleting event
	function Row_Deleting(&$rs) {

		// Enter your code here
		// To cancel, set return value to False

		return TRUE;
	}

	// Row Deleted event
	function Row_Deleted(&$rs) {

		//echo "Row Deleted";
	}

	// Email Sending event
	function Email_Sending(&$Email, &$Args) {

		//var_dump($Email); var_dump($Args); exit();
		return TRUE;
	}

	// Lookup Selecting event
	function Lookup_Selecting($fld, &$filter) {

		//var_dump($fld->FldName, $fld->LookupFilters, $filter); // Uncomment to view the filter
		// Enter your code here

	}

	// Row Rendering event
	function Row_Rendering() {

		// Enter your code here
	}

	// Row Rendered event
	function Row_Rendered() {

		// To view properties of field class, use:
		//var_dump($this-><FieldName>);

	}

	// User ID Filtering event
	function UserID_Filtering(&$filter) {

		// Enter your code here
	}
}
?>
