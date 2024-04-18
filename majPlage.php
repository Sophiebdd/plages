<?php

include './pdo.php'; 
$connexion = connexionBDD();
$id = 0;
if (isset($_GET['id'])) $id = $_GET['id'];
$NOM_PLAGE = $_POST['NOM_PLAGE'];
$LONGUEUR_PLAGE = $_POST['LONGUEUR_PLAGE'];
$ID_VILLE = $_POST['ID_VILLE'];


$marequete=
"UPDATE plage
SET NOM_PLAGE = '$NOM_PLAGE', LONGUEUR_PLAGE = '$LONGUEUR_PLAGE', ID_VILLE = '$ID_VILLE' 
WHERE ID_PLAGE = $id ";
echo $marequete;



$reqPreparee = $connexion->prepare($marequete);
$reqPreparee->execute();

header('location:./listePlage.php?modification=1');



?>