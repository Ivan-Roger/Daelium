<?php
  session_start();
  //include_once("../model/Artist.class.php");
  require_once("../model/utils.class.php");
  $data = initPage("Artistes");


  $data["action"] = "";
  if (isset($_GET["artiste"]) && isset($_GET["action"]) && $_GET['action']=="edit") {
    $data['artistegroupe']['nomscene']= "En Marche";
    include("../view/artiste_fiche_edit.view.php");
  } else if(isset($_GET["artiste"])) {
    $data['artistegroupe']['nomscene']= "En Marche";
    include("../view/artiste_fiche.view.php");
  } else {
    $data['code']=404;
    $data['message'] = "Le groupe que vous cherchez n'existe pas ou plus !";
    include("../view/error.view.php");
  }



?>
