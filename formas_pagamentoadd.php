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
$formas_pagamento_add = new formas_pagamento_add();

// Run the page
$formas_pagamento_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$formas_pagamento_add->Page_Render();
?>
<?php include_once "header.php" ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "add";
var fformas_pagamentoadd = currentForm = new ew.Form("fformas_pagamentoadd", "add");

// Validate form
fformas_pagamentoadd.validate = function() {
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
		<?php if ($formas_pagamento_add->descricao->Required) { ?>
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
fformas_pagamentoadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fformas_pagamentoadd.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php $formas_pagamento_add->showPageHeader(); ?>
<?php
$formas_pagamento_add->showMessage();
?>
<form name="fformas_pagamentoadd" id="fformas_pagamentoadd" class="<?php echo $formas_pagamento_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($formas_pagamento_add->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $formas_pagamento_add->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="formas_pagamento">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$formas_pagamento_add->IsModal ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($formas_pagamento->descricao->Visible) { // descricao ?>
	<div id="r_descricao" class="form-group row">
		<label id="elh_formas_pagamento_descricao" for="x_descricao" class="<?php echo $formas_pagamento_add->LeftColumnClass ?>"><?php echo $formas_pagamento->descricao->caption() ?><?php echo ($formas_pagamento->descricao->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $formas_pagamento_add->RightColumnClass ?>"><div<?php echo $formas_pagamento->descricao->cellAttributes() ?>>
<span id="el_formas_pagamento_descricao">
<input type="text" data-table="formas_pagamento" data-field="x_descricao" name="x_descricao" id="x_descricao" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($formas_pagamento->descricao->getPlaceHolder()) ?>" value="<?php echo $formas_pagamento->descricao->EditValue ?>"<?php echo $formas_pagamento->descricao->editAttributes() ?>>
</span>
<?php echo $formas_pagamento->descricao->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$formas_pagamento_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $formas_pagamento_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $formas_pagamento_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$formas_pagamento_add->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$formas_pagamento_add->terminate();
?>