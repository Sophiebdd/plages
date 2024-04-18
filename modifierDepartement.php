<?php
session_start(); // Démarrage de la session
if (!isset($_SESSION['loggedin'])) header("Location: ./connexion.php");
header("Cache-Control: no-cache, must-revalidate");
header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); 
include "./pdo.php";
$link = connexionBDD();

$id = 0;
if (isset($_GET['id'])) $id = $_GET['id'];
$requeteDep = "SELECT * FROM responsable_departemental where ID_DEP = $id";
$reqPrepareeDep = $link->prepare($requeteDep);
$reqPrepareeDep->execute(); 
$resRequeteDep = $reqPrepareeDep->fetchAll(PDO::FETCH_ASSOC);
foreach ($resRequeteDep as $rowDep) {
    $NOM_RESP = $rowDep['NOM_RESP'];
    $PRENOM_RESP = $rowDep['PRENOM_RESP'];
    $NOM_DPTM = $rowDep['NOM_DPTM'];
    $NUM_DPTM = $rowDep['NUM_DPTM'];
}
?>


<!DOCTYPE HTML>
<html>
    <head lang="fr">
        <title>Modifier département</title>
        <meta charset="utf-8">
        <link rel="stylesheet" type="text/css" href="./style.css"/>
    </head>

    <body>
        <div class="nav"></div>
            <div class="form">
            <FORM method="POST" action="./majDepartement.php?id=<?php echo $id;?>">
                
                <INPUT type="text" name="NOM_DPTM" placeholder="Nom du département" value='<?php echo $NOM_DPTM;?>'>
                <INPUT type="text" name="NOM_RESP" placeholder="Nom du responsable" value='<?php echo $NOM_RESP;?>'>
                <INPUT type="text" name="PRENOM_RESP" placeholder="Prénom du responsable" value='<?php echo $PRENOM_RESP;?>'>
                <INPUT type="text" name="NUM_DPTM" placeholder="Numéro du département" value='<?php echo $NUM_DPTM;?>'>
                <br><br>
                <INPUT class="submit" type="submit" value="Envoyer">
                <INPUT type="reset" value="Effacer">

        </FORM></div>
    
        </body>
    </html>   