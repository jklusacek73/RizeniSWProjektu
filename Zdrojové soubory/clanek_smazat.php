<?php
session_start();
if((isset($_SESSION['user_is_logged'])) && ($_SESSION['editor'] == true)){
 require_once('connect.php');
 @$vysledek = $mysqli->query("SELECT * FROM clanek WHERE id_clanku = $_GET[id];");
 $zaznam = $vysledek->fetch_array();
 @$vysledekUzivatel = $mysqli->query("SELECT * FROM uzivatel WHERE id_uzivatele = $zaznam[odpovedny_uzivatel];");
 $uzivatel = $vysledekUzivatel->fetch_array();
 @$vysledek2 = $mysqli->query("SELECT * FROM recenze WHERE id_clanku = $_GET[id];");
 while($recenze2 = $vysledek2->fetch_array()){
   if ($recenze['id_recenze'] !== null){
     unlink($recenze['nazev_souboru']);
   }
 }
 if($zaznam['id_clanku'] !== null){
   unlink($zaznam['nazev_souboru']);
   if ($zaznam['nazev_aktualizovaneho_souboru'] !== null) {
     unlink($zaznam['nazev_aktualizovaneho_souboru']);
   }
   $mysqli->begin_transaction(MYSQLI_TRANS_START_READ_WRITE);
   @$vysledek = $mysqli->query("DELETE FROM recenze WHERE id_clanku = $_GET[id];");
   @$vysledek = $mysqli->query("DELETE FROM autori WHERE id_clanku = $_GET[id];");
   @$vysledek = $mysqli->query("DELETE FROM historieClanek WHERE id_clanku = $_GET[id];");
   @$vysledek = $mysqli->query("DELETE FROM clanek WHERE id_clanku = $_GET[id];");
   $mysqli->commit();
   $_SESSION['typ'] = "success";
   $_SESSION['zprava'] =  "Úspěšně smazán článek <b>$zaznam[nazev_clanku]</b>";
    $headers = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
    $headers .= 'From: Logos Polytechnikos <' . $mailFrom . '>' . "\r\n";
    $message = "
      <html>
      <head>
        <title>Článek nebude vydán</title>
      </head>
      <body>
      <p>Dobrý den,</p>
      <p>Váš článek <b>$zaznam[nazev_clanku]</b> nebude vydán.</p>
      <p>Doufáme, že i nadále s naším časopisem budete spolupracovat a vytvářet nové články.</p>
      <p>Pokud chcete spolupracovat s redakcí jiným způsobem, kontaktujte prosím redakci pomocí kontaktního formuláře.</p>
      <p>Přejeme Vám hezký den <br /> Váš tým časopisu Logos Polytechnikos</p>
      </body>
      </html>
      ";
      mail($uzivatel['e_mail'],'Článek nebude vydán',$message,$headers);
      header("Location:casopis_podrobnosti.php?id=$zaznam[casopis]");
      exit;
 }
 $_SESSION['typ'] = "danger";
 $_SESSION['zprava'] = "Chyba při mazání článku <b>$zaznam[nazev_clanku]</b>";
 header("Location:uvod.php");
}else{
 header("Location:uvod.php");
}
  ?>
