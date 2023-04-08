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
$compras_itens_view = new compras_itens_view();

// Run the page
$compras_itens_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$compras_itens_view->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if (!$compras_itens->isExport()) { ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "view";
var fcompras_itensview = currentForm = new ew.Form("fcompras_itensview", "view");

// Form_CustomValidate event
fcompras_itensview.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fcompras_itensview.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php } ?>
<?php if (!$compras_itens->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $compras_itens_view->ExportOptions->render("body") ?>
<?php $compras_itens_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $compras_itens_view->showPageHeader(); ?>
<?php
$compras_itens_view->showMessage();
?>
<form name="fcompras_itensview" id="fcompras_itensview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($compras_itens_view->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $compras_itens_view->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="compras_itens">
<input type="hidden" name="modal" value="<?php echo (int)$compras_itens_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($compras_itens->id->Visible) { // id ?>
	<tr id="r_id">
		<td class="<?php echo $compras_itens_view->TableLeftColumnClass ?>"><span id="elh_compras_itens_id"><?php echo $compras_itens->id->caption() ?></span></td>
		<td data-name="id"<?php echo $compras_itens->id->cellAttributes() ?>>
<span id="el_compras_itens_id">
<span<?php echo $compras_itens->id->viewAttributes() ?>>
<?php echo $compras_itens->id->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($compras_itens->id_compra->Visible) { // id_compra ?>
	<tr id="r_id_compra">
		<td class="<?php echo $compras_itens_view->TableLeftColumnClass ?>"><span id="elh_compras_itens_id_compra"><?php echo $compras_itens->id_compra->caption() ?></span></td>
		<td data-name="id_compra"<?php echo $compras_itens->id_compra->cellAttributes() ?>>
<span id="el_compras_itens_id_compra">
<span<?php echo $compras_itens->id_compra->viewAttributes() ?>>
<?php echo $compras_itens->id_compra->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($compras_itens->item->Visible) { // item ?>
	<tr id="r_item">
		<td class="<?php echo $compras_itens_view->TableLeftColumnClass ?>"><span id="elh_compras_itens_item"><?php echo $compras_itens->item->caption() ?></span></td>
		<td data-name="item"<?php echo $compras_itens->item->cellAttributes() ?>>
<span id="el_compras_itens_item">
<span<?php echo $compras_itens->item->viewAttributes() ?>>
<?php echo $compras_itens->item->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($compras_itens->quantidade->Visible) { // quantidade ?>
	<tr id="r_quantidade">
		<td class="<?php echo $compras_itens_view->TableLeftColumnClass ?>"><span id="elh_compras_itens_quantidade"><?php echo $compras_itens->quantidade->caption() ?></span></td>
		<td data-name="quantidade"<?php echo $compras_itens->quantidade->cellAttributes() ?>>
<span id="el_compras_itens_quantidade">
<span<?php echo $compras_itens->quantidade->viewAttributes() ?>>
<?php echo $compras_itens->quantidade->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($compras_itens->unitario->Visible) { // unitario ?>
	<tr id="r_unitario">
		<td class="<?php echo $compras_itens_view->TableLeftColumnClass ?>"><span id="elh_compras_itens_unitario"><?php echo $compras_itens->unitario->caption() ?></span></td>
		<td data-name="unitario"<?php echo $compras_itens->unitario->cellAttributes() ?>>
<span id="el_compras_itens_unitario">
<span<?php echo $compras_itens->unitario->viewAttributes() ?>>
<?php echo $compras_itens->unitario->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($compras_itens->total->Visible) { // total ?>
	<tr id="r_total">
		<td class="<?php echo $compras_itens_view->TableLeftColumnClass ?>"><span id="elh_compras_itens_total"><?php echo $compras_itens->total->caption() ?></span></td>
		<td data-name="total"<?php echo $compras_itens->total->cellAttributes() ?>>
<span id="el_compras_itens_total">
<span<?php echo $compras_itens->total->viewAttributes() ?>>
<?php echo $compras_itens->total->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
</form>
<?php
$compras_itens_view->showPageFooter();
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
$compras_itens_view->terminate();
?>