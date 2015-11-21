<?php
  session_start();
  require_once("../model/utils.class.php");
  $data = initPage("List");

  include("../view/list.view.php");
?>
