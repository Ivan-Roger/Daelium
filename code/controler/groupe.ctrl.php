<?php
session_start();
include("include/auth.ctrl.php");
require_once("../model/utils.class.php");
require_once("../model/DAO.class.php");
$data = initPage("Groupes");
$dao = new Dao();

$userid= $_SESSION["user"]["ID"];
$user = $dao->readBookerById($userid);

if($user != NULL){ // SI booker

  if(isset($_GET['id'])){
    $groupeid = $_GET['id'];
    $groupe = $dao->readGroupeById($groupeid);
    if($groupe != NULL){

      $listegroupeuser = $dao->readListGroupeByBooker($userid);
      if($listegroupeuser != NULL){ // Si l'organisateur a au moins un evt.
        $present = $user->possedeGroupe($groupeid,$listegroupeuser);
      }else {
        $present = false;
      }
      if($present){
        $listA = $dao->readArtisteByGroupe($groupeid);
        $i = 0;

        if($listA != NULL){
        foreach ($listA as $key => $value) {
          $artiste = $dao->readArtisteById($value);
          $art[$i]['prenom'] = $artiste->getPrenom();
          $art[$i]['nom'] = $artiste->getNom();
          $art[$i]['dateNaissance'] = $artiste->getDateNaissance();
          $art[$i]['email'] = $artiste->getEmailcontact();
          $art[$i]['telephone'] = $artiste->getTel();
          $art[$i]['adresse'] = $artiste->getAdresse();
          if(($idlieu = $artiste->getAdresse()) == NULL){
            $art[$i]['adresse'] = "Non indiquée";
          }else{
            $lieu = $dao->readLieuById($idlieu);
            $art[$i]['adresse'] =  $lieu->getAdresse().", ".$lieu->getcodepostal().", ".$lieu->getVille().", ".$lieu->getPays();
          }
          if($artiste->getPaiement() == 0){
            $art[$i]['paiement'] = "Cheque";
          }else {
            $art[$i]['paiement'] = "Virement";

          }
          $art[$i]['IBAN'] = $artiste->getRib();
          $art[$i]['ordre'] = $artiste->getOrdreCheque();
          $i++;
        }
        $data['artistes']= $art;
      }else {
        $data['artistes'] =array();
      }

        $data['groupe']['id']=$_GET['id'];
        $data['groupe']['nom'] = $groupe->getNom();
        $data['groupe']['nb']= $i;
        $data['groupe']['email'] = $groupe->getEmail();

        if($groupe->getDescription() == NULL){
          $data['groupe']['description'] = "Aucune description";
        }else {
          $data['groupe']['description'] = $groupe->getDescription();
        }
        $genre = $dao->readManifestationGenreByidManif($_GET['id']);
        $data['groupe']['genre'] = "";
        if($genre != NULL){
          foreach ($genre as $key => $value) {
            $data['groupe']['genre'] = $data['groupe']['genre']." ".$value['nomg'];
          }
        }else {
          $data['groupe']['genre'] = "Aucun genre";
        }
        if(($idlieu = $groupe->getAdresse()) == NULL){
          $data['groupe']['lieu']['adresse'] = "Non indiquée";
          $data['groupe']['lieu']['googlemaps'] = NULL;
        }else{
          $lieu = $dao->readLieuById($idlieu);
          $data['groupe']['lieu']['adresse'] =  $lieu->getAdresse().", ".$lieu->getcodepostal().", ".$lieu->getVille().", ".$lieu->getPays();
          $data['groupe']['lieu']['googlemaps'] = "https://www.google.fr/maps/place/".str_replace ( ' ' ,'+' ,$lieu->getAdresse())."+".$lieu->getcodepostal()."+".$lieu->getVille()."+".strtolower($lieu->getPays());
        }

        //envoie les données pour un artiste
        include("../view/groupe.view.php");
      }else {
        $data['error']['title'] = "Acces Interdit";
        $data['error']['message'] = "Vous ne pouvez pas venir ici, cet espace est reservé à l'organisateur de la manifestation.";
        $data['error']['back'] = "../controler/main.ctrl.php";
        include("../view/error.view.php");
      }
    }else {
      $data['error']['title'] = "Artiste Inconnu";
      $data['error']['back'] = "../controler/artistes.ctrl.php";
      $data['error']['message'] = "Vous vous etes perdu";
      include("../view/error.view.php");
    }
  }else {
    $data['error']['title'] = "Artiste Inconnu";
    $data['error']['back'] = "../controler/artistes.ctrl.php";
    $data['error']['message'] = "Vous vous etes perdu";
    include("../view/error.view.php");
  }
}else {
  $data['error']['title'] = "Acces Interdit";
  $data['error']['message'] = "Vous ne pouvez pas venir ici, cet espace est reservé à l'organisateur de la manifestation.";
  $data['error']['back'] = "../controler/main.ctrl.php";
  include("../view/error.view.php");
}
  ?>
