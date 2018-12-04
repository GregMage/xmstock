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
 * @copyright       XOOPS Project (http://xoops.org)
 * @license         GNU GPL 2 (http://www.gnu.org/licenses/old-licenses/gpl-2.0.html)
 * @author          Mage Gregory (AKA Mage)
 */
use Xmf\Module\Admin;
use Xmf\Request;


require __DIR__ . '/admin_header.php';
$moduleAdmin = Admin::getInstance();
$moduleAdmin->displayNavigation('transfer.php');

// Get Action type
$op = Request::getCmd('op', 'list');
switch ($op) {
    case 'list':
        // Define Stylesheet
        $xoTheme->addStylesheet(XOOPS_URL . '/modules/system/css/admin.css');
        // Module admin
        $moduleAdmin->addItemButton(_MA_XMSTOCK_TRANSFER_ENTRYINSTOCK, 'transfer.php?op=add&type=E', 'add');
        $moduleAdmin->addItemButton(_MA_XMSTOCK_TRANSFER_OUTOFSTOCK, 'transfer.php?op=add&type=O', 'add');
        $moduleAdmin->addItemButton(_MA_XMSTOCK_TRANSFER_TRANSFEROFSTOCK, 'transfer.php?op=add&type=T', 'add');
        $xoopsTpl->assign('renderbutton', $moduleAdmin->renderButton());        
        // Get start pager
        $start = Request::getInt('start', 0);
        // Criteria
        $criteria = new CriteriaCompo();
        $criteria->setSort('transfer_date');
        $criteria->setOrder('DESC');
        $criteria->setStart($start);
        $criteria->setLimit($nb_limit);
		$transferHandler->table_link = $transferHandler->db->prefix("xmarticle_article");
        $transferHandler->field_link = "article_id";
        $transferHandler->field_object = "transfer_articleid";
        $transfer_arr = $transferHandler->getByLink($criteria);
        $transfer_count = $transferHandler->getCount($criteria);
        $xoopsTpl->assign('transfer_count', $transfer_count);
        if ($transfer_count > 0) {
            foreach (array_keys($transfer_arr) as $i) {
                $transfer_id               = $transfer_arr[$i]->getVar('transfer_id');
                $transfer['id']            = $transfer_id;
                $transfer['date']          = formatTimestamp($transfer_arr[$i]->getVar('transfer_date'), 'm');
                $transfer['article']       = $transfer_arr[$i]->getVar('article_name') . ' (' . $transfer_arr[$i]->getVar('article_reference') . ')';
                $transfer['amount']        = $transfer_arr[$i]->getVar('transfer_amount');
                $transfer['user']          = XoopsUser::getUnameFromId($transfer_arr[$i]->getVar('transfer_userid'));
				switch ($transfer_arr[$i]->getVar('transfer_type')) {
					default:
					case 'E':
						$transfer['type'] = _MA_XMSTOCK_TRANSFER_ENTRYINSTOCK;
						break;
						
					case 'O':
						$transfer['type'] = _MA_XMSTOCK_TRANSFER_OUTOFSTOCK;
						break;
						
					case 'T':
						$transfer['type'] = _MA_XMSTOCK_TRANSFER_TRANSFEROFSTOCK;
						break;
				}
                $transfer['status']        = $transfer_arr[$i]->getVar('transfer_status');
                $xoopsTpl->append_by_ref('transfer', $transfer);
                unset($transfer);
            }
            // Display Page Navigation
            if ($transfer_count > $nb_limit) {
                $nav = new XoopsPageNav($transfer_count, $nb_limit, $start, 'start');
                $xoopsTpl->assign('nav_menu', $nav->renderNav(4));
            }
        } else {
            $xoopsTpl->assign('error_message', _MA_XMSTOCK_ERROR_NOTRANSFER);
        }
        break;
    
    // Add
    case 'add':
        // Module admin
        $moduleAdmin->addItemButton(_MA_XMSTOCK_TRANSFER_LIST, 'transfer.php', 'list');
        $xoopsTpl->assign('renderbutton', $moduleAdmin->renderButton());        
        // Form
		$type = Request::getString('type', 'E');
        $obj  = $transferHandler->create();
        $form = $obj->getForm($type);
        $xoopsTpl->assign('form', $form->render());
        break;
        
    // Edit
    case 'edit':
        // Module admin
        $moduleAdmin->addItemButton(_MA_XMSTOCK_TRANSFER_LIST, 'transfer.php', 'list');
        $xoopsTpl->assign('renderbutton', $moduleAdmin->renderButton());        
        // Form
        $transfer_id = Request::getInt('transfer_id', 0);
        if ($transfer_id == 0) {
            $xoopsTpl->assign('error_message', _MA_XMSTOCK_ERROR_NOTRANSFER);
        } else {
            $obj = $transferHandler->get($transfer_id);
			if ($obj->getVar('transfer_status') == 0){
				$form = $obj->getForm();
				$xoopsTpl->assign('form', $form->render());
			}				
        }

        break;
    // Save
    case 'save':
        if (!$GLOBALS['xoopsSecurity']->check()) {
            redirect_header('transfer.php', 3, implode('<br />', $GLOBALS['xoopsSecurity']->getErrors()));
        }
        $transfer_id = Request::getInt('transfer_id', 0);
        if ($transfer_id == 0) {
            $obj = $transferHandler->create();            
        } else {
            $obj = $transferHandler->get($transfer_id);
        }
        $error_message = $obj->saveTransfer($transferHandler, 'transfer.php');
        if ($error_message != ''){
            $xoopsTpl->assign('error_message', $error_message);
            $form = $obj->getForm();
            $xoopsTpl->assign('form', $form->render());
        }        
        break;
		
	// del
    case 'del':    
        $transfer_id = Request::getInt('transfer_id', 0);
        if ($transfer_id == 0) {
            $xoopsTpl->assign('error_message', _MA_XMSTOCK_ERROR_NOTRANSFER);
        } else {
			$obj = $transferHandler->get($transfer_id);
			if ($obj->getVar('transfer_status') == 0){
				$surdel = Request::getBool('surdel', false);
				if ($surdel === true) {
					if (!$GLOBALS['xoopsSecurity']->check()) {
						redirect_header('transfer.php', 3, implode('<br />', $GLOBALS['xoopsSecurity']->getErrors()));
					}
					if ($transferHandler->delete($obj)) {					
						redirect_header('transfer.php', 2, _MA_XMSTOCK_REDIRECT_SAVE);
					} else {
						$xoopsTpl->assign('error_message', $obj->getHtmlErrors());
					}
				} else {
					xoops_confirm(array('surdel' => true, 'transfer_id' => $transfer_id, 'op' => 'del'), $_SERVER['REQUEST_URI'], 
										sprintf(_MA_XMSTOCK_TRANSFER_SUREDEL, $obj->getVar('transfer_ref')));
				}
			}
        }        
        break;
		
	// Update status
    case 'update_status':
        $transfer_id = Request::getInt('transfer_id', 0);
        if ($transfer_id > 0) {
            $obj = $transferHandler->get($transfer_id);
            $status = $obj->getVar('transfer_status');
			if ($status == 0) {
				$obj->setVar('transfer_status', 1);
				if ($transferHandler->insert($obj)) {
					redirect_header('transfer.php', 2, _MA_XMSTOCK_REDIRECT_SAVE);
				}
				$xoopsTpl->assign('error_message', $obj->getHtmlErrors());
			}
        }
        break;
}

$xoopsTpl->display("db:xmstock_admin_transfer.tpl");

require __DIR__ . '/admin_footer.php';
