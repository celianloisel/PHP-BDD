<nav>
    <ul>
        <?php if($user_id !== false){ ?>
        <li>
            <a href="?name=home">Home</a>
        </li>
        <?php } ?>
        <li>
            <a href="?name=register">Register</a>
        </li>
        <li>
            <a href="?name=login">Login</a>
        </li>
    </ul>
</nav>