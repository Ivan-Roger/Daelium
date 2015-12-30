<?php
  session_start();
  include("include/auth.ctrl.php");
  require_once("../model/utils.class.php");
  require_once("../model/DAO.class.php");
  $data = initPage("Liste Groupes");

  $dao = new DAO();

  $data["users"] = array();
  $data["users"] = $dao->readAllPersonne();


  include("../view/liste_utilisateur.view.php");
?>
