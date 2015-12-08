<?php
  class EvenementAgenda {
    private Agenda $parent;
	private $nom;
	private $dateDebut;  // Type date ?
	private $heureDebut; // Type date ?
	private $dateFin;	 // Type heure ?
	private $heureFin;	 // Type heure ?
	private Lieu $lieu;
	private Personne[] $participants;
	private $rappels // Tableau des rappels donnés par l'utilisateur
	// /!\ FAIRE UNE CLASSE /!\ avec le nom du champ ajouté, son type etc...
	private $plus // Tableau des champs ajoutés par l'utilisateur

    function __construct($parent=NULL, $nom=NULL, $dateDebut=NULL, $heureDebut=NULL, 
						 $dateFin=NULL, $heureFin=NULL, $lieu=NULL, $participants=NULL, $rappels=NULL, $plus=NULL) {
      // Peut être faire une exception si le parent est NULL
	  if (!isset($this->parent)) {
        $this->parent = $parent;
      }	  
	  if ($nom != NULL) {
          $this->nom = $nom;
      }
	  if ($dateDebut != NULL) {
          $this->dateDebut = $dateDebut;
      }
	  if ($heureDebut != NULL) {
          $this->heureDebut = $heureDebut;
      }
	  if ($dateFin != NULL) {
          $this->dateFin = $dateFin;
      }
	  if ($heureFin != NULL) {
          $this->heureFin = $heureFin;
      }
	  if ($lieu != NULL) {
          $this->lieu = $lieu;
      }
	  if ($participants != NULL) {
          $this->participants = $participants;
      }
	  if ($rappels != NULL) {
          $this->rappels = $rappels;
      }
	  if ($plus != NULL) {
          $this->plus = $plus;
      }
    }
	
	// ********************************
	//        Fonctions getter
	// ********************************
	// getter du nom de l'évènement
	function nom() {
		return $this->nom;
	}
	
	// getter de la date de début de l'évènement
	function dateDebut() {
		return $this->dateDebut;
	}
	
	// getter de la l'heure de début de l'évènement
	function heureDebut() {
		return $this->heureDebut;
	}
	
	// getter de la date de fin de l'évènement
	function dateFin() {
		return $this->dateFin;
	}
	
	// getter de la l'heure de fin de l'évènement
	function heureFin() {
		return $this->heureFin;
	}
	
	// getter du lieu de l'évènement
	function lieu() {
		return $this->lieu;
	}
	
	// getter des participants de l'évènement
	function participants() {
		return $this->participants;
	}
	
	// getter des rappels de l'évènement
	function rappels() {
		return $this->rappels;
	}
	
	// getter des plus(champs ajoutés par l'utilisateur) de l'évènement
	function plus() {
		return $this->plus;
	}
  }
?>
