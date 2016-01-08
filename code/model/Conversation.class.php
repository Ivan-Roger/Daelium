<?php
   class Conversation {
      private $idconversation;
      private $idpremiermessage;
      private $nom;

      function __construct($idconversation = NULL,$idpremiermessage = NULL,$nom = NULL) {
         if (!isset($this->idconversation)) {
            $this->idconversation = $idconversation;
         }
         if($idpremiermessage != NULL){
            $this->idpremiermessage = $idpremiermessage;
         }
         if($nom != NULL){
            $this->nom = $nom;
         }
      }

      // ********************************
      //        Fonctions getter
      // ********************************
      // getter de l'id de la conversation
      function getID(){
         return $this->idconversation;
      }
      // getter du premier message de la conversation
      function getIDMessageOrigine(){
         return $this->idpremiermessage;
      }
      // getter du nom de la conversation
      function getNom(){
         return $this->nom;
      }
   }
?>
