<?php
session_start();
if(isset($_SESSION['user_is_logged'])){
  require_once('connect.php');
  require_once('function.php');
?>
<?php include 'hlavicka.php'?>
  <?php include 'menu-uvod.php'?>
<?php include 'hlavni-foto.php'?>
<div class="row" id="hlavni">
  <div class="col-sm-offset-1 col-sm-10 col-xs-12">
    <br />
    <div class="col-sm-12">
      <?php include 'zpravy.php'?>
    </div>
    <div class="col-sm-12">
      <h4 class="hlavni-nadpis">Příští čísla časopisu</h4>
      <?php
      $datum = date("Y-m-d");
      @$vysledek = $mysqli->query("SELECT id_casopisu, rok, cislo, kapacita, uzaverka, temata, titul_pred, jmeno, prijmeni, titul_za FROM uzivatel JOIN casopis ON id_uzivatele = odpovida WHERE uzaverka >= '$datum';");
      if (!$vysledek){
        echo ("<h5>Aktuálně nejsou dispozici žádné čísla časopisu.</h5>");
      }else {
      ?>
      <table class="font table table-striped table-hover">
        <thead>
          <tr>
            <th>Číslo časopisu</th>
            <th>Zbývající kapacita článků</th>
            <th>Uzávěrka čísla</th>
            <th>Témata</th>
            <th>Editor</th>
          </tr>
       </thead>
      <tbody>
      <?php
        while ($casopis = $vysledek->fetch_array()){
          @$vysledek2 = $mysqli->query("SELECT COUNT(casopis) AS 'pocet' FROM clanek WHERE casopis = " . $casopis['id_casopisu'] . ";");
          $clanky = $vysledek2->fetch_array();
          echo('<tr><td>'. $casopis['rok'] . '/' . $casopis['cislo'] .'</td>');
          $zbyvajiciClanky = $casopis['kapacita'] - $clanky['pocet'];
          echo('<td>'. $zbyvajiciClanky .'</td>');
          echo('<td>'. strftime("%e.%m. %Y" ,strtotime($casopis['uzaverka'])) .'</td>');
          echo('<td>'. $casopis['temata'] .'</td>');
          echo('<td>'. getCeleJmeno($casopis['titul_pred'], $casopis['jmeno'], $casopis['prijmeni'], $casopis['titul_za']) .'</td></tr>');
        }
      ?>
    </tbody>
      </table>
    <?php } ?>
    </div>
    <?php if(isset($_SESSION['autor'])) {  ?>
    <div class="col-sm-12">
      <h4 class="hlavni-nadpis">Moje nejnovější nahrané články</h4>
      <?php
      @$vysledek = $mysqli->query("SELECT id_clanku, nazev_clanku, datum_vlozeni, stav, rok, cislo FROM clanek JOIN casopis ON casopis = id_casopisu WHERE odpovedny_uzivatel = " . $_SESSION['id_uzivatele'] . " ORDER BY datum_vlozeni DESC LIMIT 0, 5;");
      if (!$vysledek){
        echo ("<h5>Ještě nemáte nahrané žádné články.</h5>");
      } else {
      ?>
      <table class="font table table-striped table-hover">
        <thead>
          <tr>
            <th>Název článku</th>
            <th>Datum vložení</th>
            <th>Stav</th>
            <th>Časopis</th>
          </tr>
       </thead>
      <tbody>
      <?php
        while ($clanek = $vysledek->fetch_array()){
          echo('<tr><td>'. $clanek['nazev_clanku'] .'</td>');
          echo('<td>'. strftime("%e.%m. %Y" ,strtotime($clanek['datum_vlozeni'])) .'</td>');
          echo('<td>'. $clanek['stav'] .'</td>');
          echo('<td>'. $clanek['rok'] . '/' . $clanek['cislo'] .'</td>');
        }
      ?>
    </tbody>
      </table>
    <?php } ?>
    </div>
  <?php
  }
  if (isset($_SESSION['recenzent'])) {
  ?>
    <div class="col-sm-12">
      <h4 class="hlavni-nadpis">Moje nejnovější nahrané recenze</h4>
      <?php
        @$vysledek = $mysqli->query("SELECT id_recenze, datum, nazev_clanku, stav, rok, cislo FROM recenze NATURAL JOIN clanek JOIN casopis ON casopis = id_casopisu WHERE id_uzivatele = " . $_SESSION['id_uzivatele'] . " ORDER BY datum DESC LIMIT 0, 5;");
        if (!$vysledek) {
          echo ("<h5>Ještě nemáte nahrané žádné recenze k článkům.</h5>");
        } else {
      ?>
      <table class="font table table-striped table-hover">
        <thead>
          <tr>
            <th>Název recenzovaného článku</th>
            <th>Datum vložení</th>
            <th>Stav článku </th>
            <th>Číslo časopisu</th>
          </tr>
       </thead>
      <tbody>
      <?php
        while ($recenze = $vysledek->fetch_array()){
          echo('<tr><td>'. $recenze['nazev_clanku'] .'</td>');
          echo('<td>'. strftime("%e.%m. %Y" ,strtotime($recenze['datum'])) .'</td>');
          echo('<td>'. $recenze['stav'] .'</td>');
          echo('<td>'. $recenze['rok'] . '/' . $recenze['cislo'] .'</td>');
        }
      ?>
    </tbody>
      </table>
    <?php } ?>
    </div>
    <?php
    }
    if(isset($_SESSION['editor'])) {
    ?>
    <div class="col-sm-12">
      <h4 class="hlavni-nadpis">Časopisy, které editoruji</h4>
      <?php
        $datum = date("Y-m-d");
        @$vysledek = $mysqli->query("SELECT * FROM casopis WHERE odpovida = " . $_SESSION['id_uzivatele'] . " AND uzaverka >= '$datum' ORDER BY uzaverka DESC LIMIT 0, 5;");
        if (!$vysledek){
          echo ("<h5>Aktuálně nemáte k editaci žádná čísla časopisu.</h5>");
        } else {
      ?>
      <table class="tabulka font table table-striped table-hover">
      <thead>
        <tr>
          <th>Číslo časopisu</th>
          <th>Témata</th>
          <th>Uzávěrka časopisu</th>
          <th>Počet nahraných článků</th>
          <th>Kapacita</th>
          <th></th>
        </tr>
     </thead>
        <tbody>
          <?php
            while ($casopis = $vysledek->fetch_array()){
              @$vysledek2 = $mysqli->query("SELECT COUNT(casopis) AS 'pocet' FROM clanek WHERE casopis = " . $casopis['id_casopisu'] . ";");
              $clanky = $vysledek2->fetch_array();
              echo('<tr><td>'.  $casopis['rok'] . '/' . $casopis['cislo'] .'</td>');
              echo('<td>'. $casopis['temata'] .'</td>');
              echo('<td>'. strftime("%e.%m. %Y" ,strtotime($casopis['uzaverka'])) .'</td>');
              echo('<td>'. $clanky['pocet'] .'</td>');
              echo('<td>'. $casopis['kapacita'] .'</td>');
              echo('<td><a class="btn btn-primary btn-sm" href="prehled_clanku.php?id='. $casopis['id_casopisu'] . '">Přehled článků v časopise</a></td></tr>');
            }
           ?>
       </tbody>
     </table>
   <?php } ?>
    </div>
  <?php } ?>
</div>
</div>
<?php include 'paticka.php'?>
<?php
}else{
  header("Location:index.php");
}
?>
