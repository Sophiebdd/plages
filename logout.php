<?php

session_start();
session_destroy();
header("location:./connexion.php");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Déconnexion en cours</title>
    <script>
        // Redirige l'utilisateur vers la page de connexion après la déconnexion
        setTimeout(function() {
            window.location.href = "./connexion.php";
        }, 1000); // Redirige après 1 seconde (facultatif)
    </script>
</head>
<body>
    <p>Déconnexion en cours...</p>
</body>
</html>