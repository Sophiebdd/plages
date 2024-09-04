<?php
include './pdo.php';
$connexion = connexionBDD();

$email = $_POST['email'];
$password = $_POST['password'];

// Hachage du mot de passe
$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

$marequete = "INSERT INTO connexion (id_connexion, password, email) VALUES (0, :password, :email)";
$reqPrepare = $connexion->prepare($marequete);
$reqPrepare->bindParam(':password', $hashedPassword);
$reqPrepare->bindParam(':email', $email);
$reqPrepare->execute();

header('location:./connexion.php?inscription=1');
?>