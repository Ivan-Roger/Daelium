<?php
  session_start();
  if (isset($_GET['login'])) {
    if(isset($_POST["mail"])){
      $dao = new DAO();
      $user = $dao->readUtilisateurByEmail($_POST["mail"]);
      if ($user===false) {
        // Mail invalide : retour sur connexion avec message d'erreur
        $data['errorFields']['inputEmail']=true;
        include("../view/signin.view.php");
      } else {
        if($user->getMdp() == $_POST["mdp"]){
          $_SESSION["userLoginMail"]=$_POST["mail"];
          $_SESSION["userLoginTime"]=date("");
          $_SESSION["userLoginID"]=$user->getIdUtilisateur();
          //$_SESSION["userLoginName"]=$user->getNom(); // NOM

          header("Location:"."../controler/main.ctrl.php?login");
        } else {
          // Mot de passe invalide : retour sur connexion avec message d'erreur
          $data['errorFields']['inputPassword']=true;
          include("../view/signin.view.php");
        }
      }
    } else {
      // Mail invalide : retour sur connexion avec message d'erreur
      $data['errorFields']['inputEmail']=true;
      include("../view/signin.view.php");
    }
  } else if (isset($_GET['logout'])) {
    // Deconnexion : vidage de $_SESSION
    header("Location:"."../controler/nolog.ctrl.php");
  } else {
    // Action inconnue : retour vers nolog.view
    header("Location:"."../controler/nolog.ctrl.php");
  }
?>
