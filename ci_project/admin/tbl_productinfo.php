<?php

// Global variable for table object
$tbl_product = NULL;

//
// Table class for tbl_product
//
class ctbl_product extends cTable {
	var $pro_id;
	var $pro_cat_id;
	var $pro_name;
	var $pro_feature;
	var $pro_img_folder;
	var $pro_detail;
	var $price;
	var $pro_keyword;
	var $pro_status;
	var $col_id;

	//
	// Table class constructor
	//
	function __construct() {
		global $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();
		$this->TableVar = 'tbl_product';
		$this->TableName = 'tbl_product';
		$this->TableType = 'TABLE';

		// Update Table
		$this->UpdateTable = "`tbl_product`";
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

		// pro_id
		$this->pro_id = new cField('tbl_product', 'tbl_product', 'x_pro_id', 'pro_id', '`pro_id`', '`pro_id`', 3, -1, FALSE, '`pro_id`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'NO');
		$this->pro_id->Sortable = TRUE; // Allow sort
		$this->pro_id->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['pro_id'] = &$this->pro_id;

		// pro_cat_id
		$this->pro_cat_id = new cField('tbl_product', 'tbl_product', 'x_pro_cat_id', 'pro_cat_id', '`pro_cat_id`', '`pro_cat_id`', 3, -1, FALSE, '`pro_cat_id`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->pro_cat_id->Sortable = TRUE; // Allow sort
		$this->pro_cat_id->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['pro_cat_id'] = &$this->pro_cat_id;

		// pro_name
		$this->pro_name = new cField('tbl_product', 'tbl_product', 'x_pro_name', 'pro_name', '`pro_name`', '`pro_name`', 200, -1, FALSE, '`pro_name`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->pro_name->Sortable = TRUE; // Allow sort
		$this->fields['pro_name'] = &$this->pro_name;

		// pro_feature
		$this->pro_feature = new cField('tbl_product', 'tbl_product', 'x_pro_feature', 'pro_feature', '`pro_feature`', '`pro_feature`', 200, -1, FALSE, '`pro_feature`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->pro_feature->Sortable = TRUE; // Allow sort
		$this->fields['pro_feature'] = &$this->pro_feature;

		// pro_img_folder
		$this->pro_img_folder = new cField('tbl_product', 'tbl_product', 'x_pro_img_folder', 'pro_img_folder', '`pro_img_folder`', '`pro_img_folder`', 200, -1, FALSE, '`pro_img_folder`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->pro_img_folder->Sortable = TRUE; // Allow sort
		$this->fields['pro_img_folder'] = &$this->pro_img_folder;

		// pro_detail
		$this->pro_detail = new cField('tbl_product', 'tbl_product', 'x_pro_detail', 'pro_detail', '`pro_detail`', '`pro_detail`', 201, -1, FALSE, '`pro_detail`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXTAREA');
		$this->pro_detail->Sortable = TRUE; // Allow sort
		$this->fields['pro_detail'] = &$this->pro_detail;

		// price
		$this->price = new cField('tbl_product', 'tbl_product', 'x_price', 'price', '`price`', '`price`', 200, -1, FALSE, '`price`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->price->Sortable = TRUE; // Allow sort
		$this->fields['price'] = &$this->price;

		// pro_keyword
		$this->pro_keyword = new cField('tbl_product', 'tbl_product', 'x_pro_keyword', 'pro_keyword', '`pro_keyword`', '`pro_keyword`', 200, -1, FALSE, '`pro_keyword`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->pro_keyword->Sortable = TRUE; // Allow sort
		$this->fields['pro_keyword'] = &$this->pro_keyword;

		// pro_status
		$this->pro_status = new cField('tbl_product', 'tbl_product', 'x_pro_status', 'pro_status', '`pro_status`', '`pro_status`', 202, -1, FALSE, '`pro_status`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'CHECKBOX');
		$this->pro_status->Sortable = TRUE; // Allow sort
		$this->pro_status->FldDataType = EW_DATATYPE_BOOLEAN;
		$this->pro_status->TrueValue = 'Y';
		$this->pro_status->FalseValue = 'N';
		$this->pro_status->OptionCount = 2;
		$this->fields['pro_status'] = &$this->pro_status;

		// col_id
		$this->col_id = new cField('tbl_product', 'tbl_product', 'x_col_id', 'col_id', '`col_id`', '`col_id`', 3, -1, FALSE, '`col_id`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->col_id->Sortable = TRUE; // Allow sort
		$this->col_id->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['col_id'] = &$this->col_id;
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
		return ($this->_SqlFrom <> "") ? $this->_SqlFrom : "`tbl_product`";
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
			$this->pro_id->setDbValue($conn->Insert_ID());
			$rs['pro_id'] = $this->pro_id->DbValue;
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
			if (array_key_exists('pro_id', $rs))
				ew_AddFilter($where, ew_QuotedName('pro_id', $this->DBID) . '=' . ew_QuotedValue($rs['pro_id'], $this->pro_id->FldDataType, $this->DBID));
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
		return "`pro_id` = @pro_id@";
	}

	// Key filter
	function KeyFilter() {
		$sKeyFilter = $this->SqlKeyFilter();
		if (!is_numeric($this->pro_id->CurrentValue))
			return "0=1"; // Invalid key
		if (is_null($this->pro_id->CurrentValue))
			return "0=1"; // Invalid key
		else
			$sKeyFilter = str_replace("@pro_id@", ew_AdjustSql($this->pro_id->CurrentValue, $this->DBID), $sKeyFilter); // Replace key value
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
			return "tbl_productlist.php";
		}
	}

	function setReturnUrl($v) {
		$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_RETURN_URL] = $v;
	}

	// Get modal caption
	function GetModalCaption($pageName) {
		global $Language;
		if ($pageName == "tbl_productview.php")
			return $Language->Phrase("View");
		elseif ($pageName == "tbl_productedit.php")
			return $Language->Phrase("Edit");
		elseif ($pageName == "tbl_productadd.php")
			return $Language->Phrase("Add");
		else
			return "";
	}

	// List URL
	function GetListUrl() {
		return "tbl_productlist.php";
	}

	// View URL
	function GetViewUrl($parm = "") {
		if ($parm <> "")
			$url = $this->KeyUrl("tbl_productview.php", $this->UrlParm($parm));
		else
			$url = $this->KeyUrl("tbl_productview.php", $this->UrlParm(EW_TABLE_SHOW_DETAIL . "="));
		return $this->AddMasterUrl($url);
	}

	// Add URL
	function GetAddUrl($parm = "") {
		if ($parm <> "")
			$url = "tbl_productadd.php?" . $this->UrlParm($parm);
		else
			$url = "tbl_productadd.php";
		return $this->AddMasterUrl($url);
	}

	// Edit URL
	function GetEditUrl($parm = "") {
		$url = $this->KeyUrl("tbl_productedit.php", $this->UrlParm($parm));
		return $this->AddMasterUrl($url);
	}

	// Inline edit URL
	function GetInlineEditUrl() {
		$url = $this->KeyUrl(ew_CurrentPage(), $this->UrlParm("a=edit"));
		return $this->AddMasterUrl($url);
	}

	// Copy URL
	function GetCopyUrl($parm = "") {
		$url = $this->KeyUrl("tbl_productadd.php", $this->UrlParm($parm));
		return $this->AddMasterUrl($url);
	}

	// Inline copy URL
	function GetInlineCopyUrl() {
		$url = $this->KeyUrl(ew_CurrentPage(), $this->UrlParm("a=copy"));
		return $this->AddMasterUrl($url);
	}

	// Delete URL
	function GetDeleteUrl() {
		return $this->KeyUrl("tbl_productdelete.php", $this->UrlParm());
	}

	// Add master url
	function AddMasterUrl($url) {
		return $url;
	}

	function KeyToJson() {
		$json = "";
		$json .= "pro_id:" . ew_VarToJson($this->pro_id->CurrentValue, "number", "'");
		return "{" . $json . "}";
	}

	// Add key value to URL
	function KeyUrl($url, $parm = "") {
		$sUrl = $url . "?";
		if ($parm <> "") $sUrl .= $parm . "&";
		if (!is_null($this->pro_id->CurrentValue)) {
			$sUrl .= "pro_id=" . urlencode($this->pro_id->CurrentValue);
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
			if ($isPost && isset($_POST["pro_id"]))
				$arKeys[] = $_POST["pro_id"];
			elseif (isset($_GET["pro_id"]))
				$arKeys[] = $_GET["pro_id"];
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
			$this->pro_id->CurrentValue = $key;
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
		$this->pro_id->setDbValue($rs->fields('pro_id'));
		$this->pro_cat_id->setDbValue($rs->fields('pro_cat_id'));
		$this->pro_name->setDbValue($rs->fields('pro_name'));
		$this->pro_feature->setDbValue($rs->fields('pro_feature'));
		$this->pro_img_folder->setDbValue($rs->fields('pro_img_folder'));
		$this->pro_detail->setDbValue($rs->fields('pro_detail'));
		$this->price->setDbValue($rs->fields('price'));
		$this->pro_keyword->setDbValue($rs->fields('pro_keyword'));
		$this->pro_status->setDbValue($rs->fields('pro_status'));
		$this->col_id->setDbValue($rs->fields('col_id'));
	}

	// Render list row values
	function RenderListRow() {
		global $Security, $gsLanguage, $Language;

		// Call Row Rendering event
		$this->Row_Rendering();

	// Common render codes
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

		// pro_id
		$this->pro_id->EditAttrs["class"] = "form-control";
		$this->pro_id->EditCustomAttributes = "";
		$this->pro_id->EditValue = $this->pro_id->CurrentValue;
		$this->pro_id->ViewCustomAttributes = "";

		// pro_cat_id
		$this->pro_cat_id->EditAttrs["class"] = "form-control";
		$this->pro_cat_id->EditCustomAttributes = "";
		$this->pro_cat_id->EditValue = $this->pro_cat_id->CurrentValue;
		$this->pro_cat_id->PlaceHolder = ew_RemoveHtml($this->pro_cat_id->FldCaption());

		// pro_name
		$this->pro_name->EditAttrs["class"] = "form-control";
		$this->pro_name->EditCustomAttributes = "";
		$this->pro_name->EditValue = $this->pro_name->CurrentValue;
		$this->pro_name->PlaceHolder = ew_RemoveHtml($this->pro_name->FldCaption());

		// pro_feature
		$this->pro_feature->EditAttrs["class"] = "form-control";
		$this->pro_feature->EditCustomAttributes = "";
		$this->pro_feature->EditValue = $this->pro_feature->CurrentValue;
		$this->pro_feature->PlaceHolder = ew_RemoveHtml($this->pro_feature->FldCaption());

		// pro_img_folder
		$this->pro_img_folder->EditAttrs["class"] = "form-control";
		$this->pro_img_folder->EditCustomAttributes = "";
		$this->pro_img_folder->EditValue = $this->pro_img_folder->CurrentValue;
		$this->pro_img_folder->PlaceHolder = ew_RemoveHtml($this->pro_img_folder->FldCaption());

		// pro_detail
		$this->pro_detail->EditAttrs["class"] = "form-control";
		$this->pro_detail->EditCustomAttributes = "";
		$this->pro_detail->EditValue = $this->pro_detail->CurrentValue;
		$this->pro_detail->PlaceHolder = ew_RemoveHtml($this->pro_detail->FldCaption());

		// price
		$this->price->EditAttrs["class"] = "form-control";
		$this->price->EditCustomAttributes = "";
		$this->price->EditValue = $this->price->CurrentValue;
		$this->price->PlaceHolder = ew_RemoveHtml($this->price->FldCaption());

		// pro_keyword
		$this->pro_keyword->EditAttrs["class"] = "form-control";
		$this->pro_keyword->EditCustomAttributes = "";
		$this->pro_keyword->EditValue = $this->pro_keyword->CurrentValue;
		$this->pro_keyword->PlaceHolder = ew_RemoveHtml($this->pro_keyword->FldCaption());

		// pro_status
		$this->pro_status->EditCustomAttributes = "";
		$this->pro_status->EditValue = $this->pro_status->Options(FALSE);

		// col_id
		$this->col_id->EditAttrs["class"] = "form-control";
		$this->col_id->EditCustomAttributes = "";
		$this->col_id->EditValue = $this->col_id->CurrentValue;
		$this->col_id->PlaceHolder = ew_RemoveHtml($this->col_id->FldCaption());

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
					if ($this->pro_id->Exportable) $Doc->ExportCaption($this->pro_id);
					if ($this->pro_cat_id->Exportable) $Doc->ExportCaption($this->pro_cat_id);
					if ($this->pro_name->Exportable) $Doc->ExportCaption($this->pro_name);
					if ($this->pro_feature->Exportable) $Doc->ExportCaption($this->pro_feature);
					if ($this->pro_img_folder->Exportable) $Doc->ExportCaption($this->pro_img_folder);
					if ($this->pro_detail->Exportable) $Doc->ExportCaption($this->pro_detail);
					if ($this->price->Exportable) $Doc->ExportCaption($this->price);
					if ($this->pro_keyword->Exportable) $Doc->ExportCaption($this->pro_keyword);
					if ($this->pro_status->Exportable) $Doc->ExportCaption($this->pro_status);
					if ($this->col_id->Exportable) $Doc->ExportCaption($this->col_id);
				} else {
					if ($this->pro_id->Exportable) $Doc->ExportCaption($this->pro_id);
					if ($this->pro_cat_id->Exportable) $Doc->ExportCaption($this->pro_cat_id);
					if ($this->pro_name->Exportable) $Doc->ExportCaption($this->pro_name);
					if ($this->pro_feature->Exportable) $Doc->ExportCaption($this->pro_feature);
					if ($this->pro_img_folder->Exportable) $Doc->ExportCaption($this->pro_img_folder);
					if ($this->price->Exportable) $Doc->ExportCaption($this->price);
					if ($this->pro_keyword->Exportable) $Doc->ExportCaption($this->pro_keyword);
					if ($this->pro_status->Exportable) $Doc->ExportCaption($this->pro_status);
					if ($this->col_id->Exportable) $Doc->ExportCaption($this->col_id);
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
						if ($this->pro_id->Exportable) $Doc->ExportField($this->pro_id);
						if ($this->pro_cat_id->Exportable) $Doc->ExportField($this->pro_cat_id);
						if ($this->pro_name->Exportable) $Doc->ExportField($this->pro_name);
						if ($this->pro_feature->Exportable) $Doc->ExportField($this->pro_feature);
						if ($this->pro_img_folder->Exportable) $Doc->ExportField($this->pro_img_folder);
						if ($this->pro_detail->Exportable) $Doc->ExportField($this->pro_detail);
						if ($this->price->Exportable) $Doc->ExportField($this->price);
						if ($this->pro_keyword->Exportable) $Doc->ExportField($this->pro_keyword);
						if ($this->pro_status->Exportable) $Doc->ExportField($this->pro_status);
						if ($this->col_id->Exportable) $Doc->ExportField($this->col_id);
					} else {
						if ($this->pro_id->Exportable) $Doc->ExportField($this->pro_id);
						if ($this->pro_cat_id->Exportable) $Doc->ExportField($this->pro_cat_id);
						if ($this->pro_name->Exportable) $Doc->ExportField($this->pro_name);
						if ($this->pro_feature->Exportable) $Doc->ExportField($this->pro_feature);
						if ($this->pro_img_folder->Exportable) $Doc->ExportField($this->pro_img_folder);
						if ($this->price->Exportable) $Doc->ExportField($this->price);
						if ($this->pro_keyword->Exportable) $Doc->ExportField($this->pro_keyword);
						if ($this->pro_status->Exportable) $Doc->ExportField($this->pro_status);
						if ($this->col_id->Exportable) $Doc->ExportField($this->col_id);
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
