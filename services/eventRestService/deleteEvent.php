<?php
    include("../../includes/dbconnexion.php");

	header('Access-Control-Allow-Origin: *');    
    header('Access-Control-Allow-Headers: X-Requested-With');
    header('Access-Control-Allow-Methods: POST, GET, OPTIONS');
   
    $data = (array) json_decode(file_get_contents('php://input')); 
    
    try{

        $query = "DELETE FROM tj_participerevenement WHERE idEvenement = ?;";
        $prep = $bdd->prepare($query);
        $prep->bindValue(1, $data['idEvenement']);
        $prep->execute();

        
        //suppresion des quantites amenées
        $query = "SELECT idProduit FROM t_produit WHERE idEvenement  = '". $data['idEvenement'] ."';";
        $liste = $bdd->query($query)->fetchAll(); 

        for ($i = 0; $i < count($liste); $i++) {
            $query = "DELETE FROM tj_amenerproduit WHERE idProduit = ?;";
            $prep = $bdd->prepare($query);
            $prep->bindValue(1, $liste[$i]["idProduit"]);
            $prep->execute();
        }


        $query = "DELETE FROM t_produit WHERE idEvenement = ?;";
        $prep = $bdd->prepare($query);
        $prep->bindValue(1, $data['idEvenement']);
        $prep->execute();

        $query = "DELETE FROM t_evenement WHERE idEvenement = ?;";
        $prep = $bdd->prepare($query);
        $prep->bindValue(1, $data['idEvenement']);
        $prep->execute();

        

        echo json_encode(true);
    }
    catch(Exception $e){
        echo json_encode(false);
    }
?>