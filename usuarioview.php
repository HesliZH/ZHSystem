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
$usuario_view = new usuario_view();

// Run the page
$usuario_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$usuario_view->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if (!$usuario->isExport()) { ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "view";
var fusuarioview = currentForm = new ew.Form("fusuarioview", "view");

// Form_CustomValidate event
fusuarioview.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fusuarioview.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
fusuarioview.lists["x_ativo[]"] = <?php echo $usuario_view->ativo->Lookup->toClientList() ?>;
fusuarioview.lists["x_ativo[]"].options = <?php echo JsonEncode($usuario_view->ativo->options(FALSE, TRUE)) ?>;

// Form object for search
</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php } ?>
<?php if (!$usuario->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $usuario_view->ExportOptions->render("body") ?>
<?php $usuario_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $usuario_view->showPageHeader(); ?>
<?php
$usuario_view->showMessage();
?>
<form name="fusuarioview" id="fusuarioview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($usuario_view->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $usuario_view->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="usuario">
<input type="hidden" name="modal" value="<?php echo (int)$usuario_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($usuario->id->Visible) { // id ?>
	<tr id="r_id">
		<td class="<?php echo $usuario_view->TableLeftColumnClass ?>"><span id="elh_usuario_id"><?php echo $usuario->id->caption() ?></span></td>
		<td data-name="id"<?php echo $usuario->id->cellAttributes() ?>>
<span id="el_usuario_id">
<span<?php echo $usuario->id->viewAttributes() ?>>
<?php echo $usuario->id->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($usuario->nome_completo->Visible) { // nome_completo ?>
	<tr id="r_nome_completo">
		<td class="<?php echo $usuario_view->TableLeftColumnClass ?>"><span id="elh_usuario_nome_completo"><?php echo $usuario->nome_completo->caption() ?></span></td>
		<td data-name="nome_completo"<?php echo $usuario->nome_completo->cellAttributes() ?>>
<span id="el_usuario_nome_completo">
<span<?php echo $usuario->nome_completo->viewAttributes() ?>>
<?php echo $usuario->nome_completo->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($usuario->login_acesso->Visible) { // login_acesso ?>
	<tr id="r_login_acesso">
		<td class="<?php echo $usuario_view->TableLeftColumnClass ?>"><span id="elh_usuario_login_acesso"><?php echo $usuario->login_acesso->caption() ?></span></td>
		<td data-name="login_acesso"<?php echo $usuario->login_acesso->cellAttributes() ?>>
<span id="el_usuario_login_acesso">
<span<?php echo $usuario->login_acesso->viewAttributes() ?>>
<?php echo $usuario->login_acesso->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($usuario->_email->Visible) { // email ?>
	<tr id="r__email">
		<td class="<?php echo $usuario_view->TableLeftColumnClass ?>"><span id="elh_usuario__email"><?php echo $usuario->_email->caption() ?></span></td>
		<td data-name="_email"<?php echo $usuario->_email->cellAttributes() ?>>
<span id="el_usuario__email">
<span<?php echo $usuario->_email->viewAttributes() ?>>
<?php echo $usuario->_email->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($usuario->senha_acesso->Visible) { // senha_acesso ?>
	<tr id="r_senha_acesso">
		<td class="<?php echo $usuario_view->TableLeftColumnClass ?>"><span id="elh_usuario_senha_acesso"><?php echo $usuario->senha_acesso->caption() ?></span></td>
		<td data-name="senha_acesso"<?php echo $usuario->senha_acesso->cellAttributes() ?>>
<span id="el_usuario_senha_acesso">
<span<?php echo $usuario->senha_acesso->viewAttributes() ?>>
<?php echo $usuario->senha_acesso->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($usuario->ativo->Visible) { // ativo ?>
	<tr id="r_ativo">
		<td class="<?php echo $usuario_view->TableLeftColumnClass ?>"><span id="elh_usuario_ativo"><?php echo $usuario->ativo->caption() ?></span></td>
		<td data-name="ativo"<?php echo $usuario->ativo->cellAttributes() ?>>
<span id="el_usuario_ativo">
<span<?php echo $usuario->ativo->viewAttributes() ?>>
<?php if (ConvertToBool($usuario->ativo->CurrentValue)) { ?>
<input type="checkbox" value="<?php echo $usuario->ativo->getViewValue() ?>" disabled checked>
<?php } else { ?>
<input type="checkbox" value="<?php echo $usuario->ativo->getViewValue() ?>" disabled>
<?php } ?>
</span>
</span>
</td>
	</tr>
<?php } ?>
</table>
</form>
<?php
$usuario_view->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<?php if (!$usuario->isExport()) { ?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$usuario_view->terminate();
?>