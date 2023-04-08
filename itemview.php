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
$item_view = new item_view();

// Run the page
$item_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$item_view->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if (!$item->isExport()) { ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "view";
var fitemview = currentForm = new ew.Form("fitemview", "view");

// Form_CustomValidate event
fitemview.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fitemview.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
fitemview.lists["x_ativo[]"] = <?php echo $item_view->ativo->Lookup->toClientList() ?>;
fitemview.lists["x_ativo[]"].options = <?php echo JsonEncode($item_view->ativo->options(FALSE, TRUE)) ?>;

// Form object for search
</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php } ?>
<?php if (!$item->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $item_view->ExportOptions->render("body") ?>
<?php $item_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $item_view->showPageHeader(); ?>
<?php
$item_view->showMessage();
?>
<form name="fitemview" id="fitemview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($item_view->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $item_view->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="item">
<input type="hidden" name="modal" value="<?php echo (int)$item_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($item->id->Visible) { // id ?>
	<tr id="r_id">
		<td class="<?php echo $item_view->TableLeftColumnClass ?>"><span id="elh_item_id"><?php echo $item->id->caption() ?></span></td>
		<td data-name="id"<?php echo $item->id->cellAttributes() ?>>
<span id="el_item_id">
<span<?php echo $item->id->viewAttributes() ?>>
<?php echo $item->id->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($item->descricao->Visible) { // descricao ?>
	<tr id="r_descricao">
		<td class="<?php echo $item_view->TableLeftColumnClass ?>"><span id="elh_item_descricao"><?php echo $item->descricao->caption() ?></span></td>
		<td data-name="descricao"<?php echo $item->descricao->cellAttributes() ?>>
<span id="el_item_descricao">
<span<?php echo $item->descricao->viewAttributes() ?>>
<?php echo $item->descricao->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($item->ativo->Visible) { // ativo ?>
	<tr id="r_ativo">
		<td class="<?php echo $item_view->TableLeftColumnClass ?>"><span id="elh_item_ativo"><?php echo $item->ativo->caption() ?></span></td>
		<td data-name="ativo"<?php echo $item->ativo->cellAttributes() ?>>
<span id="el_item_ativo">
<span<?php echo $item->ativo->viewAttributes() ?>>
<?php if (ConvertToBool($item->ativo->CurrentValue)) { ?>
<input type="checkbox" value="<?php echo $item->ativo->getViewValue() ?>" disabled checked>
<?php } else { ?>
<input type="checkbox" value="<?php echo $item->ativo->getViewValue() ?>" disabled>
<?php } ?>
</span>
</span>
</td>
	</tr>
<?php } ?>
</table>
</form>
<?php
$item_view->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<?php if (!$item->isExport()) { ?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$item_view->terminate();
?>