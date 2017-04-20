<?php
    include("../../includes/dbconnexion.php");

    $liste = null;
    
    if(isset($_SESSION['user'])){ 
        //retourne les evenements crées par une personne
        $query = "SELECT idEvenement, libelle, description, dateDebut, dateCreation, lieu, prix, idUtilisateur  FROM t_evenement where idUtilisateur = '". $_SESSION['user'] ."';";
        $liste = $bdd->query($query)->fetchAll();        
    }

    echo json_encode($liste);
?>