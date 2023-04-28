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

	if ($options[4] != 'transfert'){
		switch ($options[4]) {
			case "myorders":
				$criteria->setSort('order_dorder DESC, order_status');
				$criteria->setOrder('ASC');
				$criteria->add(new Criteria('order_userid', !empty($xoopsUser) ? $xoopsUser->getVar('uid') : 0));
				$block['type'] = 'myorders';
				break;

			case "process":
				$criteria->setSort('order_dorder DESC, order_status');
				$criteria->setOrder('ASC');
				if (!empty($managePermissionArea)) {
					$criteria->add(new Criteria('order_areaid', '(' . implode(',', $managePermissionArea) . ')', 'IN'));
				} else {
					$criteria->add(new Criteria('order_areaid', 0));
				}
				$block['type'] = 'process';
				break;

		}
		$criteria->add(new Criteria('order_status', '(' . $options[0] . ')', 'IN'));
		$criteria->setLimit($options[3]);
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
			}
		}
	} else {
		//area
		$area = array();
		$area[0] = '';
		$criteria = new CriteriaCompo();
		$criteria->setSort('area_weight ASC, area_name');
		$criteria->setOrder('ASC');
		$area_arr = $areaHandler->getall($criteria);
		if (count($area_arr) > 0) {
			foreach (array_keys($area_arr) as $i) {
				$area[$i] = $area_arr[$i]->getVar('area_name');
			}
		}
		$criteria->setSort('transfer_date');
		$criteria->setOrder($options[1]);
		$criteria->add(new Criteria('transfer_status', $options[2]));
		$criteria->setLimit($options[3]);
		$area_ids = explode(',', $options[0]);
		if (!in_array(0, $area_ids)) {
			$criteria->add(new Criteria('transfer_ar_areaid', '(' . $options[0] . ')', 'IN'));
		}
		$criteria->add(new Criteria('transfer_ar_areaid', '(' . implode(',', $managePermissionArea) . ')', 'IN'));
		$transferHandler->table_link = $transferHandler->db->prefix("xmarticle_article");
        $transferHandler->field_link = "article_id";
        $transferHandler->field_object = "transfer_articleid";
        $transfer_arr = $transferHandler->getByLink($criteria);
		if (count($transfer_arr) > 0) {
            foreach (array_keys($transfer_arr) as $i) {
                $transfer_id               = $transfer_arr[$i]->getVar('transfer_id');
                $transfer['id']            = $transfer_id;
                $transfer['date']          = formatTimestamp($transfer_arr[$i]->getVar('transfer_date'), 'm');
                $transfer['article']       = '<a href="' . XOOPS_URL . '/modules/xmarticle/viewarticle.php?category_id=' . $transfer_arr[$i]->getVar('article_cid') . '&article_id=' . $transfer_arr[$i]->getVar('article_id') . '" title="' . $transfer_arr[$i]->getVar('article_name') . '" target="_blank">' . $transfer_arr[$i]->getVar('article_name') . '</a> (' . $transfer_arr[$i]->getVar('article_reference') . ')';
                $transfer['ref']           = $transfer_arr[$i]->getVar('transfer_ref');
                $transfer['amount']        = $transfer_arr[$i]->getVar('transfer_amount');
				$transfer['description']   = $transfer_arr[$i]->getVar('transfer_description');
                $transfer['user']     	   = XoopsUser::getUnameFromId($transfer_arr[$i]->getVar('transfer_userid'), 0, true);
				$transfer['type']   	   = _MA_XMSTOCK_TRANSFER_TRANSFEROFSTOCK;
				$transfer['destination']   = _MA_XMSTOCK_TRANSFER_STOCK . $area[$transfer_arr[$i]->getVar('transfer_ar_areaid')];
				$transfer['starea'] 	   = $area[$transfer_arr[$i]->getVar('transfer_st_areaid')];
				if (in_array($transfer_arr[$i]->getVar('transfer_ar_areaid'), $managePermissionArea) == true){
					$transfer['action']    = true;
				} else {
					$transfer['action']    = false;
				}
				$block['transfer'][] = $transfer;
				unset($transfer);
            }
		} else {
			$block['transfer'] = '';
		}
	}

	$GLOBALS['xoTheme']->addStylesheet(XOOPS_URL . '/modules/xmstock/assets/css/styles.css');
	return $block;
}

function block_xmstock_edit($options) {
	include __DIR__ . '/../include/common.php';
	$helper->loadLanguage('main');
	include_once XOOPS_ROOT_PATH . '/modules/xmstock/class/blockform.php';
    xoops_load('XoopsFormLoader');
	$form = new XmstockBlockForm();

	if ($options[4] != 'transfert'){
		$status_arr = array(
			0 => _MA_XMSTOCK_ORDER_STATUS_TITLE_0,
			1 => _MA_XMSTOCK_ORDER_STATUS_TITLE_1,
			2 => _MA_XMSTOCK_ORDER_STATUS_TITLE_2,
			3 => _MA_XMSTOCK_ORDER_STATUS_TITLE_3,
			4 => _MA_XMSTOCK_ORDER_STATUS_TITLE_4,
			);
		$status = new XoopsFormSelect(_MB_XMSTOCK_STATUS, 'options[0]', explode(',', $options[0]), 5, true);
		foreach (array_keys($status_arr) as $i) {
			$status->addOption($i, $status_arr[$i]);
		}
		$form->addElement($status);
		$form->addElement(new XoopsFormHidden('options[1]', $options[1]));
		$form->addElement(new XoopsFormHidden('options[2]', $options[2]));
	} else {
		// Criteria
		$criteria = new CriteriaCompo();
		$criteria->setSort('area_weight ASC, area_name');
		$criteria->setOrder('ASC');
		$criteria->add(new Criteria('area_status', 1));
		$area_arr = $areaHandler->getall($criteria);
		$area = new XoopsFormSelect(_MB_XMSTOCK_AREA, 'options[0]', explode(',', $options[0]), 5, true);
		$area->addOption(0, _MB_XMSTOCK_ALLAREA);
		foreach (array_keys($area_arr) as $i) {
			$area->addOption($area_arr[$i]->getVar('area_id'), $area_arr[$i]->getVar('area_name'));
		}
		$form->addElement($area);

		$date = new XoopsFormRadio(_MB_XMSTOCK_SORTDATE, 'options[1]', $options[1]);
		$date->addOption('DESC', '<span class="fa fa-arrow-down"></span>');
		$date->addOption('ASC', '<span class="fa fa-arrow-up"></span>');
		$form->addElement($date);

		$status = new XoopsFormRadio(_MB_XMSTOCK_STATUS, 'options[2]', $options[2]);
		$status->addOption(0, _MB_XMSTOCK_STATUS_WAITING);
		$status->addOption(1, _MB_XMSTOCK_STATUS_VALID);
		$form->addElement($status);
	}
	$form->addElement(new XoopsFormText(_MB_XMSTOCK_NBTRANSFERT, 'options[3]', 5, 5, $options[3]), true);
	$form->addElement(new XoopsFormHidden('options[4]', $options[4]));

	return $form->render();
}