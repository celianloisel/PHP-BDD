<h1>Welcome on the home page !!</h1>
<?php 
if ($role['status'] > 1) { 
   echo "Bonjour ".$role['firstname']." Votre compte est bien vérifié";
}
else {
    echo "Bonjour ".$role['firstname']." Votre compte n'est pas vérifié"; 
}

 

?>


