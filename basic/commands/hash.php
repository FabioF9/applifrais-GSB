<?php
// Connexion à la base de données
$servername = "localhost";
$username = "applifraisyii";
$password = "-_)@TwC!BrKWWTDL";
$dbname = "applifraisyii";

$conn = new mysqli($servername, $username, $password, $dbname);

// Vérification de la connexion
if ($conn->connect_error) {
    die("La connexion à la base de données a échoué : " . $conn->connect_error);
}

// Récupération des utilisateurs depuis la base de données
$sql = "SELECT id, mdp FROM visiteur";
$result = $conn->query($sql);

// Vérification des résultats
if ($result->num_rows > 0) {
    // Parcourir les utilisateurs
    while ($row = $result->fetch_assoc()) {
        $id = $row["id"];
        $motDePasseClair = $row["mdp"];

        // Hachage du mot de passe en utilisant la fonction crypt()
        $motDePasseHache = crypt($motDePasseClair, "u");

        // Mise à jour du mot de passe haché dans la base de données
        $updateSql = "UPDATE visiteur SET mdp='$motDePasseHache' WHERE id='$id'";
        $conn->query($updateSql);
        echo "Mot de passe en clair : " . $motDePasseClair . "<br>";
        echo "Mot de passe haché : " . $motDePasseHache;
    }
} else {
    echo "Aucun utilisateur trouvé dans la base de données.";
}

// Fermeture de la connexion à la base de données
$conn->close();
?>
