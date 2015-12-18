<?php
  session_start();
  include("include/auth.ctrl.php");
  require_once("../model/utils.class.php");
  $data = initPage("Groups");


  $data["action"] = "";
  if (isset($_GET["id"]) && isset($_GET["action"]) && $_GET['action']=="edit") {
    $data['groupe']['id']= $_GET['id'];
    $data['groupe']['nom']= "En Marche";
    include("../view/groupe_fiche_edit.view.php");
  } else if(isset($_GET["id"])) {

    $data['groupe']['id']=$_GET['id'];
    $data['groupe']['nom'] ="En Marche";
    $data['groupe']['nb']=2;

    $art['prenom'] = "Jean-Louis";
    $art['nom'] = "Dupond";
    $art['role'] = "Guitariste Chanteur";
    $art['desc'] = "Guitariste du groupe et chanteur";
    $data['artistes'][] = $art;

    $art['prenom'] = "Laurent";
    $art['nom'] = "Dupuis";
    $art['role'] = "Batteur";
    $art['desc'] = "Batteur du groupe";
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
    include("../view/groupe_fiche.view.php");
  } else {
    $data['error']['title'] = "Groupe Inconnu";
    $data['error']['back'] = "../controler/main.ctrl.php";
    $data['error']['message'] = "Le groupe que vous cherchez n'existe pas ou plus !";
    include("../view/error.view.php");
  }



?>
