<?php
session_start(); // Démarrage de la session
if (!isset($_SESSION['loggedin'])) header("Location: ./connexion.php");
header("Cache-Control: no-cache, must-revalidate");
header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); 
include "./pdo.php";
$link = connexionBDD();
$requete = 'SELECT ID_DEP, NOM_DPTM FROM responsable_departemental';
$reqPreparee = $link->prepare($requete);
$reqPreparee->execute(); // Exécutez la requête préparée
$resRequete = $reqPreparee->fetchAll(PDO::FETCH_ASSOC); // Obtenez tous les résultats de la requête
?>


<!DOCTYPE HTML>
<html>
    <head lang="fr">
        <title>BDD - Ville</title>
        <meta charset="utf-8">
        <link rel="stylesheet" type="text/css" href="./style.css"/>
    </head>

    <body>
        <div class="nav"></div>
            <div class="form">
            <FORM method="POST" action="./creerVille.php">
                <INPUT type="text" name="NOM_VILLE" placeholder="Nom de la ville">
                <INPUT type="text" name="CODE_POSTAL" placeholder="Code Postal">
                <INPUT type="text" name="NB_TOURISTES" placeholder="Nombre de touristes">
                <select name="ID_DEP">

                    <?php
                   
                        // ne fonctionne pas: liste déroulante vide
                        /*while ($row = $resRequete -> fetch(PDO::FETCH_ASSOC)){
                            echo "<option value='". $row['ID_DEP'] ."'>" . $row['NOM_DPTM'] . "</option>";  
                        }*/
                    

                     // faire une boucle foreach pour afficher tous les départements
                    foreach ($resRequete as $row) {
                        echo "<option value='" . $row['ID_DEP'] . "'>" . $row['NOM_DPTM'] . "</option>";
                    }
                
                    ?>

                   
                </select>
                
                <br><br>
                <INPUT class="submit" type="submit" value="Envoyer">
                <INPUT type="reset" value="Effacer">

        </FORM></div>
    
        </body>
    </html>   