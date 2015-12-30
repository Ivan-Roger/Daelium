<?php
  session_start();
  include("include/auth.ctrl.php");
  require_once("../model/utils.class.php");
  require_once("../model/DAO.class.php");
  $data = initPage("Notifications");

  $dao = new DAO();
  $listenotif = array();
  $listenotif = $dao->readListeNotificationUserid( $_SESSION["user"]["ID"]);

$data["notifs"] = array();
  foreach ($listenotif as $key => $value) {
    $data["notifs"][$key]['etat'] = $value->getEtatEcrit();
    $data["notifs"][$key]['titre'] = $value->getTypeEcrit();
    $data["notifs"][$key]['message'] = $value->getMessage();
  }



  include("../view/notifications.view.php");
?>
