<?php
if (!isset($data))
header("Location:"."../");
?>
<!DOCTYPE html>
<html>
<head>
  <?php include("../view/include/includes.view.php"); ?>
  <link rel="stylesheet" href="../data/css/groupe.css">
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
        <a class="btn btn-primary" href="../controler/groupe_fiche.ctrl.php?id=<?= $data['groupe']['id'] ?>&action=edit">Editer</a>
      </div>
    </div>
  </div>
  <section class="col-lg-10 col-lg-offset-1">
    <article class="col-lg-6 infoProfile">

      <!-- Infos -->
      <div class="well">
        <h4>Informations générales :</h4>
        <div class="row">
          <span class="col-sm-4 text-right">Nom du Groupe</span><b class="col-sm-8 text-left" id="mailAccount"><?= $data['groupe']['nom'] ?></b>
        </div>
          <div class="row">
            <span class="col-sm-4 text-right">Nombre de membres</span><b class="col-sm-8 text-left" id="mailAccount"><?= $data['groupe']['nb'] ?></b>
          </div>
          <div class="row">
            <span class="col-sm-4 text-right">Genre</span><b class="col-sm-8 text-left" id="mailAccount">A mettre</b>
          </div>
          <div class="row">
            <span class="col-sm-4 text-right">Booker en charge</span>
              <b class="col-sm-8 text-left" id="mailAccount"><?=   $data["booker"]["prenom"]." ".  $data["booker"]["nom"] ?> <a class="btn btn-primary" href="../controler/profil.ctrl.php?id=<?=   $data["booker"]['id'] ?>">Voir Profil</a></b>
            </div>
        </div>
        <!-- Fin Infos -->


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

              <!-- Liste des Artistes -->
              <div class="col-lg-12 well">
                <h4>Artistes : </h4>
                <div class="panel-group" id="accordion" role="tablist">
                  <?php foreach($data['artistes'] as $key => $art) { ?>
                    <div class="panel panel-default">
                      <div class="panel-heading" role="tab" id="headingArtist<?= $key ?>">
                        <h4 class="panel-title">
                          <a  class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseArtist<?= $key ?>" aria-expanded="false" aria-controls="collapseArtist<?= $key ?>">
                            <?= $art['prenom'] ?> <?= $art['nom'] ?>
                          </a>
                        </h4>
                      </div>
                      <div id="collapseArtist<?= $key ?>" class="panel-collapse collapse" aria-expanded="false" role="tabpanel" aria-labelledby="headingArtist<?= $key ?>">
                        <div class="panel-body">
                          <?= $art['description'] ?>
                        </div>
                      </div>
                    </div>
                    <?php } ?>
                  </div>
                </div>
                <!-- Liste des Artistes -->

              </article>
              <article class="col-lg-12">
                <!-- Fiche Com -->

                <div class="well">
                  <h4>Presentation :</h4>
                  <p>Dumque ibi diu moratur commeatus opperiens, quorum translationem ex Aquitania verni imbres solito crebriores prohibebant auctique torrentes, Herculanus advenit protector domesticus, Hermogenis ex magistro equitum filius, apud Constantinopolim, ut supra rettulimus, populari quondam turbela discerpti. quo verissime referente quae Gallus egerat, damnis super praeteritis maerens et futurorum timore suspensus angorem animi quam diu potuit emendabat.<br/>
                    Hinc ille commotus ut iniusta perferens et indigna praefecti custodiam protectoribus mandaverat fidis. quo conperto Montius tunc quaestor acer quidem sed ad lenitatem propensior, consulens in commune advocatos palatinarum primos scholarum adlocutus est mollius docens nec decere haec fieri nec prodesse addensque vocis obiurgatorio sonu quod si id placeret, post statuas Constantii deiectas super adimenda vita praefecto conveniet securius cogitari.<br/>
                    Quam ob rem cave Catoni anteponas ne istum quidem ipsum, quem Apollo, ut ais, sapientissimum iudicavit; huius enim facta, illius dicta laudantur. De me autem, ut iam cum utroque vestrum loquar, sic habetote.<br/>
                    Metuentes igitur idem latrones Lycaoniam magna parte campestrem cum se inpares nostris fore congressione stataria documentis frequentibus scirent, tramitibus deviis petivere Pamphyliam diu quidem intactam sed timore populationum et caedium, milite per omnia diffuso propinqua, magnis undique praesidiis conmunitam.<br/>
                    Postremo ad id indignitatis est ventum, ut cum peregrini ob formidatam haut ita dudum alimentorum inopiam pellerentur ab urbe praecipites, sectatoribus disciplinarum liberalium inpendio paucis sine respiratione ulla extrusis, tenerentur minimarum adseclae veri, quique id simularunt ad tempus, et tria milia saltatricum ne interpellata quidem cum choris totidemque remanerent magistris.</p>
                  </div>
                  <!-- Fin Fiche Com -->
                </article>
              </section>
              <?php include("../view/include/footer.view.php"); ?>
              <script src="../data/js/groupe.js"></script>
            </body>
            </html>
