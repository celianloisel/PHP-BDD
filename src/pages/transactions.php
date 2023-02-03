<?php

require_once __DIR__ . '/../../src/init.php';

$dbmanager = new DbManager($db);

$results = $dbmanager->getAllDescendingWhere("transactions", "user_id", $_SESSION['user_id']);

$results = array_slice(array_reverse($results), 0, 10);
foreach ($results as $transaction) {
    $name = $dbmanager->getWhere("currencies", "id", $transaction['currencies_id']);
    echo $transaction['type'] . " : " . $transaction['value'] . " " . $name['name'] . "<br>";
}
