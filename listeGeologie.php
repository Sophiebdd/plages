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
        <title>Liste géologies</title>
        <meta charset="utf-8">
        <link rel="stylesheet" type="text/css" href="./stylemenu.css"/>
        
            
    </head>

    <body class="page4">
    <div class="menu"><br><br>
<?php include './menu.php' ; ?> <br><br>

        </div>   
    
    <table class="liste">
    <thead>
        <tr>
            <th>ID GEO</th>
            <th>LIBELLE</th>
            <th>TRAITEMENT</th>
        </tr>
    </thead>
    <tbody>
        <?php
        if ($connexion) {
            try {
          
                $query = "SELECT * FROM nature_geo_plage";
                $stmt = $connexion->query($query);

    
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                     $ID_GEO = $row['ID_GEO'];
                     $LIBELLE = $row['LIBELLE'];
                    echo "<tr>
                        <td><a href='./listePlage.php'> $ID_GEO </a></td>
                        <td><a href='./ficheGeologie.php?id=$ID_GEO'> $LIBELLE </a></td>
                        <td><a href='./modifierGeologie.php?id=$ID_GEO'><button>Modifier</button>
                            <a href='./supprimerGeologie.php?id=$ID_GEO' onclick=\"return confirm('Etes-vous sûr?')\"><button id='monBouton'>Supprimer</button></a></td>
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
<div class="redirect"><a href="./formGeologie.php"><button>Vers le formulaire de création</button></a></div>
    
    </body>
</html>   