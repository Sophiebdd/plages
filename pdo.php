
<?php
function connexionBDD() {
    $servername = "localhost";
    $dbname = "gestionplages";
    $username = "root";
    $password = "";
    try {
        $connexion = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        echo "Vous êtes connecté<br>";
        return $connexion; // Retourner la connexion réussie
    } 
    catch(PDOException $e) {
        echo "La connexion a échouée: ".$e->getMessage()."<br>";
        return null; // Retourner null en cas d'échec de la connexion
    }
}
?>