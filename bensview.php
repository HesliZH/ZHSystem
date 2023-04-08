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
$bens_view = new bens_view();

// Run the page
$bens_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$bens_view->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if (!$bens->isExport()) { ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "view";
var fbensview = currentForm = new ew.Form("fbensview", "view");

// Form_CustomValidate event
fbensview.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fbensview.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
fbensview.lists["x_tipo"] = <?php echo $bens_view->tipo->Lookup->toClientList() ?>;
fbensview.lists["x_tipo"].options = <?php echo JsonEncode($bens_view->tipo->options(FALSE, TRUE)) ?>;

// Form object for search
</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php } ?>
<?php if (!$bens->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $bens_view->ExportOptions->render("body") ?>
<?php $bens_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $bens_view->showPageHeader(); ?>
<?php
$bens_view->showMessage();
?>
<form name="fbensview" id="fbensview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($bens_view->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $bens_view->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="bens">
<input type="hidden" name="modal" value="<?php echo (int)$bens_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($bens->descricao->Visible) { // descricao ?>
	<tr id="r_descricao">
		<td class="<?php echo $bens_view->TableLeftColumnClass ?>"><span id="elh_bens_descricao"><?php echo $bens->descricao->caption() ?></span></td>
		<td data-name="descricao"<?php echo $bens->descricao->cellAttributes() ?>>
<span id="el_bens_descricao">
<span<?php echo $bens->descricao->viewAttributes() ?>>
<?php echo $bens->descricao->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($bens->tipo->Visible) { // tipo ?>
	<tr id="r_tipo">
		<td class="<?php echo $bens_view->TableLeftColumnClass ?>"><span id="elh_bens_tipo"><?php echo $bens->tipo->caption() ?></span></td>
		<td data-name="tipo"<?php echo $bens->tipo->cellAttributes() ?>>
<span id="el_bens_tipo">
<span<?php echo $bens->tipo->viewAttributes() ?>>
<?php echo $bens->tipo->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($bens->placa->Visible) { // placa ?>
	<tr id="r_placa">
		<td class="<?php echo $bens_view->TableLeftColumnClass ?>"><span id="elh_bens_placa"><?php echo $bens->placa->caption() ?></span></td>
		<td data-name="placa"<?php echo $bens->placa->cellAttributes() ?>>
<span id="el_bens_placa">
<span<?php echo $bens->placa->viewAttributes() ?>>
<?php echo $bens->placa->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($bens->localizacao->Visible) { // localizacao ?>
	<tr id="r_localizacao">
		<td class="<?php echo $bens_view->TableLeftColumnClass ?>"><span id="elh_bens_localizacao"><?php echo $bens->localizacao->caption() ?></span></td>
		<td data-name="localizacao"<?php echo $bens->localizacao->cellAttributes() ?>>
<span id="el_bens_localizacao">
<span<?php echo $bens->localizacao->viewAttributes() ?>>
<?php echo $bens->localizacao->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
</form>
<?php
$bens_view->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<?php if (!$bens->isExport()) { ?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$bens_view->terminate();
?>