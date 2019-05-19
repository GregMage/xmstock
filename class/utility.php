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

	public static function checkTransfert($type, $articleid, $amount, $areaid)
    {
		include __DIR__ . '/../include/common.php';
		switch ($type) {
			case 'E':
			 default:
				return '';
				break;
							
			case 'O':
			case 'T':
				//test si l'article est bien dans le stock
				$criteria = new CriteriaCompo();
				$criteria->add(new Criteria('stock_areaid', $areaid));
				$criteria->add(new Criteria('stock_articleid', $articleid));
				$stock_arr = $stockHandler->getall($criteria);
				if (count($stock_arr) == 0){
					// l'article n'est pas en stock					
					return _MA_XMSTOCK_ERROR_TRANSFERT_NOARTICLE;
				} else {
					foreach (array_keys($stock_arr) as $i) {
						$obj = $stockHandler->get($i);
					}
					$old_amount = $obj->getVar('stock_amount');
					if ($old_amount < $amount){
						// la quantité demandée est plus grande que celle disponible
						return sprintf(_MA_XMSTOCK_ERROR_TRANSFERT_TBAMOUNT, $amount, $old_amount);
					} else {
						return '';
					}
				}
				break;
		}
    }

	public static function transfert($type, $articleid, $amount, $st_areaid, $ar_areaid)
    {
		include __DIR__ . '/../include/common.php';
		switch ($type) {
			case 'E':
			default:
				$criteria = new CriteriaCompo();
				$criteria->add(new Criteria('stock_areaid', $ar_areaid));
				$criteria->add(new Criteria('stock_articleid', $articleid));
				$stock_arr = $stockHandler->getall($criteria);
				if (count($stock_arr) == 0){
					$obj = $stockHandler->create();
					$obj->setVar('stock_areaid', $ar_areaid);
					$obj->setVar('stock_articleid', $articleid);
					$obj->setVar('stock_amount', $amount);
					if ($stockHandler->insert($obj)) {
						return '';
					} else {
						return $obj->getHtmlErrors();
					}
				} else {
					foreach (array_keys($stock_arr) as $i) {
						$obj = $stockHandler->get($i);
					}
					$old_amount = $obj->getVar('stock_amount');
					$obj->setVar('stock_amount', $old_amount + $amount);
					if ($stockHandler->insert($obj)) {
						return '';
					} else {
						return $obj->getHtmlErrors();
					}
				}
				break;
							
			case 'O':
				$criteria = new CriteriaCompo();
				$criteria->add(new Criteria('stock_areaid', $st_areaid));
				$criteria->add(new Criteria('stock_articleid', $articleid));
				$stock_arr = $stockHandler->getall($criteria);
				foreach (array_keys($stock_arr) as $i) {
					$obj = $stockHandler->get($i);
				}
				$old_amount = $obj->getVar('stock_amount');
				
				if ($old_amount == $amount){
					if ($stockHandler->delete($obj)) {
						return '';
					} else {
						return $obj->getHtmlErrors();
					}
				} else {
					$obj->setVar('stock_amount', $old_amount - $amount);
					if ($stockHandler->insert($obj)) {
						return '';
					} else {
						return $obj->getHtmlErrors();
					}
				}
		
				break;
			case 'T':
				$criteria = new CriteriaCompo();
				$criteria->add(new Criteria('stock_areaid', $st_areaid));
				$criteria->add(new Criteria('stock_articleid', $articleid));
				$stock_arr = $stockHandler->getall($criteria);
				foreach (array_keys($stock_arr) as $i) {
					$obj = $stockHandler->get($i);
				}
				$old_amount = $obj->getVar('stock_amount');
				
				if ($old_amount == $amount){
					if ($stockHandler->delete($obj)) {
						return '';
					} else {
						return $obj->getHtmlErrors();
					}
				} else {
					$obj->setVar('stock_amount', $old_amount - $amount);
					if ($stockHandler->insert($obj)) {
						$criteria = new CriteriaCompo();
						$criteria->add(new Criteria('stock_areaid', $ar_areaid));
						$criteria->add(new Criteria('stock_articleid', $articleid));
						$stock_arr = $stockHandler->getall($criteria);
						if (count($stock_arr) == 0){
							$obj = $stockHandler->create();
							$obj->setVar('stock_areaid', $ar_areaid);
							$obj->setVar('stock_articleid', $articleid);
							$obj->setVar('stock_amount', $amount);
							if ($stockHandler->insert($obj)) {
								return '';
							} else {
								return $obj->getHtmlErrors();
							}
						} else {
							foreach (array_keys($stock_arr) as $i) {
								$obj = $stockHandler->get($i);
							}
							$old_amount = $obj->getVar('stock_amount');
							$obj->setVar('stock_amount', $old_amount + $amount);
							if ($stockHandler->insert($obj)) {
								return '';
							} else {
								return $obj->getHtmlErrors();
							}
						}
						return '';
					} else {
						return $obj->getHtmlErrors();
					}
				}
				break;
		}
    }
	
	public static function getPermissionArea($permtype = 'xmstock_view')
    {
        global $xoopsUser;
        $areas = array();
        $helper = Xmf\Module\Helper::getHelper('xmstock');
        $moduleHandler = $helper->getModule();
        $groups = is_object($xoopsUser) ? $xoopsUser->getGroups() : XOOPS_GROUP_ANONYMOUS;
        $gpermHandler = xoops_getHandler('groupperm');
        $areas = $gpermHandler->getItemIds($permtype, $groups, $moduleHandler->getVar('mid'));

        return $areas;
    }

	public static function renderStocks($xoopsTpl, $xoTheme, $itemid = 0)
    {
        include __DIR__ . '/../include/common.php';
        
        $xoTheme->addStylesheet( XOOPS_URL . '/modules/xmstock/assets/css/styles.css', null );
        
        $xmstockHelper = Xmf\Module\Helper::getHelper('xmstock');
        // Load language files
        $xmstockHelper->loadLanguage('main');
		
		// Get Permission to view
		$viewPermissionArea = XmstockUtility::getPermissionArea('xmstock_view');
		
		// Criteria
        $criteria = new CriteriaCompo();
        $criteria->setSort('area_weight');
        $criteria->setOrder('ASC');
		$criteria->add(new Criteria('stock_articleid', $itemid));
		$criteria->add(new Criteria('area_status', 1));
        $stockHandler->table_link = $stockHandler->db->prefix("xmstock_area");
        $stockHandler->field_link = "area_id";
        $stockHandler->field_object = "stock_areaid";
        $stock_arr = $stockHandler->getByLink($criteria);
        if (count($stock_arr) > 0 && !empty($viewPermissionArea)) {
			$total_amount = 0;
			foreach (array_keys($stock_arr) as $i) {
				$stock['area_id']       = $stock_arr[$i]->getVar('area_id');
                $stock['name']       = $stock_arr[$i]->getVar('area_name');
                $stock['location']   = $stock_arr[$i]->getVar('area_location');
                $stock['amount']     = $stock_arr[$i]->getVar('stock_amount');
				$total_amount += $stock['amount'];
                $xoopsTpl->append_by_ref('stock', $stock);
                unset($stock);
            }
			$xoopsTpl->assign('total_amount', $total_amount);
            $xoopsTpl->assign('xmstock_viewstocks', true);
        }
    }
}
