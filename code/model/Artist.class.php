
<?php
require_once('../model/Personne.class.php');

  class Artist extends Personne{
    private $dateNaissance;
    private $paiement;
    private $rib;
    private $ordreCheque;

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

    //GETTERS
    function getDateNaissance() {
      return $this->dateNaissance;
    }
    function getPaiement() {
      return $this->paiement;
    }
    function getRib() {
      return $this->rib;
    }
    function getOrdreCheque() {
      return $this->ordreCheque;
    }
    //SETTERS
    function setDateNaissance($dateNaissance) {
     $this->dateNaissance = $dateNaissance;
    }
    function setPaiement($paiement) {
     $this->paiement = $paiement;
    }
    function setRib($rib) {
     $this->rib = $rib;
    }
    function setOrdreCheque($ordreCheque) {
     $this->ordreCheque = $ordreCheque;
    }
  }
?>
