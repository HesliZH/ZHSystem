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
$compras_itens_add = new compras_itens_add();

// Run the page
$compras_itens_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$compras_itens_add->Page_Render();
?>
<?php include_once "header.php" ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "add";
var fcompras_itensadd = currentForm = new ew.Form("fcompras_itensadd", "add");

// Validate form
fcompras_itensadd.validate = function() {
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
		<?php if ($compras_itens_add->id_compra->Required) { ?>
			elm = this.getElements("x" + infix + "_id_compra");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $compras_itens->id_compra->caption(), $compras_itens->id_compra->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_id_compra");
			if (elm && !ew.checkInteger(elm.value))
				return this.onError(elm, "<?php echo JsEncode($compras_itens->id_compra->errorMessage()) ?>");
		<?php if ($compras_itens_add->item->Required) { ?>
			elm = this.getElements("x" + infix + "_item");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $compras_itens->item->caption(), $compras_itens->item->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_item");
			if (elm && !ew.checkInteger(elm.value))
				return this.onError(elm, "<?php echo JsEncode($compras_itens->item->errorMessage()) ?>");
		<?php if ($compras_itens_add->quantidade->Required) { ?>
			elm = this.getElements("x" + infix + "_quantidade");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $compras_itens->quantidade->caption(), $compras_itens->quantidade->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_quantidade");
			if (elm && !ew.checkNumber(elm.value))
				return this.onError(elm, "<?php echo JsEncode($compras_itens->quantidade->errorMessage()) ?>");
		<?php if ($compras_itens_add->unitario->Required) { ?>
			elm = this.getElements("x" + infix + "_unitario");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $compras_itens->unitario->caption(), $compras_itens->unitario->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_unitario");
			if (elm && !ew.checkNumber(elm.value))
				return this.onError(elm, "<?php echo JsEncode($compras_itens->unitario->errorMessage()) ?>");
		<?php if ($compras_itens_add->total->Required) { ?>
			elm = this.getElements("x" + infix + "_total");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $compras_itens->total->caption(), $compras_itens->total->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_total");
			if (elm && !ew.checkNumber(elm.value))
				return this.onError(elm, "<?php echo JsEncode($compras_itens->total->errorMessage()) ?>");

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
fcompras_itensadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fcompras_itensadd.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php $compras_itens_add->showPageHeader(); ?>
<?php
$compras_itens_add->showMessage();
?>
<form name="fcompras_itensadd" id="fcompras_itensadd" class="<?php echo $compras_itens_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($compras_itens_add->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $compras_itens_add->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="compras_itens">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$compras_itens_add->IsModal ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($compras_itens->id_compra->Visible) { // id_compra ?>
	<div id="r_id_compra" class="form-group row">
		<label id="elh_compras_itens_id_compra" for="x_id_compra" class="<?php echo $compras_itens_add->LeftColumnClass ?>"><?php echo $compras_itens->id_compra->caption() ?><?php echo ($compras_itens->id_compra->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $compras_itens_add->RightColumnClass ?>"><div<?php echo $compras_itens->id_compra->cellAttributes() ?>>
<span id="el_compras_itens_id_compra">
<input type="text" data-table="compras_itens" data-field="x_id_compra" name="x_id_compra" id="x_id_compra" size="30" placeholder="<?php echo HtmlEncode($compras_itens->id_compra->getPlaceHolder()) ?>" value="<?php echo $compras_itens->id_compra->EditValue ?>"<?php echo $compras_itens->id_compra->editAttributes() ?>>
</span>
<?php echo $compras_itens->id_compra->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($compras_itens->item->Visible) { // item ?>
	<div id="r_item" class="form-group row">
		<label id="elh_compras_itens_item" for="x_item" class="<?php echo $compras_itens_add->LeftColumnClass ?>"><?php echo $compras_itens->item->caption() ?><?php echo ($compras_itens->item->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $compras_itens_add->RightColumnClass ?>"><div<?php echo $compras_itens->item->cellAttributes() ?>>
<span id="el_compras_itens_item">
<input type="text" data-table="compras_itens" data-field="x_item" name="x_item" id="x_item" size="30" placeholder="<?php echo HtmlEncode($compras_itens->item->getPlaceHolder()) ?>" value="<?php echo $compras_itens->item->EditValue ?>"<?php echo $compras_itens->item->editAttributes() ?>>
</span>
<?php echo $compras_itens->item->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($compras_itens->quantidade->Visible) { // quantidade ?>
	<div id="r_quantidade" class="form-group row">
		<label id="elh_compras_itens_quantidade" for="x_quantidade" class="<?php echo $compras_itens_add->LeftColumnClass ?>"><?php echo $compras_itens->quantidade->caption() ?><?php echo ($compras_itens->quantidade->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $compras_itens_add->RightColumnClass ?>"><div<?php echo $compras_itens->quantidade->cellAttributes() ?>>
<span id="el_compras_itens_quantidade">
<input type="text" data-table="compras_itens" data-field="x_quantidade" name="x_quantidade" id="x_quantidade" size="30" placeholder="<?php echo HtmlEncode($compras_itens->quantidade->getPlaceHolder()) ?>" value="<?php echo $compras_itens->quantidade->EditValue ?>"<?php echo $compras_itens->quantidade->editAttributes() ?>>
</span>
<?php echo $compras_itens->quantidade->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($compras_itens->unitario->Visible) { // unitario ?>
	<div id="r_unitario" class="form-group row">
		<label id="elh_compras_itens_unitario" for="x_unitario" class="<?php echo $compras_itens_add->LeftColumnClass ?>"><?php echo $compras_itens->unitario->caption() ?><?php echo ($compras_itens->unitario->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $compras_itens_add->RightColumnClass ?>"><div<?php echo $compras_itens->unitario->cellAttributes() ?>>
<span id="el_compras_itens_unitario">
<input type="text" data-table="compras_itens" data-field="x_unitario" name="x_unitario" id="x_unitario" size="30" placeholder="<?php echo HtmlEncode($compras_itens->unitario->getPlaceHolder()) ?>" value="<?php echo $compras_itens->unitario->EditValue ?>"<?php echo $compras_itens->unitario->editAttributes() ?>>
</span>
<?php echo $compras_itens->unitario->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($compras_itens->total->Visible) { // total ?>
	<div id="r_total" class="form-group row">
		<label id="elh_compras_itens_total" for="x_total" class="<?php echo $compras_itens_add->LeftColumnClass ?>"><?php echo $compras_itens->total->caption() ?><?php echo ($compras_itens->total->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $compras_itens_add->RightColumnClass ?>"><div<?php echo $compras_itens->total->cellAttributes() ?>>
<span id="el_compras_itens_total">
<input type="text" data-table="compras_itens" data-field="x_total" name="x_total" id="x_total" size="30" placeholder="<?php echo HtmlEncode($compras_itens->total->getPlaceHolder()) ?>" value="<?php echo $compras_itens->total->EditValue ?>"<?php echo $compras_itens->total->editAttributes() ?>>
</span>
<?php echo $compras_itens->total->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$compras_itens_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $compras_itens_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $compras_itens_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$compras_itens_add->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$compras_itens_add->terminate();
?>