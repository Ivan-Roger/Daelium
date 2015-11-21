<?php
  session_start();
  require_once("../model/utils.class.php");
  $alerts=array();
  if (isset($_GET['type'])) {
    $_SESSION['userType'] = $_GET['type'];
    $alerts[] = newAlert("Vous avez bien changé de statut : ".$_GET['type'],"success","ok");
  }
  $data = initPage("Main",$alerts);

  include("../view/main.view.php");
?>
