<?php

include './pdo.php'; 
$connexion = connexionBDD();

$NOM_PLAGE = $_POST['NOM_PLAGE'];
$LONGUEUR_PLAGE = $_POST['LONGUEUR_PLAGE'];
$ID_VILLE = $_POST['ID_VILLE'];



$marequete=
"INSERT INTO plage
VALUES(0,'$NOM_PLAGE','$LONGUEUR_PLAGE','$ID_VILLE'); ";
echo $marequete;



$reqPreparee = $connexion->prepare($marequete);
$reqPreparee->execute();

header('location:./listePlage.php?creation=1');



?>
