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
$contas_correntes_delete = new contas_correntes_delete();

// Run the page
$contas_correntes_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$contas_correntes_delete->Page_Render();
?>
<?php include_once "header.php" ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "delete";
var fcontas_correntesdelete = currentForm = new ew.Form("fcontas_correntesdelete", "delete");

// Form_CustomValidate event
fcontas_correntesdelete.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fcontas_correntesdelete.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
fcontas_correntesdelete.lists["x_ativo[]"] = <?php echo $contas_correntes_delete->ativo->Lookup->toClientList() ?>;
fcontas_correntesdelete.lists["x_ativo[]"].options = <?php echo JsonEncode($contas_correntes_delete->ativo->options(FALSE, TRUE)) ?>;

// Form object for search
</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php $contas_correntes_delete->showPageHeader(); ?>
<?php
$contas_correntes_delete->showMessage();
?>
<form name="fcontas_correntesdelete" id="fcontas_correntesdelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($contas_correntes_delete->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $contas_correntes_delete->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="contas_correntes">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($contas_correntes_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode($COMPOSITE_KEY_SEPARATOR, $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($contas_correntes->id->Visible) { // id ?>
		<th class="<?php echo $contas_correntes->id->headerCellClass() ?>"><span id="elh_contas_correntes_id" class="contas_correntes_id"><?php echo $contas_correntes->id->caption() ?></span></th>
<?php } ?>
<?php if ($contas_correntes->descricao->Visible) { // descricao ?>
		<th class="<?php echo $contas_correntes->descricao->headerCellClass() ?>"><span id="elh_contas_correntes_descricao" class="contas_correntes_descricao"><?php echo $contas_correntes->descricao->caption() ?></span></th>
<?php } ?>
<?php if ($contas_correntes->ativo->Visible) { // ativo ?>
		<th class="<?php echo $contas_correntes->ativo->headerCellClass() ?>"><span id="elh_contas_correntes_ativo" class="contas_correntes_ativo"><?php echo $contas_correntes->ativo->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$contas_correntes_delete->RecCnt = 0;
$i = 0;
while (!$contas_correntes_delete->Recordset->EOF) {
	$contas_correntes_delete->RecCnt++;
	$contas_correntes_delete->RowCnt++;

	// Set row properties
	$contas_correntes->resetAttributes();
	$contas_correntes->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$contas_correntes_delete->loadRowValues($contas_correntes_delete->Recordset);

	// Render row
	$contas_correntes_delete->renderRow();
?>
	<tr<?php echo $contas_correntes->rowAttributes() ?>>
<?php if ($contas_correntes->id->Visible) { // id ?>
		<td<?php echo $contas_correntes->id->cellAttributes() ?>>
<span id="el<?php echo $contas_correntes_delete->RowCnt ?>_contas_correntes_id" class="contas_correntes_id">
<span<?php echo $contas_correntes->id->viewAttributes() ?>>
<?php echo $contas_correntes->id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($contas_correntes->descricao->Visible) { // descricao ?>
		<td<?php echo $contas_correntes->descricao->cellAttributes() ?>>
<span id="el<?php echo $contas_correntes_delete->RowCnt ?>_contas_correntes_descricao" class="contas_correntes_descricao">
<span<?php echo $contas_correntes->descricao->viewAttributes() ?>>
<?php echo $contas_correntes->descricao->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($contas_correntes->ativo->Visible) { // ativo ?>
		<td<?php echo $contas_correntes->ativo->cellAttributes() ?>>
<span id="el<?php echo $contas_correntes_delete->RowCnt ?>_contas_correntes_ativo" class="contas_correntes_ativo">
<span<?php echo $contas_correntes->ativo->viewAttributes() ?>>
<?php if (ConvertToBool($contas_correntes->ativo->CurrentValue)) { ?>
<input type="checkbox" value="<?php echo $contas_correntes->ativo->getViewValue() ?>" disabled checked>
<?php } else { ?>
<input type="checkbox" value="<?php echo $contas_correntes->ativo->getViewValue() ?>" disabled>
<?php } ?>
</span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$contas_correntes_delete->Recordset->moveNext();
}
$contas_correntes_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $contas_correntes_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$contas_correntes_delete->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$contas_correntes_delete->terminate();
?>