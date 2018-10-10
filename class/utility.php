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

/**
 * Class XmstockUtility
 */
class XmstockUtility
{
    public static function getAreaList()
    {
        include __DIR__ . '/../include/common.php';
		$arealist = array();

        $criteria = new CriteriaCompo();
        $criteria->add(new Criteria('area_status', 1));
		$criteria->setSort('area_weight ASC, area_name');
        $criteria->setOrder('ASC');
		$area_arr = $areaHandler->getall($criteria);
        $area_count = $areaHandler->getCount($criteria);
		if ($area_count > 0) {
			foreach (array_keys($area_arr) as $i) {
				$arealist[$i] = $area_arr[$i]->getVar('area_name');
			}
		}
        return $arealist;
    }
}
