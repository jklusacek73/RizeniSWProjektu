<?php
  session_start();
  if((isset($_SESSION['user_is_logged'])) && ($_SESSION['redaktor'] == true)){
    require_once('connect.php');
    require_once('function.php');
    $heslo = generateRandomString(10);
    $vysledek = $mysqli->query("SELECT max(id_uzivatele) AS 'maximum' FROM uzivatel; ");
    $data = $vysledek->fetch_array();
    $id = $data['maximum'];
    if($id == null){
      $id = 1;
    }else{
      $id++;
    }
    $hesloSifra = '...' . hash('sha512', $heslo);
    $mysqli->begin_transaction(MYSQLI_TRANS_START_READ_WRITE);
    @$vysledek = $mysqli->query("INSERT INTO uzivatel VALUES ($id, '$_POST[titpred]', '$_POST[jmeno]', '$_POST[prijmeni]', '$_POST[titza]', '$_POST[email]', '$hesloSifra', '$_POST[inst]', '$_POST[blur]');");
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
    $mysqli->commit();
    if($vysledek){
      $headers = "MIME-Version: 1.0" . "\r\n";
      $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
      $headers .= 'From: <' . $mailFrom . '>' . "\r\n";
      $message = "
        <html>
        <head>
          <title>Nový uživatel v systému časopisu Logos Polytechnikos</title>
        </head>
        <body>
        <p>Dobrý den,</p>
        <p>Byl jste registrován do informačního systému časopisu Logos Polytechnikos.</p>
        <p>Vaše přihlašovací údaje jsou Váš e-mail a automaticky generované heslo <b>$heslo</b>, které si po prvním přihlášení změníte.</p>
        <p>Váš tým časopisu Logos Polytechnikos</p>
        </body>
        </html>
        ";
      mail($_POST['email'],'Nový uživatel v informačním systému časopisu Logos Polytechnikos',$message,$headers);
      $_SESSION['typ'] = "success";
      $_SESSION['zprava'] = "Registrace nového uživatele proběhla úspěšně.";
      header("Location:uvod.php");
      exit;
    }else{
      $_SESSION['typ'] = "danger";
      $_SESSION['zprava'] = "<b>Chyba při registraci.</b><br />Zkuste zadat údaje o uživateli znovu.<br />Pamatujte že email v celém systému musí být jedinečný.";
    }
    $_SESSION['user_titpred'] = $_POST['titpred'];
    $_SESSION['user_jmeno'] = $_POST['jmeno'];
    $_SESSION['user_prijmeni'] = $_POST['prijmeni'];
    $_SESSION['user_titza'] = $_POST['titza'];
    $_SESSION['user_email'] = $_POST['email'];
    $_SESSION['user_inst'] = $_POST['inst'];
    $_SESSION['user_blur'] = $_POST['blur'];
    $_SESSION['user_autor'] = $_POST['autor'];
    $_SESSION['user_recenzent'] = $_POST['recenzent'];
    $_SESSION['user_editor'] = $_POST['editor'];
    $_SESSION['user_redaktor'] = $_POST['redaktor'];
    header("Location:registrace_ostatni.php");
  }else{
    header("Location:index.php");
  }
  ?>
