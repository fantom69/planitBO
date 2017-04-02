<?php
    class Employe extends Personne {
        private $idUtilisateur;
        private $mail;
        private $nom;
        private $prenom;
        private $password;

        public function __construct($id, $mail, $nom, $prenom, $password){ // appel du constructeur de la classe parent
           
            $this->idUtilisateur = $id;
            $this->mail = $mail;
            $this->nom = $nom;
            $this->prenom = $prenom;
            $this->password = $password;
        }
    }
?>