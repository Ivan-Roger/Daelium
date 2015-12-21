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

    function __construct($idmanif = NULL,$nom = NULL,$type = NULL,$email = NULL,$description = NULL,$datedebut = NULL,$datefin = NULL,$lienimageofficiel = NULL,$facebook = NULL,$google = NULL,$twitter = NULL,$fichecom = NULL,$createur = NULL,$lieu = NULL) {
      if (!isset($this->idmanif)) {
         $this->idmanif = $idmanif;
      }
      if ($nom != NULL) {
         $this->nom = $nom;
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
    function getNom(){
      return $this->nom;
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
 function setNom($nom){
    $this->nom = $nom;
 }
 function setType($type){
    $this->type = $type;
 }
 function setDescription($description){
    $this->description = $description;
 }
 function setDateDebut($datedebut){
    $this->datedebut = $datedebut;
 }
 function setDateFin($datefin){
    $this->datefin = $datefin;
 }
 function setLienImageOfficiel($lienimageofficiel){
    $this->lienimageofficiel = $lienimageofficiel;
 }
 function setFacebook($facebook){
    $this->facebook = $facebook;
 }
 function setGoogle($google){
    $this->google = $google;
 }
 function setTwitter($twitter){
    $this->twitter = $twitter;
 }
 function setFicheCom($fichecom){
    $this->fichecom = $fichecom;
 }
 function setCreateur($createur){
    $this->createur = $createur;
 }
 function setLieu($lieu){
    $this->lieu = $lieu;
 }

  }
?>
