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
$usuario_add = new usuario_add();

// Run the page
$usuario_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$usuario_add->Page_Render();
?>
<?php include_once "header.php" ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "add";
var fusuarioadd = currentForm = new ew.Form("fusuarioadd", "add");

// Validate form
fusuarioadd.validate = function() {
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
		<?php if ($usuario_add->nome_completo->Required) { ?>
			elm = this.getElements("x" + infix + "_nome_completo");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $usuario->nome_completo->caption(), $usuario->nome_completo->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($usuario_add->login_acesso->Required) { ?>
			elm = this.getElements("x" + infix + "_login_acesso");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $usuario->login_acesso->caption(), $usuario->login_acesso->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($usuario_add->_email->Required) { ?>
			elm = this.getElements("x" + infix + "__email");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $usuario->_email->caption(), $usuario->_email->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($usuario_add->senha_acesso->Required) { ?>
			elm = this.getElements("x" + infix + "_senha_acesso");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $usuario->senha_acesso->caption(), $usuario->senha_acesso->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($usuario_add->ativo->Required) { ?>
			elm = this.getElements("x" + infix + "_ativo[]");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $usuario->ativo->caption(), $usuario->ativo->RequiredErrorMessage)) ?>");
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
fusuarioadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fusuarioadd.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
fusuarioadd.lists["x_ativo[]"] = <?php echo $usuario_add->ativo->Lookup->toClientList() ?>;
fusuarioadd.lists["x_ativo[]"].options = <?php echo JsonEncode($usuario_add->ativo->options(FALSE, TRUE)) ?>;

// Form object for search
</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php $usuario_add->showPageHeader(); ?>
<?php
$usuario_add->showMessage();
?>
<form name="fusuarioadd" id="fusuarioadd" class="<?php echo $usuario_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($usuario_add->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $usuario_add->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="usuario">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$usuario_add->IsModal ?>">
<!-- Fields to prevent google autofill -->
<input class="d-none" type="text" name="<?php echo Encrypt(Random()) ?>">
<input class="d-none" type="password" name="<?php echo Encrypt(Random()) ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($usuario->nome_completo->Visible) { // nome_completo ?>
	<div id="r_nome_completo" class="form-group row">
		<label id="elh_usuario_nome_completo" for="x_nome_completo" class="<?php echo $usuario_add->LeftColumnClass ?>"><?php echo $usuario->nome_completo->caption() ?><?php echo ($usuario->nome_completo->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $usuario_add->RightColumnClass ?>"><div<?php echo $usuario->nome_completo->cellAttributes() ?>>
<span id="el_usuario_nome_completo">
<input type="text" data-table="usuario" data-field="x_nome_completo" name="x_nome_completo" id="x_nome_completo" size="30" maxlength="90" placeholder="<?php echo HtmlEncode($usuario->nome_completo->getPlaceHolder()) ?>" value="<?php echo $usuario->nome_completo->EditValue ?>"<?php echo $usuario->nome_completo->editAttributes() ?>>
</span>
<?php echo $usuario->nome_completo->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($usuario->login_acesso->Visible) { // login_acesso ?>
	<div id="r_login_acesso" class="form-group row">
		<label id="elh_usuario_login_acesso" for="x_login_acesso" class="<?php echo $usuario_add->LeftColumnClass ?>"><?php echo $usuario->login_acesso->caption() ?><?php echo ($usuario->login_acesso->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $usuario_add->RightColumnClass ?>"><div<?php echo $usuario->login_acesso->cellAttributes() ?>>
<span id="el_usuario_login_acesso">
<input type="text" data-table="usuario" data-field="x_login_acesso" name="x_login_acesso" id="x_login_acesso" size="30" maxlength="90" placeholder="<?php echo HtmlEncode($usuario->login_acesso->getPlaceHolder()) ?>" value="<?php echo $usuario->login_acesso->EditValue ?>"<?php echo $usuario->login_acesso->editAttributes() ?>>
</span>
<?php echo $usuario->login_acesso->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($usuario->_email->Visible) { // email ?>
	<div id="r__email" class="form-group row">
		<label id="elh_usuario__email" for="x__email" class="<?php echo $usuario_add->LeftColumnClass ?>"><?php echo $usuario->_email->caption() ?><?php echo ($usuario->_email->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $usuario_add->RightColumnClass ?>"><div<?php echo $usuario->_email->cellAttributes() ?>>
<span id="el_usuario__email">
<input type="text" data-table="usuario" data-field="x__email" name="x__email" id="x__email" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($usuario->_email->getPlaceHolder()) ?>" value="<?php echo $usuario->_email->EditValue ?>"<?php echo $usuario->_email->editAttributes() ?>>
</span>
<?php echo $usuario->_email->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($usuario->senha_acesso->Visible) { // senha_acesso ?>
	<div id="r_senha_acesso" class="form-group row">
		<label id="elh_usuario_senha_acesso" for="x_senha_acesso" class="<?php echo $usuario_add->LeftColumnClass ?>"><?php echo $usuario->senha_acesso->caption() ?><?php echo ($usuario->senha_acesso->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $usuario_add->RightColumnClass ?>"><div<?php echo $usuario->senha_acesso->cellAttributes() ?>>
<span id="el_usuario_senha_acesso">
<input type="text" data-table="usuario" data-field="x_senha_acesso" name="x_senha_acesso" id="x_senha_acesso" size="30" maxlength="150" placeholder="<?php echo HtmlEncode($usuario->senha_acesso->getPlaceHolder()) ?>" value="<?php echo $usuario->senha_acesso->EditValue ?>"<?php echo $usuario->senha_acesso->editAttributes() ?>>
</span>
<?php echo $usuario->senha_acesso->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($usuario->ativo->Visible) { // ativo ?>
	<div id="r_ativo" class="form-group row">
		<label id="elh_usuario_ativo" class="<?php echo $usuario_add->LeftColumnClass ?>"><?php echo $usuario->ativo->caption() ?><?php echo ($usuario->ativo->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $usuario_add->RightColumnClass ?>"><div<?php echo $usuario->ativo->cellAttributes() ?>>
<span id="el_usuario_ativo">
<?php
$selwrk = (ConvertToBool($usuario->ativo->CurrentValue)) ? " checked" : "";
?>
<input type="checkbox" data-table="usuario" data-field="x_ativo" name="x_ativo[]" id="x_ativo[]" value="1"<?php echo $selwrk ?><?php echo $usuario->ativo->editAttributes() ?>>
</span>
<?php echo $usuario->ativo->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$usuario_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $usuario_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $usuario_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$usuario_add->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$usuario_add->terminate();
?>