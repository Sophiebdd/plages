<?php
session_start(); // Démarrage de la session
if (!isset($_SESSION['loggedin'])) header("Location: ./connexion.php?erreur=1");

header("Cache-Control: no-cache, must-revalidate");
header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); // Date passée pour forcer l'expiration immédiate ?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accueil</title>
    <link rel="stylesheet" type="text/css" href="./stylemenu.css"/>
</head>
<body>
<audio autoplay> <!-- on peut utiliser l'attribut loop pour que ce soit en boucle--> 
    <source src="./sonVagues.mp3" type="audio/mp3">
</audio>
<div class="menu"><br><br>
<?php include './menu.php' ; ?> <br><br>
</div>
<img src="./imgplage.jpg" width="600px">

</body>
</html>