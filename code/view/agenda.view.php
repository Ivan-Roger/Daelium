<?php
   if (!isset($data))
      header("Location:"."../");
?>
<!DOCTYPE html>
<html>
  <head>
    <?php include("../view/include/includes.view.php"); ?>
    <link rel="stylesheet" href="../data/css/agenda.css">
    <link rel="stylesheet" href="../data/css/jquery-ui.min.css">
    <title>Dælium - Agenda</title>
  </head>
  <body>
    <?php include("../view/include/header.view.php"); ?>
    <section class="col-lg-12">
      <div class="row">
        <div class="loader">.</div>
        <article class="col-lg-3" style="height:400px;"> <!-- =============================================== Comming Next =============================================== -->
          <div class="panel panel-default">
            <div class="panel-heading"><h4>Prochains événements</h4></div>
            <div class="panel-body table-responsive evt no-padding" style="overflow:auto;height:450px;overflow-x: hidden;">
              <table id="commingNext" class="table table-striped table-hover table-bordered col-lg-12">
                <colgroup>
                  <col class="text-center col-lg-2" />
                  <col class="text-center col-lg-3" />
                  <col class="col-lg-7"/>
                </colgroup>
                <thead>
                  <tr><th>Date</th> <th>Heure</th> <th>Evenement</th></tr>
                </thead>
                <tbody>
                </tbody>
              </table>
            </div>
          </div>
        </article>
        <article id="calendarArticle" class="col-lg-5"> <!-- =============================================== Calendar =============================================== -->
          <div class="panel panel-default">
            <div class="panel-heading text-center">
              <div class='row'>
                <div class='col-md-3 col-xs-4'>
                  <button id="calendarPrev" class='ajax-navigation btn btn-default btn-sm'>
                    <span class='glyphicon glyphicon-arrow-left no-margin'></span>
                  </button>
                </div>
                <div class='col-md-6 col-xs-4'><h4 id="calendarTitle"></h4></div>
                <div class='col-md-3 col-xs-4 '>
                  <button id="calendarNext" class='ajax-navigation btn btn-default btn-sm'>
                    <span class='glyphicon glyphicon-arrow-right no-margin'></span>
                  </button>
                </div>
              </div>
            </div>
            <div class="panel-body table-responsive calendar" style="height:450px;">
              <table id="calendar" class="table table-bordered col-lg-12 text-center" data-day="<?= $data['day'] ?>" data-month="<?= $data['month'] ?>" data-year="<?= $data['year'] ?>">
                <colgroup>
                  <col class="col-lg-1" />
                  <col/>
                  <col/>
                  <col/>
                  <col/>
                  <col/>
                  <col/>
                  <col/>
                </colgroup>
                <thead>
                  <tr><th>Semaine</th><th>Lundi</th><th>Mardi</th><th>Mercredi</th><th>Jeudi</th><th>Vendredi</th><th>Samedi</th><th>Dimanche</th></tr>
                </thead>
                <tbody>
                </tbody>
              </table>
              <div class="col-lg-12 text-center">
                  <button id="calendarResetToday" class="btn btn-default"><span class="glyphicon glyphicon-time"></span>Aujourd'hui</button>
                  <button id="newEvent" class="btn btn-primary"><span class="glyphicon glyphicon-plus"></span>Créer un évenement</button>
              </div>
            </div>
          </div>
        </article>
        <article id="dayPlanArticle" class="col-lg-4"> <!-- =============================================== Day Plan =============================================== -->
          <div class="panel panel-default">
            <div class="panel-heading text-center">
              <div class='row'>
                <div class='col-md-3 col-xs-4'>
                  <button id="dayPlanPrev" class='ajax-navigation btn btn-default btn-sm'>
                    <span class='glyphicon glyphicon-arrow-left no-margin'></span>
                  </button>
                </div>
                <div class='col-md-6 col-xs-4'>
                  <h4 id="dayPlanTitle"></h4>
                </div>
                <div class='col-md-3 col-xs-4 '>
                  <button id="dayPlanNext" class='ajax-navigation btn btn-default btn-sm'>
                    <span class='glyphicon glyphicon-arrow-right no-margin'></span>
                  </button>
                </div>
              </div>
            </div>
            <div class="panel-body table-responsive no-padding">
              <div id="dayPlan" class="col-lg-12">
                <div class="dayPlanTableHead"><table class="table table-bordered col-lg-12">
                  <tr><th>Heure</th><th>Evenements</th></tr>
                  <tr data-hour="day"><td class="text-center">Journée</td><td class="content"></td></tr>
                </table></div>
                <div class="dayPlanTable"><table class="table table-striped table-bordered col-lg-12">
                  <?php for($i=1 ; $i<=24 ; $i++){ ?>
                    <tr data-hour="<?= $i ?>"><td class="text-center" ><?= $i ?>h</td><td class="content"></td></tr>
                  <?php } ?>
                </table></div>
            </div>
          </div>
        </article>
      </div>
      <div class="row">
        <article id="eventView" data-id="" class="collapse col-lg-10 col-lg-offset-1"> <!-- =============================================== Event Display =============================================== -->
          <div class="panel panel-default">
            <div class="panel-heading">
             <div class="col-xs-11"><h3 class="eventTitle">RDV Marc-Henri</h3></div>
             <button class="float-right btn btn-lg btn-default"><span class="glyphicon glyphicon-share no-margin"></span></button>
            </div>
            <div class="panel-body">
             <!-- Date debut -->
             <div class="col-lg-6">
                <div class="horaires row">
                     <h4>Début</h4>
                     <p class="debut">
                        Du <b class="date">18/12/2015</b> à
                        <b class="heure">09h45</b>
                     </p>
                     <h4>Fin</h4>
                     <p class="fin">
                        Au <b class="date">18/12/2015</b> à
                        <b class="heure">10h30</b>
                     </p>
                </div>
                <div class="desc row">
                    <h4>Description</h4>
                    <textarea style="width:90%; height: 150px; margin-bottom: 25px;" readonly class="form-control eventDesc"></textarea>
                </div>
                <div class="rappels row">
                   <h4>Rappels</h4>
                   <button class="btn btn-default">Voir les rappels</button>
                </div>
             </div>
            <div class="col-lg-6">
               <h4><span class="glyphicon glyphicon-flag"></span>Lieu</h4>
               <div class="lieu row">
                 <p class="text">
                    110 place doyen gosses<br/>
                    38000 Grenoble<br/>
                    Isère / Rhone-Alpes<br/>
                    FRANCE
                 </p>
                 <span class="col-sm-4 text-right">Plan</span><a class="col-sm-8 text-left" href="#" target="_blank">Voir sur google maps</a>
               </div>
               <div class="row participants">
                  <h4><span class="glyphicon glyphicon-book"></span>Participants</h4>
                  <table class="table">
                     <thead>
                        <tr><th></th><th>Nom</th><th>Note</th></tr>
                     </thead>
                     <tbody>
                        <tr><td class="text-right"><span class="glyphicon glyphicon-user"></span></td><td>Marc-Henri</td><td>...</td></tr>
                     </tbody>
                  </table>
               </div>
            </div>
           </div>
          </div>
         </div>
        </article>
        <article id="eventEdit" class="collapse collapsed col-lg-10 col-lg-offset-1"> <!-- =============================================== Event Form =============================================== -->
          <div class="panel panel-default">
            <div class="panel-heading">
              <div class="input-group">
                <input name="eventname" class="form-control input-lg" value="Nouvel évènement">
              </div>
            </div>
            <div class="panel-body">
              <form method="POST" action="?create">
                <!-- Date debut -->
                <div class="form-inline">
                  <label class="col-lg-2" for="eventBeginingDate">Début</label>
                  <div class="col-lg-4 input-group">
                    <input id="eventBeginingDate" name="eventBeginingDate" class="form-control" placeholder="Date"/>
                    <div class="input-group-addon">
                      <span class="glyphicon glyphicon-calendar no-margin"></span>
                    </div>
                  </div>
                  <div class="hour-input col-lg-4 input-group">
                    <input id="eventBeginingHour" name="eventBeginingHour" class="form-control" placeholder="Heure" readonly/>
                    <div class="input-group-addon">
                      <span class="glyphicon glyphicon-time no-margin"></span>
                    </div>
                  </div>
                </div>
                <br/>
                <!-- Date Fin -->
                <div class="form-inline">
                  <label class="col-lg-2" for="eventEndingDate">Fin</label>
                  <div class="col-lg-4 input-group">
                    <input id="eventEndingDate" name="eventEndingDate" class="form-control" placeholder="Date"/>
                    <div class="input-group-addon">
                      <span class="glyphicon glyphicon-calendar no-margin"></span>
                    </div>
                  </div>
                  <div class="hour-input col-lg-4 input-group">
                    <input id="eventEndingHour" name="eventEndingHour" class="form-control" placeholder="Heure" readonly/>
                    <div class="input-group-addon">
                      <span class="glyphicon glyphicon-time no-margin"></span>
                    </div>
                  </div>
                </div>
                </br>
                <div class="form-inline">
                  <div class="col-lg-9 col-lg-offset-2 checkbox">
                    <label>
                      <input id="eventDayLong" type="checkbox" name="eventDayLong"/>
                      Journée entière
                    </label>
                  </div>
                </div>
                </br>
                </br>
                <div class="form-inline">
                  <label class="col-lg-2" for="eventPlace">Lieu</label>
                  <div class="col-lg-9 input-group">
                    <input class="form-control" type="text" name="eventPlace" id="eventPlace" placeholder="Lieu"/>
                    <div class="input-group-btn">
                      <button class="btn btn-default"><span class="glyphicon glyphicon-flag no-margin"></span></button>
                    </div>
                  </div>
                </div>
                </br>
                <div class="form-inline">
                  <label class="col-lg-2" for="eventParticipants">Participants</label>
                  <div class="col-lg-9 input-group">
                    <input class="form-control" type="text" name="eventParticipants" id="eventParticipants" placeholder="Participants"/>
                    <div class="input-group-btn">
                      <button class="btn btn-default"><span class="glyphicon glyphicon-book no-margin"></span></button>
                    </div>
                  </div>
                </div>
                </br>
                <div class="form-inline">
                  <label class="col-lg-2" for="eventDesc">Description</label>
                  <div class="col-lg-8" style="padding:0px; margin-right:50px;">
                    <textarea style="width:100%; height: 150px; margin-bottom: 25px;" class="form-control" name="eventDesc" id="eventDesc"></textarea>
                  </div>
                </div>
                </br>
                </br>
                <div class="form-inline">
                  <label class="col-lg-2" for="eventReminder">Rappels</label>
                  <div class="col-lg-8 input-group">
                    <button class="btn btn-default" id="eventReminder">Ajouter un rappel</button>
                  </div>
                </div>
                </br>
                <div class="form-inline">
                  <label class="col-lg-2" for="eventMore">Plus</label>
                  <div class="col-lg-8 input-group">
                    <button class="btn btn-default" id="eventMore">Ajouter un champ</button>
                  </div>
                </div>
                </br>
                <div class="form-inline text-right">
                  <input type="submit" class="btn btn-primary">Sauvegarder</input>
                  <input type="cancel" class="btn btn-default">Annuler</input>
                </div>
              </form>
            </div>
          </div>
        </article>
      </div>
    </section>
    <?php include("../view/include/footer.view.php"); ?>
    <script src="../data/js/jquery.scrollTo.min.js"></script>
    <script src="http://code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
    <script src="../data/js/agenda.js"></script>
    <script>
      $("#eventBeginingDate").datepicker();
      $("#eventEndingDate").datepicker();
      AgendaDate.setDate(
        <?= $data['day'] ?>,
        <?= $data['month'] ?>,
        <?= $data['year'] ?>
      );
      init();
    </script>
  </body>
</html>
