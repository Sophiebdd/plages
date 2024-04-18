<?php
   // Inclure le fichier contenant la fonction de connexion
   include './pdo.php';
   // Appeler la fonction de connexion
   $connexion = connexionBDD();
   $ID_GEO=$_POST['ID_GEO'];
   $ID_PLAGE=$_POST['ID_PLAGE'];
    $POURCENTAGE=$_POST['POURCENTAGE'];
    $marequete=
    "INSERT INTO composer
    VALUES($ID_PLAGE,$ID_GEO, $POURCENTAGE);";
    //echo $marequete;
    $reqPreparee = $connexion->prepare($marequete);
    $reqPreparee->execute();
    $url="Location:./fichePlage.php?id=$ID_PLAGE";
    header($url);
?>