<?php
  session_start();
  require_once("../model/utils.class.php");
  $data = initPage("Negociations");

  include("../view/negociations.view.php");
?>
