<?php
   if (!isset($data))
      header("Location:"."../");
?>
<!DOCTYPE html>
<html>
<header>
  <meta charset="utf-8"/>
  <title>Daelium | Work in Progress</title>
  <link rel="stylesheet" href="../data/css/bootstrap.min.css"/>
  <link rel="stylesheet" href="../data/css/signin.css"/>
  <meta name="google-signin-scope" content="profile email">
  <meta name="google-signin-client_id" content="92931061530-5ehngmgb30h1vgrgpsglcj38kaejjf3o.apps.googleusercontent.com">
  <script src="https://apis.google.com/js/platform.js" async defer></script>
  <link rel="icon" type="image/png" href="../data/img/D.png" />
</header>
<body>
  <div class="container">
        <div class="card card-container">
            <!-- <img class="profile-img-card" src="//lh3.googleusercontent.com/-6V8xOA6M7BA/AAAAAAAAAAI/AAAAAAAAAAA/rzlHcD0KYwo/photo.jpg?sz=120" alt="" /> -->
            <a class="btn btn-default" href="../controler/nolog.ctrl.php">&laquo; Retour</a>
            <img id="profile-img" class="profile-img-card" src="../data/img/D.png" />
            <p id="profile-name" class="profile-name-card">Bienvenue !</p>
            <?php if (isset($data['errorMessage'])) { ?><div class="alert alert-error"><?= $data['errorMessage'] ?></div><?php } ?>
            <hr/>
            <div class="g-signin2" data-onsuccess="onSignIn" data-theme="dark" data-width="270px"></div>
            <hr/>
            <form class="form-signin" method="POST" action="../controler/connexion.ctrl.php?login">
                <span id="reauth-email" class="reauth-email"></span>
                <div class="form-group<?php if (isset($data['errorFields']['inputEmail'])) {echo (" has-error has-feedback"); } ?>">
                  <input type="email" name="mail" id="inputEmail" class="form-control" placeholder="Adresse mail du compte" required autofocus>
                  <span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span>
                </div>
                <div class="form-group<?php if (isset($data['errorFields']['inputPassword'])) {echo (" has-error has-feedback"); } ?>">
                  <input type="password" name="mdp" id="inputPassword" class="form-control" placeholder="Mot de passe" required>
                  <span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span>
                </div>
                <div id="remember" class="checkbox">
                    <label>
                        <input type="checkbox" value="remember-me"> Se souvenir de moi
                    </label>
                </div>
                <button class="btn btn-lg btn-primary btn-block btn-signin" type="submit">Connexion</button>
            </form><!-- /form -->
            <a href="#" class="forgot-password">
                Mot de passe oublié ?
            </a>
            <br/>
            <a href="#" class="forgot-password">
                Inscription
            </a>
        </div><!-- /card-container -->
    </div><!-- /container -->
    <script src="../data/js/jQuery.min.js"></script>
    <script src="../data/js/bootstrap.min.js"></script>
    <script>
      function onSignIn(googleUser) {
        // Useful data for your client-side scripts:
        var profile = googleUser.getBasicProfile();
        console.log("ID: " + profile.getId()); // Don't send this directly to your server!
        console.log("Name: " + profile.getName());
        console.log("Image URL: " + profile.getImageUrl());
        console.log("Email: " + profile.getEmail());

        // The ID token you need to pass to your backend:
        var id_token = googleUser.getAuthResponse().id_token;
        console.log("ID Token: " + id_token);
        document.location=("../controler/connexion.ctrl.php?login&google&token="+id_token);
      }
    </script>
  </body>
</html>
