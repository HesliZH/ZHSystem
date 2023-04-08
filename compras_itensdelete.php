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
$compras_itens_delete = new compras_itens_delete();

// Run the page
$compras_itens_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$compras_itens_delete->Page_Render();
?>
<?php include_once "header.php" ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "delete";
var fcompras_itensdelete = currentForm = new ew.Form("fcompras_itensdelete", "delete");

// Form_CustomValidate event
fcompras_itensdelete.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fcompras_itensdelete.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php $compras_itens_delete->showPageHeader(); ?>
<?php
$compras_itens_delete->showMessage();
?>
<form name="fcompras_itensdelete" id="fcompras_itensdelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($compras_itens_delete->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $compras_itens_delete->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="compras_itens">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($compras_itens_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode($COMPOSITE_KEY_SEPARATOR, $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($compras_itens->id->Visible) { // id ?>
		<th class="<?php echo $compras_itens->id->headerCellClass() ?>"><span id="elh_compras_itens_id" class="compras_itens_id"><?php echo $compras_itens->id->caption() ?></span></th>
<?php } ?>
<?php if ($compras_itens->id_compra->Visible) { // id_compra ?>
		<th class="<?php echo $compras_itens->id_compra->headerCellClass() ?>"><span id="elh_compras_itens_id_compra" class="compras_itens_id_compra"><?php echo $compras_itens->id_compra->caption() ?></span></th>
<?php } ?>
<?php if ($compras_itens->item->Visible) { // item ?>
		<th class="<?php echo $compras_itens->item->headerCellClass() ?>"><span id="elh_compras_itens_item" class="compras_itens_item"><?php echo $compras_itens->item->caption() ?></span></th>
<?php } ?>
<?php if ($compras_itens->quantidade->Visible) { // quantidade ?>
		<th class="<?php echo $compras_itens->quantidade->headerCellClass() ?>"><span id="elh_compras_itens_quantidade" class="compras_itens_quantidade"><?php echo $compras_itens->quantidade->caption() ?></span></th>
<?php } ?>
<?php if ($compras_itens->unitario->Visible) { // unitario ?>
		<th class="<?php echo $compras_itens->unitario->headerCellClass() ?>"><span id="elh_compras_itens_unitario" class="compras_itens_unitario"><?php echo $compras_itens->unitario->caption() ?></span></th>
<?php } ?>
<?php if ($compras_itens->total->Visible) { // total ?>
		<th class="<?php echo $compras_itens->total->headerCellClass() ?>"><span id="elh_compras_itens_total" class="compras_itens_total"><?php echo $compras_itens->total->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$compras_itens_delete->RecCnt = 0;
$i = 0;
while (!$compras_itens_delete->Recordset->EOF) {
	$compras_itens_delete->RecCnt++;
	$compras_itens_delete->RowCnt++;

	// Set row properties
	$compras_itens->resetAttributes();
	$compras_itens->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$compras_itens_delete->loadRowValues($compras_itens_delete->Recordset);

	// Render row
	$compras_itens_delete->renderRow();
?>
	<tr<?php echo $compras_itens->rowAttributes() ?>>
<?php if ($compras_itens->id->Visible) { // id ?>
		<td<?php echo $compras_itens->id->cellAttributes() ?>>
<span id="el<?php echo $compras_itens_delete->RowCnt ?>_compras_itens_id" class="compras_itens_id">
<span<?php echo $compras_itens->id->viewAttributes() ?>>
<?php echo $compras_itens->id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($compras_itens->id_compra->Visible) { // id_compra ?>
		<td<?php echo $compras_itens->id_compra->cellAttributes() ?>>
<span id="el<?php echo $compras_itens_delete->RowCnt ?>_compras_itens_id_compra" class="compras_itens_id_compra">
<span<?php echo $compras_itens->id_compra->viewAttributes() ?>>
<?php echo $compras_itens->id_compra->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($compras_itens->item->Visible) { // item ?>
		<td<?php echo $compras_itens->item->cellAttributes() ?>>
<span id="el<?php echo $compras_itens_delete->RowCnt ?>_compras_itens_item" class="compras_itens_item">
<span<?php echo $compras_itens->item->viewAttributes() ?>>
<?php echo $compras_itens->item->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($compras_itens->quantidade->Visible) { // quantidade ?>
		<td<?php echo $compras_itens->quantidade->cellAttributes() ?>>
<span id="el<?php echo $compras_itens_delete->RowCnt ?>_compras_itens_quantidade" class="compras_itens_quantidade">
<span<?php echo $compras_itens->quantidade->viewAttributes() ?>>
<?php echo $compras_itens->quantidade->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($compras_itens->unitario->Visible) { // unitario ?>
		<td<?php echo $compras_itens->unitario->cellAttributes() ?>>
<span id="el<?php echo $compras_itens_delete->RowCnt ?>_compras_itens_unitario" class="compras_itens_unitario">
<span<?php echo $compras_itens->unitario->viewAttributes() ?>>
<?php echo $compras_itens->unitario->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($compras_itens->total->Visible) { // total ?>
		<td<?php echo $compras_itens->total->cellAttributes() ?>>
<span id="el<?php echo $compras_itens_delete->RowCnt ?>_compras_itens_total" class="compras_itens_total">
<span<?php echo $compras_itens->total->viewAttributes() ?>>
<?php echo $compras_itens->total->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$compras_itens_delete->Recordset->moveNext();
}
$compras_itens_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $compras_itens_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$compras_itens_delete->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$compras_itens_delete->terminate();
?>