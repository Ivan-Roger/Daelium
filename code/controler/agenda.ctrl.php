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
      if (isset($_GET['next-events'])) {
         $evts = $dao->readEvenementByCreateurApresDate($_SESSION['user']['ID'],date("Y-m-d"));
         foreach($evts as $evtO) {
            $evt['id'] = $evtO->getID();
            $evt['name'] = $evtO->getNom();
            $evt['dateDebut'] = $evtO->getDateDebut();
            $evt['dateFin'] = $evtO->getDateFin();
            $evt['journee'] = $evtO->isDayLong();
            if (!$evtO->isDayLong()) {
               $evt['heureDebut'] = $evtO->getHeureDebut();
               $evt['heureFin'] = $evtO->getHeureFin();
            }
            $data['events'][]=$evt;
         }
      }
      if (isset($_GET['events-day'])) {
         $data['events'] = Array();
         $evts = $dao->readEvenementByCreateurDate($_SESSION['user']['ID'],$year."-".$month."-".$day);
         if ($evts!=null) {
            foreach($evts as $evtO) {
               $evt['id'] = $evtO->getID();
               $evt['name'] = $evtO->getNom();
               $evt['dateDebut'] = $evtO->getDateDebut();
               $evt['dateFin'] = $evtO->getDateFin();
               $evt['journee'] = $evtO->isDayLong();
               if (!$evtO->isDayLong()) {
                  $evt['heureDebut'] = $evtO->getHeureDebut();
                  $evt['heureFin'] = $evtO->getHeureFin();
               }
               $data['events'][]=$evt;
            }
         }
      }
      if (isset($_GET['event'])) {
         $evt = $dao->readEvenementByID($_GET['event']);
         $data['event']['id'] = $evt->getID();
         $data['event']['name'] = $evt->getNom();
         $data['event']['dateDebut'] = $evt->getDateDebut();
         $data['event']['dateFin'] = $evt->getDateFin();
         $data['event']['journee'] = $evt->isDayLong();
         if (!$evt->isDayLong()) {
            $data['event']['heureDebut'] = $evt->getHeureDebut();
            $data['event']['heureFin'] = $evt->getHeureFin();
         }
         $data['event']['lieu'] = $evt->getLieu();
         $data['event']['participants'] = $evt->getParticipants();
         $data['event']['rappels'] = $evt->getRappels();
         $data['event']['plus'] = $evt->getPlus();
      }
   }

   if (!isset($_GET['ajax'])) // affichage normal
      include("../view/agenda.view.php");
   else { // retour en JSON pour les requetes AJAX
      header("Content-Type:"."application/json");
      echo(json_encode($data,JSON_PRETTY_PRINT));
   }
?>
