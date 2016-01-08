function attachNavbar() {
  if (window.pageYOffset >= $("#navbarOrg").offset().top) {
    console.log("Navbar attached");
    $("#navbar").css("position","fixed");
    $("#navbar").css("top","0px");
    $("#navbar").css("left","0px");
    $("#navbarOrg").css("margin-bottom","50px");
  } else {
    console.log("Navbar distached");
    $("#navbarOrg").css("margin-bottom","0px");
    $("#navbar").css("position","relative");
  }
}

function scroll() {
  /*
  if (window.pageYOffset >= counters_offset) {
    $("#counters").trigger("page.scroll.counter");
  }
  */
  for (key in scroll_triggers) {
    if (window.pageYOffset>=key) {
      $(document).trigger("page.scroll."+scroll_triggers[key]);
    }
  }
}

function counter(elem,id) {
  var val = elem.dataset.from*1;
  var to = elem.dataset.to*1;
  var speed = elem.dataset.speed*1;
  var time=new Date();
  var turn=0;

  inc = to/(speed/25);

  var tmp = setInterval(function () {
    val += inc;
    if (val >= to) {
      clearInterval(tmp);
      elem.innerHTML=to;
      var end = new Date();
      var temps = (end.getMilliseconds()-time.getMilliseconds()) + (end.getSeconds()-time.getSeconds())*1000;
      console.log("Counter "+id+" terminated in "+temps+" ms ("+turn+")");
      $(document).trigger("page.counter."+id+".over");
    } else {
      elem.innerHTML=Math.ceil(val);
      turn++;
    }
  },24);
  console.log("Counter "+id+" initialized "+val+" > "+to+" ("+speed+" ms) nb "+(speed/25)+" inc "+inc);
}

//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

var counters_once = false;
var counters_offset = $("#counters").offset().top-(window.innerHeight/2);
var scroll_triggers = new Array();
  scroll_triggers[$("#counters").offset().top-(window.innerHeight/2)] = "counter";
  scroll_triggers[$("#troops").offset().top-(window.innerHeight/2)] = "troops";


$("#sliderButton, .btn-down").click(function() {
  $.scrollTo('#contentAnchor',400);
});

$(document).on("page.scroll.troops", function () {
  $("#troop_1").slideDown(function() {
    $("#troop_2").slideDown(function() {
      $("#troop_3").slideDown();
    });
  });
});

$(document).on("page.scroll.counter", function () {
  if (!counters_once) {
    counters_once = true;
    $("#counters div:nth-child(1)").fadeIn();
    setTimeout(function () {
      counter($('.counter')[0],1);
    },400);
  }
});

$(document).on("page.counter.1.over", function () {
  $("#counters div:nth-child(2)").fadeIn();
  setTimeout(function () {
    counter($('.counter')[1],2);
  },400);
});

$(document).on("page.counter.2.over", function () {
  $("#counters div:nth-child(3)").fadeIn();
  setTimeout(function () {
    counter($('.counter')[2],3);
  },400);
});
