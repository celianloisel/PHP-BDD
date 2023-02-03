<?php

require_once __DIR__ . '/../../src/init.php';

$dbmanager = new DbManager($db);

$results = $dbmanager->getById($_POST['idWithdrawal'], "withdrawals");
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
    $accountarray[$results->currencies_id] = $results->value * -1;
    $accountstring = implode(';', array_map(
        function ($v, $k) {
            return sprintf("%s:%s", $k, $v);
        },
        $accountarray,
        array_keys($accountarray)
    ));
} else {
    if (array_key_exists($results->currencies_id, $accountarray)) {
        $accountarray[$results->currencies_id] -= $results->value;
    } else {
        $accountarray[$results->currencies_id] = $results->value * -1;
    }
    $accountstring = implode(';', array_map(
        function ($v, $k) {
            return sprintf("%s:%s", $k, $v);
        },
        $accountarray,
        array_keys($accountarray)
    ));
}

if (isset($_POST['idWithdrawal'])) {
    $transaction = new Transactions();
    $transaction->user_id = $results->user_id;
    $transaction->value = $results->value * -1;
    $transaction->currencies_id = $results->currencies_id;
    $transaction->type = "retrait";
    $dbmanager->insert($transaction);

    $bankaccount = new Bankaccounts();
    $bankaccount->id = $bankaccountvalue['id'];
    $bankaccount->user_id = $results->user_id;
    $bankaccount->value = $accountstring;
    $dbmanager->update($bankaccount);

    $dbmanager->removeById("withdrawals", $_POST['idWithdrawal']);
}

header("Location: /index.php?name=manage");


