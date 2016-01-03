<?php
if (!isset($data))
header("Location:"."../");
?>
<!DOCTYPE html>
<html>
<head>
  <?php include("../view/include/includes.view.php"); ?>
  <link rel="stylesheet" href="../data/css/groupe.css">
  <title>Dælium - Evenement - <?= $data['evenement']['nom'] ?></title>
</head>
<body>
  <?php include("../view/include/header.view.php"); ?>
  <div class="heading full">
    <img class="wall-pic" src="https://cdn2.artstation.com/p/assets/images/images/001/023/866/large/samma-van-klaarbergen-patrick-watson2.jpg?1438415706"/>
    <div class="groupInfo col-lg-10 col-lg-offset-1">
      <div class="groupPic col-sm-1 text-right"><img src="<?= $data['evenement']['img']  ?>" alt="Image de Profil"></div>
      <h3 class="col-sm-9"><?= $data['evenement']['nom'] ?> (<?= $data['evenement']['type'] ?>)</h3>
      <div class="controls col-sm-2 text-right">
        <a class="btn btn-primary" href="../controler/evenement_fiche.ctrl.php?id=<?= $data['evenement']['id'] ?>&action=edit">Editer</a>
      </div>
    </div>
  </div>
  <section class="col-lg-10 col-lg-offset-1">
    <article class="col-lg-6 infoProfile">

      <!-- Info -->
      <div class="well">
        <h4>Informations générales :</h4>
        <div class="row">
          <span class="col-sm-4 text-right">Organisateur</span><b class="col-sm-8 text-left" id="mailAccount"> <?= $data['evenement']['organisateur'] ?> <a class="btn btn-primary" href="../controler/profil.ctrl.php?id=<?= $data['evenement']['idorganisateur']?>">Voir Profil</a></b>
        </div>
        <div class="row">
          <span class="col-sm-4 text-right">Lieu</span><b class="col-sm-8 text-left" id="mailAccount"><?= $data['evenement']['lieu']['adresse'] ?> <?php if($data['evenement']['lieu']['googlemaps'] != NULL){ ?><a href="<?=  $data['evenement']['lieu']['googlemaps'] ?>" target="_blank">
            (Voir sur google maps)
          </a><?php }?></b>
        </div>
        <div class="row">
          <span class="col-sm-4 text-right">Date de début</span><b class="col-sm-8 text-left" id="mailAccount"> <?= $data['evenement']['dated'] ?></b>
        </div>
        <div class="row">
          <span class="col-sm-4 text-right">Date de fin</span><b class="col-sm-8 text-left" id="mailAccount"><?= $data['evenement']['datef'] ?></b>
        </div>
      </div>
      <!-- Fin Info -->




      </article>
      <article class="col-lg-6">

        <!-- Reseaux sociaux -->
        <div class="well">
          <h4>Reseaux sociaux :</h4>
          <?= $data['evenement']["rs"] ?>
          <?php if($data['evenement']["facebook"] != NULL){ ?>
            <a href="<?= $data['evenement']["facebook"]  ?>">Facebook : <img src="../data/img/icons/facebook.jpg" height="50" width="50"  alt="facebook"/></a>
            <?php } if($data['evenement']["google"] != NULL){ ?>
              <a href="<?= $data['evenement']["google"]  ?>">Google + : <img src="../data/img/icons/google+.jpeg" height="50" width="50" alt="Google +"/></a>
              <?php } if($data['evenement']["twitter"] != NULL){ ?>
                <a href="<?= $data['evenement']["twitter"]  ?>">Twitter : <img src="../data/img/icons/twitter.jpg" height="50" width="50" alt="Twitter"/></a>
                <?php } ?>
                <p></p>
              </div>
              <!-- FIN Reseaux sociaux -->

              <!-- Progarmation -->
              <div class="col-lg-12 well">
                <h4>Programation : </h4>
                <div class="panel-group" id="accordion" role="tablist">
                  <?php foreach($data['passages'] as $key => $pas) { ?>
                    <div class="panel panel-default">
                      <div class="panel-heading" role="tab" id="headingPassage<?= $key ?>">
                        <h4 class="panel-title">
                          <a  class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapsePassage<?= $key ?>" aria-expanded="false" aria-controls="collapsePassage<?= $key ?>">
                            <?= $pas['date'] ?> - <?= $pas['groupe']['nom'] ?>
                          </a>
                        </h4>
                      </div>
                      <div id="collapsePassage<?= $key ?>" class="panel-collapse collapse" aria-expanded="false" role="tabpanel" aria-labelledby="headingArtist<?= $key ?>">
                        <div class="panel-body">
                          <a class="btn btn-primary" href="../controler/groupe_fiche.ctr.php?id=<?= $pas['groupe']['id']?>">Voir Fiche</a></br>
                          <?= $pas['groupe']['description'] ?>
                        </div>
                      </div>
                    </div>
                    <?php } ?>
                  </div>
                </div>
                <!-- FIN Progarmation -->

                <!-- Media  -->
                <?php if (isset($data['medias'][0])) { ?>
                  <div class="col-lg-12 well" id="medias">
                    <h4>Medias : </h4>
                    <p>Habens perpendiculum exaedificavit Octaviani sibi Herodes Ascalonem abundans quam ad egregias Caesaream Herodes cedentem aemulas: honorem est vicissim Gazam magna.</p>
                    <div class="frames">
                      <div id="frameList" class="col-xs-3">
                        <ul class="nav nav-pills nav-stacked">
                          <?php foreach($data['medias'] as $key => $medias) { ?>
                            <li <?php echo($key==0?"class='active'":"");?>><a class="btn btn-default" data-url="<?= $lineUp['url'] ?>"><?= $medias['nom'] ?></a></li>
                            <?php } ?>
                          </ul>
                        </div>
                        <div class="col-md-9" style="width: 420px; height: 215px;">
                          <iframe id="frameContent" width="100%" height="100%" src="<?= $data['lineUp'][0]['url'] ?>" frameborder="0" allowfullscreen></iframe>
                        </div>
                      </div>
                    </div>
                    <?php } ?>
                    <!-- Fin Media  -->

                  </article>
                  <article class="col-lg-12">
                    <!-- Fiche Com -->
                    <div class="well">
                      <h4>Presentation :</h4>
                      <?=  $data['evenement']["fichecom"] ?>
                      </div>
                      <!-- FIN Fiche Com -->
                  </article>
                </section>
                <?php include("../view/include/footer.view.php"); ?>
                <script src="../data/js/groupe.js"></script>
              </body>
              </html>
