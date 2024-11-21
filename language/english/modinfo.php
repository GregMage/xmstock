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

// Submenu
define('_MI_XMSTOCK_SUB_CADDY', 'Caddy');
define('_MI_XMSTOCK_SUB_LOAN', 'Loan management');
define('_MI_XMSTOCK_SUB_ORDERS', 'My orders');
define('_MI_XMSTOCK_SUB_ORDERSMANAGEMENT', 'Order management');
define('_MI_XMSTOCK_SUB_OVERDRAFT', 'Overdraft list');
define('_MI_XMSTOCK_SUB_TRANSFER', 'Transfer');

// Block
define('_MI_XMSTOCK_BLOCK_MYORDERS', 'My Orders');
define('_MI_XMSTOCK_BLOCK_MYORDERS_DESC', 'Show My Orders');
define('_MI_XMSTOCK_BLOCK_PROCESS', 'Orders to Process');
define('_MI_XMSTOCK_BLOCK_PROCESS_DESC', 'Show Orders to to treat');
define('_MI_XMSTOCK_BLOCK_TRANSFERT', 'Transfers');
define('_MI_XMSTOCK_BLOCK_TRANSFERT_DESC', 'Show transfers');
define('_MI_XMSTOCK_BLOCK_MYLOANS', 'My loans');
define('_MI_XMSTOCK_BLOCK_MYLOANS_DESC', 'Show loans from user');
define('_MI_XMSTOCK_BLOCK_LOANS', 'Outstanding loans');
define('_MI_XMSTOCK_BLOCK_LOANS_DESC', 'Show loans under user management');
define('_MI_XMSTOCK_BLOCK_OVERDRAFT', 'Articles stock minimum');
define('_MI_XMSTOCK_BLOCK_OVERDRAFT_DESC', 'Show items that have reached minimum stock');

// Pref
define('_MI_XMSTOCK_PREF_HEAD_GENERAL', "<span style='font-size: large; font-weight: bold;'>General< /span>");
define('_MI_XMSTOCK_PREF_GENERALITEMPERPAGE', 'Number of items per page in the general view');
define('_MI_XMSTOCK_PREF_PRICE', 'Price management');
define('_MI_XMSTOCK_PREF_PRICE_DESC', 'Option that allows you to know how are prices managed during transfers');
define('_MI_XMSTOCK_PREF_PRICE_0', 'Disabled');
define('_MI_XMSTOCK_PREF_PRICE_1', 'Enabled, overwrites the saved price');
define('_MI_XMSTOCK_PREF_PRICE_2', 'Enabled, takes the existing price and averages it with the new one');
define('_MI_XMSTOCK_PREF_DAYDELIVERY', 'Number of days before delivery ');
define('_MI_XMSTOCK_PREF_DAYDELIVERY_DESC', 'Option to set the standard number of days before delivery');
define('_MI_XMSTOCK_PREF_DAYDELIVERY_0', 'Disabled');
define('_MI_XMSTOCK_PREF_DAYDELIVERY_1', '1 day');
define ('_MI_XMSTOCK_PREF_DAYDELIVERY_2', '2 days');
define('_MI_XMSTOCK_PREF_DAYDELIVERY_3', '3 days');
define('_MI_XMSTOCK_PREF_DAYDELIVERY_4', '4 days');
define('_MI_XMSTOCK_PREF_DAYDELIVERY_5', '5 days');
define('_MI_XMSTOCK_PREF_DAYDELIVERY_6', '6 days');
define( '_MI_XMSTOCK_PREF_DAYDELIVERY_7', '7 days');
define('_MI_XMSTOCK_PREF_GENERALEXCESSCUT', 'Cut Surplus');
define('_MI_XMSTOCK_PREF_GENERALEXCESSCUT_DESC', 'Value added to each cut for final stock release length');
define('_MI_XMSTOCK_PREF_EDITOR', 'Text Editor');
define('_MI_XMSTOCK_PREF_XMPROD', 'Use the xmprod module to add production management');
define('_MI_XMSTOCK_PREF_CAPTCHA', 'Use Captcha?');
define('_MI_XMSTOCK_PREF_CAPTCHA_DESC', 'Select Yes to use Captcha in the submit form');
define('_MI_XMSTOCK_PREF_MAXUPLOADSIZE', 'Max uploaded files size');
define('_MI_XMSTOCK_PREF_MAXUPLOADSIZE_DESC', 'This concerns the logos that are uploaded for categories and news');
define('_MI_XMSTOCK_PREF_MAXUPLOADSIZE_MBYTES', 'MB');
define('_MI_XMSTOCK_PREF_HEAD_ADMIN', "<span style='font-size: large; font-weight: bold;'>Administration</span>");
define('_MI_XMSTOCK_PREF_ITEMPERPAGE', 'Number of items per page in the administration view');
