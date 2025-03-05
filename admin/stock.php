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
use Xmf\Module\Admin;
use Xmf\Request;

require __DIR__ . '/admin_header.php';
if (!xoops_isActiveModule('xmarticle')) {
	redirect_header('index.php', 5, _MA_XMSTOCK_INDEXCONFIG_XMARTICLE_ERROR);
}
$moduleAdmin = Admin::getInstance();
$moduleAdmin->displayNavigation('stock.php');

// Get Action type
$op = Request::getCmd('op', 'list');
switch ($op) {
    case 'list':
        // Define Stylesheet
        $xoTheme->addStylesheet(XOOPS_URL . '/modules/system/css/admin.css');
        // Module admin
        $xoopsTpl->assign('renderbutton', $moduleAdmin->renderButton());
        // Get start pager
        $start = Request::getInt('start', 0);
		$xoopsTpl->assign('start', $start);
		//filter area
		$article_area = Request::getInt('article_area', 0);
        $xoopsTpl->assign('article_area', $article_area);
        $criteria = new CriteriaCompo();
		$criteria->add(new Criteria('area_status', 1));
        $criteria->setSort('area_weight ASC, area_name');
        $criteria->setOrder('ASC');
        $area_arr = $areaHandler->getall($criteria);
		if (count($area_arr) > 0) {
			$article_area_options = '<option value="0"' . ($article_area == 0 ? ' selected="selected"' : '') . '>' . _ALL .'</option>';
			foreach (array_keys($area_arr) as $i) {
				$article_area_options .= '<option value="' . $i . '"' . ($article_area == $i ? ' selected="selected"' : '') . '>' . $area_arr[$i]->getVar('area_name') . '</option>';
			}
			$xoopsTpl->assign('article_area_options', $article_area_options);
		}
		$criteria = new CriteriaCompo();
		$sql = "SELECT o.*, l.* , k.* FROM " . $xoopsDB->prefix('xmstock_stock') . " AS o LEFT JOIN " . $xoopsDB->prefix('xmarticle_article') . " AS l ON o.stock_articleid = l.article_id";
		$sql .= " LEFT JOIN " . $xoopsDB->prefix('xmstock_area') . " AS k ON o.stock_areaid = k.area_id";
		if ($article_area != 0){
			$sql .= " WHERE (`area_id` = '" . $article_area . "')  ";
			$criteria->add(new Criteria('stock_areaid', $article_area));
		}
		$sql .= " ORDER BY area_name ASC LIMIT " . $start . ", " . $nb_limit;
		$stock_arr = $xoopsDB->query($sql);
		$stock_count = $stockHandler->getCount($criteria);
		$xoopsTpl->assign('stock_count', $stock_count);
		if ($stock_count > 0) {
			$xoopsTpl->assign('filter', true);
			while($myrow = $xoopsDB->fetchArray($stock_arr)){
					$stock_id               = $myrow['stock_id'];
					$stock['id']            = $stock_id;
					$stock['area']          = $myrow['area_name'];
					$stock['article']       = '<a href="../../xmarticle/viewarticle.php?article_id=' . $myrow['article_id'] . '" title="' . $myrow['article_name'] . '" target="_blank">' . $myrow['article_name'] . '</a> (' . $myrow['article_reference'] . ')';
					$stock['amount']        = $myrow['stock_amount'];
					$xoopsTpl->appendByRef('stocks', $stock);
					unset($stock);
			}
			// Display Page Navigation
            if ($stock_count > $nb_limit) {
                $nav = new XoopsPageNav($stock_count, $nb_limit, $start, 'start', 'article_area=' . $article_area);
                $xoopsTpl->assign('nav_menu', $nav->renderNav(4));
            }
		} else {
            $xoopsTpl->assign('error_message', _MA_XMSTOCK_ERROR_NOSTOCK);
        }
        break;
}

$xoopsTpl->display("db:xmstock_admin_stock.tpl");

require __DIR__ . '/admin_footer.php';
