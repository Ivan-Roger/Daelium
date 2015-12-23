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
          <a class ="btn btn-default" href="../controler/groupes.ctrl.php"> Retour </a>
          <a class ="btn btn-primary" href="../controler/groupe_fiche.ctrl.php?id=<?= $data['evenement']['id'] ?>" > Voir fiche </a>
          <a class ="btn btn-warning" href="../controler/groupe.ctrl.php?id=<?= $data['evenement']['id'] ?>&action=edit" > Modifier </a>
        </div>
      </article>
      <div class="panel panel-default">
        <div class="panel-body">
          <table class="table">
            <colgroup>
              <col class="col-lg-8"/>
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
                <th>description :</th><td>description</td>
              </tr>
            </tbody>
          </table>
          <div class="pull-right">
            <a class ="btn btn-primary" href="#"> Ajouter un Artiste </a>
            <a class ="btn btn-warning" href="#"> Modifier </a>
            <a class ="btn btn-danger" href="#"> Suprimer </a>
          </div>
        </div>
      </div>
      <h3>Liste des membre du groupe</h3>

      <?php foreach ($data['artistes'] as $art) { ?>
        <div class="col-lg-6">
          <div class="panel panel-default">
            <div class="panel-heading"><?= $art['nom']?> <?= $art['prenom']?></div>
            <div class="panel-body">
              <table class="table">
                <colgroup>
                  <col/>
                  <col/>
                </colgroup>
                <tbody>
                  <tr>
                    <th>Nom :</th><td><?= $art['nom']?></td>
                  </tr>
                  <tr>
                    <th>Prenom :</th><td><?= $art['prenom']?> </td>
                  </tr>
                  <tr>
                    <th>Date de naissance :</th><td><?= $art['dateNaissance'] ?></td>
                  </tr>
                  <tr>
                    <th>Email :</th><td><?= $art['email'] ?></td>
                  </tr>
                  <tr>
                    <th>Telephone :</th><td><?= $art['telephone'] ?></td>
                  </tr>
                  <tr>
                    <th>Adresse :</th><td><?= $art['adresse'] ?></td>
                  </tr>
                  <tr>
                    <th>Mode de reversement du salaire :</th><td><?= $art['paiement'] ?></td>
                  </tr>
                  <?php if ($art['paiement'] == "Virement") { ?>
                    <tr>
                      <th>IBAN :</th><td><?= $art['IBAN'] ?></td>
                    </tr>
                  <?php } else if($art['paiement'] == "Cheque"){  ?>
                    <tr>
                      <th>Ordre du cheque :</th><td><?= $art['ordre'] ?></td>
                    </tr>
                  <?php } ?>
                </tbody>
              </table>
              <div class="pull-right">
                <a class ="btn btn-warning" href="#"> Modifier </a>
                <a class ="btn btn-danger" href="#"> Suprimer du Groupe </a>
              </div>
            </div>
          </div>
        </div>
      <?php }  ?>
      <!-- Fin affichage des membre du groupe -->
      </section>
    <?php include("../view/include/footer.view.php"); ?>
  </body>
</html>
