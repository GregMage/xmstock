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
		$this->initVar('output_userid', XOBJ_DTYPE_INT, null, false, 8);
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
