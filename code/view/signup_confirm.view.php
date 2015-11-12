<!DOCTYPE html>
<html>
<header>
  <meta charset="utf-8"/>
  <title>Daelium | Work in Progress</title>
  <link rel="stylesheet" href="../view/bootstrap/css/bootstrap.min.css"/>
  <link rel="stylesheet" href="../view/signup.css"/>
</header>
<body>
  <div class="container">
    <div class="card card-container">
        <h2>Verification des Informations </h2>
        <HR>
          <form class="form-signin" action="../view/signup_confirm2.view.php">
            <div class="row">
            <div class="col-xs-6">
            <label for="nom">Nom :</label>
            <input type="text" class="form-control" id="nom"  value="Blanchon" required>
            </div>
            <div class="col-xs-6">
            <label for="prenom">Prenom :</label>
            <input type="text" class="form-control" id="prenom"  value="Toto" required>
            </div>
            <label for="email">Mail :</label>
            <input type="email" class="form-control" id="email"  value="blanchon.toto@gmail.com" required>
            <label for="phone">Téléphone :</label>
            <input type="tel" class="form-control" id="phone"  value="0606060606"/>
            <div class="col-xs-10">
            <label for="rue">Rue :</label>
            <input type="text" class="form-control" id="rue" >
            </div>
            <div class="col-xs-2">
            <label for="num">N° :</label>
            <input type="text" class="form-control" id="num" >
            </div>
            <div class="col-xs-4">
            <label for="ville">Ville :</label>
            <input type="text" class="form-control" id="ville" >
            </div>
            <div class="col-xs-4">
            <label for="cp">Code postal :</label>
            <input type="text" class="form-control" id="cp" >
            </div>
            <div class="col-xs-4">
            <label for="pays">Pays :</label>
            <input type="text" class="form-control" id="pays" >
            </div>
          <HR>
          <button class="btn btn-lg btn-primary btn-block btn-signin" type="submit">Suivant</button>
        </div>
        </form><!-- /form -->
      </div><!-- /card-container -->
    </div><!-- /container -->

    <script src="http://code.jquery.com/jquery-1.11.3.min.js"></script>
    <script src="../view/bootstrap/js/bootstrap.min.js"></script>
  </body>
  </html>
