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
		$stock_count = $stockHandler->getCount();
		$sql = "SELECT o.*, l.* , k.* FROM " . $xoopsDB->prefix('xmstock_stock') . " AS o LEFT JOIN " . $xoopsDB->prefix('xmarticle_article') . " AS l ON o.stock_articleid = l.article_id";
		$sql .= " LEFT JOIN " . $xoopsDB->prefix('xmstock_area') . " AS k ON o.stock_areaid = k.area_id";
		$sql .= " ORDER BY area_name ASC LIMIT " . $start . ", " . $nb_limit;
		$xoopsTpl->assign('stock_count', $stock_count);
		$stock_arr = $xoopsDB->query($sql);
		if ($stock_count > 0) {
			while($myrow = $xoopsDB->fetchArray($stock_arr)){
					$stock_id               = $myrow['stock_id'];
					$stock['id']            = $stock_id;
					$stock['area']          = $myrow['area_name'];
					$stock['article']       = '<a href="../../xmarticle/viewarticle.php?category_id=' . $myrow['article_cid'] . '&article_id=' . $myrow['article_id'] . '" title="' . $myrow['article_name'] . '" target="_blank">' . $myrow['article_name'] . '</a> (' . $myrow['article_reference'] . ')';
					$stock['amount']        = $myrow['stock_amount'];
					$xoopsTpl->append_by_ref('stock', $stock);
					unset($stock);
			}
			// Display Page Navigation
            if ($stock_count > $nb_limit) {
                $nav = new XoopsPageNav($stock_count, $nb_limit, $start, 'start');
                $xoopsTpl->assign('nav_menu', $nav->renderNav(4));
            }
		} else {
            $xoopsTpl->assign('error_message', _MA_XMSTOCK_ERROR_NOSTOCK);
        }
        break;
}

$xoopsTpl->display("db:xmstock_admin_stock.tpl");

require __DIR__ . '/admin_footer.php';
