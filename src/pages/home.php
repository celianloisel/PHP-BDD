<h1>Welcome on the home page !!</h1>

<?php if ($role['status']>1)
echo "Bonjour ". $role['firstname'] ." Votre compte est vérifié";
else {
    echo "Bonjour ". $role['firstname'] ." Votre compte n'est pas vérifié. Veuillez attendre qu'un manager vous accepte.";
}