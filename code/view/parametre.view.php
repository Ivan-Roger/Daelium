<?php
   if (!isset($data))
      header("Location:"."../");
?>
<!DOCTYPE html>
<html>
  <head>
    <?php include("../view/include/includes.view.php"); ?>
    <title>Dælium - Paramètres</title>
  </head>
  <body>
    <?php include("../view/include/header.view.php"); ?>
    <section class="col-lg-8 col-lg-offset-2">
      <form class="form-horizontal" role="form" method="post" action="../controler/parametre.ctrl.php?action=edit">
        <div class="col-lg-12">
          <div class="panel panel-default">
            <div class="panel-heading">Mon Compte</div>
              <div class="form-group">
                <label class="control-label col-sm-3" for="emailc">Email Compte :</label>
                <div class="col-sm-9">
                  <input type="email" id="emailc" name="email" class="form-control" value=""  readonly/>
                </div>
              </div>

              <div class="form-group">
                <label class="control-label col-sm-3" for="nmdp">Nouveau mot de Passe :</label>
                <div class="col-sm-9">
                  <input type="text" id="nmdp" name="nmdp" class="form-control"  value=""/>
                </div>
              </div>

              <div class="form-group">
                <label class="control-label col-sm-3" for="cnmdp">Confirmation nouveau mot de Passe :</label>
                <div class="col-sm-9">
                  <input type="text" id="cnmdp" name="cnmdp" class="form-control"  value=""/>
                </div>
              </div>

              <div class="form-group">
                <label class="control-label col-sm-3" for="amdp">Ancien mot de Passe :</label>
                <div class="col-sm-9">
                  <input type="text" id="amdp" name="amdp" class="form-control"  value=""/>
                </div>
              </div>

            </div>
          </div>
          <div class="pull-right">
            <input class="btn btn-default" type="button" onclick="alert('Hello World!')" value="Annuler">
            <input class="btn btn-primary" type="submit" onclick="alert('Hello World!')" value="Modifier">
          </div>
  </form>
    </section>
    <?php include("../view/include/footer.view.php"); ?>
  </body>
</html>
