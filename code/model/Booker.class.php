<?php
require_once('Utilisateur.class.php');
require_once('../model/DAO.class.php');


class Booker extends Utilisateur {
  private $listgroupes;

  function __construct($idUtilisateur = NULL, $nom = NULL, $prenom = NULL, $emailcontact = NULL, $tel = NULL, $adresse = NULL, $emailCompte = NULL, $mdp = NULL,$googletoken = NULL) {
    parent::__construct($idUtilisateur,0, $nom, $prenom, $emailcontact, $tel, $adresse,$emailCompte,$mdp,$googletoken);
  }

  function getListeGroupe(){
    $dao = new Dao();
    if($this->listgroupes == NULL){
      $this->listgroupes = $dao->readListGroupeByBooker($this->getIdPersonne());
    }
    return $this->listgroupes;
  }

  function possedeGroupe($idGroupe){
    foreach ($this->getListeGroupe() as $key => $value) {
      if($value['idgroupe'] == $idGroupe){
        return true;
      }
    }
    return false;
  }

  function userinmanagedgroup(){
    $dao = new Dao();
    foreach ($this->getListeGroupe() as $key => $value) {
      $listeartiste =  $dao->readArtisteByGroupe($value['idgroupe']);
      foreach ($listeartiste as $key => $value) {
        $listearistegere[] = $value['idartiste'];
      }
    }
    return $listearistegere;
  }

function userinmanagedgroupok($idArtiste){
  foreach ($this->userinmanagedgroup() as $key => $value) {
    if($value == $idArtiste){
      return true;
    }
  }
  return false;
}

}
?>
