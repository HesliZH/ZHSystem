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
$contas_pagar_pagamentos_view = new contas_pagar_pagamentos_view();

// Run the page
$contas_pagar_pagamentos_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$contas_pagar_pagamentos_view->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if (!$contas_pagar_pagamentos->isExport()) { ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "view";
var fcontas_pagar_pagamentosview = currentForm = new ew.Form("fcontas_pagar_pagamentosview", "view");

// Form_CustomValidate event
fcontas_pagar_pagamentosview.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fcontas_pagar_pagamentosview.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php } ?>
<?php if (!$contas_pagar_pagamentos->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $contas_pagar_pagamentos_view->ExportOptions->render("body") ?>
<?php $contas_pagar_pagamentos_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $contas_pagar_pagamentos_view->showPageHeader(); ?>
<?php
$contas_pagar_pagamentos_view->showMessage();
?>
<form name="fcontas_pagar_pagamentosview" id="fcontas_pagar_pagamentosview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($contas_pagar_pagamentos_view->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $contas_pagar_pagamentos_view->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="contas_pagar_pagamentos">
<input type="hidden" name="modal" value="<?php echo (int)$contas_pagar_pagamentos_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($contas_pagar_pagamentos->id->Visible) { // id ?>
	<tr id="r_id">
		<td class="<?php echo $contas_pagar_pagamentos_view->TableLeftColumnClass ?>"><span id="elh_contas_pagar_pagamentos_id"><?php echo $contas_pagar_pagamentos->id->caption() ?></span></td>
		<td data-name="id"<?php echo $contas_pagar_pagamentos->id->cellAttributes() ?>>
<span id="el_contas_pagar_pagamentos_id">
<span<?php echo $contas_pagar_pagamentos->id->viewAttributes() ?>>
<?php echo $contas_pagar_pagamentos->id->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($contas_pagar_pagamentos->id_contas_pagar->Visible) { // id_contas_pagar ?>
	<tr id="r_id_contas_pagar">
		<td class="<?php echo $contas_pagar_pagamentos_view->TableLeftColumnClass ?>"><span id="elh_contas_pagar_pagamentos_id_contas_pagar"><?php echo $contas_pagar_pagamentos->id_contas_pagar->caption() ?></span></td>
		<td data-name="id_contas_pagar"<?php echo $contas_pagar_pagamentos->id_contas_pagar->cellAttributes() ?>>
<span id="el_contas_pagar_pagamentos_id_contas_pagar">
<span<?php echo $contas_pagar_pagamentos->id_contas_pagar->viewAttributes() ?>>
<?php echo $contas_pagar_pagamentos->id_contas_pagar->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($contas_pagar_pagamentos->valor_pago->Visible) { // valor_pago ?>
	<tr id="r_valor_pago">
		<td class="<?php echo $contas_pagar_pagamentos_view->TableLeftColumnClass ?>"><span id="elh_contas_pagar_pagamentos_valor_pago"><?php echo $contas_pagar_pagamentos->valor_pago->caption() ?></span></td>
		<td data-name="valor_pago"<?php echo $contas_pagar_pagamentos->valor_pago->cellAttributes() ?>>
<span id="el_contas_pagar_pagamentos_valor_pago">
<span<?php echo $contas_pagar_pagamentos->valor_pago->viewAttributes() ?>>
<?php echo $contas_pagar_pagamentos->valor_pago->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($contas_pagar_pagamentos->parcela->Visible) { // parcela ?>
	<tr id="r_parcela">
		<td class="<?php echo $contas_pagar_pagamentos_view->TableLeftColumnClass ?>"><span id="elh_contas_pagar_pagamentos_parcela"><?php echo $contas_pagar_pagamentos->parcela->caption() ?></span></td>
		<td data-name="parcela"<?php echo $contas_pagar_pagamentos->parcela->cellAttributes() ?>>
<span id="el_contas_pagar_pagamentos_parcela">
<span<?php echo $contas_pagar_pagamentos->parcela->viewAttributes() ?>>
<?php echo $contas_pagar_pagamentos->parcela->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($contas_pagar_pagamentos->forma_pagamento->Visible) { // forma_pagamento ?>
	<tr id="r_forma_pagamento">
		<td class="<?php echo $contas_pagar_pagamentos_view->TableLeftColumnClass ?>"><span id="elh_contas_pagar_pagamentos_forma_pagamento"><?php echo $contas_pagar_pagamentos->forma_pagamento->caption() ?></span></td>
		<td data-name="forma_pagamento"<?php echo $contas_pagar_pagamentos->forma_pagamento->cellAttributes() ?>>
<span id="el_contas_pagar_pagamentos_forma_pagamento">
<span<?php echo $contas_pagar_pagamentos->forma_pagamento->viewAttributes() ?>>
<?php echo $contas_pagar_pagamentos->forma_pagamento->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($contas_pagar_pagamentos->id_movimentacao_conta->Visible) { // id_movimentacao_conta ?>
	<tr id="r_id_movimentacao_conta">
		<td class="<?php echo $contas_pagar_pagamentos_view->TableLeftColumnClass ?>"><span id="elh_contas_pagar_pagamentos_id_movimentacao_conta"><?php echo $contas_pagar_pagamentos->id_movimentacao_conta->caption() ?></span></td>
		<td data-name="id_movimentacao_conta"<?php echo $contas_pagar_pagamentos->id_movimentacao_conta->cellAttributes() ?>>
<span id="el_contas_pagar_pagamentos_id_movimentacao_conta">
<span<?php echo $contas_pagar_pagamentos->id_movimentacao_conta->viewAttributes() ?>>
<?php echo $contas_pagar_pagamentos->id_movimentacao_conta->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
</form>
<?php
$contas_pagar_pagamentos_view->showPageFooter();
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
$contas_pagar_pagamentos_view->terminate();
?>