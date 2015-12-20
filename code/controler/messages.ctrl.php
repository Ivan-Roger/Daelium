<?php
   session_start();
   include("include/auth.ctrl.php");
   require_once("../model/utils.class.php");
   $data = initPage("Messages");

   require_once("../model/Message.class.php");
   require_once("../model/DAO.class.php");

   $userid = $_SESSION["user"]["ID"];
   $dao = new DAO();

   if (!isset($_GET['ajax'])) {
      $userObj = $dao->readPersonneById($userid);

      $messagesrecus = $dao->readMessagesRecusByUtilisateur($userid);
      $messagesenvoyes =  $dao->readMessagesEnvoyesByUtilisateur($userid);
      $messagesbrouillons =  $dao->readMessagesBrouillonsByUtilisateur($userid);

      $DEBUG[]="Moi";
      $DEBUG[]=$userObj;

      $DEBUG[]="Recu";
      $data["messageR"] = Array();
      if ($messagesrecus!=null)
      foreach ($messagesrecus as $key => $message) {
         $userExp = $dao->readPersonneById($message->getExpediteur());

         $data["messageR"][$key]["id"] = $message->getID();
         $data["messageR"][$key]["expediteur"] = $userExp->getNomComplet(); // Mettre le nom
         $data["messageR"][$key]["objet"] = $message->getNom();
         $data["messageR"][$key]["date"] = $message->getDateenvoi();
         $data["messageR"][$key]["parent"] = $message->getParent();
         $data["messageR"][$key]["lu"] = $message->getEtat()>=10;

         //$data["messageR"][$key]["contenu"] = $message->getContenu(); // Ne l'envoyer que lors de la demande AJAX

         $DEBUG[]=$message;
      }

      $DEBUG[]="Envoyé";
      $data["messageE"] = Array();
      if ($messagesenvoyes!=null)
      foreach ($messagesenvoyes as $key => $message) {
         $userRec = $dao->readPersonneById($message->getDestinataire());

         $data["messageE"][$key]["id"] = $message->getID();
         $data["messageE"][$key]["destinataire"] = $userRec->getNomComplet(); // Mettre le nom
         $data["messageE"][$key]["objet"] = $message->getNom();
         $data["messageE"][$key]["date"] = $message->getDateenvoi();
         //$data["messageE"][$key]["contenu"] = $message->getContenu(); // Ne l'envoyer que lors de la demande AJAX

         $DEBUG[]=$message;
      }

      $DEBUG[]="Brouillons";
      $data["messageB"] = Array();
      if ($messagesbrouillons!=null)
      foreach ($messagesbrouillons as $key => $message) {
         $userRec = $dao->readPersonneById($message->getDestinataire());

         $data["messageB"][$key]["id"] = $message->getID();
         $data["messageB"][$key]["destinataire"] = $userRec->getNomComplet(); // Mettre le nom
         $data["messageB"][$key]["objet"] = $message->getNom();
         $data["messageB"][$key]["date"] = $message->getDateenvoi();
         //$data["messageE"][$key]["contenu"] = $message->getContenu(); // Ne l'envoyer que lors de la demande AJAX

         $DEBUG[]=$message;
      }
   }

   if (isset($_GET['message']) && isset($_GET['id'])) {
      $message = $dao->readMessageById($_GET['id']);
      if ($message->getExpediteur()==$userid || $message->getDestinataire()==$userid) {
         $userExp = $dao->readPersonneById($message->getExpediteur());
         $userDes = $dao->readPersonneById($message->getDestinataire());
         if (isset($_GET['setState'])) {
            $message->setEtat($_GET['setState']);
            $dao->updateMessage($message);
         }
         $data['message']['id'] = $message->getID();
         $data['message']["me"] = ($message->getExpediteur()==$userid?'E':'D'); // Je suis Expediteur ou Destinataire ?
         $data['message']["destinataire"] = $userDes->getNomComplet(); // Mettre le nom
         $data['message']["expediteur"] = $userExp->getNomComplet(); // Mettre le nom
         $data['message']["objet"] = $message->getNom();
         $data['message']["date"] = $message->getDateenvoi();
         $data['message']["parent"] = $message->getParent();
         $data['message']["contenu"] = $message->getContenu(); // Ne l'envoyer que lors de la demande AJAX
         $data['message']["etat"] = $message->getEtat();
      } else {
         $data['error']['title'] = "Interdit";
         $data['error']['back'] = "../controler/messages.ctrl.php";
         $data['error']['message'] = "Vous n'avez pas le droit d'accéder a ce message (".$userid."/".$message->getExpediteur().",".$message->getDestinataire().")";
         $data['error']['code'] = 5003; // Message - Interdit
      }
   }

   // ------------- DISPLAY -------------
   if (isset($_GET['ajax'])) {
      echo("{\n");
      if (isset($_GET['message']) && isset($_GET['id'])) {
         if (isset($data['error'])) {
            echo("\t\"error\": ");
            echo(json_encode($data['error'],JSON_PRETTY_PRINT));
            echo("\n");
         } else {
            echo("\t\"message\": ");
            echo(json_encode($data['message'],JSON_PRETTY_PRINT));
            echo("\n");
         }
      }
      echo("}");
   } else {
      if (!isset($data['error']))
         include("../view/messages.view.php");
      else
         include("../view/error.view.php");
   }
?>
