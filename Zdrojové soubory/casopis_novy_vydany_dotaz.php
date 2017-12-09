 <?php
    session_start();
    if((isset($_SESSION['user_is_logged'])) && ($_SESSION['redaktor'] == true)){
     require_once('connect.php');
     @$vysledekPocet = $mysqli->query("SELECT MAX(id_casopisu) AS 'maximum' FROM casopis_vydany;");
     $pocet= $vysledekPocet->fetch_array();
     $maximum = $pocet['maximum'];
     if($maximum == null){
       $maximum = 1;
     } else {
       $maximum++;
     }
     $target_dir = 'casopisy/';
     $nazev = $maximum . "_logos_polytechnikos." . pathinfo($_FILES['fileToUpload']['name'], PATHINFO_EXTENSION);
     $uploadedFileType = pathinfo($nazev,PATHINFO_EXTENSION);
     if($uploadedFileType != "pdf") {
         $_SESSION['typ'] = 'danger';
         $_SESSION['zprava'] = '<b>Formát souboru není podporován. </b>Nahrávejte pouze soubory typu PDF.';
         $_SESSION['rok'] = $_POST['rok'];
         $_SESSION['cislo'] = $_POST['cislo'];
         $_SESSION['temata'] = $_POST['temata'];
         header("Location:casopis_novy_vydany.php");
         exit;
     }
     if(move_uploaded_file($_FILES['fileToUpload']['tmp_name'], $target_dir . $nazev)){
       @$vysledek = $mysqli->query("INSERT INTO casopis_vydany (`id_casopisu`, `rok`, `cislo`, `temata`, `odkaz_k_souboru`) VALUES ($maximum ,$_POST[rok], $_POST[cislo], '$_POST[temata]', '" . $target_dir . $nazev . "');");
       if($vysledek){
         $_SESSION['typ'] = "success";
         $_SESSION['zprava'] =  "Vytvoření čísla časopisu proběhlo úspěšně.";
         header("Location:prehled_vydanych_casopisu.php");
         exit;
       }
       $_SESSION['typ'] = "danger";
       $_SESSION['zprava'] = "<b>Chyba při vytváření čísla časopisu. 1</b>";
       $_SESSION['rok'] = $_POST['rok'];
       $_SESSION['cislo'] = $_POST['cislo'];
       $_SESSION['temata'] = $_POST['temata'];
       header("Location:casopis_novy_vydany.php");
     }else{
       $_SESSION['typ'] = "danger";
       $_SESSION['zprava'] = "<b>Chyba při vytváření čísla časopisu. 2</b>" . $target_dir . $nazev;
       $_SESSION['rok'] = $_POST['rok'];
       $_SESSION['cislo'] = $_POST['cislo'];
       $_SESSION['temata'] = $_POST['temata'];
       header("Location:casopis_novy_vydany.php");
     }
   }else{
     header("Location:uvod.php");
   }
  ?>
