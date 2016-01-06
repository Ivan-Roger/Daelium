<?php
require_once("utils.class.php");
require_once("exceptions.class.php");
require_once("Utilisateur.class.php");
require_once("Artiste.class.php");
require_once("Organisateur.class.php");
require_once("Booker.class.php");
require_once("Groupe.class.php");
require_once("Message.class.php");
require_once("Conversation.class.php");
require_once("Evenement.class.php");
require_once("Manifestation.class.php");
require_once("Creneau.class.php");
require_once("Notification.class.php");
require_once("Negociation.class.php");


class DAO {
   private $db;

   function __construct() {
      $config = parse_ini_file("../data/config.ini",true);
      try {
         $this->db = new PDO("pgsql:host=".$config['database']['address'].";port=".$config['database']['port'].";dbname=".$config['database']['name'].";user=".$config['database']['user'].";password=".$config['database']['password']);
      } catch (PDOException $e) {
         die("Error, Connexion a la DB impossible : ".$e->getMessage());
      }
   }

   // ===================== Personne =====================

    function readConnexionsInJournalByUtilisateur($id) {
      $sql = "SELECT * FROM journalDeConnexion WHERE idutilisateur = ? ORDER BY moment DESC LIMIT 20"; // requête
      $req = $this->db->prepare($sql);
      $params = array( // paramétres
         $id // l'id de l'utilisateur
      );
      $res = $req->execute($params);
      if ($res === FALSE) {
        var_dump($this->db->errorInfo()[2]);
        die("readConnexionsInJournalByUtilisateur : Requête impossible !"); // erreur dans la requête
      }
      $res = $req->fetchAll(PDO::FETCH_ASSOC);
      return (isset($res[0])?$res:null);
    }

   function createConnexionInJournal($id,$moment,$ip=null,$support=null){
     $sql="INSERT INTO journalDeConnexion VALUES (?,?,?,?)"; // requête
     $req = $this->db->prepare($sql);
     $params = array( // paramétres
        $id, // l'id de l'utilisateur
        $moment,
        $ip,
        $support
     );
     $res = $req->execute($params);
     if ($res === FALSE) {
        die("createConnexionInJournal : Requête impossible !"); // erreur dans la requête
     }
     return true;
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
      $res = $req->fetchAll(PDO::FETCH_CLASS,"Personne");
      return (isset($res[0])?$res[0]:null); // retourne le premier resultat s'il existe, sinon null
   }

   function readAllPersonne() {
      $sql = "SELECT * FROM Personne WHERE type = 1 OR type = 0"; // requête
      $req = $this->db->prepare($sql);
      $params = array( // paramétres
      );
      $res = $req->execute($params);
      if ($res === FALSE) {
         die("readPersonneById : Requête impossible !"); // erreur dans la requête
      }
      $res = $req->fetchAll(PDO::FETCH_CLASS,"Personne");
      return (isset($res)?$res:null); // retourne le premier resultat s'il existe, sinon null
   }

   function readPersonneByIdGoodClasse($id) {
      $sql = "SELECT type FROM Personne WHERE idPersonne = ?"; // requête
      $req = $this->db->prepare($sql);
      $params = array( // paramétres
         $id // l'id de l'utilisateur
      );
      $res = $req->execute($params);

      if ($res === FALSE) {
         die("readPersonneById : Requête impossible !"); // erreur dans la requête
      }
      $res = $req->fetchAll(PDO::FETCH_ASSOC);
      if(isset($res[0]["type"])){
         $type = (int) $res[0]["type"];
         if($type == 0){
            return $this->readBookerById($id);
         }elseif ($type == 1) {
            return $this->readOrganisateurById($id);
         }else {
            return $this->readArtisteById($id);
         }
      }else {
         return NULL;
      }
   }

   private function readPersonneByIdNoClass($id) {
      $sql = "SELECT * FROM Personne WHERE idPersonne = ?"; // requête
      $req = $this->db->prepare($sql);
      $params = array( // paramétres
         $id // l'id de l'utilisateur
      );
      $res = $req->execute($params);
      if ($res === FALSE) {
         die("readPersonneById : Requête impossible !"); // erreur dans la requête
      }
      $res = $req->fetchAll(PDO::FETCH_ASSOC);
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
      $res = $req->fetchAll(PDO::FETCH_CLASS,"Personne");
      return (isset($res[0])?$res[0]:null); // retourne le premier resultat s'il existe, sinon null
   }

   function readPersonneByMailNoClass($email) {
      $sql = "SELECT * FROM Personne WHERE emailContact = ?"; // requête
      $req = $this->db->prepare($sql);
      $params = array( // paramétres
         $email // l'email de l'utilisateur
      );
      $res = $req->execute($params);
      if ($res === FALSE) {
         die("readPersonneByMail : Requête impossible !"); // erreur dans la requête
      }
      $res = $req->fetchAll(PDO::FETCH_ASSOC);
      return (isset($res[0])?$res[0]:null); // retourne le premier resultat s'il existe, sinon null
   }

   // vérif or not vérif this->db is the question (si la personne est déjà présente)
   private function createPersonne($personne) {
     $p = $this->readPersonneById($personne->getIdPersonne());
     if($p == NULL){
      $sql = "INSERT INTO Personne(type,nom,prenom,tel,emailContact,adresse,description) VALUES (?,?,?,?,?,?,?) RETURNING idPersonne";
      $reqpersonne = $this->db->prepare($sql);
      $params = array(
         $personne->getType(),
         $personne->getNom(),
         $personne->getPrenom(),
         $personne->getTel(),
         $personne->getEmailcontact(),
         $personne->getAdresse(),
         $personne->getDescription()
      );
      $respersonne = $reqpersonne->execute($params);
      if ($respersonne === FALSE) {
        var_dump($this->db->errorInfo()[2]);
         die("createPersonne : Requête impossible !");
      }
      $retpersonne = $reqpersonne->fetchColumn();
      return $this->readPersonneById($retpersonne);
      }else {
         throw new DAOException("personne déjà présent dans la base");
      }
   }

   private function updatePersonne($personne) {
      $p = $this->readPersonneById($personne->getIdPersonne());
      if ($p != null) {
         $sql = "UPDATE Personne set (nom, prenom, tel, emailContact, adresse,description) = (?,?,?,?,?,?) where idPersonne = ?";
         $req = $this->db->prepare($sql);
         $params = array(
            $personne->getNom(),
            $personne->getPrenom(),
            $personne->getTel(),
            $personne->getEmailcontact(),
            $personne->getAdresse(),
            $personne->getDescription(),
            $personne->getIdPersonne()
         );
         $res = $req->execute($params);
         if ($res === FALSE) {
            die("updatePersonne : Requête impossible !");
         }
         return $this->readPersonneById($personne->getIdPersonne());
      } else {
         throw new DAOException("La personne n'existe pas");
      }
   }

   function deletePersonneById($idPersonne) {
     $u = $this->readPersonneById($idPersonne);
     if ($u != null) {

       $type = (int) $u->getType();
       if($type == 0 || $type == 1){
          $this->deleteUtilisateurById($idPersonne);
       }else {
          $this->deleteArtisteById($idPersonne);
       }

       $sql = "DELETE FROM Personne where idPersonne = ?";
       $req = $this->db->prepare($sql);
       $params = array(
         $idPersonne
       );
       $res = $req->execute($params);
       if ($res === FALSE) {
         die("deletePersonneById : Requête impossible !");
       }
       return true;
     } else {
       throw new DAOException("Personne non présent dans la base, supression impossible");
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
      //plus complexe !
      $pers = $this->readPersonneByIdNoClass($id);
      $res = $req->fetchAll(PDO::FETCH_ASSOC);
      if(isset($res[0]) && isset( $pers)){
         $Utilisateur = new Utilisateur($pers["idpersonne"],$pers["type"],$pers["nom"], $pers["prenom"], $pers["emailcontact"], $pers["tel"], $pers["adresse"],$res[0]["emailcompte"],$res[0]["mdp"],$res[0]["googletoken"]);
         return $Utilisateur;

      }else{
         return NULL;
      }
      // retourne le premier resultat s'il existe, sinon null
   }


   private function readUtilisateurByIdNoClasse($id) {
      $sql = "SELECT * FROM Utilisateur WHERE idUtilisateur = ?"; // requête
      $req = $this->db->prepare($sql);
      $params = array( // paramétres
         $id // l'id de l'utilisateur
      );
      $res = $req->execute($params);

      if ($res === FALSE) {
         die("readUserById : Requête impossible !"); // erreur dans la requête
      }
      $pers = $this->readPersonneByIdNoClass($id);

      $res = $req->fetchAll(PDO::FETCH_ASSOC);
      if(isset($res[0]) && isset( $pers)){
         $Utilisateur = array(
            "idpersonne" => $pers["idpersonne"],
            "nom" => $pers["nom"],
            "prenom" => $pers["prenom"],
            "emailcontact" =>  $pers["emailcontact"],
            "tel" => $pers["tel"],
            "adresse" => $pers["adresse"],
            "emailcompte" => $res[0]["emailcompte"],
            "mdp" => $res[0]["mdp"],
            "googletoken" => $res[0]["googletoken"],
         );
         return $Utilisateur;
      }else{
         return NULL;
      }
      // retourne le premier resultat s'il existe, sinon null
   }
   function readUtilisateurByEmail($email) {

         $sql = "SELECT * FROM Utilisateur WHERE emailCompte = ?"; // requête
         $req = $this->db->prepare($sql);
         $params = array( // paramétres
            $email // l'email de l'utilisateur
         );
         $res = $req->execute($params);
         if ($res === FALSE) {
            echo("Error: ".$this->db->errorInfo()[2]."<br/>\n");
            die("readUserByEmail : Requête impossible !"); // erreur dans la requête
         }
         $res = $req->fetchAll(PDO::FETCH_ASSOC);
          if(isset($res[0])) {
            $pers = $this->readPersonneByIdNoClass($res[0]["idutilisateur"]);
            if ($pers!=null){
              $Utilisateur = new Utilisateur($pers["idpersonne"],$pers["type"],$pers["nom"], $pers["prenom"], $pers["emailcontact"], $pers["tel"], $pers["adresse"],$res[0]["emailcompte"],$res[0]["mdp"],$res[0]["googletoken"]);
              return $Utilisateur;
            } else {
              return NULL;
            }
          } else {
            return NULL;
          }
      }

   private function createUtilisateur($utilisateur) { // peut etre mettre une personne en paramettre
      $u = $this->readUtilisateurById($utilisateur->getIdPersonne());
      if ($u == null) {
         $personne = $this->createPersonne($utilisateur);
         $sql = "INSERT INTO Utilisateur(idUtilisateur,emailCompte,mdp,googletoken) VALUES (?,?,?,?)";
         $req = $this->db->prepare($sql);
         $params = array(
            $personne->getIdPersonne(),
            $utilisateur->getEmailCompte(),
            $utilisateur->getMdp(),
            $utilisateur->getGoogleToken()
         );
         $res = $req->execute($params);
         if ($res === FALSE) {
            var_dump($this->db->errorInfo()[2]);
            die("createUser : Requête impossible !");
         }
         return $this->readUtilisateurById($personne->getIdPersonne());
      } else {
         throw new DAOException("utilisateur déjà présent dans la base (l'id en tous cas)");
      }
   }

   function updateUtilisateur($utilisateur) {
      $u = $this->readUtilisateurById($utilisateur->getIdPersonne());
      if ($u != null) {
         $this->updatePersonne($utilisateur);
         $sql = "UPDATE Utilisateur set (emailCompte,mdp) = (?,?) where idUtilisateur = ?";
         $req = $this->db->prepare($sql);
         $params = array(
            $utilisateur->getEmailCompte(),
            $utilisateur->getMdp(),
            $utilisateur->getIdPersonne()
         );
         $res = $req->execute($params);
         if ($res === FALSE) {
            die("updateUtilisateur : Requête impossible !");
         }
         return $this->readUtilisateurById($utilisateur->getIdPersonne());
      } else {
         throw new DAOException("Utilisateur non présent dans la base de données !");
      }
   }

   function deleteUtilisateurById($idUtilisateur) {
     $u = $this->readUtilisateurById($idUtilisateur);
     if ($u != null) {
      //  try {
      //     $this->deleteContactByIdProprietaire($idUtilisateur);
      //  } catch (DAOException $e) {}

       if ($this->readBookerById($idUtilisateur) != null) {
         try {
           $this->deleteBookerById($idUtilisateur);
         } catch (DAOException $e) {}
       } else {
         try {
           $this->deleteOrganisateurById($idUtilisateur);
         } catch (DAOException $e) {}
       }
      //  try {
      //    $this->deleteEvenementByidCreateur($idUtilisateur);
      //  } catch (DAOException $e) {}



       $sql = "DELETE FROM Utilisateur where idUtilisateur = ?";
       $req = $this->db->prepare($sql);
       $params = array(
         $idUtilisateur
       );
       $res = $req->execute($params);
       if ($res === FALSE) {
         die("deleteUtilisateurById : Requête impossible !");
       }
       return true;
     } else {
       throw new DAOException("Utilisateur non présent dans la base, supression impossible");
     }
   }

   // ===================== Booker =====================

   function readBookerById($id) {
      $sql = "SELECT * FROM Booker WHERE idBooker = ?"; // requête
      $req = $this->db->prepare($sql);
      $params = array( // paramétres
         $id // l'id de l'utilisateur
      );
      $res = $req->execute($params);
      if ($res === FALSE) {
        var_dump($this->db->errorInfo()[2]);
        die("readBookerById : Requête impossible !"); // erreur dans la requête
      }

      $user = $this->readUtilisateurByIdNoClasse($id);
      $res = $req->fetchAll(PDO::FETCH_ASSOC);
      if(isset($res[0]) && isset( $user)){
         $Booker = new Booker($user["idpersonne"],$user["nom"], $user["prenom"], $user["emailcontact"], $user["tel"], $user["adresse"],$user["emailcompte"],$user["mdp"],$user["googletoken"]);
         return $Booker;
      }
   }


   function createBooker($booker) {
      $b = $this->readBookerById($booker->getIdPersonne());
      if ($b == null) {
         $utilisateur = $this->createUtilisateur($booker);
         $sql = "INSERT INTO Booker(idBooker) VALUES (?)";
         $reqbooker = $this->db->prepare($sql);
         $params = array(
            $utilisateur->getIdPersonne()
         );
         $resbooker = $reqbooker->execute($params);
         if ($resbooker === FALSE) {
            die("createBooker : Requête impossible !");
         }
         return $this->readBookerById($utilisateur->getIdPersonne());
      } else {
         throw new DAOException("Booker déjà présent dans la base");
      }
   }

   function deleteBookerById($idBooker) {
     $b = $this->readBookerById($idBooker);
     if ($b != null) {
       $supr = $this->readListGroupeByBooker($idBooker);
       foreach ($supr as $Groupe) {
         try {
            $this->db->deleteGroupeById($Groupe->getIdGroupe());
         } catch (DAOException $e) {}
       }

       $this->deleteNegociationByIdBooker($idBooker);

       $sql = "DELETE FROM Booker where idBooker = ?";
       $req = $this->db->prepare($sql);
       $params = array(
         $idBooker
       );
       $res = $req->execute($params);
       if ($res === FALSE) {
         die("deleteBookerById : Requête impossible !");
       }
       return true;
     } else {
       throw new DAOException("Booker non présent dans la base, supression impossible");
     }
   }

   function deleteBookerByTop($idBooker) {
     $b = $this->readBookerById($idBooker);
     if ($b != null) {
       $this->deletePersonneById($idBooker);
       return true;
     } else {
       throw new DAOException("Booker non présent dans la base, supression impossible");
     }
   }

   // ===================== Organisateur =====================
   function readOrganisateurById($id) {
      $sql = "SELECT * FROM Organisateur WHERE idOrganisateur = ?"; // requête
      $req = $this->db->prepare($sql);
      $params = array( // paramétres
         $id // l'id de l'utilisateur
      );
      $res = $req->execute($params);
      if ($res === FALSE) {
         die("readOrganisateurById : Requête impossible !"); // erreur dans la requête
      }
      $user = $this->readUtilisateurByIdNoClasse($id);
      $res = $req->fetchAll(PDO::FETCH_ASSOC);
      if(isset($res[0]) && isset( $user)){
         $Organisateur = new Organisateur($user["idpersonne"],$user["nom"], $user["prenom"], $user["emailcontact"], $user["tel"], $user["adresse"],$user["emailcompte"],$user["mdp"],$user["googletoken"]);
         return $Organisateur;
      }
   }


   function createOrganisateur($organisateur) {
      $o = $this->readOrganisateurById($organisateur->getIdPersonne());
      if ($o == null) {
         $utilisateur = $this->createUtilisateur($organisateur);
         $sql = "INSERT INTO Organisateur(idOrganisateur) VALUES (?)";
         $reqorganisateur = $this->db->prepare($sql);
         $params = array(
            $utilisateur->getIdPersonne()
         );
         $resorganisateur = $reqorganisateur->execute($params);
         if ($resorganisateur === FALSE) {
            die("createOrganisateur : Requête impossible !");
         }
         return $this->readOrganisateurById($utilisateur->getIdPersonne());
      } else {
         throw new DAOException("Organisateur déjà présent dans la base");
      }
   }

   function deleteOrganisateurById($idOrganisateur) {
     $o = $this->readOrganisateurById($idOrganisateur);
     if ($o != null) {
       $supr = $this->readManifestationByCreateur($idOrganisateur);
       foreach ($supr as $Manif) {
         try {
            $this->deleteManifesationById($Manif->getidManif());
         } catch (DAOException $e) {}
       }

       $this->deleteNegociationByIdOrganisateur($idOrganisateur);


       $sql = "DELETE FROM Organisateur where idOrganisateur = ?";
       $req = $this->db->prepare($sql);
       $params = array(
         $idOrganisateur
       );
       $res = $req->execute($params);
       if ($res === FALSE) {
         die("deleteOrganisateurById : Requête impossible !");
       }
       return true;
     } else {
       throw new DAOException("Organisateur non présent dans la base, supression impossible");
     }
   }

   function deleteOrganisateurByTop($idOrganisateur) {
     $o = $this->db->readOrganisateurById($idOrganisateur);
     if ($o != null) {
       $this->db->deletePersonneById($idOrganisateur);
       return true;
     } else {
       throw new DAOException("Organisateur non présent dans la base, supression impossible");
     }
   }

   // ===================== Groupe =====================

   //idGroupe nomGroupe emailGroupe lienImageOfficiel facebook google twitter lecteur soundcloud ficheCom adresse
   function readGroupeById($id) {
      $sql = "SELECT * FROM Groupe WHERE idGroupe = ?"; // requête
      $req = $this->db->prepare($sql);
      $params = array( // paramétres
         $id // l'id de l'utilisateur
      );
      $res = $req->execute($params);
      if ($res === FALSE) {
         die("readGroupeById : Requête impossible !"); // erreur dans la requête
      }
      $res = $req->fetchAll(PDO::FETCH_CLASS,"Group");
      return (isset($res[0])?$res[0]:null); // retourne le premier resultat s'il existe, sinon null
   }

   function readAllGroupe() {
      $sql = "SELECT * FROM Groupe ORDER BY nomg"; // requête
      $req = $this->db->prepare($sql);
      $params = array( // paramétres
      );
      $res = $req->execute($params);
      if ($res === FALSE) {
         die("readAllGroupe : Requête impossible !"); // erreur dans la requête
      }
      $res = $req->fetchAll(PDO::FETCH_CLASS,"Group");
      return (isset($res)?$res:null); // retourne le premier resultat s'il existe, sinon null
   }


   function readGroupeByMail($email) {
      $sql = "SELECT * FROM Groupe WHERE emailGroupe = ?"; // requête
      $req = $this->db->prepare($sql);
      $params = array( // paramétres
         $email // l'email de l'utilisateur
      );
      $res = $req->execute($params);
      if ($res === FALSE) {
         die("readGroupeByMail : Requête impossible !"); // erreur dans la requête
      }
      $res = $req->fetchAll(PDO::FETCH_CLASS,"Group");
      return (isset($res[0])?$res[0]:null); // retourne le premier resultat s'il existe, sinon null
   }

   function createGroupe($groupe) {
      $g = $this->readGroupeById($groupe->getIdGroupe()); // ou un readGroupeByMail je sais pas
      if ($g == null) {
         $sql = "INSERT INTO Groupe(nomg,email,description,lienImageOfficiel,facebook,google,twitter,lecteur,soundcloud,ficheCom,adresse) VALUES (?,?,?,?,?,?,?,?,?,?,?) RETURNING idGroupe";
         $req = $this->db->prepare($sql);
         $params = array(
            $groupe->getNom(),
            $groupe->getEmail(),
            $groupe->getDescription(),
            $groupe->getLienImageOfficiel(),
            $groupe->getFacebook(),
            $groupe->getGoogle(),
            $groupe->getTwitter(),
            $groupe->getLecteur(),
            $groupe->getSoundcloud(),
            $groupe->getFicheCom(),
            $groupe->getAdresse()
         );
         $res = $req->execute($params);
         if ($res === FALSE) {
            die("createGroupe : Requête impossible !");
         }
         $ret = $req->fetchColumn();
         return $this->readGroupeById($ret);
      } else {
         throw new DAOException("Groupe déjà présent dans la base");
      }
   }

   function updateGroupe($groupe) {
      $g = $this->readGroupeById($groupe->getIdGroupe());
      if ($g != null) {
         $sql = "UPDATE Groupe set (nomg,lienImageOfficiel,facebook,google,twitter,lecteur,soundcloud,ficheCom,adresse) = (?,?,?,?,?,?,?,?,?) where idGroupe = ?";
         $req = $this->db->prepare($sql);
         $params = array(
           $groupe->getNom(),
           $groupe->getLienImageOfficiel(),
           $groupe->getFacebook(),
           $groupe->getGoogle(),
           $groupe->getTwitter(),
           $groupe->getLecteur(),
           $groupe->getSoundcloud(),
           $groupe->getFicheCom(),
           $groupe->getAdresse(),
            $groupe->getIdGroupe()
         );
         $res = $req->execute($params);
         if ($res === FALSE) {
            die("readGroupeById : Requête impossible !");
         }
         return $this->readGroupeById($groupe->getIdGroupe());
      } else {
         throw new DAOException("Groupe non présent dans la base de données !");
      }
   }

   function deleteGroupeByIdGroupe($idGroupe) {
     $b = $this->readGroupeById($idGroupe);
     if ($b != null) {
       try {
          $this->deleteBookerGroupeByIdGroupe($idGroupe);
       } catch (DAOException $e) {}
       try {
          $this->deleteGroupeArtisteByIdGroupe($idGroupe);
       } catch (DAOException $e) {}
       try {
          $this->deleteGroupeGenreIdGroupe($idGroupe);
       } catch (DAOException $e) {}
       try {
         $this->deleteCreneauByIdGroupe($idGroupe);
       } catch (DAOException $e) {}
         try {
           $this->deleteNegociationByIdGroupe($idGroupe);
         } catch (DAOException $e) {}

       $sql = "DELETE FROM Groupe where idGroupe = ?";
       $req = $this->db->prepare($sql);
       $params = array(
         $idGroupe
       );
       $res = $req->execute($params);
       if ($res === FALSE) {
         die("deleteGroupeById : Requête impossible !");
       }
       return true;
     } else {
       throw new DAOException("Groupe non présent dans la base, supression impossible");
     }
   }



   // ===================== Artiste =====================

   //idArtiste dateNaissance paiement rib ordreCheque
   function readArtisteById($id) {
      $sql = "SELECT * FROM Artiste WHERE idArtiste = ?"; // requête
      $req = $this->db->prepare($sql);
      $params = array( // paramétres
         $id // l'id de l'utilisateur
      );
      $res = $req->execute($params);
      if ($res === FALSE) {
         die("readArtisteById : Requête impossible !"); // erreur dans la requête
      }
      $pers = $this->readPersonneByIdNoClass($id);

      $res = $req->fetchAll(PDO::FETCH_ASSOC);
      if(isset($res[0]) && isset( $pers)){
         $Artist = new Artist($pers["idpersonne"],$pers["nom"], $pers["prenom"], $pers["emailcontact"], $pers["tel"], $pers["adresse"],$res[0]["datenaissance"],$res[0]["paiement"],$res[0]["rib"],$res[0]["ordrecheque"]);
         return $Artist;
      }else{
         return NULL;
      }
    }

    function createArtiste($artiste) {
       $a = $this->readArtisteById($artiste->getIdPersonne());
       if ($a == null) {
          $personne = $this->createPersonne($artiste);
          $sql = "INSERT INTO Artiste(idArtiste,dateNaissance, paiement, rib, ordreCheque) VALUES (?,?,?,?,?) RETURNING idArtiste";
          $req = $this->db->prepare($sql);
          $params = array(
            $personne->getIdPersonne(),
             $artiste->getDateNaissance(),
             $artiste->getPaiement(),
             $artiste->getRib(),
             $artiste->getOrdreCheque()
          );
          $res = $req->execute($params);
          if ($res === FALSE) {
             die("createArtiste : Requête impossible !");
          }
          $ret = $req->fetchColumn();
          return $this->readArtisteById($ret);
       } else {
          throw new DAOException("Artiste déjà présent dans la base");
       }
    }

    function updateArtiste($artiste) {
       $a = $this->readArtisteById($artiste->getIdPersonne());
       if ($a != null) {
          $this->updatePersonne($artiste);
          $sql = "UPDATE Artiste set (dateNaissance, paiement, rib, ordreCheque) = (?,?,?,?) where idArtiste = ?";
          $req = $this->db->prepare($sql);
          $params = array(
             $artiste->getDateNaissance(),
             $artiste->getPaiement(),
             $artiste->getRib(),
             $artiste->getOrdreCheque(),
             $artiste->getIdPersonne()
          );
          $res = $req->execute($params);
          if ($res === FALSE) {
             die("updateArtiste : Requête impossible !");
          }
          return $this->readArtisteById($artiste->getIdPersonne());
       } else {
          throw new DAOException("Artiste non présent dans la base de données !");
       }
    }

    function deleteArtisteById($idArtiste) {
      $b = $this->readArtisteById($idArtiste);
      if ($b != null) {

        $this->db->deleteGroupeArtisteByIdArtiste($idArtiste);

        $sql = "DELETE FROM Artiste where idArtiste = ?";
        $req = $this->db->prepare($sql);
        $params = array(
          $idArtiste
        );
        $res = $req->execute($params);
        if ($res === FALSE) {
          die("deleteArtisteById : Requête impossible !");
        }
        return true;
      } else {
        throw new DAOException("Artiste non présent dans la base, supression impossible");
      }
    }

    function deleteArtisteByTop($idArtiste) {
      $b = $this->readArtisteById($idArtiste);
      if ($b != null) {
        $this->db->deletePersonneById($idArtiste);
        return true;
      } else {
        throw new DAOException("Artiste non présent dans la base, supression impossible");
      }
    }

      // ===================== Lieu =====================

      //Lieu(idLieu,nom,description,pays,region,ville,codePostal,adresse,latitude,longitude)
      function readLieuById($id) {
         $sql = "SELECT * FROM Lieu WHERE idLieu = ?"; // requête
         $req = $this->db->prepare($sql);
         $params = array( // paramétres
            $id // l'id de l'utilisateur
         );
         $res = $req->execute($params);
         if ($res === FALSE) {
            die("readLieuById : Requête impossible !"); // erreur dans la requête
         }
         $res = $req->fetchAll(PDO::FETCH_CLASS,"Lieu");
         return (isset($res[0])?$res[0]:null); // retourne le premier resultat s'il existe, sinon null
      }

      function readLieuByVille($ville) {
         $sql = "SELECT * FROM Lieu WHERE ville = ?"; // requête
         $req = $this->db->prepare($sql);
         $params = array( // paramétres
            $ville // l'id de l'utilisateur
         );
         $res = $req->execute($params);
         if ($res === FALSE) {
            die("readLieuByVille : Requête impossible !"); // erreur dans la requête
         }
         $res = $req->fetchAll(PDO::FETCH_CLASS,"Lieu");
         return (isset($res[0])?$res:null); // retourne le premier resultat s'il existe, sinon null
      }

      function readLieuByCP($codepostal) {
         $sql = "SELECT * FROM Lieu WHERE codePostal = ?"; // requête
         $req = $this->db->prepare($sql);
         $params = array( // paramétres
            $codepostal// l'id de l'utilisateur
         );
         $res = $req->execute($params);
         if ($res === FALSE) {
            die("readLieuByCP : Requête impossible !"); // erreur dans la requête
         }
         $res = $req->fetchAll(PDO::FETCH_CLASS,"Lieu");
         return (isset($res[0])?$res:null); // retourne le premier resultat s'il existe, sinon null
      }

      function readLieuByAdresse($adresse) {
         $sql = "SELECT * FROM Lieu WHERE adresse = ?"; // requête
         $req = $this->db->prepare($sql);
         $params = array( // paramétres
            $adresse// l'id de l'utilisateur
         );
         $res = $req->execute($params);
         if ($res === FALSE) {
            die("readLieuByAdresse : Requête impossible !"); // erreur dans la requête
         }
         $res = $req->fetchAll(PDO::FETCH_CLASS,"Lieu");
         return (isset($res[0])?$res:null); // retourne le premier resultat s'il existe, sinon null

      }

      function createLieu($lieu) {
         $l = $this->readLieuById($lieu->getIdLieu());
         if ($l == null) {
            $sql = "INSERT INTO Lieu(noml,description,pays,region,ville,codePostal,adresse,latitude,longitude) VALUES (?,?,?,?,?,?,?,?,?) RETURNING idLieu";
            $reqlieu = $this->db->prepare($sql);
            $params = array(
               $lieu->getNom(),
               $lieu->getDescription(),
               $lieu->getPays(),
               $lieu->getRegion(),
               $lieu->getVille(),
               $lieu->getCodePostal(),
               $lieu->getAdresse(),
               $lieu->getLatitude(),
               $lieu->getLongitude()
            );
            $reslieu = $reqlieu->execute($params);
            if ($reslieu === FALSE) {
               die("createLieu : Requête impossible !");
            }
            $retlieu=$reqlieu->fetchColumn();
            return $this->readLieuById($retlieu);;
         } else {
            throw new DAOException("Lieu déjà présent dans la base (l'id en tous cas)");
         }
      }

      function updateLieu($lieu) {
         $l = $this->readLieuById($lieu->getIdLieu());

         if ($l != null) {
            $sql = "UPDATE Lieu set (noml,description,pays,region,ville,codePostal,adresse,latitude,longitude) = (?,?,?,?,?,?,?,?,?) where idLieu = ?";
            $req = $this->db->prepare($sql);

            $params = array(
               $lieu->getNom(),
               $lieu->getDescription(),
               $lieu->getPays(),
               $lieu->getRegion(),
               $lieu->getVille(),
               $lieu->getCodePostal(),
               $lieu->getAdresse(),
               $lieu->getLatitude(),
               $lieu->getLongitude(),
               $lieu->getIdLieu()
            );

            $res = $req->execute($params);
            if ($res === FALSE) {
               die("updateLieu : Requête impossible !");
            }
            return $this->readLieuById($lieu->getIdLieu());
         } else {
            throw new DAOException("Lieu non présent dans la base de données !");
         }
      }

      function deleteLieuById($idLieu) {
        $l = $this->readLieuById($idLieu);
        if ($l != null) {
          $sql = "DELETE FROM Lieu where idLieu = ?";
          $req = $this->db->prepare($sql);
          $params = array(
            $idLieu
          );
          $res = $req->execute($params);
          if ($res === FALSE) {
            die("deleteLieuById : Requête impossible !");
          }
          return true;
        } else {
          throw new DAOException("Lieu non présente dans la base, supression impossible");
        }
      }

      // ===================== Manifestation =====================

      //Manifestation(idManif,type,description,datedebut,datefin,prixPublic,lienImageOfficiel,facebook,google,twitter,ficheCom,createur,lieu)
      function readManifestationById($id) {
         $sql = "SELECT * FROM Manifestation WHERE idManif = ?"; // requête
         $req = $this->db->prepare($sql);
         $params = array( // paramétres
            $id // l'id de l'utilisateur
         );
         $res = $req->execute($params);
         if ($res === FALSE) {
            die("readManifestationById : Requête impossible !"); // erreur dans la requête
         }
         $res = $req->fetchAll(PDO::FETCH_CLASS,"Manifestation");
         return (isset($res[0])?$res[0]:null); // retourne le premier resultat s'il existe, sinon null

      }


      function readAllManifestation() {
         $sql = "SELECT * FROM Manifestation WHERE dateDebut >= current_date ORDER BY nom"; // requête
         $req = $this->db->prepare($sql);
         $params = array( // paramétres
         );
         $res = $req->execute($params);
         if ($res === FALSE) {
            die("readManifestationById : Requête impossible !"); // erreur dans la requête
         }
         $res = $req->fetchAll(PDO::FETCH_CLASS,"Manifestation");
         return (isset($res)?$res:null); // retourne le premier resultat s'il existe, sinon null

      }

      function readManifestationByCreateur($createur) {
         $sql = "SELECT * FROM Manifestation WHERE createur = ?"; // requête
         $req = $this->db->prepare($sql);
         $params = array(
            $createur
         );
         $res = $req->execute($params);
         if ($res === FALSE) {
            die("readManifestationByCreateur : Requête impossible !"); // erreur dans la requête
         }
         $res = $req->fetchAll(PDO::FETCH_CLASS,"Manifestation");
         return (isset($res[0])?$res:null); // retourne le premier resultat s'il existe, sinon null
      }

      function readIdManifestationByCreateur($createur) {
         $sql = "SELECT idManif FROM Manifestation WHERE createur = ?"; // requête
         $req = $this->db->prepare($sql);
         $params = array(
            $createur
         );
         $res = $req->execute($params);
         if ($res === FALSE) {
            die("readManifestationByCreateur : Requête impossible !"); // erreur dans la requête
         }
         $res = $req->fetchAll(PDO::FETCH_ASSOC);
         return (isset($res[0])?$res:null); // retourne le premier resultat s'il existe, sinon null
      }

      function createManifestation($manifestation) {
         $m = $this->readManifestationById($manifestation->getIdManif());
         if ($m == null) {
            $sql = "INSERT INTO Manifestation(nom,type,description,datedebut,datefin,lienImageOfficiel,facebook,google,twitter,ficheCom,createur,lieu) VALUES (?,?,?,?,?,?,?,?,?,?,?,?) RETURNING idManif";
            $req = $this->db->prepare($sql);
            $params = array(
               $manifestation->getNom(),
               $manifestation->getType(),
               $manifestation->getDescription(),
               $manifestation->getDateDebut(),
               $manifestation->getDateFin(),
               $manifestation->getLienImageOfficiel(),
               $manifestation->getFacebook(),
               $manifestation->getGoogle(),
               $manifestation->getTwitter(),
               $manifestation->getFicheCom(),
               $manifestation->getCreateur(),
               $manifestation->getLieu()
            );
            $res = $req->execute($params);
            if ($res === FALSE) {
               die("createManifestation : Requête impossible !");
            }
            $ret = $req->fetchColumn();
            return $this->readManifestationById($ret);

         } else {
            throw new DAOException("Manifestation déjà présent dans la base (l'id en tous cas)");
         }
      }

      function updateManifestation($manifestation) {
         $m = $this->readManifestationById($manifestation->getidManif());
         if ($m != null) {
            $sql = "UPDATE Manifestation set (nom,type,description,datedebut,datefin,lienImageOfficiel,facebook,google,twitter,ficheCom,createur,lieu) = (?,?,?,?,?,?,?,?,?,?,?,?) where idManif = ?";
            $req = $this->db->prepare($sql);
            $params = array(
               $manifestation->getNom(),
               $manifestation->getType(),
               $manifestation->getDescription(),
               $manifestation->getDateDebut(),
               $manifestation->getDateFin(),
               $manifestation->getLienImageOfficiel(),
               $manifestation->getFacebook(),
               $manifestation->getGoogle(),
               $manifestation->getTwitter(),
               $manifestation->getFicheCom(),
               $manifestation->getCreateur(),
               $manifestation->getLieu(),
               $manifestation->getidManif()
            );
            $res = $req->execute($params);
            if ($res === FALSE) {
               die("updateManifestation : Requête impossible !");
            }
            return $this->readManifestationById($manifestation->getidManif());
         } else {
            throw new DAOException("Manifestation non présent dans la base de données !");
         }
      }

      function deleteManifesationById($idManif) {
        $o = $this->readManifestationById($idManif);
        if ($o != null) {

          try {
            $this->deleteManifestationGenreByIdManif($idManif);
          } catch (DAOException $e) {}
          try {
            $this->deleteCreneauByIdManif($idManif);
          } catch (DAOException $e) {}
          try {
            $this->deleteNegociationByIdManif($idManif);
          } catch (DAOException $e) {}

          $sql = "DELETE FROM Manifestation where idManif = ?";
          $req = $this->db->prepare($sql);
          $params = array(
            $idManif
          );
          $res = $req->execute($params);
          if ($res === FALSE) {
            die("deleteManifesationById : Requête impossible !");
          }
          return true;
        } else {
          throw new DAOException("Manifestation non présent dans la base, supression impossible");
        }
      }



      // ===================== AccesDocument =====================

      //Acces_Document(token,document,expire)
      function readAccesDocumentByToken($token) {
         $sql = "SELECT * FROM Acces_Document WHERE token = ?"; // requête
         $req = $this->db->prepare($sql);
         $params = array( // paramétres
            $token
         );
         $res = $req->execute($params);
         if ($res === FALSE) {
            die("readAccesDocumentByPath : Requête impossible !"); // erreur dans la requête
         }
         $res = $req->fetchAll(PDO::FETCH_ASSOC);
         return (isset($res[0])?$res[0]:null); // retourne le premier resultat s'il existe, sinon null
      }

      function readAccesDocumentByDoc($path) {
         $sql = "SELECT * FROM Acces_Document WHERE document = ?"; // requête
         $req = $this->db->prepare($sql);
         $params = array( // paramétres
            $path
         );
         $res = $req->execute($params);
         if ($res === FALSE) {
            die("readAccesDocumentByDoc : Requête impossible !"); // erreur dans la requête
         }
         $res = $req->fetchAll(PDO::FETCH_ASSOC);
         return (isset($res[0])?$res:null);
      }

      function createAccesDocument($document,$expire=null) {
        $token = randomID(15);
        $sql = "INSERT INTO Acces_Document VALUES (?,?,?)";
        $req = $this->db->prepare($sql);
        $params = array(
          $token,
          $document,
          $expire
        );
        $res = $req->execute($params);
        if ($res===FALSE) {
          var_dump($this->db->errorInfo()[2]);
          die("createAccesDocument : Requête impossible !"); // erreur dans la requête
        }
          // A FAIRE (Attention aux perfs): Si le token est déjà utilisé on en recrée un ...
        return $token;
      }

      function deleteAccesDocument($token) {
        $n = $this->readAccesDocumentByToken($token);
        if ($n != null) {
          $sql = "DELETE FROM Acces_Document WHERE token = ?";
          $req = $this->db->prepare($sql);
          $params = array(
            $token
          );
          $res = $req->execute($params);
          if ($res === FALSE) {
            var_dump($this->db->errorInfo()[2]);
            die("deleteAccesDocument : Requête impossible !");
          }
          return true;
        } else {
          throw new DAOException("Acces_Document non présent dans la base, supression impossible");
        }
      }

      function deleteAccesDocumentByDoc($path) {
        $n = $this->readAccesDocumentByDoc($path);
        if ($n != null) {
          $sql = "DELETE FROM Acces_Document WHERE document = ?";
          $req = $this->db->prepare($sql);
          $params = array(
            $path
          );
          $res = $req->execute($params);
          if ($res === FALSE) {
            var_dump($this->db->errorInfo()[2]);
            die("deleteAccesDocumentByDoc : Requête impossible !");
          }
          return true;
        } else {
          throw new DAOException("Acces_Document non présent dans la base, supression impossible");
        }
      }

      // ===================== Evenement =====================

      //Evenement(idEvene,dateDebut,dateFin,heureDebut,heureFin,description,plus,lieu,createur)
      function readEvenementById($idEvene) {
         $sql = "SELECT * FROM Evenement WHERE idEvene = ?"; // requête
         $req = $this->db->prepare($sql);
         $params = array( // paramétres
            $idEvene // l'id de l'utilisateur
         );
         $res = $req->execute($params);
         if ($res === FALSE) {
            die("readEvenementById : Requête impossible !"); // erreur dans la requête
         }
         $res = $req->fetchAll(PDO::FETCH_CLASS,"Evenement");
         return (isset($res[0])?$res[0]:null);
      }

      function readEvenementByLieu($idLieu) {
         $sql = "SELECT * FROM Evenement WHERE idLieu = ?"; // requête
         $req = $this->db->prepare($sql);
         $params = array( // paramétres
            $idLieu // l'id de l'utilisateur
         );
         $res = $req->execute($params);
         if ($res === FALSE) {
            die("readEvenementByLieu : Requête impossible !"); // erreur dans la requête
         }
         $res = $req->fetchAll(PDO::FETCH_CLASS,"Evenement");
         return (isset($res[0])?$res:null);
      }

      function readEvenementByCreateur($idCreateur) {
         $sql = "SELECT * FROM Evenement WHERE createur = ?"; // requête
         $req = $this->db->prepare($sql);
         $params = array( // paramétres
            $idCreateur // l'id de l'utilisateur
         );
         $res = $req->execute($params);
         if ($res === FALSE) {
            var_dump($this->db->errorInfo()[2]);
            die("readEvenementByCreateur : Requête impossible !"); // erreur dans la requête
         }
         $res = $req->fetchAll(PDO::FETCH_CLASS,"Evenement");
         return (isset($res[0])?$res:null);
      }

      function readEvenementByCreateurApresDate($idCreateur,$dateDebut) {
         $sql = "SELECT * FROM Evenement WHERE createur = ? AND datedebut >= ?"; // requête
         $req = $this->db->prepare($sql);
         $params = array( // paramétres
            $idCreateur, // l'id de l'utilisateur
            $dateDebut // la date de début
         );
         $res = $req->execute($params);
         if ($res === FALSE) {
            var_dump($this->db->errorInfo()[2]);
            die("readEvenementByCreateurApresDate : Requête impossible !"); // erreur dans la requête
         }
         $res = $req->fetchAll(PDO::FETCH_CLASS,"Evenement");
         return (isset($res[0])?$res:null);
      }

      function readEvenementByCreateurDate($idCreateur,$dateDebut) {
         $sql = "SELECT * FROM Evenement WHERE createur = ? AND datedebut = ?"; // requête
         $req = $this->db->prepare($sql);
         $params = array( // paramétres
            $idCreateur, // l'id de l'utilisateur
            $dateDebut // la date de début
         );
         $res = $req->execute($params);
         if ($res === FALSE) {
            var_dump($this->db->errorInfo()[2]);
            die("readEvenementByCreateurDate : Requête impossible !"); // erreur dans la requête
         }
         $res = $req->fetchAll(PDO::FETCH_CLASS,"Evenement");
         return (isset($res[0])?$res:null);
      }

      function createEvenement($evenement) {
         $e = $this->readEvenementById($evenement->getID());
         if ($e == null) {
            $sql = "INSERT INTO Evenement(nom,dateDebut,dateFin,heureDebut,heureFin,description,lieu,createur,journee) VALUES (?,?,?,?,?,?,?,?,?) RETURNING idEvene";
            $req = $this->db->prepare($sql);
            $params = array(
               $evenement->getNom(),
               $evenement->getDateDebut(),
               $evenement->getDateFin(),
               $evenement->getHeureDebut(),
               $evenement->getHeureFin(),
               $evenement->getDescription(),
               $evenement->getLieu(),
               $evenement->getCreateur(),
               $evenement->getJournee()
            );
            $res = $req->execute($params);
            if ($res === FALSE) {
              var_dump($this->db->errorInfo()[2]);
               die("createEvenement : Requête impossible !");
            }
            return true;
         } else {
            throw new DAOException("Evenement déjà présent dans la base (l'id en tous cas)");
         }
      }

      function updateEvenement($evenement) {
         $e = $this->db->readEvenementById($evenement->idEvene);
         if ($e != null) {
            $sql = "UPDATE Evenement set (dateDebut,dateFin,heureDebut,heureFin,description,lieu,createur) = (?,?,?,?,?,?,?) where idEvene = ?";
            $req = $this->db->prepare($sql);
            $params = array(
               $evenement->getDateDebut(),
               $evenement->getDateFin(),
               $evenement->getHeureDebut(),
               $evenement->getHeureFin(),
               $evenement->description(),
               $evenement->getLieu(),
               $evenement->getCreateur(),
               $evenement->getID()
            );
            $res = $req->execute($params);
            if ($res === FALSE) {
              var_dump($this->db->errorInfo()[2]);
               die("updateEvenement : Requête impossible !");
            }
            return true;
         } else {
            throw new DAOException("Evenement non présent dans la base de données !");
         }
      }

      function deleteEvenementByIdCreateur($idCreateur) {
        $e = $this->db->readEvenementByCreateur($idCreateur);
        if ($e != null) {
          try {
            $this->db->deleteContactEvenementByContactProprietaire($idCreateur);
          } catch (DAOException $e) {}

          $sql = "DELETE FROM Evenement where createur = ?";
          $req = $this->db->prepare($sql);
          $params = array(
            $idCreateur
          );
          $res = $req->execute($params);
          if ($res === FALSE) {
            var_dump($this->db->errorInfo()[2]);
            die("deleteEvenementByIdCreateur : Requête impossible !");
          }
          return true;
        } else {
          throw new DAOException("Evenement non présent dans la base, supression impossible");
        }
      }

      // ===================== Contact =====================

      //Contact(idContact,proprietaire,notes)
      function readContactByPrimary($idContact,$proprietaire) {
         $sql = "SELECT * FROM Contact WHERE idContact = ? and proprietaire = ?"; // requête
         $req = $this->db->prepare($sql);
         $params = array(
            $idContact,
            $proprietaire
         );
         $res = $req->execute($params);
         if ($res === FALSE) {
           var_dump($this->db->errorInfo()[2]);
            die("readContactByPrimary : Requête impossible !"); // erreur dans la requête
         }
         $res = $req->fetchAll(PDO::FETCH_CLASS,"Contact");
         return (isset($res[0])?$res[0]:null);
      }

      function readContactByProprietaire($proprietaire) {
        $sql = "SELECT * FROM Contact WHERE proprietaire = ?"; // requête
        $req = $this->db->prepare($sql);
        $params = array(
          $proprietaire
        );
        $res = $req->execute($params);
        if ($res === FALSE) {
          var_dump($this->db->errorInfo()[2]);
          die("readContactByProprietaire : Requête impossible !"); // erreur dans la requête
        }
        $res = $req->fetchAll(PDO::FETCH_CLASS,"Contact");
        return (isset($res[0])?$res:null);
      }

      function createContact($contact) {
         $c = $this->db->readContactByPrimary($contact->idContact,$contact->proprietaire);
         if ($c == null) {
            $sql = "INSERT INTO Contact(idContact,proprietaire,notes) VALUES (?,?,?)";
            $req = $this->db->prepare($sql);
            $params = array(
               $contact->idContact,
               $contact->proprietaire,
               $contact->notes
            );
            $res = $req->execute($params);
            if ($res === FALSE) {
              var_dump($this->db->errorInfo()[2]);
               die("createContact : Requête impossible !");
            }
            return $this->db->readContactByPrimary($contact->idContact,$contact->proprietaire);
         } else {
            throw new DAOException("Contact déjà présent dans la base (l'id en tous cas)");
         }
      }

      function updateContact($contact) {
         $c = $this->db->readContactByPrimary($contact->idContact,$contact->proprietaire);
         if ($c != null) {
            $sql = "UPDATE Contact set (notes) = (?) where idContact = ? and proprietaire = ?";
            $req = $this->db->prepare($sql);
            $params = array(
               $contact->notes,
               $contact->idContact,
               $contact->proprietaire
            );
            $res = $req->execute($params);
            if ($res === FALSE) {
              var_dump($this->db->errorInfo()[2]);
               die("updateContact : Requête impossible !");
            }
            return $this->db->readContactByPrimary($contact->idContact,$contact->proprietaire);
         } else {
            throw new DAOException("Contact non présent dans la base");
         }
      }

      function deleteContactByIdProprietaire($idProprietaire) {
        $c = $this->db->readContactByProprietaire($idProprietaire);
        if ($c != null) {
          try {
            $this->db->deleteContactSystemById($idProprietaire);
          } catch (DAOException $e) {}
          try {
            $this->db->deleteContactExterieurById($idProprietaire);
          } catch (DAOException $e) {}
          try {
            $this->db->deleteContactTagById($idProprietaire);
          } catch (DAOException $e) {}
          try {
            $this->db->deleteContactEvenementById($idProprietaire);
          } catch (DAOException $e) {}

          $sql = "DELETE FROM Contact where Proprietaire = ? or idContact = ?";
          $req = $this->db->prepare($sql);
          $params = array(
            $idProprietaire,
            $idProprietaire
          );
          $res = $req->execute($params);
          if ($res === FALSE) {
            var_dump($this->db->errorInfo()[2]);
            die("deleteContactById : Requête impossible !");
          }
          return true;
        } else {
          throw new DAOException("Contact non présent dans la base, supression impossible");
        }
      }

      // ===================== Contact_Systeme =====================

      // Contact_Systeme(contactProprietaire,idContact,personne)
      function readContactSystemByPrimary($contactProprietaire, $idContact) {
         $sql = "SELECT * FROM Contact_Systeme WHERE contactProprietaire = ? and idContact = ?"; // requête
         $req = $this->db->prepare($sql);
         $params = array(
            $contactProprietaire,
            $idContact
         );
         $res = $req->execute($params);
         if ($res === FALSE) {
           var_dump($this->db->errorInfo()[2]);
            die("readContactSystemByPrimary : Requête impossible !"); // erreur dans la requête
         }
         $res = $req->fetchAll(PDO::FETCH_CLASS,"Contact_Systeme");
         return (isset($res[0])?$res[0]:null);
      }

      function readContactSystemById($id) {
         $sql = "SELECT * FROM Contact_Systeme WHERE contactProprietaire = ? or idContact = ?"; // requête
         $req = $this->db->prepare($sql);
         $params = array(
            $id,
            $id
         );
         $res = $req->execute($params);
         if ($res === FALSE) {
           var_dump($this->db->errorInfo()[2]);
            die("readContactSystemById : Requête impossible !"); // erreur dans la requête
         }
         $res = $req->fetchAll(PDO::FETCH_CLASS,"Contact_Systeme");
         return (isset($res[0])?$res:null);
      }

      function createContactSystem($contactSyst) {
         $c = $this->db->readContactSystemByPrimary($contactSyst->contactProprietaire,$contactSyst->idContact);
         if ($c == null) {
            $sql = "INSERT INTO Contact_Systeme(contactProprietaire,idContact,personne) VALUES (?,?,?)";
            $req = $this->db->prepare($sql);
            $params = array(
               $contactSyst->contactProprietaire,
               $contactSyst->idContact,
               $contactSyst->personne
            );
            $res = $req->execute($params);
            if ($res === FALSE) {
              var_dump($this->db->errorInfo()[2]);
               die("createContactSystem : Requête impossible !");
            }
            return $this->db->readContactSystemByPrimary($contactSyst->contactProprietaire,$contactSyst->idContact);
         } else {
            throw new DAOException("Contact_Systeme déjà présent dans la base");
         }
      }

      function updateContactSystem($contactSyst) {
         $c = $this->db->readContactSystemByPrimary($contactSyst->contactProprietaire,$contactSyst->idContact);
         if ($c != null) {
            $sql = "UPDATE Contact_Systeme set (personne) = (?) where contactProprietaire = ? and idContact = ?";
            $req = $this->db->prepare($sql);
            $params = array(
               $contactSyst->personne,
               $contactSyst->contactProprietaire,
               $contactSyst->idContact
            );
            $res = $req->execute($params);
            if ($res === FALSE) {
              var_dump($this->db->errorInfo()[2]);
               die("createContactSystem : Requête impossible !");
            }
            return $this->db->readContactSystemByPrimary($contactSyst->contactProprietaire,$contactSyst->idContact);
         } else {
            throw new DAOException("Contact_Systeme non présent dans la base");
         }
      }

      function deleteContactSystemByPrimary($contactProprietaire,$idContact) {
         $c = $this->db->readContactSystemByPrimary($contactProprietaire,$idContact);
         if ($c != null) {
            $sql = "DELETE FROM Contact_Systeme where contactProprietaire = ? and idContact = ?";
            $req = $this->db->prepare($sql);
            $params = array(
               $contactProprietaire,
               $idContact
            );
            $res = $req->execute($params);
            if ($res === FALSE) {
              var_dump($this->db->errorInfo()[2]);
               die("deleteContactSystemByPrimary : Requête impossible !");
            }
            return true;
         } else {
            throw new DAOException("Contact_Systeme non présent dans la base, supression impossible");
         }
      }

      function deleteContactSystemById($id) {
         $c = $this->db->readContactSystemById($id);
         if ($c != null) {
            $sql = "DELETE FROM Contact_Systeme where contactProprietaire = ? or idContact = ?";
            $req = $this->db->prepare($sql);
            $params = array(
               $id,
               $id
            );
            $res = $req->execute($params);
            if ($res === FALSE) {
              var_dump($this->db->errorInfo()[2]);
               die("deleteContactSystemById : Requête impossible !");
            }
            return true;
         } else {
            throw new DAOException("Contact_Systeme non présent dans la base, supression impossible");
         }
      }

      // ===================== Contact_exterieur =====================

      // Contact_exterieur(contactProprietaire,idContact,nom,email,tel)
      function readContactExterieurByPrimary($contactProprietaire, $idContact) {
         $sql = "SELECT * FROM Contact_exterieur WHERE contactProprietaire = ? and idContact = ?"; // requête
         $req = $this->db->prepare($sql);
         $params = array(
            $contactProprietaire,
            $idContact
         );
         $res = $req->execute($params);
         if ($res === FALSE) {
           var_dump($this->db->errorInfo()[2]);
            die("readContactExterieurByPrimary : Requête impossible !"); // erreur dans la requête
         }
         $res = $req->fetchAll(PDO::FETCH_CLASS,"Contact_exterieur");
         return (isset($res[0])?$res[0]:null);
      }

      function readContactExterieurById($id) {
         $sql = "SELECT * FROM Contact_exterieur WHERE contactProprietaire = ? or idContact = ?"; // requête
         $req = $this->db->prepare($sql);
         $params = array(
            $id,
            $id
         );
         $res = $req->execute($params);
         if ($res === FALSE) {
           var_dump($this->db->errorInfo()[2]);
            die("readContactExterieurById : Requête impossible !"); // erreur dans la requête
         }
         $res = $req->fetchAll(PDO::FETCH_CLASS,"Contact_exterieur");
         return (isset($res[0])?$res:null);
      }

      function createContactExterieur($contactProp) {
         $c = $this->db->readContactExterieurByPrimary($contactSyst->contactProprietaire,$contactSyst->idContact);
         if ($c == null) {
            $sql = "INSERT INTO Contact_exterieur(contactProprietaire,idContact,nom,email,tel) VALUES (?,?,?,?,?)";
            $req = $this->db->prepare($sql);
            $params = array(
               $contactProp->contactProprietaire,
               $contactProp->idContact,
               $contactProp->nom,
               $contactProp->email,
               $contactProp->tel
            );
            $res = $req->execute($params);
            if ($res === FALSE) {
              var_dump($this->db->errorInfo()[2]);
               die("createContactExterieur : Requête impossible !");
            }
            return $this->db->readContactExterieurByPrimary($contactSyst->contactProprietaire,$contactSyst->idContact);
         } else {
            throw new DAOException("Contact_exterieur déjà présent dans la base");
         }
      }

      function updateContactExterieur($contactProp) {
         $c = $this->db->readContactExterieurByPrimary($contactSyst->contactProprietaire,$contactSyst->idContact);
         if ($c != null) {
            $sql = "UPDATE Contact_exterieur set (nom,email,tel) = (?,?,?) where contactProprietaire = ? and idContact = ?";
            $req = $this->db->prepare($sql);
            $params = array(
               $contactProp->nom,
               $contactProp->email,
               $contactProp->tel,
               $contactProp->contactProprietaire,
               $contactProp->idContact
            );
            $res = $req->execute($params);
            if ($res === FALSE) {
              var_dump($this->db->errorInfo()[2]);
               die("updateContactExterieur : Requête impossible !");
            }
            return $this->db->readContactExterieurByPrimary($contactSyst->contactProprietaire,$contactSyst->idContact);
         } else {
            throw new DAOException("Contact_exterieur non présent dans la base");
         }
      }

      function deleteContactExterieurByPrimary($contactProprietaire, $idContact) {
         $c = $this->db->readContactExterieurByPrimary($contactProprietaire,$idContact);
         if ($c != null) {
            $sql = "DELETE FROM Contact_exterieur where contactProprietaire = ? and idContact = ?";
            $req = $this->db->prepare($sql);
            $params = array(
               $contactProprietaire,
               $idContact
            );
            $res = $req->execute($params);
            if ($res === FALSE) {
              var_dump($this->db->errorInfo()[2]);
               die("DeleteContactExterieur : Requête impossible !");
            }
            return true;
         } else {
            throw new DAOException("Contact_exterieur non présent dans la base");
         }
      }

      function deleteContactExterieurById($id) {
         $c = $this->db->readContactExterieurById($id);
         if ($c != null) {
            $sql = "DELETE FROM Contact_exterieur where contactProprietaire = ? or idContact = ?";
            $req = $this->db->prepare($sql);
            $params = array(
               $id,
               $id
            );
            $res = $req->execute($params);
            if ($res === FALSE) {
              var_dump($this->db->errorInfo()[2]);
               die("deleteContactExterieurById : Requête impossible !");
            }
            return true;
         } else {
            throw new DAOException("Contact_exterieur non présent dans la base");
         }
      }

      // ===================== Contact_Evenement =====================

      // Contact_Evenement(contactProprietaire,idContact,idEvene)
      function readContactEvenementByPrimary($proprietaire, $idContact, $idEvene) {
         $sql = "SELECT * FROM Contact_Evenement WHERE contactProprietaire = ? and idContact = ? and idEvene = ?"; // requête
         $req = $this->db->prepare($sql);
         $params = array(
            $proprietaire,
            $idContact,
            $idEvene
         );
         $res = $req->execute($params);
         if ($res === FALSE) {
           var_dump($this->db->errorInfo()[2]);
            die("readContactEvenementByPrimary : Requête impossible !"); // erreur dans la requête
         }
         $res = $req->fetchAll(PDO::FETCH_CLASS,"Contact_Evenement");
         return (isset($res[0])?$res[0]:null);
      }

      function readContactEvenementById($id) {
         $sql = "SELECT * FROM Contact_Evenement WHERE contactProprietaire = ? or idContact = ?"; // requête
         $req = $this->db->prepare($sql);
         $params = array(
            $id,
            $id
         );
         $res = $req->execute($params);
         if ($res === FALSE) {
           var_dump($this->db->errorInfo()[2]);
            die("readContactEvenementById : Requête impossible !"); // erreur dans la requête
         }
         $res = $req->fetchAll(PDO::FETCH_CLASS,"Contact_Evenement");
         return (isset($res[0])?$res:null);
      }

      function readContactEvenementByContactProprietaire($proprietaire) {
         $sql = "SELECT * FROM Contact_Evenement WHERE contactProprietaire = ?"; // requête
         $req = $this->db->prepare($sql);
         $params = array(
            $proprietaire
         );
         $res = $req->execute($params);
         if ($res === FALSE) {
           var_dump($this->db->errorInfo()[2]);
            die("readContactEvenementByContactProprietaire : Requête impossible !"); // erreur dans la requête
         }
         $res = $req->fetchAll(PDO::FETCH_CLASS,"Contact_Evenement");
         return (isset($res[0])?$res:null);
      }

      function createContactEvenement($contactEven) {
         $c = $this->db->readContactEvenementByPrimary($contactEven->proprietaire,$contactEven->idContact,$contactEven->idEvene);
         if ($c == null) {
            $sql = "INSERT INTO Contact_Evenement(contactProprietaire,idContact,idEvene) VALUES (?,?,?)";
            $req = $this->db->prepare($sql);
            $params = array(
               $contactProp->contactProprietaire,
               $contactProp->idContact,
               $contactProp->idEvene
            );
            $res = $req->execute($params);
            if ($res === FALSE) {
              var_dump($this->db->errorInfo()[2]);
               die("createContactEvenement : Requête impossible !");
            }
            return $this->db->readContactEvenementByPrimary($contactEven->proprietaire,$contactEven->idContact,$contactEven->idEvene);
         } else {
            throw new DAOException("Contact_Evenement déjà présent dans la base");
         }
      }

      function deleteContactEvenementByContactProprietaire($idProprietaire) {
        $e = $this->db->readContactEvenementByContactProprietaire($idProprietaire);
        if ($e != null) {
          $sql = "DELETE FROM Contact_Evenement where contactProprietaire = ?";
          $req = $this->db->prepare($sql);
          $params = array(
            $idProprietaire
          );
          $res = $req->execute($params);
          if ($res === FALSE) {
            var_dump($this->db->errorInfo()[2]);
            die("deleteContactEvenementByContactProprietaire : Requête impossible !");
          }
          return true;
        } else {
          throw new DAOException("Contact_Evenement non présent dans la base, supression impossible");
        }
      }

      function deleteContactEvenementById($id) {
        $e = $this->db->readContactEvenementById($id);
        if ($e != null) {
          $sql = "DELETE FROM Contact_Evenement where contactProprietaire = ? or idContact = ? ";
          $req = $this->db->prepare($sql);
          $params = array(
            $id,
            $id
          );
          $res = $req->execute($params);
          if ($res === FALSE) {
            var_dump($this->db->errorInfo()[2]);
            die("deleteContactEvenementById : Requête impossible !");
          }
          return true;
        } else {
          throw new DAOException("Contact_Evenement non présent dans la base, supression impossible");
        }
      }

      // ===================== Creneau =====================

      // Creneau(idManif,idGroupe,heureDebut,heureFin,lieu,heureDebutTest,heureFinTest)
      function readCreneauByPrimary($idManif, $idGroupe) {
         $sql = "SELECT * FROM Creneau WHERE idManif=? and idGroupe=?"; // requête
         $req = $this->db->prepare($sql);
         $params = array(
            $idManif,
            $idGroupe
         );
         $res = $req->execute($params);
         if ($res === FALSE) {
           var_dump($this->db->errorInfo()[2]);
            die("readCreneauByPrimary : Requête impossible !"); // erreur dans la requête
         }
         $res = $req->fetchAll(PDO::FETCH_CLASS,"Creneau");
         return (isset($res[0])?$res[0]:null);
      }

      function readCreneauByidManif($idManif) {
         $sql = "SELECT * FROM Creneau WHERE idManif=?"; // requête
         $req = $this->db->prepare($sql);
         $params = array(
            $idManif
         );
         $res = $req->execute($params);
         if ($res === FALSE) {
           var_dump($this->db->errorInfo()[2]);
            die("readCreneauByPrimary : Requête impossible !"); // erreur dans la requête
         }
         $res = $req->fetchAll(PDO::FETCH_CLASS,"Creneau");
         return (isset($res)?$res:null);
      }

      function readCreneauByidGroupe($idGroupe) {
         $sql = "SELECT * FROM Creneau WHERE idGroupe=?"; // requête
         $req = $this->db->prepare($sql);
         $params = array(
            $idGroupe
         );
         $res = $req->execute($params);
         if ($res === FALSE) {
           var_dump($this->db->errorInfo()[2]);
            die("readCreneauByPrimary : Requête impossible !"); // erreur dans la requête
         }
         $res = $req->fetchAll(PDO::FETCH_CLASS,"Creneau");
         return (isset($res)?$res:null);
      }

      function readCreneauByidGroupeidManif($idManif, $idGroupe) {
         $sql = "SELECT * FROM Creneau WHERE idManif=? and idGroupe=?"; // requête
         $req = $this->db->prepare($sql);
         $params = array(
            $idManif,
            $idGroupe
         );
         $res = $req->execute($params);
         if ($res === FALSE) {
           var_dump($this->db->errorInfo()[2]);
            die("readCreneauByPrimary : Requête impossible !"); // erreur dans la requête
         }
         $res = $req->fetchAll(PDO::FETCH_CLASS,"Creneau");
         return (isset($res)?$res:null);
      }



      function createCreneau($creneau) {
         $c = $this->readCreneauByPrimary($creneau->getidManif(),$creneau->getidGroupe());
         if ($c == null) {
            $sql = "INSERT INTO Creneau(idManif,idGroupe,datec,heureDebut,heureFin,lieu,heureDebutTest,heureFinTest) VALUES (?,?,?,?,?,?,?,?)";
            $req = $this->db->prepare($sql);
            $params = array(
               $creneau->getidManif(),
               $creneau->getidGroupe(),
               $creneau->getDate(),
               $creneau->getHeureDebut(),
               $creneau->getHeureFin(),
               $creneau->getLieu(),
               $creneau->getHeureDebutTest(),
               $creneau->getHeureFinTest()
            );
            $res = $req->execute($params);
            if ($res === FALSE) {
              var_dump($this->db->errorInfo()[2]);
               die("createCreneau : Requête impossible !");
            }
            return $this->readCreneauByPrimary($creneau->getidManif(),$creneau->getidGroupe());
         } else {
            throw new DAOException("Creneau déjà présent dans la base");
         }
      }

      function updateCreneau($creneau) {
         $c = $this->readCreneauByPrimary($creneau->getidManif(),$creneau->getidGroupe());
         if ($c != null) {
            $sql = "UPDATE Creneau set (datec,heureDebut,heureFin,lieu,heureDebutTest,heureFinTest) = (?,?,?,?,?,?) where idManif=? and idGroupe=?";
            $req = $this->db->prepare($sql);
            $params = array(
              $creneau->getDate(),
              $creneau->getHeureDebut(),
              $creneau->getHeureFin(),
              $creneau->getLieu(),
              $creneau->getHeureDebutTest(),
              $creneau->getHeureFinTest(),
              $creneau->getidManif(),
              $creneau->getidGroupe()
            );
            $res = $req->execute($params);
            if ($res === FALSE) {
              var_dump($this->db->errorInfo()[2]);
               die("updateCreneau : Requête impossible !");
            }
            return $this->readCreneauByPrimary($creneau->getidManif(),$creneau->getidGroupe());
         } else {
            throw new DAOException("Creneau non présent dans la base");
         }
      }

      function deleteCreneauByIdGroupe($idGroupe) {
        $b = $this->readCreneauByidGroupe($idGroupe);
        if ($b != null) {
          $sql = "DELETE FROM Creneau where idGroupe = ?";
          $req = $this->db->prepare($sql);
          $params = array(
            $idGroupe
          );
          $res = $req->execute($params);
          if ($res === FALSE) {
            var_dump($this->db->errorInfo()[2]);
            die("deleteCreneauByIdGroupe : Requête impossible !");
          }
          return true;
        } else {
          throw new DAOException("Creneau non présent dans la base, supression impossible");
        }
      }

      function deleteCreneau($creneau) {
        $b = $this->readCreneauByPrimary($creneau->getidManif(),$creneau->getidGroupe());
        if ($b != null) {
          $sql = "DELETE FROM Creneau where idGroupe = ? AND idManif = ?";
          $req = $this->db->prepare($sql);
          $params = array(
            $creneau->getidGroupe(),
            $creneau->getidManif()
          );
          $res = $req->execute($params);
          if ($res === FALSE) {
            var_dump($this->db->errorInfo()[2]);
            die("deleteCreneauByIdGroupe : Requête impossible !");
          }
          return true;
        } else {
          throw new DAOException("Creneau non présent dans la base, supression impossible");
        }
      }

      function deleteCreneauByIdManif($idManif) {
        $b = $this->readCreneauByidManif($idManif);
        if ($b != null) {
          $sql = "DELETE FROM Creneau where idManif = ?";
          $req = $this->db->prepare($sql);
          $params = array(
            $idManif
          );
          $res = $req->execute($params);
          if ($res === FALSE) {
            var_dump($this->db->errorInfo()[2]);
            die("deleteCreneauByIdManif : Requête impossible !");
          }
          return true;
        } else {
          throw new DAOException("Creneau non présent dans la base, supression impossible");
        }
      }

      // ===================== Groupe_Artiste =====================

      // Groupe_Artiste(idGroupe,idArtiste)
      function readGroupeArtisteByPrimary($idGroupe, $idArtiste) {
         $sql = "SELECT * FROM Groupe_Artiste WHERE  idGroupe=? and idArtiste = ?"; // requête
         $req = $this->db->prepare($sql);
         $params = array(
            $idGroupe,
            $idArtiste,
         );
         $res = $req->execute($params);
         if ($res === FALSE) {
           var_dump($this->db->errorInfo()[2]);
            die("readGroupeArtisteByPrimary : Requête impossible !"); // erreur dans la requête
         }
         $res = $req->fetchAll(PDO::FETCH_ASSOC);
         return (isset($res[0])?$res[0]:null);
      }

      function readListGroupeByArtiste($idArtiste) {
         $sql = "SELECT idGroupe FROM Groupe_Artiste WHERE idArtiste = ?"; // requête
         $req = $this->db->prepare($sql);
         $params = array(
            $idArtiste
         );
         $res = $req->execute($params);
         if ($res === FALSE) {
           var_dump($this->db->errorInfo()[2]);
            die("readGroupeByArtiste : Requête impossible !"); // erreur dans la requête
         }
         $res = $req->fetchAll(PDO::FETCH_ASSOC);

         return (isset($res)?$res:null);
      }

      function readArtisteByGroupe($idGroupe) {
         $sql = "SELECT idArtiste FROM Groupe_Artiste WHERE idGroupe=?"; // requête
         $req = $this->db->prepare($sql);
         $params = array(
            $idGroupe
         );
         $res = $req->execute($params);
         if ($res === FALSE) {
           var_dump($this->db->errorInfo()[2]);
            die("readArtisteByGroupe : Requête impossible !"); // erreur dans la requête
         }
         $res = $req->fetchAll(PDO::FETCH_ASSOC);
         return (isset($res)?$res:null);
      }

      function createGroupeArtiste($idGroupe,$idArtiste) {
         $c = $this->readGroupeArtisteByPrimary($idGroupe,$idArtiste);
         if ($c == null) {
            $sql = "INSERT INTO Groupe_Artiste(idGroupe,idArtiste) VALUES (?,?)";
            $req = $this->db->prepare($sql);
            $params = array(
               $idGroupe,
               $idArtiste
            );
            $res = $req->execute($params);
            if ($res === FALSE) {
              var_dump($this->db->errorInfo()[2]);
               die("createGroupeArtiste : Requête impossible !");
            }
            return $this->readGroupeArtisteByPrimary($idGroupe,$idArtiste);
         } else {
            throw new DAOException("Groupe_Artiste déjà présent dans la base");
         }
      }

      function deleteGroupeArtisteByIdArtisteIdGroupe($idGroupe,$idArtiste) {
        $g = $this->readListGroupeByArtiste ($idArtiste);
        if ($g != null) {
          $sql = "DELETE FROM Groupe_Artiste where idGroupe=? AND idArtiste = ?";
          $req = $this->db->prepare($sql);
          $params = array(
            $idGroupe,
            $idArtiste
          );
          $res = $req->execute($params);
          if ($res === FALSE) {
            var_dump($this->db->errorInfo()[2]);
            die("deleteGroupeArtisteByIdArtisteIdGroupe : Requête impossible !");
          }
          return true;
        } else {
          throw new DAOException("Groupe_Artiste non présent dans la base, supression impossible");
        }
      }

      function deleteGroupeArtisteByIdArtiste($idArtiste) {
        $g = $this->readListGroupeByArtiste ($idArtiste);
        if ($g != null) {
          $sql = "DELETE FROM Groupe_Artiste where idArtiste = ?";
          $req = $this->db->prepare($sql);
          $params = array(
            $idArtiste
          );
          $res = $req->execute($params);
          if ($res === FALSE) {
            var_dump($this->db->errorInfo()[2]);
            die("deleteGroupeArtisteByIdArtiste : Requête impossible !");
          }
          return true;
        } else {
          throw new DAOException("Groupe_Artiste non présent dans la base, supression impossible");
        }
      }

      function deleteGroupeArtisteByIdGroupe($idGroupe) {
        $g = $this->readArtisteByGroupe($idGroupe);
        if ($g != null) {
          $sql = "DELETE FROM Groupe_Artiste where idGroupe = ?";
          $req = $this->db->prepare($sql);
          $params = array(
            $idGroupe
          );
          $res = $req->execute($params);
          if ($res === FALSE) {
            var_dump($this->db->errorInfo()[2]);
            die("deleteGroupeArtisteByIdGroupe : Requête impossible !");
          }
          return true;
        } else {
          throw new DAOException("Groupe_Artiste non présent dans la base, supression impossible");
        }
      }


      // ===================== Negociation =====================

      // Negociation(idNegociation,idBooker,idManif,idGroupe,idOrganisateur,etat)
      function readNegociationById($id) {
         $sql = "SELECT * FROM Negociation WHERE  idNegociation=?"; // requête
         $req = $this->db->prepare($sql);
         $params = array(
            $id
         );
         $res = $req->execute($params);
         if ($res === FALSE) {
           var_dump($this->db->errorInfo()[2]);
            die("readNegociationById : Requête impossible !"); // erreur dans la requête
         }
         $res = $req->fetchAll(PDO::FETCH_CLASS,"Negociation");
         return (isset($res[0])?$res[0]:null);
      }

      function readNegociationByUtilisateur($idUtilisateur) {
        $sql = "SELECT * FROM Negociation WHERE  idBooker  =? OR idOrganisateur=?"; // requête
        $req = $this->db->prepare($sql);
        $params = array(
          $idUtilisateur,
          $idUtilisateur
        );
        $res = $req->execute($params);
        if ($res === FALSE) {
          var_dump($this->db->errorInfo()[2]);
          die("readNegociationByIdBooker : Requête impossible !"); // erreur dans la requête
        }
        $res = $req->fetchAll(PDO::FETCH_CLASS,"Negociation");
        return (isset($res[0])?$res:null);
      }

      function readNegociationByOrganisateurGroupeManif($idOrga,$idGroupe,$idManif) {
        $sql = "SELECT * FROM Negociation WHERE idOrganisateur=? AND idGroupe = ? AND idManif = ?"; // requête
        $req = $this->db->prepare($sql);
        $params = array(
          $idUtilisateur,
          $idGroupe,
          $idManif
        );
        $res = $req->execute($params);
        if ($res === FALSE) {
          var_dump($this->db->errorInfo()[2]);
          die("readNegociationByIdBooker : Requête impossible !"); // erreur dans la requête
        }
        $res = $req->fetchAll(PDO::FETCH_CLASS,"Negociation");
        return (isset($res[0])?$res:null);
      }

      function readNegociationByIdBooker($idBooker) {
        $sql = "SELECT * FROM Negociation WHERE  idBooker  =?"; // requête
        $req = $this->db->prepare($sql);
        $params = array(
          $idBooker
        );
        $res = $req->execute($params);
        if ($res === FALSE) {
          var_dump($this->db->errorInfo()[2]);
          die("readNegociationByIdBooker : Requête impossible !"); // erreur dans la requête
        }
        $res = $req->fetchAll(PDO::FETCH_CLASS,"Negociation");
        return (isset($res[0])?$res:null);
      }
      function readNegociationByIdOrganisateur($idOrganisateur) {
        $sql = "SELECT * FROM Negociation WHERE idOrganisateur  =?"; // requête
        $req = $this->db->prepare($sql);
        $params = array(
          $idOrganisateur
        );
        $res = $req->execute($params);
        if ($res === FALSE) {
          var_dump($this->db->errorInfo()[2]);
          die("readNegociationByIdOrganisateur : Requête impossible !"); // erreur dans la requête
        }
        $res = $req->fetchAll(PDO::FETCH_CLASS,"Negociation");
        return (isset($res[0])?$res:null);
      }

      function readNegociationByIdGroupe($idGroupe) {
        $sql = "SELECT * FROM Negociation WHERE idGroupe  =?"; // requête
        $req = $this->db->prepare($sql);
        $params = array(
          $idGroupe
        );
        $res = $req->execute($params);
        if ($res === FALSE) {
          die("readNegociationByIdOrganisateur : Requête impossible !"); // erreur dans la requête
        }
        $res = $req->fetchAll(PDO::FETCH_CLASS,"Negociation");
        return (isset($res[0])?$res:null);
      }

      function readNegociationByIdManif($idManif) {
        $sql = "SELECT * FROM Negociation WHERE idManif  =?"; // requête
        $req = $this->db->prepare($sql);
        $params = array(
          $idManif
        );
        $res = $req->execute($params);
        if ($res === FALSE) {
          die("readNegociationByIdManif : Requête impossible !"); // erreur dans la requête
        }
        $res = $req->fetchAll(PDO::FETCH_CLASS,"Negociation");
        return (isset($res[0])?$res:null);
      }

      function createNegociation($negociation) {
         $n = $this->readNegociationById($negociation->getIdNegociation());
         if ($n == null) {
            $sql = "INSERT INTO Negociation(idBooker,idManif,idGroupe,idOrganisateur,etat) VALUES (?,?,?,?,?) RETURNING idNegociation";
            $req = $this->db->prepare($sql);
            $params = array(
               $negociation->getIdBooker(),
               $negociation->getIdManif(),
               $negociation->getIdGroupe(),
               $negociation->getIdOrganisateur(),
               $negociation->getetat()
            );
            $res = $req->execute($params);
            if ($res === FALSE) {
              var_dump($this->db->errorInfo()[2]);
               die("createNegociation : Requête impossible !");
            }
            $ret = $req->fetchColumn();
            return $this->readNegociationById($ret);
         } else {
            throw new DAOException("Negociation déjà présente dans la base");
         }
      }

      function updateNegociation($negociation) {
         $n = $this->readNegociationById($negociation->getIdNegociation());
         if ($n != null) {
            $sql = "UPDATE Negociation set (idBooker,idManif,idGroupe,idOrganisateur,etat) = (?,?,?,?,?) where idNegociation = ?";
            $req = $this->db->prepare($sql);
            $params = array(
              $negociation->getIdBooker(),
              $negociation->getIdManif(),
              $negociation->getIdGroupe(),
              $negociation->getIdOrganisateur(),
              $negociation->getetat(),
               $negociation->getIdNegociation()
            );
            $res = $req->execute($params);
            if ($res === FALSE) {
              var_dump($this->db->errorInfo()[2]);
               die("updateNegociation : Requête impossible !");
            }
            return $this->readNegociationById($negociation->getIdNegociation());
         } else {
            throw new DAOException("Negociation non présente dans la base");
         }
      }

      function deleteNegociationByIdBooker($idBooker) {
        $n = $this->readNegociationByIdBooker($idBooker);
        if ($n != null) {
          $sql = "DELETE FROM Negociation where idBooker = ?";
          $req = $this->db->prepare($sql);
          $params = array(
            $idBooker
          );
          $res = $req->execute($params);
          if ($res === FALSE) {
            var_dump($this->db->errorInfo()[2]);
            die("deleteNegociationByIdBooker : Requête impossible !");
          }
          return true;
        } else {
          throw new DAOException("Negociation non présente dans la base, supression impossible");
        }
      }

      function deleteNegociationByIdGroupe($idGroupe) {
        $n = $this->readNegociationByIdGroupe($idGroupe);
        if ($n != null) {
          $sql = "DELETE FROM Negociation where idGroupe = ?";
          $req = $this->db->prepare($sql);
          $params = array(
            $idGroupe
          );
          $res = $req->execute($params);
          if ($res === FALSE) {
            die("deleteNegociationByIdGroupe : Requête impossible !");
          }
          return true;
        } else {
          throw new DAOException("Negociation non présente dans la base, supression impossible");
        }
      }

      function deleteNegociationByIdManif($idManif) {
        $n = $this->readNegociationByIdManif($idManif);
        if ($n != null) {
          $sql = "DELETE FROM Negociation where idManif = ?";
          $req = $this->db->prepare($sql);
          $params = array(
            $idManif
          );
          $res = $req->execute($params);
          if ($res === FALSE) {
            var_dump($this->db->errorInfo()[2]);

            die("deleteNegociationByIdManif : Requête impossible !");
          }
          return true;
        } else {
          throw new DAOException("Negociation non présente dans la base, supression impossible");
        }
      }

      function deleteNegociationByIdOrganisateur($idOrganisateur) {
        $n = $this->readNegociationByIdOrganisateur($idOrganisateur);
        if ($n != null) {
          $sql = "DELETE FROM Negociation where idOrganisateur = ?";
          $req = $this->db->prepare($sql);
          $params = array(
            $idOrganisateur
          );
          $res = $req->execute($params);
          if ($res === FALSE) {
            var_dump($this->db->errorInfo()[2]);
            die("deleteNegociationByIdOrganisateur : Requête impossible !");
          }
          return true;
        } else {
          throw new DAOException("Negociation non présente dans la base, supression impossible");
        }
      }

      // ===================== Negociation_Documents =====================

      // Negociation_Documents(idDoc,idNegociation)
      function readNegociationDocumentsByPrimary($idNegociation,$idDoc) {
         $sql = "SELECT * FROM Negociation_Documents WHERE  idNegociation=? and idDoc=?"; // requête
         $req = $this->db->prepare($sql);
         $params = array(
            $idNegociation,
            $idDoc
         );
         $res = $req->execute($params);
         if ($res === FALSE) {
           var_dump($this->db->errorInfo()[2]);
            die("readNegociationDocumentsByPrimary : Requête impossible !"); // erreur dans la requête
         }
         $res = $req->fetchAll(PDO::FETCH_CLASS,"Negociation_Documents");
         return (isset($res[0])?$res[0]:null);
      }

      function readNegociationDocumentsByIdNegociation($idNegociation) {
        $sql = "SELECT * FROM Negociation_Documents WHERE  idNegociation=? "; // requête
        $req = $this->db->prepare($sql);
        $params = array(
          $idNegociation,
        );
        $res = $req->execute($params);
        if ($res === FALSE) {
          var_dump($this->db->errorInfo()[2]);
          die("readNegociationDocumentsByIdNegociation : Requête impossible !"); // erreur dans la requête
        }
        $res = $req->fetchAll(PDO::FETCH_CLASS,"Negociation_Documents");
        return (isset($res[0])?$res:null);
      }

      function createNegociationDocuments($negociationDoc) {
         $n = $this->db->readNegociationDocumentsByPrimary($negociationDoc->idNegociation,$negociationDoc->idDoc);
         if ($n == null) {
            $sql = "INSERT INTO Negociation_Documents(idDoc,idNegociation) VALUES (?,?)";
            $req = $this->db->prepare($sql);
            $params = array(
               $negociationDoc->idNegociation,
               $negociationDoc->idDoc
            );
            $res = $req->execute($params);
            if ($res === FALSE) {
              var_dump($this->db->errorInfo()[2]);
               die("createNegociationDocuments : Requête impossible !");
            }
            return $this->db->readNegociationDocumentsByPrimary($negociationDoc->idNegociation,$negociationDoc->idDoc);
         } else {
            throw new DAOException("Negociation_Documents déjà présente dans la base");
         }
      }

      function deleteNegociationDocumentsByIdNegociation($idNegociation) {
        $n = $this->db->readNegociationDocumentsByIdNegociation($idNegociation);
        if ($n != null) {
          $sql = "DELETE FROM Negociation_Documents where idNegociation = ?";
          $req = $this->db->prepare($sql);
          $params = array(
            $idNegociation
          );
          $res = $req->execute($params);
          if ($res === FALSE) {
            var_dump($this->db->errorInfo()[2]);
            die("deleteNegociationDocumentsByIdNegociation : Requête impossible !");
          }
          foreach ($n as $doc) {
            try {
                $this->db->deleteDocumentsById($doc->getIdDoc());
            } catch (DAOException $e) {}
          }
          return true;
        } else {
          throw new DAOException("Negociation_Documents non présente dans la base, supression impossible");
        }
      }

      function deleteNegociationDocumentsByIdDoc($idDoc) {
        $n = $this->db->readNegociationDocumentsByIdNegociation($idDoc);
        if ($n != null) {
          $sql = "DELETE FROM Negociation_Documents where idDoc = ?";
          $req = $this->db->prepare($sql);
          $params = array(
            $idDoc
          );
          $res = $req->execute($params);
          if ($res === FALSE) {
            var_dump($this->db->errorInfo()[2]);
            die("deleteNegociationDocumentsByIdDoc : Requête impossible !");
          }
          return true;
        } else {
          throw new DAOException("Negociation_Documents non présente dans la base, supression impossible");
        }
      }

      // ===================== Negociation_Messages =====================

      // Negociation_Messages(idMessage,idNegociation)
      function readNegociationMessagesByPrimary($idNegociation,$idMessage) {
         $sql = "SELECT * FROM Negociation_Messages WHERE  idNegociation=? and idMessage=?"; // requête
         $req = $this->db->prepare($sql);
         $params = array(
            $idNegociation,
            $idMessage
         );
         $res = $req->execute($params);
         if ($res === FALSE) {
           var_dump($this->db->errorInfo()[2]);
            die("readNegociationMessagesByPrimary : Requête impossible !"); // erreur dans la requête
         }
         $res = $req->fetchAll(PDO::FETCH_CLASS,"Negociation_Messages");
         return (isset($res[0])?$res[0]:null);
      }

      function readNegociationMessagesByIdNegociation($idNegociation) {
         $sql = "SELECT * FROM Negociation_Messages WHERE  idNegociation=?"; // requête
         $req = $this->db->prepare($sql);
         $params = array(
            $idNegociation
         );
         $res = $req->execute($params);
         if ($res === FALSE) {
           var_dump($this->db->errorInfo()[2]);
            die("readNegociationMessagesByIdNegociation : Requête impossible !"); // erreur dans la requête
         }
         $res = $req->fetchAll(PDO::FETCH_CLASS,"Negociation_Messages");
         return (isset($res[0])?$res:null);
      }

      function readNegociationMessagesByIdMessage($idMessage) {
         $sql = "SELECT * FROM Negociation_Messages WHERE  idMessage=?"; // requête
         $req = $this->db->prepare($sql);
         $params = array(
            $idMessage
         );
         $res = $req->execute($params);
         if ($res === FALSE) {
           var_dump($this->db->errorInfo()[2]);
            die("readNegociationMessagesByIdMessage : Requête impossible !"); // erreur dans la requête
         }
         $res = $req->fetchAll(PDO::FETCH_CLASS,"Negociation_Messages");
         return (isset($res[0])?$res:null);
      }

      function createNegociationMessages($negociationMess) {
         $n = $this->db->readNegociationMessagesByPrimary($negociationMess->idNegociation,$negociationMess->idMessage);
         if ($n == null) {
            $sql = "INSERT INTO Negociation_Messages(idMessage,idNegociation) VALUES (?,?)";
            $req = $this->db->prepare($sql);
            $params = array(
               $negociationMess->idNegociation,
               $negociationMess->idMessage
            );
            $res = $req->execute($params);
            if ($res === FALSE) {
              var_dump($this->db->errorInfo()[2]);
               die("createNegociationMessages : Requête impossible !");
            }
            return $this->db->readNegociationMessagesByPrimary($negociationMess->idNegociation,$negociationMess->idMessage);
         } else {
            throw new DAOException("Negociation_Messages déjà présente dans la base");
         }
      }

      function deleteNegociationMessagesByIdNegociation($idNegociation) {
        $n = $this->db->readNegociationMessagesByIdNegociation($idNegociation);
        if ($n != null) {
          $sql = "DELETE FROM Negociation_Messages where idNegociation = ?";
          $req = $this->db->prepare($sql);
          $params = array(
            $idNegociation
          );
          $res = $req->execute($params);
          if ($res === FALSE) {
            var_dump($this->db->errorInfo()[2]);
            die("deleteNegociationMessagesByIdNegociation : Requête impossible !");
          }
          foreach ($n as $message) {
            try {
                $this->db->deleteMessageByIdMessage($message->getID());
            } catch (DAOException $e) {}
          }
          return true;
        } else {
          throw new DAOException("Negociation_Messages non présente dans la base, supression impossible");
        }
      }

      function deleteNegociationMessagesByIdMessage($idMessage) {
        $n = $this->db->readNegociationMessagesByIdMessage($idMessage);
        if ($n != null) {
          $sql = "DELETE FROM Negociation_Messages where idMessage = ?";
          $req = $this->db->prepare($sql);
          $params = array(
            $idMessage
          );
          $res = $req->execute($params);
          if ($res === FALSE) {
            var_dump($this->db->errorInfo()[2]);
            die("deleteNegociationMessagesByIdMessage : Requête impossible !");
          }
          return true;
        } else {
          throw new DAOException("Negociation_Messages non présente dans la base, supression impossible");
        }
      }

      // ===================== Message_Tag =====================

      // Message_Tag(idMessage,nom)
      function readMessageTagByPrimary($nomt,$idMessage) {
         $sql = "SELECT * FROM Message_Tag WHERE  nomt=? and idMessage=?"; // requête
         $req = $this->db->prepare($sql);
         $params = array(
            $nomt,
            $idMessage
         );
         $res = $req->execute($params);
         if ($res === FALSE) {
           var_dump($this->db->errorInfo()[2]);
            die("readMessageTagByPrimary : Requête impossible !"); // erreur dans la requête
         }
         $res = $req->fetchAll();
         return (isset($res[0])?$res[0]:null);
      }

      function readMessageTagsByMessage($idMessage) {
         $sql = "SELECT * FROM Message_Tag WHERE idMessage=?"; // requête
         $req = $this->db->prepare($sql);
         $params = array(
            $idMessage
         );
         $res = $req->execute($params);
         if ($res === FALSE) {
           var_dump($this->db->errorInfo()[2]);
            die("readMessageTagsByMessage : Requête impossible !"); // erreur dans la requête
         }
         $res = $req->fetchAll();
         return (isset($res[0])?$res:null);
      }

      function createMessageTag($nom,$idMessage) {
         $m = $this->db->readMessageTagByPrimary($nomt,$idMessage);
         if ($m == null) {
            $sql = "INSERT INTO Message_Tag(idMessage,nomt) VALUES (?,?,?)";
            $req = $this->db->prepare($sql);
            $params = array(
               $idMessage,
               $nom
            );
            $res = $req->execute($params);
            if ($res === FALSE) {
              var_dump($this->db->errorInfo()[2]);
               die("createMessageTag : Requête impossible !");
            }
            return $this->db->readMessageTagByPrimary($nomt,$idMessage);
         } else {
            throw new DAOException("Message_Tag déjà présent dans la base");
         }
      }

      function deleteMessageTagByPrimary($nomt,$idMessage) {
         $m = $this->db->readMessageTagByPrimary($nomt,$idMessage);
         if ($m != null) {
            $sql = "DELETE FROM Message_Tag where nomt=? and idMessage=? ";
            $req = $this->db->prepare($sql);
            $params = array(
               $nomt,
               $idMessage
            );
            $res = $req->execute($params);
            if ($res === FALSE) {
              var_dump($this->db->errorInfo()[2]);
               die("deleteMessageTagByPrimary : Requête impossible !");
            }
            return true;
         } else {
            throw new DAOException("Message_Tag non présent dans la base, supression impossible");
         }
      }

      function deleteMessageTagByIdMessage($idMessage) {
         $m = $this->db->readMessageTagsByMessage($idMessage);
         if ($m != null) {
            $sql = "DELETE FROM Message_Tag where idMessage=? ";
            $req = $this->db->prepare($sql);
            $params = array(
               $idMessage
            );
            $res = $req->execute($params);
            if ($res === FALSE) {
              var_dump($this->db->errorInfo()[2]);
               die("deleteMessageTagByIdMessage : Requête impossible !");
            }
            return true;
         } else {
            throw new DAOException("Message_Tag non présent dans la base, supression impossible");
         }
      }

      // ===================== Booker_Groupe =====================

      // Booker_Groupe(idGroupe,idBooker)
      function readBookerGroupeByPrimary($idBooker,$idGroupe) {
         $sql = "SELECT * FROM Booker_Groupe WHERE  idGroupe=? and idBooker=?"; // requête
         $req = $this->db->prepare($sql);
         $params = array(
            $idGroupe,
            $idBooker
         );
         $res = $req->execute($params);
         if ($res === FALSE) {
           var_dump($this->db->errorInfo()[2]);
            die("readBookerGroupeByPrimary : Requête impossible !"); // erreur dans la requête
         }
         $res = $req->fetchAll(PDO::FETCH_ASSOC);
         return (isset($res[0])?$res[0]:null);
      }

      function readListGroupeByBooker($idBooker) {
         $sql = "SELECT idGroupe FROM Booker_Groupe WHERE  idBooker=?"; // requête
         $req = $this->db->prepare($sql);
         $params = array(
            $idBooker
         );
         $res = $req->execute($params);
         if ($res === FALSE) {
           var_dump($this->db->errorInfo()[2]);
            die("readListGroupeByBooker : Requête impossible !"); // erreur dans la requête
         }
         $res = $req->fetchAll(PDO::FETCH_ASSOC);
         return (isset($res)?$res:null);
      }

      function readBookerByGroupe($idGroupe) {
         $sql = "SELECT idBooker FROM Booker_Groupe WHERE  idGroupe=?"; // requête
         $req = $this->db->prepare($sql);
         $params = array(
            $idGroupe
         );
         $res = $req->execute($params);
         if ($res === FALSE) {
           var_dump($this->db->errorInfo()[2]);
            die("readBookerByGroupe : Requête impossible !"); // erreur dans la requête
         }
         $res = $req->fetchAll(PDO::FETCH_ASSOC);
         return (isset($res[0])?$res[0]['idbooker']:null);
      }


      function createBookerGroupe($idBooker, $idGroupe) {
         $b = $this->readBookerGroupeByPrimary($idBooker,$idGroupe);
         if ($b == null) {
            $sql = "INSERT INTO Booker_Groupe(idGroupe,idBooker) VALUES (?,?)";
            $req = $this->db->prepare($sql);
            $params = array(
               $idGroupe,
               $idBooker
            );
            $res = $req->execute($params);
            if ($res === FALSE) {
              var_dump($this->db->errorInfo()[2]);
               die("createBookerGroupe : Requête impossible !");
            }
            return $this->readBookerGroupeByPrimary($idBooker,$idGroupe);
         } else {
            throw new DAOException("Booker_Groupe déjà présente dans la base");
         }
      }

      function deleteBookerGroupeByIdGroupe($idGroupe) {
        $b = $this->readBookerByGroupe($idGroupe);
        if ($b != null) {
          $sql = "DELETE FROM Booker_Groupe where idGroupe = ?";
          $req = $this->db->prepare($sql);
          $params = array(
            $idGroupe
          );
          $res = $req->execute($params);
          if ($res === FALSE) {
            var_dump($this->db->errorInfo()[2]);
            die("deleteBookerGroupeById : Requête impossible !");
          }
          return true;
        } else {
          throw new DAOException("Booker_Groupe non présent dans la base, supression impossible");
        }
      }

      function deleteBookerGroupeByTop($idGroupe) {
        $b = $this->readBookerByGroupe($idGroupe);
        if ($b != null) {
          $this->deleteGroupeByIdGroupe($idGroupe);
          return true;
        } else {
          throw new DAOException("Booker_Groupe non présent dans la base, supression impossible");
        }
      }



      // ===================== Groupe_Genre =====================

      // Groupe_Genre(idGroupe,nomg)
      function readGroupeGenreByPrimary($idGroupe, $nomGrenre) {
         $sql = "SELECT * FROM Groupe_Genre WHERE  idGroupe=? and nomg=?"; // requête
         $req = $this->db->prepare($sql);
         $params = array(
            $idGroupe,
            $nomGrenre
         );
         $res = $req->execute($params);
         if ($res === FALSE) {
            die("readGroupeGenreByPrimary : Requête impossible !"); // erreur dans la requête
         }
         $res = $req->fetchAll(PDO::FETCH_ASSOC);
         return (isset($res[0])?$res[0]:null);
      }

      function readGroupeGenreByIdGroupe($idGroupe) {
         $sql = "SELECT * FROM Groupe_Genre WHERE  idGroupe=?"; // requête
         $req = $this->db->prepare($sql);
         $params = array(
            $idGroupe
         );
         $res = $req->execute($params);
         if ($res === FALSE) {
           var_dump($this->db->errorInfo()[2]);
            die("readGroupeGenreByIdGroupe : Requête impossible !"); // erreur dans la requête
         }
         $res = $req->fetchAll(PDO::FETCH_ASSOC);
         return (isset($res[0])?$res:null);
      }

      function createGroupeGenre($idGroupe,$nomg) {
         $g = $this->readGroupeGenreByPrimary($idGroupe,$nomg);
         if ($g == null) {
            $sql = "INSERT INTO Groupe_Genre(idGroupe,nomg) VALUES (?,?)";
            $req = $this->db->prepare($sql);
            $params = array(
               $idGroupe,
               $nomg
            );
            $res = $req->execute($params);
            if ($res === FALSE) {
              var_dump($this->db->errorInfo()[2]);
               die("createGroupeGenre : Requête impossible !");
            }
            return $this->readGroupeGenreByPrimary($idGroupe,$nomg);
         } else {
            throw new DAOException("Groupe_Genre déjà présente dans la base");
         }
      }

      function deleteGroupeGenreByPrimary($idGroupe, $nomGrenre) {
         $g = $this->readGroupeGenreByPrimary($idGroupe,$nomg);
         if ($g != null) {
            $sql = "DELETE FROM Groupe_Genre WHERE idGroupe = ? and nomg = ?";
            $req = $this->db->prepare($sql);
            $params = array(
               $idGroupe,
               $nomg
            );
            $res = $req->execute($params);
            if ($res === FALSE) {
              var_dump($this->db->errorInfo()[2]);
               die("deleteGroupeGenreByPrimary : Requête impossible !");
            }
            return true;
         } else {
            throw new DAOException("Groupe_Genre non présente dans la base, suppression impossible");
         }
      }

      function deleteGroupeGenreIdGroupe($idGroupe) {
         $g = $this->readGroupeGenreByIdGroupe($idGroupe);
         if ($g != null) {
            $sql = "DELETE FROM Groupe_Genre WHERE idGroupe = ?";
            $req = $this->db->prepare($sql);
            $params = array(
               $idGroupe
            );
            $res = $req->execute($params);
            if ($res === FALSE) {
              var_dump($this->db->errorInfo()[2]);
               die("deleteGroupeGenreIdGroupe : Requête impossible !");
            }
            return true;
         } else {
            throw new DAOException("Groupe_Genre non présente dans la base, suppression impossible");
         }
      }

      // ===================== Manifestation_Genre =====================

      // Manifestation_Genre(idManif,nomGenre)

      function readManifestationGenreByPrimary($idManif, $nomg) {
         $sql = "SELECT * FROM Manifestation_Genre WHERE  idManif=? AND nomg=?" ; // requête
         $req = $this->db->prepare($sql);
         $params = array(
            $idManif,
            $nomg
         );
         $res = $req->execute($params);
         if ($res === FALSE) {
           var_dump($this->db->errorInfo()[2]);
            die("readManifestationGenreByPrimary : Requête impossible !"); // erreur dans la requête
         }
         $res = $req->fetchAll(PDO::FETCH_ASSOC);
         return (isset($res)?$res:null);
      }


      function readManifestationGenreByidManif($idManif) {
         $sql = "SELECT * FROM Manifestation_Genre WHERE  idManif=?"; // requête
         $req = $this->db->prepare($sql);
         $params = array(
            $idManif
         );
         $res = $req->execute($params);
         if ($res === FALSE) {
           var_dump($this->db->errorInfo()[2]);
            die("readManifestationGenreByidManif : Requête impossible !"); // erreur dans la requête
         }
         $res = $req->fetchAll(PDO::FETCH_ASSOC);
         return (isset($res)?$res:null);
      }

      function readManifestationByGenre($nomg) {
         $sql = "SELECT * FROM Manifestation_Genre WHERE  nomg=?"; // requête
         $req = $this->db->prepare($sql);
         $params = array(
            $nomg
         );
         $res = $req->execute($params);
         if ($res === FALSE) {
           var_dump($this->db->errorInfo()[2]);
            die("readManifestationByGenre : Requête impossible !"); // erreur dans la requête
         }
         $res = $req->fetchAll(PDO::FETCH_ASSOC);
         return (isset($res)?$res:null);
      }

      function createManifestationGenre($idManif,$nomg) {
         $m = $this->readManifestationGenreByPrimary($idManif,$nomg);
         if ($m == null) {
            $sql = "INSERT INTO Manifestation_Genre(idManif,nomg) VALUES (?,?)";
            $req = $this->db->prepare($sql);
            $params = array(
               $idManif,
               $nomg
            );
            $res = $req->execute($params);
            if ($res === FALSE) {
              var_dump($this->db->errorInfo()[2]);
               die("createManifestationGenre : Requête impossible !");
            }
            return $this->readManifestationGenreByPrimary($idManif,$nomg);
         } else {
            throw new DAOException("Manifestation_Genre déjà présente dans la base");
         }
      }

      function deleteManifestationGenreByPrimary($idManif, $nomGenre) {
         $m = $this->readManifestationGenreByPrimary($idManif,$nomGenre);
         if ($m != null) {
            $sql = "DELETE FROM Manifestation_Genre where idManif=? and nomg=?";
            $req = $this->db->prepare($sql);
            $params = array(
               $idManif,
               $nomGenre
            );
            $res = $req->execute($params);
            if ($res === FALSE) {
               die("deleteManifestationGenreByPrimary : Requête impossible !");
            }
            return true;
         } else {
            throw new DAOException("Manifestation_Genre non présente dans la base, supression impossible");
         }
      }

      function deleteManifestationGenreByIdManif($idManif) {
         $m = $this->readManifestationGenreByidManif($idManif);
         if ($m != null) {
            $sql = "DELETE FROM Manifestation_Genre where idManif=? ";
            $req = $this->db->prepare($sql);
            $params = array(
               $idManif
            );
            $res = $req->execute($params);
            if ($res === FALSE) {
              var_dump($this->db->errorInfo()[2]);
               die("deleteManifestationGenreByIdManif : Requête impossible !");
            }
            return true;
         }
      }


      // ===================== Contact_Tag =====================

      // Contact_Tag(nomt,idContact,proprietaire)
      function readContactTagByPrimary($nomt,$idContact,$proprietaire) {
         $sql = "SELECT * FROM Contact_Tag WHERE  nomt= ? and idContact= ? and proprietaire = ?"; // requête
         $req = $this->db->prepare($sql);
         $params = array(
            $nomt,
            $idContact,
            $proprietaire
         );
         $res = $req->execute($params);
         if ($res === FALSE) {
           var_dump($this->db->errorInfo()[2]);
            die("readContactTagByPrimary : Requête impossible !"); // erreur dans la requête
         }
         $res = $req->fetchAll(PDO::FETCH_CLASS,"Contact_Tag");
         return (isset($res[0])?$res[0]:null);
      }

      function readContactTagById($id) {
         $sql = "SELECT * FROM Contact_Tag WHERE  idContact= ? or proprietaire = ?"; // requête
         $req = $this->db->prepare($sql);
         $params = array(
            $id,
            $id
         );
         $res = $req->execute($params);
         if ($res === FALSE) {
           var_dump($this->db->errorInfo()[2]);
            die("readContactTagById : Requête impossible !"); // erreur dans la requête
         }
         $res = $req->fetchAll(PDO::FETCH_CLASS,"Contact_Tag");
         return (isset($res[0])?$res:null);
      }

      function createContactTag($contactTag) {
         $c = $this->db->readContactTagByPrimary($contactTag->nomt,$contactTag->idContact,$contactTag->proprietaire);
         if ($c == null) {
            $sql = "INSERT INTO Contact_Tag(nomt,idContact,proprietaire) VALUES (?,?,?)";
            $req = $this->db->prepare($sql);
            $params = array(
               $contactTag->nomt,
               $contactTag->idContact,
               $contactTag->proprietaire
            );
            $res = $req->execute($params);
            if ($res === FALSE) {
              var_dump($this->db->errorInfo()[2]);
               die("createContactTag : Requête impossible !");
            }
            return $this->db->readContactTagByPrimary($contactTag->nomt,$contactTag->idContact,$contactTag->proprietaire);
         } else {
            throw new DAOException("Contact_Tag déjà présente dans la base");
         }
      }

      function deleteContactTagbyPrimary($nomt,$idContact,$proprietaire) {
         $c = $this->db->readContactTagByPrimary($nomt,$idContact,$proprietaire);
         if ($c != null) {
            $sql = "DELETE FROM Contact_Tag WHERE nomt= ? and idContact= ? and proprietaire = ?";
            $req = $this->db->prepare($sql);
            $params = array(
               $nomt,
               $idContact,
               $proprietaire
            );
            $res = $req->execute($params);
            if ($res === FALSE) {
              var_dump($this->db->errorInfo()[2]);
               die("deleteContactTagbyPrimary : Requête impossible !");
            }
            return true;
         } else {
            throw new DAOException("Contact_Tag non présent dans la base, supression impossible");
         }
      }

      function deleteContactTagById($id) {
         $c = $this->db->readContactTagById($id);
         if ($c != null) {
            $sql = "DELETE FROM Contact_Tag WHERE idContact= ? and proprietaire = ?";
            $req = $this->db->prepare($sql);
            $params = array(
               $id,
               $id
            );
            $res = $req->execute($params);
            if ($res === FALSE) {
              var_dump($this->db->errorInfo()[2]);
               die("deleteContactTagById : Requête impossible !");
            }
            return true;
         } else {
            throw new DAOException("Contact_Tag non présent dans la base, supression impossible");
         }
      }

      // ===================== Message =====================

      // Message(idMessage,expediteur,destinataire,etat,contenu,dateenvoi)
      function readMessageById($idMessage) {
         $sql = "SELECT * FROM Message WHERE  idMessage = ?"; // requête
         $req = $this->db->prepare($sql);
         $params = array(
            $idMessage
         );
         $res = $req->execute($params);
         if ($res === FALSE) {
           var_dump($this->db->errorInfo()[2]);
            die("readMessageById : Requête impossible !"); // erreur dans la requête
         }
         $res = $req->fetchAll(PDO::FETCH_CLASS,"Message");
         return (isset($res[0])?$res[0]:null);
      }

      function readMessagesRecusByUtilisateur($idUtilisateur) {
         $sql = "SELECT * FROM Message WHERE destinataire = ? AND etat >= 5"; // requête
         $req = $this->db->prepare($sql);
         $params = array(
            $idUtilisateur
         );
         $res = $req->execute($params);
         if ($res === FALSE) {
           var_dump($this->db->errorInfo()[2]);
            die("readMessagesRecusByUtilisateur : Requête impossible !"); // erreur dans la requête
         }
         $res = $req->fetchAll(PDO::FETCH_CLASS,"Message");
         return (isset($res[0])?$res:null);
      }

      function readMessagesEnvoyesByUtilisateur($idUtilisateur) {
         $sql = "SELECT * FROM Message WHERE expediteur = ? AND etat >= 5"; // requête
         $req = $this->db->prepare($sql);
         $params = array(
            $idUtilisateur
         );
         $res = $req->execute($params);
         if ($res === FALSE) {
           var_dump($this->db->errorInfo()[2]);
            die("readMessagesEnvoyesByUtilisateur : Requête impossible !"); // erreur dans la requête
         }
         $res = $req->fetchAll(PDO::FETCH_CLASS,"Message");
         return (isset($res[0])?$res:null);
      }

      function readMessagesBrouillonsByUtilisateur($idUtilisateur) {
         $sql = "SELECT * FROM Message WHERE expediteur = ? AND etat = 0"; // requête
         $req = $this->db->prepare($sql);
         $params = array(
            $idUtilisateur
         );
         $res = $req->execute($params);
         if ($res === FALSE) {
           var_dump($this->db->errorInfo()[2]);
            die("readMessagesBrouillonsByUtilisateur : Requête impossible !"); // erreur dans la requête
         }
         $res = $req->fetchAll(PDO::FETCH_CLASS,"Message");
         return (isset($res[0])?$res:null);
      }

      function createMessage($message) {
         $c = $this->readMessageById($message->getID());
         if ($c == null) {
            $sql = "INSERT INTO Message(expediteur,destinataire,etat,contenu,dateenvoi) VALUES (?,?,?,?,?) RETURNING idMessage";
            $req = $this->db->prepare($sql);
            $params = array(
               $message->getExpediteur(),
               $message->getDestinataire(),
               $message->getEtat(),
               $message->getContenu(),
               $message->getDateenvoi()
            );
            $res = $req->execute($params);
            if ($res === FALSE) {
              var_dump($this->db->errorInfo()[2]);
               die("createMessage : Requête impossible !");
            }
            return $req->fetchColumn();
         } else {
            throw new DAOException("idMessage déjà présente dans la base");
         }
      }

      function createMessageNewConv($message,$nom) {
        $idM = $this->createMessage($message);
        $idC = $this->createConversation(new Conversation(NULL,$idM,$nom));
        $this->createMessageConversation($idC,$idM);
        return $idM;
      }

      function updateMessage($message) {
         $m = $this->readMessageById($message->getID());
         if ($m != null) {
            $sql = "UPDATE Message SET etat = ?, contenu = ?, dateenvoi = ? where idMessage= ?";
            $req = $this->db->prepare($sql);
            $params = array(
              $message->getEtat(),
              $message->getContenu(),
              $message->getDateenvoi(),
              $message->getID()
            );
            $res = $req->execute($params);
            if ($res === FALSE) {
              var_dump($this->db->errorInfo()[2]);
               die("updateMessage : Requête impossible !");
            }
         } else {
            throw new DAOException("idMessage non présent dans la base");
         }
      }


      function deleteMessageByIdMessage($idMessage) {
        $u = $this->db->readMessageById($idMessage);
        if ($u != null) {
          try {
            $this->db->deleteMessageTagByIdMessage($idMessage);
          } catch (DAOException $e) {}
          try {
            $this->db->deleteNegociationMessagesByIdMessage($idMessage);
          } catch (DAOException $e) {}

          $sql = "DELETE FROM Message where idMessage = ?";
          $req = $this->db->prepare($sql);
          $params = array(
            $idMessage
          );
          $res = $req->execute($params);
          if ($res === FALSE) {
            var_dump($this->db->errorInfo()[2]);
            die("deleteMessageByIdMessage : Requête impossible !");
          }
          return true;
        } else {
          throw new DAOException("Message non présent dans la base, supression impossible");
        }
      }

      // ===================== Conversation =====================

      // Conversation(idConversation,idPremierMessage,nom)
      function readConversationById($idConversation) {
         $sql = "SELECT * FROM Conversation WHERE idConversation = ?"; // requête
         $req = $this->db->prepare($sql);
         $params = array(
            $idConversation
         );
         $res = $req->execute($params);
         if ($res === FALSE) {
            var_dump($this->db->errorInfo()[2]);
            die("readConversationById : Requête impossible !"); // erreur dans la requête
         }
         $res = $req->fetchAll(PDO::FETCH_CLASS,"Conversation");
         return (isset($res[0])?$res[0]:null);
      }

      function createConversation($conversation) {
         $c = $this->readConversationById($conversation->getID());
         if ($c == null) {
            $sql = "INSERT INTO Conversation(idPremierMessage,nom) VALUES (?,?) RETURNING idConversation";
            $req = $this->db->prepare($sql);
            $params = array(
               $conversation->getIDMessageOrigine(),
               $conversation->getNom()
            );
            $res = $req->execute($params);
            if ($res === FALSE) {
              var_dump($this->db->errorInfo()[2]);
               die("createConversation : Requête impossible !");
            }
            return $req->fetchColumn();
         } else {
            throw new DAOException("idConversation déjà présente dans la base");
         }
      }

      // ===================== Conversation_Message =====================

      // Conversation_Message(idConversation,idMessage)
      function readMessagesByConversation($idConversation) {
         $sql = "SELECT idMessage FROM Conversation_Message WHERE idConversation = ?"; // requête
         $req = $this->db->prepare($sql);
         $params = array(
            $idConversation
         );
         $res = $req->execute($params);
         if ($res === FALSE) {
            die("readMessagesByConversation : Requête impossible !"); // erreur dans la requête
         }
         $res = $req->fetchAll();
         return (isset($res[0])?$res:null);
      }

      // Conversation_Message(idConversation,idMessage)
      function readConversationByMessage($idMessage) {
         $sql = "SELECT idConversation FROM Conversation_Message WHERE idMessage = ?"; // requête
         $req = $this->db->prepare($sql);
         $params = array(
            $idMessage
         );
         $res = $req->execute($params);
         if ($res === FALSE) {
            die("readConversationByMessage : Requête impossible !"); // erreur dans la requête
         }
         $res = $req->fetchAll();
         return (isset($res[0])?$res[0][0]:null);
      }

      function createMessageConversation($idConversation,$idMessage) {
         $c = $this->readConversationById($idConversation);
         if ($c != null) {
            $sql = "INSERT INTO Conversation_Message(idConversation,idMessage) VALUES (?,?)";
            $req = $this->db->prepare($sql);
            $params = array(
               $idConversation,
               $idMessage
            );
            $res = $req->execute($params);
            if ($res === FALSE) {
               die("createConversation : Requête impossible !");
            }
         } else {
            throw new DAOException("idConversation ($c) non présente dans la base");
         }
      }

      function readNotificationById($idNotification){
        $sql = "SELECT * FROM Notification WHERE idnotif = ?"; // requête
        $req = $this->db->prepare($sql);
        $params = array( // paramétres
           $idNotification
        );
        $res = $req->execute($params);
        if ($res === FALSE) {
           die("readNotificationById : Requête impossible !"); // erreur dans la requête
        }
        $res = $req->fetchAll(PDO::FETCH_CLASS,"Notification");
        return (isset($res[0])?$res[0]:null); // retourne le premier resultat s'il existe, sinon null
      }
      function readListeNotificationUserid($idUser){
        $sql = "SELECT * FROM Notification WHERE destinataire = ? ORDER BY idNotif"; // requête
        $req = $this->db->prepare($sql);
        $params = array( // paramétres
           $idUser
        );
        $res = $req->execute($params);
        if ($res === FALSE) {
           die("readNotificationById : Requête impossible !"); // erreur dans la requête
        }
        $res = $req->fetchAll(PDO::FETCH_CLASS,"Notification");
        return (isset($res)?$res:null); // retourne le premier resultat s'il existe, sinon null
      }
      function readListeNotificationUseridNoRead($idUser){
        $sql = "SELECT * FROM Notification WHERE destinataire = ? AND etat=0 ORDER BY idNotif DESC LIMIT 20"; // requête
        $req = $this->db->prepare($sql);
        $params = array( // paramétres
           $idUser
        );
        $res = $req->execute($params);
        if ($res === FALSE) {
           die("readNotificationById : Requête impossible !"); // erreur dans la requête
        }
        $res = $req->fetchAll(PDO::FETCH_CLASS,"Notification");
        return (isset($res)?$res:null); // retourne le premier resultat s'il existe, sinon null
      }
      function updateNotification($notification){
        $n = $this->readNotificationById($notification->getIdNotification());
        if ($n != null) {
           $sql = "UPDATE Notification set etat = ? where idnotif=?";
           $req = $this->db->prepare($sql);
           $params = array(
              $notification->getEtat(),
              $notification->getIdNotification()
           );
           $res = $req->execute($params);
           if ($res === FALSE) {
              die("updateNotification : Requête impossible !");
           }
           return $this->readNotificationById($notification->getIdNotification());
        } else {
           throw new DAOException("La notif n'existe pas");
        }
      }
      function createNotification($notification){
        $n = $this->readNotificationById($notification->getIdNotification());
        if ($n == null) {
           $sql = "INSERT INTO Notification(etat,destinataire,type,Message) VALUES (?,?,?,?) RETURNING idnotif";
           $req = $this->db->prepare($sql);
           $params = array(
              $notification->getEtat(),
              $notification->getDestinataire(),
              $notification->getType(),
              $notification->getMessage()
           );
           $res = $req->execute($params);
           if ($res === FALSE) {
              die("createNotification : Requête impossible !");
           }
           $ret = $req->fetchColumn();
           return $this->readNotificationById($ret);
        } else {
           throw new DAOException("Notif deja presente dans la base");
        }
      }
      function deleteNotification($notification){
        // A faire
      }

   }

   ?>
