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
}

header("Location: /index.php?name=recap");