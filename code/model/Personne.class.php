<?php
  class Personne {
	private $idPersonne;
	private $nom;
	private $prenom;
	private $emailcontact;
	private $tel;
	private Lieu $adresse;

    function __construct($idPersonne=NULL, $nom=NULL, $prenom=NULL, $emailcontact=NULL, $tel=NULL, $adresse=NULL) {
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
  }
?>
