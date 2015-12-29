<?php
session_start();
include("include/auth.ctrl.php");
require_once("../model/utils.class.php");
require_once("../model/DAO.class.php");
$data = initPage("Compte");
$dao = new DAO();
include_once("../view/parametre.view.php");


?>
