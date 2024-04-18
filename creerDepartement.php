<?php

include './pdo.php'; 
$connexion = connexionBDD();


$NOM_DPTM = $_POST['NOM_DPTM'];
$NOM_RESP = $_POST['NOM_RESP'];
$PRENOM_RESP = $_POST['PRENOM_RESP'];
$NUM_DPTM = $_POST['NUM_DPTM'];



echo"$NOM_DPTM<br><br>";
echo"$NOM_RESP<br><br>";
echo"$PRENOM_RESP<br><br>";
echo"$NUM_DPTM<br><br>";


$marequete=
"INSERT INTO responsable_departemental
VALUES(0,'$NOM_RESP','$PRENOM_RESP','$NOM_DPTM','$NUM_DPTM'); ";


$reqPreparee = $connexion->prepare($marequete);
$reqPreparee->execute();

header('location:./formDepartement.php');


?>
