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
$contas_pagar_pagamentos_add = new contas_pagar_pagamentos_add();

// Run the page
$contas_pagar_pagamentos_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$contas_pagar_pagamentos_add->Page_Render();
?>
<?php include_once "header.php" ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "add";
var fcontas_pagar_pagamentosadd = currentForm = new ew.Form("fcontas_pagar_pagamentosadd", "add");

// Validate form
fcontas_pagar_pagamentosadd.validate = function() {
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
		<?php if ($contas_pagar_pagamentos_add->id_contas_pagar->Required) { ?>
			elm = this.getElements("x" + infix + "_id_contas_pagar");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $contas_pagar_pagamentos->id_contas_pagar->caption(), $contas_pagar_pagamentos->id_contas_pagar->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_id_contas_pagar");
			if (elm && !ew.checkInteger(elm.value))
				return this.onError(elm, "<?php echo JsEncode($contas_pagar_pagamentos->id_contas_pagar->errorMessage()) ?>");
		<?php if ($contas_pagar_pagamentos_add->valor_pago->Required) { ?>
			elm = this.getElements("x" + infix + "_valor_pago");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $contas_pagar_pagamentos->valor_pago->caption(), $contas_pagar_pagamentos->valor_pago->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_valor_pago");
			if (elm && !ew.checkNumber(elm.value))
				return this.onError(elm, "<?php echo JsEncode($contas_pagar_pagamentos->valor_pago->errorMessage()) ?>");
		<?php if ($contas_pagar_pagamentos_add->parcela->Required) { ?>
			elm = this.getElements("x" + infix + "_parcela");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $contas_pagar_pagamentos->parcela->caption(), $contas_pagar_pagamentos->parcela->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_parcela");
			if (elm && !ew.checkInteger(elm.value))
				return this.onError(elm, "<?php echo JsEncode($contas_pagar_pagamentos->parcela->errorMessage()) ?>");
		<?php if ($contas_pagar_pagamentos_add->forma_pagamento->Required) { ?>
			elm = this.getElements("x" + infix + "_forma_pagamento");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $contas_pagar_pagamentos->forma_pagamento->caption(), $contas_pagar_pagamentos->forma_pagamento->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_forma_pagamento");
			if (elm && !ew.checkInteger(elm.value))
				return this.onError(elm, "<?php echo JsEncode($contas_pagar_pagamentos->forma_pagamento->errorMessage()) ?>");
		<?php if ($contas_pagar_pagamentos_add->id_movimentacao_conta->Required) { ?>
			elm = this.getElements("x" + infix + "_id_movimentacao_conta");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $contas_pagar_pagamentos->id_movimentacao_conta->caption(), $contas_pagar_pagamentos->id_movimentacao_conta->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_id_movimentacao_conta");
			if (elm && !ew.checkInteger(elm.value))
				return this.onError(elm, "<?php echo JsEncode($contas_pagar_pagamentos->id_movimentacao_conta->errorMessage()) ?>");

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
fcontas_pagar_pagamentosadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fcontas_pagar_pagamentosadd.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php $contas_pagar_pagamentos_add->showPageHeader(); ?>
<?php
$contas_pagar_pagamentos_add->showMessage();
?>
<form name="fcontas_pagar_pagamentosadd" id="fcontas_pagar_pagamentosadd" class="<?php echo $contas_pagar_pagamentos_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($contas_pagar_pagamentos_add->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $contas_pagar_pagamentos_add->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="contas_pagar_pagamentos">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$contas_pagar_pagamentos_add->IsModal ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($contas_pagar_pagamentos->id_contas_pagar->Visible) { // id_contas_pagar ?>
	<div id="r_id_contas_pagar" class="form-group row">
		<label id="elh_contas_pagar_pagamentos_id_contas_pagar" for="x_id_contas_pagar" class="<?php echo $contas_pagar_pagamentos_add->LeftColumnClass ?>"><?php echo $contas_pagar_pagamentos->id_contas_pagar->caption() ?><?php echo ($contas_pagar_pagamentos->id_contas_pagar->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $contas_pagar_pagamentos_add->RightColumnClass ?>"><div<?php echo $contas_pagar_pagamentos->id_contas_pagar->cellAttributes() ?>>
<span id="el_contas_pagar_pagamentos_id_contas_pagar">
<input type="text" data-table="contas_pagar_pagamentos" data-field="x_id_contas_pagar" name="x_id_contas_pagar" id="x_id_contas_pagar" size="30" placeholder="<?php echo HtmlEncode($contas_pagar_pagamentos->id_contas_pagar->getPlaceHolder()) ?>" value="<?php echo $contas_pagar_pagamentos->id_contas_pagar->EditValue ?>"<?php echo $contas_pagar_pagamentos->id_contas_pagar->editAttributes() ?>>
</span>
<?php echo $contas_pagar_pagamentos->id_contas_pagar->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($contas_pagar_pagamentos->valor_pago->Visible) { // valor_pago ?>
	<div id="r_valor_pago" class="form-group row">
		<label id="elh_contas_pagar_pagamentos_valor_pago" for="x_valor_pago" class="<?php echo $contas_pagar_pagamentos_add->LeftColumnClass ?>"><?php echo $contas_pagar_pagamentos->valor_pago->caption() ?><?php echo ($contas_pagar_pagamentos->valor_pago->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $contas_pagar_pagamentos_add->RightColumnClass ?>"><div<?php echo $contas_pagar_pagamentos->valor_pago->cellAttributes() ?>>
<span id="el_contas_pagar_pagamentos_valor_pago">
<input type="text" data-table="contas_pagar_pagamentos" data-field="x_valor_pago" name="x_valor_pago" id="x_valor_pago" size="30" placeholder="<?php echo HtmlEncode($contas_pagar_pagamentos->valor_pago->getPlaceHolder()) ?>" value="<?php echo $contas_pagar_pagamentos->valor_pago->EditValue ?>"<?php echo $contas_pagar_pagamentos->valor_pago->editAttributes() ?>>
</span>
<?php echo $contas_pagar_pagamentos->valor_pago->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($contas_pagar_pagamentos->parcela->Visible) { // parcela ?>
	<div id="r_parcela" class="form-group row">
		<label id="elh_contas_pagar_pagamentos_parcela" for="x_parcela" class="<?php echo $contas_pagar_pagamentos_add->LeftColumnClass ?>"><?php echo $contas_pagar_pagamentos->parcela->caption() ?><?php echo ($contas_pagar_pagamentos->parcela->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $contas_pagar_pagamentos_add->RightColumnClass ?>"><div<?php echo $contas_pagar_pagamentos->parcela->cellAttributes() ?>>
<span id="el_contas_pagar_pagamentos_parcela">
<input type="text" data-table="contas_pagar_pagamentos" data-field="x_parcela" name="x_parcela" id="x_parcela" size="30" placeholder="<?php echo HtmlEncode($contas_pagar_pagamentos->parcela->getPlaceHolder()) ?>" value="<?php echo $contas_pagar_pagamentos->parcela->EditValue ?>"<?php echo $contas_pagar_pagamentos->parcela->editAttributes() ?>>
</span>
<?php echo $contas_pagar_pagamentos->parcela->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($contas_pagar_pagamentos->forma_pagamento->Visible) { // forma_pagamento ?>
	<div id="r_forma_pagamento" class="form-group row">
		<label id="elh_contas_pagar_pagamentos_forma_pagamento" for="x_forma_pagamento" class="<?php echo $contas_pagar_pagamentos_add->LeftColumnClass ?>"><?php echo $contas_pagar_pagamentos->forma_pagamento->caption() ?><?php echo ($contas_pagar_pagamentos->forma_pagamento->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $contas_pagar_pagamentos_add->RightColumnClass ?>"><div<?php echo $contas_pagar_pagamentos->forma_pagamento->cellAttributes() ?>>
<span id="el_contas_pagar_pagamentos_forma_pagamento">
<input type="text" data-table="contas_pagar_pagamentos" data-field="x_forma_pagamento" name="x_forma_pagamento" id="x_forma_pagamento" size="30" placeholder="<?php echo HtmlEncode($contas_pagar_pagamentos->forma_pagamento->getPlaceHolder()) ?>" value="<?php echo $contas_pagar_pagamentos->forma_pagamento->EditValue ?>"<?php echo $contas_pagar_pagamentos->forma_pagamento->editAttributes() ?>>
</span>
<?php echo $contas_pagar_pagamentos->forma_pagamento->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($contas_pagar_pagamentos->id_movimentacao_conta->Visible) { // id_movimentacao_conta ?>
	<div id="r_id_movimentacao_conta" class="form-group row">
		<label id="elh_contas_pagar_pagamentos_id_movimentacao_conta" for="x_id_movimentacao_conta" class="<?php echo $contas_pagar_pagamentos_add->LeftColumnClass ?>"><?php echo $contas_pagar_pagamentos->id_movimentacao_conta->caption() ?><?php echo ($contas_pagar_pagamentos->id_movimentacao_conta->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $contas_pagar_pagamentos_add->RightColumnClass ?>"><div<?php echo $contas_pagar_pagamentos->id_movimentacao_conta->cellAttributes() ?>>
<span id="el_contas_pagar_pagamentos_id_movimentacao_conta">
<input type="text" data-table="contas_pagar_pagamentos" data-field="x_id_movimentacao_conta" name="x_id_movimentacao_conta" id="x_id_movimentacao_conta" size="30" placeholder="<?php echo HtmlEncode($contas_pagar_pagamentos->id_movimentacao_conta->getPlaceHolder()) ?>" value="<?php echo $contas_pagar_pagamentos->id_movimentacao_conta->EditValue ?>"<?php echo $contas_pagar_pagamentos->id_movimentacao_conta->editAttributes() ?>>
</span>
<?php echo $contas_pagar_pagamentos->id_movimentacao_conta->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$contas_pagar_pagamentos_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $contas_pagar_pagamentos_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $contas_pagar_pagamentos_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$contas_pagar_pagamentos_add->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$contas_pagar_pagamentos_add->terminate();
?>