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
      $res = $req->fetchAll(PDO::FETCH_CLASS,"Personne");
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

    // vérif or not vérif this is the question (si la personne est déjà présente)
    function createPersonne($personne) {
        $sql = "INSERT INTO Personne(nomp,prenom,tel,emailContact) VALUES (?,?,?,?)";
        $req = $this->db->prepare($sql);
        $params = array(
          $personne->nomp,
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
        $sql = "UPDATE Personne set (nomp, prenom, tel, emailContact, adresse) = (?,?,?,?,?) where id = ?";
        $req = $this->db->prepare($sql);
        $params = array($personne->nomp,
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
        return $this->db->readPersonneById($personne->id);
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
      $res = $req->fetchAll(PDO::FETCH_CLASS,"Utilisateur");
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
      $res = $req->fetchAll(PDO::FETCH_CLASS,"Utilisateur");
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
        return $this->db->readUserById($utilisateur->idUtilisateur);
      } else {
        throw DAOUserException("utilisateur déjà présent dans la base (l'id en tous cas)");
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
        return $this->db->readUserById($utilisateur->idUtilisateur);
      } else {
        throw DAOUserException("Utilisateur non présent dans la base de données !");
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
      die("readBookerById : Requête impossible !"); // erreur dans la requête
    }
    $res = $req->fetchAll(PDO::FETCH_CLASS,"Booker");
    return (isset($res[0])?$res[0]:null); // retourne le premier resultat s'il existe, sinon null
  }


  function createBooker($booker) {
    $b = $this->readBookerById($booker->idBooker);
    if ($b == null) {
      $sql = "INSERT INTO Booker(idBooker) VALUES (?)";
      $req = $this->db->prepare($sql);
      $params = array(
        $booker->idBooker;
      );
      $res = $req->execute($params);
      if ($res === FALSE) {
        die("createBooker : Requête impossible !");
      }
      return $this->db->readBookerById($utilisateur->id);
    } else {
      throw DAOUserException("Booker déjà présent dans la base");
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
    $res = $req->fetchAll(PDO::FETCH_CLASS,"Organisateur");
    return (isset($res[0])?$res[0]:null); // retourne le premier resultat s'il existe, sinon null
  }


  function createOrganisateur($organisateur) {
    $o = $this->readBookerById($organisateur->$idOrganisateur);
    if ($o == null) {
      $sql = "INSERT INTO $organisateur(idOrganisateur) VALUES (?)";
      $req = $this->db->prepare($sql);
      $params = array(
        $organisateur->idOrganisateur;
      );
      $res = $req->execute($params);
      if ($res === FALSE) {
        die("createOrganisateur : Requête impossible !");
      }
      return $this->db->createOrganisateur($organisateur->id);
    } else {
      throw DAOUserException("Organisateur déjà présent dans la base");
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
    $res = $req->fetchAll(PDO::FETCH_CLASS,"Groupe");
    return (isset($res[0])?$res[0]:null); // retourne le premier resultat s'il existe, sinon null

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
    $res = $req->fetchAll(PDO::FETCH_CLASS,"Groupe");
    return (isset($res[0])?$res[0]:null); // retourne le premier resultat s'il existe, sinon null

  }

  function createGroupe($groupe) {
    $g = $this->readGroupeById($groupe->idGroupe); // ou un readGroupeByMail je sais pas
    if ($g == null) {
      $sql = "INSERT INTO Groupe(nomg,lienImageOfficiel,facebook,google,twitter,lecteur,soundcloud,ficheCom,adresse) VALUES (?,?,?,?,?,?,?,?,?)";
      $req = $this->db->prepare($sql);
      $params = array(
        $groupe->nomg,
        $groupe->lienImageOfficiel,
        $groupe->facebook,
        $groupe->google,
        $groupe->twitter,
        $groupe->lecteur,
        $groupe->soundcloud,
        $groupe->ficheCom,
        $groupe->adresse
      );
      $res = $req->execute($params);
      if ($res === FALSE) {
        die("createGroupe : Requête impossible !");
      }
      return $this->db->readGroupeById($groupe->id);
    } else {
      throw DAOUserException("Groupe déjà présent dans la base");
    }
  }

  function updateGroupe($groupe) {
    $g = $this->readGroupeById($groupe->idGroupe);
    if ($g != null) {
      $sql = "UPDATE Groupe(nomg,lienImageOfficiel,facebook,google,twitter,lecteur,soundcloud,ficheCom,adresse) = (?,?,?,?,?,?,?,?,?) where idGroupe = ?";
      $req = $this->db->prepare($sql);
      $params = array(
        $groupe->nomg,
        $groupe->lienImageOfficiel,
        $groupe->facebook,
        $groupe->google,
        $groupe->twitter,
        $groupe->lecteur,
        $groupe->soundcloud,
        $groupe->ficheCom,
        $groupe->adresse,
        $groupe->idGroupe
      );
      $res = $req->execute($params);
      if ($res === FALSE) {
        die("readGroupeById : Requête impossible !");
      }
      return $this->db->readGroupeById($groupe->idGroupe);
    } else {
      throw DAOUserException("Groupe non présent dans la base de données !");
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
    $res = $req->fetchAll(PDO::FETCH_CLASS,"Artiste");
    return (isset($res[0])?$res[0]:null); // retourne le premier resultat s'il existe, sinon null

  }

  function createArtiste($artiste) {
    $a = $this->readArtisteById($artiste->idArtiste);
    if ($a == null) {
      $sql = "INSERT INTO Artiste(dateNaissance, paiement, rib, ordreCheque) VALUES (?,?,?,?)";
      $req = $this->db->prepare($sql);
      $params = array(
        $artiste->dateNaissance,
        $artiste->paiement,
        $artiste->rib,
        $artiste->ordreCheque
      );
      $res = $req->execute($params);
      if ($res === FALSE) {
        die("createArtiste : Requête impossible !");
      }
      return $this->db->readUserById($artiste->idArtiste);
    } else {
      throw DAOUserException("Artiste déjà présent dans la base");
    }
  }

  function updateArtiste($artiste) {
    $a = $this->readArtisteById($utilisateur->idUtilisateur);
    if ($a != null) {
      $sql = "UPDATE Artiste(dateNaissance, paiement, rib, ordreCheque) = (?,?,?,?) where idArtiste = ?";
      $req = $this->db->prepare($sql);
      $params = array(
        $artiste->dateNaissance,
        $artiste->paiement,
        $artiste->rib,
        $artiste->ordreCheque,
        $artiste->idArtiste
      );
      $res = $req->execute($params);
      if ($res === FALSE) {
        die("updateArtiste : Requête impossible !");
      }
      return $this->db->updateArtiste($utilisateur->idUtilisateur);
    } else {
      throw DAOUserException("Artiste non présent dans la base de données !");
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
    $l = $this->readLieuById($lieu->idLieu);
    if ($l == null) {
      $sql = "INSERT INTO Lieu(noml,description,pays,region,ville,codePostal,adresse,latitude,longitude) VALUES (?,?,?,?,?,?,?,?,?)";
      $req = $this->db->prepare($sql);
      $params = array(
        $lieu->noml,
        $lieu->description,
        $lieu->pays,
        $lieu->region,
        $lieu->ville,
        $lieu->codePostal,
        $lieu->adresse,
        $lieu->latitude,
        $lieu->longitude
      );
      $res = $req->execute($params);
      if ($res === FALSE) {
        die("createLieu : Requête impossible !");
      }
      return $this->db->readUserById($utilisateur->idUtilisateur);
    } else {
      throw DAOUserException("Lieu déjà présent dans la base (l'id en tous cas)");
    }
  }

  function updateLieu($lieu) {
    $l = $this->readLieuById($lieu->idLieu);
    if ($l != null) {
      $sql = "UPDATE Lieu(noml,description,pays,region,ville,codePostal,adresse,latitude,longitude) = (?,?,?,?,?,?,?,?,?) where idLieu = ?";
      $req = $this->db->prepare($sql);
      $params = array(
        $lieu->noml,
        $lieu->description,
        $lieu->pays,
        $lieu->region,
        $lieu->ville,
        $lieu->codePostal,
        $lieu->adresse,
        $lieu->latitude,
        $lieu->longitude,
        $lieu->idLieu
      );
      $res = $req->execute($params);
      if ($res === FALSE) {
        die("updateUtilisateur : Requête impossible !");
      }
      return $this->db->readLieuById($utilisateur->idUtilisateur);
    } else {
      throw DAOUserException("Lieu non présent dans la base de données !");
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

  function createManifestation($manifestation) {
    $m = $this->readUserByEmail($manifestation->idManif);
    if ($m == null) {
      $sql = "INSERT INTO Manifestation(type,description,datedebut,datefin,prixPublic,lienImageOfficiel,facebook,google,twitter,ficheCom,createur,lieu) VALUES (?,?,?,?,?,?,?,?,?,?,?,?)";
      $req = $this->db->prepare($sql);
      $params = array(
        $manifestation->type,
        $manifestation->description,
        $manifestation->dateDebut,
        $manifestation->dateFin,
        $manifestation->prixPublic,
        $manifestation->lienImageOfficiel,
        $manifestation->facebook,
        $manifestation->google,
        $manifestation->twitter,
        $manifestation->ficheCom,
        $manifestation->createur,
        $manifestation->lieu
      );
      $res = $req->execute($params);
      if ($res === FALSE) {
        die("createManifestation : Requête impossible !");
      }
      return $this->db->readManifestationById($manifestation->idManif);
    } else {
      throw DAOUserException("Manifestation déjà présent dans la base (l'id en tous cas)");
    }
  }

  function updateManifestation($manifestation) {
    $m = $this->readUserByEmail($manifestation->idManif);
    if ($m != null) {
      $sql = "UPDATE Manifestation(type,description,datedebut,datefin,prixPublic,lienImageOfficiel,facebook,google,twitter,ficheCom,createur,lieu) = (?,?,?,?,?,?,?,?,?,?,?,?) where idManif = ?";
      $req = $this->db->prepare($sql);
      $params = array(
        $manifestation->type,
        $manifestation->description,
        $manifestation->dateDebut,
        $manifestation->dateFin,
        $manifestation->prixPublic,
        $manifestation->lienImageOfficiel,
        $manifestation->facebook,
        $manifestation->google,
        $manifestation->twitter,
        $manifestation->ficheCom,
        $manifestation->createur,
        $manifestation->idLieu;
        $manifestation->idManif
      );
      $res = $req->execute($params);
      if ($res === FALSE) {
        die("updateManifestation : Requête impossible !");
      }
      return $this->db->readManifestationById($manifestation->idManif);
    } else {
      throw DAOUserException("Manifestation non présent dans la base de données !");
    }
  }

  // ===================== Document =====================

  //Document(idDoc,idUtilisateur,nom,dateCreation,dateModif,emplacement)
  function readDocumentById($idDoc) {

  }

  function readDocumentByUtilisateur($idUtilisateur) {

  }

  function createDocument($document) {

  }


  function updateDocument($document) {

  }

  // ===================== Evenenement =====================

  //Evenenement(idEvene,dateDebut,dateFin,heureDebut,heureFin,description,Lieu,createur)
  function readEvenenementById($idEvene) {

  }

  function readEvenenementByLieu($idLieu) {

  }

  function readEvenenementByCreateur($idCreateur) {

  }

  function createEvenenement($evenenement) {

  }

  function updateEvenenement($evenenement) {

  }

  // ===================== Contact =====================

  //Contact(idContact,proprietaire,notes)
  function readContactById($idContact,$proprietaire) {

  }

  function createContact($contact) {

  }

  function updateContact($contact) {

  }

  // ===================== Contact_Systeme =====================

  // Contact_Systeme(contactProprietaire,idContact,personne)
  function readContactSystemByPrimary($contactProprietaire, $idContact) {

  }

  function createContactSystem($contactSyst) {

  }

  function updateContactSystem($contactSyst) {

  }

  // ===================== Contact_exterieur =====================

  // Contact_exterieur(contactProprietaire,idContact,nom,email,tel)
  function readContactExterieurByPrimary($contactProprietaire, $idContact) {

  }

  function createContactExterieur($contactProp) {

  }

  function updateContactExterieur($contactProp) {

  }

  // ===================== Contact_Evenement =====================

  // Contact_Evenement(contactProprietaire,idContact,idEvene)
  function readContactEvenementByPrimary($contactEven, $idContact, $idEven) {

  }

  function createContactEvenement($contactEven) {

  }

  function updateContactEvenement($contactEven) {

  }

  // ===================== Creneau =====================

  // Creneau(idManif,idGroupe,heureDebut,heureFin,lieu,heureDebutTest,heureFinTest)
  function readCreneauByPrimary($idManif, $idGroupe, $heureDebut) {

  }

  function createCreneau($creneau) {

  }

  function updateCreneau($creneau) {

  }

  // ===================== Groupe_Artiste =====================

  // Groupe_Artiste(idGroupe,idArtiste)
  function readGroupeArtisteByPrimary($idGroupe, $idArtiste) {

  }

  function createGroupeArtiste($groupeArtiste) {

  }

  function updateGroupeArtiste($groupeArtiste) {

  }

  // ===================== Negociation =====================

  // Negociation(idNegociation,idBooker,idManif,idGroupe,idOrganisateur,etat)
  function readNegociationById($id) {

  }

  function createNegociation($negociation) {

  }

  function updateNegociation($negociation) {

  }

  // ===================== Negociation_Documents =====================

  // Negociation_Documents(idDoc,idNegociation)
  function readNegociationDocumentsByPrimary($idNegociation,$idDoc) {

  }

  function createNegociationDocuments($negociationDoc) {

  }

  function updateNegociationDocuments($negociationDoc) {

  }

  // ===================== Negociation_Messages =====================

  // Negociation_Messages(idMessage,idNegociation)
  function readNegociationMessagesByPrimary($idNegociation,$idMess) {

  }

  function createNegociationMessages($negociationMess) {

  }

  function updateNegociationMessages($negociationMess) {

  }

  // ===================== Message_Tag =====================

  // Message_Tag(idMessage,tel,nom)
  function readMessageTagByPrimary($nomt,$idMess) {

  }

  function createMessageTag($message) {

  }

  function updateMessageTag($message) {

  }

  // ===================== Booker_Groupe =====================

  // Booker_Groupe(idGroupe,idBooker)
  function readBookerGroupeByPrimary($idBooker,$idGroupe) {

  }

  function createBookerGroupe($bookerGroupe) {

  }

  function updateBookerGroupe($bookerGroupe) {

  }

  // ===================== Groupe_Genre =====================

  // Groupe_Genre(idGroupe,nomGenre)
  function readGroupeGenreByPrimary($idGroupe, $nomGrenre) {

  }

  function createGroupeGenre($groupeGenre) {

  }

  function updateGroupeGenre($groupeGenre) {

  }

  // ===================== Manifestation_Genre =====================

  // Manifestation_Genre(idManif,nomGenre)
  function readManifestationGenreByPrimary($idManif, $nomGenre) {

  }

  function createManifestationGenre($manifestationGenre) {

  }

  function updateManifestationGenre($manifestationGenre) {

  }

  // ===================== Contact_Tag =====================

  // Contact_Tag(nomt,idContact,proprietaire)
  function readContactTagByPrimary($nomt,$idContact,$proprietaire) {

  }

  function createContactTag($contactTag) {

  }

  function updateContactTag($contactTag) {

  }

}

?>
