<?php
  session_start();
  require_once("../model/utils.class.php");

  $data['alert'][] = newAlert("Site en cours de construction ... Risques d'erreurs ><'","danger","exclamation-sign");

  $data['page']="Artistes";


  if (isset($_SESSION['userType']))
    $data['type'] = $_SESSION['userType'];
  else
    $data['type'] = "Booker";

  include("../view/artistes.view.php");
?>
