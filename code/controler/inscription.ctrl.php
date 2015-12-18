<?php
  session_start();
  require_once("../model/utils.class.php");

  header("Location:"."../controler/main.ctrl.php?login");
?>
