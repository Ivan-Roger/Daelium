<?php
  session_start();
  //include_once("../model/Artist.class.php");
  require_once("../model/utils.class.php");

  $data['alert'][] = newAlert("Site en cours de construction ... Risques d'erreurs ><'","danger","exclamation-sign");

  $data['page']="Artiste";

  if(isset($_GET['artiste'])){
    //$artiste = new Artist($_GET['artiste']);

    $data['artiste']['nomscene'] ="Le petit père des peuples";
    $data['artiste']['prenom'] = "Joseph";
    $data['artiste']['nom'] = "Staline";
    $data['artiste']['dateNaissance'] = "18 décembre 1878";
    $data['artiste']['Email'] = "JoJoLaFripouille@URSS.net";
    $data['artiste']['telephone'] = "04 78 90 26 54";
    $data['artiste']['adresse'] = "55° 45′ 09″ Nord 37° 37′ 02″ Est";
    $data['artiste']['paiement'] = "Espece";
    $data['artiste']['IBAN'] = NULL;
    $data['artiste']['ordre'] = NULL;

    $data['vue']="fiche";









    //envoi les donner pour un artiste
  }elseif(isset($_GET['action']) && $_GET['action']=="new"){
    $data['artiste'] = "new";
    $data['vue']="form";
    //envoi un formulaire pour cree un artiste
  }else{
    //Afficher 404 not found
    $data['artiste'] = "Il doit y avoir une Erreur";
    $data['vue']="404";
  }

  if (isset($_SESSION['userType']))
    $data['type'] = $_SESSION['userType'];
  else
    $data['type'] = "Booker";

  include("../view/artiste.view.php");
?>
