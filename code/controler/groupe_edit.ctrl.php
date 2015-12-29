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
  if(isset($_GET["action"]) && $_GET["action"]=="remove"){// Si on supprime #######################################################################################################################################################

  }else if(isset($_GET["action"]) && $_GET["action"]=="edit"){ // Si on Modifie #######################################################################################################################################################



  }else{// Si on lis #########################################################################################################################################################################################################
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
        if($present){ //Si il est le booker de du groupe alors on affiche. sinon message d'erreur
          $data['groupe']['nom'] = $groupe->getNom();
          $data['groupe']['id'] = $groupeid;
          $data['groupe']['email'] = $groupe->getEmail();
          if($groupe->getDescription() == NULL){
            $data['groupe']['description'] = "";
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
            $data['groupe']['genre'] = "";
          }
          if(($idlieu = $groupe->getAdresse()) == NULL){
            $data['groupe']['lieu']['adresse'] = "";
            $data['groupe']['lieu']['codepostal'] = "";
            $data['groupe']['lieu']['ville'] = "";
            $data['groupe']['lieu']['pays'] = "";
            $data['groupe']['lieu']['region'] = "";
            $data['groupe']['lieu']['latitude'] = "";
            $data['groupe']['lieu']['longitude'] = "";
          }else{
            $lieu = $dao->readLieuById($idlieu);
            $data['groupe']['lieu']['adresse'] = $lieu->getAdresse();
            $data['groupe']['lieu']['codepostal'] = $lieu->getcodepostal();
            $data['groupe']['lieu']['ville'] = $lieu->getVille();
            $data['groupe']['lieu']['pays'] = $lieu->getPays();
            $data['groupe']['lieu']['region'] = $lieu->getRegion();
            $data['groupe']['lieu']['latitude'] = $lieu->getLatitude();
            $data['groupe']['lieu']['longitude'] = $lieu->getLongitude();
          }


          include("../view/groupe_edit.view.php");
        }else {
          $data['error']['title'] = "Acces Interdit";
          $data['error']['message'] = "Vous ne pouvez pas venir ici, cet espace est reservé au booker du la groupe.";
          $data['error']['back'] = "../controler/main.ctrl.php";
          include("../view/error.view.php");


        }


      }else {
        $data['error']['title'] = "Groupe inconnu";
        $data['error']['back'] = "../controler/groupes.ctrl.php";
        $data['error']['message'] = "Vous vous etes perdu ...";
        include("../view/error.view.php");
      }



    }else{
      $data['error']['title'] = "Groupe inconnu";
      $data['error']['back'] = "../controler/groupes.ctrl.php";
      $data['error']['message'] = "Vous vous etes perdu ...";
      include("../view/error.view.php");
    }
  }
}else {
  $data['error']['title'] = "Acces Interdit";
  $data['error']['message'] = "Vous ne pouvez pas venir ici, cet espace est reservé à l'organisateur de la manifestation.";
  $data['error']['back'] = "../controler/main.ctrl.php";
  include("../view/error.view.php");
}
?>
