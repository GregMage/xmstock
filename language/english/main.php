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

// Button
define('_MA_XMSTOCK_AREA_ADD', 'Add area');
define('_MA_XMSTOCK_AREA_LIST', 'Area list');
define('_MA_XMSTOCK_OUTPUT_ADD', 'Add Output');
define('_MA_XMSTOCK_OUTPUT_LIST', 'Output list');
define('_MA_XMSTOCK_STOCK_ADD', 'Add stock');
define('_MA_XMSTOCK_STOCK_LIST', 'stock list');
define('_MA_XMSTOCK_TRANSFER_ENTRYINSTOCK', 'Entry in stock');
define('_MA_XMSTOCK_TRANSFER_LIST', 'Transfer list');
define('_MA_XMSTOCK_TRANSFER_OUTOFSTOCK', 'Out of stock');
define('_MA_XMSTOCK_TRANSFER_TRANSFEROFSTOCK', 'Transfer of stock');

// Shared
define('_MA_XMSTOCK_ADD', 'Add');
define('_MA_XMSTOCK_ACTION', 'Action');
define('_MA_XMSTOCK_DEL', 'Delete');
define('_MA_XMSTOCK_EDIT', 'Edit');
define('_MA_XMSTOCK_INFORMATION', 'Informations');
define('_MA_XMSTOCK_ORDER', 'Order');
define('_MA_XMSTOCK_PROCESS', 'Faire avancer'); // progress
define('_MA_XMSTOCK_REDIRECT_SAVE', 'Successfully saved');
define('_MA_XMSTOCK_SORTBY', 'Trier par'); //Sort by
define('_MA_XMSTOCK_STATUS', 'Status');
define('_MA_XMSTOCK_STATUS_A', 'Active');
define('_MA_XMSTOCK_STATUS_NA', 'Disabled');
define('_MA_XMSTOCK_STATUS_EXECUTED', 'Executed');
define('_MA_XMSTOCK_STATUS_WAITING', 'Waiting');
define('_MA_XMSTOCK_TITLE', 'Title');
define('_MA_XMSTOCK_VIEW', 'View');
define('_MA_XMSTOCK_WARNING', 'Warning');

// Admin
define('_MA_XMSTOCK_INDEX_IMAGEINFO', 'Server status');
define('_MA_XMSTOCK_INDEX_MAXPOSTSIZE', 'Max post size permitted (post_max_size directive in php.ini): ');
define('_MA_XMSTOCK_INDEX_MAXUPLOADSIZE', 'Max upload size permitted (upload_max_filesize directive in php.ini): ');
define('_MA_XMSTOCK_INDEX_MEMORYLIMIT', 'Memory limit (memory_limit directive in php.ini): ');
define('_MA_XMSTOCK_INDEX_ON', "<span style='font-weight: bold;'>ON</span>");
define('_MA_XMSTOCK_INDEX_OFF', "<span style='font-weight: bold;'>OFF</span>");
define('_MA_XMSTOCK_INDEX_SERVERUPLOADSTATUS', 'Server uploads status: ');
define('_MA_XMSTOCK_INDEX_SPHPINI', "<span style='font-weight: bold;'>Information taken from PHP ini file:</span>");
define('_MA_XMSTOCK_INDEXCONFIG_XMARTICLE_ERROR', 'You must install the xmarticle module to use xmstock');

// Error message
define('_MA_XMSTOCK_ERROR_AMOUNT', 'Amount must be a number');
define('_MA_XMSTOCK_ERROR_AMOUNTNOTZERO', 'The amount can not be 0');
define('_MA_XMSTOCK_ERROR_ARTICLEID', 'There is no article selected');
define('_MA_XMSTOCK_ERROR_NACTIVE', 'Error: Disable content!');
define('_MA_XMSTOCK_ERROR_NOAREA', 'There are no areas in the database');
define('_MA_XMSTOCK_ERROR_NOORDER', 'There are no order in the database');
define('_MA_XMSTOCK_ERROR_NOOUTPUT', 'There are no outputs in the database');
define('_MA_XMSTOCK_ERROR_NOSTOCK', 'There are no stocks in the database');
define('_MA_XMSTOCK_ERROR_NOTRANSFER', 'There are no transfers in the database');
define('_MA_XMSTOCK_ERROR_ORDER_DEL', 'You cannot delete this order!');
define('_MA_XMSTOCK_ERROR_SIZE', "The size in préférence (Max uploaded files size) exceeds the maximum values defined in 'post_max_size' or 'upload_max_filesize' in your configuration in php.ini");
define('_MA_XMSTOCK_ERROR_TRANSFER_AR_AREAID', 'There is no destination stock selected');
define('_MA_XMSTOCK_ERROR_TRANSFER_ST_AREAID', 'There is no starting stock selected');
define('_MA_XMSTOCK_ERROR_TRANSFER_OUTPUTID', 'There is no output selected');
define('_MA_XMSTOCK_ERROR_TRANSFER_NOARTICLE', 'Selected article is not available in the selected stock');
define('_MA_XMSTOCK_ERROR_TRANSFER_TBAMOUNT', 'The quantity requested (%s) is more important than that available (%s)');
define('_MA_XMSTOCK_ERROR_WEIGHT', 'Weight must be a number');

// area
define('_MA_XMSTOCK_AREA_ARTICLENAME', 'Name');
define('_MA_XMSTOCK_AREA_ARTICLEREFERENCE', 'Reference');
define('_MA_XMSTOCK_AREA_AMOUNT', 'Amount');
define('_MA_XMSTOCK_AREA_AMOUNTTYPE1', '<');
define('_MA_XMSTOCK_AREA_AMOUNTTYPE2', '≤');
define('_MA_XMSTOCK_AREA_AMOUNTTYPE3', '=');
define('_MA_XMSTOCK_AREA_AMOUNTTYPE4', '>');
define('_MA_XMSTOCK_AREA_AMOUNTTYPE5', '≥');
define('_MA_XMSTOCK_AREA_COLOR', 'Color');
define('_MA_XMSTOCK_AREA_DESC', 'Description');
define('_MA_XMSTOCK_AREA_FILTERFORM', 'Filter');
define('_MA_XMSTOCK_AREA_FORMPATH', 'Files are in: %s');
define('_MA_XMSTOCK_AREA_LOCATION', 'Location');
define('_MA_XMSTOCK_AREA_LOGO', 'Logo');
define('_MA_XMSTOCK_AREA_LOGOFILE', 'Logo file');
define('_MA_XMSTOCK_AREA_NAME', 'Name');
define('_MA_XMSTOCK_AREA_SIZE', 'Maximum upload size');
define('_MA_XMSTOCK_AREA_SORT', 'Sort');
define('_MA_XMSTOCK_AREA_SORT1', 'Name Up');
define('_MA_XMSTOCK_AREA_SORT2', 'Name Down');
define('_MA_XMSTOCK_AREA_SORT3', 'Amount Up');
define('_MA_XMSTOCK_AREA_SORT4', 'Amount Down');
define('_MA_XMSTOCK_AREA_SUREDEL', 'Sure to delete this area? %s');
define('_MA_XMSTOCK_AREA_UPLOAD', 'Upload');
define('_MA_XMSTOCK_AREA_UPLOADSIZE', 'Maximum size: %s kB');
define('_MA_XMSTOCK_AREA_WEIGHT', 'Weight');

// stock
define('_MA_XMSTOCK_STOCK_AMOUNT', 'Amount in stock');
define('_MA_XMSTOCK_STOCK_AREA', 'Area');
define('_MA_XMSTOCK_STOCK_ARTICLE', 'Article in stock');

//output
define('_MA_XMSTOCK_OUTPUT_DESC', 'Description');
define('_MA_XMSTOCK_OUTPUT_NAME', 'Name');
define('_MA_XMSTOCK_OUTPUT_SUREDEL', 'Sure to delete this output? %s');
define('_MA_XMSTOCK_OUTPUT_USERID', 'Receiver');
define('_MA_XMSTOCK_OUTPUT_WEIGHT', 'Weight');

//transfer
define('_MA_XMSTOCK_TRANSFER_AMOUNT', 'Amount');
define('_MA_XMSTOCK_TRANSFER_ARAREA', 'Destination stock');
define('_MA_XMSTOCK_TRANSFER_ARTICLE', 'Article to transfer');
define('_MA_XMSTOCK_TRANSFER_DATE', 'Date');
define('_MA_XMSTOCK_TRANSFER_DESC', 'Description of the transfer');
define('_MA_XMSTOCK_TRANSFER_INFORMATION', 'Transfer Information');
define('_MA_XMSTOCK_TRANSFER_OUTPUT', 'Output');
define('_MA_XMSTOCK_TRANSFER_REF', 'Transfer reference');
define('_MA_XMSTOCK_TRANSFER_STAREA', 'Starting stock');
define('_MA_XMSTOCK_TRANSFER_SUREDEL', 'Sure to delete this transfer? %s');
define('_MA_XMSTOCK_TRANSFER_TYPE', 'Type of transfer');
define('_MA_XMSTOCK_TRANSFER_USER', 'User');

// permission
define('_MA_XMSTOCK_PERMISSION_MANAGE', 'Manage Permissions');
define('_MA_XMSTOCK_PERMISSION_MANAGE_DSC', 'Select groups that can manage this area');
define('_MA_XMSTOCK_PERMISSION_ORDER', 'Order permission');
define('_MA_XMSTOCK_PERMISSION_ORDER_DSC', 'Select groups that can order an article in this area');
define('_MA_XMSTOCK_PERMISSION_OTHER', 'Other permissions');
define('_MA_XMSTOCK_PERMISSION_OTHER_DSC', 'Select groups that can:');
define('_MA_XMSTOCK_PERMISSION_OTHER_4', '');
define('_MA_XMSTOCK_PERMISSION_OTHER_8', '');
define('_MA_XMSTOCK_PERMISSION_VIEW', 'View Permissions');
define('_MA_XMSTOCK_PERMISSION_VIEW_DSC', 'Select groups that can view in this area');

// renderStocks
define('_MA_XMSTOCK_RENDERSTOCKS_TOTAL', 'Total: ');

// user
define('_MA_XMSTOCK_HOME', 'Home page');
define('_MA_XMSTOCK_CADDY', 'Caddy');
define('_MA_XMSTOCK_CHECKOUT', 'Checkout');
define('_MA_XMSTOCK_CHECKOUT_DESC', 'Description');
define('_MA_XMSTOCK_CHECKOUT_DELIVERY', 'Delivery options');
define('_MA_XMSTOCK_CHECKOUT_DELIVERY_WITHDRAWAL', 'Withdrawal');
define('_MA_XMSTOCK_CHECKOUT_DELIVERY_DELIVERY', 'Delivery');
define('_MA_XMSTOCK_CHECKOUT_DORDER', 'Desired date');
define('_MA_XMSTOCK_CHECKOUT_INPUTINF', 'Input information');
define('_MA_XMSTOCK_CHECKOUT_SEND', 'Commande envoyée');
define('_MA_XMSTOCK_CHECKOUT_CONFIRM', 'Confirmation');
define('_MA_XMSTOCK_CHECKOUT_CONFIRM_SEND', 'Votre commande a bien été envoyée avec les informations suivantes :');
define('_MA_XMSTOCK_CHECKOUT_SUMMARY', 'Summary of your cart');
define('_MA_XMSTOCK_CHECKOUT_WARNINGQTY', 'The quantity requested for items with the logo <span class="badge badge-pill badge-warning">Warning</span> is greater than that available in stock. <br>The delivery time could be longer!');
define('_MA_XMSTOCK_CADDY_EMPTY', 'Empty cart');
define('_MA_XMSTOCK_CADDY_AREA', 'Areas');
define('_MA_XMSTOCK_CADDY_STEP1', '1- Add to cart');
define('_MA_XMSTOCK_CADDY_STEP2', '2- Input information');
define('_MA_XMSTOCK_CADDY_STEP3', '3- Confirm information');
define('_MA_XMSTOCK_CADDY_CONTINUE', 'Continue the selection of articles');
define('_MA_XMSTOCK_CADDY_UPDATE', 'Update quantity');
define('_MA_XMSTOCK_CADDY_STEP1_2', 'Next (Input information)');
define('_MA_XMSTOCK_CADDY_STEP2_2', 'Next (Confirm information)');
define('_MA_XMSTOCK_CADDY_QUANTITY', 'Quantity');
define('_MA_XMSTOCK_CADDY_ITMES', 'Items');
define('_MA_XMSTOCK_CADDY_ERROR_EMPTY', 'Your cart is empty');
define('_MA_XMSTOCK_CADDY_ERROR_NOARTICLE', 'The requested item does not exist or is not activated!');
define('_MA_XMSTOCK_CADDY_ERROR_NOAREA', 'The requested area does not exist or is not activated!');
define('_MA_XMSTOCK_CADDY_ERROR_NOPERMISSION', 'You do not have permission to order in this area');
define('_MA_XMSTOCK_CADDY_WARNING_AREA', 'Attention, vous pouvez commander plusieurs articles mais uniquement si ils sont dans le même stock.<br>Si vous voulez commander l\'article ci dessous, il faut faire une autre commande');

define('_MA_XMSTOCK_AREA_THEREAREARTICLE', 'There are <strong>%s</strong> articles in this area!');

define('_MA_XMSTOCK_ORDERS', 'Orders');
define('_MA_XMSTOCK_VIEWORDER', 'Visualization of the order');

define('_MA_XMSTOCK_ORDER_STATUS_0', 'Annulé');
define('_MA_XMSTOCK_ORDER_STATUS_1', 'En attente');
define('_MA_XMSTOCK_ORDER_STATUS_2', 'En cours');
define('_MA_XMSTOCK_ORDER_STATUS_3', 'Livraison/retrait');
define('_MA_XMSTOCK_ORDER_STATUS_4', 'Livré');
define('_MA_XMSTOCK_ORDER_STATUS_TITLE_0', 'Commandes annulées');
define('_MA_XMSTOCK_ORDER_STATUS_TITLE_1', 'Commandes en attentes');
define('_MA_XMSTOCK_ORDER_STATUS_TITLE_2', 'Commandes en cours');
define('_MA_XMSTOCK_ORDER_STATUS_TITLE_3', 'Commandes prêtes (livraison/retrait)');
define('_MA_XMSTOCK_ORDER_STATUS_TITLE_4', 'Commandes livrées');

// order
define('_MA_XMSTOCK_ORDER_ORDER', 'Order No. %s');
define('_MA_XMSTOCK_ORDER_NUMBE', 'Order number');
define('_MA_XMSTOCK_ORDER_DESCRIPTION', 'Description');
define('_MA_XMSTOCK_ORDER_DELIVERY', 'Delivery options');
define('_MA_XMSTOCK_ORDER_DELIVERY_WITHDRAWAL', 'Withdrawal');
define('_MA_XMSTOCK_ORDER_DELIVERY_DELIVERY', 'Delivery');
define('_MA_XMSTOCK_ORDER_SUREDEL', 'Sure to delete this order? #%s');



define('_MA_XMSTOCK_ORDER_DATEORDER', 'Date de commande');//Order date
define('_MA_XMSTOCK_ORDER_DATEDESIRED', 'Date désirée');//Desired date
define('_MA_XMSTOCK_ORDER_DATEVALIDATION', 'Date de validation');//Order validation date
define('_MA_XMSTOCK_ORDER_DATEDELIVERY', 'Date de livraison prévue');//Delivery Date
define('_MA_XMSTOCK_ORDER_DATEWITHDRAWAL', 'Date de retrait prévu');//Planned withdrawal date
define('_MA_XMSTOCK_ORDER_DATEDELIVERYWITHDRAWAL', 'Date de livraison/retrait prévue'); //Validated delivery/withdrawal date
define('_MA_XMSTOCK_ORDER_DATEREADY', 'Date commande prête');//Order ready date
define('_MA_XMSTOCK_ORDER_DATEDELIVERY_R', 'Date de la livraison');//
define('_MA_XMSTOCK_ORDER_DATEWITHDRAWAL_R', 'Date du retrait');//Date of withdrawal
define('_MA_XMSTOCK_ORDER_DATEDELIVERYWITHDRAWAL_R', 'Date de livraison/retrait'); //Order ready date
define('_MA_XMSTOCK_ORDER_DATECANCELLATION', 'Date d\'annulation');//Cancellation date
define('_MA_XMSTOCK_ORDER_HISTORY', 'Historique de la commande');//
define('_MA_XMSTOCK_ORDER_ARTICLES', 'Articles commandés');


define('_MA_XMSTOCK_CHECKOUT_VIEW', 'Track this order');


define('_MA_XMSTOCK_VIEWORDER_ORDER', 'Order #');
define('_MA_XMSTOCK_VIEWORDER_ARTICLE', 'Article');
define('_MA_XMSTOCK_VIEWORDER_AMOUNT', 'Amount');

// management
define('_MA_XMSTOCK_MANAGEMENT', 'Orders management');
define('_MA_XMSTOCK_MANAGEMENT_TOPROCESS', 'Commandes à traiter'); //Orders to process
define('_MA_XMSTOCK_MANAGEMENT_PREPARATION', 'Commandes en préparation'); //Orders in preparation
define('_MA_XMSTOCK_MANAGEMENT_READY', 'Commandes prêtes'); //Orders ready
define('_MA_XMSTOCK_MANAGEMENT_DELIVRED', 'Commandes livrées'); //Orders delivered
define('_MA_XMSTOCK_MANAGEMENT_CANCELED', 'Commandes annulées'); //Canceled orders
define('_MA_XMSTOCK_MANAGEMENT_ALLORDERS', 'Toutes les commandes'); //All orders
define('_MA_XMSTOCK_MANAGEMENT_VIEW', 'Visualisation d\'une commande'); //Viewing an order
define('_MA_XMSTOCK_MANAGEMENT_VIEWALL', 'Visualization of orders'); //Viewing an order
define('_MA_XMSTOCK_MANAGEMENT_SORTORDER', 'N° de commande'); //Order number








