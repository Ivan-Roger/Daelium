<?php
class Lieu {
  private $idLieu;
  private $nom;
  private $description;
  private $pays;
  private $region;
  private $ville;
  private $codePostal;
  private $adresse;
  private $latitude;
  private $longitude;

  function __construct($idLieu = NULL, $nom = NULL, $description = NULL, $pays = NULL, $region = NULL, $ville = NULL, $codePostal = NULL, $adresse = NULL, $latitude = NULL, $longitude = NULL) {
    if (!isset($this->idLieu)) {
        $this->idLieu = $idLieu;
    }
    if ($nom != NULL) {
        $this->nom = $nom;
    }
    if ($description != NULL) {
        $this->description = $description;
    }
    if ($pays != NULL) {
        $this->pays = $pays;
    }
    if ($region != NULL) {
        $this->region = $region;
    }
    if ($ville != NULL) {
        $this->ville = $ville;
    }
    if ($codePostal != NULL) {
        $this->codePostal = $codePostal;
    }
    if ($adresse != NULL) {
        $this->adresse = $adresse;
    }
    if ($latitude != NULL) {
        $this->latitude = $latitude;
    }
    if ($longitude != NULL) {
        $this->longitude = $longitude;
    }
  }


  // ********************************
  //        Fonctions getter
  // ********************************
  // getter de l'id du lieu
  public function getIdLieu() {
    return $this->idLieu;
  }

  // getter du nom du lieu
  public function getNom() {
    return $this->nom;
  }

  // getter de la description du lieu
  public function getDescription() {
    return $this->description;
  }

  // getter du pays du lieu
  public function getPays() {
    return $this->pays;
  }

  // getter de la région du lieu
  public function getRegion() {
    return $this->region;
  }

  // getter de la ville du lieu
  public function getVille() {
    return $this->ville;
  }

  // getter du code postal du lieu
  public function getCodePostal() {
    return $this->codePostal;
  }

  // getter de l'adresse du lieu
  public function getAdresse() {
    return $this->adresse;
  }

  // getter de la latitude du lieu
  public function getLatitude() {
    return $this->latitude;
  }

  // getter de la longitude du lieu
  public function getLongitude() {
    return $this->longitude;
  }

  // ********************************
  //        Fonctions setter
  // ********************************

  // setter du nom du lieu
  public function setNom($nom) {
    $this->nom = $nom;
  }

  // setter de la description du lieu
  public function setDescription($description) {
    $this->description = $description;
  }

  // setter du pays du lieu
  public function setPays($pays) {
    $this->pays = $pays;
  }

  // setter de la région du lieu
  public function setRegion($region) {
    $this->region = $region;
  }

  // setter de la ville du lieu
  public function setVille($ville) {
    $this->ville = $ville;
  }

  // setter du code postal du lieu
  public function setCodePostal($codePostal) {
    $this->codePostal = $codePostal;
  }

  // setter de l'adresse du lieu
  public function setAdresse($adresse) {
    $this->adresse = $adresse;
  }

  // setter de la latitude du lieu
  public function setLatitude($latitude) {
    $this->latitude = $latitude;
  }

  // setter de la longitude du lieu
  public function setLongitude($longitude) {
    $this->longitude = $longitude;
  }

}

?>
