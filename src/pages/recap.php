<?php
$stmt = $db->prepare("SELECT money FROM users WHERE status = 1");
$stmt->execute();
$money = $stmt->fetchAll();
?>

<h1>My account</h1>
<ul>
    <?php foreach ($money as $m) : ?>
        <li><?= $m['money'] ?></li>
    <?php endforeach; ?>
</ul>

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
