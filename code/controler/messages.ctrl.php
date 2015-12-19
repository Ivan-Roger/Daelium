<?php
  session_start();
  include("include/auth.ctrl.php");
  require_once("../model/utils.class.php");
  $data = initPage("Messages");

  require_once("../model/Message.class.php");
  require_once("../model/DAO.class.php");

  //$userid = $_SESSION["user"][loginID"];
  $userid = 1;
  $dao = new DAO();

   $messagesrecu = $dao->readMessagesRecuByUtilisateur($userid);
   $messagesenvoyes =  $dao->readMessagesEnvoyeByUtilisateur($userid);

   foreach ($messagesrecu as $key => $message) {
    $userExp = $dao->readPersonneById($message->getExpediteur());
    $userRec = $dao->readPersonneById($userid);

    $data["messageR"][$key]["expediteur"] = $userExp->getNomComplet(); // Mettre le nom
    $data["messageR"][$key]["objet"] = $message->getNom();
    $data["messageR"][$key]["date"] = $message->getDateenvoi();

    $DEBUG[]="Recu";
    $DEBUG[]=$userRec;
    $DEBUG[]=$userExp;
   }

   foreach ($messagesenvoyes as $key => $message) {
    $userExp = $dao->readPersonneById($userid);
    $userRec = $dao->readPersonneById($message->getDestinataire());

    $data["messageE"][$key]["destinataire"] = $userRec->getNomComplet(); // Mettre le nom
    $data["messageE"][$key]["objet"] = $message->getNom();
    $data["messageE"][$key]["date"] = $message->getDateenvoi();

    $DEBUG[]="Envoyé";
    $DEBUG[]=$userExp;
    $DEBUG[]=$userRec;
   }
  include("../view/messages.view.php");
?>
