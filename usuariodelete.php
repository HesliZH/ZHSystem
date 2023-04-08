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
$usuario_delete = new usuario_delete();

// Run the page
$usuario_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$usuario_delete->Page_Render();
?>
<?php include_once "header.php" ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "delete";
var fusuariodelete = currentForm = new ew.Form("fusuariodelete", "delete");

// Form_CustomValidate event
fusuariodelete.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fusuariodelete.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
fusuariodelete.lists["x_ativo[]"] = <?php echo $usuario_delete->ativo->Lookup->toClientList() ?>;
fusuariodelete.lists["x_ativo[]"].options = <?php echo JsonEncode($usuario_delete->ativo->options(FALSE, TRUE)) ?>;

// Form object for search
</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php $usuario_delete->showPageHeader(); ?>
<?php
$usuario_delete->showMessage();
?>
<form name="fusuariodelete" id="fusuariodelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($usuario_delete->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $usuario_delete->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="usuario">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($usuario_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode($COMPOSITE_KEY_SEPARATOR, $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($usuario->id->Visible) { // id ?>
		<th class="<?php echo $usuario->id->headerCellClass() ?>"><span id="elh_usuario_id" class="usuario_id"><?php echo $usuario->id->caption() ?></span></th>
<?php } ?>
<?php if ($usuario->nome_completo->Visible) { // nome_completo ?>
		<th class="<?php echo $usuario->nome_completo->headerCellClass() ?>"><span id="elh_usuario_nome_completo" class="usuario_nome_completo"><?php echo $usuario->nome_completo->caption() ?></span></th>
<?php } ?>
<?php if ($usuario->login_acesso->Visible) { // login_acesso ?>
		<th class="<?php echo $usuario->login_acesso->headerCellClass() ?>"><span id="elh_usuario_login_acesso" class="usuario_login_acesso"><?php echo $usuario->login_acesso->caption() ?></span></th>
<?php } ?>
<?php if ($usuario->_email->Visible) { // email ?>
		<th class="<?php echo $usuario->_email->headerCellClass() ?>"><span id="elh_usuario__email" class="usuario__email"><?php echo $usuario->_email->caption() ?></span></th>
<?php } ?>
<?php if ($usuario->senha_acesso->Visible) { // senha_acesso ?>
		<th class="<?php echo $usuario->senha_acesso->headerCellClass() ?>"><span id="elh_usuario_senha_acesso" class="usuario_senha_acesso"><?php echo $usuario->senha_acesso->caption() ?></span></th>
<?php } ?>
<?php if ($usuario->ativo->Visible) { // ativo ?>
		<th class="<?php echo $usuario->ativo->headerCellClass() ?>"><span id="elh_usuario_ativo" class="usuario_ativo"><?php echo $usuario->ativo->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$usuario_delete->RecCnt = 0;
$i = 0;
while (!$usuario_delete->Recordset->EOF) {
	$usuario_delete->RecCnt++;
	$usuario_delete->RowCnt++;

	// Set row properties
	$usuario->resetAttributes();
	$usuario->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$usuario_delete->loadRowValues($usuario_delete->Recordset);

	// Render row
	$usuario_delete->renderRow();
?>
	<tr<?php echo $usuario->rowAttributes() ?>>
<?php if ($usuario->id->Visible) { // id ?>
		<td<?php echo $usuario->id->cellAttributes() ?>>
<span id="el<?php echo $usuario_delete->RowCnt ?>_usuario_id" class="usuario_id">
<span<?php echo $usuario->id->viewAttributes() ?>>
<?php echo $usuario->id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($usuario->nome_completo->Visible) { // nome_completo ?>
		<td<?php echo $usuario->nome_completo->cellAttributes() ?>>
<span id="el<?php echo $usuario_delete->RowCnt ?>_usuario_nome_completo" class="usuario_nome_completo">
<span<?php echo $usuario->nome_completo->viewAttributes() ?>>
<?php echo $usuario->nome_completo->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($usuario->login_acesso->Visible) { // login_acesso ?>
		<td<?php echo $usuario->login_acesso->cellAttributes() ?>>
<span id="el<?php echo $usuario_delete->RowCnt ?>_usuario_login_acesso" class="usuario_login_acesso">
<span<?php echo $usuario->login_acesso->viewAttributes() ?>>
<?php echo $usuario->login_acesso->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($usuario->_email->Visible) { // email ?>
		<td<?php echo $usuario->_email->cellAttributes() ?>>
<span id="el<?php echo $usuario_delete->RowCnt ?>_usuario__email" class="usuario__email">
<span<?php echo $usuario->_email->viewAttributes() ?>>
<?php echo $usuario->_email->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($usuario->senha_acesso->Visible) { // senha_acesso ?>
		<td<?php echo $usuario->senha_acesso->cellAttributes() ?>>
<span id="el<?php echo $usuario_delete->RowCnt ?>_usuario_senha_acesso" class="usuario_senha_acesso">
<span<?php echo $usuario->senha_acesso->viewAttributes() ?>>
<?php echo $usuario->senha_acesso->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($usuario->ativo->Visible) { // ativo ?>
		<td<?php echo $usuario->ativo->cellAttributes() ?>>
<span id="el<?php echo $usuario_delete->RowCnt ?>_usuario_ativo" class="usuario_ativo">
<span<?php echo $usuario->ativo->viewAttributes() ?>>
<?php if (ConvertToBool($usuario->ativo->CurrentValue)) { ?>
<input type="checkbox" value="<?php echo $usuario->ativo->getViewValue() ?>" disabled checked>
<?php } else { ?>
<input type="checkbox" value="<?php echo $usuario->ativo->getViewValue() ?>" disabled>
<?php } ?>
</span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$usuario_delete->Recordset->moveNext();
}
$usuario_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $usuario_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$usuario_delete->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$usuario_delete->terminate();
?>