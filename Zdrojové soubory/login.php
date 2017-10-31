<?php
  session_start();
  require_once('connect.php');
  @$vysledek = $mysqli->query("SELECT * FROM uzivatel WHERE e_mail = '$_POST[email]';");
  if($vysledek){
    $zaznam = $vysledek->fetch_array();
    $zadaneHeslo = hash('sha512', $_POST['pwd']);
    if($zadaneHeslo == $zaznam['heslo']){
      $_SESSION["user_is_logged"] = true;
      @$vysledek2 = $mysqli->query("SELECT id_role, nazev FROM role NATURAL JOIN opravneni WHERE id_uzivatele = '$zaznam[id_uzivatele]' ORDER BY id_role;");
      while ($role = $vysledek2->fetch_array()) {
          switch($role['id_role']){
            case 1:
              $_SESSION['autor'] = true;
              break;
            case 2:
              $_SESSION['redaktor'] = true;
              break;
            case 3:
              $_SESSION['recenzent'] = true;
              break;
            case 4:
              $_SESSION['editor'] = true;
              break;
          }
      }
      header("Cache-control: private");
      $_SESSION['e-mail'] = $zaznam['e_mail'];
      $_SESSION['id_uzivatele'] = intval($zaznam['id_uzivatele']);
      $_SESSION['typ'] = "success";
      $_SESSION['zprava'] =  "Přihlášení proběhlo úspěšně";
      $_SESSION['jmeno'] = '';
      if($zaznam['titul_pred'] !== '' ) :
       $_SESSION['jmeno'] .= $zaznam['titul_pred'] . ' ';
      endif;
      $_SESSION['jmeno'] .=  $zaznam['jmeno'] . ' ' . $zaznam['prijmeni'];
      if($zaznam['titul_za'] !== '' ) :
       $_SESSION['jmeno'] .= ', ' . $zaznam['titul_za'];
      endif;
      header("Location:uvod.php");
      exit;
    }
  }
  $_SESSION['typ'] = "danger";
  $_SESSION['zprava'] = "<b>Nelze se přihlásit.</b><br />Zadejte znovu váš přihlašovací e-mail a heslo.";
  header("Location:index.php");
?>
