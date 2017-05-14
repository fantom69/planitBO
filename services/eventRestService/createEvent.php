<?php
    include("../../includes/dbconnexion.php");

	header('Access-Control-Allow-Origin: *');    
    header('Access-Control-Allow-Headers: X-Requested-With');
    header('Access-Control-Allow-Methods: POST, GET, OPTIONS');
   

    $data = (array) json_decode(file_get_contents('php://input')); 
    $date = new DateTime();
    
     try{
        
        //Ajout evenement
        $query = "INSERT INTO t_evenement(libelle, description, dateDebut, dateFin, dateCreation, lieu, latitude, longitude, prix, idUtilisateur, statut ) VALUES(?,?,?,?,?,?,?,?,?,?, ?);";
        $prep = $bdd->prepare($query);
        $prep->bindValue(1, $data['libelle']);
        $prep->bindValue(2, $data['description'] );
        $prep->bindValue(3, $data['dateDebut']);
        $prep->bindValue(4, $data['dateFin']); 
        $prep->bindValue(5, date('Y-m-d G:i:s', time())); 
        $prep->bindValue(6, $data['lieu']); 
        $prep->bindValue(7, $data['latitude']); 
        $prep->bindValue(8, $data['longitude']); 
        $prep->bindValue(9, $data['prix']); 
        $prep->bindValue(10, $_SESSION['user']); 
        $prep->bindValue(11, $data['statut']); 
        $prep->execute();

        

        //Recup idevenement crée
        $query = "SELECT MAX(idEvenement) FROM t_evenement where idUtilisateur = '". $_SESSION['user'] ."';";
        $lastIdEvent = $bdd->query($query)->fetch();   

        //ajout products
        for ($i = 0; $i < count($data['productsRequired']); $i++) {
            $produit = $data['productsRequired'][$i];
            $query = "INSERT INTO t_produit(libelleProduit, uniteProduit, idEvenement) VALUES(?,?,?);";
            $prep = $bdd->prepare($query);
            $prep->bindValue(1, $produit->libelleProduit);
            $prep->bindValue(2, $produit->uniteProduit);
            $prep->bindValue(3, $lastIdEvent[0]);
            $prep->execute();
        }

        //ajout invités
        for ($i = 0; $i < count($data['participants']); $i++) {
            $participant = $data['participants'][$i];
            $query = "INSERT INTO tj_participerevenement(idUtilisateur, idEvenement, statut) VALUES(?,?,'invitation');";
            $prep = $bdd->prepare($query);
            $prep->bindValue(1, $participant->idUtilisateur);
            $prep->bindValue(2, $lastIdEvent[0]);
            $prep->execute();
        }

        echo json_encode(true);
    }
    catch(Exception $e){
        echo json_encode(false);
    }

?>