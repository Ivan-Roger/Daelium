<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8" />
  <link rel="stylesheet" href="../data/css/bootstrap.css">
  <link rel="stylesheet" href="../data/css/artiste.css">
  <link rel="stylesheet" href="../data/css/common.css">
  <link rel="icon" type="image/png" href="../data/img/D.png" />
  <title>Dælium - Artiste - <?= $data["artistegroupe"]['nomscene']?></title>
</head>
<body>
  <!-- Cette page est acessible par tout les Organisateur et Non inscrit , Cependant le booker a possibiliter de modifier la page -->
  <?php include("../view/include/header.view.php"); ?>
  <section class="col-lg-offset-1 col-lg-10">
    <!--
    Si Affichage de la fiche.

    Libre:
      Photo du groupe
      Biographie
      Album / EP / Titre Populaire , Explication
      Line Up (Video, clip)

    Fixe:
      - Photo du groupe
      - Player Audio
      - Reseaux sociaux
      - Concert passer et à venir
      (si organisateur sur site -> fiche technique)


      Si Modif de la fiche.
      Choix du player, reseaux, Concert passer et a venir et fiche technique (oui /non)
      position du module en haut, en bas.


  -->

  </section>
  <?php include("../view/include/footer.view.php"); ?>
  <script src="http://code.jquery.com/jquery-1.11.3.min.js"></script>
  <script src="../data/js/bootstrap.min.js"></script>
</body>
</html>
