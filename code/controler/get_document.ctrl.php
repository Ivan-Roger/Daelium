<?php
  require_once("../model/utils.class.php");
  require_once("../model/DAO.class.php");
  $dao = new DAO();

  if (isset($_GET['t'])) {
    // Verifier le token(t) dans la DB ou si propriètaire
    $doc = $dao->readAccesDocumentByToken($_GET['t']);
    if ($doc!=null && ( !isset($doc['expire']) || date($doc['expire'])<=date("Y-m-d") )) {
      $data['download']['filename'] = basename($doc['document']);
      $data['download']['path'] = $doc['document'];
      $dao->deleteAccesDocument($doc['token']);
    } else {
      $data['error']['title'] = "Interdit";
      $data['error']['back'] = "../controler/documents.ctrl.php";
      $data['error']['message'] = "Le jeton d'accès est invalide. Vous n'avez pas accès a ce fichier.";
    }
  }

  if (isset($data['download'])) {
    header('Content-Description: File Transfer');// Téléchargement automatique
    header('Content-Type: application/octet-stream');
    header('Content-Disposition: '.'attachment; filename="'.$data['download']['filename'].'"');
    header('Content-Transfer-Encoding: binary');
    header('Expires: 0');
    header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
    header('Pragma: public');
    header('Content-Length: '.filesize($data['download']['path']));

    ob_clean();
    flush();
    readfile($data['download']['path']); // On envoie le fichier
    exit;
  } else {
    header("Location: "."..");
  }
?>
