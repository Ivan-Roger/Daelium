<?php
  class Evenement {
    private $idevene;
    private $createur;
    private $nom;
    private $datedebut;
    private $heuredebut;
    private $journee;
    private $datefin;
    private $heurefin;
    private $description;
    private $lieu;
    private $participants;
    private $rappels; // Tableau des rappels donnés par l'utilisateur
    // /!\ FAIRE UNE CLASSE /!\ avec le nom du champ ajouté, son type etc... >> NON !!!! - Garder le tableau
    private $plus; // Tableau des champs ajoutés par l'utilisateur

    function __construct($idevene = NULL, $createur = NULL, $nom = NULL, $datedebut = NULL, $heuredebut = NULL, $journee = NULL,
                         $datefin = NULL, $heurefin = NULL, $description = NULL, $lieu = NULL, $participants = NULL, $rappels = NULL, $plus = NULL) {
      if (!isset($this->idevene)) {
        $this->idevene = $idevene;
      }
      // Peut être faire une exception si le propriétaire est NULL
      if (!isset($this->createur)) {
        $this->createur = $createur;
      }
      if ($nom != NULL) {
          $this->nom = $nom;
      }
      if ($datedebut != NULL) {
          $this->datedebut = $datedebut;
      }
      if ($heuredebut != NULL) {
          $this->heuredebut = $heuredebut;
      }
      if ($journee != NULL) {
          $this->journee = $journee;
      }
      if ($datefin != NULL) {
          $this->datefin = $datefin;
      }
      if ($heurefin != NULL) {
          $this->heurefin = $heurefin;
      }
      if ($description != NULL) {
          $this->description = $description;
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
  // getter de l'id de l'evenement
  function getID() {
      return $this->idevene;
  }

  // getter du propriétaire de l'évènement
	function getCreateur() {
      return $this->createur;
	}

	// getter du nom de l'évènement
	function getNom() {
      return $this->nom;
	}

	// getter de la date de début de l'évènement
	function getDateDebut() {
      return $this->datedebut;
	}

	// getter de l'heure de début de l'évènement
	function getHeureDebut() {
      return $this->heuredebut;
	}

	// getter pour connaitre si l'evenement dure la jounée ou non
	function isDayLong() {
      return $this->journee == 'day';
	}

	// getter de la date de fin de l'évènement
	function getDateFin() {
      return $this->datefin;
	}

	// getter de l'heure de fin de l'évènement
	function getHeureFin() {
      return $this->heurefin;
	}

  // getter de la description de l'évènement
	function getDescription() {
      return $this->description;
	}

  // getter de la description de l'évènement
	function getJournee() {
      return $this->journee;
	}

	// getter du lieu de l'évènement
	function getLieu() {
      return $this->lieu;
	}

	// getter des participants de l'évènement
	function getParticipants() {
      return $this->participants;
	}

	// getter des rappels de l'évènement
	function getRappels() {
      return $this->rappels;
	}

	// getter des champs supplementaires, ajoutés par l'utilisateur, de l'évènement
	function getPlus() {
      return $this->plus;
	}



        // ********************************
	//        Fonctions setter
	// ********************************
        // setter du nom de l'évènement
	function setNom($nom) {
      $this->nom = $nom;
	}

	// setter de la date de début de l'évènement
	function setDateDebut($datedebut) {
      $this->datedebut = $datedebut;
	}

	// setter de la l'heure de début de l'évènement
	function setHeureDebut($heuredebut) {
      $this->heuredebut = $heuredebut;
	}

	// setter de la date de fin de l'évènement
	function setDateFin($datefin) {
      $this->datefin = $datefin;
	}

	// setter de la l'heure de fin de l'évènement
	function setHeureFin($heurefin) {
      $this->heurefin = $heurefin;
	}

  // setter de la description de l'évènement
	function getSescription($description) {
      $this->description = $description;
	}

	// setter du lieu de l'évènement
	function setLieu($lieu) {
      $this->lieu = $lieu;
	}


	// ********************************
	//        Fonctions add
	// ********************************

        // ajoute un rappel à l'évènement
	function addRappel($rappel) {
      $this->rappels[] = $rappel;
	}

	// ajoute un champ supplémentaire à l'évènement
	function addPlus($champ, $valeur) {
      $this->plus[$champ] = $valeur;
	}

        // ajoute un participant à l'évènement
	function addParticipant($participant) {
      $this->participants[] = $participant;
	}

   // ********************************
	//        Fonctions suppr
	// ********************************

        // supprime un rappel à l'évènement
	function supprRappel($rappel) {
      unset($this->rappels[getIdParValeur($rappel)]);
	}

	// supprime un champ supplémentaire à l'évènement
	function supprPlus($champ) {
      unset($this->plus[$champ]);
	}

        // supprime un participant à l'évènement
	function supprParticipant() {
      unset($this->rappels[getIdParValeur($rappel)]);
	}

   // ********************************
	//        Fonctions clear
	// ********************************

        // supprime tous les rappels liés à l'évènement
	function clearRappels($rappel) {
      $this->rappels = NULL;
	}

	// supprime tous les champs supplémentaires liés à l'évènement
	function clearPlus($champ) {
      $this->champsSupplementaires = NULL;
	}

        // supprime tous les participants liés à l'évènement
	function clearParticipants() {
      $this->rappels = NULL;
	}
  }
?>
