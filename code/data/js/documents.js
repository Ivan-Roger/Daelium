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
    console.log(this.responseText);
    var res = JSON.parse(this.responseText);
    if (res.request.code==200) {
      console.log('Succés!');
      console.log(res);
      window.location=window.location;
    } else {
      console.warn("ERROR : ",res);
    }
  });
  xhr.open('post', upURL, true);

  var data = new FormData;
  data.append('file', file);
  xhr.send(data);
}

function createDir(upURL,folderName) {
  $.ajax({url: upURL+"/"+folderName, success: function(res){
    if (res.request.code==200) {
      console.log('Succés!');
      console.log(res);
      window.location=window.location;
    } else {
      console.warn("ERROR : ",res);
    }
  }, error: function(a,b,c){
    console.warn("AJAX Error: couldn't create Dir (\""+b+"\"/\""+c+"\")");
    console.log(a.responseText);
  }});
}

function deleteItem(target) {
  var yes = confirm("Vous êtes sur le point de supprimer : "+target+" ! Continuer ?");
  if (yes) {
    $.ajax({url: "../controler/documents.ctrl.php?ajax&delete&target="+target, success: function(res){
      if (res.request.code==200) {
        console.log('Succés!');
        console.log(res);
        window.location=window.location;
      } else {
        console.warn("ERROR : ",res);
      }
    }, error: function(a,b,c){
      console.warn("AJAX Error: couldn't delete Item (\""+b+"\"/\""+c+"\")");
      console.log(a.responseText);
    }});
  }
}

function shareItem(btn,target) {
  $.ajax({url: "../controler/documents.ctrl.php?ajax&share&target="+target, success: function(res){
    console.log('Succés!');
    console.log(res);
    console.log($(btn).attr("aria-descibedby"));
    $("#"+$(btn).attr("aria-describedby")+" .popover-content").html('Partagez votre fichier en fournissant ce lien :<br/><input type="text" readonly value="'+res.link+'"/>');
  }, error: function(a,b,c){
    console.warn("AJAX Error: couldn't delete Item (\""+b+"\"/\""+c+"\")");
    console.log(a.responseText);
  }});
}

$(function () {
  $('[data-toggle="popover"]').popover();
});

$("#sendFile").on('click',function (e) {
  upload($(e.currentTarget).data().action);
});

$("#sendNewFolder").on('click',function (e) {
  createDir($(e.currentTarget).data().action,$("#newFolderName").val());
});

$(".delete-btn").on('click',function (e) {
  deleteItem($(e.currentTarget).data().target);
});

$(".share-btn").on('click',function (e) {
  if ($(e.currentTarget).attr("aria-describedby")==undefined) {
    shareItem(e.currentTarget,$(e.currentTarget).data().target);
  }
});
