<?php
  session_start();
  include("include/auth.ctrl.php");
  require_once("../model/utils.class.php");
  require_once("../model/DAO.class.php");
  $data = initPage("Groupes");
  $dao = new Dao();

  $user = $dao->readPersonneById($_SESSION["user"]["ID"]);
  if($user->getType() == 0){ // SI booker

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
      $art[$i]['paiement'] = $artiste->getPaiement();
      $art[$i]['IBAN'] = $artiste->getRib();
      $art[$i]['ordre'] = $artiste->getOrdreCheque();
      $i++;
    }
    $data['artistes']= $art;
    $data['groupe']['id']=$_GET['id'];
    $data['groupe']['nom'] = $groupe->getNom();
    $data['groupe']['nb']= $i;

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
      $data['error']['message'] = "Vous ne pouvez pas venir ici, cet espace est reservé aux bookers";
      $data['error']['back'] = "../controler/main.ctrl.php";
      include("../view/error.view.php");
    }
?>
