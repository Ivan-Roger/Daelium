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
   <script src="../ckeditor/ckeditor.js"></script>
   <title>Dælium - Messagerie</title>
</head>
<body>
   <?php include("../view/include/header.view.php"); ?>
   <section class="col-lg-12">
      <article class="col-lg-offset-1 col-lg-10">
         <div class="navbar navbar-form navbar-right"><!--
            <div class="input-group">
               <input type="text" class="form-control"/>
               <div class="input-group-btn">
                  <a href="#" class="btn btn-default">Rechercher</a>
               </div>
            </div>-->
            <a id="openEditor" class="btn btn-primary">Nouveau message</a>
         </div>
      </article>
      <div class="row">
         <div id="messageList" class="col-lg-offset-1 col-lg-10">
            <ul class="nav nav-tabs" role="tablist">
               <li id="tabInbox" role="presentation" class="active"><a href="#inbox" aria-controls="inbox" role="tab" data-toggle="tab">Receptions <?php if ($data['count']['messageR']>0) echo("<span class=\"badge info\">".$data['count']['messageR']."</span>"); ?></a></li>
               <li id="tabSent" role="presentation"><a href="#sent" aria-controls="sent" role="tab" data-toggle="tab">Envois</a></li>
               <li id="tabDrafts" role="presentation"><a href="#drafts" aria-controls="drafts" role="tab" data-toggle="tab">Brouillons <?php if ($data['count']['messageB']>0) echo("<span class=\"badge info\">".$data['count']['messageB']."</span>"); ?></a></li>
            </ul>
            <div class="tab-content">
               <div role="tabpanel" class="tab-pane active messageRead" id="inbox">
                  <table class="table table-hover col-lg-12">
                     <colgroup>
                        <col class="col-lg-3"/>
                        <col class="col-lg-7"/>
                        <col class="col-lg-2"/>
                     </colgroup>
                     <tbody>
                        <?php foreach ($data['messageR'] as $key => $message) { ?>
                           <tr class="showMessage not-shown <?= ($message['lu']?"":"info")?>" data-ID="<?= $message['id'] ?>" data-conv="<?= $message['conversation'] ?>">
                              <td><?= $message['expediteur'] ?></td><td class="objet"><?= (!$message['origine']?"<span class=\"fa fa-chevron-right\"></span>":"")?><?= $message['objet'] ?></td>
                              <td class="text-right"><?= $message['date'] ?></td>
                           </tr>
                        <?php }?>
                     </tobdy>
                  </table>
               </div>
               <div role="tabpanel" class="tab-pane messageRead" id="sent">
                  <table class="table table-hover col-lg-12">
                     <colgroup>
                        <col class="col-lg-3"/>
                        <col class="col-lg-7"/>
                        <col class="col-lg-2"/>
                     </colgroup>
                     <tbody>
                     <?php foreach ($data['messageE'] as $key => $message) { ?>
                        <tr class="showMessage not-shown" data-ID="<?= $message['id'] ?>" data-conv="<?= $message['conversation'] ?>">
                           <td><?= $message['destinataire'] ?></td><td class="objet"><?= (!$message['origine']?"<span class=\"fa fa-chevron-right\"></span>":"")?><?= $message['objet'] ?></td>
                           <td class="text-right"><?= $message['date'] ?></td>
                        </tr>
                     <?php }?>
                     </tobdy>
                  </table>
               </div>
               <div role="tabpanel" class="tab-pane messageEdit" id="drafts">
                  <table class="table table-hover col-lg-12">
                     <colgroup>
                        <col class="col-lg-3"/>
                        <col class="col-lg-7"/>
                        <col class="col-lg-2"/>
                     </colgroup>
                     <tbody>
                        <?php foreach ($data['messageB'] as $key => $message) { ?>
                           <tr class="editMessage not-shown" data-ID="<?= $message['id'] ?>"><td><?= $message['destinataire'] ?></td><td class="objet"><?= (!$message['origine']?"<span class=\"fa fa-chevron-right\"></span>":"")?><?= $message['objet'] ?></td><td class="text-right"><?= $message['date'] ?></td></tr>
                        <?php }?>
                        </tobdy>
                     </table>
                  </div>
               </div>
            </div>
            <hr/>
         </div>
         <div class="row">
            <div id="messageLoading">.</div>
            <div id="messageFrame" class="col-lg-offset-1 col-lg-10 collapse collapsed">
               <div class="panel panel-default empty">
                  <div class="panel-heading">
                     <div class="row">
                        <div class="col-sm-8">
                           <h4>Message : <span id="messageTitle">Annulation</span></h4>
                        </div>
                        <div class="col-sm-4 text-right" style="padding-right:50px;">
                           <p>le <em id="messageSendDate">05/09/2015</em> à <em id="messageSendHour">18h30</em></p>
                        </div>
                        <div class="col-lg-12">
                           <div class="col-sm-8">
                              <div class="col-sm-3">
                                 <small>de : <span id="messageSender">Laurianne</span><br/>
                                 à : <span id="messageRecipient">Moi</span></small>
                              </div>
                              <ul id="messageTags" class="col-sm-9 list-inline">
                                 <li><a class="btn btn-default" href="#"><span class="glyphicon glyphicon-tag no-margin"></span> Festival du lac</a></li>
                                 <li><a class="btn btn-default" href="#"><span class="glyphicon glyphicon-tag no-margin"></span> Metz</a></li>
                              </ul>
                           </div>
                           <div class="col-sm-4 text-right">
                              <div class="btn-group">
                                 <a class="btn btn-default" title="Tagger"><span class="glyphicon glyphicon-tags no-margin"></span></a>
                                 <a class="btn btn-default" title="Transférer"><span class="glyphicon glyphicon-share-alt no-margin"></span></a>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div id="messageContent" class="panel-body">
                     <div class="content">
                        <div class="well">
                           Bonjour,<br/>
                           Je vous contacte car j'ai reçu de nouvelles informations et je ne pourrais pas venir ce Week-End. Je vous préviens donc que j'annule le rendez-vous.<br/>
                           Cordialement,
                           Laurianne
                        </div>
                     </div>
                     <hr/>
                     <div>
                        <h4>Répondre</h4>
                        <div class="col-lg-10">
                           <textarea id="messageAnswerArea" class="form-control">Rédigez votre réponse ici ...</textarea>
                        </div>
                        <div class="col-lg-2">
                           <a href="#" class="btn btn-default full-width">Editeur</a><br/>
                           <button class="btn btn-primary btn-lg full-width">Envoyer</button>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <div id="editFrame" class="col-lg-offset-1 col-lg-10 collapse collapsed messageCreate">
               <div class="panel panel-default empty">
                  <div class="panel-heading">
                     <div class="row">
                        <div class="col-sm-8">
                           <h4>Message : <input type="text" class="form-control" name="messageTitle" placeholder="Sujet"/></h4>
                        </div>
                        <div class="col-lg-12">
                           <div class="col-sm-8">
                              <div class="col-sm-3">
                                 <small class="message-recipient">à : <span name="destinataire" data-id=""><?= (isset($data['recipient'])?$data['recipient']['name']:"") ?></span>
                                   <a class="selectRecipient btn btn-default"><span class="glyphicon glyphicon-plus no-margin"></span></a>
                                 </small>
                              </div>
                              <ul id="messageTags" class="col-sm-9 list-inline">
                                 <!--<li><a class="btn btn-default" href="#"><span class="glyphicon glyphicon-tag no-margin"></span> Festival du lac</a></li>-->
                              </ul>
                           </div>
                           <div class="col-sm-4 text-right">
                              <div class="btn-group">
                                <a id="editSaveMessage" class="btn btn-default" title="Enregistrer"><span class="glyphicon glyphicon-floppy-disk no-margin"></span></a>
                                <a id="editDeleteMessage" class="btn btn-danger" title="Supprimer"><span class="glyphicon glyphicon-trash no-margin"></span></a>
                                <a id="editSendMessage" class="btn btn-primary" title="Envoyer"><span class="glyphicon glyphicon-send"></span>Envoyer</a>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="panel-body">
                     <input name="create" value="true" type="hidden"/>
                     <div class="content">
                        <textarea rows="4" name="editMessageContent" id="editor1" cols="175%"></textarea>
                        <script>
                          // Replace the <textarea id="editor1"> with a CKEditor
                          // instance, using default configuration.
                          CKEDITOR.replace( 'editor1' );
                        </script>
                     </div>
                  </div>
               </div>
            </div>
         </div>
   </section>
   <?php include("../view/include/footer.view.php"); ?>
   <script>
    function initDoc() {
    <?php if (isset($data['open']) && $data['open']['type']=="edit") { ?>
      createMessage();
      <?php if (isset($data['recipient'])) { ?>
        setEditMessageRecipient(<?= $data['recipient']['id'] ?>,"<?= $data['recipient']['name'] ?>");
      <?php } ?>
    <?php } ?>
    }
   </script>
</body>
</html>
