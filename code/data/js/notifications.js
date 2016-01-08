function markAsRead(elem) {
  $(elem).addClass("loading");
  var id = $(elem).data().id;
  console.log("Marking Notification#"+id+" as read.")
  $.ajax({url: "notifications.ctrl.php?ajax&id="+id, success: function(res){
    if (res.request.code==200) {
      $(elem).removeClass("loading");
      console.log("Success.");
      $("table tr.notif-item[data-id="+id+"]").addClass("old").removeClass("new");
      $("table tr.notif-item[data-id="+id+"] td:nth-child(3) span.led").removeClass("led-blue").addClass("led-off");
      $(".notifs-menu a.notif-item[data-id="+id+"]").remove();
      var count = $(".notifs-count").html()-1;
      if (count>0)
        $(".notifs-count").html(count);
      else
        $(".notifs-count").remove();
    } else
      console.warn("ERROR: return code = "+res.request.code);
  }, error: function(a,b,c){
    console.warn("AJAX Error: couldn't update Notification (\""+b+"\"/\""+c+"\")");
    console.log(a.responseText);
  }});
}

$(".notif-item .close").on("click",function(e){
  markAsRead(e.currentTarget);
});
