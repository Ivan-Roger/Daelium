<?php
  session_start();
  include("include/auth.ctrl.php");
  require_once("../model/utils.class.php");
  require_once("../model/DAO.class.php");
  $data = initPage("Compte");
  $dao = new DAO();

  $connexions = $dao->readConnexionsInJournalByUtilisateur($_SESSION['user']['ID']);
  $data['journal'] = Array();
  if ($connexions!=null) {
    foreach($connexions as $key => $co) {
      $data['journal'][$key]['IP'] = $co['ip'];
      $data['journal'][$key]['moment'] = $co['moment'];
      $data['journal'][$key]['support'] = $co['support'];
    }
  }

  include("../view/parametre.view.php");
?>
