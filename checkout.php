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
		foreach ($arr_selectionArticles as $datas) {
			$articles['id']    	= $datas['id'];
			$articles['area']  	= XmstockUtility::getAreaName($datas['area'], false);
			$articles['areaid'] = $datas['area'];
			$articles['amount'] = XmstockUtility::articleAmountPerArea($datas['area'], $datas['id'], $stock_arr);
			$articles['name']  	= XmarticleUtility::getArticleName($datas['id']);
			$articles['qty']   	= $datas['qty'];
			$articles['count']  = $count;
			if ($articles['qty'] > $articles['amount']) {
				$warning = true;
				$articles['warning']  = true;
			} else {
				$articles['warning']  = false;
			}
			$count++;
			$total += $datas['qty'];
			$xoopsTpl->append_by_ref('articles', $articles);
			unset($articles);
		}
		$xoopsTpl->assign('total', $total);
		$xoopsTpl->assign('warning', $warning);
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
        $form->addElement(new XoopsFormTextDateSelect(_MA_XMSTOCK_CHECKOUT_DORDER, 'order_ddesired', 2, time()), false);
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
        $error_message = $obj->saveOrder($orderHandler, 'checkout.php?op=confirm&order_id=' . $order_id);
        if ($error_message != ''){
            $xoopsTpl->assign('error_message', $error_message);
            $form = $obj->getForm();
            $xoopsTpl->assign('form', $form->render());
        }
		//redirect_header('checkout.php?op=confirm&order_id=' . $order_id, 3, _MA_XMSTOCK_CHECKOUT_SEND);
		break;
		
	case 'confirm':
		$xoopsTpl->assign('confirm', true);
		$sessionHelper->del($session_name);
		$request_arr = [];
		$xoopsTpl->assign('request_arr', $request_arr);
		break;

}

//SEO
// pagetitle
$xoopsTpl->assign('xoops_pagetitle', _MA_XMSTOCK_CHECKOUT . ' - ' . $xoopsModule->name());
include XOOPS_ROOT_PATH . '/footer.php';