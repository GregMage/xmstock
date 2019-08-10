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


// ********************************************************************************************************************
// Liste le contenu du caddy
// ********************************************************************************************************************
function listCart($sessionHelper, $session_name)
{
	\Xmf\Debug::dump($_SESSION);
	//$sessionHelper = new \Xmf\Module\Helper\Session();
	$arr_selectionArticles = $sessionHelper->get($session_name);
	foreach ($arr_selectionArticles as $datas) {
		echo $datas['id'] . ' - ' . $datas['qty'] . '<br>';
	}
}

$op = Request::getCmd('op', 'list');
switch ($op) {
	// Add
	case 'add':
		$article_id = Request::getInt('article_id', 0);
		//TODO: Vérifier que l'article existe dans xmstock		
		if ($sessionHelper->get($session_name) != false){
			$arr_selectionArticles = $sessionHelper->get($session_name);			
		} else {
			$arr_selectionArticles = array();
		}
		$datasUpdate = array();
		$exists = false;
		foreach ($arr_selectionArticles as $articles) {
			if ($articles['id'] == $article_id) {
				$exists = true;
				$articles['qty'] += 1;
			}
			$datasUpdate[] = $articles;				
		}
		if ($exists === false) {
			$datas        = array();
			$datas['id']  = $article_id;
			$datas['qty'] = 1;
			$arr_selectionArticles[] = $datas;
			$sessionHelper->set($session_name, $arr_selectionArticles);
		} else {
			$sessionHelper->set($session_name, $datasUpdate);
		}
		listCart($sessionHelper, $session_name);
		break;
		
	// List: Liste des articles dans le caddy
	case 'list':
		listCart($sessionHelper, $session_name);	
		break;

	// empty: Vide le panier
	case 'empty':
		$sessionHelper->del($session_name);
		listCart($sessionHelper, $session_name);	
		break;
	
	// del: Supprime un article
	case 'del':
		listCart($sessionHelper, $session_name);	
		break;
}


//SEO
// pagetitle
$xoopsTpl->assign('xoops_pagetitle', \Xmf\Metagen::generateSeoTitle('Caddy' . '-' . $xoopsModule->name()));
include XOOPS_ROOT_PATH . '/footer.php';