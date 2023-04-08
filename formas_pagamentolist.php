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
$formas_pagamento_list = new formas_pagamento_list();

// Run the page
$formas_pagamento_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$formas_pagamento_list->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if (!$formas_pagamento->isExport()) { ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "list";
var fformas_pagamentolist = currentForm = new ew.Form("fformas_pagamentolist", "list");
fformas_pagamentolist.formKeyCountName = '<?php echo $formas_pagamento_list->FormKeyCountName ?>';

// Form_CustomValidate event
fformas_pagamentolist.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fformas_pagamentolist.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

var fformas_pagamentolistsrch = currentSearchForm = new ew.Form("fformas_pagamentolistsrch");

// Filters
fformas_pagamentolistsrch.filterList = <?php echo $formas_pagamento_list->getFilterList() ?>;
</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php } ?>
<?php if (!$formas_pagamento->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($formas_pagamento_list->TotalRecs > 0 && $formas_pagamento_list->ExportOptions->visible()) { ?>
<?php $formas_pagamento_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($formas_pagamento_list->ImportOptions->visible()) { ?>
<?php $formas_pagamento_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($formas_pagamento_list->SearchOptions->visible()) { ?>
<?php $formas_pagamento_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($formas_pagamento_list->FilterOptions->visible()) { ?>
<?php $formas_pagamento_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$formas_pagamento_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$formas_pagamento->isExport() && !$formas_pagamento->CurrentAction) { ?>
<form name="fformas_pagamentolistsrch" id="fformas_pagamentolistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<?php $searchPanelClass = ($formas_pagamento_list->SearchWhere <> "") ? " show" : " show"; ?>
<div id="fformas_pagamentolistsrch-search-panel" class="ew-search-panel collapse<?php echo $searchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="formas_pagamento">
	<div class="ew-basic-search">
<div id="xsr_1" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo TABLE_BASIC_SEARCH ?>" id="<?php echo TABLE_BASIC_SEARCH ?>" class="form-control" value="<?php echo HtmlEncode($formas_pagamento_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo TABLE_BASIC_SEARCH_TYPE ?>" value="<?php echo HtmlEncode($formas_pagamento_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $formas_pagamento_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($formas_pagamento_list->BasicSearch->getType() == "") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this)"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($formas_pagamento_list->BasicSearch->getType() == "=") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'=')"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($formas_pagamento_list->BasicSearch->getType() == "AND") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'AND')"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($formas_pagamento_list->BasicSearch->getType() == "OR") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'OR')"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div>
</div>
</form>
<?php } ?>
<?php } ?>
<?php $formas_pagamento_list->showPageHeader(); ?>
<?php
$formas_pagamento_list->showMessage();
?>
<?php if ($formas_pagamento_list->TotalRecs > 0 || $formas_pagamento->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($formas_pagamento_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> formas_pagamento">
<form name="fformas_pagamentolist" id="fformas_pagamentolist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($formas_pagamento_list->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $formas_pagamento_list->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="formas_pagamento">
<div id="gmp_formas_pagamento" class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel">
<?php if ($formas_pagamento_list->TotalRecs > 0 || $formas_pagamento->isGridEdit()) { ?>
<table id="tbl_formas_pagamentolist" class="table ew-table"><!-- .ew-table ##-->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$formas_pagamento_list->RowType = ROWTYPE_HEADER;

// Render list options
$formas_pagamento_list->renderListOptions();

// Render list options (header, left)
$formas_pagamento_list->ListOptions->render("header", "left");
?>
<?php if ($formas_pagamento->id->Visible) { // id ?>
	<?php if ($formas_pagamento->sortUrl($formas_pagamento->id) == "") { ?>
		<th data-name="id" class="<?php echo $formas_pagamento->id->headerCellClass() ?>"><div id="elh_formas_pagamento_id" class="formas_pagamento_id"><div class="ew-table-header-caption"><?php echo $formas_pagamento->id->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id" class="<?php echo $formas_pagamento->id->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $formas_pagamento->SortUrl($formas_pagamento->id) ?>',1);"><div id="elh_formas_pagamento_id" class="formas_pagamento_id">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $formas_pagamento->id->caption() ?></span><span class="ew-table-header-sort"><?php if ($formas_pagamento->id->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($formas_pagamento->id->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($formas_pagamento->descricao->Visible) { // descricao ?>
	<?php if ($formas_pagamento->sortUrl($formas_pagamento->descricao) == "") { ?>
		<th data-name="descricao" class="<?php echo $formas_pagamento->descricao->headerCellClass() ?>"><div id="elh_formas_pagamento_descricao" class="formas_pagamento_descricao"><div class="ew-table-header-caption"><?php echo $formas_pagamento->descricao->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="descricao" class="<?php echo $formas_pagamento->descricao->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $formas_pagamento->SortUrl($formas_pagamento->descricao) ?>',1);"><div id="elh_formas_pagamento_descricao" class="formas_pagamento_descricao">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $formas_pagamento->descricao->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($formas_pagamento->descricao->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($formas_pagamento->descricao->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$formas_pagamento_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($formas_pagamento->ExportAll && $formas_pagamento->isExport()) {
	$formas_pagamento_list->StopRec = $formas_pagamento_list->TotalRecs;
} else {

	// Set the last record to display
	if ($formas_pagamento_list->TotalRecs > $formas_pagamento_list->StartRec + $formas_pagamento_list->DisplayRecs - 1)
		$formas_pagamento_list->StopRec = $formas_pagamento_list->StartRec + $formas_pagamento_list->DisplayRecs - 1;
	else
		$formas_pagamento_list->StopRec = $formas_pagamento_list->TotalRecs;
}
$formas_pagamento_list->RecCnt = $formas_pagamento_list->StartRec - 1;
if ($formas_pagamento_list->Recordset && !$formas_pagamento_list->Recordset->EOF) {
	$formas_pagamento_list->Recordset->moveFirst();
	$selectLimit = $formas_pagamento_list->UseSelectLimit;
	if (!$selectLimit && $formas_pagamento_list->StartRec > 1)
		$formas_pagamento_list->Recordset->move($formas_pagamento_list->StartRec - 1);
} elseif (!$formas_pagamento->AllowAddDeleteRow && $formas_pagamento_list->StopRec == 0) {
	$formas_pagamento_list->StopRec = $formas_pagamento->GridAddRowCount;
}

// Initialize aggregate
$formas_pagamento->RowType = ROWTYPE_AGGREGATEINIT;
$formas_pagamento->resetAttributes();
$formas_pagamento_list->renderRow();
while ($formas_pagamento_list->RecCnt < $formas_pagamento_list->StopRec) {
	$formas_pagamento_list->RecCnt++;
	if ($formas_pagamento_list->RecCnt >= $formas_pagamento_list->StartRec) {
		$formas_pagamento_list->RowCnt++;

		// Set up key count
		$formas_pagamento_list->KeyCount = $formas_pagamento_list->RowIndex;

		// Init row class and style
		$formas_pagamento->resetAttributes();
		$formas_pagamento->CssClass = "";
		if ($formas_pagamento->isGridAdd()) {
		} else {
			$formas_pagamento_list->loadRowValues($formas_pagamento_list->Recordset); // Load row values
		}
		$formas_pagamento->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$formas_pagamento->RowAttrs = array_merge($formas_pagamento->RowAttrs, array('data-rowindex'=>$formas_pagamento_list->RowCnt, 'id'=>'r' . $formas_pagamento_list->RowCnt . '_formas_pagamento', 'data-rowtype'=>$formas_pagamento->RowType));

		// Render row
		$formas_pagamento_list->renderRow();

		// Render list options
		$formas_pagamento_list->renderListOptions();
?>
	<tr<?php echo $formas_pagamento->rowAttributes() ?>>
<?php

// Render list options (body, left)
$formas_pagamento_list->ListOptions->render("body", "left", $formas_pagamento_list->RowCnt);
?>
	<?php if ($formas_pagamento->id->Visible) { // id ?>
		<td data-name="id"<?php echo $formas_pagamento->id->cellAttributes() ?>>
<span id="el<?php echo $formas_pagamento_list->RowCnt ?>_formas_pagamento_id" class="formas_pagamento_id">
<span<?php echo $formas_pagamento->id->viewAttributes() ?>>
<?php echo $formas_pagamento->id->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($formas_pagamento->descricao->Visible) { // descricao ?>
		<td data-name="descricao"<?php echo $formas_pagamento->descricao->cellAttributes() ?>>
<span id="el<?php echo $formas_pagamento_list->RowCnt ?>_formas_pagamento_descricao" class="formas_pagamento_descricao">
<span<?php echo $formas_pagamento->descricao->viewAttributes() ?>>
<?php echo $formas_pagamento->descricao->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$formas_pagamento_list->ListOptions->render("body", "right", $formas_pagamento_list->RowCnt);
?>
	</tr>
<?php
	}
	if (!$formas_pagamento->isGridAdd())
		$formas_pagamento_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
<?php if (!$formas_pagamento->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($formas_pagamento_list->Recordset)
	$formas_pagamento_list->Recordset->Close();
?>
<?php if (!$formas_pagamento->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$formas_pagamento->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($formas_pagamento_list->Pager)) $formas_pagamento_list->Pager = new PrevNextPager($formas_pagamento_list->StartRec, $formas_pagamento_list->DisplayRecs, $formas_pagamento_list->TotalRecs, $formas_pagamento_list->AutoHidePager) ?>
<?php if ($formas_pagamento_list->Pager->RecordCount > 0 && $formas_pagamento_list->Pager->Visible) { ?>
<div class="ew-pager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ew-prev-next"><div class="input-group input-group-sm">
<div class="input-group-prepend">
<!-- first page button -->
	<?php if ($formas_pagamento_list->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerFirst") ?>" href="<?php echo $formas_pagamento_list->pageUrl() ?>start=<?php echo $formas_pagamento_list->Pager->FirstButton->Start ?>"><i class="icon-first ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerFirst") ?>"><i class="icon-first ew-icon"></i></a>
	<?php } ?>
<!-- previous page button -->
	<?php if ($formas_pagamento_list->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerPrevious") ?>" href="<?php echo $formas_pagamento_list->pageUrl() ?>start=<?php echo $formas_pagamento_list->Pager->PrevButton->Start ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerPrevious") ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } ?>
</div>
<!-- current page number -->
	<input class="form-control" type="text" name="<?php echo TABLE_PAGE_NO ?>" value="<?php echo $formas_pagamento_list->Pager->CurrentPage ?>">
<div class="input-group-append">
<!-- next page button -->
	<?php if ($formas_pagamento_list->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerNext") ?>" href="<?php echo $formas_pagamento_list->pageUrl() ?>start=<?php echo $formas_pagamento_list->Pager->NextButton->Start ?>"><i class="icon-next ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerNext") ?>"><i class="icon-next ew-icon"></i></a>
	<?php } ?>
<!-- last page button -->
	<?php if ($formas_pagamento_list->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerLast") ?>" href="<?php echo $formas_pagamento_list->pageUrl() ?>start=<?php echo $formas_pagamento_list->Pager->LastButton->Start ?>"><i class="icon-last ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerLast") ?>"><i class="icon-last ew-icon"></i></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $formas_pagamento_list->Pager->PageCount ?></span>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if ($formas_pagamento_list->Pager->RecordCount > 0) { ?>
<div class="ew-pager ew-rec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $formas_pagamento_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $formas_pagamento_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $formas_pagamento_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $formas_pagamento_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($formas_pagamento_list->TotalRecs == 0 && !$formas_pagamento->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $formas_pagamento_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$formas_pagamento_list->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<?php if (!$formas_pagamento->isExport()) { ?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$formas_pagamento_list->terminate();
?>