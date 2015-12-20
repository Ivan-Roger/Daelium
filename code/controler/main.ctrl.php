<?php
   session_start();
   include("include/auth.ctrl.php");
   require_once("../model/DAO.class.php");
   require_once("../model/utils.class.php");
   $alerts=array();
   if (isset($_GET['type'])) {
    $_SESSION['user']['type'] = $_GET['type'];
    $alerts[] = newAlert("Vous avez bien changé de statut : ".$_GET['type'],"success","ok");
   }
   $data = initPage("Main",$alerts);

   if (isset($_GET['login']))
      $data['alerts'][] = newAlert("Vous vous etes bien connecté","success","ok");

   $dao = new DAO();
   $DEBUG[] = $dao->readUtilisateurByEmail($_SESSION['user']['mail']);

  include("../view/main.view.php");
?>
