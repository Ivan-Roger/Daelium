<?php
  class Notification {
    private $idnotif;
    private $etat;
    private $destinataire;
    private $type;
    private $message;
    function __construct($idnotif = NULL, $etat = NULL, $destinataire = NULL, $type = NULL,  $message = NULL) {
      if (!isset($this->idnotif)) {
          $this->idnotif = $idnotif;
      }
      if ($etat != NULL) {
          $this->etat = $etat;
      }
      if ($destinataire != NULL) {
          $this->destinataire = $destinataire;
      }
      if ($type != NULL) {
          $this->type = $type;
      }
      if ($message != NULL) {
          $this->message = $message;
      }
    }

    function getIdNotification(){
      return $this->idnotif;
    }
    function getEtat(){
      return $this->etat;
    }
    function getEtatEcrit(){
      if($this->etat == 0){
        return "new";
      }else {
        return "old";

      }
    }
    function getDestinataire(){
      return $this->destinataire;
    }
    function getType(){
      return $this->type;
    }
    function getTypeEcrit(){
      if($this->type == 0){
        return "Message";
      }elseif ($this->type == 1) {
        return "Demmande de Groupe";
      }elseif ($this->type == 2) {
        return "Demmande participation à un evenement";
      }
      //Liste non exaustive
    }
    function getMessage(){
      return $this->message;
    }


    function setEtat($etat){
     $this->etat = $etat;
    }
    function setDestinataire($destinataire){
     $this->destinataire = $destinataire;
    }
    function setLu($type){
     $this->type = 1;
    }
    function setNonLu($type){
     $this->type = 0;
    }
    function setType($type){
     $this->type = $type;
    }
    function setMessage($message){
     $this->message = $message;
    }
  }
?>
