<?php
   if (!isset($data))
      header("Location:"."../");
?>
<!DOCTYPE html>
<html>
<header>
  <meta charset="utf-8"/>
  <title>Daelium | Work in Progress</title>
  <link rel="stylesheet" href="../data/css/bootstrap.min.css"/>
  <link rel="stylesheet" href="../data/css/signin.css"/>
  <link rel="icon" type="image/png" href="../data/img/D.png" />
</header>
<body>
  <div class="container">
    <div class="card card-container">
      <h2>Vous êtes ?</h2>
      <HR>
        <form class="form-signin">
          <div class="fonction">
          <div class="btn-group" data-toggle="buttons" id="fonction">
            <label class="btn btn-success active">
              <input type="radio" name="options" id="option1" value="on" checked> Booker
            </label>
            <label class="btn btn-success">
              <input type="radio" name="options" id="option2" value="off"> Organisateur
            </label>
          </div>
          <HR>
            <button class="btn btn-lg btn-primary btn-block btn-signin" type="submit">Suivant</button>
          </div>
        </div>
        </form><!-- /form -->
      </div><!-- /card-container -->
    </div><!-- /container -->
    <?php include("../view/include/footer.view.php"); ?>
    <script src="../data/js/jQuery.min.js"></script>
        <script src="../data/js/bootstrap.min.js"></script>
  </body>

  </body>
</html>
