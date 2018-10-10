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
 * Class xmstock_transfer
 */
class xmstock_transfer extends XoopsObject
{
    // constructor
    /**
     * xmstock_transfer constructor.
     */
    public function __construct()
    {
        $this->initVar('transfer_id', XOBJ_DTYPE_INT, null, false, 11);
        $this->initVar('transfer_description', XOBJ_DTYPE_TXTAREA, null, false);
        // use html
        $this->initVar('dohtml', XOBJ_DTYPE_INT, 1, false);
        $this->initVar('transfer_articleid', XOBJ_DTYPE_INT, null, false, 11);
		$this->initVar('transfer_st_areaid', XOBJ_DTYPE_INT, null, false, 11);
		$this->initVar('transfer_ar_areaid', XOBJ_DTYPE_INT, null, false, 11);
		$this->initVar('transfer_outputid', XOBJ_DTYPE_INT, null, false, 11);
		$this->initVar('transfer_amound', XOBJ_DTYPE_INT, null, false, 11);
		$this->initVar('transfer_date', XOBJ_DTYPE_INT, null, false, 10);
		$this->initVar('transfer_userid', XOBJ_DTYPE_INT, null, false, 8);
		$this->initVar('transfer_type', XOBJ_DTYPE_INT, null, false, 2);
        $this->initVar('transfer_ref', XOBJ_DTYPE_TXTBOX, null, false);
		$this->initVar('transfer_status', XOBJ_DTYPE_INT, null, false, 1);
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
    public function getForm($type = 'E', $action = false)
    {
        $helper = \Xmf\Module\Helper::getHelper('xmstock');
        if ($action === false) {
            $action = $_SERVER['REQUEST_URI'];
        }
        include_once XOOPS_ROOT_PATH . '/class/xoopsformloader.php';
        include __DIR__ . '/../include/common.php';
		include __DIR__ . '/formselectstock.php';

        //form title
        $title = $this->isNew() ? sprintf(_MA_XMSTOCK_ADD) : sprintf(_MA_XMSTOCK_EDIT);

        $form = new XoopsThemeForm($title, 'form', $action, 'post', true);

        if (!$this->isNew()) {
            $form->addElement(new XoopsFormHidden('transfer_id', $this->getVar('transfer_id')));
            $status = $this->getVar('transfer_status');
        } else {
            $status = 1;
        }
		
		// articleid
        $form->addElement(new XmstockFormSelectArticle(_MA_XMSTOCK_TRANSFER_ARTICLE, 'transfer_articleid', $this->getVar('transfer_articleid'), true), true);
		
		// description
        $editor_configs           = array();
        $editor_configs['name']   = 'transfer_description';
        $editor_configs['value']  = $this->getVar('transfer_description', 'e');
        $editor_configs['rows']   = 4;
        $editor_configs['cols']   = 100;
        $editor_configs['width']  = '80%';
        $editor_configs['height'] = '400px';
        $editor_configs['editor'] = $helper->getConfig('general_editor', 'Plain Text');
        $form->addElement(new XoopsFormEditor(_MA_XMSTOCK_TRANSFER_DESC, 'transfer_description', $editor_configs), false);

		// st_areaid
        $form->addElement(new XmstockFormSelectArea(_MA_XMSTOCK_TRANSFER_STAREA, 'transfer_st_areaid', $this->getVar('transfer_st_areaid'), true), true);
		
		// ar_areaid
        $form->addElement(new XmstockFormSelectArea(_MA_XMSTOCK_TRANSFER_ARAREA, 'transfer_ar_areaid', $this->getVar('transfer_ar_areaid'), true), true);
		
		// outputid
        $form->addElement(new XmstockFormSelectOutput(_MA_XMSTOCK_TRANSFER_OUTPUT, 'transfer_outputid', $this->getVar('transfer_outputid'), true), true);
		
        // amound
        $form->addElement(new XoopsFormText(_MA_XMSTOCK_TRANSFER_AMOUND, 'transfer_amound', 10, 10, $this->getVar('transfer_amound')), true);
		
		// amound
        $form->addElement(new XoopsFormText(_MA_XMSTOCK_TRANSFER_AMOUND, 'transfer_ref', 20, 20, $this->getVar('transfer_ref')), true);
		
		// status
        $form_status = new XoopsFormRadio(_MA_XMSTOCK_STATUS, 'transfer_status', $status);
        $options = array(1 => _MA_XMSTOCK_STATUS_EXECUTED, 0 =>_MA_XMSTOCK_STATUS_WAITING,);
        $form_status->addOptionArray($options);
        $form->addElement($form_status);
		
        $form->addElement(new XoopsFormHidden('op', 'save'));
        // submit
        $form->addElement(new XoopsFormButton('', 'submit', _SUBMIT, 'submit'));

        return $form;
    }

}

/**
 * Classxmstockxmstock_transferHandler
 */
class xmstockxmstock_transferHandler extends XoopsPersistableObjectHandler
{
    /**
     * xmstockxmstock_transferHandler constructor.
     * @param null|XoopsDatabase $db
     */
    public function __construct($db)
    {
        parent::__construct($db, 'xmstock_transfer', 'xmstock_transfer', 'transfer_id', 'transfer_name');
    }
}
