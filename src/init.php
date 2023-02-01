<?php
session_start();

require_once __DIR__ . '/config.php';
require_once __DIR__ . '/db.php';

require_once __DIR__ . '/class/DbObject.php';
require_once __DIR__ . '/class/ContactForm.php';
require_once __DIR__ . '/class/User.php';

require_once __DIR__ . '/class/DbManager.php';

$dbManager = new DbManager($db);

require_once __DIR__ . '/utils/errors.php';
require_once __DIR__ . '/utils/auth.php';


$user_id = get_session_user();
$user = false;
if ($user_id !== false) {
	$user = get_user_by_id($user_id);
}



// Fichier de configuration pour les rôles
define("ROLE_ADMIN", 1000);
define("ROLE_MANAGER", 200);
define("ROLE_USER_UNVERIFIED", 1);
define("ROLE_USER_VERIFIED", 10);
define("ROLE_USER_BANNED", 0);


function checkRole($userRole, $requiredRole) {
  return $userRole >= $requiredRole;
}

// Connexion à la base de données
$host = "localhost";
$dbname = "bank";
$username = "root";
$password = "root";
$pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);

// Récupération du rôle de l'utilisateur à partir de la table users
$stmt = $pdo->prepare("SELECT role FROM users WHERE username = :username");
$stmt->execute(array(":username" => "bob"));
$userRole = $stmt->fetchColumn();

// Vérification du rôle de l'utilisateur
if (checkRole($userRole, ROLE_ADMIN)) {
  // L'utilisateur a les autorisations d'un administrateur
  echo "Bienvenue l'utilisateur";
} else {
  // L'utilisateur n'a pas les autorisations d'un administrateur
  echo "Votre accès est refusé";
}

?>