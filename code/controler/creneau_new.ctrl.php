<?php
  session_start();
  include("include/auth.ctrl.php");
  require_once("../model/utils.class.php");
  $data = initPage("Creneau");
  require_once("../model/DAO.class.php");
  $dao = new Dao();


  $userid= $_SESSION["user"]["ID"];
  $user = $dao->readOrganisateurById($userid);
  if($user != NULL){
    if(isset($_GET["action"]) && $_GET["action"] == "new" && $_POST["idnego"]){
      $data['idNego'] = $_POST["idnego"];
      $idnego =$_POST["idnego"];
      $nego = $dao->readNegociationById($_POST["idnego"]);
      $idGroupe = $nego->getIdGroupe();
      $idManif = $nego->getIdManif();

      $groupe = $dao->readGroupeById($idGroupe);
      $manif = $dao->readManifestationById($idManif);

        if($nego != NULL){
          if($userid == $nego->getIdOrganisateur()){
            if(isset($_POST["tests"]) && $_POST["tests"]==1){
              $hdt = $_POST["hdt"];
              $hft = $_POST["hft"];
            }else {
              $hdt = $hft =NULL;
            }
              $Creneau = new Creneau($idManif,$idGroupe, $_POST["lieu"],$_POST["select"],$_POST["hd"], $_POST["hf"],$hdt,$hft);
              $dao->createCreneau($Creneau);
              header("Location: ../controler/negociation.ctrl.php?id=$idnego"); // A modifier par la suite
          }else {
            $data['error']['title'] = "Acces Interdit";
            $data['error']['message'] = "Vous ne pouvez pas ajouter un Creneau si vous n'êtes pas Organisateur de la Manifestation !";
            $data['error']['back'] = "../controler/negociations.ctrl.php";
            include("../view/error.view.php");
          }
        }else {
          $data['error']['title'] = "Negociation inconnu";
          $data['error']['back'] = "../controler/negociations.ctrl.php";
          $data['error']['message'] = "La Manifestation est inconnu.";
          include("../view/error.view.php");
        }

    }else if(isset($_GET["idNego"])){
      $data['idNego'] = $_GET["idNego"];
      $nego = $dao->readNegociationById($_GET["idNego"]);
      $idGroupe = $nego->getIdGroupe();
      $idManif = $nego->getIdManif();


      $groupe = $dao->readGroupeById($idGroupe);
      $manif = $dao->readManifestationById($idManif);

      $data['nomgroupe'] =$groupe->getNom();
      $data['nommanif'] =$manif->getNom();

        if($nego != NULL){
          if($userid == $nego->getIdOrganisateur()){
            $manif = $dao->readManifestationById($idManif);
            $dates = $manif->getDates();
            $data["dates"] = $dates;
              include("../view/creneau_new.view.php");
          }else {
            $data['error']['title'] = "Acces Interdit";
            $data['error']['message'] = "Vous ne pouvez pas ajouter un Creneau si vous n'êtes pas Organisateur de la Manifestation !";
            $data['error']['back'] = "../controler/negociations.ctrl.php";
            include("../view/error.view.php");
          }
        }else {
          $data['error']['title'] = "Negociation inconnu";
          $data['error']['back'] = "../controler/negociations.ctrl.php";
          $data['error']['message'] = "La Manifestation est inconnu.";
          include("../view/error.view.php");
        }

    }else {
      $data['error']['title'] = "Argument manquant";
      $data['error']['back'] = "../controler/negociations.ctrl.php";
      $data['error']['message'] = "L'id de la Negociation n'est pas renseigné.";
      include("../view/error.view.php");
    }
  }else {
    $data['error']['title'] = "Acces Interdit";
    $data['error']['message'] = "Vous ne pouvez pas ajouter un Creneau si vous n'êtes pas Organisateur !";
    $data['error']['back'] = "../controler/main.ctrl.php";
    include("../view/error.view.php");
  }






?>
