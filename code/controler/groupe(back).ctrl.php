<?php
  session_start();
  include("include/auth.ctrl.php");
  require_once("../model/utils.class.php");
  require_once("../model/DAO.class.php");
  $data = initPage("Groupes");
  $dao = new Dao();

  $user = $dao->readBookerById($_SESSION["user"]["ID"]);
  if($user != NULL){ // SI booker

  if (isset($_GET['id']) && $_GET['id'] != "" && isset($_GET['action']) && $_GET['action']=="edit") {
    $groupe = $dao->readGroupeById($_GET['id']);
    $listA = $dao->readArtisteByGroupe($_GET['id']);
    $i = 0;
    foreach ($listA as $key => $value) {
      $artiste = $dao->readArtisteById($value);
      $art[$i]['prenom'] = $artiste->getPrenom();
      $art[$i]['nom'] = $artiste->getNom();
      $art[$i]['dateNaissance'] = $artiste->getDateNaissance();
      $art[$i]['email'] = $artiste->getEmailcontact();
      $art[$i]['telephone'] = $artiste->getTel();
      $art[$i]['adresse'] = $artiste->getAdresse();
      $art[$i]['paiement'] = $artiste->getPaiement();
      $art[$i]['IBAN'] = $artiste->getRib();
      $art[$i]['ordre'] = $artiste->getOrdreCheque();
      $i++;
    }
    $data['artistes']= $art;
    $data['groupe']['id']=$_GET['id'];
    $data['groupe']['nom'] = $groupe->getNom();
    $data['groupe']['email'] = $groupe->getEmail();
    $data['groupe']['nb']= $i;
    //envoie un formulaire pour créer un artiste
    include("../view/groupe_edit.view.php");
  } else if(isset($_GET['id']) && $_GET['id'] != ""){



    $groupe = $dao->readGroupeById($_GET['id']);
    $listA = $dao->readArtisteByGroupe($_GET['id']);
    $i = 0;
    foreach ($listA as $key => $value) {
      $artiste = $dao->readArtisteById($value);
      $art[$i]['prenom'] = $artiste->getPrenom();
      $art[$i]['nom'] = $artiste->getNom();
      $art[$i]['dateNaissance'] = $artiste->getDateNaissance();
      $art[$i]['email'] = $artiste->getEmailcontact();
      $art[$i]['telephone'] = $artiste->getTel();
      $art[$i]['adresse'] = $artiste->getAdresse();
      if(($idlieu = $artiste->getAdresse()) == NULL){
        $art[$i]['adresse'] = "Non indiquée";
      }else{
        $lieu = $dao->readLieuById($idlieu);
        $art[$i]['adresse'] =  $lieu->getAdresse().", ".$lieu->getcodepostal().", ".$lieu->getVille().", ".$lieu->getPays();
      }
      $art[$i]['paiement'] = $artiste->getPaiement();
      $art[$i]['IBAN'] = $artiste->getRib();
      $art[$i]['ordre'] = $artiste->getOrdreCheque();
      $i++;
    }
    $data['artistes']= $art;
    $data['groupe']['id']=$_GET['id'];
    $data['groupe']['nom'] = $groupe->getNom();
    $data['groupe']['nb']= $i;
    $data['groupe']['email'] = $groupe->getEmail();

    if($groupe->getDescription() == NULL){
      $data['groupe']['description'] = "Aucune description";
    }else {
      $data['groupe']['description'] = $groupe->getDescription();
    }
    $genre = $dao->readManifestationGenreByidManif($_GET['id']);
    $data['groupe']['genre'] = "";
    if($genre != NULL){
      foreach ($genre as $key => $value) {
        $data['groupe']['genre'] = $data['groupe']['genre']." ".$value['nomg'];
      }
    }else {
      $data['groupe']['genre'] = "Aucun genre";
    }
    if(($idlieu = $groupe->getAdresse()) == NULL){
      $data['groupe']['lieu']['adresse'] = "Non indiquée";
      $data['groupe']['lieu']['googlemaps'] = NULL;
    }else{
      $lieu = $dao->readLieuById($idlieu);
      $data['groupe']['lieu']['adresse'] =  $lieu->getAdresse().", ".$lieu->getcodepostal().", ".$lieu->getVille().", ".$lieu->getPays();
      $data['groupe']['lieu']['googlemaps'] = "https://www.google.fr/maps/place/".str_replace ( ' ' ,'+' ,$lieu->getAdresse())."+".$lieu->getcodepostal()."+".$lieu->getVille()."+".strtolower($lieu->getPays());
    }

    //envoie les données pour un artiste
    include("../view/groupe.view.php");
  } elseif (isset($_GET['action']) && $_GET['action']=="new") {
    $data['groupe']['nom'] = "Nouveau Groupe";
    //envoie un formulaire pour créer un artiste
    include("../view/groupe_edit.view.php");
  } else {
    $data['error']['title'] = "Artiste Inconnu";
    $data['error']['back'] = "../controler/artistes.ctrl.php";
    $data['error']['message'] = "Vous vous etes perdu";
    $data['page']="Error";
    include("../view/error.view.php");
  }
    }else {
      $data['error']['title'] = "Acces Interdit";
      $data['error']['message'] = "Vous ne pouvez pas venir ici, cet espace est reservé au booker du Groupe";
      $data['error']['back'] = "../controler/main.ctrl.php";
      include("../view/error.view.php");
    }
?>
