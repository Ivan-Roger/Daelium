<?php
  session_start();
  include("include/auth.ctrl.php");
  require_once("../model/utils.class.php");
  require_once("../model/DAO.class.php");
  $data = initPage("Notifications");

  $dao = new DAO();
  $select['id'] = 0;

  // Si $_GET['id'] est set et que le message appartient au bon utilisateur alors mettre a jour l'etat a 1 (lu)
  if (isset($_GET['id'])) {
    $notif = $dao->readNotificationById($_GET['id']);
    $select['id'] = $_GET['id'];
    if ($notif->getDestinataire() == $_SESSION['user']['ID']) {
      $notif->setEtat(1);
      $dao->updateNotification($notif);
      $data['request']['code'] = 200;
      $data['request']['status'] = "Success";
    } else {
      $data['request']['code'] = 503;
      $data['error']['code'] = 0; // On n'en tient pas compte
      $data['error']['title'] = "Interdit";
      $data['error']['back'] = "../controler/notifications.ctrl.php";
      $data['error']['message'] = "Vous n'avez pas le droit d'accèder a cette notification.";
    }
    $data['notifs-menu'] = getNotifs();
  }


  if (!isset($_GET['ajax'])) {
    $listenotif = array();
    $listenotif = $dao->readListeNotificationUserid( $_SESSION["user"]["ID"]);

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
      $data["notifs"][$key]['id'] = $value->getIdNotification();
      $data["notifs"][$key]['etat'] = $value->getEtatEcrit();
      $data["notifs"][$key]['select'] = $select['id'] == $value->getIdNotification();
      $data["notifs"][$key]['titre'] = $value->getTypeEcrit();
      $data["notifs"][$key]['message'] = $value->getMessage();
    }
  }

  if (!isset($_GET['ajax'])) {
    if (isset($data['error']))
      include("../view/error.view.php");
    else
      include("../view/notifications.view.php");
  } else {
    header("Content-Type:"."application/json");
    echo(json_encode($data,JSON_PRETTY_PRINT));
  }
?>
