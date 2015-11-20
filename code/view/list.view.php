<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8" />
  <link rel="stylesheet" href="../data/css/bootstrap.css">
  <link rel="stylesheet" href="../data/css/list.css">
  <title>Dælium - Annuaire</title>
</head>
<body>
  <?php include("../view/include/header.view.php"); ?>
  <section id="boutons" class="col-lg-offset-1 col-lg-10 ">
    <button class="btn btn-primary pull-right" type="submit">Ajouter un Contact</button>
  </section>

  <section class="col-lg-offset-1 col-lg-10 ">
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
                  <button type="button" class="btn btn-default"><span class="glyphicon glyphicon-star-empty"></button>
                  <button type="button" class="btn btn-default"><span class="glyphicon glyphicon-envelope"></button>
                  <button type="button" class="btn btn-default"><span class="glyphicon glyphicon-user"></button>
                  <button type="button" class="btn btn-default"><span class="glyphicon glyphicon-pencil"></button>
                  <button type="button" class="btn btn-default"><span class="glyphicon glyphicon-trash"></button>
                </div>
              </td>
              <tr><th>Alphonse</th> <td>alphonse@gmail.com</td>  <td>0600000000</td>  <td>Booker des TheWorld</td> <td>De confiance</td><td>
                <div class="btn-group" role="group" aria-label="...">
                  <button type="button" class="btn btn-default"><span class="glyphicon glyphicon-star-empty"></button>
                  <button type="button" class="btn btn-default"><span class="glyphicon glyphicon-envelope"></button>
                  <button type="button" class="btn btn-default"><span class="glyphicon glyphicon-user"></button>
                  <button type="button" class="btn btn-default"><span class="glyphicon glyphicon-pencil"></button>
                  <button type="button" class="btn btn-default"><span class="glyphicon glyphicon-trash"></button>
                </div></td></tr>
            </tobdy>
          </table>
        </div>
      </div>
    </section>
  <section class="col-lg-offset-1 col-lg-10 ">
    <div class="panel panel-default">
      <div class="panel-heading"><strong>Tout les contacts</strong></div>
      <div class="panel-body table-responsive">
        <table id="list" class="table table-bordered col-lg-12">
          <colgroup>
            <col/>
            <col/>
            <col/>
            <col/>
            <col/>
            <col class="col-lg-1"/>
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
              <td><table class="table table-bordered text-center">
                <tr>
                  <td><span class="glyphicon glyphicon-star"></span></td>
                  <td><span class="glyphicon glyphicon-envelope"></span></td>
                  <td><span class="glyphicon glyphicon-user"></span></td>
                  <td><span class="glyphicon glyphicon-pencil"></span></td>
                  <td><span class="glyphicon glyphicon-trash"></span></td>
                </tr>
              </table></td>
              <tr><th>Alphonse</th> <td>alphonse@gmail.com</td>  <td>0600000000</td>  <td>Booker des TheWorld</td> <td>De confiance</td><td><table class="table table-bordered text-center">
                <tr>
                  <td><span class="glyphicon glyphicon-star"></span></td>
                  <td><span class="glyphicon glyphicon-envelope"></span></td>
                  <td><span class="glyphicon glyphicon-user"></span></td>
                  <td><span class="glyphicon glyphicon-pencil"></span></td>
                  <td><span class="glyphicon glyphicon-trash"></span></td>
                </tr>
              </table></td></tr>
            </tobdy>
          </table>
        </div>
      </div>
    </section>
    <?php include("../view/include/footer.view.php"); ?>
    <script src="http://code.jquery.com/jquery-1.11.3.min.js"></script>
    <script src="../data/js/bootstrap.min.js"></script>
  </body>
  </html>
