<?php
   if (!isset($data))
      header("Location:"."../");
?>
<!DOCTYPE html>
<html>
<head>
  <?php include("../view/include/includes.view.php"); ?>
  <link rel="stylesheet" href="../data/css/artiste.css">
  <title>Dælium - Artiste - Nouveau</title>
</head>
<body>
  <?php include("../view/include/header.view.php"); ?>
  <section class="col-lg-offset-1 col-lg-10">
    <form class="form-horizontal" role="form">
      <h1>Nouvel Artiste/Groupe</h1>
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
              <label class="control-label col-sm-4" for="name">Type :</label>
              <div class="col-sm-8">
                <div class="btn-group" data-toggle="buttons" id="fonction">
                  <label class="btn btn-default active">
                    <input type="radio" name="options" id="option1" value="ar" checked> Artiste
                  </label>
                  <label class="btn btn-default">
                    <input type="radio" name="options" id="option2" value="gr"> Groupe
                  </label>
                </div>
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-sm-4" for="nb">Nombre de membre :</label>
              <div class="col-sm-8">
                <input type="number" id="nb" name="nb" class="form-control" value="1"/>
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
      </div>
      <!-- Si groupe alors Demander plusieurs fois les infos sur les different membres -->

      <div class="col-lg-6">
        <div class="panel panel-default">
          <div class="panel-heading">Artiste 1</div>
          <div class="panel-body">
            <div class="form-group">
              <label class="control-label col-sm-5" for="name">Nom du membre/artiste :</label>
              <div class="col-sm-7">
                <input type="text" id="name" name="name" class="form-control" placeholder="Nom"/>
              </div>
            </div>

            <div class="form-group">
              <label class="control-label col-sm-5" for="pname">Prenom du membre/artiste :</label>
              <div class="col-sm-7">
                <input type="text" id="pname" name="pname" class="form-control" placeholder="Prenom"/>
              </div>
            </div>

            <div class="form-group">
              <label class="control-label col-sm-5" for="daten">Date de naissance :</label>
              <div class="col-sm-7">
                <input type="date" id="daten" name="daten" class="form-control" />
              </div>
            </div>

            <div class="form-group">
              <label class="control-label col-sm-5" for="mail">Email :</label>
              <div class="col-sm-7">
                <input type="email" id="mail" name="mail" class="form-control" />
              </div>
            </div>

            <div class="form-group">
              <label class="control-label col-sm-5" for="ntel">Numero de telephone :</label>
              <div class="col-sm-7">
                <input type="tel" id="ntel" name="ntel" class="form-control" />
              </div>
            </div>

            <div class="form-group">
              <label class="control-label col-sm-5" for="adrr">Adresse :</label>
              <div class="col-sm-7">
                <input type="text" id="adrr" name="adrr" class="form-control" placeholder="Adresse" />
              </div>
            </div>

            <div class="form-group">
              <label class="control-label col-sm-5" for="name">Paiement :</label>
              <div class="col-sm-7 btn-group" data-toggle="buttons" id="fonction">
                <label class="btn btn-default active">
                  <input type="radio" name="options" id="option1" value="ch" checked> Chèque
                </label>
                <label class="btn btn-default">
                  <input type="radio" name="options" id="option2" value="vi"> Virement
                </label>
                <label class="btn btn-default">
                  <input type="radio" name="options" id="option2" value="es"> Espece
                </label>
              </div>
            </div>

            <div class="form-group">
              <label class="control-label col-sm-5" for="vir">IBAN :</label>
              <div class="col-sm-7">
                <input type="text" id="vir" name="vir" class="form-control" placeholder="Si Virement" />
              </div>
            </div>

            <div class="form-group">
              <label class="control-label col-sm-5" for="ord">Ordre :</label>
              <div class="col-sm-7">
                <input type="text" id="ord" name="ord" class="form-control" placeholder="Si cheque, si vide garde le nom"/>
              </div>
            </div>

          </div>
        </div>
      </div>

      <!--deuxieme artiste -->
      <div class=" col-lg-6">
        <div class="panel panel-default">
          <div class="panel-heading">Artiste 2</div>
          <div class="panel-body">
            <div class="form-group">
              <label class="control-label col-sm-5" for="name">Nom du membre/artiste :</label>
              <div class="col-sm-7">
                <input type="text" id="name" name="name" class="form-control" placeholder="Nom"/>
              </div>
            </div>

            <div class="form-group">
              <label class="control-label col-sm-5" for="pname">Prenom du membre/artiste :</label>
              <div class="col-sm-7">
                <input type="text" id="pname" name="pname" class="form-control" placeholder="Prenom"/>
              </div>
            </div>

            <div class="form-group">
              <label class="control-label col-sm-5" for="daten">Date de naissance :</label>
              <div class="col-sm-7">
                <input type="date" id="daten" name="daten" class="form-control" />
              </div>
            </div>

            <div class="form-group">
              <label class="control-label col-sm-5" for="mail">Email :</label>
              <div class="col-sm-7">
                <input type="email" id="mail" name="mail" class="form-control" />
              </div>
            </div>

            <div class="form-group">
              <label class="control-label col-sm-5" for="ntel">Numero de telephone :</label>
              <div class="col-sm-7">
                <input type="tel" id="ntel" name="ntel" class="form-control" />
              </div>
            </div>

            <div class="form-group">
              <label class="control-label col-sm-5" for="adrr">Adresse :</label>
              <div class="col-sm-7">
                <input type="text" id="adrr" name="adrr" class="form-control" placeholder="Adresse" />
              </div>
            </div>

            <div class="form-group">
              <label class="control-label col-sm-5" for="name">Paiement :</label>
              <div class="col-sm-7 btn-group" data-toggle="buttons" id="fonction">
                <label class="btn btn-default active">
                  <input type="radio" name="options" id="option1" value="ch" checked> Chèque
                </label>
                <label class="btn btn-default">
                  <input type="radio" name="options" id="option2" value="vi"> Virement
                </label>
                <label class="btn btn-default">
                  <input type="radio" name="options" id="option2" value="es"> Espece
                </label>
              </div>
            </div>

            <div class="form-group">
              <label class="control-label col-sm-5" for="vir">IBAN :</label>
              <div class="col-sm-7">
                <input type="text" id="vir" name="vir" class="form-control" placeholder="Si Virement" />
              </div>
            </div>

            <div class="form-group">
              <label class="control-label col-sm-5" for="ord">Ordre :</label>
              <div class="col-sm-7">
                <input type="text" id="ord" name="ord" class="form-control" placeholder="Si cheque, si vide garde le nom"/>
              </div>
            </div>

          </div>
        </div>
      </div>
      <div class="pull-right">
        <input class="btn btn-primary" type="button" onclick="alert('Hello World!')" value="Annuler">
        <input class="btn btn-primary" type="button" onclick="alert('Hello World!')" value="Ajouter">
      </div>
    </form>
  </section>
  <?php include("../view/include/footer.view.php"); ?>
</body>
</html>
