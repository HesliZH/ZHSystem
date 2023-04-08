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
$contas_correntes_movimento_delete = new contas_correntes_movimento_delete();

// Run the page
$contas_correntes_movimento_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$contas_correntes_movimento_delete->Page_Render();
?>
<?php include_once "header.php" ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "delete";
var fcontas_correntes_movimentodelete = currentForm = new ew.Form("fcontas_correntes_movimentodelete", "delete");

// Form_CustomValidate event
fcontas_correntes_movimentodelete.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fcontas_correntes_movimentodelete.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php $contas_correntes_movimento_delete->showPageHeader(); ?>
<?php
$contas_correntes_movimento_delete->showMessage();
?>
<form name="fcontas_correntes_movimentodelete" id="fcontas_correntes_movimentodelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($contas_correntes_movimento_delete->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $contas_correntes_movimento_delete->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="contas_correntes_movimento">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($contas_correntes_movimento_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode($COMPOSITE_KEY_SEPARATOR, $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($contas_correntes_movimento->id->Visible) { // id ?>
		<th class="<?php echo $contas_correntes_movimento->id->headerCellClass() ?>"><span id="elh_contas_correntes_movimento_id" class="contas_correntes_movimento_id"><?php echo $contas_correntes_movimento->id->caption() ?></span></th>
<?php } ?>
<?php if ($contas_correntes_movimento->valor->Visible) { // valor ?>
		<th class="<?php echo $contas_correntes_movimento->valor->headerCellClass() ?>"><span id="elh_contas_correntes_movimento_valor" class="contas_correntes_movimento_valor"><?php echo $contas_correntes_movimento->valor->caption() ?></span></th>
<?php } ?>
<?php if ($contas_correntes_movimento->tipo_movimentacao->Visible) { // tipo_movimentacao ?>
		<th class="<?php echo $contas_correntes_movimento->tipo_movimentacao->headerCellClass() ?>"><span id="elh_contas_correntes_movimento_tipo_movimentacao" class="contas_correntes_movimento_tipo_movimentacao"><?php echo $contas_correntes_movimento->tipo_movimentacao->caption() ?></span></th>
<?php } ?>
<?php if ($contas_correntes_movimento->direcao->Visible) { // direcao ?>
		<th class="<?php echo $contas_correntes_movimento->direcao->headerCellClass() ?>"><span id="elh_contas_correntes_movimento_direcao" class="contas_correntes_movimento_direcao"><?php echo $contas_correntes_movimento->direcao->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$contas_correntes_movimento_delete->RecCnt = 0;
$i = 0;
while (!$contas_correntes_movimento_delete->Recordset->EOF) {
	$contas_correntes_movimento_delete->RecCnt++;
	$contas_correntes_movimento_delete->RowCnt++;

	// Set row properties
	$contas_correntes_movimento->resetAttributes();
	$contas_correntes_movimento->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$contas_correntes_movimento_delete->loadRowValues($contas_correntes_movimento_delete->Recordset);

	// Render row
	$contas_correntes_movimento_delete->renderRow();
?>
	<tr<?php echo $contas_correntes_movimento->rowAttributes() ?>>
<?php if ($contas_correntes_movimento->id->Visible) { // id ?>
		<td<?php echo $contas_correntes_movimento->id->cellAttributes() ?>>
<span id="el<?php echo $contas_correntes_movimento_delete->RowCnt ?>_contas_correntes_movimento_id" class="contas_correntes_movimento_id">
<span<?php echo $contas_correntes_movimento->id->viewAttributes() ?>>
<?php echo $contas_correntes_movimento->id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($contas_correntes_movimento->valor->Visible) { // valor ?>
		<td<?php echo $contas_correntes_movimento->valor->cellAttributes() ?>>
<span id="el<?php echo $contas_correntes_movimento_delete->RowCnt ?>_contas_correntes_movimento_valor" class="contas_correntes_movimento_valor">
<span<?php echo $contas_correntes_movimento->valor->viewAttributes() ?>>
<?php echo $contas_correntes_movimento->valor->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($contas_correntes_movimento->tipo_movimentacao->Visible) { // tipo_movimentacao ?>
		<td<?php echo $contas_correntes_movimento->tipo_movimentacao->cellAttributes() ?>>
<span id="el<?php echo $contas_correntes_movimento_delete->RowCnt ?>_contas_correntes_movimento_tipo_movimentacao" class="contas_correntes_movimento_tipo_movimentacao">
<span<?php echo $contas_correntes_movimento->tipo_movimentacao->viewAttributes() ?>>
<?php echo $contas_correntes_movimento->tipo_movimentacao->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($contas_correntes_movimento->direcao->Visible) { // direcao ?>
		<td<?php echo $contas_correntes_movimento->direcao->cellAttributes() ?>>
<span id="el<?php echo $contas_correntes_movimento_delete->RowCnt ?>_contas_correntes_movimento_direcao" class="contas_correntes_movimento_direcao">
<span<?php echo $contas_correntes_movimento->direcao->viewAttributes() ?>>
<?php echo $contas_correntes_movimento->direcao->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$contas_correntes_movimento_delete->Recordset->moveNext();
}
$contas_correntes_movimento_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $contas_correntes_movimento_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$contas_correntes_movimento_delete->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$contas_correntes_movimento_delete->terminate();
?>