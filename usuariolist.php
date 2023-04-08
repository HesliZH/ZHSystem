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
$usuario_list = new usuario_list();

// Run the page
$usuario_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$usuario_list->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if (!$usuario->isExport()) { ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "list";
var fusuariolist = currentForm = new ew.Form("fusuariolist", "list");
fusuariolist.formKeyCountName = '<?php echo $usuario_list->FormKeyCountName ?>';

// Form_CustomValidate event
fusuariolist.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fusuariolist.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
fusuariolist.lists["x_ativo[]"] = <?php echo $usuario_list->ativo->Lookup->toClientList() ?>;
fusuariolist.lists["x_ativo[]"].options = <?php echo JsonEncode($usuario_list->ativo->options(FALSE, TRUE)) ?>;

// Form object for search
var fusuariolistsrch = currentSearchForm = new ew.Form("fusuariolistsrch");

// Filters
fusuariolistsrch.filterList = <?php echo $usuario_list->getFilterList() ?>;
</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php } ?>
<?php if (!$usuario->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($usuario_list->TotalRecs > 0 && $usuario_list->ExportOptions->visible()) { ?>
<?php $usuario_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($usuario_list->ImportOptions->visible()) { ?>
<?php $usuario_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($usuario_list->SearchOptions->visible()) { ?>
<?php $usuario_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($usuario_list->FilterOptions->visible()) { ?>
<?php $usuario_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$usuario_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$usuario->isExport() && !$usuario->CurrentAction) { ?>
<form name="fusuariolistsrch" id="fusuariolistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<?php $searchPanelClass = ($usuario_list->SearchWhere <> "") ? " show" : " show"; ?>
<div id="fusuariolistsrch-search-panel" class="ew-search-panel collapse<?php echo $searchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="usuario">
	<div class="ew-basic-search">
<div id="xsr_1" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo TABLE_BASIC_SEARCH ?>" id="<?php echo TABLE_BASIC_SEARCH ?>" class="form-control" value="<?php echo HtmlEncode($usuario_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo TABLE_BASIC_SEARCH_TYPE ?>" value="<?php echo HtmlEncode($usuario_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $usuario_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($usuario_list->BasicSearch->getType() == "") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this)"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($usuario_list->BasicSearch->getType() == "=") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'=')"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($usuario_list->BasicSearch->getType() == "AND") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'AND')"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($usuario_list->BasicSearch->getType() == "OR") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'OR')"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div>
</div>
</form>
<?php } ?>
<?php } ?>
<?php $usuario_list->showPageHeader(); ?>
<?php
$usuario_list->showMessage();
?>
<?php if ($usuario_list->TotalRecs > 0 || $usuario->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($usuario_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> usuario">
<form name="fusuariolist" id="fusuariolist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($usuario_list->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $usuario_list->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="usuario">
<div id="gmp_usuario" class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel">
<?php if ($usuario_list->TotalRecs > 0 || $usuario->isGridEdit()) { ?>
<table id="tbl_usuariolist" class="table ew-table"><!-- .ew-table ##-->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$usuario_list->RowType = ROWTYPE_HEADER;

// Render list options
$usuario_list->renderListOptions();

// Render list options (header, left)
$usuario_list->ListOptions->render("header", "left");
?>
<?php if ($usuario->id->Visible) { // id ?>
	<?php if ($usuario->sortUrl($usuario->id) == "") { ?>
		<th data-name="id" class="<?php echo $usuario->id->headerCellClass() ?>"><div id="elh_usuario_id" class="usuario_id"><div class="ew-table-header-caption"><?php echo $usuario->id->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id" class="<?php echo $usuario->id->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $usuario->SortUrl($usuario->id) ?>',1);"><div id="elh_usuario_id" class="usuario_id">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $usuario->id->caption() ?></span><span class="ew-table-header-sort"><?php if ($usuario->id->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($usuario->id->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($usuario->nome_completo->Visible) { // nome_completo ?>
	<?php if ($usuario->sortUrl($usuario->nome_completo) == "") { ?>
		<th data-name="nome_completo" class="<?php echo $usuario->nome_completo->headerCellClass() ?>"><div id="elh_usuario_nome_completo" class="usuario_nome_completo"><div class="ew-table-header-caption"><?php echo $usuario->nome_completo->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="nome_completo" class="<?php echo $usuario->nome_completo->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $usuario->SortUrl($usuario->nome_completo) ?>',1);"><div id="elh_usuario_nome_completo" class="usuario_nome_completo">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $usuario->nome_completo->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($usuario->nome_completo->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($usuario->nome_completo->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($usuario->login_acesso->Visible) { // login_acesso ?>
	<?php if ($usuario->sortUrl($usuario->login_acesso) == "") { ?>
		<th data-name="login_acesso" class="<?php echo $usuario->login_acesso->headerCellClass() ?>"><div id="elh_usuario_login_acesso" class="usuario_login_acesso"><div class="ew-table-header-caption"><?php echo $usuario->login_acesso->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="login_acesso" class="<?php echo $usuario->login_acesso->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $usuario->SortUrl($usuario->login_acesso) ?>',1);"><div id="elh_usuario_login_acesso" class="usuario_login_acesso">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $usuario->login_acesso->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($usuario->login_acesso->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($usuario->login_acesso->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($usuario->_email->Visible) { // email ?>
	<?php if ($usuario->sortUrl($usuario->_email) == "") { ?>
		<th data-name="_email" class="<?php echo $usuario->_email->headerCellClass() ?>"><div id="elh_usuario__email" class="usuario__email"><div class="ew-table-header-caption"><?php echo $usuario->_email->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="_email" class="<?php echo $usuario->_email->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $usuario->SortUrl($usuario->_email) ?>',1);"><div id="elh_usuario__email" class="usuario__email">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $usuario->_email->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($usuario->_email->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($usuario->_email->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($usuario->senha_acesso->Visible) { // senha_acesso ?>
	<?php if ($usuario->sortUrl($usuario->senha_acesso) == "") { ?>
		<th data-name="senha_acesso" class="<?php echo $usuario->senha_acesso->headerCellClass() ?>"><div id="elh_usuario_senha_acesso" class="usuario_senha_acesso"><div class="ew-table-header-caption"><?php echo $usuario->senha_acesso->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="senha_acesso" class="<?php echo $usuario->senha_acesso->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $usuario->SortUrl($usuario->senha_acesso) ?>',1);"><div id="elh_usuario_senha_acesso" class="usuario_senha_acesso">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $usuario->senha_acesso->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($usuario->senha_acesso->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($usuario->senha_acesso->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($usuario->ativo->Visible) { // ativo ?>
	<?php if ($usuario->sortUrl($usuario->ativo) == "") { ?>
		<th data-name="ativo" class="<?php echo $usuario->ativo->headerCellClass() ?>"><div id="elh_usuario_ativo" class="usuario_ativo"><div class="ew-table-header-caption"><?php echo $usuario->ativo->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ativo" class="<?php echo $usuario->ativo->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $usuario->SortUrl($usuario->ativo) ?>',1);"><div id="elh_usuario_ativo" class="usuario_ativo">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $usuario->ativo->caption() ?></span><span class="ew-table-header-sort"><?php if ($usuario->ativo->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($usuario->ativo->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$usuario_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($usuario->ExportAll && $usuario->isExport()) {
	$usuario_list->StopRec = $usuario_list->TotalRecs;
} else {

	// Set the last record to display
	if ($usuario_list->TotalRecs > $usuario_list->StartRec + $usuario_list->DisplayRecs - 1)
		$usuario_list->StopRec = $usuario_list->StartRec + $usuario_list->DisplayRecs - 1;
	else
		$usuario_list->StopRec = $usuario_list->TotalRecs;
}
$usuario_list->RecCnt = $usuario_list->StartRec - 1;
if ($usuario_list->Recordset && !$usuario_list->Recordset->EOF) {
	$usuario_list->Recordset->moveFirst();
	$selectLimit = $usuario_list->UseSelectLimit;
	if (!$selectLimit && $usuario_list->StartRec > 1)
		$usuario_list->Recordset->move($usuario_list->StartRec - 1);
} elseif (!$usuario->AllowAddDeleteRow && $usuario_list->StopRec == 0) {
	$usuario_list->StopRec = $usuario->GridAddRowCount;
}

// Initialize aggregate
$usuario->RowType = ROWTYPE_AGGREGATEINIT;
$usuario->resetAttributes();
$usuario_list->renderRow();
while ($usuario_list->RecCnt < $usuario_list->StopRec) {
	$usuario_list->RecCnt++;
	if ($usuario_list->RecCnt >= $usuario_list->StartRec) {
		$usuario_list->RowCnt++;

		// Set up key count
		$usuario_list->KeyCount = $usuario_list->RowIndex;

		// Init row class and style
		$usuario->resetAttributes();
		$usuario->CssClass = "";
		if ($usuario->isGridAdd()) {
		} else {
			$usuario_list->loadRowValues($usuario_list->Recordset); // Load row values
		}
		$usuario->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$usuario->RowAttrs = array_merge($usuario->RowAttrs, array('data-rowindex'=>$usuario_list->RowCnt, 'id'=>'r' . $usuario_list->RowCnt . '_usuario', 'data-rowtype'=>$usuario->RowType));

		// Render row
		$usuario_list->renderRow();

		// Render list options
		$usuario_list->renderListOptions();
?>
	<tr<?php echo $usuario->rowAttributes() ?>>
<?php

// Render list options (body, left)
$usuario_list->ListOptions->render("body", "left", $usuario_list->RowCnt);
?>
	<?php if ($usuario->id->Visible) { // id ?>
		<td data-name="id"<?php echo $usuario->id->cellAttributes() ?>>
<span id="el<?php echo $usuario_list->RowCnt ?>_usuario_id" class="usuario_id">
<span<?php echo $usuario->id->viewAttributes() ?>>
<?php echo $usuario->id->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($usuario->nome_completo->Visible) { // nome_completo ?>
		<td data-name="nome_completo"<?php echo $usuario->nome_completo->cellAttributes() ?>>
<span id="el<?php echo $usuario_list->RowCnt ?>_usuario_nome_completo" class="usuario_nome_completo">
<span<?php echo $usuario->nome_completo->viewAttributes() ?>>
<?php echo $usuario->nome_completo->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($usuario->login_acesso->Visible) { // login_acesso ?>
		<td data-name="login_acesso"<?php echo $usuario->login_acesso->cellAttributes() ?>>
<span id="el<?php echo $usuario_list->RowCnt ?>_usuario_login_acesso" class="usuario_login_acesso">
<span<?php echo $usuario->login_acesso->viewAttributes() ?>>
<?php echo $usuario->login_acesso->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($usuario->_email->Visible) { // email ?>
		<td data-name="_email"<?php echo $usuario->_email->cellAttributes() ?>>
<span id="el<?php echo $usuario_list->RowCnt ?>_usuario__email" class="usuario__email">
<span<?php echo $usuario->_email->viewAttributes() ?>>
<?php echo $usuario->_email->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($usuario->senha_acesso->Visible) { // senha_acesso ?>
		<td data-name="senha_acesso"<?php echo $usuario->senha_acesso->cellAttributes() ?>>
<span id="el<?php echo $usuario_list->RowCnt ?>_usuario_senha_acesso" class="usuario_senha_acesso">
<span<?php echo $usuario->senha_acesso->viewAttributes() ?>>
<?php echo $usuario->senha_acesso->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($usuario->ativo->Visible) { // ativo ?>
		<td data-name="ativo"<?php echo $usuario->ativo->cellAttributes() ?>>
<span id="el<?php echo $usuario_list->RowCnt ?>_usuario_ativo" class="usuario_ativo">
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
<?php

// Render list options (body, right)
$usuario_list->ListOptions->render("body", "right", $usuario_list->RowCnt);
?>
	</tr>
<?php
	}
	if (!$usuario->isGridAdd())
		$usuario_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
<?php if (!$usuario->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($usuario_list->Recordset)
	$usuario_list->Recordset->Close();
?>
<?php if (!$usuario->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$usuario->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($usuario_list->Pager)) $usuario_list->Pager = new PrevNextPager($usuario_list->StartRec, $usuario_list->DisplayRecs, $usuario_list->TotalRecs, $usuario_list->AutoHidePager) ?>
<?php if ($usuario_list->Pager->RecordCount > 0 && $usuario_list->Pager->Visible) { ?>
<div class="ew-pager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ew-prev-next"><div class="input-group input-group-sm">
<div class="input-group-prepend">
<!-- first page button -->
	<?php if ($usuario_list->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerFirst") ?>" href="<?php echo $usuario_list->pageUrl() ?>start=<?php echo $usuario_list->Pager->FirstButton->Start ?>"><i class="icon-first ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerFirst") ?>"><i class="icon-first ew-icon"></i></a>
	<?php } ?>
<!-- previous page button -->
	<?php if ($usuario_list->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerPrevious") ?>" href="<?php echo $usuario_list->pageUrl() ?>start=<?php echo $usuario_list->Pager->PrevButton->Start ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerPrevious") ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } ?>
</div>
<!-- current page number -->
	<input class="form-control" type="text" name="<?php echo TABLE_PAGE_NO ?>" value="<?php echo $usuario_list->Pager->CurrentPage ?>">
<div class="input-group-append">
<!-- next page button -->
	<?php if ($usuario_list->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerNext") ?>" href="<?php echo $usuario_list->pageUrl() ?>start=<?php echo $usuario_list->Pager->NextButton->Start ?>"><i class="icon-next ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerNext") ?>"><i class="icon-next ew-icon"></i></a>
	<?php } ?>
<!-- last page button -->
	<?php if ($usuario_list->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerLast") ?>" href="<?php echo $usuario_list->pageUrl() ?>start=<?php echo $usuario_list->Pager->LastButton->Start ?>"><i class="icon-last ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerLast") ?>"><i class="icon-last ew-icon"></i></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $usuario_list->Pager->PageCount ?></span>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if ($usuario_list->Pager->RecordCount > 0) { ?>
<div class="ew-pager ew-rec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $usuario_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $usuario_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $usuario_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $usuario_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($usuario_list->TotalRecs == 0 && !$usuario->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $usuario_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$usuario_list->showPageFooter();
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
$usuario_list->terminate();
?>