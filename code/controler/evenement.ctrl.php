<?php
  session_start();
  //include_once("../model/Artist.class.php");
  require_once("../model/utils.class.php");
  $data = initPage("Evenements");

  if(isset($_GET['evenement']) && $_GET['evenement'] != ""){


    $data['vue']="fiche";

    $data['evenement']['nom'] = $_GET['evenement'];



  } elseif (isset($_GET['action']) && $_GET['action']=="new") {
    //si il demande la creation d'un evt
      $data['evenement']['nom'] = "new";
    $data['vue']="form";
    //envoi un formulaire pour cree un artiste
  }elseif (isset($_POST['nomevent'])) {
    //quand il a rempli le 1er formulaire
    $data['evenement']['nom'] = $_POST['nomevent'];


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
$data['evenement']['dates'] = $aDates;


    //insere dans le Dao

    $data['vue']="next";
  }else{
    //Afficher 404 not found
      $data['evenement']['nom'] = "Il doit y avoir une Erreur";
    $data['vue']="404";
  }


  include("../view/evenement.view.php");
?>
