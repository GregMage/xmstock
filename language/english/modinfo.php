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
define('_MI_XMSTOCK_DESC', 'Stock management');

// Menu
define('_MI_XMSTOCK_MENU_HOME', 'Index');
define('_MI_XMSTOCK_MENU_AREA', 'Area');
define('_MI_XMSTOCK_MENU_OUTPUT', 'Output');
define('_MI_XMSTOCK_MENU_STOCK', 'Stock');
define('_MI_XMSTOCK_MENU_TRANSFER', 'Transfer');
define('_MI_XMSTOCK_MENU_PERMISSION', 'Permission');
define('_MI_XMSTOCK_MENU_ABOUT', 'About');

// Sub menu
define('_MI_XMSTOCK_SUB_CADDY', 'Caddy');
define('_MI_XMSTOCK_SUB_LOAN', 'Gestion des prêts');
define('_MI_XMSTOCK_SUB_ORDERS', 'My orders');
define('_MI_XMSTOCK_SUB_ORDERSMANAGEMENT', 'Order management');
define('_MI_XMSTOCK_SUB_TRANSFER', 'Transfert');

// Block
define('_MI_XMSTOCK_BLOCK_MYORDERS', 'Mes commandes');
define('_MI_XMSTOCK_BLOCK_MYORDERS_DESC', 'Afficher mes commandes');
define('_MI_XMSTOCK_BLOCK_PROCESS', 'Commandes à traiter');
define('_MI_XMSTOCK_BLOCK_PROCESS_DESC', 'Afficher les commandes à traiter');
define('_MI_XMSTOCK_BLOCK_TRANSFERT', 'Transferts');
define('_MI_XMSTOCK_BLOCK_TRANSFERT_DESC', 'Afficher les transferts');

// Pref
define('_MI_XMSTOCK_PREF_HEAD_GENERAL', "<span style='font-size: large; font-weight: bold;'>General</span>");
define('_MI_XMSTOCK_PREF_GENERALITEMPERPAGE', 'Number of items per page in the general view');
define('_MI_XMSTOCK_PREF_PRICE', 'Gestion des prix');
define('_MI_XMSTOCK_PREF_PRICE_DESC', 'Option qui permet de savoir comment sont gérer les prix lors des transferets');
define('_MI_XMSTOCK_PREF_PRICE_0', 'Désactivé');
define('_MI_XMSTOCK_PREF_PRICE_1', 'Activé, écrase le prix enregistré');
define('_MI_XMSTOCK_PREF_PRICE_2', 'Activé, prend le prix existant et le moyenne avec le nouveau');
define('_MI_XMSTOCK_PREF_EDITOR', 'Text Editor');
define('_MI_XMSTOCK_PREF_CAPTCHA', 'Use Captcha?');
define('_MI_XMSTOCK_PREF_CAPTCHA_DESC', 'Select Yes to use Captcha in the submit form');
define('_MI_XMSTOCK_PREF_MAXUPLOADSIZE', 'Max uploaded files size');
define('_MI_XMSTOCK_PREF_MAXUPLOADSIZE_DESC', 'This concerns the logos that are uploaded for categories and news');
define('_MI_XMSTOCK_PREF_MAXUPLOADSIZE_MBYTES', 'MB');
define('_MI_XMSTOCK_PREF_HEAD_ADMIN', "<span style='font-size: large; font-weight: bold;'>Administration</span>");
define('_MI_XMSTOCK_PREF_ITEMPERPAGE', 'Number of items per page in the administration view');
