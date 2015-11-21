<?php
  session_start();
  require_once("../model/utils.class.php");
  $data = initPage("Evenements");

  include("../view/evenements.view.php");
?>
