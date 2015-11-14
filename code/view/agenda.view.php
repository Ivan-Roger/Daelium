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
          <p>Calendrier ...</p>
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
              <tr><th>41</th> <td>1</td>  <td>2</td>  <td>3</td>  <td>4</td>  <td>5</td>  <td>6</td>  <td>7</td></tr>
              <tr><th>42</th> <td>8</td>  <td>9</td>  <td>10</td> <td>10</td> <td>11</td> <td>12</td> <td>13</td></tr>
              <tr><th>43</th> <td class="active">14</td> <td>15</td> <td>16</td> <td>17</td> <td>18</td> <td>19</td> <td>20</td></tr>
              <tr><th>44</th> <td>21</td> <td>22</td> <td>23</td> <td class="info">24</td> <td>25</td> <td>26</td> <td>27</td></tr>
              <tr><th>45</th> <td>28</td> <td>29</td> <td>30</td> <td>31</td> <td></td> <td></td> <td></td></tr>
            </tobdy>
          </table>
        </article>
        <article class="col-lg-5">
          <p>Prochains événements ...</p>
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
              <tr><td></td> <td></td></tr>
              <tr><td></td> <td></td></tr>
              <tr><td></td> <td></td></tr>
              <tr><td></td> <td></td></tr>
              <tr><td></td> <td></td></tr>
              <tr><td></td> <td></td></tr>
              <tr><td></td> <td></td></tr>
            </tbody>
          </table>
        </article>
      </div>
      <div class="row">
        <article class="col-lg-5 col-lg-offset-1">
          <p>Planning journée ...</p>
          <table id="dayPlan" class="table table-hover table-striped table-bordered col-lg-12">
            <thead>
              <tr><th class="col-lg-1 text-right">Heure</th><th class="col-lg-11">Evenements</th></tr>
            </thead>
            <tbody>
              <tr><td class="text-center">8h</td><td></td></tr>
              <tr><td class="text-center">9h</td><td></td></tr>
              <tr><td class="text-center">10h</td><td></td></tr>
              <tr><td class="text-center">11h</td><td></td></tr>
              <tr><td class="text-center">12h</td><td></td></tr>
              <tr><td class="text-center">13h</td><td></td></tr>
              <tr><td class="text-center">14h</td><td></td></tr>
              <tr><td class="text-center">15h</td><td></td></tr>
              <tr><td class="text-center">16h</td><td></td></tr>
              <tr><td class="text-center">17h</td><td></td></tr>
              <tr><td class="text-center">18h</td><td></td></tr>
              <tr><td class="text-center">19h</td><td></td></tr>
            </tbody>
          </table>
        </article>
        <article class="col-lg-5">
          <p>(Modifier, Ajouter) Evénement ...</p>
          <h2 class="col-lg-12">Création agenda</h2>
          <form>
            <div class="form-inline">
              <label class="col-lg-2" for="eventBeginingDate">Début</label>
              <div class="col-lg-4 input-group">
                <input id="eventBeginingDate" name="eventBeginingDate" class="form-control" placeholder="Date" readonly/>
                <div class="input-group-btn">
                  <button class="btn btn-default"><span class="glyphicon glyphicon-calendar"></span></button>
                </div>
              </div>
              <div class="col-lg-4 input-group">
                <input id="eventBeginingHour" name="eventBeginingFour" class="form-control" placeholder="Heure" readonly/>
                <div class="input-group-btn">
                  <button class="btn btn-default"><span class="glyphicon glyphicon-time"></span></button>
                </div>
              </div>
            </div>
            <br/>
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
          </form>
        </article>
      </div>
    </section>
    <?php include("../view/include/footer.view.php"); ?>
    <script src="http://code.jquery.com/jquery-1.11.3.min.js"></script>
    <script src="../data/js/bootstrap.min.js"></script>
    <script src="../data/js/agenda.js"></script>
  </body>
</html>
