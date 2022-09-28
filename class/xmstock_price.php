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
 * Class xmstock_price
 */
class xmstock_price extends XoopsObject
{
    // constructor
    /**
     * xmstock_stock constructor.
     */
    public function __construct()
    {
        $this->initVar('price_id', XOBJ_DTYPE_INT, null, false, 11);
        $this->initVar('price_areaid', XOBJ_DTYPE_INT, null, false, 11);
		$this->initVar('price_articleid', XOBJ_DTYPE_INT, null, false, 11);
		$this->initVar('price_amount', XOBJ_DTYPE_INT, null, false, 11);
		$this->initVar('price_price', XOBJ_DTYPE_OTHER, null, false, 10);
		$this->initVar('price_date', XOBJ_DTYPE_INT, 0);		
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
 * Classxmstockxmstock_stockHandler
 */
class xmstockxmstock_priceHandler extends XoopsPersistableObjectHandler
{
    /**
     * xmstockxmstock_stockHandler constructor.
     * @param null|XoopsDatabase $db
     */
    public function __construct($db)
    {
        parent::__construct($db, 'xmstock_price', 'xmstock_price', 'price_id', 'price_amound');
    }
}
