<?php
  class Group {
    private $idgroupe;
    private $nomg;
    private $email;
    private $description;
    private $lienimageofficiel;
    private $facebook;
    private $google;
    private $twitter;
    private $soundcloud;
    private $lecteur;
    private $fichecom;
    private $adresse;

    private $artists; //list

    function __construct($idGroupe = NULL,$nomg = NULL,$email = NULL,$description = NULL,$lienimageofficiel = NULL,$facebook = NULL,$google = NULL,$twitter = NULL,$soundcloud = NULL,$lecteur = NULL,$fichecom = NULL,$adresse = NULL) {
      if (!isset($this->idgroupe)) {
         $this->idgroupe = $idGroupe;
      }
      if ($nomg != NULL) {
         $this->nomg = $nomg;
      }
      if ($email != NULL) {
         $this->email = $email;
      }
      if ($description != NULL) {
         $this->description = $description;
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
    function getDescription(){
      return $this->description;
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
    function setNom($nomg){
      $this->nomg = $nomg;
    }
    function setEmail($email){
      $this->email = $email;
    }
    function setLienImageOfficiel($lienimageofficiel){
      $this->lienimageofficiel = $lienimageofficiel;
    }
    function setFacebook($facebook){
      $this->facebook = $facebook;
    }
    function setDescription($description){
      $this->description = $description;
    }
    function setGoogle($google){
      $this->google = $google;
    }
    function setTwitter($twitter){
      $this->twitter = $twitter;
    }
    function setSoundcloud($soundcloud){
      $this->soundcloud = $soundcloud;
    }
    function setLecteur($lecteur){
      $this->lecteur = $lecteur;
    }
    function setFicheCom($ficheCom){
      $this->ficheCom = $ficheCom;
    }
    function setAdresse($adresse){
      $this->adresse = $adresse;
    }
    function setArtistes($artists){
      $this->artists = $artists;
    }

  }
?>
