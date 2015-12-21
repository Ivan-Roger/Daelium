<?php
  class Group {
    private $idGroupe;
    private $nomg;
    private $email;
    private $lienImageOfficiel;
    private $facebook;
    private $google;
    private $twitter;
    private $soundcloud;
    private $lecteur;
    private $ficheCom;
    private $adresse;

    private $artists; //list

    function __construct($idGroupe = NULL,$nomg = NULL,$email = NULL,$lienImageOfficiel = NULL,$facebook = NULL,$google = NULL,$twitter = NULL,$soundcloud = NULL,$lecteur = NULL,$ficheCom = NULL,$adresse = NULL) {
      if (!isset($this->idGroupe)) {
         $this->idGroupe = $idGroupe;
      }
      if ($nomg != NULL) {
         $this->nomg = $nomg;
      }
      if ($email != NULL) {
         $this->email = $email;
      }
      if ($lienImageOfficiel != NULL) {
         $this->lienImageOfficiel = $lienImageOfficiel;
      }
      if ($facebook != NULL) {
         $this->facebook = $facebook;
      }
      if ($google != NULL) {
         $this->google = $google;
      }
      if ($twitter != NULL) {
         $this->twitter = $twitter;
      }

      if ($soundcloud != NULL) {
         $this->soundcloud = $soundcloud;
      }
      if ($lecteur != NULL) {
         $this->lecteur = $lecteur;
      }
      if ($ficheCom != NULL) {
         $this->ficheCom = $ficheCom;
      }
      if ($adresse != NULL) {
         $this->adresse = $adresse;
      }

    }
    //GETTERS
    function getIdGroupe(){
      return $this->idGroupe;
    }
    function getNom(){
      return $this->nomg;
    }
    function getEmail(){
      return $this->email;
    }
    function getLienImageOfficiel(){
      return $this->lienImageOfficiel;
    }
    function getFacebook(){
      return $this->facebook;
    }
    function getGoogle(){
      return $this->google;
    }
    function getTwitter(){
      return $this->twitter;
    }
    function getSoundcloud(){
      return $this->soundcloud;
    }
    function getLecteur(){
      return $this->lecteur;
    }
    function getFicheCom(){
      return $this->ficheCom;
    }
    function getAdresse(){
      return $this->adresse;
    }
    function getartistes(){
      return $this->artists;
    }

    //SETTERS
    function setNom(){
      $this->nomg = $nomg;
    }
    function setEmail(){
      $this->email = $email;
    }
    function setLienImageOfficiel(){
      $this->lienImageOfficiel = $lienImageOfficiel;
    }
    function setFacebook(){
      $this->facebook = $facebook;
    }
    function setGoogle(){
      $this->google = $google;
    }
    function setTwitter(){
      $this->twitter = $twitter;
    }
    function setSoundcloud(){
      $this->soundcloud = $soundcloud;
    }
    function setLecteur(){
      $this->lecteur = $lecteur;
    }
    function setFicheCom(){
      $this->ficheCom = $ficheCom;
    }
    function setAdresse(){
      $this->adresse = $adresse;
    }
    function setArtistes(){
      $this->artists = $artists;
    }

  }
?>
