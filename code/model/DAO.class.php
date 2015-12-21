<?php
require_once("utils.class.php");
require_once("exceptions.class.php");
require_once("Utilisateur.class.php");
require_once("Artist.class.php");
require_once("Organisateur.class.php");
require_once("Booker.class.php");
require_once("Group.class.php");
require_once("Manifestation.class.php");


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

  // vérif or not vérif this->db is the question (si la personne est déjà présente)
  private function createPersonne($personne) {
    $sql = "INSERT INTO Personne(type,nom,prenom,tel,emailContact,adresse,description) VALUES (?,?,?,?,?,?,?)";
    $req = $this->db->prepare($sql);
    $params = array(
      $personne->getType(),
      $personne->getNom(),
      $personne->getPrenom(),
      $personne->getTel(),
      $personne->getEmailcontact(),
      $personne->getAdresse(),
      $personne->getDescription()
    );
    $res = $req->execute($params);
    if ($res === FALSE) {
      die("createUser : Requête impossible !");
    }
    return $this->db->readPersonneById($personne->id);
  }

  // function createPersonne($personne) {
  //   $sql = "INSERT INTO Personne(nomp,prenom,tel,emailContact) VALUES (?,?,?,?)";
  //   $req = $this->db->prepare($sql);
  //   $params = array(
  //     $personne->nomp,
  //     $personne->prenom,
  //     $personne->tel,
  //     $personne->emailContact
  //   );
  //   $res = $req->execute($params);
  //   if ($res === FALSE) {
  //     die("createUser : Requête impossible !");
  //   }
  //   return $this->db->readUserById($personne->id);
  // }

  private function updatePersonne($personne) {
    $p = $this->db->readPersonneById($personne->getIdPersonne());
    if ($p != null) {
      $sql = "UPDATE Personne set (type,nom, prenom, tel, emailContact, adresse,description) = (?,?,?,?,?,?,?) where id = ?";
      $req = $this->db->prepare($sql);
      $params = array(
      $personne->getType(),
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
    return $this->db->readPersonneById($personne->id);
  } else {
    throw DAOException("La personne n'existe pas");
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
  $res = $req->fetchAll(PDO::FETCH_CLASS,"Utilisateur");
  return (isset($res[0])?$res[0]:null); // retourne le premier resultat s'il existe, sinon null
}

private function createUtilisateur($utilisateur) { // peut etre mettre une personne en paramettre
  $u = $this->db->readUserByEmail($utilisateur->email);
  if ($u == null) {
    $this->createPersonne($utilisateur);
    $sql = "INSERT INTO Users(emailCompte,mdp,googletoken) VALUES (?,?,?)";
    $req = $this->db->prepare($sql);
    $params = array(
      $utilisateur->getEmailCompte(),
      $utilisateur->getMdp(),
      $utilisateur->getGoogleToken()
    );
    $res = $req->execute($params);
    if ($res === FALSE) {
      die("createUser : Requête impossible !");
    }
    return $this->db->readUserById($utilisateur->idUtilisateur);
  } else {
    throw DAOException("utilisateur déjà présent dans la base (l'id en tous cas)");
  }
}

// function createUtilisateur($utilisateur) { // peut etre mettre une personne en paramettre
//   $u = $this->db->readUserByEmail($utilisateur->email);
//   if ($u == null) {
//     $sql = "INSERT INTO Users(emailCompte,mdp) VALUES (?,?)";
//     $req = $this->db->prepare($sql);
//     $params = array(
//       $utilisateur->emailCompte,
//       $utilisateur->mdp
//     );
//     $res = $req->execute($params);
//     if ($res === FALSE) {
//       die("createUser : Requête impossible !");
//     }
//     return $this->db->readUserById($utilisateur->idUtilisateur);
//   } else {
//     throw DAOException("utilisateur déjà présent dans la base (l'id en tous cas)");
//   }
// }

// aussi la PERSONNE
function updateUtilisateur($utilisateur) {
  $u = $this->db->readUserByEmail($utilisateur->email);
  if ($u != null) {
    $this->updatePersonne($utilisateur);
    $sql = "UPDATE Utilisateur set (emailCompte,mdp) = (?,?) where idUtilisateur = ?";
    $req = $this->db->prepare($sql);
    $params = array(
      $utilisateur->getEmailCompte(),
      $utilisateur->getMdp(),
      $utilisateur->getIdUtilisateur()
    );
    $res = $req->execute($params);
    if ($res === FALSE) {
      die("updateUtilisateur : Requête impossible !");
    }
    return $this->db->readUserById($utilisateur->idUtilisateur);
  } else {
    throw DAOException("Utilisateur non présent dans la base de données !");
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

  $user = $this->readUtilisateurByIdNoClasse($id);
  $res = $req->fetchAll(PDO::FETCH_ASSOC);
  if(isset($res[0]) && isset( $user)){
    $Booker = new Booker($user["idpersonne"],$user["nom"], $user["prenom"], $user["emailcontact"], $user["tel"], $user["adresse"],$user["emailcompte"],$user["mdp"],$user["googletoken"]);
    return $Booker;
  }
}


function createBooker($booker) {
  $b = $this->db->readBookerById($booker->idBooker);
  if ($b == null) {
    $this->createUtilisateur($booker);
    $sql = "INSERT INTO Booker(idBooker) VALUES (?)";
    $req = $this->db->prepare($sql);
    $params = array(
      $booker->idBooker
    );
    $res = $req->execute($params);
    if ($res === FALSE) {
      die("createBooker : Requête impossible !");
    }
    return $this->db->readBookerById($utilisateur->id);
  } else {
    throw DAOException("Booker déjà présent dans la base");
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
  $o = $this->db->readBookerById($organisateur->$idOrganisateur);
  if ($o == null) {
    $this->createUtilisateur($organisateur);
    $sql = "INSERT INTO $organisateur(idOrganisateur) VALUES (?)";
    $req = $this->db->prepare($sql);
    $params = array(
      $organisateur->idOrganisateur
    );
    $res = $req->execute($params);
    if ($res === FALSE) {
      die("createOrganisateur : Requête impossible !");
    }
    return $this->db->createOrganisateur($organisateur->id);
  } else {
    throw DAOException("Organisateur déjà présent dans la base");
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
    throw DAOException("Groupe déjà présent dans la base");
  }
}

function updateGroupe($groupe) {
  $g = $this->db->readGroupeById($groupe->idGroupe);
  if ($g != null) {
    $sql = "UPDATE Groupe set (nomg,lienImageOfficiel,facebook,google,twitter,lecteur,soundcloud,ficheCom,adresse) = (?,?,?,?,?,?,?,?,?) where idGroupe = ?";
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
    throw DAOException("Groupe non présent dans la base de données !");
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
    $Artist = new Utilisateur($pers["idpersonne"],$pers["type"],$pers["nom"], $pers["prenom"], $pers["emailcontact"], $pers["tel"], $pers["adresse"],$res[0]["datenaissance"],$res[0]["paiement"],$res[0]["rib"],$res[0]["ordrecheque"]);
    return $Artist;
  }else{
    return NULL;
  }}

function createArtiste($artiste) {
  $a = $this->db->readArtisteById($artiste->idArtiste);
  if ($a == null) {
    $this->createPersonne($artiste);
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
    throw DAOException("Artiste déjà présent dans la base");
  }
}

function updateArtiste($artiste) {
  $a = $this->db->readArtisteById($utilisateur->idUtilisateur);
  if ($a != null) {
    $this->updatePersonne($artiste);
    $sql = "UPDATE Artiste set (dateNaissance, paiement, rib, ordreCheque) = (?,?,?,?) where idArtiste = ?";
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
    throw DAOException("Artiste non présent dans la base de données !");
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
    throw DAOException("Lieu déjà présent dans la base (l'id en tous cas)");
  }
}

function updateLieu($lieu) {
  $l = $this->db->readLieuById($lieu->idLieu);
  if ($l != null) {
    $sql = "UPDATE Lieu set (noml,description,pays,region,ville,codePostal,adresse,latitude,longitude) = (?,?,?,?,?,?,?,?,?) where idLieu = ?";
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
    throw DAOException("Lieu non présent dans la base de données !");
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
    $sql = "INSERT INTO Manifestation(nom,type,description,datedebut,datefin,lienImageOfficiel,facebook,google,twitter,ficheCom,createur,lieu) VALUES (?,?,?,?,?,?,?,?,?,?,?,?)";
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
    return $this->db->readManifestationById($manifestation->idManif);
  } else {
    throw DAOException("Manifestation déjà présent dans la base (l'id en tous cas)");
  }
}

function updateManifestation($manifestation) {
  $m = $this->db->readUserByEmail($manifestation->idManif);
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
    return $this->db->readManifestationById($manifestation->idManif);
  } else {
    throw DAOException("Manifestation non présent dans la base de données !");
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
    throw DAOException("Document déjà présent dans la base (l'id en tous cas)");
  }
}


function updateDocument($document) {
  $d = $this->db->readDocumentById($document->idDoc);
  if ($d != null) {
    $sql = "UPDATE Document set (idUtilisateur,nom,dateCreation,dateModif,emplacement) = (?,?,?,?,?) where idDoc= ?";
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
    throw DAOException("Document non présent dans la base de données !");
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
    throw DAOException("Evenenement déjà présent dans la base (l'id en tous cas)");
  }
}

function updateEvenenement($evenenement) {
  $e = $this->db->readEvenenementById($evenenement->idEvene);
  if ($e != null) {
    $sql = "UPDATE Evenenement set (dateDebut,dateFin,heureDebut,heureFin,description,Lieu,createur) = (?,?,?,?,?,?,?) where idEvene = ?";
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
    throw DAOException("Evenement non présent dans la base de données !");
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
    throw DAOException("Contact déjà présent dans la base (l'id en tous cas)");
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
      die("updateContact : Requête impossible !");
    }
    return $this->db->readContactByPrimary($contact->idContact,$contact->proprietaire);
  } else {
    throw DAOException("Contact non présent dans la base");
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
    throw DAOException("Contact_Systeme déjà présent dans la base");
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
      die("createContactSystem : Requête impossible !");
    }
    return $this->db->readContactSystemByPrimary($contactSyst->contactProprietaire,$contactSyst->idContact);
  } else {
    throw DAOException("Contact_Systeme non présent dans la base");
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
      die("deleteContactSystemByPrimary : Requête impossible !");
    }
    return true;
  } else {
    throw DAOException("Contact_Systeme non présent dans la base, supression impossible");
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
    throw DAOException("Contact_exterieur déjà présent dans la base");
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
      die("updateContactExterieur : Requête impossible !");
    }
    return $this->db->readContactExterieurByPrimary($contactSyst->contactProprietaire,$contactSyst->idContact);
  } else {
    throw DAOException("Contact_exterieur non présent dans la base");
  }
}

function DeleteContactExterieur($contactProprietaire, $idContact) {
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
      die("DeleteContactExterieur : Requête impossible !");
    }
    return true;
  } else {
    throw DAOException("Contact_exterieur non présent dans la base");
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
    throw DAOException("Contact_Evenement déjà présent dans la base");
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
    throw DAOException("Creneau déjà présent dans la base");
  }
}

function updateCreneau($creneau) {
  $c = $this->db->readCreneauByPrimary($creneau->idManif,$creneau->idGroupe,$creneau->heureDebut);
  if ($c != null) {
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
    throw DAOException("Creneau non présent dans la base");
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
    die("readGroupeArtisteByPrimary : Requête impossible !"); // erreur dans la requête
  }
  $res = $req->fetchAll(PDO::FETCH_CLASS,"Groupe_Artiste");
  return (isset($res[0])?$res[0]:null);
}

function readListGroupeByArtiste($idArtiste) {
  $sql = "SELECT * FROM Groupe_Artiste WHERE idArtiste = ?"; // requête
  $req = $this->db->prepare($sql);
  $params = array(
    $idArtiste
  );
  $res = $req->execute($params);
  if ($res === FALSE) {
    die("readGroupeByArtiste : Requête impossible !"); // erreur dans la requête
  }
  $res = $req->fetchAll(PDO::FETCH_ASSOC);
  return (isset($res[0])?$res[0]:null);
}

function readArtisteByGroupe($idGroupe) {
  $sql = "SELECT * FROM Groupe_Artiste WHERE idGroupe=?"; // requête
  $req = $this->db->prepare($sql);
  $params = array(
    $idGroupe
  );
  $res = $req->execute($params);
  if ($res === FALSE) {
    die("readArtisteByGroupe : Requête impossible !"); // erreur dans la requête
  }
  $res = $req->fetchAll(PDO::FETCH_ASSOC);
  return (isset($res[0])?$res[0]:null);
}

function createGroupeArtiste($idGroupe,$idArtiste) {
  $c = $this->db->readCreneauByPrimary($idGroupe,$idArtiste);
  if ($c == null) {
    $sql = "INSERT INTO Groupe_Artiste(idGroupe,idArtiste) VALUES (?,?)";
    $req = $this->db->prepare($sql);
    $params = array(
      $idGroupe,
      $idArtiste
    );
    $res = $req->execute($params);
    if ($res === FALSE) {
      die("createGroupeArtiste : Requête impossible !");
    }
    return $this->db->readGroupeArtisteByPrimary($idGroupe,$idArtiste);
  } else {
    throw DAOException("Groupe_Artiste déjà présent dans la base");
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
    die("readNegociationById : Requête impossible !"); // erreur dans la requête
  }
  $res = $req->fetchAll(PDO::FETCH_CLASS,"Negociation");
  return (isset($res[0])?$res[0]:null);
}

function createNegociation($negociation) {
  $n = $this->db->readNegociationById($negociation->idNegociation);
  if ($n == null) {
    $sql = "INSERT INTO Negociation(idBooker,idManif,idGroupe,idOrganisateur,etat) VALUES (?,?,?,?,?)";
    $req = $this->db->prepare($sql);
    $params = array(
      $negociation->idBooker,
      $negociation->idManif,
      $negociation->idGroupe,
      $negociation->idOrganisateur,
      $negociation->etat,
    );
    $res = $req->execute($params);
    if ($res === FALSE) {
      die("createNegociation : Requête impossible !");
    }
    return $this->db->readNegociationById($negociation->idNegociation);
  } else {
    throw DAOException("Negociation déjà présente dans la base");
  }
}

function updateNegociation($negociation) {
  $n = $this->db->readNegociationById($negociation->idNegociation);
  if ($n != null) {
    $sql = "UPDATE Negociation set (idBooker,idManif,idGroupe,idOrganisateur,etat) = (?,?,?,?,?) where idNegociation = ?";
    $req = $this->db->prepare($sql);
    $params = array(
      $negociation->idBooker,
      $negociation->idManif,
      $negociation->idGroupe,
      $negociation->idOrganisateur,
      $negociation->etat,
      $negociation->idNegociation
    );
    $res = $req->execute($params);
    if ($res === FALSE) {
      die("updateNegociation : Requête impossible !");
    }
    return $this->db->readNegociationById($negociation->idNegociation);
  } else {
    throw DAOException("Negociation non présente dans la base");
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
    die("readNegociationDocumentsByPrimary : Requête impossible !"); // erreur dans la requête
  }
  $res = $req->fetchAll(PDO::FETCH_CLASS,"Negociation_Documents");
  return (isset($res[0])?$res[0]:null);
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
      die("createNegociationDocuments : Requête impossible !");
    }
    return $this->db->readNegociationDocumentsByPrimary($negociationDoc->idNegociation,$negociationDoc->idDoc);
  } else {
    throw DAOException("Negociation_Documents déjà présente dans la base");
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
    die("readNegociationMessagesByPrimary : Requête impossible !"); // erreur dans la requête
  }
  $res = $req->fetchAll(PDO::FETCH_CLASS,"Negociation_Messages");
  return (isset($res[0])?$res[0]:null);
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
      die("createNegociationMessages : Requête impossible !");
    }
    return $this->db->readNegociationMessagesByPrimary($negociationMess->idNegociation,$negociationMess->idMessage);
  } else {
    throw DAOException("Negociation_Messages déjà présente dans la base");
  }
}

// ===================== Message_Tag =====================

// Message_Tag(idMessage,tel,nom)
function readMessageTagByPrimary($nomt,$idMessage) {
  $sql = "SELECT * FROM Message_Tag WHERE  nomt=? and idMessage=?"; // requête
  $req = $this->db->prepare($sql);
  $params = array(
    $nomt,
    $idMessage
  );
  $res = $req->execute($params);
  if ($res === FALSE) {
    die("readMessageTagByPrimary : Requête impossible !"); // erreur dans la requête
  }
  $res = $req->fetchAll(PDO::FETCH_CLASS,"Message_Tag");
  return (isset($res[0])?$res[0]:null);
}

function createMessageTag($messageTag) {
  $m = $this->db->readMessageTagByPrimary($messageTag->nomt,$messageTag->idMessage);
  if ($m == null) {
    $sql = "INSERT INTO Message_Tag(idMessage,tel,nomt) VALUES (?,?,?)";
    $req = $this->db->prepare($sql);
    $params = array(
      $messageTag->idMessage,
      $messageTag->tel,
      $messageTag->nomt
    );
    $res = $req->execute($params);
    if ($res === FALSE) {
      die("createMessageTag : Requête impossible !");
    }
    return $this->db->readMessageTagByPrimary($messageTag->nomt,$messageTag->idMessage);
  } else {
    throw DAOException("Message_Tag déjà présente dans la base");
  }
}

function updateMessageTag($message) {
  $m = $this->db->readMessageTagByPrimary($messageTag->nomt,$messageTag->idMessage);
  if ($m != null) {
    $sql = "UPDATE Message_Tag set (tel) = (?) where nomt=? and idMessage=? ";
    $req = $this->db->prepare($sql);
    $params = array(
      $messageTag->tel,
      $messageTag->nomt,
      $messageTag->idMessage
    );
    $res = $req->execute($params);
    if ($res === FALSE) {
      die("updateMessageTag : Requête impossible !");
    }
    return $this->db->readMessageTagByPrimary($messageTag->nomt,$messageTag->idMessage);
  } else {
    throw DAOException("Message_Tag non présent dans la base");
  }
}

function deleteMessageTagByPrimary($nomt,$idMessage) {
  $m = $this->db->readMessageTagByPrimary($nomt,$idMessage);
  if ($m != null) {
    $sql = "DELETE FROM Message_Tag where nomt=? and idMessage=? ";
    $req = $this->db->prepare($sql);
    $params = array(
      $messageTag->nomt,
      $messageTag->idMessage
    );
    $res = $req->execute($params);
    if ($res === FALSE) {
      die("deleteMessageTagByPrimary : Requête impossible !");
    }
    return true;
  } else {
    throw DAOException("Message_Tag non présent dans la base, supression impossible");
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
    die("readBookerGroupeByPrimary : Requête impossible !"); // erreur dans la requête
  }
  $res = $req->fetchAll(PDO::FETCH_CLASS,"Booker_Groupe");
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
    die("readListGroupeByBooker : Requête impossible !"); // erreur dans la requête
  }
  $res = $req->fetchAll(PDO::FETCH_ASSOC);
  return (isset($res[0])?$res[0]:null);
}

function readListBookerByGroupe($idGroupe) {
  $sql = "SELECT idBooker FROM Booker_Groupe WHERE  idGroupe=?"; // requête
  $req = $this->db->prepare($sql);
  $params = array(
    $idGroupe
  );
  $res = $req->execute($params);
  if ($res === FALSE) {
    die("readListBookerByGroupe : Requête impossible !"); // erreur dans la requête
  }
  $res = $req->fetchAll(PDO::FETCH_ASSOC);
  return (isset($res[0])?$res[0]:null);
}


function createBookerGroupe($idBooker, $idGroupe) {
  $b = $this->db->readBookerGroupeByPrimary($idBooker,$idGroupe);
  if ($b == null) {
    $sql = "INSERT INTO Booker_Groupe(idGroupe,idBooker) VALUES (?,?)";
    $req = $this->db->prepare($sql);
    $params = array(
      $idGroupe,
      $idBooker
    );
    $res = $req->execute($params);
    if ($res === FALSE) {
      die("createBookerGroupe : Requête impossible !");
    }
    return $this->db->readBookerGroupeByPrimary($idBooker,$idGroupe);
  } else {
    throw DAOException("Booker_Groupe déjà présente dans la base");
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
  $res = $req->fetchAll(PDO::FETCH_CLASS,"Groupe_Genre");
  return (isset($res[0])?$res[0]:null);
}

function createGroupeGenre($groupeGenre) {
  $g = $this->db->readGroupeGenreByPrimary($groupeGenre->idGroupe,$groupeGenre->nomg);
  if ($g == null) {
    $sql = "INSERT INTO Groupe_Genre(idGroupe,nomg) VALUES (?,?)";
    $req = $this->db->prepare($sql);
    $params = array(
      $groupeGenre->idGroupe,
      $groupeGenre->nomg
    );
    $res = $req->execute($params);
    if ($res === FALSE) {
      die("createGroupeGenre : Requête impossible !");
    }
    return $this->db->readGroupeGenreByPrimary($groupeGenre->idGroupe,$groupeGenre->nomg);
  } else {
    throw DAOException("Groupe_Genre déjà présente dans la base");
  }
}

function deleteGroupeGenreByPrimary($idGroupe, $nomGrenre) {
  $g = $this->db->readGroupeGenreByPrimary($idGroupe,$nomg);
  if ($g != null) {
    $sql = "DELETE FROM Groupe_Genre WHERE idGroupe = ? and nomg = ?";
    $req = $this->db->prepare($sql);
    $params = array(
      $idGroupe,
      $nomg
    );
    $res = $req->execute($params);
    if ($res === FALSE) {
      die("deleteGroupeGenreByPrimary : Requête impossible !");
    }
    return true;
  } else {
    throw DAOException("Groupe_Genre non présente dans la base, suppression impossible");
  }
}

// ===================== Manifestation_Genre =====================

// Manifestation_Genre(idManif,nomGenre)
function readManifestationGenreByPrimary($idManif, $nomGenre) {
  $sql = "SELECT * FROM Groupe_Genre WHERE  idManif=? and nomg=?"; // requête
  $req = $this->db->prepare($sql);
  $params = array(
    $idManif,
    $nomGrenre
  );
  $res = $req->execute($params);
  if ($res === FALSE) {
    die("readManifestationGenreByPrimary : Requête impossible !"); // erreur dans la requête
  }
  $res = $req->fetchAll(PDO::FETCH_CLASS,"Manifestation_Genre");
  return (isset($res[0])?$res[0]:null);
}

function createManifestationGenre($manifestationGenre) {
  $m = $this->db->readManifestationGenreByPrimary($manifestationGenre->idManif,$manifestationGenre->nomg);
  if ($m == null) {
    $sql = "INSERT INTO Manifestation_Genre(idManif,nomGenre) VALUES (?,?)";
    $req = $this->db->prepare($sql);
    $params = array(
      $manifestationGenre->idManif,
      $manifestationGenre->nomg
    );
    $res = $req->execute($params);
    if ($res === FALSE) {
      die("createManifestationGenre : Requête impossible !");
    }
    return $this->db->readManifestationGenreByPrimary($manifestationGenre->idManif,$manifestationGenre->nomg);
  } else {
    throw DAOException("Manifestation_Genre déjà présente dans la base");
  }
}

function deleteManifestationGenreByPrimary($idManif, $nomGenre) {
  $m = $this->db->readManifestationGenreByPrimary($idManif,$nomGenre);
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
    throw DAOException("Manifestation_Genre non présente dans la base, supression impossible");
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
    die("readContactTagByPrimary : Requête impossible !"); // erreur dans la requête
  }
  $res = $req->fetchAll(PDO::FETCH_CLASS,"Contact_Tag");
  return (isset($res[0])?$res[0]:null);
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
      die("createContactTag : Requête impossible !");
    }
    return $this->db->readContactTagByPrimary($contactTag->nomt,$contactTag->idContact,$contactTag->proprietaire);
  } else {
    throw DAOException("Contact_Tag déjà présente dans la base");
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
      die("deleteContactTagbyPrimary : Requête impossible !");
    }
    return true;
  } else {
    throw new DAOException("Contact_Tag non présent dans la base, supression impossible");
  }
}

// ===================== Message =====================

// Message(idMessage,expediteur,receveur,etat,contenu,date,nom,reponse)
function readMessageById($idMessage,$idConversation) {
  $sql = "SELECT * FROM Message WHERE  idMessage = ? AND idConversation = ?"; // requête
  $req = $this->db->prepare($sql);
  $params = array(
    $idMessage,
    $idConversation
  );
  $res = $req->execute($params);
  if ($res === FALSE) {
    die("readMessageById : Requête impossible !"); // erreur dans la requête
  }
  $res = $req->fetchAll(PDO::FETCH_CLASS,"Message");
  return (isset($res[0])?$res[0]:null);
}

function readMessagesRecusByUtilisateur($idUtilisateur) {
  $sql = "SELECT * FROM Message WHERE  receveur = ? AND etat >= 5"; // requête
  $req = $this->db->prepare($sql);
  $params = array(
    $idUtilisateur
  );
  $res = $req->execute($params);
  if ($res === FALSE) {
    die("readMessagesRecusByReceveur : Requête impossible !"); // erreur dans la requête
  }
  $res = $req->fetchAll(PDO::FETCH_CLASS,"Message");
  return (isset($res[0])?$res:null);
}

function readMessagesEnvoyesByUtilisateur($idUtilisateur) {
  $sql = "SELECT * FROM Message WHERE  expediteur = ? AND etat >= 5"; // requête
  $req = $this->db->prepare($sql);
  $params = array(
    $idUtilisateur
  );
  $res = $req->execute($params);
  if ($res === FALSE) {
    die("readMessagesEnvoyesByExpediteur : Requête impossible !"); // erreur dans la requête
  }
  $res = $req->fetchAll(PDO::FETCH_CLASS,"Message");
  return (isset($res[0])?$res:null);
}

function readMessagesBrouillonsByUtilisateur($idUtilisateur) {
  $sql = "SELECT * FROM Message WHERE  expediteur = ? AND etat = 0"; // requête
  $req = $this->db->prepare($sql);
  $params = array(
    $idUtilisateur
  );
  $res = $req->execute($params);
  if ($res === FALSE) {
    die("readMessagesBrouillonsByExpediteur : Requête impossible !"); // erreur dans la requête
  }
  $res = $req->fetchAll(PDO::FETCH_CLASS,"Message");
  return (isset($res[0])?$res:null);
}

function createMessage($message) {
  $c = $this->readMessageById($message->getID(),$idConversation->getIdConversation());
  if ($c == null) {
    $sql = "INSERT INTO Message(idConversation,expediteur,receveur,etat,contenu,`date`,nom) VALUES (?,?,?,?,?,?,?)";
    $req = $this->db->prepare($sql);
    $params = array(
      $message->getIdConversation(),
      $message->getExpediteur(),
      $message->getDestinataire(),
      $message->getEtat(),
      $message->getContenu(),
      $message->getDatenvoi(),
      $message->getNom()
    );
    $res = $req->execute($params);
    if ($res === FALSE) {
      die("createMessage : Requête impossible !");
    }
    return $this->readMessageById($message->getID());
  } else {
    throw new DAOException("idMessage déjà présente dans la base");
  }
}

function updateMessage($message) {
  $m = $this->readMessageById($message->getID(),$message->getIdConversation());
  if ($m != null) {
    $sql = "UPDATE Message SET etat = ? where idMessage= ? AND idConversation = ?";
    $req = $this->db->prepare($sql);
    $params = array(
      $message->getEtat(),
      $message->getID(),
      $message->getIdConversation()
    );
    $res = $req->execute($params);
    if ($res === FALSE) {
      die("updateMessage : Requête impossible !");
    }
    return $this->readMessageById($message->getID());
  } else {
    throw new DAOException("idMessage non présent dans la base");
  }
}

}

?>
