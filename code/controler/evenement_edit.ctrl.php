<?php
session_start();
//include_once("../model/Artist.class.php");
include("include/auth.ctrl.php");
require_once("../model/utils.class.php");
require_once("../model/DAO.class.php");
$data = initPage("Events");
$dao = new Dao();

$userid= $_SESSION["user"]["ID"];
$user = $dao->readOrganisateurById($userid);

if($user != NULL){ // SI c'est un organisateur
  if(isset($_GET["action"]) && $_GET["action"]=="remove"){ // Si on supprime #######################################################################################################################################################
    if(isset($_POST["idmanif"])){
      $idManif = $_POST["idmanif"];
      $evt = $dao->readManifestationById($idManif);
      if($evt != NULL){
        if($evt->getCreateur() == $userid){
          $dao->deleteManifesationById($idManif);
          header("Location: ../controler/evenements.ctrl.php");
        }else {
          $data['error']['title'] = "Acces Interdit";
          $data['error']['message'] = "Vous ne pouvez pas supprimer une manifestation qui ne vous appartient pas !";
          $data['error']['back'] = "../controler/evenements.ctrl.php";
          include("../view/error.view.php");
        }
      }else {
        $data['error']['title'] = "Evenement inconnu";
        $data['error']['back'] = "../controler/evenements.ctrl.php";
        $data['error']['message'] = "L'evenement que vous essayez de supprimer n'existe pas !";
        include("../view/error.view.php");
      }
    }else {
      $data['error']['title'] = "Evenement inconnu";
      $data['error']['back'] = "../controler/evenements.ctrl.php";
      $data['error']['message'] = "L'evenement que vous essayez de supprimer n'existe pas !";
      include("../view/error.view.php");
    }
  }else if(isset($_GET["action"]) && $_GET["action"]=="edit"){ // Si on Modifie #######################################################################################################################################################
    if(isset($_POST["idmanif"])){
      $idManif = $_POST["idmanif"];
      $evt = $dao->readManifestationById($idManif);
      if($evt != NULL){
        if($evt->getCreateur() == $userid){

          $idlieu = $evt->getLieu();
          $lieu = $dao->readLieuById($idlieu);

          //Mise a jour Groupe
          $nomevent = $_POST["nomevent"];
          $type = $_POST["type"];
          $autre = $_POST["autre"];
          if($type == "Autre"){
            $type = $autre;
          }
          $genre = $_POST["genre"];
          $genres = explode(",",$genre);
          $dao->deleteManifestationGenreByIdManif($idManif);
          foreach ($genres as $key => $value) {
            $dao->createManifestationGenre($idManif,$value);
          }



          $dated = $_POST["dated"];
          $datef = $_POST["datef"];
          $des = $_POST["des"];

          $evt->setNom($nomevent);
          $evt->setType($type);
          $evt->setDescription($des);
          $evt->setDateDebut($dated);
          $evt->setDateFin($datef);
          //Fin Mise a jour Groupe
          // mise a jour Lieu
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
          //Fin mise a jour Lieu


          $dao->updateManifestation($evt);
          $dao->updateLieu($lieu);


          header("Location: ../controler/evenement.ctrl.php?id=".$evt->getidManif()."");
        }else {
          $data['error']['title'] = "Acces Interdit";
          $data['error']['message'] = "Vous ne pouvez pas modifier une manifestation qui ne vous appartient pas !";
          $data['error']['back'] = "../controler/evenements.ctrl.php";
          include("../view/error.view.php");
        }
      }else {
        $data['error']['title'] = "Evenement inconnu";
        $data['error']['back'] = "../controler/evenements.ctrl.php";
        $data['error']['message'] = "L'evenement que vous essayez de modifier n'existe pas !";
        include("../view/error.view.php");
      }
    }else {
      $data['error']['title'] = "Evenement inconnu";
      $data['error']['back'] = "../controler/evenements.ctrl.php";
      $data['error']['message'] = "L'evenement que vous essayez de modifier n'existe pas !";
      include("../view/error.view.php");
    }
  }else{ // Si on lis #########################################################################################################################################################################################################
    if (isset($_GET['id'])) { // Si il n'y a pas d'id alors -> message d'erreur
      $evtid = $_GET['id'];
      $evt = $dao->readManifestationById($evtid);// Recupérer les données depuis la BD avec l'id ($_GET['id'])
      if($evt != NULL){ // Si existe dans BD
        //On verifie que la manifestation appartient bien a l'organisateur
        if($evt->getCreateur() == $userid){ //Si il est le proprietaire de l'evt alors on affiche. sinon message d'erreur
          //Information sur l'evt !
          $data['evenement']['id'] = $evtid;
          $data['evenement']['nom'] = $evt->getNom();
          $data['evenement']['dated'] = $evt->getDateDebut();
          $data['evenement']['datef'] = $evt->getDateFin();
          $data['evenement']['type'] = $evt->getType();
          $genre = $dao->readManifestationGenreByidManif($evtid);
          if($genre != NULL){
            foreach ($genre as $key => $value) {
              if(!empty($data['evenement']['genre'])){
                $data['evenement']['genre'] = $data['evenement']['genre'].",".$value['nomg'];
              }else {
                $data['evenement']['genre'] = $value['nomg'];
              }
            }
          }else {
            $data['evenement']['genre'] = "";
          }
          if($evt->getDescription() == NULL){
            $data['evenement']['description'] = "";
          }else {
            $data['evenement']['description'] = $evt->getDescription();
          }
          if(($idlieu = $evt->getLieu()) == NULL){
            $data['evenement']['lieu']['adresse'] = "";
            $data['evenement']['lieu']['codepostal'] = "";
            $data['evenement']['lieu']['ville'] = "";
            $data['evenement']['lieu']['pays'] = "";
            $data['evenement']['lieu']['region'] = "";
            $data['evenement']['lieu']['latitude'] = "";
            $data['evenement']['lieu']['longitude'] = "";
          }else{
            $lieu = $dao->readLieuById($idlieu);
            $data['evenement']['lieu']['adresse'] = $lieu->getAdresse();
            $data['evenement']['lieu']['codepostal'] = $lieu->getcodepostal();
            $data['evenement']['lieu']['ville'] = $lieu->getVille();
            $data['evenement']['lieu']['pays'] = $lieu->getPays();
            $data['evenement']['lieu']['region'] = $lieu->getRegion();
            $data['evenement']['lieu']['latitude'] = $lieu->getLatitude();
            $data['evenement']['lieu']['longitude'] = $lieu->getLongitude();
          }


          include("../view/evenement_edit.view.php");
        }else {
          $data['error']['title'] = "Acces Interdit";
          $data['error']['message'] = "Vous ne pouvez pas venir ici, cet espace est reservé à l'organisateur de la manifestation.";
          $data['error']['back'] = "../controler/main.ctrl.php";
          include("../view/error.view.php");
        }
      }else {
        $data['error']['title'] = "Evenement inconnu";
        $data['error']['back'] = "../controler/evenements.ctrl.php";
        $data['error']['message'] = "Vous vous etes perdu ...";
        include("../view/error.view.php");
      }
    }
    else{
      $data['error']['title'] = "Evenement inconnu";
      $data['error']['back'] = "../controler/evenements.ctrl.php";
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
