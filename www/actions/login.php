<?php

require_once __DIR__ . '/../../src/init.php';

if (!isset($_POST['email'], $_POST['password'])) {
	set_errors('Pas de formulaire recu', '/index.php?name=login');
}

if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) === false) {
	set_errors('Email invalide', '/index.php?name=login');
}

$password = hash('sha256', $_POST['password']);

// DEBUG
// var_dump($_POST);
// die();

$query = $db->prepare('SELECT * FROM users WHERE email = ?');
$query->execute([$_POST['email']]);
$query->setFetchMode(PDO::FETCH_ASSOC);
$user = $query->fetch();


if ($user['password'] !== $password) {
	set_errors('Mauvais mot de passe', '/index.php?name=login');
}else{
    $_SESSION['user_id'] = $user['id'];
    header('Location: /index.php?name=home');
}

