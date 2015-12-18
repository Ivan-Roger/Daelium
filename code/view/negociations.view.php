<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8" />
  <link rel="stylesheet" href="../data/css/bootstrap.css">
  <link rel="stylesheet" href="../data/css/common.css">
  <link rel="icon" type="image/png" href="../data/img/D.png" />
  <title>Dælium - Annuaire</title>
</head>
<body>
  <?php include("../view/include/header.view.php"); ?>
  <section>
    <article class="col-lg-offset-1 col-lg-10">
      <div class="panel panel-default">
        <div class="panel-heading"><strong>Mes Negociation</strong></div>
        <div class="panel-body table-responsive">
          <table id="list" class="table table-bordered col-lg-12">
            <colgroup>
              <col/>
              <col/>
              <col/>
              <col/>
              <col/>
              <col/>
            </colgroup>
            <thead>
              <tr><th>Nom du Groupe</th><th>Nom de la Manifestation</th><th>Lieu de la Manifestation</th><th>Date de la Manifestation</th><th>Etat</th><th>Actions</th></tr>
            </thead>
            <tbody>
              <tr>
                <th>Les Chamions</th>
                <td>Festival des Rouges</td>
                <td>Paris</td>
                <td>12 Juin 2016</td>
                <td>En cours</td>
                <td>
                  <div class="btn-group" role="group" aria-label="...">
                    <a href="../controler/negociation.ctrl.php" type="button" class="btn btn-default"><span class="glyphicon glyphicon-option-horizontal no-margin"></span></a>
                    <a href="" type="button" class="btn btn-default"><span class="glyphicon glyphicon-repeat no-margin"></a>
                    <button type="button" class="btn btn-default"><span class="glyphicon glyphicon-trash no-margin"></button>
                  </div>
                </td>
              </tr>
                <tr><th>Les Chamions</th>
                <td>Festival des Rouges</td>
                <td>Paris</td>
                <td>12 Juin 2016</td>
                <td>Passé</td><td>
                  <div class="btn-group" role="group" aria-label="...">
                    <button type="button" class="btn btn-default"><span class="glyphicon glyphicon-option-horizontal no-margin"></button>
                    <a href="" type="button" class="btn btn-default"><span class="glyphicon glyphicon-repeat no-margin"></a>
                    <button type="button" class="btn btn-default"><span class="glyphicon glyphicon-trash no-margin"></button>
                  </div>
                  </div></td>
                </tr>
                  <tr><th>Les Chamions</th>
                  <td>Festival des Rouges</td>
                  <td>Paris</td>
                  <td>12 Juin 2016</td>
                  <td>Terminé</td><td>
                    <div class="btn-group" role="group" aria-label="...">
                      <button type="button" class="btn btn-default"><span class="glyphicon glyphicon-option-horizontal no-margin"></button>
                      <a href="" type="button" class="btn btn-default"><span class="glyphicon glyphicon-repeat no-margin"></a>
                      <button type="button" class="btn btn-default"><span class="glyphicon glyphicon-trash no-margin"></button>
                    </div>
                    </div></td></tr>
                    <tr><th>Les Chamions</th>
                    <td>Festival des Rouges</td>
                    <td>Paris</td>
                    <td>12 Juin 2016</td>
                    <td>Negocié</td><td>
                      <div class="btn-group" role="group" aria-label="...">
                        <button type="button" class="btn btn-default"><span class="glyphicon glyphicon-option-horizontal no-margin"></button>
                        <a href="" type="button" class="btn btn-default"><span class="glyphicon glyphicon-repeat no-margin"></a>
                        <button type="button" class="btn btn-default"><span class="glyphicon glyphicon-trash no-margin"></button>
                      </div>
                      </div></td></tr>
              </tobdy>
            </table>
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
