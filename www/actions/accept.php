<?php 

require_once __DIR__ . '/../../src/init.php';
    $id =  $_POST['idUser'];
    $users = $db->prepare("UPDATE users set status =" . " '" . 10 . "' " . "WHERE id = " . $id);
    $users->execute();
    $users->fetch();

    header("Location: /index.php?name=manage")
?>