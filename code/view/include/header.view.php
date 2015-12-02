  <header class="page-header" style="margin: 0px; border: none;">
    <nav class="nav navbar-default container-fluid">
      <!-- Brand and toggle get grouped for better mobile display -->
      <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse" aria-expanded="false">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href=".."><img src="../data/img/D.png"/><span class="text">Daelium</span></a>
      </div>

      <div class="collapse navbar-collapse" id="navbar-collapse">
        <!-- Menu des differentes section du site  plus module de recherche-->
        <ul class="nav navbar-nav">
          <li<?php echo($data['page']=="Main"?" class='active'":"") ?>><a href="../controler/main.ctrl.php"><span class="glyphicon glyphicon-home"></span>Accueil</a></li>
          <li<?php echo($data['page']=="Profile"?" class='active'":"") ?>><a href="../controler/profile.ctrl.php"><span class="glyphicon glyphicon-user"></span>Profil</a></li>
          <li<?php echo($data['page']=="Documents"?" class='active'":"") ?>><a href="../controler/documents.ctrl.php"><span class="glyphicon glyphicon-file"></span>Documents</a></li>
          <li<?php echo($data['page']=="Agenda"?" class='active'":"") ?>><a href="../controler/agenda.ctrl.php"><span class="glyphicon glyphicon-calendar"></span>Agenda</a></li>
          <li<?php echo($data['page']=="Messages"?" class='active'":"") ?>><a href="../controler/messages.ctrl.php"><span class="glyphicon glyphicon-envelope"></span>Messagerie</a></li>
          <li<?php echo($data['page']=="List"?" class='active'":"") ?>><a href="../controler/list.ctrl.php"><span class="glyphicon glyphicon-list-alt"></span>Annuaire</a></li>
          <?php if($data["type"] == "booker") { ?>
            <li<?php echo($data['page']=="Artistes"?" class='active'":"") ?>><a href="../controler/artistes.ctrl.php"><span class="glyphicon glyphicon-music"></span>Mes artistes</a></li>
          <?php } else { ?>
            <li<?php echo($data['page']=="Evenements"?" class='active'":"") ?>><a href="../controler/evenements.ctrl.php"><span class="glyphicon glyphicon-folder-open"></span>Mes evenements</a></li>
          <?php }?>
        </ul>
        <ul class="nav navbar-nav navbar-right">
          <li>
            <form class="navbar-form navbar-right" method="GET" action="#">
              <div class="input-group">
                <input type="text" class="form-control" placeholder="Je cherche ...">
                <span class="input-group-btn">
                  <button class="btn btn-primary" type="button">Rechercher</button>
                </span>
              </div>
            </form>
          </li>
          <!-- Menu de l'uilisateur-->
          <li id="notifs" class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-bell"></span><sup><span class="badge badge-sm">3</span></sup></a>
            <ul class="dropdown-menu">
              <li><b>Notifications</b></li>
              <li class="bg-info"><a href="#">Invitation</a></li>
              <li class="bg-info"><a href="#">Invitation</a></li>
              <li class="bg-info"><a href="#">Invitation</a></li>
            </ul>
          </li>
          <li id="settings" class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-cog"></span><span class="text">Paramétres <span class="caret"></span></span></a>
            <ul class="dropdown-menu">
              <li>
                <?php if($data["type"]=="booker") { ?>
                  <p class="colsm-12"><span class="glyphicon glyphicon-ok"></span>Booker</p>
                <?php } else { ?>
                  <a href="../controler/main.ctrl.php?type=booker">Booker</a>
                <?php } ?>
              </li>
              <li>
                <?php if($data["type"]=="organisateur") { ?>
                  <p class="colsm-12"><span class="glyphicon glyphicon-ok"></span>Organisateur</p>
                <?php } else { ?>
                  <a href="../controler/main.ctrl.php?type=organisateur">Organisateur</a>
                <?php } ?>
              </li>
              <li role="separator" class="divider"></li>
              <li><a href="#">Separated link</a></li>
              <li role="separator" class="divider"></li>
              <li><a href="#">One more separated link</a></li>
            </ul>
          </li>
          <li id="profile" class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-user"></span><span class="text">Compte <span class="caret"></span></span></a>
            <ul class="dropdown-menu">
              <li><a href="../controler/profile.ctrl.php">Voir le profil</a></li>
              <li role="separator" class="divider"></li>
              <li><a href="../view/nolog.view.php"><span class="glyphicon glyphicon-off"></span>Déconnexion</a></li>
            </ul>
          </li>
        </ul>
      </div>
    </nav>
    <div class="alerts">
    <?php foreach ($data['alert'] as $key => $alert) { ?>
      <p id="alert<?= $key ?>" class="alert alert-<?= $alert['type'] ?> alert-dismissible fade in" onclick="$('#alert<?= $key ?>').alert('close')"><span class="glyphicon glyphicon-<?= $alert['icon'] ?>"></span><span class="text"><?= $alert['message'] ?></span><button class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></p>
    <?php } ?>
    </div>
  </header>
