<?php
  session_start();
  require_once("../model/utils.class.php");
  $mois = array("Janvier","Fevrier","Mars","Avril","Mai","Juin","Juillet","Aout","Septembre","Octobre","Novembre","Decembre");

  $data['alert']['type'] = "danger";
  $data['alert']['icon'] = "exclamation-sign";
  $data['alert']['message'] = "Site en cours de construction ... Risques d'erreurs ><'";

  $data['page']="Agenda";

  $month = (isset($_GET['month'])?$_GET['month']:date("n"));
  $data['month'] = $month;
  $year = (isset($_GET['year'])?$_GET['year']:date("Y"));
  $data['year'] = $year;
  $data['calendar'] = calendar(mktime(0,0,0,$month,1,$year));
  $data['today'] = date("j");


  if (!isset($_GET['ajax']))
    include("../view/agenda.view.php");
  else {
    header("Content-Type:"."application/json");
    echo("{\n");
      echo("\"calendar\": ");
      echo(json_encode($data['calendar'],JSON_PRETTY_PRINT));
      echo(",\n");
      echo("\"date\": {\n");
        echo("\t\"day\": ".date("j").",\n");
        echo("\t\"month\": ".date("n").",\n");
        echo("\t\"year\": ".date("Y")."\n");
      echo("},\n");
      echo("\"monthName\":\"".$mois[$month-1]."\",\n");
      echo("\"month\":".$month.",\n");
      echo("\"year\":".$year."\n");
    echo("}");
  }
?>
