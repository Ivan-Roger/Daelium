<?php
  session_start();
  include("include/auth.ctrl.php");
  require_once("../model/utils.class.php");
  require_once("../model/DAO.class.php");
  $data = initPage("Notifications");

  $dao = new DAO();
  $listenotif = array();
  $listenotif = $dao->readListeNotificationUserid( $_SESSION["user"]["ID"]);

  // Si $_GET['id'] est set et qu'elle correspon au bon utilisateur alors marquer la notification correspondante comme lue

  $data["notifs"] = array();
  foreach ($listenotif as $key => $value) {
    switch ($value->getType()) {
     case 0: // Message
       $data["notifs"][$key]['icon'] = "envelope";
       break;
     case 1: // Demande de groupe ?!
       $data["notifs"][$key]['icon'] = "child";
       break;
     case 2: // Participation a un event
       $data["notifs"][$key]['icon'] = "question";
       break;
    }
    $data["notifs"][$key]['etat'] = $value->getEtatEcrit();
    $data["notifs"][$key]['titre'] = $value->getTypeEcrit();
    $data["notifs"][$key]['message'] = $value->getMessage();
  }

  include("../view/notifications.view.php");
?>
