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
$contas_correntes_view = new contas_correntes_view();

// Run the page
$contas_correntes_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$contas_correntes_view->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if (!$contas_correntes->isExport()) { ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "view";
var fcontas_correntesview = currentForm = new ew.Form("fcontas_correntesview", "view");

// Form_CustomValidate event
fcontas_correntesview.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fcontas_correntesview.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
fcontas_correntesview.lists["x_ativo[]"] = <?php echo $contas_correntes_view->ativo->Lookup->toClientList() ?>;
fcontas_correntesview.lists["x_ativo[]"].options = <?php echo JsonEncode($contas_correntes_view->ativo->options(FALSE, TRUE)) ?>;

// Form object for search
</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php } ?>
<?php if (!$contas_correntes->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $contas_correntes_view->ExportOptions->render("body") ?>
<?php $contas_correntes_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $contas_correntes_view->showPageHeader(); ?>
<?php
$contas_correntes_view->showMessage();
?>
<form name="fcontas_correntesview" id="fcontas_correntesview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($contas_correntes_view->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $contas_correntes_view->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="contas_correntes">
<input type="hidden" name="modal" value="<?php echo (int)$contas_correntes_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($contas_correntes->id->Visible) { // id ?>
	<tr id="r_id">
		<td class="<?php echo $contas_correntes_view->TableLeftColumnClass ?>"><span id="elh_contas_correntes_id"><?php echo $contas_correntes->id->caption() ?></span></td>
		<td data-name="id"<?php echo $contas_correntes->id->cellAttributes() ?>>
<span id="el_contas_correntes_id">
<span<?php echo $contas_correntes->id->viewAttributes() ?>>
<?php echo $contas_correntes->id->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($contas_correntes->descricao->Visible) { // descricao ?>
	<tr id="r_descricao">
		<td class="<?php echo $contas_correntes_view->TableLeftColumnClass ?>"><span id="elh_contas_correntes_descricao"><?php echo $contas_correntes->descricao->caption() ?></span></td>
		<td data-name="descricao"<?php echo $contas_correntes->descricao->cellAttributes() ?>>
<span id="el_contas_correntes_descricao">
<span<?php echo $contas_correntes->descricao->viewAttributes() ?>>
<?php echo $contas_correntes->descricao->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($contas_correntes->ativo->Visible) { // ativo ?>
	<tr id="r_ativo">
		<td class="<?php echo $contas_correntes_view->TableLeftColumnClass ?>"><span id="elh_contas_correntes_ativo"><?php echo $contas_correntes->ativo->caption() ?></span></td>
		<td data-name="ativo"<?php echo $contas_correntes->ativo->cellAttributes() ?>>
<span id="el_contas_correntes_ativo">
<span<?php echo $contas_correntes->ativo->viewAttributes() ?>>
<?php if (ConvertToBool($contas_correntes->ativo->CurrentValue)) { ?>
<input type="checkbox" value="<?php echo $contas_correntes->ativo->getViewValue() ?>" disabled checked>
<?php } else { ?>
<input type="checkbox" value="<?php echo $contas_correntes->ativo->getViewValue() ?>" disabled>
<?php } ?>
</span>
</span>
</td>
	</tr>
<?php } ?>
</table>
</form>
<?php
$contas_correntes_view->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<?php if (!$contas_correntes->isExport()) { ?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$contas_correntes_view->terminate();
?>