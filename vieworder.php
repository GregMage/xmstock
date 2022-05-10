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
		$order  = $orderHandler->get($order_id);
		$xoopsTpl->assign('orderid', $order_id);
		$xoopsTpl->assign('description', XmstockUtility::generateDescriptionTagSafe($order->getVar('order_description', 'show'), 50));
		$xoopsTpl->assign('ddesired', formatTimestamp($order->getVar('order_ddesired'), 's'));
		$xoopsTpl->assign('dorder', formatTimestamp($order->getVar('order_dorder'), 'm'));
		$xoopsTpl->assign('delivery', $order->getVar('order_delivery'));		
		switch ($order->getVar('order_status')) {
			case 1:
				$xoopsTpl->assign('status', _MA_XMSTOCK_ORDER_STATUS_1);
				break;
			case 2:
				$xoopsTpl->assign('status', _MA_XMSTOCK_ORDER_STATUS_2);
				break;
			case 3:
				$xoopsTpl->assign('status', _MA_XMSTOCK_ORDER_STATUS_3);
				break;
			case 4:
				$xoopsTpl->assign('status', _MA_XMSTOCK_ORDER_STATUS_4);
				break;
			case 0:
				$xoopsTpl->assign('status', _MA_XMSTOCK_ORDER_STATUS_0);
				break;
		}
		// Criteria
        $criteria = new CriteriaCompo();
		$criteria->add(new Criteria('itemorder_orderid', $order->getVar('order_id')));
		$itemorderHandler->table_link = $itemorderHandler->db->prefix("xmarticle_article");
		$itemorderHandler->field_link = "article_id";
		$itemorderHandler->field_object = "itemorder_articleid";
		$itemorder_arr = $itemorderHandler->getByLink($criteria);
		foreach (array_keys($itemorder_arr) as $i) {
			$item['id']        = $itemorder_arr[$i]->getVar('itemorder_articleid');
			$item['name']      = $itemorder_arr[$i]->getVar('article_name');
			$item['reference'] = $itemorder_arr[$i]->getVar('article_reference');
			$item['cid']   	   = $itemorder_arr[$i]->getVar('article_cid');
			$item['amount']    = $itemorder_arr[$i]->getVar('itemorder_amount');
			$item['status']    = $itemorder_arr[$i]->getVar('itemorder_status');
			$xoopsTpl->append_by_ref('item', $item);
			unset($item);
		}
	}
}


//SEO
// pagetitle
$xoopsTpl->assign('xoops_pagetitle', _MA_XMSTOCK_VIEWORDER . ' - ' . $xoopsModule->name());
include XOOPS_ROOT_PATH . '/footer.php';