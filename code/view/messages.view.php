<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <link rel="stylesheet" href="../data/css/bootstrap.css">
    <title>Dælium - Messagerie</title>
  </head>
  <body>
    <?php include("../view/include/header.view.php"); ?>
    <section class="col-lg-offset-1 col-lg-3">

      <ul class="nav nav-tabs">
        <li role="presentation" class="active"><a href="#">Receptions <span class="badge">5</span></a></li>
        <li role="presentation"><a href="#">Envois <span class="badge">5</span></a></li>
        <li role="presentation"><a href="#">Brouillons <span class="badge">5</span></a></li>
      </ul>
      <table id="list" class="table table-hover table-striped col-lg-12">
        <colgroup>
          <col/>
          <col/>
          <col/>
        </colgroup>
        <tbody>
          <tr><td>Jean</td><td>Bonjour</td><td>13:15</td></tr>
          <tr><td>SFR</td><td>Forfait de telephone</td><td>12 Nov</td></tr>
          <tr><td>Google</td><td>Historique de vos recherches</td><td>19 Sep</td></tr>
          <tr><td>...</td><td>...</td><td>...</td></tr>
        </tobdy>
        </table>
    </section>
  <section class="col-lg-7">
  <div class="panel panel-default">
    ...
</div>
    </section>
    <?php include("../view/include/footer.view.php"); ?>
    <script src="http://code.jquery.com/jquery-1.11.3.min.js"></script>
    <script src="../data/js/bootstrap.min.js"></script>
  </body>
</html>
