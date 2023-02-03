<?php
require_once __DIR__ . '/../../src/init.php';

$u = $_SESSION['user_id'];

$a = $_POST['currency'];
$fin = $_POST['currencyfin'];

$c = $_POST['amount'];

$dbManager = new DbManager($db);

/* $user= $dbManager->getById($_SESSION['user_id'],'user'); */

// TODO mettre à jour la colonne value dans user


$dbmanager = new DbManager($db);
$to = $dbmanager->getWhere("currencies", "id", $a);
$tofin = $dbmanager->getWhere("currencies", "id", $fin);

$results = $_POST['amount'] / $to['taux'] * $tofin['taux'];

$bankaccountvalue = $dbmanager->getWhere("bankaccounts", "user_id", $_SESSION['user_id']);

$createaccountarray = explode(";", $bankaccountvalue["value"]);
$accountarray = array();
$accountstring = "";

foreach ($createaccountarray as $v) {
    $tmp = explode(':', $v);
    if (!$tmp[0]) {
        $accountarray = null;
    } else {
        $accountarray[$tmp[0]] = $tmp[1];
    }
}

if ($accountarray == null) {
    $accountarray[$_POST['currency']] = $c * -1;
    $accountstring = implode(';', array_map(
        function ($v, $k) {
            return sprintf("%s:%s", $k, $v);
        },
        $accountarray,
        array_keys($accountarray)
    ));
} else {
    if (array_key_exists($_POST['currency'], $accountarray)) {
        $accountarray[$_POST['currency']] -= $c;
    } else {
        $accountarray[$_POST['currency']] = $c * -1;
    }
    $accountstring = implode(';', array_map(
        function ($v, $k) {
            return sprintf("%s:%s", $k, $v);
        },
        $accountarray,
        array_keys($accountarray)
    ));
}

$transaction = new Transactions();
$transaction->user_id = $_SESSION['user_id'];
$transaction->value = $c * -1;
$transaction->currencies_id = $_POST['currency'];
$transaction->type = "retrait";
$dbmanager->insert($transaction);

$bankaccount = new Bankaccounts();
$bankaccount->id = $bankaccountvalue['id'];
$bankaccount->user_id = $_SESSION['user_id'];
$bankaccount->value = $accountstring;
$dbmanager->update($bankaccount);


$bankaccountvalue = $dbmanager->getWhere("bankaccounts", "user_id", $_SESSION['user_id']);

$createaccountarray = explode(";", $bankaccountvalue["value"]);
$accountarray = array();
$accountstring = "";

foreach ($createaccountarray as $v) {
    $tmp = explode(':', $v);
    if (!$tmp[0]) {
        $accountarray = null;
    } else {
        $accountarray[$tmp[0]] = $tmp[1];
    }
}

if ($accountarray == null) {
    $accountarray[$fin] = $results;
    $accountstring = implode(';', array_map(
        function ($v, $k) {
            return sprintf("%s:%s", $k, $v);
        },
        $accountarray,
        array_keys($accountarray)
    ));
} else {
    if (array_key_exists($fin, $accountarray)) {
        $accountarray[$fin] += $results;
    } else {
        $accountarray[$fin] = $results;
    }
    $accountstring = implode(';', array_map(
        function ($v, $k) {
            return sprintf("%s:%s", $k, $v);
        },
        $accountarray,
        array_keys($accountarray)
    ));
}

$transaction = new Transactions();
$transaction->user_id = $_SESSION['user_id'];
$transaction->value = $results;
$transaction->currencies_id = $fin;
$transaction->type = "depot";
$dbmanager->insert($transaction);

$bankaccount = new Bankaccounts();
$bankaccount->id = $bankaccountvalue['id'];
$bankaccount->user_id = $_SESSION['user_id'];
$bankaccount->value = $accountstring;
$dbmanager->update($bankaccount);

header('Location: /index.php?name=home');
