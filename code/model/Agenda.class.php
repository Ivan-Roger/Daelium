<?php
  class Agenda {
    private Utilisateur $utilisateur;
    private EvenementAgenda[] $evenements;
    // Constructeur
    function __construct($utilisateur=NULL, $evenements=NULL) { // A voir si bonne écriture pour $evenements
      if (!isset($this->utilisateur)) {
        $this->utilisateur = $utilisateur;
      }
      if ($evenements != NULL) {
        $this->evenements = $evenements;
      }
    }
    
  // ********************************
  //        Fonctions getter
  // ********************************
  // getter de l'utilisateur à qui appartient l'agenda
  function getUtilisateur() {
    return $this->utilisateur;
  }
    
  // getter de la liste des évènements 
  function getEvenements() {
    return $this->evenements;
  }
    
  }
?>
