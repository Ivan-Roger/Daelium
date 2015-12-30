<?php
  session_start();
  include("include/auth.ctrl.php");
  require_once("../model/DAO.class.php");
  require_once("../model/utils.class.php");
  $data = initPage("Negociations");
  $dao = new DAO();

  $iduser = $_SESSION["user"]["ID"];
  $user = $dao->readPersonneByIdGoodClasse($_SESSION["user"]["ID"]);
  $type = $user->getType();


  if(isset($_GET["action"]) && $_GET["action"] == "create"){
    if($type == 0){
      if($user->possedeGroupe($_GET["choix"])){


      }else {
        $data['error']['title'] = "Action impossible";
        $data['error']['message'] = "Vous ne pouvez pas demarer un groupe pour une Manifestation qui ne vous appartient pas.";
        $data['error']['back'] = "../controler/main.ctrl.php";
        include("../view/error.view.php");
      }
    }elseif ($type == 1) {
      if($user->possedeManif($_GET["choix"])){


      }else {
        $data['error']['title'] = "Action impossible";
        $data['error']['message'] = "Vous ne pouvez pas demarer une negociation pour une Manifestation qui ne vous appartient pas.";
        $data['error']['back'] = "../controler/main.ctrl.php";
        include("../view/error.view.php");
      }
    }





  }elseif(isset($_GET["idGroupe"]) && $type== 1){
    $groupe = $dao->readGroupeById($_GET["idGroupe"]);
    if(isset($groupe)){
      $data["type"] = "le Groupe";
      $data["typerech"] = "Manifestation";

      $data["nom"] = $groupe->getNom();
      $list = array();
      $list = $dao->readManifestationByCreateur($iduser);
      $data["list"] = array();
      foreach ($list as $key => $value) {
        $data["list"][$key]["nom"] = $value->getNom();
        $data["list"][$key]["id"] = $value->getIdManif();
      }
    include("../view/negociation_new.view.php");
    }else{
      $data['error']['title'] = "Groupe Inconnu";
      $data['error']['back'] = "../controler/main.ctrl.php";
      $data['error']['message'] = "Vous vous etes perdu";
      include("../view/error.view.php");
    }
  }elseif (isset($_GET["idManifestation"]) &&  $type == 0) {
    $manif = $dao->readManifestationById($_GET["idManifestation"]);
    if(isset($manif)){
      $data["type"] = "la Manifestation";
      $data["typerech"] = "Groupe";

      $data["nom"] = $manif->getNom();
      $list = array();
      $groupesid = $dao->readListGroupeByBooker($iduser);
      $data["list"] = array();
      foreach ($groupesid as $key => $value) {
        $groupe = $dao->readGroupeById($value['idgroupe']);
        $data["list"][$key]["nom"] = $groupe->getNom();
        $data["list"][$key]["id"] = $value['idgroupe'];
      }
    include("../view/negociation_new.view.php");
    }else{
      $data['error']['title'] = "Manifestation Inconnu";
      $data['error']['back'] = "../controler/main.ctrl.php";
      $data['error']['message'] = "Vous vous etes perdu";
      include("../view/error.view.php");
    }
  }else {
    $data['error']['title'] = "Action impossible";
    $data['error']['message'] = "Vous ne pouvez pas negocier un groupe si vous êtes Booker / Manifestation si vous êtes organisateur";
    $data['error']['back'] = "../controler/main.ctrl.php";
    include("../view/error.view.php");
  }
?>
