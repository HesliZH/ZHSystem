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
$formas_pagamento_edit = new formas_pagamento_edit();

// Run the page
$formas_pagamento_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$formas_pagamento_edit->Page_Render();
?>
<?php include_once "header.php" ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "edit";
var fformas_pagamentoedit = currentForm = new ew.Form("fformas_pagamentoedit", "edit");

// Validate form
fformas_pagamentoedit.validate = function() {
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
		<?php if ($formas_pagamento_edit->id->Required) { ?>
			elm = this.getElements("x" + infix + "_id");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $formas_pagamento->id->caption(), $formas_pagamento->id->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($formas_pagamento_edit->descricao->Required) { ?>
			elm = this.getElements("x" + infix + "_descricao");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $formas_pagamento->descricao->caption(), $formas_pagamento->descricao->RequiredErrorMessage)) ?>");
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
fformas_pagamentoedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fformas_pagamentoedit.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php $formas_pagamento_edit->showPageHeader(); ?>
<?php
$formas_pagamento_edit->showMessage();
?>
<form name="fformas_pagamentoedit" id="fformas_pagamentoedit" class="<?php echo $formas_pagamento_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($formas_pagamento_edit->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $formas_pagamento_edit->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="formas_pagamento">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$formas_pagamento_edit->IsModal ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($formas_pagamento->id->Visible) { // id ?>
	<div id="r_id" class="form-group row">
		<label id="elh_formas_pagamento_id" class="<?php echo $formas_pagamento_edit->LeftColumnClass ?>"><?php echo $formas_pagamento->id->caption() ?><?php echo ($formas_pagamento->id->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $formas_pagamento_edit->RightColumnClass ?>"><div<?php echo $formas_pagamento->id->cellAttributes() ?>>
<span id="el_formas_pagamento_id">
<span<?php echo $formas_pagamento->id->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($formas_pagamento->id->EditValue) ?>"></span>
</span>
<input type="hidden" data-table="formas_pagamento" data-field="x_id" name="x_id" id="x_id" value="<?php echo HtmlEncode($formas_pagamento->id->CurrentValue) ?>">
<?php echo $formas_pagamento->id->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($formas_pagamento->descricao->Visible) { // descricao ?>
	<div id="r_descricao" class="form-group row">
		<label id="elh_formas_pagamento_descricao" for="x_descricao" class="<?php echo $formas_pagamento_edit->LeftColumnClass ?>"><?php echo $formas_pagamento->descricao->caption() ?><?php echo ($formas_pagamento->descricao->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $formas_pagamento_edit->RightColumnClass ?>"><div<?php echo $formas_pagamento->descricao->cellAttributes() ?>>
<span id="el_formas_pagamento_descricao">
<input type="text" data-table="formas_pagamento" data-field="x_descricao" name="x_descricao" id="x_descricao" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($formas_pagamento->descricao->getPlaceHolder()) ?>" value="<?php echo $formas_pagamento->descricao->EditValue ?>"<?php echo $formas_pagamento->descricao->editAttributes() ?>>
</span>
<?php echo $formas_pagamento->descricao->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$formas_pagamento_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $formas_pagamento_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $formas_pagamento_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$formas_pagamento_edit->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$formas_pagamento_edit->terminate();
?>