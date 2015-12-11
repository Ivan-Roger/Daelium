<?php
  session_start();
  require_once("../model/utils.class.php");
  $data = initPage("Negociation");

  include("../view/negociation.view.php");
?>
