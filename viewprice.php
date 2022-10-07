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

use \Xmf\Request;

include_once __DIR__ . '/header.php';
$GLOBALS['xoopsOption']['template_main'] = 'xmstock_viewprice.tpl';
include_once XOOPS_ROOT_PATH . '/header.php';

$xoTheme->addStylesheet(XOOPS_URL . '/modules/' . $xoopsModule->getVar('dirname', 'n') . '/assets/css/styles.css', null);

$area_id = Request::getInt('area_id', 0);

$xoopsTpl->assign('index_module', $helper->getModule()->getVar('name'));

if ($area_id == 0) {
    redirect_header('index.php', 2, _MA_XMSTOCK_ERROR_NOAREA);
}
// permission to view
$permHelper->checkPermissionRedirect('xmstock_other', 4, 'index.php', 2, _NOPERM);

//SEO
// pagetitle
//$xoopsTpl->assign('xoops_pagetitle', $area->getVar('area_name') . '-' . $xoopsModule->name());
//description
//$xoTheme->addMeta('meta', 'description', \Xmf\Metagen::generateDescription('A faire!!!!!!!!!!!!', 30));
include XOOPS_ROOT_PATH . '/footer.php';
