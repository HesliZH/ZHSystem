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
$contas_correntes_add = new contas_correntes_add();

// Run the page
$contas_correntes_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$contas_correntes_add->Page_Render();
?>
<?php include_once "header.php" ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "add";
var fcontas_correntesadd = currentForm = new ew.Form("fcontas_correntesadd", "add");

// Validate form
fcontas_correntesadd.validate = function() {
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
		<?php if ($contas_correntes_add->descricao->Required) { ?>
			elm = this.getElements("x" + infix + "_descricao");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $contas_correntes->descricao->caption(), $contas_correntes->descricao->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($contas_correntes_add->ativo->Required) { ?>
			elm = this.getElements("x" + infix + "_ativo[]");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $contas_correntes->ativo->caption(), $contas_correntes->ativo->RequiredErrorMessage)) ?>");
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
fcontas_correntesadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fcontas_correntesadd.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
fcontas_correntesadd.lists["x_ativo[]"] = <?php echo $contas_correntes_add->ativo->Lookup->toClientList() ?>;
fcontas_correntesadd.lists["x_ativo[]"].options = <?php echo JsonEncode($contas_correntes_add->ativo->options(FALSE, TRUE)) ?>;

// Form object for search
</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php $contas_correntes_add->showPageHeader(); ?>
<?php
$contas_correntes_add->showMessage();
?>
<form name="fcontas_correntesadd" id="fcontas_correntesadd" class="<?php echo $contas_correntes_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($contas_correntes_add->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $contas_correntes_add->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="contas_correntes">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$contas_correntes_add->IsModal ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($contas_correntes->descricao->Visible) { // descricao ?>
	<div id="r_descricao" class="form-group row">
		<label id="elh_contas_correntes_descricao" for="x_descricao" class="<?php echo $contas_correntes_add->LeftColumnClass ?>"><?php echo $contas_correntes->descricao->caption() ?><?php echo ($contas_correntes->descricao->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $contas_correntes_add->RightColumnClass ?>"><div<?php echo $contas_correntes->descricao->cellAttributes() ?>>
<span id="el_contas_correntes_descricao">
<input type="text" data-table="contas_correntes" data-field="x_descricao" name="x_descricao" id="x_descricao" size="30" maxlength="60" placeholder="<?php echo HtmlEncode($contas_correntes->descricao->getPlaceHolder()) ?>" value="<?php echo $contas_correntes->descricao->EditValue ?>"<?php echo $contas_correntes->descricao->editAttributes() ?>>
</span>
<?php echo $contas_correntes->descricao->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($contas_correntes->ativo->Visible) { // ativo ?>
	<div id="r_ativo" class="form-group row">
		<label id="elh_contas_correntes_ativo" class="<?php echo $contas_correntes_add->LeftColumnClass ?>"><?php echo $contas_correntes->ativo->caption() ?><?php echo ($contas_correntes->ativo->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $contas_correntes_add->RightColumnClass ?>"><div<?php echo $contas_correntes->ativo->cellAttributes() ?>>
<span id="el_contas_correntes_ativo">
<?php
$selwrk = (ConvertToBool($contas_correntes->ativo->CurrentValue)) ? " checked" : "";
?>
<input type="checkbox" data-table="contas_correntes" data-field="x_ativo" name="x_ativo[]" id="x_ativo[]" value="1"<?php echo $selwrk ?><?php echo $contas_correntes->ativo->editAttributes() ?>>
</span>
<?php echo $contas_correntes->ativo->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$contas_correntes_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $contas_correntes_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $contas_correntes_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$contas_correntes_add->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$contas_correntes_add->terminate();
?>