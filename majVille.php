<?php

    include './pdo.php'; // Inclure le fichier pdo.php
    $connexion = connexionBDD(); // Appeler la fonction connexionBDD pour Ã©tablir la connexion
    $id = 0;
    if (isset($_GET['id'])) $id = $_GET['id'];
    $NOM_VILLE = $_POST['NOM_VILLE'];
    $CODE_POSTAL = $_POST['CODE_POSTAL'];
    $NB_TOURISTES = $_POST['NB_TOURISTES'];
    $ID_DEP = $_POST['ID_DEP'];

    $marequete=
    "UPDATE ville 
    SET NOM_VILLE = '$NOM_VILLE', CODE_POSTAL = '$CODE_POSTAL', NB_TOURISTES = $NB_TOURISTES, ID_DEP = $ID_DEP 
    WHERE ID_VILLE = $id ";

    $reqPreparee = $connexion->prepare($marequete);
    $reqPreparee->execute();

    header('Location:./listeVille.php?modification=1');
?>