<?php
    include("../../includes/dbconnexion.php");

	header('Access-Control-Allow-Origin: *');    
    header('Access-Control-Allow-Headers: X-Requested-With');
    header('Access-Control-Allow-Methods: POST, GET, OPTIONS');
   

    $data = (array) json_decode(file_get_contents('php://input')); 

     try{
        //MAJ des items d'un evenement
        $query = "UPDATE tj_participerevenement SET statut = 'participation' WHERE idEvenement = ? AND idUtilisateur = ? ;";
        $prep = $bdd->prepare($query);
        $prep->bindValue(1,  $data['idEvenement']); 
        $prep->bindValue(2, $_SESSION['user']); 
        $prep->execute();

        echo json_encode(true);
    }
    catch(Exception $e){
        echo json_encode(false);
    }

?>