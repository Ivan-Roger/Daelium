<?php
  session_start();
  include("include/auth.ctrl.php");
  require_once("../model/utils.class.php");
  require_once("../model/DAO.class.php");
  $data = initPage("Negociations");
  $dao = new DAO();

  $userid= $_SESSION["user"]["ID"];
  $user = $dao->readPersonneById($userid);

  $negociations = array();
  $negociations = $dao->readNegociationByUtilisateur($userid);

  $data['nego'] = array();
  foreach ($negociations as $key => $nego) {
    $idGroupe = $nego->getIdGroupe();
    $idManif = $nego->getIdManif();
    $groupe = $dao->readGroupeById($idGroupe);
    $manif = $dao->readManifestationById($idManif);
    $data['nego'][$key]['nomgroupe'] = $groupe->getNom();
    $data['nego'][$key]['nommanif'] = $manif->getNom();
    $data['nego'][$key]['datemanif'] = $manif->getDateDebut();

    $idLieu =$manif->getLieu();
    if($idLieu != NULL){
      $lieu = $dao->readLieuById();
      $data['nego'][$key]['villemanif'] = $lieu->getVille();
    }else {
      $data['nego'][$key]['villemanif'] = "Inconue";
    }
    $data['nego'][$key]['etat'] = $nego->getetatEcrit();
    $data['nego'][$key]['id'] = $nego->getIdNegociation();

  }


  include("../view/negociations.view.php");
?>
