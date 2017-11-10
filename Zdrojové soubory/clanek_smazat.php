<?php
session_start();
if((isset($_SESSION['user_is_logged'])) && ($_SESSION['editor'] == true)){
 require_once('connect.php');
 @$vysledek = $mysqli->query("SELECT * FROM clanek WHERE id_clanku = $_GET[id];");
 $zaznam = $vysledek->fetch_array();
 if($zaznam['id_clanku'] !== null){
   unlink($zaznam['nazev_souboru']);
   if ($zaznam['nazev_aktualizovaneho_souboru'] !== null) {
     unlink($zaznam['nazev_aktualizovaneho_souboru']);
   }
   $mysqli->begin_transaction(MYSQLI_TRANS_START_READ_WRITE);
   @$vysledek = $mysqli->query("DELETE FROM recenze WHERE id_clanku = $_GET[id];");
   @$vysledek = $mysqli->query("DELETE FROM autori WHERE id_clanku = $_GET[id];");
   @$vysledek = $mysqli->query("DELETE FROM clanek WHERE id_clanku = $_GET[id];");
   $mysqli->commit();
   $_SESSION['typ'] = "success";
   $_SESSION['zprava'] =  "Úspěšně smazán článek <b>$zaznam[nazev_clanku]</b>";
   header("Location:uvod.php");
   exit;
 }
 $_SESSION['typ'] = "danger";
 $_SESSION['zprava'] = "Chyba při mazání článku <b>$zaznam[nazev_clanku]</b>";
 header("Location:uvod.php");
}else{
 header("Location:uvod.php");
}
  ?>
