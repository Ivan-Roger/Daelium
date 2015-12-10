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

  function __construct($idLieu, $nom, $description, $pays, $region, $ville, $codePostal, $adresse, $latitude, $longitude) {
    $this->idLieu = $idLieu;
    $this->nom = $nom;
    $this->description = $description;
    $this->pays = $pays;
    $this->region = $region;
    $this->ville = $ville;
    $this->codePostal = $codePostal;
    $this->adresse = $adresse;
    $this->latitude = $latitude;
    $this->longitude = $longitude;
  }


  //////////////////////
  //      GETTER
  //////////////////////
  public function IdLieu() {
    return $this->idLieu;
  }

  public function Nom() {
    return $this->nom;
  }

  public function Description() {
    return $this->description;
  }

  public function Pays() {
    return $this->pays;
  }

  public function Region() {
    return $this->region;
  }

  public function Ville() {
    return $this->ville;
  }

  public function CodePostal() {
    return $this->codePostal;
  }

  public function Adresse() {
    return $this->adresse;
  }

  public function Latitude() {
    return $this->latitude;
  }

  public function Longitude() {
    return $this->longitude;
  }

  //////////////////////
  //      SETTER
  //////////////////////
  public function Nom($nom) {
    $this->nom = $nom;
  }

  public function Description($description) {
    $this->description = $description;
  }

  public function Pays($pays) {
    $this->pays = $pays;
  }

  public function Region($region) {
    $this->region = $region;
  }

  public function Ville($ville) {
    $this->ville = $ville;
  }

  public function CodePostal($codePostal) {
    $this->codePostal = $codePostal;
  }

  public function Adresse($adresse) {
    $this->adresse = $adresse;
  }

  public function Latitude($latitude) {
    $this->latitude = $latitude;
  }

  public function Longitude($longitude) {
    $this->longitude = $longitude;
  }

  //////////////////////
  //      METHODES
  //////////////////////

  }

?>
