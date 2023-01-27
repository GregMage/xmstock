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
use Xmf\Module\Helper;
function block_xmstock_show($options) {
	global $xoopsUser;
	include __DIR__ . '/../include/common.php';
	include_once __DIR__ . '/../class/utility.php';

	$helper = Helper::getHelper('xmstock');
	$helper->loadLanguage('main');

	// Get Permission to manage
	$managePermissionArea = XmstockUtility::getPermissionArea('xmstock_manage');

	$block = array();
	$criteria = new CriteriaCompo();
	$criteria->setSort('order_dorder DESC, order_status');
	$criteria->setOrder('ASC');

	switch ($options[2]) {
		case "myorders":
			$criteria->add(new Criteria('order_userid', !empty($xoopsUser) ? $xoopsUser->getVar('uid') : 0));
			$block['type'] = 'myorders';
			break;

		case "process":
			if (!empty($managePermissionArea)) {
				$criteria->add(new Criteria('order_areaid', '(' . implode(',', $managePermissionArea) . ')', 'IN'));
			}
			$block['type'] = 'process';
			break;

	}
	$criteria->add(new Criteria('order_status', '(' . $options[0] . ')', 'IN'));
	$criteria->setLimit($options[1]);
	$order_arr = $orderHandler->getall($criteria);
	if (!empty($order_arr)) {
		foreach (array_keys($order_arr) as $i) {
			$order['id']              = $order_arr[$i]->getVar('order_id');
			$order['ddesired']        = formatTimestamp($order_arr[$i]->getVar('order_ddesired'), 's');
			$order['dorder']          = formatTimestamp($order_arr[$i]->getVar('order_dorder'), 's');
			switch ($order_arr[$i]->getVar('order_status')) {
				case 1:
					$order['status_text'] = _MA_XMSTOCK_ORDER_STATUS_1;
					$order['status_icon'] = '<span class="fa fa-hourglass-start fa-fw" aria-hidden="true"></span>';
					break;
				case 2:
					$order['status_text'] = _MA_XMSTOCK_ORDER_STATUS_2;
					$order['status_icon'] = '<span class="fa fa-hourglass-half fa-fw" aria-hidden="true"></span>';
					break;
				case 3:
					$order['status_text'] = _MA_XMSTOCK_ORDER_STATUS_3;
					$order['status_icon'] = '<span class="fa fa-thumbs-o-up fa-fw" aria-hidden="true"></span>';
					break;
				case 4:
					$order['status_text'] = _MA_XMSTOCK_ORDER_STATUS_4;
					$order['status_icon'] = '<span class="fa fa-check fa-fw" aria-hidden="true"></span>';
					break;
				case 0:
					$order['status_text'] = _MA_XMSTOCK_ORDER_STATUS_0;
					$order['status_icon'] ='<span class="fa fa-ban fa-fw" aria-hidden="true"></span>';
					break;
			}
			$block['order'][] = $order;
			unset($order);
			unset($order_1);
		}
	}
	$GLOBALS['xoTheme']->addStylesheet(XOOPS_URL . '/modules/xmstock/assets/css/styles.css');
	return $block;
}

function block_xmstock_edit($options) {
	include __DIR__ . '/../include/common.php';
	$helper->loadLanguage('main');

	$status_arr = array(
		0 => _MA_XMSTOCK_ORDER_STATUS_TITLE_0,
		1 => _MA_XMSTOCK_ORDER_STATUS_TITLE_1,
		2 => _MA_XMSTOCK_ORDER_STATUS_TITLE_2,
		3 => _MA_XMSTOCK_ORDER_STATUS_TITLE_3,
		4 => _MA_XMSTOCK_ORDER_STATUS_TITLE_4,
		);

	include_once XOOPS_ROOT_PATH . '/modules/xmstock/class/blockform.php';
    xoops_load('XoopsFormLoader');

    $form = new XmstockBlockForm();
	$status = new XoopsFormSelect(_MB_XMSTOCK_STATUS, 'options[0]', explode(',', $options[0]), 5, true);
	foreach (array_keys($status_arr) as $i) {
		$status->addOption($i, $status_arr[$i]);
	}
	$form->addElement($status);
	$form->addElement(new XoopsFormText(_MB_XMSTOCK_NBORDER, 'options[1]', 5, 5, $options[1]), true);
	$form->addElement(new XoopsFormHidden('options[2]', $options[2]));

	return $form->render();
}