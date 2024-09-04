<?php
include './pdo.php'; 
$connexion = connexionBDD();
session_start(); 

// Condition pour vérifier si les données du formulaire ont été soumises
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];
   
    // Cette requête vérifie si l'email saisi est le même que dans la base de données
    $query = "SELECT * FROM connexion WHERE email = :email";
    $statement = $connexion->prepare($query);
    $statement->bindParam(':email', $email);
    $statement->execute();
    
    if ($statement->rowCount() > 0) {
        // si il y a une ligne retournée, on récupère les données de l'utilisateur
        $result = $statement->fetch(PDO::FETCH_ASSOC);
        
        // Cette méthode vérifie si le mot de passe saisi correspond au mot de passe haché stocké
        if (password_verify($password, $result['password'])) {
            // Si la connexion réussit, on stocke les données dans la session
            $_SESSION['email'] = $email;
            $_SESSION['loggedin'] = true;
            echo "Connexion réussie";
            header('location:./accueil.php');
            exit; 
        } else {
            echo "Identifiant ou mot de passe incorrect";
            echo "<script>setTimeout(function(){ window.location.href = './connexion.php'; }, 3000);</script>";
            exit; 
        }
    } else {
        echo "Identifiant ou mot de passe incorrect";
        echo "<script>setTimeout(function(){ window.location.href = './connexion.php'; }, 3000);</script>";
        exit; 
    }
}
?>