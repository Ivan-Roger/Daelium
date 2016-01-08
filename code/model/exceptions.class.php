<?php
  class DAOException extends Exception {
    function __construct($message,$code=0) {
      Exception::__construct($message,$code);
    }
  }

  class DAOUserException extends DAOException {
    function __construct($message,$code=0) {
      DAOException::__construct($message,$code);
    }
  }

?>
