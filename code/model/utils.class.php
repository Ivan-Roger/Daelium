<?php
  /***************
   *    Utils    *
   ***************/

   function randomId($n = 20) {
     // $n : longueur de la chaine d'ID.
     $chars = "abcdefghijqlmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789_-.*#"; // les differents charactères possibles
     shuffle($chars);
     for ($i=0; $i<$n; $i++) {
       $res[] = $chars[rand(0,count($chars)-1)];
     }
     return $res;
   }

   function calendar($timestamp=null) {
     $timestamp = ($timestamp!=null?$timestamp:mktime(0,0,0,date("n"),1,date("Y")));
     $date = getdate($timestamp);
     $length=0;
     if ($date['mon']==2) {
       $bi = (($date['year']%4 == 0 && $date['year']%100 != 0) || ($date['year']%400 == 0));
       $length = ( $bi ? 29 : 28 ); // annee bisextile si :    divisible par 4 et non par 100   /OU/   divisible par 400
     } else if($date['mon']%2 == 0) {
       $length = 31;
     } else {
       $length = 30;
     }
     // wday par défaut : de 0(Dimanche) à 6(Samedi)
     $wday = $date['wday']-1; // on décale : de -1(Dimanche) à 5(Samedi)
     $wday = ($wday<0?6:$wday); // si c'est un dimanche (-1) alors 6 sinon on change pas

     $i=0;
     for ($l=0; $i<($length+$wday); $l++) {
       $res[$l]['id'] = date("W",$timestamp)+$l;
       for ($c=0; $c<7; $c++) {
         $n = $i-$wday+1; // jour actuel
         $res[$l]['days'][$c] = (($n<1) || ($n>$length)?0:$n);
         $i++;
       }
     }

     return $res;
   }
?>
