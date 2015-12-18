<!DOCTYPE html>
<html>
<head>
  <?php include("../view/includ/includes.view.php"); ?>
  <link rel="stylesheet" href="../data/css/artiste_fiche.css">
  <title>Dælium - Artiste - <?= $data['groupe']['nom']?> - Edition</title>
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
      <form class="form-horizontal" role="form">
          <h2>Fiche de "<?= $data["groupe"]['nom']?>"</h2>
        <article class="col-lg-offset-2 col-lg-10">
          <div class="navbar navbar-right">
            <a class ="btn btn-default" href="../controler/groupe_fiche.ctrl.php?id=<?= $data['groupe']['id']?>"> Retour </a>
            <input class ="btn btn-warning" type="reset" name="nom" value="Annuler">
            <input class ="btn btn-primary" type="submit" name="nom" value="Enregister">
          </div>
        </article>
        <div class="col-lg-12">
          <div class="panel panel-default">
            <div class="panel-heading">Elements/Position</div>
            <div class="panel-body">
              <div class="form-group">
                <label class="control-label col-sm-3" for="rs">Panneau Reseaux sociaux :</label>
                <div class="col-sm-3 btn-group" data-toggle="buttons" id="fonction">
                  <label class="btn btn-default active">
                    <input type="radio" name="rsa" id="option1" value="on" checked > Actif
                  </label>
                  <label class="btn btn-default">
                    <input type="radio" name="rsa" id="option2" value="off" > Inactif
                  </label>
                </div>
                <label class="control-label col-sm-2" for="rsp">Position :</label>
                <div class="col-sm-4 btn-group" data-toggle="buttons" id="fonction">
                  <label class="btn btn-default ">
                    <input type="radio" name="rsp" id="option1" value="haut" > En haut de la page
                  </label>
                  <label class="btn btn-default active">
                    <input type="radio" name="rsp" id="option2" value="bas" checked> En bas de la page
                  </label>
                </div>
              </div>
              <hr>
              <div class="form-group">
                <label class="control-label col-sm-3" for="lec">Panneau Lecteur :</label>
                  <div class="col-sm-3 btn-group" data-toggle="buttons" id="fonction">
                    <label class="btn btn-default active">
                      <input type="radio" name="leca" id="option1" value="on" checked > Actif
                    </label>
                    <label class="btn btn-default">
                      <input type="radio" name="leca" id="option2" value="off" > Inactif
                    </label>
                  </div>
                  <label class="control-label col-sm-2" for="lecp">Position :</label>
                  <div class="col-sm-4 btn-group" data-toggle="buttons" id="fonction">
                    <label class="btn btn-default ">
                      <input type="radio" name="lecp" id="option1" value="haut" > En haut de la page
                    </label>
                    <label class="btn btn-default active">
                      <input type="radio" name="lecp" id="option2" value="bas" checked> En bas de la page
                    </label>
                  </div>
              </div>
              <hr>
              <div class="form-group">
                <label class="control-label col-sm-3" for="conc">Panneau Concert passé/futur :</label>
                <div class="col-sm-3 btn-group" data-toggle="buttons" id="fonction">
                  <label class="btn btn-default active">
                    <input type="radio" name="conc" id="option1" value="on" checked > Actif
                  </label>
                  <label class="btn btn-default ">
                    <input type="radio" name="conc" id="option2" value="off" > Inactif
                  </label>
                </div>
                  <label class="control-label col-sm-2" for="concp">Position :</label>
                  <div class="col-sm-4 btn-group" data-toggle="buttons" id="fonction">
                    <label class="btn btn-default ">
                      <input type="radio" name="concp" id="option1" value="haut" > En haut de la page
                    </label>
                    <label class="btn btn-default active">
                      <input type="radio" name="concp" id="option2" value="bas" checked> En bas de la page
                    </label>
                  </div>
              </div>
              <hr>
              <div class="form-group">
                <label class="control-label col-sm-3" for="imgc">Image de couverture :</label>
                <div class="col-sm-3 btn-group" data-toggle="buttons" id="fonction">
                  <label class="btn btn-default active">
                    <input type="radio" name="imgc" id="option1" value="on" checked > Actif
                  </label>
                  <label class="btn btn-default ">
                    <input type="radio" name="imgc" id="option2" value="off" > Inactif
                  </label>
                </div>
                  <label class="control-label col-sm-2" for="imgp">Position :</label>
                  <div class="col-sm-4 btn-group" data-toggle="buttons" id="fonction">
                    <label class="btn btn-default active">
                      <input type="radio" name="imgp" id="option1" value="haut" checked> En haut de la page
                    </label>
                    <label class="btn btn-default ">
                      <input type="radio" name="imgp" id="option2" value="bas" > En bas de la page
                    </label>
                  </div>
              </div>
              <hr>
              <div class="form-group">
                <label class="control-label col-sm-3" for="ft">Lien vers fiche technique :</label>
                <div class="col-sm-3 btn-group" data-toggle="buttons" id="fonction">
                  <label class="btn btn-default active">
                    <input type="radio" name="ft" id="option1" value="on" checked > Public
                  </label>
                  <label class="btn btn-default">
                    <input type="radio" name="ft" id="option1" value="on"> Inscrit sur le site
                  </label>
                  <label class="btn btn-default ">
                    <input type="radio" name="ft" id="option2" value="off" > Inactif
                  </label>
                </div>
                  <label class="control-label col-sm-2" for="ftp">Position :</label>
                  <div class="col-sm-4 btn-group" data-toggle="buttons" id="fonction">
                    <label class="btn btn-default ">
                      <input type="radio" name="ftp" id="option1" value="haut" > En haut de la page
                    </label>
                    <label class="btn btn-default active">
                      <input type="radio" name="ftp" id="option2" value="bas" checked> En bas de la page
                    </label>
                  </div>
              </div>
            </div>
          </div>
        </div>

        <div class="col-lg-12">
          <div class="panel panel-default">
            <div class="panel-heading">Image de couverture</div>
            <div class="panel-body">
              Choisir un fichier ou l'envoyer
            </div>
          </div>
        </div>

        <div class="col-lg-12">
          <div class="panel panel-default">
            <div class="panel-heading">Reseaux sociaux</div>
            <div class="panel-body">
              <div class="form-group">
                <label class="control-label col-sm-2" for="face">Facebook :</label>
                <div class="col-sm-8">
                  <input type="text" id="face" name="face" class="form-control" />
                </div>
                <div class="col-sm-2 btn-group" data-toggle="buttons" id="fonction">
                  <label class="btn btn-default active">
                    <input type="radio" name="facea" id="option1" value="on" checked="checked" > Actif
                  </label>
                  <label class="btn btn-default">
                    <input type="radio" name="facea" id="option2" value="off" > Inactif
                  </label>
                </div>
              </div> <!-- /form-group -->

              <div class="form-group">
                <label class="control-label col-sm-2" for="twt">Twitter :</label>
                <div class="col-sm-8">
                  <input type="text" id="face" name="twt" class="form-control" />
                </div>
                <div class="col-sm-2 btn-group" data-toggle="buttons" id="fonction">
                  <label class="btn btn-default active">
                    <input type="radio" name="twta" id="option1" value="on" checked="checked" > Actif
                  </label>
                  <label class="btn btn-default">
                    <input type="radio" name="twta" id="option2" value="off" > Inactif
                  </label>
                </div>
              </div> <!-- /form-group -->

              <div class="form-group">
                <label class="control-label col-sm-2" for="gg">Google+ :</label>
                <div class="col-sm-8">
                  <input type="text" id="gg" name="gg" class="form-control" />
                </div>
                <div class="col-sm-2 btn-group" data-toggle="buttons" id="fonction">
                  <label class="btn btn-default active">
                    <input type="radio" name="gga" id="option1" value="on" checked="checked" > Actif
                  </label>
                  <label class="btn btn-default">
                    <input type="radio" name="gga" id="option2" value="off" > Inactif
                  </label>
                </div>
              </div> <!-- /form-group -->


              <div class="form-group">
                <label class="control-label col-sm-2" for="sc">SoundCloud :</label>
                <div class="col-sm-8">
                  <input type="text" id="sc" name="sc" class="form-control" />
                </div>
                <div class="col-sm-2 btn-group" data-toggle="buttons" id="fonction">
                  <label class="btn btn-default active">
                    <input type="radio" name="sca" id="option1" value="on" checked="checked" > Actif
                  </label>
                  <label class="btn btn-default">
                    <input type="radio" name="sca" id="option2" value="off" > Inactif
                  </label>
                </div>
              </div> <!-- /form-group -->
            </div>
          </div>
        </div>
        <div class="col-lg-12">
          <div class="panel panel-default">
            <div class="panel-heading">Lecteurs</div>
            <div class="panel-body">
              <textarea rows="4" cols="175%"> </textarea>
            </div>
          </div>
        </div>
        <div class="col-lg-12">
          <div class="panel panel-default">
            <div class="panel-heading">Contenu de la page</div>
            <div class="panel-body">
              <textarea rows="4" cols="175%"> </textarea>
            </div>
          </div>
        </div>
      </form>
    </section>
    <?php include("../view/include/footer.view.php"); ?>
    <script src="../data/js/jQuery.min.js"></script>
    <script src="../data/js/bootstrap.min.js"></script>
    <script src="https://apis.google.com/js/platform.js" async defer></script>
    <script src="../data/js/common.js"></script>
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
