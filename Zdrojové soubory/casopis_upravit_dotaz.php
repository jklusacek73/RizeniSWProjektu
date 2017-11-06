 <?php
    session_start();
    if((isset($_SESSION['user_is_logged'])) && ($_SESSION['redaktor'] == true)){
     require_once('connect.php');
     $timestamp = strtotime($_POST['uzaverka']);
     $uzaverka = date('Y-m-d', $timestamp);
     @$vysledek = $mysqli->query("UPDATE casopis SET kapacita = $_POST[kapacita], uzaverka = '$uzaverka', temata = '$_POST[temata]', odpovida = $_POST[editor] WHERE id_casopisu = $_POST[id];");
     if($vysledek){
       $_SESSION['typ'] = "success";
       $_SESSION['zprava'] =  "Úprava čísla časopisu proběhla úspěšně.";
       header("Location:casopis_prehled.php");
       exit;
     }
     $_SESSION['typ'] = "danger";
     $_SESSION['zprava'] = "<b>Chyba při úpravě čísla časopisu. </b>";
     $_SESSION['rok'] = $_POST['rok'];
     $_SESSION['kapacita'] = $_POST['kapacita'];
     $_SESSION['uzaverka'] = $_POST['uzaverka'];
     $_SESSION['temata'] = $_POST['temata'];
     $_SESSION['editor'] = $_POST['editor'];
     header("Location:casopis_novy.php?id=$_POST[id]");
   }else{
     header("Location:uvod.php");
   }
  ?>
