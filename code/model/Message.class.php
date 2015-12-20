<?php
   include("../model/Utilisateur.class.php");
   class Message {
      private $idmessage;
      private $idConversation;
      private $expediteur;
      private $receveur;
      private $etat;
      private $nom;
      private $contenu;
      private $dateenvoi;

      function __construct($idmessage = NULL,$idConversation =NULL,$expediteur = NULL,$receveur = NULL,$etat = NULL,$nom = NULL,$contenu = NULL,$dateenvoi = NULL) {
         if (!isset($this->idmessage)) {
            $this->idmessage = $idmessage;
         }
         if($expediteur != NULL){
            $this->expediteur = $expediteur;
         }
         if($receveur != NULL){
            $this->receveur = $receveur;
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
         if($dateenvoi != NULL){
            $this->dateenvoi = $dateenvoi;
         }
         if($idConversation != NULL){
            $this->idConversation = $idConversation;
         }
      }
      function getID(){
         return $this->idmessage;
      }
      function getExpediteur(){
         return $this->expediteur;
      }
      function getDestinataire(){
         return $this->receveur;
      }
      function getContenu(){
         return $this->contenu;
      }
      function getDateenvoi(){
         return $this->dateenvoi;
      }
      function getNom(){
         return $this->nom;
      }
      function getParent(){
         return $this->reponse;
      }
      function getEtat(){
         return $this->etat;
      }
      function setEtat($etat){
         $this->etat=$etat;
      }
      function getIdConversation(){
         return $this->idConversation;
      }
   }
?>
