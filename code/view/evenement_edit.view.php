<?php
if (!isset($data))
header("Location:"."../");
?>
<!DOCTYPE html>
<html>
<head>
  <?php include("../view/include/includes.view.php"); ?>
  <link rel="stylesheet" href="../data/css/artiste.css">
  <title>Dælium - Evenement - <?= $data['evenement']['nom']?></title>
</head>
<body>
  <?php include("../view/include/header.view.php"); ?>
  <section class="col-lg-offset-2 col-lg-8">
    <form class="form-horizontal" role="form" method="post" action="../controler/evenement.ctrl.php">
      <div class="col-lg-12">
        <div class="panel panel-default">
          <div class="panel-heading">Modification de l'evenement "<?= $data['evenement']['nom']?>"</div>
          <div class="panel-body">
            <div class="form-group">
              <label class="control-label col-sm-4" for="nomevent">Nom de l'évènement :</label>
              <div class="col-sm-8">
                <input id="nomevent" name="nomevent" class="form-control" required="required" value="<?= $data['evenement']['nom']?>"/>
              </div>
            </div>

            <div class="form-group">
              <label class="control-label col-sm-4" for="type">Type :</label>
              <div class="col-sm-8">
                <div class="btn-group" data-toggle="buttons" id="fonction">
                  <label class="btn btn-default <?php if($data['evenement']['type'] =="Concert"){echo "active";}  ?>">
                    <input type="radio" name="type" id="option1" value="Concert" <?php if($data['evenement']['type'] =="Concert"){echo "checked";}  ?>> Concert
                  </label>
                  <label class="btn btn-default <?php if($data['evenement']['type'] == "Festival"){echo "active";}  ?>">
                    <input type="radio" name="type" id="option2" value="Festival" <?php if($data['evenement']['type'] =="Festival"){echo "checked";}  ?>> Festival
                  </label>
                  <label class="btn btn-default <?php if($data['evenement']['type'] == "Mariage"){echo "active";}  ?>">
                    <input type="radio" name="type" id="option2" value="Mariage" <?php if($data['evenement']['type'] =="Mariage"){echo "checked";}  ?>> Mariage
                  </label>
                  <label class="btn btn-default <?php if($data['evenement']['type'] == "Fête de village"){echo "active";}  ?>">
                    <input type="radio" name="type" id="option2" value="Fête" <?php if($data['evenement']['type'] =="Fête de village"){echo "checked";}  ?>> Fête de village
                  </label>
                  <label class="btn btn-default <?php if($data['evenement']['type'] == "Autre"){echo "active";}  ?>">
                    <input type="radio" name="type" id="option2" value="Autre" <?php if($data['evenement']['type'] =="Autre"){echo "checked";}  ?>> Autre
                  </label>
                </div>
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-sm-4" for="autre">Si autre :</label>
              <div class="col-sm-8">
                <input type="text" id="autre" name="autre" class="form-control" value="<?= $data['evenement']['type'] ?>"/>
              </div>
            </div>

            <div class="form-group">
              <label class="control-label col-sm-4" for="dated">Genre :</label>
              <div class="col-sm-8">
                <input type="text" id="dated" name="dated" required="required" class="form-control" value="<?= $data['evenement']['genre'] ?>" />
              </div>
            </div>


            <div class="form-group">
              <label class="control-label col-sm-4" for="dated">Date de debut :</label>
              <div class="col-sm-8">
                <input type="date" id="dated" name="dated" required="required" class="form-control" value="<?= $data['evenement']['dated'] ?>" />
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-sm-4" for="datef">Date de fin :</label>
              <div class="col-sm-8">
                <input type="date" id="datef" name="datef" required="required" class="form-control" value="<?= $data['evenement']['datef'] ?>" />
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-sm-4" for="des">Description :</label>
              <div class="col-sm-8">
                <textarea id="des" name="des" class="form-control"> <?= $data['evenement']['description'] ?></textarea>
              </div>
            </div>

            <div class="form-group">
              <label class="control-label col-sm-4" for="des">Lieu :</label>
              <div class="col-sm-8 well">

                <label class="control-label col-sm-2" for="des">Adresse :</label>
                <div class="col-sm-10">
                  <input type="text" id="datef" name="datef" required="required" class="form-control" value="<?= $data['evenement']['lieu']['adresse'] ?>" />
                </div>
                <label class="control-label col-sm-2" for="des">Code postal :</label>
                <div class="col-sm-2">
                  <input type="text" id="datef" name="datef" required="required" class="form-control" value="<?= $data['evenement']['lieu']['codepostal'] ?>" />
                </div>
                <label class="control-label col-sm-2" for="des">Ville :</label>
                <div class="col-sm-6">
                  <input type="text" id="datef" name="datef" required="required" class="form-control" value="<?= $data['evenement']['lieu']['ville'] ?>" />
                </div>
                <label class="control-label col-sm-2" for="des">Region :</label>
                <div class="col-sm-4">
                  <input type="text" id="datef" name="datef" required="required" class="form-control" value="<?= $data['evenement']['lieu']['region'] ?>" />
                </div>
                <label class="control-label col-sm-2" for="des">Pays :</label>
                <div class="col-sm-4">
                  <input type="text" id="datef" name="datef" required="required" class="form-control" value="<?= $data['evenement']['lieu']['pays'] ?>" />
                </div>
                <label class="control-label col-sm-2" for="des">Latitude :</label>
                <div class="col-sm-4">
                  <input type="text" id="datef" name="datef" required="required" class="form-control" value="<?= $data['evenement']['lieu']['latitude'] ?>" />
                </div>
                <label class="control-label col-sm-2" for="des">Longitude :</label>
                <div class="col-sm-4">
                  <input type="text" id="datef" name="datef" required="required" class="form-control" value="<?=$data['evenement']['lieu']['longitude']?>" />
                </div>
              </div>

              <!--
              <div class="form-group">
              <label class="control-label col-sm-4" for="img">Image officielle :</label>
              <div class="col-sm-8">
              <input type="file" id="img" name="img"/>
            </div>
          </div>
        -->
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
</body>
</html>
