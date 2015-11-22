<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8" />
  <link rel="stylesheet" href="../data/css/bootstrap.css">
  <link rel="stylesheet" href="../data/css/artiste_fiche.css">
  <link rel="stylesheet" href="../data/css/common.css">
  <title>Dælium - Artiste - <?= $data["artistegroupe"]['nomscene']?></title>
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
    - Photo du groupe

    - Player Audio
    - Reseaux sociaux
    - Concert passer et à venir
    (si organisateur sur site -> fiche technique)


    Si Modif de la fiche.
    Choix du player, reseaux, Concert passer et a venir et fiche technique (oui /non)
    position du module en haut, en bas.
  -->

  <?php if($data["action"] == "edit") { ?>

    <form class="form-horizontal" role="form">
      <h2 >Fiche de "<?= $data["artistegroupe"]['nomscene']?>"</h2>
      <article class="col-lg-offset-2 col-lg-10">
        <div class="navbar navbar-form navbar-right">
          <a class ="btn btn-default" href="../controler/artiste.ctrl.php?artiste=<?= $data["artistegroupe"]['nomscene']?>"> Retour </a>
          <INPUT class ="btn btn-warning" TYPE="reset" NAME="nom" VALUE="Annuler">
          <INPUT class ="btn btn-primary" TYPE="submit" NAME="nom" VALUE="Enregister">
        </div>
      </article>
      <div class="col-lg-12">
        <div class="panel panel-default">
          <div class="panel-heading">Elements/Position</div>
          <div class="panel-body">
            <div class="form-group">
              <label class="control-label col-sm-3" for="rs">Panneau Reseaux sociaux :</label>
              <div class="col-sm-3 btn-group" data-toggle="buttons" id="fonction">
                <label class="btn btn-default active">
                  <input type="radio" name="rsa" id="option1" value="on" checked > Actif
                </label>
                <label class="btn btn-default">
                  <input type="radio" name="rsa" id="option2" value="off" > Inactif
                </label>
              </div>
              <label class="control-label col-sm-2" for="rsp">Position :</label>
              <div class="col-sm-4 btn-group" data-toggle="buttons" id="fonction">
                <label class="btn btn-default ">
                  <input type="radio" name="rsp" id="option1" value="haut" > En haut de la page
                </label>
                <label class="btn btn-default active">
                  <input type="radio" name="rsp" id="option2" value="bas" checked> En bas de la page
                </label>
              </div>
            </div>
            <hr>
            <div class="form-group">
              <label class="control-label col-sm-3" for="lec">Panneau Lecteur :</label>
                <div class="col-sm-3 btn-group" data-toggle="buttons" id="fonction">
                  <label class="btn btn-default active">
                    <input type="radio" name="leca" id="option1" value="on" checked > Actif
                  </label>
                  <label class="btn btn-default">
                    <input type="radio" name="leca" id="option2" value="off" > Inactif
                  </label>
                </div>
                <label class="control-label col-sm-2" for="lecp">Position :</label>
                <div class="col-sm-4 btn-group" data-toggle="buttons" id="fonction">
                  <label class="btn btn-default ">
                    <input type="radio" name="lecp" id="option1" value="haut" > En haut de la page
                  </label>
                  <label class="btn btn-default active">
                    <input type="radio" name="lecp" id="option2" value="bas" checked> En bas de la page
                  </label>
                </div>
            </div>
            <hr>
            <div class="form-group">
              <label class="control-label col-sm-3" for="conc">Panneau Concert passé/futur :</label>
              <div class="col-sm-3 btn-group" data-toggle="buttons" id="fonction">
                <label class="btn btn-default active">
                  <input type="radio" name="conc" id="option1" value="on" checked > Actif
                </label>
                <label class="btn btn-default ">
                  <input type="radio" name="conc" id="option2" value="off" > Inactif
                </label>
              </div>
                <label class="control-label col-sm-2" for="concp">Position :</label>
                <div class="col-sm-4 btn-group" data-toggle="buttons" id="fonction">
                  <label class="btn btn-default ">
                    <input type="radio" name="concp" id="option1" value="haut" > En haut de la page
                  </label>
                  <label class="btn btn-default active">
                    <input type="radio" name="concp" id="option2" value="bas" checked> En bas de la page
                  </label>
                </div>
            </div>
            <hr>
            <div class="form-group">
              <label class="control-label col-sm-3" for="imgc">Image de couverture :</label>
              <div class="col-sm-3 btn-group" data-toggle="buttons" id="fonction">
                <label class="btn btn-default active">
                  <input type="radio" name="imgc" id="option1" value="on" checked > Actif
                </label>
                <label class="btn btn-default ">
                  <input type="radio" name="imgc" id="option2" value="off" > Inactif
                </label>
              </div>
                <label class="control-label col-sm-2" for="imgp">Position :</label>
                <div class="col-sm-4 btn-group" data-toggle="buttons" id="fonction">
                  <label class="btn btn-default active">
                    <input type="radio" name="imgp" id="option1" value="haut" checked> En haut de la page
                  </label>
                  <label class="btn btn-default ">
                    <input type="radio" name="imgp" id="option2" value="bas" > En bas de la page
                  </label>
                </div>
            </div>
            <hr>
            <div class="form-group">
              <label class="control-label col-sm-3" for="ft">Lien vers fiche technique :</label>
              <div class="col-sm-3 btn-group" data-toggle="buttons" id="fonction">
                <label class="btn btn-default active">
                  <input type="radio" name="ft" id="option1" value="on" checked > Public
                </label>
                <label class="btn btn-default">
                  <input type="radio" name="ft" id="option1" value="on"> Inscrit sur le site
                </label>
                <label class="btn btn-default ">
                  <input type="radio" name="ft" id="option2" value="off" > Inactif
                </label>
              </div>
                <label class="control-label col-sm-2" for="ftp">Position :</label>
                <div class="col-sm-4 btn-group" data-toggle="buttons" id="fonction">
                  <label class="btn btn-default ">
                    <input type="radio" name="ftp" id="option1" value="haut" > En haut de la page
                  </label>
                  <label class="btn btn-default active">
                    <input type="radio" name="ftp" id="option2" value="bas" checked> En bas de la page
                  </label>
                </div>
            </div>
          </div>
        </div>
      </div>

      <div class="col-lg-12">
        <div class="panel panel-default">
          <div class="panel-heading">Image de couverture</div>
          <div class="panel-body">
            Choisir un fichier ou l'envoyer
          </div>
        </div>
      </div>

      <div class="col-lg-12">
        <div class="panel panel-default">
          <div class="panel-heading">Reseaux sociaux</div>
          <div class="panel-body">
            <div class="form-group">
              <label class="control-label col-sm-2" for="face">Facebook :</label>
              <div class="col-sm-8">
                <input type="text" id="face" name="face" class="form-control" />
              </div>
              <div class="col-sm-2 btn-group" data-toggle="buttons" id="fonction">
                <label class="btn btn-default active">
                  <input type="radio" name="facea" id="option1" value="on" checked="checked" > Actif
                </label>
                <label class="btn btn-default">
                  <input type="radio" name="facea" id="option2" value="off" > Inactif
                </label>
              </div>
            </div>

            <div class="form-group">
              <label class="control-label col-sm-2" for="twt">Twitter :</label>
              <div class="col-sm-8">
                <input type="text" id="face" name="twt" class="form-control" />
              </div>
              <div class="col-sm-2 btn-group" data-toggle="buttons" id="fonction">
                <label class="btn btn-default active">
                  <input type="radio" name="twta" id="option1" value="on" checked="checked" > Actif
                </label>
                <label class="btn btn-default">
                  <input type="radio" name="twta" id="option2" value="off" > Inactif
                </label>
              </div>
            </div>

            <div class="form-group">
              <label class="control-label col-sm-2" for="gg">Google+ :</label>
              <div class="col-sm-8">
                <input type="text" id="gg" name="gg" class="form-control" />
              </div>
              <div class="col-sm-2 btn-group" data-toggle="buttons" id="fonction">
                <label class="btn btn-default active">
                  <input type="radio" name="gga" id="option1" value="on" checked="checked" > Actif
                </label>
                <label class="btn btn-default">
                  <input type="radio" name="gga" id="option2" value="off" > Inactif
                </label>
              </div>
            </div>


            <div class="form-group">
              <label class="control-label col-sm-2" for="sc">SoundCloud :</label>
              <div class="col-sm-8">
                <input type="text" id="sc" name="sc" class="form-control" />
              </div>
              <div class="col-sm-2 btn-group" data-toggle="buttons" id="fonction">
                <label class="btn btn-default active">
                  <input type="radio" name="sca" id="option1" value="on" checked="checked" > Actif
                </label>
                <label class="btn btn-default">
                  <input type="radio" name="sca" id="option2" value="off" > Inactif
                </label>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="col-lg-12">
        <div class="panel panel-default">
          <div class="panel-heading">Lecteurs</div>
          <div class="panel-body">
            <textarea rows="4" cols="175%"> </textarea>
          </div>
        </div>
      </div>

      <div class="col-lg-12">
        <div class="panel panel-default">
          <div class="panel-heading">Contenu de la page</div>
          <div class="panel-body">
            <textarea rows="4" cols="175%"> </textarea>
          </div>
        </div>
      </div>

    </form>



    <?php }else if($data["action"] == "view") { ?>
      <div class="panel panel-default">
        <div class="panel-heading"><h2 ><?= $data["artistegroupe"]['nomscene']?></h2><a class ="btn btn-primary" href="../controler/artiste_fiche.ctrl.php?artiste=<?= $data["artistegroupe"]['nomscene']?>&action=edit"> Modifier la fiche </a></div>
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
            <div class="panel-heading"><?= $data["artistegroupe"]['nomscene']?> en concert</div>
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

        <?php }else{ ?>

          <?php } ?>
        </section>
        <?php include("../view/include/footer.view.php"); ?>
        <script src="http://code.jquery.com/jquery-1.11.3.min.js"></script>
        <script src="../data/js/bootstrap.min.js"></script>
        <div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/fr_FR/sdk.js#xfbml=1&version=v2.5";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
      </body>
      </html>
