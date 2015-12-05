<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <link rel="stylesheet" href="../data/css/bootstrap.css">
    <link rel="stylesheet" href="../data/css/artiste.css">
    <link rel="stylesheet" href="../data/css/common.css">
    <link rel="icon" type="image/png" href="../data/img/D.png" />
    <title>Dælium - Erreur - <?= $data['error']['title']?></title>
  </head>
  <body>
    <?php include("../view/include/header.view.php"); ?>
    <section class="col-lg-offset-2 col-lg-8">
      <div>
        <h1>Erreur : <small><?= $data['error']['title']?></small></h1>
        <div>
          <a class ="btn btn-default" href="<?= $data['error']['back'] ?>"> Retour </a>
          <p><?= $data['error']['message'] ?></p>
        </div>
      </div>
    </section>
    <?php include("../view/include/footer.view.php"); ?>
    <script src="../data/js/jQuery.min.js"></script>
    <script src="../data/js/bootstrap.min.js"></script>
  </body>
</html>
