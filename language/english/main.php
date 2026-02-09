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
define('_MA_XMSTOCK_TRANSFER_OUTFLOW', 'Direct output');
define('_MA_XMSTOCK_TRANSFER_TRANSFEROFSTOCK', 'Transfer of stock');

// Shared
define('_MA_XMSTOCK_ADD', 'Add');
define('_MA_XMSTOCK_ACTION', 'Action');
define('_MA_XMSTOCK_DEL', 'Delete');
define('_MA_XMSTOCK_EDIT', 'Edit');
define('_MA_XMSTOCK_ERROR', 'Error');
define('_MA_XMSTOCK_INFORMATION', 'Informations');
define('_MA_XMSTOCK_ORDER', 'Order');
define('_MA_XMSTOCK_LOAN', 'Borrow');
define('_MA_XMSTOCK_PROCESS', 'Progress');
define('_MA_XMSTOCK_REDIRECT_SAVE', 'Successfully saved');
define('_MA_XMSTOCK_REJECT', 'Reject');
define('_MA_XMSTOCK_SORTBY', 'Sort by');
define('_MA_XMSTOCK_STATUS', 'Status');
define('_MA_XMSTOCK_STATUS_A', 'Active');
define('_MA_XMSTOCK_STATUS_NA', 'Disabled');
define('_MA_XMSTOCK_STATUS_EXECUTED', 'Executed');
define('_MA_XMSTOCK_STATUS_WAITING', 'Waiting');
define('_MA_XMSTOCK_TITLE', 'Title');
define('_MA_XMSTOCK_VIEW', 'View');
define('_MA_XMSTOCK_VALID', 'Validate');
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
define('_MA_XMSTOCK_INDEXCONFIG_XMPROD_WARNINGNOTINSTALLED', 'You have not installed the xmprod module, this module is required if you want to have production management');
define('_MA_XMSTOCK_INDEXCONFIG_XMPROD_WARNINGNOTACTIVATE', 'You must activate in the preferences of the xmstock module the use of xmprod (if you want to have production management)');

// Error message
define('_MA_XMSTOCK_ERROR_AMOUNT', 'Amount must be a number');
define('_MA_XMSTOCK_ERROR_ARTICLEID', 'There is no article selected');
define('_MA_XMSTOCK_ERROR_DELSTOCK', 'You cannot delete this stock because there are orders in progress for this stock!');
define('_MA_XMSTOCK_ERROR_LOCATION', 'The location is not defined');
define('_MA_XMSTOCK_ERROR_NACTIVE', 'Error: Disable content!');
define('_MA_XMSTOCK_ERROR_NOAREA', 'There are no areas in the database');
define('_MA_XMSTOCK_ERROR_NOARTICLE', 'There are no articles, it is necessary to have at least one article!');
define('_MA_XMSTOCK_ERROR_NOLOAN', 'There are no loan in the database');
define('_MA_XMSTOCK_ERROR_NOORDER', 'There are no order in the database');
define('_MA_XMSTOCK_ERROR_NOOUTPUT', 'There are no outputs in the database');
define('_MA_XMSTOCK_ERROR_NOPRICE', 'No price in the database');
define('_MA_XMSTOCK_ERROR_NOSTOCK', 'There are no stocks in the database');
define('_MA_XMSTOCK_ERROR_NOTRANSFER', 'There are no transfers in the database');
define('_MA_XMSTOCK_ERROR_ONEARTICLE', 'You must have at least one article (no value 0 on the remaining article)');
define('_MA_XMSTOCK_ERROR_ORDER_DEL', 'You cannot delete this order!');
define('_MA_XMSTOCK_ERROR_PRICE', 'The price must be a number and greater than 0');
define('_MA_XMSTOCK_ERROR_SIZE', "The size in préférence (Max uploaded files size) exceeds the maximum values defined in 'post_max_size' or 'upload_max_filesize' in your configuration in php.ini");
define('_MA_XMSTOCK_ERROR_SPLIT', 'You cannot split the entire article (there is only one article...)');
define('_MA_XMSTOCK_ERROR_TRANSFER_AR_AREAID', 'There is no destination stock selected');
define('_MA_XMSTOCK_ERROR_TRANSFER_ST_AREAID', 'There is no starting stock selected');
define('_MA_XMSTOCK_ERROR_TRANSFER_ST_TO_AR', 'The starting and arrival stocks are identical');
define('_MA_XMSTOCK_ERROR_TRANSFER_OUTPUT', 'You must choose an external or internal recipient. Not both!');
define('_MA_XMSTOCK_ERROR_TRANSFER_OUTPUTID', 'There is no output selected');
define('_MA_XMSTOCK_ERROR_TRANSFER_NOARTICLE', 'Selected article is not available in the selected stock');
define('_MA_XMSTOCK_ERROR_TRANSFER_TBAMOUNT', 'The quantity requested (%s) is more important than that available (%s)');
define('_MA_XMSTOCK_ERROR_USER', 'No user selected');
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
define('_MA_XMSTOCK_AREA_PRODUCTION', 'Production');
define('_MA_XMSTOCK_AREA_PRODUCTION_DESC', 'Integrate this stock into the analysis of the production plan?');
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
define('_MA_XMSTOCK_STOCK_AREA', 'Stock');
define('_MA_XMSTOCK_STOCK_ARTICLE', 'Article in stock');
define('_MA_XMSTOCK_STOCK_DEL', 'Permanently delete the article from stock');
define('_MA_XMSTOCK_STOCK_DEL_DESC', 'Warning, the article will no longer be in this stock and the price history will be lost!');
define('_MA_XMSTOCK_STOCK_FREE', 'Self service');
define('_MA_XMSTOCK_STOCK_LENGHT', 'Length (mm)');
define('_MA_XMSTOCK_STOCK_LOAN', '<span class="fa fa-exchange"></span> Loan');
define('_MA_XMSTOCK_STOCK_LOCATION', 'Location');
define('_MA_XMSTOCK_STOCK_MINI', 'Stock minimum');
define('_MA_XMSTOCK_STOCK_MINI_DSC', 'Value that defines the minimum stock (used if it is necessary to track minimum stock). Set the value 0 to not track');
define('_MA_XMSTOCK_STOCK_ML', 'Linear (mml)');
define('_MA_XMSTOCK_STOCK_ORDER', 'Disable ordering');
define('_MA_XMSTOCK_STOCK_ORDER_DESC', 'This option allows you to disable ordering');
define('_MA_XMSTOCK_STOCK_SURFACE', 'Surface (mm²)');
define('_MA_XMSTOCK_STOCK_TYPE', 'Type');
define('_MA_XMSTOCK_STOCK_TYPE_DESC', 'The linear (mml) option is used for material stored in the form of linear profile. The loan option allows you to activate the article lending system. The self-service option disables quantity tracking. The surface (mm²) option is used for material stored in the form of plates.');
define('_MA_XMSTOCK_STOCK_STANDARD', 'Standard (Qté)');
define('_MA_XMSTOCK_STOCK_WIDTH', 'Width (mm)');

//output
define('_MA_XMSTOCK_OUTPUT_DESC', 'Description');
define('_MA_XMSTOCK_OUTPUT_NAME', 'Name');
define('_MA_XMSTOCK_OUTPUT_SUREDEL', 'Sure to delete this output? %s');
define('_MA_XMSTOCK_OUTPUT_WEIGHT', 'Weight');

//transfer
define('_MA_XMSTOCK_TRANSFER_ALL', 'All transfers');
define('_MA_XMSTOCK_TRANSFER_AMOUNT', 'Amount');
define('_MA_XMSTOCK_TRANSFER_AMOUNT_DSC', 'If this is a "linear" quantity, enter the quantity in [mm].');
define('_MA_XMSTOCK_TRANSFER_ARAREA', 'Destination stock');
define('_MA_XMSTOCK_TRANSFER_ARTICLE', 'Article to transfer');
define('_MA_XMSTOCK_TRANSFER_DATE', 'Date');
define('_MA_XMSTOCK_TRANSFER_DESC', 'Description of the transfer');
define('_MA_XMSTOCK_TRANSFER_DESTINATION', 'Destination');
define('_MA_XMSTOCK_TRANSFER_FORM', 'Transfer form');
define('_MA_XMSTOCK_TRANSFER_INFORMATION', 'Transfer Information');
define('_MA_XMSTOCK_TRANSFER_LIST_WARNING', 'Transfers pending validation');
define('_MA_XMSTOCK_TRANSFER_LOAN', 'Create a loan');
define('_MA_XMSTOCK_TRANSFER_LOCATION', 'Location');
define('_MA_XMSTOCK_TRANSFER_LOCATION_DSC', 'Location of the article in stock');
define('_MA_XMSTOCK_TRANSFER_NEEDSYEAR', 'Période du besoin');
define('_MA_XMSTOCK_TRANSFER_NEEDSYEAR_DSC', 'This article is in the production plan, you must indicate for which period is your need');
define('_MA_XMSTOCK_TRANSFER_OUTPUT', 'Recipient');
define('_MA_XMSTOCK_TRANSFER_OUTPUT_DSC', 'You must choose an external or internal recipient. Only one choice between the two possibilities');
define('_MA_XMSTOCK_TRANSFER_OUTPUTID', 'External recipient');
define('_MA_XMSTOCK_TRANSFER_OUTPUTUSERID', 'Internal recipient');
define('_MA_XMSTOCK_TRANSFER_PRICE', 'Price');
define('_MA_XMSTOCK_TRANSFER_PRICE_DSC', 'Specify the price of the batch to transfer. A value of 0 will not record a price (if a price already exists in stock, it will be used)');
define('_MA_XMSTOCK_TRANSFER_REF', 'Transfer reference');
define('_MA_XMSTOCK_TRANSFER_STOCK', 'Stock: ');
define('_MA_XMSTOCK_TRANSFER_SUREDEL', 'Sure to delete this transfer? %s');
define('_MA_XMSTOCK_TRANSFER_STAREA', 'Starting stock');
define('_MA_XMSTOCK_TRANSFER_TIME', 'Time');
define('_MA_XMSTOCK_TRANSFER_TRANSFER', 'Transfer');
define('_MA_XMSTOCK_TRANSFER_TYPE', 'Type of transfer');
define('_MA_XMSTOCK_TRANSFER_USER', 'Author of the transfer');

// permission
define('_MA_XMSTOCK_PERMISSION_MANAGE', 'Manage Permissions');
define('_MA_XMSTOCK_PERMISSION_MANAGE_DSC', 'Select groups that can manage this area');
define('_MA_XMSTOCK_PERMISSION_ORDER', 'Order permission');
define('_MA_XMSTOCK_PERMISSION_ORDER_DSC', 'Select groups that can order an article in this area');
define('_MA_XMSTOCK_PERMISSION_OUTFLOW', 'Direct stock output authorization');
define('_MA_XMSTOCK_PERMISSION_OUTFLOW_DSC', 'Choose the groups that can make a direct stock output of components in these storage areas');
define('_MA_XMSTOCK_PERMISSION_OTHER', 'Other permissions');
define('_MA_XMSTOCK_PERMISSION_OTHER_DSC', 'Select groups that can:');
define('_MA_XMSTOCK_PERMISSION_OTHER_4', 'Permission to see the price');
define('_MA_XMSTOCK_PERMISSION_OTHER_8', 'Permission to see price statistics');
define('_MA_XMSTOCK_PERMISSION_OTHER_16', 'Permission to make stock outputs');
define('_MA_XMSTOCK_PERMISSION_VIEW', 'View Permissions');
define('_MA_XMSTOCK_PERMISSION_VIEW_DSC', 'Select groups that can view in this area');

// renderStocks
define('_MA_XMSTOCK_RENDERSTOCKS_PRICE', 'Price: %s CHF');
define('_MA_XMSTOCK_RENDERSTOCKS_TOTAL', 'Total: ');

// user
define('_MA_XMSTOCK_AREA_THEREAREARTICLE', 'There are <strong>%s</strong> articles in this area!');
define('_MA_XMSTOCK_CADDY', 'Shopping cart');
define('_MA_XMSTOCK_HOME', 'Home page');
define('_MA_XMSTOCK_VIEWORDER', 'Visualization of the order');

// checkout
define('_MA_XMSTOCK_CHECKOUT', 'Checkout');
define('_MA_XMSTOCK_CHECKOUT_UNIT', 'mm');
define('_MA_XMSTOCK_CHECKOUT_UNITS', 'mm²');
define('_MA_XMSTOCK_CHECKOUT_DESC', 'Description');
define('_MA_XMSTOCK_CHECKOUT_DELIVERY', 'Delivery options');
define('_MA_XMSTOCK_CHECKOUT_DELIVERY_WITHDRAWAL', 'Withdrawal');
define('_MA_XMSTOCK_CHECKOUT_DELIVERY_DELIVERY', 'Delivery');
define('_MA_XMSTOCK_CHECKOUT_DORDER', 'Desired date');
define('_MA_XMSTOCK_CHECKOUT_DORDER_DSC', '<div class="alert alert-warning">The standard delivery time is %s days!</div>');
define('_MA_XMSTOCK_CHECKOUT_ERRORQTY', 'The quantity requested for items with the logo <span class="badge badge-pill badge-danger">Error</span> is greater than that available in stock. <br>This is not possible in the case of a loan! The quantity has therefore been adapted.');
define('_MA_XMSTOCK_CHECKOUT_INFORMATION', 'Please return articles with the logo <span class="badge badge-pill badge-light">' . _MA_XMSTOCK_STOCK_LOAN . '</span> within a reasonable timeframe');
define('_MA_XMSTOCK_CHECKOUT_INPUTINF', 'Input information');
define('_MA_XMSTOCK_CHECKOUT_SEND', 'Order sent');
define('_MA_XMSTOCK_CHECKOUT_CONFIRM', 'Confirmation');
define('_MA_XMSTOCK_CHECKOUT_CONFIRM_SEND', 'Your order has been sent with the following information:');
define('_MA_XMSTOCK_CHECKOUT_SUMMARY', 'Summary of your cart');
define('_MA_XMSTOCK_CHECKOUT_VIEW', 'Track this order');
define('_MA_XMSTOCK_CHECKOUT_WARNINGQTY', 'The quantity requested for items with the logo <span class="badge badge-pill badge-warning">Warning</span> is greater than that available in stock. <br>The delivery time could be longer!');
define('_MA_XMSTOCK_CHECKOUT_WARNINGQTY2', 'If the desired article is in stock but not in sufficient quantity and you wish to obtain the quantity in stock before the total, please split the order into 2.');

// caddy
define('_MA_XMSTOCK_CADDY_NEEDSYEARS', 'Need');
define('_MA_XMSTOCK_CADDY_LENGHT', 'Lenght');
define('_MA_XMSTOCK_CADDY_WIDTH', 'Width');
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
define('_MA_XMSTOCK_CADDY_ERROR_NOORDER', 'The article cannot be ordered (the order restriction is enabled)');
define('_MA_XMSTOCK_CADDY_ERROR_NOPERMISSION', 'You do not have permission to order in this area');
define('_MA_XMSTOCK_CADDY_ERROR_NOLOAN', 'This article cannot be borrowed at the moment!');
define('_MA_XMSTOCK_CADDY_WARNING_AREA', 'Warning, you can order multiple articles but only if they are in the same stock. If you want to order the article below, you need to make another order');

// order
define('_MA_XMSTOCK_ORDER_ARTICLES', 'Ordered articles');
define('_MA_XMSTOCK_ORDER_DATECANCELLATION', 'Cancellation date');
define('_MA_XMSTOCK_ORDER_DATEDELIVERY', 'Planned delivery date');
define('_MA_XMSTOCK_ORDER_DATEDELIVERY_R', 'Delivery Date');
define('_MA_XMSTOCK_ORDER_DATEDELIVERYWITHDRAWAL', 'Validated delivery/withdrawal date');
define('_MA_XMSTOCK_ORDER_DATEDELIVERYWITHDRAWAL_R', 'Order ready date');
define('_MA_XMSTOCK_ORDER_DATEDESIRED', 'Desired date');
define('_MA_XMSTOCK_ORDER_DATEORDER', 'Order date');
define('_MA_XMSTOCK_ORDER_DATEREADY', 'Order ready date');
define('_MA_XMSTOCK_ORDER_DATEVALIDATION', 'Order validation date');
define('_MA_XMSTOCK_ORDER_DATEWITHDRAWAL', 'Planned withdrawal date');
define('_MA_XMSTOCK_ORDER_DATEWITHDRAWAL_R', 'Date of withdrawal');
define('_MA_XMSTOCK_ORDER_HISTORY', 'Order history');
define('_MA_XMSTOCK_ORDER_ORDER', 'Order No. %s');
define('_MA_XMSTOCK_ORDER_DESCRIPTION', 'Description');
define('_MA_XMSTOCK_ORDER_DELIVERY', 'Delivery options');
define('_MA_XMSTOCK_ORDER_DELIVERY_WITHDRAWAL', 'Withdrawal');
define('_MA_XMSTOCK_ORDER_DELIVERY_DELIVERY', 'Delivery');
define('_MA_XMSTOCK_ORDER_STATUS_0', 'Cancelled');
define('_MA_XMSTOCK_ORDER_STATUS_1', 'Pending');
define('_MA_XMSTOCK_ORDER_STATUS_2', 'In progress');
define('_MA_XMSTOCK_ORDER_STATUS_3', 'Delivery/withdrawal');
define('_MA_XMSTOCK_ORDER_STATUS_4', 'Delivered');
define('_MA_XMSTOCK_ORDER_STATUS_TITLE_0', 'Cancelled orders');
define('_MA_XMSTOCK_ORDER_STATUS_TITLE_1', 'Pending orders');
define('_MA_XMSTOCK_ORDER_STATUS_TITLE_2', 'Orders in progress');
define('_MA_XMSTOCK_ORDER_STATUS_TITLE_3', 'Orders ready (delivery/withdrawal)');
define('_MA_XMSTOCK_ORDER_STATUS_TITLE_4', 'Delivered orders');
define('_MA_XMSTOCK_ORDER_SUREDEL', 'Sure to delete this order? #%s');
define('_MA_XMSTOCK_ORDERS', 'Orders');

// vieworder
define('_MA_XMSTOCK_VIEWORDER_AMOUNT', 'Amount');
define('_MA_XMSTOCK_VIEWORDER_ARTICLE', 'Article');
define('_MA_XMSTOCK_VIEWORDER_ORDER', 'Order #');

// management
define('_MA_XMSTOCK_MANAGEMENT', 'Orders management');
define('_MA_XMSTOCK_MANAGEMENT_ALLORDERS', 'All orders');
define('_MA_XMSTOCK_MANAGEMENT_AREA', 'Stock');
define('_MA_XMSTOCK_MANAGEMENT_CANCELED', 'Canceled orders');
define('_MA_XMSTOCK_MANAGEMENT_CUSTOMER', 'Customer');
define('_MA_XMSTOCK_MANAGEMENT_DELIVRED', 'Orders delivered');
define('_MA_XMSTOCK_MANAGEMENT_PREPARATION', 'Orders in preparation');
define('_MA_XMSTOCK_MANAGEMENT_READY', 'Orders ready');
define('_MA_XMSTOCK_MANAGEMENT_SORTORDER', 'Order number');
define('_MA_XMSTOCK_MANAGEMENT_TOPROCESS', 'Orders to process');
define('_MA_XMSTOCK_MANAGEMENT_VIEW', 'Visualization an order');
define('_MA_XMSTOCK_MANAGEMENT_VIEWALL', 'Visualization of orders');

//action.php
define('_MA_XMSTOCK_ACTION_ARTICLES', 'Articles');
define('_MA_XMSTOCK_ACTION_EDIT', 'Edition of an order');
define('_MA_XMSTOCK_ACTION_EDITSTOCK', 'Edition of a stock');
define('_MA_XMSTOCK_ACTION_INFODELARTICLE', 'Put "0" to delete an article');
define('_MA_XMSTOCK_ACTION_NEXT1', 'Order validation form');
define('_MA_XMSTOCK_ACTION_NEXT2', 'Order preparation form');
define('_MA_XMSTOCK_ACTION_NEXT3', 'Order delivery form');
define('_MA_XMSTOCK_ACTION_SPLIT', 'Split');
define('_MA_XMSTOCK_ACTION_SPLIT_AMOUNT', 'Quantity');
define('_MA_XMSTOCK_ACTION_SPLIT_DESC', 'The articles selected in "Split" will be grouped in a new order. If the "Quantity" is set to 0, all the quantity of the article will be transferred to a new order. If the "Quantity" does not contain 0, then the specified quantity will remain in this order and the balance will be transferred to the new order');
define('_MA_XMSTOCK_ACTION_SPLIT_TEXT', 'This order is a split order (original order: %s)');
define('_MA_XMSTOCK_ACTION_TRANSFERT_REF', 'Order %s');
define('_MA_XMSTOCK_ACTION_TRANSFERT_DESC', 'Order from %s with number %s');
define('_MA_XMSTOCK_ACTION_WARNING_STATUS2', 'Once this form is validated, the articles will be deducted from stock!');
define('_MA_XMSTOCK_ACTION_WARNING_STATUS3', 'Once this form is validated, the order will be considered delivered (articles delivered or withdrawn).');

// viewprice.php
define('_MA_XMSTOCK_VIEWPRICE_AMOUNT', 'Quantity transferred');
define('_MA_XMSTOCK_VIEWPRICE_AVERAGEPRICE', 'Average price: ');
define('_MA_XMSTOCK_VIEWPRICE_DASHBOARD', 'Dashboard');
define('_MA_XMSTOCK_VIEWPRICE_DATE', 'Date');
define('_MA_XMSTOCK_VIEWPRICE_EXPORT', 'Export');
define('_MA_XMSTOCK_VIEWPRICE_FILTER', 'Filter');
define('_MA_XMSTOCK_VIEWPRICE_PERPAGE', 'per page');
define('_MA_XMSTOCK_VIEWPRICE_PRICE', 'Prix');
define('_MA_XMSTOCK_VIEWPRICE_PRICECHF', 'Price in CHF');

// loan.php
define('_MA_XMSTOCK_LOAN_ADD', 'Adding a loan');
define('_MA_XMSTOCK_LOAN_AMOUNT', 'Amount');
define('_MA_XMSTOCK_LOAN_AREA', 'Stock');
define('_MA_XMSTOCK_LOAN_ARTICLE', 'Article to lend');
define('_MA_XMSTOCK_LOAN_DATE', 'Loan date');
define('_MA_XMSTOCK_LOAN_EDIT', 'Edition of a loan');
define('_MA_XMSTOCK_LOAN_FORM', 'Loan form');
define('_MA_XMSTOCK_LOAN_LARTICLE', 'Borrowed article');
define('_MA_XMSTOCK_LOAN_LIST', 'List of loans');
define('_MA_XMSTOCK_LOAN_RDATE', 'Return date');
define('_MA_XMSTOCK_LOAN_STATUS', 'Loan status');
define('_MA_XMSTOCK_LOAN_STATUS_L', 'On loan');
define('_MA_XMSTOCK_LOAN_STATUS_C', 'Loan closed');
define('_MA_XMSTOCK_LOAN_TRANSFERT_DESC', 'Loan from %s with number %s');
define('_MA_XMSTOCK_LOAN_TRANSFERT_REF', 'Loan %s');
define('_MA_XMSTOCK_LOAN_USERID', 'Loan recipient');
define('_MA_XMSTOCK_LOAN_USERSLIST', 'List of borrowers');

//overdraft.php
define('_MA_XMSTOCK_OVERDRAFT_ALL', 'All overdrafts');
define('_MA_XMSTOCK_OVERDRAFT_AMOUNT', 'Quantity');
define('_MA_XMSTOCK_OVERDRAFT_AREA', 'Stock');
define('_MA_XMSTOCK_OVERDRAFT_ARTICLE', 'Article');
define('_MA_XMSTOCK_OVERDRAFT_NOOVERDRAFT', 'No articles below the minimum amount');
