<?php
  require_once('Utilisateur.class.php');

  class Booker extends Utilisateur {
    private $listgroupes;

    function __construct($idUtilisateur = NULL,$type = NULL, $nom = NULL, $prenom = NULL, $emailcontact = NULL, $tel = NULL, $adresse = NULL, $emailCompte = NULL, $mdp = NULL,$googletoken = NULL) {
      parent::__construct($idUtilisateur,$type, $nom, $prenom, $emailcontact, $tel, $adresse,$emailCompte,$mdp,$googletoken);
    }
    function update(){



    }
  }
?>
