function showMessage(e) {
   if ($(e.currentTarget).hasClass("shown"))
      return;
   var convID = $(e.currentTarget).data().conv;
   var id = $(e.currentTarget).data().id;
   console.log("Display message "+id);

   $("#messageLoading").addClass("loading-start");
   $("#messageLoading").removeClass("loading-fail");
   $("#messageLoading").removeClass("loading-end");
   $.ajax({url: "messages.ctrl.php?ajax&message="+id+"&conversation="+convID, success: function(res){
      $("#messageLoading").addClass("loading-end");
      $("#messageLoading").removeClass("loading-start");

      console.log(res);

      $("#editFrame").collapse("hide");
      $("#messageFrame").collapse("show");

      $(".showMessage.shown").addClass("not-shown");
      $(".showMessage.shown").removeClass("shown");
      $(e.currentTarget).addClass("shown");
      $(e.currentTarget).removeClass("not-shown");

      $(".tab-content .tab-pane.messageRead tr.showMessage[data-ID=\""+res.message.id+"\"]").addClass("shown");
      $(".tab-content .tab-pane.messageRead tr.showMessage[data-ID=\""+res.message.id+"\"]").removeClass("not-shown");

      $("#messageTitle").html(res.message.objet+(!res.message.origine?" (Réponse)":""));
      $("#messageSender").html(res.message.expediteur);
      $("#messageRecipient").html(res.message.destinataire);
      $("#messageSendDate").html(res.message.date);
      //$("#messageSendHour").html(res.message.hour);

      $("#messageContent .content").html("");
      for (var key in res.conversation.list) {
        var cur = res.conversation.list[key];
        linkText = (key==0?"Message originel":"Réponse #"+key);
        if (cur[0]<res.message.id) {
           $("#messageContent .content").append($("<div class=\"showMessage not-shown well well-sm\" data-ID=\""+cur[0]+"\" data-conv=\""+res.conversation.id+"\">").html("<b>"+linkText+"</b>"));
        } else if (cur[0]==res.message.id) {
           $("#messageContent .content").append($("<div class=\"well\">").html(res.message.contenu));
        } else {
           $("#messageContent .content").append($("<div class=\"showMessage not-shown well well-sm\" data-ID=\""+cur[0]+"\" data-conv=\""+res.conversation.id+"\">").html("<b>"+linkText+"</b>"));
        }
      }
      $("#messageContent .content .showMessage.not-shown").on('click',showMessage);

      $("#messageTags").html("");
      for (var key in res.message.tags) {
        var cur = res.message.tags[key];
        $("#messageTags").append($("<li><button class=\"btn btn-default\"><span class=\"glyphicon glyphicon-tag\"></span>"+cur['nomt']+"</button></li>"));
      }

      console.log("res.message.me="+res.message.me);
      if (res.message.me=='D') { // Si je suis le destinataire alors j'enregistre le message comme lu.
        $.ajax({url: "messages.ctrl.php?ajax&message&id="+res.message.id+"&setState="+10, success: function(res){
          console.log("SetState : ",res);
        }});
        $(".tab-content .tab-pane.messageRead tr.showMessage.shown").removeClass("info");
        var nouveauxRestants = $("#tabInbox .badge.info").html()*1 - 1;
        if (nouveauxRestants>0)
           $("#tabInbox .badge.info").html(nouveauxRestants)
        else
           $("#tabInbox .badge.info").remove();
      }
   }, error: function(a, b, c) {
      console.warn("AJAX Error: couldn't get Message (\""+b+"\")");
      $("#messageLoading").removeClass("loading-start");
      $("#messageLoading").addClass("loading-fail");
   }});
}

function sendNewMessage(etat) {
  console.log("Sending new message");
  $("#messageLoading").addClass("loading-start");
  $("#messageLoading").removeClass("loading-fail");
  $("#messageLoading").removeClass("loading-end");
  var messageData = {}; // Convertir les infos en objet
  messageData.etat = etat;
  messageData.recipient = $("#editFrame span[name='destinataire']").data().id;
  messageData.titre = $("#editFrame input[name='messageTitle']").val();
  messageData.contenu = CKEDITOR.instances.editor1.getData();
  $.ajax({url: "../controler/messages.ctrl.php?ajax&create&send", method: 'POST', data: messageData, success: function(res) {
     $("#messageLoading").addClass("loading-end");
     $("#messageLoading").removeClass("loading-start");

     console.log(res);

     window.location.reload();
  }, error: function(a, b, c) {
    console.warn("AJAX Error: couldn't send Message (\""+b+"\"/\""+c+"\")");
    console.log(a.responseText);
    $("#messageLoading").removeClass("loading-start");
    $("#messageLoading").addClass("loading-fail");
  }});
}

function sendUpdateMessage(e,etat) {
  console.log("Update message "+$(e.currentTarget).data().id);
  $("#messageLoading").addClass("loading-start");
  $("#messageLoading").removeClass("loading-fail");
  $("#messageLoading").removeClass("loading-end");
  var messageData = {}; // Convertir les infos en objet
  messageData.idMessage = $(e.currentTarget).data().id;
  messageData.etat = etat;
  messageData.contenu = CKEDITOR.instances.editor1.getData();
  $.ajax({url: "../controler/messages.ctrl.php?ajax&update&send", method: 'POST', data: messageData, success: function(res) {
     $("#messageLoading").addClass("loading-end");
     $("#messageLoading").removeClass("loading-start");

     console.log(res);

     window.location.reload();
  }, error: function(a, b, c) {
    console.warn("AJAX Error: couldn't send Message (\""+b+"\"/\""+c+"\")");
    console.log(a.responseText);
    $("#messageLoading").removeClass("loading-start");
    $("#messageLoading").addClass("loading-fail");
  }});
}

function editMessage(e) {
   if ($(e.currentTarget).hasClass("shown"))
      return;
   var convID = $(e.currentTarget).data().conv;
   var id = $(e.currentTarget).data().id;
   console.log("Edit message "+id);

   $("#messageLoading").addClass("loading-start");
   $("#messageLoading").removeClass("loading-fail");
   $("#messageLoading").removeClass("loading-end");
   $.ajax({url: "messages.ctrl.php?ajax&message="+id, success: function(res){
      $("#messageLoading").addClass("loading-end");
      $("#messageLoading").removeClass("loading-start");

      console.log(res);

      $("#editFrame").collapse("show");
      $("#messageFrame").collapse("hide");

      $(".editMessage.shown").addClass("not-shown");
      $(".editMessage.shown").removeClass("shown");
      $(e.currentTarget).addClass("shown");
      $(e.currentTarget).removeClass("not-shown");

      $(".tab-content .tab-pane.messageEdit tr.editMessage[data-ID=\""+res.message.id+"\"]").addClass("shown");
      $(".tab-content .tab-pane.messageEdit tr.editMessage[data-ID=\""+res.message.id+"\"]").removeClass("not-shown");

      $("#editFrame").removeClass("messageCreate");
      $("#editFrame").addClass("messageEdit");
      $("#editFrame input[name='messageTitle']").val(res.message.objet+(!res.message.origine?" (Réponse)":""));
      $("#editFrame input[name='messageTitle']").attr('readonly','');
      setEditMessageRecipient(res.message['destinataire-id'],res.message.destinataire);
      $("#editFrame #editSaveMessage").data('id',res.message.id);
      $("#editFrame #editSendMessage").data('id',res.message.id);

      CKEDITOR.instances.editor1.setData(res.message.contenu);

      $("#messageTags").html("");
      for (var key in res.message.tags) {
        var cur = res.message.tags[key];
        $("#messageTags").append($("<li><button class=\"btn btn-default\"><span class=\"glyphicon glyphicon-tag\"></span>"+cur['nomt']+"</button></li>"));
      }

   }, error: function(a, b, c) {
      console.warn("AJAX Error: couldn't get Message (\""+b+"\")");
      $("#messageLoading").removeClass("loading-start");
      $("#messageLoading").addClass("loading-fail");
   }});
}

function createMessage(e) {
  console.log("Openning message editor : creation");

  $("#editFrame").collapse("show");
  $("#messageFrame").collapse("hide");

  $(".editMessage.shown").addClass("not-shown");
  $(".editMessage.shown").removeClass("shown");

  $("#editFrame").removeClass("messageEdit");
  $("#editFrame").addClass("messageCreate");

  $("#editFrame input[name='messageTitle']").val("");
  $("#editFrame input[name='messageTitle']").removeProp('readonly');
  $("#editFrame span[name='destinataire']").html("");

  CKEDITOR.instances.editor1.setData("");
}

function setEditMessageRecipient(id,name) {
  $("#editFrame .message-recipient").addClass('hide-selector');
  $("#editFrame .message-recipient span[name='destinataire']").data('id',id);
  $("#editFrame .message-recipient span[name='destinataire']").html(name);
}

document.addEventListener("DOMContentLoaded", function() {
  $(".showMessage.not-shown").on('click',showMessage);
  $(".editMessage.not-shown").on('click',editMessage);
  $("#openEditor").on('click',function(e){
    createMessage(e);
  });
  $("#editFrame #editSaveMessage").on('click',function(e){
    if ($("#editFrame").hasClass("messageCreate")) {
      console.log("A");
      sendNewMessage(e,0);
    } else if ($("#editFrame").hasClass("messageEdit")) {
      console.log("B");
      sendUpdateMessage(e,0);
    }
  });
  $("#editFrame #editSendMessage").on('click',function(e){
    if ($("#editFrame").hasClass("messageCreate")) {
      console.log("C");
      sendNewMessage(e,5);
    } else if ($("#editFrame").hasClass("messageEdit")) {
      console.log("D");
      sendUpdateMessage(e,5);
    }
  });
  initDoc();
  console.log("Page initialized !");
});
