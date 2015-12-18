<?php
session_start;
if(isset($_POST["mail"])){

  $dao = new DAO();
  $user = $dao->readUtilisateurByEmail($_POST["mail"]);

  if($user->getMdp() == $_POST["mdp"]){
    $_SESSION["login"]=true;
    $_SESSION["userid"]=$user->getIdUtilisateur();
  }else{
    //erreur connection
  }



}





 ?>
