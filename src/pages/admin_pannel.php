<h1>Welcome on the Admin Pannel !!</h1>

<?php
require_once __DIR__ . '/../../src/init.php'; ?>

<h3>Users List</h3>

<?php $dbManager = new DbManager($db);
        
        $results = $dbManager->getAll("users");
       
        foreach ($results as $result) {
            if ($result['status'] >200) {
                $roles = "admin";
            }
            elseif ($result['status'] >10) {
                $roles = "manager";
            }
            elseif ($result['status'] >1) {
                $roles = "verified";
            }
            elseif ($result['status'] >0) {
                $roles = "unverified";
            }
            elseif ($result['status'] >-1) {
                $roles = "banned";
            } 
            echo $result['id']." ". $result['firstname']." ". $result['lastname']." ".$roles; ?>
            
            <br><br> <?php }?>

        <h3>Transaction List</h3>

        <?php
       
        $transacs = $dbManager->getAll("transactions");
        foreach ($transacs as $transac) {
            
            echo $transac['id']." user_id :  ".$transac['user_id']." ".$transac['value']."  ".$transac['currencies_id']."  ".$transac['type']."  ".$transac['date'] ;
            ?> <br> <br> <?php
        }
        ?>
