<?php
session_start(); // Démarrage de la session
if (!isset($_SESSION['loggedin'])) header("Location: ./connexion.php");
header("Cache-Control: no-cache, must-revalidate");
header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); // Date passée pour forcer l'expiration immédiate
include './pdo.php';
$connexion = connexionBDD();
if (isset($_GET['creation']) == 1) 
    echo "création réussie"; else echo "Pas de création en cours"; 
    
if (isset($_GET['modification']) == 1) 
    echo " modification réussie"; else echo " Pas de modification";
?>


<!DOCTYPE HTML>
<html>
    <head lang="fr">
        <title>Liste départements</title>
        <meta charset="utf-8">
        <link rel="stylesheet" type="text/css" href="./stylemenu.css"/>
       
    </head>

    <body class="page3">
        
    <div class="menu"><br><br>
<?php include './menu.php' ; ?> <br><br>

        </div>
    <table class="liste">
    <thead>
        <tr>
            <th>ID DEPT</th>
            <th>NOM RESPONSABLE</th>
            <th>PRENOM RESPONSABLE</th>
            <th>DEPARTEMENT</th>
            <th>NUMERO</th>
            <th>TRAITEMENT</th>
        </tr>
    </thead>
    <tbody>
        <?php
        if ($connexion) {
            try {
           
                $query = "SELECT * FROM responsable_departemental";
                $stmt = $connexion->query($query);

           
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                   $ID_DEP = $row['ID_DEP'];
                   $NOM_RESP = $row['NOM_RESP'];
                   $PRENOM_RESP = $row['PRENOM_RESP'];
                   $NOM_DPTM = $row['NOM_DPTM'];
                   $NUM_DPTM = $row['NUM_DPTM'];

                    echo "<tr>
                    <td>  $ID_DEP </td>
                    <td> $NOM_RESP </td>
                    <td>  $PRENOM_RESP </td>
                    <td><a href='./ficheDepartement.php?id=$ID_DEP'> $NOM_DPTM </a></td>
                    <td>  $NUM_DPTM </td>
                    <td><a href='./modifierDepartement.php?id=$ID_DEP'><button>Modifier</button>
                            <a href='./supprimerDepartement.php?id=$ID_DEP' onclick=\"return confirm('Etes-vous sûr?')\"><button id='monBouton'>Supprimer</button></a></td>
                    </tr>";
                }
            } catch (PDOException $e) {
                echo "Erreur: " . $e->getMessage();
            }

           
            $connexion = null;
        } else {
            echo "<tr><td colspan='3'>La connexion à la base de données a échoué</td></tr>";
        }
        ?>
    </tbody>
</table>
<br>
<div class="redirect"><a href="./formDepartement.php"><button>Vers le formulaire de création</button></a></div>

    
    </body>
</html>   