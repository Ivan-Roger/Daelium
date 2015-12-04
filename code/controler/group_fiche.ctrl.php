<?php
  session_start();
  require_once("../model/utils.class.php");
  $data = initPage("Groups");


  $data["action"] = "";
  if (isset($_GET["id"]) && isset($_GET["action"]) && $_GET['action']=="edit") {
    $data['group']['id']= $_GET['id'];
    $data['group']['name']= "En Marche";
    include("../view/group_fiche_edit.view.php");
  } else if(isset($_GET["id"])) {
    $data['group']['id']= $_GET['id'];
    $data['group']['name']= "En Marche";
    include("../view/group_fiche.view.php");
  } else {
    $data['error']['title'] = "Groupe Inconnu";
    $data['error']['back'] = "../controler/main.ctrl.php";
    $data['error']['message'] = "Le groupe que vous cherchez n'existe pas ou plus !";
    include("../view/error.view.php");
  }



?>
