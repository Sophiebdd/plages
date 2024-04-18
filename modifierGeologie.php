<?php
session_start(); // Démarrage de la session
if (!isset($_SESSION['loggedin'])) header("Location: ./connexion.php");
header("Cache-Control: no-cache, must-revalidate");
header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); 
include "./pdo.php";
$link = connexionBDD();

$id = 0;
if (isset($_GET['id'])) $id = $_GET['id'];
$requeteGeo = "SELECT * FROM nature_geo_plage where ID_GEO = $id";
$reqPrepareeGeo = $link->prepare($requeteGeo);
$reqPrepareeGeo->execute(); 
$resRequeteGeo = $reqPrepareeGeo->fetchAll(PDO::FETCH_ASSOC);
foreach ($resRequeteGeo as $rowGeo) {
    $libelle = $rowGeo['LIBELLE'];

}
?>


<!DOCTYPE HTML>
<html>
    <head lang="fr">
        <title>Modifier géologie</title>
        <meta charset="utf-8">
        <link rel="stylesheet" type="text/css" href="./style.css"/>
    </head>

    <body>
        <div class="nav"></div>
            <div class="form">
            <FORM method="POST" action="./majGeologie.php?id=<?php echo $id;?>">
                
                <INPUT type="text" name="LIBELLE" placeholder="Libellé" value='<?php echo $libelle;?>'>
                
                <br><br>
                <INPUT class="submit" type="submit" value="Envoyer">
                <INPUT type="reset" value="Effacer">

        </FORM></div>
    
        </body>
    </html>  