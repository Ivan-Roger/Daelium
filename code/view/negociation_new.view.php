<?php
   if (!isset($data))
      header("Location:"."../");
?>
<!DOCTYPE html>
<html>
<head>
  <?php include("../view/include/includes.view.php"); ?>
  <title>Dælium - Nouvelle - Negociation</title>
</head>
<body>
  <?php include("../view/include/header.view.php"); ?>
  <section class="col-lg-8 col-lg-offset-2">
    <form class="form-horizontal" role="form" method="post" action="../controler/negociation_new.ctrl.php?action=create">
      <div class="col-lg-12">
        <div class="panel panel-default">
          <div class="panel-heading">Nouvelle négociation pour <?= $data['type']?> "<b><?= $data['nom']?></b>"</div>
          <div class="panel-body">

            <div class="form-group">
              <label class="control-label col-sm-3" for="choix">Liste de mes <?= $data['typerech']?>s :</label>
              <div class="col-sm-9">
                <select name="choix" class=form-control>
                  <?php foreach ($data["list"] as $key => $value): ?>
                    <option  value=<?= $value["id"] ?>><?= $value["nom"] ?></option>
                  <?php endforeach; ?>
                </select>
                <input type="hidden" name="cible" value="<?= $data["id"] ?>">
              </div>
            </div>


              </div>
            </div>
            </div>
        <div class="pull-right">
          <a href="../controler/<?= $data["retour"] ?>_fiche.ctrl.php?id=<?= $data["id"] ?>" class="btn btn-default" >Retour</a>
          <input class="btn btn-primary" type="submit"  value="Negocier">
        </div>
      </form>
      </section>
      <?php include("../view/include/footer.view.php"); ?>
    </body>
    </html>
