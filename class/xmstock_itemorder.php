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
 * @copyright       XOOPS Project (https://xoops.org)
 * @license         GNU GPL 2 (http://www.gnu.org/licenses/old-licenses/gpl-2.0.html)
 * @author          Mage Gregory (AKA Mage)
 */

defined('XOOPS_ROOT_PATH') || exit('Restricted access.');

/**
 * Class xmstock_itemorder
 */
class xmstock_itemorder extends XoopsObject
{
    // constructor
    /**
     * xmstock_itemorder constructor.
     */
    public function __construct()
    {
        $this->initVar('itemorder_id', XOBJ_DTYPE_INT, null);
        $this->initVar('itemorder_orderid', XOBJ_DTYPE_INT, null);
        $this->initVar('itemorder_articleid', XOBJ_DTYPE_INT, null);
        $this->initVar('itemorder_areaid', XOBJ_DTYPE_INT, null);
        $this->initVar('itemorder_amount', XOBJ_DTYPE_INT, null);
        $this->initVar('itemorder_needsyear', XOBJ_DTYPE_TXTBOX, null);
        $this->initVar('itemorder_length', XOBJ_DTYPE_OTHER, null);
        $this->initVar('itemorder_width', XOBJ_DTYPE_OTHER, null);
		$this->initVar('article_reference', XOBJ_DTYPE_TXTBOX, null);
		$this->initVar('article_cid', XOBJ_DTYPE_INT, null);
		$this->initVar('article_name', XOBJ_DTYPE_TXTBOX, null);
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
 * Class xmstockxmstock_itemorderHandler
 */
class xmstockxmstock_itemorderHandler extends XoopsPersistableObjectHandler
{
    /**
     * xmstockxmstock_itemorderHandler constructor.
     * @param null|XoopsDatabase $db
     */
    public function __construct($db)
    {
        parent::__construct($db, 'xmstock_itemorder', 'xmstock_itemorder', 'itemorder_id', 'itemorder_orderid');
    }
}
