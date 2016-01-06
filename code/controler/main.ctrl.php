<?php
   session_start();
   include("include/auth.ctrl.php");
   require_once("../model/DAO.class.php");
   require_once("../model/utils.class.php");
   $alerts=array();
   $data = initPage("Main",$alerts);

   if (isset($_GET['login']))
      $data['alerts'][] = newAlert("Vous vous etes bien connecté","success","ok");

   $dao = new DAO();
   $DEBUG[] = $dao->readUtilisateurByEmail($_SESSION['user']['mail']);

  include("../view/main.view.php");
?>
