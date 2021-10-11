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
$GLOBALS['xoopsOption']['template_main'] = 'xmstock_index.tpl';
include_once XOOPS_ROOT_PATH . '/header.php';

$xoTheme->addStylesheet(XOOPS_URL . '/modules/' . $xoopsModule->getVar('dirname', 'n') . '/assets/css/styles.css', null);

// Get Permission to view
$viewPermissionArea = XmstockUtility::getPermissionArea('xmstock_view');

// Get stock
$criteria = new CriteriaCompo();
$stock_arr = $stockHandler->getall($criteria);

// Get start pager
$start = Request::getInt('start', 0);

$xoopsTpl->assign('index_module', $helper->getModule()->getVar('name'));
// Criteria
$criteria = new CriteriaCompo();
$criteria->setSort('area_weight ASC, area_name');
$criteria->setOrder('ASC');
$criteria->setStart($start);
$criteria->setLimit($nb_limit);
$criteria->add(new Criteria('area_status', 1));
if (!empty($viewPermissionAreat)) {
    $criteria->add(new Criteria('area_id', '(' . implode(',', $viewPermissionArea) . ')', 'IN'));
}
$area_arr = $areaHandler->getall($criteria);
$area_count = $areaHandler->getCount($criteria);
$xoopsTpl->assign('area_count', $area_count);
$keywords = '';
if ($area_count > 0 && !empty($viewPermissionArea)) {
    foreach (array_keys($area_arr) as $i) {
		$area_id                 = $area_arr[$i]->getVar('area_id');
		$area['id']              = $area_id;
		$area['name']            = $area_arr[$i]->getVar('area_name');
		$area['description']     = \Xmf\Metagen::generateDescription($area_arr[$i]->getVar('area_description', 'show'), 30);
		$area['location']        = $area_arr[$i]->getVar('area_location');
		$area['totalarticle']    = sprintf(_MA_XMSTOCK_AREA_THEREAREARTICLE, XmstockUtility::articlePerArea($area_id, $stock_arr));
		$area_img             	 = $area_arr[$i]->getVar('area_logo');
		if ($area_img == ''){
			$area['logo']        = '';
		} else {
			$area['logo']        = $url_logo_area . $area_img;
		}
		$color					 = $area_arr[$i]->getVar('area_color');
		if ($color == '#ffffff'){
			$area['color']	 	 = false;
		} else {
			$area['color']	  	 = $color;
		}
		$xoopsTpl->append_by_ref('areas', $area);
        if ($keywords == '') {
            $keywords = $area_arr[$i]->getVar('area_name');
        } else {
            $keywords = $keywords . ',' . $area_arr[$i]->getVar('area_name');
        }
        unset($area);
    }
    // Display Page Navigation
    if ($area_count > $nb_limit) {
        $nav = new XoopsPageNav($area_count, $nb_limit, $start, 'start');
        $xoopsTpl->assign('nav_menu', $nav->renderNav(4));
    }
}
//SEO
// pagetitle
$xoopsTpl->assign('xoops_pagetitle', $xoopsModule->name());
//keywords
$xoTheme->addMeta('meta', 'keywords', $keywords);
include XOOPS_ROOT_PATH . '/footer.php';
