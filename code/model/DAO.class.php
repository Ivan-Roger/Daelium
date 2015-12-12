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

    // vérif or not vérif this->db is the question (si la personne est déjà présente)
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
      $p = $this->db->readPersonneById($personne->idUtilisateur);
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
      $u = $this->db->readUserByEmail($utilisateur->email);
      if ($u == null) {
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
      $u = $this->db->readUserByEmail($utilisateur->email);
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
    $b = $this->db->readBookerById($booker->idBooker);
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
    $o = $this->db->readBookerById($organisateur->$idOrganisateur);
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
    $g = $this->db->readGroupeById($groupe->idGroupe); // ou un readGroupeByMail je sais pas
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
    $g = $this->db->readGroupeById($groupe->idGroupe);
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
    $a = $this->db->readArtisteById($artiste->idArtiste);
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
    $a = $this->db->readArtisteById($utilisateur->idUtilisateur);
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
    $l = $this->db->readLieuById($lieu->idLieu);
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
    $l = $this->db->readLieuById($lieu->idLieu);
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
    $m = $this->db->readUserByEmail($manifestation->idManif);
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
    $m = $this->db->readUserByEmail($manifestation->idManif);
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
    $sql = "SELECT * FROM Document WHERE idDoc = ?"; // requête
    $req = $this->db->prepare($sql);
    $params = array( // paramétres
      $idDoc // l'id de l'utilisateur
    );
    $res = $req->execute($params);
    if ($res === FALSE) {
      die("readDocumentById : Requête impossible !"); // erreur dans la requête
    }
    $res = $req->fetchAll(PDO::FETCH_CLASS,"Document");
    return (isset($res[0])?$res[0]:null); // retourne le premier resultat s'il existe, sinon null
  }


  function createDocument($document) {
    $d = $this->db->readDocumentById($document->idDoc);
    if ($d == null) {
      $sql = "INSERT INTO Document(idUtilisateur,nom,dateCreation,dateModif,emplacement) VALUES (?,?,?,?,?)";
      $req = $this->db->prepare($sql);
      $params = array(
        $document->idUtilisateur,
        $document->nom,
        $document->dateCreation,
        $document->dateModif,
        $document->emplacement
      );
      $res = $req->execute($params);
      if ($res === FALSE) {
        die("createDocument : Requête impossible !");
      }
      return $this->db->readUserById($document->idDoc);
    } else {
      throw DAOUserException("Document déjà présent dans la base (l'id en tous cas)");
    }
  }


  function updateDocument($document) {
    $d = $this->db->readDocumentById($document->idDoc);
    if ($d != null) {
      $sql = "UPDATE Document(idUtilisateur,nom,dateCreation,dateModif,emplacement) = (?,?,?,?,?) where idDoc= ?";
      $req = $this->db->prepare($sql);
      $params = array(
        $document->idUtilisateur,
        $document->nom,
        $document->dateCreation,
        $document->dateModif,
        $document->emplacement,
        $document->idDoc
      );
      $res = $req->execute($params);
      if ($res === FALSE) {
        die("updateDocument : Requête impossible !");
      }
      return $this->db->readDocumentById($document->idDoc);
    } else {
      throw DAOUserException("Document non présent dans la base de données !");
    }
  }

  // ===================== Evenenement =====================

  //Evenenement(idEvene,dateDebut,dateFin,heureDebut,heureFin,description,Lieu,createur)
  function readEvenenementById($idEvene) {
    $sql = "SELECT * FROM Evenenement WHERE idEvene = ?"; // requête
    $req = $this->db->prepare($sql);
    $params = array( // paramétres
      $idEvene // l'id de l'utilisateur
    );
    $res = $req->execute($params);
    if ($res === FALSE) {
      die("readEvenenementById : Requête impossible !"); // erreur dans la requête
    }
    $res = $req->fetchAll(PDO::FETCH_CLASS,"Evenenement");
    return (isset($res[0])?$res[0]:null);
  }

  function readEvenenementByLieu($idLieu) {
    $sql = "SELECT * FROM Evenenement WHERE idLieu = ?"; // requête
    $req = $this->db->prepare($sql);
    $params = array( // paramétres
      $idLieu // l'id de l'utilisateur
    );
    $res = $req->execute($params);
    if ($res === FALSE) {
      die("readEvenenementByLieu : Requête impossible !"); // erreur dans la requête
    }
    $res = $req->fetchAll(PDO::FETCH_CLASS,"Evenenement");
    return (isset($res[0])?$res:null);
  }

  function readEvenenementByCreateur($idCreateur) {
    $sql = "SELECT * FROM Evenenement WHERE idCreateur = ?"; // requête
    $req = $this->db->prepare($sql);
    $params = array( // paramétres
      $idCreateur // l'id de l'utilisateur
    );
    $res = $req->execute($params);
    if ($res === FALSE) {
      die("readEvenenementByCreateur : Requête impossible !"); // erreur dans la requête
    }
    $res = $req->fetchAll(PDO::FETCH_CLASS,"Evenenement");
    return (isset($res[0])?$res:null);
  }

  function createEvenenement($evenenement) {
    $e = $this->db->readEvenenementById($evenenement->idEvene);
    if ($e == null) {
      $sql = "INSERT INTO Evenenement(dateDebut,dateFin,heureDebut,heureFin,description,Lieu,createur) VALUES (?,?,?,?,?,?,?)";
      $req = $this->db->prepare($sql);
      $params = array(
        $evenenement->dateDebut,
        $evenenement->dateFin,
        $evenenement->heureDebut,
        $evenenement->heureFin,
        $evenenement->description,
        $evenenement->Lieu,
        $evenenement->createur
      );
      $res = $req->execute($params);
      if ($res === FALSE) {
        die("createEvenenement : Requête impossible !");
      }
      return $this->db->readUserById($evenenement->idEvene);
    } else {
      throw DAOUserException("Evenenement déjà présent dans la base (l'id en tous cas)");
    }
  }

  function updateEvenenement($evenenement) {
    $e = $this->db->readEvenenementById($evenenement->idEvene);
    if ($e != null) {
      $sql = "UPDATE Evenenement(dateDebut,dateFin,heureDebut,heureFin,description,Lieu,createur) = (?,?,?,?,?,?,?) where idEvene = ?";
      $req = $this->db->prepare($sql);
      $params = array(
        $evenenement->dateDebut,
        $evenenement->dateFin,
        $evenenement->heureDebut,
        $evenenement->heureFin,
        $evenenement->description,
        $evenenement->Lieu,
        $evenenement->createur,
        $evenenement->idEvene
      );
      $res = $req->execute($params);
      if ($res === FALSE) {
        die("updateEvenenement : Requête impossible !");
      }
      return $this->db->readEvenenementById($evenenement->idEvene);
    } else {
      throw DAOUserException("Evenement non présent dans la base de données !");
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
      die("readContactByPrimary : Requête impossible !"); // erreur dans la requête
    }
    $res = $req->fetchAll(PDO::FETCH_CLASS,"Contact");
    return (isset($res[0])?$res[0]:null);
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
        die("createContact : Requête impossible !");
      }
      return $this->db->readContactByPrimary($contact->idContact,$contact->proprietaire);
    } else {
      throw DAOUserException("Contact déjà présent dans la base (l'id en tous cas)");
    }
  }

  function updateContact($contact) {
    $c = $this->db->readContactByPrimary($contact->idContact,$contact->proprietaire);
    if ($c == null) {
      $sql = "UPDATE Contact set (notes) = (?) where idContact = ? and proprietaire = ?";
      $req = $this->db->prepare($sql);
      $params = array(
        $contact->notes,
        $contact->idContact,
        $contact->proprietaire
      );
      $res = $req->execute($params);
      if ($res === FALSE) {
        die("updateContact : Requête impossible !");
      }
      return $this->db->readContactByPrimary($contact->idContact,$contact->proprietaire);
    } else {
      throw DAOUserException("Contact non présent dans la base");
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
      die("readContactSystemByPrimary : Requête impossible !"); // erreur dans la requête
    }
    $res = $req->fetchAll(PDO::FETCH_CLASS,"Contact_Systeme");
    return (isset($res[0])?$res[0]:null);
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
        die("createContactSystem : Requête impossible !");
      }
      return $this->db->readContactSystemByPrimary($contactSyst->contactProprietaire,$contactSyst->idContact);
    } else {
      throw DAOUserException("Contact_Systeme déjà présent dans la base");
    }
  }

  function updateContactSystem($contactSyst) {
    $c = $this->db->readContactSystemByPrimary($contactSyst->contactProprietaire,$contactSyst->idContact);
    if ($c == null) {
      $sql = "UPDATE Contact_Systeme set (personne) = (?) where contactProprietaire = ? and idContact = ?";
      $req = $this->db->prepare($sql);
      $params = array(
        $contactSyst->personne,
        $contactSyst->contactProprietaire,
        $contactSyst->idContact
      );
      $res = $req->execute($params);
      if ($res === FALSE) {
        die("createContactSystem : Requête impossible !");
      }
      return $this->db->readContactSystemByPrimary($contactSyst->contactProprietaire,$contactSyst->idContact);
    } else {
      throw DAOUserException("Contact_Systeme non présent dans la base");
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
      die("readContactExterieurByPrimary : Requête impossible !"); // erreur dans la requête
    }
    $res = $req->fetchAll(PDO::FETCH_CLASS,"Contact_exterieur");
    return (isset($res[0])?$res[0]:null);
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
        die("createContactExterieur : Requête impossible !");
      }
      return $this->db->readContactExterieurByPrimary($contactSyst->contactProprietaire,$contactSyst->idContact);
    } else {
      throw DAOUserException("Contact_exterieur déjà présent dans la base");
    }
  }

  function updateContactExterieur($contactProp) {
    $c = $this->db->readContactExterieurByPrimary($contactSyst->contactProprietaire,$contactSyst->idContact);
    if ($c == null) {
      $sql = "UPDATE Contact_exterieur set (nom,email,tel) = (?,?,?) where contactProprietaire = ? and idContact = ?";
      $req = $this->db->prepare($sql);
      $params = array(
        $contactProp->nom,
        $contactProp->email,
        $contactProp->tel
        $contactProp->contactProprietaire,
        $contactProp->idContact
      );
      $res = $req->execute($params);
      if ($res === FALSE) {
        die("updateContactExterieur : Requête impossible !");
      }
      return $this->db->readContactExterieurByPrimary($contactSyst->contactProprietaire,$contactSyst->idContact);
    } else {
      throw DAOUserException("Contact_exterieur non présent dans la base");
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
      die("readContactEvenementByPrimary : Requête impossible !"); // erreur dans la requête
    }
    $res = $req->fetchAll(PDO::FETCH_CLASS,"Contact_Evenement");
    return (isset($res[0])?$res[0]:null);
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
        die("createContactEvenement : Requête impossible !");
      }
      return $this->db->readContactEvenementByPrimary($contactEven->proprietaire,$contactEven->idContact,$contactEven->idEvene);
    } else {
      throw DAOUserException("Contact_Evenement déjà présent dans la base");
    }
  }

  //Etant donnée les trois clées qui sont primaire je ne pense pas qu'on puisse faire un update sur contact evenement

  // ===================== Creneau =====================

  // Creneau(idManif,idGroupe,heureDebut,heureFin,lieu,heureDebutTest,heureFinTest)
  function readCreneauByPrimary($idManif, $idGroupe, $heureDebut) {
    $sql = "SELECT * FROM Creneau WHERE idManif=? and idGroupe=? and heureDebut = ?"; // requête
    $req = $this->db->prepare($sql);
    $params = array(
      $idManif,
      $idGroupe,
      $heureDebut
    );
    $res = $req->execute($params);
    if ($res === FALSE) {
      die("readCreneauByPrimary : Requête impossible !"); // erreur dans la requête
    }
    $res = $req->fetchAll(PDO::FETCH_CLASS,"Creneau");
    return (isset($res[0])?$res[0]:null);
  }

  function createCreneau($creneau) {
    $c = $this->db->readCreneauByPrimary($creneau->idManif,$creneau->idGroupe,$creneau->heureDebut);
    if ($c == null) {
      $sql = "INSERT INTO Creneau(idManif,idGroupe,heureDebut,heureFin,lieu,heureDebutTest,heureFinTest) VALUES (?,?,?,?,?,?,?)";
      $req = $this->db->prepare($sql);
      $params = array(
        $creneau->idManif,
        $creneau->idGroupe,
        $creneau->heureDebut,
        $creneau->heureFin,
        $creneau->lieu,
        $creneau->heureDebutTest,
        $creneau->heureFinTest
      );
      $res = $req->execute($params);
      if ($res === FALSE) {
        die("createCreneau : Requête impossible !");
      }
      return $this->db->readCreneauByPrimary($creneau->idManif,$creneau->idGroupe,$creneau->heureDebut);
    } else {
      throw DAOUserException("Creneau déjà présent dans la base");
    }
  }

  function updateCreneau($creneau) {
    $c = $this->db->readCreneauByPrimary($creneau->idManif,$creneau->idGroupe,$creneau->heureDebut);
    if ($c == null) {
      $sql = "UPDATE Creneau set (heureFin,lieu,heureDebutTest,heureFinTest) = (?,?,?,?) where idManif=? and idGroupe=? and heureDebut = ?";
      $req = $this->db->prepare($sql);
      $params = array(
        $creneau->heureFin,
        $creneau->lieu,
        $creneau->heureDebutTest,
        $creneau->heureFinTest,
        $creneau->idManif,
        $creneau->idGroupe,
        $creneau->heureDebut
      );
      $res = $req->execute($params);
      if ($res === FALSE) {
        die("updateCreneau : Requête impossible !");
      }
      return $this->db->readCreneauByPrimary($creneau->idManif,$creneau->idGroupe,$creneau->heureDebut);
    } else {
      throw DAOUserException("Creneau non présent dans la base");
    }
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
