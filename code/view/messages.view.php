<?php
if (!isset($data))
header("Location:"."../");
?>
<!DOCTYPE html>
<html>
<head>
   <?php include("../view/include/includes.view.php"); ?>
   <link rel="stylesheet" href="../data/css/messages.css">
   <script src="../data/js/messages.js"></script>
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
            <li id="tabInbox" role="presentation" class="active"><a href="#inbox" aria-controls="inbox" role="tab" data-toggle="tab">Receptions <span class="badge info">5</span></a></li>
            <li id="tabSent" role="presentation"><a href="#sent" aria-controls="sent" role="tab" data-toggle="tab">Envois</a></li>
            <li id="tabDrafts" role="presentation"><a href="#drafts" aria-controls="drafts" role="tab" data-toggle="tab">Brouillons <span class="badge warning">2</span></a></li>
         </ul>
         <div class="tab-content">
            <div role="tabpanel" class="tab-pane active" id="inbox"><table id="list" class="table table-hover col-lg-12">
               <colgroup>
                  <col class="col-lg-3"/>
                  <col class="col-lg-7"/>
                  <col class="col-lg-2"/>
               </colgroup>
               <tbody>
                  <?php foreach ($data['messageR'] as $key => $message) { ?>
                     <tr class="not-active <?= ($message['lu']?"":"info")?>" data-ID="<?= $message['id'] ?>"><td><?= $message['expediteur'] ?></td><td><b><?= ($message['parent']!=0?"<span class=\"fa fa-chevron-right\"></span>":"")?><?= $message['objet'] ?></b></td><td class="text-right"><?= $message['date'] ?></td></tr>
                     <?php }?>
                     <tr class="info"><td>Jean</td><td><b>Oubli</b></td><td class="text-right">13:15</td></tr>
                     <tr class="info"><td>Hervé</td><td><b>Concert</b></td><td class="text-right">17 Nov</td></tr>
                     <tr class="info"><td>Marc</td><td><b>Camion</b></td><td class="text-right">11 Nov</td></tr>
                     <tr class="info"><td>Henri</td><td><b>Festival du lac</b></td><td class="text-right">7 Nov</td></tr>
                     <tr class="info"><td>Louise</td><td><b>Préparation scène</b></td><td class="text-right">24 Sep</td></tr>
                     <tr class="info"><td>Jean</td><td><b>Bonjour</b></td><td class="text-right">11 Sep</td></tr>
                     <tr class="warning"><td>Laurianne</td><td>Annulation</td><td class="text-right">5 Sep</td></tr>
                     <tr><td>Marie</td><td>Achat</td><td class="text-right">1 Sep</td></tr>
                  </tobdy>
               </table></div>
               <div role="tabpanel" class="tab-pane" id="sent"><table class="table table-hover col-lg-12">
                  <colgroup>
                     <col class="col-lg-3"/>
                     <col class="col-lg-7"/>
                     <col class="col-lg-2"/>
                  </colgroup>
                  <tbody>
                     <?php foreach ($data['messageE'] as $key => $message) { ?>
                     <tr data-ID="<?= $message['id'] ?>"><td><?= $message['destinataire'] ?></td><td><?= $message['objet'] ?></td><td class="text-right"><?= $message['date'] ?></td></tr>
                     <?php }?>
                     <tr><td>Marc</td><td>Camion</td><td class="text-right">11 Nov</td></tr>
                     <tr><td>Henri</td><td>Festival du lac</td><td class="text-right">7 Nov</td></tr>
                     <tr><td>Louise</td><td>Préparation scène</td><td class="text-right">24 Sep</td></tr>
                  </tobdy>
               </table></div>
               <div role="tabpanel" class="tab-pane" id="drafts">
                  <table class="table table-hover col-lg-12">
                     <colgroup>
                        <col class="col-lg-3"/>
                        <col class="col-lg-7"/>
                        <col class="col-lg-2"/>
                     </colgroup>
                     <tbody>
                        <?php foreach ($data['messageB'] as $key => $message) { ?>
                           <tr data-ID="<?= $message['id'] ?>"><td><?= $message['destinataire'] ?></td><td><?= $message['objet'] ?></td><td class="text-right"><?= $message['date'] ?></td></tr>
                           <?php }?>
                           <tr><td>Hervé</td><td><b>Concert</b></td><td>17 Nov</td></tr>
                           <tr><td>Marc</td><td><b>Camion</b></td><td>11 Nov</td></tr>
                        </tobdy>
                     </table>
                  </div>
               </div>
            </div>
            <div class="col-lg-6">
               <div class="panel panel-default">
                  <div id="messageLoading">.</div>
                  <div class="panel-heading">
                     <div class="row">
                        <div class="col-lg-8">
                           <h4>Message : <span id="messageTitle">Annulation</span></h4>
                           <small>de : <span id="messageSender">Laurianne</span></small>
                        </div>
                        <div class="col-sm-4 text-right" style="padding-right:50px;">
                           <p>le <em id="messageSendDate">05/09/2015</em> à <em id="messageSendHour">18h30</em></p>
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
                  <div id="messageContent" class="panel-body">
                     <div class="well">
                        <p>Bonjour,<br/>
                           Je vous contacte car j'ai reçu de nouvelles informations et je ne pourrais pas venir ce Week-End. Je vous préviens donc que j'annule le rendez-vous.<br/>
                           Cordialement,
                           Laurianne
                        </p>
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
      </body>
      </html>
