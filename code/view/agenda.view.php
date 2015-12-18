<!DOCTYPE html>
<html>
  <head>
    <?php include("../view/include/includes.view.php"); ?>
    <link rel="stylesheet" href="../data/css/agenda.css">
    <title>Dælium - Agenda</title>
  </head>
  <body>
    <?php include("../view/include/header.view.php"); ?>
    <section class="col-lg-12">
      <div class="row">
        <article id="calendarArticle" class="col-lg-5 col-lg-offset-1"> <!-- =============================================== Calendar =============================================== -->
          <div class="panel panel-default">
            <div class="panel-heading text-center">
              <div class='row'>
                <div class='col-md-3 col-xs-4'>
                  <button id="calendarPrev" class='ajax-navigation btn btn-default btn-sm'>
                    <span class='glyphicon glyphicon-arrow-left no-margin'></span>
                  </button>
                </div>
                <div class='col-md-6 col-xs-4'><h4 id="calendarTitle"><?= $data['monthName'] ?> <?= $data['year'] ?></h4></div>
                <div class='col-md-3 col-xs-4 '>
                  <button id="calendarNext" class='ajax-navigation btn btn-default btn-sm'>
                    <span class='glyphicon glyphicon-arrow-right no-margin'></span>
                  </button>
                </div>
              </div>
            </div>
            <div class="panel-body table-responsive calendar no-padding" style="height:450px;">
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
                  <?php
                  $today = (($data['date']['month']==$data['month'] && $data['date']['year']==$data['year'])?$data['date']['day']:null);
                  foreach($data['calendar'] as $week) { ?>
                  <tr data-week="<?= $week['id'] ?>">
                    <th><?= $week['id'] ?></th>
                    <td data-day="<?= $week['days'][0] ?>" class="<?php echo($week['days'][0]<=0?"not-hover ":"day "); ?><?php echo($week['days'][0]==$today?"info ":""); ?>">
                      <?= $week['days'][0] ?>
                    </td>
                    <td data-day="<?= $week['days'][1] ?>" class="<?php echo($week['days'][1]<=0?"not-hover ":"day "); ?><?php echo($week['days'][1]==$today?"info ":""); ?>">
                      <?= $week['days'][1] ?></td>
                    <td data-day="<?= $week['days'][2] ?>" class="<?php echo($week['days'][2]<=0?"not-hover ":"day "); ?><?php echo($week['days'][2]==$today?"info ":""); ?>">
                      <?= $week['days'][2] ?>
                    </td>
                    <td data-day="<?= $week['days'][3] ?>" class="<?php echo($week['days'][3]<=0?"not-hover ":"day "); ?><?php echo($week['days'][3]==$today?"info ":""); ?>">
                      <?= $week['days'][3] ?>
                    </td>
                    <td data-day="<?= $week['days'][4] ?>" class="<?php echo($week['days'][4]<=0?"not-hover ":"day "); ?><?php echo($week['days'][4]==$today?"info ":""); ?>">
                      <?= $week['days'][4] ?>
                    </td>
                    <td data-day="<?= $week['days'][5] ?>" class="<?php echo($week['days'][5]<=0?"not-hover ":"day "); ?><?php echo($week['days'][5]==$today?"info ":""); ?>">
                      <?= $week['days'][5] ?>
                    </td>
                    <td data-day="<?= $week['days'][6] ?>" class="<?php echo($week['days'][6]<=0?"not-hover ":"day "); ?><?php echo($week['days'][6]==$today?"info ":""); ?>">
                      <?= $week['days'][6] ?>
                    </td>
                  </tr>
                  <?php } ?>
                </tbody>
              </table>
              <button id="calendarResetToday" class="btn btn-default"><span class="glyphicon glyphicon-time"></span>Aujourd'hui</button>
            </div>
          </div>
        </article>
        <article class="col-lg-5" style="height:400px;"> <!-- =============================================== Comming Next =============================================== -->
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
      </div>
      <div class="row">
        <article class="col-lg-5 col-lg-offset-1"> <!-- =============================================== Day Plan =============================================== -->
          <div class="panel panel-default">
            <div class="panel-heading text-center">
              <div class='row'>
                <div class='col-md-3 col-xs-4'>
                  <button id="dayPlanPrev" class='ajax-navigation btn btn-default btn-sm'>
                    <span class='glyphicon glyphicon-arrow-left no-margin'></span>
                  </button>
                </div>
                <div class='col-md-6 col-xs-4'>
                  <h4 id="dayPlanTitle"><?= $data['wdayName'] ?> <?= $data['day'] ?> <?= $data['monthName'] ?></h4>
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
        <article class="col-lg-5"> <!-- =============================================== Event Form =============================================== -->
          <div class="panel panel-default">
            <div class="panel-heading">
              <div class="input-group">
                <input name="eventname" class="form-control input-lg" value="Nouvel évènement">
                <div class="input-group-btn">
                  <button class="btn btn-lg btn-default"><span class="glyphicon glyphicon-share no-margin"></span></button>
                </div>
              </div>
            </div>
            <div class="panel-body">
              <form>
                <!-- Date debut -->
                <div class="form-inline">
                  <label class="col-lg-2" for="eventBeginingDate">Début</label>
                  <div class="col-lg-4 input-group">
                    <input id="eventBeginingDate" name="eventBeginingDate" class="form-control" placeholder="Date"/>
                    <!-- je sugere ici de faire un type date -->
                    <div class="input-group-addon">
                      <span class="glyphicon glyphicon-calendar no-margin"></span>
                    </div>
                  </div>
                  <div class="col-lg-4 input-group">
                    <input id="eventBeginingHour" name="eventBeginingFour" class="form-control" placeholder="Heure" readonly/>
                    <!-- je sugere ici de faire un type time -->
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
                  <div class="col-lg-4 input-group">
                    <input id="eventEndingHour" name="eventEndingFour" class="form-control" placeholder="Heure" readonly/>
                    <div class="input-group-addon">
                      <span class="glyphicon glyphicon-time no-margin"></span>
                    </div>
                  </div>
                </div>
                </br>
                <div class="form-inline">
                  <div class="col-lg-9 col-lg-offset-2 checkbox">
                    <label>
                      <input type="checkbox" name="eventDayLong"/>
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
                    <button class="btn btn-default" name="eventReminder" id="eventReminder">Ajouter un rappel</button>
                  </div>
                </div>
                </br>
                <div class="form-inline">
                  <label class="col-lg-2" for="eventMore">Plus</label>
                  <div class="col-lg-8 input-group">
                    <button class="btn btn-default" name="eventMore" id="eventMore">Ajouter un champ</button>
                  </div>
                </div>
                </br>
                <div class="form-inline text-right">
                  <button class="btn btn-primary">Sauvegarder</button>
                  <button class="btn btn-default">Annuler</button>
                </div>
              </form>
            </div>
          </div>
        </article>
      </div>
    </section>
    <?php include("../view/include/footer.view.php"); ?>
    <script src="../data/js/jQuery.min.js"></script>
    <script src="http://code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
    <script src="../data/js/bootstrap.min.js"></script>
    <script src="https://apis.google.com/js/platform.js" async defer></script>
    <script src="../data/js/common.js"></script>
    <script src="../data/js/agenda.js"></script>
    <script>
      $("#eventBeginingDate").datepicker();
      $("#eventEndingDate").datepicker();
      AgendaDate.set(
        <?= $data['wday'] ?>,
        <?= $data['day'] ?>,
        <?= $data['month'] ?>,
        <?= $data['year'] ?>,
        <?= $data['mlength'] ?>
      );
    </script>
  </body>
</html>
