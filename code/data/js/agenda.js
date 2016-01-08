function frDays(day) {
  day -= 1;
  if (day==-1) {
    day = 6;
  }
  return day;
}

function updateCalendar(func) {
  $(".loader").addClass("start");
  $(".loader").removeClass("end");
  $(".loader").removeClass("fail");
  $("#calendarTitle").html(AgendaDate.getMonthName()+" "+AgendaDate.getYear());
  $.ajax({url: "agenda.ctrl.php?ajax&calendar&month="+AgendaDate.getMonth()+"&year="+AgendaDate.getYear(), success: function(res){
    $(".loader").addClass("end");
    $(".loader").removeClass("start");
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
    $("#calendar tbody td[class~='day']").on('click',clickSetDay);
    if (func!=null) {
      func();
    }
  }, error: function(a, b, c) {
    $(".loader").addClass("fail");
    $(".loader").removeClass("start");
    console.warn("AJAX Error: couldn't update Calendar (\""+b+"\"/\""+c+"\")");
    console.log(a.responseText);
  }});
}

function updateCommingNext(func) {
  $(".loader").addClass("start");
  $(".loader").removeClass("end");
  $(".loader").removeClass("fail");
  $.ajax({url: "agenda.ctrl.php?ajax&next-events", success: function(res){
    $(".loader").addClass("end");
    $(".loader").removeClass("start");
    console.log("Update Comming Next !");
    console.log(res);
    $("#commingNext tbody").html("");
    for (var id in res.events) {
      $("#commingNext tbody").append("<tr data-id=\""+res.events[id].id+"\">");
      $("#commingNext tbody tr:last-child").append($("<td class=\"date\" data-date=\""+res.events[id].dateDebut+"\">").html(res.events[id].dateDebut));
      if (res.events[id].journee) {
        $("#commingNext tbody tr:last-child").append($("<td class=\"hour empty\" data-hour=\"day\">").html("Journée"));
        console.log("Day");
      } else
        $("#commingNext tbody tr:last-child").append($("<td class=\"hour\" data-hour=\""+res.events[id].heureDebut+"\">").html(res.events[id].heureDebut));
      $("#commingNext tbody tr:last-child").append($("<td>").html(res.events[id].name));
    }
    if (func!=null) {
      func();
    }
  }, error: function(a, b, c) {
    $(".loader").addClass("fail");
    $(".loader").removeClass("start");
    console.warn("AJAX Error: couldn't update Comming Next (\""+b+"\"/\""+c+"\")");
    console.log(a.responseText);
  }});
}

function updateEvent(id,func) {
  console.log("Open event "+id);
  $(".loader").addClass("start");
  $(".loader").removeClass("end");
  $(".loader").removeClass("fail");
  $.ajax({url: "agenda.ctrl.php?ajax&event="+id, success: function(res){
    $(".loader").addClass("end");
    $(".loader").removeClass("start");
    $("#eventEdit").collapse('hide');
    $("#eventView").collapse('show');
    $.scrollTo("#eventView");
    console.log("Update Event !");
    console.log(res);
    $("#eventView").attr("data-id",res.event.id);
    $("#eventView .eventTitle").html(res.event.name);
    $("#eventView .horaires .debut .date").html(res.event.dateDebut);
    $("#eventView .horaires .debut .heure").html("...");
    $("#eventView .horaires .fin .date").html(res.event.dateFin);
    $("#eventView .horaires .fin .heure").html("...");
    $("#eventView .lieu .text").html(res.event.lieu);
    if (res.event['lien-lieu']!=undefined)
      $("#eventView .lieu a").attr("href",res.event['lien-lieu']);
    else
      $("#eventView .lieu a").hide();

    $("#eventView .desc textarea").html(res.event.description);
    $("#eventView .participants tbody").html("");
    for (var id in res.event.participants) {
       $("#eventView .participants tbody").append($("<tr data-id=\""+res.event.participants[id]+"\" >")
          .append($("<td class=\"text-right\">").html("<span class=\"glyphicon glyphicon-user\">"))
          .append($("<td>").html("Marc")) // Nom du participant
          .append($("<td>").html("...")) // Notes
       );
    }
    if (func!=null) {
       func();
    }
  }, error: function(a, b, c) {
    $(".loader").addClass("fail");
    $(".loader").removeClass("start");
    console.warn("AJAX Error: couldn't update Event (\""+b+"\"/\""+c+"\")");
    console.log(a.responseText);
  }});
}

function updateDayPlan(func) {
  $("#dayPlanTitle").html(AgendaDate.getDayName()+" "+AgendaDate.getDay()+" "+AgendaDate.getMonthName());
  $(".loader").addClass("start");
  $(".loader").removeClass("end");
  $(".loader").removeClass("fail");
  $.ajax({url: "agenda.ctrl.php?ajax&events-day&day="+AgendaDate.getDay()+"&month="+AgendaDate.getMonth()+"&year="+AgendaDate.getYear(), success: function(res) {
    $(".loader").addClass("end");
    $(".loader").removeClass("start");
    console.log("Update Day Plan !");
    console.log(res);
    $("#dayPlan tr[data-hour=\"day\"] td.content").html("");
    for (var i=1; i<=24; i++) {
      $("#dayPlan tr[data-hour=\""+i+"\"] td.content").html("");
    }
    for (var id in res.events) {
      if (res.events[id].journee) {
         $("#dayPlan tr[data-hour=\"day\"] td.content").append($("<span class=\"evenement\" data-id=\""+res.events[id].id+"\">").html(res.events[id].name));
         $("#dayPlan tr[data-hour=\"day\"] td.content span.evenement:last-child").on('click',function (e) {
           updateEvent($(e.currentTarget).data().id);
         });
      } else {
         var hour = res.events[id].heureDebut.split(":")[0];
         hour = (hour>0?hour*1:hour);
         $("#dayPlan tr[data-hour=\""+hour+"\"] td.content").append($("<span class=\"evenement\" data-id=\""+res.events[id].id+"\">").html(res.events[id].name));
         $("#dayPlan tr[data-hour=\""+hour+"\"] td.content span.evenement:last-child").on('click',function (e) {
           updateEvent($(e.currentTarget).data().id);
         });
      }
      // DEBUG
      console.log("Evenement : ("+res.events[id].dateDebut+") : "+res.events[id].name);
    }
    if (func!=null) {
      func();
    }
  }, error: function(a, b ,c) {
    $(".loader").addClass("fail");
    $(".loader").removeClass("start");
    console.warn("AJAX Error: couldn't update Day Plan (\""+b+"\"/\""+c+"\")");
    console.log(a.responseText);
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
      console.log("Prev");
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
    updateCommingNext((function () {
      $("#commingNext tbody tr").on('click',function (e) {
        updateEvent($(e.currentTarget).data().id);
      });
    }));

    $("#calendarResetToday").on('click',function(){
      var d = new Date();
      AgendaDate.setDate(d.getDate(),d.getMonth()+1,d.getFullYear());
    });

    $("#calendarPrev").on('click',function(){
      AgendaDate.prevMonth();
    });
    $("#calendarNext").on('click',function(){
      AgendaDate.nextMonth();
    });

    $("#dayPlanPrev").on('click',function(){
      AgendaDate.prevDay();
    });
    $("#dayPlanNext").on('click',function(){
      AgendaDate.nextDay();
    });

    $("#newEvent").on('click',function(){
      $("#eventView").collapse('hide');
      $("#eventEdit").collapse('show');
      $.scrollTo("#eventEdit");
    });

    $("#eventDayLong").on('change',function(e){
      if ($(e.currentTarget).is(":checked")) {
        $(".hour-input").hide();
      } else {
        $(".hour-input").show();
      }
      $("#eventDayLongValue").val(($(e.currentTarget).is(":checked")?"checked":"empty"))
    });

    $("#calendar tbody td[class~='day']").on('click',clickSetDay);

    console.log("Agenda initialized ...");
  }
