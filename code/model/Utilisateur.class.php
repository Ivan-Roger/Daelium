<?php
require_once('Personne.Class.php');

  class Utilisateur extends Personne {
    private $idUtilisateur; 
    private $emailCompte;
    private $mdp; // mot de passe de l'utilisateur


    private function __construct($idUtilisateur = NULL, $emailCompte = NULL, $mdp = NULL) {
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
