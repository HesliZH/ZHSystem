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
$fornecedores_view = new fornecedores_view();

// Run the page
$fornecedores_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$fornecedores_view->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if (!$fornecedores->isExport()) { ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "view";
var ffornecedoresview = currentForm = new ew.Form("ffornecedoresview", "view");

// Form_CustomValidate event
ffornecedoresview.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
ffornecedoresview.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
ffornecedoresview.lists["x_ativo[]"] = <?php echo $fornecedores_view->ativo->Lookup->toClientList() ?>;
ffornecedoresview.lists["x_ativo[]"].options = <?php echo JsonEncode($fornecedores_view->ativo->options(FALSE, TRUE)) ?>;

// Form object for search
</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php } ?>
<?php if (!$fornecedores->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $fornecedores_view->ExportOptions->render("body") ?>
<?php $fornecedores_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $fornecedores_view->showPageHeader(); ?>
<?php
$fornecedores_view->showMessage();
?>
<form name="ffornecedoresview" id="ffornecedoresview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($fornecedores_view->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $fornecedores_view->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="fornecedores">
<input type="hidden" name="modal" value="<?php echo (int)$fornecedores_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($fornecedores->id->Visible) { // id ?>
	<tr id="r_id">
		<td class="<?php echo $fornecedores_view->TableLeftColumnClass ?>"><span id="elh_fornecedores_id"><?php echo $fornecedores->id->caption() ?></span></td>
		<td data-name="id"<?php echo $fornecedores->id->cellAttributes() ?>>
<span id="el_fornecedores_id">
<span<?php echo $fornecedores->id->viewAttributes() ?>>
<?php echo $fornecedores->id->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($fornecedores->razao_social->Visible) { // razao_social ?>
	<tr id="r_razao_social">
		<td class="<?php echo $fornecedores_view->TableLeftColumnClass ?>"><span id="elh_fornecedores_razao_social"><?php echo $fornecedores->razao_social->caption() ?></span></td>
		<td data-name="razao_social"<?php echo $fornecedores->razao_social->cellAttributes() ?>>
<span id="el_fornecedores_razao_social">
<span<?php echo $fornecedores->razao_social->viewAttributes() ?>>
<?php echo $fornecedores->razao_social->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($fornecedores->ativo->Visible) { // ativo ?>
	<tr id="r_ativo">
		<td class="<?php echo $fornecedores_view->TableLeftColumnClass ?>"><span id="elh_fornecedores_ativo"><?php echo $fornecedores->ativo->caption() ?></span></td>
		<td data-name="ativo"<?php echo $fornecedores->ativo->cellAttributes() ?>>
<span id="el_fornecedores_ativo">
<span<?php echo $fornecedores->ativo->viewAttributes() ?>>
<?php if (ConvertToBool($fornecedores->ativo->CurrentValue)) { ?>
<input type="checkbox" value="<?php echo $fornecedores->ativo->getViewValue() ?>" disabled checked>
<?php } else { ?>
<input type="checkbox" value="<?php echo $fornecedores->ativo->getViewValue() ?>" disabled>
<?php } ?>
</span>
</span>
</td>
	</tr>
<?php } ?>
</table>
</form>
<?php
$fornecedores_view->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<?php if (!$fornecedores->isExport()) { ?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$fornecedores_view->terminate();
?>