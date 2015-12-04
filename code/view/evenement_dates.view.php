<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <link rel="stylesheet" href="../data/css/bootstrap.css">
    <link rel="stylesheet" href="../data/css/artiste.css">
    <link rel="stylesheet" href="../data/css/common.css">
    <link rel="icon" type="image/png" href="../data/img/D.png" />
    <title>Dælium - Evenement - <?= $data['evenement']['name']?></title>
  </head>
  <body>
    <?php include("../view/include/header.view.php"); ?>
    <section class="col-lg-offset-2 col-lg-8">
      <!-- Pour chaque jour entre les deux date, demander les heure de debut et de fin de la programation -->
      <h3>Programmation des journées pour <?= $data['evenement']['name']?></h3>
      <form class="form-horizontal" role="form" method="post" action="../controler/evenement.ctrl.php">
        <?php foreach ($data['evenement']['dates'] as $date) { ?>
          <div class="col-lg-3">
            <div class="panel panel-default">
              <div class="panel-heading"><?= $date ?></div>
              <div class="panel-body">
                <div class="form-group">
                  <label class="control-label col-sm-6" for="autre">Debut :</label>
                  <div class="col-sm-6">
                    <input type="time" id="autre" name="autre" class="form-control" />
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label col-sm-6" for="autre">Fin :</label>
                  <div class="col-sm-6">
                    <input type="time" id="autre" name="autre" class="form-control" />
                  </div>
                </div>
              </div>
            </div>
          </div>
        <?php  } ?>
        <div class="col-lg-12"></div>
        <div class="pull-right">
          <a class ="btn btn-warning" href="../controler/evenements.ctrl.php"> Annuler </a>
          <input class="btn btn-primary" type="Submit"  value="Suivant">
        </div>
      </form>
    </section>
    <?php include("../view/include/footer.view.php"); ?>
    <script src="http://code.jquery.com/jquery-1.11.3.min.js"></script>
    <script src="../data/js/bootstrap.min.js"></script>
  </body>
</html>
