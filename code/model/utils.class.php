<?php
  /***************
   *    Utils    *
   ***************/

   function randomId($n = 20) {
     // $n : longueur de la chaine d'ID.
     $chars = "abcdefghijqlmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789_-.*#"; // les differents charactères possibles
     shuffle($chars);
     for ($i=0, $i<$n; $i++) {
       $res[] = $chars[rand(0,count($chars)-1)];
     }
     return $res;
   }
?>
