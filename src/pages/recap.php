<?php

$u = $_SESSION['user_id'];

//$money = $db->prepare("SELECT value FROM bankaccounts WHERE user_id = $u");
//$money->execute();
//$result = $money->fetch();

$dbmanager = new DbManager($db);
$result = $dbmanager->getWhere("bankaccounts", "user_id", $u);

$createaccountarray = explode(";", $result["value"]);
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


?>

<h1>My account</h1>

<h2>Your money:</h2>

<?php foreach ($accountarray as $v => $value) {

    $dbmanager = new DbManager($db);
    $i = $dbmanager->getWhere("currencies", "id", $v);
    $j = $i['name'];
    ?>

    <div>
        <p><?= "$value $j"; ?></p>
    </div>

<?php } ?>

<form action="/actions/recap.php" method="post">
    <label for="depot">Depot : </label>
    <input type="text" name="depot" id="depot">
    <select name="currency">
        <option disabled selected="selected">--Please choose an option--</option>
        <?php
        $dbManager = new DbManager($db);
        $results = $dbManager->getAll("currencies");
        foreach ($results as $result) { ?>
            <option value="<?= $result['id'] ?>"><?= $result['name'] ?></option>;
        <?php } ?>
    </select>
    <input type="submit" value="Depot" name="submit">
</form>

<form action="/actions/recap.php" method="post">
    <label for="retrait">Retrait : </label>
    <input type="text" name="retrait" id="retrait">
    <select name="currency">
        <option disabled selected="selected">--Please choose an option--</option>
        <?php
        $dbManager = new DbManager($db);
        $results = $dbManager->getAll("currencies");
        foreach ($results as $result) { ?>
            <option value="<?= $result['id'] ?>"><?= $result['name'] ?></option>;
        <?php } ?>
    </select>
    <input type="submit" value="Retrait" name="submit">
</form>

<form action="/actions/recap.php" method="post">
    <label for="send">Send : </label>
    <input type="text" name="send" id="send">
    <select name="currency">
        <option disabled selected="selected">--Please choose an option--</option>
        <?php
        $dbManager = new DbManager($db);
        $results = $dbManager->getAll("currencies");
        foreach ($results as $result) { ?>
            <option value="<?= $result['id'] ?>"><?= $result['name'] ?></option>;
        <?php } ?>
    </select>
    <label for="qui">A qui : </label>
    <input type="text" name="qui" id="qui">
    <input type="submit" value="Send" name="submit">
</form>
