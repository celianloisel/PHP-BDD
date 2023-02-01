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
            <form action="/actions/accept.php">
                <input type="submit" value="Accept">
            </form>
        </div>
    </section>
<?php endforeach; ?>