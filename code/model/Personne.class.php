<?php
  require_once('../model/Lieu.class.php');
  class Personne {
	private $idPersonne;
	private $nom;
	private $prenom;
	private $emailcontact;
	private $tel;
	private $adresse; // Class lieu

    function __construct($idPersonne = NULL, $nom = NULL, $prenom = NULL, $emailcontact = NULL, $tel = NULL, $adresse = NULL) {
      if (!isset($this->idPersonne)) {
          $this->idPersonne = $idPersonne;
      }
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
    }

    // ********************************
    //        Fonctions getter
    // ********************************
    // getter de l'id de la personne
    function getIdPersonne() {
        return $this->idPersonne;
    }

    // getter du nom de la personne
    function getNom() {
        return $this->nom;
    }

    // getter du prenom de la personne
   function getPrenom() {
      return $this->prenom;
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
  }
?>
