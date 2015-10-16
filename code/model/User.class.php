<?php

  class User {
    private $id;
    private $firstName;
    private $lastName;
    private $pseudo;
    private UserProfile $profil;
    private Message[] $msg;
    private Note[] $notes;

    private function __construct() {

    }
  }

?>
