<?php

require_once __DIR__ . '/../../src/init.php';

if (isset($_POST['submit']) && $_POST['submit'] == "Depot") {
    $dbmanager = new DbManager($db);

    $deposits = new Deposits();
    $deposits->user_id = $_SESSION["user_id"];
    $deposits->value = $_POST["depot"];
    $deposits->currencies_id = $_POST['currency'];

    $dbmanager->insert($deposits);
} elseif (isset($_POST['submit']) && $_POST['submit'] == "Retrait") {
    $dbmanager = new DbManager($db);

    $withdrawals = new Withdrawals();
    $withdrawals->user_id = $_SESSION["user_id"];
    $withdrawals->value = $_POST["retrait"];
    $withdrawals->currencies_id = $_POST['currency'];

    $dbmanager->insert($withdrawals);
} elseif (isset($_POST['submit']) && $_POST['submit'] == "Send") {
    $dbmanager = new DbManager($db);

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
        $accountarray[$_POST['currency']] = $_POST['send'] * -1;
        $accountstring = implode(';', array_map(
            function ($v, $k) {
                return sprintf("%s:%s", $k, $v);
            },
            $accountarray,
            array_keys($accountarray)
        ));
    } else {
        if (array_key_exists($_POST['currency'], $accountarray)) {
            $accountarray[$_POST['currency']] -= $_POST['send'];
        } else {
            $accountarray[$_POST['currency']] = $_POST['send'] * -1;
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
    $transaction->value = $_POST['send'];
    $transaction->currencies_id = $_POST['currency'];
    $transaction->type = "retrait";
    $dbmanager->insert($transaction);

    $bankaccount = new Bankaccounts();
    $bankaccount->id = $bankaccountvalue['id'];
    $bankaccount->user_id = $_SESSION['user_id'];
    $bankaccount->value = $accountstring;
    $dbmanager->update($bankaccount);


    $bankaccountvalue = $dbmanager->getWhere("bankaccounts", "user_id", $_POST['qui']);

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
        $accountarray[$_POST['currency']] = $_POST['send'];
        $accountstring = implode(';', array_map(
            function ($v, $k) {
                return sprintf("%s:%s", $k, $v);
            },
            $accountarray,
            array_keys($accountarray)
        ));
    } else {
        if (array_key_exists($_POST['currency'], $accountarray)) {
            $accountarray[$_POST['currency']] += $_POST['send'];
        } else {
            $accountarray[$_POST['currency']] = $_POST['send'];
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
    $transaction->user_id = $_POST['qui'];
    $transaction->value = $_POST['send'];
    $transaction->currencies_id = $_POST['currency'];
    $transaction->type = "depot";
    $dbmanager->insert($transaction);

    $bankaccount = new Bankaccounts();
    $bankaccount->id = $bankaccountvalue['id'];
    $bankaccount->user_id = $_POST['qui'];
    $bankaccount->value = $accountstring;
    $dbmanager->update($bankaccount);

}

header("Location: /index.php?name=recap");