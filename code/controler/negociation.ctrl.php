<?php
  session_start();
  include("include/auth.ctrl.php");
  require_once("../model/utils.class.php");
  $data = initPage("Negociations");

  include("../view/negociation.view.php");
?>
