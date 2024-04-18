<?php 
header("Cache-Control: no-cache, must-revalidate");
header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); // Date passée pour forcer l'expiration immédiate 
$message_inscription = isset($_GET['inscription']) && $_GET['inscription'] == 1 ? "Votre inscription a été réalisée avec succès. Veuillez maintenant vous connecter." : "";
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="./styleconnexion.css"/>
    <title>Connexion</title>
</head>
<body>
    
   
    <div class="formulaire">
        <div class="message">
<?php
    echo $message_inscription; 
?> 

        <br><br></div>
        <div class="connexion">
            Veuillez vous connecter ici: <br><br>
            <form method="POST" action="./creerConnexion.php">
                <label>Identifiant (e-mail)</label><br>
                <input type="email" name="email" placeholder="Saisissez votre e-mail" required>
                <br><br>
                <label>Mot de passe</label><br>
                <input type="password" name="password" required>
                <br><br>
                <input class="submit" type="submit" value="Connexion">
                <input type="reset" value="Effacer">
            </form>
        </div>
        <div class="inscription">
            Vous n'avez pas de compte? Veuillez le créer ici:<br><br>
            <form method="POST" action="./creerInscription.php">
                <label>Identifiant (e-mail)</label><br>
                <input type="email" name="email" placeholder="Saisissez votre e-mail" required>
                <br><br>
                <label>Mot de passe</label><br>
                <input type="password" name="password" pattern="^(?=.*[A-Za-z])[A-Za-z\d]{6,}$" title="Le mot de passe doit contenir au moins 6 caractères" required>
                <br><br>
                <input class="submit" type="submit" value="Inscription">
                <input type="reset" value="Effacer">
            </form>
        </div>
    </div>

    
</body>
</html>