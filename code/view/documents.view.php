<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <link rel="stylesheet" href="../data/css/bootstrap.css">
    <link rel="stylesheet" href="../data/css/common.css">
    <link rel="stylesheet" href="../data/css/documents.css">
    <link rel="icon" type="image/png" href="../data/img/D.png" />
    <title>Dælium - Documents</title>
  </head>
  <body>
    <?php include("../view/include/header.view.php"); ?>
    <section class="col-lg-10 col-lg-offset-1">
      <div class="col-lg-8">
        <div class="panel panel-default">
          <div class="panel-heading">
            <h4>Mes fichiers : Racine</h4>
            <small><a href="#">Racine</a> &raquo;</small>
          </div>
          <div class="panel-body table-responsive no-padding">
            <table class="table table-bordered table-hover">
              <thead>
                <tr><th class="col-lg-7">Nom</th><th class="col-lg-2">Actions</th><th class="col-lg-2">Date de modification</th><th class="col-lg-1">Taille</th></tr>
              </thead>
              <tbody>
                <tr>
                  <td><a href="#"><span class="glyphicon glyphicon-folder-open"></span>Fiches concert</a></td>
                  <td><div class="btn-group">
                    <a class="btn btn-default"><span class="glyphicon glyphicon-sort no-margin"></span></a>
                    <a class="btn btn-default"><span class="glyphicon glyphicon-trash no-margin"></span></a>
                  </div></td>
                  <td>24/10/2015</td>
                  <td>80 Ko</td>
                </tr>
                <tr>
                  <td><a href="#"><span class="glyphicon glyphicon-file"></span>Fiche technique.doc</a></td>
                  <td><div class="btn-group">
                    <a class="btn btn-default"><span class="glyphicon glyphicon-download-alt no-margin"></span></a>
                    <a class="btn btn-default"><span class="glyphicon glyphicon-sort no-margin"></span></a>
                    <a class="btn btn-default"><span class="glyphicon glyphicon-trash no-margin"></span></a>
                  </div></td>
                  <td>27/10/2015</td>
                  <td>20 Ko</td>
                </tr>
                <tr>
                  <td><a href="#"><span class="glyphicon glyphicon-file"></span>CV.doc</a></td>
                  <td><div class="btn-group">
                    <a class="btn btn-default"><span class="glyphicon glyphicon-download-alt no-margin"></span></a>
                    <a class="btn btn-default"><span class="glyphicon glyphicon-sort no-margin"></span></a>
                    <a class="btn btn-default"><span class="glyphicon glyphicon-trash no-margin"></span></a>
                  </div></td>
                  <td>27/10/2015</td>
                  <td>20 Ko</td>
                </tr>
                <tr>
                  <td><a href="#"><span class="glyphicon glyphicon-file"></span>Candidature festival.doc</a></td>
                  <td><div class="btn-group">
                    <a class="btn btn-default"><span class="glyphicon glyphicon-download-alt no-margin"></span></a>
                    <a class="btn btn-default"><span class="glyphicon glyphicon-sort no-margin"></span></a>
                    <a class="btn btn-default"><span class="glyphicon glyphicon-trash no-margin"></span></a>
                  </div></td>
                  <td>27/10/2015</td>
                  <td>20 Ko</td>
                </tr>
                <tr>
                  <td><a href="#"><span class="glyphicon glyphicon-file"></span>Bilan.xcf</a></td>
                  <td><div class="btn-group">
                    <a class="btn btn-default"><span class="glyphicon glyphicon-download-alt no-margin"></span></a>
                    <a class="btn btn-default"><span class="glyphicon glyphicon-sort no-margin"></span></a>
                    <a class="btn btn-default"><span class="glyphicon glyphicon-trash no-margin"></span></a>
                  </div></td>
                  <td>27/10/2015</td>
                  <td>20 Ko</td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
      <div class="col-lg-4">
        <div class="panel panel-default">
          <div class="panel-heading">
            <h4>Ajouter un fichier</h4>
            <small>Le fichier sera enregistré dans le dossier courant.</small>
          </div>
          <div class="panel-body">
            <div class="input-group">
              <input type="file" class="col-sm-9">
              <button class="btn btn-default col-sm-3"><span class="glyphicon glyphicon-cloud-upload"></span>Envoyer</button>
            </div>
          </div>
        </div>
      </div>
    </section>
    <?php include("../view/include/footer.view.php"); ?>
    <script src="../data/js/jQuery.min.js"></script>
    <script src="../data/js/bootstrap.min.js"></script>
    <script src="https://apis.google.com/js/platform.js" async defer></script>
    <script src="../data/js/common.js"></script>
  </body>
</html>
