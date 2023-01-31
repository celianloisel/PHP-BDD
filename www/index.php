<?php
require_once __DIR__ . '/../src/init.php';

$pageTitles = [
	'login' => 'Login',
	'register' => 'Register',
	'home' => 'Home',
	'contact' => 'Contact Us'
];

$guest_pages = ['login', 'register'];
$loggedin_pages = ['home'];

if ($user_id === false) {
	$pageName = 'login';
}
else{
	$pageName = 'home';
}

if ($user_id !== false && in_array($_GET['name'], $loggedin_pages)) {
	$pageName = $_GET["name"];
}
elseif ($user_id === false && in_array($_GET['name'], $guest_pages)) {
	$pageName = $_GET['name'];
}
else{
    $pageName = '404';
}

$page_title = $pageTitles[$pageName];

require_once __DIR__ . '/../src/partials/header.php'; ?>
<body>
    <!-- page content -->
    <?php require_once __DIR__ . '/../src/pages/' . $pageName . '.php'; ?>

    <!-- footer -->
    <?php require_once __DIR__ . '/../src/partials/footer.php'; ?>
</body>
</html>