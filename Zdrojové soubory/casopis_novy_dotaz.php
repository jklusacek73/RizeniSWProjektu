 <?php
    session_start();
    if((isset($_SESSION['user_is_logged'])) && ($_SESSION['redaktor'] == true)){
     require_once('connect.php');
     $timestamp = strtotime($_POST['uzaverka']);
     $uzaverka = date('Y-m-d', $timestamp);
     $vysledek = $mysqli->query("SELECT max(id_casopisu) AS 'maximum' FROM casopis; ");
     $data = $vysledek->fetch_array();
     $id = $data['maximum'];
     if($id == null){
       $id = 1;
     }else{
       $id++;
     }
     $vysledek2 = $mysqli->query("SELECT max(cislo) AS 'max' FROM casopis WHERE rok = $_POST[rok];");
     $data = $vysledek2->fetch_array();
     $cislo = $data['max'];
     if($cislo == null){
       $cislo = 1;
     }else{
       $cislo++;
     }
     @$vysledek = $mysqli->query("INSERT INTO casopis (`id_casopisu`, `rok`, `cislo`, `kapacita`, `uzaverka`, `temata`, `odpovida`) VALUES ($id, $_POST[rok], $cislo, $_POST[kapacita], '$uzaverka', '$_POST[temata]', $_POST[editor]);");
     if($vysledek){
       $_SESSION['typ'] = "success";
       $_SESSION['zprava'] =  "Vytvoření čísla časopisu proběhlo úspěšně.";
       header("Location:uvod.php");
       exit;
     }
     $_SESSION['typ'] = "danger";
     $_SESSION['zprava'] = "<b>Chyba při vytváření čísla časopisu. </b>";
     $_SESSION['rok'] = $_POST['rok'];
     $_SESSION['cislo'] = $_POST['cislo'];
     $_SESSION['kapacita'] = $_POST['kapacita'];
     $_SESSION['uzaverka'] = $_POST['uzaverka'];
     $_SESSION['temata'] = $_POST['temata'];
     $_SESSION['editor'] = $_POST['editor'];
     header("Location:casopis_novy.php");
   }else{
     header("Location:uvod.php");
   }
  ?>
