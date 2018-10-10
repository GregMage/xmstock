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

if (!defined('XOOPS_ROOT_PATH')) {
    die('XOOPS root path not defined');
}

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
		$this->initVar('stock_amound', XOBJ_DTYPE_INT, null, false, 11);
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
    public function getForm($action = false)
    {
        $helper = \Xmf\Module\Helper::getHelper('xmstock');
        if ($action === false) {
            $action = $_SERVER['REQUEST_URI'];
        }
        include_once XOOPS_ROOT_PATH . '/class/xoopsformloader.php';
        include __DIR__ . '/../include/common.php';
		include __DIR__ . '/formselectarea.php';

        //form title
        $title = $this->isNew() ? sprintf(_MA_XMSTOCK_ADD) : sprintf(_MA_XMSTOCK_EDIT);

        $form = new XoopsThemeForm($title, 'form', $action, 'post', true);

        if (!$this->isNew()) {
            $form->addElement(new XoopsFormHidden('stock_id', $this->getVar('stock_id')));
        }

		// area
        $form->addElement(new XmstockFormSelectArea(_MA_XMSTOCK_OUTPUT_USERID, 'stock_areaid', $this->getVar('stock_areaid')), true);
		
        // amound
        $form->addElement(new XoopsFormText(_MA_XMSTOCK_STOCK_AMOUND, 'stock_amound', 10, 10, $this->getVar('stock_amound')), true);

        $form->addElement(new XoopsFormHidden('op', 'save'));
        // submit
        $form->addElement(new XoopsFormButton('', 'submit', _SUBMIT, 'submit'));

        return $form;
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
