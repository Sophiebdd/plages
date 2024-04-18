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
        <title>Liste plages</title>
        <meta charset="utf-8">
        <link rel="stylesheet" type="text/css" href="./stylemenu.css"/>
    </head>
    <body class="page1">
        <div class="menu"><br><br>
<?php include './menu.php' ; ?> <br><br>
        </div>
    
    <table class="liste">
    <thead>
        <tr>
            <th>ID PLAGE</th>
            <th>NOM PLAGE</th>
            <th>LONGUEUR</th>
            <th>ID VILLE</th>
            <th>TRAITEMENT</th>
        </tr>
    </thead>
    <tbody>
        <?php
        if ($connexion) {
            try {
                $query = "SELECT * FROM plage";
                $stmt = $connexion->query($query);
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    $ID_PLAGE = $row['ID_PLAGE'];
                    $NOM_PLAGE = $row['NOM_PLAGE'];
                    $LONGUEUR_PLAGE = $row['LONGUEUR_PLAGE'];
                    $ID_VILLE = $row['ID_VILLE'];
                    echo "<tr>
                            <td> $ID_PLAGE </td>
                            <td><a href='./fichePlage.php?id=$ID_PLAGE'> $NOM_PLAGE </a></td>
                            <td> $LONGUEUR_PLAGE </td>
                            <td><a href='./listeVille.php'> $ID_VILLE </td>
                            <td><a href='./modifierPlage.php?id=$ID_PLAGE'><button>Modifier</button>
                            <a href='./supprimerPlage.php?id=$ID_PLAGE' onclick=\"return confirm('Etes-vous sûr?')\"><button id='monBouton'>Supprimer</button></a></td>
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
<div class="redirect"><a href="./formPlage.php"><button>Vers le formulaire de création</button></a></div>

    </body>
</html>   