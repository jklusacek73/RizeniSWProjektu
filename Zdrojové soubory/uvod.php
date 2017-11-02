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
      <?php include 'zpravy.php' ?>
    </div>
    <div class="col-sm-12">
      <h4 class="hlavni-nadpis">Nejbližší čísla časopisu</h4>
      <table class="font table table-striped table-hover">
        <thead>
          <tr>
            <th>Číslo časopisu</th>
            <th>Zbývající kapacita článků</th>
            <th>Uzávěrka čísla</th>
            <th>Témata</th>
            <th>Odpovídá</th>
          </tr>
       </thead>
      <tbody>
      <?php
        @$vysledek = $mysqli->query("SELECT id_casopisu, rok, cislo, kapacita, uzaverka, temata, titul_pred, jmeno, prijmeni, titul_za FROM uzivatel JOIN casopis ON id_uzivatele = odpovida");
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
    </div>
    <div class="col-sm-12">
      <h4 class="hlavni-nadpis">Moje nahrané články</h4>
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
        @$vysledek = $mysqli->query("SELECT id_clanku, nazev_clanku, datum_vlozeni, stav, rok, cislo FROM clanek JOIN casopis ON casopis = id_casopisu WHERE odpovedny_uzivatel = " . $_SESSION['id_uzivatele'] . " ORDER BY datum_vlozeni DESC LIMIT 0, 5;");
        while ($clanek = $vysledek->fetch_array()){
          echo('<tr><td>'. $clanek['nazev_clanku'] .'</td>');
          echo('<td>'. strftime("%e.%m. %Y" ,strtotime($clanek['datum_vlozeni'])) .'</td>');
          echo('<td>'. $clanek['stav'] .'</td>');
          echo('<td>'. $clanek['rok'] . '/' . $clanek['cislo'] .'</td>');
        }
      ?>
    </tbody>
      </table>
    </div>
  </div>
</div>
<?php include 'paticka.php'?>
<?php
}else{
  header("Location:index.php");
}
?>
