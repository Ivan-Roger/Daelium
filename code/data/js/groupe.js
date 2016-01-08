$("#frameList li").click((function (e) {
  $("#frameList li[class='active']").attr("class","")
  $(e.currentTarget).attr("class","active");
  console.log("Test");
  console.log(e);
  $("#frameContent").attr("src",$("#frameList li[class='active'] a").data().url);
}));
