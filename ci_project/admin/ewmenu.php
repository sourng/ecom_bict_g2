<?php

// Menu
$RootMenu = new cMenu("RootMenu", TRUE);
$RootMenu->AddMenuItem(1, "mi_slide", $Language->MenuPhrase("1", "MenuText"), "slidelist.php", -1, "", IsLoggedIn() || AllowListMenu('{6AF8C2FF-A16C-4050-9229-E3A572D6C974}slide'), FALSE, FALSE, "");
$RootMenu->AddMenuItem(2, "mi_tbl_brand", $Language->MenuPhrase("2", "MenuText"), "tbl_brandlist.php", -1, "", IsLoggedIn() || AllowListMenu('{6AF8C2FF-A16C-4050-9229-E3A572D6C974}tbl_brand'), FALSE, FALSE, "");
$RootMenu->AddMenuItem(3, "mi_tbl_cart", $Language->MenuPhrase("3", "MenuText"), "tbl_cartlist.php", -1, "", IsLoggedIn() || AllowListMenu('{6AF8C2FF-A16C-4050-9229-E3A572D6C974}tbl_cart'), FALSE, FALSE, "");
$RootMenu->AddMenuItem(4, "mi_tbl_category", $Language->MenuPhrase("4", "MenuText"), "tbl_categorylist.php", -1, "", IsLoggedIn() || AllowListMenu('{6AF8C2FF-A16C-4050-9229-E3A572D6C974}tbl_category'), FALSE, FALSE, "");
$RootMenu->AddMenuItem(5, "mi_tbl_color", $Language->MenuPhrase("5", "MenuText"), "tbl_colorlist.php", -1, "", IsLoggedIn() || AllowListMenu('{6AF8C2FF-A16C-4050-9229-E3A572D6C974}tbl_color'), FALSE, FALSE, "");
$RootMenu->AddMenuItem(6, "mi_tbl_customer", $Language->MenuPhrase("6", "MenuText"), "tbl_customerlist.php", -1, "", IsLoggedIn() || AllowListMenu('{6AF8C2FF-A16C-4050-9229-E3A572D6C974}tbl_customer'), FALSE, FALSE, "");
$RootMenu->AddMenuItem(7, "mi_tbl_order", $Language->MenuPhrase("7", "MenuText"), "tbl_orderlist.php", -1, "", IsLoggedIn() || AllowListMenu('{6AF8C2FF-A16C-4050-9229-E3A572D6C974}tbl_order'), FALSE, FALSE, "");
$RootMenu->AddMenuItem(8, "mi_tbl_order_detail", $Language->MenuPhrase("8", "MenuText"), "tbl_order_detaillist.php", -1, "", IsLoggedIn() || AllowListMenu('{6AF8C2FF-A16C-4050-9229-E3A572D6C974}tbl_order_detail'), FALSE, FALSE, "");
$RootMenu->AddMenuItem(9, "mi_tbl_product", $Language->MenuPhrase("9", "MenuText"), "tbl_productlist.php", -1, "", IsLoggedIn() || AllowListMenu('{6AF8C2FF-A16C-4050-9229-E3A572D6C974}tbl_product'), FALSE, FALSE, "");
$RootMenu->AddMenuItem(10, "mi_tbl_product_category", $Language->MenuPhrase("10", "MenuText"), "tbl_product_categorylist.php", -1, "", IsLoggedIn() || AllowListMenu('{6AF8C2FF-A16C-4050-9229-E3A572D6C974}tbl_product_category'), FALSE, FALSE, "");
echo $RootMenu->ToScript();
?>
<div class="ewVertical" id="ewMenu"></div>
