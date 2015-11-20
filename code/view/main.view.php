<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <link rel="stylesheet" href="../data/css/bootstrap.css">
    <link rel="stylesheet" href="../data/css/common.css">
    <link rel="stylesheet" href="../data/css/main.css">
    <title>Dælium</title>
  </head>
  <body>
    <?php include("../view/include/header.view.php"); ?>
    <section id="welcome" class="container-fluid" style="padding:0px;">
      <div id="carousel-welcome" class="carousel slide" data-ride="carousel">
        <!-- Indicators -->
        <ol class="carousel-indicators">
          <li data-target="#carousel-welcome" data-slide-to="0" class="active"></li>
          <li data-target="#carousel-welcome" data-slide-to="1"></li>
        </ol>

        <!-- Wrapper for slides -->
        <div class="carousel-inner" role="listbox">
          <div class="slide-full item active">
            <div class="carousel-caption">
              <h1>Bienvenue ! A FAIRE !!!</h1>
              <p>Bienvenue sur Dælium, le site est actuellement en construction ...</p>
              <p><a class="btn btn-primary btn-lg" href="#" role="button">Learn more</a></p>
            </div>
          </div>
          <div class="slide-full item">
            <div class="carousel-caption">
              <h1>Slide 2</h1>
              <p>Bienvenue sur Dælium, le site est actuellement en construction ...</p>
              <p><a class="btn btn-primary btn-lg" href="#" role="button">Learn more</a></p>
            </div>
          </div>
        </div>

        <!-- Controls -->
        <a class="left carousel-control" href="#carousel-welcome" role="button" data-slide="prev">
          <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
          <span class="sr-only">Previous</span>
        </a>
        <a class="right carousel-control" href="#carousel-welcome" role="button" data-slide="next">
          <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
          <span class="sr-only">Next</span>
        </a>
      </div>
    </section>
    <section class="container-fluid full page-content">
      <article class="col-sm-8 col-sm-offset-1">
        <!-- Alertes et information pour l'utilisateur -->
        <div>
          <img src="http://www.ac-grenoble.fr/ien.vienne1-2/spip/IMG/bmp_Image004.bmp" alt="Mountain View" style="height:100px;">
          <p>Charle DURAND à rendu libre les inscription pour son evenement "Festival des eaux de la pluie". Vous pouvez maintenent rentre en contact avec lui afin d'y Inscrire un Artiste/Groupe .</p>
          <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum</p>
          <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum</p>
          <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum</p>
        </div>
      </article>
      <aside class="col-sm-2">
        <!-- Sugestion pour l'utilisateur (evt & art pour booker) (art pour orga )-->
        <div>
          <img src="http://www.ac-grenoble.fr/ien.vienne1-2/spip/IMG/bmp_Image004.bmp" alt="Mountain View" style="height:100px;">
          <p>L'evenement Bringue a la mairie de Valence est suceptible d'interesser le Groupe/Artiste "Les Bleu" que vous gerez.</p>
          <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum</p>
        </div>
      </aside>
    </section>
    <?php include("../view/include/footer.view.php"); ?>
    <script src="http://code.jquery.com/jquery-1.11.3.min.js"></script>
    <script src="../data/js/bootstrap.min.js"></script>
  </body>
</html>
