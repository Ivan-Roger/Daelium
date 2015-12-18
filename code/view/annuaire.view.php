<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8" />
  <link rel="stylesheet" href="../data/css/bootstrap.css">
  <link rel="stylesheet" href="../data/css/common.css">
  <link rel="stylesheet" href="../data/css/list.css">
  <link rel="icon" type="image/png" href="../data/img/D.png" />
  <title>Dælium - Annuaire</title>
</head>
<body>
  <?php include("../view/include/header.view.php"); ?>
  <section>
    <article class="col-lg-offset-1 col-lg-10">
      <div class="navbar navbar-form navbar-right">
        <div class="input-group">
          <input type="text" class="form-control"/>
          <div class="input-group-btn">
            <a href="#" class="btn btn-default">Rechercher</a>
          </div>
        </div>
        <button class="btn btn-primary" type="submit">Ajouter un Contact</button>
      </div>
    </article>
    <article class="col-lg-offset-1 col-lg-10">
      <div class="panel panel-warning">
        <div class="panel-heading"><strong>Contacts Favoris</strong></div>
        <div class="panel-body table-responsive">
          <table id="list" class="table table-bordered col-lg-12">
            <colgroup>
              <col/>
              <col/>
              <col/>
              <col/>
              <col/>
              <col class="col-lg-2"/>
            </colgroup>
            <thead>
              <tr><th>Nom / Prenom</th><th>Mail</th><th>Telephone</th><th>Description</th><th>Notes</th><th>Actions</th></tr>
            </thead>
            <tbody>
              <tr>
                <th>Jean Charle</th>
                <td>jean.c@gmail.com</td>
                <td>0600000000</td>
                <td>Organisateur du festival les rouge</td>
                <td>Serieux</td>
                <td>
                  <div class="btn-group" role="group" aria-label="...">
                    <button type="button" class="btn btn-default"><span class="glyphicon glyphicon-star-empty no-margin"></button>
                    <a href="messages.ctrl.php" type="button" class="btn btn-default"><span class="glyphicon glyphicon-envelope no-margin"></a>
                    <a href="profile.ctrl.php" type="button" class="btn btn-default"><span class="glyphicon glyphicon-user no-margin"></a>
                    <button type="button" class="btn btn-default"><span class="glyphicon glyphicon-pencil no-margin"></button>
                    <button type="button" class="btn btn-default"><span class="glyphicon glyphicon-trash no-margin"></button>
                  </div>
                </td>
                <tr><th>Alphonse</th> <td>alphonse@gmail.com</td>  <td>0600000000</td>  <td>Booker des TheWorld</td> <td>De confiance</td><td>
                  <div class="btn-group" role="group" aria-label="...">
                    <button type="button" class="btn btn-default"><span class="glyphicon glyphicon-star-empty no-margin"></button>
                    <a href="messages.ctrl.php" type="button" class="btn btn-default"><span class="glyphicon glyphicon-envelope no-margin"></a>
                    <a href="profile.ctrl.php" type="button" class="btn btn-default"><span class="glyphicon glyphicon-user no-margin"></a>
                    <button type="button" class="btn btn-default"><span class="glyphicon glyphicon-pencil no-margin"></button>
                    <button type="button" class="btn btn-default"><span class="glyphicon glyphicon-trash no-margin"></button>
                  </div></td></tr>
              </tobdy>
            </table>
          </div>
        </div>
      </article>
      <article class="col-lg-offset-1 col-lg-10 ">
        <div class="panel panel-default">
          <div class="panel-heading">
            <strong>Tout les contacts</strong>
          </div>
          <div class="panel-body">
            <ul class="nav nav-tabs" role="tablist">
              <li role="presentation" class="active"><a href="#all" aria-controls="all" role="tab" data-toggle="tab">Tous</a></li>
              <li role="presentation"><a href="#booker" aria-controls="booker" role="tab" data-toggle="tab">Bookers</a></li>
              <li role="presentation"><a href="#orga" aria-controls="orga" role="tab" data-toggle="tab">Organisateurs</a></li>
            </ul>
            <div class="tab-content">
              <div role="tabpanel" id="all" class="tab-pane active">
                <table class="table table-bordered">
                  <colgroup>
                    <col/>
                    <col/>
                    <col/>
                    <col/>
                    <col/>
                    <col class="col-lg-2"/>
                  </colgroup>
                  <thead>
                    <tr><th>Nom / Prenom</th><th>Mail</th><th>Telephone</th><th>Description</th><th>Notes</th><th>Actions</th></tr>
                  </thead>
                  <tbody>
                    <tr>
                      <th>Jean Charle</th>
                      <td>jean.c@gmail.com</td>
                      <td>0600000000</td>
                      <td>Organisateur du festival les rouge</td>
                      <td>Serieux</td>
                      <td>
                        <div class="btn-group" role="group" aria-label="...">
                          <button type="button" class="btn btn-default"><span class="glyphicon glyphicon-star no-margin"></button>
                          <a href="messages.ctrl.php" type="button" class="btn btn-default"><span class="glyphicon glyphicon-envelope no-margin"></a>
                          <a href="profile.ctrl.php" type="button" class="btn btn-default"><span class="glyphicon glyphicon-user no-margin"></a>
                          <button type="button" class="btn btn-default"><span class="glyphicon glyphicon-pencil no-margin"></button>
                          <button type="button" class="btn btn-default"><span class="glyphicon glyphicon-trash no-margin"></button>
                        </div>
                      </td>
                    </tr>
                    <tr><th>Alphonse</th> <td>alphonse@gmail.com</td>  <td>0600000000</td>  <td>Booker des TheWorld</td> <td>De confiance</td>
                      <td>
                        <div class="btn-group" role="group" aria-label="...">
                          <button type="button" class="btn btn-default"><span class="glyphicon glyphicon-star no-margin"></button>
                          <a href="messages.ctrl.php" type="button" class="btn btn-default"><span class="glyphicon glyphicon-envelope no-margin"></a>
                          <a href="profile.ctrl.php" type="button" class="btn btn-default"><span class="glyphicon glyphicon-user no-margin"></a>
                          <button type="button" class="btn btn-default"><span class="glyphicon glyphicon-pencil no-margin"></button>
                          <button type="button" class="btn btn-default"><span class="glyphicon glyphicon-trash no-margin"></button>
                        </div>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
              <div role="tabpanel" id="booker" class="tab-pane">
                <table class="table table-bordered">
                  <colgroup>
                    <col/>
                    <col/>
                    <col/>
                    <col/>
                    <col/>
                    <col class="col-lg-2"/>
                  </colgroup>
                  <thead>
                    <tr><th>Nom / Prenom</th><th>Mail</th><th>Telephone</th><th>Description</th><th>Notes</th><th>Actions</th></tr>
                  </thead>
                  <tbody>
                    <tr><th>Alphonse</th> <td>alphonse@gmail.com</td>  <td>0600000000</td>  <td>Booker des TheWorld</td> <td>De confiance</td>
                      <td>
                        <div class="btn-group" role="group" aria-label="...">
                          <button type="button" class="btn btn-default"><span class="glyphicon glyphicon-star no-margin"></button>
                          <a href="messages.ctrl.php" type="button" class="btn btn-default"><span class="glyphicon glyphicon-envelope no-margin"></a>
                          <a href="profile.ctrl.php" type="button" class="btn btn-default"><span class="glyphicon glyphicon-user no-margin"></a>
                          <button type="button" class="btn btn-default"><span class="glyphicon glyphicon-pencil no-margin"></button>
                          <button type="button" class="btn btn-default"><span class="glyphicon glyphicon-trash no-margin"></button>
                        </div>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
              <div role="tabpanel" id="orga" class="tab-pane">
                <table class="table table-bordered">
                  <colgroup>
                    <col/>
                    <col/>
                    <col/>
                    <col/>
                    <col/>
                    <col class="col-lg-2"/>
                  </colgroup>
                  <thead>
                    <tr><th>Nom / Prenom</th><th>Mail</th><th>Telephone</th><th>Description</th><th>Notes</th><th>Actions</th></tr>
                  </thead>
                  <tbody>
                    <tr>
                      <th>Jean Charle</th>
                      <td>jean.c@gmail.com</td>
                      <td>0699999999</td>
                      <td>Organisateur du festival les rouge</td>
                      <td>Serieux</td>
                      <td>
                        <div class="btn-group" role="group" aria-label="...">
                          <button type="button" class="btn btn-default"><span class="glyphicon glyphicon-star no-margin"></button>
                          <a href="messages.ctrl.php" type="button" class="btn btn-default"><span class="glyphicon glyphicon-envelope no-margin"></a>
                          <a href="profile.ctrl.php" type="button" class="btn btn-default"><span class="glyphicon glyphicon-user no-margin"></a>
                          <button type="button" class="btn btn-default"><span class="glyphicon glyphicon-pencil no-margin"></button>
                          <button type="button" class="btn btn-default"><span class="glyphicon glyphicon-trash no-margin"></button>
                        </div>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </article>
    </section>
    <?php include("../view/include/footer.view.php"); ?>
    <script src="../data/js/jQuery.min.js"></script>
    <script src="../data/js/bootstrap.min.js"></script>
    <script src="https://apis.google.com/js/platform.js" async defer></script>
    <script src="../data/js/common.js"></script>
  </body>
</html>
