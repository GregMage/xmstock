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
		$this->initVar('order_ddesired', XOBJ_DTYPE_INT, null, false, 10);
		$this->initVar('order_dorder', XOBJ_DTYPE_INT, null, false, 10);
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
            if ($orderHandler->insert($this)) {
				if ($this->get_new_enreg() == 0){
					$order_id = $this->getVar('order_id');
				} else {
					$order_id = $this->get_new_enreg();
				}
				$sessionHelper = new \Xmf\Module\Helper\Session();
				$arr_selectionArticles = $sessionHelper->get($session_name);
				if (is_array($arr_selectionArticles) == true){
					foreach ($arr_selectionArticles as $datas) {
						$obj = $itemorderHandler->create();
						$obj->setVar('itemorder_orderid', $order_id);
						$obj->setVar('itemorder_articleid', $datas['id']);
						$obj->setVar('itemorder_areaid', $datas['area']);
						$obj->setVar('itemorder_amount', $datas['qty']);
						$obj->setVar('itemorder_status', 1);
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
     * @param bool $action
     * @return XoopsThemeForm
     */
    public function getForm($action = false)
    {
        $helper = Helper::getHelper('xmstock');
        if ($action === false) {
            $action = $_SERVER['REQUEST_URI'];
        }
        include __DIR__ . '/../include/common.php';

        //form title
        $title = $this->isNew() ? sprintf(_MA_XMSTOCK_ADD) : sprintf(_MA_XMSTOCK_EDIT);

        $form = new XoopsThemeForm($title, 'form', $action, 'post', true);

        if (!$this->isNew()) {
            $form->addElement(new XoopsFormHidden('order_id', $this->getVar('order_id')));
            $status = $this->getVar('order_status');
        } else {
            $status = 1;
        }

        // description
        $editor_configs           =array();
        $editor_configs['name']   = 'order_description';
        $editor_configs['value']  = $this->getVar('order_description', 'e');
        $editor_configs['rows']   = 20;
        $editor_configs['cols']   = 160;
        $editor_configs['width']  = '100%';
        $editor_configs['height'] = '400px';
        $editor_configs['editor'] = $helper->getConfig('general_editor', 'Plain Text');
        $form->addElement(new XoopsFormEditor(_MA_XMSTOCK_AREA_DESC, 'order_description', $editor_configs), false);

		// A faire (pour la gestion des commandes admin et user)
		// status
        $form_status = new XoopsFormRadio(_MA_XMSTOCK_STATUS, 'order_status', $status);
        $options = array(1 => _MA_XMSTOCK_STATUS_A, 0 =>_MA_XMSTOCK_STATUS_NA);
        $form_status->addOptionArray($options);
        $form->addElement($form_status);

        $form->addElement(new XoopsFormHidden('op', 'save'));
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
