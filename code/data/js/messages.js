function init() {
   $("#inbox tr.not-active").on('click',function (e) {
      if ($(e.currentTarget).hasClass("warning"))
         return;
      var id = $(e.currentTarget).data().id;
      console.log("Display message "+id);

      $("#inbox tr.warning").addClass("not-active");
      $("#inbox tr.warning").removeClass("warning")

      $(e.currentTarget).addClass("warning");
      $(e.currentTarget).removeClass("info");
      $(e.currentTarget).removeClass("not-active");

      $("#messageLoading").addClass("loading-start");
      $("#messageLoading").removeClass("loading-end");
      $.ajax({url: "messages.ctrl.php?ajax&message&id="+id+"&setState=10", success: function(res){
         $("#messageLoading").addClass("loading-end");
         $("#messageLoading").removeClass("loading-start");

         console.log(res);
         res = JSON.parse(res);
         console.log(res);
         $("#messageTitle").html(res.message.objet);
         $("#messageSender").html(res.message.expediteur);
         $("#messageSendDate").html(res.message.date);
         //$("#messageSendHour").html(res.message.hour);
         $("#messageContent .well").html(res.message.contenu);
      }, error: function(a, b, c) {
         console.warn("AJAX Error: couldn't get Message (\""+b+"\")");
         $("#messageLoading").removeClass("loading-start");
         $("#messageLoading").addClass("loading-fail");
      }});
   });
}
init();
