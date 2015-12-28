<?php
  class Manifestation {
    private $idmanif;
    private $nom;
    private $type;
    private $description;
    private $datedebut;
    private $datefin;
    private $lienimageofficiel;
    private $facebook;
    private $google;
    private $twitter;
    private $fichecom;
    private $createur; // Organisateur de l'evt
    private $lieu;

    function __construct($idmanif = NULL,$nom = NULL,$type = NULL,$description = NULL,$datedebut = NULL,$datefin = NULL,$lienimageofficiel = NULL,$facebook = NULL,$google = NULL,$twitter = NULL,$fichecom = NULL,$createur = NULL,$lieu = NULL) {
      if (!isset($this->idmanif)) {
         $this->idmanif = $idmanif;
      }
      if ($nom != NULL) {
         $this->nom = $nom;
      }
      if ($type != NULL) {
         $this->type = $type;
      }
      if ($description != NULL) {
         $this->description = $description;
      }
      if ($datedebut != NULL) {
         $this->datedebut = $datedebut;
      }
      if ($datefin != NULL) {
         $this->datefin = $datefin;
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
      if ($fichecom != NULL) {
         $this->fichecom = $fichecom;
      }
      if ($createur != NULL) {
         $this->createur = $createur;
      }
      if ($lieu != NULL) {
         $this->lieu = $lieu;
      }

    }


    // ********************************
    //        Fonctions getter
    // ********************************
    // getter de l'id de la manifestation
    function getidManif(){
      return $this->idmanif;
    }
    // getter du nom de la manifestation
    function getNom(){
      return $this->nom;
    }
    // getter du type de la manifestation
    function getType(){
      return $this->type;
    }
    // getter de la description de la manifestation
    function getDescription(){
      return $this->description;
    }
    // getter de la date de début de la manifestation
    function getDateDebut(){
      return $this->datedebut;
    }
    // getter de la date de fin de la manifestation
    function getDateFin(){
      return $this->datefin;
    }
    // getter du lien de l'image officielle de la manifestation
    function getLienImageOfficiel(){
      return $this->lienimageofficiel;
    }
    // getter du Facebook de la manifestation
    function getFacebook(){
      return $this->facebook;
    }
    // getter du Google de la manifestation
    function getGoogle(){
      return $this->google;
    }
    // getter du Twitter de la manifestation
    function getTwitter(){
      return $this->twitter;
    }
    // getter de la fiche de communication de la manifestation
    function getFicheCom(){
      return $this->fichecom;
    }
    // getter du createut de la manifestation
    function getCreateur(){
      return $this->createur;
    }
    // getter du lieu de la manifestation
    function getLieu(){
      return $this->lieu;
    }


    // ********************************
    //        Fonctions setter
    // ********************************
   // setter du nom de la manifestation
   function setNom($nom){
      $this->nom = $nom;
   }
   // setter du type de la manifestation
   function setType($type){
      $this->type = $type;
   }
   // setter de la description de la manifestation
   function setDescription($description){
      $this->description = $description;
   }
   // setter de la date de début de la manifestation
   function setDateDebut($datedebut){
      $this->datedebut = $datedebut;
   }
   // setter de la date de fin de la manifestation
   function setDateFin($datefin){
      $this->datefin = $datefin;
   }
   // setter du lien de l'image officielle de la manifestation
   function setLienImageOfficiel($lienimageofficiel){
      $this->lienimageofficiel = $lienimageofficiel;
   }
   // setter du Facebook de la manifestation
   function setFacebook($facebook){
      $this->facebook = $facebook;
   }
   // setter du Google de la manifestation
   function setGoogle($google){
      $this->google = $google;
   }
   // setter du Twitter de la manifestation
   function setTwitter($twitter){
      $this->twitter = $twitter;
   }
   // setter de la fiche de communication de la manifestation
   function setFicheCom($fichecom){
      $this->fichecom = $fichecom;
   }
   // setter du createut de la manifestation
   function setCreateur($createur){
      $this->createur = $createur;
   }
   // setter du lieu de la manifestation
   function setLieu($lieu){
      $this->lieu = $lieu;
   }

  }
?>
