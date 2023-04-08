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
$contas_correntes_movimento_list = new contas_correntes_movimento_list();

// Run the page
$contas_correntes_movimento_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$contas_correntes_movimento_list->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if (!$contas_correntes_movimento->isExport()) { ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "list";
var fcontas_correntes_movimentolist = currentForm = new ew.Form("fcontas_correntes_movimentolist", "list");
fcontas_correntes_movimentolist.formKeyCountName = '<?php echo $contas_correntes_movimento_list->FormKeyCountName ?>';

// Form_CustomValidate event
fcontas_correntes_movimentolist.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fcontas_correntes_movimentolist.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php } ?>
<?php if (!$contas_correntes_movimento->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($contas_correntes_movimento_list->TotalRecs > 0 && $contas_correntes_movimento_list->ExportOptions->visible()) { ?>
<?php $contas_correntes_movimento_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($contas_correntes_movimento_list->ImportOptions->visible()) { ?>
<?php $contas_correntes_movimento_list->ImportOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$contas_correntes_movimento_list->renderOtherOptions();
?>
<?php $contas_correntes_movimento_list->showPageHeader(); ?>
<?php
$contas_correntes_movimento_list->showMessage();
?>
<?php if ($contas_correntes_movimento_list->TotalRecs > 0 || $contas_correntes_movimento->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($contas_correntes_movimento_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> contas_correntes_movimento">
<form name="fcontas_correntes_movimentolist" id="fcontas_correntes_movimentolist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($contas_correntes_movimento_list->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $contas_correntes_movimento_list->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="contas_correntes_movimento">
<div id="gmp_contas_correntes_movimento" class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel">
<?php if ($contas_correntes_movimento_list->TotalRecs > 0 || $contas_correntes_movimento->isGridEdit()) { ?>
<table id="tbl_contas_correntes_movimentolist" class="table ew-table"><!-- .ew-table ##-->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$contas_correntes_movimento_list->RowType = ROWTYPE_HEADER;

// Render list options
$contas_correntes_movimento_list->renderListOptions();

// Render list options (header, left)
$contas_correntes_movimento_list->ListOptions->render("header", "left");
?>
<?php if ($contas_correntes_movimento->id->Visible) { // id ?>
	<?php if ($contas_correntes_movimento->sortUrl($contas_correntes_movimento->id) == "") { ?>
		<th data-name="id" class="<?php echo $contas_correntes_movimento->id->headerCellClass() ?>"><div id="elh_contas_correntes_movimento_id" class="contas_correntes_movimento_id"><div class="ew-table-header-caption"><?php echo $contas_correntes_movimento->id->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id" class="<?php echo $contas_correntes_movimento->id->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $contas_correntes_movimento->SortUrl($contas_correntes_movimento->id) ?>',1);"><div id="elh_contas_correntes_movimento_id" class="contas_correntes_movimento_id">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $contas_correntes_movimento->id->caption() ?></span><span class="ew-table-header-sort"><?php if ($contas_correntes_movimento->id->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($contas_correntes_movimento->id->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($contas_correntes_movimento->valor->Visible) { // valor ?>
	<?php if ($contas_correntes_movimento->sortUrl($contas_correntes_movimento->valor) == "") { ?>
		<th data-name="valor" class="<?php echo $contas_correntes_movimento->valor->headerCellClass() ?>"><div id="elh_contas_correntes_movimento_valor" class="contas_correntes_movimento_valor"><div class="ew-table-header-caption"><?php echo $contas_correntes_movimento->valor->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="valor" class="<?php echo $contas_correntes_movimento->valor->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $contas_correntes_movimento->SortUrl($contas_correntes_movimento->valor) ?>',1);"><div id="elh_contas_correntes_movimento_valor" class="contas_correntes_movimento_valor">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $contas_correntes_movimento->valor->caption() ?></span><span class="ew-table-header-sort"><?php if ($contas_correntes_movimento->valor->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($contas_correntes_movimento->valor->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($contas_correntes_movimento->tipo_movimentacao->Visible) { // tipo_movimentacao ?>
	<?php if ($contas_correntes_movimento->sortUrl($contas_correntes_movimento->tipo_movimentacao) == "") { ?>
		<th data-name="tipo_movimentacao" class="<?php echo $contas_correntes_movimento->tipo_movimentacao->headerCellClass() ?>"><div id="elh_contas_correntes_movimento_tipo_movimentacao" class="contas_correntes_movimento_tipo_movimentacao"><div class="ew-table-header-caption"><?php echo $contas_correntes_movimento->tipo_movimentacao->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="tipo_movimentacao" class="<?php echo $contas_correntes_movimento->tipo_movimentacao->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $contas_correntes_movimento->SortUrl($contas_correntes_movimento->tipo_movimentacao) ?>',1);"><div id="elh_contas_correntes_movimento_tipo_movimentacao" class="contas_correntes_movimento_tipo_movimentacao">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $contas_correntes_movimento->tipo_movimentacao->caption() ?></span><span class="ew-table-header-sort"><?php if ($contas_correntes_movimento->tipo_movimentacao->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($contas_correntes_movimento->tipo_movimentacao->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($contas_correntes_movimento->direcao->Visible) { // direcao ?>
	<?php if ($contas_correntes_movimento->sortUrl($contas_correntes_movimento->direcao) == "") { ?>
		<th data-name="direcao" class="<?php echo $contas_correntes_movimento->direcao->headerCellClass() ?>"><div id="elh_contas_correntes_movimento_direcao" class="contas_correntes_movimento_direcao"><div class="ew-table-header-caption"><?php echo $contas_correntes_movimento->direcao->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="direcao" class="<?php echo $contas_correntes_movimento->direcao->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $contas_correntes_movimento->SortUrl($contas_correntes_movimento->direcao) ?>',1);"><div id="elh_contas_correntes_movimento_direcao" class="contas_correntes_movimento_direcao">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $contas_correntes_movimento->direcao->caption() ?></span><span class="ew-table-header-sort"><?php if ($contas_correntes_movimento->direcao->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($contas_correntes_movimento->direcao->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$contas_correntes_movimento_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($contas_correntes_movimento->ExportAll && $contas_correntes_movimento->isExport()) {
	$contas_correntes_movimento_list->StopRec = $contas_correntes_movimento_list->TotalRecs;
} else {

	// Set the last record to display
	if ($contas_correntes_movimento_list->TotalRecs > $contas_correntes_movimento_list->StartRec + $contas_correntes_movimento_list->DisplayRecs - 1)
		$contas_correntes_movimento_list->StopRec = $contas_correntes_movimento_list->StartRec + $contas_correntes_movimento_list->DisplayRecs - 1;
	else
		$contas_correntes_movimento_list->StopRec = $contas_correntes_movimento_list->TotalRecs;
}
$contas_correntes_movimento_list->RecCnt = $contas_correntes_movimento_list->StartRec - 1;
if ($contas_correntes_movimento_list->Recordset && !$contas_correntes_movimento_list->Recordset->EOF) {
	$contas_correntes_movimento_list->Recordset->moveFirst();
	$selectLimit = $contas_correntes_movimento_list->UseSelectLimit;
	if (!$selectLimit && $contas_correntes_movimento_list->StartRec > 1)
		$contas_correntes_movimento_list->Recordset->move($contas_correntes_movimento_list->StartRec - 1);
} elseif (!$contas_correntes_movimento->AllowAddDeleteRow && $contas_correntes_movimento_list->StopRec == 0) {
	$contas_correntes_movimento_list->StopRec = $contas_correntes_movimento->GridAddRowCount;
}

// Initialize aggregate
$contas_correntes_movimento->RowType = ROWTYPE_AGGREGATEINIT;
$contas_correntes_movimento->resetAttributes();
$contas_correntes_movimento_list->renderRow();
while ($contas_correntes_movimento_list->RecCnt < $contas_correntes_movimento_list->StopRec) {
	$contas_correntes_movimento_list->RecCnt++;
	if ($contas_correntes_movimento_list->RecCnt >= $contas_correntes_movimento_list->StartRec) {
		$contas_correntes_movimento_list->RowCnt++;

		// Set up key count
		$contas_correntes_movimento_list->KeyCount = $contas_correntes_movimento_list->RowIndex;

		// Init row class and style
		$contas_correntes_movimento->resetAttributes();
		$contas_correntes_movimento->CssClass = "";
		if ($contas_correntes_movimento->isGridAdd()) {
		} else {
			$contas_correntes_movimento_list->loadRowValues($contas_correntes_movimento_list->Recordset); // Load row values
		}
		$contas_correntes_movimento->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$contas_correntes_movimento->RowAttrs = array_merge($contas_correntes_movimento->RowAttrs, array('data-rowindex'=>$contas_correntes_movimento_list->RowCnt, 'id'=>'r' . $contas_correntes_movimento_list->RowCnt . '_contas_correntes_movimento', 'data-rowtype'=>$contas_correntes_movimento->RowType));

		// Render row
		$contas_correntes_movimento_list->renderRow();

		// Render list options
		$contas_correntes_movimento_list->renderListOptions();
?>
	<tr<?php echo $contas_correntes_movimento->rowAttributes() ?>>
<?php

// Render list options (body, left)
$contas_correntes_movimento_list->ListOptions->render("body", "left", $contas_correntes_movimento_list->RowCnt);
?>
	<?php if ($contas_correntes_movimento->id->Visible) { // id ?>
		<td data-name="id"<?php echo $contas_correntes_movimento->id->cellAttributes() ?>>
<span id="el<?php echo $contas_correntes_movimento_list->RowCnt ?>_contas_correntes_movimento_id" class="contas_correntes_movimento_id">
<span<?php echo $contas_correntes_movimento->id->viewAttributes() ?>>
<?php echo $contas_correntes_movimento->id->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($contas_correntes_movimento->valor->Visible) { // valor ?>
		<td data-name="valor"<?php echo $contas_correntes_movimento->valor->cellAttributes() ?>>
<span id="el<?php echo $contas_correntes_movimento_list->RowCnt ?>_contas_correntes_movimento_valor" class="contas_correntes_movimento_valor">
<span<?php echo $contas_correntes_movimento->valor->viewAttributes() ?>>
<?php echo $contas_correntes_movimento->valor->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($contas_correntes_movimento->tipo_movimentacao->Visible) { // tipo_movimentacao ?>
		<td data-name="tipo_movimentacao"<?php echo $contas_correntes_movimento->tipo_movimentacao->cellAttributes() ?>>
<span id="el<?php echo $contas_correntes_movimento_list->RowCnt ?>_contas_correntes_movimento_tipo_movimentacao" class="contas_correntes_movimento_tipo_movimentacao">
<span<?php echo $contas_correntes_movimento->tipo_movimentacao->viewAttributes() ?>>
<?php echo $contas_correntes_movimento->tipo_movimentacao->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($contas_correntes_movimento->direcao->Visible) { // direcao ?>
		<td data-name="direcao"<?php echo $contas_correntes_movimento->direcao->cellAttributes() ?>>
<span id="el<?php echo $contas_correntes_movimento_list->RowCnt ?>_contas_correntes_movimento_direcao" class="contas_correntes_movimento_direcao">
<span<?php echo $contas_correntes_movimento->direcao->viewAttributes() ?>>
<?php echo $contas_correntes_movimento->direcao->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$contas_correntes_movimento_list->ListOptions->render("body", "right", $contas_correntes_movimento_list->RowCnt);
?>
	</tr>
<?php
	}
	if (!$contas_correntes_movimento->isGridAdd())
		$contas_correntes_movimento_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
<?php if (!$contas_correntes_movimento->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($contas_correntes_movimento_list->Recordset)
	$contas_correntes_movimento_list->Recordset->Close();
?>
<?php if (!$contas_correntes_movimento->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$contas_correntes_movimento->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($contas_correntes_movimento_list->Pager)) $contas_correntes_movimento_list->Pager = new PrevNextPager($contas_correntes_movimento_list->StartRec, $contas_correntes_movimento_list->DisplayRecs, $contas_correntes_movimento_list->TotalRecs, $contas_correntes_movimento_list->AutoHidePager) ?>
<?php if ($contas_correntes_movimento_list->Pager->RecordCount > 0 && $contas_correntes_movimento_list->Pager->Visible) { ?>
<div class="ew-pager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ew-prev-next"><div class="input-group input-group-sm">
<div class="input-group-prepend">
<!-- first page button -->
	<?php if ($contas_correntes_movimento_list->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerFirst") ?>" href="<?php echo $contas_correntes_movimento_list->pageUrl() ?>start=<?php echo $contas_correntes_movimento_list->Pager->FirstButton->Start ?>"><i class="icon-first ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerFirst") ?>"><i class="icon-first ew-icon"></i></a>
	<?php } ?>
<!-- previous page button -->
	<?php if ($contas_correntes_movimento_list->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerPrevious") ?>" href="<?php echo $contas_correntes_movimento_list->pageUrl() ?>start=<?php echo $contas_correntes_movimento_list->Pager->PrevButton->Start ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerPrevious") ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } ?>
</div>
<!-- current page number -->
	<input class="form-control" type="text" name="<?php echo TABLE_PAGE_NO ?>" value="<?php echo $contas_correntes_movimento_list->Pager->CurrentPage ?>">
<div class="input-group-append">
<!-- next page button -->
	<?php if ($contas_correntes_movimento_list->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerNext") ?>" href="<?php echo $contas_correntes_movimento_list->pageUrl() ?>start=<?php echo $contas_correntes_movimento_list->Pager->NextButton->Start ?>"><i class="icon-next ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerNext") ?>"><i class="icon-next ew-icon"></i></a>
	<?php } ?>
<!-- last page button -->
	<?php if ($contas_correntes_movimento_list->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerLast") ?>" href="<?php echo $contas_correntes_movimento_list->pageUrl() ?>start=<?php echo $contas_correntes_movimento_list->Pager->LastButton->Start ?>"><i class="icon-last ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerLast") ?>"><i class="icon-last ew-icon"></i></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $contas_correntes_movimento_list->Pager->PageCount ?></span>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if ($contas_correntes_movimento_list->Pager->RecordCount > 0) { ?>
<div class="ew-pager ew-rec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $contas_correntes_movimento_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $contas_correntes_movimento_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $contas_correntes_movimento_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $contas_correntes_movimento_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($contas_correntes_movimento_list->TotalRecs == 0 && !$contas_correntes_movimento->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $contas_correntes_movimento_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$contas_correntes_movimento_list->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<?php if (!$contas_correntes_movimento->isExport()) { ?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$contas_correntes_movimento_list->terminate();
?>