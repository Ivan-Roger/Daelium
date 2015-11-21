<?php
  session_start();
  //include_once("../model/Artist.class.php");
  require_once("../model/utils.class.php");
  $data = initPage("Artistes");

  $data['artistegroupe']['nomscene'] ="Le petit père des peuples";

  <!--
fg

  ->

  include("../view/artiste_fiche.view.php");
?>
