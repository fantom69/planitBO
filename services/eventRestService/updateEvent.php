<?php
    include("../../includes/dbconnexion.php");

	header('Access-Control-Allow-Origin: *');    
    header('Access-Control-Allow-Headers: X-Requested-With');
    header('Access-Control-Allow-Methods: POST, GET, OPTIONS');
   

    $data = (array) json_decode(file_get_contents('php://input')); 
    $date = new DateTime();

     try{
        //MAJ des items d'un evenement
        $query = "UPDATE t_evenement SET libelle = ?, description = ?, dateDebut = ?, dateFin = ?, lieu = ?, latitude = ?, longitude = ?, prix = ?, statut = ? WHERE idEvenement = ? AND idUtilisateur = ? ;";
        $prep = $bdd->prepare($query);
        $prep->bindValue(1, $data['libelle']);
        $prep->bindValue(2, $data['description']);
        $prep->bindValue(3, $data['dateDebut']);
        $prep->bindValue(4, $data['dateFin']); 
        $prep->bindValue(5, $data['lieu']); 
        $prep->bindValue(6, $data['latitude']); 
        $prep->bindValue(7, $data['longitude']); 
        $prep->bindValue(8, $data['prix']); 
        $prep->bindValue(9, $data['statut']); 
        $prep->bindValue(10,  $data['idEvenement']); 
        $prep->bindValue(11, $_SESSION['user']); 
        $prep->execute();


        //Suppression des anciens produits
        $query = "DELETE FROM t_produit WHERE idEvenement = ? ;";
        $prep = $bdd->prepare($query);
        $prep->bindValue(1,  $data['idEvenement']); 
        $prep->execute();

        //ajout des produits restants
        for ($i = 0; $i < count($data['productsRequired']); $i++) {
            $produit = $data['productsRequired'][$i];
            $query = "INSERT INTO t_produit(libelleProduit, uniteProduit, idEvenement) VALUES(?,?,?);";
            $prep = $bdd->prepare($query);
            $prep->bindValue(1, $produit->libelleProduit);
            $prep->bindValue(2, $produit->uniteProduit);
            $prep->bindValue(3, $data['idEvenement']);
            $prep->execute();
        }

        //Suppression des anciens invités
        $query = "DELETE FROM tj_participerevenement WHERE idEvenement = ? ;";
        $prep = $bdd->prepare($query);
        $prep->bindValue(1, $data['idEvenement']); 
        $prep->execute();
        
        //ajout invités
        for ($i = 0; $i < count($data['participants']); $i++) {
            $participant = $data['participants'][$i];
            $query = "INSERT INTO tj_participerevenement(idUtilisateur, idEvenement, statut) VALUES(?,?,'invitation');";
            $prep = $bdd->prepare($query);
            $prep->bindValue(1, $participant->idUtilisateur);
            $prep->bindValue(2, $data['idEvenement']);
            $prep->execute();
        }

        echo json_encode(true);
    }
    catch(Exception $e){
        echo json_encode(false);
    }

?>