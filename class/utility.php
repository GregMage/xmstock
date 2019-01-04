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
    public static function getAreaList($efl = false)
    {
        include __DIR__ . '/../include/common.php';
		$arealist = array();

        $criteria = new CriteriaCompo();
        $criteria->add(new Criteria('area_status', 1));
		$criteria->setSort('area_weight ASC, area_name');
        $criteria->setOrder('ASC');
		$area_arr = $areaHandler->getall($criteria);
		if ($efl == true){
			$arealist[0] = "-";
		}
		if (count($area_arr) > 0) {
			foreach (array_keys($area_arr) as $i) {
				$arealist[$i] = $area_arr[$i]->getVar('area_name');
			}
		}
        return $arealist;
    }
	
	public static function getOutputList($efl = false)
    {
        include __DIR__ . '/../include/common.php';
		$outputlist = array();

        $criteria = new CriteriaCompo();
        $criteria->add(new Criteria('output_status', 1));
		$criteria->setSort('output_weight ASC, output_name');
        $criteria->setOrder('ASC');
		$output_arr = $outputHandler->getall($criteria);
		if ($efl == true){
			$outputlist[0] = "-";
		}
		if (count($output_arr) > 0) {
			foreach (array_keys($output_arr) as $i) {
				$outputlist[$i] = $output_arr[$i]->getVar('output_name');
			}
		}
        return $outputlist;
    }
	
	public static function addArticleStock($areaid, $articleid, $amound)
    {
        if ($areaid == 0 || $articleid == 0 || $amound == 0){
			return false;
		}
		include __DIR__ . '/../include/common.php';

        $criteria = new CriteriaCompo();
        $criteria->add(new Criteria('stock_areaid', $areaid));
        $criteria->add(new Criteria('stock_articleid', $articleid));
		$stock_arr = $stockHandler->getall($criteria);
		if (count($stock_arr) == 0){
			$obj = $stockHandler->create();
			$obj->setVar('stock_areaid', $areaid);
			$obj->setVar('stock_articleid', $articleid);
			$obj->setVar('stock_amound', $amound);
			if ($stockHandler->insert($obj)) {
                return true;
            } else {
                return false;
            }
		} else {
			foreach (array_keys($stock_arr) as $i) {
				$obj = $stockHandler->get($i);
			}
			$old_amound = $obj->getVar('stock_amound');
			$obj->setVar('stock_amound', $old_amound + $amound);
			if ($stockHandler->insert($obj)) {
                return true;
            } else {
                return false;
            }
		}
    }
}
