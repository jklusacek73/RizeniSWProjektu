<?php
session_start();
if((isset($_SESSION['user_is_logged'])) && ($_SESSION['editor'] == true)){
 require_once('connect.php');
 @$vysledek = $mysqli->query("SELECT * FROM clanek WHERE id_clanku = $_POST[clanek];");
 $zaznam = $vysledek->fetch_array();
 if($zaznam['id_clanku'] !== null){
   $timestamp = strtotime($_POST['datum']);
   $datum = date('Y-m-d', $timestamp);
   @$vysledek = $mysqli->query("UPDATE clanek SET datum_recenzniho_rizeni = '$datum', stav = 'Stanoveno datum zahájení recenzního řízení' WHERE id_clanku = $_POST[clanek];");
   @$vysledek2 = $mysqli->query("SELECT MAX(id) AS 'maximum' FROM historieClanek;");
   $zaznam2 = $vysledek2->fetch_array();
   $id = $zaznam2['maximum'];
   if( $id == null){
     $id = 1;
   }else{
     $id++;
   }
   @$vysledek3 = $mysqli->query("INSERT INTO historieClanek VALUES ($id, $_POST[clanek], 2, '$datum');");
   $_SESSION['typ'] = "success";
   $_SESSION['zprava'] =  "Datum zahájení recenzního řízení se podařilo uložit.";
   @$vysledekAutor = $mysqli->query("SELECT * FROM uzivatel WHERE id_uzivatele = $zaznam[odpovedny_uzivatel];");
   $autor = $vysledekAutor->fetch_array();
   $headers = "MIME-Version: 1.0" . "\r\n";
   $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
   $headers .= 'From: Logos Polytechnikos <' . $mailFrom . '>' . "\r\n";
   $message = "
     <html>
     <head>
       <title>Datum zahájení recenzního řízení</title>
     </head>
     <body>
     <p>Dobrý den,</p>
     <p>K Vámi nahranému článku <b>$zaznam[nazev_clanku]</b> bylo přidáno datum zahájení recenzního řízení.</p>
     <p>Sledujte stav Vašeho nahraného článku přímo v informačním systému.</p>
     <p>Váš tým časopisu Logos Polytechnikos</p>
     </body>
     </html>
     ";
   mail($autor['e_mail'],'Datum zahájení recenzního řízení',$message,$headers);
   header("Location:clanek_podrobnosti.php?id=$_POST[clanek]");
 }else{
   $_SESSION['typ'] = "danger";
   $_SESSION['zprava'] =  "Datum zahájení recenzního řízení nelze uložit.";
   header("Location:clanek_podrobnosti.php?id=$_POST[clanek]");
 }
}else{
 header("Location:uvod.php");
}
  ?>
