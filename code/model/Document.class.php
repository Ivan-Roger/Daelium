<?php
  class Document {
    private $idDoc;
    private $idUtilisateur;
    private $nom;
    private $dateCreation;
    private $dateModif;
    private $emplacement;

    function __construct($idDoc = NULL, $idUtilisateur = NULL, $nom = NULL, $dateCreation = NULL, $dateModif = NULL, $emplacement = NULL) {
      if (!isset($this->idDoc)) {
          $this->idDoc = $idDoc;
      }
      if ($idUtilisateur != NULL) {
          $this->idUtilisateur = $idUtilisateur;
      }
      if ($nom != NULL) {
          $this->nom = $nom;
      }
      if ($dateCreation != NULL) {
          $this->dateCreation = $dateCreation;
      }
      if ($dateModif != NULL) {
          $this->dateModif = $dateModif;
      }
      if ($emplacement != NULL) {
          $this->emplacement = $emplacement;
      }
    
    }
    // ********************************
    //        Fonctions getter
    // ********************************
    // getter de l'id du document
    public function getIdDoc() {
      return $this->idDoc;
    }
    // getter de l'id de l'utilisateur à qui appartient le document
    public function getIdUtilisateur() {
      return $this->idUtilisateur;
    }
    // getter du nom du document
    public function getNom() {
      return $this->nom;
    }
    // getter de la date de création du document
    public function getDateCreation() {
      return $this->dateCreation;
    }
    // getter de la date de la dernière modification du document
    public function getDateModif() {
      return $this->dateModif;
    }
    // getter de l'emplacement du document
    public function getEmplacement() {
      return $this->emplacement;
    }
    
    // ********************************
    //        Fonctions setter
    // ********************************
    // setter du nom du document
    public function setNom($nom) {
      $this->nom = $nom;
    }
    // setter de la date de la dernière modification du document
    public function setDateModif($dateModif) {
      $this->dateModif = $dateModif;
    }
    // setter de l'emplacement du document
    public function setEmplacement($emplacement) {
      $this->emplacement = $emplacement;
    }
    
  }
?>
