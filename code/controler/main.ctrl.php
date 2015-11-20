<?php
  session_start();

  $data['alert']['type'] = "danger";
  $data['alert']['icon'] = "exclamation-sign";
  $data['alert']['message'] = "Site en cours de construction ... Risques d'erreurs ><'";

  $data['page']="Main";

  if (isset($_GET['type'])) {
    $_SESSION['userType'] = $_GET['type'];
    $data['alert']['type'] = "success";
    $data['alert']['icon'] = "ok";
    $data['alert']['message'] = "Vous avez bien changé de statut : ".$_GET['type'];
  }

  if (isset($_SESSION['userType']))
    $data['type'] = $_SESSION['userType'];
  else
    $data['type'] = "Booker";

  include("../view/main.view.php");
?>
