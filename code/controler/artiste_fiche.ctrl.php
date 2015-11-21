<?php
  session_start();
  //include_once("../model/Artist.class.php");
  require_once("../model/utils.class.php");

  $data['alert'][] = newAlert("Site en cours de construction ... Risques d'erreurs ><'","danger","exclamation-sign");

  $data['page']="Artistes";



  $data['artistegroupe']['nomscene'] ="Le petit père des peuples";



  if (isset($_SESSION['userType']))
    $data['type'] = $_SESSION['userType'];
  else
    $data['type'] = "Booker";

  include("../view/artiste_fiche.view.php");
?>
