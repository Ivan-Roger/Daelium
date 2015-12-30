<?php
  session_start();
  include("include/auth.ctrl.php");
  require_once("../model/utils.class.php");
  require_once("../model/DAO.class.php");
  $data = initPage("Liste Groupes");

  $dao = new DAO();

  $data["groupes"] = array();
  $data["groupes"] = $dao->readAllGroupe();



  include("../view/liste_groupe.view.php");
?>
