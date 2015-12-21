<?php
  session_start();
  include("include/auth.ctrl.php");
  require_once("../model/utils.class.php");
  require_once("../model/DAO.class.php");
  $data = initPage("Profil");

  if(isset($_GET["id"])){
    $userpid = (int) $_GET["id"];
    $data["owner"] = $userpid == $_SESSION["user"]["ID"]; // tester si $_SESSION["user"]["ID"] existe.
  }else if (isset($_SESSION["user"]["ID"])){
    $userpid = $_SESSION["user"]["ID"];
    $data["owner"] = true;
  }else{
    $userpid = NULL;
  }

  $dao = new DAO();
  if(isset($userpid)){

    $user = $dao->readPersonneByIdGoodClasse($userpid);

    $data["nomcomplet"] = $user->getNomComplet();
    $data["mail"] = $user->getEmailCompte();
    $data["mailco"] = $user->getEmailcontact();
    $data["tel"] = $user->getTel();
    $data["description"] = $user->getDescription();

    if($user->getType() == 0){
      $data["list"] = "Mes Groupes";
    }elseif ($user->getType() == 1) {
      $data["list"] = "Mes Evenenements";
    }
    //recup le lieu
  }else {
    //erreur 404.
    //page introuvable.
  }


  include("../view/profil.view.php");
?>
