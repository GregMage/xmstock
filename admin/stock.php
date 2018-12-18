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
        $moduleAdmin->addItemButton(_MA_XMSTOCK_STOCK_ADD, 'stock.php?op=add', 'add');
        $xoopsTpl->assign('renderbutton', $moduleAdmin->renderButton());        
        // Get start pager
        $start = Request::getInt('start', 0);
        // Criteria
        $criteria = new CriteriaCompo();
        $criteria->setSort('output_weight ASC, output_name');
        $criteria->setOrder('ASC');
        $criteria->setStart($start);
        $criteria->setLimit($nb_limit);
        $output_arr = $outputHandler->getall($criteria);
        $output_count = $outputHandler->getCount($criteria);
        $xoopsTpl->assign('output_count', $output_count);
        if ($output_count > 0) {
            foreach (array_keys($output_arr) as $i) {
                $output_id               = $output_arr[$i]->getVar('output_id');
                $output['id']            = $output_id;
                $output['name']          = $output_arr[$i]->getVar('output_name');
                $output['description']   = \Xmf\Metagen::generateDescription($output_arr[$i]->getVar('output_description', 'show'), 30);
				$output['receiver']      = XoopsUser::getUnameFromId($output_arr[$i]->getVar('output_userid'));
                $output['weight']        = $output_arr[$i]->getVar('output_weight');
                $output['status']        = $output_arr[$i]->getVar('output_status');
                $xoopsTpl->append_by_ref('output', $output);
                unset($area);
            }
            // Display Page Navigation
            if ($output_count > $nb_limit) {
                $nav = new XoopsPageNav($output_count, $nb_limit, $start, 'start');
                $xoopsTpl->assign('nav_menu', $nav->renderNav(4));
            }
        } else {
            $xoopsTpl->assign('error_message', _MA_XMSTOCK_ERROR_NOSTOCK);
        }
        break;
    
    // Add
    case 'add':
        // Module admin
        $moduleAdmin->addItemButton(_MA_XMSTOCK_STOCK_LIST, 'stock.php', 'list');
        $xoopsTpl->assign('renderbutton', $moduleAdmin->renderButton());        
        // Form
        $obj  = $stockHandler->create();
        $form = $obj->getForm();
        $xoopsTpl->assign('form', $form->render());
        break;
        
    // Edit
    case 'edit':
        // Module admin
        $moduleAdmin->addItemButton(_MA_XMSTOCK_STOCK_LIST, 'stock.php', 'list');
        $xoopsTpl->assign('renderbutton', $moduleAdmin->renderButton());        
        // Form
        $stock_id = Request::getInt('stock_id', 0);
        if ($stock_id == 0) {
            $xoopsTpl->assign('error_message', _MA_XMSTOCK_ERROR_NOSTOCK);
        } else {
            $obj = $stockHandler->get($stock_id);
            $form = $obj->getForm();
            $xoopsTpl->assign('form', $form->render()); 
        }

        break;
    // Save
    case 'save':
        if (!$GLOBALS['xoopsSecurity']->check()) {
            redirect_header('stock.php', 3, implode('<br />', $GLOBALS['xoopsSecurity']->getErrors()));
        }
        $stock_id = Request::getInt('stock_id', 0);
        if ($stock_id == 0) {
            $obj = $stockHandler->create();            
        } else {
            $obj = $stockHandler->get($stock_id);
        }
        $error_message = $obj->savestock($stockHandler, 'stock.php');
        if ($error_message != ''){
            $xoopsTpl->assign('error_message', $error_message);
            $form = $obj->getForm();
            $xoopsTpl->assign('form', $form->render());
        }
        
        break;
        
    // del
    case 'del':    
        
        break;
}

$xoopsTpl->display("db:xmstock_admin_stock.tpl");

require __DIR__ . '/admin_footer.php';
