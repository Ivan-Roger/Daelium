<?php
  session_start();
  //include_once("../model/Artist.class.php");
  require_once("../model/utils.class.php");

  $data['alert'][] = newAlert("Site en cours de construction ... Risques d'erreurs ><'","danger","exclamation-sign");

  $data['page']="Artistes";

  if(isset($_GET['artiste']) && $_GET['artiste'] != ""){
    //$artiste = new Artist($_GET['artiste']);


    $data['vue']="fiche";

    $data['artistegroupe']['nomscene'] ="Le petit père des peuples";
    $data['artistegroupe']['type']='Groupe';
    $data['artistegroupe']['nb']=2;


    $data['artiste']['prenom'][0] = "Joseph";
    $data['artiste']['nom'][0] = "Staline";
    $data['artiste']['dateNaissance'][0] = "18 décembre 1878";
    $data['artiste']['email'][0] = "JoJoLaFripouille@URSS.net";
    $data['artiste']['telephone'][0] = "04 78 90 26 54";
    $data['artiste']['adresse'][0] = "55° 45′ 09″ Nord 37° 37′ 02″ Est";
    $data['artiste']['paiement'][0] = "Virement";
    $data['artiste']['IBAN'][0] = NULL;
    $data['artiste']['ordre'][0] = NULL;

    $data['artiste']['prenom'][1] = "Adolph";
    $data['artiste']['nom'][1] = "Hitler";
    $data['artiste']['dateNaissance'][1] = "30 janvier 1933";
    $data['artiste']['email'][1] = "JoJoLaFripouille@URSS.net";
    $data['artiste']['telephone'][1] = "04 78 90 26 54";
    $data['artiste']['adresse'][1] = "55° 45′ 09″ Nord 37° 37′ 02″ Est";
    $data['artiste']['paiement'][1] = "Cheque";
    $data['artiste']['IBAN'][1] = NULL;
    $data['artiste']['ordre'][1] = "Un ordre";



    //envoi les donner pour un artiste
  } elseif(isset($_GET['action']) && $_GET['action']=="new") {
    $data['artiste']['nomscene'] = "new";
    $data['vue']="form";
    //envoi un formulaire pour cree un artiste
  }else{
    //Afficher 404 not found
    $data['artistegroupe']['nomscene'] = "Il doit y avoir une Erreur";
    $data['vue']="404";
  }

  if (isset($_SESSION['userType']))
    $data['type'] = $_SESSION['userType'];
  else
    $data['type'] = "Booker";

  include("../view/artiste.view.php");
?>
