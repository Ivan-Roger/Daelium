<?php
session_start();
include("include/auth.ctrl.php");
require_once("../model/utils.class.php");
require_once("../model/DAO.class.php");
$data = initPage("Events");
$dao = new Dao();


$userid= $_SESSION["user"]["ID"];
$user = $dao->readPersonneById($userid);
if($user->getType() == 1){ // SI Orga

  $list = $dao->readManifestationByCreateur($userid);
  if($list != NULL){
    $data["asevenements"] = true;
    foreach ($list as $key => $value) {
      $data['evenements'][$key]["id"] = $value->getidManif();
      $data['evenements'][$key]["name"] = $value->getNom();
      if($value->getLienImageOfficiel() == NULL){
        $data['evenements'][$key]["img"] = "../data/img/icons/calendar_64px.png";
      }else {
        $data['evenements'][$key]["img"] = $value->getLienImageOfficiel();
      }
    }
  }else{
    $data["asevenements"] = false;
  }

  include("../view/evenements.view.php");
}else {
  $data['error']['title'] = "Acces Interdit";
  $data['error']['message'] = "Vous ne pouvez pas venir ici, cet espace est reservé aux Organisateurs";
  $data['error']['back'] = "../controler/main.ctrl.php";
  include("../view/error.view.php");
}
?>
