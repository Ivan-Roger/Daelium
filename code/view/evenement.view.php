<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8" />
  <link rel="stylesheet" href="../data/css/bootstrap.css">
  <link rel="stylesheet" href="../data/css/artiste.css">
  <link rel="stylesheet" href="../data/css/common.css">
  <link rel="icon" type="image/png" href="../data/img/D.png" />
  <title>Dælium - Artiste - <?= $data['evenement']['nom']?></title>
</head>
<body>
  <?php include("../view/include/header.view.php"); ?>
  <section class="col-lg-offset-2 col-lg-8">
    <?php if($data["vue"] == "fiche"){ ?>
      <div>
        <h1><?= $data['evenement']['nom']?></h1>
        <div>
          <a class ="btn btn-default" href="../controler/artistes.ctrl.php"> Retour </a>
        </div>
      </div>
    <?php } elseif($data["vue"] == "form"){ ?>
      <form class="form-horizontal" role="form" method="post" action="../controler/evenement.ctrl.php">
        <div class="col-lg-12">
          <div class="panel panel-default">
            <div class="panel-heading">Creation evenement</div>
            <div class="panel-body">
              <div class="form-group">
                <label class="control-label col-sm-4" for="before">J'ai deja organisé cet evenement :</label>
                <div class="col-sm-8">
                  <div class="btn-group" data-toggle="buttons" id="fonction">
                    <label class="btn btn-default active">
                      <input type="radio" name="before" id="option1" value="ar" checked> Non
                    </label>
                    <label class="btn btn-default">
                      <input type="radio" name="before" id="option2" value="gr"> Oui
                      <!-- Si oui affiche une liste deroulante.-->
                    </label>
                    </label>
                  </div>
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-sm-4" for="nomevent">Nom de l'evenement :</label>
                <div class="col-sm-8">
                  <input id="nomevent" name="nomevent" class="form-control" required="required" placeholder="Nom de l'evenement"/>
                </div>
              </div>

              <div class="form-group">
                <label class="control-label col-sm-4" for="type">Type :</label>
                <div class="col-sm-8">
                  <div class="btn-group" data-toggle="buttons" id="fonction">
                    <label class="btn btn-default active">
                      <input type="radio" name="type" id="option1" value="Concert" checked> Concert
                    </label>
                    <label class="btn btn-default">
                      <input type="radio" name="type" id="option2" value="Festival"> Festival
                    </label>
                    <label class="btn btn-default">
                      <input type="radio" name="type" id="option2" value="Mariage"> Mariage
                    </label>
                    <label class="btn btn-default">
                      <input type="radio" name="type" id="option2" value="Fête"> Fête de village
                    </label>
                    <label class="btn btn-default">
                      <input type="radio" name="type" id="option2" value="Autre"> Autre
                    </label>
                  </div>
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-sm-4" for="autre">Si autre :</label>
                <div class="col-sm-8">
                  <input type="text" id="autre" name="autre" class="form-control" />
                </div>
              </div>

              <div class="form-group">
                <label class="control-label col-sm-4" for="dated">Date de debut :</label>
                <div class="col-sm-8">
                  <input type="date" id="dated" name="dated" required="required" class="form-control" />
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-sm-4" for="datef">Date de fin :</label>
                <div class="col-sm-8">
                  <input type="date" id="datef" name="datef" required="required" class="form-control" />
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-sm-4" for="des">Description :</label>
                <div class="col-sm-8">
                  <textarea id="des" name="des" class="form-control"> </textarea>
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-sm-4" for="img">Image Officiel :</label>
                <div class="col-sm-8">
                  <input type="file" id="img" name="img" class="form-control"/>
                </div>
              </div>

              <div class="pull-right">
                <input class="btn btn-default" type="button"  value="Annuler">
                <input class="btn btn-primary" type="Submit"  value="Suivant">
              </div>
            </div>
          </div>
        </div>
        <!-- Si groupe alors Demander plusieurs fois les infos sur les different membres -->

      </form>

      <?php }elseif($data["vue"] == "next") { ?>
        <!-- Pour chaque jour entre les deux date, demander les heure de debut et de fin de la programation -->
        <h3>Programation des journées pour <?= $data['evenement']['nom']?></h3>
        <form class="form-horizontal" role="form" method="post" action="../controler/evenement.ctrl.php">
        <?php foreach ($data['evenement']['dates'] as $key => $value) { ?>
          <div class="col-lg-3">
            <div class="panel panel-default">
              <div class="panel-heading"><?= $value ?></div>
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
      <?php }else { ?>
        <h1>Erreur 404</h1>
        <p>L'evenement n'existe pas</p>
        <?php  } ?>
      </section>
      <?php include("../view/include/footer.view.php"); ?>
      <script src="http://code.jquery.com/jquery-1.11.3.min.js"></script>
      <script src="../data/js/bootstrap.min.js"></script>
    </body>
    </html>
