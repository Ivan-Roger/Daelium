function upload(upURL) {
  console.log("Envoi en cours ...");
  var file = document.getElementById('file').files[0];
  var xhr = new XMLHttpRequest();
  (xhr.upload || xhr).addEventListener('progress', function(e) {
    var done = e.position || e.loaded
    var total = e.totalSize || e.total;
    var progress = Math.round(done/total*100);
    progress = (progress>=100?0:progress);
    $("#uploadPanel .loader").width(progress+'%');
  });
  xhr.addEventListener('load', function(e) {
    $("#uploadPanel .loader").addClass('done');
    console.log('Envoi terminé.');
    console.log(this.responseText);
    setTimeout(function () {
      window.location=window.location;
    },1500);
  });
  xhr.open('post', upURL, true);

  var data = new FormData;
  data.append('file', file);
  xhr.send(data);
}

$("#sendFile").on('click',function (e) {
  upload($(e.currentTarget).data().action);
});
