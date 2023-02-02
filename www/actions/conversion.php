<?php 
require_once __DIR__ . '/../../src/init.php';

$a = $_POST['currency'];
$b = $_POST['currency-to'];

$c = $_POST['amount'];

$dbManager = new DbManager($db);

$user= $dbManager->getById($_SESSION['user_id'],'user');

// TODO mettre à jour la colonne value dans user



?>