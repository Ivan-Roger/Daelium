<?php
  session_start();
  include("include/auth.ctrl.php");
  require_once("../model/utils.class.php");
  require_once("../model/DAO.class.php");
  $dao = new DAO();
  $data = initPage("Agenda");
  $jours = array("Lundi","Mardi","Mercredi","Jeudi","Vendredi","Samedi","Dimanche");
  $mois = array("Janvier","Fevrier","Mars","Avril","Mai","Juin","Juillet","Aout","Septembre","Octobre","Novembre","Decembre");

   $day = (isset($_GET['day'])?$_GET['day']:date("j")); // jour
   $data['day'] = $day;
   $month = (isset($_GET['month'])?$_GET['month']:date("n")); // mois
   $data['month'] = $month;
   $year = (isset($_GET['year'])?$_GET['year']:date("Y")); // annee
   $data['year'] = $year;

   if (isset($_GET['ajax'])) {
      $timestamp = mktime(0,0,0,$month,$day,$year); // timestamp du jour selectionné

      $monthLength = getMonthLength($month,$year);
      $data['mlength'] = $monthLength;
      $monthName = $mois[$month-1]; // nom du mois
      $data['monthName'] = $monthName;
      $wday = fr_wday(getdate($timestamp)['wday']); // jour de la semaine
      $data['wday'] = $wday;
      $wdayName = $jours[$wday]; // nom du jour
      $data['wdayName'] = $wdayName;

      $data['date']['day'] = date("j");
      $data['date']['month'] = date("n");
      $data['date']['year'] = date("Y");

      $data['calendar'] = calendar(mktime(0,0,0,$month,1,$year));

      /* // Evenements de test
      $evt['id'] = 2;
      $evt['name'] = "RDV Jean-Louis";
      $evt['day'] = "18/12/2015";
      $evt['hour'] = "09h15";
      $evts[$evt['id']]=$evt;

      $evt['id'] = 1;
      $evt['name'] = "RDV Marc-Henri";
      $evt['day'] = "18/12/2015";
      $evt['hour'] = "09h45";
      $evts[$evt['id']]=$evt;

      $evt['id'] = 3;
      $evt['name'] = "Noël";
      $evt['day'] = "25/12/2015";
      $evt['hour'] = "day";
      $evts[$evt['id']]=$evt;

      $evt['id'] = 0;
      $evt['name'] = "Nouvel An";
      $evt['day'] = "31/12/2015";
      $evt['hour'] = "24h00";
      $evts[$evt['id']]=$evt;
      */
      if (isset($_GET['events'])) {
         $evts = $dao->readEvenementByCreateur($_SESSION['user']['ID']);
         foreach($evts as $evtO) {
            $evt['id'] = $evtO->getID();
            $evt['name'] = $evtO->getNom();
            $evt['dateDebut'] = $evtO->getDateDebut();
            $evt['heureDebut'] = $evtO->getHeureDebut();
            $evt['journee'] = $evtO->isDayLong();
            if ($evtO->isDayLong()) {
               $evt['dateFin'] = $evtO->getDateFin();
               $evt['heureFin'] = $evtO->getHeureFin();
            }
            $data['events'][]=$evt;
         }
      }
      if (isset($_GET['events-day'])) {
         $evts = $dao->readEvenementByCreateurDate($_SESSION['user']['ID'],$year."-".$month."-".$day);
         foreach($evts as $evtO) {
            $evt['id'] = $evtO->getID();
            $evt['name'] = $evtO->getNom();
            $evt['dateDebut'] = $evtO->getDateDebut();
            $evt['heureDebut'] = $evtO->getHeureDebut();
            $evt['journee'] = $evtO->isDayLong();
            if ($evtO->isDayLong()) {
               $evt['dateFin'] = $evtO->getDateFin();
               $evt['heureFin'] = $evtO->getHeureFin();
            }
            $data['events'][]=$evt;
         }
      }
      if (isset($_GET['event'])) {
         $evts = $dao->readEvenementByID($_GET['event']);
         $data['event']['id'] = 0;
         $data['event']['name'] = "Nouvel An";
         $data['event']['dateDebut'] = "31/12/2015";
         $data['event']['heureDebut'] = "24h00";
         $data['event']['journee'] = $evt->isDayLong();
         if ($evt->isDayLong()) {
            $data['event']['dateFin'] = $evt->getHeureDebut();
            $data['event']['heureFin'] = $evt->getHeureFin();
         }
      }
   }

   if (!isset($_GET['ajax'])) // affichage normal
      include("../view/agenda.view.php");
   else { // retour en JSON pour les requetes AJAX
      header("Content-Type:"."application/json");
      echo(json_encode($data,JSON_PRETTY_PRINT));
   }
?>
