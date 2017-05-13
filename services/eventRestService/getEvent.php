<?php
    include("../../includes/dbconnexion.php");

    header('Access-Control-Allow-Origin: *');    
    header('Access-Control-Allow-Headers: X-Requested-With');
    header('Access-Control-Allow-Methods: POST, GET, OPTIONS');

    $data = (array) json_decode(file_get_contents('php://input')); 

    $event = null;

    if(isset($_SESSION['user'])){ 
        try{
            $query = "SELECT idEvenement, libelle, description, dateDebut, dateFin, dateCreation, lieu, latitude, longitude, prix, idUtilisateur, statut FROM t_evenement where idEvenement = '". $data['idEvenement'] ."';";
            
            $event = $bdd->query($query)->fetch();      
        }
        catch(Exception $e){
        }  
    }

    echo json_encode($event);
?>