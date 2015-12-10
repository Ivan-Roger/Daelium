<?php
require_once('Personne.Class.php');

  class Utilisateur extends Personne {
    private $idUtilisateur;
    private $login
    private $emailCompte
    private $mdp // peut être à enlever ?


    private function __construct($id = NULL,$log = NULL, $mail = NULL, $mdp = NULL) {
      $this->idUtilisateur =$id;
      $this->login = $log;
      $this->emailCompte = $mail;
      $this->mdp = $mdp;
      $this->
    }

    //////////////////////
    //      GETTER
    //////////////////////
    function idUtilisateur() {
      return $this->idUtilisateur;
    }

    function login() {
      return $this->login;
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
