<?php
session_start(); // Démarrage de la session
if (!isset($_SESSION['loggedin'])) header("Location: ./connexion.php");
header("Cache-Control: no-cache, must-revalidate");
header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); 
include "./pdo.php";
$link = connexionBDD();
$requeteVille = 'SELECT ID_VILLE, NOM_VILLE FROM ville';
$reqPrepareeVille = $link->prepare($requeteVille);
$reqPrepareeVille->execute(); 
$resRequeteVille = $reqPrepareeVille->fetchAll(PDO::FETCH_ASSOC); 

$id = 0;
if (isset($_GET['id'])) $id = $_GET['id'];
$requetePlage = "SELECT * FROM plage where ID_PLAGE = $id";
$reqPrepareePlage = $link->prepare($requetePlage);
$reqPrepareePlage->execute();
$resRequetePlage = $reqPrepareePlage->fetchAll(PDO::FETCH_ASSOC);
foreach ($resRequetePlage as $rowPlage) {
    $plage = $rowPlage['NOM_PLAGE'];
    $longueurPlage = $rowPlage['LONGUEUR_PLAGE'];
    $IDVILLE = $rowPlage['ID_VILLE'];
}
?>


<!DOCTYPE HTML>
<html>
    <head lang="fr">
        <title>Modifier plage</title>
        <meta charset="utf-8">
        <link rel="stylesheet" type="text/css" href="./style.css"/>
    </head>

    <body>
        <div class="nav"></div>
            <div class="form">
            <FORM method="POST" action="./majPlage.php?id=<?php echo $id;?>">
                
                <INPUT type="text" name="NOM_PLAGE" placeholder="Nom de la plage" value='<?php echo $plage;?>'>
                <INPUT type="text" name="LONGUEUR_PLAGE" placeholder="Longueur de la plage" value='<?php echo $longueurPlage;?>'>
                <select name="ID_VILLE">
                <?php
                   
               foreach ($resRequeteVille as $rowVille) {
                if ($rowVille['ID_VILLE'] == $IDVILLE)
                   echo "<option value='" . $rowVille['ID_VILLE'] . "' selected>" . $rowVille['NOM_VILLE'] . "</option>";
                   else 
                   echo "
               <option value='" . $rowVille['ID_VILLE'] . "' >" . $rowVille['NOM_VILLE'] . "</option>";
                }
           
               ?>
                </select>
                <br><br>
                <INPUT class="submit" type="submit" value="modifier">
                <INPUT type="reset" value="Effacer">

        </FORM></div>
    
        </body>
    </html>   