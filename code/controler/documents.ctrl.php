<?php
  session_start();
  include("include/auth.ctrl.php");
  require_once("../model/utils.class.php");
  require_once("../model/DAO.class.php");
  $data = initPage("Documents");
  $dao = new DAO();
  $ROOT = "../data/users/u".$_SESSION['user']['ID']."/files";
  $WEBSITE = "localhost/Daelium/code";

  if (isset($_GET['file'])) { // Lecture d'un document d'un autre utilisateur
    if (is_file($ROOT.$_GET['file'])) {
      $data['download']['filename'] = basename($_GET['file']);
      $data['download']['path'] = $ROOT.$_GET['file'];
    } else {
      $data['error']['title'] = "Inexistant";
      $data['error']['back'] = "../controler/documents.ctrl.php";
      $data['error']['message'] = "Ce fichier n'existe pas.";
    }
  } else if (isset($_GET['upload'])) { // Enregistrement d'un fichier
    try {
      // Undefined | Multiple Files | $_FILES Corruption Attack
      // If this request falls under any of them, treat it invalid.
      if (!isset($_FILES['file'])) {
        throw new RuntimeException('Invalid parameters.');
      }

      $dirPath = $_GET['folder'];
      if (!(strpos('.',$dirPath)===FALSE))
        throw new RuntimeException('Wrong upload path.');

      // Check $_FILES['file']['error'] value.
      switch ($_FILES['file']['error']) {
        case UPLOAD_ERR_OK:
          break;
        case UPLOAD_ERR_NO_FILE:
          throw new RuntimeException('No file sent.');
        case UPLOAD_ERR_INI_SIZE:
        case UPLOAD_ERR_FORM_SIZE:
          throw new RuntimeException('Exceeded filesize limit.');
        default:
          throw new RuntimeException('Unknown errors.');
      }

      if ($_FILES['file']['size'] > 100000000) {
        throw new RuntimeException('Exceeded filesize limit.');
      }

      if ('php' == $ext = pathinfo($_FILES['file']['name'],PATHINFO_EXTENSION))
        throw new RuntimeException('Invalid extension.');

      $name = preg_replace("/[^\w\\n ()-:\[\]\/]'/",'_',pathinfo($_FILES['file']['name'],PATHINFO_FILENAME));
      $data['info'] = $name;

      if (is_file($ROOT.$dirPath.'/'.$name.'.'.$ext))
        throw new RuntimeException('File already exists.');

      if (!move_uploaded_file($_FILES['file']['tmp_name'],$ROOT.$dirPath.'/'.$name.'.'.$ext)) {
        throw new RuntimeException('Failed to move uploaded file.');
      }
      $data['request']['code'] = 200;
      $data['request']['message'] = "File is uploaded successfully.";
    } catch (RuntimeException $e) {
      $data['request']['code'] = 000;
      $data['request']['message'] = $e->getMessage();
      $data['error']['message'] = $e->getMessage();
    }
  } else if (isset($_GET['create'])) { // Création d'un dossier
    $dirPath = $_GET['folder'];
    if (is_dir($ROOT.$dirPath)) {
      $data['request']['code'] = 000;
      $data['request']['message'] = "Folder already exists.";
      $data['error']['message'] = "Folder already exists.";
    } else {
      if (mkdir($ROOT.$dirPath)) {
        $data['request']['code'] = 200;
        $data['request']['message'] = "Folder created successfully";
      } else {
        $data['request']['code'] = 000;
        $data['request']['message'] = "Couldn't create folder";
        $data['error']['message'] = "Couldn't create folder";
      }
    }
  } else if (isset($_GET['delete'])) { // Création d'un dossier
    $dirPath = $_GET['target'];
    $data['info'] = "Deleting : ".$ROOT.$dirPath." !";
    if (recursive_remove($ROOT.$dirPath,true)) {
      $data['request']['code'] = 200;
      $data['request']['message'] = "Directory deleted successfully";
    } else {
      $data['request']['code'] = 000;
      $data['request']['message'] = "Couldn't delete item";
      $data['error']['message'] = "Couldn't delete item";
    }
  } else if (isset($_GET['share'])) { // Création d'un dossier
    if (!isset($_GET['target'])) {
      $data['request']['code'] = 000;
      $data['request']['message'] = "Missing target parameter";
      $data['error']['message'] = "Missing target parameter";
    } else {
      $dirPath = $_GET['target'];
      $token = $dao->createAccesDocument($ROOT.$dirPath);
      $data['link'] = $WEBSITE."/controler/get_document.ctrl.php?t=".$token;
    }
  } else { // Affichage du dossier utilisateur
    $data['path'][0]['path'] = "?";
    $data['path'][0]['name'] = "Racine";
    if (isset($_GET['folder'])) { // Sous-dossier spécifique
      if (is_dir($ROOT.$_GET['folder'])) {
        $dirPathElements = explode('/',$_GET['folder']);
        array_shift($dirPathElements); // On enlève la Racine
        $pathStr = "";
        foreach ($dirPathElements as $pathElem) {
          $pathStr .= '/'.$pathElem;
          $folderInfo['path'] = "?folder=".$pathStr;
          $folderInfo['name'] = $pathElem;
          $data['path'][] = $folderInfo;
        }

        $dirPath = $_GET['folder'];
      } else {
        $data['error']['title'] = "Inexistant";
        $data['error']['back'] = "../controler/documents.ctrl.php";
        $data['error']['message'] = "Ce dossier n'existe pas.";
      }
    } else { // Racine
      $dirPath = "";
    }
    $dir = scandir($ROOT.$dirPath);
    array_shift($dir); // On enlève le `.`
    array_shift($dir); // On enlève le `..`
    $data['dir'] = Array();
    foreach ($dir as $key => $elem) {
      if (strpos($elem,".")===FALSE) {
        $data['dir'][$key]['type'] = "folder-open";
        $data['dir'][$key]['link'] = "?folder=".$dirPath.'/'.$elem;
      } else {
        $data['dir'][$key]['type'] = "file";
        $data['dir'][$key]['date'] = date("d/m/Y H:i:s", filectime($ROOT.$dirPath.'/'.$elem));
        $data['dir'][$key]['size'] = human_filesize(filesize($ROOT.$dirPath.'/'.$elem)).'o';
        $data['dir'][$key]['link'] = "?file=".$dirPath.'/'.$elem;
      }
      $data['dir'][$key]['name'] = $elem;
      $data['dir'][$key]['target'] = $dirPath.'/'.$elem;
    }
    $data['dirName'] = $data['path'][count($data['path'])-1]['name'];
    $data['upPath'] = ($dirPath!=""?$dirPath:"/");
  }

  if (!isset($_GET['ajax'])) {
    if (isset($data['error']))
      if (isset($_SESSION['user'])) {
        include("../view/error.view.php");
      } else {
        http_response_code(403);
      }
    else if (isset($data['download'])) {
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
    } else
      include("../view/documents.view.php");
  } else {
    header("Content-Type:"."application/json");
    echo(json_encode($data,JSON_PRETTY_PRINT));
  }
?>
