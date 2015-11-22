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
            <p id="profile-name" class="profile-name-card">Bienvenue chez Daelium !</p>
            <HR>
            <p class="social" ><a href="#"><img src="../data/img/google_signIn.png" /></a></p>
            <HR>
            <form class="form-signin">
                <span id="reauth-email" class="reauth-email"></span>
                <input type="text" id="inputText" class="form-control" placeholder="Nom" required autofocus>
                <input type="text" id="inputText" class="form-control" placeholder="Prenom" required>
                <input type="email" id="inputEmail" class="form-control" placeholder="Mail" required>
                <input type="password" id="inputPassword" class="form-control" placeholder="Mot de passe" required>
                <input type="password" id="inputPassword" class="form-control" placeholder="Confirmation mot de passe" required>
                <input type="tel" id="inputPhone" class="form-control" placeholder="Numero de téléphone"/>
              </br>
                <button class="btn btn-lg btn-primary btn-block btn-signin" type="submit">Inscription</button>
            </form><!-- /form -->
        </div><!-- /card-container -->
    </div><!-- /container -->
    <script src="http://code.jquery.com/jquery-1.11.3.min.js"></script>
    <script src="../data/js/bootstrap.min.js"></script>
  </body>
</html>
