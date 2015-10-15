<?php

class DAO {
  private $db;
  private $user;

  function __construct() {
    try {
      $this->db = new PDO("")
    } catch (Exception $e) {
      echo("Error : ".$e->getMessage());
    }
  }
}

?>
