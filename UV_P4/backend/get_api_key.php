<?php
session_start();

// Vérifiez si l'utilisateur est connecté
if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
    // Vous devrez remplacer 'votre_table' par le nom de votre table dans la base de données.
    $user_id = $_SESSION["id"];
    
    // Effectuez une requête SQL pour récupérer la clé API de l'utilisateur.
    require_once "connect.php"; // Assurez-vous d'inclure votre fichier de connexion ici.

    $sql = "SELECT clé_API FROM users WHERE id = ?";
    if ($stmt = $connection->prepare($sql)) {
        $stmt->bind_param("i", $user_id);

        if ($stmt->execute()) {
            $stmt->bind_result($api_key);
            if ($stmt->fetch()) {
                echo $api_key;
            } else {
                echo "Clé API non trouvée";
            }
        } else {
            echo "Erreur lors de l'exécution de la requête";
        }

        $stmt->close();
    }
} else {
    echo "Utilisateur non connecté";
}
?>
