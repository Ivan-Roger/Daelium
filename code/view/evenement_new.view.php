<?php
if (!isset($data))
header("Location:"."../");
?>
<!DOCTYPE html>
<html>
<head>
  <?php include("../view/include/includes.view.php"); ?>
  <link rel="stylesheet" href="../data/css/artiste.css">
  <title>Dælium - Evenement - <?= $data['evenement']['name']?></title>
</head>
<body>
  <?php include("../view/include/header.view.php"); ?>
  <section class="col-lg-offset-2 col-lg-8">
    <form class="form-horizontal" role="form" method="post" action="../controler/evenement_new.ctrl.php?action=create">
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
                  <label class="btn btn-default" data-toggle="collapse" href="#existe" toggle="true" aria-expanded="true" aria-controls="existe">
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
              <select name="select" class="form-control">
                <?php foreach (  $data["evenements"] as $key => $value): ?>
                  <option value="<?= $key ?>"><?= $value["nom"] ?></option>
                <?php endforeach; ?>
              </select>
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
                <label class="btn btn-default" data-toggle="collapse" href="#siautre" toggle="true" aria-expanded="true" aria-controls="siautre">
                  <input type="radio" name="type" id="option2" value="Autre" > Autre
                </label>
              </div>
            </div>
          </div>



          <div id="siautre" class="form-group collapse">
            <label class="control-label col-sm-4" for="autre">Si autre :</label>
            <div class="col-sm-8">
              <input type="text" id="autre" name="autre" class="form-control" />
            </div>
          </div>

          <div class="form-group">
            <label class="control-label col-sm-4" for="genre">Genre :</label>
            <div class="col-sm-8">
              <input type="text" id="genre" name="genre"  class="form-control" />
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
            <label class="control-label col-sm-4" >Lieu :</label>
            <div class="col-sm-8 well">

              <label class="control-label col-sm-2" for="adresse">Adresse :</label>
              <div class="col-sm-10">
                <input type="text" id="adresse" name="adresse" required="required" class="form-control" />
              </div>
              <label class="control-label col-sm-2" for="codepostal">Code postal :</label>
              <div class="col-sm-2">
                <input type="text" id="codepostal" name="codepostal" required="required" class="form-control" />
              </div>
              <label class="control-label col-sm-2" for="ville">Ville :</label>
              <div class="col-sm-6">
                <input type="text" id="ville" name="ville" required="required" class="form-control" />
              </div>
              <label class="control-label col-sm-2" for="region">Region :</label>
              <div class="col-sm-4">
                <input type="text" id="region" name="region"  class="form-control" />
              </div>
              <label class="control-label col-sm-2" for="pays">Pays :</label>
              <div class="col-sm-4">
                <input type="text" id="pays" name="pays" required="required" class="form-control"  />
              </div>
              <label class="control-label col-sm-2" for="latitude">Latitude :</label>
              <div class="col-sm-4">
                <input type="text" id="latitude" name="latitude"  class="form-control" />
              </div>
              <label class="control-label col-sm-2" for="longitude">Longitude :</label>
              <div class="col-sm-4">
                <input type="text" id="longitude" name="longitude" class="form-control" />
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
  </section>
  <?php include("../view/include/footer.view.php"); ?>
</body>
</html>
