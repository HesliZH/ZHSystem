<?php
namespace PHPMaker2019\ZH2019;

// Menu Language
if ($Language && $Language->LanguageFolder == $LANGUAGE_FOLDER)
	$MenuLanguage = &$Language;
else
	$MenuLanguage = new Language();

// Navbar menu
$topMenu = new Menu("navbar", TRUE, TRUE);
echo $topMenu->toScript();

// Sidebar menu
$sideMenu = new Menu("menu", TRUE, FALSE);
$sideMenu->addMenuItem(1, "mi_contas_pagar_pagamentos", $MenuLanguage->MenuPhrase("1", "MenuText"), "contas_pagar_pagamentoslist.php", -1, "", IsLoggedIn() || AllowListMenu('{82ACBA82-232B-41B1-A528-4DD4CC852004}contas_pagar_pagamentos'), FALSE, FALSE, "", "", FALSE);
$sideMenu->addMenuItem(2, "mi_bens", $MenuLanguage->MenuPhrase("2", "MenuText"), "benslist.php", -1, "", IsLoggedIn() || AllowListMenu('{82ACBA82-232B-41B1-A528-4DD4CC852004}bens'), FALSE, FALSE, "", "", FALSE);
$sideMenu->addMenuItem(3, "mi_contas_correntes", $MenuLanguage->MenuPhrase("3", "MenuText"), "contas_correnteslist.php", -1, "", IsLoggedIn() || AllowListMenu('{82ACBA82-232B-41B1-A528-4DD4CC852004}contas_correntes'), FALSE, FALSE, "", "", FALSE);
$sideMenu->addMenuItem(4, "mi_compras", $MenuLanguage->MenuPhrase("4", "MenuText"), "compraslist.php", -1, "", IsLoggedIn() || AllowListMenu('{82ACBA82-232B-41B1-A528-4DD4CC852004}compras'), FALSE, FALSE, "", "", FALSE);
$sideMenu->addMenuItem(5, "mi_fornecedores", $MenuLanguage->MenuPhrase("5", "MenuText"), "fornecedoreslist.php", -1, "", IsLoggedIn() || AllowListMenu('{82ACBA82-232B-41B1-A528-4DD4CC852004}fornecedores'), FALSE, FALSE, "", "", FALSE);
$sideMenu->addMenuItem(6, "mi_usuario", $MenuLanguage->MenuPhrase("6", "MenuText"), "usuariolist.php", -1, "", IsLoggedIn() || AllowListMenu('{82ACBA82-232B-41B1-A528-4DD4CC852004}usuario'), FALSE, FALSE, "", "", FALSE);
$sideMenu->addMenuItem(7, "mi_contas_pagar", $MenuLanguage->MenuPhrase("7", "MenuText"), "contas_pagarlist.php", -1, "", IsLoggedIn() || AllowListMenu('{82ACBA82-232B-41B1-A528-4DD4CC852004}contas_pagar'), FALSE, FALSE, "", "", FALSE);
$sideMenu->addMenuItem(8, "mi_formas_pagamento", $MenuLanguage->MenuPhrase("8", "MenuText"), "formas_pagamentolist.php", -1, "", IsLoggedIn() || AllowListMenu('{82ACBA82-232B-41B1-A528-4DD4CC852004}formas_pagamento'), FALSE, FALSE, "", "", FALSE);
$sideMenu->addMenuItem(9, "mi_localizacao", $MenuLanguage->MenuPhrase("9", "MenuText"), "localizacaolist.php", -1, "", IsLoggedIn() || AllowListMenu('{82ACBA82-232B-41B1-A528-4DD4CC852004}localizacao'), FALSE, FALSE, "", "", FALSE);
$sideMenu->addMenuItem(10, "mi_compras_itens", $MenuLanguage->MenuPhrase("10", "MenuText"), "compras_itenslist.php", -1, "", IsLoggedIn() || AllowListMenu('{82ACBA82-232B-41B1-A528-4DD4CC852004}compras_itens'), FALSE, FALSE, "", "", FALSE);
$sideMenu->addMenuItem(11, "mi_contas_correntes_movimento", $MenuLanguage->MenuPhrase("11", "MenuText"), "contas_correntes_movimentolist.php", -1, "", IsLoggedIn() || AllowListMenu('{82ACBA82-232B-41B1-A528-4DD4CC852004}contas_correntes_movimento'), FALSE, FALSE, "", "", FALSE);
$sideMenu->addMenuItem(12, "mi_item", $MenuLanguage->MenuPhrase("12", "MenuText"), "itemlist.php", -1, "", IsLoggedIn() || AllowListMenu('{82ACBA82-232B-41B1-A528-4DD4CC852004}item'), FALSE, FALSE, "", "", FALSE);
echo $sideMenu->toScript();
?>