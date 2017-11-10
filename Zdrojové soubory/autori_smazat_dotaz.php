<?php
session_start();
if((isset($_SESSION['user_is_logged'])) && ($_SESSION['redaktor'] == true)){
 require_once('connect.php');
 if(isset($_GET['id'])){
   @$vysledek = $mysqli->query("SELECT id_clanku FROM autori WHERE id_autora = $_GET[id];");
   $zaznam = $vysledek->fetch_array();
 }else{
   header("Location:uvod.php");
   exit;
 }
 @$vysledek = $mysqli->query("DELETE FROM autori WHERE id_autora = $_GET[id];");
 if($vysledek){
   $_SESSION['typ'] = "success";
   $_SESSION['zprava'] =  "Odstranění spoluautora proběhlo úspěšně.";
   header("Location:clanek_podrobnosti.php?id=$zaznam[id_clanku]");
   exit;
 }
 $_SESSION['typ'] = "danger";
 $_SESSION['zprava'] = "<b>Chyba při odstranění spoluautora. </b>";
 header("Location:clanek_podrobnosti.php?id=$_POST[id_clanku]");
}else{
 header("Location:uvod.php");
}
  ?>
