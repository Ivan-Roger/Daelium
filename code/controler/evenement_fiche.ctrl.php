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
    if(($idlieu = $evt->getLieu()) == NULL){
      $data['evenement']['lieu']['adresse'] = "Non indiquer";
      $data['evenement']['lieu']['googlemaps'] = NULL;
    }else{
      $lieu = $dao->readLieuById($idlieu);
      $data['evenement']['lieu']['adresse'] =  $lieu->getAdresse().", ".$lieu->getcodepostal().", ".$lieu->getVille().", ".$lieu->getPays();
      $data['evenement']['lieu']['googlemaps'] = "https://www.google.fr/maps/place/".str_replace ( ' ' ,'+' ,$lieu->getAdresse())."+".$lieu->getcodepostal()."+".$lieu->getVille()."+".strtolower($lieu->getPays());
    }
    $pas['date'] = "18/11/2015 21h20";
    $pas['groupe']['nom'] = "En marche";
    $data['passages'][] = $pas;

    $pas['date'] = "18/11/2015 21h50";
    $pas['groupe']['nom'] = "Batoucada";
    $data['passages'][] = $pas;

    $data['evenement']['img'] = "../data/users/icons/bilbao-logo.jpg";
    include("../view/evenement_fiche.view.php");
  }else {
    $data['error']['title'] = "Manifestation Inconnu";
    $data['error']['back'] = "../controler/main.ctrl.php";
    $data['error']['message'] = "La Manifestation que vous cherchez n'existe pas ou plus !";
    include("../view/error.view.php");
  }
}
