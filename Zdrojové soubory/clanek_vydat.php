<?php
session_start();
require_once('connect.php');
require_once('function.php');
if(!isset($_GET['id'])){
  header("Location:uvod.php");
  exit;
} else {
  $datum = date('Y-m-d');
  @$vysledek = $mysqli->query("SELECT * FROM clanek JOIN casopis ON casopis = id_casopisu WHERE id_clanku = $_GET[id];");
  $zaznam = $vysledek->fetch_array();
  if((isset($_SESSION['user_is_logged'])) && ($_SESSION['editor']) && ($_SESSION['id_uzivatele'] == $zaznam['odpovida'])) {
    @$vysledek2 = $mysqli->query("SELECT MAX(id) AS 'maximum' FROM historieClanek;");
    $zaznam2 = $vysledek2->fetch_array();
    $id = $zaznam2['maximum'];
    if( $id == null){
      $id = 1;
    }else{
      $id++;
    }
    @$vysledek3 = $mysqli->query("INSERT INTO historieClanek VALUES ($id, $zaznam[id_clanku], 6, '$datum');");
    @$vysledek = $mysqli->query("UPDATE clanek SET stav = 'Článek bude vydán' WHERE id_clanku = $zaznam[id_clanku];");
    if($vysledek){
      $_SESSION['typ'] = 'success';
      $_SESSION['zprava'] = "Článek $zaznam[nazev_clanku] bude vydán.";
      $headers = "MIME-Version: 1.0" . "\r\n";
      $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
      $headers .= 'From: Logos Polytechnikos <' . $mailFrom . '>' . "\r\n";
      $message1 = "
        <html>
        <head>
          <title>Váš článek bude vydán</title>
        </head>
        <body>
        <p>Dobrý den,</p>
        <p>Váš článek <b>$zaznam[nazev_clanku]</b> bude vydán v čísle <b>$zaznam[rok]/$zaznam[cislo]</b> časopisu Logos Polytechnikos.</p>
        <p>Děkujeme Vám za spolupráci.</p>
        <p>Váš tým časopisu Logos Polytechnikos</p>
        </body>
        </html>
        ";
        @$vysledek2 = $mysqli->query("SELECT DISTINCT e_mail FROM clanek JOIN uzivatel ON odpovedny_uzivatel = id_uzivatele WHERE id_uzivatele = $zaznam[odpovedny_uzivatel];");
        $zaznam2 = $vysledek2->fetch_array();
        mail($zaznam2['e_mail'],'Váš článek bude vydán',$message1,$headers);
        header("Location:clanek_podrobnosti.php?id=$zaznam[id_clanku]");
        exit;
    }else{
      $_SESSION['typ'] = 'danger';
      $_SESSION['zprava'] = '<b>Vydání článku se nezdařilo</b>';
      header("Location:clanek_podrobnosti.php?id=$zaznam[id_clanku]");
      exit;
    }
  } else {
    header("Location:clanek_podrobnosti.php?id=$zaznam[id_clanku]");
    exit;
  }
}
?>
