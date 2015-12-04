<?php
  require_once('Utilisateur.class.php')

  class Booker extends Utilisateur {
    private $idBooker;

    function __construct($id = NULL) {
      $this->idBooker = $id;
    }
  }
?>
