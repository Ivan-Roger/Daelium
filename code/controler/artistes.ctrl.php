<?php
  session_start();
  require_once("../model/utils.class.php");
  $data = initPage("Artistes");

  include("../view/artistes.view.php");
?>
