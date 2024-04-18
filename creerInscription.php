<?php
include './pdo.php'; 
$connexion = connexionBDD();

$email = $_POST['email'];
$password = $_POST['password'];

$marequete=
"INSERT INTO connexion
VALUES(0, '$password', '$email'); ";

$reqPreparee = $connexion->prepare($marequete);
$reqPreparee->execute();
header('location:./connexion.php?inscription=1');
?>
