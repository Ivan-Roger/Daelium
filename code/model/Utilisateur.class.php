<?php
  require_once('../model/Personne.class.php');

  class Utilisateur extends Personne {
    private $idutilisateur;
    private $emailcompte;
    private $mdp; // mot de passe de l'utilisateur
    private $googletoken;


    function __construct($idUtilisateur = NULL, $nom = NULL, $prenom = NULL, $emailcontact = NULL, $tel = NULL, $adresse = NULL, $emailCompte = NULL, $mdp = NULL,$googletoken = NULL) {
      parent::__construct($idUtilisateur, $nom, $prenom, $emailcontact, $tel, $adresse);
      if (!isset($this->idutilisateur)) {
        $this->idutilisateur = $idutilisateur;
      }
      if ($emailCompte != NULL) {
          $this->emailCompte = $emailCompte;
      }
      if ($mdp != NULL) {
          $this->mdp = $mdp;
      }
      if ($googletoken != NULL) {
          $this->googletoken = $googletoken;
      }

    }

    // ********************************
    //        Fonctions getter
    // ********************************
    // getter de l'id de l'utilisateur
    function getIdUtilisateur() {
      return $this->idutilisateur;
    }

    // getter de l'adresse mail de l'utilisateur
    function getEmailCompte() {
      return $this->emailCompte;
    }

    // setter du mot de passe de l'utilisateur
    function getMdp() {
      return $this->mdp;
    }

    // ********************************
    //        Fonctions setter
    // ********************************
    // getter de l'adresse mail de l'utilisateur
    function setEmailCompte($emailCompte) {
      $this->emailCompte = $emailCompte;
    }

    // setter du mot de passe de l'utilisateur
    function setMdp($mdp) {
      $this->mdp = $mdp;
    }





  }

?>
