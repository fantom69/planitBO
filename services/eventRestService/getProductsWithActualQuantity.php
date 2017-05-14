<?php
    include("../../includes/dbconnexion.php");

    header('Access-Control-Allow-Origin: *');    
    header('Access-Control-Allow-Headers: X-Requested-With');
    header('Access-Control-Allow-Methods: POST, GET, OPTIONS');

    $data = (array) json_decode(file_get_contents('php://input')); 

    $liste = null;

    $query = "SELECT p.idProduit, p.libelleProduit, p.uniteProduit, SUM(a.quantite) AS quantityActual, p.idEvenement FROM t_produit p LEFT OUTER JOIN tj_amenerproduit a ON a.idProduit = p.idProduit WHERE idEvenement = '".$data['idEvenement']."'  GROUP BY p.idProduit ;";
    
    $liste = $bdd->query($query)->fetchAll();       

    /*for ($i = 0; $i < count($liste); $i++) {
        $query = "SELECT quantite as quantityTaken FROM tj_amenerproduit WHERE idProduit = '".$liste[$i]["idProduit"]."' AND idUtilisateur = '".$_SESSION['user']."' ";
        $liste['quantityTaken'][$i] = $bdd->query($query)->fetch();       
    }*/

    echo json_encode($liste);
?>