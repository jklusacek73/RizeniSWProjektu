<?php
session_start();
if((isset($_SESSION['user_is_logged'])) && ($_SESSION['autor'] == true)){
 require_once('connect.php');
 @$vysledek = $mysqli->query("UPDATE autori SET titul_pred = '$_POST[titpred]', jmeno = '$_POST[jmeno]', prijmeni = '$_POST[prijmeni]', titul_za = '$_POST[titza]', instituce = '$_POST[inst]', instituce_blizsi_urceni = '$_POST[blur]' WHERE id_autora = $_POST[id_autora];");
 if($vysledek){
   $_SESSION['typ'] = "success";
   $_SESSION['zprava'] =  "Úprava autora proběhla úspěšně.";
   @$vysledek = $mysqli->query("SELECT id_clanku FROM autori WHERE id_autora = $_POST[id_autora];");
   $zaznam = $vysledek->fetch_array();
   header("Location:clanek_podrobnosti.php?id=$zaznam[id_clanku]");
   exit;
 }
 $_SESSION['typ'] = "danger";
 $_SESSION['zprava'] = "<b>Chyba při úpravě autora. </b>";
 header("Location:clanek_autori.php?id=$_POST[id_autora]");
}else{
 header("Location:uvod.php");
}
  ?>
