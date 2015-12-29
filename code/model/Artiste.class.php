
<?php
require_once('../model/Personne.class.php');
require_once('../model/DAO.class.php');


  class Artist extends Personne{
    private $dateNaissance;
    private $paiement;
    private $rib;
    private $ordreCheque;
    private $listeGroupe;

    function __construct($idUtilisateur = NULL, $nom = NULL, $prenom = NULL, $emailcontact = NULL, $tel = NULL, $adresse = NULL, $dateNaissance = NULL, $paiement = NULL,$rib = NULL,$ordreCheque = NULL) {
      parent::__construct($idUtilisateur,2, $nom, $prenom, $emailcontact, $tel, $adresse);
      if ($dateNaissance != NULL) {
          $this->dateNaissance = $dateNaissance;
      }
      if ($paiement != NULL) {
          $this->paiement = $paiement;
      }
      if ($rib != NULL) {
          $this->rib = $rib;
      }
      if ($ordreCheque != NULL) {
          $this->ordreCheque = $ordreCheque;
      }
    }

    // ********************************
    //        Fonctions getter
    // ********************************
    // getter de la date de naissance de l'artiste
    function getDateNaissance() {
      return $this->dateNaissance;
    }
    // getter du paiement de l'artiste ??????
    function getPaiement() {
      return $this->paiement;
    }
    // getter du RIB de l'artiste
    function getRib() {
      return $this->rib;
    }
    // getter de l'ordre auquel adresser les chèques pour l'artiste
    function getOrdreCheque() {
      return $this->ordreCheque;
    }
    function getListeGroupe() {
      $dao = new Dao();
      if($listeGroupe == NULL){

        $listeGroupe = $dao->readListGroupeByArtiste($this->getIdPersonne());
      }
      return $listeGroupe;
    }

    function estDansGroupe($idGroupe){
      foreach ($listeGroupe as $key => $value) {
        if($value == $idGroupe){
          return true;
        }
      }
      return false;
    }


    // ********************************
    //        Fonctions setter
    // ********************************
    // setter de la date de naissance de l'artiste
    function setDateNaissance($dateNaissance) {
     $this->dateNaissance = $dateNaissance;
    }
    // setter du paiement de l'artiste ??????
    function setPaiement($paiement) {
     $this->paiement = $paiement;
    }
    // setter du RIB de l'artiste
    function setRib($rib) {
     $this->rib = $rib;
    }
    // setter de l'ordre auquel adresser les chèques pour l'artiste
    function setOrdreCheque($ordreCheque) {
     $this->ordreCheque = $ordreCheque;
    }
  }
?>
