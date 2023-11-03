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
					return _MA_XMSTOCK_ERROR_TRANSFER_NOARTICLE;
				} else {
					foreach (array_keys($stock_arr) as $i) {
						$obj = $stockHandler->get($i);
					}
					$old_amount = $obj->getVar('stock_amount');
					if ($old_amount < $amount){
						// la quantité demandée est plus grande que celle disponible
						return sprintf(_MA_XMSTOCK_ERROR_TRANSFER_TBAMOUNT, $amount, $old_amount);
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
     * @param int      $st_areaid	Id de l'area de départ
     * @param int      $ar_areaid	Id de l'area d'arrivée
     * @param float    $price		prix
     * @param string   $location	emplacement
     * @param int	   $stocktype	Type de stock (1 standard, 2 matière en mml et 3 emprunt)
     * @return string   			Vide ou message d'erreur
     */
	public static function transfert($type, $articleid, $amount, $st_areaid, $ar_areaid = 0, $price = 0.0, $location = '', $stocktype = 1)
    {
		include __DIR__ . '/../include/common.php';
		$error_message = '';
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
					if ($location != '') {
						$obj->setVar('stock_location', $location);
					}
					$obj->setVar('stock_type', $stocktype);
					//price
					$price = self::priceCalculation($price, $amount, 0, 0);
					if ($price > 0) {
						$obj->setVar('stock_price', number_format($price, 2, '.', ''));
						$error_message .= self::setPrice($articleid, $ar_areaid, $amount, $price);
					}
					if ($error_message == '') {
						if ($stockHandler->insert($obj)) {
							return '';
						} else {
							return $obj->getHtmlErrors();
						}
					} else {
						return $error_message;
					}
				} else {
					foreach (array_keys($stock_arr) as $i) {
						$obj = $stockHandler->get($i);
					}
					$old_amount = $obj->getVar('stock_amount');
					$old_price = $obj->getVar('stock_price');
					$obj->setVar('stock_amount', $old_amount + $amount);
					if ($location != '') {
						$obj->setVar('stock_location', $location);
					}
					$obj->setVar('stock_type', $stocktype);
					//price
					$price = self::priceCalculation($price, $amount, $old_price, $old_amount);
					if ($price > 0) {
						$obj->setVar('stock_price', number_format($price, 2, '.', ''));
						$error_message .= self::setPrice($articleid, $ar_areaid, $amount, $price);
					}
					if ($error_message == '') {
						if ($stockHandler->insert($obj)) {
							return '';
						} else {
							return $obj->getHtmlErrors();
						}
					} else {
						return $error_message;
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
				$obj->setVar('stock_amount', $old_amount - $amount);
				if ($stockHandler->insert($obj)) {
					return '';
				} else {
					return $obj->getHtmlErrors();
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
				$st_amount = $obj->getVar('stock_amount');
				$st_price = $obj->getVar('stock_price');
				$st_stocktype = $obj->getVar('stock_type');

				// Get Permission to manage
				$managePermissionArea =  self::getPermissionArea('xmstock_manage');
				if (in_array($ar_areaid, $managePermissionArea)){
					$obj->setVar('stock_amount', $st_amount - $amount);
					if (!$stockHandler->insert($obj)) {
						return $obj->getHtmlErrors();
					}
					$criteria = new CriteriaCompo();
					$criteria->add(new Criteria('stock_areaid', $ar_areaid));
					$criteria->add(new Criteria('stock_articleid', $articleid));
					$stock_arr = $stockHandler->getall($criteria);
					if (count($stock_arr) == 0){
						$obj = $stockHandler->create();
						$obj->setVar('stock_areaid', $ar_areaid);
						$obj->setVar('stock_articleid', $articleid);
						$obj->setVar('stock_amount', $amount);
						$obj->setVar('stock_location', $location);
						$obj->setVar('stock_type', $st_stocktype);
						$obj->setVar('stock_price', $st_price);
						if ($stockHandler->insert($obj)) {
							self::setPrice($articleid, $ar_areaid, $amount, $st_price);
							return '';
						} else {
							return $obj->getHtmlErrors();
						}
					} else {
						foreach (array_keys($stock_arr) as $i) {
							$obj = $stockHandler->get($i);
						}
						$old_amount = $obj->getVar('stock_amount');
						$old_price = $obj->getVar('stock_price');
						$obj->setVar('stock_amount', $old_amount + $amount);
						//price
						$price = self::priceCalculation($st_price, $amount, $old_price, $old_amount);
						if ($price > 0) {
							$obj->setVar('stock_price', number_format($price, 2, '.', ''));
							$error_message .= self::setPrice($articleid, $ar_areaid, $amount, $price);
						}
						if ($stockHandler->insert($obj)) {
							return '';
						} else {
							return $obj->getHtmlErrors();
						}
					}
				}
				break;
		}
    }

	/**
     * Fonction qui calcul le prix d'un article
     * @param float    $price		prix
     * @param int      $amount		montant
     * @param float    $oldPrice	ancien prix
     * @param int      $oldAmount	ancien montant
     * @return int   				nouveau prix
     */
	public static function priceCalculation($price, $amount, $oldPrice, $oldAmount)
    {
		include __DIR__ . '/../include/common.php';
		$newPrice = 0;
		if ($helper->getConfig('general_price', 0) != 0) {
			if ($helper->getConfig('general_price', 0) == 1) {
				$newPrice = $price;
			} else {
				if ($oldPrice > 0 && $price > 0) {
					$newPrice = (($oldAmount * $oldPrice) + ($amount * $price))/($oldAmount + $amount);
				} else {
					if ($oldPrice > 0 && $price == 0) {
						$newPrice = $oldPrice;
					} else {
						$newPrice = $price;
					}
				}
			}
		} else {
			if ($oldPrice > 0 ) {
				$newPrice = $oldPrice;
			}
		}
		return $newPrice;
    }

	/**
     * Fonction qui enregistre les prix dans la table price
     * @param int      $articleid	Id de l'article
	 * @param int      $areaid		Id de l'area
     * @param int      $amount		montant
     * @param float    $price		prix
     * @return string   			Vide ou message d'erreur.
     */
	public static function setPrice($articleid, $areaid, $amount, $price)
    {
        include __DIR__ . '/../include/common.php';
		$obj = $priceHandler->create();
		$obj->setVar('price_articleid', $articleid);
		$obj->setVar('price_areaid', $areaid);
		$obj->setVar('price_amount', $amount);
		$obj->setVar('price_price', number_format($price, 2, '.', ''));
		$obj->setVar('price_date', time());
		if ($priceHandler->insert($obj)) {
			return '';
		} else {
			return $obj->getHtmlErrors();
		}
    }

	/**
     * Fonction qui retourne la liste des emprunteurs actifs par rapport à un stock et un article
     * @param int      $area_id 	Id du lieu de stockage
	 * @param int      $articleid	Id de l'article
     * @return array   $users		Liste des emprunteurs actifs
     */
	public static function getBorrowerPerArticle($area_id, $article_id)
    {
        include __DIR__ . '/../include/common.php';
		$users = array();
		// Criteria loan
        $criteria = new CriteriaCompo();
        $criteria->setSort('loan_date');
		$criteria->setOrder('DESC');
		$criteria->add(new Criteria('loan_status', 1));
		$criteria->add(new Criteria('loan_areaid', $area_id));
		$criteria->add(new Criteria('loan_articleid', $article_id));
		$loan_arr = $loanHandler->getall($criteria);
		if (count($loan_arr) > 0) {
			foreach (array_keys($loan_arr) as $i) {
				$users[] = XoopsUser::getUnameFromId($loan_arr[$i]->getVar('loan_userid'));
			}
		}
        return $users;
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
     * Fonction qui affiche le prix d'un article
     * @param float    $price		prix
     * @return string				prix mis en forme
     */
	public static function getPrice($price)
    {
        global $xoopsUser;
        $helper = Xmf\Module\Helper::getHelper('xmstock');
        $moduleHandler = $helper->getModule();
        $groups = is_object($xoopsUser) ? $xoopsUser->getGroups() : XOOPS_GROUP_ANONYMOUS;
        $gpermHandler = xoops_getHandler('groupperm');
		// Permission de voir le prix
        $perm_price = $gpermHandler->checkRight('xmstock_other', 4, $groups, $moduleHandler->getVar('mid')) ? true : false;
		if ($perm_price == true && $price != 0 && $helper->getConfig('general_price', 0) != 0) {
			return sprintf(_MA_XMSTOCK_RENDERSTOCKS_PRICE ,$price);
		} else {
			return '';
		}
    }

	/**
     * Fonction qui permet d'afficher les areas par rapport à un article
     * @param int      $articleid	Id de l'article
     */
	public static function renderStocks($article_id = 0)
    {
        global $xoTheme;
		global $xoopsTpl;
		include __DIR__ . '/../include/common.php';

        $xoTheme->addStylesheet( XOOPS_URL . '/modules/xmstock/assets/css/styles.css', null );

        $xmstockHelper = Xmf\Module\Helper::getHelper('xmstock');

        // Load language files
        $xmstockHelper->loadLanguage('main');

		// Get Permission to view
		$viewPermissionArea = self::getPermissionArea('xmstock_view');
		// Get Permission to order
		$orderPermissionArea = self::getPermissionArea('xmstock_order');
		// Get Permission to manage
		$managePermissionArea = XmstockUtility::getPermissionArea('xmstock_manage');

		$area = array();

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
				$stock['area_id']    	= $stock_arr[$i]->getVar('area_id');
                $stock['name']       	= $stock_arr[$i]->getVar('area_name');
                $stock['location']   	= $stock_arr[$i]->getVar('area_location');
                $stock['location_s'] 	= $stock_arr[$i]->getVar('stock_location');
				if ($stock_arr[$i]->getVar('stock_type') == 2) {
					$stock_type = true;
					$stock['amount']    = $stock_arr[$i]->getVar('stock_amount') . ' ' . _MA_XMSTOCK_CHECKOUT_UNIT;
				} else {
					$stock['amount']    = $stock_arr[$i]->getVar('stock_amount');
					$stock_type = false;
				}
				$stock['price']   	 	= self::getPrice($stock_arr[$i]->getVar('stock_price'));
				$stock['type']   	 	= $stock_arr[$i]->getVar('stock_type');
				if (in_array($stock['area_id'], $orderPermissionArea) == true){
					if ($stock['type'] == 3) {
						$stock['order'] = false;
						$stock['loan']  = true;
						$stock['borrower'] = implode(', ', self::getBorrowerPerArticle($stock['area_id'], $article_id));
					} else {
						$stock['order'] = true;
						$stock['loan'] 	= false;
						$stock['borrower'] = '';
					}
				} else {
					$stock['order'] 	= false;
					$stock['loan'] 		= false;
				}

				if (in_array($stock['area_id'], $managePermissionArea) == true){
					$stock['manage']  	= true;
				} else {
					$stock['manage']  	= false;
				}
				$total_amount += $stock['amount'];
                $xoopsTpl->appendByRef('stocks', $stock);
				$area[] = $stock['area_id'];
				unset($stock);
            }
			//self::addStocks($viewPermissionArea, $orderPermissionArea, $area);
			if ($stock_type == true) {
				$total_amount .= ' ' . _MA_XMSTOCK_CHECKOUT_UNIT;
			}
			$xoopsTpl->assign('total_amount', $total_amount);
            $xoopsTpl->assign('xmstock_viewstocks', true);
        } else {
			//self::addStocks($viewPermissionArea, $orderPermissionArea, $area);
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
     * Fonction qui donne le type de l'article dans le lieu de stockage défini
     * @param int      $area_id 	Id du lieu de stockage
	 * @param int      $articleid	Id de l'article
     * @param array    $stock_arr   Tableau des stocks
     * @return int     $type		type de l'article dans le lieu de stockage défini
     */
	public static function articleTypePerArea($area_id, $article_id, $stock_arr)
    {
        $type = 1;
        foreach (array_keys($stock_arr) as $i) {
            if ($stock_arr[$i]->getVar('stock_areaid') == $area_id && $stock_arr[$i]->getVar('stock_articleid') == $article_id) {
                $type = $stock_arr[$i]->getVar('stock_type');
            }
        }
        return $type;
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
     * Fonction qui donne qui retourne le type de stockage
     * @param int      $area_id 	Id du lieu de stockage
	 * @param int      $articleid	Id de l'article
     * @param array    $stock_arr   Tableau des stocks
     * @return int     $type		le type de stockage
     */
	public static function typeOfStock($area_id, $article_id, $stock_arr)
    {
        $type = 1;
        foreach (array_keys($stock_arr) as $i) {
            if ($stock_arr[$i]->getVar('stock_areaid') == $area_id && $stock_arr[$i]->getVar('stock_articleid') == $article_id) {
                $type = $stock_arr[$i]->getVar('stock_type');
            }
        }
        return $type;
    }

	/**
     * Fonction qui donne l'emplacement dans le stock
     * @param int      $area_id 	Id du lieu de stockage
	 * @param int      $articleid	Id de l'article
     * @param array    $stock_arr   Tableau des stocks
     * @return string  $location	Emplacement de l'article dans le stock
     */
	public static function getLocation($area_id, $article_id, $stock_arr)
    {
        $location = '';
        foreach (array_keys($stock_arr) as $i) {
            if ($stock_arr[$i]->getVar('stock_areaid') == $area_id && $stock_arr[$i]->getVar('stock_articleid') == $article_id) {
                $location = $stock_arr[$i]->getVar('stock_location');
            }
        }
        return $location;
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

	public static function getServerStats()
    {
        $moduleDirName      = basename(dirname(dirname(__DIR__)));
        $moduleDirNameUpper = mb_strtoupper($moduleDirName);
        xoops_loadLanguage('common', $moduleDirName);
        $html = '';
        $html .= "<fieldset><legend style='font-weight: bold; color: #900;'>" . _MA_XMSTOCK_INDEX_IMAGEINFO . "</legend>\n";
        $html .= "<div style='padding: 8px;'>\n";
        $html .= '<div>' . _MA_XMSTOCK_INDEX_SPHPINI . "</div>\n";
        $html .= "<ul>\n";
        $downloads = ini_get('file_uploads') ? '<span style="color: #008000;">' . _MA_XMSTOCK_INDEX_ON . '</span>' : '<span style="color: #ff0000;">' . _MA_XMNEWS_INDEX_OFF . '</span>';
        $html      .= '<li>' . _MA_XMSTOCK_INDEX_SERVERUPLOADSTATUS . $downloads;
        $html .= '<li>' . _MA_XMSTOCK_INDEX_MAXUPLOADSIZE . ' <b><span style="color: #0000ff;">' . ini_get('upload_max_filesize') . "</span></b>\n";
        $html .= '<li>' . _MA_XMSTOCK_INDEX_MAXPOSTSIZE . ' <b><span style="color: #0000ff;">' . ini_get('post_max_size') . "</span></b>\n";
        $html .= '<li>' . _MA_XMSTOCK_INDEX_MEMORYLIMIT . ' <b><span style="color: #0000ff;">' . ini_get('memory_limit') . "</span></b>\n";
        $html .= "</ul>\n";
        $html .= '</div>';
        $html .= '</fieldset><br>';

        return $html;
    }

	public static function returnBytes($val)
	{
		switch (mb_substr($val, -1)) {
			case 'K':
			case 'k':
				return (int)$val * 1024;
			case 'M':
			case 'm':
				return (int)$val * 1048576;
			case 'G':
			case 'g':
				return (int)$val * 1073741824;
			default:
				return $val;
		}
	}

	public static function generateDescriptionTagSafe($text, $wordCount = 100)
    {
		if (xoops_isActiveModule('xlanguage')){
			$text = XoopsModules\Xlanguage\Utility::cleanMultiLang($text);
		}
		$text = \Xmf\Metagen::generateDescription($text, $wordCount);
		return $text;
	}

	public static function TagSafe($text)
    {
		if (xoops_isActiveModule('xlanguage')){
			$text = XoopsModules\Xlanguage\Utility::cleanMultiLang($text);
		}
		return $text;
	}
}
