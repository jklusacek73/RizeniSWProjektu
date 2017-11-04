 <?php
    session_start();
    if(isset($_SESSION['user_is_logged'])){
     require_once('connect.php');
     //$timestamp = strtotime($_POST['uzaverka']);
     //$uzaver = date("Y-m-d", $_POST['uzaverka']);
     $vysledek = $mysqli->query("SELECT max(id_casopisu) AS 'maximum' FROM casopis; ");
     $data = $vysledek->fetch_array();
     $id = $data['maximum'];
     if($id == null){
       $id = 1;
     }else{
       $id++;
     }
     $ulozit = true;
     $info = "";
     if($ulozit == true){
       @$vysledek = $mysqli->query("INSERT INTO casopis VALUES ($id, '$_POST[rok]', '$_POST[cislo]', '$_POST[kapacita]', '$_POST[uzaverka]', '$_POST[temata]', '$_POST[editor]');");
       if($vysledek){
         $_SESSION['typ'] = "success";
         $_SESSION['zprava'] =  "Vytvoření čísla časopisu proběhlo úspěšně.";
         header("Location:uvod.php");
         exit;
       }else{
         $info .= "Vytvoření čísla časopisu neproběhlo úspěšně.<br />";
         $ulozit = false;
       }
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
