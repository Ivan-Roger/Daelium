<?php
   if (!isset($data))
      header("Location:"."../");
?>
<!DOCTYPE html>
<html>
<header>
  <meta charset="utf-8"/>
  <title>Daelium | Inscription</title>
  <link rel="stylesheet" href="../data/css/bootstrap.min.css"/>
  <link rel="stylesheet" href="../data/css/signin.css"/>
  <link rel="icon" type="image/png" href="../data/img/D.png" />
</header>
<body>
  <div class="container">
    <div class="card card-container">
      <h2>Vous êtes ?</h2>
      <HR>
        <form class="form-signin" action="../controler/inscription.ctrl.php" method="POST">
          <div class="fonction">
          <div class="btn-group" data-toggle="buttons" id="fonction">
            <label class="btn btn-success active">
              <input type="radio" name="typeuser" id="option1" value="0" checked> Booker
            </label>
            <label class="btn btn-success">
              <input type="radio" name="typeuser" id="option2" value="1"> Organisateur
            </label>
          </div>
          <input type="hidden" name="etape" value="2"/>
          <HR>
            <button class="btn btn-lg btn-primary btn-block btn-signin" type="submit">Suivant</button>
          </div>
        </div>
        </form><!-- /form -->
      </div><!-- /card-container -->
    </div><!-- /container -->
    <script src="../data/js/jQuery.min.js"></script>
        <script src="../data/js/bootstrap.min.js"></script>
  </body>

  </body>
</html>
