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
		$this->initVar('area_color', XOBJ_DTYPE_TXTBOX, '#ffffff', false);
        $this->initVar('area_location', XOBJ_DTYPE_TXTBOX, null, false);
        $this->initVar('area_weight', XOBJ_DTYPE_INT, null, false, 11);
        $this->initVar('area_production', XOBJ_DTYPE_INT, 0, false, 1);
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
            $uploader_area_img = new XoopsMediaUploader($path_logo_area, ['image/gif', 'image/jpeg', 'image/pjpeg', 'image/x-png', 'image/png'], $upload_size, null, null);
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
			$area_logo = Request::getString('area_logo', '');
			if ($area_logo == 'no-image.png'){
				$area_logo = '';
			}
            $this->setVar('area_logo', $area_logo);
        }
        $this->setVar('area_name', Request::getString('area_name', ''));
        $this->setVar('area_description',  Request::getText('area_description', ''));
        $this->setVar('area_color', Request::getString('area_color', ''));
		$this->setVar('area_location',Request::getString('area_location', ''));
        $this->setVar('area_production', Request::getInt('area_production', 1));
        $this->setVar('area_status', Request::getInt('area_status', 1));
        if ($error_message == '') {
            $this->setVar('area_weight', Request::getInt('area_weight', 0));
            if ($areaHandler->insert($this)) {
                // permissions
                if ($this->get_new_enreg() == 0){
					$perm_id = $this->getVar('area_id');
				} else {
					$perm_id = $this->get_new_enreg();
				}
                $permHelper = new \Xmf\Module\Helper\Permission();
                // permission manage
                $groups_manage = \Xmf\Request::getArray('xmstock_manage_perms', array(), 'POST');
                $permHelper->savePermissionForItem('xmstock_manage', $perm_id, $groups_manage);
				// permission view
                $groups_view = \Xmf\Request::getArray('xmstock_view_perms', array(), 'POST');
                $permHelper->savePermissionForItem('xmstock_view', $perm_id, $groups_view);
				// permission order
                $groups_request = \Xmf\Request::getArray('xmstock_order_perms', array(), 'POST');
                $permHelper->savePermissionForItem('xmstock_order', $perm_id, $groups_request);
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
        $editor_configs['rows']   = 5;
        $editor_configs['cols']   = 160;
        $editor_configs['width']  = '100%';
        $editor_configs['height'] = '200px';
        $editor_configs['editor'] = $helper->getConfig('general_editor', 'Plain Text');
        $form->addElement(new XoopsFormEditor(_MA_XMSTOCK_AREA_DESC, 'area_description', $editor_configs), false);
        // logo
		$blank_img       = $this->getVar('area_logo') ?: 'no-image.png';
        $uploadirectory  = str_replace(XOOPS_URL, '', $url_logo_area);
        $imgtray_img     = new XoopsFormElementTray(_MA_XMSTOCK_AREA_LOGOFILE  . '<br /><br />' . sprintf(_MA_XMSTOCK_AREA_UPLOADSIZE, $upload_size/1024), '<br />');
        $imgpath_img     = sprintf(_MA_XMSTOCK_AREA_FORMPATH, $uploadirectory);
        $imageselect_img = new XoopsFormSelect($imgpath_img, 'area_logo', $blank_img);
        $image_array_img = XoopsLists::getImgListAsArray($path_logo_area);
		$imageselect_img->addOption("no-image.png", $blank_img);
        foreach ($image_array_img as $image_img) {
            $imageselect_img->addOption("$image_img", $image_img);
        }
        $imageselect_img->setExtra("onchange='showImgSelected(\"image_img2\", \"area_logo\", \"" . $uploadirectory . "\", \"\", \"" . XOOPS_URL . "\")'");
        $imgtray_img->addElement($imageselect_img, false);
        $imgtray_img->addElement(new XoopsFormLabel('', "<br /><img src='" . $url_logo_area . '/' . $blank_img . "' name='image_img2' id='image_img2' alt='' style='max-width:100px'/>"));
        $fileseltray_img = new XoopsFormElementTray('<br />', '<br /><br />');
        $fileseltray_img->addElement(new XoopsFormFile(_MA_XMSTOCK_AREA_UPLOAD, 'area_logo', $upload_size), false);
        $fileseltray_img->addElement(new XoopsFormLabel(''), false);
        $imgtray_img->addElement($fileseltray_img);
        $form->addElement($imgtray_img);

		// location
        $form->addElement(new XoopsFormText(_MA_XMSTOCK_AREA_LOCATION, 'area_location', 50, 255, $this->getVar('area_location')));

		//color
		$form->addElement(new XoopsFormColorPicker(_MA_XMSTOCK_AREA_COLOR, 'area_color', $this->getVar('area_color')), false);

        // weight
        $form->addElement(new XoopsFormText(_MA_XMSTOCK_AREA_WEIGHT, 'area_weight', 5, 5, $weight));

        // production
        if (xoops_isActiveModule('xmprod')) {
            $production = new XoopsFormRadioYN(_MA_XMSTOCK_AREA_PRODUCTION, 'area_production', $this->getVar('area_production'));
            $production->setDescription(_MA_XMSTOCK_AREA_PRODUCTION_DESC);
            $form->addElement($production);
        } else {
            $form->addElement(new XoopsFormHidden('area_production', $this->getVar('area_production')));
        }

		// status
        $form_status = new XoopsFormRadio(_MA_XMSTOCK_STATUS, 'area_status', $status);
        $options = array(1 => _MA_XMSTOCK_STATUS_A, 0 =>_MA_XMSTOCK_STATUS_NA,);
        $form_status->addOptionArray($options);
        $form->addElement($form_status);

		// permission
        $permHelper = new \Xmf\Module\Helper\Permission();
        $form->addElement($permHelper->getGroupSelectFormForItem('xmstock_manage', $this->getVar('area_id'), _MA_XMSTOCK_PERMISSION_MANAGE_DSC, 'xmstock_manage_perms', true));
		$form->addElement($permHelper->getGroupSelectFormForItem('xmstock_view', $this->getVar('area_id'), _MA_XMSTOCK_PERMISSION_VIEW_DSC, 'xmstock_view_perms', true));
		$form->addElement($permHelper->getGroupSelectFormForItem('xmstock_order', $this->getVar('area_id'), _MA_XMSTOCK_PERMISSION_ORDER_DSC, 'xmstock_order_perms', true));

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
