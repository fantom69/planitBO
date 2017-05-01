<?php
    include("../../includes/dbconnexion.php");

    $liste = null;
    
    if(isset($_SESSION['user'])){ 
        $query = "SELECT u.idUtilisateur, u.nom, u.prenom, u.mail, u.lieu, u.latitude, u.longitude FROM t_utilisateur u INNER JOIN tj_etreami a on u.idUtilisateur = a.idUtilisateur_t_utilisateur AND a.idUtilisateur = '". $_SESSION['user'] ."';";
        $liste = $bdd->query($query)->fetchAll();        
    }

    echo json_encode($liste);
?>