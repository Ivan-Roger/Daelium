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

    // ===================== Utilisateur =====================

    function readUserById($id) {
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

    function readUserByEmail($email) {
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

    function createUser($login,$email,$password) {
      $i = null;
      while ($i==null) {
        $id = randomId();
        $i = $this->readUserById($id);
      }
      $l = $this->readUser($login);
      $e = $this->readUserByEmail($email);
      if ($l == null && $e == null) {
        $sql = "INSERT INTO Users(id,login,email,password) VALUES (?,?,?,?)";
        $req = $this->db->prepare($sql);
        $params = array(
          $id,
          $login,
          $email,
          $password
        );
        $res = $req->execute($params);
        if ($res === FALSE) {
          die("createUser : Requête impossible !");
        }
        return $this->db->readUserById($id);
      } else {
        throw DAOUserException("Login or Email already in use !");
      }
    }
  }

?>
