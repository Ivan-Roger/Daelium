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
               <tr class="notif-item  new">
                  <td class="bg-info text-center"><span class="fa fa-info"></span></td>   <td class="notif-item-title text-right">Invitation</td>   <td class="text-center"><span class="led led-blue fa fa-circle"></span></td>
                  <td>Vous êtes invité a participer a l'evenement <a href="../controler/evenement.ctrl.php?id=a8se85qdf5rf5g4">Bilbao BBK Live</a></td> <td><button type="button" class="close"><span aria-hidden="true">&times;</span></button></td>
               </tr>
               <tr class="notif-item  new">
                  <td class="bg-info text-center"><span class="fa fa-quote-right"></span></td>   <td class="notif-item-title text-right">Message</td>   <td class="text-center"><span class="led led-blue fa fa-circle"></span></td>
                  <td>Vous avez recu un message : <a href="../controler/messages.ctrl.php?id=a8se85qdf5rf5g4">voir</a> ...</td> <td><button type="button" class="close"><span aria-hidden="true">&times;</span></button></td>
               </tr>
               <tr class="notif-item  new">
                  <td class="bg-warning text-center"><span class="fa fa-bell-o"></span></td>   <td class="notif-item-title text-right">Rappel</td>   <td class="text-center"><span class="led led-blue fa fa-circle"></span></td>
                  <td>Rendez vous avez Jean-Marc : <a href="../controler/agenda.ctrl.php?evt=a8se85qdf5rf5g4">voir</a> ...</td> <td><button type="button" class="close"><span aria-hidden="true">&times;</span></button></td>
               </tr>
               <tr class="notif-item  old">
                  <td class="text-center"><span class="fa fa-bell-o"></span></td>   <td class="notif-item-title text-right">Rappel</td>   <td class="text-center"><span class="led led-off fa fa-circle"></span></td>
                  <td>Dinner avec Les petits gars : <a href="../controler/agenda.ctrl.php?evt=a8se85qdf5rf5g4">voir</a> ...</td> <td></td>
               </tr>
               <tr class="notif-item  old">
                  <td class="text-center"><span class="fa fa-info"></span></td>   <td class="notif-item-title text-right">Invitation</td>   <td class="text-center"><span class="led led-off fa fa-circle"></span></td>
                  <td>Vous êtes invité a participer a l'evenement <a href="../controler/evenement.ctrl.php?evt=a8se85qdf5rf5g4">Paris Live</a> ...</td> <td></td>
               </tr>
             </tbody>
           </table>
        </div>
      </div>
    </section>
    <?php include("../view/include/footer.view.php"); ?>
  </body>
</html>
