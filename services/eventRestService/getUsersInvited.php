<?php
    include("../../includes/dbconnexion.php");

    header('Access-Control-Allow-Origin: *');    
    header('Access-Control-Allow-Headers: X-Requested-With');
    header('Access-Control-Allow-Methods: POST, GET, OPTIONS');

    $data = (array) json_decode(file_get_contents('php://input')); 

    $liste = null;

    $query = "SELECT u.idUtilisateur, u.nom, u.prenom, u.mail, u.lieu, u.latitude, u.longitude FROM t_utilisateur u INNER JOIN tj_participerevenement t on t.idUtilisateur = u.idUtilisateur AND t.idEvenement =  '". $data['idEvenement'] ."';";
    
    $liste = $bdd->query($query)->fetchAll();       
        

    echo json_encode($liste);
?>