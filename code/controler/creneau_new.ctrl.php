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
    if(isset($_GET["action"]) && $_GET["action"] == "edit" && $_POST["idNego"]){
      $data['idNego'] = $_POST["idNego"];
      $nego = $dao->readNegociationById($_POST["idNego"]);
      $data['idgroupe'] = $nego->getIdGroupe();
      $data['idmanif'] = $nego->getIdManif();

      $groupe = $dao->readGroupeById($data['idgroupe']);
      $manif = $dao->readManifestationById($data['idmanif']);

        if($nego != NULL){
          if($userid == $nego->getIdOrganisateur()){
              // Traitement du formulaire
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
