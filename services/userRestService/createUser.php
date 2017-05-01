<?php
    include("../../includes/dbconnexion.php");

	header('Access-Control-Allow-Origin: *');    
    header('Access-Control-Allow-Headers: X-Requested-With');
    header('Access-Control-Allow-Methods: POST, GET, OPTIONS');
   

    $data = (array) json_decode(file_get_contents('php://input')); 


    //Liste utilisateurs
    try{
        $query = "SELECT mail FROM t_utilisateur;";
        $liste = $bdd->query($query)->fetchAll();
    }
    catch(Exception $e){

    }
    $founded = false;
    for ($i = 0; $i < count($liste); $i++) {
        if($liste[$i]['mail'] == $data['mail']){
            $founded = true;
        }
    }

    if(!$founded){
        //Insertion utilisateur
        try{
            $query = "INSERT INTO t_utilisateur(nom, prenom, mail, password, lieu, latitude , longitude) VALUES(?,?,?,?,?,?,?);";
            $prep = $bdd->prepare($query);
			$prep->bindValue(1, $data['nom']);
			$prep->bindValue(2, $data['prenom']);
			$prep->bindValue(3, $data['mail']);
			$prep->bindValue(4, sha1($data['password'] . $data['mail'])); //on crypte le mot de passe avec une clé qui elle meme resulte du cryptage du nom de l'utilisateur et d'une clé statique
            $prep->bindValue(5, $data['lieu']);
            $prep->bindValue(6, $data['latitude']);
            $prep->bindValue(7, $data['longitude']);
			$prep->execute();
            
            //ajout session idUtilisateur
            $query = "SELECT idUtilisateur FROM t_utilisateur where mail = '".$data['mail']."';";
            $liste = $bdd->query($query)->fetchAll();
            $_SESSION['user'] = $liste[0]['idUtilisateur'];
 
            echo json_encode(true);
        }
        catch(Exception $e){
            echo json_encode(false);
        }
    }
    else{
        echo json_encode(false);
    }
?>