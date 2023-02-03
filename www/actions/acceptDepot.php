<?php

require_once __DIR__ . '/../../src/init.php';

$dbmanager = new DbManager($db);

$results = $dbmanager->getById($_POST['idDepot'], "deposits");
$bankaccountvalue = $dbmanager->getWhere("bankaccounts", "user_id", $results->user_id);

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
    $accountarray[$results->currencies_id] = $results->value;
    $accountstring = implode(';', array_map(
        function ($v, $k) {
            return sprintf("%s:%s", $k, $v);
        },
        $accountarray,
        array_keys($accountarray)
    ));
} else {
    if (array_key_exists($results->currencies_id, $accountarray)) {
        $accountarray[$results->currencies_id] += $results->value;
    } else {
        $accountarray[$results->currencies_id] = $results->value;
    }
    $accountstring = implode(';', array_map(
        function ($v, $k) {
            return sprintf("%s:%s", $k, $v);
        },
        $accountarray,
        array_keys($accountarray)
    ));
}

if (isset($_POST['idDepot'])) {
    $transaction = new Transactions();
    $transaction->user_id = $results->user_id;
    $transaction->value = $results->value;
    $transaction->currencies_id = $results->currencies_id;
    $transaction->type = "depot";
    $dbmanager->insert($transaction);

    $bankaccount = new Bankaccounts();
    $bankaccount->id = $bankaccountvalue['id'];
    $bankaccount->user_id = $results->user_id;
    $bankaccount->value = $accountstring;
    $dbmanager->update($bankaccount);

    $dbmanager->removeById("deposits", $_POST['idDepot']);
}

header("Location: /index.php?name=manage");
