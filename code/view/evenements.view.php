<!DOCTYPE html>
<html>
  <head>
    <?php include("../view/includ/includes.view.php"); ?>
    <link rel="stylesheet" href="../data/css/evenements.css">
    <title>Dælium - Mes evenements</title>
  </head>
  <body>
    <?php include("../view/include/header.view.php"); ?>
    <section class="col-lg-offset-1 col-lg-10">
      <div class="row">
        <?php foreach($data['evenements'] as $evt) { ?>
          <div class="col-xs-2">
            <a href="../controler/evenement.ctrl.php?id=<?= $evt['id'] ?>" id="pic" class="thumbnail">
              <img class="category-banner img-responsive" src="<?= $evt['img'] ?>" alt="...">
              <div class="OverlayText"><?= $evt['name'] ?></div>
            </a>
          </div>
        <?php } ?>
        <div  class="col-xs-2">
          <a href="../controler/evenement.ctrl.php?action=new" id="pic" class="thumbnail">
            <img class="category-banner img-responsive" src="../data/img/icons/plus.png" alt="...">
            <div class="OverlayText ">Ajouter un evenement</div>
          </a>
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
