<?php 
    $money = $db->prepare("SELECT * FROM users WHERE status = 1");
    $money->execute();
    $money->fetch();
?>

<h1>My account</h1>
<ul>

    <?php foreach ($money as $m) : ?>
        <li><?= $m['money'] ?></li>
        <li><?= $m['money'] ?></li>
        <li><?= $m['money'] ?></li>
    <?php endforeach; ?>
</ul>