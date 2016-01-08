<?php
   if (!isset($data))
      header("Location:"."../");
?>
<!DOCTYPE html>
<html>
<head>
  <?php include("../view/include/includes.view.php"); ?>
  <link rel="stylesheet" href="../data/css/artiste_fiche.css">
  <script src="../ckeditor/ckeditor.js"></script>
  <title>Dælium - Manifestation - <?= $data['groupe']['nom']?> - Edition</title>
</head>
<body>
  <!-- Cette page est acessible par tout les Organisateur et Non inscrit , Cependant le booker a possibiliter de modifier la page -->
  <?php include("../view/include/header.view.php"); ?>
  <section class="col-lg-offset-1 col-lg-10">
    <!--
    Si Affichage de la fiche.

    Libre:
    Photo du groupe
    Biographie
    Album / EP / Titre Populaire , Explication
    Line Up (Video, clip)

    Fixe:
    - Photo du groupe (plus petite)

    - Player Audio
    - Reseaux sociaux
    - Concert passer et à venir
    (si organisateur sur site -> fiche technique)


    Si Modif de la fiche.
    Choix du player, reseaux, Concert passer et a venir et fiche technique (oui /non)
    position du module en haut, en bas.
    -->
      <form class="form-horizontal" role="form" method="post" action="../controler/evenement_fiche.ctrl.php?action=edit">
          <h2>Fiche de "<?= $data["evenement"]['nom']?>"</h2>
        <article class="col-lg-offset-2 col-lg-10">
          <div class="navbar navbar-right">
            <a class ="btn btn-default" href="../controler/evenement_fiche.ctrl.php?id=<?= $data['evenement']['id']?>"> Retour </a>
            <input class ="btn btn-warning" type="reset" name="nom" value="Annuler">
            <input class ="btn btn-primary" type="submit" name="nom" value="Enregistrer">
          </div>
        </article>
        <div class="col-lg-4">
          <div class="panel panel-default">
            <div class="panel-heading">Elements</div>
            <div class="panel-body">
              <div class="form-group">
                <label class="control-label col-sm-8" for="rs">Panneau Reseaux sociaux :</label>
                <div class="col-sm-4 btn-group" data-toggle="buttons" id="fonction">
                  <label class="btn btn-default active">
                    <input type="radio" name="rsa" id="option1" value="on" checked > Actif
                  </label>
                  <label class="btn btn-default">
                    <input type="radio" name="rsa" id="option2" value="off" > Inactif
                  </label>
                </div>
              </div>
              <hr>
              <div class="form-group">
                <label class="control-label col-sm-8" for="lart">Liste Artistes :</label>
                  <div class="col-sm-4 btn-group" data-toggle="buttons" id="fonction">
                    <label class="btn btn-default active">
                      <input type="radio" name="lart" id="option1" value="on" checked > Actif
                    </label>
                    <label class="btn btn-default">
                      <input type="radio" name="lart" id="option2" value="off" > Inactif
                    </label>
                  </div>
              </div>
              <hr>
              <div class="form-group">
                <label class="control-label col-sm-8" for="conc">Panneau Concert passé/futur :</label>
                <div class="col-sm-4 btn-group" data-toggle="buttons" id="fonction">
                  <label class="btn btn-default active">
                    <input type="radio" name="conc" id="option1" value="on" checked > Actif
                  </label>
                  <label class="btn btn-default ">
                    <input type="radio" name="conc" id="option2" value="off" > Inactif
                  </label>
                </div>

              </div>
            </div>
          </div>
        </div>



        <div class="col-lg-8">
          <div class="panel panel-default">
            <div class="panel-heading">Reseaux sociaux</div>
            <div class="panel-body">
              <div class="form-group">
                <label class="control-label col-sm-2" for="face">Facebook :</label>
                <div class="col-sm-10">
                  <input type="text" id="face" name="face" class="form-control" value="<?= $data['evenement']['facebook'] ?>" />
                </div>
              </div> <!-- /form-group -->

              <div class="form-group">
                <label class="control-label col-sm-2" for="twt">Twitter :</label>
                <div class="col-sm-10">
                  <input type="text" id="face" name="twt" class="form-control" value="<?= $data['evenement']['twitter'] ?>" />
                </div>
              </div> <!-- /form-group -->

              <div class="form-group">
                <label class="control-label col-sm-2" for="gg">Google+ :</label>
                <div class="col-sm-10">
                  <input type="text" id="gg" name="gg" class="form-control" value="<?= $data['evenement']['google'] ?>" />
                </div>
              </div> <!-- /form-group -->

            </div>
          </div>
        </div>

        <div class="col-lg-12">
          <div class="panel panel-default">
            <div class="panel-heading">Image de couverture</div>
            <div class="panel-body">
              <input type="file" name="fichier" value="<?= $data['evenement']['imageoff'] ?>">
            </div>
          </div>
        </div>

        <div class="col-lg-12">
          <div class="panel panel-default">
            <div class="panel-heading">Contenu de la page</div>
            <div class="panel-body">
              <textarea rows="4" name="pagecom" id="editor1" cols="175%"> <?= $data['evenement']['fichecom'] ?> </textarea>
              <script>
                // Replace the <textarea id="editor1"> with a CKEditor
                // instance, using default configuration.
                CKEDITOR.replace( 'editor1' );
            </script>
            </div>
          </div>
        </div>
        <input type="hidden" name="idmanif" value="<?= $data['evenement']['id'] ?>"/>

      </form>
    </section>
    <?php include("../view/include/footer.view.php"); ?>
    <div id="fb-root"></div>
    <script>
      (function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s); js.id = id;
        js.src = "//connect.facebook.net/fr_FR/sdk.js#xfbml=1&version=v2.5";
        fjs.parentNode.insertBefore(js, fjs);
      }(document, 'script', 'facebook-jssdk'));
    </script>
  </body>
</html>
