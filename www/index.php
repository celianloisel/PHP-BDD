<?php
require_once __DIR__ . '/../src/init.php';

// ! if you made a new page, add his title here and in the arrays !!!
$pageTitles = [
    'login' => 'Login',
    'register' => 'Register',
    'home' => 'Home',
    'contact' => 'Contact Us',
    '404' => 'Error 404'
];

// if we are not connected
$guest_pages = ['login', 'register']; // add new pages here

// if we are connected
$loggedin_pages = ['home']; // or here

// pages that everyone can see connected or not
$everyone_pages = []; // or here !

if (isset($_GET['name'])) {
    if ($user_id === false && $_GET['name'] == 'login') {
        $pageName = 'login';
    } elseif ($user_id === false && $_GET['name'] == 'register') {
        $pageName = 'register';
    } elseif ($user_id !== false  && in_array($_GET['name'], $loggedin_pages)) {
        $pageName = $_GET["name"];
    } elseif ($user_id === false && in_array($_GET['name'], $guest_pages)) {
        $pageName = $_GET['name'];
    }
}

$page_title = $pageTitles[$pageName];

// ! WARNING only the HTML header not the header of the body ! */
require_once __DIR__ . '/../src/partials/header.php'; ?>

<body>
    <!-- navbar -->
    <?php require_once __DIR__ . '/../src/partials/navbar.php'; ?>

    <!-- page content -->
    <?php require_once __DIR__ . '/../src/pages/' . $pageName . '.php'; ?>

    <!-- footer -->
    <?php require_once __DIR__ . '/../src/partials/footer.php'; ?>
</body>

</html>