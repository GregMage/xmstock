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
$GLOBALS['xoopsOption']['template_main'] = 'xmstock_transfer.tpl';
include_once XOOPS_ROOT_PATH . '/header.php';

$xoTheme->addStylesheet(XOOPS_URL . '/modules/' . $xoopsModule->getVar('dirname', 'n') . '/assets/css/styles.css', null);

// Get Permission to manage
$managePermissionArea = XmstockUtility::getPermissionArea('xmstock_manage');

if (empty($managePermissionArea)) {
	redirect_header('index.php', 2, _NOPERM);
}

$xoopsTpl->assign('index_module', $helper->getModule()->getVar('name'));

// Get Action type
$op = Request::getCmd('op', 'list');
switch ($op) {
    case 'list':       
        // Get start pager
        $start = Request::getInt('start', 0);		
		//filter
		$area_id = Request::getInt('area_id', 0);
        $xoopsTpl->assign('area_id', $area_id);
		$sort = Request::getString('sort', 'DESC');
		$filter = Request::getInt('filter', 10);
		$xoopsTpl->assign('sort', $sort);
		$xoopsTpl->assign('filter', $filter);
		
		//area
		$area = array();
		$criteria = new CriteriaCompo();
		$criteria->setSort('area_weight ASC, area_name');
        $criteria->setOrder('ASC');
        $area_arr = $areaHandler->getall($criteria);
		if (count($area_arr) > 0) {
			$area_options = '<option value="0"' . ($area_id == 0 ? ' selected="selected"' : '') . '>' . _ALL .'</option>';
			foreach (array_keys($area_arr) as $i) {
				if (in_array($i, $managePermissionArea)){
					$area_options .= '<option value="' . $i . '"' . ($area_id == $i ? ' selected="selected"' : '') . '>' . $area_arr[$i]->getVar('area_name') . '</option>';
				}
				$area[$i] = $area_arr[$i]->getVar('area_name');
			}
			$xoopsTpl->assign('area_options', $area_options);
			
		}
		
		echo $area_options;
		
        // Criteria
        $criteria = new CriteriaCompo();
        $criteria->setSort('transfer_date');
		$criteria->setStart($start);
		$criteria->setLimit($filter);
		$criteria->setOrder($sort);
		$criteria->add(new Criteria('transfer_st_areaid', '(0,' . implode(',', $managePermissionArea) . ')', 'IN'));
		$criteria->add(new Criteria('transfer_ar_areaid', '(0,' . implode(',', $managePermissionArea) . ')', 'IN'));
		$transferHandler->table_link = $transferHandler->db->prefix("xmarticle_article");
        $transferHandler->field_link = "article_id";
        $transferHandler->field_object = "transfer_articleid";
        $transfer_arr = $transferHandler->getByLink($criteria);
        $transfer_count = $transferHandler->getCountByLink($criteria);
        $xoopsTpl->assign('transfer_count', $transfer_count);
        if ($transfer_count > 0) {
            foreach (array_keys($transfer_arr) as $i) {
                $transfer_id               = $transfer_arr[$i]->getVar('transfer_id');
                $transfer['id']            = $transfer_id;
                $transfer['date']          = formatTimestamp($transfer_arr[$i]->getVar('transfer_date'), 'm');
                $transfer['article']       = '<a href="' . XOOPS_URL . '/modules/xmarticle/viewarticle.php?category_id=' . $transfer_arr[$i]->getVar('article_cid') . '&article_id=' . $transfer_arr[$i]->getVar('article_id') . '" title="' . $transfer_arr[$i]->getVar('article_name') . '" target="_blank">' . $transfer_arr[$i]->getVar('article_name') . '</a> (' . $transfer_arr[$i]->getVar('article_reference') . ')';
                $transfer['ref']           = $transfer_arr[$i]->getVar('transfer_ref');
                $transfer['amount']        = $transfer_arr[$i]->getVar('transfer_amount');
                $transfer['user']          = XoopsUser::getUnameFromId($transfer_arr[$i]->getVar('transfer_userid'), false, true);
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
                $xoopsTpl->append_by_ref('transfers', $transfer);
                unset($transfer);
            }
            // Display Page Navigation
            if ($transfer_count > $filter) {
                $nav = new XoopsPageNav($transfer_count, $nb_limit, $start, 'start');
                $xoopsTpl->assign('nav_menu', $nav->renderNav(4));
            }
        }
        break;
    
    // Add
    case 'add':       
        // Form
		$type = Request::getString('type', 'E');
        $obj  = $transferHandler->create();
        $form = $obj->getForm($type);
        $xoopsTpl->assign('form', $form->render());
        break;
        
    // Edit
    case 'edit':       
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
            $form = $obj->getForm($obj->getVar('transfer_type'), $obj->getVar('transfer_status'));
            $xoopsTpl->assign('form', $form->render());
        }        
        break;
}

//SEO
// pagetitle
$xoopsTpl->assign('xoops_pagetitle', _MI_XMSTOCK_SUB_TRANSFER . ' - ' . $xoopsModule->name());
include XOOPS_ROOT_PATH . '/footer.php';
