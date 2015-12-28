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
  if(isset($_GET['action']) && $_GET['action'] == "create"){ // Si on recoit le formulaire pour cree


    $before = $_POST["before"];
    $nomevent = $_POST["nomevent"];
    $type = $_POST["type"];
    $autre = $_POST["autre"];
    if($type == "Autre"){
      $type = $autre;
    }
    $genre = $_POST["genre"];
    $genres = explode(",",$genre);
    $dated = $_POST["dated"];
    $datef = $_POST["datef"];
    $des = $_POST["des"];



    $nomlieu = "Lieu de ".$nomevent;
    $adresse = $_POST["adresse"];
    $codepostal = $_POST["codepostal"];
    $ville = $_POST["ville"];
    $region = $_POST["region"];
    $pays = $_POST["pays"];
    $latitude = $_POST["latitude"];
    $longitude = $_POST["longitude"];

    $lieu = new Lieu(NULL,$nomlieu,NULL,$pays,$region,$ville,$codepostal,$adresse,$latitude,$longitude);

    $lieu2 =  $dao->createLieu($lieu);
    if(isset($lieu)){
      $manif = new Manifestation(NULL,$nomevent,$type,$des,$dated,$datef,NULL,NULL,NULL,NULL,NULL,$userid,10);
      $manif2 = $dao->createManifestation($manif);
      if(isset($manif2)){
        foreach ($genres as $key => $value) {
          if(!empty($value)){
            $dao->createManifestationGenre($manif2->getidManif(),$value);
          }
        }
        header("Location: ../controler/evenement.ctrl.php?id=".$manif2->getidManif()."");
      }else {
        // cela ne c'est pas bien passer , on annule
        $dao->deleteLieuById($lieu2->getIdLieu());
        //mettre un message d'erreur
      }
    }else{
      //mettre un message d'erreur
    }



    var_dump($manif);




  }else { // On affiche le formulaire pour cree
    $listeevtdejacree = $dao->readIdManifestationByCreateur($userid);
    foreach ($listeevtdejacree as $key => $value) {
      $evt = $dao->readManifestationById($value["idmanif"]);
      $data["evenements"][$key]["nom"]= $evt->getNom();
    }

    include("../view/evenement_new.view.php");
  }

}else {
  $data['error']['title'] = "Acces Interdit";
  $data['error']['message'] = "Vous ne pouvez pas venir ici, cet espace est reservé à l'organisateur de la manifestation.";
  $data['error']['back'] = "../controler/main.ctrl.php";
  include("../view/error.view.php");
}
?>
s
