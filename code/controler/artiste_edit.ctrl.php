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
      $artiste = $dao->readArtisteById($artisteid);
      if($artiste != NULL){
        $ok = $user->userinmanagedgroupok($artisteid);
        if($ok){

          $data['id'] = $artisteid;
          $data['prenom'] = $artiste->getPrenom();
          $data['nom'] = $artiste->getNom();
          $data['dateNaissance'] = $artiste->getDateNaissance();
          $data['email'] = $artiste->getEmailcontact();
          $data['telephone'] = $artiste->getTel();
          $idlieu = $artiste->getAdresse();

          if(($idlieu) == NULL){
            $data['adresse'] = "";
            $data['codepostal'] = "";
            $data['ville'] = "";
            $data['pays'] = "";
            $data['region'] = "";
            $data['latitude'] = "";
            $data['longitude'] = "";
          }else{
            $lieu = $dao->readLieuById($idlieu);
            $data['adresse'] = $lieu->getAdresse();
            $data['codepostal'] = $lieu->getcodepostal();
            $data['ville'] = $lieu->getVille();
            $data['pays'] = $lieu->getPays();
            $data['region'] = $lieu->getRegion();
            $data['latitude'] = $lieu->getLatitude();
            $data['longitude'] = $lieu->getLongitude();
          }


          if($artiste->getPaiement() == 0){
            $data['paiement'] = "Cheque";
          }else {
            $data['paiement'] = "Virement";

          }
          $data['IBAN'] = $artiste->getRib();
          $data['ordre'] = $artiste->getOrdreCheque();
        }


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




  }
}else {
  $data['error']['title'] = "Acces Interdit";
  $data['error']['message'] = "Vous ne pouvez pas venir ici, cet espace est reservé à l'organisateur de la manifestation.";
  $data['error']['back'] = "../controler/main.ctrl.php";
  include("../view/error.view.php");
}
?>
