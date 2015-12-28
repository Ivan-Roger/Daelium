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
  $listeevtdejacree = $dao->readIdManifestationByCreateur($userid);
  foreach ($listeevtdejacree as $key => $value) {
    $evt = $dao->readManifestationById($value["idmanif"]);
    $data["evenements"][$key]["nom"]= $evt->getNom();
  }



  include("../view/evenement_new.view.php");
}else {
  $data['error']['title'] = "Acces Interdit";
  $data['error']['message'] = "Vous ne pouvez pas venir ici, cet espace est reservé à l'organisateur de la manifestation.";
  $data['error']['back'] = "../controler/main.ctrl.php";
  include("../view/error.view.php");
}
?>
s
