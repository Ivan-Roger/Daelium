<?php
  session_start();
  include("include/auth.ctrl.php");
  require_once("../model/utils.class.php");
  require_once("../model/DAO.class.php");
  $data = initPage("Groupes");
  $dao = new Dao();

  $userid= $_SESSION["user"]["ID"];
  $user = $dao->readPersonneById($userid);
  if($user->getType() == 0){ // SI booker

    $groupelist = $dao->readListGroupeByBooker($userid);
    if($groupelist != NULL){ // Si il possede au moins un groupe
      $data["asgroupe"] = true;
      foreach ($groupelist as $key => $value) {
        $groupe =$dao->readGroupeById($value);
        $data["groupes"][$key]["id"] = $value->getIdGroupe();
        $data["groupes"][$key]["name"] = $value->getNom();
        if($value->getLienImageOfficiel() == NULL){
          $data['groupes'][$key]["img"] = "../data/img/icons/Group_64px.png";
        }else {
          $data['groupes'][$key]["img"] = $value->getLienImageOfficiel();
        }
      }
    }else { // si il ne possede as de groupe
      $data["asgroupe"] = false;
    }

include("../view/groupes.view.php");
  }else {
    $data['error']['title'] = "Acces Interdit";
    $data['error']['message'] = "Vous ne pouvez pas venir ici, cet espace est reservé aux bookers";
    $data['error']['back'] = "../controler/main.ctrl.php";
    include("../view/error.view.php");
  }
?>
