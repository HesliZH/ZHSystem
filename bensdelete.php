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
$bens_delete = new bens_delete();

// Run the page
$bens_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$bens_delete->Page_Render();
?>
<?php include_once "header.php" ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "delete";
var fbensdelete = currentForm = new ew.Form("fbensdelete", "delete");

// Form_CustomValidate event
fbensdelete.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fbensdelete.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
fbensdelete.lists["x_tipo"] = <?php echo $bens_delete->tipo->Lookup->toClientList() ?>;
fbensdelete.lists["x_tipo"].options = <?php echo JsonEncode($bens_delete->tipo->options(FALSE, TRUE)) ?>;

// Form object for search
</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php $bens_delete->showPageHeader(); ?>
<?php
$bens_delete->showMessage();
?>
<form name="fbensdelete" id="fbensdelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($bens_delete->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $bens_delete->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="bens">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($bens_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode($COMPOSITE_KEY_SEPARATOR, $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($bens->descricao->Visible) { // descricao ?>
		<th class="<?php echo $bens->descricao->headerCellClass() ?>"><span id="elh_bens_descricao" class="bens_descricao"><?php echo $bens->descricao->caption() ?></span></th>
<?php } ?>
<?php if ($bens->tipo->Visible) { // tipo ?>
		<th class="<?php echo $bens->tipo->headerCellClass() ?>"><span id="elh_bens_tipo" class="bens_tipo"><?php echo $bens->tipo->caption() ?></span></th>
<?php } ?>
<?php if ($bens->placa->Visible) { // placa ?>
		<th class="<?php echo $bens->placa->headerCellClass() ?>"><span id="elh_bens_placa" class="bens_placa"><?php echo $bens->placa->caption() ?></span></th>
<?php } ?>
<?php if ($bens->localizacao->Visible) { // localizacao ?>
		<th class="<?php echo $bens->localizacao->headerCellClass() ?>"><span id="elh_bens_localizacao" class="bens_localizacao"><?php echo $bens->localizacao->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$bens_delete->RecCnt = 0;
$i = 0;
while (!$bens_delete->Recordset->EOF) {
	$bens_delete->RecCnt++;
	$bens_delete->RowCnt++;

	// Set row properties
	$bens->resetAttributes();
	$bens->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$bens_delete->loadRowValues($bens_delete->Recordset);

	// Render row
	$bens_delete->renderRow();
?>
	<tr<?php echo $bens->rowAttributes() ?>>
<?php if ($bens->descricao->Visible) { // descricao ?>
		<td<?php echo $bens->descricao->cellAttributes() ?>>
<span id="el<?php echo $bens_delete->RowCnt ?>_bens_descricao" class="bens_descricao">
<span<?php echo $bens->descricao->viewAttributes() ?>>
<?php echo $bens->descricao->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($bens->tipo->Visible) { // tipo ?>
		<td<?php echo $bens->tipo->cellAttributes() ?>>
<span id="el<?php echo $bens_delete->RowCnt ?>_bens_tipo" class="bens_tipo">
<span<?php echo $bens->tipo->viewAttributes() ?>>
<?php echo $bens->tipo->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($bens->placa->Visible) { // placa ?>
		<td<?php echo $bens->placa->cellAttributes() ?>>
<span id="el<?php echo $bens_delete->RowCnt ?>_bens_placa" class="bens_placa">
<span<?php echo $bens->placa->viewAttributes() ?>>
<?php echo $bens->placa->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($bens->localizacao->Visible) { // localizacao ?>
		<td<?php echo $bens->localizacao->cellAttributes() ?>>
<span id="el<?php echo $bens_delete->RowCnt ?>_bens_localizacao" class="bens_localizacao">
<span<?php echo $bens->localizacao->viewAttributes() ?>>
<?php echo $bens->localizacao->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$bens_delete->Recordset->moveNext();
}
$bens_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $bens_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$bens_delete->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$bens_delete->terminate();
?>