<?php
session_start();
if((isset($_SESSION['user_is_logged'])) && ($_SESSION['editor'] == true)){
 require_once('connect.php');
 @$vysledek = $mysqli->query("SELECT id_clanku, datum_recenzniho_rizeni FROM clanek WHERE id_clanku = $_POST[clanek];");
 $zaznam = $vysledek->fetch_array();
 if($zaznam['id_clanku'] !== null){
   $timestamp = strtotime($_POST['datum']);
   $datum = date('Y-m-d', $timestamp);
   @$vysledek = $mysqli->query("UPDATE clanek SET datum_recenzniho_rizeni = '$datum', stav = 'Stanoveno datum zahájení recenzního řízení' WHERE id_clanku = $_POST[clanek];");
   $_SESSION['typ'] = "success";
   $_SESSION['zprava'] =  "Datum zahájení recenzního řízení se podařilo uložit.";
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
