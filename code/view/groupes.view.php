<?php
   if (!isset($data))
      header("Location:"."../");
?>
<!DOCTYPE html>
<html>
<head>
  <?php include("../view/include/includes.view.php"); ?>
  <link rel="stylesheet" href="../data/css/artistes.css">
  <title>Dælium - Mes artistes</title>
</head>
<body>
  <?php include("../view/include/header.view.php"); ?>
  <section class="col-lg-offset-1 col-lg-10">
    <?php if($data["asgroupe"]){ foreach($data['groupes'] as $group) { ?>
      <div  class="col-xs-2">
        <a href="../controler/groupe.ctrl.php?id=<?= $group['id'] ?>" id="pic" class="thumbnail">
          <img class="category-banner img-responsive" src="<?= $group['img'] ?>" alt="..." style="height:64px;">
          <div class="OverlayText"><?= $group['name'] ?></div>
        </a>
      </div>
    <?php }} ?>
    <div  class="col-xs-2">
      <a href="../controler/groupe_new.ctrl.php" id="pic" class="thumbnail">
        <img class="category-banner img-responsive" src="../data/img/icons/plus.png" alt="..." style="height:64px;">
        <div class="OverlayText">Ajouter un groupe</div>
      </a>
    </div>
  </section>
  <?php include("../view/include/footer.view.php"); ?>
</body>
</html>
