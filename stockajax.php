<?php

// code marker
use Xmf\Jwt\TokenFactory;
use Xmf\Jwt\TokenReader;
use Xmf\Module\Helper;
use Xmf\Request;

if (isset($_GET['Authorization'])) {
	define('PROTECTOR_SKIP_DOS_CHECK', 1);
}

$path = dirname(dirname(__DIR__));
require_once $path . '/mainfile.php';

$GLOBALS['xoopsLogger']->activated = false;
error_reporting(E_ALL);

// claims we want to assert (verify)
$uid = (is_object($GLOBALS['xoopsUser'])) ? $GLOBALS['xoopsUser']->uid() : 0;
$claims = array('aud' => basename(__FILE__), 'uid' => $uid);
$claims = TokenReader::fromRequest('stock', 'Authorization', $assert);
if ($claims === false) {
    echo json_encode(array('error' => "Invalid request token"));
    exit;
}

include __DIR__ . '/include/common.php';
// Get Permission to manage
xoops_load('utility', 'xmstock');
$managePermissionArea = XmstockUtility::getPermissionArea('xmstock_manage');

$info['location'] = '';
$articleid = Request::getInt('articleid', 0);
$areaid = Request::getInt('areaid', 0);

if (in_array($areaid, $managePermissionArea) == true){
	$info['manage']  = true;
} else {
	$info['manage']  = false;
}

if ($articleid != 0 && $areaid != 0){
	$criteria = new CriteriaCompo();
	$criteria->add(new Criteria('stock_areaid', $areaid));
	$criteria->add(new Criteria('stock_articleid', $articleid));
	$stock_arr = $stockHandler->getall($criteria);
	if (count($stock_arr) > 0) {
		foreach (array_keys($stock_arr) as $i) {
			$info['location'] =  $stock_arr[$i]->getVar('stock_location');
		}
	}
}
echo json_encode($info, $jsonFlags);
exit;
