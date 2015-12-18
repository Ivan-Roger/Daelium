<?php
include("../model/Utilisateur.class.php");
  class Message {
    private $id;
    private $sender;
    private $recipient;
    private $etat;
    private $nom;
    private $contenu;
    private $date;
    private $reponse;

    function __construct($id = NULL,$sender = NULL,$recipient = NULL,$etat = NULL,$nom = NULL,$contenu = NULL,$date = NULL,$reponse = NULL) {
      if (!isset($this->id)) {
          $this->id = $id;
      }
      if($sender != NULL){
      $this->sender = $sender;
      }
      if($recipient != NULL){
      $this->recipient = $recipient;
      }
      if($etat != NULL){
      $this->etat = $etat;
      }
      if($nom != NULL){
      $this->nom = $nom;
      }
      if($contenu != NULL){
      $this->contenu = $contenu;
      }
      if($date != NULL){
      $this->date = $date;
      }
      if($reponse != NULL){
      $this->reponse = $reponse;
      }
    }
  }
?>
