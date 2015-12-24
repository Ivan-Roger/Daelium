<?php
  require_once('Utilisateur.class.php');

  class Booker extends Utilisateur {
    private $listgroupes;

    function __construct($idUtilisateur = NULL, $nom = NULL, $prenom = NULL, $emailcontact = NULL, $tel = NULL, $adresse = NULL, $emailCompte = NULL, $mdp = NULL,$googletoken = NULL) {
      parent::__construct($idUtilisateur,0, $nom, $prenom, $emailcontact, $tel, $adresse,$emailCompte,$mdp,$googletoken);
    }
    function possedeGroupe($idGroupe,$listeGroupe){

      foreach ($listeGroupe as $key => $value) {
        if($value == $idGroupe){
          return true;
        }
      }
      return false;
    }
  }
?>
