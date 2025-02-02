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
$GLOBALS['xoopsOption']['template_main'] = 'xmstock_action.tpl';
include_once XOOPS_ROOT_PATH . '/header.php';

$xoTheme->addStylesheet(XOOPS_URL . '/modules/' . $xoopsModule->getVar('dirname', 'n') . '/assets/css/styles.css', null);

$op = Request::getCmd('op', '');
$xoopsTpl->assign('index_module', $helper->getModule()->getVar('name'));
$xoopsTpl->assign('op', $op);

// ********************************************************************************************************************
// Liste les détails de la commande
// ********************************************************************************************************************
function listOrder($obj, $order_id)
{
	global $xoopsTpl;
	$permHelper = new \Xmf\Module\Helper\Permission();
	$permHelper->checkPermissionRedirect('xmstock_manage', $obj->getVar('order_areaid'), 'index.php', 2, _NOPERM);
	$status = $obj->getVar('order_status');
	if ($status >= 1 &&  $status <= 3){
		$xoopsTpl->assign('status', $status);
		$xoopsTpl->assign('orderid', $order_id);
		$xoopsTpl->assign('description', XmstockUtility::generateDescriptionTagSafe($obj->getVar('order_description', 'show'), 50));
		$xoopsTpl->assign('ddesired', formatTimestamp($obj->getVar('order_ddesired'), 's'));
		$xoopsTpl->assign('dorder', formatTimestamp($obj->getVar('order_dorder'), 'm'));
		$xoopsTpl->assign('user', XoopsUser::getUnameFromId($obj->getVar('order_userid')));
		$xoopsTpl->assign('area_name', XmstockUtility::getAreaName($obj->getVar('order_areaid'), false, false));
		$xoopsTpl->assign('delivery', $obj->getVar('order_delivery'));
		$xoopsTpl->assign('status', $obj->getVar('order_status'));
		$xoopsTpl->assign('ddelivery', formatTimestamp($obj->getVar('order_ddelivery'), 's'));
		switch ($status) {
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
		$form = $obj->getFormNext(false, $obj->getVar('order_ddesired'));
		$xoopsTpl->assign('form', $form->render());
	} else {
		redirect_header('index.php', 2, _NOPERM);
	}
}

if ($op == 'next' || $op == 'edit' || $op == 'editstock' || $op == 'del' || $op == 'save' || $op == 'savenext' || $op == 'savestock') {
    switch ($op) {
        // next
        case 'next':
			$order_id = Request::getInt('order_id', 0);
			if ($order_id == 0) {
                $xoopsTpl->assign('error_message', _MA_XMSTOCK_ERROR_NOORDER);
			} else {
				$obj  = $orderHandler->get($order_id);
				if (empty($obj)) {
					$xoopsTpl->assign('error_message', _MA_XMSTOCK_ERROR_NOORDER);
				} else {
					 listOrder($obj, $order_id);
				}
            }
            break;

        // Edit
        case 'edit':
			$order_id = Request::getInt('order_id', 0);
			if ($order_id == 0) {
                $xoopsTpl->assign('error_message', _MA_XMSTOCK_ERROR_NOORDER);
            } else {
				$obj  = $orderHandler->get($order_id);
				if (empty($obj)) {
					$xoopsTpl->assign('error_message', _MA_XMSTOCK_ERROR_NOORDER);
				} else {
					$permHelper->checkPermissionRedirect('xmstock_manage', $obj->getVar('order_areaid'), 'index.php', 2, _NOPERM);
					if ($obj->getVar('order_status') == 3 || $obj->getVar('order_status') == 4){
						redirect_header('management.php', 3, _NOPERM);
					}
					$form = $obj->getFormEdit();
					$xoopsTpl->assign('form', $form->render());
				}
            }
            break;

        // Edit
        case 'editstock':
			$article_id = Request::getInt('article_id', 0);
			$area_id = Request::getInt('area_id', 0);
			$return = Request::getString('return', 'stock');
			$xoopsTpl->assign('area_id', $area_id);
			if ($article_id == 0 || $area_id == 0) {
                $xoopsTpl->assign('error_message', _MA_XMSTOCK_ERROR_NOSTOCK);
            } else {
				$criteria = new CriteriaCompo();
				$criteria->add(new Criteria('stock_areaid', $area_id));
				$criteria->add(new Criteria('stock_articleid', $article_id));
				$stock_arr = $stockHandler->getall($criteria);
				if (count($stock_arr) > 0) {
					foreach (array_keys($stock_arr) as $i) {
						$obj = $stockHandler->get($i);
					}
				} else {
					$xoopsTpl->assign('error_message', _MA_XMSTOCK_ERROR_NOSTOCK);
				}
				if (empty($obj)) {
					$xoopsTpl->assign('error_message', _MA_XMSTOCK_ERROR_NOSTOCK);
				} else {
					$permHelper->checkPermissionRedirect('xmstock_manage', $area_id, 'index.php', 2, _NOPERM);
					$area = $areaHandler->get($area_id);
					$xoopsTpl->assign('area_name', $area->getVar('area_name'));
					$form = $obj->getForm($return);
					$xoopsTpl->assign('form', $form->render());
				}
            }
            break;

        // Save
        case 'save':
			$order_areaid = Request::getInt('order_areaid', 0);
			// Get Permission to submit in category
			$permHelper->checkPermissionRedirect('xmstock_manage', $order_areaid, 'index.php', 2, _NOPERM);
            if (!$GLOBALS['xoopsSecurity']->check()) {
                redirect_header('index.php', 3, implode('<br>', $GLOBALS['xoopsSecurity']->getErrors()));
            }
            $order_id = Request::getInt('order_id', 0);
            if ($order_id == 0) {
                $obj = $orderHandler->create();
            } else {
                $obj = $orderHandler->get($order_id);
            }
            $error_message = $obj->saveOrderEdit($orderHandler, 'vieworder.php?op=view&order_id=' . $order_id . '&opt=man');
            if ($error_message != '') {
                $xoopsTpl->assign('error_message', $error_message);
				$form = $obj->getFormEdit();
                $xoopsTpl->assign('form', $form->render());
            }
            break;

        // SaveNext
        case 'savenext':
			$order_areaid = Request::getInt('order_areaid', 0);
			// Get Permission to submit in category
			$permHelper->checkPermissionRedirect('xmstock_manage', $order_areaid, 'index.php', 2, _NOPERM);
            if (!$GLOBALS['xoopsSecurity']->check()) {
                redirect_header('index.php', 3, implode('<br>', $GLOBALS['xoopsSecurity']->getErrors()));
            }
            $order_id = Request::getInt('order_id', 0);
            if ($order_id == 0) {
                redirect_header('index.php', 2, _NOPERM);
            } else {
                $obj = $orderHandler->get($order_id);
            }
            $error_message = $obj->saveOrderNext($orderHandler, 'management.php');
            if ($error_message != '') {
                $xoopsTpl->assign('error_message', $error_message);
				$form = $obj->getFormNext();
                $xoopsTpl->assign('form', $form->render());
				listOrder($obj, $order_id);
            }
            break;

        // SaveStock
        case 'savestock':
			$stock_areaid = Request::getInt('stock_areaid', 0);
			// Get Permission to submit in category
			$permHelper->checkPermissionRedirect('xmstock_manage', $stock_areaid, 'index.php', 2, _NOPERM);
            if (!$GLOBALS['xoopsSecurity']->check()) {
                redirect_header('index.php', 3, implode('<br>', $GLOBALS['xoopsSecurity']->getErrors()));
            }
            $stock_id = Request::getInt('stock_id', 0);
            if ($stock_id == 0) {
                redirect_header('index.php', 2, _NOPERM);
            } else {
                $obj = $stockHandler->get($stock_id);
            }
			$return = Request::getString('return', 'stock');
			if ($return == 'article') {
				$action = XOOPS_URL . '/modules/xmarticle/viewarticle.php?category_id=' . $stock_areaid . '&article_id=' . $obj->getVar('stock_articleid');
			} else {
				$action = XOOPS_URL . '/modules/xmstock/viewarea.php?area_id=' . $stock_areaid;
			}
            $error_message = $obj->saveStock($stockHandler, $action);
            if ($error_message != '') {
                $xoopsTpl->assign('error_message', $error_message);
				$xoopsTpl->assign('area_id', $stock_areaid);
				$area = $areaHandler->get($stock_areaid);
				$xoopsTpl->assign('area_name', $area->getVar('area_name'));
				$form = $obj->getForm($return);
                $xoopsTpl->assign('form', $form->render());
            }
            break;

		// del
		case 'del':
			// a faire si besoin
			break;
    }
} else {
    redirect_header('index.php', 2, _NOPERM);
}
include XOOPS_ROOT_PATH . '/footer.php';
