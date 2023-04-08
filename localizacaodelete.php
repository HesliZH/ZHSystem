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
$localizacao_delete = new localizacao_delete();

// Run the page
$localizacao_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$localizacao_delete->Page_Render();
?>
<?php include_once "header.php" ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "delete";
var flocalizacaodelete = currentForm = new ew.Form("flocalizacaodelete", "delete");

// Form_CustomValidate event
flocalizacaodelete.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
flocalizacaodelete.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php $localizacao_delete->showPageHeader(); ?>
<?php
$localizacao_delete->showMessage();
?>
<form name="flocalizacaodelete" id="flocalizacaodelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($localizacao_delete->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $localizacao_delete->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="localizacao">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($localizacao_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode($COMPOSITE_KEY_SEPARATOR, $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($localizacao->id->Visible) { // id ?>
		<th class="<?php echo $localizacao->id->headerCellClass() ?>"><span id="elh_localizacao_id" class="localizacao_id"><?php echo $localizacao->id->caption() ?></span></th>
<?php } ?>
<?php if ($localizacao->descricao->Visible) { // descricao ?>
		<th class="<?php echo $localizacao->descricao->headerCellClass() ?>"><span id="elh_localizacao_descricao" class="localizacao_descricao"><?php echo $localizacao->descricao->caption() ?></span></th>
<?php } ?>
<?php if ($localizacao->tipo->Visible) { // tipo ?>
		<th class="<?php echo $localizacao->tipo->headerCellClass() ?>"><span id="elh_localizacao_tipo" class="localizacao_tipo"><?php echo $localizacao->tipo->caption() ?></span></th>
<?php } ?>
<?php if ($localizacao->id_pai->Visible) { // id_pai ?>
		<th class="<?php echo $localizacao->id_pai->headerCellClass() ?>"><span id="elh_localizacao_id_pai" class="localizacao_id_pai"><?php echo $localizacao->id_pai->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$localizacao_delete->RecCnt = 0;
$i = 0;
while (!$localizacao_delete->Recordset->EOF) {
	$localizacao_delete->RecCnt++;
	$localizacao_delete->RowCnt++;

	// Set row properties
	$localizacao->resetAttributes();
	$localizacao->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$localizacao_delete->loadRowValues($localizacao_delete->Recordset);

	// Render row
	$localizacao_delete->renderRow();
?>
	<tr<?php echo $localizacao->rowAttributes() ?>>
<?php if ($localizacao->id->Visible) { // id ?>
		<td<?php echo $localizacao->id->cellAttributes() ?>>
<span id="el<?php echo $localizacao_delete->RowCnt ?>_localizacao_id" class="localizacao_id">
<span<?php echo $localizacao->id->viewAttributes() ?>>
<?php echo $localizacao->id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($localizacao->descricao->Visible) { // descricao ?>
		<td<?php echo $localizacao->descricao->cellAttributes() ?>>
<span id="el<?php echo $localizacao_delete->RowCnt ?>_localizacao_descricao" class="localizacao_descricao">
<span<?php echo $localizacao->descricao->viewAttributes() ?>>
<?php echo $localizacao->descricao->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($localizacao->tipo->Visible) { // tipo ?>
		<td<?php echo $localizacao->tipo->cellAttributes() ?>>
<span id="el<?php echo $localizacao_delete->RowCnt ?>_localizacao_tipo" class="localizacao_tipo">
<span<?php echo $localizacao->tipo->viewAttributes() ?>>
<?php echo $localizacao->tipo->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($localizacao->id_pai->Visible) { // id_pai ?>
		<td<?php echo $localizacao->id_pai->cellAttributes() ?>>
<span id="el<?php echo $localizacao_delete->RowCnt ?>_localizacao_id_pai" class="localizacao_id_pai">
<span<?php echo $localizacao->id_pai->viewAttributes() ?>>
<?php echo $localizacao->id_pai->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$localizacao_delete->Recordset->moveNext();
}
$localizacao_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $localizacao_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$localizacao_delete->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$localizacao_delete->terminate();
?>