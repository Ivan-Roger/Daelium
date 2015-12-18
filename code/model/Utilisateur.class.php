<?php
  require_once('../model/Personne.class.php');

  class Utilisateur extends Personne {
    private $idUtilisateur;
    private $emailCompte;
    private $mdp; // mot de passe de l'utilisateur


    function __construct($idUtilisateur = NULL, $nom = NULL, $prenom = NULL, $emailcontact = NULL, $tel = NULL, $adresse = NULL, $emailCompte = NULL, $mdp = NULL) {
      parent::__construct($idUtilisateur, $nom, $prenom, $emailcontact, $tel, $adresse);
      if (!isset($this->idUtilisateur)) {
        $this->idUtilisateur = $idUtilisateur;
      }
      if ($emailCompte != NULL) {
          $this->emailCompte = $emailCompte;
      }
      if ($mdp != NULL) {
          $this->mdp = $mdp;
      }

    }

    // ********************************
    //        Fonctions getter
    // ********************************
    // getter de l'id de l'utilisateur
    function getIdUtilisateur() {
      return $this->idUtilisateur;
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
