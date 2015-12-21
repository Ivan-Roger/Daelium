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
    $data["typename"] = $user->getNomType();
    $data["type"] = $user->getType();



    if($user->getType() == 0){ //Un booker
      $data["user"] = true;
      $data["mail"] = $user->getEmailCompte();
      $data["listname"] = "Je gère ces groupes";
      $listidgroupe = $dao->readListGroupeByBooker($user->getIdPersonne());
      foreach ($listidgroupe as $key => $value) {
        $groupe = $dao->readGroupeById((int) $value);
        $data["list"][$key]["nom"] = $groupe->getNom();
        $data["list"][$key]["id"] = $groupe->getIdGroupe();
      }
    }elseif ($user->getType() == 1) { //Un Organisateur
      $data["user"] = true;
      $data["mail"] = $user->getEmailCompte();
      $data["listname"] = "Je gère ces evenenements";
      $listevt= $dao->readManifestationByCreateur($user->getIdPersonne());
      foreach ($listevt as $key => $value) {
        $data["list"][$key]["nom"] = $value->getNom();
        $data["list"][$key]["id"] = $value->getidManif();
        $data["list"][$key]["dated"] = $value->getDateDebut();
        if($data["list"][$key]["dated"] == $value->getDateFin()){
          $data["list"][$key]["datef"] = "";
        }else{
          $data["list"][$key]["datef"] = " - ".$value->getDateFin();
        }

      }

    }else{ // Un artiste
      $data["user"] = false;
      $data["listname"] = "J'appartiens aux groupes";
      $listidgroupe = $dao->readListGroupeByArtiste($user->getIdPersonne());
      foreach ($listidgroupe as $key => $value) {
        $groupe = $dao->readGroupeById((int) $value);
        $data["list"][$key]["nom"] = $groupe->getNom();
        $data["list"][$key]["id"] = $groupe->getIdGroupe();
      }
    }
    //recup le lieu
  }else {
    //erreur 404.
    //page introuvable.
  }


  include("../view/profil.view.php");
?>
