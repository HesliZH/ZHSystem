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
$contas_correntes_movimento_view = new contas_correntes_movimento_view();

// Run the page
$contas_correntes_movimento_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$contas_correntes_movimento_view->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if (!$contas_correntes_movimento->isExport()) { ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "view";
var fcontas_correntes_movimentoview = currentForm = new ew.Form("fcontas_correntes_movimentoview", "view");

// Form_CustomValidate event
fcontas_correntes_movimentoview.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fcontas_correntes_movimentoview.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php } ?>
<?php if (!$contas_correntes_movimento->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $contas_correntes_movimento_view->ExportOptions->render("body") ?>
<?php $contas_correntes_movimento_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $contas_correntes_movimento_view->showPageHeader(); ?>
<?php
$contas_correntes_movimento_view->showMessage();
?>
<form name="fcontas_correntes_movimentoview" id="fcontas_correntes_movimentoview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($contas_correntes_movimento_view->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $contas_correntes_movimento_view->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="contas_correntes_movimento">
<input type="hidden" name="modal" value="<?php echo (int)$contas_correntes_movimento_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($contas_correntes_movimento->id->Visible) { // id ?>
	<tr id="r_id">
		<td class="<?php echo $contas_correntes_movimento_view->TableLeftColumnClass ?>"><span id="elh_contas_correntes_movimento_id"><?php echo $contas_correntes_movimento->id->caption() ?></span></td>
		<td data-name="id"<?php echo $contas_correntes_movimento->id->cellAttributes() ?>>
<span id="el_contas_correntes_movimento_id">
<span<?php echo $contas_correntes_movimento->id->viewAttributes() ?>>
<?php echo $contas_correntes_movimento->id->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($contas_correntes_movimento->valor->Visible) { // valor ?>
	<tr id="r_valor">
		<td class="<?php echo $contas_correntes_movimento_view->TableLeftColumnClass ?>"><span id="elh_contas_correntes_movimento_valor"><?php echo $contas_correntes_movimento->valor->caption() ?></span></td>
		<td data-name="valor"<?php echo $contas_correntes_movimento->valor->cellAttributes() ?>>
<span id="el_contas_correntes_movimento_valor">
<span<?php echo $contas_correntes_movimento->valor->viewAttributes() ?>>
<?php echo $contas_correntes_movimento->valor->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($contas_correntes_movimento->tipo_movimentacao->Visible) { // tipo_movimentacao ?>
	<tr id="r_tipo_movimentacao">
		<td class="<?php echo $contas_correntes_movimento_view->TableLeftColumnClass ?>"><span id="elh_contas_correntes_movimento_tipo_movimentacao"><?php echo $contas_correntes_movimento->tipo_movimentacao->caption() ?></span></td>
		<td data-name="tipo_movimentacao"<?php echo $contas_correntes_movimento->tipo_movimentacao->cellAttributes() ?>>
<span id="el_contas_correntes_movimento_tipo_movimentacao">
<span<?php echo $contas_correntes_movimento->tipo_movimentacao->viewAttributes() ?>>
<?php echo $contas_correntes_movimento->tipo_movimentacao->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($contas_correntes_movimento->direcao->Visible) { // direcao ?>
	<tr id="r_direcao">
		<td class="<?php echo $contas_correntes_movimento_view->TableLeftColumnClass ?>"><span id="elh_contas_correntes_movimento_direcao"><?php echo $contas_correntes_movimento->direcao->caption() ?></span></td>
		<td data-name="direcao"<?php echo $contas_correntes_movimento->direcao->cellAttributes() ?>>
<span id="el_contas_correntes_movimento_direcao">
<span<?php echo $contas_correntes_movimento->direcao->viewAttributes() ?>>
<?php echo $contas_correntes_movimento->direcao->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
</form>
<?php
$contas_correntes_movimento_view->showPageFooter();
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
$contas_correntes_movimento_view->terminate();
?>