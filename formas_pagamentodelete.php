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
$formas_pagamento_delete = new formas_pagamento_delete();

// Run the page
$formas_pagamento_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$formas_pagamento_delete->Page_Render();
?>
<?php include_once "header.php" ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "delete";
var fformas_pagamentodelete = currentForm = new ew.Form("fformas_pagamentodelete", "delete");

// Form_CustomValidate event
fformas_pagamentodelete.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fformas_pagamentodelete.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php $formas_pagamento_delete->showPageHeader(); ?>
<?php
$formas_pagamento_delete->showMessage();
?>
<form name="fformas_pagamentodelete" id="fformas_pagamentodelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($formas_pagamento_delete->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $formas_pagamento_delete->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="formas_pagamento">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($formas_pagamento_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode($COMPOSITE_KEY_SEPARATOR, $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($formas_pagamento->id->Visible) { // id ?>
		<th class="<?php echo $formas_pagamento->id->headerCellClass() ?>"><span id="elh_formas_pagamento_id" class="formas_pagamento_id"><?php echo $formas_pagamento->id->caption() ?></span></th>
<?php } ?>
<?php if ($formas_pagamento->descricao->Visible) { // descricao ?>
		<th class="<?php echo $formas_pagamento->descricao->headerCellClass() ?>"><span id="elh_formas_pagamento_descricao" class="formas_pagamento_descricao"><?php echo $formas_pagamento->descricao->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$formas_pagamento_delete->RecCnt = 0;
$i = 0;
while (!$formas_pagamento_delete->Recordset->EOF) {
	$formas_pagamento_delete->RecCnt++;
	$formas_pagamento_delete->RowCnt++;

	// Set row properties
	$formas_pagamento->resetAttributes();
	$formas_pagamento->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$formas_pagamento_delete->loadRowValues($formas_pagamento_delete->Recordset);

	// Render row
	$formas_pagamento_delete->renderRow();
?>
	<tr<?php echo $formas_pagamento->rowAttributes() ?>>
<?php if ($formas_pagamento->id->Visible) { // id ?>
		<td<?php echo $formas_pagamento->id->cellAttributes() ?>>
<span id="el<?php echo $formas_pagamento_delete->RowCnt ?>_formas_pagamento_id" class="formas_pagamento_id">
<span<?php echo $formas_pagamento->id->viewAttributes() ?>>
<?php echo $formas_pagamento->id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($formas_pagamento->descricao->Visible) { // descricao ?>
		<td<?php echo $formas_pagamento->descricao->cellAttributes() ?>>
<span id="el<?php echo $formas_pagamento_delete->RowCnt ?>_formas_pagamento_descricao" class="formas_pagamento_descricao">
<span<?php echo $formas_pagamento->descricao->viewAttributes() ?>>
<?php echo $formas_pagamento->descricao->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$formas_pagamento_delete->Recordset->moveNext();
}
$formas_pagamento_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $formas_pagamento_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$formas_pagamento_delete->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$formas_pagamento_delete->terminate();
?>