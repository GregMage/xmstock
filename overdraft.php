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
$GLOBALS['xoopsOption']['template_main'] = 'xmstock_overdraft.tpl';
include_once XOOPS_ROOT_PATH . '/header.php';

$xoTheme->addStylesheet(XOOPS_URL . '/modules/' . $xoopsModule->getVar('dirname', 'n') . '/assets/css/styles.css', null);

// Get Permission to manage
$managePermissionArea = XmstockUtility::getPermissionArea('xmstock_manage');

if (empty($managePermissionArea)) {
	redirect_header('index.php', 2, _NOPERM);
}

$xoopsTpl->assign('index_module', $helper->getModule()->getVar('name'));

// Get start pager
$start = Request::getInt('start', 0);
//filters
$area_id = Request::getInt('area_id', 0);
$xoopsTpl->assign('area_id', $area_id);
$sort = Request::getString('sort', 'ASC');
$xoopsTpl->assign('sort', $sort);
$filter = Request::getInt('filter', 10);
$xoopsTpl->assign('filter', $filter);
//area
$area = array();
$area[0] = '';
$criteria = new CriteriaCompo();
$criteria->setSort('area_weight ASC, area_name');
$criteria->setOrder('ASC');
$area_arr = $areaHandler->getall($criteria);
if (count($area_arr) > 0) {
	$area_options = '<option value="0"' . ($area_id == 0 ? ' selected="selected"' : '') . '>' . _ALL .'</option>';
	foreach (array_keys($area_arr) as $i) {
		if (in_array($i, $managePermissionArea)){
			$area_options .= '<option value="' . $i . '"' . ($area_id == $i ? ' selected="selected"' : '') . '>' . $area_arr[$i]->getVar('area_name') . '</option>';
		}
		$area[$i] = $area_arr[$i]->getVar('area_name');
	}
	$xoopsTpl->assign('area_options', $area_options);

}

// Criteria overdraft
$criteria = new CriteriaCompo();
$criteria->setSort('stock_amount');
$criteria->setStart($start);
$criteria->setLimit($filter);
$criteria->setOrder($sort);
if (!empty($managePermissionArea)) {
	$criteria->add(new Criteria('stock_areaid', '(' . implode(',', $managePermissionArea) . ')', 'IN'));
}
if ($area_id != 0) {
	$criteria->add(new Criteria('stock_areaid', $area_id));
}
$criteria->add(new Criteria('stock_amount', '`stock_mini`', '<='));
$criteria->add(new Criteria('stock_mini', 0, '!='));
$criteria->add(new Criteria('article_status', 1));
$stockHandler->table_link = $stockHandler->db->prefix("xmarticle_article");
$stockHandler->field_link = "article_id";
$stockHandler->field_object = "stock_articleid";
$stock_arr = $stockHandler->getByLink($criteria);
$stock_count = $stockHandler->getCountByLink($criteria);

$xoopsTpl->assign('overdraft_count', $stock_count);
if ($stock_count > 0 && !empty($managePermissionArea)) {
	foreach (array_keys($stock_arr) as $i) {
		$overdraft['article_id']	= $stock_arr[$i]->getVar('article_id');
		$overdraft['article_cid']	= $stock_arr[$i]->getVar('article_cid');
		$overdraft['article_name']	= $stock_arr[$i]->getVar('article_name');
		$overdraft['article_ref']	= $stock_arr[$i]->getVar('article_reference');
		$overdraft['area_name']		= $area[$stock_arr[$i]->getVar('stock_areaid')];
		$overdraft['amount']		= $stock_arr[$i]->getVar('stock_amount');
		$overdraft['mini']	= $stock_arr[$i]->getVar('stock_mini');
		$xoopsTpl->appendByRef('overdrafts', $overdraft);
		unset($overdraft);
	}
	// Display Page Navigation
	if ($stock_count > $filter) {
		$nav = new XoopsPageNav($stock_count, $filter, $start, 'start', 'area_id=' . $area_id .'&sort=' . $sort . '&filter=' . $filter);
		$xoopsTpl->assign('nav_menu', $nav->renderNav(4));
	}
}

//SEO
// pagetitle
$xoopsTpl->assign('xoops_pagetitle', _MI_XMSTOCK_SUB_OVERDRAFT . ' - ' . $xoopsModule->name());
include XOOPS_ROOT_PATH . '/footer.php';
