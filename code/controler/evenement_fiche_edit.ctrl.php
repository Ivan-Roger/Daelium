<?php
session_start();
//include_once("../model/Artist.class.php");
include("include/auth.ctrl.php");
require_once("../model/utils.class.php");
require_once("../model/DAO.class.php");
$data = initPage("Events");
$dao = new Dao();


if (isset($_GET['id'])) { // Si il n'y a pas d'id alors -> message d'erreur

  // Recupérer les données depuis la BD avec l'id ($_GET['id'])
  $evtid = $_GET['id'];
  $evt = $dao->readManifestationById($evtid);

  if($evt != NULL){
    $idcreateur = $evt->getCreateur();
    $organisateur = $dao->readOrganisateurById($idcreateur);

    $data['evenement']['idorganisateur'] = $idcreateur;
    $data['evenement']['organisateur'] = $organisateur->getPrenom()." ".$organisateur->getNom();
    $data['evenement']['id'] = $_GET['id'];
    $data['evenement']['nom'] = $evt->getNom();
    $data['evenement']['type'] = $evt->getType();
    $data['evenement']['tarif'] = $evt->getType();
    $data['evenement']['dated'] = $evt->getDateDebut();
    $data['evenement']['datef'] = $evt->getDateFin();
    if(($idlieu = $evt->getLieu()) == NULL){
      $data['evenement']['lieu']['adresse'] = "Non indiquer";
      $data['evenement']['lieu']['googlemaps'] = NULL;
    }else{
      $lieu = $dao->readLieuById($idlieu);
      $data['evenement']['lieu']['adresse'] =  $lieu->getAdresse().", ".$lieu->getcodepostal().", ".$lieu->getVille().", ".$lieu->getPays();
      $data['evenement']['lieu']['googlemaps'] = "https://www.google.fr/maps/place/".str_replace ( ' ' ,'+' ,$lieu->getAdresse())."+".$lieu->getcodepostal()."+".$lieu->getVille()."+".strtolower($lieu->getPays());
    }

//Reseaux sociaux
if($evt->getFacebook() == NULL &&  $evt->getTwitter() == NULL && $evt->getGoogle() == NULL){
  $data['evenement']["facebook"] = NULL;
  $data['evenement']["twitter"] = NULL;
  $data['evenement']["google"] = NULL;
  $data['evenement']["rs"] = "Il n'y a pas de liens vers les reseaux sociaux";
}else{
  $data['evenement']["facebook"] = $evt->getFacebook();
  $data['evenement']["twitter"] = $evt->getTwitter();
  $data['evenement']["google"] = $evt->getGoogle();
  $data['evenement']["rs"] ="";
}


    $creneaux = $dao->readCreneauByidManif($evtid);
    foreach ($creneaux as $key => $value) {
      $data['passages'][$key]['date'] = $value->getDate()." ".$value->getHeureDebut();
      $idgroupe = $value->getidGroupe();
      $groupe = $dao->readGroupeById($idgroupe);
      $data['passages'][$key]['groupe']['nom'] = $groupe->getNom();
      $data['passages'][$key]['groupe']['id'] = $idgroupe;
      if($groupe->getDescription() == NULL){
        $data['passages'][$key]['groupe']['description'] = "Il n'y a pas de description pour ce groupe";
      }else {
        $data['passages'][$key]['groupe']['description'] = $groupe->getDescription() ;
      }
    }

    $data['evenement']['img'] = "../data/users/icons/bilbao-logo.jpg";   // Image ?
    include("../view/evenement_fiche.view.php");
  }else {
    $data['error']['title'] = "Manifestation Inconnu";
    $data['error']['back'] = "../controler/main.ctrl.php";
    $data['error']['message'] = "La Manifestation que vous cherchez n'existe pas ou plus !";
    include("../view/error.view.php");
  }
}
