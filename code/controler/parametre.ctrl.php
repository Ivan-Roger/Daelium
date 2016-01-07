<?php
  session_start();
  include("include/auth.ctrl.php");
  require_once("../model/utils.class.php");
  require_once("../model/DAO.class.php");
  $data = initPage("Compte");
  $dao = new DAO();
  $userid = $_SESSION['user']['ID'];
  $user = $dao->readUtilisateurById($userid);
  $data["erreur"] = "";
  if(isset($_POST["action"]) && $_POST["action"] == "delete"){ // Si je supprime le compte

    $dao->deleteUtilisateurById($userid);
    unset($_SESSION);
    header("Location: ../controler/nolog.ctrl.php");
  }
  if(isset($_GET["action"]) && $_GET["action"] == "edit"){
    if($user->getMdp() == hash('sha256',$_POST["amdp"])){
      if($_POST["nmdp"] == $_POST["cnmdp"]){
        $user->setMdp(hash('sha256',$_POST["nmdp"]));
        $dao->updateUtilisateur($user);
      }else {
        $data["erreur"] = "Les deux mots de passe ne sont pas indentique";
        // erreur mot passe non identique
      }
    }else {
      $data["erreur"] = "Le mots de passe courant n'est pas bon";

      // mauvais mot de passe
    }
  }

  $data['useremail'] = $user->getEmailCompte();
  $connexions = $dao->readConnexionsInJournalByUtilisateur($userid);
  $data['journal'] = Array();
  if ($connexions!=null) {
    foreach($connexions as $key => $co) {
      $data['journal'][$key]['IP'] = $co['ip'];
      $data['journal'][$key]['moment'] = $co['moment'];
      $data['journal'][$key]['support'] = $co['support'];
    }
  }

  if (isset($_GET['delete'])) {
    $dao->deleteUtilisateurById($_SESSION['user']['ID']);
    session_destroy();
    session_write_close();
    setcookie(session_name(),'',0,'/');
  }

  include("../view/parametre.view.php");
?>
