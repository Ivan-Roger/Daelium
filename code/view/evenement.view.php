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
    <h1><?= $data['evenement']['nom']?></h1> <a class ="btn btn-primary" href="../controler/evenement_fiche.ctrl.php?id=<?= $data['evenement']['id'] ?>" > Voir fiche public </a>
    <article class="col-lg-offset-2 col-lg-10">
      <div class="navbar navbar-right">
        <a class ="btn btn-default" href="../controler/evenements.ctrl.php"> Retour </a>
        <a class ="btn btn-danger" href="../controler/evenement.ctrl.php?id=<?= $data['evenement']['id'] ?>&action=edit" > Supprimer </a>
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
              <th>Type :</th><td><?= $data['evenement']['type'] ?></td>
            </tr>
            <tr>
              <th>Genre :</th><td><?= $data['evenement']['genre'] ?> </td>
            </tr>
            <tr>
              <th>Date de debut :</th><td><?= $data['evenement']['dated'] ?></td>
            </tr>
            <tr>
              <th>Date de fin :</th><td><?= $data['evenement']['datef'] ?></td>
            </tr>
            <tr>
              <th>Lieu :</th><td><?= $data['evenement']['lieu']['adresse'] ?> <?php if($data['evenement']['lieu']['googlemaps'] != NULL){ ?> <a href="<?= $data['evenement']['lieu']['googlemaps']  ?>">Google Maps</a> <?php } ?> </td>
            </tr>
            <tr>
              <th>Description :</th><td><?= $data['evenement']['description'] ?></td>
            </tr>
          </tbody>
        </table>
      </div>
      <!-- Fin Information principals -->


      <!-- Liste groupe -->
      <div class="well">
        <h4>Liste des groupes :</h4>
        <?php foreach ($data["groupes"] as $key => $value) { ?>
          <div class="panel panel-default">
            <div class="panel-body">
              <div class="col-lg-12"><?= $value['nom'] ?><a class ="btn btn-default" href="../controler/groupe_fiche.ctrl.php?id=<?= $value['id'] ?>&action=edit" > Voir fiche </a></div>
            </div>
          </div>
      <?php  } ?>
      </div>
      <!-- Fin Liste groupe -->

    </article>
    <article class="col-lg-6 infoProfile">
      <!-- Liste Creneaux -->
      <div class="well">
        <h4>Liste des Creneaux :</h4>
        <?php foreach ($data["passages"] as $key => $value) { if($value['type'] == "Tests"){ ?>
          <div class="panel panel-danger">
            <?php }else { ?>
            <div class="panel panel-primary">
          <?php  } ?>
            <div class="panel-body">
              <div class="col-lg-12 text-center"><b><?= $value["type"] ?></b></div>
              <br/>
              <br/>
              <div class="col-lg-4"><b>Date : </b><?= $value["date"] ?></div>
              <div class="col-lg-4"><b>Heure de debut :</b> <?= $value["heured"] ?></div>
              <div class="col-lg-4"><b>Heure de fin : </b><?= $value["heuref"] ?></div>
              <div class="col-lg-12"><b>Nom du Groupe : </b><?= $value['groupe']['nom'] ?></div>
              <div class="col-lg-12"><b>Lieu :</b><?= $value["lieu"] ?></div>

            </div>
          </div>
      <?php  } ?>

      </div>
      <!-- Fin Liste Creneaux -->


    </article>


    <!-- Fin affichage des membre du groupe -->
  </section>
  <?php include("../view/include/footer.view.php"); ?>

</body>
</html>
