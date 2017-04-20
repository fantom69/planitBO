<?php
    include("../../includes/dbconnexion.php");

    header('Access-Control-Allow-Origin: *');    
    header('Access-Control-Allow-Headers: X-Requested-With');
    header('Access-Control-Allow-Methods: POST, GET, OPTIONS');

    $data = (array) json_decode(file_get_contents('php://input')); 

    $liste = null;

    if(isset($_SESSION['user'])){ 
        $query = "SELECT idEvenement, libelle, description, dateDebut, dateFin, dateCreation, lieu, latitude, longitude, prix, idUtilisateur FROM t_evenement where idEvenement = '". $data['idEvent'] ."';";
        
        $liste = $bdd->query($query)->fetch();        
    }

    echo json_encode($liste);
?>