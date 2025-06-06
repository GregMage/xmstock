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
use Xmf\Request;
use Xmf\Module\Helper;

include_once __DIR__ . '/header.php';
$GLOBALS['xoopsOption']['template_main'] = 'xmstock_caddy.tpl';
include_once XOOPS_ROOT_PATH . '/header.php';

// Get Permission to order
$orderPermissionArea = XmstockUtility::getPermissionArea('xmstock_order');

if (empty($orderPermissionArea)) {
	redirect_header('index.php', 2, _NOPERM);
}

$session_name = 'caddy';
$sessionHelper = new Helper\Session();

$xoTheme->addStylesheet(XOOPS_URL . '/modules/' . $xoopsModule->getVar('dirname', 'n') . '/assets/css/styles.css', null);

$article_id = Request::getInt('article_id', 0);
$area_id = Request::getInt('area_id', 0);

$xoopsTpl->assign('index_module', $helper->getModule()->getVar('name'));

// ********************************************************************************************************************
// Liste le contenu du caddy
// ********************************************************************************************************************
function listCart($sessionHelper, $session_name, $article_id, $stockHandler)
{
	global $xoopsTpl;
	$helper = Helper::getHelper('xmstock');
	if ($article_id == 0){
		$return_url = XOOPS_URL . '/modules/xmarticle';
	} else {
		$helperArticle = Helper::getHelper('xmarticle');
		$articleHandler   = $helperArticle->getHandler('xmarticle_article');
		$article  = $articleHandler->get($article_id);
		if (isset($article)){
			$return_url = XOOPS_URL . '/modules/xmarticle/viewarticle.php?article_id=' . $article_id;
		} else {
			$return_url = XOOPS_URL . '/modules/xmarticle';
		}
	}
	$xoopsTpl->assign('return_url', $return_url);
	$arr_selectionArticles = $sessionHelper->get($session_name);
	$total = 0;
	if (xoops_isActiveModule('xmprod')){
		if ($helper->getConfig('general_xmprod', 0) == 1) {
			xoops_load('utility', 'xmprod');
			$year_arr = XmprodUtility::getNeedsYears();
		}
	}
	if (is_array($arr_selectionArticles) == true){
		// Get stock
		$criteria = new CriteriaCompo();
		$stock_arr = $stockHandler->getall($criteria);
		xoops_load('utility', 'xmarticle');
		$count = 1;
		$mml = false;
		$mm2 = false;
		$displayneedsyear = false;
		foreach ($arr_selectionArticles as $datas) {
			$articles['id']			= $datas['id'];
			$articles['area']		= XmstockUtility::getAreaName($datas['area'], false);
			$articles['areaid']		= $datas['area'];
			$articles['amount']		= XmstockUtility::articleAmountPerArea($datas['area'], $datas['id'], $stock_arr);
			$articles['name']		= XmarticleUtility::getArticleName($datas['id'], true);
			$articles['qty']		= $datas['qty'];
			$articles['length']		= $datas['length'];
			$articles['width']		= $datas['width'];
			$articles['needsyear']  = $datas['needsyear'];
			if (xoops_isActiveModule('xmprod')){
				if ($helper->getConfig('general_xmprod', 0) == 1) {
					if (XmprodUtility::articleNeeds($articles['id']) === true){
						$needsoptions = '';
						foreach (array_keys($year_arr) as $i) {
							if ($year_arr[$i] == $articles['needsyear']){
								$needsoptions .= '<option selected="selected">' . $year_arr[$i] . '</option>';
							} else {
								$needsoptions .= '<option>' . $year_arr[$i] . '</option>';
							}
						}
						$articles['needsoptions']  = $needsoptions;
						$articles['needsyear']  = '2024/2025';
						$displayneedsyear = true;
					}
				}
			}
			$type = XmstockUtility::articleTypePerArea($datas['area'], $datas['id'], $stock_arr);
			switch ($type) {
				case 1:
					$articles['unit'] = '';
					break;
				case 2:
					$articles['unit'] = _MA_XMSTOCK_STOCK_LENGHT;
					$mml = true;
					break;
				case 3:
					$articles['unit'] = _MA_XMSTOCK_STOCK_LOAN;
					break;

				case 5:
					$articles['unit'] = _MA_XMSTOCK_STOCK_WIDTH;
					$mm2 = true;
					$mml = true;
					break;
			}
			if ($type == 3){
				$articles['max']  = 'max="' . $articles['amount'] . '"';
			} else {
				$articles['max']  = '';
			}
			$articles['count']  = $count;
			$count++;
			$total += $datas['qty'];
			if ($type == 2){
				$articles['amount'] .= ' ' . _MA_XMSTOCK_CHECKOUT_UNIT;
			}
			if ($type == 5){
				$articles['amount'] .= ' ' . _MA_XMSTOCK_CHECKOUT_UNITS;
			}
			$xoopsTpl->appendByRef('articles', $articles);
			unset($articles);
		}
		$xoopsTpl->assign('mml', $mml);
		$xoopsTpl->assign('mm2', $mm2);
		$xoopsTpl->assign('total', $total);
		$xoopsTpl->assign('displayneedsyear', $displayneedsyear);
	} else {
		$xoopsTpl->assign('error_message', _MA_XMSTOCK_CADDY_ERROR_EMPTY);
	}
}

$op = Request::getCmd('op', 'list');
switch ($op) {
	// Add
	case 'add':
		// Vérification si l'area existe.
		if ($area_id == 0){
			redirect_header( XOOPS_URL . '/modules/xmarticle', 5, _MA_XMSTOCK_CADDY_ERROR_NOAREA);
		}
		$area  = $areaHandler->get($area_id);
		if (!isset($area)){
			redirect_header( XOOPS_URL . '/modules/xmarticle', 5, _MA_XMSTOCK_CADDY_ERROR_NOAREA);
		}
		if ($area->getVar('area_status') == 0){
			redirect_header( XOOPS_URL . '/modules/xmarticle', 5, _MA_XMSTOCK_CADDY_ERROR_NOAREA);
		}
		// Vérification si l'article existe.
		if ($article_id == 0){
			redirect_header( XOOPS_URL . '/modules/xmarticle', 5, _MA_XMSTOCK_CADDY_ERROR_NOARTICLE);
		}
		$helperArticle = Helper::getHelper('xmarticle');
		$articleHandler   = $helperArticle->getHandler('xmarticle_article');
		$article  = $articleHandler->get($article_id);
		if (!isset($article)){
			redirect_header( XOOPS_URL . '/modules/xmarticle', 5, _MA_XMSTOCK_CADDY_ERROR_NOARTICLE . ' A');
		}
		if ($article->getVar('article_status') == 0){
			redirect_header( XOOPS_URL . '/modules/xmarticle', 5, _MA_XMSTOCK_CADDY_ERROR_NOARTICLE . ' B');
		}
		$criteria = new CriteriaCompo();
		$stock_arr = $stockHandler->getall($criteria);
		// Vérification si l'article est un article à emprunter
		if (XmstockUtility::typeOfStock($area_id, $article_id, $stock_arr) == 3) {
			if (XmstockUtility::articleAmountPerArea($area_id, $article_id, $stock_arr) == 0) {
				redirect_header( XOOPS_URL . '/modules/xmarticle', 5, _MA_XMSTOCK_CADDY_ERROR_NOLOAN);
			}
        }

		// Vérification si l'article peut être commandé
		$criteria = new CriteriaCompo();
		$criteria->add(new Criteria('stock_areaid', $area_id));
		$criteria->add(new Criteria('stock_articleid', $article_id));
		$criteria->add(new Criteria('stock_order', 0));
		$stock_count = $stockHandler->getCount($criteria);
		if ($stock_count == 0) {
			redirect_header( XOOPS_URL . '/modules/xmarticle', 5, _MA_XMSTOCK_CADDY_ERROR_NOORDER);
		}

		//Vérification si l'article peut être commandé (permission order)
		$orderPermissionArea = XmstockUtility::getPermissionArea('xmstock_order');
		if (in_array($area_id, $orderPermissionArea) == false){
			redirect_header( XOOPS_URL . '/modules/xmarticle', 5, _MA_XMSTOCK_CADDY_ERROR_NOPERMISSION);
		}

		if ($sessionHelper->get($session_name) != false){
			$arr_selectionArticles = $sessionHelper->get($session_name);
		} else {
			$arr_selectionArticles = array();
		}
		$datasUpdate = array();
		$exists = false;
		$temp_areaid = 0;
		foreach ($arr_selectionArticles as $articles) {
			if ($articles['id'] == $article_id && $articles['area'] == $area_id) {
				$exists = true;
				$articles['qty'] += 1;
			}
			$temp_areaid = $articles['area'];
			$datasUpdate[] = $articles;
		}
		if ($exists === false) {
			// vérification que la commande concerne qu'un stock
			if ($temp_areaid == 0 || $area_id == $temp_areaid) {
				$datas         = array();
				$datas['id']   = $article_id;
				$datas['area'] = $area_id;
				$datas['qty']  = 1;
				$datas['length']  = 0;
				$datas['width']  = 0;
				$datas['needsyear']  = '';
				$arr_selectionArticles[] = $datas;
				$sessionHelper->set($session_name, $arr_selectionArticles);
			} else {
				xoops_load('utility', 'xmarticle');
				$xoopsTpl->assign('warning_message', _MA_XMSTOCK_CADDY_WARNING_AREA . '<br>' . XmarticleUtility::getArticleName($article_id));
			}
		} else {
			$sessionHelper->set($session_name, $datasUpdate);
		}
		listCart($sessionHelper, $session_name, $article_id, $stockHandler);
		break;

	// List: Liste des articles dans le caddy
	case 'list':
		listCart($sessionHelper, $session_name, $article_id, $stockHandler);
		break;

	// Update: recalcul les quantités des articles dans le caddy
	case 'update':
		$arr_selectionArticles = $sessionHelper->get($session_name);
		if (is_array($arr_selectionArticles) == true){
			$datasUpdate = $article = array();
			$count = 1;
			foreach ($arr_selectionArticles as $datas) {
				$name_qty = 'qty_' . $count;
				$name_length = 'length_' . $count;
				$name_width = 'width_' . $count;
				$name_area = 'area_' . $count;
				$name_needsyear = 'needsyear_' . $count;
				$qty = Request::getInt($name_qty, 0, 'POST');
				$length = Request::getFloat($name_length, 0, 'POST');
				$width = Request::getFloat($name_width, 0, 'POST');
				$area = Request::getInt($name_area, 0, 'POST');
				$needsyear = Request::getString($name_needsyear, '', 'POST');
				$article['id']   = $datas['id'];
				$article['area'] = $area;
				$article['qty']  = $qty;
				$article['length']  = $length;
				$article['width']  = $width;
				$article['needsyear']  = $needsyear;
				$datasUpdate[] = $article;
				$count++;
			}
			$sessionHelper->set($session_name, $datasUpdate);
		}
		listCart($sessionHelper, $session_name, $article_id, $stockHandler);
		break;

	// empty: Vide le panier
	case 'empty':
		$sessionHelper->del($session_name);
		listCart($sessionHelper, $session_name, $article_id, $stockHandler);
		break;

	// del: Supprime un article
	case 'del':
		if ($article_id != 0 && $area_id != 0){
			$arr_selectionArticles = $sessionHelper->get($session_name);
			if (is_array($arr_selectionArticles) == true){
				$datasUpdate = array();
				foreach ($arr_selectionArticles as $datas) {
					if (!($datas['id'] == $article_id && $datas['area'] == $area_id)){
						$datasUpdate[] = $datas;
					}
				}
				if (count($datasUpdate) > 0) {
					$sessionHelper->set($session_name, $datasUpdate);
				} else {
					$sessionHelper->del($session_name);
				}
			}
		}
		listCart($sessionHelper, $session_name, $article_id, $stockHandler);
		break;
}

//SEO
// pagetitle
$xoopsTpl->assign('xoops_pagetitle', _MA_XMSTOCK_CADDY . ' - ' . $xoopsModule->name());
include XOOPS_ROOT_PATH . '/footer.php';