<?php
  class Manifestation {
    private $idmanif;
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

    function __construct($idmanif = NULL,$type = NULL,$email = NULL,$description = NULL,$datedebut = NULL,$datefin = NULL,$lienimageofficiel = NULL,$facebook = NULL,$google = NULL,$twitter = NULL,$fichecom = NULL,$createur = NULL,$lieu = NULL) {
      if (!isset($this->idmanif)) {
         $this->idmanif = $idmanif;
      }
      if ($type != NULL) {
         $this->type = $type;
      }
      if ($email != NULL) {
         $this->email = $email;
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
    //GETTERS
    function getidManif(){
      return $this->idmanif;
    }
    function getType(){
      return $this->type;
    }
    function getDescription(){
      return $this->description;
    }
    function getDateDebut(){
      return $this->datedebut;
    }
    function getDateFin(){
      return $this->datefin;
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
    function getFicheCom(){
      return $this->fichecom;
    }
    function getCreateur(){
      return $this->createur;
    }
    function getLieu(){
      return $this->lieu;
    }
 // SETTERS

 function setType(){
    $this->type = $type;
 }
 function setDescription(){
    $this->description = $description;
 }
 function setDateDebut(){
    $this->datedebut = $datedebut;
 }
 function setDateFin(){
    $this->datefin = $datefin;
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
 function setFicheCom(){
    $this->fichecom = $fichecom;
 }
 function setCreateur(){
    $this->createur = $createur;
 }
 function setLieu(){
    $this->lieu = $lieu;
 }

  }
?>
