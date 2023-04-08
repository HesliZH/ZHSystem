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
$contas_correntes_movimento_add = new contas_correntes_movimento_add();

// Run the page
$contas_correntes_movimento_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$contas_correntes_movimento_add->Page_Render();
?>
<?php include_once "header.php" ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "add";
var fcontas_correntes_movimentoadd = currentForm = new ew.Form("fcontas_correntes_movimentoadd", "add");

// Validate form
fcontas_correntes_movimentoadd.validate = function() {
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
		<?php if ($contas_correntes_movimento_add->valor->Required) { ?>
			elm = this.getElements("x" + infix + "_valor");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $contas_correntes_movimento->valor->caption(), $contas_correntes_movimento->valor->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_valor");
			if (elm && !ew.checkNumber(elm.value))
				return this.onError(elm, "<?php echo JsEncode($contas_correntes_movimento->valor->errorMessage()) ?>");
		<?php if ($contas_correntes_movimento_add->tipo_movimentacao->Required) { ?>
			elm = this.getElements("x" + infix + "_tipo_movimentacao");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $contas_correntes_movimento->tipo_movimentacao->caption(), $contas_correntes_movimento->tipo_movimentacao->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_tipo_movimentacao");
			if (elm && !ew.checkInteger(elm.value))
				return this.onError(elm, "<?php echo JsEncode($contas_correntes_movimento->tipo_movimentacao->errorMessage()) ?>");
		<?php if ($contas_correntes_movimento_add->direcao->Required) { ?>
			elm = this.getElements("x" + infix + "_direcao");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $contas_correntes_movimento->direcao->caption(), $contas_correntes_movimento->direcao->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_direcao");
			if (elm && !ew.checkInteger(elm.value))
				return this.onError(elm, "<?php echo JsEncode($contas_correntes_movimento->direcao->errorMessage()) ?>");

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
fcontas_correntes_movimentoadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fcontas_correntes_movimentoadd.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php $contas_correntes_movimento_add->showPageHeader(); ?>
<?php
$contas_correntes_movimento_add->showMessage();
?>
<form name="fcontas_correntes_movimentoadd" id="fcontas_correntes_movimentoadd" class="<?php echo $contas_correntes_movimento_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($contas_correntes_movimento_add->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $contas_correntes_movimento_add->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="contas_correntes_movimento">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$contas_correntes_movimento_add->IsModal ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($contas_correntes_movimento->valor->Visible) { // valor ?>
	<div id="r_valor" class="form-group row">
		<label id="elh_contas_correntes_movimento_valor" for="x_valor" class="<?php echo $contas_correntes_movimento_add->LeftColumnClass ?>"><?php echo $contas_correntes_movimento->valor->caption() ?><?php echo ($contas_correntes_movimento->valor->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $contas_correntes_movimento_add->RightColumnClass ?>"><div<?php echo $contas_correntes_movimento->valor->cellAttributes() ?>>
<span id="el_contas_correntes_movimento_valor">
<input type="text" data-table="contas_correntes_movimento" data-field="x_valor" name="x_valor" id="x_valor" size="30" placeholder="<?php echo HtmlEncode($contas_correntes_movimento->valor->getPlaceHolder()) ?>" value="<?php echo $contas_correntes_movimento->valor->EditValue ?>"<?php echo $contas_correntes_movimento->valor->editAttributes() ?>>
</span>
<?php echo $contas_correntes_movimento->valor->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($contas_correntes_movimento->tipo_movimentacao->Visible) { // tipo_movimentacao ?>
	<div id="r_tipo_movimentacao" class="form-group row">
		<label id="elh_contas_correntes_movimento_tipo_movimentacao" for="x_tipo_movimentacao" class="<?php echo $contas_correntes_movimento_add->LeftColumnClass ?>"><?php echo $contas_correntes_movimento->tipo_movimentacao->caption() ?><?php echo ($contas_correntes_movimento->tipo_movimentacao->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $contas_correntes_movimento_add->RightColumnClass ?>"><div<?php echo $contas_correntes_movimento->tipo_movimentacao->cellAttributes() ?>>
<span id="el_contas_correntes_movimento_tipo_movimentacao">
<input type="text" data-table="contas_correntes_movimento" data-field="x_tipo_movimentacao" name="x_tipo_movimentacao" id="x_tipo_movimentacao" size="30" placeholder="<?php echo HtmlEncode($contas_correntes_movimento->tipo_movimentacao->getPlaceHolder()) ?>" value="<?php echo $contas_correntes_movimento->tipo_movimentacao->EditValue ?>"<?php echo $contas_correntes_movimento->tipo_movimentacao->editAttributes() ?>>
</span>
<?php echo $contas_correntes_movimento->tipo_movimentacao->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($contas_correntes_movimento->direcao->Visible) { // direcao ?>
	<div id="r_direcao" class="form-group row">
		<label id="elh_contas_correntes_movimento_direcao" for="x_direcao" class="<?php echo $contas_correntes_movimento_add->LeftColumnClass ?>"><?php echo $contas_correntes_movimento->direcao->caption() ?><?php echo ($contas_correntes_movimento->direcao->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $contas_correntes_movimento_add->RightColumnClass ?>"><div<?php echo $contas_correntes_movimento->direcao->cellAttributes() ?>>
<span id="el_contas_correntes_movimento_direcao">
<input type="text" data-table="contas_correntes_movimento" data-field="x_direcao" name="x_direcao" id="x_direcao" size="30" placeholder="<?php echo HtmlEncode($contas_correntes_movimento->direcao->getPlaceHolder()) ?>" value="<?php echo $contas_correntes_movimento->direcao->EditValue ?>"<?php echo $contas_correntes_movimento->direcao->editAttributes() ?>>
</span>
<?php echo $contas_correntes_movimento->direcao->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$contas_correntes_movimento_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $contas_correntes_movimento_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $contas_correntes_movimento_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$contas_correntes_movimento_add->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$contas_correntes_movimento_add->terminate();
?>