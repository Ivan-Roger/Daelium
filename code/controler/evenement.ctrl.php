<?php
session_start();
//include_once("../model/Artist.class.php");
include("include/auth.ctrl.php");
require_once("../model/utils.class.php");
require_once("../model/DAO.class.php");
$data = initPage("Events");
$dao = new Dao();

$userid= $_SESSION["user"]["ID"];
$user = $dao->readOrganisateurById($userid);

if($user != NULL){ // SI c'est un organisateur
  if (isset($_GET['id'])) { // Si il n'y a pas d'id alors -> message d'erreur
    $evtid = $_GET['id'];
    $evt = $dao->readManifestationById($evtid);// Recupérer les données depuis la BD avec l'id ($_GET['id'])
    if($evt != NULL){ // Si existe dans BD
      //On verifie que la manifestation appartient bien a l'organisateur.
      $listeevtuser = $dao->readIdManifestationByCreateur($userid);
      if($listeevtuser != NULL){ // Si l'organisateur a au moins un evt.
        $present = $user->possedeManif($evtid,$listeevtuser);
      }else {
        $present = false;
      }

      if($present){ //Si il est le proprietaire de l'evt alors on affiche. sinon message d'erreur
        //Information sur l'evt !
        $data['evenement']['id'] = $evtid;
        $data['evenement']['nom'] = $evt->getNom();
        $data['evenement']['dated'] = $evt->getDateDebut();
        $data['evenement']['datef'] = $evt->getDateFin();
        $data['evenement']['type'] = $evt->getType();
        $genre = $dao->readManifestationGenreByidManif($evtid);
        $data['evenement']['genre'] = "";
        if($genre != NULL){
          foreach ($genre as $key => $value) {
            $data['evenement']['genre'] = $data['evenement']['genre']." ".$value['nomg'];
          }
        }else {
          $data['evenement']['genre'] = "Aucun genre";
        }
        if($evt->getDescription() == NULL){
          $data['evenement']['description'] = "Aucune description";
        }else {
          $data['evenement']['description'] = $evt->getDescription();
        }
        if(($idlieu = $evt->getLieu()) == NULL){
          $data['evenement']['lieu']['adresse'] = "Non indiquée";
          $data['evenement']['lieu']['googlemaps'] = NULL;
        }else{
          $lieu = $dao->readLieuById($idlieu);
          $data['evenement']['lieu']['adresse'] =  $lieu->getAdresse().", ".$lieu->getcodepostal().", ".$lieu->getVille().", ".$lieu->getPays();
          $data['evenement']['lieu']['googlemaps'] = "https://www.google.fr/maps/place/".str_replace ( ' ' ,'+' ,$lieu->getAdresse())."+".$lieu->getcodepostal()."+".$lieu->getVille()."+".strtolower($lieu->getPays());
        }

        // Les creneaux & groupe
        $creneaux = $dao->readCreneauByidManif($evtid);
        foreach ($creneaux as $key => $value) {
          $k = $value->getDate().$value->getHeureDebut();
          $k2 = $value->getDate().$value->getHeureDebutTest();
          $data['passages'][$k]['type'] = "Representation";
          $data['passages'][$k2]['date'] = $data['passages'][$k]['date']  = $value->getDate();
          $data['passages'][$k]['heured']  = $value->getHeureDebut();
          $data['passages'][$k]['heuref'] = $value->getHeureFin();
          $data['passages'][$k2]['lieu'] = $data['passages'][$k]['lieu']  = $value->getLieu();
          $idgroupe = $value->getidGroupe();
          $groupe = $dao->readGroupeById($idgroupe);
          $data['groupes'][$k]['nom'] = $data['passages'][$k2]['groupe']['nom'] = $data['passages'][$k]['groupe']['nom'] = $groupe->getNom();
          $data['groupes'][$k]['id'] = $data['passages'][$k2]['groupe']['id'] = $data['passages'][$k]['groupe']['id'] = $idgroupe;
          $data['passages'][$k2]['type'] = "Tests";
          $data['passages'][$k2]['heured'] = $value->getHeureDebutTest();
          $data['passages'][$k2]['heuref']= $value->getHeureFinTest();
        }
        ksort($data['passages']);
        $data['groupes'] = array_unique($data['groupes']);




        include("../view/evenement.view.php");
      }else {
        $data['error']['title'] = "Acces Interdit";
        $data['error']['message'] = "Vous ne pouvez pas venir ici, cet espace est reservé à l'organisateur de la manifestation.";
        $data['error']['back'] = "../controler/main.ctrl.php";
        include("../view/error.view.php");
      }
    }else {
      $data['error']['title'] = "Evenement inconnu";
      $data['error']['back'] = "../controler/evenements.ctrl.php";
      $data['error']['message'] = "Vous vous etes perdu ...";
      include("../view/error.view.php");
    }
  }else{
    $data['error']['title'] = "Evenement inconnu";
    $data['error']['back'] = "../controler/evenements.ctrl.php";
    $data['error']['message'] = "Vous vous etes perdu ...";
    include("../view/error.view.php");
  }

}else {
  $data['error']['title'] = "Acces Interdit";
  $data['error']['message'] = "Vous ne pouvez pas venir ici, cet espace est reservé à l'organisateur de la manifestation.";
  $data['error']['back'] = "../controler/main.ctrl.php";
  include("../view/error.view.php");
}
?>
s
