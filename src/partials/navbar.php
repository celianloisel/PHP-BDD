<nav>
    <ul>
    <!-- Droits pour managerr -->
        <?php if($user_id !== false){ 

              if ($banned || $unverified || $verified || $manager || $admin > 10){     ?>
        <li>
            <a href="?name=manage">Manage</a>
        </li>
        <?php }

        // Droits pour membres vérifiés 
        if ($banned || $unverified || $verified || $manager || $admin > 1) { ?>
            <li>
                <a href="?name=recap">Recap</a>
            </li>
            <li>
                <a href="?name=transactions">Transactions</a>
            </li>
            <li>
                <a href="?name=conversion">Conversion</a>
            </li>
       <?php } ?>
        <li>
            <a href="?name=home">Home</a>
        </li>
        
        <li>
            <form action="/../actions/logout.php" method="post">
                <input type="submit" value="Log Out">
            </form>
        </li>
        <?php } ?>
        
        <?php if($user_id === false){ ?>
        <li>
            <a href="?name=register">Register</a>
        </li>
        <li>
            <a href="?name=login">Login</a>
        </li>
        <?php } ?>
    </ul>
</nav>