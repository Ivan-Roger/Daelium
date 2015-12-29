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

    $lieu = new Lieu(NULL,$nomlieu,NULL,$pays,$region,$ville,$codepostal,$adresse,$latitude,$longitude);
    $lieu2 =  $dao->createLieu($lieu);
    if(isset($lieu2)){ // Si le lieu est cree on peut cree le groupe
      $groupe = new Group(NULL,$nomscene,$mail,$des,$img,NULL,NULL,NULL,NULL,NULL,NULL,$lieu2->getIdLieu());
      $groupe2 = $dao->createGroupe($groupe);

      if(isset($groupe2)){ // Si le groupe est cree, on peut cree les artistes
      $dao->createBookerGroupe($userid,$groupe2->getIdGroupe());
        foreach ($artistes as $key => $value) {
          $adresseartiste = new Lieu(NULL,"Adresse de ".$value["name"],NULL,$value["pays"],$value["region"],$value["ville"],$value["codepostal"],$value["adresse"],$value["latitude"],$value["longitude"]);
          $adresseartiste2 =  $dao->createLieu($adresseartiste);
          if(isset($adresseartiste2)){ //Si le lieu des Artiste est cree on peut cree les artiste
            if($value["payment"] == "ch"){
              $paiment = 0;
            }else {
              $paiment = 1;
            }
            $unartiste = new Artist(NULL,$value["name"],$value["pname"],$value["mail"],$value["ntel"],$adresseartiste2->getIdLieu(),$value["daten"],$paiment,$value["vir"],$value["ord"]);
            $unartiste2 = $dao->createArtiste($unartiste);
            if(isset($unartiste2)){ // Si l'artiste est cree, on lie Artiste et groupe
              $dao->createGroupeArtiste($groupe2->getIdGroupe(),$unartiste2->getIdPersonne());

            }else {
              // Il y a eu une erreur
              $dao->deleteLieuById($unartiste2->getIdLieu());
            }
          }else {
            // Il y a eu une erreur
            // Juste le groupe est cree mais pas les artistes liés.
          }
        }



        foreach ($genres as $key => $value) { // Creation des genres pour le groupe.
          if(!empty($value)){
            $dao->createGroupeGenre($groupe2->getIdGroupe(),$value);
          }
        }
        header("Location: ../controler/groupe.ctrl.php?id=".$groupe2->getidGroupe()."");

      }else {
        // Il y a eu une erreur
        // le lieu a ete cree mais pas le groupe donc on supprime le lieu
        $dao->deleteLieuById($lieu2->getIdLieu());
      }
    }else {
      // Il y a eu une erreur
      // Rien n'a ete cree
    }


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
