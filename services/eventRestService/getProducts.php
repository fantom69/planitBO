<?php
    include("../../includes/dbconnexion.php");

    header('Access-Control-Allow-Origin: *');    
    header('Access-Control-Allow-Headers: X-Requested-With');
    header('Access-Control-Allow-Methods: POST, GET, OPTIONS');

    $data = (array) json_decode(file_get_contents('php://input')); 

    $liste = null;

    $query = "SELECT idProduit, libelleProduit, uniteProduit, idEvenement FROM t_produit where idEvenement = '".$data['idEvenement']."';";
    
    $liste = $bdd->query($query)->fetchAll();       
        

    echo json_encode($liste);
?>