<?php

$u = $_SESSION['user_id'];

$value = $db->prepare("SELECT value FROM bankaccounts WHERE user_id = $u");
$value->execute();
$value->fetch();
var_dump($value)
?>

<h1>My account</h1>

<?php foreach ($value as $v) : ?>

    <div>
        <p><?php echo ($v) ?> </p>
    </div>

<?php endforeach; ?>

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
