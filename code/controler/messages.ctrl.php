<?php
  session_start();
  include("include/auth.ctrl.php");
  require_once("../model/utils.class.php");
  $data = initPage("Messages");



  include("../model/Message.class.php");
  include("../model/DAO.class.php");



  //$userid = $_SESSION["UserLoginId"];
$userid = 1;
  $dao = new DAO();

   $messagesrecu = $dao->readMessagesRecuByUtilisateur($userid);
   $messagesenvoyer =  $dao->readMessagesRecuByUtilisateur($userid);

   foreach ($messagesrecu as $key => $message) {
    //  var_dump($value);
    //  var_dump($key);
    $userExp = $dao->readUtilisateurById($message->getExpediteur());

    $data["messagelistr"][$key]["expediteur"] = 'Roger'; // Mettre le nom
    $data["messagelistr"][$key]["objet"] = $message->getNom();
    $data["messagelistr"][$key]["date"] = $message->getDateenvoi();
   }

   foreach ($messagesenvoyer as $key => $message) {
    //  var_dump($value);
    //  var_dump($key);
    $userExp = $dao->readUtilisateurById($message->getExpediteur());

    $data["messageliste"][$key]["destinataire"] = 'Roger'; // Mettre le nom
    $data["messageliste"][$key]["objet"] = $message->getNom();
    $data["messageliste"][$key]["date"] = $message->getDateenvoi();
   }
var_dump($data);
  include("../view/messages.view.php");
?>
