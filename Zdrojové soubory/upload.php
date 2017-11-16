<?php
session_start();
if((isset($_SESSION['user_is_logged'])) && ($_SESSION['autor'])){
  require_once('connect.php');
  require_once('function.php');
  @$vysledek = $mysqli->query("SELECT MAX(id_clanku) AS 'maximum' FROM clanek;");
  $zaznam = $vysledek->fetch_array();
  $maximum = $zaznam['maximum'];
  if($maximum == null){
    $maximum = 1;
  } else {
    $maximum++;
  }
  $target_dir = 'clanky/';
  $nazev = $maximum . "_" . $_POST['nazevClanku'] . "." . pathinfo($_FILES["fileToUpload"]["name"], PATHINFO_EXTENSION);
  $uploadedFileType = pathinfo($nazev,PATHINFO_EXTENSION);
  if($uploadedFileType != "pdf") {
      $_SESSION['typ'] = 'danger';
      $_SESSION['zprava'] = '<b>Formát souboru není podporován.</b>Nahrávejte pouze soubory typu PDF.';
      $_SESSION['nazev'] = $_POST['nazevClanku'];
      header("Location:nahrat_clanek.php");
  }else{
    $_SESSION['typ'] = 'danger';
    $_SESSION['zprava'] = '<b>Soubor nebyl úspěšně nahrán.</b>';
    $_SESSION['nazev'] = $_POST['nazevClanku'];
    header("Location:nahrat_clanek.php");
  }
  if(move_uploaded_file($_FILES['fileToUpload']['tmp_name'], $target_dir . $nazev)){
    $datum = date('Y-m-d');
    @$vysledek = $mysqli->query("INSERT INTO clanek (id_clanku, nazev_clanku, nazev_souboru, datum_vlozeni, stav, odpovedny_uzivatel, casopis) values ($maximum , '$_POST[nazevClanku]', '" . $target_dir . $nazev . "', '$datum', 'Vloženo', $_SESSION[id_uzivatele], $_POST[id]);");
    @$vysledek2 = $mysqli->query("SELECT MAX(id) AS 'maximum' FROM historieClanek;");
    $zaznam2 = $vysledek2->fetch_array();
    $id = $zaznam2['maximum'];
    if( $id == null){
      $id = 1;
    }else{
      $id++;
    }
    @$vysledek3 = $mysqli->query("INSERT INTO historieClanek VALUES ($id, $maximum, 1, '$datum');");
    if($vysledek){
        $_SESSION['typ'] = 'success';
        $_SESSION['zprava'] = 'Soubor byl úspěšně nahrán.<br /><b>Nyní můžete zadat případné další autory právě vloženého článku.</b>';
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
        $headers .= 'From: Logos Polytechnikos <' . $mailFrom . '>' . "\r\n";
        $message = "
          <html>
          <head>
            <title>Nový článek byl úspěšně přidán</title>
          </head>
          <body>
          <p>Dobrý den,</p>
          <p>Váš článek <b>$_POST[nazevClanku]</b> byl úspěšně nahrán do informačního systému časopisu Logos Polytechnikos.</p>
          <p>Sledujte stav Vašeho nahraného článku přímo v informačním systému. O dalším postupu recenzního řízení Vás budeme informovat prostřednictvím e-mailu.</p>
          <p>Váš tým časopisu Logos Polytechnikos</p>
          </body>
          </html>
          ";
        mail($_SESSION['e-mail'],'Nový článek byl úspěšně přidán',$message,$headers);
        header("Location:clanek_autori.php?id=$maximum");
        exit;
      }else {
        $_SESSION['typ'] = 'danger';
        $_SESSION['zprava'] = '<b>Soubor nebyl úspěšně nahrán.</b>';
        $_SESSION['nazev'] = $_POST['nazevClanku'];
        header("Location:nahrat_clanek.php");
      }
  } else {
    $_SESSION['typ'] = 'danger';
    $_SESSION['zprava'] = '<b>Soubor nebyl úspěšně nahrán.</b>';
    $_SESSION['nazev'] = $_POST['nazevClanku'];
    header("Location:nahrat_clanek.php");
  }
}else{
  header("Location:casopis_podrobnosti.php?id=$_POST[id]");
}
?>



<?php// složka do které se nahrává
/*$target_dir = "uploads/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$uploadedFileType = pathinfo($target_file,PATHINFO_EXTENSION);
// Check if image file is a actual image or fake image

// Check if file already exists
// nl2br() formátování kvůli /n
if (file_exists($target_file)) {
    echo nl2br("Soubor už existuje. Prosím přejmenujte soubor a zkuste znovu.\n\n");
    $uploadOk = 0;
}

if($uploadedFileType != "pdf" && $uploadedFileType != "doc" && $uploadedFileType != "docx"
&& $uploadedFileType != "txt" ) {
    echo  nl2br("Formát souboru není podporován\n\n");
    $uploadOk = 0;
}


// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
  echo nl2br("Soubor nebyl nahrán\n\n");
//if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
         // if(file_put_contents($target_file, file_get_contents($_FILES["fileToUpload"]["tmp_name"])))                     {

       echo "Soubor ". basename( $_FILES["fileToUpload"]["name"]). " byl úspěšně nahrán.";
      // @unlink($_FILES["fileToUpload"]["tmp_name"]);

    //  @mysql_query("SET CHARACTER SET utf8");

     // @mysql_query("SET NAMES utf8");
//@$vysledek = mysql_query("insert into clanek values(1 , '$_POST[nazevClanku]', '$_POST[fileToUpload]', '2017-10-28', 'Nezpracováno', 1, '$_POST[cisloCasopisu]')");
    //          if ($vysledek){
//echo "Článek byl uložen do DB";
//} else {
//echo "Článek nebyl uložen do DB.";

            // }

            try{
           //   @mysql_query("SET CHARACTER SET utf8");

    //  @mysql_query("SET NAMES utf8");
      $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
      $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $stmt = $conn->prepare("insert into clanek(id_clanku, nazev_clanku, nazev_souboru, datum_vlozeni, stav, odpovedny_uzivatel, casopis) values(1 , '$_POST[nazevClanku]', '$target_file', '2017-10-28', 'Nezpracováno', 1, '$_POST[cisloCasopisu]')");
       $stmt->execute();
       }
catch(PDOException $e)
{
      echo "Connection failed: " . $e->getMessage();
}
$conn = null;

    } else {
        echo "Soubor nebyl nahrán.";
   }
}



*/
?>
