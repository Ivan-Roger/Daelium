$("#calendarPrev").click(function(){
    console.log("Prev");
    var month = $("#calendar").attr("data-month")-1;
    var year = $("#calendar").attr("data-year");
    $.ajax({url: "agenda.ctrl.php?ajax&month="+month+"&year="+year, success: function(result){
        //$("#div1").html(result);
        console.log("Result received !");
        console.log(result);
        var res = result;
        $("#calendarMonth").html(res.monthName);
        $("#calendar").attr("data-month",res.month);
        $("#calendar").attr("data-year",res.year);
        for (var l=0; l<res.calendar.length; l++) {
          $("#calendar tbody tr:nth-child("+(l+1)+") th").html(res.calendar[l].id);
          for (var c=0; c<res.calendar[l].days.length; c++) {
            var day = res.calendar[l].days[c];
            $("#calendar tbody tr:nth-child("+(l+1)+") td:nth-child("+(c+2)+")").html((day>0?day:""));
            //<?php echo(($week['days'][0]>0?($week['days'][0]==$data['today']?" class='active'>".$week['days'][0]:">".$week['days'][0]):" class='not-hover'>")); ?>
          }
        }
    }});
});
$("#calendarNext").click(function(){
    console.log("Next");
    var month = $("#calendar").attr("data-month")+1;
    var year = $("#calendar").attr("data-year");
    $.ajax({url: "agenda.ctrl.php?ajax&month="+month+"&year="+year, success: function(result){
        //$("#div1").html(result);
        console.log("Result received !");
        console.log(result);
        var res = result;
        $("#calendarMonth").html(res.monthName);
        $("#calendar").attr("data-month",res.month);
        $("#calendar").attr("data-year",res.year);
        for (var l=0; l<res.calendar.length; l++) {
          $("#calendar tbody tr:nth-child("+(l+1)+") th").html(res.calendar[l].id);
          for (var c=0; c<res.calendar[l].days.length; c++) {
            var day = res.calendar[l].days[c];
            $("#calendar tbody tr:nth-child("+(l+1)+") td:nth-child("+(c+2)+")").html((day>0?day:""));
            //<?php echo(($week['days'][0]>0?($week['days'][0]==$data['today']?" class='active'>".$week['days'][0]:">".$week['days'][0]):" class='not-hover'>")); ?>
          }
        }
    }});
});
