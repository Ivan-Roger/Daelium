<?php

  class Creneau {
    private $idmanif;
    private $idgroupe;
    private $datec;
    private $heuredebut;
    private $heurefin;
    private $heuredebuttest;
    private $heurefintest;

    function __construct($idmanif = NULL,$idgroupe=NULL,$datec=NULL,$heuredebut=NULL,$heurefin=NULL,$heuredebuttest=NULL,$heurefintest=NULL) {
      if (!isset($this->idmanif)) {
         $this->idmanif = $idmanif;
      }
      if ($idgroupe != NULL) {
         $this->idgroupe = $idgroupe;
      }
      if ($datec != NULL) {
         $this->datec = $datec;
      }
      if ($heuredebut != NULL) {
         $this->heuredebut = $heuredebut;
      }
      if ($heurefin != NULL) {
         $this->heurefin = $heurefin;
      }
      if ($heuredebuttest != NULL) {
         $this->heuredebuttest = $heuredebuttest;
      }
      if ($heurefintest != NULL) {
         $this->heurefintest = $heurefintest;
      }
    }
    function getidManif(){
      return $this->idmanif;
    }
    function getidGroupe(){
      return $this->idgroupe;
    }
    function getDate(){
      return $this->datec;
    }
    function getHeureDebut(){
      return $this->heuredebut;
    }
    function getHeureFin(){
      return $this->heurefin;
    }
    function getHeureDebutTest(){
      return $this->heuredebuttest;
    }
    function getHeureFinTest(){
      return $this->heurefintest;
    }


    function setDate($datec){
     $this->datec = $datec;
    }
    function setHeureDebut($heuredebut){
     $this->heuredebut = $heuredebut;
    }
    function setHeureFin($heurefin){
     $this->heurefin = $heurefin;
    }
    function setHeureDebutTest($heuredebuttest){
     $this->heuredebuttest = $heuredebuttest;
    }
    function setHeureFinTest($heurefintest){
     $this->heurefintest = $heurefintest;
    }
  }
?>
