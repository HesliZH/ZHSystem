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
$contas_pagar_pagamentos_list = new contas_pagar_pagamentos_list();

// Run the page
$contas_pagar_pagamentos_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$contas_pagar_pagamentos_list->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if (!$contas_pagar_pagamentos->isExport()) { ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "list";
var fcontas_pagar_pagamentoslist = currentForm = new ew.Form("fcontas_pagar_pagamentoslist", "list");
fcontas_pagar_pagamentoslist.formKeyCountName = '<?php echo $contas_pagar_pagamentos_list->FormKeyCountName ?>';

// Form_CustomValidate event
fcontas_pagar_pagamentoslist.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fcontas_pagar_pagamentoslist.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php } ?>
<?php if (!$contas_pagar_pagamentos->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($contas_pagar_pagamentos_list->TotalRecs > 0 && $contas_pagar_pagamentos_list->ExportOptions->visible()) { ?>
<?php $contas_pagar_pagamentos_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($contas_pagar_pagamentos_list->ImportOptions->visible()) { ?>
<?php $contas_pagar_pagamentos_list->ImportOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$contas_pagar_pagamentos_list->renderOtherOptions();
?>
<?php $contas_pagar_pagamentos_list->showPageHeader(); ?>
<?php
$contas_pagar_pagamentos_list->showMessage();
?>
<?php if ($contas_pagar_pagamentos_list->TotalRecs > 0 || $contas_pagar_pagamentos->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($contas_pagar_pagamentos_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> contas_pagar_pagamentos">
<form name="fcontas_pagar_pagamentoslist" id="fcontas_pagar_pagamentoslist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($contas_pagar_pagamentos_list->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $contas_pagar_pagamentos_list->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="contas_pagar_pagamentos">
<div id="gmp_contas_pagar_pagamentos" class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel">
<?php if ($contas_pagar_pagamentos_list->TotalRecs > 0 || $contas_pagar_pagamentos->isGridEdit()) { ?>
<table id="tbl_contas_pagar_pagamentoslist" class="table ew-table"><!-- .ew-table ##-->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$contas_pagar_pagamentos_list->RowType = ROWTYPE_HEADER;

// Render list options
$contas_pagar_pagamentos_list->renderListOptions();

// Render list options (header, left)
$contas_pagar_pagamentos_list->ListOptions->render("header", "left");
?>
<?php if ($contas_pagar_pagamentos->id->Visible) { // id ?>
	<?php if ($contas_pagar_pagamentos->sortUrl($contas_pagar_pagamentos->id) == "") { ?>
		<th data-name="id" class="<?php echo $contas_pagar_pagamentos->id->headerCellClass() ?>"><div id="elh_contas_pagar_pagamentos_id" class="contas_pagar_pagamentos_id"><div class="ew-table-header-caption"><?php echo $contas_pagar_pagamentos->id->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id" class="<?php echo $contas_pagar_pagamentos->id->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $contas_pagar_pagamentos->SortUrl($contas_pagar_pagamentos->id) ?>',1);"><div id="elh_contas_pagar_pagamentos_id" class="contas_pagar_pagamentos_id">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $contas_pagar_pagamentos->id->caption() ?></span><span class="ew-table-header-sort"><?php if ($contas_pagar_pagamentos->id->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($contas_pagar_pagamentos->id->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($contas_pagar_pagamentos->id_contas_pagar->Visible) { // id_contas_pagar ?>
	<?php if ($contas_pagar_pagamentos->sortUrl($contas_pagar_pagamentos->id_contas_pagar) == "") { ?>
		<th data-name="id_contas_pagar" class="<?php echo $contas_pagar_pagamentos->id_contas_pagar->headerCellClass() ?>"><div id="elh_contas_pagar_pagamentos_id_contas_pagar" class="contas_pagar_pagamentos_id_contas_pagar"><div class="ew-table-header-caption"><?php echo $contas_pagar_pagamentos->id_contas_pagar->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id_contas_pagar" class="<?php echo $contas_pagar_pagamentos->id_contas_pagar->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $contas_pagar_pagamentos->SortUrl($contas_pagar_pagamentos->id_contas_pagar) ?>',1);"><div id="elh_contas_pagar_pagamentos_id_contas_pagar" class="contas_pagar_pagamentos_id_contas_pagar">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $contas_pagar_pagamentos->id_contas_pagar->caption() ?></span><span class="ew-table-header-sort"><?php if ($contas_pagar_pagamentos->id_contas_pagar->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($contas_pagar_pagamentos->id_contas_pagar->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($contas_pagar_pagamentos->valor_pago->Visible) { // valor_pago ?>
	<?php if ($contas_pagar_pagamentos->sortUrl($contas_pagar_pagamentos->valor_pago) == "") { ?>
		<th data-name="valor_pago" class="<?php echo $contas_pagar_pagamentos->valor_pago->headerCellClass() ?>"><div id="elh_contas_pagar_pagamentos_valor_pago" class="contas_pagar_pagamentos_valor_pago"><div class="ew-table-header-caption"><?php echo $contas_pagar_pagamentos->valor_pago->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="valor_pago" class="<?php echo $contas_pagar_pagamentos->valor_pago->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $contas_pagar_pagamentos->SortUrl($contas_pagar_pagamentos->valor_pago) ?>',1);"><div id="elh_contas_pagar_pagamentos_valor_pago" class="contas_pagar_pagamentos_valor_pago">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $contas_pagar_pagamentos->valor_pago->caption() ?></span><span class="ew-table-header-sort"><?php if ($contas_pagar_pagamentos->valor_pago->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($contas_pagar_pagamentos->valor_pago->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($contas_pagar_pagamentos->parcela->Visible) { // parcela ?>
	<?php if ($contas_pagar_pagamentos->sortUrl($contas_pagar_pagamentos->parcela) == "") { ?>
		<th data-name="parcela" class="<?php echo $contas_pagar_pagamentos->parcela->headerCellClass() ?>"><div id="elh_contas_pagar_pagamentos_parcela" class="contas_pagar_pagamentos_parcela"><div class="ew-table-header-caption"><?php echo $contas_pagar_pagamentos->parcela->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="parcela" class="<?php echo $contas_pagar_pagamentos->parcela->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $contas_pagar_pagamentos->SortUrl($contas_pagar_pagamentos->parcela) ?>',1);"><div id="elh_contas_pagar_pagamentos_parcela" class="contas_pagar_pagamentos_parcela">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $contas_pagar_pagamentos->parcela->caption() ?></span><span class="ew-table-header-sort"><?php if ($contas_pagar_pagamentos->parcela->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($contas_pagar_pagamentos->parcela->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($contas_pagar_pagamentos->forma_pagamento->Visible) { // forma_pagamento ?>
	<?php if ($contas_pagar_pagamentos->sortUrl($contas_pagar_pagamentos->forma_pagamento) == "") { ?>
		<th data-name="forma_pagamento" class="<?php echo $contas_pagar_pagamentos->forma_pagamento->headerCellClass() ?>"><div id="elh_contas_pagar_pagamentos_forma_pagamento" class="contas_pagar_pagamentos_forma_pagamento"><div class="ew-table-header-caption"><?php echo $contas_pagar_pagamentos->forma_pagamento->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="forma_pagamento" class="<?php echo $contas_pagar_pagamentos->forma_pagamento->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $contas_pagar_pagamentos->SortUrl($contas_pagar_pagamentos->forma_pagamento) ?>',1);"><div id="elh_contas_pagar_pagamentos_forma_pagamento" class="contas_pagar_pagamentos_forma_pagamento">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $contas_pagar_pagamentos->forma_pagamento->caption() ?></span><span class="ew-table-header-sort"><?php if ($contas_pagar_pagamentos->forma_pagamento->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($contas_pagar_pagamentos->forma_pagamento->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($contas_pagar_pagamentos->id_movimentacao_conta->Visible) { // id_movimentacao_conta ?>
	<?php if ($contas_pagar_pagamentos->sortUrl($contas_pagar_pagamentos->id_movimentacao_conta) == "") { ?>
		<th data-name="id_movimentacao_conta" class="<?php echo $contas_pagar_pagamentos->id_movimentacao_conta->headerCellClass() ?>"><div id="elh_contas_pagar_pagamentos_id_movimentacao_conta" class="contas_pagar_pagamentos_id_movimentacao_conta"><div class="ew-table-header-caption"><?php echo $contas_pagar_pagamentos->id_movimentacao_conta->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id_movimentacao_conta" class="<?php echo $contas_pagar_pagamentos->id_movimentacao_conta->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $contas_pagar_pagamentos->SortUrl($contas_pagar_pagamentos->id_movimentacao_conta) ?>',1);"><div id="elh_contas_pagar_pagamentos_id_movimentacao_conta" class="contas_pagar_pagamentos_id_movimentacao_conta">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $contas_pagar_pagamentos->id_movimentacao_conta->caption() ?></span><span class="ew-table-header-sort"><?php if ($contas_pagar_pagamentos->id_movimentacao_conta->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($contas_pagar_pagamentos->id_movimentacao_conta->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$contas_pagar_pagamentos_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($contas_pagar_pagamentos->ExportAll && $contas_pagar_pagamentos->isExport()) {
	$contas_pagar_pagamentos_list->StopRec = $contas_pagar_pagamentos_list->TotalRecs;
} else {

	// Set the last record to display
	if ($contas_pagar_pagamentos_list->TotalRecs > $contas_pagar_pagamentos_list->StartRec + $contas_pagar_pagamentos_list->DisplayRecs - 1)
		$contas_pagar_pagamentos_list->StopRec = $contas_pagar_pagamentos_list->StartRec + $contas_pagar_pagamentos_list->DisplayRecs - 1;
	else
		$contas_pagar_pagamentos_list->StopRec = $contas_pagar_pagamentos_list->TotalRecs;
}
$contas_pagar_pagamentos_list->RecCnt = $contas_pagar_pagamentos_list->StartRec - 1;
if ($contas_pagar_pagamentos_list->Recordset && !$contas_pagar_pagamentos_list->Recordset->EOF) {
	$contas_pagar_pagamentos_list->Recordset->moveFirst();
	$selectLimit = $contas_pagar_pagamentos_list->UseSelectLimit;
	if (!$selectLimit && $contas_pagar_pagamentos_list->StartRec > 1)
		$contas_pagar_pagamentos_list->Recordset->move($contas_pagar_pagamentos_list->StartRec - 1);
} elseif (!$contas_pagar_pagamentos->AllowAddDeleteRow && $contas_pagar_pagamentos_list->StopRec == 0) {
	$contas_pagar_pagamentos_list->StopRec = $contas_pagar_pagamentos->GridAddRowCount;
}

// Initialize aggregate
$contas_pagar_pagamentos->RowType = ROWTYPE_AGGREGATEINIT;
$contas_pagar_pagamentos->resetAttributes();
$contas_pagar_pagamentos_list->renderRow();
while ($contas_pagar_pagamentos_list->RecCnt < $contas_pagar_pagamentos_list->StopRec) {
	$contas_pagar_pagamentos_list->RecCnt++;
	if ($contas_pagar_pagamentos_list->RecCnt >= $contas_pagar_pagamentos_list->StartRec) {
		$contas_pagar_pagamentos_list->RowCnt++;

		// Set up key count
		$contas_pagar_pagamentos_list->KeyCount = $contas_pagar_pagamentos_list->RowIndex;

		// Init row class and style
		$contas_pagar_pagamentos->resetAttributes();
		$contas_pagar_pagamentos->CssClass = "";
		if ($contas_pagar_pagamentos->isGridAdd()) {
		} else {
			$contas_pagar_pagamentos_list->loadRowValues($contas_pagar_pagamentos_list->Recordset); // Load row values
		}
		$contas_pagar_pagamentos->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$contas_pagar_pagamentos->RowAttrs = array_merge($contas_pagar_pagamentos->RowAttrs, array('data-rowindex'=>$contas_pagar_pagamentos_list->RowCnt, 'id'=>'r' . $contas_pagar_pagamentos_list->RowCnt . '_contas_pagar_pagamentos', 'data-rowtype'=>$contas_pagar_pagamentos->RowType));

		// Render row
		$contas_pagar_pagamentos_list->renderRow();

		// Render list options
		$contas_pagar_pagamentos_list->renderListOptions();
?>
	<tr<?php echo $contas_pagar_pagamentos->rowAttributes() ?>>
<?php

// Render list options (body, left)
$contas_pagar_pagamentos_list->ListOptions->render("body", "left", $contas_pagar_pagamentos_list->RowCnt);
?>
	<?php if ($contas_pagar_pagamentos->id->Visible) { // id ?>
		<td data-name="id"<?php echo $contas_pagar_pagamentos->id->cellAttributes() ?>>
<span id="el<?php echo $contas_pagar_pagamentos_list->RowCnt ?>_contas_pagar_pagamentos_id" class="contas_pagar_pagamentos_id">
<span<?php echo $contas_pagar_pagamentos->id->viewAttributes() ?>>
<?php echo $contas_pagar_pagamentos->id->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($contas_pagar_pagamentos->id_contas_pagar->Visible) { // id_contas_pagar ?>
		<td data-name="id_contas_pagar"<?php echo $contas_pagar_pagamentos->id_contas_pagar->cellAttributes() ?>>
<span id="el<?php echo $contas_pagar_pagamentos_list->RowCnt ?>_contas_pagar_pagamentos_id_contas_pagar" class="contas_pagar_pagamentos_id_contas_pagar">
<span<?php echo $contas_pagar_pagamentos->id_contas_pagar->viewAttributes() ?>>
<?php echo $contas_pagar_pagamentos->id_contas_pagar->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($contas_pagar_pagamentos->valor_pago->Visible) { // valor_pago ?>
		<td data-name="valor_pago"<?php echo $contas_pagar_pagamentos->valor_pago->cellAttributes() ?>>
<span id="el<?php echo $contas_pagar_pagamentos_list->RowCnt ?>_contas_pagar_pagamentos_valor_pago" class="contas_pagar_pagamentos_valor_pago">
<span<?php echo $contas_pagar_pagamentos->valor_pago->viewAttributes() ?>>
<?php echo $contas_pagar_pagamentos->valor_pago->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($contas_pagar_pagamentos->parcela->Visible) { // parcela ?>
		<td data-name="parcela"<?php echo $contas_pagar_pagamentos->parcela->cellAttributes() ?>>
<span id="el<?php echo $contas_pagar_pagamentos_list->RowCnt ?>_contas_pagar_pagamentos_parcela" class="contas_pagar_pagamentos_parcela">
<span<?php echo $contas_pagar_pagamentos->parcela->viewAttributes() ?>>
<?php echo $contas_pagar_pagamentos->parcela->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($contas_pagar_pagamentos->forma_pagamento->Visible) { // forma_pagamento ?>
		<td data-name="forma_pagamento"<?php echo $contas_pagar_pagamentos->forma_pagamento->cellAttributes() ?>>
<span id="el<?php echo $contas_pagar_pagamentos_list->RowCnt ?>_contas_pagar_pagamentos_forma_pagamento" class="contas_pagar_pagamentos_forma_pagamento">
<span<?php echo $contas_pagar_pagamentos->forma_pagamento->viewAttributes() ?>>
<?php echo $contas_pagar_pagamentos->forma_pagamento->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($contas_pagar_pagamentos->id_movimentacao_conta->Visible) { // id_movimentacao_conta ?>
		<td data-name="id_movimentacao_conta"<?php echo $contas_pagar_pagamentos->id_movimentacao_conta->cellAttributes() ?>>
<span id="el<?php echo $contas_pagar_pagamentos_list->RowCnt ?>_contas_pagar_pagamentos_id_movimentacao_conta" class="contas_pagar_pagamentos_id_movimentacao_conta">
<span<?php echo $contas_pagar_pagamentos->id_movimentacao_conta->viewAttributes() ?>>
<?php echo $contas_pagar_pagamentos->id_movimentacao_conta->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$contas_pagar_pagamentos_list->ListOptions->render("body", "right", $contas_pagar_pagamentos_list->RowCnt);
?>
	</tr>
<?php
	}
	if (!$contas_pagar_pagamentos->isGridAdd())
		$contas_pagar_pagamentos_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
<?php if (!$contas_pagar_pagamentos->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($contas_pagar_pagamentos_list->Recordset)
	$contas_pagar_pagamentos_list->Recordset->Close();
?>
<?php if (!$contas_pagar_pagamentos->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$contas_pagar_pagamentos->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($contas_pagar_pagamentos_list->Pager)) $contas_pagar_pagamentos_list->Pager = new PrevNextPager($contas_pagar_pagamentos_list->StartRec, $contas_pagar_pagamentos_list->DisplayRecs, $contas_pagar_pagamentos_list->TotalRecs, $contas_pagar_pagamentos_list->AutoHidePager) ?>
<?php if ($contas_pagar_pagamentos_list->Pager->RecordCount > 0 && $contas_pagar_pagamentos_list->Pager->Visible) { ?>
<div class="ew-pager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ew-prev-next"><div class="input-group input-group-sm">
<div class="input-group-prepend">
<!-- first page button -->
	<?php if ($contas_pagar_pagamentos_list->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerFirst") ?>" href="<?php echo $contas_pagar_pagamentos_list->pageUrl() ?>start=<?php echo $contas_pagar_pagamentos_list->Pager->FirstButton->Start ?>"><i class="icon-first ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerFirst") ?>"><i class="icon-first ew-icon"></i></a>
	<?php } ?>
<!-- previous page button -->
	<?php if ($contas_pagar_pagamentos_list->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerPrevious") ?>" href="<?php echo $contas_pagar_pagamentos_list->pageUrl() ?>start=<?php echo $contas_pagar_pagamentos_list->Pager->PrevButton->Start ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerPrevious") ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } ?>
</div>
<!-- current page number -->
	<input class="form-control" type="text" name="<?php echo TABLE_PAGE_NO ?>" value="<?php echo $contas_pagar_pagamentos_list->Pager->CurrentPage ?>">
<div class="input-group-append">
<!-- next page button -->
	<?php if ($contas_pagar_pagamentos_list->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerNext") ?>" href="<?php echo $contas_pagar_pagamentos_list->pageUrl() ?>start=<?php echo $contas_pagar_pagamentos_list->Pager->NextButton->Start ?>"><i class="icon-next ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerNext") ?>"><i class="icon-next ew-icon"></i></a>
	<?php } ?>
<!-- last page button -->
	<?php if ($contas_pagar_pagamentos_list->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerLast") ?>" href="<?php echo $contas_pagar_pagamentos_list->pageUrl() ?>start=<?php echo $contas_pagar_pagamentos_list->Pager->LastButton->Start ?>"><i class="icon-last ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerLast") ?>"><i class="icon-last ew-icon"></i></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $contas_pagar_pagamentos_list->Pager->PageCount ?></span>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if ($contas_pagar_pagamentos_list->Pager->RecordCount > 0) { ?>
<div class="ew-pager ew-rec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $contas_pagar_pagamentos_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $contas_pagar_pagamentos_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $contas_pagar_pagamentos_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $contas_pagar_pagamentos_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($contas_pagar_pagamentos_list->TotalRecs == 0 && !$contas_pagar_pagamentos->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $contas_pagar_pagamentos_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$contas_pagar_pagamentos_list->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<?php if (!$contas_pagar_pagamentos->isExport()) { ?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$contas_pagar_pagamentos_list->terminate();
?>