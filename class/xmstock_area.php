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
 * Class xmstock_area
 */
class xmstock_area extends XoopsObject
{
    // constructor
    /**
     * xmstock_area constructor.
     */
    public function __construct()
    {
        $this->initVar('area_id', XOBJ_DTYPE_INT, null, false, 11);
        $this->initVar('area_name', XOBJ_DTYPE_TXTBOX, null, false);
        $this->initVar('area_description', XOBJ_DTYPE_TXTAREA, null, false);
        // use html
        $this->initVar('dohtml', XOBJ_DTYPE_INT, 1, false);
        $this->initVar('area_logo', XOBJ_DTYPE_TXTBOX, null, false);
        $this->initVar('area_location', XOBJ_DTYPE_TXTBOX, null, false);
        $this->initVar('area_weight', XOBJ_DTYPE_INT, null, false, 11);
        $this->initVar('area_status', XOBJ_DTYPE_INT, null, false, 1);
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
    public function saveArea($areaHandler, $action = false)
    {
        if ($action === false) {
            $action = $_SERVER['REQUEST_URI'];
        }
        include __DIR__ . '/../include/common.php';
        
        $error_message = '';
        // test error
        if ((int)$_REQUEST['area_weight'] == 0 && $_REQUEST['area_weight'] != '0') {
            $error_message .= _MA_XMSTOCK_ERROR_WEIGHT . '<br>';
            $this->setVar('area_weight', 0);
        }
        //logo
        if ($_FILES['area_logo']['error'] != UPLOAD_ERR_NO_FILE) {
            include_once XOOPS_ROOT_PATH . '/class/uploader.php';
            $uploader_area_img = new XoopsMediaUploader($path_logo_area, array('image/gif', 'image/jpeg', 'image/pjpeg', 'image/x-png', 'image/png'), $upload_size, null, null);
            if ($uploader_area_img->fetchMedia('area_logo')) {
                $uploader_area_img->setPrefix('area_');
                if (!$uploader_area_img->upload()) {
                    $error_message .= $uploader_area_img->getErrors() . '<br />';
                } else {
                    $this->setVar('area_logo', $uploader_area_img->getSavedFileName());
                }
            } else {
                $error_message .= $uploader_area_img->getErrors();
            }
        } else {
            $this->setVar('area_logo', Xmf\Request::getString('area_logo', ''));
        }
        $this->setVar('area_name', Xmf\Request::getString('area_name', ''));
        $this->setVar('area_description',  Xmf\Request::getText('area_description', ''));
        $this->setVar('area_location', Xmf\Request::getString('area_location', ''));
        $this->setVar('area_status', Xmf\Request::getInt('area_status', 1));
        if ($error_message == '') {
            $this->setVar('area_weight', Xmf\Request::getInt('area_weight', 0));
            if ($areaHandler->insert($this)) {
                // permissions
                if ($this->get_new_enreg() == 0){
					$perm_id = $this->getVar('area_id');
				} else {
					$perm_id = $this->get_new_enreg();
				}
                $permHelper = new \Xmf\Module\Helper\Permission();
				// permission a faire!!

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
        $form->setExtra('enctype="multipart/form-data"');

        if (!$this->isNew()) {
            $form->addElement(new XoopsFormHidden('area_id', $this->getVar('area_id')));
            $status = $this->getVar('area_status');
            $weight = $this->getVar('area_weight');
        } else {
            $status = 1;
            $weight = 0;
        }

        // name
        $form->addElement(new XoopsFormText(_MA_XMSTOCK_AREA_NAME, 'area_name', 50, 255, $this->getVar('area_name')), true);

        // description
        $editor_configs           =array();
        $editor_configs['name']   = 'area_description';
        $editor_configs['value']  = $this->getVar('area_description', 'e');
        $editor_configs['rows']   = 20;
        $editor_configs['cols']   = 160;
        $editor_configs['width']  = '100%';
        $editor_configs['height'] = '400px';
        $editor_configs['editor'] = $helper->getConfig('general_editor', 'Plain Text');
        $form->addElement(new XoopsFormEditor(_MA_XMSTOCK_AREA_DESC, 'area_description', $editor_configs), false);
        // logo
        $blank_img = $this->getVar('area_logo') ?: 'blank.gif';
        $uploadirectory = str_replace(XOOPS_URL, '', $url_logo_area);
        $imgtray_img     = new XoopsFormElementTray(_MA_XMSTOCK_AREA_LOGOFILE  . '<br /><br />' . sprintf(_MA_XMSTOCK_AREA_UPLOADSIZE, $upload_size/1024), '<br />');
        $imgpath_img     = sprintf(_MA_XMSTOCK_AREA_FORMPATH, $uploadirectory);
        $imageselect_img = new XoopsFormSelect($imgpath_img, 'area_logo', $blank_img);
        $image_array_img = XoopsLists::getImgListAsArray($path_logo_area);
        $imageselect_img->addOption("$blank_img", $blank_img);
        foreach ($image_array_img as $image_img) {
            $imageselect_img->addOption("$image_img", $image_img);
        }
        $imageselect_img->setExtra("onchange='showImgSelected(\"image_img2\", \"area_logo\", \"" . $uploadirectory . "\", \"\", \"" . XOOPS_URL . "\")'");
        $imgtray_img->addElement($imageselect_img, false);
        $imgtray_img->addElement(new XoopsFormLabel('', "<br /><img src='" . $url_logo_area . '/' . $blank_img . "' name='image_img2' id='image_img2' alt='' />"));
        $fileseltray_img = new XoopsFormElementTray('<br />', '<br /><br />');
        $fileseltray_img->addElement(new XoopsFormFile(_MA_XMSTOCK_AREA_UPLOAD, 'area_logo', $upload_size), false);
        $fileseltray_img->addElement(new XoopsFormLabel(''), false);
        $imgtray_img->addElement($fileseltray_img);
        $form->addElement($imgtray_img);
		
		// location
        $form->addElement(new XoopsFormText(_MA_XMSTOCK_AREA_LOCATION, 'area_location', 50, 255, $this->getVar('area_location')));

        // weight
        $form->addElement(new XoopsFormText(_MA_XMSTOCK_AREA_WEIGHT, 'area_weight', 5, 5, $weight));

		// status
        $form_status = new XoopsFormRadio(_MA_XMSTOCK_STATUS, 'area_status', $status);
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
 * Classxmstockxmstock_areaHandler
 */
class xmstockxmstock_areaHandler extends XoopsPersistableObjectHandler
{
    /**
     * xmstockxmstock_areaHandler constructor.
     * @param null|XoopsDatabase $db
     */
    public function __construct($db)
    {
        parent::__construct($db, 'xmstock_area', 'xmstock_area', 'area_id', 'area_name');
    }
}
