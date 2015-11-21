<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8" />
  <link rel="stylesheet" href="../data/css/bootstrap.css">
  <link rel="stylesheet" href="../data/css/common.css">
  <link rel="stylesheet" href="../data/css/artistes.css">
  <title>Dælium - Mes artistes</title>
</head>
<body>
  <?php include("../view/include/header.view.php"); ?>
  <section class="col-lg-offset-1 col-lg-10">
    <div class="row">
      <div  class="col-xs-2">
          <a href="../controler/artiste.ctrl.php?artiste=Groupe1" id="pic" class="thumbnail">
            <img class="category-banner img-responsive" src="../data/users/icons/User_64.png" alt="...">
            <div class="OverlayText">Groupe 1</div>
          </a>
        </div>
        <div class="col-xs-2">
          <a href="../controler/artiste.ctrl.php?artiste=Artiste2" id="pic" class="thumbnail">
            <img class="category-banner img-responsive" src="../data/users/icons/User_64.png" alt="...">
            <div class="OverlayText">Artiste 2</div>
          </a>
        </div>
        <div  class="col-xs-2">
          <a href="../controler/artiste.ctrl.php?artiste=Groupe3" id="pic" class="thumbnail">
            <img class="category-banner img-responsive" src="../data/users/icons/toy.jpg" alt="...">
            <div class="OverlayText ">Groupe 3</div>
          </a>
        </div>
        <div  class="col-xs-2">
          <a href="../controler/artiste.ctrl.php?action=new" id="pic" class="thumbnail">
            <img class="category-banner img-responsive" src="../data/img/icons/plus.png" alt="...">
            <div class="OverlayText ">Ajouter un artiste</div>
          </a>
        </div>
    </div>
  </section>
  <?php include("../view/include/footer.view.php"); ?>
  <script src="http://code.jquery.com/jquery-1.11.3.min.js"></script>
  <script src="../data/js/bootstrap.min.js"></script>
</body>
</html>
