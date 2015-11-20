<?php
  session_start();
  require_once("../model/utils.class.php");

  $data['alert'][] = newAlert("Site en cours de construction ... Risques d'erreurs ><'","danger","exclamation-sign");

  $data['page']="Main";

  if (isset($_GET['type'])) {
    $_SESSION['userType'] = $_GET['type'];
    $data['alert'][] = newAlert("Vous avez bien changé de statut : ".$_GET['type'],"success","ok");
  }

  if (isset($_SESSION['userType']))
    $data['type'] = $_SESSION['userType'];
  else
    $data['type'] = "booker";

  include("../view/main.view.php");
?>
