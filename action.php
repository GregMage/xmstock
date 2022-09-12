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

if ($op == 'next' || $op == 'edit' || $op == 'del' || $op == 'save') {
    switch ($op) {

        // next
        case 'next':
			// a faire
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
					// Get Permission to edit in category
					$permHelper->checkPermissionRedirect('xmstock_manage', $obj->getVar('order_areaid'), 'index.php', 2, _NOPERM);
					$form = $obj->getFormEdit();
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
            $error_message = $obj->saveOrderEdit($orderHandler, 'management.php');
            if ($error_message != '') {
                $xoopsTpl->assign('error_message', $error_message);
				$form = $obj->getFormEdit();
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
