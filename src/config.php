<?php 

$config = [];
$config['db'] = [
	'name' => 'bank',
	'host' => '127.0.0.1',
	'port' => 8889,
	'user' => 'root',
	'pass' => 'root'
];


// Fichier de configuration pour les rôles
define("ROLE_ADMIN", 1000);
define("ROLE_MANAGER", 200);
define("ROLE_USER_UNVERIFIED", 1);
define("ROLE_USER_VERIFIED", 10);
define("ROLE_USER_BANNED", 0);

// Vérification du rôle de l'utilisateur
function checkRole($userRole, $requiredRole) {
  return $userRole >= $requiredRole;
}

// Exemple d'utilisation pour vérifier si l'utilisateur est un administrateur
$userRole = ROLE_ADMIN;
if (checkRole($userRole, ROLE_ADMIN)) {
  // L'utilisateur a les autorisations d'un administrateur
} else {
  // L'utilisateur n'a pas les autorisations d'un administrateur
}

?>
