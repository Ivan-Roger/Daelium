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
  if(isset($_GET["action"]) && $_GET["action"]=="remove"){// Si on supprime #######################################################################################################################################################
    if(isset($_POST["idgroupe"]) && isset($_POST["idartiste"])){
      $groupeid = $_POST['idgroupe'];
      $aristeid = $_POST['idartiste'];
      $Artiste = $dao->readArtisteById($aristeid);
      $groupe = $dao->readGroupeById($groupeid);

      if($groupe != NULL && $Artiste != NULL){

        $listegroupeArtiste = $Artiste->getListeGroupe();
        $listegroupeuser = $dao->readListGroupeByBooker($userid);

        $present = $user->possedeGroupe($groupeid);
        $nb= $Artiste->getnbGroupe();
        if($present && $Artiste->estDansGroupe($groupeid)){
          $dao->deleteGroupeArtisteByIdArtisteIdGroupe($groupeid,$aristeid);
          if($nb == 1){
            $dao->deleteArtisteById($aristeid);
          }
          header("Location: ../controler/groupe.ctrl.php?id=".$groupeid."");

        }else {
          $data['error']['title'] = "Acces Interdit";
          $data['error']['message'] = "Vous ne pouvez pas supprimer un artiste qui est dans un groupe qui ne vous appartient pas !";
          $data['error']['back'] = "../controler/groupes.ctrl.php";
          include("../view/error.view.php");
        }
      }else {
        $data['error']['title'] = "Groupe ou Ariste inconnu";
        $data['error']['back'] = "../controler/groupes.ctrl.php";
        $data['error']['message'] = "L'Artiste que vous essayez de supprimer n'existe pas !";
        include("../view/error.view.php");
      }

    }else {
      $data['error']['title'] = "Groupe ou Ariste inconnu";
      $data['error']['back'] = "../controler/groupes.ctrl.php";
      $data['error']['message'] = "L'Artiste que vous essayez de supprimer n'existe pas !";
      include("../view/error.view.php");
    }
  }else if(isset($_GET["action"]) && $_GET["action"]=="edit"){ // Si on Modifie #######################################################################################################################################################
    if(isset($_POST["idartiste"])){
      $artisteid = $_POST['idartiste'];
      $Artiste = $dao->readArtisteById($artisteid);

      if($Artiste != NULL){

        $ok = $user->userinmanagedgroupok($artisteid);
        if($ok){
          $idlieu = $Artiste->getAdresse();
          $lieu = $dao->readLieuById($idlieu);

          if($lieu != NULL){
            // Mise a jour du Lieu
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

            $lieu->setPays($pays);
            $lieu->setRegion($region);
            $lieu->setVille($ville);
            $lieu->setcodepostal($codepostal);
            $lieu->setAdresse($adresse);
            $lieu->setLatitude($latitude);
            $lieu->setLongitude($longitude);

            $dao->updateLieu($lieu);
          }
          //Fin mise a jour Lieu


          //Artiste
          $nom = $_POST["name"];
          $prenom =$_POST["pname"];
          $daten =$_POST["daten"];
          if(empty($daten)){
            $daten = NULL;
          }
          $email = $_POST["mail"];
          $ntel = $_POST["ntel"];
          if(empty($ntel)){
            $ntel =NULL;
          }

          if($_POST["payment"] == "ch"){
            $paiment = 0;
          }else if($_POST["payment"] == "vi"){
            $paiment = 1;
          }else {
            $paiment = 2;
          }
          $ordre =  $_POST["ord"];
          $rib =  $_POST["vir"];

          $Artiste->setPaiement($paiment);
          $Artiste->setRib($rib);
          $Artiste->setOrdreCheque($ordre);
          $Artiste->setNom($nom);
          $Artiste->setPrenom($prenom);
          $Artiste->setDateNaissance($daten);
          $Artiste->setEmailcontact($email);
          $Artiste->setTel($ntel);
          $dao->updateArtiste($Artiste);





          header("Location: ../controler/groupes.ctrl.php"); // A modifier par la suite

        }else {
          $data['error']['title'] = "Acces Interdit";
          $data['error']['message'] = "Vous ne pouvez pas supprimer un artiste qui est dans un groupe qui ne vous appartient pas !";
          $data['error']['back'] = "../controler/groupes.ctrl.php";
          include("../view/error.view.php");
        }
      }else {
        $data['error']['title'] = "Groupe ou Ariste inconnu";
        $data['error']['back'] = "../controler/groupes.ctrl.php";
        $data['error']['message'] = "L'Artiste que vous essayez de supprimer n'existe pas !";
        include("../view/error.view.php");
      }

    }else {
      $data['error']['title'] = "Groupe ou Ariste inconnu";
      $data['error']['back'] = "../controler/groupes.ctrl.php";
      $data['error']['message'] = "L'Artiste que vous essayez de supprimer n'existe pas !";
      include("../view/error.view.php");
    }
  }else if(isset($_GET["action"]) && $_GET["action"]=="create" && isset($_GET["idgroupe"])){
    if($user->possedeGroupe($_GET["idgroupe"])){
      $data['id'] = "";
      $data['prenom'] ="";
      $data['nom'] = "";
      $data['dateNaissance'] = "";
      $data['email'] = "";
      $data['telephone'] = "";
      $data['adresse'] = "";
      $data['codepostal'] = "";
      $data['ville'] = "";
      $data['pays'] = "";
      $data['region'] = "";
      $data['latitude'] = "";
      $data['longitude'] = "";
      $data['paiement'] = "";
      $data['IBAN'] = "";
      $data['ordre'] = "";

      $data['idgroupe'] = $_GET["idgroupe"];
      include("../view/artiste_new.view.php");

    }else {
      $data['error']['title'] = "Acces Interdit";
      $data['error']['message'] = "Vous ne pouvez pas ajouter un artiste dans un groupe qui ne vous appartient pas !";
      $data['error']['back'] = "../controler/groupes.ctrl.php";
      include("../view/error.view.php");
    }

  }else if(isset($_GET["action"]) && $_GET["action"]=="new" && isset($_POST["idgroupe"])){
    if($user->possedeGroupe($_POST["idgroupe"])){
      $idgroupe = $_POST["idgroupe"];

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



    $nom = $_POST["name"];
    $prenom =$_POST["pname"];
    $daten =$_POST["daten"];
    if(empty($daten)){
      $daten = NULL;
    }
    $email = $_POST["mail"];
    $ntel = $_POST["ntel"];
    if(empty($ntel)){
      $ntel =NULL;
    }

    if($_POST["payment"] == "ch"){
      $paiment = 0;
    }else if($_POST["payment"] == "vi"){
      $paiment = 1;
    }else {
      $paiment = 2;
    }
    $ordre =  $_POST["ord"];
    $rib =  $_POST["vir"];

    $nomlieu = "Adresse de ".$nom;
    $lieu = new Lieu(NULL,$nomlieu,NULL,$pays,$region,$ville,$codepostal,$adresse,$latitude,$longitude);
    $lieu2 =  $dao->createLieu($lieu);
    if(isset($lieu2)){
      $artiste = new Artist(NULL,$nom,$prenom,$email,$ntel,$lieu2->getIdLieu(),$daten,$paiment,$rib,$ordre);
        $artiste2 = $dao->createArtiste($artiste);
        if(isset($artiste2)){ // Si l'artiste est cree, on lie Artiste et groupe
        $dao->createGroupeArtiste($idgroupe,$artiste2->getIdPersonne());

        }else {
          // Il y a eu une erreur
          $dao->deleteLieuById($artiste2->getAdresse());
        }
    }




    header("Location: ../controler/groupe.ctrl.php?id=$idgroupe"); // A modifier par la suite



    }else {
      $data['error']['title'] = "Acces Interdit";
      $data['error']['message'] = "Vous ne pouvez pas ajouter un artiste dans un groupe qui ne vous appartient pas !";
      $data['error']['back'] = "../controler/groupes.ctrl.php";
      include("../view/error.view.php");
    }
  }else{// Si on lis #########################################################################################################################################################################################################
    if(isset($_GET['id'])){
      $artisteid = $_GET['id'];
      $artiste = $dao->readArtisteById($artisteid);
      if($artiste != NULL){
        $ok = $user->userinmanagedgroupok($artisteid);
        if($ok){

          $data['id'] = $artisteid;
          $data['prenom'] = $artiste->getPrenom();
          $data['nom'] = $artiste->getNom();
          $data['dateNaissance'] = $artiste->getDateNaissance();
          $data['email'] = $artiste->getEmailcontact();
          $data['telephone'] = $artiste->getTel();
          $idlieu = $artiste->getAdresse();

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


          if($artiste->getPaiement() == 0){
            $data['paiement'] = "Cheque";
          }else {
            $data['paiement'] = "Virement";

          }
          $data['IBAN'] = $artiste->getRib();
          $data['ordre'] = $artiste->getOrdreCheque();
        }


        include("../view/artiste_edit.view.php");
      }else {
        $data['error']['title'] = "Acces Interdit";
        $data['error']['message'] = "Vous ne pouvez pas venir ici, cet espace est reservé au booker du la groupe.";
        $data['error']['back'] = "../controler/main.ctrl.php";
        include("../view/error.view.php");


      }


    }else {
      $data['error']['title'] = "Groupe inconnu";
      $data['error']['back'] = "../controler/groupes.ctrl.php";
      $data['error']['message'] = "Vous vous etes perdu ...";
      include("../view/error.view.php");
    }




  }
}else {
  $data['error']['title'] = "Acces Interdit";
  $data['error']['message'] = "Vous ne pouvez pas venir ici, cet espace est reservé à l'organisateur de la manifestation.";
  $data['error']['back'] = "../controler/main.ctrl.php";
  include("../view/error.view.php");
}
?>
