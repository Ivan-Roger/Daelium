<?php
   if (!isset($data))
      header("Location:"."../");
?>
<!DOCTYPE html>
<html>
<head>
  <?php include("../view/include/includes.view.php"); ?>
  <link rel="stylesheet" href="../data/css/artiste.css">
  <title>Dælium - Artiste - <?= $data['groupe']['nom']?></title>
</head>
<body>
  <?php include("../view/include/header.view.php"); ?>
  <section class="col-lg-offset-1 col-lg-10">
    <form class="form-horizontal" role="form">
      <h1>Modification de "<?= $data['groupe']['nom']?>"</h1>
      <article class="col-lg-offset-2 col-lg-10">
        <div class="navbar navbar-right">
          <a class ="btn btn-default" href="../controler/groupes.ctrl.php"> Retour </a>
          <a class ="btn btn-warning" href="#" > Annuler </a>
          <a class ="btn btn-primary" href="#" > Enregistrer </a>
        </div>
      </article>
      <div class="col-lg-offset-1 col-lg-10">
        <div class="panel panel-default">
          <div class="panel-heading">Artiste/Groupe</div>
          <div class="panel-body">
            <div class="form-group">
              <label class="control-label col-sm-4" for="nomscene">Nom de scene :</label>
              <div class="col-sm-8">
                <input id="nomscene" name="nomscene" class="form-control" placeholder="Nom de scene"/>
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-sm-4" for="mail">Email :</label>
              <div class="col-sm-8">
                <input type="text" id="mail" name="mail" class="form-control"/>
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-sm-4" for="genre">Genre :</label>
              <div class="col-sm-8">
                <input type="text" id="genre" name="genre" class="form-control"/>
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-sm-4" for="des">Description :</label>
              <div class="col-sm-8">
                <textarea id="des" name="des" class="form-control"> </textarea>
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-sm-4" for="img">Image de couverture :</label>
              <div class="col-sm-8">
                <input type="file" id="img" name="img"/>
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
                <label class="control-label col-sm-2" for="ville">Ville * :</label>
                <div class="col-sm-6">
                  <input type="text" id="ville" name="ville" required="required" class="form-control" />
                </div>
                <label class="control-label col-sm-2" for="region">Region :</label>
                <div class="col-sm-4">
                  <input type="text" id="region" name="region"  class="form-control" />
                </div>
                <label class="control-label col-sm-2" for="pays">Pays * :</label>
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
          </div>
        </div>
      </div>
      <div class="pull-right">
        <input class="btn btn-default" type="button" onclick="alert('Hello World!')" value="Annuler">
        <input class="btn btn-primary" type="button" onclick="alert('Hello World!')" value="Ajouter">
      </div>
    </form>
  </section>
  <?php include("../view/include/footer.view.php"); ?>
</body>
</html>
