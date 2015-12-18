<?php
  session_start();
  require_once("../model/utils.class.php");
  $data = initPage("Profil");

  include("../view/profil.view.php");
?>
