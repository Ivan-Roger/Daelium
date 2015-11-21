<?php
  session_start();
  require_once("../model/utils.class.php");
  $data = initPage("Profile");

  include("../view/profile.view.php");
?>
