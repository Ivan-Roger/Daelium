function onLoad() {
  gapi.load('auth2', function() {
    gapi.auth2.init();
  });
}
function signOut() {
  var auth2 = gapi.auth2.getAuthInstance();
  auth2.signOut().then(function () {
    console.log('User signed out.');
  });
  document.location="../controler/connexion.ctrl.php?logout";
}
$("#logoutBtn").click(signOut);
