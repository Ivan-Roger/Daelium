<?php
  session_start();
  require_once("../model/utils.class.php");

  if (isset($_SESSION['userLoginMail'])) {
    header("Location:"."../controler/main.ctrl.php");
  }

  include("../view/nolog.view.php");
?>
