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
      if($user->possedeGroupe($_POST["choix"])){
        $manif = $dao->readManifestationById($_POST['cible']);
        $groupe = $dao->readGroupeById($_POST["choix"]);
        $organisateur = $manif->getCreateur();
        $negociation = new Negociation(NULL,$iduser,$_POST['cible'],$_POST["choix"],$organisateur,1);
        $negociation2 = $dao->createNegociation($negociation);
        $nomuser = $user->getNomComplet();
        $nomgroupe = $groupe->getNom();
        $nommanif = $manif->getNom();
        $idNegociation = $negociation2->getIdNegociation();
        $notification = new Notification(NULL,0,$organisateur,2,$nomuser." souhaite que son groupe ".$nomgroupe." participe à votre Manifestation : ".$nommanif.".  <a href='../controler/negociation.ctrl.php?id=".$idNegociation."' > Voir </a>");
        var_dump($notification);

        $dao->createNotification($notification);
        header("Location: ../controler/negociation.ctrl.php?id=$idNegociation");

      }else {
        $data['error']['title'] = "Action impossible";
        $data['error']['message'] = "Vous ne pouvez pas demarer un groupe pour une Manifestation qui ne vous appartient pas.";
        $data['error']['back'] = "../controler/main.ctrl.php";
        include("../view/error.view.php");
      }
    }elseif ($type == 1) {
      if($user->possedeManif($_GET["choix"])){
        $bookerid = $dao->readBookerByGroupe($_POST["cible"]);
        $manif = $dao->readManifestationById($_POST['choix']);
        $groupe = $dao->readGroupeById($_POST["cible"]);
        $negociation = new Negociation(NULL,$bookerid,$_POST['choix'],$_POST["cible"],$iduser,1);
        $negociation2 = $dao->createNegociation($negociation);
        $nomuser = $user->getNomComplet();
        $nomgroupe = $groupe->getNom();
        $nommanif = $manif->getNom();
        $idNegociation = $negociation2->getIdNegociation();
        $notification = new Notification(NULL,0,$bookerid,2,$nomuser." souhaite que votre groupe ".$nomgroupe." participe à sa Manifestation : ".$nommanif.".  <a href='../controler/negociation.ctrl.php?id=".$idNegociation."' > Voir </a>");
        $dao->createNotification($notification);
        header("Location: ../controler/negociation.ctrl.php?id=$idNegociation");


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
      $data["id"] = $_GET["idGroupe"];
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
      $data["id"] = $_GET["idManifestation"];
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
