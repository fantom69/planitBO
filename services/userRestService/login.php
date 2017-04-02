<?php
    include("../../includes/dbconnexion.php");

	header('Access-Control-Allow-Origin: *');    
    header('Access-Control-Allow-Headers: X-Requested-With');
    header('Access-Control-Allow-Methods: POST, GET, OPTIONS');

    $data = (array) json_decode(file_get_contents('php://input')); 

    $returnData = false;

    //verification mot de passe
    try{
        $query = "SELECT idUtilisateur, password FROM t_utilisateur where mail = '". $data['mail'] ."';";
        $liste = $bdd->query($query)->fetchAll();
    }
    catch(Exception $e){

    }

    if(count($liste) > 0){
        if(sha1($data['password'] . $data['mail']) == $liste[0]['password']){
            $_SESSION['user'] = $liste[0]['idUtilisateur'];
             $returnData = true;
        }
        else{
            $returnData = false;
        }
    }
    else{
        $returnData = false;
    }

    echo json_encode($returnData);
?>