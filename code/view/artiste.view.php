<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8" />
  <link rel="stylesheet" href="../data/css/bootstrap.css">
  <link rel="stylesheet" href="../data/css/common.css">
  <link rel="stylesheet" href="../data/css/artistes.css">
  <title>Dælium - Artiste - <?= $data["artiste"]['nomscene']?></title>
</head>
<body>
  <?php include("../view/include/header.view.php"); ?>
  <section class="col-lg-offset-1 col-lg-10">
    <?php if($data["vue"] == "fiche"){ ?>

      <h2><?= $data["artiste"]['prenom'].'  '.$data["artiste"]['nom'] ?></h2><br>
      <p>Nom de scene <?= $data["artiste"]['nomscene'] ?></p><br>
      <p>Né le <?= $data["artiste"]['dateNaissance'] ?></p><br>
      <p>Téléphone <?= $data["artiste"]['telephone'] ?></p><br>
      <p>Adresse <?= $data["artiste"]['adresse'] ?></p><br>
      <p>Paiement par
        <?php if (isset($data["IBAN"])) { ?>
          virement IBAN : <?php $data["artiste"]["IBAN"] ?></p>
          <?php } else if (isset($data["ordre"])) { ?>
            chèque à l'ordre : <?php $data["artiste"]["ordre"] ?></p>
            <?php } else { ?>
              espèce</p>
              <?php } ?>
              <br>

              <a class ="btn btn-primary" href="#"> Voir fiche </a>
              <a class ="btn btn-warning" href="#"> Modifier </a>
              <a class ="btn btn-danger" href="#"> Suprimer </a>
              <a class ="btn btn-default" href="../controler/artistes.ctrl.php"> Retour </a>




              <?php }elseif ($data["vue"] == "form") { ?>
                <h1>Nouvel Artiste/Groupe</h1>
                <form class="form-horizontal" role="form">
                  <div class="col-lg-offset-3 col-lg-6">
                  <div class="panel panel-default">
                    <div class="panel-heading">Artiste/Groupe</div>
                    <div class="panel-body">
                      <div class="form-group">
                        <label class="control-label col-sm-4" for="name">Nom de scene :</label>
                        <div class="col-sm-8">
                          <input id="name" name="name" class="form-control" placeholder="Nom"/>
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="control-label col-sm-4" for="name">Type :</label>
                        <div class="col-sm-8">
                          <div class="btn-group" data-toggle="buttons" id="fonction">
                            <label class="btn btn-default active">
                              <input type="radio" name="options" id="option1" value="ar" checked> Artiste
                            </label>
                            <label class="btn btn-default">
                              <input type="radio" name="options" id="option2" value="gr"> Groupe
                            </label>
                          </div>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-sm-4" for="name">Nombre de membre :</label>
                        <div class="col-sm-8">
                          <input type="number" id="num" name="name" class="form-control" value="1"/>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-sm-4" for="name">Image de couverture :</label>
                        <div class="col-sm-8">
                          <input type="file" id="num" name="name" class="form-control"/>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                  <!-- Si groupe alors Demander plusieurs fois les infos sur les different membres -->

                  <div class="col-lg-6">
                  <div class="panel panel-default">
                    <div class="panel-heading">Artiste 1</div>
                    <div class="panel-body">
                      <div class="form-group">
                        <label class="control-label col-sm-5" for="name">Nom du membre/artiste :</label>
                        <div class="col-sm-7">
                          <input type="text" id="name" name="name" class="form-control" placeholder="Nom"/>
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="control-label col-sm-5" for="pname">Prenom du membre/artiste :</label>
                        <div class="col-sm-7">
                          <input type="text" id="pname" name="pname" class="form-control" placeholder="Prenom"/>
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="control-label col-sm-5" for="daten">Date de naissance :</label>
                        <div class="col-sm-7">
                          <input type="date" id="daten" name="daten" class="form-control" />
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="control-label col-sm-5" for="mail">Email :</label>
                        <div class="col-sm-7">
                          <input type="email" id="mail" name="mail" class="form-control" />
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="control-label col-sm-5" for="ntel">Numero de telephone :</label>
                        <div class="col-sm-7">
                          <input type="tel" id="ntel" name="ntel" class="form-control" />
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="control-label col-sm-5" for="adrr">Adresse :</label>
                        <div class="col-sm-7">
                          <input type="text" id="adrr" name="adrr" class="form-control" placeholder="Adresse" />
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="control-label col-sm-5" for="name">Paiement :</label>
                        <div class="col-sm-7 btn-group" data-toggle="buttons" id="fonction">
                          <label class="btn btn-default active">
                          <input type="radio" name="options" id="option1" value="ch" checked> Chèque
                        </label>
                        <label class="btn btn-default">
                          <input type="radio" name="options" id="option2" value="vi"> Virement
                        </label>
                        <label class="btn btn-default">
                          <input type="radio" name="options" id="option2" value="es"> Espece
                        </label>
                      </div>
                    </div>

                    <div class="form-group">
                      <label class="control-label col-sm-5" for="vir">IBAN :</label>
                      <div class="col-sm-7">
                        <input type="text" id="vir" name="vir" class="form-control" placeholder="Si Virement" />
                      </div>
                    </div>

                    <div class="form-group">
                      <label class="control-label col-sm-5" for="ord">Ordre :</label>
                      <div class="col-sm-7">
                        <input type="text" id="ord" name="ord" class="form-control" placeholder="Si cheque, si vide garde le nom"/>
                      </div>
                    </div>

                    </div>
                  </div>
                </div>

                  <!--deuxieme artiste -->
                  <div class=" col-lg-6">
                  <div class="panel panel-default">
                    <div class="panel-heading">Artiste 2</div>
                    <div class="panel-body">
                      <div class="form-group">
                        <label class="control-label col-sm-5" for="name">Nom du membre/artiste :</label>
                        <div class="col-sm-7">
                          <input type="text" id="name" name="name" class="form-control" placeholder="Nom"/>
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="control-label col-sm-5" for="pname">Prenom du membre/artiste :</label>
                        <div class="col-sm-7">
                          <input type="text" id="pname" name="pname" class="form-control" placeholder="Prenom"/>
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="control-label col-sm-5" for="daten">Date de naissance :</label>
                        <div class="col-sm-7">
                          <input type="date" id="daten" name="daten" class="form-control" />
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="control-label col-sm-5" for="mail">Email :</label>
                        <div class="col-sm-7">
                          <input type="email" id="mail" name="mail" class="form-control" />
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="control-label col-sm-5" for="ntel">Numero de telephone :</label>
                        <div class="col-sm-7">
                          <input type="tel" id="ntel" name="ntel" class="form-control" />
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="control-label col-sm-5" for="adrr">Adresse :</label>
                        <div class="col-sm-7">
                          <input type="text" id="adrr" name="adrr" class="form-control" placeholder="Adresse" />
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="control-label col-sm-5" for="name">Paiement :</label>
                        <div class="col-sm-7 btn-group" data-toggle="buttons" id="fonction">
                          <label class="btn btn-default active">
                          <input type="radio" name="options" id="option1" value="ch" checked> Chèque
                        </label>
                        <label class="btn btn-default">
                          <input type="radio" name="options" id="option2" value="vi"> Virement
                        </label>
                        <label class="btn btn-default">
                          <input type="radio" name="options" id="option2" value="es"> Espece
                        </label>
                      </div>
                    </div>

                    <div class="form-group">
                      <label class="control-label col-sm-5" for="vir">IBAN :</label>
                      <div class="col-sm-7">
                        <input type="text" id="vir" name="vir" class="form-control" placeholder="Si Virement" />
                      </div>
                    </div>

                    <div class="form-group">
                      <label class="control-label col-sm-5" for="ord">Ordre :</label>
                      <div class="col-sm-7">
                        <input type="text" id="ord" name="ord" class="form-control" placeholder="Si cheque, si vide garde le nom"/>
                      </div>
                    </div>

                    </div>
                  </div>
                </div>


                  <div class="pull-right">
                    <input class="btn btn-primary" type="button" onclick="alert('Hello World!')" value="Annuler">
                    <input class="btn btn-primary" type="button" onclick="alert('Hello World!')" value="Ajouter">
                  </div>

                </form>







                <?php }else { ?>
                  <h1>Erreur 404</h1>
                  <p>L'artiste n'existe pas</p>
                  <?php  } ?>
                </section>
                <?php include("../view/include/footer.view.php"); ?>
                <script src="http://code.jquery.com/jquery-1.11.3.min.js"></script>
                <script src="../data/js/bootstrap.min.js"></script>
              </body>
              </html>
