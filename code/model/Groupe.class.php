<?php
  class Group {
    private $idgroupe;
    private $nomg;
    private $email;
    private $lienimageofficiel;
    private $facebook;
    private $google;
    private $twitter;
    private $soundcloud;
    private $lecteur;
    private $fichecom;
    private $adresse;

    private $artists; //list

    function __construct($idGroupe = NULL,$nomg = NULL,$email = NULL,$lienimageofficiel = NULL,$facebook = NULL,$google = NULL,$twitter = NULL,$soundcloud = NULL,$lecteur = NULL,$fichecom = NULL,$adresse = NULL) {
      if (!isset($this->idgroupe)) {
         $this->idgroupe = $idGroupe;
      }
      if ($nomg != NULL) {
         $this->nomg = $nomg;
      }
      if ($email != NULL) {
         $this->email = $email;
      }
      if ($lienimageofficiel != NULL) {
         $this->lienimageofficiel = $lienimageofficiel;
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
      if ($fichecom != NULL) {
         $this->fichecom = $fichecom;
      }
      if ($adresse != NULL) {
         $this->adresse = $adresse;
      }

    }
    //GETTERS
    function getIdGroupe(){
      return $this->idgroupe;
    }
    function getNom(){
      return $this->nomg;
    }
    function getEmail(){
      return $this->email;
    }
    function getLienImageOfficiel(){
      return $this->lienimageofficiel;
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
      return $this->fichecom;
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
      $this->lienimageofficiel = $lienimageofficiel;
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
