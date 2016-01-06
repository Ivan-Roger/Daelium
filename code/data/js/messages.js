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

      $("#messageFrame").collapse("show");

      $(".showMessage.shown").addClass("not-shown");
      $(".showMessage.shown").removeClass("shown");
      $(e.currentTarget).addClass("shown");
      $(e.currentTarget).removeClass("not-shown");

      $(".tab-content .tab-pane.messageRead tr.showMessage[data-ID=\""+res.message.id+"\"]").addClass("shown");
      $(".tab-content .tab-pane.messageRead tr.showMessage[data-ID=\""+res.message.id+"\"]").removeClass("not-shown");

      $("#messageTitle").html(res.message.objet+(res.message.parent!=0?" (Réponse)":""));
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

      if (res.message.me='D') { // Si je suis le destinataire alors j'enregistre le message comme lu.
        $.ajax({url: "messages.ctrl.php?ajax&message&id="+res.message.id+"&setState="+10});
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

function sendMessage(e,etat) {
  $("#messageLoading").addClass("loading-start");
  $("#messageLoading").removeClass("loading-fail");
  $("#messageLoading").removeClass("loading-end");
  var messageData = {}; // Convertir les infos en objet
  messageData.etat = etat;
  messageData.recipient = $("#editFrame span[name='destinataire']").data().id;
  messageData.titre = $("#editFrame input[name='messageTitle']").val();
  messageData.contenu = CKEDITOR.instances.editor1.getData();
  $.ajax({url: "../controler/messages.ctrl.php?ajax&send", method: 'POST', data: messageData, success: function(res) {
     $("#messageLoading").addClass("loading-end");
     $("#messageLoading").removeClass("loading-start");

     console.log(res);

  }, error: function(a, b, c) {
    console.warn("AJAX Error: couldn't get Message (\""+b+"\")");
    $("#messageLoading").removeClass("loading-start");
    $("#messageLoading").addClass("loading-fail");
  }});
}

function addMessageReadListener() {
   $(".showMessage.not-shown").on('click',showMessage);
   console.log("Message Read Listener added !");
}
function addEditorListener() {
   //$(".editMessage.not-shown").on('click',editMessage);
   console.log("Message Edit Listener added !");
}

document.addEventListener("DOMContentLoaded", function() {
  addMessageReadListener();
  addEditorListener();
  $("#openEditor").on('click',function(){
    $("#messageFrame").collapse('hide');
    $("#editFrame").collapse('show');
  });
  $("#editSaveMessage").on('click',function(e){
    sendMessage(e,0);
  });
  $("#editSendMessage").on('click',function(e){
    sendMessage(e,5);
  });
});
