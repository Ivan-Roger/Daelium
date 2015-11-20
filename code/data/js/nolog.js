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

$("#")
