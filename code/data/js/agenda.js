function frDays(day) {
  day -= 1;
  if (day==-1) {
    day = 6;
  }
  return day;
}

function updateCalendar(func) {
  $("#calendarTitle").html(AgendaDate.getMonthName()+" "+AgendaDate.getYear());
  $.ajax({url: "agenda.ctrl.php?ajax&calendar&month="+AgendaDate.getMonth()+"&year="+AgendaDate.getYear(), success: function(res){
      console.log("Update calendar !");
      console.log(res);
      $("#calendar tbody").html("");
      for (var l=0; l<res.calendar.length; l++) {
        $("#calendar tbody").append("<tr data-week=\""+res.calendar[l].id+"\" >");
        $("#calendar tbody tr:nth-child("+(l+1)+")").append($("<th>").html(res.calendar[l].id));
        for (var c=0; c<res.calendar[l].days.length; c++) {
          var day = res.calendar[l].days[c];
          var flags = " class=\"";
          flags += (day<1?" not-hover":" day"); // ne se grise pas au survol quand la case est vide
          var d = new Date();
          flags += ((AgendaDate.getDay()==day)?" selected":""); // case du selectionnée bleue
          flags += ((day==d.getDate() && AgendaDate.getMonth()==d.getMonth()+1 && AgendaDate.getYear()==d.getFullYear())?" info":""); // case du jour
          flags += "\" data-day=\"";
          flags += day;
          flags += "\"";
          $("#calendar tbody tr:nth-child("+(l+1)+")").append($("<td"+(flags!=""?flags:"")+">").html((day>0?day:"")));
        }
      }
      $("#calendar tbody td[class~='day']").click(clickSetDay);
      if (func!=null) {
        func();
      }
  }});
}

function updateCommingNext(func) {
  $.ajax({url: "agenda.ctrl.php?ajax&events", success: function(res){
    console.log("Update Comming Next !");
    console.log(res);
    $("#commingNext tbody").html("");
    for (var d in res.events) {
      for (var h in res.events[d]) {
        for (var e in res.events[d][h]) {
          $("#commingNext tbody").append("<tr>");
          $("#commingNext tbody tr:last-child").append($("<td class=\"date\" data-date=\""+d+"\">").html(d));
          if (h=="day") {
            $("#commingNext tbody tr:last-child").append($("<td class=\"hour empty\" data-hour=\""+h+"\">").html("Toute la journée"));
            console.log("Day");
          } else
            $("#commingNext tbody tr:last-child").append($("<td class=\"hour\" data-hour=\""+h+"\">").html(h));
          $("#commingNext tbody tr:last-child").append($("<td>").html(res.events[d][h][e].name));

          // DEBUG
          console.log("Evenement : ("+d+" "+h+") : "+res.events[d][h][e].name);
        }
      }
    }
    if (func!=null) {
      func();
    }
  }});
}

function updateDayPlan(func) {
  $("#dayPlanTitle").html(AgendaDate.getDayName()+" "+AgendaDate.getDay()+" "+AgendaDate.getMonthName());
  $.ajax({url: "agenda.ctrl.php?ajax&events&day="+AgendaDate.getDay()+"&month="+AgendaDate.getMonth()+"&year="+AgendaDate.getYear(), success: function(res) {
    console.log("Update Day Plan !");
    console.log(res);
    for (var i=1; i<=24; i++) {
      $("#dayPlan tbody tr[data-hour=\""+i+"\"] td.content").html("");
    }
    for (var h in res.events[AgendaDate.getDate()]) {
      var hour = h.split("h")[0]*1;
      for (var e in res.events[AgendaDate.getDate()][h]) {
        $("#dayPlan tbody tr[data-hour=\""+hour+"\"] td.content").append($("<span class=\"evenement\" data-url=\""+(res.events[AgendaDate.getDate()][h][e].id)+"\">").html(res.events[AgendaDate.getDate()][h][e].name));
        $("#dayPlan tbody tr[data-hour=\""+hour+"\"] td.content span.evenement:last-child").click(function (e) {

        });
        // DEBUG
        console.log("Evenement : ("+AgendaDate.getDate()+" "+h+") : "+res.events[AgendaDate.getDate()][h][e].name);
      }
    }
    if (func!=null) {
      func();
    }
  }});
}

  var AgendaDate = {
    jours: ["Lundi","Mardi","Mercredi","Jeudi","Vendredi","Samedi","Dimanche"],
    mois: ["Janvier","Fevrier","Mars","Avril","Mai","Juin","Juillet","Aout","Septembre","Octobre","Novembre","Decembre"],
    set(wday,day,month,year,mlength) {
      $("#calendar").attr("data-wday",wday);
      $("#calendar").attr("data-day",day);
      $("#calendar").attr("data-month",month);
      $("#calendar").attr("data-year",year);
      $("#calendar").attr("data-mlength",mlength);
      this.update();
    },
    update(func) {
      $.ajax({url: "agenda.ctrl.php?ajax&day="+AgendaDate.getDay()+"&month="+AgendaDate.getMonth()+"&year="+AgendaDate.getYear(), success: function(res){
        $("#calendar").attr("data-mlength",res.monthLength);
        $("#calendar").attr("data-wday",res.wday);
        $("#calendarTitle").html(AgendaDate.getMonthName()+" "+AgendaDate.getYear());
        $("#dayPlanTitle").html(AgendaDate.getDayName()+" "+AgendaDate.getDay()+" "+AgendaDate.getMonthName());
        updateCalendar((function () {
          updateDayPlan(func);
        }));
      }});
    },
    setDate(day,month,year) {
      $("#calendar").attr("data-day",day);
      $("#calendar").attr("data-month",month);
      $("#calendar").attr("data-year",year);
      this.update();
    },
    getDate() {
      return AgendaDate.getDay()+"/"+AgendaDate.getMonth()+"/"+AgendaDate.getYear();
    },
    getDay() {
      return $("#calendar").attr("data-day")*1;
    },
    getWeekDay() {
      return $("#calendar").attr("data-wday")*1;
    },
    getMonth() {
      return $("#calendar").attr("data-month")*1;
    },
    getYear() {
      return $("#calendar").attr("data-year")*1;
    },
    getDayName() {
      return this.jours[this.getWeekDay()];
    },
    getMonthName() {
      return this.mois[this.getMonth()-1];
    },
    getMonthLength() {
      return $("#calendar").attr("data-mlength")*1;
    },
    prevMonth() {
      $("#calendar").attr("data-day",1);
      if (this.getMonth()==1) {
        $("#calendar").attr("data-month",12);
        $("#calendar").attr("data-year",this.getYear()-1);
      } else
        $("#calendar").attr("data-month",this.getMonth()-1);
      console.log("Prev");
      this.update();
    },
    nextMonth() {
      $("#calendar").attr("data-day",1);
      if (this.getMonth()==12) {
        $("#calendar").attr("data-month",1);
        $("#calendar").attr("data-year",this.getYear()+1);
      } else
        $("#calendar").attr("data-month",this.getMonth()+1);
      console.log("Next");
      this.update();
    },
    prevDay() {
      if (this.getDay()==1) {
        if (this.getMonth()==1) {
          $("#calendar").attr("data-month",12);
          $("#calendar").attr("data-year",this.getYear()-1);
        } else {
          $("#calendar").attr("data-month",this.getMonth()-1);
        }
        this.update(function () {
          $("#calendar").attr("data-day",AgendaDate.getMonthLength());
          updateCalendar();
          updateDayPlan();
        });
      } else {
        $("#calendar").attr("data-day",this.getDay()-1);
        this.update();
      }
      console.log("Next");
    },
    nextDay() {
      if (this.getDay()==this.getMonthLength()) {
        $("#calendar").attr("data-day",1);
        if (this.getMonth()==12) {
          $("#calendar").attr("data-month",1);
          $("#calendar").attr("data-year",this.getYear()+1);
        } else {
          $("#calendar").attr("data-month",this.getMonth()+1);
        }
      } else
        $("#calendar").attr("data-day",this.getDay()+1);
      console.log("Next");
      this.update();
    },
    setDay(day) {
      $("#calendar").attr("data-day",day);
      console.log("Day :"+day);
      this.update();
    }
  }

  function clickSetDay(e) {
    AgendaDate.setDay(e.currentTarget.dataset.day);
    $("#calendar tbody td[class~='day']").click(clickSetDay);
  }

  function init() {
    updateCommingNext();

    $("#calendarResetToday").click(function(){
      var d = new Date();
      AgendaDate.setDate(d.getDate(),d.getMonth()+1,d.getFullYear());
    });

    $("#calendarPrev").click(function(){
      AgendaDate.prevMonth();
    });
    $("#calendarNext").click(function(){
      AgendaDate.nextMonth();
    });

    $("#dayPlanPrev").click(function(){
      AgendaDate.prevDay();
    });
    $("#dayPlanNext").click(function(){
      AgendaDate.nextDay();
    });

    $("#calendar tbody td[class~='day']").click(clickSetDay);
  }


init();
