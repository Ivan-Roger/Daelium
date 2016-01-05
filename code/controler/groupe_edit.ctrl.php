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
    if(isset($_POST["idgroupe"])){
      $groupeid = $_POST['idgroupe'];
      $groupe = $dao->readGroupeById($groupeid);
      if($groupe != NULL){
        $listegroupeuser = $dao->readListGroupeByBooker($userid);
        if($listegroupeuser != NULL){ // Si l'organisateur a au moins un evt.
          $present = $user->possedeGroupe($groupeid,$listegroupeuser);
        }else {
          $present = false;
        }
        if($present){
          $dao->deleteGroupeByIdGroupe($groupeid);
          header("Location: ../controler/groupes.ctrl.php");

        }else {
          $data['error']['title'] = "Acces Interdit";
          $data['error']['message'] = "Vous ne pouvez pas modifier un groupe qui ne vous appartient pas !";
          $data['error']['back'] = "../controler/groupes.ctrl.php";
          include("../view/error.view.php");
        }
      }else {
        $data['error']['title'] = "Groupe inconnu";
        $data['error']['back'] = "../controler/groupes.ctrl.php";
        $data['error']['message'] = "Le Groupe que vous essayez de modifier n'existe pas !";
        include("../view/error.view.php");
      }

    }else {
      $data['error']['title'] = "Groupe inconnu";
      $data['error']['back'] = "../controler/groupes.ctrl.php";
      $data['error']['message'] = "Le Groupe que vous essayez de modifier n'existe pas !";
      include("../view/error.view.php");
    }
  }else if(isset($_GET["action"]) && $_GET["action"]=="edit"){ // Si on Modifie #######################################################################################################################################################
    if(isset($_POST["idgroupe"])){
      $groupeid = $_POST['idgroupe'];
      $groupe = $dao->readGroupeById($groupeid);
      if($groupe != NULL){
        $listegroupeuser = $dao->readListGroupeByBooker($userid);
        if($listegroupeuser != NULL){ // Si l'organisateur a au moins un evt.
          $present = $user->possedeGroupe($groupeid,$listegroupeuser);
        }else {
          $present = false;
        }
        if($present){ // Si c'est le booker du groupe
          $idlieu = $groupe->getAdresse();
          $lieu = $dao->readLieuById($idlieu);

          // Mise a jour du Lieu
          $adresse = $_POST["adresse"];
          $codepostal = $_POST["codepostal"];
          $ville = $_POST["ville"];
          $region = $_POST["region"];
          $pays = $_POST["pays"];
          $latitude = $_POST["latitude"];
          if(empty($latitude)){
            $latitude = NULL;
          }
          $longitude = $_POST["longitude"];
          if(empty($longitude)){
            $longitude = NULL;
          }

          $lieu->setPays($pays);
          $lieu->setRegion($region);
          $lieu->setVille($ville);
          $lieu->setcodepostal($codepostal);
          $lieu->setAdresse($adresse);
          $lieu->setLatitude($latitude);
          $lieu->setLongitude($longitude);

          $dao->updateLieu($lieu);
          //Fin mise a jour Lieu

          //Mise a jour Groupe
          $nomscene = $_POST["nomscene"];
          $genre = $_POST["genre"];
          $genres = explode(",",$genre);
          $dao->deleteGroupeGenreIdGroupe($groupeid);
          foreach ($genres as $key => $value) {
            $dao->createGroupeGenre($groupeid,$value);
          }

          $des = $_POST["des"];
          $mail = $_POST["mail"];

          $groupe->setNom($nomscene);
          $groupe->setDescription($des);
          $groupe->setEmail($mail);

          $dao->updateGroupe($groupe);
          // Fin mise a jour groupe



          header("Location: ../controler/groupe.ctrl.php?id=".$groupe->getidGroupe()."");
        }else {
          $data['error']['title'] = "Acces Interdit";
          $data['error']['message'] = "Vous ne pouvez pas modifier un groupe qui ne vous appartient pas !";
          $data['error']['back'] = "../controler/groupes.ctrl.php";
          include("../view/error.view.php");
        }
      }else {
        $data['error']['title'] = "Groupe inconnu";
        $data['error']['back'] = "../controler/groupes.ctrl.php";
        $data['error']['message'] = "Le Groupe que vous essayez de modifier n'existe pas !";
        include("../view/error.view.php");
      }


    }else {
      $data['error']['title'] = "Groupe inconnu";
      $data['error']['back'] = "../controler/groupes.ctrl.php";
      $data['error']['message'] = "Le Groupe que vous essayez de modifier n'existe pas !";
      include("../view/error.view.php");
    }


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
          $genre = $dao->readGroupeGenreByIdGroupe($_GET['id']);
          if($genre != NULL){
            foreach ($genre as $key => $value) {
              if(!empty($data['groupe']['genre'])){
                $data['groupe']['genre'] = $data['groupe']['genre'].",".$value['nomg'];
              }else {
                  $data['groupe']['genre'] = $value['nomg'];
              }
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
