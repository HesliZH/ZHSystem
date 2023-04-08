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
$compras_itens_list = new compras_itens_list();

// Run the page
$compras_itens_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$compras_itens_list->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if (!$compras_itens->isExport()) { ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "list";
var fcompras_itenslist = currentForm = new ew.Form("fcompras_itenslist", "list");
fcompras_itenslist.formKeyCountName = '<?php echo $compras_itens_list->FormKeyCountName ?>';

// Form_CustomValidate event
fcompras_itenslist.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fcompras_itenslist.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php } ?>
<?php if (!$compras_itens->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($compras_itens_list->TotalRecs > 0 && $compras_itens_list->ExportOptions->visible()) { ?>
<?php $compras_itens_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($compras_itens_list->ImportOptions->visible()) { ?>
<?php $compras_itens_list->ImportOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$compras_itens_list->renderOtherOptions();
?>
<?php $compras_itens_list->showPageHeader(); ?>
<?php
$compras_itens_list->showMessage();
?>
<?php if ($compras_itens_list->TotalRecs > 0 || $compras_itens->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($compras_itens_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> compras_itens">
<form name="fcompras_itenslist" id="fcompras_itenslist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($compras_itens_list->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $compras_itens_list->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="compras_itens">
<div id="gmp_compras_itens" class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel">
<?php if ($compras_itens_list->TotalRecs > 0 || $compras_itens->isGridEdit()) { ?>
<table id="tbl_compras_itenslist" class="table ew-table"><!-- .ew-table ##-->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$compras_itens_list->RowType = ROWTYPE_HEADER;

// Render list options
$compras_itens_list->renderListOptions();

// Render list options (header, left)
$compras_itens_list->ListOptions->render("header", "left");
?>
<?php if ($compras_itens->id->Visible) { // id ?>
	<?php if ($compras_itens->sortUrl($compras_itens->id) == "") { ?>
		<th data-name="id" class="<?php echo $compras_itens->id->headerCellClass() ?>"><div id="elh_compras_itens_id" class="compras_itens_id"><div class="ew-table-header-caption"><?php echo $compras_itens->id->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id" class="<?php echo $compras_itens->id->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $compras_itens->SortUrl($compras_itens->id) ?>',1);"><div id="elh_compras_itens_id" class="compras_itens_id">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $compras_itens->id->caption() ?></span><span class="ew-table-header-sort"><?php if ($compras_itens->id->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($compras_itens->id->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($compras_itens->id_compra->Visible) { // id_compra ?>
	<?php if ($compras_itens->sortUrl($compras_itens->id_compra) == "") { ?>
		<th data-name="id_compra" class="<?php echo $compras_itens->id_compra->headerCellClass() ?>"><div id="elh_compras_itens_id_compra" class="compras_itens_id_compra"><div class="ew-table-header-caption"><?php echo $compras_itens->id_compra->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id_compra" class="<?php echo $compras_itens->id_compra->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $compras_itens->SortUrl($compras_itens->id_compra) ?>',1);"><div id="elh_compras_itens_id_compra" class="compras_itens_id_compra">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $compras_itens->id_compra->caption() ?></span><span class="ew-table-header-sort"><?php if ($compras_itens->id_compra->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($compras_itens->id_compra->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($compras_itens->item->Visible) { // item ?>
	<?php if ($compras_itens->sortUrl($compras_itens->item) == "") { ?>
		<th data-name="item" class="<?php echo $compras_itens->item->headerCellClass() ?>"><div id="elh_compras_itens_item" class="compras_itens_item"><div class="ew-table-header-caption"><?php echo $compras_itens->item->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="item" class="<?php echo $compras_itens->item->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $compras_itens->SortUrl($compras_itens->item) ?>',1);"><div id="elh_compras_itens_item" class="compras_itens_item">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $compras_itens->item->caption() ?></span><span class="ew-table-header-sort"><?php if ($compras_itens->item->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($compras_itens->item->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($compras_itens->quantidade->Visible) { // quantidade ?>
	<?php if ($compras_itens->sortUrl($compras_itens->quantidade) == "") { ?>
		<th data-name="quantidade" class="<?php echo $compras_itens->quantidade->headerCellClass() ?>"><div id="elh_compras_itens_quantidade" class="compras_itens_quantidade"><div class="ew-table-header-caption"><?php echo $compras_itens->quantidade->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="quantidade" class="<?php echo $compras_itens->quantidade->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $compras_itens->SortUrl($compras_itens->quantidade) ?>',1);"><div id="elh_compras_itens_quantidade" class="compras_itens_quantidade">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $compras_itens->quantidade->caption() ?></span><span class="ew-table-header-sort"><?php if ($compras_itens->quantidade->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($compras_itens->quantidade->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($compras_itens->unitario->Visible) { // unitario ?>
	<?php if ($compras_itens->sortUrl($compras_itens->unitario) == "") { ?>
		<th data-name="unitario" class="<?php echo $compras_itens->unitario->headerCellClass() ?>"><div id="elh_compras_itens_unitario" class="compras_itens_unitario"><div class="ew-table-header-caption"><?php echo $compras_itens->unitario->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="unitario" class="<?php echo $compras_itens->unitario->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $compras_itens->SortUrl($compras_itens->unitario) ?>',1);"><div id="elh_compras_itens_unitario" class="compras_itens_unitario">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $compras_itens->unitario->caption() ?></span><span class="ew-table-header-sort"><?php if ($compras_itens->unitario->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($compras_itens->unitario->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($compras_itens->total->Visible) { // total ?>
	<?php if ($compras_itens->sortUrl($compras_itens->total) == "") { ?>
		<th data-name="total" class="<?php echo $compras_itens->total->headerCellClass() ?>"><div id="elh_compras_itens_total" class="compras_itens_total"><div class="ew-table-header-caption"><?php echo $compras_itens->total->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="total" class="<?php echo $compras_itens->total->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $compras_itens->SortUrl($compras_itens->total) ?>',1);"><div id="elh_compras_itens_total" class="compras_itens_total">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $compras_itens->total->caption() ?></span><span class="ew-table-header-sort"><?php if ($compras_itens->total->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($compras_itens->total->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$compras_itens_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($compras_itens->ExportAll && $compras_itens->isExport()) {
	$compras_itens_list->StopRec = $compras_itens_list->TotalRecs;
} else {

	// Set the last record to display
	if ($compras_itens_list->TotalRecs > $compras_itens_list->StartRec + $compras_itens_list->DisplayRecs - 1)
		$compras_itens_list->StopRec = $compras_itens_list->StartRec + $compras_itens_list->DisplayRecs - 1;
	else
		$compras_itens_list->StopRec = $compras_itens_list->TotalRecs;
}
$compras_itens_list->RecCnt = $compras_itens_list->StartRec - 1;
if ($compras_itens_list->Recordset && !$compras_itens_list->Recordset->EOF) {
	$compras_itens_list->Recordset->moveFirst();
	$selectLimit = $compras_itens_list->UseSelectLimit;
	if (!$selectLimit && $compras_itens_list->StartRec > 1)
		$compras_itens_list->Recordset->move($compras_itens_list->StartRec - 1);
} elseif (!$compras_itens->AllowAddDeleteRow && $compras_itens_list->StopRec == 0) {
	$compras_itens_list->StopRec = $compras_itens->GridAddRowCount;
}

// Initialize aggregate
$compras_itens->RowType = ROWTYPE_AGGREGATEINIT;
$compras_itens->resetAttributes();
$compras_itens_list->renderRow();
while ($compras_itens_list->RecCnt < $compras_itens_list->StopRec) {
	$compras_itens_list->RecCnt++;
	if ($compras_itens_list->RecCnt >= $compras_itens_list->StartRec) {
		$compras_itens_list->RowCnt++;

		// Set up key count
		$compras_itens_list->KeyCount = $compras_itens_list->RowIndex;

		// Init row class and style
		$compras_itens->resetAttributes();
		$compras_itens->CssClass = "";
		if ($compras_itens->isGridAdd()) {
		} else {
			$compras_itens_list->loadRowValues($compras_itens_list->Recordset); // Load row values
		}
		$compras_itens->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$compras_itens->RowAttrs = array_merge($compras_itens->RowAttrs, array('data-rowindex'=>$compras_itens_list->RowCnt, 'id'=>'r' . $compras_itens_list->RowCnt . '_compras_itens', 'data-rowtype'=>$compras_itens->RowType));

		// Render row
		$compras_itens_list->renderRow();

		// Render list options
		$compras_itens_list->renderListOptions();
?>
	<tr<?php echo $compras_itens->rowAttributes() ?>>
<?php

// Render list options (body, left)
$compras_itens_list->ListOptions->render("body", "left", $compras_itens_list->RowCnt);
?>
	<?php if ($compras_itens->id->Visible) { // id ?>
		<td data-name="id"<?php echo $compras_itens->id->cellAttributes() ?>>
<span id="el<?php echo $compras_itens_list->RowCnt ?>_compras_itens_id" class="compras_itens_id">
<span<?php echo $compras_itens->id->viewAttributes() ?>>
<?php echo $compras_itens->id->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($compras_itens->id_compra->Visible) { // id_compra ?>
		<td data-name="id_compra"<?php echo $compras_itens->id_compra->cellAttributes() ?>>
<span id="el<?php echo $compras_itens_list->RowCnt ?>_compras_itens_id_compra" class="compras_itens_id_compra">
<span<?php echo $compras_itens->id_compra->viewAttributes() ?>>
<?php echo $compras_itens->id_compra->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($compras_itens->item->Visible) { // item ?>
		<td data-name="item"<?php echo $compras_itens->item->cellAttributes() ?>>
<span id="el<?php echo $compras_itens_list->RowCnt ?>_compras_itens_item" class="compras_itens_item">
<span<?php echo $compras_itens->item->viewAttributes() ?>>
<?php echo $compras_itens->item->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($compras_itens->quantidade->Visible) { // quantidade ?>
		<td data-name="quantidade"<?php echo $compras_itens->quantidade->cellAttributes() ?>>
<span id="el<?php echo $compras_itens_list->RowCnt ?>_compras_itens_quantidade" class="compras_itens_quantidade">
<span<?php echo $compras_itens->quantidade->viewAttributes() ?>>
<?php echo $compras_itens->quantidade->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($compras_itens->unitario->Visible) { // unitario ?>
		<td data-name="unitario"<?php echo $compras_itens->unitario->cellAttributes() ?>>
<span id="el<?php echo $compras_itens_list->RowCnt ?>_compras_itens_unitario" class="compras_itens_unitario">
<span<?php echo $compras_itens->unitario->viewAttributes() ?>>
<?php echo $compras_itens->unitario->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($compras_itens->total->Visible) { // total ?>
		<td data-name="total"<?php echo $compras_itens->total->cellAttributes() ?>>
<span id="el<?php echo $compras_itens_list->RowCnt ?>_compras_itens_total" class="compras_itens_total">
<span<?php echo $compras_itens->total->viewAttributes() ?>>
<?php echo $compras_itens->total->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$compras_itens_list->ListOptions->render("body", "right", $compras_itens_list->RowCnt);
?>
	</tr>
<?php
	}
	if (!$compras_itens->isGridAdd())
		$compras_itens_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
<?php if (!$compras_itens->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($compras_itens_list->Recordset)
	$compras_itens_list->Recordset->Close();
?>
<?php if (!$compras_itens->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$compras_itens->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($compras_itens_list->Pager)) $compras_itens_list->Pager = new PrevNextPager($compras_itens_list->StartRec, $compras_itens_list->DisplayRecs, $compras_itens_list->TotalRecs, $compras_itens_list->AutoHidePager) ?>
<?php if ($compras_itens_list->Pager->RecordCount > 0 && $compras_itens_list->Pager->Visible) { ?>
<div class="ew-pager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ew-prev-next"><div class="input-group input-group-sm">
<div class="input-group-prepend">
<!-- first page button -->
	<?php if ($compras_itens_list->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerFirst") ?>" href="<?php echo $compras_itens_list->pageUrl() ?>start=<?php echo $compras_itens_list->Pager->FirstButton->Start ?>"><i class="icon-first ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerFirst") ?>"><i class="icon-first ew-icon"></i></a>
	<?php } ?>
<!-- previous page button -->
	<?php if ($compras_itens_list->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerPrevious") ?>" href="<?php echo $compras_itens_list->pageUrl() ?>start=<?php echo $compras_itens_list->Pager->PrevButton->Start ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerPrevious") ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } ?>
</div>
<!-- current page number -->
	<input class="form-control" type="text" name="<?php echo TABLE_PAGE_NO ?>" value="<?php echo $compras_itens_list->Pager->CurrentPage ?>">
<div class="input-group-append">
<!-- next page button -->
	<?php if ($compras_itens_list->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerNext") ?>" href="<?php echo $compras_itens_list->pageUrl() ?>start=<?php echo $compras_itens_list->Pager->NextButton->Start ?>"><i class="icon-next ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerNext") ?>"><i class="icon-next ew-icon"></i></a>
	<?php } ?>
<!-- last page button -->
	<?php if ($compras_itens_list->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerLast") ?>" href="<?php echo $compras_itens_list->pageUrl() ?>start=<?php echo $compras_itens_list->Pager->LastButton->Start ?>"><i class="icon-last ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerLast") ?>"><i class="icon-last ew-icon"></i></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $compras_itens_list->Pager->PageCount ?></span>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if ($compras_itens_list->Pager->RecordCount > 0) { ?>
<div class="ew-pager ew-rec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $compras_itens_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $compras_itens_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $compras_itens_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $compras_itens_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($compras_itens_list->TotalRecs == 0 && !$compras_itens->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $compras_itens_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$compras_itens_list->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<?php if (!$compras_itens->isExport()) { ?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$compras_itens_list->terminate();
?>