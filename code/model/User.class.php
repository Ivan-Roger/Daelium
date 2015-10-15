<?php

class User {
  private $id;
  private $firstName;
  private $lastName;
  private $pseudo;
  private Profile $profil;
  private Message[] $msg;
  private Note[] $notes;

  private function __construct() {

  }
}

?>
