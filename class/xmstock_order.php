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
use Xmf\Request;
use Xmf\Module\Helper;

if (!defined('XOOPS_ROOT_PATH')) {
    die('XOOPS root path not defined');
}

/**
 * Class xmstock_order
 */
class xmstock_order extends XoopsObject
{
    // constructor
    /**
     * xmstock_order constructor.
     */
    public function __construct()
    {
        $this->initVar('order_id', XOBJ_DTYPE_INT, null, false, 11);
        $this->initVar('order_description', XOBJ_DTYPE_TXTAREA, null, false);
        // use html
        $this->initVar('dohtml', XOBJ_DTYPE_INT, 1, false);
		$this->initVar('order_userid', XOBJ_DTYPE_INT, null, false, 8);
		$this->initVar('order_areaid', XOBJ_DTYPE_INT, null, false, 8);
		$this->initVar('order_ddesired', XOBJ_DTYPE_INT, null, false, 10);
		$this->initVar('order_dorder', XOBJ_DTYPE_INT, null, false, 10);
		$this->initVar('order_dvalidation', XOBJ_DTYPE_INT, null, false, 10);
		$this->initVar('order_ddelivery', XOBJ_DTYPE_INT, null, false, 10);
		$this->initVar('order_dready', XOBJ_DTYPE_INT, null, false, 10);
		$this->initVar('order_ddelivery_r', XOBJ_DTYPE_INT, null, false, 10);
		$this->initVar('order_dcancellation', XOBJ_DTYPE_INT, null, false, 10);;
		$this->initVar('order_delivery', XOBJ_DTYPE_INT, null, false, 2);
        $this->initVar('order_status', XOBJ_DTYPE_INT, null, false, 1);
    }

    /**
     * @return mixed
     */
    public function get_new_enreg()
    {
        global $xoopsDB;
        $new_enreg = $xoopsDB->getInsertId();
        return $new_enreg;
    }

    /**
     * @return mixed
     */
    public function saveOrder($orderHandler, $action = false)
    {
        global $xoopsUser;
		$session_name = 'caddy';
        include __DIR__ . '/../include/common.php';

        $error_message = '';
        $this->setVar('order_description',  Request::getText('order_description', ''));
		$this->setVar('order_userid', !empty($xoopsUser) ? $xoopsUser->getVar('uid') : 0);
		$this->setVar('order_ddesired', strtotime(Request::getString('order_ddesired', '')));
		$this->setVar('order_dorder', time());
		$this->setVar('order_delivery',  Request::getInt('order_delivery', 0));
        $this->setVar('order_status', Request::getInt('order_status', 1));

        if ($error_message == '') {
			$sessionHelper = new \Xmf\Module\Helper\Session();
			$arr_selectionArticles = $sessionHelper->get($session_name);
			$areaid = 0;
			if (is_array($arr_selectionArticles) == true){
				$areaid = $arr_selectionArticles[0]['area'];
			}
			$this->setVar('order_areaid', $areaid);
            if ($orderHandler->insert($this)) {
				if ($this->get_new_enreg() == 0){
					$order_id = $this->getVar('order_id');
				} else {
					$order_id = $this->get_new_enreg();
				}
				if (is_array($arr_selectionArticles) == true){
					foreach ($arr_selectionArticles as $datas) {
						$obj = $itemorderHandler->create();
						$obj->setVar('itemorder_orderid', $order_id);
						$obj->setVar('itemorder_articleid', $datas['id']);
						$obj->setVar('itemorder_areaid', $datas['area']);
						$obj->setVar('itemorder_amount', $datas['qty']);
						$obj->setVar('itemorder_length', $datas['length']);
						if (!$itemorderHandler->insert($obj)) {
							$error_message = $obj->getHtmlErrors();
						}
					}
					if ($error_message == '') {
						if ($action === false) {
							$action = $_SERVER['REQUEST_URI'] . '?op=confirm&order_id=' . $order_id;
						}
						redirect_header($action, 2, _MA_XMSTOCK_CHECKOUT_SEND);
					}
				} else {
					redirect_header('index.php', 5, _MA_XMSTOCK_CADDY_ERROR_EMPTY);
				}
            } else {
                $error_message =  $this->getHtmlErrors();
            }
        }
        return $error_message;
    }

    /**
     * @return mixed
     */
    public function saveOrderEdit($orderHandler, $action = false)
    {
        global $xoopsUser;
        include __DIR__ . '/../include/common.php';

        $error_message = '';
        $this->setVar('order_description',  Request::getText('order_description', ''));
		$this->setVar('order_userid', Request::getInt('order_userid', 0));
		$this->setVar('order_ddesired', strtotime(Request::getString('order_ddesired', '')));
		$this->setVar('order_delivery',  Request::getInt('order_delivery', 0));
        $status = Request::getInt('order_status', 1);
        $this->setVar('order_status', $status);
		if ($status == 0){
			$this->setVar('order_dcancellation', time());
		}
		if ($orderHandler->insert($this)) {
			$order_id = $this->getVar('order_id');
			$count = Request::getInt('count', 0);
			if ($count > 0){
				for ($i = 1; $i <= $count; $i++) {
					$amount = Request::getInt('amount' . $i, 0);
					$itemorder = Request::getInt('itemorder' . $i, 0);
					$obj = $itemorderHandler->get($itemorder);
					if ($amount == 0){
						if ($count > 1){
							if (!$itemorderHandler->delete($obj)) {
								$error_message = $obj->getHtmlErrors();
							}
						} else {
							$error_message = _MA_XMSTOCK_ERROR_ONEARTICLE;
						}
					} else {
						$obj->setVar('itemorder_amount', $amount);
						if (!$itemorderHandler->insert($obj)) {
							$error_message = $obj->getHtmlErrors();
						}
					}
				}
				if ($error_message == '') {
					redirect_header($action, 2, _MA_XMSTOCK_REDIRECT_SAVE);
				}
			} else {
				$error_message = _MA_XMSTOCK_ERROR_NOARTICLE;
			}
		} else {
			$error_message =  $this->getHtmlErrors();
		}
        return $error_message;
    }

	/**
     * @param bool $action
     * @return XoopsThemeForm
     */
    public function getFormEdit($action = false)
    {
        $helper = Helper::getHelper('xmstock');
        if ($action === false) {
            $action = $_SERVER['REQUEST_URI'];
        }
		include_once $GLOBALS['xoops']->path('class/xoopsformloader.php');
        include __DIR__ . '/../include/common.php';

        //form title
        $title = sprintf(_MA_XMSTOCK_EDIT);
        $form = new XoopsThemeForm($title, 'form', $action, 'post', true);
		$form->addElement(new XoopsFormHidden('order_id', $this->getVar('order_id')));
		if ($this->getVar('order_status') > 0){
			$status = 1;
		} else {
			$status = 0;
		}

        // description
        $editor_configs           =array();
        $editor_configs['name']   = 'order_description';
        $editor_configs['value']  = $this->getVar('order_description', 'e');
        $editor_configs['rows']   = 3;
        $editor_configs['cols']   = 40;
        $editor_configs['width']  = '50%';
        $editor_configs['height'] = '100px';
        $editor_configs['editor'] = $helper->getConfig('general_editor', 'Plain Text');
        $form->addElement(new XoopsFormEditor(_MA_XMSTOCK_AREA_DESC, 'order_description', $editor_configs), false);

		$form->addElement(new XoopsFormTextDateSelect(_MA_XMSTOCK_CHECKOUT_DORDER, 'order_ddesired', 2, $this->getVar('order_ddesired')), false);

		$delivery = new XoopsFormRadio(_MA_XMSTOCK_CHECKOUT_DELIVERY, 'order_delivery', $this->getVar('order_delivery'));
		$options        = [0 => _MA_XMSTOCK_CHECKOUT_DELIVERY_WITHDRAWAL, 1 => _MA_XMSTOCK_CHECKOUT_DELIVERY_DELIVERY];
		$delivery->addOptionArray($options);
		$form->addElement($delivery);

		// articles
		$criteria = new CriteriaCompo();
		$criteria->add(new Criteria('stock_areaid', $this->getVar('order_areaid')));
		$stock_arr = $stockHandler->getall($criteria);
		$criteria = new CriteriaCompo();
		$criteria->add(new Criteria('itemorder_orderid', $this->getVar('order_id')));
		$itemorderHandler->table_link = $itemorderHandler->db->prefix("xmarticle_article");
		$itemorderHandler->field_link = "article_id";
		$itemorderHandler->field_object = "itemorder_articleid";
		$itemorder_arr = $itemorderHandler->getByLink($criteria);
		$count = 0;
		$articles = "<table  class='table table-bordered'><thead class='table-primary'><tr><th scope='col'>" . _MA_XMSTOCK_ACTION_ARTICLES . "</th><th scope='col'>" . _MA_XMSTOCK_VIEWORDER_AMOUNT . "</th><th scope='col'>" . _MA_XMSTOCK_STOCK_AMOUNT . "</th></tr></thead>";
		$articles .= "<tbody>";
		foreach (array_keys($itemorder_arr) as $i) {
			$count++;
			$area_name = XmstockUtility::getAreaName($this->getVar('order_areaid'), true, false);
			$articles .= "<tr><th scope='row'><a href='" . XOOPS_URL . "/modules/xmarticle/viewarticle.php?category_id=" . $itemorder_arr[$i]->getVar('article_cid') . "&article_id=" . $itemorder_arr[$i]->getVar('itemorder_articleid') . "' title='" . $itemorder_arr[$i]->getVar('article_name') . "' target='_blank'>" . $itemorder_arr[$i]->getVar('article_name') . "</a></th>";
			$articles .= "<td><input class='form-control' type='text' name='amount" . $count . "' id='amount" . $count . "' value='" . $itemorder_arr[$i]->getVar('itemorder_amount') . "'></td>";
			$articles .= "<td class='text-center'><span class='badge badge-primary badge-pill'>" . XmstockUtility::articleAmountPerArea($this->getVar('order_areaid'), $itemorder_arr[$i]->getVar('itemorder_articleid'), $stock_arr) . "</span> " . $area_name . "</td></tr>";
			$form->addElement(new XoopsFormHidden('itemorder' . $count, $i));
		}
		$articles .= "</tbody></table>";
		$articles .= "<small class='form-text text-muted'>" . _MA_XMSTOCK_ACTION_INFODELARTICLE . "</small>";
		$form->addElement(new XoopsFormLabel(_MA_XMSTOCK_ORDER_ARTICLES, $articles), true);
		$form->addElement(new XoopsFormHidden('count', $count));

		// user
        $form->addElement(new XoopsFormSelectUser(_MA_XMSTOCK_MANAGEMENT_CUSTOMER, 'order_userid', true, $this->getVar('order_userid')), true);

		// status
        $form_status = new XoopsFormRadio(_MA_XMSTOCK_STATUS, 'order_status', $status);
        $options = array(1 => _MA_XMSTOCK_STATUS_A, 0 =>_MA_XMSTOCK_ORDER_STATUS_0);
        $form_status->addOptionArray($options);
        $form->addElement($form_status);

		$form->addElement(new XoopsFormHidden('op', 'save'));
		$form->addElement(new XoopsFormHidden('order_areaid', $this->getVar('order_areaid')));
        // submit
        $form->addElement(new XoopsFormButton('', 'submit', _SUBMIT, 'submit'));

        return $form;
    }

    /**
     * @return mixed
     */
    public function saveOrderNext($orderHandler, $action = false)
    {
        global $xoopsUser;
        include __DIR__ . '/../include/common.php';

        $error_message = '';
		$status = $this->getVar('order_status');
		switch ($status) {
			case 1:
				$this->setVar('order_delivery', Request::getInt('order_delivery', ''));
				$this->setVar('order_ddelivery',  strtotime(Request::getString('order_ddelivery', '')));
				$this->setVar('order_dvalidation', time());
				break;
			case 2:
				$this->setVar('order_dready', time());
				break;
			case 3:
				$this->setVar('order_ddelivery_r', time());
				break;
		}
		$count = Request::getInt('count', 0);
		$criteria = new CriteriaCompo();
		$criteria->add(new Criteria('stock_areaid', $this->getVar('order_areaid')));
		$stock_arr = $stockHandler->getall($criteria);
		// Contrôle pour ne pas faire suivre si le stock d'un article n'est pas suffissant
		if ($status == 2) {
			if ($count > 0){
				for ($i = 1; $i <= $count; $i++) {
					if (!isset($_POST['split' . $i])){
						$itemorder = Request::getInt('itemorder' . $i, 0);
						$item = $itemorderHandler->get($itemorder);
						$type = XmstockUtility::articleTypePerArea($this->getVar('order_areaid'), $item->getVar('itemorder_articleid'), $stock_arr);
						if ($type == 2){
							$error_message .= XmstockUtility::checkTransfert('O', $item->getVar('itemorder_articleid'), $item->getVar('itemorder_amount')*$item->getVar('itemorder_length'), $item->getVar('itemorder_areaid'));
						} else {
							$error_message .= XmstockUtility::checkTransfert('O', $item->getVar('itemorder_articleid'), $item->getVar('itemorder_amount'), $item->getVar('itemorder_areaid'));
						}
					}
				}
			}
		}
		if ($error_message == '') {
			if ($status >= 1 &&  $status <= 3){
				$this->setVar('order_status', $status + 1);
			} else {
				redirect_header('index.php', 2, _NOPERM);
			}
			if ($orderHandler->insert($this)) {
				if ($count > 0){
					//split de commandes
					$new_orderid = 0;
					$nb_split = 0;
					for ($i = 1; $i <= $count; $i++) {
						$itemorder = Request::getInt('itemorder' . $i, 0);
						$item = $itemorderHandler->get($itemorder);
						if (isset($_POST['split' . $i])){
							$nb_split++;
							// création d'une nouvelle commande si pas existante (copie des données de la commande de base)
							if ($new_orderid == 0) {
								$new_order = $orderHandler->create();
								$description = sprintf(_MA_XMSTOCK_ACTION_SPLIT_TEXT, "<a href='" . XOOPS_URL . "/modules/xmstock/vieworder.php?op=view&order_id=" . $this->getVar('order_id') . "' target='_blank'>" . $this->getVar('order_id') . "</a>") . '<br>' . $this->getVar('order_description');
								$new_order->setVar('order_description', $description);
								$new_order->setVar('order_userid', $this->getVar('order_userid'));
								$new_order->setVar('order_areaid', $this->getVar('order_areaid'));
								$new_order->setVar('order_ddesired', $this->getVar('order_ddesired'));
								$new_order->setVar('order_dorder', $this->getVar('order_dorder'));
								$new_order->setVar('order_ddesired', $this->getVar('order_ddesired'));
								$new_order->setVar('order_delivery', $this->getVar('order_delivery'));
								$new_order->setVar('order_status', 1);
								$orderHandler->insert($new_order);
								$new_orderid = $new_order->get_new_enreg();
							}
							// changement de l'article dans la nouvelle commande uniquement si pas tous les articles sont splités
							if ($nb_split < $count){
								$item->setVar('itemorder_orderid', $new_orderid);
								if (!$itemorderHandler->insert($item)) {
									$error_message = $item->getHtmlErrors();
								}
							}
						} else {
							// Sortie de stock uniquement en statut de 2 à 3
							if ($status == 2) {
								$type = XmstockUtility::articleTypePerArea($item->getVar('itemorder_areaid'), $item->getVar('itemorder_articleid'), $stock_arr);
								if ($type == 2){
									$error_message .= XmstockUtility::transfert('O', $item->getVar('itemorder_articleid'), $item->getVar('itemorder_amount')*$item->getVar('itemorder_length'), $item->getVar('itemorder_areaid'));
								} else {
									$error_message .= XmstockUtility::transfert('O', $item->getVar('itemorder_articleid'), $item->getVar('itemorder_amount'), $item->getVar('itemorder_areaid'));
								}

								// Si emprunt ajout d'une entrée dans le table d'emprunt
								if ($type == 3) {
									$loan = $loanHandler->create();
									$loan->setVar('loan_areaid', $item->getVar('itemorder_areaid'));
									$loan->setVar('loan_articleid', $item->getVar('itemorder_articleid'));
									$loan->setVar('loan_date', time());
									$loan->setVar('loan_userid', $this->getVar('order_userid'));
									$loan->setVar('loan_status', 1);
									if (!$loanHandler->insert($loan)) {
										$error_message .= $loan->getHtmlErrors();
									}
								}
								$new_transfer = $transferHandler->create();
								$new_transfer->setVar('transfer_articleid', $item->getVar('itemorder_articleid'));
								if ($type == 2){
									$new_transfer->setVar('transfer_amount', $item->getVar('itemorder_amount')*$item->getVar('itemorder_length'));
								} else {
									$new_transfer->setVar('transfer_amount', $item->getVar('itemorder_amount'));
								}
								$new_transfer->setVar('transfer_type', 'O');
								$new_transfer->setVar('transfer_st_areaid', $item->getVar('itemorder_areaid'));
								$new_transfer->setVar('transfer_outputuserid', $this->getVar('order_userid'));
								$new_transfer->setVar('transfer_description',  sprintf(_MA_XMSTOCK_ACTION_TRANSFERT_DESC, formatTimestamp($this->getVar('order_dorder'), 'm'), $this->getVar('order_id')));
								$new_transfer->setVar('transfer_ref', sprintf(_MA_XMSTOCK_ACTION_TRANSFERT_REF, $this->getVar('order_id')));
								$new_transfer->setVar('transfer_status', 1);
								$new_transfer->setVar('transfer_userid', !empty($xoopsUser) ? $xoopsUser->getVar('uid') : 0);
								$new_transfer->setVar('transfer_date', time());
								if (!$transferHandler->insert($new_transfer)) {
									$error_message .=  $new_transfer->getHtmlErrors();
								}
							}
						}
					}

					if ($error_message == '') {
						redirect_header($action, 2, _MA_XMSTOCK_REDIRECT_SAVE);
					}
				} else {
					$error_message = _MA_XMSTOCK_ERROR_NOARTICLE;
				}
			} else {
				$this->setVar('order_status', $status);
				$error_message =  $this->getHtmlErrors();
			}
		}
        return $error_message;
    }

	/**
     * @param bool $action
     * @return XoopsThemeForm
     */
    public function getFormNext($action = false, $ddesired = '')
    {
        $helper = Helper::getHelper('xmstock');
        if ($action === false) {
            $action = $_SERVER['REQUEST_URI'];
        }
		include_once $GLOBALS['xoops']->path('class/xoopsformloader.php');
        include __DIR__ . '/../include/common.php';

		$status = $this->getVar('order_status');
        //form title
		switch ($status) {
			case 1:
				$title = sprintf(_MA_XMSTOCK_ACTION_NEXT1);
				break;
			case 2:
				$title = sprintf(_MA_XMSTOCK_ACTION_NEXT2);
				break;
			case 3:
				$title = sprintf(_MA_XMSTOCK_ACTION_NEXT3);
				break;
		}
        $form = new XoopsThemeForm($title, 'form', $action, 'post', true);
		$form->addElement(new XoopsFormHidden('order_id', $this->getVar('order_id')));

		if ($status == 1){
			//Date de livraison
			$form->addElement(new XoopsFormTextDateSelect(_MA_XMSTOCK_ORDER_DATEDELIVERY, 'order_ddelivery', 2, $ddesired), false);
			//Livraison
			$delivery = new XoopsFormRadio(_MA_XMSTOCK_CHECKOUT_DELIVERY, 'order_delivery', $this->getVar('order_delivery'));
			$options        = [0 => _MA_XMSTOCK_CHECKOUT_DELIVERY_WITHDRAWAL, 1 => _MA_XMSTOCK_CHECKOUT_DELIVERY_DELIVERY];
			$delivery->addOptionArray($options);
			$form->addElement($delivery);
		}

		// articles
		$criteria = new CriteriaCompo();
		$criteria->add(new Criteria('stock_areaid', $this->getVar('order_areaid')));
		$stock_arr = $stockHandler->getall($criteria);
		$criteria = new CriteriaCompo();
		$criteria->add(new Criteria('itemorder_orderid', $this->getVar('order_id')));
		$itemorderHandler->table_link = $itemorderHandler->db->prefix("xmarticle_article");
		$itemorderHandler->field_link = "article_id";
		$itemorderHandler->field_object = "itemorder_articleid";
		$itemorder_arr = $itemorderHandler->getByLink($criteria);
		$item_array_count = count($itemorder_arr);
		$count = 0;
		$articles = "<table class='table table-bordered'><thead class='table-primary'><tr>";
		$articles .= "<th scope='col'>" . _MA_XMSTOCK_ACTION_ARTICLES . "</th>";
		if ($status == 1 || $status == 2){
			$articles .= "<th scope='col'>" . _MA_XMSTOCK_VIEWORDER_AMOUNT . "</th>";
			$articles .= "<th scope='col'>" . _MA_XMSTOCK_STOCK_AMOUNT . "</th>";
			$articles .= "<th scope='col'>" . _MA_XMSTOCK_STOCK_LOAN . "</th>";
		}
		if ($status == 2){
			$articles .= "<th scope='col'>" . _MA_XMSTOCK_STOCK_LOCATION . "</th>";
		}
		if ($item_array_count > 1){
			$articles .= "<th scope='col'>" . _MA_XMSTOCK_ACTION_SPLIT . "</th>";
		}
		$articles .= "</tr></thead><tbody>";
		foreach (array_keys($itemorder_arr) as $i) {
			$count++;
			$articles .= "<tr><th scope='row'><a href='" . XOOPS_URL . "/modules/xmarticle/viewarticle.php?category_id=" . $itemorder_arr[$i]->getVar('article_cid') . "&article_id=" . $itemorder_arr[$i]->getVar('itemorder_articleid') . "' title='" . $itemorder_arr[$i]->getVar('article_name') . "' target='_blank'>" . $itemorder_arr[$i]->getVar('article_name') . "</a></th>";
			if ($status == 1 || $status == 2){
				$area_name = XmstockUtility::getAreaName($this->getVar('order_areaid'), true, false);
				$amoutArea = XmstockUtility::articleAmountPerArea($this->getVar('order_areaid'), $itemorder_arr[$i]->getVar('itemorder_articleid'), $stock_arr);
				$type = XmstockUtility::articleTypePerArea($this->getVar('order_areaid'), $itemorder_arr[$i]->getVar('itemorder_articleid'), $stock_arr);
				if ($type == 2){
					$unit = ' ' . _MA_XMSTOCK_CHECKOUT_UNIT;
					$amount = $itemorder_arr[$i]->getVar('itemorder_amount') . 'x' . number_format($itemorder_arr[$i]->getVar('itemorder_length'), 2) . $unit;
					if (($itemorder_arr[$i]->getVar('itemorder_amount') * $itemorder_arr[$i]->getVar('itemorder_length')) > $amoutArea) {
						if ($status == 1){
							$articles .= "<td class='text-center'><span class='badge badge-warning badge-pill'>" . $amount . "</span></td>";
						} else {
							$articles .= "<td class='text-center'><span class='badge badge-danger badge-pill'>" . $amount . "</span></td>";
						}
					} else {
						$articles .= "<td class='text-center'><span class='badge badge-success badge-pill'>" . $amount . "</span></td>";
					}
				} else {
					$unit = '';
					$amount = $itemorder_arr[$i]->getVar('itemorder_amount');
					if ($amoutArea > $itemorder_arr[$i]->getVar('itemorder_amount')) {
						$articles .= "<td class='text-center'><span class='badge badge-success badge-pill'>" . $amount . "</span></td>";
					} else {
						if ($status == 1){
							$articles .= "<td class='text-center'><span class='badge badge-warning badge-pill'>" . $amount . "</span></td>";
						} else {
							$articles .= "<td class='text-center'><span class='badge badge-danger badge-pill'>" . $amount . "</span></td>";
						}
					}
				}
				$articles .= "<td class='text-center'><span class='badge badge-primary badge-pill'>" . $amoutArea . $unit . "</span> " . $area_name . "</td>";
				$type = XmstockUtility::articleTypePerArea($itemorder_arr[$i]->getVar('itemorder_areaid'), $itemorder_arr[$i]->getVar('itemorder_articleid'), $stock_arr);
				if ($type == 3) {
					$articles .= "<td class='text-center'><span class='badge badge-primary badge-pill'>" . _YES . "</span></td>";
				} else {
					$articles .= "<td class='text-center'><span class='badge badge-primary badge-pill'>" . _NO . "</span></td>";
				}
			}
			if ($status == 2){
				$location =  XmstockUtility::getLocation($this->getVar('order_areaid'), $itemorder_arr[$i]->getVar('itemorder_articleid'), $stock_arr);
				$articles .= "<td class='text-center'>" . $location . "</td>";
			}
			if ($item_array_count > 1){
				$articles .= "<td class='text-center'><input type='checkbox' class='form-check-input' name='split" . $count . "' id='split" . $count . "'></td></tr>";
			}
			$form->addElement(new XoopsFormHidden('itemorder' . $count, $i));
		}
		$articles .= "</tbody></table>";
		if ($item_array_count > 1){
			$articles .= "<small class='form-text text-muted'>" . _MA_XMSTOCK_ACTION_SPLIT_DESC . "</small>";
		}
		$form->addElement(new XoopsFormLabel(_MA_XMSTOCK_ORDER_ARTICLES, $articles), true);
		$form->addElement(new XoopsFormHidden('count', $count));

		$form->addElement(new XoopsFormHidden('op', 'saveNext'));
		$form->addElement(new XoopsFormHidden('order_areaid', $this->getVar('order_areaid')));
		$form->addElement(new XoopsFormHidden('status', $this->getVar('order_status')));
        // submit
        $form->addElement(new XoopsFormButton('', 'submit', _SUBMIT, 'submit'));

        return $form;
    }

	/**
     * @return mixed
     */
    public function delOrder($orderHandler, $order_id, $action = false)
    {
		if ($action === false) {
            $action = $_SERVER['REQUEST_URI'];
        }
		$error_message = '';
		include __DIR__ . '/../include/common.php';
		if ($orderHandler->delete($this)) {
			$criteria = new CriteriaCompo();
			$criteria->add(new Criteria('itemorder_orderid', $order_id));
			$itemorder_count = $itemorderHandler->getCount($criteria);
			if ($itemorder_count > 0) {
				$itemorderHandler->deleteAll($criteria);
			}
			redirect_header($action, 2, _MA_XMSTOCK_REDIRECT_SAVE);
		} else {
			$error_message .= $obj->getHtmlErrors();
		}
		return $error_message;
	}
}

/**
 * Classxmstockxmstock_orderHandler
 */
class xmstockxmstock_orderHandler extends XoopsPersistableObjectHandler
{
    /**
     * xmstockxmstock_orderHandler constructor.
     * @param null|XoopsDatabase $db
     */
    public function __construct($db)
    {
        parent::__construct($db, 'xmstock_order', 'xmstock_order', 'order_id', 'order_description');
    }
}
