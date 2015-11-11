<!DOCTYPE html>
<html>
<header>
  <meta charset="utf-8"/>
  <title>Daelium | Work in Progress</title>
  <link rel="stylesheet" href="../view/bootstrap/css/bootstrap.min.css"/>
  <link rel="stylesheet" href="../view/signin.css"/>
</header>
<body>
  <div class="container">
        <div class="card card-container">

            <!-- <img class="profile-img-card" src="//lh3.googleusercontent.com/-6V8xOA6M7BA/AAAAAAAAAAI/AAAAAAAAAAA/rzlHcD0KYwo/photo.jpg?sz=120" alt="" /> -->
            <img id="profile-img" class="profile-img-card" src="../view/img/D.png" />
            <p id="profile-name" class="profile-name-card">Bienvenue !</p>
            <HR>
            <p class="social" ><a href="#"><img src="https://developers.google.com/identity/images/btn_google_signin_light_normal_web.png" /></a></p>
            <HR>
            <form class="form-signin">
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
          </br>
            <a href="#" class="forgot-password">
                Inscription
            </a>
        </div><!-- /card-container -->
    </div><!-- /container -->

<script src="http://code.jquery.com/jquery-1.11.3.min.js"></script>
<script src="../view/bootstrap/js/bootstrap.min.js"></script>
</body>
</html>
