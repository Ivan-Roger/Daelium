<?php
  session_start();
  require_once("../model/utils.class.php");
  $data = initPage("Messages");

  include("../view/messages.view.php");
?>
