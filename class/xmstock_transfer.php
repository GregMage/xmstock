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
		$this->initVar('transfer_outputuserid', XOBJ_DTYPE_INT, null, false, 11);
		$this->initVar('transfer_amount', XOBJ_DTYPE_INT, null, false, 11);
		$this->initVar('transfer_date', XOBJ_DTYPE_INT, null, false, 10);
		$this->initVar('transfer_userid', XOBJ_DTYPE_INT, null, false, 8);
		$this->initVar('transfer_needsyear', XOBJ_DTYPE_TXTBOX, null);
		$this->initVar('transfer_type', XOBJ_DTYPE_TXTBOX, null, false);
        $this->initVar('transfer_ref', XOBJ_DTYPE_TXTBOX, null, false);
		$this->initVar('transfer_status', XOBJ_DTYPE_INT, null, false, 1);
		$this->initVar('transfer_price', XOBJ_DTYPE_OTHER, null, false, 10);
		$this->initVar('transfer_location', XOBJ_DTYPE_TXTBOX, null);
		$this->initVar('transfer_stocktype', XOBJ_DTYPE_INT, null, false, 1);
		$this->initVar('transfer_stockmini', XOBJ_DTYPE_INT, null, false, 1);
		$this->initVar('article_id', XOBJ_DTYPE_TXTBOX, null);
		$this->initVar('article_cid', XOBJ_DTYPE_TXTBOX, null);
		$this->initVar('article_name', XOBJ_DTYPE_TXTBOX, null);
		$this->initVar('article_reference', XOBJ_DTYPE_TXTBOX, null);
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
    public function saveTransfer($transferHandler, $action = false)
    {
        global $xoopsUser;
		if ($action === false) {
            $action = $_SERVER['REQUEST_URI'];
        }
        include __DIR__ . '/../include/common.php';

		$managePermissionArea = XmstockUtility::getPermissionArea('xmstock_manage');

        $error_message = '';
        // test error
		$transfer_amount = Request::getInt('transfer_amount', 0);
		$transfer_type = Request::getString('transfer_type', 'E');
		$transfer_st_areaid = Request::getInt('transfer_st_areaid', 0);
		$transfer_ar_areaid = Request::getInt('transfer_ar_areaid', 0);
		$transfer_outputid = Request::getInt('transfer_outputid', 0);
		$transfer_outputuserid = Request::getInt('transfer_outputuserid', 0);
		$transfer_status = Request::getInt('transfer_status', 1);
		$transfer_newstatus = Request::getInt('transfer_newstatus', 1);
        if ((int)$_REQUEST['transfer_amount'] == 0 && $_REQUEST['transfer_amount'] != '0') {
            $error_message .= _MA_XMSTOCK_ERROR_AMOUNT . '<br>';
            $transfer_amount = 0;
        }
		if ($transfer_type == 'E' && $transfer_ar_areaid == 0) {
			$error_message .= _MA_XMSTOCK_ERROR_TRANSFER_AR_AREAID . '<br>';
			$transfer_ar_areaid = 0;
		}
		if ($transfer_type == 'O') {
			if ($transfer_st_areaid == 0) {
				$error_message .= _MA_XMSTOCK_ERROR_TRANSFER_ST_AREAID . '<br>';
				$transfer_st_areaid = 0;
			}
			if ($transfer_outputid == 0 && $transfer_outputuserid == 0) {
				$error_message .= _MA_XMSTOCK_ERROR_TRANSFER_OUTPUTID . '<br>';
			}
			if ($transfer_outputid != 0 && $transfer_outputuserid != 0) {
				$error_message .= _MA_XMSTOCK_ERROR_TRANSFER_OUTPUT . '<br>';
				$transfer_outputid = 0;
				$transfer_outputuserid = 0;
			}
		}
		if ($transfer_type == 'T'){
			if ($transfer_st_areaid == 0) {
				$error_message .= _MA_XMSTOCK_ERROR_TRANSFER_ST_AREAID . '<br>';
				$transfer_st_areaid = 0;
			}
			if ($transfer_ar_areaid == 0) {
				$error_message .= _MA_XMSTOCK_ERROR_TRANSFER_AR_AREAID . '<br>';
				$transfer_ar_areaid = 0;
			}
			if ($transfer_ar_areaid == $transfer_st_areaid) {
				$error_message .= _MA_XMSTOCK_ERROR_TRANSFER_ST_TO_AR . '<br>';
				$transfer_ar_areaid = 0;
			}
		}
		$price = Request::getFloat('transfer_price', 0.0);
		if ($price < 0.0) {
			$error_message .= _MA_XMSTOCK_ERROR_PRICE . '<br>';
			$this->setVar('transfer_price', 0.0);
		} else {
			$this->setVar('transfer_price', number_format($price, 2, '.', ''));
		}
		$location = Request::getString('transfer_location', '');
		$transfer_stockmini = Request::getInt('transfer_stockmini', 0);
		if ($transfer_type != 'O') {
			if (in_array($transfer_ar_areaid, $managePermissionArea) == true){
				$this->setVar('transfer_location', $location);
				$this->setVar('transfer_stockmini', $transfer_stockmini);
			}
		}
		$this->setVar('transfer_status', $transfer_status);
		$stocktype = Request::getInt('transfer_stocktype', 0);
		if ($transfer_newstatus == 0) {
			redirect_header($action, 2, _MA_XMSTOCK_REDIRECT_SAVE);
		}
		if ($transfer_newstatus == 2) {
			if ($transferHandler->delete($this)) {
				redirect_header($action, 2, _MA_XMSTOCK_REDIRECT_SAVE);
			} else {
				return $this->getHtmlErrors();
			}
		} else {
			xoops_load('utility', 'xmarticle');
			$transfer_articleid = Request::getInt('transfer_articleid', 0);
			if ($transfer_articleid == 0) {
				$transfer_articleid = XmarticleUtility::renderArticleIdSave();
			}
			$error_message .= XmstockUtility::checkTransfert($transfer_type, $transfer_articleid, $transfer_amount, $transfer_st_areaid);
			$this->setVar('transfer_articleid', $transfer_articleid);
			$this->setVar('transfer_amount', $transfer_amount);
			$this->setVar('transfer_type', $transfer_type);
			$this->setVar('transfer_ar_areaid', $transfer_ar_areaid);
			$this->setVar('transfer_st_areaid', $transfer_st_areaid);
			$this->setVar('transfer_outputid', $transfer_outputid);
			$this->setVar('transfer_outputuserid', $transfer_outputuserid);
			$this->setVar('transfer_description',  Request::getText('transfer_description', ''));
			$this->setVar('transfer_userid', !empty($xoopsUser) ? $xoopsUser->getVar('uid') : 0);
			$this->setVar('transfer_needsyear', Request::getString('transfer_needsyear', ''));
			$this->setVar('transfer_date', time());
			if ($error_message == '') {
				if ($transfer_articleid == 0){
					$error_message .= _MA_XMSTOCK_ERROR_ARTICLEID . '<br>';
				} else {
					if ($transfer_type == 'T') {
						if (in_array($transfer_ar_areaid, $managePermissionArea) == true){
							$this->setVar('transfer_status', $transfer_newstatus);
						} else {
							$this->setVar('transfer_status', 0);
						}
					}
					if ($transfer_type == 'E') {
						$this->setVar('transfer_status', $transfer_newstatus);
					}
					$this->setVar('transfer_articleid', $transfer_articleid);
					if ($transfer_amount != 0) {
						$price = $price / $transfer_amount;
					}
					$error_message .= XmstockUtility::transfert($transfer_type, $transfer_articleid, $transfer_amount, $transfer_st_areaid, $transfer_ar_areaid, $price, $location, $stocktype, $transfer_stockmini);
					if ($error_message == '') {
						$this->destroyVars('transfer_price');
						$this->destroyVars('transfer_location');
						$this->destroyVars('transfer_stocktype');
						$this->destroyVars('transfer_stockmini');
						if ($transferHandler->insert($this)) {
							redirect_header($action, 2, _MA_XMSTOCK_REDIRECT_SAVE);
						} else {
							$error_message .=  $this->getHtmlErrors();
						}
					}
				}
			}
			return $error_message;
		}
    }

	/**
     * @param bool $action
     * @return XoopsThemeForm
     */
    public function getForm($type = 'E', $status = 1, $action = false)
    {
        $helper = \Xmf\Module\Helper::getHelper('xmstock');
        if ($action === false) {
            $action = $_SERVER['REQUEST_URI'];
        }
        include_once XOOPS_ROOT_PATH . '/class/xoopsformloader.php';
        include __DIR__ . '/../include/common.php';
		include __DIR__ . '/formselectstock.php';

        //form title
		switch($type) {
			case 'E':
				$title = _MA_XMSTOCK_TRANSFER_ENTRYINSTOCK;
				break;
			case 'O':
				$title = _MA_XMSTOCK_TRANSFER_OUTOFSTOCK;
				break;
			case 'T':
				$title = _MA_XMSTOCK_TRANSFER_TRANSFEROFSTOCK;
				break;
		}

        $form = new XoopsThemeForm($title, 'formtransfert', $action, 'post', true);

        if (!$this->isNew()) {
            $form->addElement(new XoopsFormHidden('transfer_id', $this->getVar('transfer_id')));
			$type = $this->getVar('transfer_type');
			$price = $this->getVar('transfer_price');
			$transfer_stocktype = $this->getVar('transfer_stocktype');
			if (empty($transfer_stocktype)){
				$transfer_stocktype = 1;
			}
        } else {
			$price = 0;
			$transfer_stocktype = 1;
		}
		if ($status == 1) {
			//articleid
			xoops_load('utility', 'xmarticle');
			XmarticleUtility::renderArticleForm($form, _MA_XMSTOCK_TRANSFER_ARTICLE, $this->getVar('transfer_articleid'));

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

			if ($type != 'E'){
				// st_areaid
				$form->addElement(new XmstockFormSelectArea(_MA_XMSTOCK_TRANSFER_STAREA, 'transfer_st_areaid', $this->getVar('transfer_st_areaid'), true, true), true);
			} else {
				$form->addElement(new XoopsFormHidden('transfer_st_areaid', 0));
			}
			if ($type != 'O'){
				// ar_areaid
				if ($type == 'E'){
					$form->addElement(new XmstockFormSelectArea(_MA_XMSTOCK_TRANSFER_ARAREA, 'transfer_ar_areaid', $this->getVar('transfer_ar_areaid'), true, true), true);
				} else {
					$form->addElement(new XmstockFormSelectArea(_MA_XMSTOCK_TRANSFER_ARAREA, 'transfer_ar_areaid', $this->getVar('transfer_ar_areaid'), true, false), true);
				}

			} else {
				$form->addElement(new XoopsFormHidden('transfer_ar_areaid', 0));
			}

			if ($type == 'O'){
				// outputid
				$output 		= new XoopsFormElementTray(_MA_XMSTOCK_TRANSFER_OUTPUT, '');
				$outputid 		= new XmstockFormSelectOutput(_MA_XMSTOCK_TRANSFER_OUTPUTID, 'transfer_outputid', $this->getVar('transfer_outputid'), true);
				$outputuserid 	= new XoopsFormSelectUser(_MA_XMSTOCK_TRANSFER_OUTPUTUSERID, 'transfer_outputuserid', true, $this->getVar('transfer_outputuserid'));
				$output->addElement($outputid);
				$output->addElement($outputuserid);
				$output->setDescription(_MA_XMSTOCK_TRANSFER_OUTPUT_DSC);
				$form->addElement($output);
			} else {
				$form->addElement(new XoopsFormHidden('transfer_outputid', 0));
				$form->addElement(new XoopsFormHidden('transfer_outputuserid', 0));
			}
			// amount
			$amount = new XoopsFormText(_MA_XMSTOCK_TRANSFER_AMOUNT, 'transfer_amount', 10, 10, $this->getVar('transfer_amount'));
			$amount->setDescription(_MA_XMSTOCK_TRANSFER_AMOUNT_DSC);
			$form->addElement($amount, true);
			if ($type == 'O'){
				if (xoops_isActiveModule('xmprod')){
					if ($helper->getConfig('general_xmprod', 0) == 1) {
						xoops_load('utility', 'xmprod');
						$needs     = new XoopsFormElementTray('<section id="needsyear_label">' . _MA_XMSTOCK_TRANSFER_NEEDSYEAR . '</section>', '');
						$needs->addElement(new XoopsFormLabel('<section id="needsyear_input">'), false);
						$year = new XoopsFormSelect('', 'transfer_needsyear', $this->getVar('transfer_needsyear'));
						$year_arr = XmprodUtility::getNeedsYears();
						foreach (array_keys($year_arr) as $i) {
							$year->addOption($year_arr[$i], $year_arr[$i]);
						}
						$needs->addElement($year);
						$needs->addElement(new XoopsFormLabel('<p class="form-text text-muted text-left">' . _MA_XMSTOCK_TRANSFER_NEEDSYEAR_DSC . '</p>'), false);
						$needs->addElement(new XoopsFormLabel('</section>'), false);
						$form->addElement($needs, true);
					}
				} else {
					$form->addElement(new XoopsFormHidden('transfer_needsyear', ''));
				}
			} else {
				$form->addElement(new XoopsFormHidden('transfer_needsyear', ''));
			}

			// price
			if ($helper->getConfig('general_price', 0) != 0 && $type == 'E') {
				$price = new XoopsFormText(_MA_XMSTOCK_TRANSFER_PRICE, 'transfer_price', 10, 10, $price);
				$price->setDescription(_MA_XMSTOCK_TRANSFER_PRICE_DSC);
				$form->addElement($price, false);
			} else {
				$form->addElement(new XoopsFormHidden('transfer_price', 0));
			}
		} else {
			// status
			$form_status = new XoopsFormRadio(_MA_XMSTOCK_STATUS, 'transfer_newstatus', 1);
			$options = array(0 =>_MA_XMSTOCK_STATUS_WAITING , 1 => _MA_XMSTOCK_VALID, 2 => _MA_XMSTOCK_REJECT);
			$form_status->addOptionArray($options);
			$form->addElement($form_status);
			// Hidden
			$form->addElement(new XoopsFormHidden('transfer_articleid', $this->getVar('transfer_articleid')));
			$form->addElement(new XoopsFormHidden('transfer_description', $this->getVar('transfer_description')));
			$form->addElement(new XoopsFormHidden('transfer_st_areaid', $this->getVar('transfer_st_areaid')));
			$form->addElement(new XoopsFormHidden('transfer_ar_areaid', $this->getVar('transfer_ar_areaid')));
			$form->addElement(new XoopsFormHidden('transfer_amount', $this->getVar('transfer_amount')));
		}
		// location
		if ($type != 'O') {
			if ($status == 0){
				$add_script = "<script>";
				$add_script .= "let articleId = " . $this->getVar('transfer_articleid') . ";";
				$add_script .= "let valid_areaid = " . $this->getVar('transfer_ar_areaid') . ";";
				$add_script .= "</script>";
			} else {
				$add_script = '';
			}
			$location = new XoopsFormText(_MA_XMSTOCK_TRANSFER_LOCATION, 'transfer_location', 50, 255, '');
			$location->setDescription(_MA_XMSTOCK_TRANSFER_LOCATION_DSC . $add_script);
			$form->addElement($location, false);

			$mini = new XoopsFormText(_MA_XMSTOCK_STOCK_MINI, 'transfer_stockmini', 50, 50, 0);
			$mini->setDescription(_MA_XMSTOCK_STOCK_MINI_DSC);
			$form->addElement($mini, false);
		}
		if ($type == 'E') {
			// type
			$form_type = new XoopsFormRadio(_MA_XMSTOCK_STOCK_TYPE, 'transfer_stocktype', $transfer_stocktype);
			$options = array(1 => _MA_XMSTOCK_STOCK_STANDARD, 2 =>_MA_XMSTOCK_STOCK_ML, 3 =>_MA_XMSTOCK_STOCK_LOAN, 4 =>_MA_XMSTOCK_STOCK_FREE, 5 =>_MA_XMSTOCK_STOCK_SURFACE);
			$form_type->addOptionArray($options);
			$form_type->setDescription(_MA_XMSTOCK_STOCK_TYPE_DESC);
			$form->addElement($form_type);
		}
		$form->addElement(new XoopsFormHidden('transfer_type', $type));
		$form->addElement(new XoopsFormHidden('transfer_status', $status));
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
