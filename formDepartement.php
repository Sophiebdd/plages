<?php
session_start(); // Démarrage de la session
if (!isset($_SESSION['loggedin'])) header("Location: ./connexion.php");
header("Cache-Control: no-cache, must-revalidate");
header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); 
?>


<!DOCTYPE HTML>
<html>
    <head lang="fr">
        <title>BDD - Département</title>
        <meta charset="utf-8">
        <link rel="stylesheet" type="text/css" href="./style.css"/>
    </head>

    <body>
        <div class="nav"></div>
            <div class="form">
            <FORM method="POST" action="./creerDepartement.php">
                
                <INPUT type="text" name="NOM_DPTM" placeholder="Nom du département">
                <INPUT type="text" name="NOM_RESP" placeholder="Nom du responsable">
                <INPUT type="text" name="PRENOM_RESP" placeholder="Prénom du responsable">
                <INPUT type="text" name="NUM_DPTM" placeholder="Numéro du département">
                <br><br>
                <INPUT class="submit" type="submit" value="Envoyer">
                <INPUT type="reset" value="Effacer">

        </FORM></div>
    
        </body>
    </html>   
    