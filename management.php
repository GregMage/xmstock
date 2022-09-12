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
$GLOBALS['xoopsOption']['template_main'] = 'xmstock_management.tpl';
include_once XOOPS_ROOT_PATH . '/header.php';

// Get Permission to manage
$managePermissionArea = XmstockUtility::getPermissionArea('xmstock_manage');

if (empty($managePermissionArea)) {
	redirect_header('index.php', 2, _NOPERM);
}

$xoopsTpl->assign('index_module', $helper->getModule()->getVar('name'));

$op = Request::getCmd('op', 'list');
$xoopsTpl->assign('op', $op);
switch ($op) {
	// List:
	case 'list':
		// Statut 1
		$criteria = new CriteriaCompo();
		$criteria->add(new Criteria('order_status', 1));
		if ($helper->isUserAdmin() != true){
			$criteria->add(new Criteria('order_areaid', '(' . implode(',', $managePermissionArea) . ')', 'IN'));
		}
		$criteria->setSort('order_dorder');
		$criteria->setOrder('DESC');
		$criteria->setLimit(10);
		$order_1_arr = $orderHandler->getall($criteria);
		if (!empty($order_1_arr)) {
			foreach (array_keys($order_1_arr) as $i) {
				$order_1['id']              = $order_1_arr[$i]->getVar('order_id');
				$order_1['ddesired']        = formatTimestamp($order_1_arr[$i]->getVar('order_ddesired'), 's');
				$order_1['dorder']          = formatTimestamp($order_1_arr[$i]->getVar('order_dorder'), 's');
				$xoopsTpl->append_by_ref('order_1', $order_1);
				unset($order_1);
			}
		} else {
			$xoopsTpl->assign('error_message_1', _MA_XMSTOCK_ERROR_NOORDER);
		}
		// Statut 2
		$criteria = new CriteriaCompo();
		$criteria->add(new Criteria('order_status', 2));
		if ($helper->isUserAdmin() != true){
			$criteria->add(new Criteria('order_areaid', '(' . implode(',', $managePermissionArea) . ')', 'IN'));
		}
		$criteria->setSort('order_dorder');
		$criteria->setOrder('DESC');
		$criteria->setLimit(10);
		$order_2_arr = $orderHandler->getall($criteria);
		if (!empty($order_2_arr)) {
			foreach (array_keys($order_2_arr) as $i) {
				$order_2['id']              = $order_2_arr[$i]->getVar('order_id');
				if ($order_2_arr[$i]->getVar('order_delivery') == 1){
					$order_2['delivery']    = formatTimestamp($order_2_arr[$i]->getVar('order_ddelivery'), 's');
				} else {
					$order_2['delivery']    = formatTimestamp($order_2_arr[$i]->getVar('order_dwithdrawal'), 's');
				}
				$order_2['dorder']          = formatTimestamp($order_2_arr[$i]->getVar('order_dorder'), 's');
				$xoopsTpl->append_by_ref('order_2', $order_2);
				unset($order_2);
			}
		} else {
			$xoopsTpl->assign('error_message_2', _MA_XMSTOCK_ERROR_NOORDER);
		}
		// Statut 3
		$criteria = new CriteriaCompo();
		$criteria->add(new Criteria('order_status', 3));
		if ($helper->isUserAdmin() != true){
			$criteria->add(new Criteria('order_areaid', '(' . implode(',', $managePermissionArea) . ')', 'IN'));
		}
		$criteria->setSort('order_dorder');
		$criteria->setOrder('DESC');
		$criteria->setLimit(10);
		$order_3_arr = $orderHandler->getall($criteria);
		if (!empty($order_3_arr)) {
			foreach (array_keys($order_3_arr) as $i) {
				$order_3['id']              = $order_3_arr[$i]->getVar('order_id');
				$order_3['dready']        	= formatTimestamp($order_3_arr[$i]->getVar('order_dready'), 's');
				$order_3['dorder']          = formatTimestamp($order_3_arr[$i]->getVar('order_dorder'), 's');
				$xoopsTpl->append_by_ref('order_3', $order_3);
				unset($order_3);
			}
		} else {
			$xoopsTpl->assign('error_message_3', _MA_XMSTOCK_ERROR_NOORDER);
		}
		// Statut 4
		$criteria = new CriteriaCompo();
		$criteria->add(new Criteria('order_status', 4));
		if ($helper->isUserAdmin() != true){
			$criteria->add(new Criteria('order_areaid', '(' . implode(',', $managePermissionArea) . ')', 'IN'));
		}
		$criteria->setSort('order_dorder');
		$criteria->setOrder('DESC');
		$criteria->setLimit(10);
		$order_4_arr = $orderHandler->getall($criteria);
		if (!empty($order_4_arr)) {
			foreach (array_keys($order_4_arr) as $i) {
				$order_4['id']              = $order_4_arr[$i]->getVar('order_id');
				if ($order_4_arr[$i]->getVar('order_delivery') == 1){
					$order_4['delivery_r']  = formatTimestamp($order_4_arr[$i]->getVar('order_ddelivery_r'), 's');
				} else {
					$order_4['delivery_r']  = formatTimestamp($order_4_arr[$i]->getVar('order_dwithdrawal_r'), 's');
				}
				$order_4['ddesired']        = formatTimestamp($order_4_arr[$i]->getVar('order_ddesired'), 's');
				$order_4['dorder']          = formatTimestamp($order_4_arr[$i]->getVar('order_dorder'), 's');
				$xoopsTpl->append_by_ref('order_4', $order_4);
				unset($order_4);
			}
		} else {
			$xoopsTpl->assign('error_message_4', _MA_XMSTOCK_ERROR_NOORDER);
		}
		// Statut 0
		$criteria = new CriteriaCompo();
		$criteria->add(new Criteria('order_status', 0));
		if ($helper->isUserAdmin() != true){
			$criteria->add(new Criteria('order_areaid', '(' . implode(',', $managePermissionArea) . ')', 'IN'));
		}
		$criteria->setSort('order_dorder');
		$criteria->setOrder('DESC');
		$criteria->setLimit(10);
		$order_0_arr = $orderHandler->getall($criteria);
		if (!empty($order_0_arr)) {
			foreach (array_keys($order_0_arr) as $i) {
				$order_0['id']              = $order_0_arr[$i]->getVar('order_id');
				$order_0['dcancellation']        = formatTimestamp($order_0_arr[$i]->getVar('order_dcancellation'), 's');
				$order_0['dorder']          = formatTimestamp($order_0_arr[$i]->getVar('order_dorder'), 's');
				$xoopsTpl->append_by_ref('order_0', $order_0);
				unset($order_0);
			}
		} else {
			$xoopsTpl->assign('error_message_0', _MA_XMSTOCK_ERROR_NOORDER);
		}
		break;

	case 'viewall':
		$status = Request::getString('status', 'all');
		$sort = Request::getInt('sort', 2);
		$filter = Request::getInt('filter', 0);
		if ($status == 1 && $sort > 3){
			$sort = 2;
		}
		if ($status == 2 && $sort > 4){
			$sort = 2;
		}
		if ($status == 3 && $sort > 5){
			$sort = 2;
		}
		if ($status == 4 && $sort > 6){
			$sort = 2;
		}
		if ($status == 'all' && $sort > 3){
			$sort = 2;
		}
		$xoopsTpl->assign('status', $status);
		$xoopsTpl->assign('sort', $sort);
		$xoopsTpl->assign('filter', $filter);
		// Get start pager
		$start = Request::getInt('start', 0);
		// Criteria
		$criteria = new CriteriaCompo();
		if ($status == 0 || $status == 1 || $status == 2 || $status == 3 || $status == 4){
			$criteria->add(new Criteria('order_status', $status));
		}
		if ($helper->isUserAdmin() != true){
			$criteria->add(new Criteria('order_areaid', '(' . implode(',', $managePermissionArea) . ')', 'IN'));
		}
		$order_count = $orderHandler->getCount($criteria);
		switch ($sort) {
			case 1:
				$criteria->setSort('order_id');
				break;

			case 2:
				$criteria->setSort('order_dorder');
				break;

			case 3:
				$criteria->setSort('order_ddesired');
				break;

			case 4:
				$criteria->setSort('order_ddelivery');
				break;

			case 5:
				$criteria->setSort('order_dready');
				break;
			case 6:
				$criteria->setSort('order_ddelivery_r');
				break;
			case 7:
				$criteria->setSort('order_dcancellation');
				break;

		}
		if ($filter == 0){
			$criteria->setOrder('DESC');
		} else {
			$criteria->setOrder('ASC');
		}
		$criteria->setStart($start);
		$criteria->setLimit($nb_limit);
		$order_arr = $orderHandler->getall($criteria);
		$xoopsTpl->assign('order_count', $order_count);
		if ($order_count > 0) {
			foreach (array_keys($order_arr) as $i) {
				$order_id                 = $order_arr[$i]->getVar('order_id');
				$order['id']              = $order_id;
				$order['description']     = XmstockUtility::generateDescriptionTagSafe($order_arr[$i]->getVar('order_description', 'show'), 50);
				$order['ddesired']        = formatTimestamp($order_arr[$i]->getVar('order_ddesired'), 's');
				$order['ddelivery']		  = formatTimestamp($order_arr[$i]->getVar('order_ddelivery'), 's');
				$order['dready']          = formatTimestamp($order_arr[$i]->getVar('order_dready'), 's');
				$order['ddelivery_r']	  = formatTimestamp($order_arr[$i]->getVar('order_ddelivery_r'), 's');
				$order['dorder']          = formatTimestamp($order_arr[$i]->getVar('order_dorder'), 'm');
				$order['dcancellation']   = formatTimestamp($order_arr[$i]->getVar('order_dcancellation'), 's');
				$order['delivery']        = $order_arr[$i]->getVar('order_delivery');
				$order['status']       	  = $order_arr[$i]->getVar('order_status');
				switch ($order['status']) {
					case 0:
						$order['status_text'] = _MA_XMSTOCK_ORDER_STATUS_0;
						break;

					case 1:
						$order['status_text'] = _MA_XMSTOCK_ORDER_STATUS_1;
						break;

					case 2:
						$order['status_text'] = _MA_XMSTOCK_ORDER_STATUS_2;
						break;

					case 3:
						$order['status_text'] = _MA_XMSTOCK_ORDER_STATUS_3;
						break;

					case 4:
						$order['status_text'] = _MA_XMSTOCK_ORDER_STATUS_4;
						break;

				}
				$xoopsTpl->append_by_ref('order', $order);
				unset($order);
			}
			// Display Page Navigation
			if ($order_count > $nb_limit) {
				$nav = new XoopsPageNav($order_count, $nb_limit, $start, 'start', 'op=viewall&status=' . $status . '&sort=' . $sort . '&filter=' . $filter);
				$xoopsTpl->assign('nav_menu', $nav->renderNav(4));
			}
		} else {
			$xoopsTpl->assign('error_message', _MA_XMSTOCK_ERROR_NOORDER);
		}

		break;

}


//SEO
// pagetitle
$xoopsTpl->assign('xoops_pagetitle', _MA_XMSTOCK_MANAGEMENT . ' - ' . $xoopsModule->name());
include XOOPS_ROOT_PATH . '/footer.php';