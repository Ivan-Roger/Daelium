<?php
  session_start();
  include("include/auth.ctrl.php");
  require_once("../model/utils.class.php");
  $data = initPage("Annuaire");

  include("../view/annuaire.view.php");
?>
