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


  if (!isset($_GET['ajax'])) // affichage normal
    include("../view/agenda.view.php");
  else { // retour en JSON pour les requetes AJAX (a supprimer ici et traduire coté client (JS))
    header("Content-Type:"."application/json");
    echo("{\n");
      if(isset($_GET['calendar'])) {
      echo("\"calendar\": ");
      echo(json_encode($data['calendar'],JSON_PRETTY_PRINT));
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
