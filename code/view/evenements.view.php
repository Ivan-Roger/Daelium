<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <link rel="stylesheet" href="../data/css/bootstrap.css">
    <link rel="stylesheet" href="../data/css/evenements.css">
    <link rel="stylesheet" href="../data/css/common.css">
    <link rel="icon" type="image/png" href="../data/img/D.png" />
    <title>Dælium - Mes evenements</title>
  </head>
  <body>
    <?php include("../view/include/header.view.php"); ?>
    <section class="col-lg-offset-1 col-lg-10">
      <div class="row">
        <div  class="col-xs-2">
            <a href="../controler/evenement.ctrl.php?evenement=" id="pic" class="thumbnail">
              <img class="category-banner img-responsive" src="../data/img/icons/calendar_64px.png" alt="...">
              <div class="OverlayText">Evenement 1</div>
            </a>
          </div>
          <div class="col-xs-2">
            <a href="../controler/evenement.ctrl.php?evenement=Bilbao_BBK_live" id="pic" class="thumbnail">
              <img class="category-banner img-responsive" src="../data/users/icons/bilbao-logo.jpg" alt="...">
              <div class="OverlayText">Bilbao BBK Live</div>
            </a>
          </div>
          <div  class="col-xs-2">
            <a href="../controler/evenement.ctrl.php?action=new" id="pic" class="thumbnail">
              <img class="category-banner img-responsive" src="../data/img/icons/plus.png" alt="...">
              <div class="OverlayText ">Ajouter un evenement</div>
            </a>
          </div>
      </div>
    </section>
    <?php include("../view/include/footer.view.php"); ?>
    <script src="http://code.jquery.com/jquery-1.11.3.min.js"></script>
    <script src="../data/js/bootstrap.min.js"></script>
  </body>
</html>
