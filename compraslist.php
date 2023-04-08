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
$compras_list = new compras_list();

// Run the page
$compras_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$compras_list->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if (!$compras->isExport()) { ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "list";
var fcompraslist = currentForm = new ew.Form("fcompraslist", "list");
fcompraslist.formKeyCountName = '<?php echo $compras_list->FormKeyCountName ?>';

// Form_CustomValidate event
fcompraslist.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fcompraslist.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php } ?>
<?php if (!$compras->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($compras_list->TotalRecs > 0 && $compras_list->ExportOptions->visible()) { ?>
<?php $compras_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($compras_list->ImportOptions->visible()) { ?>
<?php $compras_list->ImportOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$compras_list->renderOtherOptions();
?>
<?php $compras_list->showPageHeader(); ?>
<?php
$compras_list->showMessage();
?>
<?php if ($compras_list->TotalRecs > 0 || $compras->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($compras_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> compras">
<form name="fcompraslist" id="fcompraslist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($compras_list->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $compras_list->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="compras">
<div id="gmp_compras" class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel">
<?php if ($compras_list->TotalRecs > 0 || $compras->isGridEdit()) { ?>
<table id="tbl_compraslist" class="table ew-table"><!-- .ew-table ##-->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$compras_list->RowType = ROWTYPE_HEADER;

// Render list options
$compras_list->renderListOptions();

// Render list options (header, left)
$compras_list->ListOptions->render("header", "left");
?>
<?php if ($compras->id->Visible) { // id ?>
	<?php if ($compras->sortUrl($compras->id) == "") { ?>
		<th data-name="id" class="<?php echo $compras->id->headerCellClass() ?>"><div id="elh_compras_id" class="compras_id"><div class="ew-table-header-caption"><?php echo $compras->id->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id" class="<?php echo $compras->id->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $compras->SortUrl($compras->id) ?>',1);"><div id="elh_compras_id" class="compras_id">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $compras->id->caption() ?></span><span class="ew-table-header-sort"><?php if ($compras->id->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($compras->id->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($compras->data->Visible) { // data ?>
	<?php if ($compras->sortUrl($compras->data) == "") { ?>
		<th data-name="data" class="<?php echo $compras->data->headerCellClass() ?>"><div id="elh_compras_data" class="compras_data"><div class="ew-table-header-caption"><?php echo $compras->data->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="data" class="<?php echo $compras->data->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $compras->SortUrl($compras->data) ?>',1);"><div id="elh_compras_data" class="compras_data">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $compras->data->caption() ?></span><span class="ew-table-header-sort"><?php if ($compras->data->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($compras->data->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($compras->valor->Visible) { // valor ?>
	<?php if ($compras->sortUrl($compras->valor) == "") { ?>
		<th data-name="valor" class="<?php echo $compras->valor->headerCellClass() ?>"><div id="elh_compras_valor" class="compras_valor"><div class="ew-table-header-caption"><?php echo $compras->valor->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="valor" class="<?php echo $compras->valor->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $compras->SortUrl($compras->valor) ?>',1);"><div id="elh_compras_valor" class="compras_valor">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $compras->valor->caption() ?></span><span class="ew-table-header-sort"><?php if ($compras->valor->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($compras->valor->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($compras->fornecedor->Visible) { // fornecedor ?>
	<?php if ($compras->sortUrl($compras->fornecedor) == "") { ?>
		<th data-name="fornecedor" class="<?php echo $compras->fornecedor->headerCellClass() ?>"><div id="elh_compras_fornecedor" class="compras_fornecedor"><div class="ew-table-header-caption"><?php echo $compras->fornecedor->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="fornecedor" class="<?php echo $compras->fornecedor->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $compras->SortUrl($compras->fornecedor) ?>',1);"><div id="elh_compras_fornecedor" class="compras_fornecedor">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $compras->fornecedor->caption() ?></span><span class="ew-table-header-sort"><?php if ($compras->fornecedor->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($compras->fornecedor->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($compras->parcelas->Visible) { // parcelas ?>
	<?php if ($compras->sortUrl($compras->parcelas) == "") { ?>
		<th data-name="parcelas" class="<?php echo $compras->parcelas->headerCellClass() ?>"><div id="elh_compras_parcelas" class="compras_parcelas"><div class="ew-table-header-caption"><?php echo $compras->parcelas->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="parcelas" class="<?php echo $compras->parcelas->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $compras->SortUrl($compras->parcelas) ?>',1);"><div id="elh_compras_parcelas" class="compras_parcelas">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $compras->parcelas->caption() ?></span><span class="ew-table-header-sort"><?php if ($compras->parcelas->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($compras->parcelas->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$compras_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($compras->ExportAll && $compras->isExport()) {
	$compras_list->StopRec = $compras_list->TotalRecs;
} else {

	// Set the last record to display
	if ($compras_list->TotalRecs > $compras_list->StartRec + $compras_list->DisplayRecs - 1)
		$compras_list->StopRec = $compras_list->StartRec + $compras_list->DisplayRecs - 1;
	else
		$compras_list->StopRec = $compras_list->TotalRecs;
}
$compras_list->RecCnt = $compras_list->StartRec - 1;
if ($compras_list->Recordset && !$compras_list->Recordset->EOF) {
	$compras_list->Recordset->moveFirst();
	$selectLimit = $compras_list->UseSelectLimit;
	if (!$selectLimit && $compras_list->StartRec > 1)
		$compras_list->Recordset->move($compras_list->StartRec - 1);
} elseif (!$compras->AllowAddDeleteRow && $compras_list->StopRec == 0) {
	$compras_list->StopRec = $compras->GridAddRowCount;
}

// Initialize aggregate
$compras->RowType = ROWTYPE_AGGREGATEINIT;
$compras->resetAttributes();
$compras_list->renderRow();
while ($compras_list->RecCnt < $compras_list->StopRec) {
	$compras_list->RecCnt++;
	if ($compras_list->RecCnt >= $compras_list->StartRec) {
		$compras_list->RowCnt++;

		// Set up key count
		$compras_list->KeyCount = $compras_list->RowIndex;

		// Init row class and style
		$compras->resetAttributes();
		$compras->CssClass = "";
		if ($compras->isGridAdd()) {
		} else {
			$compras_list->loadRowValues($compras_list->Recordset); // Load row values
		}
		$compras->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$compras->RowAttrs = array_merge($compras->RowAttrs, array('data-rowindex'=>$compras_list->RowCnt, 'id'=>'r' . $compras_list->RowCnt . '_compras', 'data-rowtype'=>$compras->RowType));

		// Render row
		$compras_list->renderRow();

		// Render list options
		$compras_list->renderListOptions();
?>
	<tr<?php echo $compras->rowAttributes() ?>>
<?php

// Render list options (body, left)
$compras_list->ListOptions->render("body", "left", $compras_list->RowCnt);
?>
	<?php if ($compras->id->Visible) { // id ?>
		<td data-name="id"<?php echo $compras->id->cellAttributes() ?>>
<span id="el<?php echo $compras_list->RowCnt ?>_compras_id" class="compras_id">
<span<?php echo $compras->id->viewAttributes() ?>>
<?php echo $compras->id->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($compras->data->Visible) { // data ?>
		<td data-name="data"<?php echo $compras->data->cellAttributes() ?>>
<span id="el<?php echo $compras_list->RowCnt ?>_compras_data" class="compras_data">
<span<?php echo $compras->data->viewAttributes() ?>>
<?php echo $compras->data->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($compras->valor->Visible) { // valor ?>
		<td data-name="valor"<?php echo $compras->valor->cellAttributes() ?>>
<span id="el<?php echo $compras_list->RowCnt ?>_compras_valor" class="compras_valor">
<span<?php echo $compras->valor->viewAttributes() ?>>
<?php echo $compras->valor->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($compras->fornecedor->Visible) { // fornecedor ?>
		<td data-name="fornecedor"<?php echo $compras->fornecedor->cellAttributes() ?>>
<span id="el<?php echo $compras_list->RowCnt ?>_compras_fornecedor" class="compras_fornecedor">
<span<?php echo $compras->fornecedor->viewAttributes() ?>>
<?php echo $compras->fornecedor->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($compras->parcelas->Visible) { // parcelas ?>
		<td data-name="parcelas"<?php echo $compras->parcelas->cellAttributes() ?>>
<span id="el<?php echo $compras_list->RowCnt ?>_compras_parcelas" class="compras_parcelas">
<span<?php echo $compras->parcelas->viewAttributes() ?>>
<?php echo $compras->parcelas->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$compras_list->ListOptions->render("body", "right", $compras_list->RowCnt);
?>
	</tr>
<?php
	}
	if (!$compras->isGridAdd())
		$compras_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
<?php if (!$compras->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($compras_list->Recordset)
	$compras_list->Recordset->Close();
?>
<?php if (!$compras->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$compras->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($compras_list->Pager)) $compras_list->Pager = new PrevNextPager($compras_list->StartRec, $compras_list->DisplayRecs, $compras_list->TotalRecs, $compras_list->AutoHidePager) ?>
<?php if ($compras_list->Pager->RecordCount > 0 && $compras_list->Pager->Visible) { ?>
<div class="ew-pager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ew-prev-next"><div class="input-group input-group-sm">
<div class="input-group-prepend">
<!-- first page button -->
	<?php if ($compras_list->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerFirst") ?>" href="<?php echo $compras_list->pageUrl() ?>start=<?php echo $compras_list->Pager->FirstButton->Start ?>"><i class="icon-first ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerFirst") ?>"><i class="icon-first ew-icon"></i></a>
	<?php } ?>
<!-- previous page button -->
	<?php if ($compras_list->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerPrevious") ?>" href="<?php echo $compras_list->pageUrl() ?>start=<?php echo $compras_list->Pager->PrevButton->Start ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerPrevious") ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } ?>
</div>
<!-- current page number -->
	<input class="form-control" type="text" name="<?php echo TABLE_PAGE_NO ?>" value="<?php echo $compras_list->Pager->CurrentPage ?>">
<div class="input-group-append">
<!-- next page button -->
	<?php if ($compras_list->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerNext") ?>" href="<?php echo $compras_list->pageUrl() ?>start=<?php echo $compras_list->Pager->NextButton->Start ?>"><i class="icon-next ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerNext") ?>"><i class="icon-next ew-icon"></i></a>
	<?php } ?>
<!-- last page button -->
	<?php if ($compras_list->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerLast") ?>" href="<?php echo $compras_list->pageUrl() ?>start=<?php echo $compras_list->Pager->LastButton->Start ?>"><i class="icon-last ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerLast") ?>"><i class="icon-last ew-icon"></i></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $compras_list->Pager->PageCount ?></span>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if ($compras_list->Pager->RecordCount > 0) { ?>
<div class="ew-pager ew-rec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $compras_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $compras_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $compras_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $compras_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($compras_list->TotalRecs == 0 && !$compras->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $compras_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$compras_list->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<?php if (!$compras->isExport()) { ?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$compras_list->terminate();
?>