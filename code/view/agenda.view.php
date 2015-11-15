<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <link rel="stylesheet" href="../data/css/bootstrap.css">
    <link rel="stylesheet" href="../data/css/agenda.css">
    <title>Dælium - Agenda</title>
  </head>
  <body>
    <?php include("../view/include/header.view.php"); ?>
    <section class="col-lg-12">
      <div class="row">
        <article class="col-lg-5 col-lg-offset-1">
          <div class="panel panel-default">
            <div class="panel-heading text-center">
              <div class='row'>
                  <div class='col-md-3 col-xs-4'>
                    <a class='ajax-navigation btn btn-default btn-sm' href='#'>
                      <span class='glyphicon glyphicon-arrow-left'></span>
                    </a>
                  </div>
                  <div class='col-md-6 col-xs-4'><strong>Novembre</strong></div>
                  <div class='col-md-3 col-xs-4 '>
                    <a class='ajax-navigation btn btn-default btn-sm' href='#'>
                      <span class='glyphicon glyphicon-arrow-right'></span>
                    </a>
                  </div>
                </div>
              </div>
            <div class="panel-body  calendar">
          <table id="calendar" class="table table-bordered col-lg-12 text-center">
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
              <tr><th>41</th> <td class="not-hover"></td>  <td class="not-hover"></td>  <td class="not-hover"></td>  <td class="not-hover"></td>  <td class="not-hover"></td>  <td class="not-hover"></td>  <td>1</td></tr>
              <tr><th>42</th> <td>2</td>  <td>3</td>  <td>4</td> <td>5</td> <td>6</td> <td>7</td> <td>8</td></tr>
              <tr><th>43</th> <td class="active">9</td> <td>10</td> <td>11</td> <td>12</td> <td>13</td> <td>14</td> <td>15</td></tr>
              <tr><th>44</th> <td>16</td> <td>17</td> <td>18</td> <td class="info">19</td> <td>20</td> <td>21</td> <td>22</td></tr>
              <tr><th>45</th> <td>23</td> <td>24</td> <td>25</td> <td>26</td> <td>27</td> <td>28</td> <td>29</td></tr>
              <tr><th>46</th> <td>30</td> <td class="not-hover"></td> <td class="not-hover"></td> <td class="not-hover"></td> <td class="not-hover"></td> <td class="not-hover"></td> <td class="not-hover"></td></tr>
            </tobdy>
          </table>
        </div>
      </div>
        </article>
        <article class="col-lg-5">
          <div class="panel panel-default">
            <div class="panel-heading">Prochains événements</div>
            <div class="panel-body evt" style="overflow:scroll;height:360px;overflow-x: hidden;">
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
                    <a class='ajax-navigation btn btn-default btn-sm' href='#'>
                      <span class='glyphicon glyphicon-arrow-left'></span>
                    </a>
                  </div>
                  <div class='col-md-6 col-xs-4'><strong>Vendredi 13 Novembre</strong></div>
                  <div class='col-md-3 col-xs-4 '>
                    <a class='ajax-navigation btn btn-default btn-sm' href='#'>
                      <span class='glyphicon glyphicon-arrow-right'></span>
                    </a>
                  </div>
                </div>
              </div>
              <div class="panel-body day" style="overflow:scroll;height:360px;overflow-x: hidden;">
          <table id="dayPlan" class="table table-hover table-striped table-bordered col-lg-12">
            <thead>
              <tr><th class="col-lg-1 text-right">Heure</th><th class="col-lg-11">Evenements</th></tr>
            </thead>
            <tbody>
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
            <div class="panel-heading"><input name="eventname" class="form-control" value="Un evenement"></div>
            <div class="panel-body">
          <form>
            <!-- Date debut -->
            <div class="form-inline">
              <label class="col-lg-2" for="eventBeginingDate">Début</label>
              <div class="col-lg-4 input-group">
                <input id="eventBeginingDate" name="eventBeginingDate" class="form-control" placeholder="Date" readonly/>
                <!-- je sugere ici de faire un type date -->
                <div class="input-group-btn">
                  <button class="btn btn-default"><span class="glyphicon glyphicon-calendar"></span></button>
                </div>
              </div>
              <div class="col-lg-4 input-group">
                <input id="eventBeginingHour" name="eventBeginingFour" class="form-control" placeholder="Heure" readonly/>
                <!-- je sugere ici de faire un type time -->
                <div class="input-group-btn">
                  <button class="btn btn-default"><span class="glyphicon glyphicon-time"></span></button>
                </div>
              </div>
            </div>
            <br/>
            <!-- Date Fin -->
            <div class="form-inline">
              <label class="col-lg-2" for="eventEndingDate">Fin</label>
              <div class="col-lg-4 input-group">
                <input id="eventEndingDate" name="eventEndingDate" class="form-control" placeholder="Date" readonly/>
                <div class="input-group-btn">
                  <button class="btn btn-default"><span class="glyphicon glyphicon-calendar"></span></button>
                </div>
              </div>
              <div class="col-lg-4 input-group">
                <input id="eventEndingHour" name="eventEndingFour" class="form-control" placeholder="Heure" readonly/>
                <div class="input-group-btn">
                  <button class="btn btn-default"><span class="glyphicon glyphicon-time"></span></button>
                </div>
              </div>
            </div>
            </br>
          </form>
        </div>
      </div>
        </article>
      </div>
    </section>
    <?php include("../view/include/footer.view.php"); ?>
    <script src="http://code.jquery.com/jquery-1.11.3.min.js"></script>
    <script src="../data/js/bootstrap.min.js"></script>
    <script src="../data/js/agenda.js"></script>
  </body>
</html>
