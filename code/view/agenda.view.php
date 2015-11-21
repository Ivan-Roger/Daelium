<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <link rel="stylesheet" href="../data/css/bootstrap.css">
    <link rel="stylesheet" href="../data/css/common.css">
    <link rel="stylesheet" href="../data/css/agenda.css">
    <link rel="stylesheet" href="http://code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
    <link rel="icon" type="image/png" href="../data/img/D.png" />
    <title>Dælium - Agenda</title>
  </head>
  <body>
    <?php include("../view/include/header.view.php"); ?>
    <section class="col-lg-12">
      <div class="row">
        <article id="calendarArticle" class="col-lg-5 col-lg-offset-1">
          <div class="panel panel-default">
            <div class="panel-heading text-center">
              <div class='row'>
                <div class='col-md-3 col-xs-4'>
                  <button id="calendarPrev" class='ajax-navigation btn btn-default btn-sm'>
                    <span class='glyphicon glyphicon-arrow-left'></span>
                  </button>
                </div>
                <div class='col-md-6 col-xs-4'><strong id="calendarTitle"><?= $data['monthName'] ?> <?= $data['year'] ?></strong></div>
                <div class='col-md-3 col-xs-4 '>
                  <button id="calendarNext" class='ajax-navigation btn btn-default btn-sm'>
                    <span class='glyphicon glyphicon-arrow-right'></span>
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
                  <tr>
                    <th><?= $week['id'] ?></th>
                    <td<?php echo(($week['days'][0]>0?($week['days'][0]==$today?" class='info'>".$week['days'][0]:">".$week['days'][0]):" class='not-hover'>")); ?></td>
                    <td<?php echo(($week['days'][1]>0?($week['days'][1]==$today?" class='info'>".$week['days'][1]:">".$week['days'][1]):" class='not-hover'>")); ?></td>
                    <td<?php echo(($week['days'][2]>0?($week['days'][2]==$today?" class='info'>".$week['days'][2]:">".$week['days'][2]):" class='not-hover'>")); ?></td>
                    <td<?php echo(($week['days'][3]>0?($week['days'][3]==$today?" class='info'>".$week['days'][3]:">".$week['days'][3]):" class='not-hover'>")); ?></td>
                    <td<?php echo(($week['days'][4]>0?($week['days'][4]==$today?" class='info'>".$week['days'][4]:">".$week['days'][4]):" class='not-hover'>")); ?></td>
                    <td<?php echo(($week['days'][5]>0?($week['days'][5]==$today?" class='info'>".$week['days'][5]:">".$week['days'][5]):" class='not-hover'>")); ?></td>
                    <td<?php echo(($week['days'][6]>0?($week['days'][6]==$today?" class='info'>".$week['days'][6]:">".$week['days'][6]):" class='not-hover'>")); ?></td>
                  </tr>
                  <?php } ?>
                </tbody>
              </table>
            </div>
          </div>
        </article>
        <article class="col-lg-5" style="height:400px;">
          <div class="panel panel-default">
            <div class="panel-heading">Prochains événements</div>
            <div id="sanspadding" class="panel-body table-responsive evt" style="overflow:auto;height:450px;overflow-x: hidden;">
              <table id="commingNext" class="table table-striped table-hover table-bordered col-lg-12">
                <colgroup>
                  <col class="text-center col-lg-2" />
                  <col class="col-lg-10"/>
                </colgroup>
                <thead>
                  <tr><th>Date / Heure</th> <th>Evenements</th></tr>
                </thead>
                <tbody>
                  <tr><td>14/11/2015</td> <td>Création agenda</td></tr>
                  <tr><td>24/11/2015</td> <td>Rendez-vous Dælium</td></tr>
                </tbody>
              </table>
            </div>
          </div>
        </article>
      </div>
      <div class="row">
        <article class="col-lg-5 col-lg-offset-1">
          <div class="panel panel-default">
            <div class="panel-heading text-center">
              <div class='row'>
                <div class='col-md-3 col-xs-4'>
                  <button id="dayPlanPrev" class='ajax-navigation btn btn-default btn-sm'>
                    <span class='glyphicon glyphicon-arrow-left'></span>
                  </button>
                </div>
                <div class='col-md-6 col-xs-4'>
                  <strong id="dayPlanTitle"><?= $data['wdayName'] ?> <?= $data['day'] ?> <?= $data['monthName'] ?></strong>
                </div>
                <div class='col-md-3 col-xs-4 '>
                  <button id="dayPlanNext" class='ajax-navigation btn btn-default btn-sm'>
                    <span class='glyphicon glyphicon-arrow-right'></span>
                  </button>
                </div>
              </div>
            </div>
            <div id="sanspadding" class="panel-body table-responsive" style="height:605px;">
              <table id="dayPlan" class="table table-hover table-striped table-bordered col-lg-12">
                <thead>
                  <tr><th class="col-lg-1 text-right">Heure</th><th class="col-lg-11">Evenements</th></tr>
                </thead>
                <tbody class="overflow:auto;overflow-x: hidden;">
                  <?php for($i=1 ; $i<=24 ; $i++){ ?>
                    <tr><td class="text-center" ><?= $i ?>h</td><td></td></tr>
                  <?php } ?>
                </tbody>
              </table>
            </div>
          </div>
        </article>
        <article class="col-lg-5">
          <div class="panel panel-default">
            <div class="panel-heading">
              <div class="input-group">
                <input name="eventname" class="form-control input-lg" value="Nouvel évènement">
                <div class="input-group-btn">
                  <button class="btn btn-lg btn-default"><span class="glyphicon glyphicon-share"></span></button>
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
                      <span class="glyphicon glyphicon-calendar"></span>
                    </div>
                  </div>
                  <div class="col-lg-4 input-group">
                    <input id="eventBeginingHour" name="eventBeginingFour" class="form-control" placeholder="Heure" readonly/>
                    <!-- je sugere ici de faire un type time -->
                    <div class="input-group-addon">
                      <span class="glyphicon glyphicon-time"></span>
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
                      <span class="glyphicon glyphicon-calendar"></span>
                    </div>
                  </div>
                  <div class="col-lg-4 input-group">
                    <input id="eventEndingHour" name="eventEndingFour" class="form-control" placeholder="Heure" readonly/>
                    <div class="input-group-addon">
                      <span class="glyphicon glyphicon-time"></span>
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
                      <button class="btn btn-default"><span class="glyphicon glyphicon-flag"></span></button>
                    </div>
                  </div>
                </div>
                </br>
                <div class="form-inline">
                  <label class="col-lg-2" for="eventParticipants">Participants</label>
                  <div class="col-lg-9 input-group">
                    <input class="form-control" type="text" name="eventParticipants" id="eventParticipants" placeholder="Participants"/>
                    <div class="input-group-btn">
                      <button class="btn btn-default"><span class="glyphicon glyphicon-book"></span></button>
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
    <script src="http://code.jquery.com/jquery-1.11.3.min.js"></script>
    <script src="http://code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
    <script src="../data/js/bootstrap.min.js"></script>
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
