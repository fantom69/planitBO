<?php
    include("../../includes/dbconnexion.php");

    header('Access-Control-Allow-Origin: *');    
    header('Access-Control-Allow-Headers: X-Requested-With');
    header('Access-Control-Allow-Methods: POST, GET, OPTIONS');

    $data = (array) json_decode(file_get_contents('php://input')); 

    $liste = null;

    $query = "SELECT a.idProduit, p.libelleProduit, a.quantite, a.idUtilisateur FROM tj_amenerproduit a INNER JOIN t_produit p ON p.idProduit = a.idProduit AND p.idEvenement = '". $data['idEvenement'] ."' WHERE a.quantite > 0;";
    $liste = $bdd->query($query)->fetchAll();       

    echo json_encode($liste);
?>