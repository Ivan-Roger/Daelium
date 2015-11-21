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

      <div class="col-lg-12">
        <div class="panel panel-default">
          <div class="panel-heading">Elements/Position</div>
          <div class="panel-body">
            <div class="form-group">
              <label class="control-label col-sm-3" for="rs">Panneau Reseaux sociaux :</label>
              <div class="col-sm-2">
                <input type="checkbox" name="rsa" value="rsa"> Actif
              </div>
              <label class="control-label col-sm-2" for="rsp">Position :</label>
              <div class="col-sm-5">
                <INPUT type="radio" name="rsp" value="haut"> En haut de la page
                <INPUT type="radio" name="rsp" value="bas"> En bas de la page
              </div>
            </div>
            <hr>
            <div class="form-group">
              <label class="control-label col-sm-3" for="lec">Panneau Lecteur :</label>
              <div class="col-sm-2">
                <input type="checkbox" name="leca" value="leca"> Actif
              </div>
                <label class="control-label col-sm-2" for="lecp">Position :</label>
              <div class="col-sm-4">
                <INPUT type="radio" name="lecp" value="haut"> En haut de la page
                <INPUT type="radio" name="lecp" value="bas"> En bas de la page
              </div>
            </div>
            <hr>
            <div class="form-group">
              <label class="control-label col-sm-3" for="conc">Panneau Concert passé/futur :</label>
              <div class="col-sm-2">
                <input type="checkbox" name="conca" value="conca"> Actif
              </div>
                <label class="control-label col-sm-2" for="concp">Position :</label>
              <div class="col-sm-5">
                <INPUT type="radio" name="concp" value="haut"> En haut de la page
                <INPUT type="radio" name="concp" value="bas"> En bas de la page
              </div>
            </div>
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
              <div class="col-sm-2">
                <input type="checkbox" name="facea" value="facea"> Actif
              </div>
            </div>

            <div class="form-group">
              <label class="control-label col-sm-2" for="gg">Google+ :</label>
              <div class="col-sm-8">
                <input type="text" id="gg" name="gg" class="form-control" />
              </div>
              <div class="col-sm-2">
                <input type="checkbox" name="gga" value="gga"> Actif
              </div>
            </div>


            <div class="form-group">
              <label class="control-label col-sm-2" for="sc">SoundCloud :</label>
              <div class="col-sm-8">
                <input type="text" id="sc" name="sc" class="form-control" />
              </div>
              <div class="col-sm-2">
                <input type="checkbox" name="sca" value="sca"> Actif
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
        <div class="panel-heading"><h2><?= $data["artistegroupe"]['nomscene']?></h2><a class ="btn btn-primary" href="../controler/artiste_fiche.ctrl.php?artiste=<?= $data["artistegroupe"]['nomscene']?>&action=edit"> Modifier la fiche </a></div>
        <div class="panel-body">
          <img src="https://cdn2.artstation.com/p/assets/images/images/001/023/866/large/samma-van-klaarbergen-patrick-watson2.jpg?1438415706" />

          <h3>BIO</h3>
          <p>Passionné de musiques et d'instruments au plus jeune age, Benjamin Nectoux explore l'univers de l'electro pour composer des morceaux aux mélanges traditionnels et instrumentales. Deyosan, c'est le plaisir de mélanger les rythmes et les sons, préparer une mixture à la recherche de sensations musicales. C'est bien un collectif qui se construit au fil des rencontres artistiques : sitar, n'goni, chant, clarinette, violon... croisent leur chemins, se quittent, se retrouvent le temps d'un morceau.<p>
            <h3>Album Hon Hop (2013)</h3>
            <p> C'est à travers le métissage, le mélange des esthétiques, des instruments, des influences, des voix que Deyosan a construit cet album. L'expérience Hon Hop ("mixture" en vietnamien), compositions électroniques rythmés à d'autres plus immersives et prenantes, invite le public et l'auditeur au voyage et à la découverte.
            </p>
            <h3>LINE UP</h3>
            <p>Sitar/Machine, Chant N'Goni, Didgeridoo, Violon, Clarinette...</p>
            <iframe width="560" height="315" src="https://www.youtube.com/embed/T4_iS3vdUTA" frameborder="0" allowfullscreen></iframe>
            <iframe width="560" height="315" src="https://www.youtube.com/embed/T4_iS3vdUTA" frameborder="0" allowfullscreen></iframe>
          </div>
        </div>
        <div class="col-lg-4">
          <div class="panel panel-default">
            <div class="panel-heading">Player</div>
            <div class="panel-body">
            </div>
          </div>
        </div>
        <div class="col-lg-4">
          <div class="panel panel-default">
            <div class="panel-heading">Reseaux sociaux</div>
            <div class="panel-body">
            </div>
          </div>
        </div>
        <div class="col-lg-4">
          <div class="panel panel-default">
            <div class="panel-heading"><?= $data["artistegroupe"]['nomscene']?> en concert</div>
            <div class="panel-body">
            </div>
          </div>
        </div>

        <?php }else{ ?>

          <?php } ?>
        </section>
        <?php include("../view/include/footer.view.php"); ?>
        <script src="http://code.jquery.com/jquery-1.11.3.min.js"></script>
        <script src="../data/js/bootstrap.min.js"></script>
      </body>
      </html>
