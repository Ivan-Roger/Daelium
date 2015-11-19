<?php
  session_start();

  $data['alert']['type'] = "danger";
  $data['alert']['icon'] = "exclamation-sign";
  $data['alert']['message'] = "Site en cours de construction ... Risques d'erreurs ><'";

  $data['page']="Artiste";

  if(isset($_GET['artiste'])){
    $data['artiste'] =$_GET['artiste'];
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
