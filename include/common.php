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
 * @copyright       XOOPS Project (http://xoops.org)
 * @license         GNU GPL 2 (http://www.gnu.org/licenses/old-licenses/gpl-2.0.html)
 * @author          Mage Gregory (AKA Mage)
 */
class_exists('\Xmf\Module\Admin') or die('XMF is required.');
use Xmf\Module\Helper;
$helper = Helper::getHelper(basename(dirname(__DIR__)));

// Get handler
$areaHandler = $helper->getHandler('xmstock_area');
$outputHandler = $helper->getHandler('xmstock_output');
$stockHandler = $helper->getHandler('xmstock_stock');
$transferHandler = $helper->getHandler('xmstock_transfer');
$orderHandler = $helper->getHandler('xmstock_order');
$itemorderHandler = $helper->getHandler('xmstock_itemorder');

// Path & url Config
$url_logo_area = XOOPS_UPLOAD_URL . '/xmstock/images/area/';
$path_logo_area = XOOPS_UPLOAD_PATH . '/xmstock/images/area/';