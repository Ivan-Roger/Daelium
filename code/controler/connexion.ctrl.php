<?php
  session_start();
  require_once("../model/DAO.class.php");
  $data = Array();
  if (isset($_GET['login'])) {
    $mail=false;
    if (isset($_GET['google'])) {
      $res = json_decode(file_get_contents("https://www.googleapis.com/oauth2/v3/tokeninfo?id_token=".$_GET['token']),true);
      if (isset($res['error_description'])) {
        // Token invalide
        $data['errorMessage']="Invalid Token ... Try again !";
        include("../view/signin.view.php");
      }
      $mail = $res['email'];
      $dao = new DAO();
      $user = $dao->readUtilisateurByEmail($mail);
      if ($user==null) {
        // Mail invalide : retour sur connexion avec message d'erreur
        $data['errorMessage']="Invalid Email ... Try again !";
        $data['errorFields']['inputEmail']=true;
        include("../view/signin.view.php");
      } else {
        $_SESSION["user"]["mail"]=$mail;
        $_SESSION["user"]["loginTime"]=date("");
        $_SESSION["user"]["ID"]=$user->getIdPersonne();
        $_SESSION["user"]["type"]=$user->getType();
        $dao->createConnexionInJournal($user->getIdPersonne(),date("Y-m-d H:i:s"),$_SERVER['REMOTE_ADDR'],$_SERVER['HTTP_USER_AGENT']);

        /*
        $id_user = $user->getIdUtilisateur();
        var_dump($id_user);
        $pers = $dao->readPersonneById($id_user);
        var_dump($pers);
        $_SESSION["user"]["name"]=$pers->getNom(); // NOM
        */
        header("Location:"."../controler/main.ctrl.php?login");
      }
    } else if(isset($_POST["mail"])) {
      $mail = $_POST["mail"];
      $dao = new DAO();
      $user = $dao->readUtilisateurByEmail($mail);
      if ($user==null) {
        // Mail invalide : retour sur connexion avec message d'erreur
        $data['errorMessage']="Invalid Email ... Try again !";
        $data['errorFields']['inputEmail']=true;
        include("../view/signin.view.php");
      } else {
        if($user->getMdp() == hash('sha2',$_POST["mdp"])){
          $_SESSION["user"]["mail"]=$mail;
          $_SESSION["user"]["loginTime"]=date("");
          $_SESSION["user"]["ID"]=$user->getIdPersonne();
          $_SESSION["user"]["type"]=$user->getType();

          //$_SESSION["userLoginName"]=$user->getNom(); // NOM
          $dao->createConnexionInJournal($user->getIdPersonne(),date("Y-m-d H:i:s"),$_SERVER['REMOTE_ADDR'],$_SERVER['HTTP_USER_AGENT']);

          header("Location:"."../controler/main.ctrl.php?login");
        } else {
          // Mot de passe invalide : retour sur connexion avec message d'erreur
          $data['errorMessage']="Invalid Password ... Try again !";
          $data['errorFields']['inputPassword']=true;
          include("../view/signin.view.php");
        }
      }
    } else {
      // Mail invalide : retour sur connexion avec message d'erreur
      $data['errorMessage']="Invalid Connection ... Try again !";
      include("../view/signin.view.php");
    }
  } else if (isset($_GET['logout'])) {
    // Deconnexion : vidage de $_SESSION
    session_destroy();
    session_write_close();
    setcookie(session_name(),'',0,'/');
    header("Location:"."../controler/nolog.ctrl.php");
  } else {
    // Pas d'action, on affiche la page
    include("../view/signin.view.php");
  }
?>
