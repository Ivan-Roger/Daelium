<?php
   if (!isset($data))
      header("Location:"."../");
?>
<!DOCTYPE html>
<html>
<head>
  <?php include("../view/include/includes.view.php"); ?>
  <title>Dælium - Liste Utilisateurs</title>
</head>
<body>
  <?php include("../view/include/header.view.php"); ?>
  <section>
    <article class="col-lg-offset-1 col-lg-10">
      <div class="panel panel-default">
        <div class="panel-heading"><strong>Liste des utilisateurs presents sur le site</strong></div>
        <div class="panel-body table-responsive">
          <?php foreach ($data["users"] as $key => $value): ?>
            <div class="well">
              <?= $value->getNomComplet() ?> (<?= $value->getNomType() ?>)<div class="pull-right"> <a class="btn btn-primary" href="../controler/profil.ctrl.php?id=<?= $value->getIdPersonne() ?>">Voir Fiche</a></div>
            </div>
          <?php endforeach; ?>

          </div>
        </div>
      </article>
    </section>
    <?php include("../view/include/footer.view.php"); ?>
  </body>
</html>
