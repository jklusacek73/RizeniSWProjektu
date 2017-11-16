<?php
session_start();
if((isset($_SESSION['user_is_logged'])) && ($_SESSION['autor'])) {
  require_once('connect.php');
  $target_dir = 'clanky/';
  $nazev = $_POST['id']. "_" . $_POST['nazev'] . "_aktualizace" . "." . pathinfo($_FILES["fileToUpload"]["name"], PATHINFO_EXTENSION);
  $uploadedFileType = pathinfo($nazev,PATHINFO_EXTENSION);
  if($uploadedFileType != "pdf") {
      $_SESSION['typ'] = 'danger';
      $_SESSION['zprava'] = '<b>Formát souboru není podporován.</b>Nahrávejte pouze soubory typu PDF.';
      header("Location:clanek_aktualizace.php?id=$_POST[id]");
      exit;
  }
  if(move_uploaded_file($_FILES['fileToUpload']['tmp_name'], $target_dir . $nazev)){
      $datum = date('Y-m-d');
      @$vysledek = $mysqli->query("UPDATE clanek SET nazev_aktualizovaneho_souboru = '" . $target_dir . $nazev ."', datum_aktualizace = '$datum', stav = 'Byla nahrána aktualizace článku' WHERE id_clanku = $_POST[id];");
      @$vysledek2 = $mysqli->query("SELECT MAX(id) AS 'maximum' FROM historieClanek;");
      $zaznam2 = $vysledek2->fetch_array();
      $id = $zaznam2['maximum'];
      if( $id == null){
        $id = 1;
      }else{
        $id++;
      }
      @$vysledek3 = $mysqli->query("INSERT INTO historieClanek VALUES ($id, $_POST[id], 5, '$datum');");
      if($vysledek){
        $_SESSION['typ'] = 'success';
        $_SESSION['zprava'] = 'Článek byl úspěšně aktualizován.';
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
        $headers .= 'From: Logos Polytechnikos <' . $mailFrom . '>' . "\r\n";
        $message = "
          <html>
          <head>
            <title>Článek byl úspěšně aktualizován</title>
          </head>
          <body>
          <p>Dobrý den,</p>
          <p>Váše aktualizace článku <b>$_POST[nazev]</b> byla úspěšně nahrán do informačního systému časopisu Logos Polytechnikos.</p>
          <p>Očekávejte další e-mail o tom, zda bude Váš článek skutečně vydán.
          <p>Váš tým časopisu Logos Polytechnikos</p>
          </body>
          </html>
          ";
        mail($_SESSION['e-mail'],'Článek byl úspěšně aktualizován',$message,$headers);
        header("Location:clanek_podrobnosti.php?id=$_POST[id]");
        exit;
      }else {
        $_SESSION['typ'] = 'danger';
        $_SESSION['zprava'] = '<b>Článek nebyl úspěšně aktualizován</b>';
        header("Location:casopis_podrobnosti.php?id=$_POST[id]");
        exit;
      }
  } else {
    $_SESSION['typ'] = 'danger';
    $_SESSION['zprava'] = '<b>Článek nebyl úspěšně aktualizován</b>';
    header("Location:casopis_podrobnosti.php?id=$_POST[id]");
    exit;
  }
}else{
  header("Location:uvod.php");
}
?>
