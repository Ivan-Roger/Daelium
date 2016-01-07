<?php
if (!isset($data))
header("Location:"."../");
?>
<!DOCTYPE html>
<html>
<head>
  <?php include("../view/include/includes.view.php"); ?>
  <link rel="stylesheet" href="../data/css/artiste.css">
  <title>Dælium - Artiste - <?= $data['nom']?></title>
</head>
<body>
  <?php include("../view/include/header.view.php"); ?>
  <section class="col-lg-offset-2 col-lg-8">
    <form class="form-horizontal" role="form" method="post" action="../controler/artiste_edit.ctrl.php?action=new">
      <div class="col-lg-12">
        <div class="panel panel-default">
          <div class="panel-heading">Artiste  <?= $data['nom']?></div>
          <div class="panel-body">
            <div class="form-group">
              <label class="control-label col-sm-3" for="name">Nom de l'artiste *:</label>
              <div class="col-sm-9">
                <input type="text" id="name" name="name" class="form-control" required placeholder="Nom" value="<?= $data['nom']?>"/>
              </div>
            </div>

            <div class="form-group">
              <label class="control-label col-sm-3" for="pname">Prenom de l'artiste :</label>
              <div class="col-sm-9">
                <input type="text" id="pname" name="pname" class="form-control" placeholder="Prenom" value="<?= $data['prenom']?>"/>
              </div>
            </div>

            <div class="form-group">
              <label class="control-label col-sm-3" for="daten">Date de naissance :</label>
              <div class="col-sm-9">
                <input type="date" id="daten" name="daten" class="form-control" value="<?= $data['dateNaissance']?>" />
              </div>
            </div>

            <div class="form-group">
              <label class="control-label col-sm-3" for="mail">Email :</label>
              <div class="col-sm-9">
                <input type="email" id="mail" name="mail" class="form-control"  value="<?= $data['email']?>"/>
              </div>
            </div>

            <div class="form-group">
              <label class="control-label col-sm-3" for="ntel">Numero de telephone :</label>
              <div class="col-sm-9">
                <input type="tel" id="ntel" name="ntel" class="form-control" value="<?= $data['telephone']?>"/>
              </div>
            </div>

            <div class="form-group">
              <label class="control-label col-sm-3" for="adrr">Adresse :</label>
              <div class="col-sm-9 well">

                <label class="control-label col-sm-2" for="adresse">Adresse :</label>
                <div class="col-sm-10">
                  <input type="text" id="adresse" name="adresse"  class="form-control" value="<?= $data['adresse']?>" />
                </div>
                <label class="control-label col-sm-2" for="codepostal">Code postal :</label>
                <div class="col-sm-2">
                  <input type="text" id="codepostal" name="codepostal"  class="form-control" value="<?= $data['codepostal']?>" />
                </div>
                <label class="control-label col-sm-2" for="ville">Ville * :</label>
                <div class="col-sm-6">
                  <input type="text" id="ville" name="ville" required="required" class="form-control"value="<?= $data['ville']?>" />
                </div>
                <label class="control-label col-sm-2" for="region">Region :</label>
                <div class="col-sm-4">
                  <input type="text" id="region" name="region"  class="form-control" value="<?= $data['pays']?>" />
                </div>
                <label class="control-label col-sm-2" for="pays">Pays * :</label>
                <div class="col-sm-4">
                  <input type="text" id="pays" name="pays" required="required" class="form-control"  value="<?= $data['region']?>"/>
                </div>
                <label class="control-label col-sm-2" for="latitude">Latitude :</label>
                <div class="col-sm-4">
                  <input type="text" id="latitude" name="latitude"  class="form-control" value="<?= $data['latitude']?>" />
                </div>
                <label class="control-label col-sm-2" for="longitude">Longitude :</label>
                <div class="col-sm-4">
                  <input type="text" id="longitude" name="longitude" class="form-control"  value="<?= $data['longitude']?>"/>
                </div>


              </div>
            </div>

            <div class="form-group">
              <label class="control-label col-sm-3" for="payment">Paiement :</label>
              <div class="col-sm-9 btn-group" data-toggle="buttons" id="fonction">
                <label class="btn btn-default <?php if($data['paiement'] == "Cheque"){ echo "active"; } ?>">
                  <input type="radio" name="payment" id="payment" value="ch" <?php if($data['paiement'] == "Cheque"){ ?> checked <?php } ?>> Chèque
                </label>
                <label class="btn btn-default  <?php if($data['paiement'] == "Virement"){ echo "active"; } ?>">
                  <input type="radio" name="payment" id="payment" value="vi" <?php if($data['paiement'] == "Virement"){ ?> checked <?php } ?>>  Virement
                </label>
                <label class="btn btn-default <?php if($data['paiement'] == "Espece"){ echo "active"; } ?>">
                  <input type="radio" name="payment" id="payment" value="es" <?php if($data['paiement'] == "Espece"){ ?> checked <?php } ?>> Espece
                </label>
              </div>
            </div>

            <div class="form-group">
              <label class="control-label col-sm-3" for="vir">IBAN :</label>
              <div class="col-sm-9">
                <input type="text" id="vir" name="vir" class="form-control" placeholder="Si Virement" value="<?= $data['IBAN']?>" />
              </div>
            </div>

            <div class="form-group">
              <label class="control-label col-sm-3" for="ord">Ordre :</label>
              <div class="col-sm-9">
                <input type="text" id="ord" name="ord" class="form-control" placeholder="Si cheque, si vide garde le nom" value="<?= $data['ordre']?>"/>
              </div>
            </div>

          </div>
        </div>
        <input type="hidden" name="idgroupe" value="<?= $data['idgroupe'] ?>"/>
        <div class="pull-right">
          <input class="btn btn-default" type="reset" value="Annuler">
          <input class="btn btn-primary" type="submit"  value="Ajouter">
        </div>
</form>
</section>
<?php include("../view/include/footer.view.php"); ?>
</body>
</html>
