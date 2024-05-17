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
 * Class xmstock_loan
 */
class xmstock_loan extends XoopsObject
{
    // constructor
    /**
     * xmstock_loan constructor.
     */
    public function __construct()
    {
        $this->initVar('loan_id', XOBJ_DTYPE_INT, null, false, 11);
		$this->initVar('loan_areaid', XOBJ_DTYPE_INT, null, false, 8);
		$this->initVar('loan_articleid', XOBJ_DTYPE_INT, null, false, 8);
		$this->initVar('loan_amount', XOBJ_DTYPE_INT, null, false, 6);
		$this->initVar('loan_date', XOBJ_DTYPE_INT, null, false, 10);
		$this->initVar('loan_rdate', XOBJ_DTYPE_INT, null, false, 10);
		$this->initVar('loan_userid', XOBJ_DTYPE_INT, null, false, 8);
		$this->initVar('loan_status', XOBJ_DTYPE_INT, null, false, 1);
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
    public function saveLoan($loanHandler, $action = false)
    {
        global $xoopsUser;

        include __DIR__ . '/../include/common.php';

        $error_message = '';
        $areaid = Request::getInt('loan_areaid', 0);
        $this->setVar('loan_areaid', $areaid);
		$status = Request::getInt('loan_status', 1);
		$this->setVar('loan_status', $status);
        $userid = Request::getInt('loan_userid', 0);
        $this->setVar('loan_userid', $userid);
		$date = Request::getString('loan_date', '');
		$amount = Request::getInt('loan_amount', 0);
		if ($date != '') {
			$this->setVar('loan_date', strtotime($date));
		}
		if ((int)$_REQUEST['loan_amount'] == 0 && $_REQUEST['loan_amount'] != '0') {
            $error_message .= _MA_XMSTOCK_ERROR_AMOUNT . '<br>';
            $amount = 0;
        }
		if ($userid == 0) {
			$error_message .= _MA_XMSTOCK_ERROR_USER . '<br>';
		}
		xoops_load('utility', 'xmarticle');
		$transfer_articleid = Request::getInt('loan_articleid', 0);
		if ($transfer_articleid == 0) {
			$transfer_articleid = XmarticleUtility::renderArticleIdSave();
		}
		if ($status != 0) {
			$error_message .= XmstockUtility::checkTransfert('O', $transfer_articleid, 1, $areaid);
		}
		$this->setVar('loan_articleid', $transfer_articleid);
        if ($error_message == '') {
			$this->setVar('loan_amount', $amount);
			if ($status == 0) {
				$this->setVar('loan_rdate', time());
				$criteria = new CriteriaCompo();
				$criteria->add(new Criteria('stock_areaid', $areaid));
				$criteria->add(new Criteria('stock_articleid', $transfer_articleid));
				$stock_arr = $stockHandler->getall($criteria);
				foreach (array_keys($stock_arr) as $i) {
					$type = $stock_arr[$i]->getVar('stock_type');
				}
				$error_message .= XmstockUtility::transfert('E', $transfer_articleid, $amount, 0, $areaid, 0, '', $type);
			} else {
				$error_message .= XmstockUtility::transfert('O', $transfer_articleid, $amount, $areaid);
			}
			if ($error_message == '') {
				if ($loanHandler->insert($this)) {
					$new_transfer = $transferHandler->create();
					$new_transfer->setVar('transfer_articleid', $transfer_articleid);
					$new_transfer->setVar('transfer_amount', $amount);
					if ($status == 0) {
						$new_transfer->setVar('transfer_type', 'E');
					} else {
						$new_transfer->setVar('transfer_type', 'O');
					}
					$new_transfer->setVar('transfer_ar_areaid', $areaid);
					$new_transfer->setVar('transfer_st_areaid', $areaid);
					$new_transfer->setVar('transfer_outputuserid', $userid);
					$new_transfer->setVar('transfer_description',  sprintf(_MA_XMSTOCK_LOAN_TRANSFERT_DESC, formatTimestamp($this->getVar('loan_date'), 'm'), $this->getVar('loan_id')));
					$new_transfer->setVar('transfer_ref', sprintf(_MA_XMSTOCK_LOAN_TRANSFERT_REF, $this->getVar('loan_id')));
					$new_transfer->setVar('transfer_status', 1);
					$new_transfer->setVar('transfer_userid', !empty($xoopsUser) ? $xoopsUser->getVar('uid') : 0);
					$new_transfer->setVar('transfer_date', time());
					if (!$transferHandler->insert($new_transfer)) {
						$error_message .=  $new_transfer->getHtmlErrors();
					} else {
						redirect_header($action, 2, _MA_XMSTOCK_REDIRECT_SAVE);
					}
				} else {
					$error_message =  $this->getHtmlErrors();
				}
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
		include_once $GLOBALS['xoops']->path('class/xoopsformloader.php');
        include __DIR__ . '/../include/common.php';
		include __DIR__ . '/formselectstock.php';

        //form title
        $title = $this->isNew() ? sprintf(_MA_XMSTOCK_LOAN_ADD) : sprintf(_MA_XMSTOCK_LOAN_EDIT);

        $form = new XoopsThemeForm($title, 'form', $action, 'post', true);
		xoops_load('utility', 'xmarticle');
		XmarticleUtility::renderArticleForm($form, _MA_XMSTOCK_LOAN_ARTICLE, $this->getVar('loan_articleid'));

		if ($this->isNew()) {
			//areaid
			$form->addElement(new XmstockFormSelectArea(_MA_XMSTOCK_LOAN_AREA, 'loan_areaid', $this->getVar('loan_areaid'), true, true), true);
			//date
			$form->addElement(new XoopsFormTextDateSelect(_MA_XMSTOCK_LOAN_DATE, 'loan_date', 2, time()), false);
			//user
			$form->addElement(new XoopsFormSelectUser(_MA_XMSTOCK_LOAN_USERID, 'loan_userid', true, ''), true);
			//amount
			$form->addElement(new XoopsFormText(_MA_XMSTOCK_LOAN_AMOUNT, 'loan_amount', 10, 10, 1), true);
			//status
			$form->addElement(new XoopsFormHidden('status', 1));
		} else {
			//date
			$form->addElement(new XoopsFormLabel(_MA_XMSTOCK_LOAN_DATE, formatTimestamp($this->getVar('loan_date'), 's')), false);
			//user
			$form->addElement(new XoopsFormLabel(_MA_XMSTOCK_LOAN_USERID, XoopsUser::getUnameFromId($this->getVar('loan_userid'))), false);
			$form->addElement(new XoopsFormHidden('loan_userid', $this->getVar('loan_userid')));
			//amount
			$form->addElement(new XoopsFormLabel(_MA_XMSTOCK_LOAN_AMOUNT, $this->getVar('loan_amount')), false);
			$form->addElement(new XoopsFormHidden('loan_amount', $this->getVar('loan_amount')));
			//status
			$form_status = new XoopsFormRadio(_MA_XMSTOCK_LOAN_STATUS, 'loan_status', $this->getVar('loan_status'));
			$options = array(1 => _MA_XMSTOCK_LOAN_STATUS_L, 0 =>_MA_XMSTOCK_LOAN_STATUS_C,);
			$form_status->addOptionArray($options);
			$form->addElement($form_status);
			//articleid
			$form->addElement(new XoopsFormHidden('transfer_articleid', $this->getVar('transfer_articleid')));
			//id
			$form->addElement(new XoopsFormHidden('loan_id', $this->getVar('loan_id')));
			//areaid
			$form->addElement(new XoopsFormHidden('loan_areaid', $this->getVar('loan_areaid')));
		}

		$form->addElement(new XoopsFormHidden('op', 'save'));

        // submit
        $form->addElement(new XoopsFormButton('', 'submit', _SUBMIT, 'submit'));

        return $form;
    }
}

/**
 * Classxmstockxmstock_loanHandler
 */
class xmstockxmstock_loanHandler extends XoopsPersistableObjectHandler
{
    /**
     * xmstockxmstock_loanHandler constructor.
     * @param null|XoopsDatabase $db
     */
    public function __construct($db)
    {
        parent::__construct($db, 'xmstock_loan', 'xmstock_loan', 'loan_id', 'loan_articleid');
    }
}
