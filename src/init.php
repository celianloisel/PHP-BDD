<?php
session_start();

require_once __DIR__ . '/config.php';
require_once __DIR__ . '/db.php';

require_once __DIR__ . '/class/DbObject.php';
require_once __DIR__ . '/class/ContactForm.php';
require_once __DIR__ . '/class/Users.php';
require_once __DIR__ . '/class/Deposits.php';

require_once __DIR__ . '/class/DbManager.php';

require_once __DIR__ . '/utils/errors.php';
require_once __DIR__ . '/utils/auth.php';

$dbManager = new DbManager($db);

$user_id = get_session_user();
$user = false;
if ($user_id !== false) {
	$user = get_user_by_id($user_id);
	$role=$dbManager->getById_basic('users', $_SESSION['user_id']);
	$admin=0;
	$manager=0;
	$verified=0;
	$unverified=0;
	$banned=0;
	if ($role['status']>200){$admin = $role['status'];}
	elseif ($role['status']>10) { $manager = $role['status'];}
	elseif ($role['status']>1) {$verified = $role['status']; }
	elseif ($role['status']>0) {$unverified = $role['status'];}
	elseif ($role['status']>(-1)) {$banned = $role['status'];}
}






