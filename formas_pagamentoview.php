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
$formas_pagamento_view = new formas_pagamento_view();

// Run the page
$formas_pagamento_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$formas_pagamento_view->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if (!$formas_pagamento->isExport()) { ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "view";
var fformas_pagamentoview = currentForm = new ew.Form("fformas_pagamentoview", "view");

// Form_CustomValidate event
fformas_pagamentoview.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fformas_pagamentoview.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php } ?>
<?php if (!$formas_pagamento->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $formas_pagamento_view->ExportOptions->render("body") ?>
<?php $formas_pagamento_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $formas_pagamento_view->showPageHeader(); ?>
<?php
$formas_pagamento_view->showMessage();
?>
<form name="fformas_pagamentoview" id="fformas_pagamentoview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($formas_pagamento_view->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $formas_pagamento_view->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="formas_pagamento">
<input type="hidden" name="modal" value="<?php echo (int)$formas_pagamento_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($formas_pagamento->id->Visible) { // id ?>
	<tr id="r_id">
		<td class="<?php echo $formas_pagamento_view->TableLeftColumnClass ?>"><span id="elh_formas_pagamento_id"><?php echo $formas_pagamento->id->caption() ?></span></td>
		<td data-name="id"<?php echo $formas_pagamento->id->cellAttributes() ?>>
<span id="el_formas_pagamento_id">
<span<?php echo $formas_pagamento->id->viewAttributes() ?>>
<?php echo $formas_pagamento->id->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($formas_pagamento->descricao->Visible) { // descricao ?>
	<tr id="r_descricao">
		<td class="<?php echo $formas_pagamento_view->TableLeftColumnClass ?>"><span id="elh_formas_pagamento_descricao"><?php echo $formas_pagamento->descricao->caption() ?></span></td>
		<td data-name="descricao"<?php echo $formas_pagamento->descricao->cellAttributes() ?>>
<span id="el_formas_pagamento_descricao">
<span<?php echo $formas_pagamento->descricao->viewAttributes() ?>>
<?php echo $formas_pagamento->descricao->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
</form>
<?php
$formas_pagamento_view->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<?php if (!$formas_pagamento->isExport()) { ?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$formas_pagamento_view->terminate();
?>