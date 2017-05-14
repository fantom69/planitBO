<?php
    include("../../includes/dbconnexion.php");

	header('Access-Control-Allow-Origin: *');    
    header('Access-Control-Allow-Headers: X-Requested-With');
    header('Access-Control-Allow-Methods: POST, GET, OPTIONS');
   

    $data = (array) json_decode(file_get_contents('php://input')); 

     try{
        //MAJ des items d'un evenement
        $query = "UPDATE tj_participerevenement SET statut = 'refus' WHERE idEvenement = ? AND idUtilisateur = ? ;";
        $prep = $bdd->prepare($query);
        $prep->bindValue(1,  $data['idEvenement']); 
        $prep->bindValue(2, $_SESSION['user']); 
        $prep->execute();

        //suppresion des quantites amenées pour le user connecté
        $query = "SELECT idProduit FROM t_produit WHERE idEvenement  = '". $data['idEvenement'] ."';";
        $liste = $bdd->query($query)->fetchAll(); 

        for ($i = 0; $i < count($liste); $i++) {
            $query = "DELETE FROM tj_amenerproduit WHERE idProduit = ? AND idUtilisateur = '". $_SESSION['user'] ."';";
            $prep = $bdd->prepare($query);
            $prep->bindValue(1, $liste[$i]["idProduit"]);
            $prep->execute();
        }

        echo json_encode(true);
    }
    catch(Exception $e){
        echo json_encode(false);
    }

?>