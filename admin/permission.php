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
include_once XOOPS_ROOT_PATH.'/class/xoopsform/grouppermform.php';
$moduleAdmin = Admin::getInstance();
$moduleAdmin->displayNavigation('permission.php');

// Get permission
$permission = Request::getInt('permission', 1);

// area
$criteria = new CriteriaCompo();
$area_arr = $areaHandler->getall($criteria);
if (count($area_arr) > 0) {
    $tab_perm = array(1 => _MA_XMSTOCK_PERMISSION_MANAGE, 2 => _MA_XMSTOCK_PERMISSION_VIEW, 3 => _MA_XMSTOCK_PERMISSION_ORDER, 4 => _MA_XMSTOCK_PERMISSION_OTHER);
} else {
    $tab_perm = [4 => _MA_XMSTOCK_PERMISSION_OTHER];
    $permission = 4;
}
if (isset($tab_perm)){
    $permission_options = '';
    foreach (array_keys($tab_perm) as $i) {
        $permission_options .= '<option value="' . $i . '"' . ($permission == $i ? ' selected="selected"' : '') . '>' . $tab_perm[$i] . '</option>';
    }
    $xoopsTpl->assign('permission_options', $permission_options);

    switch ($permission) {
        case 1:    // manage permission
            $formTitle = _MA_XMSTOCK_PERMISSION_MANAGE;
            $permissionName = 'xmstock_manage';
            $permissionDescription = _MA_XMSTOCK_PERMISSION_MANAGE_DSC;
            foreach (array_keys($area_arr) as $i) {
                $global_perms_array[$i] = $area_arr[$i]->getVar('area_name');
            }
            break;

		case 2:    // view permission
            $formTitle = _MA_XMSTOCK_PERMISSION_VIEW;
            $permissionName = 'xmstock_view';
            $permissionDescription = _MA_XMSTOCK_PERMISSION_VIEW_DSC;
            foreach (array_keys($area_arr) as $i) {
                $global_perms_array[$i] = $area_arr[$i]->getVar('area_name');
            }
            break;

        case 3:    // request permission
            $formTitle = _MA_XMSTOCK_PERMISSION_ORDER;
            $permissionName = 'xmstock_order';
            $permissionDescription = _MA_XMSTOCK_PERMISSION_ORDER_DSC;
            foreach (array_keys($area_arr) as $i) {
                $global_perms_array[$i] = $area_arr[$i]->getVar('area_name');
            }
            break;

		case 4:    // Other permission
			$formTitle = _MA_XMSTOCK_PERMISSION_OTHER;
			$permissionName = 'xmstock_other';
			$permissionDescription = _MA_XMSTOCK_PERMISSION_OTHER_DSC;
			$global_perms_array    = [
				'4' => _MA_XMSTOCK_PERMISSION_OTHER_4 ,
				'8' => _MA_XMSTOCK_PERMISSION_OTHER_8
			];
			break;
    }
    $permissionsForm = new XoopsGroupPermForm($formTitle, $helper->getModule()->getVar('mid'), $permissionName, $permissionDescription, 'admin/permission.php?permission=' . $permission);
    foreach ($global_perms_array as $perm_id => $permissionName) {
        $permissionsForm->addItem($perm_id , $permissionName) ;
    }
    $xoopsTpl->assign('form', $permissionsForm->render());
} else {
    $xoopsTpl->assign('error_message', _MA_XMDOC_ERROR_PERMISSION);
}
$xoopsTpl->display("db:xmdoc_admin_permission.tpl");

require __DIR__ . '/admin_footer.php';
