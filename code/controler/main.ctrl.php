<?php
  session_start();
  require_once("../model/utils.class.php");
  $alerts=array();
  if (isset($_GET['type'])) {
    $_SESSION['userType'] = $_GET['type'];
    $alerts[] = newAlert("Vous avez bien changé de statut : ".$_GET['type'],"success","ok");
  }
  $data = initPage("Main",$alerts);

  if (isset($_GET['login']))
    $data['alerts'][] = newAlert("Vous vous etes bien connecté","success","ok");
  include("../view/main.view.php");
?>
