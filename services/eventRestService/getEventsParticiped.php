<?php
    include("../../includes/dbconnexion.php");

    $liste = null;
    
    if(isset($_SESSION['user'])){ 
        $query = "SELECT e.idEvenement, e.libelle, e.description, e.dateDebut, e.dateCreation, e.lieu, e.prix, e.idUtilisateur, ev.statut FROM t_evenement e INNER JOIN tj_participerevenement ev ON ev.idEvenement = e.idEvenement AND ev.idUtilisateur = '". $_SESSION['user'] ."';";
        $liste = $bdd->query($query)->fetchAll();       
    }

    echo json_encode($liste);
?>