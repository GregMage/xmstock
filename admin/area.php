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
$moduleAdmin = Admin::getInstance();
$moduleAdmin->displayNavigation('area.php');

// Get Action type
$op = Request::getCmd('op', 'list');
switch ($op) {
    case 'list':
        // Define Stylesheet
        $xoTheme->addStylesheet(XOOPS_URL . '/modules/system/css/admin.css');
        $xoTheme->addScript('modules/system/js/admin.js');
        // Module admin
        $moduleAdmin->addItemButton(_MA_XMSTOCK_AREA_ADD, 'area.php?op=add', 'add');
        $xoopsTpl->assign('renderbutton', $moduleAdmin->renderButton());        
        // Get start pager
        $start = Request::getInt('start', 0);
        // Criteria
        $criteria = new CriteriaCompo();
        $criteria->setSort('area_weight ASC, area_name');
        $criteria->setOrder('ASC');
        $criteria->setStart($start);
        $criteria->setLimit($nb_limit);
        $area_arr = $areaHandler->getall($criteria);
        $area_count = $areaHandler->getCount($criteria);
        $xoopsTpl->assign('area_count', $area_count);
        if ($area_count > 0) {
            foreach (array_keys($area_arr) as $i) {
                $area_id                 = $area_arr[$i]->getVar('area_id');
                $area['id']              = $area_id;
                $area['name']            = $area_arr[$i]->getVar('area_name');
                $area['description']     = \Xmf\Metagen::generateDescription($area_arr[$i]->getVar('area_description', 'show'), 30);
				$area['location']            = $area_arr[$i]->getVar('area_location');
                $area['weight']          = $area_arr[$i]->getVar('area_weight');
                $area['status']          = $area_arr[$i]->getVar('area_status');
                $area_img                = $area_arr[$i]->getVar('area_logo') ?: 'blank.gif';
                $area['logo']            = '<img src="' . $url_logo_area .  $area_img . '" alt="' . $area_img . '" />';
                $xoopsTpl->append_by_ref('area', $area);
                unset($area);
            }
            // Display Page Navigation
            if ($area_count > $nb_limit) {
                $nav = new XoopsPageNav($area_count, $nb_limit, $start, 'start');
                $xoopsTpl->assign('nav_menu', $nav->renderNav(4));
            }
        } else {
            $xoopsTpl->assign('error_message', _MA_XMSTOCK_ERROR_NOAREA);
        }
        break;
    
    // Add
    case 'add':
        // Module admin
        $moduleAdmin->addItemButton(_MA_XMSTOCK_AREA_LIST, 'area.php', 'list');
        $xoopsTpl->assign('renderbutton', $moduleAdmin->renderButton());        
        // Form
        $obj  = $areaHandler->create();
        $form = $obj->getForm();
        $xoopsTpl->assign('form', $form->render());
        break;
        
    // Edit
    case 'edit':
        // Module admin
        $moduleAdmin->addItemButton(_MA_XMSTOCK_AREA_LIST, 'area.php', 'list');
        $xoopsTpl->assign('renderbutton', $moduleAdmin->renderButton());        
        // Form
        $area_id = Request::getInt('area_id', 0);
        if ($area_id == 0) {
            $xoopsTpl->assign('error_message', _MA_XMSTOCK_ERROR_NOAREA);
        } else {
            $obj = $areaHandler->get($area_id);
            $form = $obj->getForm();
            $xoopsTpl->assign('form', $form->render()); 
        }

        break;
    // Save
    case 'save':
        if (!$GLOBALS['xoopsSecurity']->check()) {
            redirect_header('area.php', 3, implode('<br />', $GLOBALS['xoopsSecurity']->getErrors()));
        }
        $area_id = Request::getInt('area_id', 0);
        if ($area_id == 0) {
            $obj = $areaHandler->create();            
        } else {
            $obj = $areaHandler->get($area_id);
        }
        $error_message = $obj->saveArea($areaHandler, 'area.php');
        if ($error_message != ''){
            $xoopsTpl->assign('error_message', $error_message);
            $form = $obj->getForm();
            $xoopsTpl->assign('form', $form->render());
        }
        
        break;
        
    // del
    case 'del':    
        $area_id = Request::getInt('area_id', 0);
        if ($area_id == 0) {
            $xoopsTpl->assign('error_message', _MA_XMSTOCK_ERROR_NOAREA);
        } else {
            $surdel = Request::getBool('surdel', false);
            $obj  = $areaHandler->get($area_id);
            if ($surdel === true) {
                if (!$GLOBALS['xoopsSecurity']->check()) {
                    redirect_header('area.php', 3, implode('<br />', $GLOBALS['xoopsSecurity']->getErrors()));
                }
                if ($areaHandler->delete($obj)) {
                    //Del logo
                    if ($obj->getVar('area_logo') != 'blank.gif') {
                        // Test if the image is used
                        $criteria = new CriteriaCompo();
                        $criteria->add(new Criteria('area_logo', $obj->getVar('area_logo')));
                        $area_count = $areaHandler->getCount($criteria);
                        if ($area_count == 0){
                            $urlfile = $path_logo_area . $obj->getVar('area_logo');
                            if (is_file($urlfile)) {
                                chmod($urlfile, 0777);
                                unlink($urlfile);
                            }
                        }
                    }
                    // Del permissions
                    $permHelper = new \Xmf\Module\Helper\Permission();
					$permHelper->deletePermissionForItem('xmstock_manage', $area_id);
                    $permHelper->deletePermissionForItem('xmstock_supervisor', $area_id);
                    $permHelper->deletePermissionForItem('xmstock_view', $area_id);
                    $permHelper->deletePermissionForItem('xmstock_request', $area_id);					
                    redirect_header('area.php', 2, _MA_XMSTOCK_REDIRECT_SAVE);
                } else {
                    $xoopsTpl->assign('error_message', $obj->getHtmlErrors());
                }
            } else {
                $area_img = $obj->getVar('area_logo') ?: 'blank.gif';
                xoops_confirm(array('surdel' => true, 'area_id' => $area_id, 'op' => 'del'), $_SERVER['REQUEST_URI'], 
                                    sprintf(_MA_XMSTOCK_AREA_SUREDEL, $obj->getVar('area_name')) . '<br>
                                    <img src="' . $url_logo_area . $area_img . '" title="' . 
                                    $obj->getVar('area_name') . '" />');
            }
        }
        
        break;
        
    // Update status
    case 'area_update_status':
        $area_id = Request::getInt('area_id', 0);
        if ($area_id > 0) {
            $obj = $areaHandler->get($area_id);
            $old = $obj->getVar('area_status');
            $obj->setVar('area_status', !$old);
            if ($areaHandler->insert($obj)) {
                exit;
            }
            $xoopsTpl->assign('error_message', $obj->getHtmlErrors());
        }
        break;
}

$xoopsTpl->display("db:xmstock_admin_area.tpl");

require __DIR__ . '/admin_footer.php';
