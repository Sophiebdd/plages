<?php
    include './pdo.php'; // Inclure le fichier pdo.php
    $connexion = connexionBDD(); // Appeler la fonction connexionBDD pour établir la connexion

    // Vérifier si la connexion est établie avec succès
    if ($connexion) {
        // Vérifier si l'ID de la ville à supprimer est passé en paramètre dans l'URL
        if (isset($_GET['id'])) {
            $id_geo = $_GET['id'];

            try {
                // Supprimer d'abord les enregistrements liés dans la table composer
                /*$query_composer = "DELETE FROM composer WHERE ID_PLAGE IN (SELECT ID_PLAGE FROM plage WHERE ID_VILLE = :id_ville)";
                $stmt_composer = $connexion->prepare($query_composer);
                $stmt_composer->bindParam(':id_ville', $id_ville);
                $stmt_composer->execute();

                // Ensuite, supprimer les enregistrements liés dans la table plage
                $query_plage = "DELETE FROM plage WHERE ID_VILLE = :id_ville";
                $stmt_plage = $connexion->prepare($query_plage);
                $stmt_plage->bindParam(':id_ville', $id_ville);
                $stmt_plage->execute();*/

                // Enfin, supprimer la ville de la table ville (dans les tables composer et plage, faire structure -> vue relationnelle et mettre les contraintes en cascade sinon erreur "impossible de supprimer car contrainte parent)
                $query_geo = "DELETE FROM nature_geo_plage WHERE ID_GEO = :id_geo";
                $stmt_geo = $connexion->prepare($query_geo);
                $stmt_geo->bindParam(':id_geo', $id_geo);
                $stmt_geo->execute();

                // Rediriger vers la page de liste des villes après la suppression réussie
                header('Location:./listeGeologie.php?suppression=1');
                exit(); // Terminer le script après la redirection
            } catch (PDOException $e) {
                echo "Erreur lors de la suppression de la géologie : " . $e->getMessage();
            }
        } else {
            echo "ID de la géologie non fourni pour la suppression.";
        }
    } else {
        echo "La connexion à la base de données a échoué.";
    }
?>