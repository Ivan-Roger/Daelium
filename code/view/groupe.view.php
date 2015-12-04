<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <link rel="stylesheet" href="../data/css/bootstrap.css">
    <link rel="stylesheet" href="../data/css/common.css">
    <link rel="stylesheet" href="../data/css/groupe.css">
    <link rel="icon" type="image/png" href="../data/img/D.png" />
    <title>Dælium - Groupes - <?= $data['groupe']['nom'] ?></title>
  </head>
  <body>
    <?php include("../view/include/header.view.php"); ?>
    <div class="heading full">
      <img class="wall-pic" src="https://cdn2.artstation.com/p/assets/images/images/001/023/866/large/samma-van-klaarbergen-patrick-watson2.jpg?1438415706"/>
      <div class="groupInfo col-lg-10 col-lg-offset-1">
        <div class="groupPic col-sm-1 text-right"><img src="../data/img/icons/Group_64px.png" alt="Image de Profil"></div>
        <h3 class="col-sm-9"><?= $data['groupe']['nom'] ?></h3>
        <div class="controls col-sm-2 text-right">
          <a class="btn btn-primary" href="#">Editer</a>
        </div>
      </div>
    </div>
    <section class="col-lg-10 col-lg-offset-1">
      <article class="col-lg-6 infoProfile">
        <div class="well">
          <h4>Informations générales</h4>
          <div class="row">
            <span class="col-sm-4 text-right">Booker en charge</span><b class="col-sm-8 text-left" id="mailAccount">Jean-Louis Dupond</b>
          </div>
          <div class="row">
            <span class="col-sm-4 text-right">Nombre de membres</span><b class="col-sm-8 text-left" id="mailAccount"><?= $data['groupe']['nb'] ?></b>
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
          <h4>Artistes : </h4>
          <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="false">
            <?php foreach($data['artistes'] as $key => $art) { ?>
              <div class="panel panel-default">
                <div class="panel-heading" role="tab" id="headingArtist<?= $key ?>">
                  <h4 class="panel-title">
                    <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseArtist<?= $key ?>" aria-expanded="false" aria-controls="collapseArtist<?= $key ?>">
                      <?= $art['prenom'] ?> <?= $art['nom'] ?>
                    </a>
                  </h4>
                </div>
                <div id="collapseArtist<?= $key ?>" class="panel-collapse collapse in" aria-expanded="false" role="tabpanel" aria-labelledby="headingArtist<?= $key ?>">
                  <div class="panel-body">
                    Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
                  </div>
                </div>
              </div>
            <?php } ?>
          </div>
        </div>
        <div class="groupDesc col-lg-12 well">
          <h4>Description</h4>
          <textarea class="form-control" readonly>
            Je suis Booker depuis 2002 dans l'association Les petits gars à Grenoble. Toujours disponible ...
Je m'occupe actuellement de deux groupes : En marche et Batoucada
Pour me contacter utilisez l'adresse de contact.</textarea>
        </div>
      </article>
    </section>
    <?php include("../view/include/footer.view.php"); ?>
    <script src="http://code.jquery.com/jquery-1.11.3.min.js"></script>
    <script src="../data/js/bootstrap.min.js"></script>
  </body>
</html>
