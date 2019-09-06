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
	/**
     * Fonction qui génère une liste des areas (id et nom)
     * @param boolean  $efl			Ajout d'un entrée nul en première position (-)
     * @return array   $arealist
     */
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
	
	/**
     * Fonction qui génère une liste des outputs (id et nom)
     * @param boolean  $efl			Ajout d'un entrée nul en première position (-)
     * @return array   $outputlist
     */	
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

	/**
     * Fonction qui génère vérifie si l'article à transférer est présent dans la quantité demandée
     * @param string   $type		Type de transfert (E: entrée, O: sortie, T: Transfert)
     * @param int      $articleid	Id de l'article
     * @param int      $amount		montant
     * @param int      $areaid	    Id de l'area
     * @return string   			Vide ou message d'erreur.	
     */
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

	/**
     * Fonction qui effectue le transfert de l'artile (dans la quantité demandée)dans le lieu voulu
     * @param string   $type		Type de transfert (E: entrée, O: sortie, T: Transfert)
     * @param int      $articleid	Id de l'article
     * @param int      $amount		montant
     * @param int      $areaid	    Id de l'area de départ
     * @param int      $areaid	    Id de l'area d'arrivée
     * @return string   			Vide ou message d'erreur.	
     */
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

	/**
     * Fonction qui liste les areas qui respectent la permission demandées
     * @param string   $permtype	Type de permission
     * @return array   $areas		Liste des areas qui correspondent à la permission
     */
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
	
	/**
     * Fonction qui permet d'afficher les areas par rapport à un article
     * @param          $xoopsTpl
     * @param      	   $xoTheme
     * @param int      $articleid	Id de l'article
     */
	public static function renderStocks($xoopsTpl, $xoTheme, $article_id = 0)
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
		$criteria->add(new Criteria('stock_articleid', $article_id));
		if (!empty($viewPermissionArea)) {
			$criteria->add(new Criteria('area_id', '(' . implode(',', $viewPermissionArea) . ')', 'IN'));
		}
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

	/**
     * Fonction qui compte le nombre d'article contenu dans un lieu de stockage
     * @param int      $area_id 	Id du lieu de stockage
     * @param array    $stock_arr   Tableau des stocks
     * @return int     $count		Nombre d'article
     */
	public static function articlePerArea($area_id, $stock_arr)
    {
        $count = 0;
        foreach (array_keys($stock_arr) as $i) {
            if ($stock_arr[$i]->getVar('stock_areaid') == $area_id) {
                $count++;
            }
        }
        return $count;
    }
	
	/**
     * Fonction qui donne le montant total de l'article dans le lieu de stockage défini
     * @param int      $area_id 	Id du lieu de stockage
	 * @param int      $articleid	Id de l'article
     * @param array    $stock_arr   Tableau des stocks
     * @return int     $amount		Montant total de l'article dans le lieu de stockage défini
     */
	public static function articleAmountPerArea($area_id, $article_id, $stock_arr)
    {
        $amount = 0;
        foreach (array_keys($stock_arr) as $i) {
            if ($stock_arr[$i]->getVar('stock_areaid') == $area_id && $stock_arr[$i]->getVar('stock_articleid') == $article_id) {
                $amount = $stock_arr[$i]->getVar('stock_amount');
            }
        }
        return $amount;
    }
	
	/**
     * Fonction qui permet d'afficher le nom d'un lieu de stockage
	 * @param int      $areaeid	    Id du lieu de stockage
     * @param boolean  $uloc		Afficher le lieu
     * @param boolean  $ulink		Nom sous forme de lien     
	 * @return string   			Nom selon les options ou message d'erreur
     */
	
	public static function getAreaName($areaid, $uloc = true, $ulink = true)
    {
        include __DIR__ . '/../include/common.php';
		
		$area = $areaHandler->get($areaid);
		if (isset($area)){
			if ($uloc == true){
				$loc = ' (' . $area->getVar('area_location') . ')';
			} else {
				$loc = '';
			}
			if ($ulink == true){
				$link = '<a href="' . XOOPS_URL . '/modules/xmstock/viewarea.php?area_id=' . $areaid . '" title="' . $area->getVar('area_name') . '" target="_blank">' . $area->getVar('area_name') . '</a>';
			} else {
				$link = $area->getVar('area_name');
			}		
			return $link . $loc;
		} else {
			return 'Error: The requested area does not exist! (ID-' . $areaid . ')';
		}
    }
}
