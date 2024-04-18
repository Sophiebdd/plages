<?php

include './pdo.php'; // Inclure le fichier pdo.php
$connexion = connexionBDD(); // Appeler la fonction connexionBDD pour établir la connexion

//$username = "root";
//$password = "";
//$link = new PDO("mysql:host=localhost;dbname=gestionplages", $username, $password);


$NOM_VILLE = $_POST['NOM_VILLE'];
$CODE_POSTAL = $_POST['CODE_POSTAL'];
$NB_TOURISTES = $_POST['NB_TOURISTES'];
$ID_DEP = $_POST['ID_DEP'];


$marequete=
"INSERT INTO ville
VALUES(0,'$NOM_VILLE','$CODE_POSTAL','$NB_TOURISTES','$ID_DEP'); ";
//echo $marequete;

/*$link->query($marequete);*/

$reqPreparee = $connexion->prepare($marequete);
$reqPreparee->execute();
//ne fonctionne pas: "Fatal error: Uncaught Error: Call to undefined method PDO::close() in..." 
/*$link->close();*/
header('location:./listeVille.php?creation=1');


?>
