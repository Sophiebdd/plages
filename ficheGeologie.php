<?php
session_start(); // Démarrage de la session
if (!isset($_SESSION['loggedin'])) header("Location: ./connexion.php");
header("Cache-Control: no-cache, must-revalidate");
header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); 
?>
<!DOCTYPE HTML>
<html>
    <head lang="fr">
        <title>Fiche géologie</title>
        <meta charset="utf-8">
        <link rel="stylesheet" type="text/css" href="./style.css"/>
        
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
            
            $id_geo = $_GET['id'];

           
            $query = "SELECT plage.*, nature_geo_plage.* , composer.* FROM nature_geo_plage 
            INNER JOIN composer ON nature_geo_plage.ID_GEO = composer.ID_GEO
            INNER JOIN plage on composer.ID_GEO = plage.ID_PLAGE
            WHERE nature_geo_plage.ID_GEO = :id_geo";
            $stmt = $connexion->prepare($query);
            $stmt->bindParam(':id_geo', $id_geo);
            $stmt->execute();

       
            if ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                echo "<h1>Détails de la plage " . $row['NOM_PLAGE'] . "</h1>";
                echo "<p>Longueur en km: " . $row['LONGUEUR_PLAGE'] . "</p>";
                echo "<p>Typologie du terrain: " . $row['LIBELLE'] . "</p>";
                ;
            } else {
                echo "Aucune plage trouvée avec cet ID.";
            }
        } else {
            echo "ID de la plage non spécifié.";
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