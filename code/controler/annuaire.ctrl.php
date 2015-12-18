<?php
  session_start();
  require_once("../model/utils.class.php");
  $data = initPage("List");

  include("../view/annuaire.view.php");
?>
