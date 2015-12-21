<?php
class Lieu {
  private $idlieu;
  private $noml;
  private $description;
  private $pays;
  private $region;
  private $ville;
  private $codepostal;
  private $adresse;
  private $latitude;
  private $longitude;

  function __construct($idlieu = NULL, $noml = NULL, $description = NULL, $pays = NULL, $region = NULL, $ville = NULL, $codepostal = NULL, $adresse = NULL, $latitude = NULL, $longitude = NULL) {
    if (!isset($this->idlieu)) {
        $this->idlieu = $idlieu;
    }
    if ($noml != NULL) {
        $this->noml = $noml;
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
    if ($codepostal != NULL) {
        $this->codepostal = $codepostal;
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
    return $this->idlieu;
  }

  // getter du noml du lieu
  public function getnoml() {
    return $this->noml;
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
  public function getcodepostal() {
    return $this->codepostal;
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

  // setter du noml du lieu
  public function setnoml($noml) {
    $this->noml = $noml;
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
  public function setcodepostal($codepostal) {
    $this->codepostal = $codepostal;
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
