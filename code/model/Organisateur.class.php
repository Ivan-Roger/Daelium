<?php
require_once('Utilisateur.class.php');
require_once('../model/DAO.class.php');

  class Organisateur extends Utilisateur  {
     private $listeManif;

    function __construct($idUtilisateur = NULL, $nom = NULL, $prenom = NULL, $emailcontact = NULL, $tel = NULL, $adresse = NULL, $emailCompte = NULL, $mdp = NULL,$googletoken = NULL) {
      parent::__construct($idUtilisateur,1, $nom, $prenom, $emailcontact, $tel, $adresse,$emailCompte,$mdp,$googletoken);
    }

    function possedeManif($idManif){
      foreach ($this->getListeManif() as $key => $value) {
        if($value['idmanif'] == $idManif){
          return true;
        }
      }
      return false;
    }

    function getListeManif(){
      $dao = new Dao();
      if($this->listeManif == NULL){
        $this->listeManif = $dao->readIdManifestationByCreateur($this->getIdPersonne());
      }
      return $this->listgroupes;
    }
  }
?>
