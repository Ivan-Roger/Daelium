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
    $data["mailco"] = $user->getEmailcontact();
    $data["tel"] = $user->getTel();
    if($user->getDescription() == NULL){
      $data["description"] = "Aucune description ...";
    }else {
      $data["description"] = $user->getDescription();
    }
    $data["type"] = $user->getNomType();



    if($user->getType() == 0){ //Un booker
      $data["user"] = true;
      $data["mail"] = $user->getEmailCompte();
      $data["listname"] = "Je gère ces groupes";
      $listidgroupe = $dao->readListGroupeByBooker($user->getIdPersonne());
      foreach ($listidgroupe as $key => $value) {
        $listegroupe[] = $dao->readGroupeById((int) $value);
      }
      $data["list"] = $listegroupe;
    }elseif ($user->getType() == 1) { //Un Organisateur
      $data["user"] = true;
      $data["mail"] = $user->getEmailCompte();
      $data["listname"] = "Je gère ces evenenements";
      $listidevt = $dao->readManifestationByCreateur($user->getIdPersonne());
      var_dump($listidevt);
      // foreach ($listidevt as $key => $value) {
      //   $listevt[] = $dao->readGroupeById((int) $value);
      // }
      $data["list"] = $listevt;
    }else{ // Un artiste
      $data["user"] = false;
      $data["listname"] = "J'appartiens aux groupes";
      $listidgroupe = $dao->readListGroupeByArtiste($user->getIdPersonne());
      foreach ($listidgroupe as $key => $value) {
        $listegroupe[] = $dao->readGroupeById((int) $value);
      }
      $data["list"] = $listegroupe;
      var_dump($data["list"]);
    }
    //recup le lieu
  }else {
    //erreur 404.
    //page introuvable.
  }


  include("../view/profil.view.php");
?>
