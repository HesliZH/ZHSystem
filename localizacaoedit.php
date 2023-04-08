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
$localizacao_edit = new localizacao_edit();

// Run the page
$localizacao_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$localizacao_edit->Page_Render();
?>
<?php include_once "header.php" ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "edit";
var flocalizacaoedit = currentForm = new ew.Form("flocalizacaoedit", "edit");

// Validate form
flocalizacaoedit.validate = function() {
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
		<?php if ($localizacao_edit->id->Required) { ?>
			elm = this.getElements("x" + infix + "_id");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $localizacao->id->caption(), $localizacao->id->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($localizacao_edit->descricao->Required) { ?>
			elm = this.getElements("x" + infix + "_descricao");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $localizacao->descricao->caption(), $localizacao->descricao->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($localizacao_edit->tipo->Required) { ?>
			elm = this.getElements("x" + infix + "_tipo");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $localizacao->tipo->caption(), $localizacao->tipo->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_tipo");
			if (elm && !ew.checkInteger(elm.value))
				return this.onError(elm, "<?php echo JsEncode($localizacao->tipo->errorMessage()) ?>");
		<?php if ($localizacao_edit->id_pai->Required) { ?>
			elm = this.getElements("x" + infix + "_id_pai");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $localizacao->id_pai->caption(), $localizacao->id_pai->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_id_pai");
			if (elm && !ew.checkInteger(elm.value))
				return this.onError(elm, "<?php echo JsEncode($localizacao->id_pai->errorMessage()) ?>");

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
flocalizacaoedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
flocalizacaoedit.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php $localizacao_edit->showPageHeader(); ?>
<?php
$localizacao_edit->showMessage();
?>
<form name="flocalizacaoedit" id="flocalizacaoedit" class="<?php echo $localizacao_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($localizacao_edit->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $localizacao_edit->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="localizacao">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$localizacao_edit->IsModal ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($localizacao->id->Visible) { // id ?>
	<div id="r_id" class="form-group row">
		<label id="elh_localizacao_id" class="<?php echo $localizacao_edit->LeftColumnClass ?>"><?php echo $localizacao->id->caption() ?><?php echo ($localizacao->id->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $localizacao_edit->RightColumnClass ?>"><div<?php echo $localizacao->id->cellAttributes() ?>>
<span id="el_localizacao_id">
<span<?php echo $localizacao->id->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($localizacao->id->EditValue) ?>"></span>
</span>
<input type="hidden" data-table="localizacao" data-field="x_id" name="x_id" id="x_id" value="<?php echo HtmlEncode($localizacao->id->CurrentValue) ?>">
<?php echo $localizacao->id->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($localizacao->descricao->Visible) { // descricao ?>
	<div id="r_descricao" class="form-group row">
		<label id="elh_localizacao_descricao" for="x_descricao" class="<?php echo $localizacao_edit->LeftColumnClass ?>"><?php echo $localizacao->descricao->caption() ?><?php echo ($localizacao->descricao->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $localizacao_edit->RightColumnClass ?>"><div<?php echo $localizacao->descricao->cellAttributes() ?>>
<span id="el_localizacao_descricao">
<input type="text" data-table="localizacao" data-field="x_descricao" name="x_descricao" id="x_descricao" size="30" maxlength="80" placeholder="<?php echo HtmlEncode($localizacao->descricao->getPlaceHolder()) ?>" value="<?php echo $localizacao->descricao->EditValue ?>"<?php echo $localizacao->descricao->editAttributes() ?>>
</span>
<?php echo $localizacao->descricao->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($localizacao->tipo->Visible) { // tipo ?>
	<div id="r_tipo" class="form-group row">
		<label id="elh_localizacao_tipo" for="x_tipo" class="<?php echo $localizacao_edit->LeftColumnClass ?>"><?php echo $localizacao->tipo->caption() ?><?php echo ($localizacao->tipo->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $localizacao_edit->RightColumnClass ?>"><div<?php echo $localizacao->tipo->cellAttributes() ?>>
<span id="el_localizacao_tipo">
<input type="text" data-table="localizacao" data-field="x_tipo" name="x_tipo" id="x_tipo" size="30" placeholder="<?php echo HtmlEncode($localizacao->tipo->getPlaceHolder()) ?>" value="<?php echo $localizacao->tipo->EditValue ?>"<?php echo $localizacao->tipo->editAttributes() ?>>
</span>
<?php echo $localizacao->tipo->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($localizacao->id_pai->Visible) { // id_pai ?>
	<div id="r_id_pai" class="form-group row">
		<label id="elh_localizacao_id_pai" for="x_id_pai" class="<?php echo $localizacao_edit->LeftColumnClass ?>"><?php echo $localizacao->id_pai->caption() ?><?php echo ($localizacao->id_pai->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $localizacao_edit->RightColumnClass ?>"><div<?php echo $localizacao->id_pai->cellAttributes() ?>>
<span id="el_localizacao_id_pai">
<input type="text" data-table="localizacao" data-field="x_id_pai" name="x_id_pai" id="x_id_pai" size="30" placeholder="<?php echo HtmlEncode($localizacao->id_pai->getPlaceHolder()) ?>" value="<?php echo $localizacao->id_pai->EditValue ?>"<?php echo $localizacao->id_pai->editAttributes() ?>>
</span>
<?php echo $localizacao->id_pai->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$localizacao_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $localizacao_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $localizacao_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$localizacao_edit->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$localizacao_edit->terminate();
?>