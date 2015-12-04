<?php
  class Agenda {
    private User $user;
    private AgendaEvent[] $events;

    // Constructeur
    function __construct($user=NULL, $events=NULL) { // A vroi si bonne écriture pour $events
      if (!isset($this->user)) {
        $this->user = $user;
      }
      if ($events != NULL) {
        $this->events = $events;
      }
    }
    
  // ********************************
  //        Fonctions getter
  // ********************************
  // getter de l'utilisateur à qui appartient l'agenda
  function getUser() {
    return $this->user;
  }
    
  // getter de la liste des évènements 
  function getEvents() {
    return $this->events;
  }
    
  }
?>
