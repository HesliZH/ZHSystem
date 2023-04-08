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
$bens_list = new bens_list();

// Run the page
$bens_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$bens_list->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if (!$bens->isExport()) { ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "list";
var fbenslist = currentForm = new ew.Form("fbenslist", "list");
fbenslist.formKeyCountName = '<?php echo $bens_list->FormKeyCountName ?>';

// Form_CustomValidate event
fbenslist.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fbenslist.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
fbenslist.lists["x_tipo"] = <?php echo $bens_list->tipo->Lookup->toClientList() ?>;
fbenslist.lists["x_tipo"].options = <?php echo JsonEncode($bens_list->tipo->options(FALSE, TRUE)) ?>;

// Form object for search
var fbenslistsrch = currentSearchForm = new ew.Form("fbenslistsrch");

// Filters
fbenslistsrch.filterList = <?php echo $bens_list->getFilterList() ?>;
</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php } ?>
<?php if (!$bens->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($bens_list->TotalRecs > 0 && $bens_list->ExportOptions->visible()) { ?>
<?php $bens_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($bens_list->ImportOptions->visible()) { ?>
<?php $bens_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($bens_list->SearchOptions->visible()) { ?>
<?php $bens_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($bens_list->FilterOptions->visible()) { ?>
<?php $bens_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$bens_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$bens->isExport() && !$bens->CurrentAction) { ?>
<form name="fbenslistsrch" id="fbenslistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<?php $searchPanelClass = ($bens_list->SearchWhere <> "") ? " show" : " show"; ?>
<div id="fbenslistsrch-search-panel" class="ew-search-panel collapse<?php echo $searchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="bens">
	<div class="ew-basic-search">
<div id="xsr_1" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo TABLE_BASIC_SEARCH ?>" id="<?php echo TABLE_BASIC_SEARCH ?>" class="form-control" value="<?php echo HtmlEncode($bens_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo TABLE_BASIC_SEARCH_TYPE ?>" value="<?php echo HtmlEncode($bens_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $bens_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($bens_list->BasicSearch->getType() == "") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this)"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($bens_list->BasicSearch->getType() == "=") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'=')"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($bens_list->BasicSearch->getType() == "AND") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'AND')"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($bens_list->BasicSearch->getType() == "OR") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'OR')"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div>
</div>
</form>
<?php } ?>
<?php } ?>
<?php $bens_list->showPageHeader(); ?>
<?php
$bens_list->showMessage();
?>
<?php if ($bens_list->TotalRecs > 0 || $bens->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($bens_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> bens">
<form name="fbenslist" id="fbenslist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($bens_list->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $bens_list->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="bens">
<div id="gmp_bens" class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel">
<?php if ($bens_list->TotalRecs > 0 || $bens->isGridEdit()) { ?>
<table id="tbl_benslist" class="table ew-table"><!-- .ew-table ##-->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$bens_list->RowType = ROWTYPE_HEADER;

// Render list options
$bens_list->renderListOptions();

// Render list options (header, left)
$bens_list->ListOptions->render("header", "left");
?>
<?php if ($bens->descricao->Visible) { // descricao ?>
	<?php if ($bens->sortUrl($bens->descricao) == "") { ?>
		<th data-name="descricao" class="<?php echo $bens->descricao->headerCellClass() ?>"><div id="elh_bens_descricao" class="bens_descricao"><div class="ew-table-header-caption"><?php echo $bens->descricao->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="descricao" class="<?php echo $bens->descricao->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $bens->SortUrl($bens->descricao) ?>',1);"><div id="elh_bens_descricao" class="bens_descricao">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $bens->descricao->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($bens->descricao->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($bens->descricao->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($bens->tipo->Visible) { // tipo ?>
	<?php if ($bens->sortUrl($bens->tipo) == "") { ?>
		<th data-name="tipo" class="<?php echo $bens->tipo->headerCellClass() ?>"><div id="elh_bens_tipo" class="bens_tipo"><div class="ew-table-header-caption"><?php echo $bens->tipo->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="tipo" class="<?php echo $bens->tipo->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $bens->SortUrl($bens->tipo) ?>',1);"><div id="elh_bens_tipo" class="bens_tipo">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $bens->tipo->caption() ?></span><span class="ew-table-header-sort"><?php if ($bens->tipo->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($bens->tipo->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($bens->placa->Visible) { // placa ?>
	<?php if ($bens->sortUrl($bens->placa) == "") { ?>
		<th data-name="placa" class="<?php echo $bens->placa->headerCellClass() ?>"><div id="elh_bens_placa" class="bens_placa"><div class="ew-table-header-caption"><?php echo $bens->placa->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="placa" class="<?php echo $bens->placa->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $bens->SortUrl($bens->placa) ?>',1);"><div id="elh_bens_placa" class="bens_placa">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $bens->placa->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($bens->placa->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($bens->placa->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($bens->localizacao->Visible) { // localizacao ?>
	<?php if ($bens->sortUrl($bens->localizacao) == "") { ?>
		<th data-name="localizacao" class="<?php echo $bens->localizacao->headerCellClass() ?>"><div id="elh_bens_localizacao" class="bens_localizacao"><div class="ew-table-header-caption"><?php echo $bens->localizacao->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="localizacao" class="<?php echo $bens->localizacao->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $bens->SortUrl($bens->localizacao) ?>',1);"><div id="elh_bens_localizacao" class="bens_localizacao">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $bens->localizacao->caption() ?></span><span class="ew-table-header-sort"><?php if ($bens->localizacao->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($bens->localizacao->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$bens_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($bens->ExportAll && $bens->isExport()) {
	$bens_list->StopRec = $bens_list->TotalRecs;
} else {

	// Set the last record to display
	if ($bens_list->TotalRecs > $bens_list->StartRec + $bens_list->DisplayRecs - 1)
		$bens_list->StopRec = $bens_list->StartRec + $bens_list->DisplayRecs - 1;
	else
		$bens_list->StopRec = $bens_list->TotalRecs;
}
$bens_list->RecCnt = $bens_list->StartRec - 1;
if ($bens_list->Recordset && !$bens_list->Recordset->EOF) {
	$bens_list->Recordset->moveFirst();
	$selectLimit = $bens_list->UseSelectLimit;
	if (!$selectLimit && $bens_list->StartRec > 1)
		$bens_list->Recordset->move($bens_list->StartRec - 1);
} elseif (!$bens->AllowAddDeleteRow && $bens_list->StopRec == 0) {
	$bens_list->StopRec = $bens->GridAddRowCount;
}

// Initialize aggregate
$bens->RowType = ROWTYPE_AGGREGATEINIT;
$bens->resetAttributes();
$bens_list->renderRow();
while ($bens_list->RecCnt < $bens_list->StopRec) {
	$bens_list->RecCnt++;
	if ($bens_list->RecCnt >= $bens_list->StartRec) {
		$bens_list->RowCnt++;

		// Set up key count
		$bens_list->KeyCount = $bens_list->RowIndex;

		// Init row class and style
		$bens->resetAttributes();
		$bens->CssClass = "";
		if ($bens->isGridAdd()) {
		} else {
			$bens_list->loadRowValues($bens_list->Recordset); // Load row values
		}
		$bens->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$bens->RowAttrs = array_merge($bens->RowAttrs, array('data-rowindex'=>$bens_list->RowCnt, 'id'=>'r' . $bens_list->RowCnt . '_bens', 'data-rowtype'=>$bens->RowType));

		// Render row
		$bens_list->renderRow();

		// Render list options
		$bens_list->renderListOptions();
?>
	<tr<?php echo $bens->rowAttributes() ?>>
<?php

// Render list options (body, left)
$bens_list->ListOptions->render("body", "left", $bens_list->RowCnt);
?>
	<?php if ($bens->descricao->Visible) { // descricao ?>
		<td data-name="descricao"<?php echo $bens->descricao->cellAttributes() ?>>
<span id="el<?php echo $bens_list->RowCnt ?>_bens_descricao" class="bens_descricao">
<span<?php echo $bens->descricao->viewAttributes() ?>>
<?php echo $bens->descricao->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($bens->tipo->Visible) { // tipo ?>
		<td data-name="tipo"<?php echo $bens->tipo->cellAttributes() ?>>
<span id="el<?php echo $bens_list->RowCnt ?>_bens_tipo" class="bens_tipo">
<span<?php echo $bens->tipo->viewAttributes() ?>>
<?php echo $bens->tipo->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($bens->placa->Visible) { // placa ?>
		<td data-name="placa"<?php echo $bens->placa->cellAttributes() ?>>
<span id="el<?php echo $bens_list->RowCnt ?>_bens_placa" class="bens_placa">
<span<?php echo $bens->placa->viewAttributes() ?>>
<?php echo $bens->placa->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($bens->localizacao->Visible) { // localizacao ?>
		<td data-name="localizacao"<?php echo $bens->localizacao->cellAttributes() ?>>
<span id="el<?php echo $bens_list->RowCnt ?>_bens_localizacao" class="bens_localizacao">
<span<?php echo $bens->localizacao->viewAttributes() ?>>
<?php echo $bens->localizacao->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$bens_list->ListOptions->render("body", "right", $bens_list->RowCnt);
?>
	</tr>
<?php
	}
	if (!$bens->isGridAdd())
		$bens_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
<?php if (!$bens->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($bens_list->Recordset)
	$bens_list->Recordset->Close();
?>
<?php if (!$bens->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$bens->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($bens_list->Pager)) $bens_list->Pager = new PrevNextPager($bens_list->StartRec, $bens_list->DisplayRecs, $bens_list->TotalRecs, $bens_list->AutoHidePager) ?>
<?php if ($bens_list->Pager->RecordCount > 0 && $bens_list->Pager->Visible) { ?>
<div class="ew-pager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ew-prev-next"><div class="input-group input-group-sm">
<div class="input-group-prepend">
<!-- first page button -->
	<?php if ($bens_list->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerFirst") ?>" href="<?php echo $bens_list->pageUrl() ?>start=<?php echo $bens_list->Pager->FirstButton->Start ?>"><i class="icon-first ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerFirst") ?>"><i class="icon-first ew-icon"></i></a>
	<?php } ?>
<!-- previous page button -->
	<?php if ($bens_list->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerPrevious") ?>" href="<?php echo $bens_list->pageUrl() ?>start=<?php echo $bens_list->Pager->PrevButton->Start ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerPrevious") ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } ?>
</div>
<!-- current page number -->
	<input class="form-control" type="text" name="<?php echo TABLE_PAGE_NO ?>" value="<?php echo $bens_list->Pager->CurrentPage ?>">
<div class="input-group-append">
<!-- next page button -->
	<?php if ($bens_list->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerNext") ?>" href="<?php echo $bens_list->pageUrl() ?>start=<?php echo $bens_list->Pager->NextButton->Start ?>"><i class="icon-next ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerNext") ?>"><i class="icon-next ew-icon"></i></a>
	<?php } ?>
<!-- last page button -->
	<?php if ($bens_list->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerLast") ?>" href="<?php echo $bens_list->pageUrl() ?>start=<?php echo $bens_list->Pager->LastButton->Start ?>"><i class="icon-last ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerLast") ?>"><i class="icon-last ew-icon"></i></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $bens_list->Pager->PageCount ?></span>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if ($bens_list->Pager->RecordCount > 0) { ?>
<div class="ew-pager ew-rec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $bens_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $bens_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $bens_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $bens_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($bens_list->TotalRecs == 0 && !$bens->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $bens_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$bens_list->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<?php if (!$bens->isExport()) { ?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$bens_list->terminate();
?>