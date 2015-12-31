<?php
   if (!isset($data))
      header("Location:"."../");
?>
<!DOCTYPE html>
<html>
<head>
  <?php include("../view/include/includes.view.php"); ?>
  <title>Dælium - Annuaire</title>
</head>
<body>
  <?php include("../view/include/header.view.php"); ?>
  <section>
    <article class="col-lg-offset-1 col-lg-11">

      <h1><?= $data["titre"] ?></h1>
      <h2>Etat de la negociation : <?= $data["etat"] ?></h2>
    </article>


    <article class="col-lg-offset-1 col-lg-3">
      <div class="info">

          <div class="panel panel-default">
            <div class="panel-heading">
              <h4>Informations</h4>
            </div>
            <div class="panel-body">
              <p>Groupe : <?= $data["nomgroupe"] ?><a href="../controler/groupe_fiche.ctrl.php?id=<?= $data["idgroupe"] ?>" type="button" class="btn btn-default">Voir Fiche</a> </p>
              <p>Manifestation : <?= $data["nommanif"] ?><a href="../controler/evenement_fiche.ctrl.php?id=<?= $data["idmanif"] ?>" type="button" class="btn btn-default">Voir Fiche</a> </p>
              <p>Booker : <?= $data["nombooker"] ?><a href="../controler/profil.ctrl.php?id=<?= $data["idbooker"] ?>" type="button" class="btn btn-default">Voir Fiche</a></p>
              <p>Organisateur : <?= $data["nomorga"] ?><a href="../controler/profil.ctrl.php?id=<?= $data["idorga"] ?>" type="button" class="btn btn-default">Voir Fiche</a></p>
              <p>Dates : <?= $data["datemanif"] ?> <p>


            </div>
          </div>
      </div>
    </article>
    <article class=" col-lg-4">
      <div class="info">

          <div class="panel panel-default">
            <div class="panel-heading">
              <h4>Documents</h4>
            </div>
            <div class="panel-body">



            </div>
          </div>
      </div>
    </article>

    <article class=" col-lg-3">
      <div class="info">

          <div class="panel panel-default">
            <div class="panel-heading">
              <h4>Actions</h4>
            </div>
            <div class="panel-body">
              <button type="button" class="btn btn-danger">Refuser la proposition</button></br>
              <button type="button" class="btn btn-warning">Negocier la proposition</button></br>
              <button type="button" class="btn btn-default">Relancer la proposition</button></br>
              <button type="button" class="btn btn-primary">Accepter la proposition</button></br>
              <button type="button" class="btn btn-default">Créer la facture</button>



            </div>
          </div>
      </div>
    </article>

    <article class="col-lg-offset-1 col-lg-10">
      <div class="info">

          <div class="panel panel-default">
            <div class="panel-heading">
              <h4>Historique</h4>
            </div>
            <div class="panel-body">
...


            </div>
          </div>
      </div>
    </article>

      <article class="message col-lg-offset-1 col-lg-10">
        <div class="panel panel-default">
          <div class="panel-heading">
            <h4>Messagerie Directe</h4>
          </div>
          <div class="panel-body">

            <div class="col-lg-12">
              <div class="col-lg-offset-2 col-lg-9" >
                <div class="well">
                  <p>Bonjour,<br/>
                    Je vous contacte car j'ai reçu de nouvelles informations et je ne pourrais pas venir ce Week-End. Je vous préviens donc que j'annule le rendez-vous.<br/>
                    Cordialement,
                    Laurianne</p>
                  </div>
                </div>
                <div class=" col-lg-1" >
                  <div class="well">
                    <p>Moi</p>
                  </div>
                </div>
              </div>

              <div class="col-lg-12">
                <div class="col-lg-1" >
                  <div class="well">
                    <p>Lui</p>
                  </div>
                </div>
                <div class="col-lg-9" >
                  <div class="well">
                    <p>Bonjour,<br/>
                      Je vous contacte car j'ai reçu de nouvelles informations et je ne pourrais pas venir ce Week-End. Je vous préviens donc que j'annule le rendez-vous.<br/>
                      Cordialement,
                      Laurianne</p>
                    </div>
                  </div>
                </div>


                <div class="class="col-lg-12"">
                  <div class="col-lg-offset-2 col-lg-9" >
                    <div class="well">
                      <p>Bonjour,<br/>
                        Je vous contacte car j'ai reçu de nouvelles informations et je ne pourrais pas venir ce Week-End. Je vous préviens donc que j'annule le rendez-vous.<br/>
                        Cordialement,
                        Laurianne</p>
                      </div>
                    </div>
                    <div class=" col-lg-1" >
                      <div class="well">
                        <p>Moi</p>
                      </div>
                    </div>
                  </div>



                <div class="col-lg-12">
                  <hr/>
                  <div class="col-lg-10">
                    <textarea class="form-control">Rédigez votre réponse ici ...</textarea>
                  </div>
                  <div class="col-lg-2 btn-group-vertical">
                    <button class="btn btn-primary btn-lg ">Envoyer</button>
                  </div>
                </div>


              </div>
            </div>
          </div>
        </article>
      </section>
      <?php include("../view/include/footer.view.php"); ?>
    </body>
    </html>
