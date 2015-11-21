<?php
  session_start();
  require_once("../model/utils.class.php");
  $data = initPage("Documents");

  include("../view/documents.view.php");
?>
