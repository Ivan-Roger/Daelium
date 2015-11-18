<?php
  session_start();
  // meh

  $data['alert']['type'] = "danger";
  $data['alert']['icon'] = "exclamation-sign";
  $data['alert']['message'] = "Site en cours de construction ... Risques d'erreurs ><'";

  $data['page']="Documents";

  include("../view/documents.view.php");
?>
