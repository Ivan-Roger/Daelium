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
    <form class="form-horizontal" role="form" method="post" action="../controler/evenement_edit.ctrl.php?action=edit">
      <div class="col-lg-12">
        <div class="panel panel-default">
          <div class="panel-heading">Modification de l'evenement "<?= $data['evenement']['nom']?>"</div>
          <div class="panel-body">
            <div class="form-group">
              <label class="control-label col-sm-4" for="nomevent">Nom de l'évènement *:</label>
              <div class="col-sm-8">
                <input id="nomevent" name="nomevent" class="form-control" required="required" placeholder="Un évènement" value="<?= $data['evenement']['nom']?>"/>
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
              <label class="control-label col-sm-4" for="genre">Genre :</label>
              <div class="col-sm-8">
                <input type="text" id="genre" name="genre"  class="form-control" placeholder="Pop,Rock,Electro" value="<?= $data['evenement']['genre'] ?>" />
              </div>
            </div>


            <div class="form-group">
              <label class="control-label col-sm-4" for="dated">Date de debut *:</label>
              <div class="col-sm-8">
                <input type="date" id="dated" name="dated" required="required" class="form-control" value="<?= $data['evenement']['dated'] ?>" />
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-sm-4" for="datef">Date de fin *:</label>
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
              <label class="control-label col-sm-4" for="des">Lieu *:</label>
              <div class="col-sm-8 well">

                <label class="control-label col-sm-2" for="adresse">Adresse *:</label>
                <div class="col-sm-10">
                  <input type="text" id="adresse" name="adresse" required="required" class="form-control" value="<?= $data['evenement']['lieu']['adresse'] ?>" />
                </div>
                <label class="control-label col-sm-2" for="codepostal">Code postal *:</label>
                <div class="col-sm-2">
                  <input type="text" id="codepostal" name="codepostal" required="required" class="form-control" value="<?= $data['evenement']['lieu']['codepostal'] ?>"/>
                </div>
                <label class="control-label col-sm-2" for="ville">Ville *:</label>
                <div class="col-sm-6">
                  <input type="text" id="ville" name="ville" required="required" class="form-control" value="<?= $data['evenement']['lieu']['ville'] ?>" />
                </div>
                <label class="control-label col-sm-2" for="region">Region :</label>
                <div class="col-sm-4">
                  <input type="text" id="region" name="region"  class="form-control" value="<?= $data['evenement']['lieu']['pays'] ?>" />
                </div>
                <label class="control-label col-sm-2" for="pays">Pays *:</label>
                <div class="col-sm-4">
                  <input type="text" id="pays" name="pays" required="required" class="form-control" value="<?= $data['evenement']['lieu']['region'] ?>" />
                </div>
                <label class="control-label col-sm-2" for="latitude">Latitude :</label>
                <div class="col-sm-4">
                  <input type="text" id="latitude" name="latitude"  class="form-control" value="<?= $data['evenement']['lieu']['latitude'] ?>" />
                </div>
                <label class="control-label col-sm-2" for="longitude">Longitude :</label>
                <div class="col-sm-4">
                  <input type="text" id="longitude" name="longitude" class="form-control" value="<?= $data['evenement']['lieu']['longitude'] ?>" />
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
        <input type="hidden" name="idmanif" value="<?= $data['evenement']['id'] ?>"/>
        <div class="pull-right">
          <input class="btn btn-default" type="button"  value="Retour">
          <input class="btn btn-primary" type="Submit"  value="Modifier">
        </div>
      </div>
    </div>
  </div>
</form>
</section>
<?php include("../view/include/footer.view.php"); ?>
</body>
</html>
