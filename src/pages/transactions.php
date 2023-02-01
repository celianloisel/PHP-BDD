<?php

// Connexion à la base de données
$host = "localhost";
$username = " root ";
$password = " root";
$dbname = "bank";

$conn = mysqli_connect($host, $username, $password, $dbname);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Récupération de l'utilisateur courant
$user_id = $_SESSION['user_id'];

// Nombre de transactions par page
$records_per_page = 10;

// Numéro de page actuel
$page = (isset($_GET['page']) && $_GET['page'] > 0) ? $_GET['page'] : 1;

// Déterminer le premier enregistrement à récupérer
$start_from = ($page - 1) * $records_per_page;

// Récupération des 10 dernières transactions pour l'utilisateur courant
$sql = "SELECT * FROM transactions WHERE user_id = $user_id ORDER BY date DESC LIMIT $start_from, $records_per_page";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    // Affichage des transactions
    while ($row = mysqli_fetch_assoc($result)) {
        echo "Transaction ID : " . $row["id"] . "<br>";
        echo "Date : " . $row["date"] . "<br>";
        echo "Montant : " . $row["amount"] . "<br>";
        echo "Description : " . $row["description"] . "<br><br>";
    }

    // Pagination
    $sql = "SELECT COUNT(id) FROM transactions WHERE user_id = $user_id";
    $result = mysqli_query($conn, $sql);
    $total_records = mysqli_fetch_array($result)[0];
    $total_pages = ceil($total_records / $records_per_page);

    echo "<a href='transactions.php?page=1'>".'Première page'."</a> ";

    for ($i = 1; $i <= $total_pages; $i++) {
        echo "<a href='transactions.php?page=".$i."'>".$i."</a> ";
    };
    echo "<a href='transactions.php?page=$total_pages'>".'Dernière page'."</a> ";
} else {
    echo "Aucune transaction trouvée";
}

// Fermeture de la connexion à la base de données
mysqli_close($conn);

?>
