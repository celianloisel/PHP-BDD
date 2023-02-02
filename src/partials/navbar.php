<nav>
    <ul>
        <?php if($user_id !== false){ ?>
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
        <?php
        if($user_id !== false){ 
            if ($role['status'] > 1){ ?>
            <li>
                <a href="?name=transactions">Transactions</a>
            </li>
            <li>
                <a href="?name=withdrawals">Withdrawals</a>
            </li>
            <li>
                <a href="?name=account_summary">Account Summary</a>
            </li>
            <li>
                <a href="?name=currency_conversion">Account Summary</a>
            </li>
        <?php }
           
        }
             ?>
            


    </ul>
</nav>