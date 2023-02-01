<?php
/*
 You may not change or alter any portion of this comment or credits
 of supporting developers from this source code or any supporting source code
 which is considered copyrighted (c) material of the original comment or credit authors.

 This program is distributed in the hope that it will be useful,
 but WITHOUT ANY WARRANTY; without even the implied warranty of
 MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
*/

/**
 * xmstock module
 *
 * @copyright       XOOPS Project (https://xoops.org)
 * @license         GNU GPL 2 (http://www.gnu.org/licenses/old-licenses/gpl-2.0.html)
 * @author          Mage Gregory (AKA Mage)
 */
// The name of this module
define('_MI_XMSTOCK_NAME', 'Stock');
define('_MI_XMSTOCK_DESC', 'Gestion de stock');

// Menu
define('_MI_XMSTOCK_MENU_HOME', 'Index');
define('_MI_XMSTOCK_MENU_AREA', 'Zone');
define('_MI_XMSTOCK_MENU_OUTPUT', 'Sorties');
define('_MI_XMSTOCK_MENU_STOCK', 'Stock');
define('_MI_XMSTOCK_MENU_TRANSFER', 'Transferts');
define('_MI_XMSTOCK_MENU_PERMISSION', 'Autorisations');
define('_MI_XMSTOCK_MENU_ABOUT', 'À propos');

// Sub menu
define('_MI_XMSTOCK_SUB_CADDY', 'Caddie');
define('_MI_XMSTOCK_SUB_LOAN', 'Gestion des prêts');
define('_MI_XMSTOCK_SUB_ORDERS', 'Mes commandes');
define('_MI_XMSTOCK_SUB_ORDERSMANAGEMENT', 'Gestion des commandes');
define('_MI_XMSTOCK_SUB_TRANSFER', 'Transferts');

// Block
define('_MI_XMSTOCK_BLOCK_MYORDERS', 'Mes commandes');
define('_MI_XMSTOCK_BLOCK_MYORDERS_DESC', 'Afficher mes commandes');
define('_MI_XMSTOCK_BLOCK_PROCESS', 'Commandes à traiter');
define('_MI_XMSTOCK_BLOCK_PROCESS_DESC', 'Afficher les commandes à traiter');

// Pref
define('_MI_XMSTOCK_PREF_HEAD_GENERAL', "<span style='font-size: large; font-weight: bold;'>Général</span>");
define('_MI_XMSTOCK_PREF_GENERALITEMPERPAGE', 'Nombre d\'éléments par page dans la vue générale');
define('_MI_XMSTOCK_PREF_PRICE', 'Gestion des prix');
define('_MI_XMSTOCK_PREF_PRICE_DESC', 'Option qui permet de savoir comment sont gérés les prix lors des transferets');
define('_MI_XMSTOCK_PREF_PRICE_0', 'Désactivé');
define('_MI_XMSTOCK_PREF_PRICE_1', 'Activé, écrase le prix enregistré');
define('_MI_XMSTOCK_PREF_PRICE_2', 'Activé, prend le prix existant et le moyenne avec le nouveau');
define('_MI_XMSTOCK_PREF_EDITOR', 'Éditeur de texte');
define('_MI_XMSTOCK_PREF_CAPTCHA', 'Utiliser Captcha?');
define('_MI_XMSTOCK_PREF_CAPTCHA_DESC', 'Sélectionnez Oui pour utiliser Captcha dans le formulaire de soumission.');
define('_MI_XMSTOCK_PREF_MAXUPLOADSIZE', 'Taille maximale des fichiers uploadés');
define('_MI_XMSTOCK_PREF_MAXUPLOADSIZE_DESC', 'Cela concerne les logos uploadés pour les catégories et les actualités');
define('_MI_XMSTOCK_PREF_MAXUPLOADSIZE_MBYTES', 'Mb');
define('_MI_XMSTOCK_PREF_HEAD_ADMIN', "<span style='font-size: large; font-weight: bold;'>Administration</span>");
define('_MI_XMSTOCK_PREF_ITEMPERPAGE', 'Nombre d\'éléments par page dans la vue d\'administration');
