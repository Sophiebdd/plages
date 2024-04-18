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
        <title>Liste villes</title>
        <meta charset="utf-8">
        <link rel="stylesheet" type="text/css" href="./stylemenu.css"/>     
    </head>

    <body class="page2">
    <div class="menu"><br><br>
<?php include './menu.php' ; ?> <br><br>

        </div>
    
    <table class="liste">
    <thead>
        <tr>
            <th>ID VILLE</th>
            <th>NOM DE LA VILLE</th>
            <th>CODE POSTAL</th>
            <th>NB DE TOURISTES</th>
            <th>ID DEPARTEMENT</th>
            <th>TRAITEMENT</th>
        </tr>
    </thead>
    <tbody>
        <?php
        // Vérifier si la connexion est établie avec succès
        if ($connexion) {
            try {
                // Requête SQL pour récupérer les données
                $query = "SELECT * FROM ville";
                $stmt = $connexion->query($query);
                // Affichage des données dans le tableau
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    $ID_VILLE = $row['ID_VILLE'];
                    $CODE_POSTAL = $row['CODE_POSTAL'];
                    $NOM_VILLE = $row['NOM_VILLE'];
                    $NB_TOURISTES = $row['NB_TOURISTES'];
                    $ID_DEP = $row['ID_DEP'];
                    echo "<tr>
                            <td>$ID_VILLE</td>
                            <td><a href='./ficheVille.php?id=$ID_VILLE'>$NOM_VILLE</a></td>
                            <td>$CODE_POSTAL</td>
                            <td>$NB_TOURISTES</td>
                            <td>$ID_DEP</td>
                            <td><a href='./modifierVille.php?id=$ID_VILLE'><button>Modifier</button></a>
                            <a href='./supprimerVille.php?id=$ID_VILLE' onclick=\"return confirm('Etes-vous sûr?')\"><button id='monBouton'>Supprimer</button></a></td>
                        </tr>";
                }
            } catch (PDOException $e) {
                echo "Erreur: " . $e->getMessage();
            }
            // Fermer la connexion
            $connexion = null;
        } else {
            echo "<tr><td colspan='3'>La connexion à la base de données a échoué</td></tr>";
        }
        ?>
    </tbody>
</table>

<br>
<div class="redirect"><a href="./formVille.php"><button>Vers le formulaire de création</button></a></div>
    
    </body>
</html>   