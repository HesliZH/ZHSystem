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
$localizacao_view = new localizacao_view();

// Run the page
$localizacao_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$localizacao_view->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if (!$localizacao->isExport()) { ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "view";
var flocalizacaoview = currentForm = new ew.Form("flocalizacaoview", "view");

// Form_CustomValidate event
flocalizacaoview.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
flocalizacaoview.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php } ?>
<?php if (!$localizacao->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $localizacao_view->ExportOptions->render("body") ?>
<?php $localizacao_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $localizacao_view->showPageHeader(); ?>
<?php
$localizacao_view->showMessage();
?>
<form name="flocalizacaoview" id="flocalizacaoview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($localizacao_view->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $localizacao_view->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="localizacao">
<input type="hidden" name="modal" value="<?php echo (int)$localizacao_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($localizacao->id->Visible) { // id ?>
	<tr id="r_id">
		<td class="<?php echo $localizacao_view->TableLeftColumnClass ?>"><span id="elh_localizacao_id"><?php echo $localizacao->id->caption() ?></span></td>
		<td data-name="id"<?php echo $localizacao->id->cellAttributes() ?>>
<span id="el_localizacao_id">
<span<?php echo $localizacao->id->viewAttributes() ?>>
<?php echo $localizacao->id->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($localizacao->descricao->Visible) { // descricao ?>
	<tr id="r_descricao">
		<td class="<?php echo $localizacao_view->TableLeftColumnClass ?>"><span id="elh_localizacao_descricao"><?php echo $localizacao->descricao->caption() ?></span></td>
		<td data-name="descricao"<?php echo $localizacao->descricao->cellAttributes() ?>>
<span id="el_localizacao_descricao">
<span<?php echo $localizacao->descricao->viewAttributes() ?>>
<?php echo $localizacao->descricao->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($localizacao->tipo->Visible) { // tipo ?>
	<tr id="r_tipo">
		<td class="<?php echo $localizacao_view->TableLeftColumnClass ?>"><span id="elh_localizacao_tipo"><?php echo $localizacao->tipo->caption() ?></span></td>
		<td data-name="tipo"<?php echo $localizacao->tipo->cellAttributes() ?>>
<span id="el_localizacao_tipo">
<span<?php echo $localizacao->tipo->viewAttributes() ?>>
<?php echo $localizacao->tipo->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($localizacao->id_pai->Visible) { // id_pai ?>
	<tr id="r_id_pai">
		<td class="<?php echo $localizacao_view->TableLeftColumnClass ?>"><span id="elh_localizacao_id_pai"><?php echo $localizacao->id_pai->caption() ?></span></td>
		<td data-name="id_pai"<?php echo $localizacao->id_pai->cellAttributes() ?>>
<span id="el_localizacao_id_pai">
<span<?php echo $localizacao->id_pai->viewAttributes() ?>>
<?php echo $localizacao->id_pai->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
</form>
<?php
$localizacao_view->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<?php if (!$localizacao->isExport()) { ?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$localizacao_view->terminate();
?>