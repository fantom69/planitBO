<?php
    include("../../includes/dbconnexion.php");

	header('Access-Control-Allow-Origin: *');    
    header('Access-Control-Allow-Headers: X-Requested-With');
    header('Access-Control-Allow-Methods: POST, GET, OPTIONS');
   

    $data = (array) json_decode(file_get_contents('php://input')); 
    $date = new DateTime();

     try{

        $query = "UPDATE t_evenement SET libelle = ?, description = ?, dateDebut = ?, dateFin = ?, lieu = ?, latitude = ?, longitude = ?, prix = ? WHERE idEvenement = ? AND idUtilisateur = ? ;";
        $prep = $bdd->prepare($query);
        $prep->bindValue(1, $data['libelle']);
        $prep->bindValue(2, $data['description']);
        $prep->bindValue(3, $data['dateDebut']);
        $prep->bindValue(4, $data['dateFin']); 
        $prep->bindValue(5, $data['lieu']); 
        $prep->bindValue(6, $data['latitude']); 
        $prep->bindValue(7, $data['longitude']); 
        $prep->bindValue(8, $data['prix']); 
        $prep->bindValue(9,  $data['idEvenement']); 
        $prep->bindValue(10, $_SESSION['user']); 

        $prep->execute();

        echo json_encode(true);
    }
    catch(Exception $e){
        echo json_encode(false);
    }

?>