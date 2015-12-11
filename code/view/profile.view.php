<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <link rel="stylesheet" href="../data/css/bootstrap.css">
    <link rel="stylesheet" href="../data/css/common.css">
    <link rel="stylesheet" href="../data/css/profile.css">
    <link rel="icon" type="image/png" href="../data/img/D.png" />
    <title>Dælium - Profil</title>
  </head>
  <body>
    <?php include("../view/include/header.view.php"); ?>
    <div class="heading full">
      <img class="wall-pic" src="../data/img/fotolia_musique.jpg"/>
      <div class="userInfo col-xs-10 col-xs-offset-1">
        <div class="col-xs-1 text-right"><img src="../data/users/icons/User_64.png" alt="Image de Profil"></div>
        <h3 class="col-xs-9">Marc Dupuis</h3>
        <div class="controls col-xs-2 text-right">
          <a class="btn btn-primary" href="#">Editer</a>
        </div>
      </div>
    </div>
    <section class="col-lg-10 col-lg-offset-1">
      <article class="col-lg-6 infoProfile">
        <div class="well">
          <h4>Contact</h4>
          <div class="row">
            <span class="col-sm-4 text-right">Mail du compte</span><b class="col-sm-8 text-left" id="mailAccount">marc.dupuis@gmail.com</b>
          </div>
          <div class="row">
            <span class="col-sm-4 text-right">Mail de contact</span><b class="col-sm-8 text-left" id="mailAccount">m.dupuis@les-petits-gars.fr</b>
          </div>
          <div class="row">
            <span class="col-sm-4 text-right">Numéro de mobile</span><b class="col-sm-8 text-left" id="mailAccount">06 04 12 53 52</b>
          </div>
          <div class="row">
            <span class="col-sm-4 text-right">Numéro professionel</span><b class="col-sm-8 text-left" id="mailAccount">04 95 63 21 14</b>
          </div>
        </div>
        <div class="well">
          <h4>Position</h4>
          <div class="row">
            <span class="col-sm-4 text-right">Adresse</span><b class="col-sm-8 text-left" id="adress">2 Place Doyen Gosse<br/>38000 Grenoble</b>
          </div>
          <div class="row">
            <span class="col-sm-4 text-right">Plan</span>
            <a href="https://www.google.fr/maps/place/2+Place+Doyen+Gosse,+38000+Grenoble/@45.1919241,5.717596,18z/data=!4m2!3m1!1s0x478af4872c0a703f:0x6503d8b580fceb38" target="_blank">
              Voir sur gogle maps
            </a>
          </div>
        </div>
      </article>
      <article class="col-lg-6">
        <div class="col-lg-12 well">
          <h4>Mes groupes : </h4>
          <ul class="groups list-group">
            <li class="list-group-item">
              <span class="group-name col-sm-10">En marche</span>
              <div class="col-sm-2">
                <a class="btn btn-default" href="groupe_fiche.ctrl.php?id=<?= "a" ?>">Voir fiche</a>
              </div>
            </li>
            <li class="list-group-item">
              <span class="group-name col-sm-10">Batoucada</span>
              <div class="col-sm-2">
                <a class="btn btn-default" href="groupe_fiche.ctrl.php?id=<?= "a" ?>">Voir fiche</a>
              </div>
            </li>
          </ul>
        </div>
        <div class="userDesc col-lg-12 well">
          <h4>Description</h4>
          <textarea class="form-control" readonly>
            Je suis Booker depuis 2002 dans l'association Les petits gars à Grenoble. Toujours disponible ...
Je m'occupe actuellement de deux groupes : En marche et Batoucada
Pour me contacter utilisez l'adresse de contact.</textarea>
        </div>
      </article>
    </section>
    <?php include("../view/include/footer.view.php"); ?>
    <script src="../data/js/jQuery.min.js"></script>
    <script src="../data/js/bootstrap.min.js"></script>
  </body>
</html>
