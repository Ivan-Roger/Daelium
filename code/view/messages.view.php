<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <link rel="stylesheet" href="../data/css/bootstrap.css">
    <link rel="stylesheet" href="../data/css/common.css">
    <link rel="stylesheet" href="../data/css/messages.css">
    <link rel="icon" type="image/png" href="../data/img/D.png" />
    <title>Dælium - Messagerie</title>
  </head>
  <body>
    <?php include("../view/include/header.view.php"); ?>
    <section>
      <article class="col-lg-offset-1 col-lg-10">
        <div class="navbar navbar-form navbar-right">
          <div class="input-group">
            <input type="text" class="form-control"/>
            <div class="input-group-btn">
              <a href="#" class="btn btn-default">Rechercher</a>
            </div>
          </div>
          <button class="btn btn-primary" type="submit">Nouveau message</button>
        </div>
      </article>
      <div class="col-lg-offset-1 col-lg-4">
        <ul class="nav nav-tabs" role="tablist">
          <li role="presentation" class="active"><a href="#inbox" aria-controls="inbox" role="tab" data-toggle="tab">Receptions <span class="badge info">5</span></a></li>
          <li role="presentation"><a href="#sent" aria-controls="sent" role="tab" data-toggle="tab">Envois</a></li>
          <li role="presentation"><a href="#drafts" aria-controls="drafts" role="tab" data-toggle="tab">Brouillons <span class="badge warning">2</span></a></li>
        </ul>
        <div class="tab-content">
          <div role="tabpanel" class="tab-pane active" id="inbox"><table id="list" class="table table-hover col-lg-12">
            <colgroup>
              <col class="col-lg-3"/>
              <col class="col-lg-7"/>
              <col class="col-lg-2"/>
            </colgroup>
            <tbody>
              <tr class="info"><td>Jean</td><td><b>Oubli</b></td><td>13:15</td></tr>
              <tr class="info"><td>Hervé</td><td><b>Concert</b></td><td>17 Nov</td></tr>
              <tr class="info"><td>Marc</td><td><b>Camion</b></td><td>11 Nov</td></tr>
              <tr class="info"><td>Henri</td><td><b>Festival du lac</b></td><td>7 Nov</td></tr>
              <tr class="info"><td>Louise</td><td><b>Préparation scène</b></td><td>24 Sep</td></tr>
              <tr class="info"><td>Jean</td><td><b>Bonjour</b></td><td>11 Sep</td></tr>
              <tr class="warning"><td>Laurianne</td><td>Annulation</td><td>5 Sep</td></tr>
              <tr><td>Marie</td><td>Achat</td><td>1 Sep</td></tr>
            </tobdy>
          </table></div>
          <div role="tabpanel" class="tab-pane" id="sent"><table class="table table-hover col-lg-12">
            <colgroup>
              <col class="col-lg-3"/>
              <col class="col-lg-7"/>
              <col class="col-lg-2"/>
            </colgroup>
            <tbody>
              <tr><td>Marc</td><td>Camion</td><td>11 Nov</td></tr>
              <tr><td>Henri</td><td>Festival du lac</td><td>7 Nov</td></tr>
              <tr><td>Louise</td><td>Préparation scène</td><td>24 Sep</td></tr>
            </tobdy>
          </table></div>
          <div role="tabpanel" class="tab-pane" id="drafts"><table class="table table-hover col-lg-12">
            <colgroup>
              <col class="col-lg-3"/>
              <col class="col-lg-7"/>
              <col class="col-lg-2"/>
            </colgroup>
            <tbody>
              <tr><td>Hervé</td><td><b>Concert</b></td><td>17 Nov</td></tr>
              <tr><td>Marc</td><td><b>Camion</b></td><td>11 Nov</td></tr>
            </tobdy>
          </table></div>
        </div>
      </div>
      <div class="col-lg-6">
        <div class="panel panel-default">
          <div class="panel-heading">
            <div class="row">
              <div class="col-lg-8">
                <h4>Message : Annulation</h4>
                <small>de : Laurianne</small>
              </div>
              <div class="col-sm-4 text-right" style="padding-right:50px;">
                <p>le <em>05/09/2015</em> à <em>18h30</em></p>
              </div>
              <div class="row col-lg-12">
                <div class="col-lg-8">
                  <ul class="list-inline">
                    <li><a class="btn btn-default" href="#"><span class="glyphicon glyphicon-tag no-margin"></span> Festival du lac</a></li>
                    <li><a class="btn btn-default" href="#"><span class="glyphicon glyphicon-tag no-margin"></span> Metz</a></li>
                  </ul>
                </div>
                <div class="col-lg-4 text-right">
                  <div class="btn-group">
                    <a class="btn btn-default" title="Tagger"><span class="glyphicon glyphicon-tags no-margin"></span></a>
                    <a class="btn btn-default" title="Favori"><span class="glyphicon glyphicon-star-empty no-margin"></span></a>
                    <a class="btn btn-default" title="Répondre"><span class="glyphicon glyphicon-comment no-margin"></span></a>
                    <a class="btn btn-default" title="Transférer"><span class="glyphicon glyphicon-share-alt no-margin"></span></a>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="panel-body">
            <div class="well">
              <p>Bonjour,<br/>
              Je vous contacte car j'ai reçu de nouvelles informations et je ne pourrais pas venir ce Week-End. Je vous préviens donc que j'annule le rendez-vous.<br/>
              Cordialement,
              Laurianne</p>
            </div>
            <hr/>
            <div>
              <h4>Répondre</h4>
              <div class="col-lg-10">
                <textarea class="form-control">Rédigez votre réponse ici ...</textarea>
              </div>
              <div class="col-lg-2 btn-group-vertical">
                <button class="btn btn-primary btn-lg full">Envoyer</button>
                <button class="btn btn-default full">Ouvrir l'éditeur</button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <?php include("../view/include/footer.view.php"); ?>
    <script src="../data/js/jQuery.min.js"></script>
    <script src="../data/js/bootstrap.min.js"></script>
  </body>
</html>
