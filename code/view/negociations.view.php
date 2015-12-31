<?php
   if (!isset($data))
      header("Location:"."../");
?>
<!DOCTYPE html>
<html>
<head>
  <?php include("../view/include/includes.view.php"); ?>
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
              <?php foreach ($data['nego'] as $key => $value): ?>
                <tr>
                  <th><?= $value["nomgroupe"] ?></th>
                  <td><?= $value["nommanif"] ?></td>
                  <td><?= $value["villemanif"] ?></td>
                  <td><?= $value["datemanif"] ?></td>
                  <td><?= $value["etat"] ?></td>
                  <td>
                    <div class="btn-group" role="group" aria-label="...">
                      <a href="../controler/negociation.ctrl.php?id=<?= $value["id"] ?>" type="button" class="btn btn-default"><span class="glyphicon glyphicon-option-horizontal no-margin"></span></a>
                      <a href="" type="button" class="btn btn-default"><span class="glyphicon glyphicon-repeat no-margin"></a>
                      <button type="button" class="btn btn-default"><span class="glyphicon glyphicon-trash no-margin"></button>
                    </div>
                  </td>
                </tr>
              <?php endforeach; ?>
              </tobdy>
            </table>
          </div>
        </div>
      </article>
    </section>
    <?php include("../view/include/footer.view.php"); ?>
  </body>
</html>
