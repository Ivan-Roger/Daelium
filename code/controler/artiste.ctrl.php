<?php
  session_start();
  //include_once("../model/Artist.class.php");
  require_once("../model/utils.class.php");
  $data = initPage("Artistes");

  if(isset($_GET['artiste']) && $_GET['artiste'] != ""){
    //$artiste = new Artist($_GET['artiste']);


    $data['vue']="fiche";

    $data['artistegroupe']['nomscene'] ="En Marche";
    $data['artistegroupe']['type']='Groupe';
    $data['artistegroupe']['nb']=2;


    $data['artiste']['prenom'][0] = "Toto";
    $data['artiste']['nom'][0] = "Dufaud";
    $data['artiste']['dateNaissance'][0] = "18 décembre 1878";
    $data['artiste']['email'][0] = "toto.dufaud@gmail.com";
    $data['artiste']['telephone'][0] = "04 78 90 26 54";
    $data['artiste']['adresse'][0] = "Cours Berriat 38000 Grenoble";
    $data['artiste']['paiement'][0] = "Virement";
    $data['artiste']['IBAN'][0] = "2117812164121";
    $data['artiste']['ordre'][0] = NULL;

    $data['artiste']['prenom'][1] = "Titi";
    $data['artiste']['nom'][1] = "Gautier";
    $data['artiste']['dateNaissance'][1] = "30 janvier 1933";
    $data['artiste']['email'][1] = "titi.gautier@gmail.com";
    $data['artiste']['telephone'][1] = "04 78 90 26 54";
    $data['artiste']['adresse'][1] = "Bvd Gambetta 38000 Grenoble";
    $data['artiste']['paiement'][1] = "Cheque";
    $data['artiste']['IBAN'][1] = NULL;
    $data['artiste']['ordre'][1] = "Mr Titi Gautier";



    //envoi les donner pour un artiste
  } elseif (isset($_GET['action']) && $_GET['action']=="new") {
    $data['artistegroupe']['nomscene'] = "new";
    $data['vue']="form";
    //envoi un formulaire pour cree un artiste
  }else{
    //Afficher 404 not found
    $data['artistegroupe']['nomscene'] = "Il doit y avoir une Erreur";
    $data['vue']="404";
  }


  include("../view/artiste.view.php");
?>
