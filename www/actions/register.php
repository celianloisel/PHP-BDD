<?php

require_once __DIR__ . '/../../src/init.php';

if (!isset($_POST['email'], $_POST['pseudo'], $_POST['password'], $_POST['cpassword'])) {
	set_errors('Pas de formulaire recu', '?name=register');
}

if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) === false) {
	set_errors('Email invalide', '?name=register');
}

if (empty($_POST['firstname']) || strlen($_POST['firstname']) > 100) {
	set_errors('Fullname invalide', '?name=register');
}

if (empty($_POST['lastname']) || strlen($_POST['lastname']) > 100) {
	set_errors('Fullname invalide', '?name=register');
}

if (empty($_POST['password']) || ($_POST['password'] !== $_POST['cpassword'])) {
	set_errors('Message invalide', '?name=register');
}

$_POST['pseudo'] = htmlentities($_POST['pseudo'],  ENT_QUOTES | ENT_SUBSTITUTE | ENT_HTML5);
$_POST['password'] = hash('sha256', $_POST['password']);

unset($_POST['cpassword']);

$current_date = date('d-m-y');

// TODO setup with dbmanager
$query = $db->prepare('INSERT INTO users (firstname, lastname, email, password, status, register_date) VALUES(:firstname, :lastname, :email, :password, 1, $current_date)');
$query->execute($_POST);

$_SESSION['user_id'] = $db->lastInsertId();

header('Location: ?name=login');