<?php
  session_start();
  require_once("../model/utils.class.php");

  if (isset($_SESSION['user'])) {
    header("Location:"."../controler/main.ctrl.php");
  }
  $data = Array();

  include("../view/nolog.view.php");
?>
