<?php

include './pdo.php'; 
$connexion = connexionBDD();

$LIBELLE = $_POST['LIBELLE'];


$marequete=
"INSERT INTO nature_geo_plage
VALUES(0,'$LIBELLE'); ";
echo $marequete;



$reqPreparee = $connexion->prepare($marequete);
$reqPreparee->execute();

header('location:./listeGeologie.php?creation=1');


?>