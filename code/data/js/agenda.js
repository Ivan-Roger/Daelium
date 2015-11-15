$("#calendarPrev").click(function(){
    var month = $("#calendar").attr("data-month")-1;
    var year = $("#calendar").attr("data-year");
    console.log("Prev ("+month+","+year+")");
    $.ajax({url: "agenda.ctrl.php?ajax&month="+month+"&year="+year, success: function(result){
        console.log("Result received !");
        console.log(result);
        var res = result;
        $("#calendarMonth").html(res.monthName);
        $("#calendar").attr("data-month",res.month);
        $("#calendar").attr("data-year",res.year);
        $("#calendar tbody").html("");
        for (var l=0; l<res.calendar.length; l++) {
          $("#calendar tbody").append("<tr>");
          $("#calendar tbody tr:nth-child("+(l+1)+")").append($("<th>").html(res.calendar[l].id));
          for (var c=0; c<res.calendar[l].days.length; c++) {
            var day = res.calendar[l].days[c];
            var flags = " class=\"";
            flags += (day<1?" not-hover":""); // ne se grise pas au survol quand la case est vide
            flags += ((day==res.date.day && month==res.date.month && year == res.date.year)?" info":""); // case du jour grisée
            flags += "\"";
            $("#calendar tbody tr:nth-child("+(l+1)+")").append($("<td"+(flags!=""?flags:"")+">").html((day>0?day:"")));
          }
        }
    }});
});
$("#calendarNext").click(function(){
    var month = $("#calendar").attr("data-month");
    month++;
    var year = $("#calendar").attr("data-year");
    console.log("Prev ("+month+","+year+")");
    $.ajax({url: "agenda.ctrl.php?ajax&month="+month+"&year="+year, success: function(result){
        console.log("Result received !");
        console.log(result);
        var res = result;
        $("#calendarMonth").html(res.monthName);
        $("#calendar").attr("data-month",res.month);
        $("#calendar").attr("data-year",res.year);
        $("#calendar tbody").html("");
        for (var l=0; l<res.calendar.length; l++) {
          $("#calendar tbody").append("<tr>");
          $("#calendar tbody tr:nth-child("+(l+1)+")").append($("<th>").html(res.calendar[l].id));
          for (var c=0; c<res.calendar[l].days.length; c++) {
            var day = res.calendar[l].days[c];
            var flags = " class=\"";
            flags += (day<1?" not-hover":""); // ne se grise pas au survol quand la case est vide
            flags += ((day==res.date.day && month==res.date.month && year == res.date.year)?" info":""); // case du jour grisée
            flags += "\"";
            $("#calendar tbody tr:nth-child("+(l+1)+")").append($("<td"+(flags!=""?flags:"")+">").html((day>0?day:"")));
          }
        }
    }});
});
