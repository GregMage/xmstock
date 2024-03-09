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
		//output
		$criteria = new CriteriaCompo();
		$criteria->add(new Criteria('output_status', 1));
		$output_arr = $outputHandler->getall($criteria);
		$output[0] = '';
		if (count($output_arr) > 0) {
			foreach (array_keys($output_arr) as $i) {
				$output[$i] = $output_arr[$i]->getVar('output_name');
			}
		}

		// Criteria warning
        $criteria = new CriteriaCompo();
        $criteria->setSort('transfer_date');
		$criteria->setOrder('ASC');
		$criteria->add(new Criteria('transfer_status', 0));
		$transferHandler->table_link = $transferHandler->db->prefix("xmarticle_article");
        $transferHandler->field_link = "article_id";
        $transferHandler->field_object = "transfer_articleid";
        $transfer_w_arr = $transferHandler->getByLink($criteria);
        $xoopsTpl->assign('transfer_w_count', count($transfer_w_arr));
        if (count($transfer_w_arr) > 0) {
            foreach (array_keys($transfer_w_arr) as $i) {
                $transfer_w_id               = $transfer_w_arr[$i]->getVar('transfer_id');
                $transfer_w['id']            = $transfer_w_id;
                $transfer_w['date']          = formatTimestamp($transfer_w_arr[$i]->getVar('transfer_date'), 'm');
                $transfer_w['article']       = '<a href="' . XOOPS_URL . '/modules/xmarticle/viewarticle.php?category_id=' . $transfer_w_arr[$i]->getVar('article_cid') . '&article_id=' . $transfer_w_arr[$i]->getVar('article_id') . '" title="' . $transfer_w_arr[$i]->getVar('article_name') . '" target="_blank">' . $transfer_w_arr[$i]->getVar('article_name') . '</a> (' . $transfer_w_arr[$i]->getVar('article_reference') . ')';
                $transfer_w['ref']           = $transfer_w_arr[$i]->getVar('transfer_ref');
                $transfer_w['amount']        = $transfer_w_arr[$i]->getVar('transfer_amount');
				$transfer_w['description']   = $transfer_w_arr[$i]->getVar('transfer_description');
                $transfer_w['user']     	 = XoopsUser::getUnameFromId($transfer_w_arr[$i]->getVar('transfer_userid'), 0, true);
				$transfer_w['type']   		 = _MA_XMSTOCK_TRANSFER_TRANSFEROFSTOCK;
				if ($transfer_w_arr[$i]->getVar('transfer_ar_areaid') != 0) {
					$transfer_w['destination'] = _MA_XMSTOCK_TRANSFER_STOCK . $area[$transfer_w_arr[$i]->getVar('transfer_ar_areaid')];
				} else {
					$transfer_w['destination'] = '';
				}
				$transfer_w['starea'] 		 = $area[$transfer_w_arr[$i]->getVar('transfer_st_areaid')];
				if (in_array($transfer_w_arr[$i]->getVar('transfer_ar_areaid'), $managePermissionArea) == true){
					$transfer_w['action']    = true;
				} else {
					$transfer_w['action']    = false;
				}


				$xoopsTpl->appendByRef('transfers_w', $transfer_w);
                unset($transfer_w);
            }
		}

        // Criteria transfer
        $criteria = new CriteriaCompo();
        $criteria->setSort('transfer_date');
		$criteria->setStart($start);
		$criteria->setLimit($filter);
		$criteria->setOrder($sort);

		if ($area_id == 0){
			$criteria->add(new Criteria('(transfer_st_areaid', '(' . implode(',', $managePermissionArea) . ')', 'IN'), 'OR');
			$criteria->add(new Criteria('transfer_ar_areaid', '(' . implode(',', $managePermissionArea) . ')', 'IN'), 'OR');
		} else {
			$criteria->add(new Criteria('(transfer_st_areaid', $area_id ), 'OR');
			$criteria->add(new Criteria('transfer_ar_areaid', $area_id), 'OR');
		}
		if ($article_id != 0) {
			$criteria->add(new Criteria('article_id', $article_id), ') AND');
			$criteria->add(new Criteria('transfer_status', 1), 'AND');
		} else {
			$criteria->add(new Criteria('transfer_status', 1), ') AND');
		}
		$transferHandler->table_link = $transferHandler->db->prefix("xmarticle_article");
        $transferHandler->field_link = "article_id";
        $transferHandler->field_object = "transfer_articleid";
        $transfer_arr = $transferHandler->getByLink($criteria);
        $transfer_count = $transferHandler->getCountByLink($criteria);
        $xoopsTpl->assign('transfer_count', $transfer_count);
		$xoopsTpl->assign('export_head', '#;' . _MA_XMSTOCK_TRANSFER_DESC . ';' . _MA_XMSTOCK_TRANSFER_ARTICLE . ';' . _MA_XMSTOCK_TRANSFER_REF . ';' . _MA_XMSTOCK_TRANSFER_TYPE . ';' . _MA_XMSTOCK_TRANSFER_DATE . ';' . _MA_XMSTOCK_TRANSFER_TIME . ';' . _MA_XMSTOCK_TRANSFER_AMOUNT . ';' . _MA_XMSTOCK_TRANSFER_DESTINATION . ';' . _MA_XMSTOCK_TRANSFER_USER . '\n');
        if ($transfer_count > 0) {
            foreach (array_keys($transfer_arr) as $i) {
                $transfer_id               = $transfer_arr[$i]->getVar('transfer_id');
                $transfer['id']            = $transfer_id;
                $transfer['date']          = formatTimestamp($transfer_arr[$i]->getVar('transfer_date'), 'm');
                $transfer['article']       = '<a href="' . XOOPS_URL . '/modules/xmarticle/viewarticle.php?category_id=' . $transfer_arr[$i]->getVar('article_cid') . '&article_id=' . $transfer_arr[$i]->getVar('article_id') . '" title="' . $transfer_arr[$i]->getVar('article_name') . '" target="_blank">' . $transfer_arr[$i]->getVar('article_name') . '</a> (' . $transfer_arr[$i]->getVar('article_reference') . ')';
                $transfer['ref']           = $transfer_arr[$i]->getVar('transfer_ref');
                $transfer['description']   = $transfer_arr[$i]->getVar('transfer_description');
                $transfer['amount']        = $transfer_arr[$i]->getVar('transfer_amount');
                $transfer['code_type']     = $transfer_arr[$i]->getVar('transfer_type');
                $transfer['needsyear']     = $transfer_arr[$i]->getVar('transfer_needsyear');
                $transfer['user']     	   = XoopsUser::getUnameFromId($transfer_arr[$i]->getVar('transfer_userid'), 0, true);
                $transfer['user-export']   = XoopsUser::getUnameFromId($transfer_arr[$i]->getVar('transfer_userid'), 0, false);
				switch ($transfer_arr[$i]->getVar('transfer_type')) {
					default:
					case 'E':
						$transfer['type'] 	= _MA_XMSTOCK_TRANSFER_ENTRYINSTOCK;
						$transfer['starea'] = '';
						$transfer['destination'] = _MA_XMSTOCK_TRANSFER_STOCK . $area[$transfer_arr[$i]->getVar('transfer_ar_areaid')];
						$transfer['destination-export'] = _MA_XMSTOCK_TRANSFER_STOCK . $area[$transfer_arr[$i]->getVar('transfer_ar_areaid')];
						break;

					case 'O':
						$transfer['type']   = _MA_XMSTOCK_TRANSFER_OUTOFSTOCK;
						$transfer['starea'] = $area[$transfer_arr[$i]->getVar('transfer_st_areaid')];
						if ($transfer_arr[$i]->getVar('transfer_outputuserid') == 0){
							if ($transfer_arr[$i]->getVar('transfer_outputid') != 0){
								$transfer['destination'] = $output[$transfer_arr[$i]->getVar('transfer_outputid')];
							} else {
								$transfer['destination'] = '';
							}
							$transfer['destination-export'] = $transfer['destination'];
						} else {
							$transfer['destination'] = XoopsUser::getUnameFromId($transfer_arr[$i]->getVar('transfer_outputuserid'), false, true);
							$transfer['destination-export'] = XoopsUser::getUnameFromId($transfer_arr[$i]->getVar('transfer_outputuserid'), false, false);
						}
						break;

					case 'T':
						$transfer['type']   = _MA_XMSTOCK_TRANSFER_TRANSFEROFSTOCK;
						$transfer['destination'] = _MA_XMSTOCK_TRANSFER_STOCK . $area[$transfer_arr[$i]->getVar('transfer_ar_areaid')];
						$transfer['destination-export'] = _MA_XMSTOCK_TRANSFER_STOCK . $area[$transfer_arr[$i]->getVar('transfer_ar_areaid')];
						$transfer['starea'] = $area[$transfer_arr[$i]->getVar('transfer_st_areaid')];
						break;
				}
				$transfer['export'] = $transfer_id . ';' . $transfer['description'] . ';' . $transfer_arr[$i]->getVar('article_name') . '(' . $transfer_arr[$i]->getVar('article_reference') . ')' . ';' . $transfer['ref'] . ';' . $transfer['type'] . ';' . formatTimestamp($transfer_arr[$i]->getVar('transfer_date'), 's') . ';' . substr(formatTimestamp($transfer_arr[$i]->getVar('transfer_date'), 'm'), -5) . ';' . $transfer['amount'] . ';' . $transfer['destination-export'] . ';' . $transfer['user-export'] . '\n';
                $xoopsTpl->appendByRef('transfers', $transfer);
                unset($transfer);
            }
            // Display Page Navigation
            if ($transfer_count > $filter) {
                $nav = new XoopsPageNav($transfer_count, $filter, $start, 'start', 'area_id=' . $area_id .'&sort=' . $sort . '&filter=' . $filter . '&article_id=' . $article_id);
                $xoopsTpl->assign('nav_menu', $nav->renderNav(4));
            }
        }
        break;

    // Add
    case 'add':
        // Form
		$type = Request::getString('type', 'E');
        $obj  = $transferHandler->create();
		$obj->setVar('transfer_articleid', Request::getInt('article_id', 0));
		if ($type == 'E'){
			$obj->setVar('transfer_ar_areaid', Request::getInt('area_id', 0));
		}
		$obj->setVar('transfer_st_areaid', Request::getInt('area_id', 0));
        $form = $obj->getForm($type);
		$xoopsTpl->assign('type', $type);
		$payload = array(
            'aud' => 'stockajax.php',
            'cat' => '',
            'uid' => (is_object($GLOBALS['xoopsUser'])) ? $GLOBALS['xoopsUser']->uid() : 0
        );
		$jwt = \Xmf\Jwt\TokenFactory::build('stock', $payload, 60*10); // token good for 10 minutes
        $xoopsTpl->assign('jwt', $jwt);
        $xoopsTpl->assign('form', $form->render());
        break;

    // Validation
    case 'valid':
        // Form
        $transfer_id = Request::getInt('transfer_id', 0);
        if ($transfer_id == 0) {
            $xoopsTpl->assign('error_message', _MA_XMSTOCK_ERROR_NOTRANSFER);
        } else {
            $obj = $transferHandler->get($transfer_id);
			if (in_array($obj->getVar('transfer_ar_areaid'), $managePermissionArea) != true){
				redirect_header('transfer.php', 3, _NOPERM);
			}
			if ($obj->getVar('transfer_status') == 0){
				xoops_load('utility', 'xmarticle');
				$xoopsTpl->assign('transfert_id', $transfer_id);
				$xoopsTpl->assign('transfer_description', $obj->getVar('transfer_description'));
				$xoopsTpl->assign('transfer_article', XmarticleUtility::getArticleName($obj->getVar('transfer_articleid'), true));
				$xoopsTpl->assign('transfer_ref', $obj->getVar('transfer_ref'));
				$xoopsTpl->assign('transfer_type', _MA_XMSTOCK_TRANSFER_TRANSFEROFSTOCK);
				$xoopsTpl->assign('transfer_date', formatTimestamp($obj->getVar('transfer_date'), 'm'));
				$xoopsTpl->assign('transfer_amount', $obj->getVar('transfer_amount'));
				$area = $areaHandler->get($obj->getVar('transfer_st_areaid'));
				$xoopsTpl->assign('transfer_starea', $area->getVar('area_name'));
				$area = $areaHandler->get($obj->getVar('transfer_ar_areaid'));
				$xoopsTpl->assign('transfer_destination', $area->getVar('area_name'));
				$xoopsTpl->assign('transfer_user', XoopsUser::getUnameFromId($obj->getVar('transfer_userid')));
				$form = $obj->getForm('T', 0);
				$payload = array(
					'aud' => 'stockajax.php',
					'cat' => '',
					'uid' => (is_object($GLOBALS['xoopsUser'])) ? $GLOBALS['xoopsUser']->uid() : 0
				);
				$jwt = \Xmf\Jwt\TokenFactory::build('stock', $payload, 60*10); // token good for 10 minutes
				$xoopsTpl->assign('jwt', $jwt);
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
			$payload = array(
				'aud' => 'stockajax.php',
				'cat' => '',
				'uid' => (is_object($GLOBALS['xoopsUser'])) ? $GLOBALS['xoopsUser']->uid() : 0
			);
			$jwt = \Xmf\Jwt\TokenFactory::build('stock', $payload, 60*10); // token good for 10 minutes
			$xoopsTpl->assign('jwt', $jwt);
            $form = $obj->getForm($obj->getVar('transfer_type'), $obj->getVar('transfer_status'));
            $xoopsTpl->assign('form', $form->render());
        }
        break;
}

//SEO
// pagetitle
$xoopsTpl->assign('xoops_pagetitle', _MI_XMSTOCK_SUB_TRANSFER . ' - ' . $xoopsModule->name());
include XOOPS_ROOT_PATH . '/footer.php';
