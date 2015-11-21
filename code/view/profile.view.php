<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <link rel="stylesheet" href="../data/css/bootstrap.css">
    <link rel="stylesheet" href="../data/css/common.css">
    <link rel="icon" type="image/png" href="../data/img/D.png" />
    <title>Dælium - Profil</title>
  </head>
  <body>
    <?php include("../view/include/header.view.php"); ?>
    <section class="col-lg-12">

      <h1> Informations personnelles : </h1>
      <div class="row"><div class="col-sm-2 col-sm-offset-1">
        <img src="../data/users/icons/User_64.png" alt="Image de Profil">
      </div></div>

      <form class="form-horizontal">

        <div class="form-group">
          <div class="row">
          <label for="Nom" class="col-sm-1 control-label">Nom</label>
            <div class="col-sm-2">
              <input type="text" class="form-control" id="Nom" placeholder="Nom">
            </div>
            <div class="col-sm-2">
              <div class="checkbox">
                <label>
                  <input type="checkbox"> Public
                </label>
              </div>
            </div>
          </div>
        </div>

        <div class="form-group">
          <div class="row">
          <label for="Prenom" class="col-sm-1 control-label">Prénom</label>
            <div class="col-sm-2">
              <input type="text" class="form-control" id="Prenom" placeholder="Prénom">
            </div>
            <div class="col-sm-2">
              <div class="checkbox">
                <label>
                  <input type="checkbox"> Public
                </label>
              </div>
            </div>
          </div>
        </div>

        <div class="form-group">
          <div class="row">
          <label for="EmailPerso" class="col-sm-1 control-label">Email du compte</label>
            <div class="col-sm-2">
              <input type="email" class="form-control" id="EmailPerso" placeholder="Ex: prenom.nom@domaine.com">
            </div>
            <div class="col-sm-2">
              <div class="checkbox">
                <label>
                  <input type="checkbox"> Public
                </label>
              </div>
            </div>
          </div>
        </div>

        <div class="form-group">
          <div class="row">
          <label for="EmailPro" class="col-sm-1 control-label">Email de contact</label>
            <div class="col-sm-2">
              <input type="email" class="form-control" id="EmailPro" placeholder="Ex: prenom.nom@domaine.com">
            </div>
            <div class="col-sm-2">
              <div class="checkbox">
                <label>
                  <input type="checkbox"> Public
                </label>
              </div>
            </div>
          </div>
        </div>

        <div class="form-group">
          <div class="row">
          <label for="TelPro" class="col-sm-1 control-label">Numero de télephone professionnel</label>
            <div class="col-sm-2">
              <input type="tel" class="form-control" id="TelPro" placeholder="Format: XX XX XX XX XX ou XXXXXXXX">
            </div>
            <div class="col-sm-2">
              <div class="checkbox">
                <label>
                  <input type="checkbox"> Public
                </label>
              </div>
            </div>
          </div>
        </div>

</form>


    </section>
    <?php include("../view/include/footer.view.php"); ?>
    <script src="http://code.jquery.com/jquery-1.11.3.min.js"></script>
    <script src="../data/js/bootstrap.min.js"></script>
  </body>
</html>
