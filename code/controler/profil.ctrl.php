<?php
  session_start();
  include("include/auth.ctrl.php");
  require_once("../model/utils.class.php");
  require_once("../model/DAO.class.php");
  $data = initPage("Profil");

  if(isset($_GET["id"])){
    $userpid = $_GET["id"];
    $data["owner"] = $_GET["id"] == $_SESSION["user"]["ID"]; // tester si $_SESSION["user"]["ID"] existe.
  }else if (isset($_SESSION["user"]["ID"])){
    $userpid = $_SESSION["user"]["ID"];
    $data["owner"] = true;
  }else{
    $userpid = NULL;
  }

  $dao = new DAO();
  if($userpid != NULL){
    $user = $dao->readUtilisateurById($userpid);

    $data["nomcomplet"] = $user->getNomComplet();
    $data["mail"] = $user->getEmailCompte();
    $data["mailco"] = $user->getEmailcontact();
    $data["tel"] = $user->getTel();
    //recup le lieu
    //si c'est un booker alors charger ses groupe sinon pour un organisateur ses evts.
  }else {
    //erreur 404.
    //page introuvable.
  }


  include("../view/profil.view.php");
?>
