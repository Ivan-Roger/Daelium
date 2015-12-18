<!DOCTYPE html>
<html>
  <head>
    <?php include("../view/include/includes.view.php"); ?>
    <link rel="stylesheet" href="../data/css/artiste.css">
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
    <script src="https://apis.google.com/js/platform.js" async defer></script>
    <script src="../data/js/common.js"></script>
  </body>
</html>
