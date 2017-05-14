<?php
    include("../../includes/dbconnexion.php");

	header('Access-Control-Allow-Origin: *');    
    header('Access-Control-Allow-Headers: X-Requested-With');
    header('Access-Control-Allow-Methods: POST, GET, OPTIONS');
   

    $data = (array) json_decode(file_get_contents('php://input')); 


     try{

        //suppresion des quantites amenées pour ce user
        $query = "SELECT idProduit FROM t_produit WHERE idEvenement  = '". $data['idEvenement'] ."';";
        $liste = $bdd->query($query)->fetchAll(); 

        for ($i = 0; $i < count($liste); $i++) {
            $query = "DELETE FROM tj_amenerproduit WHERE idProduit = ? AND idUtilisateur = '". $_SESSION['user'] ."';";
            $prep = $bdd->prepare($query);
            $prep->bindValue(1, $liste[$i]["idProduit"]);
            $prep->execute();
        }

        //ajout des produits restants
        for ($i = 0; $i < count($data['productsRequired']); $i++) {
            $produit = $data['productsRequired'][$i];
            $query = "INSERT INTO tj_amenerproduit(idProduit, idUtilisateur, quantite) VALUES(?,?,?);";
            $prep = $bdd->prepare($query);
            $prep->bindValue(1, $produit->idProduit);
            $prep->bindValue(2, $_SESSION['user']);
            $prep->bindValue(3, $produit->quantityTaken);
            $prep->execute();
        }

        echo json_encode(true);
    }
    catch(Exception $e){
        echo json_encode(false);
    }

?>