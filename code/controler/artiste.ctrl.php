<?php
  session_start();
  //include_once("../model/Artist.class.php");
  require_once("../model/utils.class.php");
  $data = initPage("Artistes");

  if (isset($_GET['artiste']) && $_GET['artiste'] != "" && isset($_GET['action']) && $_GET['action']=="edit") {
    $data['groupe']['id']="kfpb5gso63w7s2l";
    $data['groupe']['nomscene'] ="En Marche";
    $data['groupe']['nb']=2;

    $art['prenom'] = "Marc";
    $art['nom'] = "Dupond";
    $art['dateNaissance'] = "18 décembre 1878";
    $art['email'] = "marc.dupond@gmail.com";
    $art['telephone'] = "04 78 90 26 54";
    $art['adresse'] = "Cours Berriat 38000 Grenoble";
    $art['paiement'] = "Virement";
    $art['IBAN'] = "2117812164121";
    $art['ordre'] = NULL;
    $data['artiste'][] = $art;

    $art['prenom'] = "Laurent";
    $art['nom'] = "Dupuis";
    $art['dateNaissance'] = "30 janvier 1933";
    $art['email'] = "laurent.dupuis@gmail.com";
    $art['telephone'] = "04 76 42 51 35";
    $art['adresse'] = "Bvd Gambetta 38000 Grenoble";
    $art['paiement'] = "Cheque";
    $art['IBAN'] = NULL;
    $art['ordre'] = "Mr Laurent Dupuis";
    $data['artiste'][] = $art;
    //envoie un formulaire pour créer un artiste
    include("../view/artiste_edit.view.php");
  } else if(isset($_GET['artiste']) && $_GET['artiste'] != ""){
    //$artiste = new Artist($_GET['artiste']);

    $data['groupe']['id']="kfpb5gso63w7s2l";
    $data['groupe']['nomscene'] ="En Marche";
    $data['groupe']['nb']=2;

    $art['prenom'] = "Marc";
    $art['nom'] = "Dupond";
    $art['dateNaissance'] = "18 décembre 1878";
    $art['email'] = "marc.dupond@gmail.com";
    $art['telephone'] = "04 78 90 26 54";
    $art['adresse'] = "Cours Berriat 38000 Grenoble";
    $art['paiement'] = "Virement";
    $art['IBAN'] = "2117812164121";
    $art['ordre'] = NULL;
    $data['artiste'][] = $art;

    $art['prenom'] = "Laurent";
    $art['nom'] = "Dupuis";
    $art['dateNaissance'] = "30 janvier 1933";
    $art['email'] = "laurent.dupuis@gmail.com";
    $art['telephone'] = "04 76 42 51 35";
    $art['adresse'] = "Bvd Gambetta 38000 Grenoble";
    $art['paiement'] = "Cheque";
    $art['IBAN'] = NULL;
    $art['ordre'] = "Mr Laurent Dupuis";
    $data['artiste'][] = $art;

    //envoie les données pour un artiste
    include("../view/artiste.view.php");
  } elseif (isset($_GET['action']) && $_GET['action']=="new") {
    $data['artistegroupe']['nomscene'] = "Nouveau Groupe";
    //envoie un formulaire pour créer un artiste
    include("../view/artiste_edit.view.php");
  } else {
    $data['error']['title'] = "Artiste Inconnu";
    $data['error']['back'] = "../controler/artistes.ctrl.php";
    $data['error']['message'] = "Vous vous etes perdu";
    $data['page']="Error";
    include("../view/error.view.php");
  }
?>
