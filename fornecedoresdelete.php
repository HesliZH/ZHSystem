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
$fornecedores_delete = new fornecedores_delete();

// Run the page
$fornecedores_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$fornecedores_delete->Page_Render();
?>
<?php include_once "header.php" ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "delete";
var ffornecedoresdelete = currentForm = new ew.Form("ffornecedoresdelete", "delete");

// Form_CustomValidate event
ffornecedoresdelete.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
ffornecedoresdelete.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
ffornecedoresdelete.lists["x_ativo[]"] = <?php echo $fornecedores_delete->ativo->Lookup->toClientList() ?>;
ffornecedoresdelete.lists["x_ativo[]"].options = <?php echo JsonEncode($fornecedores_delete->ativo->options(FALSE, TRUE)) ?>;

// Form object for search
</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php $fornecedores_delete->showPageHeader(); ?>
<?php
$fornecedores_delete->showMessage();
?>
<form name="ffornecedoresdelete" id="ffornecedoresdelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($fornecedores_delete->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $fornecedores_delete->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="fornecedores">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($fornecedores_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode($COMPOSITE_KEY_SEPARATOR, $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($fornecedores->id->Visible) { // id ?>
		<th class="<?php echo $fornecedores->id->headerCellClass() ?>"><span id="elh_fornecedores_id" class="fornecedores_id"><?php echo $fornecedores->id->caption() ?></span></th>
<?php } ?>
<?php if ($fornecedores->razao_social->Visible) { // razao_social ?>
		<th class="<?php echo $fornecedores->razao_social->headerCellClass() ?>"><span id="elh_fornecedores_razao_social" class="fornecedores_razao_social"><?php echo $fornecedores->razao_social->caption() ?></span></th>
<?php } ?>
<?php if ($fornecedores->ativo->Visible) { // ativo ?>
		<th class="<?php echo $fornecedores->ativo->headerCellClass() ?>"><span id="elh_fornecedores_ativo" class="fornecedores_ativo"><?php echo $fornecedores->ativo->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$fornecedores_delete->RecCnt = 0;
$i = 0;
while (!$fornecedores_delete->Recordset->EOF) {
	$fornecedores_delete->RecCnt++;
	$fornecedores_delete->RowCnt++;

	// Set row properties
	$fornecedores->resetAttributes();
	$fornecedores->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$fornecedores_delete->loadRowValues($fornecedores_delete->Recordset);

	// Render row
	$fornecedores_delete->renderRow();
?>
	<tr<?php echo $fornecedores->rowAttributes() ?>>
<?php if ($fornecedores->id->Visible) { // id ?>
		<td<?php echo $fornecedores->id->cellAttributes() ?>>
<span id="el<?php echo $fornecedores_delete->RowCnt ?>_fornecedores_id" class="fornecedores_id">
<span<?php echo $fornecedores->id->viewAttributes() ?>>
<?php echo $fornecedores->id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($fornecedores->razao_social->Visible) { // razao_social ?>
		<td<?php echo $fornecedores->razao_social->cellAttributes() ?>>
<span id="el<?php echo $fornecedores_delete->RowCnt ?>_fornecedores_razao_social" class="fornecedores_razao_social">
<span<?php echo $fornecedores->razao_social->viewAttributes() ?>>
<?php echo $fornecedores->razao_social->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($fornecedores->ativo->Visible) { // ativo ?>
		<td<?php echo $fornecedores->ativo->cellAttributes() ?>>
<span id="el<?php echo $fornecedores_delete->RowCnt ?>_fornecedores_ativo" class="fornecedores_ativo">
<span<?php echo $fornecedores->ativo->viewAttributes() ?>>
<?php if (ConvertToBool($fornecedores->ativo->CurrentValue)) { ?>
<input type="checkbox" value="<?php echo $fornecedores->ativo->getViewValue() ?>" disabled checked>
<?php } else { ?>
<input type="checkbox" value="<?php echo $fornecedores->ativo->getViewValue() ?>" disabled>
<?php } ?>
</span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$fornecedores_delete->Recordset->moveNext();
}
$fornecedores_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $fornecedores_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$fornecedores_delete->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$fornecedores_delete->terminate();
?>