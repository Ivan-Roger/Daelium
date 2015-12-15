<?php
  session_start();
  //include_once("../model/Artist.class.php");
  require_once("../model/utils.class.php");
  $data = initPage("Events");

  if (isset($_GET['id']) && $_GET['id'] != "") {
    // Recupérer les données depuis la BD avec l'id ($_GET['id'])
    $data['evenement']['id'] = $_GET['id'];
    $data['evenement']['nom'] = "Bilbao BBK Live";
    $data['evenement']['lieu'] = "Villard de Lans";

    $pas['date'] = "18/11/2015 21h20";
    $pas['groupe']['nom'] = "En marche";
    $data['passages'][] = $pas;

    $pas['date'] = "18/11/2015 21h50";
    $pas['groupe']['nom'] = "Batoucada";
    $data['passages'][] = $pas;

    $data['evenement']['img'] = "../data/users/icons/bilbao-logo.jpg";
    include("../view/evenement.view.php");

  } elseif (isset($_GET['action']) && $_GET['action']=="new") {
    //si il demande la creation d'un evt
    $data['evenement']['id'] = "kfpb5gso63w7s2l";
    $data['evenement']['nom'] = "Nouvel Evenement";
    //envoi un formulaire pour cree un artiste
    include("../view/evenement_edit.view.php");

  } elseif (isset($_POST['action']) && $_POST['action']="dates") {
    //quand il a rempli le 1er formulaire
    $data['evenement']['id'] = $_POST['id'];
    $data['evenement']['nom'] = "Bilbao BBK Live";
    $data['evenement']['img'] = "../data/users/icons/bilbao-logo.jpg";
    $dated = $_POST['dated'];
    $datef = $_POST['datef'];

    function getDatesBetween ($dStart, $dEnd) {
      $iStart = strtotime ($dStart);
      $iEnd = strtotime ($dEnd);
      if (false === $iStart || false === $iEnd) {
        return false;
      }
      $aStart = explode ('-', $dStart);
      $aEnd = explode ('-', $dEnd);
      if (count ($aStart) !== 3 || count ($aEnd) !== 3) {
        return false;
      }
      if (false === checkdate ($aStart[1], $aStart[2], $aStart[0]) || false === checkdate ($aEnd[1], $aEnd[2], $aEnd[0]) || $iEnd <= $iStart) {
        return false;
      }
      for ($i = $iStart; $i < $iEnd + 86400; $i = strtotime ('+1 day', $i) ) {
        $sDateToArr = strftime ('%d/%m/%Y', $i);
        $sYear = substr ($sDateToArr, 0, 4);
        $sMonth = substr ($sDateToArr, 5, 2);
        $aDates[] = $sDateToArr;
      }
      if (isset ($aDates) && !empty ($aDates)) {
        return $aDates;
      } else {
        return false;
      }
    }

    // chaque jour qu'il y a entre ces deux dates
    $aDates = getDatesBetween ($dated, $datef);
    //$data['evenement']['dates'] = $aDates;

    $data['evenement']['dates'][] = "15/11/2014";
    $data['evenement']['dates'][] = "16/11/2014";
    $data['evenement']['dates'][] = "17/11/2014";
    $data['evenement']['dates'][] = "18/11/2014";

    //insere dans le Dao

    include("../view/evenement_dates.view.php");

  } else {
    $data['error']['title'] = "Evenement inconnu";
    $data['error']['back'] = "../controler/evenements.ctrl.php";
    $data['error']['message'] = "Vous vous etes perdu ...";
    $data['page'] = "Error";
    include("../view/error.view.php");
  }
?>
