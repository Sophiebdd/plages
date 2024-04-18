<?php
session_start(); // Démarrage de la session
if (!isset($_SESSION['loggedin'])) header("Location: ./connexion.php");
header("Cache-Control: no-cache, must-revalidate");
header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); 
?>
<!DOCTYPE HTML>
<html>
    <head lang="fr">
        <title>Fiche département</title>
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
            $id_dep = $_GET['id'];
            $query = "SELECT * FROM responsable_departemental
            WHERE ID_DEP = :id_dep";
            $stmt = $connexion->prepare($query);
            $stmt->bindParam(':id_dep', $id_dep);
            $stmt->execute();

            if ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                echo "<h1>Nom du département et numéro du département: " . $row['NOM_DPTM'] . " ( ". $row['NUM_DPTM']." )" . "</h1>";
                echo "<p>Nom et prénom du responsable: " . $row['NOM_RESP'] . " " . $row['PRENOM_RESP']. "</p>";
                         } else {
                echo "Aucun département trouvée avec cet ID.";
            }
        } else {
            echo "ID du département non spécifié.";
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