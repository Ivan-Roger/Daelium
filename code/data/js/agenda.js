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
    }, error: function(a, b, c) {
      console.warn("AJAX Error: couldn't update Calendar (\""+b+"\")");
    }});
}

function updateCommingNext(func) {
  $.ajax({url: "agenda.ctrl.php?ajax&events", success: function(res){
    console.log("Update Comming Next !");
    console.log(res);
    $("#commingNext tbody").html("");
    for (var id in res.events) {
      $("#commingNext tbody").append("<tr>");
      $("#commingNext tbody tr:last-child").append($("<td class=\"date\" data-date=\""+res.events[id].day+"\">").html(res.events[id].day));
      if (res.events[id].hour=="day") {
        $("#commingNext tbody tr:last-child").append($("<td class=\"hour empty\" data-hour=\""+res.events[id].hour+"\">").html("Journée"));
        console.log("Day");
      } else
        $("#commingNext tbody tr:last-child").append($("<td class=\"hour\" data-hour=\""+res.events[id].hour+"\">").html(res.events[id].hour));
      $("#commingNext tbody tr:last-child").append($("<td>").html(res.events[id].name));
    }
    if (func!=null) {
      func();
    }
  }, error: function(a, b, c) {
    console.warn("AJAX Error: couldn't update Comming Next (\""+b+"\")");
  }});
}

function updateEvent(id,func) {
  $.ajax({url: "agenda.ctrl.php?ajax&event="+id, success: function(res){
    console.log("Update Event !");
    console.log(res);
    $("#eventView").attr("data-id","");
    $("#eventView .eventTitle").html("");
    $("#eventView .horaires .debut .date").html("");
    $("#eventView .horaires .debut .heure").html("");
    $("#eventView .horaires .fin .date").html("");
    $("#eventView .horaires .fin .heure").html("");
    $("#eventView .lieu .text").html("");
    $("#eventView .lieu a").attr("href","");
    $("#eventView .desc textarea").html("");
    $("#eventView .participants tbody").html("");
    for (var id in res.event.participants) {
      $("#eventView .participants tbody").append($("<tr data-id=\""+res.event.participants[id]+"\" >")
         .append($("<td class=\"text-right\">").html("<span class=\"glyphicon glyphicon-user\">"))
         .append($("<td>").html("Marc")) // Nom du participant
         .append($("<td>").html("...")); // Notes
    }
    if (func!=null) {
      func();
    }
  }, error: function(a, b, c) {
    console.warn("AJAX Error: couldn't update Event (\""+b+"\")");
  }});
}

function updateDayPlan(func) {
  $("#dayPlanTitle").html(AgendaDate.getDayName()+" "+AgendaDate.getDay()+" "+AgendaDate.getMonthName());
  $.ajax({url: "agenda.ctrl.php?ajax&events-day&day="+AgendaDate.getDay()+"&month="+AgendaDate.getMonth()+"&year="+AgendaDate.getYear(), success: function(res) {
    console.log("Update Day Plan !");
    console.log(res);
    $("#dayPlan tr[data-hour=\"day\"] td.content").html("");
    for (var i=1; i<=24; i++) {
      $("#dayPlan tr[data-hour=\""+i+"\"] td.content").html("");
    }
    for (var id in res.events) {
      var hour = res.events[id].hour.split("h")[0];
      hour = (hour>0?hour*1:hour);
      $("#dayPlan tr[data-hour=\""+hour+"\"] td.content").append($("<span class=\"evenement\" data-id=\""+id+"\">").html(res.events[id].name));
      $("#dayPlan tr[data-hour=\""+hour+"\"] td.content span.evenement:last-child").click(function (e) {
        console.log("Open event "+$(e.currentTarget).data().id);
      });
      // DEBUG
      console.log("Evenement : ("+AgendaDate.getDate()+" "+res.events[id].hour+") : "+res.events[id].name);
    }
    if (func!=null) {
      func();
    }
  }, error: function(a, b ,c) {
    console.warn("AJAX Error: couldn't update Day Plan (\""+b+"\")");
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
    $("#calendar tbody td[class~='day']").on('click',clickSetDay);
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

    $("#calendar tbody td[class~='day']").on('click',clickSetDay);
  }


init();
