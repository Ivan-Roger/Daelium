<?php
  require_once('../model/Lieu.class.php');
  class Personne {
	private $idpersonne;
  private $type;
	private $nom;
	private $prenom;
	private $emailcontact;
	private $tel;
	private $adresse; // Class lieu
  private $description;

   function __construct($idpersonne = NULL,$type = NULL, $nom = NULL, $prenom = NULL, $emailcontact = NULL, $tel = NULL, $adresse = NULL, $description =NULL) {
      if (!isset($this->idpersonne)) {
         $this->idpersonne = $idpersonne;
      }


         $this->type = $type;

      if ($nom != NULL) {
         $this->nom = $nom;
      }
      if ($prenom != NULL) {
         $this->prenom = $prenom;
      }
      if ($emailcontact != NULL) {
         $this->emailcontact = $emailcontact;
      }
      if ($tel != NULL) {
         $this->tel = $tel;
      }
      if ($adresse != NULL) {
         $this->adresse = $adresse;
      }
      if ($description != NULL) {
         $this->description = $description;
      }
   }

   // ********************************
   //        Fonctions getter
   // ********************************
   // getter de l'id de la personne
   function getIdPersonne() {
     return $this->idpersonne;
   }

   // getter du nom de la personne
   function getNom() {
     return $this->nom;
   }

    // getter du prenom de la personne
   function getPrenom() {
      return $this->prenom;
   }

   function getType() {
      return $this->type;
   }

   function getNomType() {
      if($this->type == 0){
        return "Booker";
      }elseif ($this->type == 1) {
        return "Organisateur";
      }else {
        return "Artiste";
      }
   }


   function getNomComplet() {
      return $this->getPrenom()." ".$this->getNom();
   }

    // getter de l'email de contact de la personne
    function getEmailcontact() {
        return $this->emailcontact;
    }

    // getter du numéro de téléphone de la personne
    function getTel() {
        return $this->tel;
    }

    function getDescription() {
        return $this->description;
    }

    // getter de l'adresse de la personne
    function getAdresse() {
        return $this->adresse;
    }

    // ********************************
    //        Fonctions setter
    // ********************************
    // setter de l'id de la personne
    function setIdPersonne($idPersonne) {
        $this->idPersonne = $idPersonne;
    }

    // setter du nom de la personne
    function setNom($nom) {
        $this->nom = $nom;
    }

    // setter du prenom de la personne
    function setPrenom($prenom) {
        $this->prenom = $prenom;
    }

    // setter de l'email de contact de la personne
    function setEmailcontact($emailcontact) {
        $this->emailcontact = $emailcontact;
    }

    // setter du numéro de téléphone de la personne
    function setTel($tel) {
        $this->tel = $tel;
    }

    // setter de l'adresse de la personne
    function setAdresse($adresse) {
        $this->adresse = $adresse;
    }
    function setDescription($description) {
        $this->description = $description;
    }

  }
?>
