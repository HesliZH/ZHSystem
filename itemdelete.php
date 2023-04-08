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
$item_delete = new item_delete();

// Run the page
$item_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$item_delete->Page_Render();
?>
<?php include_once "header.php" ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "delete";
var fitemdelete = currentForm = new ew.Form("fitemdelete", "delete");

// Form_CustomValidate event
fitemdelete.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fitemdelete.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
fitemdelete.lists["x_ativo[]"] = <?php echo $item_delete->ativo->Lookup->toClientList() ?>;
fitemdelete.lists["x_ativo[]"].options = <?php echo JsonEncode($item_delete->ativo->options(FALSE, TRUE)) ?>;

// Form object for search
</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php $item_delete->showPageHeader(); ?>
<?php
$item_delete->showMessage();
?>
<form name="fitemdelete" id="fitemdelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($item_delete->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $item_delete->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="item">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($item_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode($COMPOSITE_KEY_SEPARATOR, $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($item->id->Visible) { // id ?>
		<th class="<?php echo $item->id->headerCellClass() ?>"><span id="elh_item_id" class="item_id"><?php echo $item->id->caption() ?></span></th>
<?php } ?>
<?php if ($item->descricao->Visible) { // descricao ?>
		<th class="<?php echo $item->descricao->headerCellClass() ?>"><span id="elh_item_descricao" class="item_descricao"><?php echo $item->descricao->caption() ?></span></th>
<?php } ?>
<?php if ($item->ativo->Visible) { // ativo ?>
		<th class="<?php echo $item->ativo->headerCellClass() ?>"><span id="elh_item_ativo" class="item_ativo"><?php echo $item->ativo->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$item_delete->RecCnt = 0;
$i = 0;
while (!$item_delete->Recordset->EOF) {
	$item_delete->RecCnt++;
	$item_delete->RowCnt++;

	// Set row properties
	$item->resetAttributes();
	$item->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$item_delete->loadRowValues($item_delete->Recordset);

	// Render row
	$item_delete->renderRow();
?>
	<tr<?php echo $item->rowAttributes() ?>>
<?php if ($item->id->Visible) { // id ?>
		<td<?php echo $item->id->cellAttributes() ?>>
<span id="el<?php echo $item_delete->RowCnt ?>_item_id" class="item_id">
<span<?php echo $item->id->viewAttributes() ?>>
<?php echo $item->id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($item->descricao->Visible) { // descricao ?>
		<td<?php echo $item->descricao->cellAttributes() ?>>
<span id="el<?php echo $item_delete->RowCnt ?>_item_descricao" class="item_descricao">
<span<?php echo $item->descricao->viewAttributes() ?>>
<?php echo $item->descricao->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($item->ativo->Visible) { // ativo ?>
		<td<?php echo $item->ativo->cellAttributes() ?>>
<span id="el<?php echo $item_delete->RowCnt ?>_item_ativo" class="item_ativo">
<span<?php echo $item->ativo->viewAttributes() ?>>
<?php if (ConvertToBool($item->ativo->CurrentValue)) { ?>
<input type="checkbox" value="<?php echo $item->ativo->getViewValue() ?>" disabled checked>
<?php } else { ?>
<input type="checkbox" value="<?php echo $item->ativo->getViewValue() ?>" disabled>
<?php } ?>
</span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$item_delete->Recordset->moveNext();
}
$item_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $item_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$item_delete->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$item_delete->terminate();
?>