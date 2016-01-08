<?php
  session_start();
  include("include/auth.ctrl.php");
  require_once("../model/utils.class.php");
  require_once("../model/DAO.class.php");
  $data = initPage("Groupes");
  $dao = new Dao();

  $userid= $_SESSION["user"]["ID"];
  $user = $dao->readBookerById($userid);
if(isset($_GET["action"]) && $_GET["action"] == "edit" && isset($_GET["id"])){
  $idgroupe = $_GET['id'];
  $groupe = $dao->readGroupeById($idgroupe);
  if($groupe != NULL){
    if($user != NULL){
      $present = $user->possedeGroupe($idgroupe);
    }else {
      $present = false;
    }
    if($present){
        $data['groupe']['id']=$_GET['id'];
        $data['groupe']['nom'] = $groupe->getNom();
        $data['groupe']["facebook"] = $groupe->getFacebook();
        $data['groupe']["twitter"] = $groupe->getTwitter();
        $data['groupe']["google"] = $groupe->getGoogle();
        $data['groupe']["soundcloud"] = $groupe->getSoundcloud();
        $data['groupe']["imageoff"] = $groupe->getLienImageOfficiel();
        $data['groupe']["fichecom"] = $groupe->getFicheCom();
          include("../view/groupe_fiche_edit.view.php");
    }else {
      $data['error']['title'] = "Acces Interdit";
      $data['error']['message'] = "Vous ne pouvez pas venir ici, cet espace est reservé au booker du groupe.";
      $data['error']['back'] = "../controler/main.ctrl.php";
      include("../view/error.view.php");
    }
  }else {
    $data['error']['title'] = "Groupe Inconnu";
    $data['error']['back'] = "../controler/groupes.ctrl.php";
    $data['error']['message'] = "Vous vous etes perdu";
    include("../view/error.view.php");
  }

}else if(isset($_GET["action"]) && $_GET["action"] == "edit"  && isset($_POST["idgroupe"])){


  $idgroupe = $_POST['idgroupe'];
  $groupe = $dao->readGroupeById($idgroupe);
  if($groupe != NULL){
    if($user != NULL){
      $present = $user->possedeGroupe($idgroupe);
    }else {
      $present = false;
    }
    if($present){
          $groupe->setFacebook($_POST["face"]);
          $groupe->setGoogle($_POST["gg"]);
          $groupe->setTwitter($_POST["twt"]);
          $groupe->setSoundcloud($_POST["sc"]);
          $groupe->setLienImageOfficiel($_POST["fichier"]);
          $groupe->setFicheCom($_POST["pagecom"]);

          $dao->updateGroupe($groupe);


          header("Location: ../controler/groupe_fiche.ctrl.php?id=".$idgroupe."");

    }else {
      $data['error']['title'] = "Acces Interdit";
      $data['error']['message'] = "Vous ne pouvez pas venir ici, cet espace est reservé au booker du groupe.";
      $data['error']['back'] = "../controler/main.ctrl.php";
      include("../view/error.view.php");
    }
  }else {
    $data['error']['title'] = "Groupe Inconnu";
    $data['error']['back'] = "../controler/groupes.ctrl.php";
    $data['error']['message'] = "Vous vous etes perdu";
    include("../view/error.view.php");
  }
}else if(isset($_GET["id"])) {
    $idgroupe = $_GET['id'];
    $groupe = $dao->readGroupeById($idgroupe);
    if($groupe != NULL){
      $listA = $dao->readArtisteByGroupe($idgroupe);
      $i = 0;
      foreach ($listA as $key => $value) {
        $artiste = $dao->readArtisteById($value["idartiste"]);
        $art[$i]['prenom'] = $artiste->getPrenom();
        $art[$i]['nom'] = $artiste->getNom();
        if($artiste->getDescription() == NULL){
            $art[$i]['description'] = "Pas de description disponible";
        }else{
          $art[$i]['description'] = $artiste->getDescription();
        }
        $i++;
      }

      if($user != NULL){
        $data['isbooker'] = $user->possedeGroupe($idgroupe);
        $data["canNego"] = false;
      }else {
        $data['isbooker'] = false;
        $data["canNego"] = true;
      }

      $data['artistes']= $art;

      $data['groupe']['id']=$_GET['id'];
      $data['groupe']['nom'] = $groupe->getNom();
      $data['groupe']['nb']= $i;
      $data['groupe']["fichecom"] = $groupe->getFicheCom();

      $bookerid = $dao->readBookerByGroupe($idgroupe);
      $booker = $dao->readBookerById($bookerid);
      $data["booker"]["id"] = $bookerid;
      $data["booker"]["nom"] = $booker->getNom();
      $data["booker"]["prenom"] = $booker->getPrenom();

      if ($groupe->getFacebook() == NULL &&  $groupe->getTwitter() == NULL && $groupe->getGoogle() == NULL && $groupe->getSoundcloud() == NULL) {
        $data['groupe']["facebook"] = NULL;
        $data['groupe']["twitter"] = NULL;
        $data['groupe']["google"] = NULL;
        $data['groupe']["soundcloud"] = NULL;
        $data['groupe']["rs"] = "Il n'y a pas de liens vers les reseaux sociaux";
      } else{
        $data['groupe']["facebook"] = $groupe->getFacebook();
        $data['groupe']["twitter"] = $groupe->getTwitter();
        $data['groupe']["google"] = $groupe->getGoogle();
          $data['groupe']["soundcloud"] = $groupe->getSoundcloud();
        $data['evenement']["rs"] ="";
      }


      //envoie les données pour un artiste
        include("../view/groupe_fiche.view.php");
    } else{
      $data['error']['title'] = "Groupe Inconnu";
      $data['error']['back'] = "../controler/main.ctrl.php";
      $data['error']['message'] = "Le groupe que vous cherchez n'existe pas ou plus !";
      include("../view/error.view.php");
    }
  } else {
    $data['error']['title'] = "Groupe Inconnu";
    $data['error']['back'] = "../controler/main.ctrl.php";
    $data['error']['message'] = "Le groupe que vous cherchez n'existe pas ou plus !";
    include("../view/error.view.php");
  }
?>
