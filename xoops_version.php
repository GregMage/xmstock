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
$modversion['dirname']     = basename(__DIR__);
$modversion['name']        = ucfirst(basename(__DIR__));
$modversion['version']     = '0.1.0-Alpha1';
$modversion['description'] = _MI_XMSTOCK_DESC;
$modversion['author']      = 'Grégory Mage (Mage)';
$modversion['url']         = 'https://github.com/GregMage';
$modversion['credits']     = 'Mage';

$modversion['help']        = 'page=help';
$modversion['license']     = 'GNU GPL 3 or later';
$modversion['license_url'] = 'http://www.gnu.org/licenses/gpl-3.0.html';
$modversion['official']    = 0;
$modversion['image']       = 'assets/images/xmstock_logo.png';

// Menu
$modversion['hasMain'] = 1;
$modversion['sub'][]   = [
    'name' => _MI_XMSTOCK_SUB_CADDY,
    'url'  => 'caddy.php'
];
$modversion['sub'][]   = [
    'name' => _MI_XMSTOCK_SUB_ORDERS,
    'url'  => 'order.php'
];
$modversion['sub'][]   = [
    'name' => _MI_XMSTOCK_SUB_ORDERSMANAGEMENT,
    'url'  => 'management.php'
];
$modversion['sub'][]   = [
    'name' => _MI_XMSTOCK_SUB_TRANSFER,
    'url'  => 'transfer.php'
];
$modversion['sub'][]   = [
    'name' => _MI_XMSTOCK_SUB_LOAN,
    'url'  => 'loan.php'
];

// Admin things
$modversion['hasAdmin']    = 1;
$modversion['system_menu'] = 1;
$modversion['adminindex']  = 'admin/index.php';
$modversion['adminmenu']   = 'admin/menu.php';

// Install and update
$modversion['onInstall']        = 'include/install.php';
//$modversion['onUpdate']         = 'include/update.php';

// Tables
$modversion['sqlfile']['mysql'] = 'sql/mysql.sql';

$modversion['tables'][1] = 'xmstock_area';
$modversion['tables'][2] = 'xmstock_transfer';
$modversion['tables'][3] = 'xmstock_stock';
$modversion['tables'][4] = 'xmstock_output';
$modversion['tables'][6] = 'xmstock_order';
$modversion['tables'][7] = 'xmstock_itemorder';
$modversion['tables'][8] = 'xmstock_price';
$modversion['tables'][9] = 'xmstock_loan';


// Admin Templates
$modversion['templates'][] = array('file' => 'xmstock_admin_area.tpl', 'description' => '', 'type' => 'admin');
$modversion['templates'][] = array('file' => 'xmstock_admin_output.tpl', 'description' => '', 'type' => 'admin');
$modversion['templates'][] = array('file' => 'xmstock_admin_stock.tpl', 'description' => '', 'type' => 'admin');
$modversion['templates'][] = array('file' => 'xmstock_admin_transfer.tpl', 'description' => '', 'type' => 'admin');

// User Templates
$modversion['templates'][] = ['file' => 'xmstock_index.tpl', 'description' => ''];
$modversion['templates'][] = ['file' => 'xmstock_viewstocks.tpl', 'description' => ''];
$modversion['templates'][] = ['file' => 'xmstock_viewarea.tpl', 'description' => ''];
$modversion['templates'][] = ['file' => 'xmstock_caddy.tpl', 'description' => ''];
$modversion['templates'][] = ['file' => 'xmstock_checkout.tpl', 'description' => ''];
$modversion['templates'][] = ['file' => 'xmstock_order.tpl', 'description' => ''];
$modversion['templates'][] = ['file' => 'xmstock_vieworder.tpl', 'description' => ''];
$modversion['templates'][] = ['file' => 'xmstock_management.tpl', 'description' => ''];
$modversion['templates'][] = ['file' => 'xmstock_action.tpl', 'description' => ''];
$modversion['templates'][] = ['file' => 'xmstock_viewprice.tpl', 'description' => ''];
$modversion['templates'][] = ['file' => 'xmstock_transfer.tpl', 'description' => ''];
$modversion['templates'][] = ['file' => 'xmstock_loan.tpl', 'description' => ''];

// Configs
$modversion['config'] = [];

$modversion['config'][] = [
    'name'        => 'break',
    'title'       => '_MI_XMSTOCK_PREF_HEAD_GENERAL',
    'description' => '',
    'formtype'    => 'line_break',
    'valuetype'   => 'text',
    'default'     => 'head',
];

$modversion['config'][] = [
    'name'        => 'general_perpage',
    'title'       => '_MI_XMSTOCK_PREF_GENERALITEMPERPAGE',
    'description' => '',
    'formtype'    => 'textbox',
    'valuetype'   => 'int',
    'default'     => 15
];

$optionPrice[_MI_XMSTOCK_PREF_PRICE_0] = 0;
$optionPrice[_MI_XMSTOCK_PREF_PRICE_1] = 1;
$optionPrice[_MI_XMSTOCK_PREF_PRICE_2] = 2;
$modversion['config'][] = [
    'name'        => 'general_price',
    'title'       => '_MI_XMSTOCK_PREF_PRICE',
    'description' => '_MI_XMSTOCK_PREF_PRICE_DESC',
    'formtype'    => 'select',
    'valuetype'   => 'int',
    'default'     => 0,
	'options' => $optionPrice,
];

xoops_load('xoopseditorhandler');
$editorHandler = XoopsEditorHandler::getInstance();
$modversion['config'][] = [
    'name'        => 'general_editor',
    'title'       => '_MI_XMSTOCK_PREF_EDITOR',
    'description' => '',
    'formtype'    => 'select',
    'valuetype'   => 'text',
    'default'     => 'dhtmltextarea',
    'options'     => array_flip($editorHandler->getList())
];

$modversion['config'][] = [
    'name'        => 'general_captcha',
    'title'       => '_MI_XMSTOCK_PREF_CAPTCHA',
    'description' => '_MI_XMSTOCK_PREF_CAPTCHA_DESC',
    'formtype'    => 'yesno',
    'valuetype'   => 'int',
    'default'     => 0
];

$optionMaxsize['0.1 ' . _MI_XMSTOCK_PREF_MAXUPLOADSIZE_MBYTES] = 104858;
$optionMaxsize['0.5 ' . _MI_XMSTOCK_PREF_MAXUPLOADSIZE_MBYTES] = 1024*1024*0.5;
$optionMaxsize['1 ' . _MI_XMSTOCK_PREF_MAXUPLOADSIZE_MBYTES] = 1024*1024*1;
$optionMaxsize['1.5 ' . _MI_XMSTOCK_PREF_MAXUPLOADSIZE_MBYTES] = 1024*1024*1.5;
$optionMaxsize['2 ' . _MI_XMSTOCK_PREF_MAXUPLOADSIZE_MBYTES] = 1024*1024*2;
$optionMaxsize['5 ' . _MI_XMSTOCK_PREF_MAXUPLOADSIZE_MBYTES] = 1024*1024*5;
$optionMaxsize['10 ' . _MI_XMSTOCK_PREF_MAXUPLOADSIZE_MBYTES] = 1024*1024*10;
$modversion['config'][] = [
    'name'        => 'general_maxuploadsize',
    'title'       => '_MI_XMSTOCK_PREF_MAXUPLOADSIZE',
    'description' => '_MI_XMSTOCK_PREF_MAXUPLOADSIZE_DESC',
    'formtype'    => 'select',
    'valuetype'   => 'int',
    'default'     => 104858,
	'options' => $optionMaxsize,
];

$modversion['config'][] = [
    'name'        => 'break',
    'title'       => '_MI_XMSTOCK_PREF_HEAD_ADMIN',
    'description' => '',
    'formtype'    => 'line_break',
    'valuetype'   => 'text',
    'default'     => 'head',
];

$modversion['config'][] = [
    'name'        => 'admin_perpage',
    'title'       => '_MI_XMSTOCK_PREF_ITEMPERPAGE',
    'description' => '',
    'formtype'    => 'textbox',
    'valuetype'   => 'int',
    'default'     => 15
];

// About stuff
$modversion['release_date']  = '2017/11/04';

$modversion['developer_lead']      = 'Mage';
$modversion['module_website_url']  = 'github.com/GregMage';
$modversion['module_website_name'] = 'github.com/GregMage';

$modversion['min_xoops'] = '2.5.10';
$modversion['min_php']   = '7.0';
