<?php
   if (!isset($data))
      header("Location:"."../");
?>
<!DOCTYPE html>
<html>
  <head>
    <?php include("../view/include/includes.view.php"); ?>
    <title>Dælium - Profil - Edition</title>
  </head>
  <body>
    <?php include("../view/include/header.view.php"); ?>
    <section class="col-lg-8 col-lg-offset-2">
      <form class="form-horizontal" role="form" method="post" action="../controler/profil_edit.ctrl.php?action=edit">
        <div class="col-lg-12">
          <div class="panel panel-default">
            <div class="panel-heading">Mon profil</div>
            <div class="panel-body">
              <div class="form-group">
                <label class="control-label col-sm-3" for="name">Nom *:</label>
                <div class="col-sm-9">
                  <input type="text" id="name" name="name" class="form-control" required placeholder="Nom" value="<?= $data['nom']?>"/>
                </div>
              </div>

              <div class="form-group">
                <label class="control-label col-sm-3" for="pname">Prenom *:</label>
                <div class="col-sm-9">
                  <input type="text" id="pname" name="pname" class="form-control" required placeholder="Prenom" value="<?= $data['prenom']?>"/>
                </div>
              </div>

              <div class="form-group">
                <label class="control-label col-sm-3" for="emailcompte">Email Compte :</label>
                <div class="col-sm-9">
                  <input type="email" id="emailc" name="emailcompte" class="form-control" value="<?= $data['emailcompte']?>"  readonly/>
                </div>
              </div>

              <div class="form-group">
                <label class="control-label col-sm-3" for="mail">Email Contact :</label>
                <div class="col-sm-9">
                  <input type="email" id="mail" name="mail" class="form-control"  value="<?= $data['email']?>"/>
                </div>
              </div>

              <div class="form-group">
                <label class="control-label col-sm-3" for="ntel">Numero de telephone :</label>
                <div class="col-sm-9">
                  <input type="tel" id="ntel" name="ntel" class="form-control" value="<?= $data['telephone']?>"/>
                </div>
              </div>

              <div class="form-group">
                <label class="control-label col-sm-3" for="adrr">Adresse :</label>
                <div class="col-sm-9 well">

                  <label class="control-label col-sm-2" for="adresse">Adresse :</label>
                  <div class="col-sm-10">
                    <input type="text" id="adresse" name="adresse"  class="form-control" value="<?= $data['adresse']?>" />
                  </div>
                  <label class="control-label col-sm-2" for="codepostal">Code postal :</label>
                  <div class="col-sm-2">
                    <input type="text" id="codepostal" name="codepostal"  class="form-control" value="<?= $data['codepostal']?>" />
                  </div>
                  <label class="control-label col-sm-2" for="ville">Ville * :</label>
                  <div class="col-sm-6">
                    <input type="text" id="ville" name="ville" required="required" class="form-control"value="<?= $data['ville']?>" />
                  </div>
                  <label class="control-label col-sm-2" for="region">Region :</label>
                  <div class="col-sm-4">
                    <input type="text" id="region" name="region"  class="form-control" value="<?= $data['region']?>" />
                  </div>
                  <label class="control-label col-sm-2" for="pays">Pays * :</label>
                  <div class="col-sm-4">
                    <input type="text" id="pays" name="pays" required="required" class="form-control"  value="<?= $data['pays']?>"/>
                  </div>
                  <label class="control-label col-sm-2" for="latitude">Latitude :</label>
                  <div class="col-sm-4">
                    <input type="text" id="latitude" name="latitude"  class="form-control" value="<?= $data['latitude']?>" />
                  </div>
                  <label class="control-label col-sm-2" for="longitude">Longitude :</label>
                  <div class="col-sm-4">
                    <input type="text" id="longitude" name="longitude" class="form-control"  value="<?= $data['longitude']?>"/>
                  </div>


                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-sm-3" for="des">Description :</label>
                <div class="col-sm-9">
                  <textarea id="des" name="des" class="form-control"><?= $data['des']?></textarea>
                </div>
              </div>
            </div>
          </div>
          <div class="pull-right">
            <a href="../controler/profil.ctrl.php" class="btn btn-default">Retour</a>
            <input class="btn btn-primary" type="submit"  value="Modifier">
          </div>
  </form>
    </section>
    <?php include("../view/include/footer.view.php"); ?>
  </body>
</html>
