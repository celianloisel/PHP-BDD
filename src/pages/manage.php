<?php
require_once __DIR__ . '/../class/DbManager.php';
/* $users = $db->prepare("SELECT * FROM users WHERE status = 1");
$users->execute();
$userResult = $users->fetchAll(); */

$dbmanager = new DbManager($db);
$userResult = $dbmanager->getAllWhere("users", "status", 1);

?>

<?php foreach ($userResult as $user): ?>
    <section>
        <div>
            <p><?= $user['firstname'] . " " .$user['lastname'] ?> </p>
        </div>
        <div>
            <form action="/actions/accept.php" method="post">
                <input type="text" value="<?= $user['id'] ?>" name="idUser" style="display:none">
                <input type="submit" value="Accept">
            </form>
        </div>
    </section>
<?php endforeach;

$dbManager = new DbManager($db);
$results = $dbManager->getAll("deposits");

foreach ($results as $r) {
    $userData = $dbManager->getWhere("users", "id", $r["user_id"]);
    $currenciesData = $dbManager->getWhere("currencies", "id", $r["currencies_id"]);
    ?>
    <section>
        <div>
            <p><?= $userData['firstname'] ?> <?= $userData['lastname'] ?> : <?= $r['value'] ?> <?= $currenciesData["name"] ?></p>
        </div>
        <div>
            <form action="/actions/acceptDepot.php" method="post">
                <input type="text" value="<?= $r['id'] ?>" name="idDepot" style="display:none">
                <input type="submit" value="Accept">
            </form>
        </div>
    </section>
<?php }


$results2 = $dbManager->getAll("withdrawals");
foreach ($results2 as $r) {
    $userData = $dbManager->getWhere("users", "id", $r["user_id"]);
    $currenciesData = $dbManager->getWhere("currencies", "id", $r["currencies_id"]);
    ?>
    <section>
        <div>
            <p><?= $userData['firstname'] ?> <?= $userData['lastname'] ?> : <?= $r['value'] ?> <?= $currenciesData["name"] ?></p>
        </div>
        <div>
            <form action="/actions/acceptWithdrawals.php" method="post">
                <input type="text" value="<?= $r['id'] ?>" name="idWithdrawal" style="display:none">
                <input type="submit" value="Accept">
            </form>
        </div>
    </section>
<?php }
