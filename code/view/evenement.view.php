<?php
   if (!isset($data))
      header("Location:"."../");
?>
<!DOCTYPE html>
<html>
  <head>
    <?php include("../view/include/includes.view.php"); ?>
    <link rel="stylesheet" href="../data/css/artiste.css">
    <title>Dælium - Evenement - <?= $data['evenement']['nom'] ?></title>
  </head>
  <body>
    <?php include("../view/include/header.view.php"); ?>
    <section class="col-lg-offset-1 col-lg-10">
      <h1><?= $data['evenement']['nom']?></h1>
      <article class="col-lg-offset-2 col-lg-10">
        <div class="navbar navbar-right">
          <a class ="btn btn-default" href="../controler/evenements.ctrl.php"> Retour </a>
          <a class ="btn btn-primary" href="../controler/evenement_fiche.ctrl.php?id=<?= $data['evenement']['id'] ?>" > Voir fiche </a>
          <a class ="btn btn-warning" href="../controler/evenement.ctrl.php?id=<?= $data['evenement']['id'] ?>&action=edit" > Modifier </a>
        </div>
      </article>


      <article class="col-lg-6 infoProfile">
        <!-- Information principals -->
      <div class="well">
        <h4>Informations générales :</h4>
          <table class="table">
            <colgroup>
              <col class="col-lg-3"/>
              <col/>
            </colgroup>
            <tbody>
              <tr>
                <th>Nom :</th><td><?= $data['evenement']['nom']?></td>
              </tr>
              <tr>
                <th>Type :</th><td>Type </td>
              </tr>
              <tr>
                <th>Date de debut :</th><td>Date de debut</td>
              </tr>
              <tr>
                <th>Date de fin :</th><td>Date de fin</td>
              </tr>
              <tr>
                <th>Lieu :</th><td>Lieu </td>
              </tr>
              <tr>
                <th>description :</th><td>description</td>
              </tr>
            </tbody>
          </table>
      </div>
      <!-- Fin Information principals -->


<!-- Liste groupe -->
      <div class="well">
        <h4>Liste des groupes</h4>
      </div>
<!-- Fin Liste groupe -->

    </article>
    <article class="col-lg-6 infoProfile">
      <!-- Liste Creneaux -->
      <div class="well">
        <h4>Liste des Creneaux</h4>
      </div>
      <!-- Fin Liste Creneaux -->


    </article>


      <!-- Fin affichage des membre du groupe -->
      </section>
    <?php include("../view/include/footer.view.php"); ?>
  </body>
</html>
