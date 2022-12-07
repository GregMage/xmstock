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
$GLOBALS['xoopsOption']['template_main'] = 'xmstock_loan.tpl';
include_once XOOPS_ROOT_PATH . '/header.php';

$xoTheme->addStylesheet(XOOPS_URL . '/modules/' . $xoopsModule->getVar('dirname', 'n') . '/assets/css/styles.css', null);
$xoTheme->addScript('modules/xmstock/assets/js/FileSaver.js');
$xoTheme->addScript('modules/xmstock/assets/js/export.js');

// Get Permission to manage
$managePermissionArea = XmstockUtility::getPermissionArea('xmstock_manage');

if (empty($managePermissionArea)) {
	redirect_header('index.php', 2, _NOPERM);
}

$xoopsTpl->assign('index_module', $helper->getModule()->getVar('name'));

// Get Action type
$op = Request::getCmd('op', 'list');
$xoopsTpl->assign('op', $op);
switch ($op) {
    case 'list':
        // Get start pager
        $start = Request::getInt('start', 0);
		//filters
		$area_id = Request::getInt('area_id', 0);
        $xoopsTpl->assign('area_id', $area_id);
		$sort = Request::getString('sort', 'DESC');
		$filter = Request::getInt('filter', 10);
		$xoopsTpl->assign('sort', $sort);
		$xoopsTpl->assign('filter', $filter);
		//external filters
		$article_id = Request::getInt('article_id', 0);

		//area
		$area = array();
		$area[0] = '';
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

        // Criteria loan
        $criteria = new CriteriaCompo();
        $criteria->setSort('loan_date');
		$criteria->setStart($start);
		$criteria->setLimit($filter);
		$criteria->setOrder($sort);

		$loanHandler->table_link = $loanHandler->db->prefix("xmarticle_article");
        $loanHandler->field_link = "article_id";
        $loanHandler->field_object = "loan_articleid";
        $loan_arr = $loanHandler->getByLink($criteria);
        $loan_count = $loanHandler->getCountByLink($criteria);
        $xoopsTpl->assign('loan_count', $loan_count);
		$xoopsTpl->assign('export_head', '#;' . _MA_XMSTOCK_LOAN_DATE . ';' . _MA_XMSTOCK_LOAN_LARTICLE . ';' . _MA_XMSTOCK_LOAN_RDATE . ';' . _MA_XMSTOCK_LOAN_USERID . ';' . _MA_XMSTOCK_LOAN_STATUS . '\n');
        if ($loan_count > 0) {
            foreach (array_keys($loan_arr) as $i) {
                $loan_id               = $loan_arr[$i]->getVar('loan_id');
                $loan['id']            = $loan_id;
                $loan['date']          = formatTimestamp($loan_arr[$i]->getVar('loan_date'), 'm');
                $loan['rdate']         = formatTimestamp($loan_arr[$i]->getVar('loan_rdate'), 'm');
                $loan['article']       = '<a href="' . XOOPS_URL . '/modules/xmarticle/viewarticle.php?category_id=' . $loan_arr[$i]->getVar('article_cid') . '&article_id=' . $loan_arr[$i]->getVar('article_id') . '" title="' . $loan_arr[$i]->getVar('article_name') . '" target="_blank">' . $loan_arr[$i]->getVar('article_name') . '</a> (' . $loan_arr[$i]->getVar('loan_reference') . ')';
                $loan['status']        = $loan_arr[$i]->getVar('loan_status');
                $loan['user']     	   = XoopsUser::getUnameFromId($loan_arr[$i]->getVar('loan_userid'));
				if ($loan['status'] == 0) {
					$loan['text_status'] = _MA_XMSTOCK_LOAN_STATUS_C;
				} else {
					$loan['text_status'] = _MA_XMSTOCK_LOAN_STATUS_L;
				}
				$loan['export'] = $loan_id . ';' . $loan['date'] . ';' . $loan_arr[$i]->getVar('article_name') . '(' . $loan_arr[$i]->getVar('article_reference') . ')' . ';' . $loan['rdate'] . ';' . $loan['user'] . ';' . $loan['text_status'] . '\n';
                $xoopsTpl->append_by_ref('loans', $loan);
                unset($loan);
            }
            // Display Page Navigation
            if ($loan_count > $filter) {
                $nav = new XoopsPageNav($loan_count, $filter, $start, 'start', 'area_id=' . $area_id .'&sort=' . $sort . '&filter=' . $filter . '&article_id=' . $article_id);
                $xoopsTpl->assign('nav_menu', $nav->renderNav(4));
            }
        }
        break;

    // Add
    case 'add':
        // Form
        $obj  = $loanHandler->create();
        $form = $obj->getForm();
        $xoopsTpl->assign('form', $form->render());
        break;

    // Save
    case 'save':
        if (!$GLOBALS['xoopsSecurity']->check()) {
            redirect_header('loan.php', 3, implode('<br />', $GLOBALS['xoopsSecurity']->getErrors()));
        }
        $loan_id = Request::getInt('loan_id', 0);
        if ($loan_id == 0) {
            $obj = $loanHandler->create();
        } else {
            $obj = $loanHandler->get($loan_id);
        }
        $error_message = $obj->saveLoan($loanHandler, XOOPS_URL . "/modules/xmstock/loan.php");
        if ($error_message != ''){
			$xoopsTpl->assign('error_message', $error_message);
            $form = $obj->getForm();
            $xoopsTpl->assign('form', $form->render());
        }
        break;
}

//SEO
// pagetitle
$xoopsTpl->assign('xoops_pagetitle', _MI_XMSTOCK_SUB_LOAN . ' - ' . $xoopsModule->name());
include XOOPS_ROOT_PATH . '/footer.php';
