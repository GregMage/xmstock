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
	include __DIR__ . '/../include/common.php';
	include_once __DIR__ . '/../class/utility.php';

	$helper = Helper::getHelper('xmstock');
	$helper->loadLanguage('main');

	$criteria = new CriteriaCompo();
	$criteria->setSort('order_dorder DESC, order_status');
	$criteria->setOrder('ASC');

	switch ($options[2]) {
		case "myorders":
			$criteria->add(new Criteria('order_userid', !empty($xoopsUser) ? $xoopsUser->getVar('uid') : 0));
			break;

		case "process":
			//$criteria->add(new Criteria('order_userid', !empty($xoopsUser) ? $xoopsUser->getVar('uid') : 0));
			break;

	}
	$criteria->add(new Criteria('order_status', '(' . $options[0] . ')', 'IN'));

	/*// Get Permission to view
	$viewPermissionCat = XmdocUtility::getPermissionCat('xmdoc_view');
	//xmsocial
	if (xoops_isActiveModule('xmsocial') && $helper->getConfig('general_xmsocial', 0) == 1) {
		xoops_load('utility', 'xmsocial');
	}

	$permDocHelper = new Helper\Permission('xmdoc');

	$block = array();
	$block['use_modal'] = $helper->getConfig('general_usemodal', 1);

	$criteria = new CriteriaCompo();
	$criteria->add(new Criteria('document_status', 1));
	switch ($options[2]) {
        case "date":
			$criteria->setSort('document_date DESC, document_name');
			$criteria->setOrder('ASC');
        break;

        case "hits":
			$criteria->setSort('document_counter DESC, document_name');
			$criteria->setOrder('ASC');
        break;

        case "rating":
			$criteria->setSort('document_rating DESC, document_name');
			$criteria->setOrder('ASC');
        break;

        case "random":
            $criteria->setSort('RAND()');
        break;

		case "title":
			switch ($options[3]) {
				case 0:
					$criteria->setSort('document_date DESC, document_name');
					$criteria->setOrder('ASC');
					break;

				case 1:
					$criteria->setSort('document_counter DESC, document_name');
					$criteria->setOrder('ASC');
					break;

				case 2:
					$criteria->setSort('document_rating DESC, document_name');
					$criteria->setOrder('ASC');
					break;

				case 3:
					$criteria->setSort('RAND()');
					break;
			}
			$block['size'] = $options[4];
			$block['logo'] = $options[5];
			break;
    }
	$category_ids = explode(',', $options[0]);
	if (!in_array(0, $category_ids)) {
        $criteria->add(new Criteria('category_id', '(' . $options[0] . ')', 'IN'));
    }
	$criteria->setLimit($options[1]);
	if (!empty($viewPermissionCat)) {
		$criteria->add(new Criteria('document_category', '(' . implode(',', $viewPermissionCat) . ')', 'IN'));
	}
	$documentHandler->table_link = $documentHandler->db->prefix("xmdoc_category");
	$documentHandler->field_link = "category_id";
	$documentHandler->field_object = "document_category";
	$document_arr = $documentHandler->getByLink($criteria);
	if (count($document_arr) > 0 && !empty($viewPermissionCat)) {
		foreach (array_keys($document_arr) as $i) {
			$document_id                   = $document_arr[$i]->getVar('document_id');
			$document['id']                = $document_id;
			$document['name']              = $document_arr[$i]->getVar('document_name');
			$document['category']          = $document_arr[$i]->getVar('category_name');
			$document['categoryid']        = $document_arr[$i]->getVar('document_category');
			$document['document']          = $document_arr[$i]->getVar('document_document');
			$document['description']       	   = str_replace('[break]', '', $document_arr[$i]->getVar('document_description', 'show'));
			if (false == strpos($document_arr[$i]->getVar('document_description', 'e'), '[break]')){
				$document['description_short'] = $document_arr[$i]->getVar('document_description', 'show');
				$document['description_end']   = '';
			}else{
				$document['description_short'] = substr($document_arr[$i]->getVar('document_description', 'show'), 0, strpos($document_arr[$i]->getVar('document_description', 'show'),'[break]'));
				$document['description_end']   = str_replace('[break]', '', substr($document_arr[$i]->getVar('document_description', 'show'), strpos($document_arr[$i]->getVar('document_description', 'show'),'[break]')));
			}
			$document['size']              = XmdocUtility::SizeConvertString($document_arr[$i]->getVar('document_size'));
			$document['author']            = XoopsUser::getUnameFromId($document_arr[$i]->getVar('document_userid'));
			$document['date']              = formatTimestamp($document_arr[$i]->getVar('document_date'), 's');
			if ($document_arr[$i]->getVar('document_mdate') != 0) {
				$document['mdate']         = formatTimestamp($document_arr[$i]->getVar('document_mdate'), 's');
			}
			$document['counter']           = $document_arr[$i]->getVar('document_counter');
			$document['showinfo']          = $document_arr[$i]->getVar('document_showinfo');
			$document_img                  = $document_arr[$i]->getVar('document_logo') ?: 'blank_doc.gif';
			$document['logo']              = $url_logo_document . $document_img;
			$color 						   = $document_arr[$i]->getVar('category_color');
			if ($color == '#ffffff'){
				$document['color'] 		   = false;
			} else {
				$document['color'] 		   = $color;
			}
			$document['perm_edit']         = $permDocHelper->checkPermission('xmdoc_editapprove', $document['categoryid']);
			$document['perm_del']          = $permDocHelper->checkPermission('xmdoc_delete', $document['categoryid']);
			//xmsocial
			if (xoops_isActiveModule('xmsocial') && $helper->getConfig('general_xmsocial', 0) == 1) {
				$document['xmsocial_arr'] = XmsocialUtility::renderRating('xmdoc', $document_id , 5, $document_arr[$i]->getVar('document_rating'), $document_arr[$i]->getVar('document_votes'));
				$document['dorating'] = 1;
			} else {
				$document['dorating'] = 0;
			}
			$block['document'][] = $document;
			unset($document);
		}
	}*/
	$GLOBALS['xoTheme']->addStylesheet(XOOPS_URL . '/modules/xmstock/assets/css/styles.css');
	return $block;
}

function block_xmstock_edit($options) {
	include __DIR__ . '/../include/common.php';
	$helper->loadLanguage('main');

	$status_arr = array(
		0 => _MA_XMSTOCK_ORDER_STATUS_TITLE_0,
		1 => _MA_XMSTOCK_ORDER_STATUS_TITLE_1,
		2 => _MA_XMSTOCK_ORDER_STATUS_TITLE_2,
		3 => _MA_XMSTOCK_ORDER_STATUS_TITLE_3,
		4 => _MA_XMSTOCK_ORDER_STATUS_TITLE_4,
		);

	include_once XOOPS_ROOT_PATH . '/modules/xmstock/class/blockform.php';
    xoops_load('XoopsFormLoader');

    $form = new XmstockBlockForm();
	$status = new XoopsFormSelect(_MB_XMSTOCK_STATUS, 'options[0]', explode(',', $options[0]), 5, true);
	foreach (array_keys($status_arr) as $i) {
		$status->addOption($i, $status_arr[$i]);
	}
	$form->addElement($status);
	$form->addElement(new XoopsFormText(_MB_XMSTOCK_NBORDER, 'options[1]', 5, 5, $options[1]), true);
	$form->addElement(new XoopsFormHidden('options[2]', $options[2]));

	return $form->render();
}