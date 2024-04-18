<?php

include './pdo.php'; 
$connexion = connexionBDD();

$id = 0;
if (isset($_GET['id'])) $id = $_GET['id'];

$NOM_DPTM = $_POST['NOM_DPTM'];
$NOM_RESP = $_POST['NOM_RESP'];
$PRENOM_RESP = $_POST['PRENOM_RESP'];
$NUM_DPTM = $_POST['NUM_DPTM'];



$marequete=
"UPDATE responsable_departemental
SET NOM_RESP = '$NOM_RESP', PRENOM_RESP = '$PRENOM_RESP', NOM_DPTM = '$NOM_DPTM', NUM_DPTM = '$NUM_DPTM'
WHERE ID_DEP = $id ";


$reqPreparee = $connexion->prepare($marequete);
$reqPreparee->execute();

header('location:./listeDepartement.php?modification = 1');


?>