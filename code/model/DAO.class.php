<?php
  require_once("../data/config.php");
  require_once("utils.class.php");
  require_once("exceptions.class.php");

  class DAO {
    private $db;

    function __construct() {
      try {
        $this->db = new PDO("pgsql:host=".$ADRESS_BD.";port=".$PORT_BD.";dbname=".$NAME_BD.";user=".$USER_BD.";password=".$PASSWORD_BD);
      } catch (PDOException $e) {
        die("Error, Connexion a la DB impossible : ".$e->getMessage());
      }
    }

    // ===================== Personne =====================

    function readPersonneById($id) {
      $sql = "SELECT * FROM Personne WHERE idPersonne = ?"; // requête
      $req = $this->db->prepare($sql);
      $params = array( // paramétres
        $id // l'id de l'utilisateur
      );
      $res = $req->execute($params);
      if ($res === FALSE) {
        die("readPersonneById : Requête impossible !"); // erreur dans la requête
      }
      $res = $req->fetchAll(PDO::FETCH_CLASS,"User");
      return (isset($res[0])?$res[0]:null); // retourne le premier resultat s'il existe, sinon null
    }

    function readPersonneByMail($email) {
      $sql = "SELECT * FROM Personne WHERE emailContact = ?"; // requête
      $req = $this->db->prepare($sql);
      $params = array( // paramétres
        $email // l'email de l'utilisateur
      );
      $res = $req->execute($params);
      if ($res === FALSE) {
        die("readPersonneByMail : Requête impossible !"); // erreur dans la requête
      }
      $res = $req->fetchAll(PDO::FETCH_CLASS,"User");
      return (isset($res[0])?$res[0]:null); // retourne le premier resultat s'il existe, sinon null
    }

    // vérif or not vérif this is the question (si la personne est déjà présente)
    function createPersonne($personne) {
        $sql = "INSERT INTO Personne(nom,prenom,tel,emailContact) VALUES (?,?,?,?)";
        $req = $this->db->prepare($sql);
        $params = array(
          $personne->nom,
          $personne->prenom,
          $personne->tel,
          $personne->emailContact
        );
        $res = $req->execute($params);
        if ($res === FALSE) {
          die("createUser : Requête impossible !");
        }
        return $this->db->readUserById($personne->id);
      }
    }

    function updatePersonne($personne) {
      $p = $this->readPersonneById($personne->idUtilisateur);
      if ($p != null) {
        $sql = "UPDATE Personne set (nom, prenom, tel, emailContact, adresse) = (?,?,?,?,?) where id = ?";
        $req = $this->db->prepare($sql);
        $params = array($personne->nom,
                        $personne->prenom,
                        $personne->tel,
                        $personne->emailContact,
                        $personne->adresse,
                        $personne->idPersonne
        );
        $res = $req->execute($params);
        if ($res === FALSE) {
          die("updatePersonne : Requête impossible !");
        }
        return $this->db->readUserById($personne->id);
      } else {
        throw DAOUserException("La personne n'existe pas");
      }
    }

    // ===================== Utilisateur =====================

    function readUtilisateurById($id) {
      $sql = "SELECT * FROM Utilisateur WHERE idUtilisateur = ?"; // requête
      $req = $this->db->prepare($sql);
      $params = array( // paramétres
        $id // l'id de l'utilisateur
      );
      $res = $req->execute($params);
      if ($res === FALSE) {
        die("readUserById : Requête impossible !"); // erreur dans la requête
      }
      $res = $req->fetchAll(PDO::FETCH_CLASS,"User");
      return (isset($res[0])?$res[0]:null); // retourne le premier resultat s'il existe, sinon null
    }

    function readUtilisateurByEmail($email) {
      $sql = "SELECT * FROM Users WHERE emailCompte = ?"; // requête
      $req = $this->db->prepare($sql);
      $params = array( // paramétres
        $email // l'email de l'utilisateur
      );
      $res = $req->execute($params);
      if ($res === FALSE) {
        die("readUserByEmail : Requête impossible !"); // erreur dans la requête
      }
      $res = $req->fetchAll(PDO::FETCH_CLASS,"User");
      return (isset($res[0])?$res[0]:null); // retourne le premier resultat s'il existe, sinon null
    }

    function createUtilisateur($utilisateur) { // peut etre mettre une personne en paramettre
      $e = $this->readUserByEmail($utilisateur->email);
      if ($e == null) {
        $sql = "INSERT INTO Users(emailCompte,mdp) VALUES (?,?)";
        $req = $this->db->prepare($sql);
        $params = array(
          $utilisateur->emailCompte,
          $utilisateur->mdp
        );
        $res = $req->execute($params);
        if ($res === FALSE) {
          die("createUser : Requête impossible !");
        }
        return $this->db->readUserById($utilisateur->id);
      } else {
        throw DAOUserException("Id ou email déjà utilisés");
      }
    }

    // aussi la PERSONNE
    function updateUtilisateur($utilisateur) {
      $u = $this->readPersonneById($utilisateur->idUtilisateur);
      if ($u != null) {
        $sql = "UPDATE Utilisateur (emailCompte,mdp) = (?,?) where idUtilisateur = ?";
        $req = $this->db->prepare($sql);
        $params = array(
          $utilisateur->emailCompte,
          $utilisateur->mdp,
          $utilisateur->idUtilisateur
        );
        $res = $req->execute($params);
        if ($res === FALSE) {
          die("updateUtilisateur : Requête impossible !");
        }
        return $this->db->readUserById($utilisateur->id);
      } else {
        throw DAOUserException("Utilisateur non présent dans la base de données !");
      }
    }

  // ===================== Booker =====================

  function readBookerById($id) {

  }

  function readBookerByMail($email) {

  }

  function createBooker($booker) {

  }

  function updateBooker($personne) {

  }

  // ===================== Organisateur =====================
  function readOrganisateurById($id) {

  }

  function readOrganisateurByMail($email) {

  }

  function createOrganisateur($booker) {

  }

  function updateOrganisateur($personne) {

  }

  // ===================== Groupe =====================
  function readGroupeById($id) {

  }

  function readGroupeByMail($email) {

  }

  function createGroupe($booker) {

  }

  function updateGroupe($personne) {

  }

  // ===================== Artiste =====================
  function readArtisteById($id) {

  }

  function readArtisteByMail($email) {

  }

  function createArtiste($booker) {

  }

  function updateArtiste($personne) {

  }

  // ===================== Lieu =====================
  function readLieueById($id) {

  }

  function readLieuByMail($email) {

  }

  function createLieu($booker) {

  }

  function updateLieu($personne) {

  }

  // ===================== Manifestation =====================
  function readManifestationById($id) {

  }

  function readManifestationByMail($email) {

  }

  function createManifestation($booker) {

  }

  function updateManifestation($personne) {

  }

}

?>
