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
    if(isset($_GET["action"]) && $_GET["action"] == "delete" && isset($_GET["idgroupe"]) && isset($_GET["idmanif"])){
      $idmanif = $_GET["idmanif"];
      $idGroupe = $_GET["idgroupe"];
      $creneau = $dao->readCreneauByPrimary($idmanif,$idGroupe);
      if($creneau != NULL){
          if($user->possedeManif($idmanif)){

            $dao->deleteCreneau($creneau);

            if(isset($_GET["idnego"])){
              $idnego = $_GET["idnego"];
              header("Location: ../controler/negociation.ctrl.php?id=$idnego"); // A modifier par la suite
          }else{
            header("Location: ../controler/negociations.ctrl.php");
          }


          }else {
            $data['error']['title'] = "Acces Interdit";
            $data['error']['message'] = "Vous ne pouvez pas modifier un Creneau si vous n'êtes pas Organisateur de la Manifestation !";
            $data['error']['back'] = "../controler/negociations.ctrl.php";
            include("../view/error.view.php");
          }
      }else {
        $data['error']['title'] = "Creneau inconnu";
        $data['error']['back'] = "../controler/negociations.ctrl.php";
        $data['error']['message'] = "La Creneau est inconnu.";
        include("../view/error.view.php");
      }
    }else if(isset($_GET["action"]) && $_GET["action"] == "edit" && isset($_POST["idgroupe"]) && isset($_POST["idmanif"])){
      $idmanif = $_POST["idmanif"];
      $idGroupe = $_POST["idgroupe"];
      $creneau = $dao->readCreneauByPrimary($idmanif,$idGroupe);
      if($creneau != NULL){
          if($user->possedeManif($idmanif)){

            $data['idNego'] = $_POST["idnego"];
            $idnego =$_POST["idnego"];


            $creneau->setDate($_POST["date"]);
            $creneau->setHeureDebut($_POST["hd"]);
            $creneau->setHeureFin($_POST["hf"]);
            $creneau->setHeureDebutTest($_POST["hdt"]);
            $creneau->setHeureFinTest($_POST["hft"]);
            $creneau->setLieu($_POST["lieu"]);

            $dao->updateCreneau($creneau);

            header("Location: ../controler/negociation.ctrl.php?id=$idnego"); // A modifier par la suite


          }else {
            $data['error']['title'] = "Acces Interdit";
            $data['error']['message'] = "Vous ne pouvez pas modifier un Creneau si vous n'êtes pas Organisateur de la Manifestation !";
            $data['error']['back'] = "../controler/negociations.ctrl.php";
            include("../view/error.view.php");
          }
      }else {
        $data['error']['title'] = "Creneau inconnu";
        $data['error']['back'] = "../controler/negociations.ctrl.php";
        $data['error']['message'] = "La Creneau est inconnu.";
        include("../view/error.view.php");
      }


    }else if(isset($_GET["idgroupe"]) && isset($_GET["idmanif"])){
      $idmanif = $_GET["idmanif"];
      $idGroupe = $_GET["idgroupe"];
      $manif = $dao->readManifestationById($idmanif);
      $groupe = $dao->readGroupeById($idGroupe);
      $creneau = $dao->readCreneauByPrimary($idmanif,$idGroupe);
      if($creneau != NULL){
        if($user->possedeManif($idmanif)){
          $data["nomgroupe"] = $groupe->getNom();
          $data["idgroupe"] = $idGroupe;
          $data["idmanif"] = $idmanif;
          $data["nommanif"] = $manif->getNom();
          $data["hd"]  = $creneau->getHeureDebut();
          $data["hf"] = $creneau->getHeureFin();
          $data["hdt"] = $creneau->getHeureDebutTest();
          $data["hft"] = $creneau->getHeureFinTest();
          $data["lieu"] = $creneau->getLieu();
          $data["date"] = $creneau->getDate();
          if(isset($_GET["idnego"])){
          $data["idnego"] = $_GET["idnego"];
        }else{
          $data["idnego"]= -2;
        }

        include_once("../view/creneau.view.php");

        }else {
          $data['error']['title'] = "Acces Interdit";
          $data['error']['message'] = "Vous ne pouvez pas modifier un Creneau si vous n'êtes pas Organisateur de la Manifestation !";
          $data['error']['back'] = "../controler/negociations.ctrl.php";
          include("../view/error.view.php");
        }



      }else {
        $data['error']['title'] = "Creneau inconnu";
        $data['error']['back'] = "../controler/negociations.ctrl.php";
        $data['error']['message'] = "La Creneau est inconnu.";
        include("../view/error.view.php");
      }


    }else {
      $data['error']['title'] = "Argument manquant";
      $data['error']['back'] = "../controler/negociations.ctrl.php";
      $data['error']['message'] = "L'id du groupe et l'id de la manifestation ne sont pas renseignée.";
      include("../view/error.view.php");
    }
  }else {
    $data['error']['title'] = "Acces Interdit";
    $data['error']['message'] = "Vous ne pouvez pas ajouter un Creneau si vous n'êtes pas Organisateur !";
    $data['error']['back'] = "../controler/main.ctrl.php";
    include("../view/error.view.php");
  }






?>
