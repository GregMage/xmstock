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
use \Xmf\Request;

include_once __DIR__ . '/header.php';
$GLOBALS['xoopsOption']['template_main'] = 'xmstock_caddy.tpl';
include_once XOOPS_ROOT_PATH . '/header.php';

$session_name = 'caddy';
$sessionHelper = new \Xmf\Module\Helper\Session();

$xoTheme->addStylesheet(XOOPS_URL . '/modules/' . $xoopsModule->getVar('dirname', 'n') . '/assets/css/styles.css', null);

$article_id = Request::getInt('article_id', 0);
$area_id = Request::getInt('area_id', 0);


// ********************************************************************************************************************
// Liste le contenu du caddy
// ********************************************************************************************************************
function listCart($sessionHelper, $session_name, $article_id = 0, $stockHandler)
{
	global $xoopsTpl;
	if ($article_id == 0){
		$return_url = XOOPS_URL . '/modules/xmarticle';
	} else {
		$helper = Xmf\Module\Helper::getHelper('xmarticle');
		$articleHandler   = $helper->getHandler('xmarticle_article');
		$article  = $articleHandler->get($article_id);
		if (isset($article)){
			$return_url = XOOPS_URL . '/modules/xmarticle/viewarticle.php?category_id=' . $article->getVar('article_cid') . '&article_id=' . $article_id;
		} else {
			$return_url = XOOPS_URL . '/modules/xmarticle';
		}
	}
	$xoopsTpl->assign('return_url', $return_url);
	$arr_selectionArticles = $sessionHelper->get($session_name);
	$total = 0;
	if (is_array($arr_selectionArticles) == true){
		// Get stock
		$criteria = new CriteriaCompo();
		$stock_arr = $stockHandler->getall($criteria);
		xoops_load('utility', 'xmarticle');
		$count = 1;
		foreach ($arr_selectionArticles as $datas) {
			$articles['id']    	= $datas['id'];
			$articles['area']  	= XmstockUtility::getAreaName($datas['area'], false);
			$articles['areaid'] = $datas['area'];
			$articles['amount'] = XmstockUtility::articleAmountPerArea($datas['area'], $datas['id'], $stock_arr);
			$articles['name']  	= XmarticleUtility::getArticleName($datas['id']);
			$articles['qty']   	= $datas['qty'];
			$articles['count']  = $count;
			$count++;
			$total += $datas['qty'];
			$xoopsTpl->append_by_ref('articles', $articles);
			unset($articles);
		}
		$xoopsTpl->assign('total', $total);
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
		$helper = Xmf\Module\Helper::getHelper('xmarticle');
		$articleHandler   = $helper->getHandler('xmarticle_article');
		$article  = $articleHandler->get($article_id);
		if (!isset($article)){
			redirect_header( XOOPS_URL . '/modules/xmarticle', 5, _MA_XMSTOCK_CADDY_ERROR_NOARTICLE);
		}
		if ($article->getVar('article_status') == 0){
			redirect_header( XOOPS_URL . '/modules/xmarticle', 5, _MA_XMSTOCK_CADDY_ERROR_NOARTICLE);
		}	
		//Vérification que l'article existe dans le lieu de stockage
		$criteria = new CriteriaCompo();
		$stock_arr = $stockHandler->getall($criteria);
		if (XmstockUtility::articleAmountPerArea($area_id, $article_id, $stock_arr) == 0){
			redirect_header( XOOPS_URL . '/modules/xmarticle', 5, _MA_XMSTOCK_CADDY_ERROR_NOARTICLE);
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
		foreach ($arr_selectionArticles as $articles) {
			if ($articles['id'] == $article_id && $articles['area'] == $area_id) {
				$exists = true;
				$articles['qty'] += 1;
			}
			$datasUpdate[] = $articles;				
		}
		if ($exists === false) {
			$datas         = array();
			$datas['id']   = $article_id;
			$datas['area'] = $area_id;
			$datas['qty']  = 1;
			$arr_selectionArticles[] = $datas;
			$sessionHelper->set($session_name, $arr_selectionArticles);
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
				$name_area = 'area_' . $count;
				$qty = \Xmf\Request::getInt($name_qty, 0, 'POST');
				$area = \Xmf\Request::getInt($name_area, 0, 'POST');
				$article['id']   = $datas['id'];
				$article['area'] = $area;
				$article['qty']  = $qty;					
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