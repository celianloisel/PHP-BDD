<?php

$u = $_SESSION['user_id'];

$money = $db->prepare("SELECT value FROM bankaccounts WHERE user_id = $u");
$money->execute();
$result = $money->fetchAll();

$string = $result[0][0];

eval("\$array = $string;");

?>

<h1>My account</h1>

<h2>Your money:</h2>

<?php foreach ($array as $v => $value){ ?>

    <div>
        <p><?= "$v: $value"; ?></p>
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
