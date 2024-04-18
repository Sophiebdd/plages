<?php

include './pdo.php'; 
$connexion = connexionBDD();

$id = 0;
if (isset($_GET['id'])) $id = $_GET['id'];
$LIBELLE = $_POST['LIBELLE'];



$marequete=
"UPDATE nature_geo_plage
SET LIBELLE = '$LIBELLE'
WHERE ID_GEO = $id";
echo $marequete;



$reqPreparee = $connexion->prepare($marequete);
$reqPreparee->execute();

header('location:./listeGeologie.php?modification=1');


?>