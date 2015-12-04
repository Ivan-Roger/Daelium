<?php
  session_start();
  require_once("../model/utils.class.php");
  $data = initPage("Groups");

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
?>
