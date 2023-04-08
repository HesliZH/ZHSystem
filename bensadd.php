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
$bens_add = new bens_add();

// Run the page
$bens_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$bens_add->Page_Render();
?>
<?php include_once "header.php" ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "add";
var fbensadd = currentForm = new ew.Form("fbensadd", "add");

// Validate form
fbensadd.validate = function() {
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
		<?php if ($bens_add->descricao->Required) { ?>
			elm = this.getElements("x" + infix + "_descricao");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $bens->descricao->caption(), $bens->descricao->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($bens_add->tipo->Required) { ?>
			elm = this.getElements("x" + infix + "_tipo");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $bens->tipo->caption(), $bens->tipo->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($bens_add->placa->Required) { ?>
			elm = this.getElements("x" + infix + "_placa");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $bens->placa->caption(), $bens->placa->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($bens_add->localizacao->Required) { ?>
			elm = this.getElements("x" + infix + "_localizacao");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $bens->localizacao->caption(), $bens->localizacao->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_localizacao");
			if (elm && !ew.checkInteger(elm.value))
				return this.onError(elm, "<?php echo JsEncode($bens->localizacao->errorMessage()) ?>");

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
fbensadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fbensadd.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
fbensadd.lists["x_tipo"] = <?php echo $bens_add->tipo->Lookup->toClientList() ?>;
fbensadd.lists["x_tipo"].options = <?php echo JsonEncode($bens_add->tipo->options(FALSE, TRUE)) ?>;

// Form object for search
</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php $bens_add->showPageHeader(); ?>
<?php
$bens_add->showMessage();
?>
<form name="fbensadd" id="fbensadd" class="<?php echo $bens_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($bens_add->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $bens_add->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="bens">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$bens_add->IsModal ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($bens->descricao->Visible) { // descricao ?>
	<div id="r_descricao" class="form-group row">
		<label id="elh_bens_descricao" for="x_descricao" class="<?php echo $bens_add->LeftColumnClass ?>"><?php echo $bens->descricao->caption() ?><?php echo ($bens->descricao->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $bens_add->RightColumnClass ?>"><div<?php echo $bens->descricao->cellAttributes() ?>>
<span id="el_bens_descricao">
<input type="text" data-table="bens" data-field="x_descricao" name="x_descricao" id="x_descricao" size="30" maxlength="70" placeholder="<?php echo HtmlEncode($bens->descricao->getPlaceHolder()) ?>" value="<?php echo $bens->descricao->EditValue ?>"<?php echo $bens->descricao->editAttributes() ?>>
</span>
<?php echo $bens->descricao->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($bens->tipo->Visible) { // tipo ?>
	<div id="r_tipo" class="form-group row">
		<label id="elh_bens_tipo" for="x_tipo" class="<?php echo $bens_add->LeftColumnClass ?>"><?php echo $bens->tipo->caption() ?><?php echo ($bens->tipo->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $bens_add->RightColumnClass ?>"><div<?php echo $bens->tipo->cellAttributes() ?>>
<span id="el_bens_tipo">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="bens" data-field="x_tipo" data-value-separator="<?php echo $bens->tipo->displayValueSeparatorAttribute() ?>" id="x_tipo" name="x_tipo"<?php echo $bens->tipo->editAttributes() ?>>
		<?php echo $bens->tipo->selectOptionListHtml("x_tipo") ?>
	</select>
</div>
</span>
<?php echo $bens->tipo->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($bens->placa->Visible) { // placa ?>
	<div id="r_placa" class="form-group row">
		<label id="elh_bens_placa" for="x_placa" class="<?php echo $bens_add->LeftColumnClass ?>"><?php echo $bens->placa->caption() ?><?php echo ($bens->placa->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $bens_add->RightColumnClass ?>"><div<?php echo $bens->placa->cellAttributes() ?>>
<span id="el_bens_placa">
<input type="text" data-table="bens" data-field="x_placa" name="x_placa" id="x_placa" size="30" maxlength="10" placeholder="<?php echo HtmlEncode($bens->placa->getPlaceHolder()) ?>" value="<?php echo $bens->placa->EditValue ?>"<?php echo $bens->placa->editAttributes() ?>>
</span>
<?php echo $bens->placa->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($bens->localizacao->Visible) { // localizacao ?>
	<div id="r_localizacao" class="form-group row">
		<label id="elh_bens_localizacao" for="x_localizacao" class="<?php echo $bens_add->LeftColumnClass ?>"><?php echo $bens->localizacao->caption() ?><?php echo ($bens->localizacao->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $bens_add->RightColumnClass ?>"><div<?php echo $bens->localizacao->cellAttributes() ?>>
<span id="el_bens_localizacao">
<input type="text" data-table="bens" data-field="x_localizacao" name="x_localizacao" id="x_localizacao" size="30" placeholder="<?php echo HtmlEncode($bens->localizacao->getPlaceHolder()) ?>" value="<?php echo $bens->localizacao->EditValue ?>"<?php echo $bens->localizacao->editAttributes() ?>>
</span>
<?php echo $bens->localizacao->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$bens_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $bens_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $bens_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$bens_add->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$bens_add->terminate();
?>