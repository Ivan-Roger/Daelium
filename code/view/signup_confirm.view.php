<?php
   if (!isset($data))
      header("Location:"."../");
?>
<!DOCTYPE html>
<html>
<header>
  <meta charset="utf-8"/>
  <title>Daelium | Inscription</title>
  <link rel="stylesheet" href="../data/css/bootstrap.min.css"/>
  <link rel="stylesheet" href="../data/css/signup.css"/>
  <link rel="icon" type="image/png" href="../data/img/D.png" />
</header>
<body>
  <div class="container">
    <div class="card card-container">
        <h2>Verification des Informations </h2>
        <HR>
          <form class="form-signin" action="../controler/inscription.ctrl.php" method="POST">
            <div class="row">
            <div class="col-xs-6">
            <label for="nom">Nom :</label>
            <input type="text" class="form-control" id="nom" name="nom" value="<?= $data["nom"] ?>" required>
            </div>
            <div class="col-xs-6">
            <label for="prenom">Prenom :</label>
            <input type="text" class="form-control" id="prenom" name="prenom"  value="<?= $data["prenom"] ?>" required>
            </div>
            <label for="email">Mail :</label>
            <input type="email" class="form-control" id="mailcompte" name="mailcompte" value="<?= $data["mail"] ?>" required>
            <label for="phone">Téléphone :</label>
            <input type="tel" class="form-control" id="ntel" name="ntel" value="<?= $data["tel"] ?>"/>
            <div class="col-xs-8">
            <label for="rue">N° & Rue :</label>
            <input type="text" class="form-control" name="adresse"id="adresse" >
            </div>
            <div class="col-xs-4">
            <label for="num">Code postal :</label>
            <input type="text" class="form-control"name="codepostal" id="codepostal" >
            </div>
            <div class="col-xs-4">
            <label for="ville">Ville :</label>
            <input type="text" class="form-control" name="ville"id="ville" >
            </div>
            <div class="col-xs-4">
            <label for="cp">Region *:</label>
            <input type="text" class="form-control"name="region" id="region" required>
            </div>
            <div class="col-xs-4">
            <label for="pays">Pays *:</label>
            <input type="text" class="form-control"name="pays" id="pays" required>
            </div>
            <input type="hidden" name="etape" value="1"/>
          <HR>
          <button class="btn btn-lg btn-primary btn-block btn-signin" type="submit">Suivant</button>
        </div>
        </form><!-- /form -->
      </div><!-- /card-container -->
    </div><!-- /container -->
    <?php include("../view/include/footer.view.php"); ?>
    <script src="../data/js/jQuery.min.js"></script>
    <script src="../data/js/bootstrap.min.js"></script>
  </body>
</html>
