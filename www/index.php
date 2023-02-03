<?php
require_once __DIR__ . '/../src/init.php';

// ! if you made a new page, add his title here and in the arrays and in the navbar !!!
$pageTitles = [
    'login' => 'Login',
    'register' => 'Register',
    'home' => 'Home',
    'contact' => 'Contact Us',
    '404' => 'Error 404',
    'manage' => 'Manage Users',
    'recap' => 'My Account',
    'conversion' => 'Convert your money',
    'transactions' => 'History of your transactions'
];

// if we are not connected
$guest_pages = ['login', 'register']; // add new pages here

// if we are connected
$loggedin_pages = ['home', 'manage', 'recap', 'conversion', 'transactions']; // or here

// pages that everyone can see connected or not
$everyone_pages = []; // or here !

if (isset($_GET['name'])) {
    if ($user_id !== false && in_array($_GET['name'], $loggedin_pages)) {
        $pageName = $_GET["name"];
    } elseif ($user_id === false && in_array($_GET['name'], $guest_pages)) {
        $pageName = $_GET['name'];
    }
} else {
    if ($user_id === false) {
        $pageName = 'login';
    } else {
        $pageName = 'home';
    }
}

$page_title = $pageTitles[$pageName];
?>

<html lang="fr">

<?php require_once __DIR__ . '/../src/partials/head.php'; ?>

<body>
<!-- navbar -->
<?php require_once __DIR__ . '/../src/partials/navbar.php'; ?>
<?php
$errors = get_errors();
if ($errors !== false) {
    echo '<p>' . $errors . '</p>';
}
?>
<!-- page content -->
<?php require_once __DIR__ . '/../src/pages/' . $pageName . '.php'; ?>

<!-- footer -->
<?php require_once __DIR__ . '/../src/partials/footer.php'; ?>
<?php if ($pageName == 'conversion') { ?>
    <script>
        <?php
        require_once __DIR__ . "/../src/assets/js/conversion.js";
        ?>
    </script>
<?php } ?>
</body>

</html>