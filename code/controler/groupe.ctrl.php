<?php
  session_start();
  require_once("../model/utils.class.php");
  $data = initPage("Groups");

  if (isset($_GET['id']) && $_GET['id'] != "" && isset($_GET['action']) && $_GET['action']=="edit") {
    $data['group']['id']="kfpb5gso63w7s2l";
    $data['group']['name'] ="En Marche";
    $data['group']['nb']=2;

    $art['prenom'] = "Marc";
    $art['nom'] = "Dupond";
    $art['dateNaissance'] = "18 décembre 1878";
    $art['email'] = "marc.dupond@gmail.com";
    $art['telephone'] = "04 78 90 26 54";
    $art['adresse'] = "Cours Berriat 38000 Grenoble";
    $art['paiement'] = "Virement";
    $art['IBAN'] = "2117812164121";
    $art['ordre'] = NULL;
    $data['artistes'][] = $art;

    $art['prenom'] = "Laurent";
    $art['nom'] = "Dupuis";
    $art['dateNaissance'] = "30 janvier 1933";
    $art['email'] = "laurent.dupuis@gmail.com";
    $art['telephone'] = "04 76 42 51 35";
    $art['adresse'] = "Bvd Gambetta 38000 Grenoble";
    $art['paiement'] = "Cheque";
    $art['IBAN'] = NULL;
    $art['ordre'] = "Mr Laurent Dupuis";
    $data['artistes'][] = $art;
    //envoie un formulaire pour créer un artiste
    include("../view/group_edit.view.php");
  } else if(isset($_GET['id']) && $_GET['id'] != ""){

    $data['groupe']['id']=$_GET['id'];
    $data['groupe']['nom'] ="En Marche";
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
    $data['artistes'][] = $art;

    $art['prenom'] = "Laurent";
    $art['nom'] = "Dupuis";
    $art['dateNaissance'] = "30 janvier 1933";
    $art['email'] = "laurent.dupuis@gmail.com";
    $art['telephone'] = "04 76 42 51 35";
    $art['adresse'] = "Bvd Gambetta 38000 Grenoble";
    $art['paiement'] = "Cheque";
    $art['IBAN'] = NULL;
    $art['ordre'] = "Mr Laurent Dupuis";
    $data['artistes'][] = $art;

    $album['nom'] = "Hon Hop";
    $album['date'] = "2013";
    $data['albums'][] = $album;

    $album['nom'] = "Ping Pong";
    $album['date'] = "2015";
    $data['albums'][] = $album;

    $lineUp['nom'] = "Hello";
    $lineUp['url'] = "https://www.youtube.com/embed/YQHsXMglC9A?feature=player_detailpage";
    $data['lineUp'][] = $lineUp;

    $lineUp['nom'] = "Overwerk";
    $lineUp['url'] = "https://w.soundcloud.com/player/?url=https%3A//api.soundcloud.com/tracks/231318729&amp;auto_play=false&amp;hide_related=false&amp;show_comments=true&amp;show_user=true&amp;show_reposts=false&amp;visual=true";
    $data['lineUp'][] = $lineUp;

    //envoie les données pour un artiste
    include("../view/groupe.view.php");
  } elseif (isset($_GET['action']) && $_GET['action']=="new") {
    $data['group']['name'] = "Nouveau Groupe";
    //envoie un formulaire pour créer un artiste
    include("../view/group_edit.view.php");
  } else {
    $data['error']['title'] = "Artiste Inconnu";
    $data['error']['back'] = "../controler/artistes.ctrl.php";
    $data['error']['message'] = "Vous vous etes perdu";
    $data['page']="Error";
    include("../view/error.view.php");
  }
?>
