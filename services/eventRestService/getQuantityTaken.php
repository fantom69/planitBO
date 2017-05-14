<?php
    include("../../includes/dbconnexion.php");

    header('Access-Control-Allow-Origin: *');    
    header('Access-Control-Allow-Headers: X-Requested-With');
    header('Access-Control-Allow-Methods: POST, GET, OPTIONS');

    $data = (array) json_decode(file_get_contents('php://input')); 

    $liste = null;

    $query = "SELECT idProduit, quantite as quantityTaken FROM tj_amenerproduit WHERE idUtilisateur = '".$_SESSION['user']."' ";
    $liste = $bdd->query($query)->fetchAll();       


    echo json_encode($liste);
?>