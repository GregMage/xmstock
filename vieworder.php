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
$GLOBALS['xoopsOption']['template_main'] = 'xmstock_vieworder.tpl';
include_once XOOPS_ROOT_PATH . '/header.php';

$xoopsTpl->assign('index_module', $helper->getModule()->getVar('name'));
$order_id = Request::getInt('order_id', 0);
if ($order_id == 0) {
	$xoopsTpl->assign('error_message', _MA_XMSTOCK_ERROR_NOORDER);
} else {
	$order = $orderHandler->get($order_id);
	if (empty($order) === true){
		$xoopsTpl->assign('error_message', _MA_XMSTOCK_ERROR_NOORDER);
	} else {
		$opt = Request::getString('opt', '');
		$xoopsTpl->assign('opt', $opt);
		$order  = $orderHandler->get($order_id);
		// Uniquement le propriétaire de la commande peut la voire ou le responsable du stock ou l'admin
		$managePermissionArea = XmstockUtility::getPermissionArea('xmstock_manage');
		$userid = !empty($xoopsUser) ? $xoopsUser->getVar('uid') : 0;
		if ($helper->isUserAdmin() != true){
			if (in_array($order->getVar('order_areaid'), $managePermissionArea) == false) {
				if ( $order->getVar('order_userid') != $userid){
					redirect_header('index.php', 2, _NOPERM);
				}
			}
		}
		$xoopsTpl->assign('orderid', $order_id);
		$xoopsTpl->assign('description', $order->getVar('order_description'));
		$xoopsTpl->assign('ddesired', formatTimestamp($order->getVar('order_ddesired'), 's'));
		$xoopsTpl->assign('dorder', formatTimestamp($order->getVar('order_dorder'), 'm'));
		$xoopsTpl->assign('user', XoopsUser::getUnameFromId($order->getVar('order_userid')));
		if ($order->getVar('order_dvalidation') == 0){
			$xoopsTpl->assign('dvalidation', '<span class="fa fa-ban fa-fw" aria-hidden="true"></span>');
		} else {
			$xoopsTpl->assign('dvalidation', formatTimestamp($order->getVar('order_dvalidation'), 'm'));
		}
		if ($order->getVar('order_ddelivery') == 0){
			$xoopsTpl->assign('ddelivery', '<span class="fa fa-ban fa-fw" aria-hidden="true"></span>');
		} else {
			$xoopsTpl->assign('ddelivery', formatTimestamp($order->getVar('order_ddelivery'), 's'));
		}
		if ($order->getVar('order_dready') == 0){
			$xoopsTpl->assign('dready', '<span class="fa fa-ban fa-fw" aria-hidden="true"></span>');
		} else {
			$xoopsTpl->assign('dready', formatTimestamp($order->getVar('order_dready'), 'm'));
		}
		if ($order->getVar('order_ddelivery_r') == 0){
			$xoopsTpl->assign('ddelivery_r', '<span class="fa fa-ban fa-fw" aria-hidden="true"></span>');
		} else {
			$xoopsTpl->assign('ddelivery_r', formatTimestamp($order->getVar('order_ddelivery_r'), 'm'));
		}
		if ($order->getVar('order_dcancellation') == 0){
			$xoopsTpl->assign('dcancellation', '<span class="fa fa-ban fa-fw" aria-hidden="true"></span>');
		} else {
			$xoopsTpl->assign('dcancellation', formatTimestamp($order->getVar('order_dcancellation'), 'm'));
		}
		if ($order->getVar('order_delivery') == 0){
			$xoopsTpl->assign('delivery', '<span class="fa fa-ban fa-fw" aria-hidden="true"></span>');
		} else {
			$xoopsTpl->assign('delivery', formatTimestamp($order->getVar('order_delivery'), 'm'));
		}
		$xoopsTpl->assign('delivery', $order->getVar('order_delivery'));
		$xoopsTpl->assign('status', $order->getVar('order_status'));
		switch ($order->getVar('order_status')) {
			case 1:
				$xoopsTpl->assign('status_text', _MA_XMSTOCK_ORDER_STATUS_1);
				$xoopsTpl->assign('status_icon', '<span class="fa fa-hourglass-start fa-fw" aria-hidden="true"></span>');
				break;
			case 2:
				$xoopsTpl->assign('status_text', _MA_XMSTOCK_ORDER_STATUS_2);
				$xoopsTpl->assign('status_icon', '<span class="fa fa-hourglass-half fa-fw" aria-hidden="true"></span>');
				break;
			case 3:
				$xoopsTpl->assign('status_text', _MA_XMSTOCK_ORDER_STATUS_3);
				$xoopsTpl->assign('status_icon', '<span class="fa fa-thumbs-o-up fa-fw" aria-hidden="true"></span>');
				break;
			case 4:
				$xoopsTpl->assign('status_text', _MA_XMSTOCK_ORDER_STATUS_4);
				$xoopsTpl->assign('status_icon', '<span class="fa fa-check fa-fw" aria-hidden="true"></span>');
				break;
			case 0:
				$xoopsTpl->assign('status_text', _MA_XMSTOCK_ORDER_STATUS_0);
				$xoopsTpl->assign('status_icon', '<span class="fa fa-ban fa-fw" aria-hidden="true"></span>');
				break;
		}
		// Criteria
        $criteria = new CriteriaCompo();
		$criteria->add(new Criteria('itemorder_orderid', $order->getVar('order_id')));
		$itemorderHandler->table_link = $itemorderHandler->db->prefix("xmarticle_article");
		$itemorderHandler->field_link = "article_id";
		$itemorderHandler->field_object = "itemorder_articleid";
		$itemorder_arr = $itemorderHandler->getByLink($criteria);
		// Get stock
		$criteria = new CriteriaCompo();
		$stock_arr = $stockHandler->getall($criteria);
		$mml = false;
		foreach (array_keys($itemorder_arr) as $i) {
			$item['id']        = $itemorder_arr[$i]->getVar('itemorder_articleid');
			$item['name']      = $itemorder_arr[$i]->getVar('article_name');
			$item['reference'] = $itemorder_arr[$i]->getVar('article_reference');
			$item['cid']   	   = $itemorder_arr[$i]->getVar('article_cid');
			$item['amount']    = $itemorder_arr[$i]->getVar('itemorder_amount');
			$item['length']    = $itemorder_arr[$i]->getVar('itemorder_length');
			if ($item['length'] == 0) {
				$item['length'] = '';
			}
			$item['status']    = $itemorder_arr[$i]->getVar('itemorder_status');
			$type = XmstockUtility::articleTypePerArea($itemorder_arr[$i]->getVar('itemorder_areaid'), $itemorder_arr[$i]->getVar('itemorder_articleid'), $stock_arr);
			switch ($type) {
				case 1:
					$item['type'] = '';
					break;
				case 2:
					$mml = true;
					$item['type'] = '';
					break;
				case 3:
					$item['type'] = _MA_XMSTOCK_STOCK_LOAN;
					break;
			}
			$xoopsTpl->appendByRef('item', $item);
			unset($item);
		}
		$xoopsTpl->assign('mml', $mml);
	}
}
//SEO
// pagetitle
$xoopsTpl->assign('xoops_pagetitle', _MA_XMSTOCK_VIEWORDER . ' - ' . $xoopsModule->name());
include XOOPS_ROOT_PATH . '/footer.php';