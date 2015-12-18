<!DOCTYPE html>
<html>
  <head>
    <?php include("../view/includ/includes.view.php"); ?>
    <link rel="stylesheet" href="../data/css/artiste.css">
    <title>Dælium - Evenement - <?= $data['evenement']['name']?></title>
  </head>
  <body>
    <?php include("../view/include/header.view.php"); ?>
    <section class="col-lg-offset-2 col-lg-8">
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
                <label class="control-label col-sm-4" for="nomevent">Nom de l'évènement :</label>
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
                <label class="control-label col-sm-4" for="img">Image officielle :</label>
                <div class="col-sm-8">
                  <input type="file" id="img" name="img"/>
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
        <input type="hidden" name="id" value="<?= $data['evenement']['id'] ?>"/>
        <input type="hidden" name="action" value="form2"/>
      </form>
    </section>
    <?php include("../view/include/footer.view.php"); ?>
    <script src="../data/js/jQuery.min.js"></script>
    <script src="../data/js/bootstrap.min.js"></script>
    <script src="https://apis.google.com/js/platform.js" async defer></script>
    <script src="../data/js/common.js"></script>
  </body>
</html>
