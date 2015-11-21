<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <link rel="stylesheet" href="../data/css/bootstrap.css">
    <link rel="stylesheet" href="../data/css/common.css">
    <link rel="stylesheet" href="../data/css/messages.css">
    <title>Dælium - Messagerie</title>
  </head>
  <body>
    <?php include("../view/include/header.view.php"); ?>
    <section class="col-lg-offset-1 col-lg-3">

      <ul class="nav nav-tabs">
        <li role="presentation" class="active"><a href="#">Receptions <span class="badge info">5</span></a></li>
        <li role="presentation"><a href="#">Envois</a></li>
        <li role="presentation"><a href="#">Brouillons <span class="badge warning">2</span></a></li>
      </ul>
      <table id="list" class="table table-hover col-lg-12">
        <colgroup>
          <col/>
          <col/>
          <col/>
        </colgroup>
        <tbody>
          <tr class="info"><td>Jean</td><td>Oubli</td><td>13:15</td></tr>
          <tr class="info"><td>Hervé</td><td>Concert</td><td>17 Nov</td></tr>
          <tr class="info"><td>Marc</td><td>Camion</td><td>11 Nov</td></tr>
          <tr class="info"><td>Henri</td><td>Festival du lac</td><td>7 Nov</td></tr>
          <tr class="info"><td>Louise</td><td>Préparation scène</td><td>24 Sep</td></tr>
          <tr class="info"><td>Jean</td><td>Bonjour</td><td>11 Sep</td></tr>
          <tr class="warning"><td>Laurianne</td><td>Annulation</td><td>5 Sep</td></tr>
          <tr><td>Marie</td><td>Achat</td><td>1 Sep</td></tr>
        </tobdy>
        </table>
    </section>
    <section class="col-lg-7">
      <div class="panel panel-default">
        <div class="panel-heading">
          <div class="row">
            <div class="col-lg-8">
              <p>
                <strong>Message : Annulation</strong><br/>
                <small>de : Laurianne</small>
              </p>
            </div>
            <div class="col-sm-4 text-right" style="padding-right:50px;">
              <p>le <em>05/09/2015</em> à <em>18h30</em></p>
            </div>
            <div class="row col-lg-12">
              <div class="col-lg-8">
                <ul class="list-inline">
                  <li><a class="btn btn-default" href="#"><span class="glyphicon glyphicon-tag"></span> Festival du lac</a></li>
                  <li><a class="btn btn-default" href="#"><span class="glyphicon glyphicon-tag"></span> Metz</a></li>
                </ul>
              </div>
              <div class="col-lg-4 text-right">
                <div class="btn-group">
                  <a class="btn btn-default" title="Tagger"><span class="glyphicon glyphicon-tags"></span></a>
                  <a class="btn btn-default" title="Favori"><span class="glyphicon glyphicon-star-empty"></span></a>
                  <a class="btn btn-default" title="Répondre"><span class="glyphicon glyphicon-comment"></span></a>
                  <a class="btn btn-default" title="Transférer"><span class="glyphicon glyphicon-share-alt"></span></a>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="panel-body">
          <div>
            <p>Bonjour,<br/>
            Je vous contacte car j'ai reçu de nouvelles informations et je ne pourrais pas venir ce Week-End. Je vous préviens donc que j'annule le rendez-vous.<br/>
            Cordialement,
            Laurianne</p>
          </div>
        </div>
      </div>
    </section>
    <?php include("../view/include/footer.view.php"); ?>
    <script src="http://code.jquery.com/jquery-1.11.3.min.js"></script>
    <script src="../data/js/bootstrap.min.js"></script>
  </body>
</html>
