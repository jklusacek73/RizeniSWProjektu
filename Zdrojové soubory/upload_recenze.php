<?php
session_start();
if((isset($_SESSION['user_is_logged'])) && ($_SESSION['recenzent'])) {
  require_once('connect.php');
  @$vysledek = $mysqli->query("SELECT COUNT(id_recenze) AS 'pocet' FROM recenze WHERE id_uzivatele = $_SESSION[id_uzivatele] AND id_clanku = $_POST[id];");
  $kontrola = $vysledek->fetch_array();
  if($kontrola['pocet'] > 0){
    $_SESSION['typ'] = 'danger';
    $_SESSION['zprava'] = "<b>K článku už nemůžete nahrávat další recenze</b>";
    header("Location:clanek_podrobnosti.php?id=$_POST[id]");
    exit;
  }
  @$vysledek = $mysqli->query("SELECT MAX(id_recenze) AS 'maximum' FROM recenze;");
  $zaznam = $vysledek->fetch_array();
  $maximum = $zaznam['maximum'];
  if($maximum == null){
    $maximum = 1;
  } else {
    $maximum++;
  }
  $target_dir = 'recenze/';
  $nazev = $maximum . "_recenze_" . $_POST['id'] . "." . pathinfo($_FILES["fileToUpload"]["name"], PATHINFO_EXTENSION);
  $uploadedFileType = pathinfo($nazev,PATHINFO_EXTENSION);
  if($uploadedFileType != "pdf") {
      $_SESSION['typ'] = 'danger';
      $_SESSION['zprava'] = '<b>Formát souboru není podporován.</b>Nahrávejte pouze soubory typu PDF.';
      header("Location:recenze_nahrat.php?id=$_POST[id]");
      exit;
  }
  if(move_uploaded_file($_FILES['fileToUpload']['tmp_name'], $target_dir . $nazev)){
      $datum = date('Y-m-d');
      $mysqli->begin_transaction(MYSQLI_TRANS_START_READ_WRITE);
      @$vysledek = $mysqli->query("INSERT INTO recenze(id_recenze, datum, nazev_souboru, id_uzivatele, id_clanku) values ($maximum , '$datum', '" . $target_dir . $nazev . "', $_SESSION[id_uzivatele], $_POST[id]);");
      @$vysledek2 = $mysqli->query("SELECT COUNT(id_clanku) AS 'pocet_recenzi' FROM recenze WHERE id_clanku = $_POST[id];");
      $zaznam = $vysledek2->fetch_array();
      $vysledek3 = false;
      $recenze = '';
      @$vysledekH1 = $mysqli->query("SELECT MAX(id) AS 'maximum' FROM historieClanek;");
      $zaznam2 = $vysledekH1->fetch_array();
      $id = $zaznam2['maximum'];
      if( $id == null){
        $id = 1;
      }else{
        $id++;
      }
      if($zaznam['pocet_recenzi'] == 1){
        @$vysledekH2 = $mysqli->query("INSERT INTO historieClanek VALUES ($id, $_POST[id], 3, '$datum');");
        @$vysledek3 = $mysqli->query("UPDATE clanek SET stav = 'Byla nahrána 1. recenze' WHERE id_clanku = $_POST[id];");
        $recenze .= 'První ';
      }else if($zaznam['pocet_recenzi'] == 2){
        @$vysledekH2  = $mysqli->query("INSERT INTO historieClanek VALUES ($id, $_POST[id], 4, '$datum');");
        @$vysledek3 = $mysqli->query("UPDATE clanek SET stav = 'Byla nahrána 2. recenze. Nyní můžete svůj článek aktualizovat.' WHERE id_clanku = $_POST[id];");
        $recenze .= 'Druhá ';
      }
      $mysqli->commit();
      if($vysledek && $vysledek2 && $vysledek3){
        @$vysledek = $mysqli->query("SELECT * FROM clanek JOIN uzivatel ON odpovedny_uzivatel = id_uzivatele WHERE id_clanku = $_POST[id];");
        $clanek = $vysledek->fetch_array();
        $_SESSION['typ'] = 'success';
        $_SESSION['zprava'] = 'Recenze byla úspěšně nahrána.';
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
        $headers .= 'From: Logos Polytechnikos <' . $mailFrom . '>' . "\r\n";
        $message1 = "
          <html>
          <head>
            <title>Recenze byla úspěšně nahrána</title>
          </head>
          <body>
          <p>Dobrý den,</p>
          <p>Vaše recence k článku <b>$clanek[nazev_clanku]</b> byla úspěšně nahrána do informačního systému časopisu Logos Polytechnikos.</p>
          <p>Váš tým časopisu Logos Polytechnikos</p>
          </body>
          </html>
          ";
        mail($_SESSION['e-mail'],'Recenze byla úspěšně nahrána',$message1,$headers);
        if($zaznam['pocet_recenzi'] == 1){
          $message2 = "
            <html>
            <head>
              <title>Recenze k Vašemu článku </title>
            </head>
            <body>
            <p>Dobrý den,</p>
            <p>První recence k Vašemu článku <b>$clanek[nazev_clanku]</b> byla úspěšně nahrána do informačního systému časopisu Logos Polytechnikos.</p>
            <p>Váš tým časopisu Logos Polytechnikos</p>
            </body>
            </html>
            ";
          mail($clanek['e_mail'],'První recenze k Vašemu článku',$message2,$headers);
        }
        if($zaznam['pocet_recenzi'] == 2){
          $message3 = "
            <html>
            <head>
              <title>Recenze k Vašemu článku </title>
            </head>
            <body>
            <p>Dobrý den,</p>
            <p>Druhá recence k Vašemu článku <b>$clanek[nazev_clanku]</b> byla úspěšně nahrána do informačního systému časopisu Logos Polytechnikos.</p>
            <p>Prosíme zkontrolujte si v informačním systému zda a jak máte aktualizovat Váš článek.</p>
            <p>Váš tým časopisu Logos Polytechnikos</p>
            </body>
            </html>
            ";
            mail($clanek['e_mail'],'Druhá recenze k Vašemu článku',$message3,$headers);
        }
        header("Location:clanek_podrobnosti.php?id=$_POST[id]");
        exit;
      }else {
        $_SESSION['typ'] = 'danger';
        $_SESSION['zprava'] = '<b>Recenze nebyla úspěšně nahrána.</b>';
        header("Location:recenze_nahrat.php?id=$_POST[id]");
        exit;
      }
  } else {
    $_SESSION['typ'] = 'danger';
    $_SESSION['zprava'] = '<b>Recenze nebyla úspěšně nahrána.</b>';
    header("Location:casopis_podrobnosti.php?id=$_POST[id]");
    exit;
  }
}else{
  header("Location:casopis_podrobnosti.php?id=$_POST[id]");
}
?>
