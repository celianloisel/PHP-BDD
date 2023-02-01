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


require_once "config.php";

function checkRole($userRole, $requiredRole) {
  return $userRole >= $requiredRole;
}

require_once "config.php";

// Connexion à la base de données
$host = "localhost";
$dbname = "bank";
$username = "root";
$password = "root";
$pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);

// Récupération du rôle de l'utilisateur à partir de la table `users`
$stmt = $pdo->prepare("SELECT role FROM users WHERE username = :username");
$stmt->execute(array(":username" => "bob"));
$userRole = $stmt->fetchColumn();

// Vérification du rôle de l'utilisateur
if (checkRole($userRole, ROLE_ADMIN)) {
  // L'utilisateur a les autorisations d'un administrateur
  echo "Bienvenue l'utilisateur";
} else {
  // L'utilisateur n'a pas les autorisations d'un administrateur
  echo "Votre accès estgits refusé";
}

// Vérification du rôle de l'utilisateur
// function checkRole($userRole, $requiredRole) {
//   return $userRole >= $requiredRole;
// }

// // Exemple d'utilisation pour vérifier si l'utilisateur est un administrateur
// $userRole = ROLE_ADMIN;
// if (checkRole($userRole, ROLE_ADMIN)) {
//   // L'utilisateur a les autorisations d'un administrateur
// } else {
//   // L'utilisateur n'a pas les autorisations d'un administrateur
// }

?>
