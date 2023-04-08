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
$compras_delete = new compras_delete();

// Run the page
$compras_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$compras_delete->Page_Render();
?>
<?php include_once "header.php" ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "delete";
var fcomprasdelete = currentForm = new ew.Form("fcomprasdelete", "delete");

// Form_CustomValidate event
fcomprasdelete.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fcomprasdelete.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php $compras_delete->showPageHeader(); ?>
<?php
$compras_delete->showMessage();
?>
<form name="fcomprasdelete" id="fcomprasdelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($compras_delete->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $compras_delete->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="compras">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($compras_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode($COMPOSITE_KEY_SEPARATOR, $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($compras->id->Visible) { // id ?>
		<th class="<?php echo $compras->id->headerCellClass() ?>"><span id="elh_compras_id" class="compras_id"><?php echo $compras->id->caption() ?></span></th>
<?php } ?>
<?php if ($compras->data->Visible) { // data ?>
		<th class="<?php echo $compras->data->headerCellClass() ?>"><span id="elh_compras_data" class="compras_data"><?php echo $compras->data->caption() ?></span></th>
<?php } ?>
<?php if ($compras->valor->Visible) { // valor ?>
		<th class="<?php echo $compras->valor->headerCellClass() ?>"><span id="elh_compras_valor" class="compras_valor"><?php echo $compras->valor->caption() ?></span></th>
<?php } ?>
<?php if ($compras->fornecedor->Visible) { // fornecedor ?>
		<th class="<?php echo $compras->fornecedor->headerCellClass() ?>"><span id="elh_compras_fornecedor" class="compras_fornecedor"><?php echo $compras->fornecedor->caption() ?></span></th>
<?php } ?>
<?php if ($compras->parcelas->Visible) { // parcelas ?>
		<th class="<?php echo $compras->parcelas->headerCellClass() ?>"><span id="elh_compras_parcelas" class="compras_parcelas"><?php echo $compras->parcelas->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$compras_delete->RecCnt = 0;
$i = 0;
while (!$compras_delete->Recordset->EOF) {
	$compras_delete->RecCnt++;
	$compras_delete->RowCnt++;

	// Set row properties
	$compras->resetAttributes();
	$compras->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$compras_delete->loadRowValues($compras_delete->Recordset);

	// Render row
	$compras_delete->renderRow();
?>
	<tr<?php echo $compras->rowAttributes() ?>>
<?php if ($compras->id->Visible) { // id ?>
		<td<?php echo $compras->id->cellAttributes() ?>>
<span id="el<?php echo $compras_delete->RowCnt ?>_compras_id" class="compras_id">
<span<?php echo $compras->id->viewAttributes() ?>>
<?php echo $compras->id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($compras->data->Visible) { // data ?>
		<td<?php echo $compras->data->cellAttributes() ?>>
<span id="el<?php echo $compras_delete->RowCnt ?>_compras_data" class="compras_data">
<span<?php echo $compras->data->viewAttributes() ?>>
<?php echo $compras->data->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($compras->valor->Visible) { // valor ?>
		<td<?php echo $compras->valor->cellAttributes() ?>>
<span id="el<?php echo $compras_delete->RowCnt ?>_compras_valor" class="compras_valor">
<span<?php echo $compras->valor->viewAttributes() ?>>
<?php echo $compras->valor->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($compras->fornecedor->Visible) { // fornecedor ?>
		<td<?php echo $compras->fornecedor->cellAttributes() ?>>
<span id="el<?php echo $compras_delete->RowCnt ?>_compras_fornecedor" class="compras_fornecedor">
<span<?php echo $compras->fornecedor->viewAttributes() ?>>
<?php echo $compras->fornecedor->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($compras->parcelas->Visible) { // parcelas ?>
		<td<?php echo $compras->parcelas->cellAttributes() ?>>
<span id="el<?php echo $compras_delete->RowCnt ?>_compras_parcelas" class="compras_parcelas">
<span<?php echo $compras->parcelas->viewAttributes() ?>>
<?php echo $compras->parcelas->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$compras_delete->Recordset->moveNext();
}
$compras_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $compras_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$compras_delete->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$compras_delete->terminate();
?>