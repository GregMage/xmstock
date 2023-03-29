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

defined('XOOPS_ROOT_PATH') || exit('Restricted access');

xoops_load('XoopsFormSelect');

/**
 * A select field with area
 */
class XmstockFormSelectArea extends XoopsFormSelect
{
    /**
     * Constructor
     *
     * @param string  $caption Caption
     * @param string  $name    "name" attribute
     * @param mixed   $value   Pre-selected value (or array of them).
     *                         Legal are all 2-letter country codes (in capitals).
	 * @param boolean $efl     If true added an empty first line
	 * @param boolean $filter  If true area filtred
     * @param int     $size    Number or rows. "1" makes a drop-down-list
     */
    public function __construct($caption, $name, $value = null, $efl = false, $filter = false, $size = 1)
    {
        parent::__construct($caption, $name, $value, $size);

		include __DIR__ . '/../include/common.php';

		// Get Permission to manage
        xoops_load('utility', 'xmstock');
		$managePermissionArea = XmstockUtility::getPermissionArea('xmstock_manage');

		$arealist = array();
        $criteria = new CriteriaCompo();
        $criteria->add(new Criteria('area_status', 1));
		if ($helper->isUserAdmin() != true){
			if ($filter == true) {
				$criteria->add(new Criteria('area_id', '(' . implode(',', $managePermissionArea) . ')', 'IN'));
			}
		}
		$criteria->setSort('area_weight ASC, area_name');
        $criteria->setOrder('ASC');
		$area_arr = $areaHandler->getall($criteria);
		if ($efl == true && count($area_arr) > 1){
			$arealist[0] = "-";
		}
		if (count($area_arr) > 0) {
			foreach (array_keys($area_arr) as $i) {
				$arealist[$i] = $area_arr[$i]->getVar('area_name');
			}
		}
        $this->addOptionArray($arealist);
    }
}

/**
 * A select field with output
 */
class XmstockFormSelectOutput extends XoopsFormSelect
{
    /**
     * Constructor
     *
     * @param string  $caption Caption
     * @param string  $name    "name" attribute
     * @param mixed   $value   Pre-selected value (or array of them).
     *                         Legal are all 2-letter country codes (in capitals).
	 * @param boolean $efl     If true added an empty first line
     * @param int     $size    Number or rows. "1" makes a drop-down-list
     */
    public function __construct($caption, $name, $value = null, $efl = false, $size = 1)
    {
        parent::__construct($caption, $name, $value, $size);
        $this->addOptionArray(XmstockUtility::getOutputList($efl));
    }
}