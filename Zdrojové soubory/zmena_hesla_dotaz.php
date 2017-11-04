<?php
    session_start();
    if(isset($_SESSION['user_is_logged'])){
     require_once('connect.php');
     $ulozit = true;
     $info = "";
     $heslo = $_POST['pswd1'];
     $hesloZnovu = $_POST['pswd2'];
     if(strlen($heslo) < 10){
       $info .= "Zadané heslo je příliš krátké (heslo musí mít alespoň 10 znaků).<br />";
       $ulozit = false;
     }else{
       if($heslo !== $hesloZnovu){
         $info .= "Zadaná hesla nejsou stejná.<br />";
         $ulozit = false;
       }
     }
     if($ulozit == true){
       $hesloSifra =  hash('sha512', $heslo);
       @$vysledek = $mysqli->query("UPDATE uzivatel SET heslo = '$hesloSifra' WHERE id_uzivatele = $_SESSION[id_uzivatele];");
       if($vysledek){
         $_SESSION['typ'] = "success";
         $_SESSION['zprava'] =  "Vaše heslo bylo úspěšně změněno.</b>";
         header("Location:uvod.php");
         exit;
       }else{
         $info .= "<b>Zopakujte zadání nového hesla.</b>";
         $ulozit = false;
       }
     }
     $_SESSION['typ'] = "danger";
     $_SESSION['zprava'] = $info;
     header("Location:zmena_hesla.php");
   }else{
     header("Location:index.php");
   }
  ?>
