<?php
  session_start();
  include("include/auth.ctrl.php");
  require_once("../model/utils.class.php");
  require_once("../model/DAO.class.php");
  $data = initPage("Notifications");

  $dao = new DAO();


  $listenotif = $dao->readListeNotificationUserid( $_SESSION["user"]["ID"]);
  var_dump($listenotif);


  include("../view/notifications.view.php");
?>
