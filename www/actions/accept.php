<?php 

require_once __DIR__ . '/../../src/init.php';
    $id =  $_POST['idUser'];
    $users = $db->prepare("UPDATE users set status =" . " '" . 10 . "' " . "WHERE id = " . $id);
    $users->execute();
    $users->fetch();


    $insertUser = $db->prepare('INSERT INTO bankaccounts(user_id,value)VALUES(?,?)'); //on rentre dans la base de données (via l'objet) les informations du nouvel utilisateur
    $insertUser->execute(array($id,"[]")); 
   
    header("Location: /index.php?name=manage")
?>