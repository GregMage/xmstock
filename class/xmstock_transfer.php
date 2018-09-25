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
