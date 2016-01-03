<?php
session_start();
require_once("../model/utils.class.php");
   require_once("../model/DAO.class.php");
$data = Array();
    $dao = new DAO();

if((isset($_POST['etape']) && $_POST['etape'] == 0)){ // Si on recoit le premier formulaire

  if(!empty($_POST["mailcompte"])){

    $ok = $dao->readUtilisateurByEmail($_POST["mailcompte"]);
    if($ok == NULL){
      if($_POST["mdp"] == $_POST["cmdp"]){
        $data["nom"] = $_POST["nom"];
        $data["prenom"] = $_POST["prenom"];
        $data["mail"] = $_POST["mailcompte"];
        $data["tel"] = $_POST["ntel"];
        $_SESSION["signup"]["mdp"] = $_POST["mdp"];
        include("../view/signup_confirm.view.php");
      }else {
        include("../view/signup.view.php");
        $data["erreur"] = "Les mots de passe ne sont pas les mêmes";
      }
    }else {
      include("../view/signup.view.php");
      $data["erreur"] = "Cet email est deja Utilisé";
    }
  }else {
    include("../view/signup.view.php");
    $data["erreur"] = "Vous n'avez pas renseigné d'email ou de nom";
  }
}else if(isset($_POST['etape']) && $_POST['etape'] == 1){ // Si on recoit le deuxieme formulaire
  $_SESSION["signup"]["googletoken"] = NULL;
  $_SESSION["signup"]["nom"] = $_POST["nom"];
  $_SESSION["signup"]["prenom"] = $_POST["prenom"];
  $_SESSION["signup"]["mail"] = $_POST["mailcompte"];
  $_SESSION["signup"]["tel"] =$_POST["ntel"];
  $_SESSION["signup"]["adresse"] =$_POST["adresse"];
  $_SESSION["signup"]["codepostal"] = $_POST["codepostal"];
  $_SESSION["signup"]["ville"] = $_POST["ville"];
  $_SESSION["signup"]["region"] = $_POST["region"];
  $_SESSION["signup"]["pays"] = $_POST["pays"];
  include("../view/signup_confirm2.view.php");

}else if(isset($_POST['etape']) && $_POST['etape'] == 2){ // Si on recoit le dernier formulaire

$info = $_SESSION["signup"];
$noml = "Adresse de ".$info["nom"];

$Adresse1= new Lieu(NULL,$noml,NULL,$info["pays"],$info["region"],$info["ville"],$info["codepostal"],$info["adresse"],NULL,NULL);
$Adresse = $dao->createLieu($Adresse1);
if(isset($Adresse)){
  if($_POST["typeuser"] == 0){ //Booker
    $booker = new Booker(NULL,$info["nom"],$info["prenom"],$info["mail"],$info["tel"],$Adresse->getIdLieu(),$info["mail"],$info["mdp"],$info["googletoken"]);
    $user = $booker2 = $dao->createBooker($booker);
  }else { //Organisateur
    $organisateur = new Organisateur(NULL,$info["nom"],$info["prenom"],$info["mail"],$info["tel"],$Adresse->getIdLieu(),$info["mail"],$info["mdp"],$info["googletoken"]);
    $user = $organisateur2 = $dao->createOrganisateur($organisateur);
  }
  if(!(isset($organisateur2) || isset($booker2))){
    $dao->deleteLieuById($Adresse->getIdLieu());
  }else {
    $_SESSION["user"]["mail"]=$info["mail"];
    $_SESSION["user"]["loginTime"]=date("");
    $_SESSION["user"]["ID"]=$user->getIdPersonne();
  }

  // Création du dossier personnel et copie du fichier par défaut.
  mkdir("../data/users/u".$user->getIdPersonne());
  mkdir("../data/users/u".$user->getIdPersonne()."/files");
  copy("../data/users/Bienvenue.txt","../data/users/u".$user->getIdPersonne()."/files/Bienvenue.txt");

  header("Location: ../controler/main.ctrl.php");
  }
} else { // Si on commence l'inscription
  include("../view/signup.view.php");
}


?>
