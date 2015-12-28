<?php
session_start();
include("include/auth.ctrl.php");
require_once("../model/utils.class.php");
require_once("../model/DAO.class.php");
$data = initPage("Groupes");
$dao = new Dao();

$userid= $_SESSION["user"]["ID"];
$user = $dao->readBookerById($userid);

if($user != NULL){ // SI booker
  if(isset($_GET['action']) && $_GET['action'] == "create"){ // Si on recoit le formulaire pour cree


    $nomscene = $_POST["nomscene"];

    // $type = $_POST["type"];
    // $nb = $_POST["nb"];

    $mail = $_POST["mail"];
    $genre = $_POST["genre"];
    $genres = explode(",",$genre);
    $des = $_POST["des"];
    $img = $_POST["img"];

    //Lieu
    $nomlieu = "Lieu pour ".$nomscene;
    $adresse = $_POST["adresse"];
    $codepostal = $_POST["codepostal"];
    $ville = $_POST["ville"];
    $region = $_POST["region"];
    $pays = $_POST["pays"];
    $latitude = $_POST["latitude"];
    $longitude = $_POST["longitude"];

    $artistes = $_POST["person"];
    var_dump($artistes);

    $lieu = new Lieu(NULL,$nomlieu,NULL,$pays,$region,$ville,$codepostal,$adresse,$latitude,$longitude);
    $lieu2 =  $dao->createLieu($lieu);
    if(isset($lieu2)){
      $groupe = new Group(NULL,$nomscene,$email,$des,$img,NULL,NULL,NULL,NULL,NULL,NULL,$lieu2->getIdLieu());
      $groupe2 = $dao->createGroupe($groupe);
      if(isset($groupe2)){
        foreach ($artistes as $key => $value) {
          $unartiste = new Artist(NULL,$value["name"],$value["pname"],$value["pname"],$value["mail"],$value["ntel"],$lieu2->getIdLieu(),$value["daten"],$value["payment"],$value["vir"],$value["ord"]);
          $unartiste2 = $dao->createArtiste($unartiste);
          $dao->createGroupeArtiste($groupe2->getIdGroupe(),$unartiste2->getIdPersonne());
        }





        foreach ($genres as $key => $value) {
          if(!empty($value)){
            $dao->createGroupeGenre($genres->getIdGroupe(),$value);
          }
        }
    }}


  }else {
    // On affiche le formulaire pour cree
    include("../view/groupe_new.view.php");
  }
}else {
  $data['error']['title'] = "Acces Interdit";
  $data['error']['message'] = "Vous ne pouvez pas venir ici, cet espace est reservé à l'organisateur de la manifestation.";
  $data['error']['back'] = "../controler/main.ctrl.php";
  include("../view/error.view.php");
}
?>
