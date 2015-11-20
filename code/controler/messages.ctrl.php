<?php
  session_start();

  $data['alert']['type'] = "danger";
  $data['alert']['icon'] = "exclamation-sign";
  $data['alert']['message'] = "Site en cours de construction ... Risques d'erreurs ><'";

  $data['page']="Messages";

  if (isset($_SESSION['userType']))
    $data['type'] = $_SESSION['userType'];
  else
    $data['type'] = "Booker";

  include("../view/messages.view.php");
?>
