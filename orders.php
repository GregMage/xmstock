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
use Xmf\Request;
use Xmf\Module\Helper;

include_once __DIR__ . '/header.php';
$GLOBALS['xoopsOption']['template_main'] = 'xmstock_order.tpl';
include_once XOOPS_ROOT_PATH . '/header.php';

$xoopsTpl->assign('index_module', $helper->getModule()->getVar('name'));
$xoopsTpl->assign('pill_A', 2);
$xoopsTpl->assign('pill_B', 3);
$xoopsTpl->assign('pill_C', 0);
$xoopsTpl->assign('pill_D', 1);
$xoopsTpl->assign('pill_E', 4);
$xoopsTpl->assign('pill_F', 60);


//SEO
// pagetitle
$xoopsTpl->assign('xoops_pagetitle', _MA_XMSTOCK_ORDERS . ' - ' . $xoopsModule->name());
include XOOPS_ROOT_PATH . '/footer.php';