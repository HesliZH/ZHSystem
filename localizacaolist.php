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
$localizacao_list = new localizacao_list();

// Run the page
$localizacao_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$localizacao_list->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if (!$localizacao->isExport()) { ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "list";
var flocalizacaolist = currentForm = new ew.Form("flocalizacaolist", "list");
flocalizacaolist.formKeyCountName = '<?php echo $localizacao_list->FormKeyCountName ?>';

// Form_CustomValidate event
flocalizacaolist.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
flocalizacaolist.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

var flocalizacaolistsrch = currentSearchForm = new ew.Form("flocalizacaolistsrch");

// Filters
flocalizacaolistsrch.filterList = <?php echo $localizacao_list->getFilterList() ?>;
</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php } ?>
<?php if (!$localizacao->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($localizacao_list->TotalRecs > 0 && $localizacao_list->ExportOptions->visible()) { ?>
<?php $localizacao_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($localizacao_list->ImportOptions->visible()) { ?>
<?php $localizacao_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($localizacao_list->SearchOptions->visible()) { ?>
<?php $localizacao_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($localizacao_list->FilterOptions->visible()) { ?>
<?php $localizacao_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$localizacao_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$localizacao->isExport() && !$localizacao->CurrentAction) { ?>
<form name="flocalizacaolistsrch" id="flocalizacaolistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<?php $searchPanelClass = ($localizacao_list->SearchWhere <> "") ? " show" : " show"; ?>
<div id="flocalizacaolistsrch-search-panel" class="ew-search-panel collapse<?php echo $searchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="localizacao">
	<div class="ew-basic-search">
<div id="xsr_1" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo TABLE_BASIC_SEARCH ?>" id="<?php echo TABLE_BASIC_SEARCH ?>" class="form-control" value="<?php echo HtmlEncode($localizacao_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo TABLE_BASIC_SEARCH_TYPE ?>" value="<?php echo HtmlEncode($localizacao_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $localizacao_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($localizacao_list->BasicSearch->getType() == "") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this)"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($localizacao_list->BasicSearch->getType() == "=") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'=')"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($localizacao_list->BasicSearch->getType() == "AND") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'AND')"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($localizacao_list->BasicSearch->getType() == "OR") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'OR')"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div>
</div>
</form>
<?php } ?>
<?php } ?>
<?php $localizacao_list->showPageHeader(); ?>
<?php
$localizacao_list->showMessage();
?>
<?php if ($localizacao_list->TotalRecs > 0 || $localizacao->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($localizacao_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> localizacao">
<form name="flocalizacaolist" id="flocalizacaolist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($localizacao_list->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $localizacao_list->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="localizacao">
<div id="gmp_localizacao" class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel">
<?php if ($localizacao_list->TotalRecs > 0 || $localizacao->isGridEdit()) { ?>
<table id="tbl_localizacaolist" class="table ew-table"><!-- .ew-table ##-->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$localizacao_list->RowType = ROWTYPE_HEADER;

// Render list options
$localizacao_list->renderListOptions();

// Render list options (header, left)
$localizacao_list->ListOptions->render("header", "left");
?>
<?php if ($localizacao->id->Visible) { // id ?>
	<?php if ($localizacao->sortUrl($localizacao->id) == "") { ?>
		<th data-name="id" class="<?php echo $localizacao->id->headerCellClass() ?>"><div id="elh_localizacao_id" class="localizacao_id"><div class="ew-table-header-caption"><?php echo $localizacao->id->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id" class="<?php echo $localizacao->id->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $localizacao->SortUrl($localizacao->id) ?>',1);"><div id="elh_localizacao_id" class="localizacao_id">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $localizacao->id->caption() ?></span><span class="ew-table-header-sort"><?php if ($localizacao->id->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($localizacao->id->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($localizacao->descricao->Visible) { // descricao ?>
	<?php if ($localizacao->sortUrl($localizacao->descricao) == "") { ?>
		<th data-name="descricao" class="<?php echo $localizacao->descricao->headerCellClass() ?>"><div id="elh_localizacao_descricao" class="localizacao_descricao"><div class="ew-table-header-caption"><?php echo $localizacao->descricao->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="descricao" class="<?php echo $localizacao->descricao->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $localizacao->SortUrl($localizacao->descricao) ?>',1);"><div id="elh_localizacao_descricao" class="localizacao_descricao">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $localizacao->descricao->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($localizacao->descricao->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($localizacao->descricao->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($localizacao->tipo->Visible) { // tipo ?>
	<?php if ($localizacao->sortUrl($localizacao->tipo) == "") { ?>
		<th data-name="tipo" class="<?php echo $localizacao->tipo->headerCellClass() ?>"><div id="elh_localizacao_tipo" class="localizacao_tipo"><div class="ew-table-header-caption"><?php echo $localizacao->tipo->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="tipo" class="<?php echo $localizacao->tipo->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $localizacao->SortUrl($localizacao->tipo) ?>',1);"><div id="elh_localizacao_tipo" class="localizacao_tipo">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $localizacao->tipo->caption() ?></span><span class="ew-table-header-sort"><?php if ($localizacao->tipo->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($localizacao->tipo->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($localizacao->id_pai->Visible) { // id_pai ?>
	<?php if ($localizacao->sortUrl($localizacao->id_pai) == "") { ?>
		<th data-name="id_pai" class="<?php echo $localizacao->id_pai->headerCellClass() ?>"><div id="elh_localizacao_id_pai" class="localizacao_id_pai"><div class="ew-table-header-caption"><?php echo $localizacao->id_pai->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id_pai" class="<?php echo $localizacao->id_pai->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $localizacao->SortUrl($localizacao->id_pai) ?>',1);"><div id="elh_localizacao_id_pai" class="localizacao_id_pai">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $localizacao->id_pai->caption() ?></span><span class="ew-table-header-sort"><?php if ($localizacao->id_pai->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($localizacao->id_pai->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$localizacao_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($localizacao->ExportAll && $localizacao->isExport()) {
	$localizacao_list->StopRec = $localizacao_list->TotalRecs;
} else {

	// Set the last record to display
	if ($localizacao_list->TotalRecs > $localizacao_list->StartRec + $localizacao_list->DisplayRecs - 1)
		$localizacao_list->StopRec = $localizacao_list->StartRec + $localizacao_list->DisplayRecs - 1;
	else
		$localizacao_list->StopRec = $localizacao_list->TotalRecs;
}
$localizacao_list->RecCnt = $localizacao_list->StartRec - 1;
if ($localizacao_list->Recordset && !$localizacao_list->Recordset->EOF) {
	$localizacao_list->Recordset->moveFirst();
	$selectLimit = $localizacao_list->UseSelectLimit;
	if (!$selectLimit && $localizacao_list->StartRec > 1)
		$localizacao_list->Recordset->move($localizacao_list->StartRec - 1);
} elseif (!$localizacao->AllowAddDeleteRow && $localizacao_list->StopRec == 0) {
	$localizacao_list->StopRec = $localizacao->GridAddRowCount;
}

// Initialize aggregate
$localizacao->RowType = ROWTYPE_AGGREGATEINIT;
$localizacao->resetAttributes();
$localizacao_list->renderRow();
while ($localizacao_list->RecCnt < $localizacao_list->StopRec) {
	$localizacao_list->RecCnt++;
	if ($localizacao_list->RecCnt >= $localizacao_list->StartRec) {
		$localizacao_list->RowCnt++;

		// Set up key count
		$localizacao_list->KeyCount = $localizacao_list->RowIndex;

		// Init row class and style
		$localizacao->resetAttributes();
		$localizacao->CssClass = "";
		if ($localizacao->isGridAdd()) {
		} else {
			$localizacao_list->loadRowValues($localizacao_list->Recordset); // Load row values
		}
		$localizacao->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$localizacao->RowAttrs = array_merge($localizacao->RowAttrs, array('data-rowindex'=>$localizacao_list->RowCnt, 'id'=>'r' . $localizacao_list->RowCnt . '_localizacao', 'data-rowtype'=>$localizacao->RowType));

		// Render row
		$localizacao_list->renderRow();

		// Render list options
		$localizacao_list->renderListOptions();
?>
	<tr<?php echo $localizacao->rowAttributes() ?>>
<?php

// Render list options (body, left)
$localizacao_list->ListOptions->render("body", "left", $localizacao_list->RowCnt);
?>
	<?php if ($localizacao->id->Visible) { // id ?>
		<td data-name="id"<?php echo $localizacao->id->cellAttributes() ?>>
<span id="el<?php echo $localizacao_list->RowCnt ?>_localizacao_id" class="localizacao_id">
<span<?php echo $localizacao->id->viewAttributes() ?>>
<?php echo $localizacao->id->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($localizacao->descricao->Visible) { // descricao ?>
		<td data-name="descricao"<?php echo $localizacao->descricao->cellAttributes() ?>>
<span id="el<?php echo $localizacao_list->RowCnt ?>_localizacao_descricao" class="localizacao_descricao">
<span<?php echo $localizacao->descricao->viewAttributes() ?>>
<?php echo $localizacao->descricao->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($localizacao->tipo->Visible) { // tipo ?>
		<td data-name="tipo"<?php echo $localizacao->tipo->cellAttributes() ?>>
<span id="el<?php echo $localizacao_list->RowCnt ?>_localizacao_tipo" class="localizacao_tipo">
<span<?php echo $localizacao->tipo->viewAttributes() ?>>
<?php echo $localizacao->tipo->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($localizacao->id_pai->Visible) { // id_pai ?>
		<td data-name="id_pai"<?php echo $localizacao->id_pai->cellAttributes() ?>>
<span id="el<?php echo $localizacao_list->RowCnt ?>_localizacao_id_pai" class="localizacao_id_pai">
<span<?php echo $localizacao->id_pai->viewAttributes() ?>>
<?php echo $localizacao->id_pai->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$localizacao_list->ListOptions->render("body", "right", $localizacao_list->RowCnt);
?>
	</tr>
<?php
	}
	if (!$localizacao->isGridAdd())
		$localizacao_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
<?php if (!$localizacao->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($localizacao_list->Recordset)
	$localizacao_list->Recordset->Close();
?>
<?php if (!$localizacao->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$localizacao->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($localizacao_list->Pager)) $localizacao_list->Pager = new PrevNextPager($localizacao_list->StartRec, $localizacao_list->DisplayRecs, $localizacao_list->TotalRecs, $localizacao_list->AutoHidePager) ?>
<?php if ($localizacao_list->Pager->RecordCount > 0 && $localizacao_list->Pager->Visible) { ?>
<div class="ew-pager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ew-prev-next"><div class="input-group input-group-sm">
<div class="input-group-prepend">
<!-- first page button -->
	<?php if ($localizacao_list->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerFirst") ?>" href="<?php echo $localizacao_list->pageUrl() ?>start=<?php echo $localizacao_list->Pager->FirstButton->Start ?>"><i class="icon-first ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerFirst") ?>"><i class="icon-first ew-icon"></i></a>
	<?php } ?>
<!-- previous page button -->
	<?php if ($localizacao_list->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerPrevious") ?>" href="<?php echo $localizacao_list->pageUrl() ?>start=<?php echo $localizacao_list->Pager->PrevButton->Start ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerPrevious") ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } ?>
</div>
<!-- current page number -->
	<input class="form-control" type="text" name="<?php echo TABLE_PAGE_NO ?>" value="<?php echo $localizacao_list->Pager->CurrentPage ?>">
<div class="input-group-append">
<!-- next page button -->
	<?php if ($localizacao_list->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerNext") ?>" href="<?php echo $localizacao_list->pageUrl() ?>start=<?php echo $localizacao_list->Pager->NextButton->Start ?>"><i class="icon-next ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerNext") ?>"><i class="icon-next ew-icon"></i></a>
	<?php } ?>
<!-- last page button -->
	<?php if ($localizacao_list->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerLast") ?>" href="<?php echo $localizacao_list->pageUrl() ?>start=<?php echo $localizacao_list->Pager->LastButton->Start ?>"><i class="icon-last ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerLast") ?>"><i class="icon-last ew-icon"></i></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $localizacao_list->Pager->PageCount ?></span>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if ($localizacao_list->Pager->RecordCount > 0) { ?>
<div class="ew-pager ew-rec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $localizacao_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $localizacao_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $localizacao_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $localizacao_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($localizacao_list->TotalRecs == 0 && !$localizacao->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $localizacao_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$localizacao_list->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<?php if (!$localizacao->isExport()) { ?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$localizacao_list->terminate();
?>