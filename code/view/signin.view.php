<!DOCTYPE html>
<html>
<header>
  <meta charset="utf-8"/>
  <title>Daelium | Work in Progress</title>
  <link rel="stylesheet" href="../data/css/bootstrap.min.css"/>
  <link rel="stylesheet" href="../data/css/signin.css"/>
  <link rel="icon" type="image/png" href="../data/img/D.png" />
</header>
<body>
  <div class="container">
        <div class="card card-container">

            <!-- <img class="profile-img-card" src="//lh3.googleusercontent.com/-6V8xOA6M7BA/AAAAAAAAAAI/AAAAAAAAAAA/rzlHcD0KYwo/photo.jpg?sz=120" alt="" /> -->
            <img id="profile-img" class="profile-img-card" src="../data/img/D.png" />
            <p id="profile-name" class="profile-name-card">Bienvenue !</p>
            <hr/>
            <p class="social" ><a href="#"><img src="../data/img/google_signIn.png" /></a></p>
            <hr/>
            <form class="form-signin" method="POST" action="../controler/connexion.ctrl.php">
                <span id="reauth-email" class="reauth-email"></span>
                <input type="email" id="inputEmail" class="form-control" placeholder="Adresse mail" required autofocus>
                <input type="password" id="inputPassword" class="form-control" placeholder="Mot de passe" required>
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
  </body>
</html>
