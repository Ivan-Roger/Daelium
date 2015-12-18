<?php
  session_start();
  include("include/auth.ctrl.php");
  require_once("../model/utils.class.php");
  $data = initPage("Events");

  // Recupérer les données depuis la BD
  $evt['id'] = "fhdg8x5x8bncx5";
  $evt['name'] = "Evenement 1";
  $evt['img'] = "../data/img/icons/calendar_64px.png";
  $data['evenements'][] = $evt;

  $evt['id'] = "8fgb5wsd63w7sxa";
  $evt['name'] = "Bilbao BBK live";
  $evt['img'] = "../data/users/icons/bilbao-logo.jpg";
  $data['evenements'][] = $evt;

  include("../view/evenements.view.php");
?>
