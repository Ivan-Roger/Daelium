<?php
  if (!isset($data))
    header("Location:"."../");
?>
<!DOCTYPE html>
<html>
  <head>
    <?php include("../view/include/includes.view.php"); ?>
    <link rel="stylesheet" href="../data/css/notifications.css">
    <title>Dælium - Notifications</title>
  </head>
  <body>
    <?php include("../view/include/header.view.php"); ?>
    <section class="col-lg-offset-1 col-lg-10">
      <div>
        <h1>Notifications</h1>
        <div>
           <table class="table">
             <thead>
                <tr><th></th><th class="text-right">Titre</th><th class="text-center">Etat</th><th>Message</th><th></th></tr>
             </thead>
             <tbody>
               <?php foreach ($data["notifs"] as $key => $value) { ?>
                 <tr data-id="<?= $value['id'] ?>" class="notif-item <?= $value['etat'] ?> <?= ($value['select']?"selected":"") ?>">
                    <td class="text-center"><span class="fa fa-<?= $value['icon'] ?>"></span></td>   <td class="notif-item-title text-right"><?= $value['titre'] ?></td>   <td class="text-center"><span class="led <?php if($value['etat'] == "new"){ echo "led-blue "; }else{ echo "led-off"; } ?> fa fa-circle"></span></td>
                    <td><?= $value['message'] ?></td> <td><button type="button" data-id="<?= $value['id'] ?>" class="close"><span class="times" aria-hidden="true">&times;</span><span class="loading fa fa-refresh fa-spin"></span></button></td>
                 </tr>
               <?php } ?>
             </tbody>
           </table>
        </div>
      </div>
    </section>
    <?php include("../view/include/footer.view.php"); ?>
    <script src="../data/js/notifications.js"></script>
  </body>
</html>
