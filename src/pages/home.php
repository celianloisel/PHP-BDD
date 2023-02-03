<h1>Welcome on the home page !!</h1>

<?php
if ($admin>200) { echo "Bonjour ". $role['firstname'] ." OMGGGG C EST LE PATRONNNN BAISSEZ VOTRE PANTALON TOUTE DE SUITE";}
elseif ($manager>10) { echo "Bonjour ". $role['firstname'] ." Oh Grand manager, Voulez-vous un café ? ";}
elseif ($verified>1) {echo "Bonjour ". $role['firstname'] ." Votre compte est vérifié, vous avez accès à toutes les fonctionnalités aux utilisateurs de la banque"; }
elseif ($unverified>0)
echo "Bonjour ". $role['firstname'] ." Votre compte n'est pas vérifié. Veuillez attendre qu'un manager vous accepte.";
elseif ($banned>(-1)) {
    echo "Bonjour ". $role['firstname'] ." T'es ban gros caca, ton odeur est fétide va prendre une douche et va en enfer.";
}