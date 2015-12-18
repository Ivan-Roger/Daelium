<?php
  session_start();
  require_once("../model/utils.class.php");
  $data = initPage("Messages");


  
  include("../model/Message.class.php");
  include("../model/DAO.class.php");



  //$userid = $_SESSION["UserLoginId"];
$userid = 1;
  $dao = new DAO();

  $messagerecu = $dao->readMessagesRecuByUtilisateur($userid);
  $messageenvoyer =  $dao->readMessagesRecuByUtilisateur($userid);
  var_dump($messagerecu);

  include("../view/messages.view.php");
?>
