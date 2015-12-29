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
    if(isset($_POST["idgroupe"]) && isset($_POST["idartiste"])){
      $groupeid = $_POST['idgroupe'];
      $aristeid = $_POST['idartiste'];
      $Artiste = $dao->readArtisteById($aristeid);
      $groupe = $dao->readGroupeById($groupeid);

      if($groupe != NULL && $Artiste != NULL){

        $listegroupeArtiste = $Artiste->getListeGroupe();
        $listegroupeuser = $dao->readListGroupeByBooker($userid);
        if($listegroupeuser != NULL){
          $present = $user->possedeGroupe($groupeid,$listegroupeuser);
        }else {
          $present = false;
        }
        if($present && $Artiste->estDansGroupe($groupeid)){
          $dao->deleteGroupeArtisteByIdArtisteIdGroupe($groupeid,$aristeid);
          if(count($Artiste->getListeGroupe()) == 1){
            $dao->deleteArtisteById($aristeid);
          }
          header("Location: ../controler/groupe.ctrl.php?id=".$groupeid."");

        }else {
          $data['error']['title'] = "Acces Interdit";
          $data['error']['message'] = "Vous ne pouvez pas supprimer un artiste qui est dans un groupe qui ne vous appartient pas !";
          $data['error']['back'] = "../controler/groupes.ctrl.php";
          include("../view/error.view.php");
        }
      }else {
        $data['error']['title'] = "Groupe ou Ariste inconnu";
        $data['error']['back'] = "../controler/groupes.ctrl.php";
        $data['error']['message'] = "L'Artiste que vous essayez de supprimer n'existe pas !";
        include("../view/error.view.php");
      }

    }else {
      $data['error']['title'] = "Groupe ou Ariste inconnu";
      $data['error']['back'] = "../controler/groupes.ctrl.php";
      $data['error']['message'] = "L'Artiste que vous essayez de supprimer n'existe pas !";
      include("../view/error.view.php");
    }
  }else if(isset($_GET["action"]) && $_GET["action"]=="edit"){ // Si on Modifie #######################################################################################################################################################
    if(isset($_POST["idgroupe"]) && isset($_POST["idartiste"])){
      $groupeid = $_POST['idgroupe'];
      $aristeid = $_POST['idartiste'];
      $Artiste = $dao->readArtisteById($aristeid);
      $groupe = $dao->readGroupeById($groupeid);

      if($groupe != NULL && $Artiste != NULL){

        $listegroupeArtiste = $Artiste->getListeGroupe();
        $listegroupeuser = $dao->readListGroupeByBooker($userid);
        if($listegroupeuser != NULL){
          $present = $user->possedeGroupe($groupeid,$listegroupeuser);
        }else {
          $present = false;
        }
        if($present && $Artiste->estDansGroupe($groupeid)){


          //Lieu


          //Artiste





          header("Location: ../controler/groupe.ctrl.php?id=".$groupeid."");

        }else {
          $data['error']['title'] = "Acces Interdit";
          $data['error']['message'] = "Vous ne pouvez pas supprimer un artiste qui est dans un groupe qui ne vous appartient pas !";
          $data['error']['back'] = "../controler/groupes.ctrl.php";
          include("../view/error.view.php");
        }
      }else {
        $data['error']['title'] = "Groupe ou Ariste inconnu";
        $data['error']['back'] = "../controler/groupes.ctrl.php";
        $data['error']['message'] = "L'Artiste que vous essayez de supprimer n'existe pas !";
        include("../view/error.view.php");
      }

    }else {
      $data['error']['title'] = "Groupe ou Ariste inconnu";
      $data['error']['back'] = "../controler/groupes.ctrl.php";
      $data['error']['message'] = "L'Artiste que vous essayez de supprimer n'existe pas !";
      include("../view/error.view.php");
    }
  }else{// Si on lis #########################################################################################################################################################################################################
    if(isset($_GET['id'])){
      $artisteid = $_GET['id'];
      $Artiste = $dao->readArtisteById($artisteid);
      if($Artiste != NULL){


        $ok = $user->userinmanagedgroupok($artisteid);
        if($ok){


          include("../view/artiste_edit.view.php");
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
