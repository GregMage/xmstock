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

use Xmf\Module\Admin;

require __DIR__ . '/admin_header.php';

$moduleAdmin = Admin::getInstance();
$moduleAdmin->displayNavigation('index.php');

$iniPostMaxSize = XmstockUtility::returnBytes(ini_get('post_max_size'));
$iniUploadMaxFileSize = XmstockUtility::returnBytes(ini_get('upload_max_filesize'));
if (min($iniPostMaxSize, $iniUploadMaxFileSize) < $helper->getConfig('general_maxuploadsize', 104858)) {
	echo '<div class="errorMsg" style="text-align: left;">' . _MA_XMSTOCK_ERROR_SIZE . '</div>';	
}

$moduleAdmin->addConfigModuleVersion('system', '2.1.2');
// xmarticle
if (xoops_isActiveModule('xmarticle')) {
    $moduleAdmin->addConfigModuleVersion('xmarticle', '1.0.0');
} else {
    $moduleAdmin->addConfigError(_MA_XMSTOCK_INDEXCONFIG_XMARTICLE_ERROR);
}
$folder[] = $path_logo_area;
foreach (array_keys( $folder) as $i) {
    $moduleAdmin->addConfigBoxLine($folder[$i], 'folder');
    $moduleAdmin->addConfigBoxLine(array($folder[$i], '777'), 'chmod');
}
$moduleAdmin->displayIndex();

echo XmstockUtility::getServerStats();

require __DIR__ . '/admin_footer.php';