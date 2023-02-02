<?php

require_once __DIR__ . '/../../src/init.php';

$errors = get_errors();

if (!isset($_POST['email'], $_POST['firstname'], $_POST['lastname'], $_POST['password'], $_POST['cpassword'])) {
	set_errors('Pas de formulaire recu', '/index.php?name=register');
}

if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) === false) {
	set_errors('Email invalide', '/index.php?name=register');
}

if (empty($_POST['firstname']) || strlen($_POST['firstname']) > 100) {
	set_errors('firstanme invalide', '/index.php?name=register');
}

if (!preg_match('`[0-9]{10}`',$_POST['number_phone'])) {
	set_errors('numéro de téléphone invalide', '/index.php?name=register');
}
if (empty($_POST['password']) || ($_POST['password'] !== $_POST['cpassword'])) {
	set_errors('Mot de passe invalide ou les 2 mots de passes ne correspondent pas', '/index.php?name=register');
}

if (empty($_POST['password']) || ($_POST['password'] !== $_POST['cpassword'])) {
	set_errors('Mot de passe invalide ou les 2 mots de passes ne correspondent pas', '/index.php?name=register');
}
$query = $db->prepare('SELECT * FROM users WHERE email = ?');
$query->execute([$_POST['email']]);
$query->setFetchMode(PDO::FETCH_ASSOC);
$user = $query->fetch();

if($user !== false){
	set_errors('Mail déjà existant', '/index.php?name=register');
}

unset($_POST['cpassword']);

$current_date = date('d-m-y');

// TODO setup with dbmanager
/* $query = $db->prepare("INSERT INTO users (firstname, lastname, email, password, status) VALUES(" ."'" .$_POST['firstname'] ."','" . $_POST['lastname'] ."','" . $_POST['email'] ."','" .  $_POST['password'] ."','" . 1   ."')");
$query->execute(); */

$dbmanager = new DbManager($db);

$newUser = new Users();
$newUser->setFirstname($_POST['firstname']);
$newUser->setLastname($_POST['lastname']);
$newUser->setEmail($_POST['email']);
$newUser->setNumber_phone($_POST['number_phone']);
$newUser->setPassword($_POST['password']);
$newUser->setStatus(1);

$dbmanager->insert($newUser);

header('Location: /index.php?name=login');