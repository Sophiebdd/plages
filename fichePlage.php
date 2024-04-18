<?php
session_start(); // Démarrage de la session
if (!isset($_SESSION['loggedin'])) header("Location: ./connexion.php");
header("Cache-Control: no-cache, must-revalidate");
header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); 

    $id = 0;
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        // Inclure le fichier contenant la fonction de connexion
        include './pdo.php';
        // Appeler la fonction de connexion
        $connexion = connexionBDD();

        // requête pour afficher les détails de CETTE plage
        $requetePlage = "SELECT plage.*, ville.* FROM plage 
            INNER JOIN ville ON ville.ID_VILLE = plage.ID_PLAGE
            WHERE plage.ID_PLAGE = :id_plage";
        $reqPrepareePlage = $connexion->prepare($requetePlage);
        $reqPrepareePlage->bindParam(':id_plage', $id);
        $reqPrepareePlage->execute();

        // requête pour remplir la liste déroulante (pour associer un type de terrain à CETTE plage)
        $requeteListeTerrains = "SELECT * FROM nature_geo_plage";
        $reqPrepareeTerrains = $connexion->prepare($requeteListeTerrains);
        $reqPrepareeTerrains->execute();
        $resPrepareeTerrains = $reqPrepareeTerrains->fetchAll(PDO::FETCH_ASSOC);

        // requête pour lister les associations EXISTANTES (entre CETTE plage et certaines natures de terrains)
        $requeteAssociations =   "SELECT * 
            FROM nature_geo_plage ngp
            INNER JOIN composer ON composer.ID_GEO = ngp.ID_GEO
            where composer.ID_PLAGE = :id_plage";
        $reqPrepareeAssociations = $connexion->prepare($requeteAssociations);
        $reqPrepareeAssociations->bindParam(':id_plage', $id);
        $reqPrepareeAssociations->execute(); 

    }
?>

<!DOCTYPE HTML>
<html>
    <head lang="fr">
        <title>Fiche plage</title>
        <meta charset="utf-8">
        <link rel="stylesheet" type="text/css" href="./style.css"/>
        <script src="./node_modules/highcharts/highcharts.js"></script>
        <script src="./node_modules/highcharts/modules/variable-pie.js"></script>
        <script src="./node_modules/highcharts/modules/exporting.js"></script>
        <script src="./node_modules/highcharts/modules/export-data.js"></script>
        <script src="./node_modules/highcharts/modules/accessibility.js"></script>
        
            <style>
            table {
                border: solid;
                border-radius: 10px;
                padding: 20px;
                margin-left: 30%;
                text-align: center;
            }
            a {
                text-decoration: none;
            }
            </style>
    </head>
    <body>
        <div>

<?php
    if ($rowPlage = $reqPrepareePlage->fetch(PDO::FETCH_ASSOC)) {
        echo "<h1>Détails de la plage " . $rowPlage['NOM_PLAGE'] . "</h1>";
        echo "<p>Longueur en km: " . $rowPlage['LONGUEUR_PLAGE'] . "</p>";
        echo "<p>Nom de la ville: " .  $rowPlage['NOM_VILLE'] . "</p>";
    } 
?>

        </div>
        <div class='geologie'>
            <form action="./creerComposer.php" method="POST">
                
                <select name="ID_GEO">                
<?php 
    foreach ($resPrepareeTerrains as $rowTerrains) {
        echo "
                    <option value='" . $rowTerrains['ID_GEO'] . "'>" . $rowTerrains['LIBELLE']. "</option>";
    }
?>

                </select>
                <INPUT type="number" name="POURCENTAGE" min="1" max="100" placeholder="pourcentage">
                <INPUT type="hidden" name="ID_PLAGE" value="<?php echo $id; ?>">
                <INPUT type="submit" value='Associer'>
        
            </form>
        </div>
        <div class='association'>
<?php          
    $resRequeteAssociations = $reqPrepareeAssociations->fetchAll(PDO::FETCH_ASSOC);
    foreach ($resRequeteAssociations as $rowAssociations) {
         $POURCENTAGE = $rowAssociations['POURCENTAGE'];
         $LIBELLE = $rowAssociations['LIBELLE'];
        echo "
            $LIBELLE $POURCENTAGE <br>";
    }
    
    // Fermer la connexion
    $connexion = null;
?>
        </div>




<figure class="highcharts-figure">
    <div id="container"></div>
</figure>
<script>
Highcharts.chart('container', {
    chart: {
        type: 'variablepie'
    },
    title: {
        text: 'Part en pourcentage de chaque type de terrain sur cette plage:',
        align: 'center'
    },
    tooltip: {
        headerFormat: '',
        pointFormat: '<span style="color:{point.color}">\u25CF</span> <b> {point.name}</b><br/>' +
            'pourcentage: <b>{point.y}</b><br/>'  
    },
    series: [{
        minPointSize: 80,
        innerSize: '20%',
        zMin: 0,
        name: 'terrains',
        borderRadius: 5,
        data: [
                <?php foreach ($resRequeteAssociations as $rowAssociation) { ?>
                    {
                        name: '<?php echo $rowAssociation['LIBELLE']; ?>',
                        y: <?php echo $rowAssociation['POURCENTAGE']; ?>,
                    },
                <?php } ?>
            ],
        colors: [
            '#4caefe',
            '#3dc3e8',
            '#2dd9db',
            '#1feeaf',
            '#0ff3a0',
            '#00e887',
            '#2dd9db',
            '#23e274'
        ]
    }]
});
</script>
    </body>
</html>