<?php
  session_start();
  if(isset($_SESSION['user_is_logged'])){
    require_once('connect.php');
    require_once('function.php');
    $mysqli->begin_transaction(MYSQLI_TRANS_START_READ_WRITE);
    @$vysledek = $mysqli->query("UPDATE uzivatel SET titul_pred = '$_POST[titpred]', jmeno = '$_POST[jmeno]', prijmeni = '$_POST[prijmeni]', titul_za = '$_POST[titza]', e_mail = '$_POST[email]', instituce = '$_POST[inst]', instituce_blizsi_urceni = '$_POST[blur]' WHERE id_uzivatele = $_SESSION[id_uzivatele];");
    $mysqli->commit();
    if($vysledek){
      $_SESSION['typ'] = "success";
      $_SESSION['zprava'] = "Aktualizace dat proběhla úspěšně.";
      header("Location:uvod.php");
    }else{
      $_SESSION['typ'] = 'danger';
      $_SESSION['zprava'] = "<b>Aktualizace dat o uživateli neproběhla úspěšně.</b><br />Pamatujte, že e-mail musí být v celé databázi jedinečný.";
      header("Location:upravit_udaje.php");
    }
  }else{
    header("Location:uvod.php");
  }
  ?>
