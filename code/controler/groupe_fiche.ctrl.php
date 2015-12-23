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
      $artiste = $dao->readArtisteById($value);
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


    $bookeridlist = $dao->readListBookerByGroupe($idgroupe);
    foreach ($bookeridlist as $key => $value) {
      $booker = $dao->readBookerById($value);
      $data["booker"][$key]["id"] = $value;
      $data["booker"][$key]["nom"] = $booker->getNom();
      $data["booker"][$key]["prenom"] = $booker->getPrenom();
    }

    $album['nom'] = "Hon Hop";
    $album['date'] = "2013";
    $data['albums'][] = $album;

    $album['nom'] = "Ping Pong";
    $album['date'] = "2015";
    $data['albums'][] = $album;

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
