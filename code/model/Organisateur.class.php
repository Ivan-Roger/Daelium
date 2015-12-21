<?php
require_once('Utilisateur.class.php');
  class Organisateur extends Utilisateur  {
    // private $events;

    function __construct($idUtilisateur = NULL,$type = NULL, $nom = NULL, $prenom = NULL, $emailcontact = NULL, $tel = NULL, $adresse = NULL, $emailCompte = NULL, $mdp = NULL,$googletoken = NULL) {
      parent::__construct($idUtilisateur,$type, $nom, $prenom, $emailcontact, $tel, $adresse,$emailCompte,$mdp,$googletoken);
    }
  }
?>
