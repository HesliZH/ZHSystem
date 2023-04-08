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
$contas_correntes_list = new contas_correntes_list();

// Run the page
$contas_correntes_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$contas_correntes_list->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if (!$contas_correntes->isExport()) { ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "list";
var fcontas_correnteslist = currentForm = new ew.Form("fcontas_correnteslist", "list");
fcontas_correnteslist.formKeyCountName = '<?php echo $contas_correntes_list->FormKeyCountName ?>';

// Form_CustomValidate event
fcontas_correnteslist.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fcontas_correnteslist.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
fcontas_correnteslist.lists["x_ativo[]"] = <?php echo $contas_correntes_list->ativo->Lookup->toClientList() ?>;
fcontas_correnteslist.lists["x_ativo[]"].options = <?php echo JsonEncode($contas_correntes_list->ativo->options(FALSE, TRUE)) ?>;

// Form object for search
var fcontas_correnteslistsrch = currentSearchForm = new ew.Form("fcontas_correnteslistsrch");

// Filters
fcontas_correnteslistsrch.filterList = <?php echo $contas_correntes_list->getFilterList() ?>;
</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php } ?>
<?php if (!$contas_correntes->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($contas_correntes_list->TotalRecs > 0 && $contas_correntes_list->ExportOptions->visible()) { ?>
<?php $contas_correntes_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($contas_correntes_list->ImportOptions->visible()) { ?>
<?php $contas_correntes_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($contas_correntes_list->SearchOptions->visible()) { ?>
<?php $contas_correntes_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($contas_correntes_list->FilterOptions->visible()) { ?>
<?php $contas_correntes_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$contas_correntes_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$contas_correntes->isExport() && !$contas_correntes->CurrentAction) { ?>
<form name="fcontas_correnteslistsrch" id="fcontas_correnteslistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<?php $searchPanelClass = ($contas_correntes_list->SearchWhere <> "") ? " show" : " show"; ?>
<div id="fcontas_correnteslistsrch-search-panel" class="ew-search-panel collapse<?php echo $searchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="contas_correntes">
	<div class="ew-basic-search">
<div id="xsr_1" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo TABLE_BASIC_SEARCH ?>" id="<?php echo TABLE_BASIC_SEARCH ?>" class="form-control" value="<?php echo HtmlEncode($contas_correntes_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo TABLE_BASIC_SEARCH_TYPE ?>" value="<?php echo HtmlEncode($contas_correntes_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $contas_correntes_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($contas_correntes_list->BasicSearch->getType() == "") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this)"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($contas_correntes_list->BasicSearch->getType() == "=") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'=')"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($contas_correntes_list->BasicSearch->getType() == "AND") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'AND')"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($contas_correntes_list->BasicSearch->getType() == "OR") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'OR')"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div>
</div>
</form>
<?php } ?>
<?php } ?>
<?php $contas_correntes_list->showPageHeader(); ?>
<?php
$contas_correntes_list->showMessage();
?>
<?php if ($contas_correntes_list->TotalRecs > 0 || $contas_correntes->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($contas_correntes_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> contas_correntes">
<form name="fcontas_correnteslist" id="fcontas_correnteslist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($contas_correntes_list->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $contas_correntes_list->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="contas_correntes">
<div id="gmp_contas_correntes" class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel">
<?php if ($contas_correntes_list->TotalRecs > 0 || $contas_correntes->isGridEdit()) { ?>
<table id="tbl_contas_correnteslist" class="table ew-table"><!-- .ew-table ##-->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$contas_correntes_list->RowType = ROWTYPE_HEADER;

// Render list options
$contas_correntes_list->renderListOptions();

// Render list options (header, left)
$contas_correntes_list->ListOptions->render("header", "left");
?>
<?php if ($contas_correntes->id->Visible) { // id ?>
	<?php if ($contas_correntes->sortUrl($contas_correntes->id) == "") { ?>
		<th data-name="id" class="<?php echo $contas_correntes->id->headerCellClass() ?>"><div id="elh_contas_correntes_id" class="contas_correntes_id"><div class="ew-table-header-caption"><?php echo $contas_correntes->id->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id" class="<?php echo $contas_correntes->id->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $contas_correntes->SortUrl($contas_correntes->id) ?>',1);"><div id="elh_contas_correntes_id" class="contas_correntes_id">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $contas_correntes->id->caption() ?></span><span class="ew-table-header-sort"><?php if ($contas_correntes->id->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($contas_correntes->id->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($contas_correntes->descricao->Visible) { // descricao ?>
	<?php if ($contas_correntes->sortUrl($contas_correntes->descricao) == "") { ?>
		<th data-name="descricao" class="<?php echo $contas_correntes->descricao->headerCellClass() ?>"><div id="elh_contas_correntes_descricao" class="contas_correntes_descricao"><div class="ew-table-header-caption"><?php echo $contas_correntes->descricao->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="descricao" class="<?php echo $contas_correntes->descricao->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $contas_correntes->SortUrl($contas_correntes->descricao) ?>',1);"><div id="elh_contas_correntes_descricao" class="contas_correntes_descricao">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $contas_correntes->descricao->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($contas_correntes->descricao->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($contas_correntes->descricao->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($contas_correntes->ativo->Visible) { // ativo ?>
	<?php if ($contas_correntes->sortUrl($contas_correntes->ativo) == "") { ?>
		<th data-name="ativo" class="<?php echo $contas_correntes->ativo->headerCellClass() ?>"><div id="elh_contas_correntes_ativo" class="contas_correntes_ativo"><div class="ew-table-header-caption"><?php echo $contas_correntes->ativo->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ativo" class="<?php echo $contas_correntes->ativo->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $contas_correntes->SortUrl($contas_correntes->ativo) ?>',1);"><div id="elh_contas_correntes_ativo" class="contas_correntes_ativo">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $contas_correntes->ativo->caption() ?></span><span class="ew-table-header-sort"><?php if ($contas_correntes->ativo->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($contas_correntes->ativo->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$contas_correntes_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($contas_correntes->ExportAll && $contas_correntes->isExport()) {
	$contas_correntes_list->StopRec = $contas_correntes_list->TotalRecs;
} else {

	// Set the last record to display
	if ($contas_correntes_list->TotalRecs > $contas_correntes_list->StartRec + $contas_correntes_list->DisplayRecs - 1)
		$contas_correntes_list->StopRec = $contas_correntes_list->StartRec + $contas_correntes_list->DisplayRecs - 1;
	else
		$contas_correntes_list->StopRec = $contas_correntes_list->TotalRecs;
}
$contas_correntes_list->RecCnt = $contas_correntes_list->StartRec - 1;
if ($contas_correntes_list->Recordset && !$contas_correntes_list->Recordset->EOF) {
	$contas_correntes_list->Recordset->moveFirst();
	$selectLimit = $contas_correntes_list->UseSelectLimit;
	if (!$selectLimit && $contas_correntes_list->StartRec > 1)
		$contas_correntes_list->Recordset->move($contas_correntes_list->StartRec - 1);
} elseif (!$contas_correntes->AllowAddDeleteRow && $contas_correntes_list->StopRec == 0) {
	$contas_correntes_list->StopRec = $contas_correntes->GridAddRowCount;
}

// Initialize aggregate
$contas_correntes->RowType = ROWTYPE_AGGREGATEINIT;
$contas_correntes->resetAttributes();
$contas_correntes_list->renderRow();
while ($contas_correntes_list->RecCnt < $contas_correntes_list->StopRec) {
	$contas_correntes_list->RecCnt++;
	if ($contas_correntes_list->RecCnt >= $contas_correntes_list->StartRec) {
		$contas_correntes_list->RowCnt++;

		// Set up key count
		$contas_correntes_list->KeyCount = $contas_correntes_list->RowIndex;

		// Init row class and style
		$contas_correntes->resetAttributes();
		$contas_correntes->CssClass = "";
		if ($contas_correntes->isGridAdd()) {
		} else {
			$contas_correntes_list->loadRowValues($contas_correntes_list->Recordset); // Load row values
		}
		$contas_correntes->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$contas_correntes->RowAttrs = array_merge($contas_correntes->RowAttrs, array('data-rowindex'=>$contas_correntes_list->RowCnt, 'id'=>'r' . $contas_correntes_list->RowCnt . '_contas_correntes', 'data-rowtype'=>$contas_correntes->RowType));

		// Render row
		$contas_correntes_list->renderRow();

		// Render list options
		$contas_correntes_list->renderListOptions();
?>
	<tr<?php echo $contas_correntes->rowAttributes() ?>>
<?php

// Render list options (body, left)
$contas_correntes_list->ListOptions->render("body", "left", $contas_correntes_list->RowCnt);
?>
	<?php if ($contas_correntes->id->Visible) { // id ?>
		<td data-name="id"<?php echo $contas_correntes->id->cellAttributes() ?>>
<span id="el<?php echo $contas_correntes_list->RowCnt ?>_contas_correntes_id" class="contas_correntes_id">
<span<?php echo $contas_correntes->id->viewAttributes() ?>>
<?php echo $contas_correntes->id->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($contas_correntes->descricao->Visible) { // descricao ?>
		<td data-name="descricao"<?php echo $contas_correntes->descricao->cellAttributes() ?>>
<span id="el<?php echo $contas_correntes_list->RowCnt ?>_contas_correntes_descricao" class="contas_correntes_descricao">
<span<?php echo $contas_correntes->descricao->viewAttributes() ?>>
<?php echo $contas_correntes->descricao->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($contas_correntes->ativo->Visible) { // ativo ?>
		<td data-name="ativo"<?php echo $contas_correntes->ativo->cellAttributes() ?>>
<span id="el<?php echo $contas_correntes_list->RowCnt ?>_contas_correntes_ativo" class="contas_correntes_ativo">
<span<?php echo $contas_correntes->ativo->viewAttributes() ?>>
<?php if (ConvertToBool($contas_correntes->ativo->CurrentValue)) { ?>
<input type="checkbox" value="<?php echo $contas_correntes->ativo->getViewValue() ?>" disabled checked>
<?php } else { ?>
<input type="checkbox" value="<?php echo $contas_correntes->ativo->getViewValue() ?>" disabled>
<?php } ?>
</span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$contas_correntes_list->ListOptions->render("body", "right", $contas_correntes_list->RowCnt);
?>
	</tr>
<?php
	}
	if (!$contas_correntes->isGridAdd())
		$contas_correntes_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
<?php if (!$contas_correntes->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($contas_correntes_list->Recordset)
	$contas_correntes_list->Recordset->Close();
?>
<?php if (!$contas_correntes->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$contas_correntes->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($contas_correntes_list->Pager)) $contas_correntes_list->Pager = new PrevNextPager($contas_correntes_list->StartRec, $contas_correntes_list->DisplayRecs, $contas_correntes_list->TotalRecs, $contas_correntes_list->AutoHidePager) ?>
<?php if ($contas_correntes_list->Pager->RecordCount > 0 && $contas_correntes_list->Pager->Visible) { ?>
<div class="ew-pager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ew-prev-next"><div class="input-group input-group-sm">
<div class="input-group-prepend">
<!-- first page button -->
	<?php if ($contas_correntes_list->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerFirst") ?>" href="<?php echo $contas_correntes_list->pageUrl() ?>start=<?php echo $contas_correntes_list->Pager->FirstButton->Start ?>"><i class="icon-first ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerFirst") ?>"><i class="icon-first ew-icon"></i></a>
	<?php } ?>
<!-- previous page button -->
	<?php if ($contas_correntes_list->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerPrevious") ?>" href="<?php echo $contas_correntes_list->pageUrl() ?>start=<?php echo $contas_correntes_list->Pager->PrevButton->Start ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerPrevious") ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } ?>
</div>
<!-- current page number -->
	<input class="form-control" type="text" name="<?php echo TABLE_PAGE_NO ?>" value="<?php echo $contas_correntes_list->Pager->CurrentPage ?>">
<div class="input-group-append">
<!-- next page button -->
	<?php if ($contas_correntes_list->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerNext") ?>" href="<?php echo $contas_correntes_list->pageUrl() ?>start=<?php echo $contas_correntes_list->Pager->NextButton->Start ?>"><i class="icon-next ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerNext") ?>"><i class="icon-next ew-icon"></i></a>
	<?php } ?>
<!-- last page button -->
	<?php if ($contas_correntes_list->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerLast") ?>" href="<?php echo $contas_correntes_list->pageUrl() ?>start=<?php echo $contas_correntes_list->Pager->LastButton->Start ?>"><i class="icon-last ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerLast") ?>"><i class="icon-last ew-icon"></i></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $contas_correntes_list->Pager->PageCount ?></span>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if ($contas_correntes_list->Pager->RecordCount > 0) { ?>
<div class="ew-pager ew-rec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $contas_correntes_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $contas_correntes_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $contas_correntes_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $contas_correntes_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($contas_correntes_list->TotalRecs == 0 && !$contas_correntes->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $contas_correntes_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$contas_correntes_list->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<?php if (!$contas_correntes->isExport()) { ?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$contas_correntes_list->terminate();
?>