<?php
require_once('Personne.Class.php');

  class Utilisateur extends Personne {
    private $idUtilisateur; 
    private $emailCompte;
    private $mdp; // mot de passe de l'utilisateur


    private function __construct($idUtilisateur = NULL, $emailCompte = NULL, $mdp = NULL) {
      $this->idUtilisateur =$id;
      $this->emailCompte = $mail;
      $this->mdp = $mdp;
    }

    //////////////////////
    //      GETTER
    //////////////////////
    function idUtilisateur() {
      return $this->idUtilisateur;
    }

    function email() {
      return $this->emailCompte;
    }

    function mdp() {
      return $this->mdp;
    }

    //////////////////////
    //      SETTER
    //////////////////////
    function login($log) {
      $this->login = $log;
    }

    function email($mail) {
      $this->email = $mail;
    }

    function mdp($mdp) {
      $this->mdp = $mdp;
    }

    //////////////////////
    //      METHODES
    //////////////////////




  }

?>
