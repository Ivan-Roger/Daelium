<?php
  session_start();
  include("include/auth.ctrl.php");
  require_once("../model/utils.class.php");
  $data = initPage("Negociation");

  include("../view/negociation.view.php");
?>
