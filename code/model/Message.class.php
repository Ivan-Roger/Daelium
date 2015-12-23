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
      
      // ********************************
      //        Fonctions getter
      // ********************************
      // getter de l'id du message
      function getID(){
         return $this->idmessage;
      }
      // getter de l'expéditeur du message
      function getExpediteur(){
         return $this->expediteur;
      }
      // getter du destinataire du message
      function getDestinataire(){
         return $this->receveur;
      }
      // getter du contenu du message
      function getContenu(){
         return $this->contenu;
      }
      // getter de la date d'envoi du message
      function getDateenvoi(){
         return $this->dateenvoi;
      }
      // getter du nom du message
      function getNom(){
         return $this->nom;
      }
      // getter du parent du message ?????
      function getParent(){
         return $this->reponse;
      }
      // getter de l'etat du message
      function getEtat(){
         return $this->etat;
      }      
      // getter de l'id de la conversation à laquelle appartient le message
      function getIdConversation(){
         return $this->idConversation;
      }


      // ********************************
      //        Fonctions setter
      // ********************************
      // setter de l'etat du message
      function setEtat($etat){
         $this->etat=$etat;
      }
   }
?>
