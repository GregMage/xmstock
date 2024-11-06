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

defined('XOOPS_ROOT_PATH') || exit('Restricted access.');

/**
 * Class xmstock_stock
 */
class xmstock_stock extends XoopsObject
{
    // constructor
    /**
     * xmstock_stock constructor.
     */
    public function __construct()
    {
        $this->initVar('stock_id', XOBJ_DTYPE_INT, null, false, 11);
        $this->initVar('stock_areaid', XOBJ_DTYPE_INT, null, false, 11);
		$this->initVar('stock_articleid', XOBJ_DTYPE_INT, null, false, 11);
		$this->initVar('stock_amount', XOBJ_DTYPE_INT, null, false, 11);
		$this->initVar('stock_price', XOBJ_DTYPE_OTHER, null, false, 10);
		$this->initVar('stock_location', XOBJ_DTYPE_TXTBOX, null, false);
		$this->initVar('stock_type', XOBJ_DTYPE_INT, null, false, 1);
        $this->initVar('stock_mini', XOBJ_DTYPE_INT, null, false, 11);
        $this->initVar('stock_order', XOBJ_DTYPE_INT, null, false, 1);
		$this->initVar('area_id', XOBJ_DTYPE_INT, null, false, 11);
		$this->initVar('area_name', XOBJ_DTYPE_TXTBOX, null, false);
		$this->initVar('area_logo', XOBJ_DTYPE_TXTBOX, null, false);
        $this->initVar('area_location', XOBJ_DTYPE_TXTBOX, null, false);
		$this->initVar('area_weight', XOBJ_DTYPE_INT, null, false, 11);
		$this->initVar('article_id', XOBJ_DTYPE_INT, null);
		$this->initVar('article_cid', XOBJ_DTYPE_INT, null);
		$this->initVar('article_name', XOBJ_DTYPE_TXTBOX, null);
		$this->initVar('article_reference', XOBJ_DTYPE_TXTBOX, null);
		$this->initVar('article_status', XOBJ_DTYPE_INT, 1);
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
     * @param bool $action
     * @return XoopsThemeForm
     */
    public function getForm($return = 'stock', $action = false)
    {
        $helper = \Xmf\Module\Helper::getHelper('xmstock');
        if ($action === false) {
            $action = $_SERVER['REQUEST_URI'];
        }
        include_once XOOPS_ROOT_PATH . '/class/xoopsformloader.php';
        include __DIR__ . '/../include/common.php';

        //form title
        $title = $this->isNew() ? sprintf(_MA_XMSTOCK_ADD) : sprintf(_MA_XMSTOCK_EDIT);

        $form = new XoopsThemeForm($title, 'form', $action, 'post', true);

        if (!$this->isNew()) {
            $form->addElement(new XoopsFormHidden('stock_id', $this->getVar('stock_id')));
        }

        $mini = new XoopsFormText(_MA_XMSTOCK_STOCK_MINI, 'stock_mini', 50, 50, $this->getVar('stock_mini'));
		$mini->setDescription(_MA_XMSTOCK_STOCK_MINI_DSC);
        $form->addElement($mini, true);

		$location = new XoopsFormText(_MA_XMSTOCK_TRANSFER_LOCATION, 'stock_location', 50, 255, $this->getVar('stock_location'));
		$location->setDescription(_MA_XMSTOCK_TRANSFER_LOCATION_DSC);
		$form->addElement($location, true);

		// order
		$form_order = new XoopsFormCheckBox(_MA_XMSTOCK_STOCK_ORDER, 'stock_order', $this->getVar('stock_order'));
		$options = array(1 => ' ');
		$form_order->addOptionArray($options);
		$form_order->setDescription(_MA_XMSTOCK_STOCK_ORDER_DESC);
		$form->addElement($form_order);

		// type
		$form_type = new XoopsFormRadio(_MA_XMSTOCK_STOCK_TYPE, 'stock_type', $this->getVar('stock_type'));
		$options = array(1 => _MA_XMSTOCK_STOCK_STANDARD, 2 =>_MA_XMSTOCK_STOCK_ML, 3 =>_MA_XMSTOCK_STOCK_LOAN, 4 =>_MA_XMSTOCK_STOCK_FREE, 5 =>_MA_XMSTOCK_STOCK_SURFACE);
		$form_type->addOptionArray($options);
		$form_type->setDescription(_MA_XMSTOCK_STOCK_TYPE_DESC);
		$form->addElement($form_type);

        // Suppression total du stock
        $form_del = new XoopsFormRadioYN(_MA_XMSTOCK_STOCK_DEL, 'stock_del', $this->getVar('stock_del'));
        $form_del->setDescription(_MA_XMSTOCK_STOCK_DEL_DESC);
        $form->addElement($form_del);

		$form->addElement(new XoopsFormHidden('stock_areaid', $this->getVar('stock_areaid')));
        $form->addElement(new XoopsFormHidden('return', $return));
        $form->addElement(new XoopsFormHidden('op', 'savestock'));
        // submit
        $form->addElement(new XoopsFormButton('', 'submit', _SUBMIT, 'submit'));
        return $form;
    }

    /**
     * @return mixed
     */
    public function saveStock($stockHandler, $action = false)
    {
        if ($action === false) {
            $action = $_SERVER['REQUEST_URI'];
        }
        include __DIR__ . '/../include/common.php';

        $error_message = '';
        // test error

		$location = Request::getString('stock_location', '');
		$del = Request::getString('stock_del', '');
		$this->setVar('stock_mini', Request::getInt('stock_mini', 0));
		$this->setVar('stock_order', Request::getInt('stock_order', 0));
		$this->setVar('stock_del', Request::getInt('stock_del', 0));
		$this->setVar('stock_type', Request::getInt('stock_type', 1));
        // si le stock est en libre service le total du stock passe à 0.
        if (Request::getInt('stock_type', 1) == 4) {
            $this->setVar('stock_amount', 0);
        }
		if ($location == '') {
			$error_message .= _MA_XMSTOCK_ERROR_LOCATION . '<br>';
			$this->setVar('stock_location', '');
		} else {
			$this->setVar('stock_location', $location);
		}

        if ($error_message == '') {
            if ($del == 1) {
                //on vide la table de prix
                $criteria = new CriteriaCompo();
                $criteria->add(new Criteria('price_areaid', $this->getVar('stock_areaid')));
                $criteria->add(new Criteria('price_articleid', $this->getVar('stock_articleid')));
                $price_count = $priceHandler->getCount($criteria);
                if ($price_count > 0) {
                    $priceHandler->deleteAll($criteria);
                }
                // on enlève la ligne dans le stock
                if ($stockHandler->delete($this)) {
                    redirect_header($action, 2, _MA_XMSTOCK_REDIRECT_SAVE);
                }  else {
                    $error_message =  $this->getHtmlErrors();
                }
            } else {
                if ($stockHandler->insert($this)) {
                    redirect_header($action, 2, _MA_XMSTOCK_REDIRECT_SAVE);
                } else {
                    $error_message =  $this->getHtmlErrors();
                }
            }
        }
        return $error_message;
    }
}

/**
 * Classxmstockxmstock_stockHandler
 */
class xmstockxmstock_stockHandler extends XoopsPersistableObjectHandler
{
    /**
     * xmstockxmstock_stockHandler constructor.
     * @param null|XoopsDatabase $db
     */
    public function __construct($db)
    {
        parent::__construct($db, 'xmstock_stock', 'xmstock_stock', 'stock_id', 'stock_amound');
    }
}
