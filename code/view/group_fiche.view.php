<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8" />
  <link rel="stylesheet" href="../data/css/bootstrap.css">
  <link rel="stylesheet" href="../data/css/artiste_fiche.css">
  <link rel="stylesheet" href="../data/css/common.css">
  <link rel="icon" type="image/png" href="../data/img/D.png" />
  <title>Dælium - Artiste - <?= $data['group']['name']?></title>
</head>
<body>
  <!-- Cette page est acessible par tout les Organisateur et Non inscrit , Cependant le booker a possibiliter de modifier la page -->
  <?php include("../view/include/header.view.php"); ?>
  <section class="col-lg-offset-1 col-lg-10">
    <!--
    Si Affichage de la fiche.

    Libre:
    Photo du groupe
    Biographie
    Album / EP / Titre Populaire , Explication
    Line Up (Video, clip)

    Fixe:
    - Photo du groupe (plus petite)

    - Player Audio
    - Reseaux sociaux
    - Concert passer et à venir
    (si organisateur sur site -> fiche technique)


    Si Modif de la fiche.
    Choix du player, reseaux, Concerts passés et à venir et fiche technique (oui /non)
    position du module en haut, en bas.
  -->
      <div class="panel panel-default">
        <div class="panel-heading"><h2 ><?= $data['group']['name']?></h2><a class ="btn btn-primary" href="../controler/group_fiche.ctrl.php?id=<?= $data['group']['id']?>&action=edit"> Modifier la fiche </a></div>
        <div class="panel-body">
          <img src="https://cdn2.artstation.com/p/assets/images/images/001/023/866/large/samma-van-klaarbergen-patrick-watson2.jpg?1438415706" />

          <h3>BIO</h3>
          <p>Dumque ibi diu moratur commeatus opperiens, quorum translationem ex Aquitania verni imbres solito crebriores prohibebant auctique torrentes, Herculanus advenit protector domesticus, Hermogenis ex magistro equitum filius, apud Constantinopolim, ut supra rettulimus, populari quondam turbela discerpti. quo verissime referente quae Gallus egerat, damnis super praeteritis maerens et futurorum timore suspensus angorem animi quam diu potuit emendabat.

Hinc ille commotus ut iniusta perferens et indigna praefecti custodiam protectoribus mandaverat fidis. quo conperto Montius tunc quaestor acer quidem sed ad lenitatem propensior, consulens in commune advocatos palatinarum primos scholarum adlocutus est mollius docens nec decere haec fieri nec prodesse addensque vocis obiurgatorio sonu quod si id placeret, post statuas Constantii deiectas super adimenda vita praefecto conveniet securius cogitari.

Quam ob rem cave Catoni anteponas ne istum quidem ipsum, quem Apollo, ut ais, sapientissimum iudicavit; huius enim facta, illius dicta laudantur. De me autem, ut iam cum utroque vestrum loquar, sic habetote.

Metuentes igitur idem latrones Lycaoniam magna parte campestrem cum se inpares nostris fore congressione stataria documentis frequentibus scirent, tramitibus deviis petivere Pamphyliam diu quidem intactam sed timore populationum et caedium, milite per omnia diffuso propinqua, magnis undique praesidiis conmunitam.

Postremo ad id indignitatis est ventum, ut cum peregrini ob formidatam haut ita dudum alimentorum inopiam pellerentur ab urbe praecipites, sectatoribus disciplinarum liberalium inpendio paucis sine respiratione ulla extrusis, tenerentur minimarum adseclae veri, quique id simularunt ad tempus, et tria milia saltatricum ne interpellata quidem cum choris totidemque remanerent magistris.<p>
            <h3>Album Hon Hop (2013)</h3>
            <p> Dumque ibi diu moratur commeatus opperiens, quorum translationem ex Aquitania verni imbres solito crebriores prohibebant auctique torrentes, Herculanus advenit protector domesticus, Hermogenis ex magistro equitum filius, apud Constantinopolim, ut supra rettulimus, populari quondam turbela discerpti. quo verissime referente quae Gallus egerat, damnis super praeteritis maerens et futurorum timore suspensus angorem animi quam diu potuit emendabat.

Hinc ille commotus ut iniusta perferens et indigna praefecti custodiam protectoribus mandaverat fidis. quo conperto Montius tunc quaestor acer quidem sed ad lenitatem propensior, consulens in commune advocatos palatinarum primos scholarum adlocutus est mollius docens nec decere haec fieri nec prodesse addensque vocis obiurgatorio sonu quod si id placeret, post statuas Constantii deiectas super adimenda vita praefecto conveniet securius cogitari.

Quam ob rem cave Catoni anteponas ne istum quidem ipsum, quem Apollo, ut ais, sapientissimum iudicavit; huius enim facta, illius dicta laudantur. De me autem, ut iam cum utroque vestrum loquar, sic habetote.

Metuentes igitur idem latrones Lycaoniam magna parte campestrem cum se inpares nostris fore congressione stataria documentis frequentibus scirent, tramitibus deviis petivere Pamphyliam diu quidem intactam sed timore populationum et caedium, milite per omnia diffuso propinqua, magnis undique praesidiis conmunitam.

Postremo ad id indignitatis est ventum, ut cum peregrini ob formidatam haut ita dudum alimentorum inopiam pellerentur ab urbe praecipites, sectatoribus disciplinarum liberalium inpendio paucis sine respiratione ulla extrusis, tenerentur minimarum adseclae veri, quique id simularunt ad tempus, et tria milia saltatricum ne interpellata quidem cum choris totidemque remanerent magistris.
            </p>
            <h3>LINE UP</h3>
            <p>Habens perpendiculum exaedificavit Octaviani sibi Herodes Ascalonem abundans quam ad egregias Caesaream Herodes cedentem aemulas: honorem est vicissim Gazam magna.</p>
            <iframe width="420" height="315" src="https://www.youtube.com/embed/ZLwWzNrdkTg" frameborder="0" allowfullscreen></iframe>
            <iframe width="420" height="315" src="https://www.youtube.com/embed/ZLwWzNrdkTg" frameborder="0" allowfullscreen></iframe>
          </div>
        </div>
        <div class="col-lg-4">
          <div class="panel panel-default">
            <div class="panel-heading">Player</div>

            <div class="panel-body">
              <iframe width="100%" height="300" scrolling="no" frameborder="no" src="https://w.soundcloud.com/player/?url=https%3A//api.soundcloud.com/tracks/231318729&amp;auto_play=false&amp;hide_related=false&amp;show_comments=true&amp;show_user=true&amp;show_reposts=false&amp;visual=true"></iframe>
            </div>
          </div>
        </div>
        <div class="col-lg-4">
          <div class="panel panel-default">
            <div class="panel-heading">Reseaux sociaux</div>
            <div class="panel-body">
              <iframe allowtransparency="true" scrolling="no" frameborder="no" src="https://w.soundcloud.com/icon/?url=http%3A%2F%2Fsoundcloud.com%2Fetienne-barbier&color=orange_transparent&size=48" style="width: 48px; height: 48px;"></iframe>
              <script src="https://apis.google.com/js/platform.js" async defer></script>
              <g:plusone></g:plusone>
              <div class="fb-share-button" data-href="https://developers.facebook.com/docs/plugins/" data-layout="button_count"></div>
            </div>
          </div>
        </div>
        <div class="col-lg-4">
          <div class="panel panel-default">
            <div class="panel-heading"><?= $data["group"]['name']?> en concert</div>
              <h4>Futur</h4>
                <ul>
                  <li>15 Janvier a Marseille</li>
                  <li>18Janvier a Paris</li>
                  <li>20 Janvier a Grenoble</li>
                  <li>15 Fevrier a Lyon</li>
                </ul>
              <h4>Passé</h4>
            <div class="panel-body">
              <ul>
                <li>05 Novembre a Tours</li>
                <li>06 Novembre a Brest</li>
                <li>17 Septembre a Lille</li>
                <li>26 Aout a Bordeau</li>
              </ul>
            </div>
          </div>
        </div>
    </section>
    <?php include("../view/include/footer.view.php"); ?>
    <script src="http://code.jquery.com/jquery-1.11.3.min.js"></script>
    <script src="../data/js/bootstrap.min.js"></script>
    <div id="fb-root"></div>
    <script>
      (function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s); js.id = id;
        js.src = "//connect.facebook.net/fr_FR/sdk.js#xfbml=1&version=v2.5";
        fjs.parentNode.insertBefore(js, fjs);
      }(document, 'script', 'facebook-jssdk'));
    </script>
  </body>
</html>
