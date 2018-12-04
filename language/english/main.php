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
define('_MA_XMSTOCK_REDIRECT_SAVE', 'Successfully saved');
define('_MA_XMSTOCK_STATUS', 'Status');
define('_MA_XMSTOCK_STATUS_A', 'Active');
define('_MA_XMSTOCK_STATUS_NA', 'Disabled');
define('_MA_XMSTOCK_STATUS_EXECUTED', 'Executed');
define('_MA_XMSTOCK_STATUS_WAITING', 'Waiting');

define('_MA_XMSTOCK_VIEW', 'View');

// Error message
define('_MA_XMSTOCK_ERROR_NOAREA', 'There are no areas in the database');
define('_MA_XMSTOCK_ERROR_NOOUTPUT', 'There are no outputs in the database');
define('_MA_XMSTOCK_ERROR_NOSTOCK', 'There are no stocks in the database');
define('_MA_XMSTOCK_ERROR_NOTRANSFER', 'There are no transfers in the database');
define('_MA_XMSTOCK_ERROR_WEIGHT', 'Weight must be a number');
define('_MA_XMSTOCK_ERROR_AMOUNT', 'Amount must be a number');
define('_MA_XMSTOCK_ERROR_ARTICLEID', 'There is no article selected');

// area
define('_MA_XMSTOCK_AREA_DESC', 'Description');
define('_MA_XMSTOCK_AREA_FORMPATH', 'Files are in: %s');
define('_MA_XMSTOCK_AREA_LOCATION', 'Location');
define('_MA_XMSTOCK_AREA_LOGO', 'Logo');
define('_MA_XMSTOCK_AREA_LOGOFILE', 'Logo file');
define('_MA_XMSTOCK_AREA_NAME', 'Name');
define('_MA_XMSTOCK_AREA_SIZE', 'Maximum upload size');
define('_MA_XMSTOCK_AREA_SUREDEL', 'Sure to delete this area? %s');
define('_MA_XMSTOCK_AREA_UPLOAD', 'Upload');
define('_MA_XMSTOCK_AREA_UPLOADSIZE', 'Maximum size: %s kB');
define('_MA_XMSTOCK_AREA_WEIGHT', 'Weight');

//output
define('_MA_XMSTOCK_OUTPUT_DESC', 'Description');
define('_MA_XMSTOCK_OUTPUT_NAME', 'Name');
define('_MA_XMSTOCK_OUTPUT_SUREDEL', 'Sure to delete this output? %s');
define('_MA_XMSTOCK_OUTPUT_USERID', 'Receiver');
define('_MA_XMSTOCK_OUTPUT_WEIGHT', 'Weight');

//transfer
define('_MA_XMSTOCK_TRANSFER_REF', 'Transfer reference');
define('_MA_XMSTOCK_TRANSFER_ARTICLE', 'Article to transfer');
define('_MA_XMSTOCK_TRANSFER_DESC', 'Description of the transfer');
define('_MA_XMSTOCK_TRANSFER_AMOUNT', 'Amount');
define('_MA_XMSTOCK_TRANSFER_ARAREA', 'Destination stock');
define('_MA_XMSTOCK_TRANSFER_STAREA', 'Starting stock');
define('_MA_XMSTOCK_TRANSFER_OUTPUT', 'Output');
define('_MA_XMSTOCK_TRANSFER_DATE', 'Date');
define('_MA_XMSTOCK_TRANSFER_TYPE', 'Type of transfer');
define('_MA_XMSTOCK_TRANSFER_USER', 'User');
define('_MA_XMSTOCK_TRANSFER_SUREDEL', 'Sure to delete this transfer? %s');



// permission
define('_MA_XMSTOCK_PERMISSION_MANAGE', 'Manage Permissions');
define('_MA_XMSTOCK_PERMISSION_MANAGE_DSC', 'Select groups that can manage this area');
define('_MA_XMSTOCK_PERMISSION_SUPERVISE', 'Supervisor Permissions');
define('_MA_XMSTOCK_PERMISSION_SUPERVISE_DSC', 'Select groups that can supervise this area');
define('_MA_XMSTOCK_PERMISSION_VIEW', 'View Permissions');
define('_MA_XMSTOCK_PERMISSION_VIEW_DSC', 'Select groups that can view in this area');
define('_MA_XMSTOCK_PERMISSION_REQUEST', 'request permission');
define('_MA_XMSTOCK_PERMISSION_REQUEST_DSC', 'Select groups that can request an article in this area');
define('_MA_XMSTOCK_PERMISSION_OTHER', 'Other permissions');
define('_MA_XMSTOCK_PERMISSION_OTHER_DSC', 'Select groups that can:');
define('_MA_XMSTOCK_PERMISSION_OTHER_4', '');
define('_MA_XMSTOCK_PERMISSION_OTHER_8', '');

// Admin
define('_MA_XMSTOCK_INDEXCONFIG_XMARTICLE_ERROR', 'You must install the xmarticle module to use xmstock');

 