<?php
  session_start();
  include("include/auth.ctrl.php");
  require_once("../model/utils.class.php");
  require_once("../model/DAO.class.php");
  $data = initPage("Liste Groupes");

  $dao = new DAO();

  $data["manifs"] = array();
  $data["manifs"] = $dao->readAllManifestation();


  include("../view/liste_manifestation.view.php");
?>
