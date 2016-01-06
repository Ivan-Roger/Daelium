<?php
   class Message {
      private $idmessage;
      private $expediteur;
      private $destinataire;
      private $etat;
      private $contenu;
      private $dateenvoi;

      function __construct($idmessage = NULL,$expediteur = NULL,$destinataire = NULL,$etat = NULL,$contenu = NULL,$dateenvoi = NULL) {
         if (!isset($this->idmessage)) {
            $this->idmessage = $idmessage;
         }
         if($expediteur != NULL){
            $this->expediteur = $expediteur;
         }
         if($destinataire != NULL){
            $this->destinataire = $destinataire;
         }
         if($etat != NULL){
            $this->etat = $etat;
         }
         if($contenu != NULL){
            $this->contenu = $contenu;
         }
         if($dateenvoi != NULL){
            $this->dateenvoi = $dateenvoi;
         }
      }

      // ********************************
      //        Fonctions getter
      // ********************************
      // getter de l'id du message
      function getID(){
         return $this->idmessage;
      }
      // getter de l'expediteur du message
      function getExpediteur(){
         return ($this->expediteur==0?0:$this->expediteur);
      }
      // getter du destinataire du message
      function getDestinataire(){
         return ($this->destinataire==0?0:$this->destinataire);
      }
      // getter du contenu du message
      function getContenu(){
         return $this->contenu;
      }
      // getter de la date d'envoi du message
      function getDateenvoi(){
         return $this->dateenvoi;
      }
      // getter de l'etat du message
      function getEtat(){
         return $this->etat;
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
