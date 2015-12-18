<?php
  session_start();
  include("include/auth.ctrl.php");
  require_once("../model/utils.class.php");
  $data = initPage("List");

  include("../view/annuaire.view.php");
?>
