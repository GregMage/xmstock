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
		$criteria->setSort('order_dorder');
		$criteria->setOrder('DESC');
		$criteria->setLimit(10);
		$order_2_arr = $orderHandler->getall($criteria);
		if (!empty($order_2_arr)) {
			foreach (array_keys($order_2_arr) as $i) {
				$order_2['id']              = $order_2_arr[$i]->getVar('order_id');
				$order_2['ddesired']        = formatTimestamp($order_2_arr[$i]->getVar('order_ddesired'), 's');
				$order_2['dorder']          = formatTimestamp($order_2_arr[$i]->getVar('order_dorder'), 's');
				$xoopsTpl->append_by_ref('order_2', $order_2);
				unset($order_2);
			}
		} else {
			$xoopsTpl->assign('error_message_2', _MA_XMSTOCK_ERROR_NOORDER);
		}


		break;


}


//SEO
// pagetitle
$xoopsTpl->assign('xoops_pagetitle', _MA_XMSTOCK_MANAGEMENT . ' - ' . $xoopsModule->name());
include XOOPS_ROOT_PATH . '/footer.php';