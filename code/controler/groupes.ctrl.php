<?php
  session_start();
  include("include/auth.ctrl.php");
  require_once("../model/utils.class.php");
  require_once("../model/DAO.class.php");
  $data = initPage("Groupes");
  $dao = new Dao();

  $user = $dao->readPersonneById($_SESSION["user"]["ID"]);
  if($user->getType() == 0){ // SI booker


    $groupelist = $dao->readListGroupeByBooker($_SESSION["user"]["ID"]);
    var_dump($groupelist);
    foreach ($groupelist as $key => $value) {
      $groupe =$dao->readGroupeById($value);
      var_dump($groupe);
    }

    $group['id'] = "mla8df1h3qet0sy";
    $group['name'] = "En Marche";
    $group['img'] = "../data/img/icons/Group_64px.png";
    $data['groupes'][] = $group;

    $group['id'] = "hla8df1h3qet0sp";
    $group['name'] = "Batoucada";
    $group['img'] = "../data/img/icons/Group_64px.png";
    $data['groupes'][] = $group;

    $group['id'] = "gla8df1h3qet0sv";
    $group['name'] = "Berlondon";
    $group['img'] = "../data/img/icons/Group_64px.png";
    $data['groupes'][] = $group;





include("../view/groupes.view.php");
  }else {
    $data['error']['title'] = "Acces Interdit";
    $data['error']['message'] = "Vous ne pouvez pas venir ici, cet espace est reservé aux bookers";
    $data['error']['back'] = "../controler/main.ctrl.php";
    include("../view/error.view.php");
  }





?>
