<?php

require_once __DIR__ . '/../../src/init.php';

if (!isset($_POST['email'], $_POST['firstname'], $_POST['lastname'] , $_POST['password'], $_POST['cpassword'])) {
	set_errors('Pas de formulaire recu', '/index.php?name=register');
}

if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) === false) {
	set_errors('Email invalide', '/index.php?name=register');
}

if (empty($_POST['firstname']) || strlen($_POST['firstname']) > 100) {
	set_errors('Fullname invalide', '/index.php?name=register');
}

if (empty($_POST['lastname']) || strlen($_POST['lastname']) > 100) {
	set_errors('Fullname invalide', '/index.php?name=register');
}

if (empty($_POST['password']) || ($_POST['password'] !== $_POST['cpassword'])) {
	set_errors('Message invalide', '/index.php?name=register');
}

$_POST['password'] = hash('sha256', $_POST['password']);

unset($_POST['cpassword']);

$current_date = date('d-m-y');

// TODO setup with dbmanager
$query = $db->prepare("INSERT INTO users (firstname, lastname, email, password, status, register_date, login_date) VALUES(" ."'" .$_POST['firstname'] ."','" . $_POST['lastname'] ."','" . $_POST['email'] ."','" .  $_POST['password'] ."','" . 1   ."','" . $current_date ."','" . $current_date . "')");
$query->execute();

/* $_SESSION['user_id'] = $db->lastInsertId(); */

header('Location: /index.php?name=login');