<?php
  session_start();
  include("include/auth.ctrl.php");
  require_once("../model/utils.class.php");
  require_once("../model/DAO.class.php");
  $data = initPage("Negociations");
  $dao = new DAO();

  $userid= $_SESSION["user"]["ID"];
  $user = $dao->readBookerById($userid);
  if(isset($_GET["id"])){
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
      if($userid == $idbookernego){
        $data["titre"] = $data['nomgroupe']." au ".$data['nommanif'];

        include("../view/negociation.view.php");
      }elseif ($userid == $idorganisateurnego) {
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
