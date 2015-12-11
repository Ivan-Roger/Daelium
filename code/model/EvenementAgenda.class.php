<?php
  class EvenementAgenda {
    private $idEvenement;
    private Utilisateur $proprietaire;
    private $nom;
    private $dateDebut;
    private $heureDebut;
    private $dateFin;
    private $heureFin;
    private Lieu $lieu;
    private Personne[] $participants;
    private $rappels // Tableau des rappels donnés par l'utilisateur
    // /!\ FAIRE UNE CLASSE /!\ avec le nom du champ ajouté, son type etc...
    private $plus // Tableau des champs ajoutés par l'utilisateur

    function __construct($idEvenement = NULL, $proprietaire = NULL, $nom = NULL, $dateDebut = NULL, $heureDebut = NULL,
                         $dateFin = NULL, $heureFin = NULL, $lieu = NULL, $participants = NULL, $rappels = NULL, $plus = NULL) {
      if (!isset($this->idEvenement)) {
        $this->idEvenement = $idEvenement;
      }
      // Peut être faire une exception si le propriétaire est NULL
      if (!isset($this->proprietaire)) {
        $this->proprietaire = $proprietaire;
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
  // getter du propriétaire de l'évènement
  function getIdEvenement() {
      return $this->idEvenement;
  }

  // getter du propriétaire de l'évènement
	function getProprietaire() {
            return $this->proprietaire;
	}

	// getter du nom de l'évènement
	function getNom() {
            return $this->nom;
	}

	// getter de la date de début de l'évènement
	function getDateDebut() {
            return $this->dateDebut;
	}

	// getter de la l'heure de début de l'évènement
	function getHeureDebut() {
            return $this->heureDebut;
	}

	// getter de la date de fin de l'évènement
	function getDateFin() {
            return $this->dateFin;
	}

	// getter de la l'heure de fin de l'évènement
	function getHeureFin() {
            return $this->heureFin;
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

	// getter des plus(champs ajoutés par l'utilisateur) de l'évènement
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
	function setDateDebut($dateDebut) {
            $this->dateDebut = $dateDebut;
	}

	// setter de la l'heure de début de l'évènement
	function setHeureDebut($heureDebut) {
            $this->heureDebut = $heureDebut;
	}

	// setter de la date de fin de l'évènement
	function setDateFin($dateFin) {
            $this->dateFin = $dateFin;
	}

	// setter de la l'heure de fin de l'évènement
	function setHeureFin($heureFin) {
            $this->heureFin = $heureFin;
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
            $this->plus = NULL;
	}

        // supprime tous les participants liés à l'évènement
	function clearParticipants() {
            $this->rappels = NULL;
	}
  }
?>
