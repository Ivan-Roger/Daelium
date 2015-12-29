<?php
session_start();
include("include/auth.ctrl.php");
require_once("../model/utils.class.php");
require_once("../model/DAO.class.php");
$data = initPage("Profil");

if(isset($_GET["id"])){
  $userpid = (int) $_GET["id"];
  $data["owner"] = $userpid == $_SESSION["user"]["ID"]; // tester si $_SESSION["user"]["ID"] existe.
}else if (isset($_SESSION["user"]["ID"])){
  $userpid = $_SESSION["user"]["ID"];
  $data["owner"] = true;
}else{
  $userpid = NULL;
}

$dao = new DAO();
if(isset($userpid)){
  $user = $dao->readPersonneByIdGoodClasse($userpid);


  $data["nomcomplet"] = $user->getNomComplet();
  $data["mailco"] = $user->getEmailcontact();
  $data["tel"] = $user->getTel();
  if($user->getDescription() == NULL){
    $data["description"] = "Aucune description ...";
  }else {
    $data["description"] = $user->getDescription();
  }
  $data["typename"] = $user->getNomType();
  $data["type"] = $user->getType();

//Affichage adresse ###################################################""

  $adresse = $dao->readLieuById($user->getAdresse());
  if($adresse != NULL){
    if($adresse->getLatitude() != NULL && $adresse->getLongitude() != NULL ){
      $data["adresse"]["liengooglemaps"] = "https://www.google.fr/maps/place/".$adresse->getLatitude()."+".$adresse->getLongitude();
    }else if($adresse->getAdresse() != NULL && $adresse->getcodepostal() != NULL && $adresse->getVille() != NULL && $adresse->getPays() != NULL){
      $data["adresse"]["liengooglemaps"] = "https://www.google.fr/maps/place/".str_replace ( ' ' ,'+' ,$adresse->getAdresse())."+".$adresse->getcodepostal()."+".$adresse->getVille()."+".strtolower($adresse->getPays());
    }else{
      $data["adresse"]["liengooglemaps"] = NULL;
    }
    $data["adresse"]["adresse"] = $adresse->getAdresse();
    $data["adresse"]["codePostal"] = $adresse->getcodepostal();
    $data["adresse"]["Ville"] = $adresse->getVille();
    $data["adresse"]["Region"] = $adresse->getRegion();
    $data["adresse"]["Pays"] = $adresse->getPays();

    $data["adresse"]["ok"] = true;
  }else{
    $data["adresse"]["ok"] = false;
  }
//FIN Affichage adresse ###################################################""


//Affichage Liste Groupe ou EVTs ###################################################""
  if($user->getType() == 0){ //Un booker
    $data["user"] = true;
    $data["mail"] = $user->getEmailCompte();
    $data["listname"] = "Je gère ces groupes";
    $data["typelist"] = "Groupe(s)";
    $listidgroupe = $dao->readListGroupeByBooker($user->getIdPersonne());
    if($listidgroupe != NULL){
      foreach ($listidgroupe as $key => $value) {
        $groupe = $dao->readGroupeById((int) $value);
        $data["list"][$key]["nom"] = $groupe->getNom();
        $data["list"][$key]["id"] = $groupe->getIdGroupe();
      }
      $data["aslist"] = true;
    }else{
      $data["aslist"] = false;
    }
  }elseif ($user->getType() == 1) { //Un Organisateur
    $data["user"] = true;
    $data["mail"] = $user->getEmailCompte();
    $data["listname"] = "Je gère ces evenenements";
    $data["typelist"] = "Evenenement(s)";
    $listevt= $dao->readManifestationByCreateur($user->getIdPersonne());
    if($listevt != NULL){
      foreach ($listevt as $key => $value) {
        $data["list"][$key]["nom"] = $value->getNom();
        $data["list"][$key]["id"] = $value->getidManif();
        $data["list"][$key]["dated"] = $value->getDateDebut();
        if($data["list"][$key]["dated"] == $value->getDateFin()){
          $data["list"][$key]["datef"] = "";
        }else{
          $data["list"][$key]["datef"] = " - ".$value->getDateFin();
        }
      }
      $data["aslist"] = true;
    }else{
      $data["aslist"] = false;
    }
  }else{ // Un artiste
    $data["user"] = false;
    $data["listname"] = "J'appartiens aux groupes";
    $data["typelist"] = "Groupe(s)";
    $listidgroupe = $dao->readListGroupeByArtiste($user->getIdPersonne());
    if($listidgroupe != NULL){
      foreach ($listidgroupe as $key => $value) {
        $groupe = $dao->readGroupeById((int) $value);
        $data["list"][$key]["nom"] = $groupe->getNom();
        $data["list"][$key]["id"] = $groupe->getIdGroupe();
      }
      $data["aslist"] = true;
    }else{
      $data["aslist"] = false;
    }
  }

//FIN Affichage Liste Groupe ou EVTs ###################################################""



  //recup le lieu
}else {
  //erreur 404.
  //page introuvable.
}


include("../view/profil.view.php");
?>
