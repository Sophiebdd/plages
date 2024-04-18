<?php
session_start(); // Démarrage de la session
if (!isset($_SESSION['loggedin'])) header("Location: ./connexion.php");
header("Cache-Control: no-cache, must-revalidate");
header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); 
include "./pdo.php";
$link = connexionBDD();
$requeteDep = 'SELECT ID_DEP, NOM_DPTM FROM responsable_departemental';
$reqPrepareeDep = $link->prepare($requeteDep);
$reqPrepareeDep->execute(); // Exécutez la requête préparée
$resRequeteDep = $reqPrepareeDep->fetchAll(PDO::FETCH_ASSOC); // Obtenez tous les résultats de la requête
$id = 0;
if (isset($_GET['id'])) $id = $_GET['id'];
$requeteVille = "SELECT * FROM ville where ID_VILLE = $id";
$reqPrepareeVille = $link->prepare($requeteVille);
$reqPrepareeVille->execute(); // Exécutez la requête préparée
$resRequeteVille = $reqPrepareeVille->fetchAll(PDO::FETCH_ASSOC);
foreach ($resRequeteVille as $rowVille) {
    $ville = $rowVille['NOM_VILLE'];
    $CP = $rowVille['CODE_POSTAL'];
    $NBT = $rowVille['NB_TOURISTES'];
    $IDD = $rowVille['ID_DEP'];
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <link href="">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title>Modifier ville</title>
</head>
<body>
    <div class="nav">
    </div>
    
    <div class="form">
        <div class="formulaire">
            <form action="./majVille.php?id=<?php echo $id;?>" method="POST">

                <INPUT type="text" name="NOM_VILLE" placeholder="Nom de la ville" value='<?php echo $ville;?>'>
                <INPUT type="text" name="CODE_POSTAL" placeholder="Code Postal" value='<?php echo $CP;?>'>
                <INPUT type="int" name="NB_TOURISTES" placeholder="Nombre de touristes" value='<?php echo $NBT;?>'>

                <select  name="ID_DEP">    
                <?php // faire une boucle foreach pour afficher tous les départements
                    foreach ($resRequeteDep as $rowDep) {
                        if ($rowDep['ID_DEP'] == $IDD)
                            echo "
                        <option value='" . $rowDep['ID_DEP'] . "' selected>" . $rowDep['NOM_DPTM'] . "</option>";
                        else 
                            echo "
                        <option value='" . $rowDep['ID_DEP'] . "' >" . $rowDep['NOM_DPTM'] . "</option>";
                    }
                ?>
                
                </select><br><br>
                <input type="submit" value="modifier">
                
            </form>  
        </div>    
    </div>
</body>
</html>