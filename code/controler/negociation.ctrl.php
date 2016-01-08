<?php
  session_start();
  include("include/auth.ctrl.php");
  require_once("../model/utils.class.php");
  require_once("../model/DAO.class.php");
  $data = initPage("Negociation");
  $dao = new DAO();

  $userid= $_SESSION["user"]["ID"];
  $user = $dao->readUtilisateurById($userid);
  $nomuser = $user->getNomComplet();



  if(isset($_POST["accepter"])){
    $idnego = $_POST["accepter"];
    $nego = $dao->readNegociationById($idnego);

    if($nego != NULL){
      $idbookernego = $nego->getIdBooker();
      $idorganisateurnego = $nego->getIdOrganisateur();
      $idGroupe = $nego->getIdGroupe();
      $idManif = $nego->getIdManif();

      $booker = $dao->readBookerById($idbookernego);
      $groupe = $dao->readGroupeById($idGroupe);
      $manif = $dao->readManifestationById($idManif);
      $organisateur = $dao->readOrganisateurById($idorganisateurnego);

      $nomgroupe= $groupe->getNom();
      $nommanif= $manif->getNom();


      if($userid == $idbookernego){
        $nego->setetat(3);
        $dao->updateNegociation($nego);
        $notification = new Notification(NULL,0,$idorganisateurnego,2,$nomuser." a accepeté la negociation entre le groupe ".$nomgroupe." et votre Manifestation : ".$nommanif.".  <a href='../controler/negociation.ctrl.php?id=".$idnego."' > Voir </a>");
        $dao->createNotification($notification);
        header("Location: ../controler/negociation.ctrl.php?id=$idnego");
      }else if($userid == $idorganisateurnego) {
        $nego->setetat(3);
        $dao->updateNegociation($nego);
        $notification = new Notification(NULL,0,$idbookernego,2,$nomuser." a accepeté la negociation entre votre groupe ".$nomgroupe." et sa Manifestation : ".$nommanif.".  <a href='../controler/negociation.ctrl.php?id=".$idnego."' > Voir </a>");
        $dao->createNotification($notification);
        header("Location: ../controler/negociation.ctrl.php?id=$idnego");
      }else {
        $data['error']['title'] = "Acces Interdit";
        $data['error']['back'] = "../controler/negociations.ctrl.php";
        $data['error']['message'] = "Vous ne pouvez pas refuser une negociation qui ne vous appartient pas";
        include("../view/error.view.php");
      }
    }else {
      $data['error']['title'] = "Negociation Inconnu";
      $data['error']['back'] = "../controler/negociations.ctrl.php";
      $data['error']['message'] = "Vous vous etes perdu";
      include("../view/error.view.php");
    }
  }elseif (isset($_POST["relancer"])) {
    $idnego = $_POST["relancer"];
    $nego = $dao->readNegociationById($idnego);

    if($nego != NULL){
      $idbookernego = $nego->getIdBooker();
      $idorganisateurnego = $nego->getIdOrganisateur();
      $idGroupe = $nego->getIdGroupe();
      $idManif = $nego->getIdManif();

      $booker = $dao->readBookerById($idbookernego);
      $groupe = $dao->readGroupeById($idGroupe);
      $manif = $dao->readManifestationById($idManif);
      $organisateur = $dao->readOrganisateurById($idorganisateurnego);
      $nomgroupe= $groupe->getNom();
      $nommanif= $manif->getNom();

      if($userid == $idbookernego){
        $notification = new Notification(NULL,0,$idorganisateurnego,2,$nomuser." Vous relance pour la negociation entre le groupe ".$nomgroupe." et votre Manifestation : ".$nommanif.".  <a href='../controler/negociation.ctrl.php?id=".$idnego."' > Voir </a>");
        $dao->createNotification($notification);
        header("Location: ../controler/negociation.ctrl.php?id=$idnego");
      }else if($userid == $idorganisateurnego) {
        $notification = new Notification(NULL,0,$idbookernego,2,$nomuser." Vous relance pour la negociation entre votre groupe ".$nomgroupe." et sa Manifestation : ".$nommanif.".  <a href='../controler/negociation.ctrl.php?id=".$idnego."' > Voir </a>");
        $dao->createNotification($notification);
        header("Location: ../controler/negociation.ctrl.php?id=$idnego");
      }else {
        $data['error']['title'] = "Acces Interdit";
        $data['error']['back'] = "../controler/negociations.ctrl.php";
        $data['error']['message'] = "Vous ne pouvez pas refuser une negociation qui ne vous appartient pas";
        include("../view/error.view.php");
      }
    }else {
      $data['error']['title'] = "Negociation Inconnu";
      $data['error']['back'] = "../controler/negociations.ctrl.php";
      $data['error']['message'] = "Vous vous etes perdu";
      include("../view/error.view.php");
    }

  }elseif (isset($_POST["refuser"])) {
    $idnego = $_POST["refuser"];
    $nego = $dao->readNegociationById($idnego);
    if($nego != NULL){
      $idbookernego = $nego->getIdBooker();
      $idorganisateurnego = $nego->getIdOrganisateur();
      $idGroupe = $nego->getIdGroupe();
      $idManif = $nego->getIdManif();

      $booker = $dao->readBookerById($idbookernego);
      $groupe = $dao->readGroupeById($idGroupe);
      $manif = $dao->readManifestationById($idManif);
      $organisateur = $dao->readOrganisateurById($idorganisateurnego);
      $nomgroupe= $groupe->getNom();
      $nommanif= $manif->getNom();
      if($userid == $idbookernego ){
        $nego->setetat(2);
        $dao->updateNegociation($nego);
        $notification = new Notification(NULL,0,$idorganisateurnego,2,$nomuser." a refusé la negociation entre le groupe ".$nomgroupe." et votre Manifestation : ".$nommanif.".  <a href='../controler/negociation.ctrl.php?id=".$idnego."' > Voir </a>");
        $dao->createNotification($notification);
        header("Location: ../controler/negociation.ctrl.php?id=$idnego");
      }else if($userid == $idorganisateurnego){
        $nego->setetat(2);
        $dao->updateNegociation($nego);
        $notification = new Notification(NULL,0,$idbookernego,2,$nomuser." a refusé la negociation entre votre groupe ".$nomgroupe." et sa Manifestation : ".$nommanif.".  <a href='../controler/negociation.ctrl.php?id=".$idnego."' > Voir </a>");
        $dao->createNotification($notification);
        header("Location: ../controler/negociation.ctrl.php?id=$idnego");
      }else {
        $data['error']['title'] = "Acces Interdit";
        $data['error']['back'] = "../controler/negociations.ctrl.php";
        $data['error']['message'] = "Vous ne pouvez pas refuser une negociation qui ne vous appartient pas";
        include("../view/error.view.php");
      }
    }else {
      $data['error']['title'] = "Negociation Inconnu";
      $data['error']['back'] = "../controler/negociations.ctrl.php";
      $data['error']['message'] = "Vous vous etes perdu";
      include("../view/error.view.php");
    }


  }elseif (isset($_POST["annuler"])) {
    $idnego = $_POST["annuler"];
    $nego = $dao->readNegociationById($idnego);
    if($nego != NULL){
      $idbookernego = $nego->getIdBooker();
      $idorganisateurnego = $nego->getIdOrganisateur();
      $idGroupe = $nego->getIdGroupe();
      $idManif = $nego->getIdManif();

      $idCreateur = $nego->getIdCreateur();

      $booker = $dao->readBookerById($idbookernego);
      $groupe = $dao->readGroupeById($idGroupe);
      $manif = $dao->readManifestationById($idManif);
      $organisateur = $dao->readOrganisateurById($idorganisateurnego);
      $nomgroupe= $groupe->getNom();
      $nommanif= $manif->getNom();
      if(($userid == $idbookernego) == $idCreateur){
        if($nego->getetat() == 2){
          $nego->setetat(5);
        }elseif ($nego->getetat() == 3) {
          $nego->setetat(6);
        }else {
          $nego->setetat(4);
        }
        $dao->updateNegociation($nego);
        $notification = new Notification(NULL,0,$idorganisateurnego,2,$nomuser." a annulé la negociation entre le groupe ".$nomgroupe." et votre Manifestation : ".$nommanif.".  <a href='../controler/negociation.ctrl.php?id=".$idnego."' > Voir </a>");
        $dao->createNotification($notification);
        header("Location: ../controler/negociation.ctrl.php?id=$idnego");
      }else if(($userid == $idorganisateurnego) == $idCreateur){
        if($nego->getetat() == 2){
          $nego->setetat(5);
        }elseif ($nego->getetat() == 3) {
          $nego->setetat(6);
        }else {
          $nego->setetat(4);
        }
        $dao->updateNegociation($nego);
        $notification = new Notification(NULL,0,$idbookernego,2,$nomuser." a annulé la negociation entre votre groupe ".$nomgroupe." et sa Manifestation : ".$nommanif.".  <a href='../controler/negociation.ctrl.php?id=".$idnego."' > Voir </a>");
        $dao->createNotification($notification);
        header("Location: ../controler/negociation.ctrl.php?id=$idnego");
      }else {
        $data['error']['title'] = "Acces Interdit";
        $data['error']['back'] = "../controler/negociations.ctrl.php";
        $data['error']['message'] = "Vous ne pouvez pas annuler une negociation que vous n'avez pas crée";
        include("../view/error.view.php");
      }
    }else {
      $data['error']['title'] = "Negociation Inconnu";
      $data['error']['back'] = "../controler/negociations.ctrl.php";
      $data['error']['message'] = "Vous vous etes perdu";
      include("../view/error.view.php");
    }


  }elseif (isset($_POST["annulerannuler"])) {
    $idnego = $_POST["annulerannuler"];
    $nego = $dao->readNegociationById($idnego);
    if($nego != NULL){
      $idbookernego = $nego->getIdBooker();
      $idorganisateurnego = $nego->getIdOrganisateur();
      $idGroupe = $nego->getIdGroupe();
      $idManif = $nego->getIdManif();

      $idCreateur = $nego->getIdCreateur();

      $booker = $dao->readBookerById($idbookernego);
      $groupe = $dao->readGroupeById($idGroupe);
      $manif = $dao->readManifestationById($idManif);
      $organisateur = $dao->readOrganisateurById($idorganisateurnego);
      $nomgroupe= $groupe->getNom();
      $nommanif= $manif->getNom();
      if(($userid == $idbookernego) == $idCreateur){
        if($nego->getetat() == 5){
          $nego->setetat(2);
        }elseif ($nego->getetat() == 6) {
          $nego->setetat(3);
        }else {
          $nego->setetat(0);
        }

        $dao->updateNegociation($nego);
        $notification = new Notification(NULL,0,$idorganisateurnego,2,$nomuser." a annulé l'annulation de la negociation entre le groupe ".$nomgroupe." et votre Manifestation : ".$nommanif.".  <a href='../controler/negociation.ctrl.php?id=".$idnego."' > Voir </a>");
        $dao->createNotification($notification);
        header("Location: ../controler/negociation.ctrl.php?id=$idnego");
      }else if(($userid == $idorganisateurnego) == $idCreateur){
        if($nego->getetat() == 5){
          $nego->setetat(2);
        }elseif ($nego->getetat() == 6) {
          $nego->setetat(3);
        }else {
          $nego->setetat(0);
        }
        $dao->updateNegociation($nego);
        $notification = new Notification(NULL,0,$idbookernego,2,$nomuser." a annulé l'annulation de la negociation entre votre groupe ".$nomgroupe." et sa Manifestation : ".$nommanif.".  <a href='../controler/negociation.ctrl.php?id=".$idnego."' > Voir </a>");
        $dao->createNotification($notification);
        header("Location: ../controler/negociation.ctrl.php?id=$idnego");
      }else {
        $data['error']['title'] = "Acces Interdit";
        $data['error']['back'] = "../controler/negociations.ctrl.php";
        $data['error']['message'] = "Vous ne pouvez pas annuler une negociation que vous n'avez pas crée";
        include("../view/error.view.php");
      }
    }else {
      $data['error']['title'] = "Negociation Inconnu";
      $data['error']['back'] = "../controler/negociations.ctrl.php";
      $data['error']['message'] = "Vous vous etes perdu";
      include("../view/error.view.php");
    }


  }else if(isset($_GET["id"])){
    $idnego = $_GET["id"];
    $nego = $dao->readNegociationById($idnego);
    if($nego != NULL){
      $idbookernego = $nego->getIdBooker();
      $idorganisateurnego = $nego->getIdOrganisateur();
      $idGroupe = $nego->getIdGroupe();
      $idManif = $nego->getIdManif();

      $booker = $dao->readBookerById($idbookernego);
      $groupe = $dao->readGroupeById($idGroupe);
      $manif = $dao->readManifestationById($idManif);
      $organisateur = $dao->readOrganisateurById($idorganisateurnego);

      $data['ascreate'] = $userid == $nego->getIdCreateur();

      $data["canAction"] = $nego->getetat() == 0 || $nego->getetat() == 2 || $nego->getetat() == 3;

      $data["enCour"] = $nego->getetat() == 0 ;

      $data["refuse"] = $nego->getetat() == 2 ;
      $data["Accept"] = $nego->getetat() == 1 ;



      $data['idnego'] = $idnego;
      $data['nombooker']  = $booker->getNomComplet();
      $data['nomorga'] = $organisateur->getNomComplet();
      $data['nomgroupe'] = $groupe->getNom();
      $data['nommanif'] = $manif->getNom();
      $data['datemanif'] = $manif->getDateDebut();

      $data['idbooker']  = $booker->getIdPersonne();
      $data['idorga'] = $organisateur->getIdPersonne();
      $data['idgroupe'] = $groupe->getIdGroupe();
      $data['idmanif'] = $manif->getIdManif();

      $data["etat"] = $nego->getetatEcrit();

      $creneau = array();
      $creneau = $dao->readCreneauByidManif($idManif);
      $data["creneau"] = array();
      foreach ($creneau as $key => $value) {
        if($value->getidGroupe() == $idGroupe){
          $data["creneau"][$key]["lieu"] = $value->getLieu();
          $data["creneau"][$key]["date"] = $value->getDate();
          $data["creneau"][$key]["hd"] = $value->getHeureDebut();
          $data["creneau"][$key]["hf"] = $value->getHeureFin();
          $data["creneau"][$key]["idmanif"] = $value->getidManif();
          $data["creneau"][$key]["idgroupe"] = $value->getidGroupe();
          if($value->getHeureDebutTest() == NULL){
            $data["creneau"][$key]["hdt"] =  "Pas de tests";
            $data["creneau"][$key]["hft"] = "Pas de tests";
          }else {
            $data["creneau"][$key]["hdt"] = $value->getHeureDebutTest();
            $data["creneau"][$key]["hft"] = $value->getHeureFinTest();
          }
        }


      }



      if($userid == $idbookernego){
        $data["orga"] = false;
        $data["titre"] = "<n>".$data['nomgroupe']."</b> au ".$data['nommanif'];

        include("../view/negociation.view.php");
      }elseif ($userid == $idorganisateurnego) {
        $data["orga"] = true;

        $data["titre"] = $data['nomgroupe']." au <b>".$data['nommanif']."</b>";
        # code...
        include("../view/negociation.view.php");
      }else {
        $data['error']['title'] = "Acces Interdit";
        $data['error']['back'] = "../controler/negociations.ctrl.php";
        $data['error']['message'] = "Vous n'êtes pas impliqué dans cette negociation";
        include("../view/error.view.php");
      }






    }else {
      $data['error']['title'] = "Negociation Inconnu";
      $data['error']['back'] = "../controler/negociations.ctrl.php";
      $data['error']['message'] = "Vous vous etes perdu";
      include("../view/error.view.php");
    }
  }else {
    $data['error']['title'] = "Negociation Inconnu";
    $data['error']['back'] = "../controler/negociations.ctrl.php";
    $data['error']['message'] = "Vous vous etes perdu";
    include("../view/error.view.php");
  }

?>
