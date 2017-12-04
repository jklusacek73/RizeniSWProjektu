 <?php
    session_start();
    if((isset($_SESSION['user_is_logged'])) && ($_SESSION['redaktor'] == true)){
     require_once('connect.php');
     
    
   
    // $data = $vysledek->fetch_array();
    
    
     @$vysledek = $mysqli->query("INSERT INTO casopis_vydany (`rok`, `cislo`, `temata`, `odkaz_k_souboru`) VALUES ($_POST[rok], $_POST[cislo], '$_POST[temata]', '$_POST[fileToUpload]');");
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
     $_SESSION['temata'] = $_POST['temata'];
     header("Location:casopis_novy_vydany.php");
   }else{
     header("Location:uvod.php");
   }
  ?>
