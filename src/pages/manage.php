<?php 
    $users = $db->prepare("SELECT * FROM users WHERE status = 1");
    $users->execute();
    $users->fetch();
?>

<?php foreach($users as $user): ?>
    <section>
        <div>
            <p><?= $user['firstname'] ?> </p>
            <p><?= $user['lastname'] ?> </p>      
        </div>
        <div>
            <button>Accept</button>
            <button>Denied</button>
        </div>
    </section>
<?php endforeach; ?>