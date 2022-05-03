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

$status = Request::getInt('status', 1);
$xoopsTpl->assign('status', $status);
$xoopsTpl->assign('index_module', $helper->getModule()->getVar('name'));

$op = Request::getCmd('op', 'list');
$xoopsTpl->assign('op', $op);
switch ($op) {
	// List: Liste les commandes
	case 'list':
		$criteria = new CriteriaCompo();
		$criteria->add(new Criteria('order_status', 1));
		$order_count_A = $orderHandler->getCount($criteria);
		$criteria = new CriteriaCompo();
		$criteria->add(new Criteria('order_status', 2));
		$order_count_B = $orderHandler->getCount($criteria);
		$criteria = new CriteriaCompo();
		$criteria->add(new Criteria('order_status', 3));
		$order_count_C = $orderHandler->getCount($criteria);
		$criteria = new CriteriaCompo();
		$criteria->add(new Criteria('order_status', 4));
		$order_count_D = $orderHandler->getCount($criteria);
		$criteria = new CriteriaCompo();
		$criteria->add(new Criteria('order_status', 5));
		$order_count_E = $orderHandler->getCount($criteria);
		$criteria = new CriteriaCompo();
		$criteria->add(new Criteria('order_status', 6));
		$order_count_F = $orderHandler->getCount($criteria);
		$xoopsTpl->assign('pill_A', $order_count_A);
		$xoopsTpl->assign('pill_B', $order_count_B);
		$xoopsTpl->assign('pill_C', $order_count_C);
		$xoopsTpl->assign('pill_D', $order_count_D);
		$xoopsTpl->assign('pill_E', $order_count_E);
		$xoopsTpl->assign('pill_F', $order_count_F);

		// Get start pager
		$start = Request::getInt('start', 0);
		// Criteria
		$criteria = new CriteriaCompo();
		$criteria->add(new Criteria('order_userid', !empty($xoopsUser) ? $xoopsUser->getVar('uid') : 0));
		$order_count = $orderHandler->getCount($criteria);
		$criteria->add(new Criteria('order_status', $status));		
		$criteria->setSort('order_dorder');
		$criteria->setOrder('DESC');
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
				$order['dorder']          = formatTimestamp($order_arr[$i]->getVar('order_dorder'), 'm');
				$order['delivery']        = $order_arr[$i]->getVar('order_delivery');
				$order['status']       	  = $order_arr[$i]->getVar('order_status');
				$xoopsTpl->append_by_ref('order', $order);
				unset($order);
			}
			// Display Page Navigation
			if ($order_count > $nb_limit) {
				$nav = new XoopsPageNav($order_count, $nb_limit, $start, 'start');
				$xoopsTpl->assign('nav_menu', $nav->renderNav(4));
			}
		} else {
			$xoopsTpl->assign('error_message', _MA_XMSTOCK_ERROR_NOORDER);
		}
		break;

	case 'del':
        $order_id = Request::getInt('order_id', 0);
        if ($order_id == 0) {
            $xoopsTpl->assign('error_message', _MA_XMSTOCK_ERROR_NOORDER);
        } else {
            $surdel = Request::getBool('surdel', false);
            $obj  = $orderHandler->get($order_id);
			if (empty($obj) === true){
				$xoopsTpl->assign('error_message', _MA_XMSTOCK_ERROR_NOORDER);
			} else {
				if ($obj->getVar('order_status') != 1){
					$xoopsTpl->assign('error_message', _MA_XMSTOCK_ERROR_ORDER_DEL);
				} else {
					if ($surdel === true) {
						if (!$GLOBALS['xoopsSecurity']->check()) {
							redirect_header('order.php', 3, implode('<br>', $GLOBALS['xoopsSecurity']->getErrors()));
						}
						$error_message = $obj->delOrder($orderHandler, $order_id, 'order.php');
						if ($error_message != ''){
							$xoopsTpl->assign('error_message', $error_message);
						}
					} else {
						xoops_confirm(['surdel' => true, 'oder_id' => $order_id, 'op' => 'del'], $_SERVER['REQUEST_URI'],
											sprintf(_MA_XMSTOCK_ORDER_SUREDEL, $obj->getVar('order_id')) . '<br>' .
											XmstockUtility::generateDescriptionTagSafe($obj->getVar('order_description', 'show'), 50));
					}
				}
			}
        }
		break;
}


//SEO
// pagetitle
$xoopsTpl->assign('xoops_pagetitle', _MA_XMSTOCK_ORDERS . ' - ' . $xoopsModule->name());
include XOOPS_ROOT_PATH . '/footer.php';