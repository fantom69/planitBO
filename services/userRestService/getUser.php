<?php
    include("../../includes/dbconnexion.php");

    $liste = null;
    
    if(isset($_SESSION['user'])){ 
        $query = "SELECT idUtilisateur, nom, prenom, mail, lieu, latitude, longitude FROM t_utilisateur where idUtilisateur = '". $_SESSION['user'] ."';";
        $liste = $bdd->query($query)->fetch();        
    }

    echo json_encode($liste);
?>