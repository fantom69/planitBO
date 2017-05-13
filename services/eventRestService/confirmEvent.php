<?php
    include("../../includes/dbconnexion.php");

	header('Access-Control-Allow-Origin: *');    
    header('Access-Control-Allow-Headers: X-Requested-With');
    header('Access-Control-Allow-Methods: POST, GET, OPTIONS');
   

    $data = (array) json_decode(file_get_contents('php://input')); 


    if(isset($_SESSION['user'])){ 
        $query = "UPDATE t_evenement SET statut = 'confirmation' WHERE idEvenement = ? AND idUtilisateur = ? ;";
        $prep = $bdd->prepare($query);
        $prep->bindValue(1,  $data['idEvenement']); 
        $prep->bindValue(2, $_SESSION['user']); 
        $prep->execute();   

        echo json_encode(true);
    }
    else{
        echo json_encode(false);
    }

    
?>