<?php
session_start(); // Démarrage de la session
if (!isset($_SESSION['loggedin'])) header("Location: ./connexion.php");
header("Cache-Control: no-cache, must-revalidate");
header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); 
include "./pdo.php";
$link = connexionBDD();
$requete = 'SELECT ID_VILLE, NOM_VILLE FROM ville';
$reqPreparee = $link->prepare($requete);
$reqPreparee->execute(); 
$resRequete = $reqPreparee->fetchAll(PDO::FETCH_ASSOC); 
?>


<!DOCTYPE HTML>
<html>
    <head lang="fr">
        <title>BDD - Plage</title>
        <meta charset="utf-8">
        <link rel="stylesheet" type="text/css" href="./style.css"/>
    </head>

    <body>
        <div class="nav">
            
        </div>
            <div class="form">
            <FORM method="POST" action="./creerPlage.php">
                
                <INPUT type="text" name="NOM_PLAGE" placeholder="Nom de la plage">
                <INPUT type="text" name="LONGUEUR_PLAGE" placeholder="Longueur de la plage">
                <select name="ID_VILLE">
                <?php
                   
               foreach ($resRequete as $row) {
                   echo "<option value='" . $row['ID_VILLE'] . "'>" . $row['NOM_VILLE'] . "</option>";
               }
           
               ?>
                </select>
                <br><br>
                <INPUT class="submit" type="submit" value="Envoyer">
                <INPUT type="reset" value="Effacer">

        </FORM></div>
    
        </body>
    </html>   