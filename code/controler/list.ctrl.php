<?php
  session_start();

  $data['alert']['type'] = "danger";
  $data['alert']['icon'] = "exclamation-sign";
  $data['alert']['message'] = "Site en cours de construction ... Risques d'erreurs ><'";

  $data['page']="List";

  include("../view/list.view.php");
?>
