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
$GLOBALS['xoopsOption']['template_main'] = 'xmstock_viewarea.tpl';
include_once XOOPS_ROOT_PATH . '/header.php';

$xoTheme->addStylesheet(XOOPS_URL . '/modules/' . $xoopsModule->getVar('dirname', 'n') . '/assets/css/styles.css', null);

$area_id = Request::getInt('area_id', 0);

$xoopsTpl->assign('index_module', $helper->getModule()->getVar('name'));

if ($area_id == 0) {
    redirect_header('index.php', 2, _MA_XMSTOCK_ERROR_NOAREA);
}
// permission to view
$permHelper->checkPermissionRedirect('xmstock_view', $area_id, 'index.php', 2, _NOPERM);
// Get Permission to order
$orderPermissionArea = XmstockUtility::getPermissionArea('xmstock_order');
// Get Permission to manage
$managePermissionArea = XmstockUtility::getPermissionArea('xmstock_manage');

$area  = $areaHandler->get($area_id);

if (empty($area)) {
    redirect_header('index.php', 2, _MA_XMSTOCK_ERROR_NOAREA);
}

if ($helper->isUserAdmin() != true){
	if ($area->getVar('area_status') == 0) {
		redirect_header('index.php', 2, _MA_XMSTOCK_ERROR_NACTIVE);
	}
}

if (in_array($area_id, $orderPermissionArea) == true){
	$xoopsTpl->assign('order', true);
} else {
	$xoopsTpl->assign('order', false);
}

if (in_array($area_id, $managePermissionArea) == true){
	$xoopsTpl->assign('manage', true);
} else {
	$xoopsTpl->assign('manage', false);
}
// Area
$xoopsTpl->assign('area_id', $area_id);
$xoopsTpl->assign('name', $area->getVar('area_name'));
$xoopsTpl->assign('description', $area->getVar('area_description'));
$xoopsTpl->assign('location', $area->getVar('area_location'));
$area_img = $area->getVar('area_logo') ?: 'blank.gif';
$xoopsTpl->assign('logo', $url_logo_area . $area_img);

//Search form
// get values
$search = Request::getString('search', '');
$reset  = Request::getString('reset', '');
if ($reset == '') {
    $s_name  = Request::getString('s_name', '');
    $s_ref   = Request::getString('s_ref', '');
    $s_amty  = Request::getString('s_amty', '');
    $s_amval = Request::getInt('s_amval', 0);
	$s_sort  = Request::getString('s_sort', 'ADESC');
} else {
    $s_name  = '';
    $s_ref   = '';
    $s_amty  = '';
    $s_amval = 0;
    $s_sort = 'ADESC';
}


$form = new XoopsThemeForm(_MA_XMSTOCK_AREA_FILTERFORM, 'form', $_SERVER['REQUEST_URI'], 'post', true);
// name
$form->addElement(new XoopsFormText(_MA_XMSTOCK_AREA_ARTICLENAME, 's_name', 50, 255, $s_name));
//reference
$form->addElement(new XoopsFormText(_MA_XMSTOCK_AREA_ARTICLEREFERENCE, 's_ref', 50, 255, $s_ref));
// amount
$amount = new \XoopsFormElementTray(_MA_XMSTOCK_AREA_AMOUNT);
$amount_type = new \XoopsFormSelect('', 's_amty', $s_amty);
$typeArray = [
	''   => '',
	'<'  => _MA_XMSTOCK_AREA_AMOUNTTYPE1,
	'<=' => _MA_XMSTOCK_AREA_AMOUNTTYPE2,
	'='  => _MA_XMSTOCK_AREA_AMOUNTTYPE3,
	'>'  => _MA_XMSTOCK_AREA_AMOUNTTYPE4,
	'>=' => _MA_XMSTOCK_AREA_AMOUNTTYPE5
];
$amount_type->addOptionArray($typeArray);
$amount->addElement($amount_type);
$amount->addElement(new \XoopsFormText('', 's_amval', 10, 10, $s_amval));
$form->addElement($amount);
//Sort
$sort = new \XoopsFormSelect(_MA_XMSTOCK_AREA_SORT, 's_sort', $s_sort);
$sortArray = [
	'NASC'  => _MA_XMSTOCK_AREA_SORT1,
	'NDESC' => _MA_XMSTOCK_AREA_SORT2,
	'AASC'  => _MA_XMSTOCK_AREA_SORT3,
	'ADESC' => _MA_XMSTOCK_AREA_SORT4,
];
$sort->addOptionArray($sortArray);
$form->addElement($sort);
// search
$button = new XoopsFormElementTray('');
$button->addElement(new XoopsFormButton('', 'search', _SEARCH, 'submit'));
$button->addElement(new XoopsFormButton('', 'reset', _RESET, 'submit'));
$form->addElement($button);
$xoopsTpl->assign('form', $form->render());

// Article
// Get start pager
$start = Request::getInt('start', 0);
$criteria = new CriteriaCompo();
$arguments = '';
if ($s_name != '') {
	$criteria->add(new Criteria('article_name', '%' . $s_name . '%', 'LIKE'));
	$arguments .= '&amp;s_name=' . $s_name;
}
if ($s_ref != '') {
	$criteria->add(new Criteria('article_reference', '%' . $s_ref . '%', 'LIKE'));
	$arguments .= '&amp;s_ref=' . $s_ref;
}
if ($s_amty != '' && $s_amval != 0) {
	$criteria->add(new Criteria('stock_amount', $s_amval, $s_amty));
	$arguments .= '&amp;s_amty=' . $s_amty . '&amp;s_amval=' . $s_amval;
}
switch ($s_sort) {
	case 'NASC';
		$criteria->setSort('article_name');
		$criteria->setOrder('ASC');
		break;

	case 'NDESC';
		$criteria->setSort('article_name');
		$criteria->setOrder('DESC');
		break;

	case 'AASC';
		$criteria->setSort('stock_amount');
		$criteria->setOrder('ASC');
		break;

	case 'ADESC';
	default:
		$criteria->setSort('stock_amount');
		$criteria->setOrder('DESC');
		break;
}
$arguments .= '&amp;s_sort=' . $s_sort;
$criteria->setStart($start);
$criteria->setLimit($nb_limit);
$criteria->add(new Criteria('stock_areaid', $area_id));
$criteria->add(new Criteria('article_status', 1));
$stockHandler->table_link = $stockHandler->db->prefix("xmarticle_article");
$stockHandler->field_link = "article_id";
$stockHandler->field_object = "stock_articleid";
$stock_arr = $stockHandler->getByLink($criteria);
$stock_count = $stockHandler->getCountByLink($criteria);
if ($stock_count > 0) {
	foreach (array_keys($stock_arr) as $i) {
		$stock['article_id']  = $stock_arr[$i]->getVar('article_id');
		$stock['article_cid'] = $stock_arr[$i]->getVar('article_cid');
		$stock['name']        = $stock_arr[$i]->getVar('article_name');
		$stock['reference']   = $stock_arr[$i]->getVar('article_reference');
		$stock['amount']      = $stock_arr[$i]->getVar('stock_amount');
		$stock['location_s']  = $stock_arr[$i]->getVar('stock_location');
		$stock['price']   	  = XmstockUtility::getPrice($stock_arr[$i]->getVar('stock_price'));
		$stock['borrower'] 	  = implode(', ', XmstockUtility::getBorrowerPerArticle($area_id , $stock['article_id']));
		$stock['type']   	  = $stock_arr[$i]->getVar('stock_type');
		if ($stock['type'] == 3){
			$stock['loan']    = true;
		} else {
			$stock['loan']    = false;
		}
		$xoopsTpl->append_by_ref('stock', $stock);
		unset($stock);
	}
	if ($stock_count > $nb_limit) {
        $nav = new XoopsPageNav($stock_count, $nb_limit, $start, 'start', 'area_id=' . $area_id . $arguments);
        $xoopsTpl->assign('nav_menu', $nav->renderNav(4));
    }
	$xoopsTpl->assign('xmstock_viewarticles', true);
}
//SEO
// pagetitle
$xoopsTpl->assign('xoops_pagetitle', $area->getVar('area_name') . '-' . $xoopsModule->name());
//description
$xoTheme->addMeta('meta', 'description', \Xmf\Metagen::generateDescription($area->getVar('area_description'), 30));
//keywords
$keywords = \Xmf\Metagen::generateKeywords($area->getVar('area_description'), 10);
$xoTheme->addMeta('meta', 'keywords', implode(', ', $keywords));
include XOOPS_ROOT_PATH . '/footer.php';
