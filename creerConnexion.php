<?php
include './pdo.php'; 
$connexion = connexionBDD();
session_start(); // Démarre une nouvelle session ou reprend une session existante
//$_SESSION['loggedin'] = true
// Vérifie si les données du formulaire ont été soumises
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupère les données du formulaire
    $email = $_POST['email'];
    $password = $_POST['password'];
   
    // Requête pour vérifier si l'email et le mot de passe correspondent dans la base de données
    $query = "SELECT * FROM connexion WHERE email = :email AND password = :password";
    $statement = $connexion->prepare($query);
    $statement->bindParam(':email', $email);
    $statement->bindParam(':password', $password);
    $statement->execute();
    
    // Vérifie si une ligne est retournée (correspondance trouvée)
    if ($statement->rowCount() > 0) {
        // Si la connexion réussit, stocke les données dans la session
        $_SESSION['email'] = $email;
        $_SESSION['loggedin'] = true;
       
        echo "Connexion réussie";
        header('location:./accueil.php');
        exit; // Assure que le script s'arrête après la redirection} 
        
    } else {
        // Si l'identifiant ou le mot de passe est incorrect, affiche le message pendant 5 secondes
        echo "Identifiant ou mot de passe incorrect";
        // Attente de 5 secondes avant la redirection
        echo "<script>setTimeout(function(){ window.location.href = './connexion.php'; }, 3000);</script>";
        exit; // Assure que le script s'arrête après la redirection
    }
}
?>