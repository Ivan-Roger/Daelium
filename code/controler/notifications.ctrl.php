<?php
  session_start();
  include("include/auth.ctrl.php");
  require_once("../model/utils.class.php");
  $data = initPage("Notifications");

  if(isset($_GET["id"])){
    $userpid = $_GET["id"];
  }else if (isset($_SESSION["user"]["ID"])){
    $userpid = $_SESSION["user"]["ID"];
  }else{
    $userpid = NULL;
  }

  $dao = new DAO();
  $user = $dao->readPersonneById($message->getExpediteur());

  $DEBUG = $user->getNomComplet();

  include("../view/notifications.view.php");
?>
