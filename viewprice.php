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
use Xmf\Module\Helper;

include_once __DIR__ . '/header.php';
$GLOBALS['xoopsOption']['template_main'] = 'xmstock_viewprice.tpl';
include_once XOOPS_ROOT_PATH . '/header.php';

$xoTheme->addStylesheet(XOOPS_URL . '/modules/' . $xoopsModule->getVar('dirname', 'n') . '/assets/css/styles.css', null);
$xoTheme->addScript('modules/xmstock/assets/js/chart.min.js');
$xoTheme->addScript('modules/xmstock/assets/js/FileSaver.js');
$xoTheme->addScript('modules/xmstock/assets/js/price.js');


$area_id = Request::getInt('area_id', 0);
$article_id = Request::getInt('article_id', 0);

$xoopsTpl->assign('index_module', $helper->getModule()->getVar('name'));

if ($area_id == 0) {
    redirect_header('index.php', 2, _MA_XMSTOCK_ERROR_NOAREA);
}
if ($article_id == 0) {
    redirect_header('index.php', 2, _MA_XMSTOCK_ERROR_NOARTICLE);
}
// permission to view
$permHelper->checkPermissionRedirect('xmstock_other', 4, 'index.php', 2, _NOPERM);

//Article
xoops_load('utility', 'xmarticle');
$xoopsTpl->assign('article_name', XmarticleUtility::getArticleName($article_id));
$xoopsTpl->assign('file_name', 'Price-' . XmarticleUtility::getArticleName($article_id, false, false));


// Get start pager
$start = Request::getInt('start', 0);

// Criteria
$criteria = new CriteriaCompo();
$criteria->setSort('price_date');
$criteria->setStart($start);
$criteria->setLimit($nb_limit);
$criteria->add(new Criteria('price_areaid', $area_id));
$criteria->add(new Criteria('price_articleid', $article_id));
$criteria->setOrder('ASC');
$price_graph = $priceHandler->getall($criteria);
$criteria->setOrder('DESC');
$price_arr = $priceHandler->getall($criteria);
$price_count = $priceHandler->getCount($criteria);
if ($price_count > 0) {
	foreach (array_keys($price_arr) as $i) {
		$price['date']   = formatTimestamp($price_arr[$i]->getVar('price_date'), 's');
		$price['amount'] = $price_arr[$i]->getVar('price_amount');
		$price['price']  = $price_arr[$i]->getVar('price_price');
		$xoopsTpl->append_by_ref('prices', $price);
        unset($price);
    }
	foreach (array_keys($price_graph) as $i) {
		$price_graph['price']  = $price_arr[$i]->getVar('price_price');
		$price_graph['date']   = formatTimestamp($price_arr[$i]->getVar('price_date'), 's');
		$xoopsTpl->append_by_ref('price_graph', $price_graph);
        unset($price_graph);
	}
    // Display Page Navigation
    if ($price_count > $nb_limit) {
        $nav = new XoopsPageNav($price_count, $nb_limit, $start, 'start');
        $xoopsTpl->assign('nav_menu', $nav->renderNav(4));
    }
} else {
	redirect_header('index.php', 2, _MA_XMSTOCK_ERROR_NOPRICE);
}



//SEO
// pagetitle
//$xoopsTpl->assign('xoops_pagetitle', $area->getVar('area_name') . '-' . $xoopsModule->name());
//description
//$xoTheme->addMeta('meta', 'description', \Xmf\Metagen::generateDescription('A faire!!!!!!!!!!!!', 30));
include XOOPS_ROOT_PATH . '/footer.php';
