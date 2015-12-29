<?php
session_start();
include("include/auth.ctrl.php");
require_once("../model/utils.class.php");
require_once("../model/DAO.class.php");
$data = initPage("Profil");
$dao = new DAO();

if(isset($_GET["action"]) && $_GET["action"]=="edit"){
  if(isset($_SESSION["user"]["ID"])){
    $userpid = (int) $_SESSION["user"]["ID"];

    $user = $dao->readUtilisateurById($userpid);
    //Adresse
    $adresse = $_POST["adresse"];
    $codepostal = $_POST["codepostal"];
    $ville = $_POST["ville"];
    $region = $_POST["region"];
    $pays = $_POST["pays"];
    $latitude = $_POST["latitude"];
    if(empty($latitude)){
      $latitude = NULL;
    }
    $longitude = $_POST["longitude"];
    if(empty($longitude)){
      $longitude = NULL;
    }
    $idlieu = $user->getAdresse();
    $lieu = $dao->readLieuById($idlieu);
    $lieu->setPays($pays);
    $lieu->setRegion($region);
    $lieu->setVille($ville);
    $lieu->setcodepostal($codepostal);
    $lieu->setAdresse($adresse);
    $lieu->setLatitude($latitude);
    $lieu->setLongitude($longitude);

    $dao->updateLieu($lieu);

    $nom = $_POST["name"];
    $prenom =$_POST["pname"];
    $email =$_POST["email"];
    $ntel =$_POST["ntel"];
    $description =$_POST["des"];
    if(empty($description)){
      $description = NULL;
    }

    $user->setNom($nom);
    $user->setPrenom($prenom);
    $user->setEmailcontact($email);
    $user->setTel($ntel);
    $user->setDescription($description);

    $dao->updateUtilisateur($user);

    header("Location: ../controler/profil.ctrl.php");
  }


}else if(isset($_SESSION["user"]["ID"])){
  $userpid = (int) $_SESSION["user"]["ID"];

  $user = $dao->readUtilisateurById($userpid);

  $data['id'] = $userpid;
  $data['prenom'] = $user->getPrenom();
  $data['nom'] = $user->getNom();
  $data['email'] = $user->getEmailcontact();
  $data['emailc'] = $user->getEmailCompte();
  $data['telephone'] = $user->getTel();
  $data['des'] = $user->getDescription();

  $idlieu = $user->getAdresse();

  if(($idlieu) == NULL){
    $data['adresse'] = "";
    $data['codepostal'] = "";
    $data['ville'] = "";
    $data['pays'] = "";
    $data['region'] = "";
    $data['latitude'] = "";
    $data['longitude'] = "";
  }else{
    $lieu = $dao->readLieuById($idlieu);
    $data['adresse'] = $lieu->getAdresse();
    $data['codepostal'] = $lieu->getcodepostal();
    $data['ville'] = $lieu->getVille();
    $data['pays'] = $lieu->getPays();
    $data['region'] = $lieu->getRegion();
    $data['latitude'] = $lieu->getLatitude();
    $data['longitude'] = $lieu->getLongitude();
  }

  include("../view/profil_edit.view.php");
}else {
  $data['error']['title'] = "Mauvais profil";
  $data['error']['back'] = "../controler/profil.ctrl.php";
  $data['error']['message'] = "Vous ne pouvez pas modifier un autre profil que le votre";
  include("../view/error.view.php");
}



?>
