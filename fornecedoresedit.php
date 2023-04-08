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
$fornecedores_edit = new fornecedores_edit();

// Run the page
$fornecedores_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$fornecedores_edit->Page_Render();
?>
<?php include_once "header.php" ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "edit";
var ffornecedoresedit = currentForm = new ew.Form("ffornecedoresedit", "edit");

// Validate form
ffornecedoresedit.validate = function() {
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
		<?php if ($fornecedores_edit->id->Required) { ?>
			elm = this.getElements("x" + infix + "_id");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $fornecedores->id->caption(), $fornecedores->id->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($fornecedores_edit->razao_social->Required) { ?>
			elm = this.getElements("x" + infix + "_razao_social");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $fornecedores->razao_social->caption(), $fornecedores->razao_social->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($fornecedores_edit->ativo->Required) { ?>
			elm = this.getElements("x" + infix + "_ativo[]");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $fornecedores->ativo->caption(), $fornecedores->ativo->RequiredErrorMessage)) ?>");
		<?php } ?>

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
ffornecedoresedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
ffornecedoresedit.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
ffornecedoresedit.lists["x_ativo[]"] = <?php echo $fornecedores_edit->ativo->Lookup->toClientList() ?>;
ffornecedoresedit.lists["x_ativo[]"].options = <?php echo JsonEncode($fornecedores_edit->ativo->options(FALSE, TRUE)) ?>;

// Form object for search
</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php $fornecedores_edit->showPageHeader(); ?>
<?php
$fornecedores_edit->showMessage();
?>
<form name="ffornecedoresedit" id="ffornecedoresedit" class="<?php echo $fornecedores_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($fornecedores_edit->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $fornecedores_edit->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="fornecedores">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$fornecedores_edit->IsModal ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($fornecedores->id->Visible) { // id ?>
	<div id="r_id" class="form-group row">
		<label id="elh_fornecedores_id" class="<?php echo $fornecedores_edit->LeftColumnClass ?>"><?php echo $fornecedores->id->caption() ?><?php echo ($fornecedores->id->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $fornecedores_edit->RightColumnClass ?>"><div<?php echo $fornecedores->id->cellAttributes() ?>>
<span id="el_fornecedores_id">
<span<?php echo $fornecedores->id->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($fornecedores->id->EditValue) ?>"></span>
</span>
<input type="hidden" data-table="fornecedores" data-field="x_id" name="x_id" id="x_id" value="<?php echo HtmlEncode($fornecedores->id->CurrentValue) ?>">
<?php echo $fornecedores->id->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($fornecedores->razao_social->Visible) { // razao_social ?>
	<div id="r_razao_social" class="form-group row">
		<label id="elh_fornecedores_razao_social" for="x_razao_social" class="<?php echo $fornecedores_edit->LeftColumnClass ?>"><?php echo $fornecedores->razao_social->caption() ?><?php echo ($fornecedores->razao_social->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $fornecedores_edit->RightColumnClass ?>"><div<?php echo $fornecedores->razao_social->cellAttributes() ?>>
<span id="el_fornecedores_razao_social">
<input type="text" data-table="fornecedores" data-field="x_razao_social" name="x_razao_social" id="x_razao_social" size="30" maxlength="60" placeholder="<?php echo HtmlEncode($fornecedores->razao_social->getPlaceHolder()) ?>" value="<?php echo $fornecedores->razao_social->EditValue ?>"<?php echo $fornecedores->razao_social->editAttributes() ?>>
</span>
<?php echo $fornecedores->razao_social->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($fornecedores->ativo->Visible) { // ativo ?>
	<div id="r_ativo" class="form-group row">
		<label id="elh_fornecedores_ativo" class="<?php echo $fornecedores_edit->LeftColumnClass ?>"><?php echo $fornecedores->ativo->caption() ?><?php echo ($fornecedores->ativo->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $fornecedores_edit->RightColumnClass ?>"><div<?php echo $fornecedores->ativo->cellAttributes() ?>>
<span id="el_fornecedores_ativo">
<?php
$selwrk = (ConvertToBool($fornecedores->ativo->CurrentValue)) ? " checked" : "";
?>
<input type="checkbox" data-table="fornecedores" data-field="x_ativo" name="x_ativo[]" id="x_ativo[]" value="1"<?php echo $selwrk ?><?php echo $fornecedores->ativo->editAttributes() ?>>
</span>
<?php echo $fornecedores->ativo->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$fornecedores_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $fornecedores_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $fornecedores_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$fornecedores_edit->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$fornecedores_edit->terminate();
?>