<?php
  session_start();
  require_once("../model/utils.class.php");
  $data = initPage("Agenda");
  $jours = array("Lundi","Mardi","Mercredi","Jeudi","Vendredi","Samedi","Dimanche");
  $mois = array("Janvier","Fevrier","Mars","Avril","Mai","Juin","Juillet","Aout","Septembre","Octobre","Novembre","Decembre");

  $day = (isset($_GET['day'])?$_GET['day']:date("j")); // jour
  $data['day'] = $day;
  $month = (isset($_GET['month'])?$_GET['month']:date("n")); // mois
  $data['month'] = $month;
  $monthName = $mois[$month-1]; // nom du mois
  $data['monthName'] = $monthName;
  $year = (isset($_GET['year'])?$_GET['year']:date("Y")); // annee
  $data['year'] = $year;
  $monthLength = getMonthLength($month,$year);
  $data['mlength'] = $monthLength;

  $timestamp = mktime(0,0,0,$month,$day,$year); // timestamp du jour selectionné

  $wday = fr_wday(getdate($timestamp)['wday']); // jour de la semaine
  $data['wday'] = $wday;
  $wdayName = $jours[$wday]; // nom du jour
  $data['wdayName'] = $wdayName;

  $data['calendar'] = calendar(mktime(0,0,0,$month,1,$year));
  $data['date']['day'] = date("j");
  $data['date']['month'] = date("n");
  $data['date']['year'] = date("Y");

  $data['events'] = Array();
  if (isset($_GET['events']) || $day==18) {
    $evt['id'] = 2;
    $evt['name'] = "RDV Jean-Louis";
    $evt['day'] = "18/12/2015";
    $evt['hour'] = "09h15";
    $data['events'][$evt['id']]=$evt;

    $evt['id'] = 1;
    $evt['name'] = "RDV Marc-Henri";
    $evt['day'] = "18/12/2015";
    $evt['hour'] = "09h45";
    $data['events'][$evt['id']]=$evt;
  }
  if (isset($_GET['events']) || $day==25) {
    $evt['id'] = 3;
    $evt['name'] = "Noël";
    $evt['day'] = "25/12/2015";
    $evt['hour'] = "day";
    $data['events'][$evt['id']]=$evt;
  }
  if (isset($_GET['events']) || $day==31) {
    $evt['id'] = 0;
    $evt['name'] = "Nouvel An";
    $evt['day'] = "31/12/2015";
    $evt['hour'] = "24h00";
    $data['events'][$evt['id']]=$evt;
  }

  if (!isset($_GET['ajax'])) // affichage normal
    include("../view/agenda.view.php");
  else { // retour en JSON pour les requetes AJAX
    header("Content-Type:"."application/json");
    echo("{\n");
      if(isset($_GET['calendar'])) {
      echo("\"calendar\": ");
      echo(json_encode($data['calendar'],JSON_PRETTY_PRINT));
      echo("\n");
    } else if (isset($_GET['events']) || isset($_GET['events-day'])) {
      echo("\"events\": ");
      echo(json_encode($data['events'],JSON_PRETTY_PRINT));
      echo("\n");
    } else if (isset($_GET['event']) && isset($_GET['id'])) {
      echo("\"event\": ");
      echo(json_encode($data['event'],JSON_PRETTY_PRINT));
      echo("\n");
    } else {
      echo("\"date\": {\n");
        echo("\t\"day\": ".date("j").",\n");
        echo("\t\"month\": ".date("n").",\n");
        echo("\t\"year\": ".date("Y")."\n");
      echo("},\n");
      echo("\"day\":\"".$day."\",\n");
      echo("\"dayName\":\"".$jours[$wday]."\",\n");
      echo("\"wday\":\"".$wday."\",\n");
      echo("\"monthName\":\"".$mois[$month-1]."\",\n");
      echo("\"month\":".$month.",\n");
      echo("\"year\":".$year.",\n");
      echo("\"monthLength\":".$monthLength."\n");
    }
    echo("}");
  }
?>
