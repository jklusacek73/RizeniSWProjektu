<?php
session_start();
if((isset($_SESSION['user_is_logged'])) && ($_SESSION['editor'] == true) && ($_SESSION['id_uzivatele'] == $_POST['user'])){
 require_once('connect.php');
 @$vysledekKomentar = $mysqli->query("UPDATE clanek SET komentar = '$_POST[comment]', stav = 'K článku byl přidán komentář editora' WHERE id_clanku = $_POST[clanek]");
 $vysledekAktualizace = false;
 if(isset($_POST['aktualizace'])){
   @$vysledekAktualizace = $mysqli->query("UPDATE clanek SET povolit_aktualizace = TRUE WHERE id_clanku = $_POST[clanek]");
 }else{
   @$vysledekAktualizace = $mysqli->query("UPDATE clanek SET povolit_aktualizace = FALSE WHERE id_clanku = $_POST[clanek]");
 }
 @$vysledek2 = $mysqli->query("SELECT MAX(id) AS 'maximum' FROM historieClanek;");
 $zaznam2 = $vysledek2->fetch_array();
 $id = $zaznam2['maximum'];
 if( $id == null){
   $id = 1;
 }else{
   $id++;
 }
 $datum = date('Y-m-d');
 @$vysledek3 = $mysqli->query("INSERT INTO historieClanek VALUES ($id, $_POST[clanek], 5, '$datum');");
 if($vysledekKomentar && $vysledekAktualizace && $vysledek3){
   $_SESSION['typ'] = 'success';
   $_SESSION['zprava'] = 'Byl úspěšně přidán komentář editora k článku.';
   @$vysledek = $mysqli->query("SELECT * FROM clanek JOIN uzivatel ON odpovedny_uzivatel = id_uzivatele WHERE id_clanku = $_POST[clanek]");
   $zaznam = $vysledek->fetch_array();
   $headers = "MIME-Version: 1.0" . "\r\n";
   $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
   $headers .= 'From: Logos Polytechnikos <' . $mailFrom . '>' . "\r\n";
   $message = "
     <html>
     <head>
       <title>K Vašemu článku byl přidán komentář editora</title>
     </head>
     <body>
     <p>Dobrý den,</p>
     <p>k Vašemu článku <b>$zaznam[nazev_clanku]</b> byl přidán komentář editora v tomto znění:</p>
     <p>$_POST[comment]</p>";
    if(isset($_POST['aktualizace'])){
      $message .= "<p>Prosíme aktualizujte svůj článek podle požadavků</p>";
    }else{
      $message .= "<p>Již nemusíte aktualizovat článek.</p>";
    }
    $message .= "<p>O dalším postupu při vydávání tohoto článku Vás budeme informovat prostřednictvím e-mailové adresy</p>
    <p>Váš tým časopisu Logos Polytechnikos</p>
    </body>
     </html>
     ";
   mail($zaznam['e_mail'],'K Vašemu článku byl přidán komentář editora',$message,$headers);
   header("Location:clanek_podrobnosti.php?id=$_POST[clanek]");
   exit;
 }else{
   $_SESSION['typ'] = 'danger';
   $_SESSION['zprava'] = 'Komentář editora nebyl úspěšně uložen.<br /><b>Zkuste to prosím znovu.</b>';
   header("Location:clanek_podrobnosti.php?id=$_POST[clanek]");
   exit;
 }
}else{
 header("Location:uvod.php");
}
  ?>
