<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8" />
  <link rel="stylesheet" href="../data/css/bootstrap.css">
  <link rel="stylesheet" href="../data/css/artiste.css">
  <link rel="stylesheet" href="../data/css/common.css">
  <title>Dælium - Artiste - <?= $data["artistegroupe"]['nomscene']?></title>
</head>
<body>
  <?php include("../view/include/header.view.php"); ?>
  <section class="col-lg-offset-1 col-lg-10">
    <?php if($data["vue"] == "fiche"){ ?>
      <h1>Fiche <?= $data["artistegroupe"]['nomscene']?></h1>
      <a class ="btn btn-primary" href="#"> Voir fiche </a>
      <a class ="btn btn-default" href="../controler/artistes.ctrl.php"> Retour </a>
    </br>

  </br>
  <div class="panel panel-default">
    <div class="panel-body">
      <table class="table">
        <colgroup>
          <col/>
          <col/>
        </colgroup>
        <tbody>
          <tr>
            <th>Nom de scene <?= $data['artistegroupe']['type']?> :</th><td><?= $data["artistegroupe"]['nomscene']?></td>
          </tr>
          <tr>
            <th>Nombre de membres :</th><td><?= $data['artistegroupe']['nb']?> </td>
          </tr>
          <tr>
            <th>Image de couverture :</th><td>A mettre</td>
          </tr>
        </tbody>
      </table>
      <div class="pull-right">
        <?php if($data['artistegroupe']['type'] == "Groupe"){ ?>
          <a class ="btn btn-primary" href="#"> Ajouter un Artiste </a>
          <?php } ?>
          <a class ="btn btn-warning" href="#"> Modifier </a>
          <a class ="btn btn-danger" href="#"> Suprimer </a>
        </div>
      </div>
    </div>

    <?php if($data['artistegroupe']['type'] == "Groupe"){ ?>
      <h2>Liste des membre du groupe</h2>
      <?php } else{ ?>
        <h2>Detail de l'artiste</h2>
        <?php }?>

        <?php for ($i=0; $i < $data['artistegroupe']['nb'] ; $i++){ ?>
          <div class="col-lg-6">
            <div class="panel panel-default">
              <div class="panel-heading"><?= $data["artiste"]['nom'][$i]?> <?= $data['artiste']['prenom'][$i]?></div>
              <div class="panel-body">
                <table class="table">
                  <colgroup>
                    <col/>
                    <col/>
                  </colgroup>
                  <tbody>
                    <tr>
                      <th>Nom :</th><td><?= $data["artiste"]['nom'][$i]?></td>
                    </tr>
                    <tr>
                      <th>Prenom :</th><td><?= $data['artiste']['prenom'][$i]?> </td>
                    </tr>
                    <tr>
                      <th>Date de naissance :</th><td><?= $data["artiste"]['dateNaissance'][$i] ?></td>
                    </tr>
                    <tr>
                      <th>Email :</th><td><?= $data["artiste"]['email'][$i] ?></td>
                    </tr>
                    <tr>
                      <th>Telephone :</th><td><?= $data["artiste"]['telephone'][$i] ?></td>
                    </tr>
                    <tr>
                      <th>Adresse :</th><td><?= $data["artiste"]['adresse'][$i] ?></td>
                    </tr>
                    <tr>
                      <th>Mode de reversement du salaire :</th><td><?= $data['artiste']['paiement'][$i] ?></td>
                    </tr>
                    <?php if ($data['artiste']['paiement'][$i] == "Virement") { ?>
                      <tr>
                        <th>IBAN :</th><td><?= $data['artiste']['IBAN'][$i] ?></td>
                      </tr>
                      <?php } else if($data['artiste']['paiement'][$i] == "Cheque"){  ?>
                        <tr>
                          <th>Ordre du cheque :</th><td>A mettre</td>
                        </tr>
                        <?php } ?>
                      </tbody>
                    </table>
                    <div class="pull-right">
                      <a class ="btn btn-warning" href="#"> Modifier </a>
                      <a class ="btn btn-danger" href="#"> Suprimer du Groupe </a>
                    </div>
                  </div>
                </div>
              </div>
              <?php }  ?>
              <!-- Fin affichage des membre du groupe -->
              <?php }elseif ($data["vue"] == "form") { ?>
                <h1>Nouvel Artiste/Groupe</h1>
                <form class="form-horizontal" role="form">
                  <div class="col-lg-offset-3 col-lg-6">
                    <div class="panel panel-default">
                      <div class="panel-heading">Artiste/Groupe</div>
                      <div class="panel-body">
                        <div class="form-group">
                          <label class="control-label col-sm-4" for="nomscene">Nom de scene :</label>
                          <div class="col-sm-8">
                            <input id="nomscene" name="nomscene" class="form-control" placeholder="Nom de scene"/>
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
                          <label class="control-label col-sm-4" for="nb">Nombre de membre :</label>
                          <div class="col-sm-8">
                            <input type="number" id="nb" name="nb" class="form-control" value="1"/>
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="control-label col-sm-4" for="img">Image de couverture :</label>
                          <div class="col-sm-8">
                            <input type="file" id="img" name="img" class="form-control"/>
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
