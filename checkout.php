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
$GLOBALS['xoopsOption']['template_main'] = 'xmstock_checkout.tpl';
include_once XOOPS_ROOT_PATH . '/header.php';

$session_name = 'caddy';
$sessionHelper = new \Xmf\Module\Helper\Session();

$xoTheme->addStylesheet(XOOPS_URL . '/modules/' . $xoopsModule->getVar('dirname', 'n') . '/assets/css/styles.css', null);

$xoopsTpl->assign('index_module', $helper->getModule()->getVar('name'));

//$article_id = Request::getInt('article_id', 0);
//$area_id = Request::getInt('area_id', 0);


// ********************************************************************************************************************
// Liste le contenu du caddy
// ********************************************************************************************************************
function listCart($sessionHelper, $session_name, $stockHandler)
{
	global $xoopsTpl;
	$arr_selectionArticles = $sessionHelper->get($session_name);
	$total = 0;
	if (is_array($arr_selectionArticles) == true){
		// Get stock
		$criteria = new CriteriaCompo();
		$stock_arr = $stockHandler->getall($criteria);
		xoops_load('utility', 'xmarticle');
		$count = 1;
		$warning = false;
		$error = false;
		$info = false;
		$mml = false;
		$datasUpdate = array();
		foreach ($arr_selectionArticles as $datas) {
			$articles['id']    	= $datas['id'];
			$articles['area']  	= XmstockUtility::getAreaName($datas['area'], false);
			$articles['areaid'] = $datas['area'];
			$articles['amount'] = XmstockUtility::articleAmountPerArea($datas['area'], $datas['id'], $stock_arr);
			$articles['name']  	= XmarticleUtility::getArticleName($datas['id'], true);
			$articles['qty']   	= $datas['qty'];
			$articles['length'] = $datas['length'];
			$articles['count']  = $count;
			$savedata['id']     = $datas['id'];
			$savedata['area']   = $datas['area'];
			$savedata['qty']    = $datas['qty'];
			$savedata['length'] = $datas['length'];
			$type = XmstockUtility::articleTypePerArea($datas['area'], $datas['id'], $stock_arr);
			switch ($type) {
				case 1:
					$articles['unit'] = '';
					$articles['error'] = false;
					$articles['info'] = false;
					if ($articles['qty'] > $articles['amount']) {
						$warning = true;
						$articles['warning'] = true;
					} else {
						$articles['warning'] = false;
					}
					break;
				case 2:
					$articles['unit'] = _MA_XMSTOCK_CHECKOUT_UNIT;
					$articles['error'] = false;
					$articles['info'] = false;
					$mml = true;
					if (($articles['qty'] * $articles['length']) > $articles['amount']) {
						$warning = true;
						$articles['warning'] = true;
					} else {
						$articles['warning'] = false;
					}
					break;
				case 3:
					$articles['unit'] = _MA_XMSTOCK_STOCK_LOAN;
					$articles['warning'] = false;
					$articles['info'] = true;
					$info = true;
					if ($articles['qty'] > $articles['amount']) {
						$error = true;
						$articles['error'] = true;
						$articles['qty'] = $articles['amount'];
						$savedata['qty'] = $articles['amount'];
					} else {
						$articles['error'] = false;
					}
					break;
			}
			$count++;
			$total += $articles['qty'];
			$datasUpdate[] = $savedata;
			$xoopsTpl->appendByRef('articles', $articles);
			unset($articles);
		}
		$sessionHelper->set($session_name, $datasUpdate);
		$xoopsTpl->assign('mml', $mml);
		$xoopsTpl->assign('total', $total);
		$xoopsTpl->assign('warning', $warning);
		$xoopsTpl->assign('error', $error);
		$xoopsTpl->assign('info', $info);
	} else {
		redirect_header('index.php', 5, _MA_XMSTOCK_CADDY_ERROR_EMPTY);
	}
}

$op = Request::getCmd('op', 'list');
switch ($op) {

	// List: Liste les articles
	case 'list':
		include_once XOOPS_ROOT_PATH . '/class/xoopsformloader.php';
		$form = new XoopsThemeForm(_MA_XMSTOCK_CHECKOUT_INPUTINF, 'form', $_SERVER['REQUEST_URI'], 'post', true);
		// description
        $editor_configs           =array();
        $editor_configs['name']   = 'order_description';
        $editor_configs['value']  = '';
        $editor_configs['rows']   = 3;
        $editor_configs['cols']   = 40;
        $editor_configs['width']  = '50%';
        $editor_configs['height'] = '100px';
        $editor_configs['editor'] = $helper->getConfig('general_editor', 'Plain Text');
        $form->addElement(new XoopsFormEditor(_MA_XMSTOCK_CHECKOUT_DESC, 'order_description', $editor_configs), true);
        $ddesired = new XoopsFormTextDateSelect(_MA_XMSTOCK_CHECKOUT_DORDER, 'order_ddesired', 2, time());
		$ddesired->setDescription(_MA_XMSTOCK_CHECKOUT_DORDER_DSC);
        $form->addElement($ddesired, false);

		$delivery = new XoopsFormRadio(_MA_XMSTOCK_CHECKOUT_DELIVERY, 'order_delivery', 0);
		$options        = [0 => _MA_XMSTOCK_CHECKOUT_DELIVERY_WITHDRAWAL, 1 => _MA_XMSTOCK_CHECKOUT_DELIVERY_DELIVERY];
		$delivery->addOptionArray($options);
		$form->addElement($delivery);
		$form->addElement(new XoopsFormHidden('op', 'save'));
		$form->addElement(new XoopsFormButton('', 'submit', "<span class='fa fa-check-circle'></span> " . _MA_XMSTOCK_CADDY_STEP2_2 . "<span>", 'submit'));
		$xoopsTpl->assign('form', $form->render());
		listCart($sessionHelper, $session_name, $stockHandler);
		break;

	case 'save':
        if (!$GLOBALS['xoopsSecurity']->check()) {
            redirect_header('caddy.php', 3, implode('<br />', $GLOBALS['xoopsSecurity']->getErrors()));
        }
        $order_id = Request::getInt('order_id', 0);
        if ($order_id == 0) {
            $obj = $orderHandler->create();
        } else {
            $obj = $orderHandler->get($order_id);
        }
        $error_message = $obj->saveOrder($orderHandler);
        if ($error_message != ''){
            $xoopsTpl->assign('error_message', $error_message);
            $form = $obj->getForm();
            $xoopsTpl->assign('form', $form->render());
        }
		break;

	case 'confirm':
		$xoopsTpl->assign('confirm', true);
		$order_id = Request::getInt('order_id', 0);
		$order  = $orderHandler->get($order_id);
		if (empty($order)) {
			redirect_header('index.php', 2, _MA_XMSTOCK_ERROR_NOORDER);
		}
		$sessionHelper->del($session_name);

		if ($order->getVar('order_delivery') == 0){
			$delivery = _MA_XMSTOCK_CHECKOUT_DELIVERY_WITHDRAWAL;
		} else {
			$delivery = _MA_XMSTOCK_CHECKOUT_DELIVERY_DELIVERY;
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
		$caddy_items = array();
		foreach (array_keys($itemorder_arr) as $i) {
			//var_dump($itemorder_arr[$i]);
			$caddy_items[$i]['id'] = $itemorder_arr[$i]->getVar('itemorder_articleid');
			$caddy_items[$i]['name'] = $itemorder_arr[$i]->getVar('article_name');
			$caddy_items[$i]['amount'] = $itemorder_arr[$i]->getVar('itemorder_amount');
			$caddy_items[$i]['length'] = number_format($itemorder_arr[$i]->getVar('itemorder_length'), 2);
			if ($caddy_items[$i]['length'] == 0) {
				$caddy_items[$i]['length'] = '';
			}
			$caddy_items[$i]['cid'] = $itemorder_arr[$i]->getVar('article_cid');
			$type = XmstockUtility::articleTypePerArea($itemorder_arr[$i]->getVar('itemorder_areaid'), $itemorder_arr[$i]->getVar('itemorder_articleid'), $stock_arr);
			switch ($type) {
				case 1:
					$caddy_items[$i]['type'] = '';
					break;
				case 2:
					$caddy_items[$i]['type'] = '';
					break;
				case 3:
					$caddy_items[$i]['type'] = _MA_XMSTOCK_STOCK_LOAN;
					break;
			}
		}
		$xoopsTpl->assign('order_title', sprintf(_MA_XMSTOCK_ORDER_ORDER, $order->getVar('order_id')));
		$xoopsTpl->assign('order_id', $order_id);
		switch ($order->getVar('order_status')) {
			case 1:
				$status = _MA_XMSTOCK_ORDER_STATUS_1;
				break;
			case 2:
				$status = _MA_XMSTOCK_ORDER_STATUS_2;
				break;
			case 3:
				$status = _MA_XMSTOCK_ORDER_STATUS_3;
				break;
			case 4:
				$status = _MA_XMSTOCK_ORDER_STATUS_4;
				break;
			case 0:
				$status = _MA_XMSTOCK_ORDER_STATUS_0;
				break;
		}
		$order_arr = array(
            _MA_XMSTOCK_ORDER_DATEORDER     => formatTimestamp($order->getVar('order_dorder'), 'm'),
            _MA_XMSTOCK_ORDER_DATEDESIRED  => formatTimestamp($order->getVar('order_ddesired'), 's'),
            _MA_XMSTOCK_CHECKOUT_DELIVERY   => $delivery,
            _MA_XMSTOCK_CADDY_ITMES     	=> $caddy_items,
            _MA_XMSTOCK_STATUS     			=> $status,
        );


		$xoopsTpl->assign('order_arr', $order_arr);
		break;

}

//SEO
// pagetitle
$xoopsTpl->assign('xoops_pagetitle', _MA_XMSTOCK_CHECKOUT . ' - ' . $xoopsModule->name());
include XOOPS_ROOT_PATH . '/footer.php';