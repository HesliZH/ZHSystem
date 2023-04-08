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
$compras_edit = new compras_edit();

// Run the page
$compras_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$compras_edit->Page_Render();
?>
<?php include_once "header.php" ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "edit";
var fcomprasedit = currentForm = new ew.Form("fcomprasedit", "edit");

// Validate form
fcomprasedit.validate = function() {
	if (!this.validateRequired)
		return true; // Ignore validation
	var $ = jQuery, fobj = this.getForm(), $fobj = $(fobj);
	if ($fobj.find("#confirm").val() == "F")
		return true;
	var elm, felm, uelm, addcnt = 0;
	var $k = $fobj.find("#" + this.formKeyCountName); // Get key_count
	var rowcnt = ($k[0]) ? parseInt($k.val(), 10) : 1;
	var startcnt = (rowcnt == 0) ? 0 : 1; // Check rowcnt == 0 => Inline-Add
	var gridinsert = ["insert", "gridinsert"].includes($fobj.find("#action").val()) && $k[0];
	for (var i = startcnt; i <= rowcnt; i++) {
		var infix = ($k[0]) ? String(i) : "";
		$fobj.data("rowindex", infix);
		<?php if ($compras_edit->id->Required) { ?>
			elm = this.getElements("x" + infix + "_id");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $compras->id->caption(), $compras->id->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($compras_edit->data->Required) { ?>
			elm = this.getElements("x" + infix + "_data");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $compras->data->caption(), $compras->data->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_data");
			if (elm && !ew.checkDateDef(elm.value))
				return this.onError(elm, "<?php echo JsEncode($compras->data->errorMessage()) ?>");
		<?php if ($compras_edit->valor->Required) { ?>
			elm = this.getElements("x" + infix + "_valor");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $compras->valor->caption(), $compras->valor->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_valor");
			if (elm && !ew.checkNumber(elm.value))
				return this.onError(elm, "<?php echo JsEncode($compras->valor->errorMessage()) ?>");
		<?php if ($compras_edit->fornecedor->Required) { ?>
			elm = this.getElements("x" + infix + "_fornecedor");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $compras->fornecedor->caption(), $compras->fornecedor->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_fornecedor");
			if (elm && !ew.checkInteger(elm.value))
				return this.onError(elm, "<?php echo JsEncode($compras->fornecedor->errorMessage()) ?>");
		<?php if ($compras_edit->parcelas->Required) { ?>
			elm = this.getElements("x" + infix + "_parcelas");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $compras->parcelas->caption(), $compras->parcelas->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_parcelas");
			if (elm && !ew.checkInteger(elm.value))
				return this.onError(elm, "<?php echo JsEncode($compras->parcelas->errorMessage()) ?>");

			// Fire Form_CustomValidate event
			if (!this.Form_CustomValidate(fobj))
				return false;
	}

	// Process detail forms
	var dfs = $fobj.find("input[name='detailpage']").get();
	for (var i = 0; i < dfs.length; i++) {
		var df = dfs[i], val = df.value;
		if (val && ew.forms[val])
			if (!ew.forms[val].validate())
				return false;
	}
	return true;
}

// Form_CustomValidate event
fcomprasedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fcomprasedit.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php $compras_edit->showPageHeader(); ?>
<?php
$compras_edit->showMessage();
?>
<form name="fcomprasedit" id="fcomprasedit" class="<?php echo $compras_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($compras_edit->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $compras_edit->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="compras">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$compras_edit->IsModal ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($compras->id->Visible) { // id ?>
	<div id="r_id" class="form-group row">
		<label id="elh_compras_id" class="<?php echo $compras_edit->LeftColumnClass ?>"><?php echo $compras->id->caption() ?><?php echo ($compras->id->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $compras_edit->RightColumnClass ?>"><div<?php echo $compras->id->cellAttributes() ?>>
<span id="el_compras_id">
<span<?php echo $compras->id->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($compras->id->EditValue) ?>"></span>
</span>
<input type="hidden" data-table="compras" data-field="x_id" name="x_id" id="x_id" value="<?php echo HtmlEncode($compras->id->CurrentValue) ?>">
<?php echo $compras->id->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($compras->data->Visible) { // data ?>
	<div id="r_data" class="form-group row">
		<label id="elh_compras_data" for="x_data" class="<?php echo $compras_edit->LeftColumnClass ?>"><?php echo $compras->data->caption() ?><?php echo ($compras->data->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $compras_edit->RightColumnClass ?>"><div<?php echo $compras->data->cellAttributes() ?>>
<span id="el_compras_data">
<input type="text" data-table="compras" data-field="x_data" name="x_data" id="x_data" placeholder="<?php echo HtmlEncode($compras->data->getPlaceHolder()) ?>" value="<?php echo $compras->data->EditValue ?>"<?php echo $compras->data->editAttributes() ?>>
</span>
<?php echo $compras->data->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($compras->valor->Visible) { // valor ?>
	<div id="r_valor" class="form-group row">
		<label id="elh_compras_valor" for="x_valor" class="<?php echo $compras_edit->LeftColumnClass ?>"><?php echo $compras->valor->caption() ?><?php echo ($compras->valor->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $compras_edit->RightColumnClass ?>"><div<?php echo $compras->valor->cellAttributes() ?>>
<span id="el_compras_valor">
<input type="text" data-table="compras" data-field="x_valor" name="x_valor" id="x_valor" size="30" placeholder="<?php echo HtmlEncode($compras->valor->getPlaceHolder()) ?>" value="<?php echo $compras->valor->EditValue ?>"<?php echo $compras->valor->editAttributes() ?>>
</span>
<?php echo $compras->valor->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($compras->fornecedor->Visible) { // fornecedor ?>
	<div id="r_fornecedor" class="form-group row">
		<label id="elh_compras_fornecedor" for="x_fornecedor" class="<?php echo $compras_edit->LeftColumnClass ?>"><?php echo $compras->fornecedor->caption() ?><?php echo ($compras->fornecedor->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $compras_edit->RightColumnClass ?>"><div<?php echo $compras->fornecedor->cellAttributes() ?>>
<span id="el_compras_fornecedor">
<input type="text" data-table="compras" data-field="x_fornecedor" name="x_fornecedor" id="x_fornecedor" size="30" placeholder="<?php echo HtmlEncode($compras->fornecedor->getPlaceHolder()) ?>" value="<?php echo $compras->fornecedor->EditValue ?>"<?php echo $compras->fornecedor->editAttributes() ?>>
</span>
<?php echo $compras->fornecedor->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($compras->parcelas->Visible) { // parcelas ?>
	<div id="r_parcelas" class="form-group row">
		<label id="elh_compras_parcelas" for="x_parcelas" class="<?php echo $compras_edit->LeftColumnClass ?>"><?php echo $compras->parcelas->caption() ?><?php echo ($compras->parcelas->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $compras_edit->RightColumnClass ?>"><div<?php echo $compras->parcelas->cellAttributes() ?>>
<span id="el_compras_parcelas">
<input type="text" data-table="compras" data-field="x_parcelas" name="x_parcelas" id="x_parcelas" size="30" placeholder="<?php echo HtmlEncode($compras->parcelas->getPlaceHolder()) ?>" value="<?php echo $compras->parcelas->EditValue ?>"<?php echo $compras->parcelas->editAttributes() ?>>
</span>
<?php echo $compras->parcelas->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$compras_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $compras_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $compras_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$compras_edit->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$compras_edit->terminate();
?>