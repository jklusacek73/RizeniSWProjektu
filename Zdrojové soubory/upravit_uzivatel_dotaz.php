<?php
  session_start();
  if((isset($_SESSION['user_is_logged'])) && ($_SESSION['redaktor'] == true)){
    require_once('connect.php');
    require_once('function.php');
    $id = $_POST['id'];
    $mysqli->begin_transaction(MYSQLI_TRANS_START_READ_WRITE);
    @$vysledek = $mysqli->query("DELETE FROM opravneni WHERE id_uzivatele = $id;");
    if($_POST['autor'] == true){
      @$vysledek2 = $mysqli->query("INSERT INTO opravneni VALUES ($id, '1');");
    }
    if($_POST['redaktor'] == true){
      @$vysledek2 = $mysqli->query("INSERT INTO opravneni VALUES ($id, '2');");
    }
    if($_POST['recenzent'] == true){
      @$vysledek2 = $mysqli->query("INSERT INTO opravneni VALUES ($id, '3');");
    }
    if($_POST['editor'] == true){
      @$vysledek2 = $mysqli->query("INSERT INTO opravneni VALUES ($id, '4');");
    }
    @$vysledek3 = $mysqli->query("UPDATE uzivatel SET titul_pred = '$_POST[titpred]', jmeno = '$_POST[jmeno]', prijmeni = '$_POST[prijmeni]', titul_za = '$_POST[titza]', e_mail = '$_POST[email]', instituce = '$_POST[inst]', instituce_blizsi_urceni = '$_POST[blur]' WHERE id_uzivatele = $id;");
    $mysqli->commit();
    if(($vysledek) && ($vysledek2) && ($vysledek3)){
      $_SESSION['typ'] = "success";
      $_SESSION['zprava'] = "Aktualizace dat proběhla úspěšně.";
      header("Location:seznam_uzivatelu.php");
    }else{
      $_SESSION['typ'] = 'danger';
      $_SESSION['zprava'] = "<b>Aktualizace dat o uživateli neproběhla úspěšně.</b><br />Pamatujte, že e-mail musí být v celé databázi jedinečný.";
      header("Location:registrace_ostatni.php?id=$id");
    }
  }else{
    header("Location:uvod.php");
  }
  ?>
