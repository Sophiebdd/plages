<?php
session_start(); // Démarrage de la session
if (!isset($_SESSION['loggedin'])) header("Location: ./connexion.php");
header("Cache-Control: no-cache, must-revalidate");
header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); 
?>

<!DOCTYPE HTML>
<html>
    <head lang="fr">
        <title>Fiche Ville</title>
        <meta charset="utf-8">
        <style>
            table {
                background-color: #ffceba;
                color: #9E2B40;
                border: solid;
                border-color: #9E2B40;
                border-radius: 10px;
                padding: 20px;
                margin-left: 30%;
                text-align: center;
            }
            a {
                text-decoration: none;
                color: #6B0D0D;
            }
        </style>
    </head>
    <body>
<div>
<?php

include './pdo.php';
$connexion = connexionBDD();


if ($connexion) {
    try {
       
        if (isset($_GET['id'])) {
            
            $id_ville = $_GET['id'];
            $query = "SELECT ville.*, plage.* FROM ville 
            INNER JOIN plage ON ville.ID_VILLE = plage.ID_VILLE
            WHERE ville.ID_VILLE = :id_ville";
            $stmt = $connexion->prepare($query);
            $stmt->bindParam(':id_ville', $id_ville);
            $stmt->execute();

  
            if ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                echo "<h1>Détails de la ville " . $row['NOM_VILLE'] . "</h1>";
                echo "<p>Code postal: " . $row['CODE_POSTAL'] . "</p>";
                echo "<p>Nombre de touristes: " . $row['NB_TOURISTES'] . "</p>";
                echo "<p>ID du département: " . $row['ID_DEP'] . "</p>";
                echo "<p>Nom plage: " . $row['NOM_PLAGE'] . "</p>";
                echo "<p>Longueur plage: " . $row['LONGUEUR_PLAGE'] ." km" . "</p>";
            } else {
                echo "Aucune ville trouvée avec cet ID.";
            }
        } else {
            echo "ID de la ville non spécifié.";
        }
    } catch (PDOException $e) {
        echo "Erreur: " . $e->getMessage();
    }

  
    $connexion = null;
} else {
    echo "La connexion à la base de données a échoué";
}
?>
</div>
</body>
</html>