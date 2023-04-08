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
$contas_pagar_pagamentos_delete = new contas_pagar_pagamentos_delete();

// Run the page
$contas_pagar_pagamentos_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$contas_pagar_pagamentos_delete->Page_Render();
?>
<?php include_once "header.php" ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "delete";
var fcontas_pagar_pagamentosdelete = currentForm = new ew.Form("fcontas_pagar_pagamentosdelete", "delete");

// Form_CustomValidate event
fcontas_pagar_pagamentosdelete.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fcontas_pagar_pagamentosdelete.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php $contas_pagar_pagamentos_delete->showPageHeader(); ?>
<?php
$contas_pagar_pagamentos_delete->showMessage();
?>
<form name="fcontas_pagar_pagamentosdelete" id="fcontas_pagar_pagamentosdelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($contas_pagar_pagamentos_delete->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $contas_pagar_pagamentos_delete->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="contas_pagar_pagamentos">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($contas_pagar_pagamentos_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode($COMPOSITE_KEY_SEPARATOR, $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($contas_pagar_pagamentos->id->Visible) { // id ?>
		<th class="<?php echo $contas_pagar_pagamentos->id->headerCellClass() ?>"><span id="elh_contas_pagar_pagamentos_id" class="contas_pagar_pagamentos_id"><?php echo $contas_pagar_pagamentos->id->caption() ?></span></th>
<?php } ?>
<?php if ($contas_pagar_pagamentos->id_contas_pagar->Visible) { // id_contas_pagar ?>
		<th class="<?php echo $contas_pagar_pagamentos->id_contas_pagar->headerCellClass() ?>"><span id="elh_contas_pagar_pagamentos_id_contas_pagar" class="contas_pagar_pagamentos_id_contas_pagar"><?php echo $contas_pagar_pagamentos->id_contas_pagar->caption() ?></span></th>
<?php } ?>
<?php if ($contas_pagar_pagamentos->valor_pago->Visible) { // valor_pago ?>
		<th class="<?php echo $contas_pagar_pagamentos->valor_pago->headerCellClass() ?>"><span id="elh_contas_pagar_pagamentos_valor_pago" class="contas_pagar_pagamentos_valor_pago"><?php echo $contas_pagar_pagamentos->valor_pago->caption() ?></span></th>
<?php } ?>
<?php if ($contas_pagar_pagamentos->parcela->Visible) { // parcela ?>
		<th class="<?php echo $contas_pagar_pagamentos->parcela->headerCellClass() ?>"><span id="elh_contas_pagar_pagamentos_parcela" class="contas_pagar_pagamentos_parcela"><?php echo $contas_pagar_pagamentos->parcela->caption() ?></span></th>
<?php } ?>
<?php if ($contas_pagar_pagamentos->forma_pagamento->Visible) { // forma_pagamento ?>
		<th class="<?php echo $contas_pagar_pagamentos->forma_pagamento->headerCellClass() ?>"><span id="elh_contas_pagar_pagamentos_forma_pagamento" class="contas_pagar_pagamentos_forma_pagamento"><?php echo $contas_pagar_pagamentos->forma_pagamento->caption() ?></span></th>
<?php } ?>
<?php if ($contas_pagar_pagamentos->id_movimentacao_conta->Visible) { // id_movimentacao_conta ?>
		<th class="<?php echo $contas_pagar_pagamentos->id_movimentacao_conta->headerCellClass() ?>"><span id="elh_contas_pagar_pagamentos_id_movimentacao_conta" class="contas_pagar_pagamentos_id_movimentacao_conta"><?php echo $contas_pagar_pagamentos->id_movimentacao_conta->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$contas_pagar_pagamentos_delete->RecCnt = 0;
$i = 0;
while (!$contas_pagar_pagamentos_delete->Recordset->EOF) {
	$contas_pagar_pagamentos_delete->RecCnt++;
	$contas_pagar_pagamentos_delete->RowCnt++;

	// Set row properties
	$contas_pagar_pagamentos->resetAttributes();
	$contas_pagar_pagamentos->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$contas_pagar_pagamentos_delete->loadRowValues($contas_pagar_pagamentos_delete->Recordset);

	// Render row
	$contas_pagar_pagamentos_delete->renderRow();
?>
	<tr<?php echo $contas_pagar_pagamentos->rowAttributes() ?>>
<?php if ($contas_pagar_pagamentos->id->Visible) { // id ?>
		<td<?php echo $contas_pagar_pagamentos->id->cellAttributes() ?>>
<span id="el<?php echo $contas_pagar_pagamentos_delete->RowCnt ?>_contas_pagar_pagamentos_id" class="contas_pagar_pagamentos_id">
<span<?php echo $contas_pagar_pagamentos->id->viewAttributes() ?>>
<?php echo $contas_pagar_pagamentos->id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($contas_pagar_pagamentos->id_contas_pagar->Visible) { // id_contas_pagar ?>
		<td<?php echo $contas_pagar_pagamentos->id_contas_pagar->cellAttributes() ?>>
<span id="el<?php echo $contas_pagar_pagamentos_delete->RowCnt ?>_contas_pagar_pagamentos_id_contas_pagar" class="contas_pagar_pagamentos_id_contas_pagar">
<span<?php echo $contas_pagar_pagamentos->id_contas_pagar->viewAttributes() ?>>
<?php echo $contas_pagar_pagamentos->id_contas_pagar->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($contas_pagar_pagamentos->valor_pago->Visible) { // valor_pago ?>
		<td<?php echo $contas_pagar_pagamentos->valor_pago->cellAttributes() ?>>
<span id="el<?php echo $contas_pagar_pagamentos_delete->RowCnt ?>_contas_pagar_pagamentos_valor_pago" class="contas_pagar_pagamentos_valor_pago">
<span<?php echo $contas_pagar_pagamentos->valor_pago->viewAttributes() ?>>
<?php echo $contas_pagar_pagamentos->valor_pago->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($contas_pagar_pagamentos->parcela->Visible) { // parcela ?>
		<td<?php echo $contas_pagar_pagamentos->parcela->cellAttributes() ?>>
<span id="el<?php echo $contas_pagar_pagamentos_delete->RowCnt ?>_contas_pagar_pagamentos_parcela" class="contas_pagar_pagamentos_parcela">
<span<?php echo $contas_pagar_pagamentos->parcela->viewAttributes() ?>>
<?php echo $contas_pagar_pagamentos->parcela->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($contas_pagar_pagamentos->forma_pagamento->Visible) { // forma_pagamento ?>
		<td<?php echo $contas_pagar_pagamentos->forma_pagamento->cellAttributes() ?>>
<span id="el<?php echo $contas_pagar_pagamentos_delete->RowCnt ?>_contas_pagar_pagamentos_forma_pagamento" class="contas_pagar_pagamentos_forma_pagamento">
<span<?php echo $contas_pagar_pagamentos->forma_pagamento->viewAttributes() ?>>
<?php echo $contas_pagar_pagamentos->forma_pagamento->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($contas_pagar_pagamentos->id_movimentacao_conta->Visible) { // id_movimentacao_conta ?>
		<td<?php echo $contas_pagar_pagamentos->id_movimentacao_conta->cellAttributes() ?>>
<span id="el<?php echo $contas_pagar_pagamentos_delete->RowCnt ?>_contas_pagar_pagamentos_id_movimentacao_conta" class="contas_pagar_pagamentos_id_movimentacao_conta">
<span<?php echo $contas_pagar_pagamentos->id_movimentacao_conta->viewAttributes() ?>>
<?php echo $contas_pagar_pagamentos->id_movimentacao_conta->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$contas_pagar_pagamentos_delete->Recordset->moveNext();
}
$contas_pagar_pagamentos_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $contas_pagar_pagamentos_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$contas_pagar_pagamentos_delete->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$contas_pagar_pagamentos_delete->terminate();
?>