<?php
           //připojení k DB
$servername = "localhost";
$username = "";
$password = "";
$dbname = "";

                           

// složka do které se nahrává
$target_dir = "uploads/";
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




?>