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
 * Class xmstock_output
 */
class xmstock_output extends XoopsObject
{
    // constructor
    /**
     * xmstock_output constructor.
     */
    public function __construct()
    {
        $this->initVar('output_id', XOBJ_DTYPE_INT, null, false, 11);
		$this->initVar('output_name', XOBJ_DTYPE_TXTBOX, null, false);
		$this->initVar('output_description', XOBJ_DTYPE_TXTAREA, null, false);
        // use html
        $this->initVar('dohtml', XOBJ_DTYPE_INT, 1, false);
		$this->initVar('output_userid', XOBJ_DTYPE_INT, null, false, 8);
		$this->initVar('output_weight', XOBJ_DTYPE_INT, null, false, 11);
        $this->initVar('output_status', XOBJ_DTYPE_INT, null, false, 1);
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
    public function saveOutput($areaHandler, $action = false)
    {
        if ($action === false) {
            $action = $_SERVER['REQUEST_URI'];
        }
        include __DIR__ . '/../include/common.php';
        
        $error_message = '';
        // test error
        if ((int)$_REQUEST['output_weight'] == 0 && $_REQUEST['output_weight'] != '0') {
            $error_message .= _MA_XMSTOCK_ERROR_WEIGHT . '<br>';
            $this->setVar('output_weight', 0);
        }
        $this->setVar('output_name', Xmf\Request::getString('output_name', ''));
        $this->setVar('output_description',  Xmf\Request::getText('output_description', ''));
        $this->setVar('output_userid', Xmf\Request::getInt('output_userid', 0));
        $this->setVar('output_status', Xmf\Request::getInt('output_status', 1));
        if ($error_message == '') {
            $this->setVar('output_weight', Xmf\Request::getInt('output_weight', 0));
            if ($outputHandler->insert($this)) {
                redirect_header($action, 2, _MA_XMSTOCK_REDIRECT_SAVE);
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
        $upload_size = 512000;
        $helper = \Xmf\Module\Helper::getHelper('xmstock');
        if ($action === false) {
            $action = $_SERVER['REQUEST_URI'];
        }
        include_once XOOPS_ROOT_PATH . '/class/xoopsformloader.php';
        include __DIR__ . '/../include/common.php';

        //form title
        $title = $this->isNew() ? sprintf(_MA_XMSTOCK_ADD) : sprintf(_MA_XMSTOCK_EDIT);

        $form = new XoopsThemeForm($title, 'form', $action, 'post', true);
        //$form->setExtra('enctype="multipart/form-data"');

        if (!$this->isNew()) {
            $form->addElement(new XoopsFormHidden('output_id', $this->getVar('output_id')));
            $status = $this->getVar('output_status');
            $weight = $this->getVar('output_weight');
        } else {
            $status = 1;
            $weight = 0;
        }

        // name
        $form->addElement(new XoopsFormText(_MA_XMSTOCK_OUTPUT_NAME, 'output_name', 50, 255, $this->getVar('output_name')), true);

        // description
        $editor_configs           =array();
        $editor_configs['name']   = 'output_description';
        $editor_configs['value']  = $this->getVar('output_description', 'e');
        $editor_configs['rows']   = 20;
        $editor_configs['cols']   = 160;
        $editor_configs['width']  = '100%';
        $editor_configs['height'] = '400px';
        $editor_configs['editor'] = $helper->getConfig('general_editor', 'Plain Text');
        $form->addElement(new XoopsFormEditor(_MA_XMSTOCK_OUTPUT_DESC, 'output_description', $editor_configs), false);
		
		// user
        $form->addElement(new XoopsFormSelectUser(_MA_XMSTOCK_OUTPUT_USERID, 'output_userid', true, $this->getVar('output_userid')), true);

        // weight
        $form->addElement(new XoopsFormText(_MA_XMSTOCK_OUTPUT_WEIGHT, 'output_weight', 5, 5, $weight));

		// status
        $form_status = new XoopsFormRadio(_MA_XMSTOCK_STATUS, 'output_status', $status);
        $options = array(1 => _MA_XMSTOCK_STATUS_A, 0 =>_MA_XMSTOCK_STATUS_NA,);
        $form_status->addOptionArray($options);
        $form->addElement($form_status);

        $form->addElement(new XoopsFormHidden('op', 'save'));
        // submit
        $form->addElement(new XoopsFormButton('', 'submit', _SUBMIT, 'submit'));

        return $form;
    }

}

/**
 * Classxmstockxmstock_outputHandler
 */
class xmstockxmstock_outputHandler extends XoopsPersistableObjectHandler
{
    /**
     * xmstockxmstock_outputHandler constructor.
     * @param null|XoopsDatabase $db
     */
    public function __construct($db)
    {
        parent::__construct($db, 'xmstock_output', 'xmstock_output', 'output_id', 'output_name');
    }
}
