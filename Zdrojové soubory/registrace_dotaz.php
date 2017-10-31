<?php
    session_start();
    if(!isset($_SESSION['user_is_logged'])){
     require_once('connect.php');
     $vysledek = $mysqli->query("SELECT max(id_uzivatele) AS 'maximum' FROM uzivatel; ");
     $data = $vysledek->fetch_array();
     $id = $data['maximum'];
     if($id == null){
       $id = 1;
     }else{
       $id++;
     }
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
       $mysqli->begin_transaction(MYSQLI_TRANS_START_READ_WRITE);
       @$vysledek = $mysqli->query("INSERT INTO uzivatel VALUES ($id, '$_POST[titpred]', '$_POST[jmeno]', '$_POST[prijmeni]', '$_POST[titza]', '$_POST[email]', '$hesloSifra' , '$_POST[inst]', '$_POST[blur]');");
       @$vysledek = $mysqli->query("INSERT INTO opravneni VALUES ($id,'1');");
       $mysqli->commit();
       if($vysledek){
         $_SESSION['typ'] = "success";
         $_SESSION['zprava'] =  "Registrace proběhla úspěšně. <b>Nyní se můžete přihlásit. </b>";
         header("Location:index.php");
         exit;
       }else{
         $info .= "Registrace neproběhla úspěšně.<br />";
         $ulozit = false;
       }
     }
     $_SESSION['typ'] = "danger";
     $_SESSION['zprava'] = "<b>Chyba při registraci. </b><br />" . $info . "<b>Pamatujte, že e-mail musí být jedinečný v celé databázi.</b>";
     $_SESSION['titpred'] = $_POST['titpred'];
     $_SESSION['jmeno'] = $_POST['jmeno'];
     $_SESSION['prijmeni'] = $_POST['prijmeni'];
     $_SESSION['titza'] = $_POST['titza'];
     $_SESSION['email'] = $_POST['email'];
     $_SESSION['inst'] = $_POST['inst'];
     $_SESSION['blur'] = $_POST['blur'];
     header("Location:registrace.php");
   }else{
     header("Location:uvod.php");
   }
  ?>
