<?php
  session_start();
  include("include/auth.ctrl.php");
  require_once("../model/utils.class.php");
  require_once("../model/DAO.class.php");
  $data = initPage("Groupes");
  $dao = new Dao();




 if(isset($_GET["id"])) {
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

    $data['artistes']= $art;

    $data['groupe']['id']=$_GET['id'];
    $data['groupe']['nom'] = $groupe->getNom();
    $data['groupe']['nb']= $i;


    $bookerid = $dao->readBookerByGroupe($idgroupe);
      $booker = $dao->readBookerById($bookerid);
      $data["booker"]["id"] = $bookerid;
      $data["booker"]["nom"] = $booker->getNom();
      $data["booker"]["prenom"] = $booker->getPrenom();


    if($groupe->getFacebook() == NULL &&  $groupe->getTwitter() == NULL && $groupe->getGoogle() == NULL){
      $data['evenement']["facebook"] = NULL;
      $data['evenement']["twitter"] = NULL;
      $data['evenement']["google"] = NULL;
      $data['evenement']["rs"] = "Il n'y a pas de liens vers les reseaux sociaux";
    }else{
      $data['evenement']["facebook"] = $groupe->getFacebook();
      $data['evenement']["twitter"] = $groupe->getTwitter();
      $data['evenement']["google"] = $groupe->getGoogle();
      $data['evenement']["rs"] ="";
    }

    $lineUp['nom'] = "Hello";
    $lineUp['url'] = "https://www.youtube.com/embed/YQHsXMglC9A?feature=player_detailpage";
    $data['lineUp'][] = $lineUp;

    $lineUp['nom'] = "Overwerk";
    $lineUp['url'] = "https://w.soundcloud.com/player/?url=https%3A//api.soundcloud.com/tracks/231318729&amp;auto_play=false&amp;hide_related=false&amp;show_comments=true&amp;show_user=true&amp;show_reposts=false&amp;visual=true";
    $data['lineUp'][] = $lineUp;

    //envoie les données pour un artiste
    include("../view/groupe_fiche.view.php");
  }else{
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
