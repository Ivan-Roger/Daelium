<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <link rel="stylesheet" href="bootstrap/css/bootstrap.css">
    <title>Dælium</title>
  </head>
  <body>
    <header class="page-header">
      <div id="top">
        <h1>Dælium</h1>
        <p>Le site des echanges musicaux</p>
        <!-- Logo du site , tritre description -->
      </div>
      <div class="container-fluid">
        <nav class="nav navbar-default">
          <div class="navbar-header">
            <img src="../view/img/D.png" alt="LogoSite" style="height:50px;">
          </div>
          <!-- Menu des differentes section du site  plus module de recherche-->
          <ul class="nav navbar-nav">
            <li class="active"><a href="#"><span class="glyphicon glyphicon-home"></span> Accueil</a></li>
            <li><a href="#"><span class="glyphicon glyphicon-user"></span> Profil</a></li>
            <li><a href="#"><span class="glyphicon glyphicon-file"></span> Documents</a></li>
            <li><a href="#"><span class="glyphicon glyphicon-calendar"></span> Agenda</a></li>
            <li><a href="#"><span class="glyphicon glyphicon-envelope"></span> Messagerie</a></li>
            <li><a href="#"><span class="glyphicon glyphicon-list-alt"></span> Annuaire</a></li>
          </ul>
          <ul class="nav navbar-nav navbar-right">
            <!-- Menu de l'uilisateur-->
            <li id="settings" class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-cog"></span> Paramétres <span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li><a href="#">Action</a></li>
                <li><a href="#">Another action</a></li>
                <li><a href="#">Something else here</a></li>
                <li role="separator" class="divider"></li>
                <li><a href="#">Separated link</a></li>
                <li role="separator" class="divider"></li>
                <li><a href="#">One more separated link</a></li>
              </ul>
            </li>
            <li id="profile" class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-user"></span> Compte <span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li><a href="#">Action</a></li>
                <li><a href="#">Another action</a></li>
                <li><a href="#">Something else here</a></li>
                <li role="separator" class="divider"></li>
                <li><a href="#">Separated link</a></li>
                <li role="separator" class="divider"></li>
                <li><a href="#">One more separated link</a></li>
              </ul>
            </li>
          </ul>
          <form class="navbar-form navbar-right" method="get" action="#">
            <div class="input-group">
              <input type="text" class="form-control" placeholder="Je cherche ...">
              <span class="input-group-btn">
                <button class="btn btn-primary" type="button">Rechercher</button>
              </span>
            </div>
          </form>
        </nav>
      </div>
    </header>
    <section class="container">
      <div class="jumbotron">
        <h1>Bienvenue !</h1>
        <p>Bienvenue sur Dælium, le site est actuellement en construction ...</p>
        <p><a class="btn btn-primary btn-lg" href="#" role="button">Learn more</a></p>
      </div>
    </section>
    <section class="col-sm-10">
      <!-- Alertes et information pour l'utilisateur -->
      <article>
        <img src="http://www.ac-grenoble.fr/ien.vienne1-2/spip/IMG/bmp_Image004.bmp" alt="Mountain View" style="height:100px;">
        <p>Charle DURAND à rendu libre les inscription pour son evenement "Festival des eaux de la pluie". Vous pouvez maintenent rentre en contact avec lui afin d'y Inscrire un Artiste/Groupe .</p>
      </article>
      <article>
        <img src="http://www.ac-grenoble.fr/ien.vienne1-2/spip/IMG/bmp_Image004.bmp" alt="Mountain View" style="height:100px;">
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum</p>
      </article>
      <article>
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum</p>
      </article>
      <article>
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum</p>
      </article>
    </section>
    <section class="col-sm-2">
      <!-- Sugestion pour l'utilisateur (evt & art pour booker) (art pour orga )-->
      <article>
        <img src="http://www.ac-grenoble.fr/ien.vienne1-2/spip/IMG/bmp_Image004.bmp" alt="Mountain View" style="height:100px;">
        <p>L'evenement Bringue a la mairie de Valence est suceptible d'interesser le Groupe/Artiste "Les Bleu" que vous gerez.</p>
      </article>
      <article>
        <p>L'evenement Bringue a la mairie de Valence est suceptible d'interesser le Groupe/Artiste "Les Bleu" que vous gerez.</p>
      </article>
    </section>
    <footer id="footer">
      <h2>Daelium</h2>
      <p>IUT2 UPMF, Place Doyen Gosse, 38000 Grenoble, Rhone-Alpes</p>
    </footer>
    <script src="http://code.jquery.com/jquery-1.11.3.min.js"></script>
    <script src="../view/bootstrap/js/bootstrap.min.js"></script>
  </body>
</html>
