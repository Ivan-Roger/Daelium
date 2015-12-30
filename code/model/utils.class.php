<?php
require_once("../model/DAO.class.php");
  /***************
   *    Utils    *
   ***************/

   function initPage($page,$alerts=null) {
     $data['page']=$page;
     $dao = new DAO();

     $listenotif = array();
     $listenotif = $dao->readListeNotificationUseridNoRead( $_SESSION["user"]["ID"]);

     $data["notifications"] = array();
       foreach ($listenotif as $key => $value) {
         $data["notifications"][$key]['titre'] = $value->getTypeEcrit();
       }

     $data['alerts']=array();
     if ($alerts!=null)
       $data['alerts'] = array_merge($data['alerts'],$alerts);

     if (isset($_SESSION['user']['type']))
       $data['type'] = $_SESSION['user']['type'];
     else
       $data['type'] = "booker";


     return $data;
   }

   function randomId($n = 20) {
     // $n : longueur de la chaine d'ID.
     $chars = str_split("abcdefghijqlmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789"); // les differents charactères possibles
     shuffle($chars);
     for ($i=0; $i<$n; $i++) {
       $res[] = $chars[rand(0,count($chars)-1)];
     }
     return $res;
   }

   function calendar($timestamp=null) {
     $timestamp = ($timestamp!=null?$timestamp:mktime(0,0,0,date("n"),1,date("Y")));
     $date = getdate($timestamp);
     $length=getMonthLength($date['mon'],$date['year']);
     $wday = fr_wday($date['wday']); // conversion des jours de la semaine en FR
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

   function fr_wday($wday) {
     // wday par défaut : de 0(Dimanche) à 6(Samedi)
     $wday = $wday-1; // on décale : de -1(Dimanche) à 5(Samedi)
     $wday = ($wday<0?6:$wday); // si c'est un dimanche (-1) alors 6 sinon on change pas
     return $wday;
   }

   function getMonthLength($month,$year) {
     if ($month==2) {
       $bi = (($year%4 == 0 && $year%100 != 0) || ($year%400 == 0));
       $length = ( $bi ? 29 : 28 ); // annee bisextile si :    divisible par 4 et non par 100   /OU/   divisible par 400
     } else if($month%2 == 0) {
       $length = 31;
     } else {
       $length = 30;
     }
     return $length;
   }

   function newAlert($message,$type="info",$icon="") {
     $data['type'] = $type;
     $data['icon'] = $icon;
     $data['message'] = $message;
     return $data;
   }
?>
