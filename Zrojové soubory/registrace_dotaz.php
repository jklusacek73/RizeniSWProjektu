<?php include 'hlavicka.php'?>
    <?php include 'menu-uvod.php'?>
  <?php include 'hlavni-foto.php'?>
  <div class="row" id="hlavni">
      <div class="col-sm-offset-1 col-sm-10 col-xs-12">
      <div class="col-sm-12">
        <h3 class="hlavni-nadpis">Registrace do informačního systému</h2>
      </div>
      </div> 
      <div class="col-sm-offset-1 col-sm-10 col-xs-12">
      <div class="col-sm-12">
      <?php
     $mysqli = new mysqli("localhost", "krejci26", "Melinho58826", "krejci26");
     $mysqli->set_charset("utf8");
     $pomocna = $mysqli->query("SELECT max(id_uzivatele) FROM uzivatel; ");
     $id_uzivatel = $pomocna + 1;
     @$vysledek = $mysqli->query("INSERT INTO uzivatel VALUES 
     ('$_POST[id_uzivatel]', '$_POST[titpred]', '$_POST[jmeno]', '$_POST[prijmeni]', '$_POST[titza]', '$_POST[email]', '$_POST[pswd]', '$_POST[inst]', '$_POST[blur]');");
   if($vysledek){
        echo ("<p>Registrace byla úspěšná.</p>");
     }else{
        echo ("<p>Registrace nebyla úspěšná.</p>");
     }
     echo ("<a href=index.php><button type=button class=\"btn btn-primary\">Zpět na přihlašovací stránku.</button> </a>");
          
  ?>
  </div>
  </div>
    </div>
      
      <?php include 'paticka.php'?>