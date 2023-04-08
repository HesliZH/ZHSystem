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
$compras_view = new compras_view();

// Run the page
$compras_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$compras_view->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if (!$compras->isExport()) { ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "view";
var fcomprasview = currentForm = new ew.Form("fcomprasview", "view");

// Form_CustomValidate event
fcomprasview.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fcomprasview.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php } ?>
<?php if (!$compras->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $compras_view->ExportOptions->render("body") ?>
<?php $compras_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $compras_view->showPageHeader(); ?>
<?php
$compras_view->showMessage();
?>
<form name="fcomprasview" id="fcomprasview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($compras_view->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $compras_view->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="compras">
<input type="hidden" name="modal" value="<?php echo (int)$compras_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($compras->id->Visible) { // id ?>
	<tr id="r_id">
		<td class="<?php echo $compras_view->TableLeftColumnClass ?>"><span id="elh_compras_id"><?php echo $compras->id->caption() ?></span></td>
		<td data-name="id"<?php echo $compras->id->cellAttributes() ?>>
<span id="el_compras_id">
<span<?php echo $compras->id->viewAttributes() ?>>
<?php echo $compras->id->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($compras->data->Visible) { // data ?>
	<tr id="r_data">
		<td class="<?php echo $compras_view->TableLeftColumnClass ?>"><span id="elh_compras_data"><?php echo $compras->data->caption() ?></span></td>
		<td data-name="data"<?php echo $compras->data->cellAttributes() ?>>
<span id="el_compras_data">
<span<?php echo $compras->data->viewAttributes() ?>>
<?php echo $compras->data->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($compras->valor->Visible) { // valor ?>
	<tr id="r_valor">
		<td class="<?php echo $compras_view->TableLeftColumnClass ?>"><span id="elh_compras_valor"><?php echo $compras->valor->caption() ?></span></td>
		<td data-name="valor"<?php echo $compras->valor->cellAttributes() ?>>
<span id="el_compras_valor">
<span<?php echo $compras->valor->viewAttributes() ?>>
<?php echo $compras->valor->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($compras->fornecedor->Visible) { // fornecedor ?>
	<tr id="r_fornecedor">
		<td class="<?php echo $compras_view->TableLeftColumnClass ?>"><span id="elh_compras_fornecedor"><?php echo $compras->fornecedor->caption() ?></span></td>
		<td data-name="fornecedor"<?php echo $compras->fornecedor->cellAttributes() ?>>
<span id="el_compras_fornecedor">
<span<?php echo $compras->fornecedor->viewAttributes() ?>>
<?php echo $compras->fornecedor->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($compras->parcelas->Visible) { // parcelas ?>
	<tr id="r_parcelas">
		<td class="<?php echo $compras_view->TableLeftColumnClass ?>"><span id="elh_compras_parcelas"><?php echo $compras->parcelas->caption() ?></span></td>
		<td data-name="parcelas"<?php echo $compras->parcelas->cellAttributes() ?>>
<span id="el_compras_parcelas">
<span<?php echo $compras->parcelas->viewAttributes() ?>>
<?php echo $compras->parcelas->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
</form>
<?php
$compras_view->showPageFooter();
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
$compras_view->terminate();
?>