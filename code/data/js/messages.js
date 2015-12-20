function showMessage(e) {
   if ($(e.currentTarget).hasClass("shown"))
      return;
   var id = $(e.currentTarget).data().id;
   console.log("Display message "+id);

   $("#messageLoading").addClass("loading-start");
   $("#messageLoading").removeClass("loading-fail");
   $("#messageLoading").removeClass("loading-end");
   $.ajax({url: "messages.ctrl.php?ajax&message&id="+id, success: function(res){
      $("#messageLoading").addClass("loading-end");
      $("#messageLoading").removeClass("loading-start");
      try {
         res = JSON.parse(res);
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
         if (res.message.parent>0) {
            $("#messageContent .messageInfos").append($("<p class=\"messageInfoParent\">").html("Ce message est une réponse à <span class=\"showMessage not-shown showMessageText\" data-ID=\""+res.message.parent+"\">celui-ci</span>."));
            $("#messageContent .messageInfos .messageInfoParent .showMessage.not-shown").on('click',showMessage);
         } else {
            $("#messageContent .messageInfos .messageInfoParent").remove();
         }
         $("#messageContent .well").html(res.message.contenu);

         if (res.message.me='D') { // Si je suis le destinataire alors j'enregistre le message comme lu.
            $.ajax({url: "messages.ctrl.php?ajax&message&id="+res.message.id+"&setState="+10});
            $(".tab-content .tab-pane.messageRead tr.showMessage.shown").removeClass("info");
            var nouveauxRestants = $("#tabInbox .badge.info").html()*1 - 1;
            if (nouveauxRestants>0)
               $("#tabInbox .badge.info").html(nouveauxRestants)
            else
               $("#tabInbox .badge.info").remove();
         }
      } catch (err) {
         console.warn("Error: wrong Message data (\""+err+"\")");
         $("#messageLoading").addClass("loading-fail");
         $("#messageLoading").removeClass("loading-start");
      }
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

document.addEventListener("DOMContentLoaded", function() {
  addMessageReadListener();
});
