<?php
namespace PHPMaker2019\ZH2019;

// Session
if (session_status() !== PHP_SESSION_ACTIVE)
	session_start(); // Init session data

// Output buffering
ob_start(); 

// Autoload
include_once "autoload.php";
?>
<?php

// Write header
WriteHeader(FALSE);

// Create page object
$fornecedores_list = new fornecedores_list();

// Run the page
$fornecedores_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$fornecedores_list->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if (!$fornecedores->isExport()) { ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "list";
var ffornecedoreslist = currentForm = new ew.Form("ffornecedoreslist", "list");
ffornecedoreslist.formKeyCountName = '<?php echo $fornecedores_list->FormKeyCountName ?>';

// Form_CustomValidate event
ffornecedoreslist.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
ffornecedoreslist.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
ffornecedoreslist.lists["x_ativo[]"] = <?php echo $fornecedores_list->ativo->Lookup->toClientList() ?>;
ffornecedoreslist.lists["x_ativo[]"].options = <?php echo JsonEncode($fornecedores_list->ativo->options(FALSE, TRUE)) ?>;

// Form object for search
var ffornecedoreslistsrch = currentSearchForm = new ew.Form("ffornecedoreslistsrch");

// Filters
ffornecedoreslistsrch.filterList = <?php echo $fornecedores_list->getFilterList() ?>;
</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php } ?>
<?php if (!$fornecedores->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($fornecedores_list->TotalRecs > 0 && $fornecedores_list->ExportOptions->visible()) { ?>
<?php $fornecedores_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($fornecedores_list->ImportOptions->visible()) { ?>
<?php $fornecedores_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($fornecedores_list->SearchOptions->visible()) { ?>
<?php $fornecedores_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($fornecedores_list->FilterOptions->visible()) { ?>
<?php $fornecedores_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$fornecedores_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$fornecedores->isExport() && !$fornecedores->CurrentAction) { ?>
<form name="ffornecedoreslistsrch" id="ffornecedoreslistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<?php $searchPanelClass = ($fornecedores_list->SearchWhere <> "") ? " show" : " show"; ?>
<div id="ffornecedoreslistsrch-search-panel" class="ew-search-panel collapse<?php echo $searchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="fornecedores">
	<div class="ew-basic-search">
<div id="xsr_1" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo TABLE_BASIC_SEARCH ?>" id="<?php echo TABLE_BASIC_SEARCH ?>" class="form-control" value="<?php echo HtmlEncode($fornecedores_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo TABLE_BASIC_SEARCH_TYPE ?>" value="<?php echo HtmlEncode($fornecedores_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $fornecedores_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($fornecedores_list->BasicSearch->getType() == "") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this)"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($fornecedores_list->BasicSearch->getType() == "=") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'=')"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($fornecedores_list->BasicSearch->getType() == "AND") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'AND')"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($fornecedores_list->BasicSearch->getType() == "OR") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'OR')"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div>
</div>
</form>
<?php } ?>
<?php } ?>
<?php $fornecedores_list->showPageHeader(); ?>
<?php
$fornecedores_list->showMessage();
?>
<?php if ($fornecedores_list->TotalRecs > 0 || $fornecedores->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($fornecedores_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> fornecedores">
<form name="ffornecedoreslist" id="ffornecedoreslist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($fornecedores_list->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $fornecedores_list->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="fornecedores">
<div id="gmp_fornecedores" class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel">
<?php if ($fornecedores_list->TotalRecs > 0 || $fornecedores->isGridEdit()) { ?>
<table id="tbl_fornecedoreslist" class="table ew-table"><!-- .ew-table ##-->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$fornecedores_list->RowType = ROWTYPE_HEADER;

// Render list options
$fornecedores_list->renderListOptions();

// Render list options (header, left)
$fornecedores_list->ListOptions->render("header", "left");
?>
<?php if ($fornecedores->id->Visible) { // id ?>
	<?php if ($fornecedores->sortUrl($fornecedores->id) == "") { ?>
		<th data-name="id" class="<?php echo $fornecedores->id->headerCellClass() ?>"><div id="elh_fornecedores_id" class="fornecedores_id"><div class="ew-table-header-caption"><?php echo $fornecedores->id->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id" class="<?php echo $fornecedores->id->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $fornecedores->SortUrl($fornecedores->id) ?>',1);"><div id="elh_fornecedores_id" class="fornecedores_id">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $fornecedores->id->caption() ?></span><span class="ew-table-header-sort"><?php if ($fornecedores->id->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($fornecedores->id->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($fornecedores->razao_social->Visible) { // razao_social ?>
	<?php if ($fornecedores->sortUrl($fornecedores->razao_social) == "") { ?>
		<th data-name="razao_social" class="<?php echo $fornecedores->razao_social->headerCellClass() ?>"><div id="elh_fornecedores_razao_social" class="fornecedores_razao_social"><div class="ew-table-header-caption"><?php echo $fornecedores->razao_social->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="razao_social" class="<?php echo $fornecedores->razao_social->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $fornecedores->SortUrl($fornecedores->razao_social) ?>',1);"><div id="elh_fornecedores_razao_social" class="fornecedores_razao_social">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $fornecedores->razao_social->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($fornecedores->razao_social->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($fornecedores->razao_social->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($fornecedores->ativo->Visible) { // ativo ?>
	<?php if ($fornecedores->sortUrl($fornecedores->ativo) == "") { ?>
		<th data-name="ativo" class="<?php echo $fornecedores->ativo->headerCellClass() ?>"><div id="elh_fornecedores_ativo" class="fornecedores_ativo"><div class="ew-table-header-caption"><?php echo $fornecedores->ativo->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ativo" class="<?php echo $fornecedores->ativo->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $fornecedores->SortUrl($fornecedores->ativo) ?>',1);"><div id="elh_fornecedores_ativo" class="fornecedores_ativo">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $fornecedores->ativo->caption() ?></span><span class="ew-table-header-sort"><?php if ($fornecedores->ativo->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($fornecedores->ativo->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$fornecedores_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($fornecedores->ExportAll && $fornecedores->isExport()) {
	$fornecedores_list->StopRec = $fornecedores_list->TotalRecs;
} else {

	// Set the last record to display
	if ($fornecedores_list->TotalRecs > $fornecedores_list->StartRec + $fornecedores_list->DisplayRecs - 1)
		$fornecedores_list->StopRec = $fornecedores_list->StartRec + $fornecedores_list->DisplayRecs - 1;
	else
		$fornecedores_list->StopRec = $fornecedores_list->TotalRecs;
}
$fornecedores_list->RecCnt = $fornecedores_list->StartRec - 1;
if ($fornecedores_list->Recordset && !$fornecedores_list->Recordset->EOF) {
	$fornecedores_list->Recordset->moveFirst();
	$selectLimit = $fornecedores_list->UseSelectLimit;
	if (!$selectLimit && $fornecedores_list->StartRec > 1)
		$fornecedores_list->Recordset->move($fornecedores_list->StartRec - 1);
} elseif (!$fornecedores->AllowAddDeleteRow && $fornecedores_list->StopRec == 0) {
	$fornecedores_list->StopRec = $fornecedores->GridAddRowCount;
}

// Initialize aggregate
$fornecedores->RowType = ROWTYPE_AGGREGATEINIT;
$fornecedores->resetAttributes();
$fornecedores_list->renderRow();
while ($fornecedores_list->RecCnt < $fornecedores_list->StopRec) {
	$fornecedores_list->RecCnt++;
	if ($fornecedores_list->RecCnt >= $fornecedores_list->StartRec) {
		$fornecedores_list->RowCnt++;

		// Set up key count
		$fornecedores_list->KeyCount = $fornecedores_list->RowIndex;

		// Init row class and style
		$fornecedores->resetAttributes();
		$fornecedores->CssClass = "";
		if ($fornecedores->isGridAdd()) {
		} else {
			$fornecedores_list->loadRowValues($fornecedores_list->Recordset); // Load row values
		}
		$fornecedores->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$fornecedores->RowAttrs = array_merge($fornecedores->RowAttrs, array('data-rowindex'=>$fornecedores_list->RowCnt, 'id'=>'r' . $fornecedores_list->RowCnt . '_fornecedores', 'data-rowtype'=>$fornecedores->RowType));

		// Render row
		$fornecedores_list->renderRow();

		// Render list options
		$fornecedores_list->renderListOptions();
?>
	<tr<?php echo $fornecedores->rowAttributes() ?>>
<?php

// Render list options (body, left)
$fornecedores_list->ListOptions->render("body", "left", $fornecedores_list->RowCnt);
?>
	<?php if ($fornecedores->id->Visible) { // id ?>
		<td data-name="id"<?php echo $fornecedores->id->cellAttributes() ?>>
<span id="el<?php echo $fornecedores_list->RowCnt ?>_fornecedores_id" class="fornecedores_id">
<span<?php echo $fornecedores->id->viewAttributes() ?>>
<?php echo $fornecedores->id->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($fornecedores->razao_social->Visible) { // razao_social ?>
		<td data-name="razao_social"<?php echo $fornecedores->razao_social->cellAttributes() ?>>
<span id="el<?php echo $fornecedores_list->RowCnt ?>_fornecedores_razao_social" class="fornecedores_razao_social">
<span<?php echo $fornecedores->razao_social->viewAttributes() ?>>
<?php echo $fornecedores->razao_social->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($fornecedores->ativo->Visible) { // ativo ?>
		<td data-name="ativo"<?php echo $fornecedores->ativo->cellAttributes() ?>>
<span id="el<?php echo $fornecedores_list->RowCnt ?>_fornecedores_ativo" class="fornecedores_ativo">
<span<?php echo $fornecedores->ativo->viewAttributes() ?>>
<?php if (ConvertToBool($fornecedores->ativo->CurrentValue)) { ?>
<input type="checkbox" value="<?php echo $fornecedores->ativo->getViewValue() ?>" disabled checked>
<?php } else { ?>
<input type="checkbox" value="<?php echo $fornecedores->ativo->getViewValue() ?>" disabled>
<?php } ?>
</span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$fornecedores_list->ListOptions->render("body", "right", $fornecedores_list->RowCnt);
?>
	</tr>
<?php
	}
	if (!$fornecedores->isGridAdd())
		$fornecedores_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
<?php if (!$fornecedores->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($fornecedores_list->Recordset)
	$fornecedores_list->Recordset->Close();
?>
<?php if (!$fornecedores->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$fornecedores->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($fornecedores_list->Pager)) $fornecedores_list->Pager = new PrevNextPager($fornecedores_list->StartRec, $fornecedores_list->DisplayRecs, $fornecedores_list->TotalRecs, $fornecedores_list->AutoHidePager) ?>
<?php if ($fornecedores_list->Pager->RecordCount > 0 && $fornecedores_list->Pager->Visible) { ?>
<div class="ew-pager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ew-prev-next"><div class="input-group input-group-sm">
<div class="input-group-prepend">
<!-- first page button -->
	<?php if ($fornecedores_list->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerFirst") ?>" href="<?php echo $fornecedores_list->pageUrl() ?>start=<?php echo $fornecedores_list->Pager->FirstButton->Start ?>"><i class="icon-first ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerFirst") ?>"><i class="icon-first ew-icon"></i></a>
	<?php } ?>
<!-- previous page button -->
	<?php if ($fornecedores_list->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerPrevious") ?>" href="<?php echo $fornecedores_list->pageUrl() ?>start=<?php echo $fornecedores_list->Pager->PrevButton->Start ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerPrevious") ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } ?>
</div>
<!-- current page number -->
	<input class="form-control" type="text" name="<?php echo TABLE_PAGE_NO ?>" value="<?php echo $fornecedores_list->Pager->CurrentPage ?>">
<div class="input-group-append">
<!-- next page button -->
	<?php if ($fornecedores_list->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerNext") ?>" href="<?php echo $fornecedores_list->pageUrl() ?>start=<?php echo $fornecedores_list->Pager->NextButton->Start ?>"><i class="icon-next ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerNext") ?>"><i class="icon-next ew-icon"></i></a>
	<?php } ?>
<!-- last page button -->
	<?php if ($fornecedores_list->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerLast") ?>" href="<?php echo $fornecedores_list->pageUrl() ?>start=<?php echo $fornecedores_list->Pager->LastButton->Start ?>"><i class="icon-last ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerLast") ?>"><i class="icon-last ew-icon"></i></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $fornecedores_list->Pager->PageCount ?></span>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if ($fornecedores_list->Pager->RecordCount > 0) { ?>
<div class="ew-pager ew-rec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $fornecedores_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $fornecedores_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $fornecedores_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $fornecedores_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($fornecedores_list->TotalRecs == 0 && !$fornecedores->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $fornecedores_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$fornecedores_list->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<?php if (!$fornecedores->isExport()) { ?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$fornecedores_list->terminate();
?>