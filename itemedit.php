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
$item_edit = new item_edit();

// Run the page
$item_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$item_edit->Page_Render();
?>
<?php include_once "header.php" ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "edit";
var fitemedit = currentForm = new ew.Form("fitemedit", "edit");

// Validate form
fitemedit.validate = function() {
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
		<?php if ($item_edit->id->Required) { ?>
			elm = this.getElements("x" + infix + "_id");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $item->id->caption(), $item->id->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($item_edit->descricao->Required) { ?>
			elm = this.getElements("x" + infix + "_descricao");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $item->descricao->caption(), $item->descricao->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($item_edit->ativo->Required) { ?>
			elm = this.getElements("x" + infix + "_ativo[]");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $item->ativo->caption(), $item->ativo->RequiredErrorMessage)) ?>");
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
fitemedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fitemedit.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
fitemedit.lists["x_ativo[]"] = <?php echo $item_edit->ativo->Lookup->toClientList() ?>;
fitemedit.lists["x_ativo[]"].options = <?php echo JsonEncode($item_edit->ativo->options(FALSE, TRUE)) ?>;

// Form object for search
</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php $item_edit->showPageHeader(); ?>
<?php
$item_edit->showMessage();
?>
<form name="fitemedit" id="fitemedit" class="<?php echo $item_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($item_edit->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $item_edit->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="item">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$item_edit->IsModal ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($item->id->Visible) { // id ?>
	<div id="r_id" class="form-group row">
		<label id="elh_item_id" class="<?php echo $item_edit->LeftColumnClass ?>"><?php echo $item->id->caption() ?><?php echo ($item->id->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $item_edit->RightColumnClass ?>"><div<?php echo $item->id->cellAttributes() ?>>
<span id="el_item_id">
<span<?php echo $item->id->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($item->id->EditValue) ?>"></span>
</span>
<input type="hidden" data-table="item" data-field="x_id" name="x_id" id="x_id" value="<?php echo HtmlEncode($item->id->CurrentValue) ?>">
<?php echo $item->id->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($item->descricao->Visible) { // descricao ?>
	<div id="r_descricao" class="form-group row">
		<label id="elh_item_descricao" for="x_descricao" class="<?php echo $item_edit->LeftColumnClass ?>"><?php echo $item->descricao->caption() ?><?php echo ($item->descricao->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $item_edit->RightColumnClass ?>"><div<?php echo $item->descricao->cellAttributes() ?>>
<span id="el_item_descricao">
<input type="text" data-table="item" data-field="x_descricao" name="x_descricao" id="x_descricao" size="30" maxlength="60" placeholder="<?php echo HtmlEncode($item->descricao->getPlaceHolder()) ?>" value="<?php echo $item->descricao->EditValue ?>"<?php echo $item->descricao->editAttributes() ?>>
</span>
<?php echo $item->descricao->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($item->ativo->Visible) { // ativo ?>
	<div id="r_ativo" class="form-group row">
		<label id="elh_item_ativo" class="<?php echo $item_edit->LeftColumnClass ?>"><?php echo $item->ativo->caption() ?><?php echo ($item->ativo->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $item_edit->RightColumnClass ?>"><div<?php echo $item->ativo->cellAttributes() ?>>
<span id="el_item_ativo">
<?php
$selwrk = (ConvertToBool($item->ativo->CurrentValue)) ? " checked" : "";
?>
<input type="checkbox" data-table="item" data-field="x_ativo" name="x_ativo[]" id="x_ativo[]" value="1"<?php echo $selwrk ?><?php echo $item->ativo->editAttributes() ?>>
</span>
<?php echo $item->ativo->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$item_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $item_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $item_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$item_edit->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$item_edit->terminate();
?>