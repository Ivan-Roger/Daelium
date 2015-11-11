<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8" />
  <link rel="stylesheet" href="../view/bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="../view/nolog.css"/>
  <title>Dælium</title>
</head>
<body>
  <nav class="container-fluid nav navbar-default">
    <div class="navbar-header">
      <img src="../view/img/D.png" alt="LogoSite" style="height:50px;">
    </div>
    <!-- Menu des differentes section du site  plus module de recherche-->
    <form class="navbar-form navbar-right" method="GET" action="#">
      <!-- Menu de l'uilisateur-->
        <button type="button" class="btn btn-primary"> Se connecter </button>
          <button type="button" class="btn btn-warning">Je m'inscrit maintenent !</button>
    </form>
  </nav>

  <div id="carousel-example-generic" class="carousel slide col-lg-6" data-ride="carousel">
    <!-- Indicators -->
    <ol class="carousel-indicators">
      <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
      <li data-target="#carousel-example-generic" data-slide-to="1"></li>
    </ol>

    <!-- Wrapper for slides -->
    <div class="carousel-inner" role="listbox">
      <div class="item active">
        <img src="http://wikipics.net/photos/20150125142221651988185.jpg" alt="...">
        <div class="carousel-caption">
          Rien 1
        </div>
      </div>
      <div class="item">
        <img src="http://wikipics.net/photos/20150125142221651988185.jpg" alt="...">
        <div class="carousel-caption">
          Rien 2
        </div>
      </div>
    </div>

    <!-- Controls -->
    <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
      <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
      <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
      <span class="sr-only">Next</span>
    </a>
  </div>
  <footer class="footer">
    <h2>Daelium</h2>
    <p>IUT2 UPMF, Place Doyen Gosse, 38000 Grenoble, Rhone-Alpes</p>
  </footer>
  <script src="http://code.jquery.com/jquery-1.11.3.min.js"></script>
  <script src="../view/bootstrap/js/bootstrap.min.js"></script>
</body>
</html>
